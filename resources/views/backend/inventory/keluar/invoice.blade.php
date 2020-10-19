<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>TB-Delima | Invoice Print</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap 4 -->

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('public/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('public/dist/css/adminlte.min.css')}}">

  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body>
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-12">
        <h2 class="page-header">
          <i class="fas fa-globe"></i> TB-Delima.
          <small class="float-right">Tanggal: <?php echo date('d-m-Y') ?></small>
        </h2>
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
          <strong>{{ @$rs->nama }}</strong><br>
          {{ @$rs->alamat }}<br>
          Telepon: {{ @$rs->telepon }}<br>
          Email: {{ @$rs->email }}
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        <b>Invoice #{{ @$rs->no_invoice }}</b><br>
        <!-- <br>
        <b>Catatan:</b> {{ @$rs->catatan }}
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
        <!-- <p class="lead">Metode Pembayaran: <span class="text-primary"><b>@if(@$rs->metode_pembayaran == 1) Transfer Bank @else Cash On Delivery @endif</b></span></p> -->
      </div>
      <!-- /.col -->
      <div class="col-6">
        <div class="table-responsive">
          <table class="table">
            <tr>
              <th>Total:</th>
              <td>Rp. {{ number_format(@$rs->cost,0,',','.')}}</td>
            </tr>
          </table>
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->

<!-- <script type="text/javascript"> 
  window.addEventListener("load", window.print());
</script> -->
</body>
</html>
