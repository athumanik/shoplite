<x-dashboard-layout>
   <!-- Header -->
    @include('inventories.header')
    <!-- Header -->

    <!-- Content Area -->
    <div class="flex-1 overflow-auto">
        <!-- Products List View -->

        @include('inventories.list')
        <!-- Products List View -->


    </div>
    <!-- Content Area -->

        @include('inventories.script')


</x-dashboard-layout>
