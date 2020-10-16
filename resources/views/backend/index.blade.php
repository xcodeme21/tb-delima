<!DOCTYPE html>
<html>
@include("backend.include.head")
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
@include("backend.include.nav")

  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
              <!-- <li class="breadcrumb-item active">Dashboard v1</li> -->
            </ol>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">
        @include('flash::message')
        <div class="row">
          <div class="col-lg-4 col-12">
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ @$totalpelanggan }}</h3>

                <p>Pelanggan</p>
              </div>
              <div class="icon">
                <i class="fas fa-users"></i>
              </div>
              <a href="{{ route('pelanggan') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          
          <div class="col-lg-4 col-12">
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{ @$totalkategori }}</h3>

                <p>Kategori</p>
              </div>
              <div class="icon">
                <i class="fas fa-tag"></i>
              </div>
              <a href="{{ route('kategori') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-12">
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{ @$totalproduk }}</h3>

                <p>Produk</p>
              </div>
              <div class="icon">
                <i class="fas fa-list"></i>
              </div>
              <a href="{{ route('produk') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
  
        </div>
    </section>




    <!-- <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <canvas id="dw-chart"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section> -->



  </div>
  
  @include("backend.include.footer")


</div>

@include("backend.include.script")

</body>
</html>
