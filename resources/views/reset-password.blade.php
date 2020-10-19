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
                    <div class="col-md-12 d-flex flex-column mt-4 mt-md-0">
                        <div class="card flex-grow-1 mb-0">
                            <div class="card-body">
                                <h3 class="card-title">Reset-Password</h3>
                                {{ Form::open(['route'=>'post-reset-password', 'id'=>'form','method' => 'POST', 'class'=>'animated bounceIn', 'accept'=>'image/*' ,'enctype'=>'multipart/form-data']) }} 
                                {{ Form::token() }}
                                    <div class="form-group">
                                        <label>Email</label> 
                                        <input type="email" class="form-control" name="email" placeholder="Masukkan email..." required>
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-4">Reset</button>
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