<script src="{{ asset('public/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('public/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<script src="{{ asset('public/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('public/plugins/sparklines/sparkline.js') }}"></script>
<script src="{{ asset('public/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<script src="{{ asset('public/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('public/plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('public/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<script src="{{ asset('public/plugins/summernote/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('public/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<script src="{{ asset('public/dist/js/adminlte.js') }}"></script>
<script src="{{ asset('public/dist/js/pages/dashboard.js') }}"></script>
<script src="{{ asset('public/dist/js/demo.js') }}"></script>
<script src="{{ asset('public/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('public/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('public/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('public/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('public/vendor/mckenziearts/laravel-notify/js/notify.js') }}"></script>
<script src="{{ asset('public/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('public/plugins/summernote/summernote-bs4.min.js') }}"></script>
<script>
$('div.alert').not('.alert-important').delay(3000).fadeOut(350);
</script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

})
</script>

@if(@$indexPage == "Produk" || @$indexPage == "Barang Masuk")
<script>
  $('.textarea').summernote({
  toolbar: [
    // [groupName, [list of button]]
    ['style', ['bold', 'italic', 'underline', 'clear']],
    ['font', ['strikethrough', 'superscript', 'subscript']],
    ['fontsize', ['fontsize']],
    ['color', ['color']],
    ['para', ['ul', 'ol', 'paragraph']],
    ['height', ['height']]
  ]
});
</script>

<script type="text/javascript">
		
		var rupiah = document.getElementById('rupiah');
		rupiah.addEventListener('keyup', function(e){
			rupiah.value = formatRupiah(this.value, '');
		});
 
		/* Fungsi formatRupiah */
		function formatRupiah(angka, prefix){
			var number_string = angka.replace(/[^,\d]/g, '').toString(),
			split   		= number_string.split(','),
			sisa     		= split[0].length % 3,
			rupiah     		= split[0].substr(0, sisa),
			ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
 
			if(ribuan){
				separator = sisa ? '.' : '';
				rupiah += separator + ribuan.join('.');
			}
 
			rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
			return prefix == undefined ? rupiah : (rupiah ? '' + rupiah : '');
		}
	</script>
@endif



<script>
function getTransaksiMasuk() {
  $.ajax({
    type: "GET",
    url: "{{ route('count-transaksi-masuk') }}"
  })
  .done(function( data ) {
    $('#counttransaksimasuk').html(data);

    setTimeout(getTransaksiMasuk, 1000);
  });
  }
  getTransaksiMasuk();
</script>


<script>
function getTransaksiProses() {
  $.ajax({
    type: "GET",
    url: "{{ route('count-transaksi-proses') }}"
  })
  .done(function( data ) {
    $('#counttransaksiproses').html(data);

    setTimeout(getTransaksiProses, 1000);
  });
  }
  getTransaksiProses();
</script>


<script>
function getTransaksiKirim() {
  $.ajax({
    type: "GET",
    url: "{{ route('count-transaksi-kirim') }}"
  })
  .done(function( data ) {
    $('#counttransaksikirim').html(data);

    setTimeout(getTransaksiKirim, 1000);
  });
  }
  getTransaksiKirim();
</script>