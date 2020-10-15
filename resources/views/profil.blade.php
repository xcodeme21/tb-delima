<!DOCTYPE html><html lang="en" dir="ltr">
@include("include.head")
<body>
@include('flash::message')
<div class="site">      
@include("include.header")          
@include("include.mobile-menu-other")
    <div class="site__body">

        <br>

        <div class="block">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 d-flex flex-column mt-4 mt-md-0">
                        <div class="card flex-grow-1 mb-0">
                            <div class="card-body">
                                <h3 class="card-title">Profil</h3>
                                {{ Form::open(['route'=>'pages-profil-update', 'id'=>'form','method' => 'POST', 'class'=>'animated bounceIn', 'accept'=>'image/*' ,'enctype'=>'multipart/form-data']) }} 
                                {{ Form::token() }}
                                    <div class="form-group">
                                        <label>Nama</label> 
                                        <input type="text" class="form-control" name="name" placeholder="Masukkan nama..." value="{{ Auth::user()->name }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label> 
                                        <input type="email" class="form-control" name="email" placeholder="Masukkan email..." value="{{ Auth::user()->email }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label>No. HP</label> 
                                        <input type="number" class="form-control" name="phone" placeholder="Masukkan nomor HP..." value="{{ Auth::user()->phone }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Alamat</label>
                                        <textarea class="form-control" name="address" placeholder="Masukkan alamat..." required>{{ Auth::user()->address }}</textarea> 
                                    </div>
                                    <div class="form-group">
                                        <label>Foto</label> 
                                        <input type="file" class="form-control" name="photo" placeholder="Masukkan foto...">
                                        <br>
                                        <span><img src="{{ asset('public/img/pelanggan/'.Auth::user()->photo) }}" width="200"></span>
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-4">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-6 d-flex flex-column mt-4 mt-md-0">
                        <div class="card flex-grow-1 mb-0">
                            <div class="card-body">
                                <h3 class="card-title">Password</h3>
                                {{ Form::open(['route'=>'pages-profil-updatepassword', 'id'=>'form','method' => 'POST', 'class'=>'animated bounceIn', 'accept'=>'image/*' ,'enctype'=>'multipart/form-data']) }} 
                                {{ Form::token() }}
                                    <div class="form-group">
                                        <label>Password</label> 
                                        <input type="password" class="form-control" name="password" placeholder="Masukkan password..." required>
                                    </div>
                                    <div class="form-group">
                                        <label>Repeat Password</label> 
                                        <input type="password" class="form-control" name="repeatpassword" placeholder="Ulangi password.." required>
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-4">Update Password</button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>    

    </div><!-- site__body / end -->
                             
</div>
                                 
@include("include.footer")
@include("include.menu-mobile")
@include("include.script")


                                 
</body>
</html>