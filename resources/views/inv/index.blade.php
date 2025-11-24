<x-cashier>
    @include('inv.style')

    <!-- Header -->
    @include('inv.header')
    <!-- Header -->

     <!-- Content Area -->
    <div class="flex-1 overflow-auto p-6">
        <!-- dashboard List View -->

        @include('inv.list')

        <!-- dashboard List View -->
        @include('inv.create')


    </div>
    <!-- Content Area -->

        @include('inv.script')


</x-cashier>
