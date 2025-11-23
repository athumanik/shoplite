<x-dashboard-layout>

    <!-- Header -->
    @include('shops.header')
    <!-- Header -->

    <!-- Content Area -->
    <div class="flex-1 overflow-auto">
        <!-- Products List View -->

        @include('shops.list')
        <!-- Products List View -->


    </div>
    <!-- Content Area -->

    <!-- Create/Edit Wholesale Form -->
    @include('shops.create')
    <!-- Create/Edit Wholesale Form -->


    @include('shops.script')

</x-dashboard-layout>
