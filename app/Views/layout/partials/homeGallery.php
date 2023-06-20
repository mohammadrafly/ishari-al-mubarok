    <!-- ======= Portfolio Section ======= -->
    <section id="portfolio" class="portfolio">
      <div class="container">

        <div class="section-title">
          <span>Gallery</span>
          <h2>Gallery</h2>
          <p>Dokumen kegiatan kegiatan kami</p>
        </div>

        <div class="row">
          <div class="col-lg-12 d-flex justify-content-center">
            <ul id="portfolio-flters">
            </ul>
          </div>
        </div>

        <div class="row portfolio-container">
          <?php foreach($content as $data): ?>
          <div class="col-lg-4 col-md-6 portfolio-item filter-app">
            <img src="<?= base_url('uploads/'.$data['picture']) ?>" class="img-fluid" alt="">
          </div>
          <?php endforeach?>

        </div>

      </div>
    </section><!-- End Portfolio Section -->