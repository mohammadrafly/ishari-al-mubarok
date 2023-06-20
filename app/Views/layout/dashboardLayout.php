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
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
  <link id="pagestyle" href="<?= base_url('assets_be/css/argon-dashboard.css?v=2.0.4') ?>" rel="stylesheet" />
  <style>
    .zoomable-image.medium-zoom-image--opened {
      z-index: 1050; /* Set a higher z-index value to overlap the modal */
    }
  </style>
</head>
<body class="g-sidenav-show   bg-gray-100">
  <div class="min-height-300 bg-primary position-absolute w-100"></div>
  <?= $this->include('layout/partials/dashboardSideBar') ?>
  <main class="main-content position-relative border-radius-lg ">
    <?= $this->include('layout/partials/dashboardHeader') ?>
    <div class="container-fluid py-4">
      <?= $this->renderSection('content') ?>
      <?= $this->include('layout/partials/dashboardFooter') ?>
    </div>
  </main>
  <?= $this->renderSection('scripts') ?>
  <!--   Core JS Files   -->
  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.15/dist/sweetalert2.all.min.js"></script>
  <script src="<?= base_url('assets_be/js/core/popper.min.js') ?>"></script>
  <script src="<?= base_url('assets_be/js/core/bootstrap.min.js') ?>"></script>
  <script src="<?= base_url('assets_be/js/plugins/perfect-scrollbar.min.js') ?>"></script>
  <script src="<?= base_url('assets_be/js/plugins/smooth-scrollbar.min.js') ?>"></script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <script>
    $(document).ready(function() {
        var currentUrl = window.location.href;
        $("a").each(function() {
            if ($(this).attr("href") === currentUrl) {
                $(this).addClass("active");
            } else {
                $(this).removeClass("active");
            }
        });
    });
  </script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="<?= base_url('assets_be/js/argon-dashboard.min.js?v=2.0.4') ?>"></script>
</body>

</html>