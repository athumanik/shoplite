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
