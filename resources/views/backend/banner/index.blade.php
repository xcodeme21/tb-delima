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
            <h1 class="m-0 text-dark">Banner</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('banner') }}">Utama</a></li>
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

                <div class="row-fluid" align="center">
                  <h2>SLIDE 1</h2>
                </div>
                <hr>

                {{ Form::open(['route'=>'update-1-banner' ,'method' => 'post', 'class'=>'form-horizontal mt-3  animated bounceIn','enctype'=>'multipart/form-data']) }} 
                {{ Form::token() }}
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Judul</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-line" name="banner_1_judul" value="{{ @$rs->banner_1_judul }}" placeholder="Judul" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Deskripsi</label>
                        <div class="col-sm-9">
                            <textarea class="form-control form-control-line textarea" name="banner_1_deskripsi" placeholder="Deskripsi" required>{{ @$rs->banner_1_deskripsi }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Gambar</label>
                        <div class="col-sm-9">
                            <input type="file" class="form-control form-control-line" name="banner_1_img" placeholder="Foto">
                            @if(@$rs->banner_1_img != null)
                            <br>
                            <img src="{{ asset('public/img/banner/'.@$rs->banner_1_img) }}" width="250px"/>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row-fluid" align="right">
                        <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save fa-fw"></i> Update</button>
                    </div>
                {{ Form::close() }}
                
              </div>
            </div>
          </div>
        </div>
        
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">

                <div class="row-fluid" align="center">
                  <h2>SLIDE 2</h2>
                </div>
                <hr>

                {{ Form::open(['route'=>'update-2-banner' ,'method' => 'post', 'class'=>'form-horizontal mt-3  animated bounceIn','enctype'=>'multipart/form-data']) }} 
                {{ Form::token() }}
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Judul</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-line" name="banner_2_judul" value="{{ @$rs->banner_2_judul }}" placeholder="Judul" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Deskripsi</label>
                        <div class="col-sm-9">
                            <textarea class="form-control form-control-line textarea" name="banner_2_deskripsi" placeholder="Deskripsi" required>{{ @$rs->banner_2_deskripsi }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Gambar</label>
                        <div class="col-sm-9">
                            <input type="file" class="form-control form-control-line" name="banner_2_img" placeholder="Foto">
                            @if(@$rs->banner_2_img != null)
                            <br>
                            <img src="{{ asset('public/img/banner/'.@$rs->banner_2_img) }}" width="250px"/>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row-fluid" align="right">
                        <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save fa-fw"></i> Update</button>
                    </div>
                {{ Form::close() }}
                
              </div>
            </div>
          </div>
        </div>
        
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">

                <div class="row-fluid" align="center">
                  <h2>SLIDE 3</h2>
                </div>
                <hr>

                {{ Form::open(['route'=>'update-3-banner' ,'method' => 'post', 'class'=>'form-horizontal mt-3  animated bounceIn','enctype'=>'multipart/form-data']) }} 
                {{ Form::token() }}
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Judul</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-line" name="banner_3_judul" value="{{ @$rs->banner_3_judul }}" placeholder="Judul" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Deskripsi</label>
                        <div class="col-sm-9">
                            <textarea class="form-control form-control-line textarea" name="banner_3_deskripsi" placeholder="Deskripsi" required>{{ @$rs->banner_3_deskripsi }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Gambar</label>
                        <div class="col-sm-9">
                            <input type="file" class="form-control form-control-line" name="banner_3_img" placeholder="Foto">
                            @if(@$rs->banner_3_img != null)
                            <br>
                            <img src="{{ asset('public/img/banner/'.@$rs->banner_3_img) }}" width="250px"/>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row-fluid" align="right">
                        <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save fa-fw"></i> Update</button>
                    </div>
                {{ Form::close() }}
                
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


</body>
</html>
