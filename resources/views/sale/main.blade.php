<x-dashboard-layout>

    <!-- Header -->
    @include('sale.header')
    <!-- Header -->

    <!-- Content Area -->
    <div class="flex-1 overflow-auto">
        <!-- Sales List View -->

        @include('sale.list')
        <!-- Sales List View -->


    </div>
    <!-- Content Area -->

        @include('sale.script')


</x-dashboard-layout>
