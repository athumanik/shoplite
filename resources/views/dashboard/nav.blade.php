 <!-- Navbar -->
 <nav id="navbar" class="navbar navbar-expand-lg">
     <div class="container-fluid">
         <button class="btn btn-outline-secondary d-md-none" id="mobileSidebarToggle">
             <i class="fas fa-bars"></i>
         </button>

         <div class="d-flex align-items-center ms-auto">
             <div class="dropdown">
                 <a class="dropdown-toggle d-flex align-items-center" href="#" role="button" id="profileDropdown"
                     data-bs-toggle="dropdown" aria-expanded="false">
                     <img src="{{ asset('storage/img/fav.png') }}" class="profile-img me-2" alt="Profile">
                     {{-- <span class="d-none d-md-inline">Admin User</span> --}}
                 </a>
                 <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                     <li><a class="dropdown-item" href="{{ route('profile.show') }}"><i
                                 class="fas fa-user me-2"></i>Profile</a></li>
                     {{-- <li><a class="dropdown-item" href="{{route('')}}"><i class="fas fa-cog me-2"></i>Settings</a></li> --}}
                     <li>
                         <hr class="dropdown-divider">
                     </li>
                     <li>
                         <!-- Authentication -->
                         <form method="POST" action="{{ route('logout') }}" x-data>
                             @csrf
                             <a class="dropdown-item" href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                 <i class="fas fa-sign-out-alt me-2"></i> {{ __('Logout') }}
                             </a>
                         </form>
                     </li>
{{--  --}}
                 </ul>
             </div>
         </div>
     </div>
 </nav>
