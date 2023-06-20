    <!-- ======= Team Section ======= -->
    <section id="team" class="team section-bg">
      <div class="container">

        <div class="section-title">
          <span>Pengurus</span>
          <h2>Pengurus</h2>
          <p>Susunan pengurus ISHARI AL-MUBAROK Rawan Barat Kecamatan Besuki Kabupaten Situbondo</p>
        </div>

        <div class="row">
        <?php if (!empty($pengurus)): ?>
          <?php foreach($pengurus as $dataPe): ?>
            <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
              <div class="member">
                <img src="<?= base_url('uploads/'.$dataPe->picture) ?>" alt="<?= $dataPe->picture ?>">
                <h4><?= $dataPe->nama ?></h4>
                <span><?= $dataPe->role ?></span>
                <div class="social">
                  <a href=""><i class="bi bi-twitter"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
            </div>
          <?php endforeach ?>
        <?php endif ?>
        </div>

      </div>
    </section><!-- End Team Section -->