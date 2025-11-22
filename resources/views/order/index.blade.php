<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders - Shoplite Agrovet</title>
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

        .fade-in {
            animation: fadeIn 0.3s ease-in;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .skeleton {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
        }

        @keyframes loading {
            0% {
                background-position: 200% 0;
            }

            100% {
                background-position: -200% 0;
            }
        }

        .progress-bar {
            height: 8px;
            border-radius: 4px;
            background: #e5e7eb;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            border-radius: 4px;
            transition: width 0.3s ease;
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
                    <svg class="h-8 w-8 text-green-600" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M12 2L3 9V20C3 20.5304 3.21071 21.0391 3.58579 21.4142C3.96086 21.7893 4.46957 22 5 22H19C19.5304 22 20.0391 21.7893 20.4142 21.4142C20.7893 21.0391 21 20.5304 21 20V9L12 2Z"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M9 22V12H15V22" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M9 12H15" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                    <span class="ml-2 text-xl font-bold text-gray-800">Shoplite</span>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 px-4 py-6 space-y-2">
                <a href="{{ route('sales.index') }}"
                    class="flex items-center px-3 py-2 text-gray-600 hover:bg-gray-100 rounded-lg">
                    <i class="fas fa-shopping-cart w-5 h-5 mr-3"></i>
                    <span>Sales</span>
                </a>
                    <a href="{{ route('wholesale') }}" class="flex items-center px-3 py-2 text-gray-700 bg-green-50 rounded-lg">
                    <i class="fas fa-shopping-cart w-5 h-5 mr-3"></i>
                    <span class="font-medium">WholeSales</span>
                </a>
                <a href="{{ route('orders') }}"
                    class="flex items-center px-3 py-2 text-gray-700 bg-green-50 rounded-lg border border-green-200">
                    <i class="fas fa-clipboard-list w-5 h-5 mr-3 text-green-600"></i>
                    <span class="font-medium">Orders</span>
                </a>
                <a href="{{ route('products') }}"
                    class="flex items-center px-3 py-2 text-gray-600 hover:bg-gray-100 rounded-lg">
                    <i class="fas fa-cube w-5 h-5 mr-3"></i>
                    <span>Products</span>
                </a>
                <a href="{{ route('inventory.index') }}"
                    class="flex items-center px-3 py-2 text-gray-600 hover:bg-gray-100 rounded-lg">
                    <i class="fas fa-boxes w-5 h-5 mr-3"></i>
                    <span>Inventory</span>
                </a>
                <a href="{{ route('report') }}"
                    class="flex items-center px-3 py-2 text-gray-600 hover:bg-gray-100 rounded-lg">
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
                        <h1 class="text-2xl font-bold text-gray-900" id="page-title">Orders</h1>
                        <p class="text-sm text-gray-600 mt-1" id="page-description">Manage customer orders and pre-sales
                        </p>
                    </div>
                    <div class="flex items-center space-x-3">
                        <button
                            class="px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 flex items-center"
                            id="filter-btn">
                            <i class="fas fa-filter mr-2"></i>
                            Filter
                        </button>
                        <button
                            class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 flex items-center"
                            id="create-order-btn">
                            <i class="fas fa-plus mr-2"></i>
                            New Order
                        </button>
                    </div>
                </div>
            </header>

            <!-- Content Area -->
            <div class="flex-1 overflow-auto">
                <!-- Orders List View -->
                <div id="list-view" class="p-6">
                    <!-- Stats Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                        <div class="bg-white rounded-lg border border-gray-200 p-6 fade-in">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-600">Total Orders</p>
                                    <p class="text-2xl font-bold text-gray-900 mt-1" id="total-orders">--</p>
                                </div>
                                <div class="h-12 w-12 bg-green-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-clipboard-list text-green-600 text-xl"></i>
                                </div>
                            </div>
                            <p class="text-xs text-gray-600 mt-2">All time orders</p>
                        </div>

                        <div class="bg-white rounded-lg border border-gray-200 p-6 fade-in">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-600">Pending Orders</p>
                                    <p class="text-2xl font-bold text-gray-900 mt-1" id="pending-orders">--</p>
                                </div>
                                <div class="h-12 w-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-clock text-yellow-600 text-xl"></i>
                                </div>
                            </div>
                            <p class="text-xs text-gray-600 mt-2">Awaiting completion</p>
                        </div>

                        <div class="bg-white rounded-lg border border-gray-200 p-6 fade-in">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-600">Completed Today</p>
                                    <p class="text-2xl font-bold text-gray-900 mt-1" id="completed-today">--</p>
                                </div>
                                <div class="h-12 w-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-check-circle text-blue-600 text-xl"></i>
                                </div>
                            </div>
                            <p class="text-xs text-gray-600 mt-2">Converted to sales</p>
                        </div>

                        <div class="bg-white rounded-lg border border-gray-200 p-6 fade-in">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-600">Order Value</p>
                                    <p class="text-2xl font-bold text-gray-900 mt-1" id="order-value">--</p>
                                </div>
                                <div class="h-12 w-12 bg-purple-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-dollar-sign text-purple-600 text-xl"></i>
                                </div>
                            </div>
                            <p class="text-xs text-gray-600 mt-2">Total pending value</p>
                        </div>
                    </div>

                    <!-- Orders Table -->
                    <div class="bg-white rounded-lg border border-gray-200 overflow-hidden fade-in">
                        <!-- Table Header -->
                        <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                            <h3 class="text-lg font-medium text-gray-900">Customer Orders</h3>
                            <div class="flex items-center space-x-3">
                                <div class="relative">
                                    <input type="text" id="search-input" placeholder="Search orders..."
                                        class="pl-9 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                    <i
                                        class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                </div>
                                <button class="p-2 border border-gray-300 rounded-lg hover:bg-gray-50"
                                    id="export-btn">
                                    <i class="fas fa-download text-gray-600"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Loading State -->
                        <div id="loading-state" class="p-8">
                            <div class="animate-pulse">
                                <div class="space-y-4">
                                    <div class="skeleton h-4 rounded"></div>
                                    <div class="skeleton h-4 rounded"></div>
                                    <div class="skeleton h-4 rounded"></div>
                                    <div class="skeleton h-4 rounded w-3/4"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Table -->
                        <div class="overflow-x-auto">
                            <table class="w-full" id="orders-table" style="display: none;">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Order ID</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Customer</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Date</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Amount</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Payment</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Status</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Progress</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200" id="orders-table-body">
                                    <!-- Orders data will be loaded here -->
                                </tbody>
                            </table>
                        </div>

                        <!-- Empty State -->
                        <div id="empty-state" class="hidden p-12 text-center">
                            <i class="fas fa-clipboard-list text-4xl text-gray-300 mb-4"></i>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">No orders found</h3>
                            <p class="text-gray-500 mb-4">Get started by creating your first customer order.</p>
                            <button class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700"
                                id="create-first-order">
                                Create Order
                            </button>
                        </div>

                        <!-- Pagination -->
                        <div class="px-6 py-4 border-t border-gray-200 flex items-center justify-between"
                            id="pagination-container" style="display: none;">
                            <div class="text-sm text-gray-700">
                                Showing <span class="font-medium" id="pagination-from">1</span> to
                                <span class="font-medium" id="pagination-to">10</span> of
                                <span class="font-medium" id="pagination-total">97</span> results
                            </div>
                            <div class="flex space-x-2">
                                <button
                                    class="px-3 py-1 border border-gray-300 rounded text-sm font-medium text-gray-700 hover:bg-gray-50"
                                    id="prev-page">Previous</button>
                                <button
                                    class="px-3 py-1 border border-gray-300 rounded text-sm font-medium text-gray-700 hover:bg-gray-50"
                                    id="next-page">Next</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Create/Edit Order Form -->
                <div id="form-view" class="hidden p-6">
                    <div class="max-w-6xl mx-auto">
                        <div class="form-card bg-white rounded-lg border border-gray-200 fade-in">
                            <!-- Form Header -->
                            <div class="px-6 py-4 border-b border-gray-200">
                                <div class="flex items-center justify-between">
                                    <h3 class="text-lg font-medium text-gray-900" id="form-title">New Customer Order
                                    </h3>
                                    <button class="text-gray-400 hover:text-gray-600" id="back-to-list">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Form Content -->
                            <div class="p-6">
                                <form id="order-form">
                                    <!-- Customer & Payment Info -->
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                        <div>
                                            <label for="customer"
                                                class="block text-sm font-medium text-gray-700 mb-2">Customer *</label>
                                            <input type="text" id="customer" name="customer" required
                                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                                placeholder="Enter customer name" value="Regular">
                                        </div>
                                        <div>
                                            <label for="payment_method"
                                                class="block text-sm font-medium text-gray-700 mb-2">Payment Method
                                                *</label>
                                            <select id="payment_method" name="payment_method" required
                                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                                <option value="cash">Cash</option>
                                                <option value="card">Card</option>
                                                <option value="mobile">Mobile Money</option>
                                                <option value="credit">Credit</option>
                                                <option value="partial">Partial Payment</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Order Items -->
                                    <div class="mb-6">
                                        <div class="flex items-center justify-between mb-4">
                                            <label class="block text-sm font-medium text-gray-700">Order Items</label>
                                            <button type="button" id="add-item-btn"
                                                class="px-3 py-1 bg-green-600 text-white rounded text-sm hover:bg-green-700">
                                                <i class="fas fa-plus mr-1"></i>Add Item
                                            </button>
                                        </div>

                                        <div class="border border-gray-200 rounded-lg overflow-hidden">
                                            <table class="w-full">
                                                <thead class="bg-gray-50">
                                                    <tr>
                                                        <th
                                                            class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                                            Product</th>
                                                        <th
                                                            class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                                            Quantity</th>
                                                        <th
                                                            class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                                            Unit Price</th>
                                                        <th
                                                            class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                                            Total</th>
                                                        <th
                                                            class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                                            Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="order-items-container" class="divide-y divide-gray-200">
                                                    <!-- Order items will be added here -->
                                                </tbody>
                                                <tfoot class="bg-gray-50">
                                                    <tr>
                                                        <td colspan="3"
                                                            class="px-4 py-3 text-right text-sm font-medium text-gray-700">
                                                            Subtotal</td>
                                                        <td class="px-4 py-3 text-sm font-medium text-gray-900"
                                                            id="subtotal-display">$0.00</td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3"
                                                            class="px-4 py-3 text-right text-sm font-medium text-gray-700">
                                                            Tax (8%)</td>
                                                        <td class="px-4 py-3 text-sm font-medium text-gray-900"
                                                            id="tax-display">$0.00</td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3"
                                                            class="px-4 py-3 text-right text-sm font-medium text-gray-700">
                                                            Grand Total</td>
                                                        <td class="px-4 py-3 text-lg font-bold text-green-600"
                                                            id="grand-total-display">$0.00</td>
                                                        <td></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>

                                    <!-- Payment Progress (for edit mode) -->
                                    <div id="payment-progress-section" class="mb-6 hidden">
                                        <h4 class="text-md font-medium text-gray-900 mb-4">Payment Progress</h4>
                                        <div class="bg-gray-50 p-4 rounded-lg">
                                            <div class="flex justify-between text-sm mb-2">
                                                <span>Amount Paid</span>
                                                <span id="amount-paid-display">$0.00</span>
                                            </div>
                                            <div class="progress-bar mb-2">
                                                <div id="progress-fill" class="progress-fill bg-green-600"
                                                    style="width: 0%"></div>
                                            </div>
                                            <div class="flex justify-between text-sm text-gray-600">
                                                <span id="progress-text">0% Complete</span>
                                                <span id="remaining-amount">$0.00 remaining</span>
                                            </div>
                                            <div class="mt-4">
                                                <label for="additional-payment"
                                                    class="block text-sm font-medium text-gray-700 mb-2">Add
                                                    Payment</label>
                                                <div class="flex space-x-3">
                                                    <input type="number" id="additional-payment" step="0.01"
                                                        min="0"
                                                        class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                                        placeholder="Enter amount">
                                                    <button type="button" id="add-payment-btn"
                                                        class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                                                        Add Payment
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Additional Information -->
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                        <div>
                                            <label for="status"
                                                class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                                            <select id="status" name="status"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                                <option value="pending">Pending</option>
                                                <option value="confirmed">Confirmed</option>
                                                <option value="processing">Processing</option>
                                                <option value="completed">Completed</option>
                                                <option value="cancelled">Cancelled</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label for="receipt"
                                                class="block text-sm font-medium text-gray-700 mb-2">Receipt
                                                Number</label>
                                            <input type="text" id="receipt" name="receipt"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                                placeholder="Enter receipt number">
                                        </div>
                                    </div>

                                    <!-- Notes -->
                                    <div class="mb-6">
                                        <label for="notes"
                                            class="block text-sm font-medium text-gray-700 mb-2">Notes</label>
                                        <textarea id="notes" name="notes" rows="3"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                            placeholder="Add any notes about this order..."></textarea>
                                    </div>

                                    <!-- Form Actions -->
                                    <div class="flex items-center justify-end space-x-3 pt-6 border-t border-gray-200">
                                        <button type="button" id="cancel-form"
                                            class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                                            Cancel
                                        </button>
                                        <button type="button" id="complete-sale-btn"
                                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 hidden">
                                            <i class="fas fa-check mr-2"></i>Complete to Sale
                                        </button>
                                        <button type="submit"
                                            class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                                            Save Order
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
        class OrdersResource {
            constructor() {
                this.currentView = 'list';
                this.orders = [];
                this.products = [];
                this.currentPage = 1;
                this.totalPages = 1;
                this.searchTerm = '';
                this.isLoading = false;
                this.currentOrderId = null;
                this.amountPaid = 0;

                this.initializeEventListeners();
                this.loadOrders();
                this.loadProducts();
            }

            initializeEventListeners() {
                // Navigation
                document.getElementById('create-order-btn').addEventListener('click', () => this.showFormView());
                document.getElementById('create-first-order').addEventListener('click', () => this.showFormView());
                document.getElementById('back-to-list').addEventListener('click', () => this.showListView());
                document.getElementById('cancel-form').addEventListener('click', () => this.showListView());

                // Form
                document.getElementById('order-form').addEventListener('submit', (e) => this.handleFormSubmit(e));
                document.getElementById('add-item-btn').addEventListener('click', () => this.addOrderItem());
                document.getElementById('add-payment-btn').addEventListener('click', () => this.addPayment());
                document.getElementById('complete-sale-btn').addEventListener('click', () => this.completeToSale());

                // Search and Pagination
                document.getElementById('search-input').addEventListener('input',
                    this.debounce((e) => this.handleSearch(e), 300)
                );
                document.getElementById('prev-page').addEventListener('click', () => this.previousPage());
                document.getElementById('next-page').addEventListener('click', () => this.nextPage());

                // Export
                document.getElementById('export-btn').addEventListener('click', () => this.exportOrders());

                // Order items event delegation
                document.getElementById('order-items-container').addEventListener('input', (e) => this.updateTotals());
                document.getElementById('order-items-container').addEventListener('click', (e) => this.handleItemAction(
                    e));
            }

            debounce(func, wait) {
                let timeout;
                return function executedFunction(...args) {
                    const later = () => {
                        clearTimeout(timeout);
                        func(...args);
                    };
                    clearTimeout(timeout);
                    timeout = setTimeout(later, wait);
                };
            }

            async loadOrders(page = 1) {
                this.isLoading = true;
                this.showLoadingState();

                try {
                    // Simulate API call - replace with actual fetch("/api/orders")
                    const response = await this.mockApiCall(page);

                    this.orders = response.data;
                    this.currentPage = response.current_page;
                    this.totalPages = response.last_page;

                    this.renderOrdersList();
                    this.updateStats(response.stats);
                    this.updatePagination();

                } catch (error) {
                    console.error('Error loading orders:', error);
                    this.showErrorState();
                } finally {
                    this.isLoading = false;
                }
            }

            async loadProducts() {
                // Simulate loading products for the form
                this.products = [{
                        id: 1,
                        name: 'Livestock Vaccine',
                        price: 24.99
                    },
                    {
                        id: 2,
                        name: 'Organic Fertilizer',
                        price: 19.99
                    },
                    {
                        id: 3,
                        name: 'Premium Animal Feed',
                        price: 34.99
                    },
                    {
                        id: 4,
                        name: 'Farm Sprayer',
                        price: 89.99
                    },
                    {
                        id: 5,
                        name: 'Antibiotics',
                        price: 15.99
                    },
                    {
                        id: 6,
                        name: 'Herbicide',
                        price: 22.50
                    },
                    {
                        id: 7,
                        name: 'Vitamin Supplements',
                        price: 12.75
                    },
                    {
                        id: 8,
                        name: 'Water Pump',
                        price: 45.00
                    }
                ];
            }

            async mockApiCall(page) {
                // Simulate API delay
                await new Promise(resolve => setTimeout(resolve, 800));

                // Mock data that matches your schema
                const mockOrders = Array.from({
                    length: 10
                }, (_, index) => {
                    const id = (page - 1) * 10 + index + 1;
                    const customers = ['John Farmer', 'Green Valley Farm', 'Maria Sanchez', 'Robert Kimani',
                        'Regular'
                    ];
                    const customer = customers[Math.floor(Math.random() * customers.length)];
                    const total = (Math.random() * 500 + 50).toFixed(2);
                    const statuses = ['pending', 'confirmed', 'processing', 'completed', 'cancelled'];
                    const status = statuses[Math.floor(Math.random() * statuses.length)];
                    const amountPaid = status === 'completed' ? total : (Math.random() * parseFloat(total))
                        .toFixed(2);

                    return {
                        id: id,
                        customer: customer,
                        grand_total: total,
                        payment_method: ['cash', 'card', 'mobile', 'credit', 'partial'][Math.floor(Math
                        .random() * 5)],
                        status: status,
                        amount_paid: amountPaid,
                        receipt: `ORD-${1000 + id}`,
                        notes: Math.random() > 0.7 ? 'Customer will collect tomorrow' : null,
                        items_count: Math.floor(Math.random() * 4) + 1,
                        created_at: new Date(Date.now() - Math.random() * 10000000000).toISOString(),
                        updated_at: new Date(Date.now() - Math.random() * 5000000000).toISOString()
                    };
                });

                const stats = {
                    total_orders: 42,
                    pending_orders: 15,
                    completed_today: 3,
                    order_value: '8,456.78'
                };

                return {
                    data: mockOrders,
                    current_page: page,
                    last_page: 4,
                    per_page: 10,
                    total: 42,
                    stats: stats
                };
            }

            showLoadingState() {
                document.getElementById('loading-state').style.display = 'block';
                document.getElementById('orders-table').style.display = 'none';
                document.getElementById('empty-state').classList.add('hidden');
                document.getElementById('pagination-container').style.display = 'none';
            }

            showErrorState() {
                document.getElementById('loading-state').innerHTML = `
                    <div class="text-center text-red-600">
                        <i class="fas fa-exclamation-triangle text-2xl mb-2"></i>
                        <p>Failed to load orders</p>
                        <button class="mt-2 px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700" onclick="window.ordersResource.loadOrders()">
                            Retry
                        </button>
                    </div>
                `;
            }

            renderOrdersList() {
                const tbody = document.getElementById('orders-table-body');
                tbody.innerHTML = '';

                if (this.orders.length === 0) {
                    this.showEmptyState();
                    return;
                }

                this.orders.forEach(order => {
                    const row = this.createOrderRow(order);
                    tbody.appendChild(row);
                });

                document.getElementById('loading-state').style.display = 'none';
                document.getElementById('orders-table').style.display = 'table';
                document.getElementById('empty-state').classList.add('hidden');
            }

            createOrderRow(order) {
                const row = document.createElement('tr');
                row.className = 'table-row fade-in';

                const statusBadge = this.getStatusBadge(order.status);
                const paymentBadge = this.getPaymentBadge(order.payment_method);
                const progressPercentage = (order.amount_paid / order.grand_total) * 100;

                row.innerHTML = `
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#ORD-${order.id.toString().padStart(3, '0')}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${order.customer}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${new Date(order.created_at).toLocaleDateString()}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">$${order.grand_total}</td>
                    <td class="px-6 py-4 whitespace-nowrap">${paymentBadge}</td>
                    <td class="px-6 py-4 whitespace-nowrap">${statusBadge}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="progress-bar">
                            <div class="progress-fill ${progressPercentage === 100 ? 'bg-green-600' : 'bg-blue-600'}" style="width: ${progressPercentage}%"></div>
                        </div>
                        <div class="text-xs text-gray-500 mt-1">${Math.round(progressPercentage)}%</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <button class="text-green-600 hover:text-green-900 mr-3 edit-order" data-id="${order.id}">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="text-red-600 hover:text-red-900 delete-order" data-id="${order.id}">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                `;

                // Add event listeners
                row.querySelector('.edit-order').addEventListener('click', () => {
                    this.showFormView(order.id);
                });

                row.querySelector('.delete-order').addEventListener('click', () => {
                    this.deleteOrder(order.id);
                });

                return row;
            }

            getStatusBadge(status) {
                const badges = {
                    'pending': 'bg-yellow-100 text-yellow-800',
                    'confirmed': 'bg-blue-100 text-blue-800',
                    'processing': 'bg-purple-100 text-purple-800',
                    'completed': 'bg-green-100 text-green-800',
                    'cancelled': 'bg-red-100 text-red-800'
                };

                const statusText = {
                    'pending': 'Pending',
                    'confirmed': 'Confirmed',
                    'processing': 'Processing',
                    'completed': 'Completed',
                    'cancelled': 'Cancelled'
                };

                return `<span class="status-badge ${badges[status]}">${statusText[status]}</span>`;
            }

            getPaymentBadge(method) {
                const badges = {
                    'cash': 'bg-green-100 text-green-800',
                    'card': 'bg-blue-100 text-blue-800',
                    'mobile': 'bg-purple-100 text-purple-800',
                    'credit': 'bg-yellow-100 text-yellow-800',
                    'partial': 'bg-orange-100 text-orange-800'
                };

                const methodText = {
                    'cash': 'Cash',
                    'card': 'Card',
                    'mobile': 'Mobile',
                    'credit': 'Credit',
                    'partial': 'Partial'
                };

                return `<span class="payment-badge ${badges[method]}">${methodText[method]}</span>`;
            }

            showEmptyState() {
                document.getElementById('loading-state').style.display = 'none';
                document.getElementById('orders-table').style.display = 'none';
                document.getElementById('empty-state').classList.remove('hidden');
                document.getElementById('pagination-container').style.display = 'none';
            }

            updateStats(stats) {
                document.getElementById('total-orders').textContent = stats.total_orders;
                document.getElementById('pending-orders').textContent = stats.pending_orders;
                document.getElementById('completed-today').textContent = stats.completed_today;
                document.getElementById('order-value').textContent = `$${stats.order_value}`;
            }

            updatePagination() {
                const from = (this.currentPage - 1) * 10 + 1;
                const to = Math.min(this.currentPage * 10, 42);

                document.getElementById('pagination-from').textContent = from;
                document.getElementById('pagination-to').textContent = to;
                document.getElementById('pagination-total').textContent = 42;

                document.getElementById('prev-page').disabled = this.currentPage === 1;
                document.getElementById('next-page').disabled = this.currentPage === this.totalPages;

                document.getElementById('pagination-container').style.display = 'flex';
            }

            previousPage() {
                if (this.currentPage > 1) {
                    this.loadOrders(this.currentPage - 1);
                }
            }

            nextPage() {
                if (this.currentPage < this.totalPages) {
                    this.loadOrders(this.currentPage + 1);
                }
            }

            handleSearch(e) {
                this.searchTerm = e.target.value.toLowerCase();
                console.log('Searching for:', this.searchTerm);
                // In real implementation, this would trigger an API call with search term
            }

            showListView() {
                this.currentView = 'list';
                document.getElementById('list-view').classList.remove('hidden');
                document.getElementById('form-view').classList.add('hidden');
                document.getElementById('page-title').textContent = 'Orders';
                document.getElementById('page-description').textContent = 'Manage customer orders and pre-sales';
            }

            showFormView(orderId = null) {
                this.currentView = 'form';
                this.currentOrderId = orderId;

                document.getElementById('list-view').classList.add('hidden');
                document.getElementById('form-view').classList.remove('hidden');

                if (orderId) {
                    document.getElementById('form-title').textContent = 'Edit Customer Order';
                    this.loadOrderForEdit(orderId);
                    this.showPaymentProgress();
                    document.getElementById('complete-sale-btn').classList.remove('hidden');
                } else {
                    document.getElementById('form-title').textContent = 'New Customer Order';
                    this.resetForm();
                    document.getElementById('payment-progress-section').classList.add('hidden');
                    document.getElementById('complete-sale-btn').classList.add('hidden');
                }
            }

            resetForm() {
                document.getElementById('order-form').reset();
                document.getElementById('order-items-container').innerHTML = '';
                this.addOrderItem(); // Add one empty item
                this.updateTotals();
                this.amountPaid = 0;
            }

            addOrderItem(product = null) {
                const container = document.getElementById('order-items-container');
                const itemId = Date.now();

                const itemHtml = `
                    <tr class="order-item" data-item-id="${itemId}">
                        <td class="px-4 py-3">
                            <select name="items[${itemId}][product_id]" class="product-select w-full px-2 py-1 border border-gray-300 rounded text-sm focus:outline-none focus:ring-1 focus:ring-green-500">
                                <option value="">Select Product</option>
                                ${this.products.map(p => `<option value="${p.id}" ${product && product.product_id === p.id ? 'selected' : ''} data-price="${p.price}">${p.name} - $${p.price}</option>`).join('')}
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

                // Add event listeners for product selection
                const productSelect = container.querySelector(`[data-item-id="${itemId}"] .product-select`);
                productSelect.addEventListener('change', (e) => {
                    const selectedOption = e.target.options[e.target.selectedIndex];
                    const price = selectedOption.dataset.price;
                    if (price) {
                        const priceInput = container.querySelector(`[data-item-id="${itemId}"] .price-input`);
                        priceInput.value = price;
                        this.updateTotals();
                    }
                });

                this.updateTotals();
            }

            handleItemAction(e) {
                if (e.target.closest('.remove-item')) {
                    const itemRow = e.target.closest('.order-item');
                    if (document.querySelectorAll('.order-item').length > 1) {
                        itemRow.remove();
                        this.updateTotals();
                    } else {
                        alert('At least one item is required');
                    }
                }
            }

            updateTotals() {
                let subtotal = 0;

                document.querySelectorAll('.order-item').forEach(row => {
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

                // Update payment progress if in edit mode
                if (this.currentOrderId) {
                    this.updatePaymentProgress(grandTotal);
                }
            }

            async loadOrderForEdit(orderId) {
                // In real app, this would fetch from API
                const order = this.orders.find(o => o.id === orderId);
                if (order) {
                    document.getElementById('customer').value = order.customer;
                    document.getElementById('payment_method').value = order.payment_method;
                    document.getElementById('status').value = order.status;
                    document.getElementById('receipt').value = order.receipt || '';
                    document.getElementById('notes').value = order.notes || '';
                    this.amountPaid = parseFloat(order.amount_paid);

                    // Load order items would go here
                    // For now, we'll add a sample item
                    this.addOrderItem({
                        product_id: 1,
                        quantity: 2,
                        unit_amount: 24.99
                    });
                }
            }

            showPaymentProgress() {
                document.getElementById('payment-progress-section').classList.remove('hidden');
                this.updatePaymentProgress();
            }

            updatePaymentProgress(grandTotal = null) {
                if (!grandTotal) {
                    grandTotal = parseFloat(document.getElementById('grand-total-display').textContent.replace('$',
                        '')) || 0;
                }

                const progressPercentage = grandTotal > 0 ? (this.amountPaid / grandTotal) * 100 : 0;
                const remainingAmount = grandTotal - this.amountPaid;

                document.getElementById('amount-paid-display').textContent = `$${this.amountPaid.toFixed(2)}`;
                document.getElementById('progress-fill').style.width = `${progressPercentage}%`;
                document.getElementById('progress-text').textContent = `${Math.round(progressPercentage)}% Complete`;
                document.getElementById('remaining-amount').textContent = `$${remainingAmount.toFixed(2)} remaining`;

                // Update progress bar color
                const progressFill = document.getElementById('progress-fill');
                if (progressPercentage === 100) {
                    progressFill.className = 'progress-fill bg-green-600';
                } else if (progressPercentage >= 50) {
                    progressFill.className = 'progress-fill bg-blue-600';
                } else {
                    progressFill.className = 'progress-fill bg-yellow-600';
                }
            }

            addPayment() {
                const additionalPayment = parseFloat(document.getElementById('additional-payment').value) || 0;
                const grandTotal = parseFloat(document.getElementById('grand-total-display').textContent.replace('$',
                    '')) || 0;

                if (additionalPayment <= 0) {
                    alert('Please enter a valid payment amount');
                    return;
                }

                this.amountPaid += additionalPayment;

                // Don't allow overpayment
                if (this.amountPaid > grandTotal) {
                    this.amountPaid = grandTotal;
                    alert('Payment cannot exceed order total');
                }

                this.updatePaymentProgress(grandTotal);
                document.getElementById('additional-payment').value = '';

                // If fully paid, suggest completing to sale
                if (this.amountPaid >= grandTotal) {
                    document.getElementById('status').value = 'completed';
                    alert('Order fully paid! You can now complete this to a sale.');
                }
            }

            async completeToSale() {
                const grandTotal = parseFloat(document.getElementById('grand-total-display').textContent.replace('$',
                    '')) || 0;

                if (this.amountPaid < grandTotal) {
                    if (!confirm('Order is not fully paid. Are you sure you want to complete it to sale?')) {
                        return;
                    }
                }

                try {
                    // Simulate API call to convert order to sale
                    await new Promise(resolve => setTimeout(resolve, 1000));

                    const orderData = {
                        customer: document.getElementById('customer').value,
                        grand_total: grandTotal,
                        payment_method: document.getElementById('payment_method').value,
                        status: 'paid',
                        receipt: document.getElementById('receipt').value,
                        notes: document.getElementById('notes').value,
                        items: this.getOrderItemsData()
                    };

                    console.log('Converting order to sale:', orderData);
                    alert('Order successfully converted to sale!');
                    this.showListView();
                    this.loadOrders(); // Refresh the list

                } catch (error) {
                    console.error('Error converting order to sale:', error);
                    alert('Error converting order to sale. Please try again.');
                }
            }

            getOrderItemsData() {
                const items = [];
                document.querySelectorAll('.order-item').forEach(row => {
                    const productId = row.querySelector('.product-select').value;
                    const quantity = row.querySelector('.quantity-input').value;
                    const unitAmount = row.querySelector('.price-input').value;

                    if (productId && quantity && unitAmount) {
                        items.push({
                            product_id: productId,
                            quantity: parseInt(quantity),
                            unit_amount: parseFloat(unitAmount),
                            total_amount: parseFloat(quantity) * parseFloat(unitAmount)
                        });
                    }
                });
                return items;
            }

            async handleFormSubmit(e) {
                e.preventDefault();

                const formData = new FormData(e.target);
                const orderData = {
                    customer: formData.get('customer'),
                    payment_method: formData.get('payment_method'),
                    status: formData.get('status'),
                    receipt: formData.get('receipt'),
                    notes: formData.get('notes'),
                    amount_paid: this.amountPaid,
                    items: this.getOrderItemsData()
                };

                // Calculate grand total
                orderData.grand_total = orderData.items.reduce((sum, item) => sum + item.total_amount, 0) * 1.08;

                try {
                    if (this.currentOrderId) {
                        await this.updateOrder(this.currentOrderId, orderData);
                    } else {
                        await this.createOrder(orderData);
                    }
                } catch (error) {
                    console.error('Error saving order:', error);
                    alert('Error saving order. Please try again.');
                }
            }

            async createOrder(orderData) {
                // Simulate API call
                await new Promise(resolve => setTimeout(resolve, 1000));
                console.log('Creating order:', orderData);
                alert('Order created successfully!');
                this.showListView();
                this.loadOrders(); // Refresh the list
            }

            async updateOrder(orderId, orderData) {
                // Simulate API call
                await new Promise(resolve => setTimeout(resolve, 1000));
                console.log('Updating order:', orderId, orderData);
                alert('Order updated successfully!');
                this.showListView();
                this.loadOrders(); // Refresh the list
            }

            async deleteOrder(orderId) {
                if (!confirm('Are you sure you want to delete this order?')) {
                    return;
                }

                try {
                    // Simulate API call
                    await new Promise(resolve => setTimeout(resolve, 800));
                    console.log('Deleting order:', orderId);
                    alert('Order deleted successfully!');
                    this.loadOrders(); // Refresh the list
                } catch (error) {
                    console.error('Error deleting order:', error);
                    alert('Error deleting order. Please try again.');
                }
            }

            exportOrders() {
                console.log('Exporting orders data...');
                alert('Orders export started! You will receive the file shortly.');
            }
        }

        // Initialize the orders resource when page loads
        document.addEventListener('DOMContentLoaded', function() {
            window.ordersResource = new OrdersResource();
        });
    </script>
</body>

</html>
