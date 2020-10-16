<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

</nav>



  
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link">
      <img src="{{ asset('public/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">TB-Delima</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('public/img/sistem/user.png') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Masterisasi
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('profil-toko') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Profil Toko</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('banner') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Banner</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('logo-merek') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Logo Merek</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="{{ route('pelanggan') }}" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>Pelanggan</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('kategori') }}" class="nav-link">
              <i class="nav-icon fas fa-tag"></i>
              <p>Kategori</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('produk') }}" class="nav-link">
              <i class="nav-icon fas fa-list"></i>
              <p>Produk</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('transaksi-masuk') }}" class="nav-link">
              <i class="nav-icon fas fa-shopping-cart"></i>
              <p>Transaksi Masuk <span class="badge badge-danger right" id="counttransaksimasuk"></span></p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('transaksi-proses') }}" class="nav-link">
              <i class="nav-icon fas fa-shopping-cart"></i>
              <p>Transaksi Proses <span class="badge badge-info right" id="counttransaksiproses"></span></p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('transaksi-kirim') }}" class="nav-link">
              <i class="nav-icon fas fa-shopping-cart"></i>
              <p>Transaksi Kirim <span class="badge badge-success right" id="counttransaksikirim"></span></p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('akun') }}" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>Akun</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>  
            <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>Logout</p>
            </a>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
