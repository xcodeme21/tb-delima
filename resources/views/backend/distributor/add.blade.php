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
            <h1 class="m-0 text-dark">Distributor</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('distributor') }}">Utama</a></li>
              <li class="breadcrumb-item active">Tambah Distributor</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            @include('flash::message')
            <div class="card">
              <div class="card-body">
                {{ Form::open(['route'=>'tambah-distributor' ,'method' => 'post', 'class'=>'form-horizontal mt-3  animated bounceIn','enctype'=>'multipart/form-data']) }} 
                {{ Form::token() }}
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Nama</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-line" name="nama" placeholder="Nama" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Email</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control form-control-line" name="email" placeholder="Email" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Telepon</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-line" name="telepon" placeholder="Telepon" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Alamat</label>
                        <div class="col-sm-9">
                            <textarea class="form-control form-control-line" name="alamat" placeholder="Alamat" required></textarea>
                        </div>
                    </div>
                    <div class="form-group row-fluid" align="right">
                        <a href="{{ route('distributor') }}" class="btn btn-info btn-sm"><i class="fa fa-arrow-left fa-fw"></i> Kembali</a>
                        <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save fa-fw"></i> Simpan</button>
                    </div>
                {{ Form::close() }}
                
              </div>
            </div>
          </div>

        </div>
    </section>
  </div>
  
  @include("backend.include.footer")


</div>

@include("backend.include.script")


</body>
</html>
