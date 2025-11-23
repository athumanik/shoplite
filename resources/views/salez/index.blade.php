<x-sales>
    <!-- Main Content -->
    <div class="flex-1 flex flex-col overflow-hidden">
        <!-- Header -->
        <header class="bg-white border-b border-gray-200">
            <div class="flex items-center justify-between px-6 py-4">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900" id="page-title">Sales</h1>
                    <p class="text-sm text-gray-600 mt-1" id="page-description">Manage your sales transactions</p>
                </div>
                <div class="flex items-center space-x-3">
                    <button
                        class="px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 flex items-center">
                        <i class="fas fa-filter mr-2"></i>
                        Filter
                    </button>
                    <button class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 flex items-center"
                        id="create-sale-btn">
                        <i class="fas fa-plus mr-2"></i>
                        New Sale
                    </button>
                </div>
            </div>
        </header>

        <!-- Content Area -->
        <div class="flex-1 overflow-auto">
            <!-- Sales List View -->
            <div id="list-view" class="p-6">

                @include('salez.stats')

                <!-- Sales Table -->
                <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
                    <!-- Table Header -->
                    <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                        <h3 class="text-lg font-medium text-gray-900">Recent Sales</h3>
                        <div class="flex items-center space-x-3">
                            <div class="relative">
                                <input type="text" placeholder="Search sales..."
                                    class="pl-9 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                <i
                                    class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            </div>
                            <button class="p-2 border border-gray-300 rounded-lg hover:bg-gray-50">
                                <i class="fas fa-download text-gray-600"></i>
                            </button>
                        </div>
                    </div>
                    {{-- <!-- Loading State -->
                    <div id="loading-state" class="p-8">
                        <div class="animate-pulse">
                            <div class="space-y-4">
                                <div class="skeleton h-4 rounded"></div>
                                <div class="skeleton h-4 rounded"></div>
                                <div class="skeleton h-4 rounded"></div>
                                <div class="skeleton h-4 rounded w-3/4"></div>
                            </div>
                        </div>
                    </div> --}}

                    <!-- Table -->
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Sale ID</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Customer</th>

                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Amount</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Payment</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Date</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200" id="sales-table-body">
                                <!-- Sales data will be loaded here -->
                            </tbody>
                        </table>
                    </div>

                    <!-- Empty State -->
                    <div id="empty-state" class="hidden p-12 text-center">
                        <i class="fas fa-money-bill-wave text-4xl text-gray-300 mb-4"></i>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">No Sales found</h3>
                        <p class="text-gray-500 mb-4">Get started by recording your first sales.</p>
                        <button class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700"
                            id="create-first-sales">
                            Add Sales
                        </button>
                    </div>
                    <!-- Empty State -->


                    <!-- Pagination -->
                    {{-- modified --}}

                    <div class="px-6 py-4 border-t border-gray-200 flex items-center justify-between"
                        id="pagination-container" style="display: none;">

                        <div class="text-sm text-gray-700">
                            Showing
                            <span class="font-medium" id="pagination-from">1</span>
                            to
                            <span class="font-medium" id="pagination-to">10</span>
                            of
                            <span class="font-medium" id="pagination-total">0</span> results
                        </div>

                        <div class="flex space-x-2">
                            <button
                                class="px-3 py-1 border border-gray-300 rounded text-sm font-medium text-gray-700 hover:bg-gray-50 disabled:opacity-50"
                                id="prev-page">Previous</button>

                            <button
                                class="px-3 py-1 border border-gray-300 rounded text-sm font-medium text-gray-700 hover:bg-gray-50 disabled:opacity-50"
                                id="next-page">Next</button>
                        </div>
                    </div>
                    {{-- modified --}}
                    {{-- page --}}

                </div>
            </div>
            {{-- create form --}}
            @include('salez.create')

            {{-- create form --}}

        </div>
    </div>
    </div>

</x-sales>
