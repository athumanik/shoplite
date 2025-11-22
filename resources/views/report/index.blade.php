<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports - Shoplite Agrovet</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
        .chart-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
            border: 1px solid #e5e7eb;
        }
        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .progress-ring {
            transform: rotate(-90deg);
        }
        .progress-ring-circle {
            transition: stroke-dashoffset 0.35s;
            transform: rotate(90deg);
            transform-origin: 50% 50%;
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
                <a href="{{route('report')}}" class="flex items-center px-3 py-2 text-gray-700 bg-green-50 rounded-lg border border-green-200">
                    <i class="fas fa-chart-bar w-5 h-5 mr-3 text-green-600"></i>
                    <span class="font-medium sidebar-text">Reports</span>
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
                        <h1 class="text-2xl font-bold text-gray-900">Business Intelligence</h1>
                        <p class="text-sm text-gray-600 mt-1">Real-time insights and performance analytics</p>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center space-x-2">
                            <span class="text-sm text-gray-600">Period:</span>
                            <select class="border border-gray-300 rounded-lg px-3 py-1 text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                                <option>Today</option>
                                <option selected>This Week</option>
                                <option>This Month</option>
                                <option>This Quarter</option>
                                <option>This Year</option>
                            </select>
                        </div>
                        <button class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 flex items-center">
                            <i class="fas fa-download mr-2"></i>
                            Export Report
                        </button>
                    </div>
                </div>
            </header>

            <!-- Content Area -->
            <div class="flex-1 overflow-auto p-6">
                <!-- Key Metrics -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <!-- Revenue Card -->
                    <div class="stat-card bg-white rounded-xl border border-gray-200 p-6 fade-in">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Total Revenue</p>
                                <p class="text-3xl font-bold text-gray-900 mt-2">$45,678</p>
                                <div class="flex items-center mt-2">
                                    <span class="text-green-600 text-sm font-medium flex items-center">
                                        <i class="fas fa-arrow-up mr-1"></i>
                                        12.5%
                                    </span>
                                    <span class="text-gray-500 text-sm ml-2">vs last month</span>
                                </div>
                            </div>
                            <div class="h-14 w-14 bg-green-100 rounded-xl flex items-center justify-center">
                                <i class="fas fa-dollar-sign text-green-600 text-xl"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Sales Card -->
                    <div class="stat-card bg-white rounded-xl border border-gray-200 p-6 fade-in">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Total Sales</p>
                                <p class="text-3xl font-bold text-gray-900 mt-2">1,234</p>
                                <div class="flex items-center mt-2">
                                    <span class="text-green-600 text-sm font-medium flex items-center">
                                        <i class="fas fa-arrow-up mr-1"></i>
                                        8.2%
                                    </span>
                                    <span class="text-gray-500 text-sm ml-2">vs last month</span>
                                </div>
                            </div>
                            <div class="h-14 w-14 bg-blue-100 rounded-xl flex items-center justify-center">
                                <i class="fas fa-shopping-cart text-blue-600 text-xl"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Customers Card -->
                    <div class="stat-card bg-white rounded-xl border border-gray-200 p-6 fade-in">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Active Customers</p>
                                <p class="text-3xl font-bold text-gray-900 mt-2">567</p>
                                <div class="flex items-center mt-2">
                                    <span class="text-green-600 text-sm font-medium flex items-center">
                                        <i class="fas fa-arrow-up mr-1"></i>
                                        5.3%
                                    </span>
                                    <span class="text-gray-500 text-sm ml-2">new this month</span>
                                </div>
                            </div>
                            <div class="h-14 w-14 bg-purple-100 rounded-xl flex items-center justify-center">
                                <i class="fas fa-users text-purple-600 text-xl"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Growth Card -->
                    <div class="stat-card bg-white rounded-xl border border-gray-200 p-6 fade-in">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Profit Margin</p>
                                <p class="text-3xl font-bold text-gray-900 mt-2">24.8%</p>
                                <div class="flex items-center mt-2">
                                    <span class="text-green-600 text-sm font-medium flex items-center">
                                        <i class="fas fa-arrow-up mr-1"></i>
                                        2.1%
                                    </span>
                                    <span class="text-gray-500 text-sm ml-2">improvement</span>
                                </div>
                            </div>
                            <div class="h-14 w-14 bg-yellow-100 rounded-xl flex items-center justify-center">
                                <i class="fas fa-chart-line text-yellow-600 text-xl"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Charts Row 1 -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                    <!-- Revenue Trend -->
                    <div class="chart-container p-6 fade-in">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-lg font-semibold text-gray-900">Revenue Trend</h3>
                            <div class="flex space-x-2">
                                <button class="px-3 py-1 text-xs bg-green-100 text-green-700 rounded-lg">Monthly</button>
                                <button class="px-3 py-1 text-xs bg-gray-100 text-gray-600 rounded-lg">Quarterly</button>
                            </div>
                        </div>
                        <div class="h-80">
                            <canvas id="revenueChart"></canvas>
                        </div>
                    </div>

                    <!-- Sales by Category -->
                    <div class="chart-container p-6 fade-in">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-lg font-semibold text-gray-900">Sales by Category</h3>
                            <i class="fas fa-ellipsis-h text-gray-400"></i>
                        </div>
                        <div class="h-80">
                            <canvas id="categoryChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Charts Row 2 -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                    <!-- Top Products -->
                    <div class="chart-container p-6 fade-in">
                        <h3 class="text-lg font-semibold text-gray-900 mb-6">Top Selling Products</h3>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="h-10 w-10 bg-green-100 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-syringe text-green-600"></i>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900">Livestock Vaccine</p>
                                        <p class="text-xs text-gray-500">Animal Health</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm font-bold text-gray-900">$12,450</p>
                                    <p class="text-xs text-green-600">+15.2%</p>
                                </div>
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="h-10 w-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-spray-can text-blue-600"></i>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900">Organic Fertilizer</p>
                                        <p class="text-xs text-gray-500">Crop Protection</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm font-bold text-gray-900">$8,920</p>
                                    <p class="text-xs text-green-600">+8.7%</p>
                                </div>
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="h-10 w-10 bg-yellow-100 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-wheat-alt text-yellow-600"></i>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900">Animal Feed</p>
                                        <p class="text-xs text-gray-500">Feeds & Supplements</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm font-bold text-gray-900">$7,340</p>
                                    <p class="text-xs text-green-600">+12.3%</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Customer Metrics -->
                    <div class="chart-container p-6 fade-in">
                        <h3 class="text-lg font-semibold text-gray-900 mb-6">Customer Insights</h3>
                        <div class="space-y-6">
                            <div>
                                <div class="flex justify-between text-sm mb-2">
                                    <span class="text-gray-600">Repeat Customers</span>
                                    <span class="font-medium">68%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-green-600 h-2 rounded-full" style="width: 68%"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between text-sm mb-2">
                                    <span class="text-gray-600">New Customers</span>
                                    <span class="font-medium">32%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-blue-600 h-2 rounded-full" style="width: 32%"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between text-sm mb-2">
                                    <span class="text-gray-600">Average Order Value</span>
                                    <span class="font-medium">$156.75</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-purple-600 h-2 rounded-full" style="width: 75%"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Inventory Health -->
                    <div class="chart-container p-6 fade-in">
                        <h3 class="text-lg font-semibold text-gray-900 mb-6">Inventory Health</h3>
                        <div class="flex items-center justify-center mb-4">
                            <div class="relative">
                                <svg class="w-32 h-32">
                                    <circle class="text-gray-200" stroke-width="8" stroke="currentColor" fill="transparent" r="56" cx="64" cy="64"/>
                                    <circle class="text-green-500" stroke-width="8" stroke-dasharray="352" stroke-dashoffset="70" stroke-linecap="round" stroke="currentColor" fill="transparent" r="56" cx="64" cy="64"/>
                                </svg>
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <span class="text-2xl font-bold text-gray-900">80%</span>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <p class="text-sm text-gray-600">Stock Turnover Ratio</p>
                            <p class="text-xs text-green-600 mt-1">Healthy • 2.1x monthly</p>
                        </div>
                    </div>
                </div>

                <!-- Performance Metrics -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Monthly Performance -->
                    <div class="chart-container p-6 fade-in">
                        <h3 class="text-lg font-semibold text-gray-900 mb-6">Monthly Performance</h3>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                <div class="flex items-center">
                                    <i class="fas fa-trending-up text-green-600 mr-3"></i>
                                    <span class="text-sm font-medium text-gray-700">Revenue Growth</span>
                                </div>
                                <span class="text-sm font-bold text-green-600">+12.5%</span>
                            </div>
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                <div class="flex items-center">
                                    <i class="fas fa-shopping-cart text-blue-600 mr-3"></i>
                                    <span class="text-sm font-medium text-gray-700">Sales Volume</span>
                                </div>
                                <span class="text-sm font-bold text-blue-600">+8.2%</span>
                            </div>
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                <div class="flex items-center">
                                    <i class="fas fa-users text-purple-600 mr-3"></i>
                                    <span class="text-sm font-medium text-gray-700">Customer Growth</span>
                                </div>
                                <span class="text-sm font-bold text-purple-600">+5.3%</span>
                            </div>
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                <div class="flex items-center">
                                    <i class="fas fa-percentage text-yellow-600 mr-3"></i>
                                    <span class="text-sm font-medium text-gray-700">Profit Margin</span>
                                </div>
                                <span class="text-sm font-bold text-yellow-600">+2.1%</span>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="chart-container p-6 fade-in">
                        <h3 class="text-lg font-semibold text-gray-900 mb-6">Quick Actions</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <button class="p-4 bg-green-50 border border-green-200 rounded-lg hover:bg-green-100 transition-colors text-center">
                                <i class="fas fa-file-pdf text-green-600 text-xl mb-2"></i>
                                <p class="text-sm font-medium text-gray-900">Sales Report</p>
                                <p class="text-xs text-gray-500">Generate PDF</p>
                            </button>
                            <button class="p-4 bg-blue-50 border border-blue-200 rounded-lg hover:bg-blue-100 transition-colors text-center">
                                <i class="fas fa-chart-bar text-blue-600 text-xl mb-2"></i>
                                <p class="text-sm font-medium text-gray-900">Analytics</p>
                                <p class="text-xs text-gray-500">View Details</p>
                            </button>
                            <button class="p-4 bg-purple-50 border border-purple-200 rounded-lg hover:bg-purple-100 transition-colors text-center">
                                <i class="fas fa-box text-purple-600 text-xl mb-2"></i>
                                <p class="text-sm font-medium text-gray-900">Inventory</p>
                                <p class="text-xs text-gray-500">Stock Report</p>
                            </button>
                            <button class="p-4 bg-yellow-50 border border-yellow-200 rounded-lg hover:bg-yellow-100 transition-colors text-center">
                                <i class="fas fa-user-plus text-yellow-600 text-xl mb-2"></i>
                                <p class="text-sm font-medium text-gray-900">Customers</p>
                                <p class="text-xs text-gray-500">Growth Report</p>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        class ReportsDashboard {
            constructor() {
                this.isSidebarCollapsed = false;
                this.initializeCharts();
                this.initializeEventListeners();
            }

            initializeEventListeners() {
                // Sidebar toggle
                document.getElementById('sidebar-toggle').addEventListener('click', () => this.toggleSidebar());
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

            initializeCharts() {
                this.createRevenueChart();
                this.createCategoryChart();
            }

            createRevenueChart() {
                const ctx = document.getElementById('revenueChart').getContext('2d');
                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                        datasets: [{
                            label: 'Revenue',
                            data: [32000, 35000, 38000, 42000, 45000, 48000, 52000, 55000, 58000, 62000, 65000, 68000],
                            borderColor: '#10b981',
                            backgroundColor: 'rgba(16, 185, 129, 0.1)',
                            borderWidth: 3,
                            fill: true,
                            tension: 0.4
                        }, {
                            label: 'Target',
                            data: [30000, 33000, 36000, 40000, 43000, 46000, 50000, 53000, 56000, 60000, 63000, 66000],
                            borderColor: '#6b7280',
                            borderWidth: 2,
                            borderDash: [5, 5],
                            fill: false,
                            tension: 0.4
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'top',
                            },
                            tooltip: {
                                mode: 'index',
                                intersect: false,
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: {
                                    drawBorder: false,
                                },
                                ticks: {
                                    callback: function(value) {
                                        return '$' + value.toLocaleString();
                                    }
                                }
                            },
                            x: {
                                grid: {
                                    display: false
                                }
                            }
                        }
                    }
                });
            }

            createCategoryChart() {
                const ctx = document.getElementById('categoryChart').getContext('2d');
                new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: ['Animal Health', 'Crop Protection', 'Feeds & Supplements', 'Farming Equipment'],
                        datasets: [{
                            data: [35, 25, 20, 20],
                            backgroundColor: [
                                '#10b981',
                                '#3b82f6',
                                '#f59e0b',
                                '#8b5cf6'
                            ],
                            borderWidth: 0,
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        cutout: '70%',
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    padding: 20,
                                    usePointStyle: true,
                                }
                            }
                        }
                    }
                });
            }
        }

        // Initialize the dashboard when page loads
        document.addEventListener('DOMContentLoaded', function() {
            window.reportsDashboard = new ReportsDashboard();

            // Add fade-in animation to all stat cards
            const cards = document.querySelectorAll('.fade-in');
            cards.forEach((card, index) => {
                card.style.animationDelay = `${index * 0.1}s`;
            });
        });
    </script>
</body>
</html>
