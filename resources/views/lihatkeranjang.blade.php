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
                <div class="page-header__title"><br><h1><i class="fa fa-shopping-cart"></i> Keranjang</h1></div>
            </div>
        </div>

        <div class="cart block">
            <div class="container">
                <table class="cart__table cart-table">
                    <thead class="cart-table__head">
                        <tr class="cart-table__row">
                            <th class="cart-table__column cart-table__column--image">Foto</th>
                            <th class="cart-table__column cart-table__column--product">Nama Produk</th>
                            <th class="cart-table__column cart-table__column--price">Harga</th>
                            <th class="cart-table__column cart-table__column--quantity">Jumlah</th>
                            <th class="cart-table__column cart-table__column--total">Total</th>
                            <th class="cart-table__column cart-table__column--remove"></th>
                        </tr>
                    </thead>
                    <tbody class="cart-table__body">
                        @foreach(@$isikeranjangku as $isiker)
                        <tr class="cart-table__row">
                            <td class="cart-table__column cart-table__column--image">
                                <div class="product-image">
                                    <a href="#" class="product-image__body"><img class="product-image__img" src="{{ asset('public/img/produk/'.@$isiker->foto_produk) }}" alt=""></a>
                                </div>
                            </td>
                            <td class="cart-table__column cart-table__column--product">
                                <a href="#" class="cart-table__product-name">{{ @$isiker->nama_produk }}</a>
                            </td>
                            <td class="cart-table__column cart-table__column--price" data-title="Price">Rp. {{ number_format(@$isiker->harga,0,',','.')}}</td>
                            <td class="cart-table__column cart-table__column--quantity" data-title="Quantity">
                                <div class="input-number">
                                    <input class="form-control input-number__input" type="number" min="1" value="{{ @$isiker->jumlah }}" readonly>
                                    <a href="{{ url('/keranjang/add/'.@$isiker->produk_id) }}" class="input-number__add"></a>
                                    <a href="{{ url('/keranjang/kurangi/'.@$isiker->produk_id) }}" class="input-number__sub"></a>
                                </div>
                            </td>
                            <td class="cart-table__column cart-table__column--total" data-title="Total">Rp. {{ number_format(@$isiker->harga_per_produk,0,',','.')}}</td>
                            <td class="cart-table__column cart-table__column--remove">
                                <a href="{{ url('/keranjang/delete/'.@$isiker->id) }}" class="btn btn-danger btn-sm btn-svg-icon"><svg width="12px" height="12px"><use xlink:href="{{ asset('public/frontend//images/sprite.svg#cross-12') }}"></use></svg></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="cart__actions">
                    <form class="cart__coupon-form"></form>
                    <div class="cart__buttons">
                        <a href="{{ url('/') }}" class="btn btn-primary cart__update-button"><i class="fa fa-shopping-cart"></i> Lanjutkan Belanja</a> 
                    </div>
                </div>
                <div class="row justify-content-end pt-5">
                    <div class="col-12 col-md-7 col-lg-6 col-xl-5">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">Total Keranjang</h3>
                                <table class="cart__totals">
                                    <thead class="cart__totals-header">
                                        <tr>
                                            <th>Total</th>
                                            <td>Rp. {{ number_format(@$totalhargakeranjangku,0,',','.')}}</td>
                                        </tr>
                                    </thead>
                                    <!-- <tbody class="cart__totals-body">
                                        <tr>
                                            <th>Ongkir</th>
                                            <td>Rp. {{ number_format(30000,0,',','.')}}
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot class="cart__totals-footer">
                                        <tr>
                                            <th>Total</th>
                                            <td>
                                                <?php 
                                                $subtotal=$totalhargakeranjangku;
                                                $ongkir=30000;
                                                $total=$subtotal+$ongkir;
                                                echo "Rp.".number_format(@$total,0,',','.');
                                                ?>
                                            </td>
                                        </tr>
                                    </tfoot> -->
                                </table>
                                <a class="btn btn-primary btn-xl btn-block cart__checkout-button" href="{{ route('checkout') }}">Proceed to checkout</a>
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