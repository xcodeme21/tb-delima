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
                            <li class="breadcrumb-item"><a href="index.html">Home</a> <svg class="breadcrumb-arrow" width="6px" height="9px"><use xlink:href="{{ asset('public/frontend/images/sprite.svg#arrow-rounded-right-6x9')  }}"></use></svg></li><li class="breadcrumb-item"><a href="{{ url('/category/'.@$rs->kategori_id) }}">{{ @$rs->nama_kategori }}</a> <svg class="breadcrumb-arrow" width="6px" height="9px"><use xlink:href="{{ asset('public/frontend/images/sprite.svg#arrow-rounded-right-6x9') }}"></use></svg></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ @$rs->nama_produk }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>


        <div class="block">
            <div class="container">
                <div class="product product--layout--standard" data-layout="standard">
                    <div class="product__content">
                        <!-- .product__gallery -->
                        <div class="product__gallery">
                            <div class="product-gallery">
                                <div class="product-gallery__featured">
                                    <button class="product-gallery__zoom"><svg width="24px" height="24px"><use xlink:href="images/sprite.svg#zoom-in-24"></use></svg></button>
                                    <div class="owl-carousel owl-loaded owl-drag" id="product-image">
                                        <div class="owl-stage-outer">
                                            <div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 2655px;">
                                                <div class="owl-item active" style="width: 531px;">
                                                    <div class="product-image product-image--location--gallery">
                                                        <a href="{{ asset('public/img/produk/'.@$rs->foto_produk) }}" data-width="700" data-height="700" class="product-image__body" target="_blank"><img class="product-image__img" src="{{ asset('public/img/produk/'.@$rs->foto_produk) }}" alt="{{ @$rs->nama_produk }}"></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="owl-nav disabled">
                                            <button type="button" role="presentation" class="owl-prev"><span aria-label="Previous">‹</span></button>
                                            <button type="button" role="presentation" class="owl-next"><span aria-label="Next">›</span></button>
                                        </div>

                                        <div class="owl-dots disabled"></div>

                                        <div class="owl-nav disabled">
                                            <button type="button" role="presentation" class="owl-prev"><span aria-label="Previous">‹</span></button>
                                            <button type="button" role="presentation" class="owl-next"><span aria-label="Next">›</span></button>
                                        </div>

                                        <div class="owl-dots disabled"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- .product__gallery / end -->

                        <!-- .product__info -->
                        <div class="product__info">
                            <div class="product__wishlist-compare">
                                <button type="button" class="btn btn-sm btn-light btn-svg-icon" data-toggle="tooltip" data-placement="right" title="" data-original-title="Wishlist"><svg width="16px" height="16px"><use xlink:href="images/sprite.svg#wishlist-16"></use></svg></button> 
                                <button type="button" class="btn btn-sm btn-light btn-svg-icon" data-toggle="tooltip" data-placement="right" title="" data-original-title="Compare"><svg width="16px" height="16px"><use xlink:href="images/sprite.svg#compare-16"></use></svg></button>
                            </div>

                            <h1 class="product__name">{{ @$rs->nama_produk }}</h1>
                            <div class="product__rating">
                                <div class="product__rating-legend">
                                    <a href="#">{{ @$rs->total_penjualan }} Terjual</a><span></span>
                                </div>
                            </div>
                            <ul class="product__meta">
                                <li class="product__meta-availability">Stok: <span class="text-success">{{ @$rs->stok }}</span></li>
                            </ul>
                        </div>
                        <!-- .product__info / end -->

                        <!-- .product__sidebar -->
                        <div class="product__sidebar">
                            <div class="product__availability">Stok: <span class="text-success">{{ @$rs->stok }}</span></div>
                            <div class="product__prices">Rp. {{ number_format(@$rs->harga,0,',','.')}}</div>

                            <!-- .product__options -->
                            {{ Form::open(['route'=>'tambah-keranjang' ,'method' => 'post', 'class'=>'product__options  animated bounceIn','enctype'=>'multipart/form-data']) }}
                            {{ Form::token() }} 
                                <div class="form-group product__option">
                                    <label class="product__option-label" for="product-quantity">Jumlah</label>
                                    <div class="product__actions">
                                        <div class="product__actions-item">
                                            <div class="input-number product__quantity">
                                                <input id="product-quantity" class="input-number__input form-control form-control-lg" type="number" min="1" value="1" name="jumlah" required>
                                                <div class="input-number__add"></div>
                                                <div class="input-number__sub"></div>
                                            </div>
                                        </div>
                                        <input type="hidden" value="{{ @$rs->id }}" name="id">
                                        <div class="product__actions-item product__actions-item--addtocart">
                                            <button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-shopping-cart"></i> Keranjang</button>
                                        </div>
                                    </div>
                                </div>
                            {{ Form::close() }}
                            <!-- .product__options / end -->
                        </div>
                    </div>
                </div>

                <div class="product-tabs product-tabs--sticky">
                    <div class="product-tabs__list">
                        <div class="product-tabs__list-body">
                            <div class="product-tabs__list-container container">
                                <a href="#tab-description" class="product-tabs__item product-tabs__item--active">Deskripsi</a>
                                <a href="#tab-reviews" class="product-tabs__item">Penilaian Produk</a></div>
                            </div>
                        </div>
                        <div class="product-tabs__content">
                            <div class="product-tabs__pane" id="tab-description">
                                <div class="typography">
                                    <h3 class="reviews-view__header">Deskripsi</h3><br>{!! @$rs->keterangan_produk !!}
                                </div>
                            </div>
                            <div class="product-tabs__pane product-tabs__pane--active" id="tab-reviews">
                                <div class="reviews-view">
                                    <div class="reviews-view__list">
                                        <h3 class="reviews-view__header">Penilaian Produk</h3>
                                        <div class="reviews-list">
                                            <ol class="reviews-list__content">
                                                @foreach(@$reviews as $rev)
                                                <li class="reviews-list__item">
                                                    <div class="review">
                                                        <div class="review__avatar">
                                                            <img src="{{ asset('public/img/pelanggan/'.@$rev->foto) }}" alt="">
                                                        </div>
                                                        <div class="review__content">
                                                            <div class="review__author">{{ @$rev->nama }}</div>
                                                            <div class="review__text">{{ @$rev->reviews }}</div>
                                                            <div class="review__date">{{ @$rev->created_at }}</div>
                                                        </div>
                                                    </div>
                                                </li>
                                                @endforeach
                                            </ol>
                                        </div>
                                    </div>

                                    @if(Auth::check())
                                    {{ Form::open(['route'=>'tulis-penilaian' ,'method' => 'post', 'class'=>'reviews-view__form animated bounceIn','enctype'=>'multipart/form-data']) }}
                                    {{ Form::token() }} 
                                        <h3 class="reviews-view__header">Tulis Penilaian</h3>
                                        <div class="row">
                                            <div class="col-12 col-lg-9 col-xl-8">
                                                <div class="form-group">
                                                    <label for="review-text">Penilaian Anda</label> 
                                                    <textarea class="form-control" id="review-text" name="reviews" rows="6" required></textarea>
                                                    <input type="hidden" name="produk_id" value="{{ @$rs->id }}">
                                                </div>
                                                <div class="form-group mb-0">
                                                    <button type="submit" class="btn btn-primary btn-lg"><i class="fas fa-paper-plane"></i> Kirim</button>
                                                </div>
                                            </div>
                                        </div>
                                    {{ Form::close() }} 
                                    @endif

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