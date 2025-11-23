<x-dashboard-layout>
    @include('dash.style')

    <!-- Header -->
    @include('dash.header')
    <!-- Header -->

     <!-- Content Area -->
    <div class="flex-1 overflow-auto p-6">
        <!-- dashboard List View -->

        @include('dash.list')

        <!-- dashboard List View -->
      @include('dash.chart')
      @include('dash.customer')

    </div>
    <!-- Content Area -->

        @include('dash.script')

</x-dashboard-layout>
