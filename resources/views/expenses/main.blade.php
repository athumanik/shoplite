<x-dashboard-layout>

    <!-- Header -->
    @include('expenses.header')
    <!-- Header -->

    <!-- Content Area -->
    <div class="flex-1 overflow-auto">
        <!-- Products List View -->

        @include('expenses.list')
        <!-- Products List View -->


    </div>
    <!-- Content Area -->

    <!-- Create/Edit Expense Form -->
    @include('expenses.create')
    <!-- Create/Edit Expense Form -->


    @include('expenses.script')

</x-dashboard-layout>
