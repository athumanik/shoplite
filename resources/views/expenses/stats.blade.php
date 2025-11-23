 <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">

        {{-- Total Expenses --}}
        <div class="stat-card bg-white rounded-xl border border-gray-200 p-6 fade-in">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Expenses</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2 " id="totalExpenses">
                       ...
                    </p>
                    <div class="flex items-center mt-2">
                        <span class="text-red-600 text-sm font-medium flex items-center">
                            <i class="fas fa-arrow-up mr-1"></i>
                            ..%
                        </span>
                        {{-- <span class="text-gray-500 text-sm ml-2">vs last month</span> --}}
                        <span class="text-gray-500 text-sm ml-2" id="vs">..</span>
                    </div>
                </div>
                <div class="h-14 w-14 bg-red-100 rounded-xl flex items-center justify-center">
                    <i class="fas fa-money-bill-wave text-red-600 text-xl"></i>
                </div>
            </div>
        </div>

        {{-- Total Expenses --}}


        <div class="stat-card bg-white rounded-xl border border-gray-200 p-6 fade-in">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">This Month</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2" id="monthly">
                       ...
                    </p>
                    <div class="flex items-center mt-2">
                        <span class="text-green-600 text-sm font-medium flex items-center">
                            <i class="fas fa-arrow-down mr-1"></i>
                            ..%
                        </span>
                        {{-- <span class="text-gray-500 text-sm ml-2">savings</span> --}}
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
                    <p class="text-3xl font-bold text-gray-900 mt-2" id="avgExpenses">
                        ...
                    </p>
                    <div class="flex items-center mt-2">
                        <span class="text-gray-600 text-sm font-medium" id="bagdet">..</span>
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
                    <p class="text-3xl font-bold text-gray-900 mt-2" id="category">
                        ...
                    </p>
                    <div class="flex items-center mt-2">
                        <span class="text-gray-500 text-sm" id="spendings">..</span>
                    </div>
                </div>
                <div class="h-14 w-14 bg-purple-100 rounded-xl flex items-center justify-center">
                    <i class="fas fa-bolt text-purple-600 text-xl"></i>
                </div>
            </div>
        </div>
    </div>
