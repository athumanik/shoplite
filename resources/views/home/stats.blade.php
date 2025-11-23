 <!-- Stats Cards -->
 <div class="row">
     <div class="col-xl-3 col-md-6 mb-4">
         <div class="stat-card blue p-4 rounded-3 h-100">
             <div class="d-flex justify-content-between align-items-center">
                 <div>
                     <h6 class="text-uppercase mb-1">Users</h6>
                     <h3 class="mb-0">{{ $users }}</h3>
                 </div>
                 <div class="icon-circle bg-white-10">
                     <i class="fas fa-users text-white"></i>
                 </div>
             </div>
             <div class="mt-3">
                 <span class="text-white-50"><i class="fas fa-arrow-up me-1"></i> 1% from last month</span>
             </div>
         </div>
     </div>

     {{-- sales --}}
     <div class="col-xl-3 col-md-6 mb-4">
         <div class="stat-card yellow p-4 rounded-3 h-100">
             <div class="d-flex justify-content-between align-items-center">
                 <div>
                     <h6 class="text-uppercase mb-1">Total Sales</h6>
                     <h3 class="mb-0">{{ $users }}</h3>
                 </div>
                 <div class="icon-circle bg-white-10">
                     <i class="fas fa-shopping-cart fa-2x text-white"></i>
                 </div>
             </div>
             <div class="mt-3">
                 <span class="text-white-50"><i class="fas fa-arrow-up me-1"></i> 12% from last month</span>
             </div>
         </div>
     </div>

     {{-- Profit --}}
     <div class="col-xl-3 col-md-6 mb-4">
         <div class="stat-card blue p-4 rounded-3 h-100">
             <div class="d-flex justify-content-between align-items-center">
                 <div>
                     <h6 class="text-uppercase mb-1">Profit</h6>
                     <h3 class="mb-0">0</h3>
                 </div>
                 <div class="icon-circle bg-white-10">
                     <i class="fas fa-dollar-sign fa-2x text-warning"></i>
                 </div>
             </div>
             <div class="mt-3">
                 <span class="text-white-50"><i class="fas fa-arrow-up me-1"></i> 12% from last month</span>
             </div>
         </div>
     </div>

     {{-- Loss --}}
     <div class="col-xl-3 col-md-6 mb-4">
         <div class="stat-card yellow p-4 rounded-3 h-100">
             <div class="d-flex justify-content-between align-items-center">
                 <div>
                     <h6 class="text-uppercase mb-1">Loss</h6>
                     <h3 class="mb-0">0</h3>
                 </div>
                 <div class="icon-circle bg-white-10">
                     <i class="fas fa-chart-bar fa-2x text-danger"></i>
                 </div>
             </div>
             <div class="mt-3">
                 <span class="text-white-50"><i class="fas fa-arrow-up me-1"></i> 12% from last month</span>
             </div>
         </div>
     </div>
 </div>

 <!-- Stats Cards -->
 <div class="row">
     <div class="col-xl-3 col-md-6 mb-4">
         <div class="stat-card blue p-4 rounded-3 h-100">
             <div class="d-flex justify-content-between align-items-center">
                 <div>
                     <h6 class="text-uppercase mb-1">Workers</h6>
                     <h3 class="mb-0">{{ $users }}</h3>
                 </div>
                 <div class="icon-circle bg-white-10">
                     <i class="fas fa-users fa-2x text-white"></i>
                 </div>
             </div>
             <div class="mt-3">
                 <span class="text-white-50"><i class="fas fa-arrow-up me-1"></i> 1% toka mwezi uliopita</span>
             </div>
         </div>
     </div>


     {{-- church --}}

     <div class="col-xl-3 col-md-6 mb-4">
         <div class="stat-card yellow p-4 rounded-3 h-100">
             <div class="d-flex justify-content-between align-items-center">
                 <div>
                     <h6 class="text-uppercase mb-1">Bidhaa</h6>
                     <h3 class="mb-0">{{ $products }}</h3>

                 </div>
                 <div class="icon-circle bg-white-10">
                     <i class="fas fa-box-open fa-2x text-success mb-3"></i>
                 </div>
             </div>
             <div class="mt-3">
                 <span class="text-white-50"><i class="fas fa-arrow-up me-1"></i> 8% toka mwezi jana</span>
             </div>
         </div>
     </div>

        {{-- Supplier --}}
     <div class="col-xl-3 col-md-6 mb-4">
         <div class="stat-card blue p-4 rounded-3 h-100">
             <div class="d-flex justify-content-between align-items-center">
                 <div>
                     <h6 class="text-uppercase mb-1">Supplier</h6>
                     <h3 class="mb-0">0</h3>
                 </div>
                 <div class="icon-circle bg-white-10">
                     <i class="fas fa-truck fa-2x text-warning"></i>
                 </div>
             </div>
             <div class="mt-3">
                 <span class="text-white-50"><i class="fas fa-arrow-up me-1"></i> 12% from last month</span>
             </div>
         </div>
     </div>

     {{-- Customers --}}
     <div class="col-xl-3 col-md-6 mb-4">
         <div class="stat-card yellow p-4 rounded-3 h-100">
             <div class="d-flex justify-content-between align-items-center">
                 <div>
                     <h6 class="text-uppercase mb-1">Customers</h6>
                     <h3 class="mb-0">0</h3>
                 </div>
                 <div class="icon-circle bg-white-10">
                     <i class="fas fa-user-friends fa-2x text-primary"></i>
                 </div>
             </div>
             <div class="mt-3">
                 <span class="text-white-50"><i class="fas fa-arrow-up me-1"></i> 12% from last month</span>
             </div>
         </div>
     </div>
 </div>

 {{--  --}}
 <div class="row">
     <div class="col-xl-3 col-md-6 mb-4">
         <div class="stat-card blue p-4 rounded-3 h-100">
             <div class="d-flex justify-content-between align-items-center">
                 <div>
                     <h6 class="text-uppercase mb-1">Expenses</h6>
                     <h3 class="mb-0">{{ $users }}</h3>
                 </div>
                 <div class="icon-circle bg-white-10">
                     <i class="fas fa-money-bill-wave fa-2x text-white"></i>
                 </div>
             </div>
             <div class="mt-3">
                 <span class="text-white-50"><i class="fas fa-arrow-up me-1"></i> 1% toka mwezi uliopita</span>
             </div>
         </div>
     </div>


     {{-- church --}}

     <div class="col-xl-3 col-md-6 mb-4">
         <div class="stat-card yellow p-4 rounded-3 h-100">
             <div class="d-flex justify-content-between align-items-center">
                 <div>
                     <h6 class="text-uppercase mb-1">Stock</h6>
                     <h3 class="mb-0">{{ $products }}</h3>

                 </div>
                 <div class="icon-circle bg-white-10">
                     <i class="fas fa-warehouse fa-2x text-success mb-3"></i>
                 </div>
             </div>
             <div class="mt-3">
                 <span class="text-white-50"><i class="fas fa-arrow-up me-1"></i> 2% toka mwezi jana</span>
             </div>
         </div>
     </div>
     <div class="col-xl-3 col-md-6 mb-4">
         <div class="stat-card blue p-4 rounded-3 h-100">
             <div class="d-flex justify-content-between align-items-center">
                 <div>
                     <h6 class="text-uppercase mb-1">Stock Value</h6>
                     <h3 class="mb-0">{{ $products }}</h3>

                 </div>
                 <div class="icon-circle bg-white-10">
                     <i class="fas fa-chart-line fa-2x text-gray-700 mb-3"></i>
                 </div>
             </div>
             <div class="mt-3">
                 <span class="text-white-50"><i class="fas fa-arrow-up me-1"></i> 2% toka mwezi jana</span>
             </div>
         </div>
     </div>
 </div>
