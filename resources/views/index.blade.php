<!DOCTYPE html><html lang="en" dir="ltr">
@include("include.head")
<body>
 @include('flash::message')
    <div class="site">
        <header class="site__header d-lg-none">
            <div class="mobile-header mobile-header--sticky" data-sticky-mode="pullToShow">
                <div class="mobile-header__panel">
                    <div class="container">
                        <div class="mobile-header__body">
                        <button class="mobile-header__menu-button">
                            <svg width="18px" height="14px">
                                <use xlink:href="{{ asset('public/frontend/images/sprite.svg#menu-18x14') }}"></use>
                            </svg>
                        </button> 
                        <a class="mobile-header__logo" href="{{ url('/') }}">TB-Delima</a>
                                 <div class="search search--location--mobile-header mobile-header__search">
                                 <div class="search__body">
                                {{ Form::open(['url'=>'/search/produk/', 'id'=>'form','method' => 'GET', 'class'=>'search__form animated bounceIn', 'accept'=>'image/*' ,'enctype'=>'multipart/form-data']) }} 
                                 <input class="search__input" name="search" placeholder="Cari produk disini..." aria-label="Site search" type="text" autocomplete="off"> 
                                 <button class="search__button search__button--type--submit" type="submit">
                                 <svg width="20px" height="20px">
                                 <use xlink:href="public/frontend/images/sprite.svg#search-20"></use>
                                 </svg>
                                 </button> 
                                 
                                 <button type="submit" class="search__button search__button--type--close" type="button">
                                 <svg width="20px" height="20px">
                                 <use xlink:href="public/frontend/images/sprite.svg#cross-20"></use>
                                 </svg>
                                 </button>
                                 <div class="search__border"></div>
                                 {{ Form::close() }}
                                 <div class="search__suggestions suggestions suggestions--location--mobile-header"></div></div></div><div class="mobile-header__indicators"><div class="indicator indicator--mobile-search indicator--mobile d-md-none"><button class="indicator__button"><span class="indicator__area"><svg width="20px" height="20px"><use xlink:href="public/frontend/images/sprite.svg#search-20"></use></svg></span></button></div><div class="indicator indicator--mobile d-sm-flex d-none"></div>
                                 
                                 @if(Auth::check())
                                 <div class="indicator indicator--mobile"><a href="#" class="indicator__button"><span class="indicator__area"><svg width="20px" height="20px"><use xlink:href="public/frontend/images/sprite.svg#cart-20"></use></svg> <span class="indicator__value">{{ @$totalkeranjangku }}</span></span></a></div>
                                 @endif

                             </div></div></div></div></div></header><!-- mobile site__header / end --><!-- desktop site__header --><header class="site__header d-lg-block d-none"><div class="site-header"><!-- .topbar -->
                                 
                                 <div class="site-header__middle container">
                                     <div class="site-header__logo"><a href="{{ url('/') }}"><h1>TB-Delima</h1></a></div>
                                    <div class="site-header__search">
                                        <div class="search search--location--header">
                                            <div class="search__body">
                                                {{ Form::open(['url'=>'/search/produk/', 'id'=>'form','method' => 'GET', 'class'=>'search__form animated bounceIn', 'accept'=>'image/*' ,'enctype'=>'multipart/form-data']) }} 
                                                    <input class="search__input" name="search" placeholder="Cari produk disini..." aria-label="Site search" type="text" autocomplete="off"> 
                                                    <button type="submit" class="search__button search__button--type--submit" type="submit"><svg width="20px" height="20px"><use xlink:href="public/frontend/images/sprite.svg#search-20"></use></svg></button>
                                                    <div class="search__border"></div>
                                                {{ Form::close() }}
                                            <div class="search__suggestions suggestions suggestions--location--header"></div></div></div></div><div class="site-header__phone"><div class="site-header__phone-title">Customer Service</div><div class="site-header__phone-number">{{ @$profil->telepon }}</div></div></div><div class="site-header__nav-panel"><!-- data-sticky-mode - one of [pullToShow, alwaysOnTop] --><div class="nav-panel nav-panel--sticky" data-sticky-mode="pullToShow"><div class="nav-panel__container container"><div class="nav-panel__row"><div class="nav-panel__departments"><!-- .departments --><div class="departments departments--open departments--fixed" data-departments-fixed-by=".block-slideshow"><div class="departments__body"><div class="departments__links-wrapper"><div class="departments__submenus-container"></div>
                                    <ul class="departments__links">
                                    @foreach(@$kategori as $kt)
                                    <li class="departments__item">
                                        <a class="departments__item-link" href="{{ url('category',$kt->id) }}">{{ @$kt->nama_kategori }}</a>
                                    </li>
                                    @endforeach
                                    </ul>
                                </div>
                            </div>
                        <button class="departments__button"><svg class="departments__button-icon" width="18px" height="14px"><use xlink:href="{{ asset('public/frontend/images/sprite.svg#menu-18x14') }}"></use></svg> 
                                 Kategori 
                                 <svg class="departments__button-arrow" width="9px" height="6px">
                                     <use xlink:href="public/frontend/images/sprite.svg#arrow-rounded-down-9x6">
                                 </use>
                                 </svg>
                                 </button>
                                 </div>
                                 </div>
                                 <div class="nav-panel__nav-links nav-links">
                                 <ul class="nav-links__list">
                                 <li class="nav-links__item nav-links__item--has-submenu">
                                 <a class="nav-links__item-link" href="{{ url('/') }}">
                                 <div class="nav-links__item-body">Home</div>
                                 </a></li>
                                 
                                 @if(Auth::check())
                                 <li class="nav-links__item"><a class="nav-links__item-link" href="{{ route('riwayat-pesanan') }}"><div class="nav-links__item-body">Riwayat Pesanan</div></a></li>
                                 @endif

                                 </ul></div><!-- .nav-links / end -->
                                 
                                 <div class="nav-panel__indicators"><div class="indicator"></div>
                                 
                                 @if(Auth::check())
                                 <div class="indicator indicator--trigger--click">
                                 <a href="#" class="indicator__button"><span class="indicator__area"><svg width="20px" height="20px"><use xlink:href="public/frontend/images/sprite.svg#cart-20"></use></svg> <span class="indicator__value">{{ @$totalkeranjangku }}</span></span></a>
                                 <div class="indicator__dropdown"><!-- .dropcart --><div class="dropcart dropcart--style--dropdown">
                                     

                                     <div class="dropcart__body">
                                            <div class="dropcart__products-list">
                                                @foreach(@$isikeranjangku as $iskerku)
                                                <div class="dropcart__product">
                                                    <div class="product-image dropcart__product-image">
                                                        <a href="{{ url('/view/produk/'.@$iskerku->id) }}" class="product-image__body"><img class="product-image__img" src="{{ asset('public/img/produk/'. @$iskerku->foto_produk) }}" alt=""></a>
                                                    </div>
                                                    <div class="dropcart__product-info">
                                                        <div class="dropcart__product-name"><a href="{{ url('/view/produk/'.@$iskerku->id) }}">{{ @$iskerku->nama_produk }}</a></div>
                                                        <div class="dropcart__product-meta">
                                                            <span class="dropcart__product-quantity">{{ @$iskerku->jumlah }}</span> × <span class="dropcart__product-price">Rp. {{ number_format(@$iskerku->harga,0,',','.')}}</span>
                                                        </div>
                                                    </div>
                                                    <a href="{{ url('/keranjang/delete/'.@$iskerku->id) }}" type="button" class="dropcart__product-remove btn btn-light btn-sm btn-svg-icon"><svg width="10px" height="10px"><use xlink:href="{{ asset('public/frontend/images/sprite.svg#cross-10') }}"></use></svg></a>
                                                </div>
                                                @endforeach
                                            </div>
                                            <div class="dropcart__totals">
                                                <table>
                                                    <tbody>
                                                        <tr>
                                                            <th>Total</th>
                                                            <td>Rp. {{ number_format(@$totalhargakeranjangku,0,',','.')}}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="dropcart__buttons">
                                                <a class="btn btn-secondary" href="{{ route('lihat-keranjang') }}">Lihat Keranjang</a> 
                                                <a class="btn btn-primary" href="{{ route('checkout') }}">Checkout</a></div>
                                            </div>


                                 </div><!-- .dropcart / end --></div></div>
                                 @endif
                                 
                                 <div class="indicator indicator--trigger--click"><a href="#" class="indicator__button"><span class="indicator__area"><svg width="20px" height="20px"><use xlink:href="public/frontend/images/sprite.svg#person-20"></use></svg></span></a><div class="indicator__dropdown"><div class="account-menu">
                                 
                                 
                                 
                                 @if(Auth::check())
                                 <div class="account-menu__divider"></div>
                                 
                                 <a href="#" class="account-menu__user"><div class="account-menu__user-avatar"><img src="{{ asset('public/img/pelanggan/'.Auth::user()->photo) }}" alt=""></div><div class="account-menu__user-info"><div class="account-menu__user-name">{{ Auth::user()->name }}</div><div class="account-menu__user-email">{{ Auth::user()->email }}</div></div></a>
                                 
                                 
                                 <div class="account-menu__divider"></div>

                                 <ul class="account-menu__links">
                                 <li><a href="{{ route('pages-profil') }}">Edit Profil</a></li>
                                 <li><a href="{{ route('riwayat-pesanan') }}">Riwayat Pesanan</a></li>
                                 </ul>
                                 <div class="account-menu__divider"></div>
                                 <ul class="account-menu__links">
                                 <li><a href="{{ route('logout-frontend') }}" onclick="event.preventDefault();document.getElementById('logout-frontend').submit();">Logout</a></li>
                                 <form id="logout-frontend" action="{{ route('logout-frontend') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form> 
                                 </ul>

                                 @else
                                 {{ Form::open(['route'=>'login-frontend', 'class'=>'account-menu__form','method' => 'POST']) }} 
                                 {{ Form::token() }}
                                 <div class="account-menu__form-title">Log In to Your Account</div>
                                 <div class="form-group">
                                 <label for="header-signin-email" class="sr-only">Email address</label> <input id="header-signin-email" type="email" class="form-control form-control-sm" placeholder="Email address" name="email" required>
                                 </div>
                                 <div class="form-group">
                                 <label for="header-signin-password" class="sr-only">Password</label>
                                 <div class="account-menu__form-forgot">
                                 <input id="header-signin-password" type="password" class="form-control form-control-sm" placeholder="Password" name="password" required> 
                                 
                                 <!-- <a href="#" class="account-menu__form-forgot-link">Forgot?</a> -->
                                </div></div>
                                 
                                 <div class="form-group account-menu__form-button">
                                 <button type="submit" class="btn btn-primary btn-sm">Login</button></div><div class="account-menu__form-link"><a href="{{ route('pages-register') }}">Create An Account</a></div></form>
                                 {{ Form::close() }}
                                 @endif

                                 </div></div></div></div></div></div></div></div></div></header><!-- desktop site__header / end -->
                                 
                                 <!-- site__body -->
                                 <div class="site__body">
                                 <!-- .block-slideshow --><div class="block-slideshow block-slideshow--layout--with-departments block"><div class="container"><div class="row"><div class="col-lg-3 d-none d-lg-block"></div><div class="col-12 col-lg-9"><div class="block-slideshow__body"><div class="owl-carousel"><a class="block-slideshow__slide" href="#"><div class="block-slideshow__slide-image block-slideshow__slide-image--desktop" style="background-image: url('public/img/banner/{{ @$banner->banner_1_img }}')"></div><div class="block-slideshow__slide-image block-slideshow__slide-image--mobile" style="background-image: url('public/img/banner/{{ @$banner->banner_1_img }}')"></div><div class="block-slideshow__slide-content"><div class="block-slideshow__slide-title">{{ @$banner->banner_1_judul }}</div><div class="block-slideshow__slide-text">{!! @$banner->banner_1_deskripsi !!}</div></div></a><a class="block-slideshow__slide" href="#"><div class="block-slideshow__slide-image block-slideshow__slide-image--desktop" style="background-image: url('public/img/banner/{{ @$banner->banner_2_img }}')"></div><div class="block-slideshow__slide-image block-slideshow__slide-image--mobile" style="background-image: url('public/img/banner/{{ @$banner->banner_2_img }}')"></div><div class="block-slideshow__slide-content"><div class="block-slideshow__slide-title">{{ @$banner->banner_2_judul }}</div><div class="block-slideshow__slide-text">{!! @$banner->banner_2_deskripsi !!}</div></div></a><a class="block-slideshow__slide" href="#"><div class="block-slideshow__slide-image block-slideshow__slide-image--desktop" style="background-image: url('public/img/banner/{{ @$banner->banner_3_img }}')"></div><div class="block-slideshow__slide-image block-slideshow__slide-image--mobile" style="background-image: url('public/img/banner/{{ @$banner->banner_3_img }}')"></div><div class="block-slideshow__slide-content"><div class="block-slideshow__slide-title">{{ @$banner->banner_3_judul }}</div><div class="block-slideshow__slide-text">{!! @$banner->banner_3_deskripsi !!}</div></div></a></div></div></div></div></div></div><!-- .block-slideshow / end -->
                                 
                                 
                                 
                                 <!-- .block-features -->
                                 <div class="block block-features block-features--layout--classic"><div class="container"><div class="block-features__list"><div class="block-features__item"><div class="block-features__icon"><svg width="48px" height="48px"><use xlink:href="public/frontend/images/sprite.svg#fi-free-delivery-48"></use></svg></div><div class="block-features__content"><div class="block-features__title">Gratis Ongkir</div><div class="block-features__subtitle">Untuk semua produk</div></div></div><div class="block-features__divider"></div><div class="block-features__item"><div class="block-features__icon"><svg width="48px" height="48px"><use xlink:href="public/frontend/images/sprite.svg#fi-24-hours-48"></use></svg></div><div class="block-features__content"><div class="block-features__title">Konsultasi</div><div class="block-features__subtitle">Konsultasi pembangunan</div></div></div><div class="block-features__divider"></div><div class="block-features__item"><div class="block-features__icon"><svg width="48px" height="48px"><use xlink:href="public/frontend/images/sprite.svg#fi-payment-security-48"></use></svg></div><div class="block-features__content"><div class="block-features__title">100% Aman</div><div class="block-features__subtitle">Pengiriman aman</div></div></div><div class="block-features__divider"></div><div class="block-features__item"><div class="block-features__icon"><svg width="48px" height="48px"><use xlink:href="public/frontend/images/sprite.svg#fi-tag-48"></use></svg></div><div class="block-features__content"><div class="block-features__title">Murah</div><div class="block-features__subtitle">Harga lebih murah</div></div></div></div></div></div><!-- .block-features / end -->
                                 
                                 
                                 <!-- .block-products-carousel -->
                                 <div class="block block-products-carousel" data-layout="grid-4" data-mobile-grid-columns="2"><div class="container"><div class="block-header"><h3 class="block-header__title">Produk Pilihan</h3><div class="block-header__divider"></div>
                                 
                                 
                                 <div class="block-header__arrows-list"><button class="block-header__arrow block-header__arrow--left" type="button"><svg width="7px" height="11px"><use xlink:href="public/frontend/images/sprite.svg#arrow-rounded-left-7x11"></use></svg></button> <button class="block-header__arrow block-header__arrow--right" type="button"><svg width="7px" height="11px"><use xlink:href="public/frontend/images/sprite.svg#arrow-rounded-right-7x11"></use></svg></button></div></div>
                                 
                                 
                                 <div class="block-products-carousel__slider">
                                 <div class="block-products-carousel__preloader"></div>
                                 <div class="owl-carousel">
                                  
                                  @foreach(@$produkpilihan as $propil)
                                 <div class="block-products-carousel__column">
                                 <div class="block-products-carousel__cell">
                                 <div class="product-card product-card--hidden-actions">
                                 
                                 <div class="product-card__badges-list">
                                 </div><div class="product-card__image product-image"><a href="{{ url('/view/produk/'.@$propil->id) }}" class="product-image__body"><img class="product-image__img" src="{{ asset('public/img/produk/'.@$propil->foto_produk) }}" alt="{{ @$propil->nama_produk }}"></a></div><div class="product-card__info"><div class="product-card__name"><a href="{{ url('/view/produk/'.@$propil->id) }}">{{ @$propil->nama_produk }}</a></div><div class="product-card__rating"><div class="product-card__rating-legend">{{ @$propil->total_penjualan }} Terjual</div></div><ul class="product-card__features-list"><li>Speed: 750 RPM</li><li>Power Source: Cordless-Electric</li><li>Battery Cell Type: Lithium</li><li>Voltage: 20 Volts</li><li>Battery Capacity: 2 Ah</li></ul></div><div class="product-card__actions"><div class="product-card__availability">Availability: <span class="text-success">In Stock</span></div><div class="product-card__prices">Rp. {{ number_format(@$propil->harga,0,',','.')}}</div><div class="product-card__buttons"><a href="{{ url('/keranjang/add/'.@$propil->id) }}" class="btn btn-primary product-card__addtocart" type="button"><i class="fa fa-shopping-cart"></i> Keranjang</a> <a href="{{ url('/keranjang/add/'.@$propil->id) }}" class="btn btn-secondary product-card__addtocart product-card__addtocart--list" type="button"><i class="fa fa-shopping-cart"></i> Keranjang</a>  </div></div></div></div></div>
                                 @endforeach
                                 
                                 </div></div></div></div><!-- .block-products-carousel / end -->
                                 
                                 <!-- .block-banner -->
                                 <!-- <div class="block block-banner"><div class="container"><a href="#" class="block-banner__body"><div class="block-banner__image block-banner__image--desktop" style="background-image: url('public/frontend/images/banners/banner-1.jpg')"></div><div class="block-banner__image block-banner__image--mobile" style="background-image: url('public/frontend/images/banners/banner-1-mobile.jpg')"></div><div class="block-banner__title">Hundreds<br class="block-banner__mobile-br">Hand Tools</div><div class="block-banner__text">Hammers, Chisels, Universal Pliers, Nippers, Jigsaws, Saws</div></a></div></div> -->
                                 <!-- .block-banner / end -->

                                 <!-- .block-products -->
                                 <div class="block block-products block-products--layout--large-first" data-mobile-grid-columns="2"><div class="container">
                                 <div class="block-header">
                                 <h3 class="block-header__title">Penjualan Terlaris</h3>
                                 <div class="block-header__divider"></div>
                                 </div><div class="block-products__body">
                                 <div class="block-products__featured">
                                 <div class="block-products__featured-item">
                                 <div class="product-card product-card--hidden-actions">
                                 <button class="product-card__quickview" type="button">
                                 <svg width="16px" height="16px"><use xlink:href="public/frontend/images/sprite.svg#quickview-16"></use></svg> <span class="fake-svg-icon"></span></button><div class="product-card__badges-list"><div class="product-card__badge product-card__badge--hot">HOT</div></div><div class="product-card__image product-image"><a href="{{ url('/view/produk/'.@$onebest->id) }}" class="product-image__body"><img class="product-image__img" src="{{ asset('public/img/produk/'.@$onebest->foto_produk) }}" alt=""></a></div><div class="product-card__info"><div class="product-card__name"><a href="{{ url('/view/produk/'.@$onebest->id) }}">{{ @$onebest->nama_produk }}</a></div><div class="product-card__rating-legend">{{ @$onebest->total_penjualan }} Terjual</div>
                                 
                                 <!-- <ul class="product-card__features-list"><li>Speed: 750 RPM</li><li>Power Source: Cordless-Electric</li><li>Battery Cell Type: Lithium</li><li>Voltage: 20 Volts</li><li>Battery Capacity: 2 Ah</li></ul> -->
                                 </div>
                                 
                                 <div class="product-card__actions">
                                 <div class="product-card__availability">Availability: <span class="text-success">In Stock</span></div><div class="product-card__prices">Rp. {{ number_format(@$onebest->harga,0,',','.')}}</div><div class="product-card__buttons"><a href="{{ url('/keranjang/add/'.@$onebest->id) }}" class="btn btn-primary product-card__addtocart" type="button"><i class="fa fa-shopping-cart"></i> Keranjang</a> <a href="{{ url('/keranjang/add/'.@$onebest->id) }}" class="btn btn-secondary product-card__addtocart product-card__addtocart--list" type="button"><i class="fa fa-shopping-cart"></i> Keranjang</a>  </div></div></div></div></div>
                                 
                                 
                                 
                                 <div class="block-products__list">

                                @foreach(@$otherbest as $obest)
                                 <div class="block-products__list-item">
                                 <div class="product-card product-card--hidden-actions">
                                 
                                 
                                 <div class="product-card__badges-list"><div class="product-card__badge product-card__badge--hot">Hot</div></div><div class="product-card__image product-image"><a href="{{ url('/view/produk/'.@$obest->id) }}" class="product-image__body"><img class="product-image__img" src="{{ asset('public/img/produk/'.@$obest->foto_produk) }}" alt=""></a></div><div class="product-card__info"><div class="product-card__name"><a href="{{ url('/view/produk/'.@$obest->id) }}">{{ @$obest->nama_produk }}</a></div>
                                 
                                 <div class="product-card__rating">
                                       
                                 <div class="product-card__rating-legend">{{ @$obest->total_penjualan }} Terjual</div></div><ul class="product-card__features-list"><li>Speed: 750 RPM</li><li>Power Source: Cordless-Electric</li><li>Battery Cell Type: Lithium</li><li>Voltage: 20 Volts</li><li>Battery Capacity: 2 Ah</li></ul></div><div class="product-card__actions"><div class="product-card__availability">Availability: <span class="text-success">In Stock</span></div><div class="product-card__prices">Rp. {{ number_format(@$obest->harga,0,',','.')}}</div><div class="product-card__buttons"><a href="{{ url('/keranjang/add/'.@$obest->id) }}" class="btn btn-primary product-card__addtocart" type="button"><i class="fa fa-shopping-cart"></i> Keranjang</a> <a href="{{ url('/keranjang/add/'.@$obest->id) }}" class="btn btn-secondary product-card__addtocart product-card__addtocart--list" type="button"><i class="fa fa-shopping-cart"></i> Keranjang</a>  </div></div></div></div>

                                 @endforeach
                                 
                                 </div></div></div></div><!-- .block-products / end -->
                                 
                                 
                                 
                                 
                                 <!-- .block-posts -->
                                 
                                 <div class="block block-posts" data-layout="list" data-mobile-columns="1">
                                 
                                 <div class="container">
                                 
                                 
                                 
                                 <!-- .block-brands --><div class="block block-brands"><div class="container"><div class="block-brands__slider"><div class="owl-carousel">
                                 @foreach(@$merek as $brands)
                                    <div class="block-brands__item">
                                     <a href="#"><img src="{{ asset('public/img/logo-merek/'.@$brands->logo_merek) }}" alt="" width="100" height="100"></a>
                                    </div>      
                                @endforeach
                                 
                                 </div></div></div></div><!-- .block-brands / end -->
                                 
                                 
                                 
                                 </div><!-- site__body / end -->
                                 
                                 
                                 @include("include.footer")
                                 @include("include.menu-mobile")
                                 @include("include.script")


                                 
                                 </body>
</html>