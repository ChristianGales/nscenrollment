{{-- admin sidebar --}}
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2 bg-white my-2" id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand d-flex align-items-center px-4 py-3 m-0">
            <img src="{{ asset('img/logo.png') }}" class="navbar-brand-img me-2" width="26" height="26" alt="main_logo">
            <span class="text-sm text-dark">NSC Enrollment System</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0 mb-2">
    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
        
            {{-- Admin Links --}}
            @if (Auth::user()->usertype == 'admin')

                {{-- Admin Dashboard --}}
                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs text-dark font-weight-bolder opacity-5">Dashboard</h6>
                </li>

                {{-- <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.enrollment') ? 'active bg-gradient-dark text-white' : 'text-dark' }}" href="{{ route('admin.enrollment') }}">
                        <i class="material-symbols-rounded opacity-5">table_view</i>
                        <span class="nav-link-text ms-1">Enrollment</span>
                    </a>
                </li> --}}
                {{-- <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active bg-gradient-dark text-white' : 'text-dark' }}" href="{{ route('admin.dashboard') }}">
                        <i class="material-symbols-rounded opacity-5">dashboard</i>
                        <span class="nav-link-text ms-1">Enrollments</span>
                    </a>
                </li> --}}
                {{-- <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.enrollment') ? 'active bg-gradient-dark text-white' : 'text-dark' }}" href="../pages/dashboard-t.html">
                        <i class="material-symbols-rounded opacity-5">table_view</i>
                        <span class="nav-link-text ms-1">Enrollment</span>
                    </a>
                </li> --}}
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.student.index') ? 'active bg-gradient-dark text-white' : 'text-dark' }}" href="{{route ('admin.student.index')}}">
                        <i class="material-symbols-rounded opacity-5">supervisor_account</i>
                        <span class="nav-link-text ms-1">Students</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.subject.index.') ? 'active bg-gradient-dark text-white' : 'text-dark' }}" href="{{route ('admin.subject.index') }}">
                        <i class="material-symbols-rounded opacity-5">receipt_long</i>
                        <span class="nav-link-text ms-1">Subjects</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.section.index') ? 'active bg-gradient-dark text-white' : 'text-dark' }}" href="{{ route('admin.section.index') }}">
                        <i class="material-symbols-rounded opacity-5">groups</i>
                        <span class="nav-link-text ms-1">Section</span>
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.schedule') ? 'active bg-gradient-dark text-white' : 'text-dark' }}" href="../pages/dashboard-t.html">
                        <i class="material-symbols-rounded opacity-5">calendar_month</i>
                        <span class="nav-link-text ms-1">Schedule</span>
                    </a>
                </li> --}}
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.teacher.index') ? 'active bg-gradient-dark text-white' : 'text-dark' }}" href="{{ route('admin.teacher.index') }}">
                        <i class="material-symbols-rounded opacity-5">manage_accounts</i>
                        <span class="nav-link-text ms-1">Teacher</span>
                    </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link {{ request()->routeIs('admin.grade.index') ? 'active bg-gradient-dark text-white' : 'text-dark' }}" href="{{ route('admin.grade.index') }}">
                      <i class="material-symbols-rounded opacity-5">signal_cellular_alt</i>
                      <span class="nav-link-text ms-1">Grade Level</span>
                  </a>
              </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.year.index') ? 'active bg-gradient-dark text-white' : 'text-dark' }}" href="{{ route('admin.year.index') }}">
                        <i class="material-symbols-rounded opacity-5">calendar_clock</i>
                        <span class="nav-link-text ms-1">Academic Year</span>
                    </a>
                </li>

            @endif

           {{-- User Links --}}
            @if (Auth::user()->usertype == 'user')

            {{-- <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('dashboard') ? 'active bg-gradient-dark text-white' : 'text-dark' }}" href="{{ route('dashboard') }}">
                    <i class="material-symbols-rounded opacity-5">dashboard</i>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li> --}}

            <li class="nav-item">
                <a class="nav-link {{ request()->is('schedule.index') ? 'active bg-gradient-dark text-white' : 'text-dark' }}" href="{{route ('schedule.index')}}">
                    <i class="material-symbols-rounded opacity-5">calendar_month</i>
                    <span class="nav-link-text ms-1">Schedule</span>
                </a>
            </li>
        
            @endif

            {{-- Account Section --}}
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-dark font-weight-bolder opacity-5">Account Pages</h6>
            </li>

            {{-- <li class="nav-item">
                <a class="nav-link text-dark" href="{{ route('profile.edit') }}">
                    <i class="material-symbols-rounded opacity-5">person</i>
                    <span class="nav-link-text ms-1">Profile</span>
                </a>
            </li> --}}
          
            <li class="nav-item">
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <a class="nav-link text-dark" href="#" onclick="event.preventDefault(); this.closest('form').submit();">
                        <i class="material-symbols-rounded opacity-5">logout</i>
                        <span class="nav-link-text ms-1">Log Out</span>
                    </a>
                </form>
            </li>
        </ul>
    </div>
</aside>



