<header class="site__header d-lg-none">
   <!-- data-sticky-mode - one of [pullToShow, alwaysOnTop] -->
   <div class="mobile-header mobile-header--sticky" data-sticky-mode="pullToShow">
      <div class="mobile-header__panel">
         <div class="container">
            <div class="mobile-header__body">
               <button class="mobile-header__menu-button"><svg width="18px" height="14px"><use xlink:href="{{ asset('public/frontend/images/sprite.svg#menu-18x14') }}"></use></svg></button> 
               <a class="mobile-header__logo" href="{{ url('/') }}">TB-Delima</a>
               <div class="search search--location--mobile-header mobile-header__search">
                  <div class="search__body">
                     <form class="search__form" action="#">
                        <input class="search__input" name="search" placeholder="Search over 10,000 products" aria-label="Site search" type="text" autocomplete="off"> 
                        <button class="search__button search__button--type--submit" type="submit"><svg width="20px" height="20px"><use xlink:href="{{ asset('public/frontend/images/sprite.svg#search-20') }}"></use></svg></button> 
                        <button class="search__button search__button--type--close" type="button"><svg width="20px" height="20px"><use xlink:href="{{ asset('public/frontend/images/sprite.svg#cross-20') }}"></use></svg></button>
                        <div class="search__border"></div>
                     </form>
                     <div class="search__suggestions suggestions suggestions--location--mobile-header"></div>
                  </div>
               </div>
               <div class="mobile-header__indicators">
                  <div class="indicator indicator--mobile-search indicator--mobile d-md-none">
                     <button class="indicator__button"><span class="indicator__area"><svg width="20px" height="20px"><use xlink:href="{{ asset('public/frontend/images/sprite.svg#search-20') }}"></use></svg></span></button>
                  </div>
                  <div class="indicator indicator--mobile d-sm-flex d-none">
                     <a href="wishlist.html" class="indicator__button"><span class="indicator__area"><svg width="20px" height="20px"><use xlink:href="{{ asset('public/frontend/images/sprite.svg#heart-20') }}"></use></svg> <span class="indicator__value">0</span></span></a>
                  </div>
                  @if(Auth::check())
                  <div class="indicator indicator--mobile">
                     <a href="{{ route('lihat-keranjang') }}" class="indicator__button"><span class="indicator__area"><svg width="20px" height="20px"><use xlink:href="{{ asset('public/frontend/images/sprite.svg#cart-20') }}"></use></svg> <span class="indicator__value">{{ @$totalkeranjangku }}</span></span></a>
                  </div>
                  @endif
               </div>
            </div>
         </div>
      </div>
   </div>
</header>