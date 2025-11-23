<x-cashier>
    @include('selling.style')

<!-- Header -->
    @include('selling.header')
    <!-- Header -->

    <!-- Content Area -->
    <div class="flex-1 overflow-auto">
        <!-- Products List View -->

        @include('selling.list')
        <!-- Products List View -->


    </div>
    <!-- Content Area -->

    <!-- Create/Edit Wholesale Form -->
    @include('selling.create')
    <!-- Create/Edit Wholesale Form -->


    @include('selling.script')
</x-cashier>
