 <!-- ======= Sidebar ======= -->


 <aside id="sidebar" class="sidebar">


    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-heading">Admin</li>

      
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ ('home') }}">
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
            <a href="{{ route('datapeminjam') }}">
              <i class="bi bi-circle"></i><span>Data Peminjam</span>
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


      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('login') }}">
          <i class="bi bi-box-arrow-in-right"></i>
          <!-- href-->
          <span>Log out</span>
        </a>
      </li><!-- End Login Page Nav -->

    </ul>


    <!--TAMPILAN SIDE BAR USER-->

    <ul class="sidebar-nav" id="sidebar-nav">
      <li class="nav-heading">User</li>

    </li><!-- End Dashboard Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ route('informasisaranauser') }}">
        </i><span>Informasi Sarana User</span>
      </a>
      
    </li><!-- End masterdataNav -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ route('transaksiuser') }}">
        </i><span>Transaksi User</span>
      </a>
      
    </li><!-- End Transaksi admin Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ route('login') }}">
        <i class="bi bi-box-arrow-in-right"></i>
        <!-- href-->
        <span>Log out User</span>
      </a>
    </li><!-- End Login Page Nav -->

  </ul>

  </aside><!-- End Sidebar-->