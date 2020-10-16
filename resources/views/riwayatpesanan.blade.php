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
                <div class="page-header__title"><br><h1><i class="fa fa-history small"></i> Riwayat Pesanan</h1></div>
            </div>
        </div>


        <div class="block">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-12 mt-4 mt-lg-0">
                        <div class="card">
                            <div class="card-table">
                                <div class="table-responsive-sm">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>No Invoice</th>
                                                <th>Tanggal</th>
                                                <th>Metode Pembayaran</th>
                                                <th>Status Pembayaran</th>
                                                <th>Status Pengiriman</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach(@$pesanan as $pes)
                                            <tr>
                                                <td>
                                                    <a href="{{ url('/riwayat-pesanan/detail/'.@$pes->id) }}">#{{ @$pes->no_invoice }}</a>
                                                </td>
                                                <td>{{ @$pes->tanggal_transaksi }}</td>
                                                <td>@if(@$pes->metode_pembayaran == 1) Transfer Bank @else Cash On Delivery @endif</td>
                                                <td>
                                                    @if(@$pes->status_pembayaran == 0 && @$pes->bukti_pembayaran == null) 
                                                    <span class="text-danger">Belum Bayar</span>
                                                    @elseif(@$pes->status_pembayaran == 0 && @$pes->bukti_pembayaran != null)
                                                    <span class="text-info">Verifikasi Pembayaran</span>
                                                    @else
                                                    <span class="text-success">Sudah Bayar </span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if(@$pes->status_pengiriman == 0) 
                                                    Belum Diproses 
                                                    @elseif(@$pes->status_pengiriman == 1) 
                                                    Sedang Diproses  
                                                    @elseif(@$pes->status_pengiriman == 2) 
                                                    Sedang Dikirim
                                                    @else
                                                    Selesai 
                                                    @endif
                                                </td>
                                                <td>Rp. {{ number_format(@$pes->total_bayar,0,',','.')}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
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