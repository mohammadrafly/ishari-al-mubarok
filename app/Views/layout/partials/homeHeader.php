<!-- ======= Header ======= -->
<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center justify-content-between">

      <h1 class="logo"><a href="<?= base_url('/') ?>">Ishari Al Mubarok</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
          <li><a class="nav-link scrollto" href="#about">About</a></li>
          <li><a class="nav-link scrollto " href="#portfolio">Gallery</a></li>
          <li><a class="nav-link scrollto" href="#team">Pengurus</a></li>
          <?php if (session()->get('role') == 'client'): ?>
            <li class="dropdown"><a href="#"><span>Hi, <?= session()->get('nama') ?></span> <i class="bi bi-chevron-down"></i></a>
              <ul>
                <li><a href="<?= base_url('dashboard/profile/'.session()->get('email')) ?>">Profile</a></li>
                <li><a href="<?= base_url('dashboard/pesanan/saya/'.session()->get('email')) ?>">Pesanan</a></li>
                <li><a href="javascript:void(0);" onclick="signOut()">Keluar</a></li>
              </ul>
            </li>
          <?php elseif (session()->get('role') == 'admin'): ?>
            <li class="dropdown"><a href="#"><span>Hi, <?= session()->get('nama') ?></span> <i class="bi bi-chevron-down"></i></a>
              <ul>
                <li><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
                <li><a href="javascript:void(0);" onclick="signOut()">Keluar</a></li>
              </ul>
            </li>
          <?php elseif (session()->get('role') == 'pengurus'): ?>
            <li class="dropdown"><a href="#"><span>Hi, <?= session()->get('nama') ?></span> <i class="bi bi-chevron-down"></i></a>
              <ul>
                <li><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
                <li><a href="javascript:void(0);" onclick="signOut()">Keluar</a></li>
              </ul>
            </li>
          <?php else: ?>
            <li><a class="getstarted scrollto" href="<?= base_url('signin')?>">Login/Register</a></li>
          <?php endif?>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->