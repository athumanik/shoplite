<!-- Header -->
<header class="bg-white border-b border-gray-200">
    <div class="flex items-center justify-between px-6 py-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Cashier Dashboard</h1>
            <p class="text-sm text-gray-600 mt-1">Quick access to sales, receipts, and daily performance</p>
        </div>

        <div class="flex items-center space-x-4">
            <div class="flex items-center space-x-2">
                <span class="text-sm text-gray-600">View:</span>
                <select
                    class="border border-gray-300 rounded-lg px-3 py-1 text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                    <option selected>Today</option>
                    <option>This Week</option>
                    <option>This Month</option>
                </select>
            </div>

            <button class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 flex items-center">
                <i class="fas fa-receipt mr-2"></i>
                Print Report
            </button>
        </div>
    </div>
</header>
