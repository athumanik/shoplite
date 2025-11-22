<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wholesale - Shoplite Agrovet</title>
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
        .sidebar.collapsed {
            width: 64px;
        }
        .sidebar.collapsed .sidebar-text {
            display: none;
        }
        .main-content {
            transition: all 0.3s ease;
        }
        .stat-card {
            transition: transform 0.2s ease;
        }
        .stat-card:hover {
            transform: translateY(-2px);
        }
        .table-row:hover {
            background-color: #f9fafb;
        }
        .form-card {
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
        }
        .fade-in {
            animation: fadeIn 0.3s ease-in;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .skeleton {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
        }
        @keyframes loading {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }
        .search-dropdown {
            max-height: 300px;
            overflow-y: auto;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }
        .product-option:hover {
            background-color: #f3f4f6;
        }
        .mobile-search-modal {
            background: rgba(0, 0, 0, 0.5);
        }
        @media (max-width: 768px) {
            .stat-card {
                margin-bottom: 1rem;
            }
        }
    </style>
</head>
<body class="antialiased">
    <!-- Main Layout -->
    <div class="flex h-screen bg-gray-50">
        <!-- Sidebar -->
        <div class="sidebar w-64 bg-white border-r border-gray-200 flex flex-col relative">
            <!-- Toggle Button -->
            <button id="sidebar-toggle" class="absolute -right-3 top-6 bg-white border border-gray-300 rounded-full w-6 h-6 flex items-center justify-center shadow-sm hover:shadow-md z-10">
                <i class="fas fa-chevron-left text-gray-600 text-xs"></i>
            </button>

            <!-- Logo -->
            <div class="flex items-center justify-center h-16 border-b border-gray-200 px-4">
                <div class="flex items-center">
                    <svg class="h-8 w-8 text-green-600" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2L3 9V20C3 20.5304 3.21071 21.0391 3.58579 21.4142C3.96086 21.7893 4.46957 22 5 22H19C19.5304 22 20.0391 21.7893 20.4142 21.4142C20.7893 21.0391 21 20.5304 21 20V9L12 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M9 22V12H15V22" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M9 12H15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span class="ml-2 text-xl font-bold text-gray-800 sidebar-text">Shoplite</span>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 px-4 py-6 space-y-2">
                <a href="#" class="flex items-center px-3 py-2 text-gray-600 hover:bg-gray-100 rounded-lg">
                    <i class="fas fa-shopping-cart w-5 h-5 mr-3"></i>
                    <span class="sidebar-text">Retail Sales</span>
                </a>
                <a href="#" class="flex items-center px-3 py-2 text-gray-700 bg-green-50 rounded-lg border border-green-200">
                    <i class="fas fa-pallet w-5 h-5 mr-3 text-green-600"></i>
                    <span class="font-medium sidebar-text">Wholesale</span>
                </a>
                <a href="#" class="flex items-center px-3 py-2 text-gray-600 hover:bg-gray-100 rounded-lg">
                    <i class="fas fa-clipboard-list w-5 h-5 mr-3"></i>
                    <span class="sidebar-text">Orders</span>
                </a>
                <a href="#" class="flex items-center px-3 py-2 text-gray-600 hover:bg-gray-100 rounded-lg">
                    <i class="fas fa-cube w-5 h-5 mr-3"></i>
                    <span class="sidebar-text">Products</span>
                </a>
                <a href="#" class="flex items-center px-3 py-2 text-gray-600 hover:bg-gray-100 rounded-lg">
                    <i class="fas fa-chart-bar w-5 h-5 mr-3"></i>
                    <span class="sidebar-text">Reports</span>
                </a>
            </nav>

            <!-- User Profile -->
            <div class="border-t border-gray-200 p-4">
                <div class="flex items-center">
                    <div class="h-8 w-8 rounded-full bg-green-100 flex items-center justify-center">
                        <span class="text-green-600 font-medium text-sm">JD</span>
                    </div>
                    <div class="ml-3 sidebar-text">
                        <div class="text-sm font-medium text-gray-900">John Doe</div>
                        <div class="text-xs text-gray-500">Wholesale Manager</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content flex-1 flex flex-col overflow-hidden transition-all duration-300">
            <!-- Header -->
            <header class="bg-white border-b border-gray-200">
                <div class="flex items-center justify-between px-4 sm:px-6 py-4">
                    <div>
                        <h1 class="text-xl sm:text-2xl font-bold text-gray-900" id="page-title">Wholesale Sales</h1>
                        <p class="text-sm text-gray-600 mt-1" id="page-description">Bulk orders and wholesale transactions</p>
                    </div>
                    <div class="flex items-center space-x-2 sm:space-x-3">
                        <button class="px-3 sm:px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 flex items-center text-sm sm:text-base" id="filter-btn">
                            <i class="fas fa-filter mr-2"></i>
                            <span class="hidden sm:inline">Filter</span>
                        </button>
                        <button class="px-3 sm:px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 flex items-center text-sm sm:text-base" id="create-wholesale-btn">
                            <i class="fas fa-plus mr-2"></i>
                            <span class="hidden sm:inline">New Wholesale</span>
                        </button>
                    </div>
                </div>
            </header>

            <!-- Content Area -->
            <div class="flex-1 overflow-auto">
                <!-- Wholesale List View -->
                <div id="list-view" class="p-4 sm:p-6">
                    <!-- Stats Cards -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-6 sm:mb-8">
                        <div class="stat-card bg-white rounded-xl border border-gray-200 p-4 sm:p-6 fade-in">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-600">Wholesale Revenue</p>
                                    <p class="text-2xl sm:text-3xl font-bold text-gray-900 mt-2">$89,450</p>
                                    <div class="flex items-center mt-2">
                                        <span class="text-green-600 text-sm font-medium flex items-center">
                                            <i class="fas fa-arrow-up mr-1"></i>
                                            15.8%
                                        </span>
                                        <span class="text-gray-500 text-sm ml-2 hidden sm:inline">vs last month</span>
                                    </div>
                                </div>
                                <div class="h-12 w-12 sm:h-14 sm:w-14 bg-green-100 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-pallet text-green-600 text-lg sm:text-xl"></i>
                                </div>
                            </div>
                        </div>

                        <div class="stat-card bg-white rounded-xl border border-gray-200 p-4 sm:p-6 fade-in">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-600">Bulk Orders</p>
                                    <p class="text-2xl sm:text-3xl font-bold text-gray-900 mt-2">156</p>
                                    <div class="flex items-center mt-2">
                                        <span class="text-green-600 text-sm font-medium flex items-center">
                                            <i class="fas fa-arrow-up mr-1"></i>
                                            12.3%
                                        </span>
                                        <span class="text-gray-500 text-sm ml-2 hidden sm:inline">this month</span>
                                    </div>
                                </div>
                                <div class="h-12 w-12 sm:h-14 sm:w-14 bg-blue-100 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-boxes text-blue-600 text-lg sm:text-xl"></i>
                                </div>
                            </div>
                        </div>

                        <div class="stat-card bg-white rounded-xl border border-gray-200 p-4 sm:p-6 fade-in">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-600">Avg. Order Value</p>
                                    <p class="text-2xl sm:text-3xl font-bold text-gray-900 mt-2">$2,845</p>
                                    <div class="flex items-center mt-2">
                                        <span class="text-green-600 text-sm font-medium flex items-center">
                                            <i class="fas fa-arrow-up mr-1"></i>
                                            8.7%
                                        </span>
                                        <span class="text-gray-500 text-sm ml-2 hidden sm:inline">increase</span>
                                    </div>
                                </div>
                                <div class="h-12 w-12 sm:h-14 sm:w-14 bg-purple-100 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-dollar-sign text-purple-600 text-lg sm:text-xl"></i>
                                </div>
                            </div>
                        </div>

                        <div class="stat-card bg-white rounded-xl border border-gray-200 p-4 sm:p-6 fade-in">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-600">Top Wholesale Product</p>
                                    <p class="text-2xl sm:text-3xl font-bold text-gray-900 mt-2">Animal Feed</p>
                                    <div class="flex items-center mt-2">
                                        <span class="text-gray-500 text-sm">$34,120 revenue</span>
                                    </div>
                                </div>
                                <div class="h-12 w-12 sm:h-14 sm:w-14 bg-yellow-100 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-wheat-alt text-yellow-600 text-lg sm:text-xl"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Wholesale Table -->
                    <div class="bg-white rounded-lg border border-gray-200 overflow-hidden fade-in">
                        <!-- Table Header -->
                        <div class="px-4 sm:px-6 py-4 border-b border-gray-200 flex flex-col sm:flex-row sm:items-center justify-between space-y-3 sm:space-y-0">
                            <h3 class="text-lg font-medium text-gray-900">Recent Wholesale Orders</h3>
                            <div class="flex items-center space-x-3">
                                <div class="relative flex-1 sm:flex-none">
                                    <input type="text" id="search-input" placeholder="Search orders..."
                                        class="w-full sm:w-64 pl-9 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                    <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                </div>
                                <button class="p-2 border border-gray-300 rounded-lg hover:bg-gray-50 hidden sm:block">
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
                            <table class="w-full" id="wholesale-table" style="display: none;">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order ID</th>
                                        <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                                        <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden sm:table-cell">Date</th>
                                        <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                                        <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden md:table-cell">Items</th>
                                        <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200" id="wholesale-table-body">
                                    <!-- Wholesale data will be loaded here -->
                                </tbody>
                            </table>
                        </div>

                        <!-- Empty State -->
                        <div id="empty-state" class="hidden p-8 sm:p-12 text-center">
                            <i class="fas fa-pallet text-4xl text-gray-300 mb-4"></i>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">No wholesale orders found</h3>
                            <p class="text-gray-500 mb-4">Get started by creating your first wholesale order.</p>
                            <button class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700" id="create-first-wholesale">
                                Create Wholesale Order
                            </button>
                        </div>

                        <!-- Pagination -->
                        <div class="px-4 sm:px-6 py-4 border-t border-gray-200 flex flex-col sm:flex-row items-center justify-between space-y-3 sm:space-y-0" id="pagination-container" style="display: none;">
                            <div class="text-sm text-gray-700">
                                Showing <span class="font-medium" id="pagination-from">1</span> to
                                <span class="font-medium" id="pagination-to">10</span> of
                                <span class="font-medium" id="pagination-total">97</span> results
                            </div>
                            <div class="flex space-x-2">
                                <button class="px-3 py-1 border border-gray-300 rounded text-sm font-medium text-gray-700 hover:bg-gray-50" id="prev-page">Previous</button>
                                <button class="px-3 py-1 border border-gray-300 rounded text-sm font-medium text-gray-700 hover:bg-gray-50" id="next-page">Next</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Create/Edit Wholesale Form -->
                <div id="form-view" class="hidden p-4 sm:p-6">
                    <div class="max-w-6xl mx-auto">
                        <div class="form-card bg-white rounded-lg border border-gray-200 fade-in">
                            <!-- Form Header -->
                            <div class="px-4 sm:px-6 py-4 border-b border-gray-200">
                                <div class="flex items-center justify-between">
                                    <h3 class="text-lg font-medium text-gray-900" id="form-title">New Wholesale Order</h3>
                                    <button class="text-gray-400 hover:text-gray-600" id="back-to-list">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Form Content -->
                            <div class="p-4 sm:p-6">
                                <form id="wholesale-form">
                                    <!-- Customer Information -->
                                    <div class="mb-6">
                                        <h4 class="text-md font-medium text-gray-900 mb-4">Customer Information</h4>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                                            <div>
                                                <label for="customer" class="block text-sm font-medium text-gray-700 mb-2">Customer *</label>
                                                <input type="text" id="customer" name="customer" required
                                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                                    placeholder="Enter customer name" value="Wholesale Customer">
                                            </div>
                                            <div>
                                                <label for="payment_method" class="block text-sm font-medium text-gray-700 mb-2">Payment Method *</label>
                                                <select id="payment_method" name="payment_method" required
                                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                                    <option value="bank_transfer">Bank Transfer</option>
                                                    <option value="cash">Cash</option>
                                                    <option value="cheque">Cheque</option>
                                                    <option value="credit">Credit</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Product Search & Selection -->
                                    <div class="mb-6">
                                        <div class="flex items-center justify-between mb-4">
                                            <label class="block text-sm font-medium text-gray-700">Order Items</label>
                                            <div class="relative flex-1 max-w-md ml-4">
                                                <input type="text" id="product-search"
                                                    class="w-full pl-9 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                                    placeholder="Search products...">
                                                <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>

                                                <!-- Search Dropdown -->
                                                <div id="search-results" class="hidden absolute z-10 w-full mt-1 bg-white border border-gray-300 rounded-lg shadow-lg search-dropdown">
                                                    <!-- Search results will appear here -->
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Mobile Search Trigger -->
                                        <button type="button" id="mobile-search-trigger" class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg text-gray-600 hover:bg-gray-100 flex items-center justify-center sm:hidden mb-4">
                                            <i class="fas fa-search mr-2"></i>
                                            Tap to Search Products
                                        </button>

                                        <!-- Items Table -->
                                        <div class="border border-gray-200 rounded-lg overflow-hidden">
                                            <div class="overflow-x-auto">
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
                                                    <tbody id="wholesale-items-container" class="divide-y divide-gray-200">
                                                        <!-- Wholesale items will be added here -->
                                                    </tbody>
                                                    <tfoot class="bg-gray-50">
                                                        <tr>
                                                            <td colspan="3" class="px-4 py-3 text-right text-sm font-medium text-gray-700">Subtotal</td>
                                                            <td class="px-4 py-3 text-sm font-medium text-gray-900" id="subtotal-display">$0.00</td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="3" class="px-4 py-3 text-right text-sm font-medium text-gray-700">Tax (if applicable)</td>
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
                                    </div>

                                    <!-- Additional Information -->
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6 mb-6">
                                        <div>
                                            <label for="receipt" class="block text-sm font-medium text-gray-700 mb-2">Receipt Number</label>
                                            <input type="text" id="receipt" name="receipt"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                                placeholder="Enter receipt number">
                                        </div>
                                        <div>
                                            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                                            <select id="status" name="status"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                                <option value="paid">Paid</option>
                                                <option value="pending">Pending</option>
                                                <option value="cancelled">Cancelled</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Notes -->
                                    <div class="mb-6">
                                        <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">Notes</label>
                                        <textarea id="notes" name="notes" rows="3"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                            placeholder="Add any notes about this wholesale order..."></textarea>
                                    </div>

                                    <!-- Form Actions -->
                                    <div class="flex items-center justify-end space-x-3 pt-6 border-t border-gray-200">
                                        <button type="button" id="cancel-form" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                                            Cancel
                                        </button>
                                        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                                            Save Wholesale Order
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

    <!-- Mobile Search Modal -->
    <div id="mobile-search-modal" class="fixed inset-0 z-50 hidden mobile-search-modal">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg w-full max-w-md max-h-[80vh] overflow-hidden">
                <div class="p-4 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-medium text-gray-900">Search Products</h3>
                        <button type="button" id="close-mobile-search" class="text-gray-400 hover:text-gray-600">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <div class="mt-3 relative">
                        <input type="text" id="mobile-product-search"
                            class="w-full pl-9 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                            placeholder="Type to search products...">
                        <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    </div>
                </div>
                <div id="mobile-search-results" class="max-h-[60vh] overflow-y-auto p-2">
                    <!-- Mobile search results will appear here -->
                </div>
            </div>
        </div>
    </div>

    <script>
        class WholesaleResource {
    constructor() {
        this.currentView = 'list';
        this.wholesales = [];
        this.products = [];
        this.currentPage = 1;
        this.totalPages = 1;
        this.searchTerm = '';
        this.isLoading = false;
        this.isSidebarCollapsed = false;
        this.currentWholesaleId = null;

        // Wait for DOM to be ready before initializing
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', () => this.initialize());
        } else {
            this.initialize();
        }
    }

    initialize() {
        this.initializeEventListeners();
        this.loadWholesales();
        this.loadProducts();
    }

    initializeEventListeners() {
        // Safe event listener attachment with null checks
        this.safeAddEventListener('create-wholesale-btn', 'click', () => this.showFormView());
        this.safeAddEventListener('create-first-wholesale', 'click', () => this.showFormView());
        this.safeAddEventListener('back-to-list', 'click', () => this.showListView());
        this.safeAddEventListener('cancel-form', 'click', () => this.showListView());

        // Form submission
        const wholesaleForm = document.getElementById('wholesale-form');
        if (wholesaleForm) {
            wholesaleForm.addEventListener('submit', (e) => this.handleFormSubmit(e));
        }

        // Search functionality
        this.safeAddEventListener('product-search', 'input',
            this.debounce((e) => this.handleProductSearch(e), 300)
        );
        this.safeAddEventListener('mobile-product-search', 'input',
            this.debounce((e) => this.handleMobileProductSearch(e), 300)
        );
        this.safeAddEventListener('mobile-search-trigger', 'click', () => this.showMobileSearch());
        this.safeAddEventListener('close-mobile-search', 'click', () => this.hideMobileSearch());

        // Search and Pagination
        this.safeAddEventListener('search-input', 'input',
            this.debounce((e) => this.handleSearch(e), 300)
        );
        this.safeAddEventListener('prev-page', 'click', () => this.previousPage());
        this.safeAddEventListener('next-page', 'click', () => this.nextPage());

        // Export
        this.safeAddEventListener('export-btn', 'click', () => this.exportWholesales());

        // Sidebar toggle
        this.safeAddEventListener('sidebar-toggle', 'click', () => this.toggleSidebar());

        // Close search dropdown when clicking outside
        document.addEventListener('click', (e) => {
            if (!e.target.closest('#product-search') && !e.target.closest('#search-results')) {
                const searchResults = document.getElementById('search-results');
                if (searchResults) {
                    searchResults.classList.add('hidden');
                }
            }
        });
    }

    // Helper method to safely add event listeners
    safeAddEventListener(elementId, event, handler) {
        const element = document.getElementById(elementId);
        if (element) {
            element.addEventListener(event, handler);
        } else {
            console.warn(`Element with id '${elementId}' not found`);
        }
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

    // ... rest of your methods remain the same ...
    toggleSidebar() {
        const sidebar = document.querySelector('.sidebar');
        const toggleIcon = document.querySelector('#sidebar-toggle i');

        if (!sidebar || !toggleIcon) return;

        this.isSidebarCollapsed = !this.isSidebarCollapsed;

        sidebar.classList.toggle('collapsed');

        if (this.isSidebarCollapsed) {
            toggleIcon.className = 'fas fa-chevron-right text-gray-600 text-xs';
        } else {
            toggleIcon.className = 'fas fa-chevron-left text-gray-600 text-xs';
        }
    }

    async loadWholesales(page = 1) {
        this.isLoading = true;
        this.showLoadingState();

        try {
            const response = await this.mockApiCall(page);

            this.wholesales = response.data;
            this.currentPage = response.current_page;
            this.totalPages = response.last_page;

            this.renderWholesalesList();
            this.updatePagination();

        } catch (error) {
            console.error('Error loading wholesales:', error);
            this.showErrorState();
        } finally {
            this.isLoading = false;
        }
    }

    async loadProducts() {
        // Simulate loading products - in real app, this would be an API call
        this.products = [
            { id: 1, name: 'Livestock Vaccine', wholesale_price: 22.50, stock: 450, category: 'Animal Health' },
            { id: 2, name: 'Organic Fertilizer', wholesale_price: 18.00, stock: 320, category: 'Crop Protection' },
            { id: 3, name: 'Premium Animal Feed', wholesale_price: 28.50, stock: 670, category: 'Feeds & Supplements' },
            { id: 4, name: 'Farm Sprayer', wholesale_price: 75.00, stock: 120, category: 'Farming Equipment' },
            { id: 5, name: 'Antibiotics', wholesale_price: 14.50, stock: 280, category: 'Animal Health' },
            { id: 6, name: 'Herbicide', wholesale_price: 20.00, stock: 410, category: 'Crop Protection' },
            { id: 7, name: 'Vitamin Supplements', wholesale_price: 10.50, stock: 890, category: 'Feeds & Supplements' },
            { id: 8, name: 'Water Pump', wholesale_price: 38.00, stock: 80, category: 'Farming Equipment' },
            { id: 9, name: 'Poultry Feed', wholesale_price: 25.00, stock: 560, category: 'Feeds & Supplements' },
            { id: 10, name: 'Crop Seeds', wholesale_price: 15.00, stock: 340, category: 'Crop Protection' }
        ];
    }

    async mockApiCall(page) {
        await new Promise(resolve => setTimeout(resolve, 800));

        const mockWholesales = Array.from({ length: 10 }, (_, index) => {
            const id = (page - 1) * 10 + index + 1;
            const customers = ['Agro Distributors', 'Farm Supply Co.', 'Bulk Buyers Ltd', 'Regional Wholesaler', 'Agricultural Co-op'];
            const customer = customers[Math.floor(Math.random() * customers.length)];
            const total = (Math.random() * 10000 + 1000).toFixed(2);

            return {
                id: id,
                customer: customer,
                grand_total: total,
                payment_method: ['bank_transfer', 'cash', 'cheque', 'credit'][Math.floor(Math.random() * 4)],
                status: 'paid',
                receipt: `WHO-${1000 + id}`,
                items_count: Math.floor(Math.random() * 8) + 3,
                created_at: new Date(Date.now() - Math.random() * 10000000000).toISOString(),
                updated_at: new Date(Date.now() - Math.random() * 5000000000).toISOString()
            };
        });

        return {
            data: mockWholesales,
            current_page: page,
            last_page: 5,
            per_page: 10,
            total: 42
        };
    }

    showLoadingState() {
        const loadingState = document.getElementById('loading-state');
        const wholesaleTable = document.getElementById('wholesale-table');
        const emptyState = document.getElementById('empty-state');
        const paginationContainer = document.getElementById('pagination-container');

        if (loadingState) loadingState.style.display = 'block';
        if (wholesaleTable) wholesaleTable.style.display = 'none';
        if (emptyState) emptyState.classList.add('hidden');
        if (paginationContainer) paginationContainer.style.display = 'none';
    }

    showErrorState() {
        const loadingState = document.getElementById('loading-state');
        if (loadingState) {
            loadingState.innerHTML = `
                <div class="text-center text-red-600">
                    <i class="fas fa-exclamation-triangle text-2xl mb-2"></i>
                    <p>Failed to load wholesale orders</p>
                    <button class="mt-2 px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700" onclick="window.wholesaleResource.loadWholesales()">
                        Retry
                    </button>
                </div>
            `;
        }
    }

    renderWholesalesList() {
        const tbody = document.getElementById('wholesale-table-body');
        if (!tbody) return;

        tbody.innerHTML = '';

        if (this.wholesales.length === 0) {
            this.showEmptyState();
            return;
        }

        this.wholesales.forEach(wholesale => {
            const row = this.createWholesaleRow(wholesale);
            tbody.appendChild(row);
        });

        const loadingState = document.getElementById('loading-state');
        const wholesaleTable = document.getElementById('wholesale-table');
        const emptyState = document.getElementById('empty-state');

        if (loadingState) loadingState.style.display = 'none';
        if (wholesaleTable) wholesaleTable.style.display = 'table';
        if (emptyState) emptyState.classList.add('hidden');
    }

    createWholesaleRow(wholesale) {
        const row = document.createElement('tr');
        row.className = 'table-row fade-in';

        row.innerHTML = `
            <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#WHO-${wholesale.id.toString().padStart(3, '0')}</td>
            <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm text-gray-900">${wholesale.customer}</td>
            <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm text-gray-500 hidden sm:table-cell">${new Date(wholesale.created_at).toLocaleDateString()}</td>
            <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm font-bold text-green-600">$${parseFloat(wholesale.grand_total).toLocaleString()}</td>
            <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm text-gray-500 hidden md:table-cell">${wholesale.items_count} items</td>
            <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm font-medium">
                <button class="text-green-600 hover:text-green-900 mr-3 edit-wholesale" data-id="${wholesale.id}">
                    <i class="fas fa-edit"></i>
                </button>
                <button class="text-red-600 hover:text-red-900 delete-wholesale" data-id="${wholesale.id}">
                    <i class="fas fa-trash"></i>
                </button>
            </td>
        `;

        // Add event listeners to the buttons in this row
        const editBtn = row.querySelector('.edit-wholesale');
        const deleteBtn = row.querySelector('.delete-wholesale');

        if (editBtn) {
            editBtn.addEventListener('click', () => {
                this.showFormView(wholesale.id);
            });
        }

        if (deleteBtn) {
            deleteBtn.addEventListener('click', () => {
                this.deleteWholesale(wholesale.id);
            });
        }

        return row;
    }

    showEmptyState() {
        const loadingState = document.getElementById('loading-state');
        const wholesaleTable = document.getElementById('wholesale-table');
        const emptyState = document.getElementById('empty-state');
        const paginationContainer = document.getElementById('pagination-container');

        if (loadingState) loadingState.style.display = 'none';
        if (wholesaleTable) wholesaleTable.style.display = 'none';
        if (emptyState) emptyState.classList.remove('hidden');
        if (paginationContainer) paginationContainer.style.display = 'none';
    }

    updatePagination() {
        const from = (this.currentPage - 1) * 10 + 1;
        const to = Math.min(this.currentPage * 10, 42);

        const paginationFrom = document.getElementById('pagination-from');
        const paginationTo = document.getElementById('pagination-to');
        const paginationTotal = document.getElementById('pagination-total');
        const paginationContainer = document.getElementById('pagination-container');

        if (paginationFrom) paginationFrom.textContent = from;
        if (paginationTo) paginationTo.textContent = to;
        if (paginationTotal) paginationTotal.textContent = 42;

        if (paginationContainer) paginationContainer.style.display = 'flex';
    }

    previousPage() {
        if (this.currentPage > 1) {
            this.loadWholesales(this.currentPage - 1);
        }
    }

    nextPage() {
        if (this.currentPage < this.totalPages) {
            this.loadWholesales(this.currentPage + 1);
        }
    }

    handleSearch(e) {
        this.searchTerm = e.target.value.toLowerCase();
        console.log('Searching for:', this.searchTerm);
    }

    handleProductSearch(e) {
        const query = e.target.value.toLowerCase();
        const resultsContainer = document.getElementById('search-results');
        if (!resultsContainer) return;

        if (query.length < 2) {
            resultsContainer.classList.add('hidden');
            return;
        }

        const filteredProducts = this.products.filter(product =>
            product.name.toLowerCase().includes(query) ||
            product.category.toLowerCase().includes(query)
        );

        this.renderSearchResults(filteredProducts, resultsContainer);
        resultsContainer.classList.remove('hidden');
    }

    handleMobileProductSearch(e) {
        const query = e.target.value.toLowerCase();
        const resultsContainer = document.getElementById('mobile-search-results');
        if (!resultsContainer) return;

        const filteredProducts = this.products.filter(product =>
            product.name.toLowerCase().includes(query) ||
            product.category.toLowerCase().includes(query)
        );

        this.renderMobileSearchResults(filteredProducts, resultsContainer);
    }

    renderSearchResults(products, container) {
        if (products.length === 0) {
            container.innerHTML = `
                <div class="p-4 text-center text-gray-500">
                    <i class="fas fa-search mb-2"></i>
                    <p>No products found</p>
                </div>
            `;
            return;
        }

        container.innerHTML = products.map(product => `
            <div class="product-option p-3 border-b border-gray-100 cursor-pointer hover:bg-gray-50"
                 data-product-id="${product.id}"
                 data-product-name="${product.name}"
                 data-wholesale-price="${product.wholesale_price}">
                <div class="flex justify-between items-center">
                    <div>
                        <div class="font-medium text-gray-900">${product.name}</div>
                        <div class="text-sm text-gray-500">${product.category} • ${product.stock} in stock</div>
                    </div>
                    <div class="text-right">
                        <div class="font-bold text-green-600">$${product.wholesale_price}</div>
                        <div class="text-xs text-gray-500">wholesale</div>
                    </div>
                </div>
            </div>
        `).join('');

        // Add click event listeners
        container.querySelectorAll('.product-option').forEach(option => {
            option.addEventListener('click', () => {
                this.addProductToOrder(
                    option.dataset.productId,
                    option.dataset.productName,
                    parseFloat(option.dataset.wholesalePrice)
                );
                const searchResults = document.getElementById('search-results');
                if (searchResults) searchResults.classList.add('hidden');
                const productSearch = document.getElementById('product-search');
                if (productSearch) productSearch.value = '';
            });
        });
    }

    renderMobileSearchResults(products, container) {
        if (products.length === 0) {
            container.innerHTML = `
                <div class="p-4 text-center text-gray-500">
                    <i class="fas fa-search mb-2"></i>
                    <p>No products found</p>
                </div>
            `;
            return;
        }

        container.innerHTML = products.map(product => `
            <div class="product-option p-4 border-b border-gray-100 cursor-pointer hover:bg-gray-50"
                 data-product-id="${product.id}"
                 data-product-name="${product.name}"
                 data-wholesale-price="${product.wholesale_price}">
                <div class="flex justify-between items-center">
                    <div class="flex-1">
                        <div class="font-medium text-gray-900">${product.name}</div>
                        <div class="text-sm text-gray-500">${product.category} • ${product.stock} in stock</div>
                    </div>
                    <div class="text-right ml-4">
                        <div class="font-bold text-green-600">$${product.wholesale_price}</div>
                        <div class="text-xs text-gray-500">wholesale</div>
                    </div>
                </div>
            </div>
        `).join('');

        // Add click event listeners
        container.querySelectorAll('.product-option').forEach(option => {
            option.addEventListener('click', () => {
                this.addProductToOrder(
                    option.dataset.productId,
                    option.dataset.productName,
                    parseFloat(option.dataset.wholesalePrice)
                );
                this.hideMobileSearch();
            });
        });
    }

    showMobileSearch() {
        const modal = document.getElementById('mobile-search-modal');
        if (modal) modal.classList.remove('hidden');
        const searchInput = document.getElementById('mobile-product-search');
        if (searchInput) searchInput.focus();
    }

    hideMobileSearch() {
        const modal = document.getElementById('mobile-search-modal');
        if (modal) modal.classList.add('hidden');
        const searchInput = document.getElementById('mobile-product-search');
        if (searchInput) searchInput.value = '';
        const searchResults = document.getElementById('mobile-search-results');
        if (searchResults) searchResults.innerHTML = '';
    }

    addProductToOrder(productId, productName, wholesalePrice) {
        const container = document.getElementById('wholesale-items-container');
        if (!container) return;

        const itemId = Date.now();

        const itemHtml = `
            <tr class="wholesale-item" data-item-id="${itemId}">
                <td class="px-4 py-3">
                    <input type="hidden" name="items[${itemId}][product_id]" value="${productId}">
                    <div class="text-sm font-medium text-gray-900">${productName}</div>
                    <div class="text-xs text-gray-500">Wholesale item</div>
                </td>
                <td class="px-4 py-3">
                    <input type="number" name="items[${itemId}][quantity]" value="1" min="1"
                        class="quantity-input w-20 px-2 py-1 border border-gray-300 rounded text-sm focus:outline-none focus:ring-1 focus:ring-green-500">
                </td>
                <td class="px-4 py-3">
                    <input type="number" name="items[${itemId}][unit_amount]" value="${wholesalePrice}" step="0.01"
                        class="price-input w-24 px-2 py-1 border border-gray-300 rounded text-sm focus:outline-none focus:ring-1 focus:ring-green-500">
                </td>
                <td class="px-4 py-3">
                    <span class="item-total text-sm font-medium">$${wholesalePrice.toFixed(2)}</span>
                </td>
                <td class="px-4 py-3">
                    <button type="button" class="remove-item text-red-600 hover:text-red-800">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            </tr>
        `;

        container.insertAdjacentHTML('beforeend', itemHtml);

        // Add event listeners for the new item
        const newItem = container.querySelector(`[data-item-id="${itemId}"]`);
        if (newItem) {
            const quantityInput = newItem.querySelector('.quantity-input');
            const priceInput = newItem.querySelector('.price-input');
            const removeBtn = newItem.querySelector('.remove-item');

            if (quantityInput) quantityInput.addEventListener('input', () => this.updateTotals());
            if (priceInput) priceInput.addEventListener('input', () => this.updateTotals());
            if (removeBtn) {
                removeBtn.addEventListener('click', () => {
                    newItem.remove();
                    this.updateTotals();
                });
            }
        }

        this.updateTotals();
    }

    updateTotals() {
        let subtotal = 0;

        document.querySelectorAll('.wholesale-item').forEach(row => {
            const quantityInput = row.querySelector('.quantity-input');
            const priceInput = row.querySelector('.price-input');
            const itemTotal = row.querySelector('.item-total');

            if (quantityInput && priceInput && itemTotal) {
                const quantity = parseFloat(quantityInput.value) || 0;
                const price = parseFloat(priceInput.value) || 0;
                const total = quantity * price;

                itemTotal.textContent = `$${total.toFixed(2)}`;
                subtotal += total;
            }
        });

        // For wholesale, tax might be handled differently
        const tax = 0; // You can add tax calculation if needed
        const grandTotal = subtotal + tax;

        const subtotalDisplay = document.getElementById('subtotal-display');
        const taxDisplay = document.getElementById('tax-display');
        const grandTotalDisplay = document.getElementById('grand-total-display');

        if (subtotalDisplay) subtotalDisplay.textContent = `$${subtotal.toFixed(2)}`;
        if (taxDisplay) taxDisplay.textContent = `$${tax.toFixed(2)}`;
        if (grandTotalDisplay) grandTotalDisplay.textContent = `$${grandTotal.toFixed(2)}`;
    }

    showListView() {
        const listView = document.getElementById('list-view');
        const formView = document.getElementById('form-view');
        const pageTitle = document.getElementById('page-title');
        const pageDescription = document.getElementById('page-description');

        if (listView) listView.classList.remove('hidden');
        if (formView) formView.classList.add('hidden');
        if (pageTitle) pageTitle.textContent = 'Wholesale Sales';
        if (pageDescription) pageDescription.textContent = 'Bulk orders and wholesale transactions';

        this.currentView = 'list';
    }

    showFormView(wholesaleId = null) {
        const listView = document.getElementById('list-view');
        const formView = document.getElementById('form-view');
        const formTitle = document.getElementById('form-title');

        if (listView) listView.classList.add('hidden');
        if (formView) formView.classList.remove('hidden');

        this.currentView = 'form';
        this.currentWholesaleId = wholesaleId;

        if (wholesaleId) {
            if (formTitle) formTitle.textContent = 'Edit Wholesale Order';
            this.loadWholesaleForEdit(wholesaleId);
        } else {
            if (formTitle) formTitle.textContent = 'New Wholesale Order';
            this.resetForm();
        }
    }

    resetForm() {
        const wholesaleForm = document.getElementById('wholesale-form');
        const itemsContainer = document.getElementById('wholesale-items-container');
        const customerInput = document.getElementById('customer');

        if (wholesaleForm) wholesaleForm.reset();
        if (itemsContainer) itemsContainer.innerHTML = '';
        if (customerInput) customerInput.value = 'Wholesale Customer';
        this.updateTotals();
    }

    async loadWholesaleForEdit(wholesaleId) {
        // In real app, this would fetch from API
        const wholesale = this.wholesales.find(w => w.id === wholesaleId);
        if (wholesale) {
            const customerInput = document.getElementById('customer');
            const paymentMethodSelect = document.getElementById('payment_method');
            const receiptInput = document.getElementById('receipt');
            const statusSelect = document.getElementById('status');
            const notesTextarea = document.getElementById('notes');

            if (customerInput) customerInput.value = wholesale.customer;
            if (paymentMethodSelect) paymentMethodSelect.value = wholesale.payment_method;
            if (receiptInput) receiptInput.value = wholesale.receipt || '';
            if (statusSelect) statusSelect.value = wholesale.status;
            if (notesTextarea) notesTextarea.value = wholesale.notes || '';

            // Load wholesale items would go here
            // For demo, add a sample item
            this.addProductToOrder(1, 'Livestock Vaccine', 22.50);
        }
    }

    async handleFormSubmit(e) {
        e.preventDefault();

        const formData = new FormData(e.target);
        const wholesaleData = {
            customer: formData.get('customer'),
            payment_method: formData.get('payment_method'),
            receipt: formData.get('receipt'),
            status: formData.get('status'),
            notes: formData.get('notes'),
            customer_type: 'wholesale', // For future reporting
            items: this.getWholesaleItemsData()
        };

        // Calculate grand total
        wholesaleData.grand_total = wholesaleData.items.reduce((sum, item) => sum + item.total_amount, 0);

        try {
            if (this.currentWholesaleId) {
                await this.updateWholesale(this.currentWholesaleId, wholesaleData);
            } else {
                await this.createWholesale(wholesaleData);
            }
        } catch (error) {
            console.error('Error saving wholesale order:', error);
            alert('Error saving wholesale order. Please try again.');
        }
    }

    getWholesaleItemsData() {
        const items = [];
        document.querySelectorAll('.wholesale-item').forEach(row => {
            const productIdInput = row.querySelector('input[name*="[product_id]"]');
            const quantityInput = row.querySelector('.quantity-input');
            const priceInput = row.querySelector('.price-input');

            if (productIdInput && quantityInput && priceInput) {
                const productId = productIdInput.value;
                const quantity = quantityInput.value;
                const unitAmount = priceInput.value;

                if (productId && quantity && unitAmount) {
                    items.push({
                        product_id: productId,
                        quantity: parseInt(quantity),
                        unit_amount: parseFloat(unitAmount),
                        total_amount: parseFloat(quantity) * parseFloat(unitAmount)
                    });
                }
            }
        });
        return items;
    }

    async createWholesale(wholesaleData) {
        // Simulate API call
        await new Promise(resolve => setTimeout(resolve, 1000));
        console.log('Creating wholesale order:', wholesaleData);
        alert('Wholesale order created successfully!');
        this.showListView();
        this.loadWholesales(); // Refresh the list
    }

    async updateWholesale(wholesaleId, wholesaleData) {
        // Simulate API call
        await new Promise(resolve => setTimeout(resolve, 1000));
        console.log('Updating wholesale order:', wholesaleId, wholesaleData);
        alert('Wholesale order updated successfully!');
        this.showListView();
        this.loadWholesales(); // Refresh the list
    }

    async deleteWholesale(wholesaleId) {
        if (!confirm('Are you sure you want to delete this wholesale order?')) {
            return;
        }

        try {
            // Simulate API call
            await new Promise(resolve => setTimeout(resolve, 800));
            console.log('Deleting wholesale order:', wholesaleId);
            alert('Wholesale order deleted successfully!');
            this.loadWholesales(); // Refresh the list
        } catch (error) {
            console.error('Error deleting wholesale order:', error);
            alert('Error deleting wholesale order. Please try again.');
        }
    }

    exportWholesales() {
        console.log('Exporting wholesale data...');
        alert('Wholesale export started! You will receive the file shortly.');
    }
}

// Initialize the wholesale resource when page loads
document.addEventListener('DOMContentLoaded', function() {
    window.wholesaleResource = new WholesaleResource();

    // Add fade-in animation to all stat cards
    const cards = document.querySelectorAll('.fade-in');
    cards.forEach((card, index) => {
        card.style.animationDelay = `${index * 0.1}s`;
    });
});
    </script>
</body>
</html>
