<x-cashier>
    @include('shop.style')

<!-- Header -->
    @include('shop.header')
    <!-- Header -->

    <!-- Content Area -->
    <div class="flex-1 overflow-auto">
        <!-- Products List View -->

        @include('shop.list')
        <!-- Products List View -->


    </div>
    <!-- Content Area -->

    <!-- Create/Edit Wholesale Form -->
    @include('shop.create')
    <!-- Create/Edit Wholesale Form -->


    @include('shop.script')
</x-cashier>
