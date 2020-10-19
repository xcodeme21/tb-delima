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
            <h1 class="m-0 text-dark">Barang Keluar</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('barang-keluar') }}">Utama</a></li>
              <li class="breadcrumb-item active">Detail Barang Keluar</li>
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
                <div class="row-fluid" align="right">
                    <a href="{{ route('barang-keluar') }}" class="btn btn-info btn-sm"><i class="fa fa-arrow-left"></i> Kembali</a>
                </div>
                <hr>

                {{ Form::open(['class'=>'form-horizontal mt-3  animated bounceIn','enctype'=>'multipart/form-data']) }} 
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Nama Distributor</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-line" name="nama" placeholder="No. Invoice" value="{{ @$rs->nama }}" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">No. Invoice</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-line" name="no_invoice" placeholder="No. Invoice" value="{{ @$rs->no_invoice }}" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Tgl. Invoice</label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control form-control-line" name="tanggal_invoice" placeholder="Tgl. Invoice" value="{{ @$rs->tanggal_invoice }}" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Cost</label>
                        <div class="col-sm-9">
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <button type="button" class="btn btn-info">Rp.</button>
                            </div>
                            <input type="text" class="form-control form-control-line" id="rupiah" name="cost" value="{{ number_format(@$rs->cost,0,',','.')}}" placeholder="0" disabled>
                          </div>
                        </div>
                    </div>
                  </form>
                
              </div>
            </div>
          </div>

        </div>



        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <div class="row-fluid" align="center">
                  <h3>Detail Produk</h3>
                </div>
                <hr>
                <div class="row-fluid" align="right">
                  <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-success"><i class="fa fa-plus fa-fw"></i> Tambah Produk</button>

                  <div class="modal fade" id="modal-success">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content bg-success">
                        <div class="modal-header">
                          <h4 class="modal-title"><i class="fa fa-plus fa-fw"></i> Tambah Produk</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        </div>
                        {{ Form::open(['route'=>'tambah-detail-barang-keluar' ,'method' => 'post', 'class'=>'form-horizontal mt-3  animated bounceIn','enctype'=>'multipart/form-data']) }} 
                        {{ Form::token() }}
                        <div class="modal-body" align="left">
                          <div class="form-group row">
                              <label for="fname" class="col-sm-3 text-right control-label col-form-label">Produk</label>
                              <div class="col-sm-9">
                              <select class="form-control form-control-line select2 select2-danger" name="produk_id" required>
                                <option value="" selected>-- Pilih produk --</option>
                                @foreach(@$arrayproduk as $arpro)
                                <option value="{{ @$arpro->id }}">{{ @$arpro->nama_produk }} || Rp. {{ number_format(@$arpro->harga,0,',','.')}} || Stok : {{ @$arpro->stok }}</option>
                                @endforeach
                              </select>
                              <input type="hidden" name="inventory_id" value="{{ @$rs->id }}" />
                              <input type="hidden" name="distributor_id" value="{{ @$rs->distributor_id }}" />
                              </div>
                          </div>
                          <div class="form-group row">
                              <label for="fname" class="col-sm-3 text-right control-label col-form-label">Jumlah</label>
                              <div class="col-sm-9">
                              <input type="number" class="form-control form-control-line" name="jumlah" placeholder="Masukkan jumlah barang" required>
                              </div>
                          </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                          <button type="button" class="btn btn-outline-light" data-dismiss="modal">Batal</button>
                          <button type="submit" class="btn btn-outline-light">Simpan</button>
                        </div>
                        {{ Form::close() }}
                      </div>
                    </div>
                  </div>

                </div>
                <hr>
                <table class="table table-condensed display" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th class="bg-th">No</th>  
                            <th class="bg-th">Nama Produk</th>
                            <th class="bg-th">Harga Satuan</th>
                            <th class="bg-th">Jumlah</th>
                            <th class="bg-th">Harga Total</th>
                            <th class="bg-th">Action</th>
                        </tr>
                    </thead>
                    <tbody>  
                      <?php $no=0; ?>
                      @foreach(@$detail as $det)
                      <?php $no++; ?>
                        <tr>
                          <td>{{ @$no }}</td>
                          <td>{{ @$det->nama_produk }}</td>
                          <td>Rp. {{ number_format(@$det->harga_satuan,0,',','.')}}</td>
                          <td>{{ @$det->jumlah }}</td>
                          <td>Rp. {{ number_format(@$det->harga_per_produk,0,',','.')}}</td>
                          <td>
                            <a href="{{ url('/backend/barang-keluar/detail/hapus',[@$rs->id,@$det->produk_id]) }}" class="btn btn-danger btn-sm"><i class="fa fa-trash fa-fw"></i> Hapus</a>
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                </table>
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
