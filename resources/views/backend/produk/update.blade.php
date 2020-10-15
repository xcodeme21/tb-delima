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
            <h1 class="m-0 text-dark">Produk</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('produk') }}">Utama</a></li>
              <li class="breadcrumb-item active">Update Produk</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">

                {{ Form::open(['route'=>'edit-produk' ,'method' => 'post', 'class'=>'form-horizontal mt-3  animated bounceIn','enctype'=>'multipart/form-data']) }} 
                {{ Form::token() }}
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Nama Produk</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-line" name="nama_produk" value="{{ @$rs->nama_produk }}" placeholder="Nama Produk" required>
                            <input type="hidden" name="id" value="{{ @$rs->id }}" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Kategori</label>
                        <div class="col-sm-9">
                        {{ Form::select('kategori_id', @$kategori_id,@$rs->kategori_id, ['class'=>'form-control form-control-line select2 select2-danger', 'data-dropdown-css-class'=>'select2-danger', 'style'=>'width: 100%;', 'required']) }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Keterangan</label>
                        <div class="col-sm-9">
                            <textarea class="form-control form-control-line textarea" name="keterangan_produk" placeholder="Keterangan" required>{{ @$rs->keterangan_produk }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Harga</label>
                        <div class="col-sm-9">
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <button type="button" class="btn btn-info">Rp.</button>
                            </div>
                            <input type="text" class="form-control form-control-line" id="rupiah" name="harga" value="{{ number_format(@$rs->harga,0,',','.')}}" placeholder="0" required">
                          </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Foto</label>
                        <div class="col-sm-9">
                            <input type="file" class="form-control form-control-line" name="foto_produk" placeholder="Foto">
                            @if(@$rs->stok != null)
                            <br>
                            <img src="{{ asset('public/img/produk/'.@$rs->foto_produk) }}"/>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Stok</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control form-control-line" name="stok" value="{{ @$rs->stok }}" placeholder="Stok" required>
                        </div>
                    </div>
                    <div class="form-group row-fluid" align="right">
                        <a href="{{ route('produk') }}" class="btn btn-info btn-sm"><i class="fa fa-arrow-left fa-fw"></i> Kembali</a>
                        <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save fa-fw"></i> Update</button>
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
