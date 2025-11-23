<x-cashier>
    @include('cashier.style')

    <!-- Header -->
    @include('cashier.header')
    <!-- Header -->

     <!-- Content Area -->
    <div class="flex-1 overflow-auto p-6">
        <!-- dashboard List View -->

        @include('cashier.stats')

        @include('cashier.list')

        <!-- dashboard List View -->
      @include('cashier.chart')
      @include('cashier.customer')

    </div>
    <!-- Content Area -->

        @include('cashier.script')


</x-cashier>
