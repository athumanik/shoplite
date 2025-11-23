  @php
      if (!Auth::check()) {
          return redirect(route('login'));
      }

      $user = Auth::user();
  @endphp
  <!-- Header -->
  <header class="bg-white border-b border-gray-200">
      <div class="flex items-center justify-between px-4 sm:px-6 py-4">
          <div>
              <h1 class="text-xl sm:text-2xl font-bold text-gray-900" id="page-title">Shopping</h1>
              <p class="text-sm text-gray-600 mt-1" id="page-description">Welcome back {{ $user->name }}</p>
          </div>
          <div class="flex items-center space-x-2 sm:space-x-3">
              <button
                  class="px-3 sm:px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 flex items-center text-sm sm:text-base"
                  id="filter-btn">
                  <i class="fas fa-filter mr-2"></i>
                  <span class="hidden sm:inline">Filter</span>
              </button>
              <button
                  class="px-3 sm:px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-blue-700 flex items-center text-sm sm:text-base"
                  id="create-shop-btn">
                  <i class="fas fa-plus mr-2"></i>
                  <span class="hidden sm:inline">Shopping</span>
              </button>
          </div>
      </div>
  </header>
