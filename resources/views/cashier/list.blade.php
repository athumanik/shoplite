<!-- Charts Row 1 -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">

    <!-- Daily Collections Trend -->
    <div class="chart-container p-6 fade-in">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-semibold text-gray-900">Daily Collections Trend</h3>
            <div class="flex space-x-2">
                <button class="px-3 py-1 text-xs bg-green-100 text-green-700 rounded-lg">Daily</button>
                <button class="px-3 py-1 text-xs bg-gray-100 text-gray-600 rounded-lg">Weekly</button>
            </div>
        </div>
        <div class="h-80">
            <canvas id="revenueChart"></canvas>
        </div>
    </div>

    <!-- Payments By Method -->
    <div class="chart-container p-6 fade-in">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-semibold text-gray-900">Payments by Method</h3>
            <i class="fas fa-ellipsis-h text-gray-400"></i>
        </div>
        <div class="h-80">
            <canvas id="categoryChart"></canvas>
        </div>
    </div>
</div>






