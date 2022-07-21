  <!--===============================================================================================-->
  <script src="/template/vendor/jquery/jquery-3.2.1.min.js"></script>
  <!--===============================================================================================-->
  <script src="/template/vendor/animsition/js/animsition.min.js"></script>
  <!--===============================================================================================-->
  <script src="/template/vendor/bootstrap/js/popper.js"></script>
  <script src="/template/vendor/bootstrap/js/bootstrap.min.js"></script>
  <!--===============================================================================================-->
  <script src="/template/vendor/select2/select2.min.js"></script>
  <!--===============================================================================================-->
  <script>
      $(".js-select2").each(function() {
          $(this).select2({
              minimumResultsForSearch: 20,
              dropdownParent: $(this).next('.dropDownSelect2')
          });
      })
  </script>
  <!--===============================================================================================-->
  <script src="/template/vendor/daterangepicker/moment.min.js"></script>
  <script src="/template/vendor/daterangepicker/daterangepicker.js"></script>
  <!--===============================================================================================-->
  <script src="/template/vendor/slick/slick.min.js"></script>
  <script src="/template/js/slick-custom.js"></script>
  <!--===============================================================================================-->
  <script src="/template/vendor/parallax100/parallax100.js"></script>
  <script>
      $('.parallax100').parallax100();
  </script>
  <!--===============================================================================================-->
  <script src="/template/vendor/MagnificPopup/jquery.magnific-popup.min.js"></script>
  <script>
      $('.gallery-lb').each(function() { // the containers for all your galleries
          $(this).magnificPopup({
              delegate: 'a', // the selector for gallery item
              type: 'image',
              gallery: {
                  enabled: true
              },
              mainClass: 'mfp-fade'
          });
      });
  </script>
  <!--===============================================================================================-->
  <script src="/template/vendor/isotope/isotope.pkgd.min.js"></script>
  <!--===============================================================================================-->
  <script src="/template/vendor/sweetalert/sweetalert.min.js"></script>
  <!--===============================================================================================-->
  <script src="/template/js/common/logout.js"></script>
  @section('scripts')
      <script>
          $('.js-addwish-detail').each(function() {
              var nameProduct = $(this).parent().parent().parent().find('.js-name-detail').html();

              $(this).on('click', function() {
                  swal(nameProduct, "is added to wishlist !", "success");

                  $(this).addClass('js-addedwish-detail');
                  $(this).off('click');
              });
          });

          /*---------------------------------------------*/

          $('.js-addcart-detail').each(function() {
              var nameProduct = $(this).parent().parent().parent().parent().find('.js-name-detail').html();
              $(this).on('click', function() {
                  swal(nameProduct, "is added to cart !", "success");
              });
          });
      </script>
      <!--===============================================================================================-->
      <script src="/template/vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
      <script>
          $('.js-pscroll').each(function() {
              $(this).css('position', 'relative');
              $(this).css('overflow', 'hidden');
              var ps = new PerfectScrollbar(this, {
                  wheelSpeed: 1,
                  scrollingThreshold: 1000,
                  wheelPropagation: false,
              });

              $(window).on('resize', function() {
                  ps.update();
              })
          });
      </script>
      <!--===============================================================================================-->
      <script src="/template/js/main.js"></script>
      <!--===============================================================================================-->
      <script src="/template/js/script.js"></script>
  @show

  <!--===============================================================================================-->
  @livewireScripts
  <!--===============================================================================================-->
  @stack('scripts')
  <!--===============================================================================================-->
