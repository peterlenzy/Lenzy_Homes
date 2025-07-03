<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="author" content="Codescandy">
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-M8S4MT3EYG"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'G-M8S4MT3EYG');
  </script>
  <link rel="shortcut icon" type="image/x-icon" href="{{ asset('build/assets/images/brand/logo/home logo.png') }}">
  <link href="../build/assets/libs/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link href="../build/assets/libs/%40mdi/font/css/materialdesignicons.min.css" rel="stylesheet">
  <link href="../build/assets/libs/simplebar/dist/simplebar.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../build/assets/css/theme.min.css">
  <title>Lenzy Homes App</title>
</head>
<body>
  <main id="main-wrapper" class="main-wrapper">
    <div class="header">
      <div class="navbar-custom navbar navbar-expand-lg">
        <div class="container-fluid px-0">
          <a class="navbar-brand d-block d-md-none" href="#">
            <img src="{{ asset('assets/images/brand/logo/home logo.png')}}" alt="Image">
          </a>
          <a id="nav-toggle" href="#!" class="ms-auto ms-md-0 me-0 me-lg-3 ">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-text-indent-left text-muted" viewBox="0 0 16 16">
              <path d="M2 3.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm.646 2.146a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1 0 .708l-2 2a.5.5 0 0 1-.708-.708L4.293 8 2.646 6.354a.5.5 0 0 1 0-.708zM7 6.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 3a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm-5 3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z"/>
            </svg>
          </a>
          <div class="d-none d-md-none d-lg-block">
            <form action="#">
              <div class="input-group ">
                <input class="form-control rounded-3" type="search" value="" id="searchInput" placeholder="Search">
                <span class="input-group-append">
                  <button class="btn ms-n10 rounded-0 rounded-end" type="button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search text-dark">
                      <circle cx="11" cy="11" r="8"></circle>
                      <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                  </button>
                </span>
              </div>
            </form>
          </div>
          <ul class="navbar-nav navbar-right-wrap ms-lg-auto d-flex nav-top-wrap align-items-center ms-4 ms-lg-0 g-6">
            <a href="{{route('houses.index')}}" class="btn btn-outline-info" role="button">Home</a>
            @auth
            @if(auth()->user()->role === 'admin')
            <a href="{{route('houses.create')}}" class="btn btn-outline-primary" role="button">Add Houses</a>
            <a href="{{route('users.create')}}" class="btn btn-outline-primary" role="button">Add Users</a>
            @endif
            @endauth
            <a href="#" class="form-check form-switch theme-switch btn btn-ghost btn-icon rounded-circle mb-0 ">
              <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
              <label class="form-check-label" for="flexSwitchCheckDefault"></label>
            </a>
            <li class="dropdown  ms-2">
              <a class="btn btn-ghost btn-icon rounded-circle" href="#!" role="button" id="dropdownNotification" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="icon-xs" data-feather="bell"></i>
              </a>
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end" aria-labelledby="dropdownNotification">
                <div>
                  <div class="border-bottom px-3 pt-2 pb-3 d-flex justify-content-between align-items-center">
                    <p class="mb-0 text-dark fw-medium fs-4">Notifications</p>
                    <a href="#!" class="text-muted">
                      <span>
                        <i class="me-1 icon-xs" data-feather="settings"></i>
                      </span>
                    </a>
                  </div>
                  <div data-simplebar style="height: 250px;">
                    <ul class="list-group list-group-flush notification-list-scroll">
                      <li class="list-group-item bg-light">
                        <a href="#!" class="text-muted">
                          <h5 class=" mb-1">Edwin Mutua</h5>
                          <p class="mb-0">Mauris blandit erat id nunc blandit, ac eleifend dolor pretium.</p>
                        </a>
                      </li>
                      <li class="list-group-item">
                        <a href="#!" class="text-muted">
                          <h5 class=" mb-1">Neha Kannned</h5>
                          <p class="mb-0">Proin at elit vel est condimentum elementum id in ante. Maecenas et sapien metus.</p>
                        </a>
                      </li>
                      <li class="list-group-item">
                        <a href="#!" class="text-muted">
                          <h5 class=" mb-1">Nirmala Chauhan</h5>
                          <p class="mb-0">Morbi maximus urna lobortis elit sollicitudin sollicitudieget elit vel pretium.</p>
                        </a>
                      </li>
                      <li class="list-group-item">
                        <a href="#!" class="text-muted">
                          <h5 class=" mb-1">Sina Ray</h5>
                          <p class="mb-0">Sed aliquam augue sit amet mauris volutpat hendrerit sed nunc eu diam.</p>
                        </a>
                      </li>
                    </ul>
                  </div>
                  <div class="border-top px-3 py-2 text-center">
                    <a href="#!" class="text-inherit">View all Notifications</a>
                  </div>
                </div>
              </div>
            </li>
            <li class="dropdown ms-2">
              <a class="rounded-circle" href="#!" role="button" id="dropdownUser" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="avatar avatar-md avatar-indicators avatar-online">
                    @php
                    $user=Auth::user();
                    @endphp
                 <img class="rounded-circle" id="profile-image-{{ $user->id }}" src="{{  asset($user->img_path) }}" alt="profile Image"data-user-id="{{ $user->id }}">
                </div>
              </a>
              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownUser">
                <div class="px-4 pb-0 pt-2">
                  <div class="lh-1">
                    <h5 class="mb-1">Peter Lenzy</h5>
                    <a href="{{ route('profile.edit') }}" class="text-inherit fs-6">View my profile</a>
                  </div>
                  <div class="dropdown-divider mt-3 mb-2"></div>
                </div>
                <ul class="list-unstyled">
                  <li>
                    <a class="dropdown-item d-flex align-items-center" href="{{ route('profile.edit') }}">
                      <i class="me-2 icon-xxs dropdown-item-icon" data-feather="user"></i>Edit Profile
                    </a>
                  </li>
                   <li>
                    <form method="POST" action="{{route('logout')}}">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger d-flex align-items-center">
                            <i class="me-2 icon-xxs dropdown-item-icon" data-feather="log-out"></i>Sign Out
                        </button>
                    </form>
                </li>
                </ul>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="navbar-vertical navbar nav-dashboard">
      <div class="h-100" data-simplebar>
        <a class="navbar-brand" href="#">
          <img src="{{ asset('build/assets/images/smarthome.png')}}" alt="Lenzy Homes logo">
        </a>
        <ul class="navbar-nav flex-column" id="sideNavbar">
          <li class="nav-item">
            <div class="navbar-heading">Lenzy Homes App</div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('houses.index') }}">
              <i data-feather="home" class="nav-icon me-2 icon-xxs"></i> View Houses
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/aboutus">
              <i data-feather="info" class="nav-icon me-2 icon-xxs"></i> About Us
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/contactus">
              <i data-feather="phone" class="nav-icon me-2 icon-xxs"></i> Contact Us
            </a>
          </li>
          @auth
          @if(auth()->user()->role === 'admin')
          <li class="nav-item">
            <a class="nav-link collapsed" href="#!" data-bs-toggle="collapse" data-bs-target="#navinvoice" aria-expanded="false" aria-controls="navinvoice">
              <i data-feather="settings" class="nav-icon me-2 icon-xxs"></i>Management Configurations
            </a>
            <div id="navinvoice" class="collapse" data-bs-parent="#sideNavbar">
              <ul class="nav flex-column">
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('houses.index') }}">House Management</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('users.index') }}">Users Management</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('payments.index') }}">Payments Management</a>
                </li>

              </ul>
            </div>
          </li>
          @endauth
          @endif
        </ul>
      </div>
    </div>
    <div class="main-content" id="mainContent">
      <div class="container-fluid">
        @yield('content')
      </div>
    </div>
  </main>
  <style>
    .navbar-vertical {
      position: left;
      top: 0;
      left: 0;
      height: 100%;
      z-index: 1000;
    }
    .main-content {
      /* margin-right: 260px; */
      padding: 80px 20px 60px 20px;
      min-height: calc(100vh - 60px);
    }
    body {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }
    footer {
      position: fixed;
      bottom: 0;
      left: 0;
      width: 100%;
      background-color: rgb(249, 248, 250);
      text-align: center;
      padding: 1rem;
      border-top: 1px solid #dee2e6;
      z-index: 1000;
    }
  </style>
  <footer class="fixed bottom-0 left-0 w-full py-4 bg-white dark:bg-gray-800 text-center text-sm text-black dark:text-white/70 border-t">
    <strong>© {{ date('Y') }} Lenzy Homes App.</strong> All rights reserved.
  </footer>
  <script src="../build/assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../build/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../build/assets/libs/feather-icons/dist/feather.min.js"></script>
  <script src="../build/assets/libs/simplebar/dist/simplebar.min.js"></script>
  <script src="../build/assets/js/theme.min.js"></script>
</body>
</html>
