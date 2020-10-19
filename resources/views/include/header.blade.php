<header class="site__header d-lg-block d-none">
            <div class="site-header__middle container">
                <div class="site-header__logo"><a href="{{ url('/') }}"><h1>TB-Delima</h1></a></div>

            <div class="site-header__search"><div class="search search--location--header">
                <div class="search__body">
                    {{ Form::open(['url'=>'/search/produk/', 'id'=>'form','method' => 'GET', 'class'=>'search__form animated bounceIn', 'accept'=>'image/*' ,'enctype'=>'multipart/form-data']) }} 
                         <input class="search__input" name="search" placeholder="Cari produk disini..." aria-label="Site search" type="text" autocomplete="off"> 
                         <button class="search__button search__button--type--submit" type="submit">
                         <svg width="20px" height="20px">
                         <use xlink:href="{{ asset('public/frontend/images/sprite.svg#search-20') }}"></use>
                         </svg>
                         </button> 
                         <div class="search__border"></div>
                     </form>
                     {{ Form::close() }}

                    <div class="search__suggestions suggestions suggestions--location--header"></div>
                </div>
            </div>
        </div>
        <div class="site-header__phone">
            <div class="site-header__phone-title">Customer Service</div>
                <div class="site-header__phone-number">{{ @$profil->telepon }}</div>
            </div>
        </div>

        <div class="nav-panel nav-panel--sticky" data-sticky-mode="pullToShow">
            <div class="nav-panel__container container">
                <div class="nav-panel__row">
                    <div class="nav-panel__departments">
                    <!-- .departments -->
                        <div class="departments" data-departments-fixed-by="">
                            <div class="departments__body">
                                <div class="departments__links-wrapper">
                                    <div class="departments__submenus-container"></div>
                                    <ul class="departments__links">
                                        @foreach(@$kategori as $kt)
                                        <li class="departments__item">
                                            <a class="departments__item-link" href="{{ url('category',$kt->id) }}">{{ @$kt->nama_kategori }}</a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>

                            <button class="departments__button"><svg class="departments__button-icon" width="18px" height="14px"><use xlink:href="{{ asset('public/frontend/images/sprite.svg#menu-18x14') }}"></use></svg> Kategori <svg class="departments__button-arrow" width="9px" height="6px"><use xlink:href="{{ asset('public/frontend/images/sprite.svg#arrow-rounded-down-9x6') }}"></use></svg></button>
                            </div><!-- .departments / end -->
                        </div>
                        <!-- .nav-links -->

                        <div class="nav-panel__nav-links nav-links">
                            <ul class="nav-links__list">
                                <li class="nav-links__item nav-links__item--has-submenu">
                                    <a class="nav-links__item-link" href="{{ url('/') }}"><div class="nav-links__item-body">Home</div>
                                    </a>
                                </li> 
                                 @if(Auth::check())
                                 <li class="nav-links__item"><a class="nav-links__item-link" href="{{ route('riwayat-pesanan') }}"><div class="nav-links__item-body">Riwayat Pesanan</div></a></li>
                                 @endif
                            </ul>
                        </div><!-- .nav-links / end -->


                        <div class="nav-panel__indicators">                                 
                            @if(Auth::check())
                            <div class="indicator indicator--trigger--click">
                                <a href="#" class="indicator__button"><span class="indicator__area"><svg width="20px" height="20px"><use xlink:href="{{ asset('public/frontend/images/sprite.svg#cart-20') }}"></use></svg> <span class="indicator__value">{{ @$totalkeranjangku }}</span></span></a>

                                <div class="indicator__dropdown">
                                    <!-- .dropcart -->
                                    <div class="dropcart dropcart--style--dropdown">
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
                                    </div><!-- .dropcart / end -->
                                </div>
                            </div>
                            @endif



                            <div class="indicator indicator--trigger--click">
                                <a href="#" class="indicator__button"><span class="indicator__area"><svg width="20px" height="20px"><use xlink:href="{{ asset('public/frontend/images/sprite.svg#person-20') }}"></use></svg></span></a>
                                <div class="indicator__dropdown">
                                    <div class="account-menu">
                                        

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
                                    <li><a href="{{ route('logout-frontend') }}"onclick="event.preventDefault();document.getElementById('logout-frontend').submit();">Logout</a></li>
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
                                    </div>
                                </div>
                                 
                                 <div class="form-group account-menu__form-button">
                                     <button type="submit" class="btn btn-primary btn-sm">Login</button>
                                 </div>
                                 <div class="account-menu__form-link"><a href="{{ route('pages-register') }}">Create An Account</a><br>
                                    <a href="{{ route('reset-password') }}">Lupa Password ?</a>
                                 </div>
                                {{ Form::close() }}
                                @endif
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
    </div>
</header>  