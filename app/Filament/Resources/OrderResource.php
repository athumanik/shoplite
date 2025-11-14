<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\order;
use App\Models\order_item;
use App\Models\inventory;
use App\Models\inventory_item;
use App\Models\product;
use App\Models\sales;
use App\Models\sales_item;
use Filament\Forms;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\DatePicker;
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
use Filament\Tables\Actions\ExportBulkAction;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\Indicator;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Support\Carbon;
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

class OrderResource extends Resource
{
    protected static ?string $model = order::class;

    protected static ?string $navigationIcon = 'heroicon-o-sparkles';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Group::make()
                    ->schema([
                        Section::make('Sales Information')
                            ->schema([
                                TextInput::make('customer')
                                    // ->placeholder('Regular Customer')
                                    ->default('Regular')
                                    ->required()
                                    ->label('Customer'),
                                TextInput::make('receipt')
                                    ->default(sales::generateReceipt())
                                    ->readOnly(),

                            ])->columns(2)
                    ])->columns(3),

                Group::make()
                    ->schema([
                        Section::make('Sales Total')
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
                        Section::make('Ordered Products')
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
                                            ->afterStateUpdated(fn($state, Set $set)
                                                => $set('unit_amount', product::find($state)?->price ?? 0))
                                            ->afterStateUpdated(fn($state, Set $set)
                                                => $set('total_amount', product::find($state)?->price ?? 0))
                                            ->columnSpanFull()
                                            ->preload(),

                                        TextInput::make('quantity')
                                            // ->label('Idadi')
                                            ->required(fn(string $context): bool => $context === 'create') // Only required on create
                                            ->default(1)
                                            ->minValue(1)
                                            // ->maxValue(
                                            //     fn($get, $livewire, string $context) => $context === 'create'
                                            //     ? max(
                                            //         inventory_item::where('product_id', $get('product_id'))->sum('quantity') -
                                            //         sales_item::where('product_id', $get('product_id'))->sum('quantity'),
                                            //         0
                                            //     )
                                            //     : null // No max limit when editing
                                            // )
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

                                    ])->grid(2)
                                    ->defaultItems(2)
                                    // ->columns(['default' => 2, 'md' => 2, 'xl' => 2])
                                    ->deleteAction(
                                        fn(Action $action) => $action->requiresConfirmation(),
                                    )
                                    ->deletable(Auth::user()->hasrole(['admin', 'super_admin',]))
                                    ->columns(3),


                            ])
                    ])   ->columnSpanFull(),


                    //
                Group::make()
                    ->schema([
                        Section::make('Order Assured')
                            ->schema([
                                TextInput::make('notes')
                                    ->default('Order made by ' . Auth::user()->name . ' @ ' . now())
                                    ->readOnly(),

                                DateTimePicker::make('created_at')
                                    ->label('Order Date')
                                    ->native(false)
                                    ->columnSpanFull()
                                    ->default(now()),

                            ])
                    ]),

                Group::make()
                    ->schema([
                        Section::make('Payment method')
                            ->schema([

                                ToggleButtons::make('payment_method')
                                    // ->hidden()
                                    ->inline()
                                    ->options([
                                        'cash' => 'Cash',
                                        'card' => 'Card',
                                        'M-pesa' => 'M-pesa',
                                        'T-pesa' => 'T-pesa',
                                    ])
                                    ->icons([
                                        'cash' => 'heroicon-o-currency-dollar',
                                        'card' => 'heroicon-o-credit-card',
                                        'M-pesa' => 'heroicon-o-credit-card',
                                        'T-pesa' => 'heroicon-o-credit-card',
                                    ])
                                    ->columnSpanFull()
                                    ->default('card')
                                    ->required(),
                                ToggleButtons::make('status')
                                    ->inline()
                                    // ->hidden()

                                    ->options([
                                        // 'paid' => 'Paid',
                                        'pending' => 'Pending',
                                        'delivered' => 'Delivered',
                                        'cancelled' => 'Cancelled',
                                    ])
                                    ->default('pending')
                                    ->colors([
                                        // 'paid' => 'success',
                                        'pending' => 'warning',
                                        'delivered' => 'success',
                                        'cancelled' => 'danger',
                                    ])
                                    ->icons([
                                        // 'Paid' => 'heroicon-m-check-badge',
                                        'pending' => 'heroicon-m-arrow-path',
                                        'delivered' => 'heroicon-o-truck',
                                        'cancelled' => 'heroicon-m-x-circle',
                                    ])->columnSpanFull(),

                            ])->columns(2)
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('customer')
                    ->label('Cutomer')
                    ->searchable(),

                TextColumn::make(' ')
                    ->label('Ordered Products')
                    ->numeric()
                    ->color('gray')
                    ->badge()
                    ->getStateUsing(function ($record) {
                        return order_item::where('order_id', $record->id)->sum('quantity');
                    }),


                TextColumn::make('grand_total')
                    ->numeric()
                    ->money('Tsh'),

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
                        'delivered' => 'success',
                        'pending' => 'warning',
                        'cancelled' => 'danger',
                    })
                    ->icon(fn(string $state): string => match ($state) {
                        'delivered' => 'heroicon-o-truck',
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
                // Existing Filters
                SelectFilter::make('product')
                    ->relationship('product', 'name')
                    ->preload()
                    ->searchable(),

                Filter::make('created_at')
                    ->form([
                        DatePicker::make('created_from'),
                        DatePicker::make('created_until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn(Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn(Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];

                        if ($data['created_from'] ?? null) {
                            $indicators[] = Indicator::make('Created from ' . Carbon::parse($data['created_from'])->toFormattedDateString())
                                ->removeField('from');
                        }

                        if ($data['created_until'] ?? null) {
                            $indicators[] = Indicator::make('Created until ' . Carbon::parse($data['created_until'])->toFormattedDateString())
                                ->removeField('until');
                        }

                        return $indicators;
                    }),


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
                                    ->title('Order Deleted')
                                    ->body('The Order Product deleted successfully')

                            )
                    ]
                )->tooltip('Actions')
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'view' => Pages\ViewOrder::route('/{record}'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
