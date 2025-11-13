<x-dashboard-layout>

    <div id="content">
        <div class="container-fluid">

            <div class="row mb-4">
                <div class="col-12">
                    <h2 class="fw-bold text-dark">Dashboard Overview</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Agrovet</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                        </ol>
                    </nav>
                </div>
            </div>

            {{-- Cards  --}}
            @include('dashboard.stats')





        </div>
    </div>

</x-dashboard-layout>
