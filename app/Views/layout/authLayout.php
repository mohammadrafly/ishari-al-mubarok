<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url('assets_be/img/apple-icon.png') ?>">
  <link rel="icon" type="image/png" href="<?= base_url('assets_be/img/favicon.png') ?>">
  <title>
    Ishari Al Mubarok
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="<?= base_url('assets_be/css/nucleo-icons.css') ?>" rel="stylesheet" />
  <link href="<?= base_url('assets_be/css/nucleo-svg.css') ?>" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="<?= base_url('assets_be/css/nucleo-svg.css') ?>" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="<?= base_url('assets_be/css/argon-dashboard.css?v=2.0.4') ?>" rel="stylesheet" />
</head>

<body class="">
  <?= $this->renderSection('content') ?>

  <?= $this->renderSection('scripts') ?>
  <!--   Core JS Files   -->
  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.15/dist/sweetalert2.all.min.js"></script>
  <script src="<?= base_url('assets_be/js/core/popper.min.js') ?>"></script>
  <script src="<?= base_url('assets_be/js/core/bootstrap.min.js') ?>"></script>
  <script src="<?= base_url('assets_be/js/plugins/perfect-scrollbar.min.js') ?>"></script>
  <script src="<?= base_url('assets_be/js/plugins/smooth-scrollbar.min.js') ?>"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="<?= base_url('assets_be/js/argon-dashboard.min.js?v=2.0.4') ?>"></script>
</body>

</html>