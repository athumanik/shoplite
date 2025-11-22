{{-- <x-dashboard-layout> --}}


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales - Shoplite Agrovet</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #f8fafc;
        }
        .sidebar {
            transition: all 0.3s ease;
        }
        .table-row:hover {
            background-color: #f9fafb;
        }
        .form-card {
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
        }
        .status-badge {
            font-size: 0.75rem;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
        }
        .payment-badge {
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
            border-radius: 6px;
        }
    </style>
</head>
<body class="antialiased">
    <!-- Main Layout -->
    <div class="flex h-screen bg-gray-50">
        <!-- Sidebar -->
        <div class="sidebar w-64 bg-white border-r border-gray-200 flex flex-col">
            <!-- Logo -->
            <div class="flex items-center justify-center h-16 border-b border-gray-200">
                <div class="flex items-center">
                    <a href="{{ route('dashboard') }}" > <svg class="h-8 w-8 text-green-600" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2L3 9V20C3 20.5304 3.21071 21.0391 3.58579 21.4142C3.96086 21.7893 4.46957 22 5 22H19C19.5304 22 20.0391 21.7893 20.4142 21.4142C20.7893 21.0391 21 20.5304 21 20V9L12 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M9 22V12H15V22" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M9 12H15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg></a>
                    <span class="ml-2 text-xl font-bold text-gray-800">Shoplite</span>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 px-4 py-6 space-y-2">
                <a href="{{ route('sales.index') }}" class="flex items-center px-3 py-2 text-gray-700 bg-green-50 rounded-lg border border-green-200">
                    <i class="fas fa-shopping-cart w-5 h-5 mr-3 text-green-600"></i>
                    <span class="font-medium">Sales</span>
                </a>
                <a href="{{ route('wholesale') }}" class="flex items-center px-3 py-2 text-gray-700 bg-green-50 rounded-lg">
                    <i class="fas fa-shopping-cart w-5 h-5 mr-3"></i>
                    <span class="font-medium">WholeSales</span>
                </a>
                <a href="{{ route('products') }}" class="flex items-center px-3 py-2 text-gray-600 hover:bg-gray-100 rounded-lg">
                    <i class="fas fa-cube w-5 h-5 mr-3"></i>
                    <span>Products</span>
                </a>

                <a href="{{ route('inventory.index') }}" class="flex items-center px-3 py-2 text-gray-600 hover:bg-gray-100 rounded-lg">
                    <i class="fas fa-boxes w-5 h-5 mr-3"></i>
                    <span>Inventory</span>
                </a>
                  <a href="#" class="flex items-center px-3 py-2 text-gray-600 hover:bg-gray-100 rounded-lg">
                    <i class="fas fa-users w-5 h-5 mr-3"></i>
                    <span>Customers</span>
                </a>
                <a href="{{ route('report') }}" class="flex items-center px-3 py-2 text-gray-600 hover:bg-gray-100 rounded-lg">
                    <i class="fas fa-chart-bar w-5 h-5 mr-3"></i>
                    <span>Reports</span>
                </a>
                 <a href="{{ route('expense') }}"
                    class="flex items-center px-3 py-2 text-gray-600 hover:bg-gray-100 rounded-lg">
                    <i class="fas fa-money-bill-wave w-5 h-5 mr-3 "></i>
                    <span class="font-medium sidebar-text">Expenses</span>
                </a>
            </nav>

            <!-- User Profile -->
            <div class="border-t border-gray-200 p-4">
                <div class="flex items-center">
                    <div class="h-8 w-8 rounded-full bg-green-100 flex items-center justify-center">
                        <span class="text-green-600 font-medium text-sm">JD</span>
                    </div>
                    <div class="ml-3">
                        <div class="text-sm font-medium text-gray-900">John Doe</div>
                        <div class="text-xs text-gray-500">Agrovet Manager</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <header class="bg-white border-b border-gray-200">
                <div class="flex items-center justify-between px-6 py-4">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900" id="page-title">Sales</h1>
                        <p class="text-sm text-gray-600 mt-1" id="page-description">Manage your sales transactions</p>
                    </div>
                    <div class="flex items-center space-x-3">
                        <button class="px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 flex items-center">
                            <i class="fas fa-filter mr-2"></i>
                            Filter
                        </button>
                        <button class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 flex items-center" id="create-sale-btn">
                            <i class="fas fa-plus mr-2"></i>
                            New Sale
                        </button>
                    </div>
                </div>
            </header>

            <!-- Content Area -->
            <div class="flex-1 overflow-auto">
                <!-- Sales List View -->
                <div id="list-view" class="p-6">
                    <!-- Stats Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                        <div class="bg-white rounded-lg border border-gray-200 p-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-600">Total Sales</p>
                                    <p class="text-2xl font-bold text-gray-900 mt-1">$12,458</p>
                                </div>
                                <div class="h-12 w-12 bg-green-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-shopping-cart text-green-600 text-xl"></i>
                                </div>
                            </div>
                            <p class="text-xs text-green-600 mt-2">
                                <i class="fas fa-arrow-up mr-1"></i>12% from last month
                            </p>
                        </div>

                        <div class="bg-white rounded-lg border border-gray-200 p-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-600">Today's Sales</p>
                                    <p class="text-2xl font-bold text-gray-900 mt-1">$1,234</p>
                                </div>
                                <div class="h-12 w-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-calendar-day text-blue-600 text-xl"></i>
                                </div>
                            </div>
                            <p class="text-xs text-gray-600 mt-2">8 transactions today</p>
                        </div>

                        <div class="bg-white rounded-lg border border-gray-200 p-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-600">Pending Orders</p>
                                    <p class="text-2xl font-bold text-gray-900 mt-1">3</p>
                                </div>
                                <div class="h-12 w-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-clock text-yellow-600 text-xl"></i>
                                </div>
                            </div>
                            <p class="text-xs text-gray-600 mt-2">Waiting for completion</p>
                        </div>

                        <div class="bg-white rounded-lg border border-gray-200 p-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-600">Avg. Sale Value</p>
                                    <p class="text-2xl font-bold text-gray-900 mt-1">$156</p>
                                </div>
                                <div class="h-12 w-12 bg-purple-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-chart-line text-purple-600 text-xl"></i>
                                </div>
                            </div>
                            <p class="text-xs text-gray-600 mt-2">Per transaction</p>
                        </div>
                    </div>

                    <!-- Sales Table -->
                    <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
                        <!-- Table Header -->
                        <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                            <h3 class="text-lg font-medium text-gray-900">Recent Sales</h3>
                            <div class="flex items-center space-x-3">
                                <div class="relative">
                                    <input type="text" placeholder="Search sales..." class="pl-9 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                    <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                </div>
                                <button class="p-2 border border-gray-300 rounded-lg hover:bg-gray-50">
                                    <i class="fas fa-download text-gray-600"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Table -->
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sale ID</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Payment</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200" id="sales-table-body">
                                    <!-- Sales data will be loaded here -->
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="px-6 py-4 border-t border-gray-200 flex items-center justify-between">
                            <div class="text-sm text-gray-700">
                                Showing <span class="font-medium">1</span> to <span class="font-medium">10</span> of <span class="font-medium">97</span> results
                            </div>
                            <div class="flex space-x-2">
                                <button class="px-3 py-1 border border-gray-300 rounded text-sm font-medium text-gray-700 hover:bg-gray-50">Previous</button>
                                <button class="px-3 py-1 border border-gray-300 rounded text-sm font-medium text-gray-700 hover:bg-gray-50">Next</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Create/Edit Sale Form -->
                <div id="form-view" class="hidden p-6">
                    <div class="max-w-4xl mx-auto">
                        <div class="form-card bg-white rounded-lg border border-gray-200">
                            <!-- Form Header -->
                            <div class="px-6 py-4 border-b border-gray-200">
                                <div class="flex items-center justify-between">
                                    <h3 class="text-lg font-medium text-gray-900" id="form-title">Create New Sale</h3>
                                    <button class="text-gray-400 hover:text-gray-600" id="back-to-list">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Form Content -->
                            <div class="p-6">
                                <form id="sale-form">
                                    <!-- Customer & Payment Info -->
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                        <div>
                                            <label for="customer" class="block text-sm font-medium text-gray-700 mb-2">Customer</label>
                                            <input type="text" id="customer" name="customer"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                                placeholder="Enter customer name" value="Regular">
                                        </div>
                                        <div>
                                            <label for="payment_method" class="block text-sm font-medium text-gray-700 mb-2">Payment Method</label>
                                            <select id="payment_method" name="payment_method"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                                <option value="cash">Cash</option>
                                                <option value="card">Card</option>
                                                <option value="mobile">Mobile Money</option>
                                                <option value="credit">Farmer Credit</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Sale Items -->
                                    <div class="mb-6">
                                        <div class="flex items-center justify-between mb-4">
                                            <label class="block text-sm font-medium text-gray-700">Sale Items</label>
                                            <button type="button" id="add-item-btn" class="px-3 py-1 bg-green-600 text-white rounded text-sm hover:bg-green-700">
                                                <i class="fas fa-plus mr-1"></i>Add Item
                                            </button>
                                        </div>

                                        <div class="border border-gray-200 rounded-lg overflow-hidden">
                                            <table class="w-full">
                                                <thead class="bg-gray-50">
                                                    <tr>
                                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Product</th>
                                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Quantity</th>
                                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Unit Price</th>
                                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="sale-items-container" class="divide-y divide-gray-200">
                                                    <!-- Sale items will be added here -->
                                                </tbody>
                                                <tfoot class="bg-gray-50">
                                                    <tr>
                                                        <td colspan="3" class="px-4 py-3 text-right text-sm font-medium text-gray-700">Subtotal</td>
                                                        <td class="px-4 py-3 text-sm font-medium text-gray-900" id="subtotal-display">$0.00</td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3" class="px-4 py-3 text-right text-sm font-medium text-gray-700">Tax (8%)</td>
                                                        <td class="px-4 py-3 text-sm font-medium text-gray-900" id="tax-display">$0.00</td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3" class="px-4 py-3 text-right text-sm font-medium text-gray-700">Grand Total</td>
                                                        <td class="px-4 py-3 text-lg font-bold text-green-600" id="grand-total-display">$0.00</td>
                                                        <td></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>

                                    <!-- Notes -->
                                    <div class="mb-6">
                                        <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">Notes</label>
                                        <textarea id="notes" name="notes" rows="3"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                            placeholder="Add any notes about this sale..."></textarea>
                                    </div>

                                    <!-- Form Actions -->
                                    <div class="flex items-center justify-end space-x-3 pt-6 border-t border-gray-200">
                                        <button type="button" id="cancel-form" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                                            Cancel
                                        </button>
                                        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                                            Save Sale
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        class SalesResource {
            constructor() {
                this.currentView = 'list';
                this.sales = [];
                this.products = [];
                this.currentSaleId = null;

                this.initializeEventListeners();
                this.loadSampleData();
                this.renderSalesList();
            }

            initializeEventListeners() {
                // Navigation
                document.getElementById('create-sale-btn').addEventListener('click', () => this.showFormView());
                document.getElementById('back-to-list').addEventListener('click', () => this.showListView());
                document.getElementById('cancel-form').addEventListener('click', () => this.showListView());

                // Form
                document.getElementById('sale-form').addEventListener('submit', (e) => this.handleFormSubmit(e));
                document.getElementById('add-item-btn').addEventListener('click', () => this.addSaleItem());

                // Sale items event delegation
                document.getElementById('sale-items-container').addEventListener('input', (e) => this.updateTotals());
                document.getElementById('sale-items-container').addEventListener('click', (e) => this.handleItemAction(e));
            }

            loadSampleData() {
                // Sample sales data
                this.sales = [
                    { id: 1, customer: 'John Farmer', grand_total: 156.75, payment_method: 'cash', status: 'paid', created_at: '2023-12-01 14:30:00' },
                    { id: 2, customer: 'Green Valley Farm', grand_total: 289.50, payment_method: 'card', status: 'paid', created_at: '2023-12-01 11:15:00' },
                    { id: 3, customer: 'Regular', grand_total: 45.25, payment_method: 'mobile', status: 'paid', created_at: '2023-11-30 16:45:00' },
                    { id: 4, customer: 'Maria Sanchez', grand_total: 178.90, payment_method: 'credit', status: 'pending', created_at: '2023-11-30 09:20:00' },
                    { id: 5, customer: 'Robert Kimani', grand_total: 324.15, payment_method: 'cash', status: 'paid', created_at: '2023-11-29 13:10:00' }
                ];

                // Sample products
                this.products = [
                    { id: 1, name: 'Livestock Vaccine', price: 24.99 },
                    { id: 2, name: 'Organic Fertilizer', price: 19.99 },
                    { id: 3, name: 'Premium Animal Feed', price: 34.99 },
                    { id: 4, name: 'Farm Sprayer', price: 89.99 },
                    { id: 5, name: 'Antibiotics', price: 15.99 }
                ];
            }

            showListView() {
                this.currentView = 'list';
                document.getElementById('list-view').classList.remove('hidden');
                document.getElementById('form-view').classList.add('hidden');
                document.getElementById('page-title').textContent = 'Sales';
                document.getElementById('page-description').textContent = 'Manage your sales transactions';
            }

            showFormView(saleId = null) {
                this.currentView = 'form';
                this.currentSaleId = saleId;

                document.getElementById('list-view').classList.add('hidden');
                document.getElementById('form-view').classList.remove('hidden');

                if (saleId) {
                    document.getElementById('form-title').textContent = 'Edit Sale';
                    this.loadSaleForEdit(saleId);
                } else {
                    document.getElementById('form-title').textContent = 'Create New Sale';
                    this.resetForm();
                }
            }

            resetForm() {
                document.getElementById('sale-form').reset();
                document.getElementById('sale-items-container').innerHTML = '';
                this.addSaleItem(); // Add one empty item
                this.updateTotals();
            }

            addSaleItem(product = null) {
                const container = document.getElementById('sale-items-container');
                const itemId = Date.now();

                const itemHtml = `
                    <tr class="sale-item" data-item-id="${itemId}">
                        <td class="px-4 py-3">
                            <select name="items[${itemId}][product_id]" class="product-select w-full px-2 py-1 border border-gray-300 rounded text-sm focus:outline-none focus:ring-1 focus:ring-green-500">
                                <option value="">Select Product</option>
                                ${this.products.map(p => `<option value="${p.id}" ${product && product.product_id === p.id ? 'selected' : ''}>${p.name} - $${p.price}</option>`).join('')}
                            </select>
                        </td>
                        <td class="px-4 py-3">
                            <input type="number" name="items[${itemId}][quantity]" value="${product ? product.quantity : 1}" min="1"
                                class="quantity-input w-20 px-2 py-1 border border-gray-300 rounded text-sm focus:outline-none focus:ring-1 focus:ring-green-500">
                        </td>
                        <td class="px-4 py-3">
                            <input type="number" name="items[${itemId}][unit_amount]" value="${product ? product.unit_amount : ''}" step="0.01"
                                class="price-input w-24 px-2 py-1 border border-gray-300 rounded text-sm focus:outline-none focus:ring-1 focus:ring-green-500" placeholder="0.00">
                        </td>
                        <td class="px-4 py-3">
                            <span class="item-total text-sm font-medium">$0.00</span>
                        </td>
                        <td class="px-4 py-3">
                            <button type="button" class="remove-item text-red-600 hover:text-red-800">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                `;

                container.insertAdjacentHTML('beforeend', itemHtml);
                this.updateTotals();
            }

            handleItemAction(e) {
                if (e.target.closest('.remove-item')) {
                    const itemRow = e.target.closest('.sale-item');
                    if (document.querySelectorAll('.sale-item').length > 1) {
                        itemRow.remove();
                        this.updateTotals();
                    } else {
                        alert('At least one item is required');
                    }
                }
            }

            updateTotals() {
                let subtotal = 0;

                document.querySelectorAll('.sale-item').forEach(row => {
                    const quantity = parseFloat(row.querySelector('.quantity-input').value) || 0;
                    const price = parseFloat(row.querySelector('.price-input').value) || 0;
                    const total = quantity * price;

                    row.querySelector('.item-total').textContent = `$${total.toFixed(2)}`;
                    subtotal += total;
                });

                const tax = subtotal * 0.08;
                const grandTotal = subtotal + tax;

                document.getElementById('subtotal-display').textContent = `$${subtotal.toFixed(2)}`;
                document.getElementById('tax-display').textContent = `$${tax.toFixed(2)}`;
                document.getElementById('grand-total-display').textContent = `$${grandTotal.toFixed(2)}`;
            }

            renderSalesList() {
                const tbody = document.getElementById('sales-table-body');
                tbody.innerHTML = '';

                this.sales.forEach(sale => {
                    const row = this.createSaleRow(sale);
                    tbody.appendChild(row);
                });
            }

            createSaleRow(sale) {
                const row = document.createElement('tr');
                row.className = 'table-row';

                const statusBadge = sale.status === 'paid' ?
                    '<span class="status-badge bg-green-100 text-green-800">Paid</span>' :
                    '<span class="status-badge bg-yellow-100 text-yellow-800">Pending</span>';

                const paymentBadge = this.getPaymentBadge(sale.payment_method);

                row.innerHTML = `
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#${sale.id}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${sale.customer}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${new Date(sale.created_at).toLocaleDateString()}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">$${sale.grand_total}</td>
                    <td class="px-6 py-4 whitespace-nowrap">${paymentBadge}</td>
                    <td class="px-6 py-4 whitespace-nowrap">${statusBadge}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <button class="text-green-600 hover:text-green-900 mr-3 edit-sale" data-id="${sale.id}">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="text-red-600 hover:text-red-900 delete-sale" data-id="${sale.id}">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                `;

                // Add event listeners
                row.querySelector('.edit-sale').addEventListener('click', (e) => {
                    this.showFormView(sale.id);
                });

                row.querySelector('.delete-sale').addEventListener('click', (e) => {
                    this.deleteSale(sale.id);
                });

                return row;
            }

            getPaymentBadge(method) {
                const badges = {
                    cash: 'bg-green-100 text-green-800',
                    card: 'bg-blue-100 text-blue-800',
                    mobile: 'bg-purple-100 text-purple-800',
                    credit: 'bg-yellow-100 text-yellow-800'
                };

                const methodText = {
                    cash: 'Cash',
                    card: 'Card',
                    mobile: 'Mobile',
                    credit: 'Credit'
                };

                return `<span class="payment-badge ${badges[method]}">${methodText[method]}</span>`;
            }

            loadSaleForEdit(saleId) {
                // In real app, this would fetch from API
                const sale = this.sales.find(s => s.id === saleId);
                if (sale) {
                    document.getElementById('customer').value = sale.customer;
                    document.getElementById('payment_method').value = sale.payment_method;
                    // Load sale items would go here
                }
            }

            handleFormSubmit(e) {
                e.preventDefault();

                const formData = new FormData(e.target);
                const saleData = {
                    customer: formData.get('customer'),
                    payment_method: formData.get('payment_method'),
                    notes: formData.get('notes'),
                    items: []
                };

                // Collect items data
                document.querySelectorAll('.sale-item').forEach(row => {
                    const productId = row.querySelector('.product-select').value;
                    const quantity = row.querySelector('.quantity-input').value;
                    const unitAmount = row.querySelector('.price-input').value;

                    if (productId && quantity && unitAmount) {
                        saleData.items.push({
                            product_id: productId,
                            quantity: parseInt(quantity),
                            unit_amount: parseFloat(unitAmount),
                            total_amount: parseFloat(quantity) * parseFloat(unitAmount)
                        });
                    }
                });

                // Calculate grand total
                saleData.grand_total = saleData.items.reduce((sum, item) => sum + item.total_amount, 0) * 1.08;

                if (this.currentSaleId) {
                    this.updateSale(this.currentSaleId, saleData);
                } else {
                    this.createSale(saleData);
                }
            }

            createSale(saleData) {
                // In real app, this would be an API call
                console.log('Creating sale:', saleData);
                alert('Sale created successfully!');
                this.showListView();
                this.loadSampleData(); // Refresh data
                this.renderSalesList();
            }

            updateSale(saleId, saleData) {
                // In real app, this would be an API call
                console.log('Updating sale:', saleId, saleData);
                alert('Sale updated successfully!');
                this.showListView();
                this.loadSampleData(); // Refresh data
                this.renderSalesList();
            }

            deleteSale(saleId) {
                if (confirm('Are you sure you want to delete this sale?')) {
                    // In real app, this would be an API call
                    console.log('Deleting sale:', saleId);
                    alert('Sale deleted successfully!');
                    this.loadSampleData(); // Refresh data
                    this.renderSalesList();
                }
            }
        }

        // Initialize the sales resource when page loads
        document.addEventListener('DOMContentLoaded', function() {
            window.salesResource = new SalesResource();
        });
    </script>

</body>
</html>
{{-- </x-dashboard-layout> --}}
