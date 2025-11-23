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
                <circle class="text-gray-200" stroke-width="8" stroke="currentColor" fill="transparent" r="56"
                    cx="64" cy="64" />
                <circle class="text-green-500" stroke-width="8" stroke-dasharray="352" stroke-dashoffset="70"
                    stroke-linecap="round" stroke="currentColor" fill="transparent" r="56" cx="64"
                    cy="64" />
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
            <button
                class="p-4 bg-green-50 border border-green-200 rounded-lg hover:bg-green-100 transition-colors text-center">
                <i class="fas fa-file-pdf text-green-600 text-xl mb-2"></i>
                <p class="text-sm font-medium text-gray-900">Sales Report</p>
                <p class="text-xs text-gray-500">Generate PDF</p>
            </button>
            <button
                class="p-4 bg-blue-50 border border-blue-200 rounded-lg hover:bg-blue-100 transition-colors text-center">
                <i class="fas fa-chart-bar text-blue-600 text-xl mb-2"></i>
                <p class="text-sm font-medium text-gray-900">Analytics</p>
                <p class="text-xs text-gray-500">View Details</p>
            </button>
            <button
                class="p-4 bg-purple-50 border border-purple-200 rounded-lg hover:bg-purple-100 transition-colors text-center">
                <i class="fas fa-box text-purple-600 text-xl mb-2"></i>
                <p class="text-sm font-medium text-gray-900">Inventory</p>
                <p class="text-xs text-gray-500">Stock Report</p>
            </button>
            <button
                class="p-4 bg-yellow-50 border border-yellow-200 rounded-lg hover:bg-yellow-100 transition-colors text-center">
                <i class="fas fa-user-plus text-yellow-600 text-xl mb-2"></i>
                <p class="text-sm font-medium text-gray-900">Customers</p>
                <p class="text-xs text-gray-500">Growth Report</p>
            </button>
        </div>
    </div>
