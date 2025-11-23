  <!-- Product List View -->
  <div id="list-view" class="p-6">
      @include('products.stats')

      <!-- Product Table -->
      <div class="bg-white rounded-lg border border-gray-200 overflow-hidden fade-in">
          <!-- Table Header -->
          <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
              <h3 class="text-lg font-medium text-gray-900">Products Records</h3>

              {{-- search --}}
              <div class="flex items-center space-x-3">
                  <div class="relative">
                      <input type="text" id="search-input" placeholder="Search products..."
                          class="pl-9 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                      <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                  </div>
                  <button class="p-2 border border-gray-300 rounded-lg hover:bg-gray-50" id="export-btn">
                      <i class="fas fa-download text-gray-600"></i>
                  </button>
              </div>
              {{-- search --}}

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
                          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                              Products</th>
                          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                              Price</th>
                          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                              Wholesale</th>
                          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                              Buying</th>
                          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                              Date</th>
                          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                              Actions</th>
                      </tr>
                  </thead>
                  <tbody class="bg-white divide-y divide-gray-200" id="expenses-table-body">
                      <!-- Product data will be loaded here -->
                  </tbody>
              </table>
          </div>

          <!-- Empty State -->
          <div id="empty-state" class="hidden p-12 text-center">
              <i class="fas fa-money-bill-wave text-4xl text-gray-300 mb-4"></i>
              <h3 class="text-lg font-medium text-gray-900 mb-2">No product found</h3>
              <p class="text-gray-500 mb-4">Get started by recording your first product.</p>
              <button class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700" id="create-first-expense">
                  Add Product
              </button>
          </div>

          <!-- Pagination -->
          {{-- modified --}}

          <div class="px-6 py-4 border-t border-gray-200 flex items-center justify-between" id="pagination-container"
              style="display: none;">

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



  <!-- Product List View -->
