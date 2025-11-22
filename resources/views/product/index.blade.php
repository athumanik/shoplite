<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products - Shoplite Agrovet</title>
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
                <a href="{{ route('sales.index') }}" class="flex items-center px-3 py-2 text-gray-600 hover:bg-gray-100 rounded-lg">
                    <i class="fas fa-shopping-cart w-5 h-5 mr-3"></i>
                    <span>Sales</span>
                </a>
              <a href="{{ route('wholesale') }}" class="flex items-center px-3 py-2 text-gray-600 hover:bg-gray-100 rounded-lg">
        <i class="fas fa-credit-card w-5 h-5 mr-3"></i>
        <span class="sidebar-text">WholeSales</span>
    </a>
                <a href="{{ route('products') }}"
                    class="flex items-center px-3 py-2 text-gray-700 bg-green-50 rounded-lg border border-green-200">
                    <i class="fas fa-cube w-5 h-5 mr-3 text-green-600"></i>
                    <span class="font-medium">Products</span>
                </a>

                <a href="{{ route("inventory.index") }}" class="flex items-center px-3 py-2 text-gray-600 hover:bg-gray-100 rounded-lg">
                    <i class="fas fa-boxes w-5 h-5 mr-3"></i>
                    <span>Inventory</span>
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
                        <h1 class="text-2xl font-bold text-gray-900" id="page-title">Products</h1>
                        <p class="text-sm text-gray-600 mt-1" id="page-description">Manage your product catalog</p>
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
                            id="create-product-btn">
                            <i class="fas fa-plus mr-2"></i>
                            New Product
                        </button>
                    </div>
                </div>
            </header>

            <!-- Content Area -->
            <div class="flex-1 overflow-auto">
                <!-- Products List View -->
                <div id="list-view" class="p-6">
                    <!-- Stats Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                        <div class="bg-white rounded-lg border border-gray-200 p-6 fade-in">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-600">Total Products</p>
                                    <p class="text-2xl font-bold text-gray-900 mt-1" id="total-products">--</p>
                                </div>
                                <div class="h-12 w-12 bg-green-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-cube text-green-600 text-xl"></i>
                                </div>
                            </div>
                            <p class="text-xs text-gray-600 mt-2">Across all categories</p>
                        </div>

                        <div class="bg-white rounded-lg border border-gray-200 p-6 fade-in">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-600">Active Products</p>
                                    <p class="text-2xl font-bold text-gray-900 mt-1" id="active-products">--</p>
                                </div>
                                <div class="h-12 w-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-check-circle text-blue-600 text-xl"></i>
                                </div>
                            </div>
                            <p class="text-xs text-green-600 mt-2" id="active-percentage">--% of total</p>
                        </div>

                        <div class="bg-white rounded-lg border border-gray-200 p-6 fade-in">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-600">Avg. Price</p>
                                    <p class="text-2xl font-bold text-gray-900 mt-1" id="avg-price">--</p>
                                </div>
                                <div class="h-12 w-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-tag text-yellow-600 text-xl"></i>
                                </div>
                            </div>
                            <p class="text-xs text-gray-600 mt-2">Average product price</p>
                        </div>

                        <div class="bg-white rounded-lg border border-gray-200 p-6 fade-in">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-600">Stock Value</p>
                                    <p class="text-2xl font-bold text-gray-900 mt-1" id="stock-value">--</p>
                                </div>
                                <div class="h-12 w-12 bg-purple-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-dollar-sign text-purple-600 text-xl"></i>
                                </div>
                            </div>
                            <p class="text-xs text-gray-600 mt-2">Total inventory value</p>
                        </div>
                    </div>

                    <!-- Products Table -->
                    <div class="bg-white rounded-lg border border-gray-200 overflow-hidden fade-in">
                        <!-- Table Header -->
                        <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                            <h3 class="text-lg font-medium text-gray-900">Product Catalog</h3>
                            <div class="flex items-center space-x-3">
                                <div class="relative">
                                    <input type="text" id="search-input" placeholder="Search products..."
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
                            <table class="w-full" id="products-table" style="display: none;">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Product</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Price</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Wholesale</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Buying Price</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Status</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Last Updated</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200" id="products-table-body">
                                    <!-- Products data will be loaded here -->
                                </tbody>
                            </table>
                        </div>

                        <!-- Empty State -->
                        <div id="empty-state" class="hidden p-12 text-center">
                            <i class="fas fa-cube text-4xl text-gray-300 mb-4"></i>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">No products found</h3>
                            <p class="text-gray-500 mb-4">Get started by creating your first product.</p>
                            <button class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700"
                                id="create-first-product">
                                Create Product
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

                <!-- Create/Edit Product Form -->
                <div id="form-view" class="hidden p-6">
                    <div class="max-w-4xl mx-auto">
                        <div class="form-card bg-white rounded-lg border border-gray-200 fade-in">
                            <!-- Form Header -->
                            <div class="px-6 py-4 border-b border-gray-200">
                                <div class="flex items-center justify-between">
                                    <h3 class="text-lg font-medium text-gray-900" id="form-title">Create New Product
                                    </h3>
                                    <button class="text-gray-400 hover:text-gray-600" id="back-to-list">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Form Content -->
                            <div class="p-6">
                                <form id="product-form">
                                    <!-- Basic Information -->
                                    <div class="mb-6">
                                        <h4 class="text-md font-medium text-gray-900 mb-4">Basic Information</h4>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                            <div>
                                                <label for="name"
                                                    class="block text-sm font-medium text-gray-700 mb-2">Product Name
                                                    *</label>
                                                <input type="text" id="name" name="name" required
                                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                                    placeholder="Enter product name">
                                            </div>
                                            <div>
                                                <label for="slug"
                                                    class="block text-sm font-medium text-gray-700 mb-2">Slug *</label>
                                                <input type="text" id="slug" name="slug" required
                                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                                    placeholder="product-slug">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Pricing -->
                                    <div class="mb-6">
                                        <h4 class="text-md font-medium text-gray-900 mb-4">Pricing</h4>
                                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                            <div>
                                                <label for="price"
                                                    class="block text-sm font-medium text-gray-700 mb-2">Selling Price
                                                    *</label>
                                                <div class="relative">
                                                    <div
                                                        class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                        <span class="text-gray-500">$</span>
                                                    </div>
                                                    <input type="number" id="price" name="price" required
                                                        step="0.01" min="0"
                                                        class="w-full pl-7 pr-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                                        placeholder="0.00">
                                                </div>
                                            </div>
                                            <div>
                                                <label for="wholesale_price"
                                                    class="block text-sm font-medium text-gray-700 mb-2">Wholesale
                                                    Price *</label>
                                                <div class="relative">
                                                    <div
                                                        class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                        <span class="text-gray-500">$</span>
                                                    </div>
                                                    <input type="number" id="wholesale_price" name="wholesale_price"
                                                        required step="0.01" min="0"
                                                        class="w-full pl-7 pr-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                                        placeholder="0.00">
                                                </div>
                                            </div>
                                            <div>
                                                <label for="buying_price"
                                                    class="block text-sm font-medium text-gray-700 mb-2">Buying
                                                    Price</label>
                                                <div class="relative">
                                                    <div
                                                        class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                        <span class="text-gray-500">$</span>
                                                    </div>
                                                    <input type="number" id="buying_price" name="buying_price"
                                                        step="0.01" min="0"
                                                        class="w-full pl-7 pr-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                                        placeholder="0.00">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Status -->
                                    <div class="mb-6">
                                        <h4 class="text-md font-medium text-gray-900 mb-4">Status</h4>
                                        <div class="flex items-center">
                                            <input type="checkbox" id="is_active" name="is_active" checked
                                                class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded">
                                            <label for="is_active" class="ml-2 block text-sm text-gray-900">
                                                Product is active and available for sale
                                            </label>
                                        </div>
                                    </div>

                                    <!-- Form Actions -->
                                    <div class="flex items-center justify-end space-x-3 pt-6 border-t border-gray-200">
                                        <button type="button" id="cancel-form"
                                            class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                                            Cancel
                                        </button>
                                        <button type="submit"
                                            class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                                            Save Product
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
        class ProductsResource {
            constructor() {
                this.currentView = 'list';
                this.products = [];
                this.currentPage = 1;
                this.totalPages = 1;
                this.searchTerm = '';
                this.isLoading = false;

                this.initializeEventListeners();
                this.loadProducts();
            }

            initializeEventListeners() {
                // Navigation
                document.getElementById('create-product-btn').addEventListener('click', () => this.showFormView());
                document.getElementById('create-first-product').addEventListener('click', () => this.showFormView());
                document.getElementById('back-to-list').addEventListener('click', () => this.showListView());
                document.getElementById('cancel-form').addEventListener('click', () => this.showListView());

                // Form
                document.getElementById('product-form').addEventListener('submit', (e) => this.handleFormSubmit(e));
                document.getElementById('name').addEventListener('input', (e) => this.generateSlug(e.target.value));

                // Search and Pagination
                document.getElementById('search-input').addEventListener('input',
                    this.debounce((e) => this.handleSearch(e), 300)
                );
                document.getElementById('prev-page').addEventListener('click', () => this.previousPage());
                document.getElementById('next-page').addEventListener('click', () => this.nextPage());

                // Export
                document.getElementById('export-btn').addEventListener('click', () => this.exportProducts());
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

            async loadProducts(page = 1) {
                this.isLoading = true;
                this.showLoadingState();

                try {
                    // Simulate API call - replace with actual fetch("/api/products")
                    const response = await this.mockApiCall(page);

                    this.products = response.data;
                    this.currentPage = response.current_page;
                    this.totalPages = response.last_page;

                    this.renderProductsList();
                    this.updateStats(response.stats);
                    this.updatePagination();

                } catch (error) {
                    console.error('Error loading products:', error);
                    this.showErrorState();
                } finally {
                    this.isLoading = false;
                }
            }

            async mockApiCall(page) {
                // Simulate API delay
                await new Promise(resolve => setTimeout(resolve, 800));

                // Mock data that matches your schema
                const mockProducts = Array.from({
                    length: 45
                }, (_, index) => {
                    const id = (page - 1) * 10 + index + 1;
                    const categories = ['Animal Health', 'Crop Protection', 'Feeds & Supplements',
                        'Farming Equipment'
                    ];
                    const category = categories[Math.floor(Math.random() * categories.length)];

                    return {
                        id: id,
                        name: `${category} Product ${id}`,
                        slug: `${category.toLowerCase().replace(' ', '-')}-product-${id}`,
                        price: (Math.random() * 100 + 10).toFixed(2),
                        wholesale_price: (Math.random() * 80 + 8).toFixed(2),
                        buying_price: (Math.random() * 60 + 5).toFixed(2),
                        is_active: Math.random() > 0.1,
                        created_at: new Date(Date.now() - Math.random() * 10000000000).toISOString(),
                        updated_at: new Date(Date.now() - Math.random() * 5000000000).toISOString()
                    };
                }).slice(0, 10); // Only return 10 items per page

                const stats = {
                    total: 45,
                    active: 38,
                    avg_price: '45.67',
                    stock_value: '12,458.90'
                };

                return {
                    data: mockProducts,
                    current_page: page,
                    last_page: 5,
                    per_page: 10,
                    total: 45,
                    stats: stats
                };
            }

            showLoadingState() {
                document.getElementById('loading-state').style.display = 'block';
                document.getElementById('products-table').style.display = 'none';
                document.getElementById('empty-state').classList.add('hidden');
                document.getElementById('pagination-container').style.display = 'none';
            }

            showErrorState() {
                document.getElementById('loading-state').innerHTML = `
                    <div class="text-center text-red-600">
                        <i class="fas fa-exclamation-triangle text-2xl mb-2"></i>
                        <p>Failed to load products</p>
                        <button class="mt-2 px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700" onclick="window.productsResource.loadProducts()">
                            Retry
                        </button>
                    </div>
                `;
            }

            renderProductsList() {
                const tbody = document.getElementById('products-table-body');
                tbody.innerHTML = '';

                if (this.products.length === 0) {
                    this.showEmptyState();
                    return;
                }

                this.products.forEach(product => {
                    const row = this.createProductRow(product);
                    tbody.appendChild(row);
                });

                document.getElementById('loading-state').style.display = 'none';
                document.getElementById('products-table').style.display = 'table';
                document.getElementById('empty-state').classList.add('hidden');
            }

            createProductRow(product) {
                const row = document.createElement('tr');
                row.className = 'table-row fade-in';

                const statusBadge = product.is_active ?
                    '<span class="status-badge bg-green-100 text-green-800">Active</span>' :
                    '<span class="status-badge bg-gray-100 text-gray-800">Inactive</span>';

                row.innerHTML = `
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="h-10 w-10 bg-green-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-cube text-green-600"></i>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">${product.name}</div>
                                <div class="text-sm text-gray-500">${product.slug}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">$${product.price}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">$${product.wholesale_price}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">$${product.buying_price || '--'}</td>
                    <td class="px-6 py-4 whitespace-nowrap">${statusBadge}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${new Date(product.updated_at).toLocaleDateString()}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <button class="text-green-600 hover:text-green-900 mr-3 edit-product" data-id="${product.id}">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="text-red-600 hover:text-red-900 delete-product" data-id="${product.id}">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                `;

                // Add event listeners
                row.querySelector('.edit-product').addEventListener('click', () => {
                    this.showFormView(product.id);
                });

                row.querySelector('.delete-product').addEventListener('click', () => {
                    this.deleteProduct(product.id);
                });

                return row;
            }

            showEmptyState() {
                document.getElementById('loading-state').style.display = 'none';
                document.getElementById('products-table').style.display = 'none';
                document.getElementById('empty-state').classList.remove('hidden');
                document.getElementById('pagination-container').style.display = 'none';
            }

            updateStats(stats) {
                document.getElementById('total-products').textContent = stats.total;
                document.getElementById('active-products').textContent = stats.active;
                document.getElementById('active-percentage').textContent =
                    `${Math.round((stats.active / stats.total) * 100)}% of total`;
                document.getElementById('avg-price').textContent = `$${stats.avg_price}`;
                document.getElementById('stock-value').textContent = `$${stats.stock_value}`;
            }

            updatePagination() {
                const from = (this.currentPage - 1) * 10 + 1;
                const to = Math.min(this.currentPage * 10, 45); // Replace with actual total

                document.getElementById('pagination-from').textContent = from;
                document.getElementById('pagination-to').textContent = to;
                document.getElementById('pagination-total').textContent = 45; // Replace with actual total

                document.getElementById('prev-page').disabled = this.currentPage === 1;
                document.getElementById('next-page').disabled = this.currentPage === this.totalPages;

                document.getElementById('pagination-container').style.display = 'flex';
            }

            previousPage() {
                if (this.currentPage > 1) {
                    this.loadProducts(this.currentPage - 1);
                }
            }

            nextPage() {
                if (this.currentPage < this.totalPages) {
                    this.loadProducts(this.currentPage + 1);
                }
            }

            handleSearch(e) {
                this.searchTerm = e.target.value.toLowerCase();
                // In real implementation, this would trigger an API call with search term
                console.log('Searching for:', this.searchTerm);
                // this.loadProducts(1); // Reload with search term
            }

            showListView() {
                this.currentView = 'list';
                document.getElementById('list-view').classList.remove('hidden');
                document.getElementById('form-view').classList.add('hidden');
                document.getElementById('page-title').textContent = 'Products';
                document.getElementById('page-description').textContent = 'Manage your product catalog';
            }

            showFormView(productId = null) {
                this.currentView = 'form';
                this.currentProductId = productId;

                document.getElementById('list-view').classList.add('hidden');
                document.getElementById('form-view').classList.remove('hidden');

                if (productId) {
                    document.getElementById('form-title').textContent = 'Edit Product';
                    this.loadProductForEdit(productId);
                } else {
                    document.getElementById('form-title').textContent = 'Create New Product';
                    this.resetForm();
                }
            }

            resetForm() {
                document.getElementById('product-form').reset();
                document.getElementById('is_active').checked = true;
            }

            generateSlug(name) {
                if (!name) return;
                const slug = name.toLowerCase()
                    .replace(/[^a-z0-9 -]/g, '')
                    .replace(/\s+/g, '-')
                    .replace(/-+/g, '-');
                document.getElementById('slug').value = slug;
            }

            async loadProductForEdit(productId) {
                // In real app, this would fetch from API
                const product = this.products.find(p => p.id === productId);
                if (product) {
                    document.getElementById('name').value = product.name;
                    document.getElementById('slug').value = product.slug;
                    document.getElementById('price').value = product.price;
                    document.getElementById('wholesale_price').value = product.wholesale_price;
                    document.getElementById('buying_price').value = product.buying_price || '';
                    document.getElementById('is_active').checked = product.is_active;
                }
            }

            async handleFormSubmit(e) {
                e.preventDefault();

                const formData = new FormData(e.target);
                const productData = {
                    name: formData.get('name'),
                    slug: formData.get('slug'),
                    price: parseFloat(formData.get('price')),
                    wholesale_price: parseFloat(formData.get('wholesale_price')),
                    buying_price: formData.get('buying_price') ? parseFloat(formData.get('buying_price')) : null,
                    is_active: formData.get('is_active') === 'on'
                };

                try {
                    if (this.currentProductId) {
                        await this.updateProduct(this.currentProductId, productData);
                    } else {
                        await this.createProduct(productData);
                    }
                } catch (error) {
                    console.error('Error saving product:', error);
                    alert('Error saving product. Please try again.');
                }
            }

            async createProduct(productData) {
                // Simulate API call
                await new Promise(resolve => setTimeout(resolve, 1000));
                console.log('Creating product:', productData);
                alert('Product created successfully!');
                this.showListView();
                this.loadProducts(); // Refresh the list
            }

            async updateProduct(productId, productData) {
                // Simulate API call
                await new Promise(resolve => setTimeout(resolve, 1000));
                console.log('Updating product:', productId, productData);
                alert('Product updated successfully!');
                this.showListView();
                this.loadProducts(); // Refresh the list
            }

            async deleteProduct(productId) {
                if (!confirm('Are you sure you want to delete this product?')) {
                    return;
                }

                try {
                    // Simulate API call
                    await new Promise(resolve => setTimeout(resolve, 800));
                    console.log('Deleting product:', productId);
                    alert('Product deleted successfully!');
                    this.loadProducts(); // Refresh the list
                } catch (error) {
                    console.error('Error deleting product:', error);
                    alert('Error deleting product. Please try again.');
                }
            }

            exportProducts() {
                // In real implementation, this would trigger a download
                console.log('Exporting products...');
                alert('Export started! You will receive the file shortly.');
            }
        }

        // Initialize the products resource when page loads
        document.addEventListener('DOMContentLoaded', function() {
            window.productsResource = new ProductsResource();
        });
    </script>
</body>

</html>
