<?= $this->extend('layout/homeLayout') ?>
<?= $this->section('content') ?>
</br>
</br>
</br>
</br>
   <!-- ======= Contact Section ======= -->
   <section id="contact" class="contact">
      <div class="container">

        <div class="section-title">
          <span>Profile</span>
          <h2>Profile</h2>
          <p>Sit sint consectetur velit quisquam cupiditate impedit suscipit alias</p>
        </div>
        <form id="profile" role="form" enctype="multipart/form-data">
        <div class="row">

          <div class="col-lg-4 d-flex align-items-stretch">
            <div class="info">
                <?php if (!empty($content['picture'])): ?>
                    <img src="<?= base_url('uploads/'.$content['picture']) ?>" width="100%"/>
                <?php else: ?>
                    <img src="<?= base_url('assets/img/default.png') ?>" width="100%"/>
                <?php endif ?>
                <div class="form-group col-md-12">
                  <input class="form-control" id="id" name="id" type="text" value="<?= $content['id'] ?>" hidden>
                  <input type="file" class="form-control" name="picture" id="formFile" type="file" value="<?= $content['picture'] ?>">
                </div>
            </div>
          </div>

          <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch">
            <div class="php-email-form">
              <div class="row">
                <div class="form-group col-md-6">
                  <label for="name">Nama</label>
                  <input class="form-control" id="nama" name="nama" type="text" value="<?= $content['nama'] ?>">
                </div>
                <div class="form-group col-md-6 mt-3 mt-md-0">
                  <label for="name">Email</label>
                  <input class="form-control" id="email" name="email" type="text" value="<?= $content['email'] ?>" disabled>
                </div>
              </div>
              <div class="row">
                <div class="form-group col-md-6">
                  <label for="name">Username</label>
                  <input class="form-control" id="username" name="username" type="text" value="<?= $content['username'] ?>">
                </div>
                <div class="form-group col-md-6 mt-3 mt-md-0">
                  <label for="name">Nomor HP</label>
                  <input class="form-control" id="nomor_hp" name="nomor_hp" type="text" value="<?= $content['nomor_hp'] ?>">
                </div>
              </div>
              <div class="form-group mt-3">
                <label for="name">Alamat</label>
                <textarea class="form-control" id="alamat" name="alamat" type="text" rows="5"><?= $content['alamat'] ?></textarea>
              </div>
              <div class="text-center"><button type="submit">Simpan</button></div>
            </div>
          </div>

        </div>
        </form>

      </div>
    </section><!-- End Contact Section -->
<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script src="<?= base_url('js/SignOut.js') ?>"></script>
<script src="<?= base_url('js/UpdateProfile.js') ?>"></script>
<?= $this->endSection() ?>