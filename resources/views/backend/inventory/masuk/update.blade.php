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
            <h1 class="m-0 text-dark">Barang Masuk</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('barang-masuk') }}">Utama</a></li>
              <li class="breadcrumb-item active">Update Barang Masuk</li>
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

                {{ Form::open(['route'=>'edit-barang-masuk' ,'method' => 'post', 'class'=>'form-horizontal mt-3  animated bounceIn','enctype'=>'multipart/form-data']) }} 
                {{ Form::token() }}
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Distributor</label>
                        <div class="col-sm-9">
                        {{ Form::select('distributor_id', @$distributor_id,@$rs->distributor_id, ['class'=>'form-control form-control-line select2 select2-danger', 'data-dropdown-css-class'=>'select2-danger', 'style'=>'width: 100%;', 'required']) }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">No. Invoice</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-line" name="no_invoice" placeholder="No. Invoice" value="{{ @$rs->no_invoice }}" required>
                            <input type="hidden" name="id" value="{{ @$rs->id }}" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Tgl. Invoice</label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control form-control-line" name="tanggal_invoice" placeholder="Tgl. Invoice" value="{{ @$rs->tanggal_invoice }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Cost</label>
                        <div class="col-sm-9">
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <button type="button" class="btn btn-info">Rp.</button>
                            </div>
                            <input type="text" class="form-control form-control-line" id="rupiah" name="cost" value="{{ number_format(@$rs->cost,0,',','.')}}" placeholder="0" required>
                          </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Gambar Invoice</label>
                        <div class="col-sm-9">
                            <input type="file" class="form-control form-control-line" name="gambar_invoice" placeholder="Gambar Invoice">
                            @if(@$rs->gambar_invoice != null)
                            <br>
                            <a href="{{ asset('public/img/inventory/'.@$rs->gambar_invoice) }}" target="_blank"><img src="{{ asset('public/img/inventory/'.@$rs->gambar_invoice) }}" width="250" /></a>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row-fluid" align="right">
                        <a href="{{ route('barang-masuk') }}" class="btn btn-info btn-sm"><i class="fa fa-arrow-left fa-fw"></i> Kembali</a>
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
