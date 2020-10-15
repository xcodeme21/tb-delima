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
            <h1 class="m-0 text-dark">Pelanggan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('pelanggan') }}">Home</a></li>
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
                <div class="row-fluid" align="right">
                      <a href="{{ route('add-pelanggan') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-fw"></i> Tambah</a>
                      <a href="{{ route('pelanggan') }}" class="btn btn-info btn-sm"><i class="fa fa-spin fa-spinner"></i> Refresh</a>
                      <hr>
                  </div>
                  <div class="table-responsive animated bounceInUp">
                      <table id="listpelanggan" class="table table-condensed display nowrap" cellspacing="0" width="100%">
                          <thead>
                              <tr>
                                  <th class="bg-th">No</th>  
                                  <th class="bg-th">Nama</th>
                                  <th class="bg-th">Email</th>
                                  <th class="bg-th">No. HP</th>
                                  <th class="bg-th">Alamat</th>
                                  <th class="bg-th">Foto</th>
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
      $('#listpelanggan').DataTable({
          responsive: true,
          processing: true,
          serverSide: true,
          ajax: "{{ url('backend/pelanggan/data') }}",
          columns: [
              { data: 'id', defaultContent: '', searchable: false, render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1; //auto increment
                }},
              { data: 'name', name: 'name' },
              { data: 'email', name: 'email' },
              { data: 'phone', name: 'phone' },
              { data: 'address', name: 'address' },
              { data: 'photo', name: 'photo', orderable: false, searchable: false },
              { data: 'action', name: 'action', orderable: false, searchable: false},
          ]
      });
  });
</script>

</body>
</html>
