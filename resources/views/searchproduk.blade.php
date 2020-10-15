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
                <div class="page-header__breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a> <svg class="breadcrumb-arrow" width="6px" height="9px"><use xlink:href="images/sprite.svg#arrow-rounded-right-6x9"></use></svg></li>
                            <li class="breadcrumb-item active" aria-current="page">Hasil Pencarian</li></li>
                        </ol>
                    </nav>
                </div>
                <div class="page-header__title"><h1>Hasil Pencarian <span class="text-danger"><em>"{{ @$search }}"</em></span></h1></div>
            </div>
        </div>

        <div class="container">
            <div class="shop-layout shop-layout--sidebar--start">
                <div class="shop-layout__sidebar">
                    <div class="block block-sidebar block-sidebar--offcanvas--mobile">
                        <div class="block-sidebar__backdrop"></div>
                        <div class="block-sidebar__body">
                            <div class="block-sidebar__header">
                                <div class="block-sidebar__title">Kategori</div>
                                <button class="block-sidebar__close" type="button"><svg width="20px" height="20px"><use xlink:href="images/sprite.svg#cross-20"></use></svg></button>
                            </div>
                            <div class="block-sidebar__item">
                                <div class="widget-filters widget widget-filters--offcanvas--mobile" data-collapse="" data-collapse-opened-class="filter--opened"><h4 class="widget-filters__title widget__title">Kategori</h4>
                                    <div class="widget-filters__list">
                                        <div class="widget-filters__item">
                                            <div class="filter filter--opened" data-collapse-item="">
                                                <div class="filter__body" data-collapse-content="">
                                                    <div class="filter__container">
                                                        <div class="filter-categories">
                                                            <ul class="filter-categories__list">
                                                                @foreach(@$kategori as $cate)
                                                                <li class="filter-categories__item filter-categories__item--parent"><svg class="filter-categories__arrow" width="6px" height="9px"><use xlink:href="images/sprite.svg#arrow-rounded-left-6x9"></use></svg> <a href="{{ url('/category/'.@$cate->id) }}">{{ @$cate->nama_kategori }}</a>
                                                                    <div class="filter-categories__counter">{{ count(@$countproduk->where('kategori_id',@$cate->id)) }}</div>
                                                                </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="shop-layout__content">
                    <div class="block">
                        <div class="products-view">
                            <div class="products-view__options">
                                <div class="view-options view-options--offcanvas--mobile">
                                    <div class="view-options__filters-button">
                                        <button type="button" class="filters-button"><svg class="filters-button__icon" width="16px" height="16px"><use xlink:href="images/sprite.svg#filters-16"></use></svg> <span class="filters-button__title">Kategori</span> <span class="filters-button__counter">{{ @$totalkategori }}</span></button>
                                    </div>
                                    <div class="view-options__layout">
                                        <div class="layout-switcher">
                                            <div class="layout-switcher__list">
                                                <button data-layout="grid-3-sidebar" data-with-features="false" title="Grid" type="button" class="layout-switcher__button"><svg width="16px" height="16px"><use xlink:href="{{ asset('public/frontend/images/sprite.svg#layout-grid-16x16') }}"></use></svg></button> 
                                                <!-- <button data-layout="grid-3-sidebar" data-with-features="true" title="Grid With Features" type="button" class="layout-switcher__button"><svg width="16px" height="16px"><use xlink:href="{{ asset('public/frontend/images/sprite.svg#layout-grid-with-details-16x16') }}"></use></svg></button>  -->
                                                <button data-layout="list" data-with-features="false" title="List" type="button" class="layout-switcher__button layout-switcher__button--active"><svg width="16px" height="16px"><use xlink:href="{{ asset('public/frontend/images/sprite.svg#layout-list-16x16') }}"></use></svg></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="view-options__divider"></div>
                                </div>
                            </div>


                            <div class="products-view__list products-list" data-layout="list" data-with-features="false" data-mobile-grid-columns="2">
                                <div class="products-list__body">
                                    @foreach(@$result as $rs)
                                    <div class="products-list__item">
                                        <div class="product-card product-card--hidden-actions">
                                            <div class="product-card__image product-image"><a href="{{ url('/view/produk/'.@$rs->id) }}" class="product-image__body"><img class="product-image__img" src="{{ asset('public/img/produk/'.@$rs->foto_produk) }}" alt=""></a></div>
                                            <div class="product-card__info">
                                                <div class="product-card__name">
                                                    <a href="{{ url('/view/produk/'.@$rs->id) }}">{{ @$rs->nama_produk }}</a>
                                                </div>
                                                <div class="product-card__rating">
                                                    <div class="product-card__rating-legend">{{ @$rs->total_penjualan }} Terjual</div>
                                                </div>
                                            </div>
                                            <div class="product-card__actions">
                                                <div class="product-card__availability">Stok: <span class="text-success">{{ @$rs->stok }}</span></div>
                                                <div class="product-card__prices">Rp. {{ number_format(@$rs->harga,0,',','.')}}</div>
                                                <div class="product-card__buttons">
                                                    <a href="{{ url('/keranjang/add/'.@$rs->id) }}" class="btn btn-primary product-card__addtocart" type="button"><i class="fa fa-shopping-cart"></i> Keranjang</a> 
                                                    <a href="{{ url('/keranjang/add/'.@$rs->id) }}" class="btn btn-secondary product-card__addtocart product-card__addtocart--list" type="button"><i class="fa fa-shopping-cart"></i> Keranjang</a> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach

                                </div>
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