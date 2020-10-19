<!DOCTYPE html><html lang="en" dir="ltr">
@include("include.head")
<body>
@include('flash::message')
<div class="site">      
@include("include.header")          
@include("include.mobile-menu-other")
    <div class="site__body">

        <div class="page-header">
            <div class="page-header__container container">
                <div class="page-header__title"><br><h1><i class="fa fa-shopping-cart"></i> Checkout</h1></div>
            </div>
        </div>

        <div class="checkout block">
            <div class="container">
                {{ Form::open(['route'=>'post-checkout', 'id'=>'form','method' => 'POST', 'class'=>'search__form animated bounceIn', 'accept'=>'image/*' ,'enctype'=>'multipart/form-data']) }} 
                {{ Form::token() }}
                <div class="row">
                    <div class="col-12 mb-3"></div>
                    <div class="col-12 col-lg-6 col-xl-7">
                        <div class="card mb-lg-0">
                            <div class="card-body">
                                <h3 class="card-title">Detail Pengiriman</h3>
                                <div class="form-group">
                                    <label>Nama</label> 
                                    <input type="text" class="form-control" name="nama_tujuan" value="{{ Auth::user()->name}}" required>
                                </div>
                                <div class="form-group">
                                    <label>No. HP</label> 
                                    <input type="text" class="form-control" name="no_hp_tujuan" value="{{ Auth::user()->phone }}" required>
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label> 
                                    <textarea class="form-control" rows="5" name="alamat_tujuan" required>{{ Auth::user()->address }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="checkout-comment">Catatan <span class="text-muted">(Optional)</span></label> 
                                    <textarea id="checkout-comment" name="catatan" class="form-control" rows="4"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 col-xl-5 mt-4 mt-lg-0">
                        <div class="card mb-0">
                            <div class="card-body">
                                <h3 class="card-title">Detail Pembelian</h3>
                                <table class="checkout__totals">
                                    <thead class="checkout__totals-header">
                                        <tr>
                                            <th>Product</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody class="checkout__totals-products">
                                        @foreach(@$isikeranjangku as $isiker)
                                        <tr>
                                            <td>{{ @$isiker->nama_produk }} × {{ @$isiker->jumlah }}</td>
                                            <td>Rp. {{ number_format(@$isiker->harga_per_produk,0,',','.')}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot class="checkout__totals-footer">
                                        <tr>
                                            <th>Total</th>
                                            <td>Rp. {{ number_format(@$totalhargakeranjangku,0,',','.')}}</td>
                                        </tr>
                                    </tfoot>
                                </table>
                                <div class="payment-methods">
                                    <ul class="payment-methods__list">
                                        <li class="payment-methods__item payment-methods__item--active">
                                            <label class="payment-methods__item-header"><span class="payment-methods__item-radio input-radio"><span class="input-radio__body"><input class="input-radio__input" name="metode_pembayaran" value="1" type="radio" checked="checked"> <span class="input-radio__circle"></span> </span></span><span class="payment-methods__item-title">Transfer Bank</span></label>
                                            <div class="payment-methods__item-container">
                                                <div class="payment-methods__item-description text-muted">Bayar melalui transfer dengan mengupload bukti transfer.</div>
                                            </div>
                                        </li>
                                        <li class="payment-methods__item">
                                            <label class="payment-methods__item-header"><span class="payment-methods__item-radio input-radio"><span class="input-radio__body"><input class="input-radio__input" name="metode_pembayaran" value="2" type="radio"> <span class="input-radio__circle"></span> </span></span><span class="payment-methods__item-title">Cash on delivery</span></label>
                                            <div class="payment-methods__item-container">
                                                <div class="payment-methods__item-description text-muted">Bayar pesanan di tempat.</div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <button type="submit" class="btn btn-primary btn-xl btn-block">Place Order</button>
                            </div>
                        </div>
                    </div>
                </div>
                {{ Form::close() }}

            </div>
        </div>

      


    </div><!-- site__body / end -->
                             
</div>
                                 
@include("include.footer")
@include("include.menu-mobile")
@include("include.script")


                                 
</body>
</html>