  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">SIMPANSARANA</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">
        <li class="nav-item dropdown">
          <li>
            <hr class="dropdown-divider">
          </li>
        </li>
        <li class="nav-item dropdown pe-3">

          <!-- Proses menberi tautan ke profil pengguna --> 
          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            @if (Str::length(Auth::guard('admin')->user()) > 0) <!--otoritas autenticate milik admin -->
            <img src="{{ asset('assets/img/profile.png') }}" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user()->nama}}</span> <!--menampilkan nama pengguna sesuai autentifikasinya-->
            @elseif (Str::length(Auth::guard('web')->user()) > 0) <!--kondisional bila kondisei sebelum tidak dipenuhi maka ini di cek-->
            <img src="{{ asset('assets/img/profile.png') }}" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user()->nama}}</span>
            @endif
          </a>

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              @if (Str::length(Auth::guard('admin')->user()) > 0)
              <h6>{{ Auth::user()->nama}}</h6>
              
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{ route('profiladmin') }}">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>

            @elseif (Str::length(Auth::guard('web')->user()) > 0)
              <h6>{{ Auth::user()->nama}}</h6>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{ route('profiluser') }}">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>  

            @endif
            <li>
              <hr class="dropdown-divider">
            </li>


            <li>
                <!-- Button trigger modal -->
                <button type="button" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#logoutModal">
                  <!-- data-bs-toggle modal = jika tombol di klik akan muncul modal atau pop up || Edit modal di layout app_admin-->
                  <i class="bi bi-box-arrow-right"></i> <!--icon logout-->  
                  <span>Log Out</span>
                </button>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->