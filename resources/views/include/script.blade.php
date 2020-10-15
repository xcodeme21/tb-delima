<script src="{{ asset('public/frontend/vendor/jquery/jquery.min.js') }}"></script>
                                 <script src="{{ asset('public/frontend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
                                 <script src="{{ asset('public/frontend/vendor/owl-carousel/owl.carousel.min.js') }}"></script>
                                 <script src="{{ asset('public/frontend/vendor/nouislider/nouislider.min.js') }}"></script>
                                 <script src="{{ asset('public/frontend/vendor/photoswipe/photoswipe.min.js') }}"></script>
                                 <script src="{{ asset('public/frontend/vendor/photoswipe/photoswipe-ui-default.min.js') }}"></script>
                                 <script src="{{ asset('public/frontend/vendor/select2/js/select2.min.js') }}"></script>
                                 <script src="{{ asset('public/frontend/js/number.js') }}"></script>
                                 <script src="{{ asset('public/frontend/js/main.js') }}"></script>
                                 <script src="{{ asset('public/frontend/js/header.js') }}"></script>
                                 <script src="{{ asset('public/frontend/vendor/svg4everybody/svg4everybody.min.js') }}"></script>
                                 <script>svg4everybody();</script>
                                 <script src="{{ asset('public/vendor/mckenziearts/laravel-notify/js/notify.js') }}"></script>
                                 @if(@$indexPage != "Riwayat Pesanan")
                                <script>
                                $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
                                </script>
                                @endif