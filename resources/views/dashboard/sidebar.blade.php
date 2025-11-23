<!-- Sidebar -->
<div class="sidebar w-64 bg-white border-r border-gray-200 flex flex-col relative">
    <!-- Toggle Button -->
    <button id="sidebar-toggle"
        class="absolute -right-3 top-6 bg-white border border-gray-300 rounded-full w-6 h-6 flex items-center justify-center shadow-sm hover:shadow-md z-10">
        <i class="fas fa-chevron-left text-gray-600 text-xs"></i>
    </button>

    <!-- Logo -->
    <div class="flex items-center justify-center h-16 border-b border-gray-200 px-4">
        <div class="flex items-center">
            <svg class="h-8 w-8 text-green-600" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M12 2L3 9V20C3 20.5304 3.21071 21.0391 3.58579 21.4142C3.96086 21.7893 4.46957 22 5 22H19C19.5304 22 20.0391 21.7893 20.4142 21.4142C20.7893 21.0391 21 20.5304 21 20V9L12 2Z"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M9 22V12H15V22" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
                <path d="M9 12H15" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
            <span class="ml-2 text-xl font-bold text-gray-800 sidebar-text">Shoplite</span>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 px-4 py-6 space-y-2">
        <a href="{{ route('dashboard') }}"
            class="flex items-center px-3 py-2 rounded-lg transition-all duration-200
          {{ request()->routeIs('dashboard')
              ? 'bg-green-50 text-gray-700 border border-green-200'
              : 'text-gray-600 hover:bg-gray-100' }}">

            <i
                class="fas fa-gauge w-5 h-5 mr-3
            {{ request()->routeIs('dashboard') ? 'text-green-600' : '' }}"></i>

            <span class="sidebar-text {{ request()->routeIs('dashboard') ? 'font-medium' : '' }}">
                Dashboard
            </span>
        </a>

        <a href="{{ route('sales') }}"
            class="flex items-center px-3 py-2 rounded-lg transition-all duration-200
          {{ request()->routeIs('sales')
              ? 'bg-green-50 text-gray-700 border border-green-200'
              : 'text-gray-600 hover:bg-gray-100' }}">

            <i
                class="fas fa-cash-register w-5 h-5 mr-3
            {{ request()->routeIs('sales') ? 'text-green-600' : '' }}"></i>

            <span class="sidebar-text {{ request()->routeIs('sales') ? 'font-medium' : '' }}">
                Sales
            </span>
        </a>

        <a href="{{ route('product') }}"
            class="flex items-center px-3 py-2 rounded-lg transition-all duration-200
          {{ request()->routeIs('product')
              ? 'bg-green-50 text-gray-700 border border-green-200'
              : 'text-gray-600 hover:bg-gray-100' }}">

            <i
                class="fas fa-cubes w-5 h-5 mr-3
            {{ request()->routeIs('product') ? 'text-green-600' : '' }}"></i>

            <span class="sidebar-text {{ request()->routeIs('product') ? 'font-medium' : '' }}">
              Products
            </span>
        </a>

        <a href="{{ route('wholesales') }}"
            class="flex items-center px-3 py-2 rounded-lg transition-all duration-200
          {{ request()->routeIs('wholesales')
              ? 'bg-green-50 text-gray-700 border border-green-200'
              : 'text-gray-600 hover:bg-gray-100' }}">

            <i
                class="fas fa-dolly w-5 h-5 mr-3
            {{ request()->routeIs('wholesales') ? 'text-green-600' : '' }}"></i>

            <span class="sidebar-text {{ request()->routeIs('wholesales') ? 'font-medium' : '' }}">
              Wholesales
            </span>
        </a>
        <a href="{{ route('shop') }}"
            class="flex items-center px-3 py-2 rounded-lg transition-all duration-200
          {{ request()->routeIs('shop')
              ? 'bg-green-50 text-gray-700 border border-green-200'
              : 'text-gray-600 hover:bg-gray-100' }}">

            <i
                class="fas fa-shop w-5 h-5 mr-3
            {{ request()->routeIs('shop') ? 'text-green-600' : '' }}"></i>

            <span class="sidebar-text {{ request()->routeIs('shop') ? 'font-medium' : '' }}">
              Shopping
            </span>
        </a>
        <a href="{{ route('inventories') }}"
            class="flex items-center px-3 py-2 rounded-lg transition-all duration-200
          {{ request()->routeIs('inventories')
              ? 'bg-green-50 text-gray-700 border border-green-200'
              : 'text-gray-600 hover:bg-gray-100' }}">

            <i
                class="fas fa-boxes-stacked  w-5 h-5 mr-3
            {{ request()->routeIs('inventories') ? 'text-green-600' : '' }}"></i>

            <span class="sidebar-text {{ request()->routeIs('inventories') ? 'font-medium' : '' }}">
             Inventory
            </span>
        </a>
        <a href="{{ route('expenses') }}"
            class="flex items-center px-3 py-2 rounded-lg transition-all duration-200
          {{ request()->routeIs('expenses')
              ? 'bg-green-50 text-gray-700 border border-green-200'
              : 'text-gray-600 hover:bg-gray-100' }}">

            <i
                class="fas fa-wallet w-5 h-5 mr-3
            {{ request()->routeIs('expenses') ? 'text-green-600' : '' }}"></i>

            <span class="sidebar-text {{ request()->routeIs('expenses') ? 'font-medium' : '' }}">
              Expenses
            </span>
        </a>

        <a href="{{ route('pos.guest') }}" target="_blank" rel="noopener noreferrer"
            class="flex items-center px-3 py-2 rounded-lg transition-all duration-200
          {{ request()->routeIs('pos.guest')
              ? 'bg-green-50 text-gray-700 border border-green-200'
              : 'text-gray-600 hover:bg-gray-100' }}">

            <i
                class="fas fa-shopping-cart w-5 h-5 mr-3
            {{ request()->routeIs('pos.guest') ? 'text-green-600' : '' }}"></i>

            <span class="sidebar-text {{ request()->routeIs('pos.guest') ? 'font-medium' : '' }}">
             POS
            </span>
        </a>

        <a href="{{ route('stock.guest') }}" target="_blank" rel="noopener noreferrer"
            class="flex items-center px-3 py-2 rounded-lg transition-all duration-200
          {{ request()->routeIs('stock.guest')
              ? 'bg-green-50 text-gray-700 border border-green-200'
              : 'text-gray-600 hover:bg-gray-100' }}">

            <i
                class="fas fa-handshake w-5 h-5 mr-3
            {{ request()->routeIs('stock.guest') ? 'text-green-600' : '' }}"></i>

            <span class="sidebar-text {{ request()->routeIs('stock.guest') ? 'font-medium' : '' }}">
             STOCKING
            </span>
        </a>



    </nav>


    <!-- User Profile -->
    @include('user.profile')
    <!-- User Profile -->


</div>
