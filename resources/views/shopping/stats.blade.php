<!-- Stats Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-6 sm:mb-8">
    <div class="stat-card bg-white rounded-xl border border-gray-200 p-4 sm:p-6 fade-in">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600">Wholesale Revenue</p>
                <p class="text-2xl sm:text-3xl font-bold text-gray-900 mt-2" id="revenue">--</p>
                <div class="flex items-center mt-2">
                    <span class="text-green-600 text-sm font-medium flex items-center">
                        <i class="fas fa-arrow-up mr-1"></i>
                        ..%
                    </span>
                    <span class="text-gray-500 text-sm ml-2 hidden sm:inline">..</span>
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
                <p class="text-2xl sm:text-3xl font-bold text-gray-900 mt-2" id="orders">--</p>
                <div class="flex items-center mt-2">
                    <span class="text-green-600 text-sm font-medium flex items-center">
                        <i class="fas fa-arrow-up mr-1"></i>
                        ..%
                    </span>
                    <span class="text-gray-500 text-sm ml-2 hidden sm:inline" id="month">..</span>
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
                <p class="text-2xl sm:text-3xl font-bold text-gray-900 mt-2" id="average">--</p>
                <div class="flex items-center mt-2">
                    <span class="text-green-600 text-sm font-medium flex items-center">
                        <i class="fas fa-arrow-up mr-1"></i>
                        ..%
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
                <p class="text-2xl sm:text-3xl font-bold text-gray-900 mt-2">--</p>
                <div class="flex items-center mt-2">
                    <span class="text-gray-500 text-sm" id="topSales">..</span>
                </div>
            </div>
            <div class="h-12 w-12 sm:h-14 sm:w-14 bg-yellow-100 rounded-xl flex items-center justify-center">
                <i class="fas fa-wheat-alt text-yellow-600 text-lg sm:text-xl"></i>
            </div>
        </div>
    </div>
</div>
