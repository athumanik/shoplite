<x-cashier>
    @include('shopping.style')

    <!-- Header -->
    @include('shopping.header')
    <!-- Header -->

     <!-- Content Area -->
    <div class="flex-1 overflow-auto p-6">
        <!-- dashboard List View -->

        @include('shopping.list')

        <!-- dashboard List View -->
        @include('shopping.create')


    </div>
    <!-- Content Area -->

        @include('shopping.script')


</x-cashier>
