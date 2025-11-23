<x-dashboard-layout>
   <!-- Header -->
    @include('products.header')
    <!-- Header -->

    <!-- Content Area -->
    <div class="flex-1 overflow-auto">
        <!-- Products List View -->

        @include('products.list')
        <!-- Products List View -->


    </div>
    <!-- Content Area -->

        @include('products.script')


</x-dashboard-layout>
