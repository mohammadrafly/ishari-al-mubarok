<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex align-items-center">

<div class="container">
  <div class="row">
    <div class="col-lg-6 pt-5 pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center">
                    <?php if (!empty(session()->getFlashdata('error'))) : ?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <?php echo session()->getFlashdata('error'); ?>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty(session()->getFlashdata('success'))) : ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?php echo session()->getFlashdata('success'); ?>
                        </div>
                    <?php endif; ?>
      <h1>Assalamualaikum</h1>
      <h2>Selamat datang di website kami.</h2>
      <div class="d-flex">
        <?php if (!session()->get('LoginTrue')): ?>
        <a href="<?= base_url('signup') ?>" class="btn-get-started scrollto">Pesan Sekarang</a>
        <?php else: ?>
        <a href="<?= base_url('dashboard/pesanan/saya/'.session()->get('email')) ?>" class="btn-get-started scrollto">Pesan Sekarang</a>
        <?php endif ?>
        <a href="https://youtu.be/oqqOXS9eQcQ" class="glightbox btn-watch-video"><i class="bi bi-play-circle"></i><span>Lihat Video</span></a>
      </div>
    </div>
    <div class="col-lg-6 order-1 order-lg-2 hero-img">
      <img src="assets/img/hero-img.png" class="img-fluid animated" alt="">
    </div>
  </div>
</div>

</section><!-- End Hero -->