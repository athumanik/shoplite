<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expenses - Shoplite Agrovet</title>
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
        .category-badge {
            font-size: 0.75rem;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
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
                <a href="{{ route('sales.index') }}" class="flex items-center px-3 py-2 text-gray-600 hover:bg-gray-100 rounded-lg">
                    <i class="fas fa-shopping-cart w-5 h-5 mr-3"></i>
                    <span class="sidebar-text">Sales</span>
                </a>
                    <a href="{{ route('wholesale') }}" class="flex items-center px-3 py-2 text-gray-700 bg-green-50 rounded-lg">
                    <i class="fas fa-shopping-cart w-5 h-5 mr-3"></i>
                    <span class="font-medium">WholeSales</span>
                </a>
                <a href="{{route('orders')}}" class="flex items-center px-3 py-2 text-gray-600 hover:bg-gray-100 rounded-lg">
                    <i class="fas fa-clipboard-list w-5 h-5 mr-3"></i>
                    <span class="sidebar-text">Orders</span>
                </a>
                <a href="{{route('products')}}" class="flex items-center px-3 py-2 text-gray-600 hover:bg-gray-100 rounded-lg">
                    <i class="fas fa-cube w-5 h-5 mr-3"></i>
                    <span class="sidebar-text">Products</span>
                </a>
                <a href="{{route('inventory.index')}}" class="flex items-center px-3 py-2 text-gray-600 hover:bg-gray-100 rounded-lg">
                    <i class="fas fa-boxes w-5 h-5 mr-3"></i>
                    <span class="sidebar-text">Inventory</span>
                </a>
                <a href="{{route('report')}}" class="flex items-center px-3 py-2 text-gray-600 hover:bg-gray-100 rounded-lg">
                    <i class="fas fa-chart-bar w-5 h-5 mr-3"></i>
                    <span class="sidebar-text">Reports</span>
                </a>
                <a href="{{route('expense')}}" class="flex items-center px-3 py-2 text-gray-700 bg-green-50 rounded-lg border border-green-200">
                    <i class="fas fa-money-bill-wave w-5 h-5 mr-3 text-green-600"></i>
                    <span class="font-medium sidebar-text">Expenses</span>
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
                        <div class="text-xs text-gray-500">Agrovet Manager</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content flex-1 flex flex-col overflow-hidden transition-all duration-300">
            <!-- Header -->
            <header class="bg-white border-b border-gray-200">
                <div class="flex items-center justify-between px-6 py-4">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900" id="page-title">Expenses</h1>
                        <p class="text-sm text-gray-600 mt-1" id="page-description">Manage business expenses and track spending</p>
                    </div>
                    <div class="flex items-center space-x-3">
                        <button class="px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 flex items-center" id="filter-btn">
                            <i class="fas fa-filter mr-2"></i>
                            Filter
                        </button>
                        <button class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 flex items-center" id="create-expense-btn">
                            <i class="fas fa-plus mr-2"></i>
                            New Expense
                        </button>
                    </div>
                </div>
            </header>

            <!-- Content Area -->
            <div class="flex-1 overflow-auto">
                <!-- Expenses List View -->
                <div id="list-view" class="p-6">
                    <!-- Stats Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                        <div class="stat-card bg-white rounded-xl border border-gray-200 p-6 fade-in">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-600">Total Expenses</p>
                                    <p class="text-3xl font-bold text-gray-900 mt-2">$12,458</p>
                                    <div class="flex items-center mt-2">
                                        <span class="text-red-600 text-sm font-medium flex items-center">
                                            <i class="fas fa-arrow-up mr-1"></i>
                                            8.2%
                                        </span>
                                        <span class="text-gray-500 text-sm ml-2">vs last month</span>
                                    </div>
                                </div>
                                <div class="h-14 w-14 bg-red-100 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-money-bill-wave text-red-600 text-xl"></i>
                                </div>
                            </div>
                        </div>

                        <div class="stat-card bg-white rounded-xl border border-gray-200 p-6 fade-in">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-600">This Month</p>
                                    <p class="text-3xl font-bold text-gray-900 mt-2">$2,345</p>
                                    <div class="flex items-center mt-2">
                                        <span class="text-green-600 text-sm font-medium flex items-center">
                                            <i class="fas fa-arrow-down mr-1"></i>
                                            5.3%
                                        </span>
                                        <span class="text-gray-500 text-sm ml-2">savings</span>
                                    </div>
                                </div>
                                <div class="h-14 w-14 bg-blue-100 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-calendar-alt text-blue-600 text-xl"></i>
                                </div>
                            </div>
                        </div>

                        <div class="stat-card bg-white rounded-xl border border-gray-200 p-6 fade-in">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-600">Avg. Monthly</p>
                                    <p class="text-3xl font-bold text-gray-900 mt-2">$2,890</p>
                                    <div class="flex items-center mt-2">
                                        <span class="text-gray-600 text-sm font-medium">Budget: $3,000</span>
                                    </div>
                                </div>
                                <div class="h-14 w-14 bg-green-100 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-chart-line text-green-600 text-xl"></i>
                                </div>
                            </div>
                        </div>

                        <div class="stat-card bg-white rounded-xl border border-gray-200 p-6 fade-in">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-600">Top Category</p>
                                    <p class="text-3xl font-bold text-gray-900 mt-2">Utilities</p>
                                    <div class="flex items-center mt-2">
                                        <span class="text-gray-500 text-sm">$1,234 spent</span>
                                    </div>
                                </div>
                                <div class="h-14 w-14 bg-purple-100 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-bolt text-purple-600 text-xl"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Expenses Table -->
                    <div class="bg-white rounded-lg border border-gray-200 overflow-hidden fade-in">
                        <!-- Table Header -->
                        <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                            <h3 class="text-lg font-medium text-gray-900">Expense Records</h3>
                            <div class="flex items-center space-x-3">
                                <div class="relative">
                                    <input type="text" id="search-input" placeholder="Search expenses..."
                                        class="pl-9 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                    <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                </div>
                                <button class="p-2 border border-gray-300 rounded-lg hover:bg-gray-50" id="export-btn">
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
                            <table class="w-full" id="expenses-table" style="display: none;">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Expense</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Receipt</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200" id="expenses-table-body">
                                    <!-- Expenses data will be loaded here -->
                                </tbody>
                            </table>
                        </div>

                        <!-- Empty State -->
                        <div id="empty-state" class="hidden p-12 text-center">
                            <i class="fas fa-money-bill-wave text-4xl text-gray-300 mb-4"></i>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">No expenses found</h3>
                            <p class="text-gray-500 mb-4">Get started by recording your first expense.</p>
                            <button class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700" id="create-first-expense">
                                Add Expense
                            </button>
                        </div>

                        <!-- Pagination -->
                        <div class="px-6 py-4 border-t border-gray-200 flex items-center justify-between" id="pagination-container" style="display: none;">
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

                <!-- Create/Edit Expense Form -->
                <div id="form-view" class="hidden p-6">
                    <div class="max-w-2xl mx-auto">
                        <div class="form-card bg-white rounded-lg border border-gray-200 fade-in">
                            <!-- Form Header -->
                            <div class="px-6 py-4 border-b border-gray-200">
                                <div class="flex items-center justify-between">
                                    <h3 class="text-lg font-medium text-gray-900" id="form-title">New Expense</h3>
                                    <button class="text-gray-400 hover:text-gray-600" id="back-to-list">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Form Content -->
                            <div class="p-6">
                                <form id="expense-form">
                                    <!-- Basic Information -->
                                    <div class="space-y-6">
                                        <div>
                                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Expense Name *</label>
                                            <input type="text" id="name" name="name" required
                                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                                placeholder="Enter expense description">
                                        </div>

                                        <div>
                                            <label for="amount" class="block text-sm font-medium text-gray-700 mb-2">Amount *</label>
                                            <div class="relative">
                                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                    <span class="text-gray-500">$</span>
                                                </div>
                                                <input type="number" id="amount" name="amount" required step="0.01" min="0"
                                                    class="w-full pl-7 pr-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                                    placeholder="0.00">
                                            </div>
                                        </div>

                                        <div>
                                            <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                                            <select id="category" name="category"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                                <option value="">Select Category</option>
                                                <option value="Utilities">Utilities</option>
                                                <option value="Rent">Rent</option>
                                                <option value="Salaries">Salaries</option>
                                                <option value="Supplies">Supplies</option>
                                                <option value="Maintenance">Maintenance</option>
                                                <option value="Transport">Transport</option>
                                                <option value="Marketing">Marketing</option>
                                                <option value="Other">Other</option>
                                            </select>
                                        </div>

                                        <div>
                                            <label for="receipt" class="block text-sm font-medium text-gray-700 mb-2">Receipt Number</label>
                                            <input type="text" id="receipt" name="receipt"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                                placeholder="Enter receipt number">
                                        </div>

                                        <div>
                                            <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">Notes</label>
                                            <textarea id="notes" name="notes" rows="3"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                                placeholder="Add any notes about this expense..."></textarea>
                                        </div>
                                    </div>

                                    <!-- Form Actions -->
                                    <div class="flex items-center justify-end space-x-3 pt-6 border-t border-gray-200">
                                        <button type="button" id="cancel-form" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                                            Cancel
                                        </button>
                                        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                                            Save Expense
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
        class ExpensesResource {
            constructor() {
                this.currentView = 'list';
                this.expenses = [];
                this.currentPage = 1;
                this.totalPages = 1;
                this.searchTerm = '';
                this.isLoading = false;
                this.isSidebarCollapsed = false;

                this.initializeEventListeners();
                this.loadExpenses();
            }

            initializeEventListeners() {
                // Navigation
                document.getElementById('create-expense-btn').addEventListener('click', () => this.showFormView());
                document.getElementById('create-first-expense').addEventListener('click', () => this.showFormView());
                document.getElementById('back-to-list').addEventListener('click', () => this.showListView());
                document.getElementById('cancel-form').addEventListener('click', () => this.showListView());

                // Form
                document.getElementById('expense-form').addEventListener('submit', (e) => this.handleFormSubmit(e));

                // Search and Pagination
                document.getElementById('search-input').addEventListener('input',
                    this.debounce((e) => this.handleSearch(e), 300)
                );
                document.getElementById('prev-page').addEventListener('click', () => this.previousPage());
                document.getElementById('next-page').addEventListener('click', () => this.nextPage());

                // Export
                document.getElementById('export-btn').addEventListener('click', () => this.exportExpenses());

                // Sidebar toggle
                document.getElementById('sidebar-toggle').addEventListener('click', () => this.toggleSidebar());
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

            toggleSidebar() {
                const sidebar = document.querySelector('.sidebar');
                const mainContent = document.querySelector('.main-content');
                const toggleIcon = document.querySelector('#sidebar-toggle i');

                this.isSidebarCollapsed = !this.isSidebarCollapsed;

                sidebar.classList.toggle('collapsed');

                if (this.isSidebarCollapsed) {
                    toggleIcon.className = 'fas fa-chevron-right text-gray-600 text-xs';
                } else {
                    toggleIcon.className = 'fas fa-chevron-left text-gray-600 text-xs';
                }
            }

            async loadExpenses(page = 1) {
                this.isLoading = true;
                this.showLoadingState();

                try {
                    // Simulate API call - replace with actual fetch("/api/expenses")
                    const response = await this.mockApiCall(page);

                    this.expenses = response.data;
                    this.currentPage = response.current_page;
                    this.totalPages = response.last_page;

                    this.renderExpensesList();
                    this.updatePagination();

                } catch (error) {
                    console.error('Error loading expenses:', error);
                    this.showErrorState();
                } finally {
                    this.isLoading = false;
                }
            }

            async mockApiCall(page) {
                // Simulate API delay
                await new Promise(resolve => setTimeout(resolve, 800));

                // Mock data that matches your schema
                const mockExpenses = Array.from({ length: 10 }, (_, index) => {
                    const id = (page - 1) * 10 + index + 1;
                    const categories = ['Utilities', 'Rent', 'Salaries', 'Supplies', 'Maintenance', 'Transport', 'Marketing', 'Other'];
                    const category = categories[Math.floor(Math.random() * categories.length)];
                    const amount = (Math.random() * 1000 + 50).toFixed(2);

                    return {
                        id: id,
                        name: `${category} Expense ${id}`,
                        amount: amount,
                        category: category,
                        receipt: `RCP-${1000 + id}`,
                        notes: Math.random() > 0.7 ? 'Monthly recurring expense' : null,
                        created_at: new Date(Date.now() - Math.random() * 10000000000).toISOString(),
                        updated_at: new Date(Date.now() - Math.random() * 5000000000).toISOString()
                    };
                });

                return {
                    data: mockExpenses,
                    current_page: page,
                    last_page: 5,
                    per_page: 10,
                    total: 42
                };
            }

            showLoadingState() {
                document.getElementById('loading-state').style.display = 'block';
                document.getElementById('expenses-table').style.display = 'none';
                document.getElementById('empty-state').classList.add('hidden');
                document.getElementById('pagination-container').style.display = 'none';
            }

            showErrorState() {
                document.getElementById('loading-state').innerHTML = `
                    <div class="text-center text-red-600">
                        <i class="fas fa-exclamation-triangle text-2xl mb-2"></i>
                        <p>Failed to load expenses</p>
                        <button class="mt-2 px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700" onclick="window.expensesResource.loadExpenses()">
                            Retry
                        </button>
                    </div>
                `;
            }

            renderExpensesList() {
                const tbody = document.getElementById('expenses-table-body');
                tbody.innerHTML = '';

                if (this.expenses.length === 0) {
                    this.showEmptyState();
                    return;
                }

                this.expenses.forEach(expense => {
                    const row = this.createExpenseRow(expense);
                    tbody.appendChild(row);
                });

                document.getElementById('loading-state').style.display = 'none';
                document.getElementById('expenses-table').style.display = 'table';
                document.getElementById('empty-state').classList.add('hidden');
            }

            createExpenseRow(expense) {
                const row = document.createElement('tr');
                row.className = 'table-row fade-in';

                const categoryBadge = this.getCategoryBadge(expense.category);

                row.innerHTML = `
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="h-10 w-10 bg-red-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-money-bill-wave text-red-600"></i>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">${expense.name}</div>
                                <div class="text-sm text-gray-500">${expense.notes || 'No notes'}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-red-600">$${expense.amount}</td>
                    <td class="px-6 py-4 whitespace-nowrap">${categoryBadge}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${expense.receipt}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${new Date(expense.created_at).toLocaleDateString()}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <button class="text-green-600 hover:text-green-900 mr-3 edit-expense" data-id="${expense.id}">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="text-red-600 hover:text-red-900 delete-expense" data-id="${expense.id}">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                `;

                // Add event listeners
                row.querySelector('.edit-expense').addEventListener('click', () => {
                    this.showFormView(expense.id);
                });

                row.querySelector('.delete-expense').addEventListener('click', () => {
                    this.deleteExpense(expense.id);
                });

                return row;
            }

            getCategoryBadge(category) {
                const badges = {
                    'Utilities': 'bg-blue-100 text-blue-800',
                    'Rent': 'bg-purple-100 text-purple-800',
                    'Salaries': 'bg-green-100 text-green-800',
                    'Supplies': 'bg-yellow-100 text-yellow-800',
                    'Maintenance': 'bg-orange-100 text-orange-800',
                    'Transport': 'bg-indigo-100 text-indigo-800',
                    'Marketing': 'bg-pink-100 text-pink-800',
                    'Other': 'bg-gray-100 text-gray-800'
                };

                return `<span class="category-badge ${badges[category]}">${category}</span>`;
            }

            showEmptyState() {
                document.getElementById('loading-state').style.display = 'none';
                document.getElementById('expenses-table').style.display = 'none';
                document.getElementById('empty-state').classList.remove('hidden');
                document.getElementById('pagination-container').style.display = 'none';
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
                    this.loadExpenses(this.currentPage - 1);
                }
            }

            nextPage() {
                if (this.currentPage < this.totalPages) {
                    this.loadExpenses(this.currentPage + 1);
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
                document.getElementById('page-title').textContent = 'Expenses';
                document.getElementById('page-description').textContent = 'Manage business expenses and track spending';
            }

            showFormView(expenseId = null) {
                this.currentView = 'form';
                this.currentExpenseId = expenseId;

                document.getElementById('list-view').classList.add('hidden');
                document.getElementById('form-view').classList.remove('hidden');

                if (expenseId) {
                    document.getElementById('form-title').textContent = 'Edit Expense';
                    this.loadExpenseForEdit(expenseId);
                } else {
                    document.getElementById('form-title').textContent = 'New Expense';
                    this.resetForm();
                }
            }

            resetForm() {
                document.getElementById('expense-form').reset();
            }

            async loadExpenseForEdit(expenseId) {
                // In real app, this would fetch from API
                const expense = this.expenses.find(e => e.id === expenseId);
                if (expense) {
                    document.getElementById('name').value = expense.name;
                    document.getElementById('amount').value = expense.amount;
                    document.getElementById('category').value = expense.category;
                    document.getElementById('receipt').value = expense.receipt || '';
                    document.getElementById('notes').value = expense.notes || '';
                }
            }

            async handleFormSubmit(e) {
                e.preventDefault();

                const formData = new FormData(e.target);
                const expenseData = {
                    name: formData.get('name'),
                    amount: parseFloat(formData.get('amount')),
                    category: formData.get('category'),
                    receipt: formData.get('receipt'),
                    notes: formData.get('notes')
                };

                try {
                    if (this.currentExpenseId) {
                        await this.updateExpense(this.currentExpenseId, expenseData);
                    } else {
                        await this.createExpense(expenseData);
                    }
                } catch (error) {
                    console.error('Error saving expense:', error);
                    alert('Error saving expense. Please try again.');
                }
            }

            async createExpense(expenseData) {
                // Simulate API call
                await new Promise(resolve => setTimeout(resolve, 1000));
                console.log('Creating expense:', expenseData);
                alert('Expense created successfully!');
                this.showListView();
                this.loadExpenses(); // Refresh the list
            }

            async updateExpense(expenseId, expenseData) {
                // Simulate API call
                await new Promise(resolve => setTimeout(resolve, 1000));
                console.log('Updating expense:', expenseId, expenseData);
                alert('Expense updated successfully!');
                this.showListView();
                this.loadExpenses(); // Refresh the list
            }

            async deleteExpense(expenseId) {
                if (!confirm('Are you sure you want to delete this expense?')) {
                    return;
                }

                try {
                    // Simulate API call
                    await new Promise(resolve => setTimeout(resolve, 800));
                    console.log('Deleting expense:', expenseId);
                    alert('Expense deleted successfully!');
                    this.loadExpenses(); // Refresh the list
                } catch (error) {
                    console.error('Error deleting expense:', error);
                    alert('Error deleting expense. Please try again.');
                }
            }

            exportExpenses() {
                console.log('Exporting expenses data...');
                alert('Expenses export started! You will receive the file shortly.');
            }
        }

        // Initialize the expenses resource when page loads
        document.addEventListener('DOMContentLoaded', function() {
            window.expensesResource = new ExpensesResource();

            // Add fade-in animation to all stat cards
            const cards = document.querySelectorAll('.fade-in');
            cards.forEach((card, index) => {
                card.style.animationDelay = `${index * 0.1}s`;
            });
        });
    </script>
</body>
</html>
