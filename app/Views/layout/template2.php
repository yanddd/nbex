<!doctype html>
<html class="no-js" lang="">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title><?= $title; ?></title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- favicon
		============================================ -->
  <link rel="shortcut icon" type="image/x-icon" href="<?= base_url(); ?>/img/logo/ptpn5.png">
  <!-- Google Fonts
		============================================ -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
  <!-- Bootstrap CSS
		============================================ -->
  <link rel="stylesheet" href="<?= base_url(); ?>/css/bootstrap.min.css">
  <!-- Bootstrap CSS
		============================================ -->
  <link href="<?= base_url(); ?>/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <!-- owl.carousel CSS
		============================================ -->
  <link rel="stylesheet" href="<?= base_url(); ?>/css/owl.carousel.css">
  <link rel="stylesheet" href="<?= base_url(); ?>/css/owl.theme.css">
  <link rel="stylesheet" href="<?= base_url(); ?>/css/owl.transitions.css">
  <!-- meanmenu CSS
		============================================ -->
  <link rel="stylesheet" href="<?= base_url(); ?>/css/meanmenu/meanmenu.min.css">
  <!-- animate CSS
		============================================ -->
  <link rel="stylesheet" href="<?= base_url(); ?>/css/animate.css">
  <!-- normalize CSS
		============================================ -->
  <link rel="stylesheet" href="<?= base_url(); ?>/css/normalize.css">
  <!-- mCustomScrollbar CSS
		============================================ -->
  <link rel="stylesheet" href="<?= base_url(); ?>/css/scrollbar/jquery.mCustomScrollbar.min.css">
  <!-- jvectormap CSS
		============================================ -->
  <link rel="stylesheet" href="<?= base_url(); ?>/css/jvectormap/jquery-jvectormap-2.0.3.css">
  <!-- notika icon CSS
		============================================ -->
  <link rel="stylesheet" href="<?= base_url(); ?>/css/notika-custom-icon.css">
  <!-- wave CSS
		============================================ -->
  <link rel="stylesheet" href="<?= base_url(); ?>/css/wave/waves.min.css">
  <!-- main CSS
		============================================ -->
  <link rel="stylesheet" href="<?= base_url(); ?>/css/main.css">
  <!-- style CSS
		============================================ -->
  <link rel="stylesheet" href="<?= base_url(); ?>/css/style.css">
  <!-- responsive CSS
		============================================ -->
  <link rel="stylesheet" href="<?= base_url(); ?>/css/responsive.css">
  <link rel="stylesheet" href="<?= base_url(); ?>/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="<?= base_url(); ?>/css/bootstrap.min.css">
  <!-- font awesome CSS
		============================================ -->
  <link rel="stylesheet" href="<?= base_url(); ?>/css/font-awesome.min.css">
  <!-- owl.carousel CSS
		============================================ -->
  <link rel="stylesheet" href="<?= base_url(); ?>/css/owl.transitions.css">
  <!-- meanmenu CSS
		============================================ -->
  <link rel="stylesheet" href="<?= base_url(); ?>/css/meanmenu/meanmenu.min.css">
  <!-- animate CSS
		============================================ -->
  <link rel="stylesheet" href="<?= base_url(); ?>/css/animate.css">
  <!-- normalize CSS
		============================================ -->
  <link rel="stylesheet" href="<?= base_url(); ?>/css/normalize.css">
  <!-- wave CSS
		============================================ -->
  <link rel="stylesheet" href="<?= base_url(); ?>/css/wave/button.css">
  <!-- mCustomScrollbar CSS
		============================================ -->
  <link rel="stylesheet" href="<?= base_url(); ?>/css/scrollbar/jquery.mCustomScrollbar.min.css">
  <!-- Notika icon CSS
		============================================ -->
  <link rel="stylesheet" href="<?= base_url(); ?>/css/notika-custom-icon.css">
  <!-- Data Table JS
		============================================ -->
  <!-- main CSS
		============================================ -->

  <!-- style CSS
		============================================ -->
  <!-- responsive CSS
		============================================ -->
  <!-- modernizr JS
		============================================ -->
  <script src="<?= base_url(); ?>/js/vendor/modernizr-2.8.3.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
  <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
  <!-- Start Header Top Area -->
  <?= $this->include('layout/header'); ?>
  <!-- End Header Top Area -->
  <!-- Start content area -->
  <?= $this->renderSection('content'); ?>
  <!-- End content area-->
  <!-- Start Footer area-->
  <div class="footer-copyright-area">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="footer-copy-right">
            <p style="color: white;">Copyright © 2021
              . All rights reserved. by ptpn5</a>.</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="<?= base_url(); ?>/js/vendor/jquery-1.12.4.min.js"></script>
  <script src="<?= base_url(); ?>/js/bootstrap.min.js"></script>
  <script src="<?= base_url(); ?>/js/wow.min.js"></script>
  <script src="<?= base_url(); ?>/js/jquery-price-slider.js"></script>
  <script src="<?= base_url(); ?>/js/owl.carousel.min.js"></script>
  <script src="<?= base_url(); ?>/js/jquery.scrollUp.min.js"></script>
  <script src="<?= base_url(); ?>/js/meanmenu/jquery.meanmenu.js"></script>
  <script src="<?= base_url(); ?>/js/counterup/jquery.counterup.min.js"></script>
  <script src="<?= base_url(); ?>/js/counterup/waypoints.min.js"></script>
  <script src="<?= base_url(); ?>/js/counterup/counterup-active.js"></script>
  <script src="<?= base_url(); ?>/js/scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
  <script src="<?= base_url(); ?>/js/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
  <script src="<?= base_url(); ?>/js/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
  <script src="<?= base_url(); ?>/js/jvectormap/jvectormap-active.js"></script>
  <script src="<?= base_url(); ?>/js/sparkline/jquery.sparkline.min.js"></script>
  <script src="<?= base_url(); ?>/js/sparkline/sparkline-active.js"></script>
  <script src="<?= base_url(); ?>/js/flot/jquery.flot.js"></script>
  <script src="<?= base_url(); ?>/js/flot/jquery.flot.resize.js"></script>
  <script src="<?= base_url(); ?>/js/flot/jquery.flot.pie.js"></script>
  <script src="<?= base_url(); ?>/js/flot/jquery.flot.tooltip.min.js"></script>
  <script src="<?= base_url(); ?>/js/flot/jquery.flot.orderBars.js"></script>
  <script src="<?= base_url(); ?>/js/flot/curvedLines.js"></script>
  <script src="<?= base_url(); ?>/js/flot/flot-active.js"></script>
  <script src="<?= base_url(); ?>/js/knob/jquery.knob.js"></script>
  <script src="<?= base_url(); ?>/js/knob/jquery.appear.js"></script>
  <script src="<?= base_url(); ?>/js/knob/knob-active.js"></script>
  <script src="<?= base_url(); ?>/js/wave/waves.min.js"></script>
  <script src="<?= base_url(); ?>/js/wave/wave-active.js"></script>
  <script src="<?= base_url(); ?>/js/chat/moment.min.js"></script>
  <script src="<?= base_url(); ?>/js/chat/jquery.chat.js"></script>
  <script src="<?= base_url(); ?>/js/todo/jquery.todo.js"></script>
  <script src="<?= base_url(); ?>/js/plugins.js"></script>
  <script src="<?= base_url(); ?>/js/main.js"></script>
  <script src="<?= base_url(); ?>/js/tawk-chat.js"></script>
  <script src="<?= base_url(); ?>/js/data-table/jquery.dataTables.min.js"></script>
  <script src="<?= base_url(); ?>/js/data-table/data-table-act.js"></script>



</body>

</html>