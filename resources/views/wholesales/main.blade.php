<x-dashboard-layout>

    <!-- Header -->
    @include('wholesales.header')
    <!-- Header -->

    <!-- Content Area -->
    <div class="flex-1 overflow-auto">
        <!-- Products List View -->

        @include('wholesales.list')
        <!-- Products List View -->


    </div>
    <!-- Content Area -->

    <!-- Create/Edit Wholesale Form -->
    @include('wholesales.create')
    <!-- Create/Edit Wholesale Form -->


    @include('wholesales.script')

</x-dashboard-layout>
