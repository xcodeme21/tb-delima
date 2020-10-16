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
                <div class="page-header__title"><br><h1><i class="fa fa-history small"></i> Detail Riwayat Pesanan</h1></div>
            </div>
        </div>


        
        <div class="block">
            <div class="container">
                <div class="row">
                    @if(@$rs->metode_pembayaran == 1 && @$rs->status_pembayaran == 0 && @$rs->bukti_pembayaran == null)
                        <div class="col-12 mb-3">
                            <div class="alert alert-lg alert-danger">
                                <i class="fa fa-info-circle fa-fw"></i> Silahkan upload bukti transfer. Agar pesanan kamu dapat dilanjutkan.
                            </div>
                        </div>
                    @endif
                    <div class="col-12 col-lg-12 mt-4 mt-lg-0">
                        <div class="card">      
                            <div class="order-header">
                                <div class="order-header__actions">
                                    <a href="{{ route('riwayat-pesanan') }}" class="btn btn-xs btn-secondary"><i class="fa fa-arrow-left"></i> Kembali</a>
                                </div>
                                <h5 class="order-header__title">#{{ @$rs->no_invoice }}</h5>
                                <div class="order-header__subtitle">
                                    Tanggal Transaksi <mark class="order-header__date">{{ @$rs->tanggal_transaksi }}</mark> dan saat ini 
                                    @if(@$rs->status_pengiriman == 0) 
                                    <mark class="order-header__status text-danger">Belum Diproses </mark>
                                    @elseif(@$rs->status_pengiriman == 1) 
                                    <mark class="order-header__status text-warning">Sedang Diproses  </mark>
                                    @elseif(@$rs->status_pengiriman == 2) 
                                    <mark class="order-header__status text-info">Sedang Dikirim </mark>
                                    @else
                                    <mark class="order-header__status text-success">Selesai </mark>
                                    @endif.
                                </div>
                            </div>

                            <div class="card-divider"></div>

                            <div class="card-table">
                                <div class="table-responsive-sm">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>Product</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody class="card-table__body card-table__body--merge-rows">
                                            @foreach(@$detail as $det)
                                            <tr>
                                                <td>{{ @$det->nama_produk }} × {{ @$det->jumlah }}</td>
                                                <td>Rp. {{ number_format(@$det->harga_per_produk,0,',','.')}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Total</th>
                                                <td class="text-danger">Rp. {{ number_format(@$rs->total_bayar,0,',','.')}}</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3 no-gutters mx-n2">
                            @if(@$rs->metode_pembayaran == 1 && @$rs->status_pembayaran == 0)
                            <div class="col-sm-6 col-12 px-2 mt-sm-0 mt-3">
                                <div class="card address-card address-card--featured">
                                    <div class="address-card__body">
                                        <div class="address-card__badge address-card__badge--muted">Bukti Transfer</div>
                                        @if(@$rs->status_pengiriman == 0)
                                        {{ Form::open(['route'=>'uploadbuktipembayaran-riwayat-pesanan' ,'method' => 'post', 'class'=>'form-horizontal mt-3  animated bounceIn','enctype'=>'multipart/form-data']) }} 
                                        {{ Form::token() }}
                                        <div class="form-group row">
                                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Gambar</label>
                                            <div class="col-sm-9">
                                                <input type="file" class="form-control form-control-line" name="bukti_pembayaran" placeholder="Foto">
                                                <input type="hidden" name="id" value="{{ @$rs->id }}">
                                            </div>
                                        </div>
                                        <div class="form-group row-fluid" align="right">
                                            <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-upload"></i> Upload</button>
                                        </div>
                                        {{ Form::close() }}
                                        @endif

                                        @if(@$rs->bukti_pembayaran != null)
                                        <br>
                                        <a href="{{ asset('public/img/bukti/'.@$rs->bukti_pembayaran) }}" target="_blank"><img src="{{ asset('public/img/bukti/'.@$rs->bukti_pembayaran) }}" width="250px"/></a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endif

                            <div class="col-sm-6 col-12 px-2 mt-sm-0 mt-3">
                                <div class="card address-card address-card--featured">
                                    <div class="address-card__body">
                                        <div class="address-card__badge address-card__badge--muted">Tujuan Pengiriman</div>
                                        <div class="address-card__name">{{ @$rs->nama_tujuan }}</div>
                                        <div class="address-card__row"></div>
                                        <div class="address-card__row">
                                            <div class="address-card__row-title">Alamat</div>
                                            <div class="address-card__row-content">{{ @$rs->alamat_tujuan }}</div>
                                        </div>
                                        <div class="address-card__row">
                                            <div class="address-card__row-title">No. HP</div>
                                            <div class="address-card__row-content">{{ @$rs->no_hp_tujuan }}</div>
                                        </div>
                                    </div>
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