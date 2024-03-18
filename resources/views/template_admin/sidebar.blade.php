 <!-- ======= Sidebar ======= -->


 <aside id="sidebar" class="sidebar">


    <ul class="sidebar-nav" id="sidebar-nav">
      @if (Str::length(Auth::guard('admin')->user()) > 0)
        <li class="nav-heading">Admin</li>

      
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('dashboard') }}">
          <i class="bi bi-box-arrow-in-right"></i>
          <!-- href-->
          <span>Dashboard</span>
        </a>
      </li><!-- End Login Page Nav -->

      </li><!-- End masterdataNav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-archive"></i><span>Master Data</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ route('datasarana') }}">
              <i class="bi bi-circle"></i><span>Data Sarana</span>
            </a>
          </li>
          <li>
            <a href="{{ route('dataterdaftar') }}">
              <i class="bi bi-circle"></i><span>Data Pengguna</span>
            </a>
          </li>
        </ul>
      </li><!-- End masterdataNav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-arrow-left-right"></i><span>Transaksi</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ route('transaksipeminjaman') }}">
              <i class="bi bi-circle"></i><span>Peminjaman</span>
            </a>
          </li>
          <li>
            <a href="{{ route('transaksipengembalian') }}">
              <i class="bi bi-circle"></i><span>Pengembalian</span>
            </a>
          </li>
        </ul>
      </li><!-- End Transaksi admin Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-file-earmark-text"><span></i>Laporan</span><i class="bi bi-chevron-down ms-auto"></i>
          
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ route('laporanpeminjaman') }}">
              <i class="bi bi-circle"></i><span>Lap.Peminjaman</span>
            </a>
          </li>
          <li>
            <a href="{{ route('laporanpengembalian') }}">
              <i class="bi bi-circle"></i><span>Lap.Pengembalian</span>
            </a>
          </li>
        </ul>
      </li><!-- End Laporan  Nav -->


      {{-- <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('login') }}">
          <i class="bi bi-box-arrow-in-right"></i>
          <!-- href-->
          <span>Log out</span>
        </a>
      </li><!-- End Login Page Nav --> --}}

    </ul>


    <!--TAMPILAN SIDE BAR USER-->

    <ul class="sidebar-nav" id="sidebar-nav">
      @elseif (Str::length(Auth::guard('web')->user()) > 0)
      <li class="nav-heading">User</li>

    </li><!-- End Dashboard Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ route('informasisaranauser') }}">
        </i><span>Informasi Sarana</span>
      </a>
      
    </li><!-- End masterdataNav -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ route('transaksiuser') }}">
        </i><span>Transaksi Pengguna</span>
      </a>
      
    </li><!-- End Transaksi admin Nav -->

    
    @endif
    <li class="nav-item">
      <!-- Button trigger modal -->
      <button type="button" class="nav-link collapsed" data-bs-toggle="modal" data-bs-target="#logoutModal">
          <i class="bi bi-box-arrow-in-right"></i>
          <span>Log out</span>
      </button>
    </li>
    <!-- End Login Page Nav -->
  </ul>

  </aside><!-- End Sidebar-->