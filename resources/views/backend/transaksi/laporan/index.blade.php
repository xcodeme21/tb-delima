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
            <h1 class="m-0 text-dark">Laporan Transaksi</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('laporan-transaksi') }}">Home</a></li>
              <!-- <li class="breadcrumb-item active">Dashboard v1</li> -->
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
                  <div class="row-fluid animated bounceInUp" align="right">
                    <a href="{{ route('export-laporan-transaksi') }}" class="btn btn-success btn-sm"><i class="fas fa-file-excel"></i> Export</a>
                  </div>
                  <br>
                  <div class="table-responsive animated bounceInUp">
                      <table id="listtransaksi" class="table table-condensed display" cellspacing="0" width="100%">
                          <thead>
                              <tr>
                                  <th class="bg-th">No</th>  
                                  <th class="bg-th">No. Invoice</th>
                                  <th class="bg-th">Tanggal</th>
                                  <th class="bg-th">Total</th>
                                  <th class="bg-th">Action</th>
                              </tr>
                          </thead>
                          <tbody>  
                          </tbody>
                      </table>
                  </div>
              </div>
            </div>
          </div>

        </div>
    </section>
  </div>
  
  @include("backend.include.footer")


</div>

@include("backend.include.script")

<script>
  $(function() {
      $('#listtransaksi').DataTable({
          responsive: true,
          processing: true,
          serverSide: true,
          ajax: "{{ url('backend/laporan-transaksi/data') }}",
          columns: [
              { data: 'id', defaultContent: '', searchable: false, render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1; //auto increment
                }},
              { data: 'no_invoice', name: 'no_invoice' },
              { data: 'tanggal_transaksi', name: 'tanggal_transaksi' },
              { data: 'total_bayar', name: 'total_bayar' },
              { data: 'action', name: 'action', orderable: false, searchable: false},
          ]
      });
  });
</script>

</body>
</html>
