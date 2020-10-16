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
            <h1 class="m-0 text-dark">Transaksi Masuk</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('transaksi-masuk') }}">Utama</a></li>
              <li class="breadcrumb-item active">View Transaksi Masuk</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- <div class="callout callout-info">
              <h5><i class="fas fa-info"></i> Catatan:</h5>
              Halaman ini adalah fitur detail transaksi. Untuk mencetak invoice klik tombol <button class="btn btn-default"><i class="fas fa-print"></i> Cetak Invoice</button> dibawah.
            </div> -->


            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <i class="fas fa-globe"></i> TB-Delima.
                    <small class="float-right">Tanggal: <?php echo date('d-m-Y') ?></small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  Dari
                  <address>
                    <strong>TB-Delima</strong><br>
                    {{ @$profil->alamat }}<br>
                    Telepon: {{ @$profil->telepon }}<br>
                    Email: {{ @$profil->email }}
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  Ke
                  <address>
                    <strong>{{ @$rs->nama_tujuan }}</strong><br>
                    {{ @$rs->alamat_tujuan }}<br>
                    No. HP: {{ @$rs->no_hp_tujuan }}
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  <b>Invoice #{{ @$rs->no_invoice }}</b><br>
                  <!-- <br>
                  <b>Order ID:</b> 4F3S8J<br>
                  <b>Payment Due:</b> 2/22/2014<br>
                  <b>Account:</b> 968-34567 -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>No.</th>
                      <th>Produk</th>
                      <th>Kuantitas</th>
                      <th>Subtotal</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $no=0; ?>
                    @foreach(@$detail as $det)
                    <?php $no++; ?>
                    <tr>
                      <td>{{@$no }}</td>
                      <td>{{ @$det->nama_produk }}</td>
                      <td>{{ @$det->jumlah }}</td>
                      <td>Rp. {{ number_format(@$det->harga_per_produk,0,',','.')}}</td>
                    </tr>
                    @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                  <p class="lead">Metode Pembayaran: <span class="text-primary"><b>@if(@$rs->metode_pembayaran == 1) Transfer Bank @else Cash On Delivery @endif</b></span></p>
                  
                  @if(@$rs->metode_pembayaran == 1 && @$rs->bukti_pembayaran == null)
                  <div class="callout callout-danger">
                    <h5><i class="fas fa-info"></i> Peringatan:</h5>
                    Bukti transfer belum di upload.
                  </div>
                  @elseif(@$rs->metode_pembayaran == 1 && @$rs->bukti_pembayaran != null)
                  <div class="callout callout-danger">
                    <a href="{{ asset('public/img/bukti/'.@$rs->bukti_pembayaran) }}" target="_blank"><img src="{{ asset('public/img/bukti/'.@$rs->bukti_pembayaran) }}" width="250"></a>
                  </div>
                  @endif
                </div>
                <!-- /.col -->
                <div class="col-6">
                  <div class="table-responsive">
                    <table class="table">
                      <tbody>
                      <tr>
                        <th>Total:</th>
                        <td>Rp. {{ number_format(@$rs->total_bayar,0,',','.')}}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- /.col -->
            </div>
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                  <a href="{{ url('/backend/transaksi-masuk/view/invoice/'.@$rs->id) }}" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Cetak Invoice</a>
                  <a href="{{ url('/backend/transaksi-masuk/proses/'.@$rs->id) }}" class="btn btn-success float-right"><i class="far fa-paper-plane"></i>&nbsp;Proses
                  </a>
                </div>
              </div>
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
  </div>
  
  @include("backend.include.footer")


</div>

@include("backend.include.script")


</body>
</html>
