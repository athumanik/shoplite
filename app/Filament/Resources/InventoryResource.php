<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InventoryResource\Pages;
use App\Filament\Resources\InventoryResource\RelationManagers;
use App\Models\inventory;
use App\Models\inventory_item;
use App\Models\product;
use App\Models\sales;
use App\Models\sales_item;
use Filament\Forms;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;

use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\ExportBulkAction;
use Illuminate\Support\Number;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ExportAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class InventoryResource extends Resource
{
    protected static ?string $model = inventory::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-storefront';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Group::make()
                    ->schema([
                        Section::make('Stocks Info')
                            ->schema([
                                TextInput::make('supplier')
                                    ->required()
                                    ->maxLength(255)
                                    ->default('Regular'),
                                TextInput::make('batch_no')
                                    ->default(inventory::generateBatch())
                                    ->readOnly(),
                                TextInput::make('receipt')
                                    ->default(inventory::generateReceipt())
                                    ->readOnly()
                                    ->columnSpanFull(),
                            ])->columns(2),


                    ])->columns(3),

                Group::make()
                    ->schema([
                        Section::make('Stocks Total')
                            ->schema([
                                Placeholder::make('grand_total_placeholder')
                                    ->label('Grand Total')
                                    ->content(function (Get $get, Set $set) {
                                        $total = 0;
                                        if (!$repeaters = $get('items')) {
                                            return $total;
                                        }
                                        foreach ($repeaters as $key => $repeater) {
                                            $total += $get("items.{$key}.total_amount");
                                        }
                                        $set('grand_total', $total);
                                        return Number::currency($total, 'Tsh');
                                    }),
                                Hidden::make('grand_total')
                                    ->default(0),


                            ]),



                    ])->columns(3),


                Group::make()
                    ->schema([
                        Section::make('Product Stock Entry')
                            ->schema([
                                Repeater::make('items')
                                    ->relationship()
                                    ->schema([
                                        Select::make('product_id')
                                            ->relationship('product', 'name')
                                            // ->label('Jina la Bidhaa')
                                            ->searchable()
                                            ->disableOptionsWhenSelectedInSiblingRepeaterItems()
                                            ->distinct()
                                            ->required()
                                            ->reactive()
                                            ->afterStateUpdated(function ($state, Set $set, Get $get) {
                                                $product = product::find($state);

                                                if ($product) {
                                                    $productCode = strtoupper(substr($product->name, 0, 3)); // First 3 letters of name
                                                    $batch = $get('../../batch_no'); // Get batch_no from parent form
                                                    $sku = $productCode . '-' . str_pad($product->id, 3, '0', STR_PAD_LEFT) . '-' . $batch;

                                                    $set('unit_amount', $product->buying_price);
                                                    $set('total_amount', $product->buying_price); // Initial total, quantity=1
                                                    $set('sku', $sku);
                                                } else {
                                                    $set('unit_amount', 0);
                                                    $set('total_amount', 0);
                                                    $set('sku', null);
                                                }
                                            })
                                            ->columnSpanFull()
                                            ->preload(),

                                        TextInput::make('quantity')
                                            // ->label('Idadi')
                                            ->required(fn(string $context): bool => $context === 'create') // Only required on create
                                            ->default(1)
                                            ->minValue(1)

                                            ->helperText(fn(Get $get, string $context) => $get('product_id')
                                                ? ($context === 'create'
                                                    ? "Zimebaki: " . max(
                                                        (inventory_item::where('product_id', $get('product_id'))->first()?->quantity ?? 0) -
                                                        sales_item::where('product_id', $get('product_id'))->sum('quantity'),
                                                        0
                                                    )
                                                    : "Physical Count: " . (
                                                        (inventory_item::where('product_id', $get('product_id'))->first()?->quantity ?? 0) -
                                                        sales_item::where('product_id', $get('product_id'))->sum('quantity')
                                                    )
                                                )
                                                : "Choose product")
                                            ->reactive()
                                            ->afterStateUpdated(fn($state, Set $set, Get $get)
                                                => $set('total_amount', $state * $get('unit_amount')))
                                            ->numeric(),

                                        TextInput::make('unit_amount')
                                            ->required()
                                            ->disabled()
                                            ->dehydrated()
                                            ->numeric(),
                                        TextInput::make('total_amount')
                                            ->required()
                                            ->readOnly()
                                            ->dehydrated()
                                            ->numeric(),
                                        TextInput::make('sku')
                                            ->required()
                                            ->readOnly()
                                            ->dehydrated(),

                                    ])->grid(2)
                                    ->defaultItems(2)
                                    // ->columns(['default' => 2, 'md' => 2, 'xl' => 2])
                                    ->deleteAction(
                                        fn(Action $action) => $action->requiresConfirmation(),
                                    )
                                    ->deletable(Auth::user()->hasrole(['admin', 'super_admin',]))
                                    ->columns(2),

                            ])
                    ])->columnSpanFull(),


                Group::make()
                    ->schema([
                        Section::make('Stocks Assured')
                            ->schema([
                                TextInput::make('notes')
                                    ->default('Stock made by ' . Auth::user()->name . ' @ ' . now())
                                    ->readOnly(),

                                DateTimePicker::make('created_at')
                                    ->label('Stock Date')
                                    ->native(false)
                                    ->columnSpanFull()
                                    ->default(now()),

                            ]),

                    ])->columns(3),
                Group::make()
                    ->schema([

                        Section::make('Payment method')
                            ->schema([

                                ToggleButtons::make('payment_method')
                                    // ->hidden()
                                    ->inline()
                                    ->options([
                                        'Cash' => 'Cash',
                                        'card' => 'Card',
                                        'M-pesa' => 'M-pesa',
                                        'T-pesa' => 'T-pesa',
                                    ])
                                    ->icons([
                                        'Cash' => 'heroicon-o-currency-dollar',
                                        'card' => 'heroicon-o-credit-card',
                                        'M-pesa' => 'heroicon-o-credit-card',
                                        'T-pesa' => 'heroicon-o-credit-card',
                                    ])
                                    ->columnSpanFull()
                                    ->default('Cash')
                                    ->required(),
                                ToggleButtons::make('status')
                                    ->inline()
                                    // ->hidden()

                                    ->options([
                                        'paid' => 'Paid',
                                        'pending' => 'Pending',
                                        'cancelled' => 'Cancelled',
                                    ])
                                    ->default('paid')
                                    ->colors([
                                        'paid' => 'success',
                                        'pending' => 'warning',
                                        'cancelled' => 'danger',
                                    ])
                                    ->icons([
                                        'Paid' => 'heroicon-m-check-badge',
                                        'pending' => 'heroicon-m-arrow-path',
                                        'cancelled' => 'heroicon-m-x-circle',
                                    ])->columnSpanFull(),

                            ])->columns(2)
                    ])->columns(3),


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('supplier')
                    ->searchable(),
                TextColumn::make(' ')
                    ->label('Stock Goods')
                    ->numeric()
                    ->color('gray')
                    ->badge()
                    ->getStateUsing(function ($record) {
                        return inventory_item::where('inventory_id', $record->id)->sum('quantity');
                    }),


                TextColumn::make('grand_total')
                    ->numeric()
                    ->money('Tsh'),
                TextColumn::make('batch_no')
                    ->color('gray')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->badge(),

                SelectColumn::make('payment_method')
                    ->options([
                        'Cash' => 'Cash',
                        'card' => 'Card',
                    ])
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'paid' => 'success',
                        'pending' => 'warning',
                        'cancelled' => 'danger',
                    })
                    ->icon(fn(string $state): string => match ($state) {
                        'paid' => 'heroicon-m-check-badge',
                        'pending' => 'heroicon-m-arrow-path',
                        'cancelled' => 'heroicon-m-x-circle',
                    })
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make(
                    [
                        EditAction::make(),
                        ViewAction::make(),
                        DeleteAction::make()
                            ->successNotification(
                                Notification::make()
                                    ->success()
                                    ->title('Stock Deleted')
                                    ->body('The Stock Product deleted successfully')

                            )
                    ]
                )->tooltip('Actions')
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInventories::route('/'),
            'create' => Pages\CreateInventory::route('/create'),
            'view' => Pages\ViewInventory::route('/{record}'),
            'edit' => Pages\EditInventory::route('/{record}/edit'),
        ];
    }
}
