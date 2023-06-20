<?= $this->extend('layout/dashboardLayout') ?>

<?= $this->section('content') ?>
    <div class="card shadow-lg mx-4 card-profile-bottom">
      <div class="card-body p-3">
        <div class="row gx-4">
          <div class="col-auto">
            <div class="avatar avatar-xl position-relative">
              <img src="<?= base_url('uploads/'.$content['picture']) ?>" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
            </div>
          </div>
          <div class="col-auto my-auto">
            <div class="h-100">
              <h5 class="mb-1">
                <?= $content['nama'] ?>
              </h5>
              <p class="mb-0 font-weight-bold text-sm">
                <?= $content['role'] ?>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
            <form id="profile" enctype="multipart/form-data">
              <p class="text-uppercase text-sm">User Information</p>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="formFile" class="form-label">Foto </label>
                    <input class="form-control form-control-sm" name="picture" id="formFile" type="file" value="<?= $content['picture'] ?>">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Username</label>
                    <input class="form-control" id="id" name="id" type="text" value="<?= $content['id'] ?>" hidden>
                    <input class="form-control" id="username" name="username" type="text" value="<?= $content['username'] ?>">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Email address</label>
                    <input disabled class="form-control" id="email" name="email" type="email" value="<?= $content['email'] ?>">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Nama Lengkap</label>
                    <input class="form-control" id="nama" name="nama" type="text" value="<?= $content['nama'] ?>">
                  </div>
                </div>
              </div>
              <hr class="horizontal dark">
              <p class="text-uppercase text-sm">Contact Information</p>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Alamat</label>
                    <input class="form-control" id="alamat" name="alamat" type="text" value="<?= $content['alamat'] ?>">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Nomor HP</label>
                    <input class="form-control" id="nomor_hp" name="nomor_hp" type="number" value="<?= $content['nomor_hp'] ?>">
                  </div>
                </div>
              </div>
              <button type="submit" class="btn btn-primary btn-sm ms-auto">Simpan</button>
            </form>
            </div>
          </div>
        </div>
      </div>
    </div>
<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script src="<?= base_url('js/SignOut.js') ?>"></script>
<script src="<?= base_url('js/UpdateProfile.js') ?>"></script>
<?= $this->endSection() ?>