
<!-- quickview-modal --><div id="quickview-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true"><div class="modal-dialog modal-dialog-centered modal-xl"><div class="modal-content"></div></div></div><!-- quickview-modal / end --><!-- mobilemenu --><div class="mobilemenu"><div class="mobilemenu__backdrop"></div><div class="mobilemenu__body"><div class="mobilemenu__header"><div class="mobilemenu__title">Menu</div><button type="button" class="mobilemenu__close"><svg width="20px" height="20px"><use xlink:href="{{ asset('public/frontend/images/sprite.svg#cross-20') }}"></use></svg></button></div><div class="mobilemenu__content"><ul class="mobile-links mobile-links--level--0" data-collapse data-collapse-opened-class="mobile-links__item--open">
@if(Auth::check())
<li class="mobile-links__item" data-collapse-item><div class="mobile-links__item-title"><a href="#" class="mobile-links__item-link"><img src="{{ asset('public/img/pelanggan/'.Auth::user()->photo) }}" width="30" height="30" /><span>{{ Auth::user()->name }}</span></a> </div><div class="mobile-links__item-sub-links" data-collapse-content></div></li>
@endif
<li class="mobile-links__item" data-collapse-item><div class="mobile-links__item-title"><a href="{{ url('/') }}" class="mobile-links__item-link">Home</a> </div><div class="mobile-links__item-sub-links" data-collapse-content></div></li>

<li class="mobile-links__item mobile-links__item" data-collapse-item="">
    <div class="mobile-links__item-title">
        <a href="#" class="mobile-links__item-link">Kategori</a>
        <button class="mobile-links__item-toggle" type="button" data-collapse-trigger=""><svg class="mobile-links__item-arrow" width="12px" height="7px"><use xlink:href="{{ asset('public/frontend/images/sprite.svg#arrow-rounded-down-12x7') }}"></use></svg></button>
    </div>
    <div class="mobile-links__item-sub-links" data-collapse-content="" style="">
        <ul class="mobile-links mobile-links--level--1">
            @foreach(@$kategori as $kt)
            <li class="mobile-links__item" data-collapse-item="">
                <div class="mobile-links__item-title">
                    <a href="{{ url('category',$kt->id) }}" class="mobile-links__item-link">{{ @$kt->nama_kategori }}</a>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
</li>

@if(Auth::check())
<li class="mobile-links__item" data-collapse-item><div class="mobile-links__item-title"><a href="{{ route('riwayat-pesanan') }}" class="mobile-links__item-link">Riwayat Pesanan</a> </div><div class="mobile-links__item-sub-links" data-collapse-content></div></li>
<li class="mobile-links__item" data-collapse-item><div class="mobile-links__item-title"><a href="{{ url('/') }}" class="mobile-links__item-link">Bantuan</a> </div><div class="mobile-links__item-sub-links" data-collapse-content></div></li>
<li class="mobile-links__item" data-collapse-item><div class="mobile-links__item-title"><a href="{{ url('/pages/profil') }}" class="mobile-links__item-link">Profil</a> </div><div class="mobile-links__item-sub-links" data-collapse-content></div></li>
<li class="mobile-links__item" data-collapse-item><div class="mobile-links__item-title"><a href="{{ route('logout-frontend') }}" onclick="event.preventDefault();document.getElementById('logout-frontend').submit();" class="mobile-links__item-link">Logout</a>
	<form id="logout-frontend" action="{{ route('logout-frontend') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>
    </div>
    <div class="mobile-links__item-sub-links" data-collapse-content></div>
</li>
@else
<li class="mobile-links__item" data-collapse-item><div class="mobile-links__item-title"><a href="{{ route('pages-login') }}" class="mobile-links__item-link">Login</a> </div><div class="mobile-links__item-sub-links" data-collapse-content></div></li>
<li class="mobile-links__item" data-collapse-item><div class="mobile-links__item-title"><a href="{{ route('pages-register') }}" class="mobile-links__item-link">Register</a> </div><div class="mobile-links__item-sub-links" data-collapse-content></div></li>
@endif
            <div class="pswp__caption">
            <div class="pswp__caption__center"></div>
            </div>
        </div>
    </div>
</div><!-- photoswipe / end --><!-- js -->