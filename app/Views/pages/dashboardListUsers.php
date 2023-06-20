<?= $this->extend('layout/dashboardLayout') ?>

<?= $this->section('content') ?>
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>List Users</h6>
                <button type="button" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Tambah User
                </button>
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah User</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="#" id="form">
                                <div class="form-group">
                                    <label for="nama lengkap">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="id" name="id" hidden>
                                    <input type="text" class="form-control" id="nama" name="nama" autocomplete="Nama Lengkap" placeholder="Nama Lengkap">
                                </div>
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="username" class="form-control" id="username" name="username" autocomplete="Username" placeholder="Username">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" autocomplete="Email" placeholder="Email">
                                </div>
                                <div class="form-group">
                                  <label for="exampleFormControlSelect1">Role</label>
                                  <select class="form-control" id="role" name="role">
                                    <option value="admin">Admin</option>
                                    <option value="pengurus">Pengurus</option>
                                    <option value="client">Client</option>
                                  </select>
                                </div>
                                <div class="form-group" id="pass">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" autocomplete="Password" placeholder="Password">
                                </div>
                                <!--
                                    <div class="form-group">
                                        <label for="formFile" class="form-label">Foto </label>
                                        <input class="form-control form-control-sm" name="picture" id="formFile" type="file">
                                    </div>
                                -->
                                <div class="mt-3">
                                    <button type="button" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0" onclick="saveUsers()">Simpan</button>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-lg btn-secondary btn-lg w-100 mt-4 mb-0" data-bs-dismiss="modal">Close</button>
                        </div>
                      </div>
                  </div>
                </div>
            </div>
            <div class="card-body px-0 pt-0">
              <div class="table-responsive px-4 py-4">
                <table class="table align-items-center mb-0" id="orderTable">
                  <thead>
                    <tr>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Lengkap</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Username</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Created At</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Updated At</th>
                        <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($content as $data): ?>
                    <tr>
                      <td class="align-middle text-center"> 
                        <span class="text-secondary text-xs font-weight-bold"><?= $data['nama'] ?></span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold"><?= $data['username'] ?></span>
                      </td>
                      <td class="align-middle text-center"> 
                        <span class="text-secondary text-xs font-weight-bold"><?= $data['email'] ?></span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold"><?= $data['created_at'] ?></span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold"><?= $data['updated_at'] ?></span>
                      </td>
                      <td class="align-middle text-center">
                        <button type="button" class="btn btn-default" onclick="editUser(<?= $data['id']?>)">
                          <span>Edit</span>
                        </button>
                        <button type="button" class="btn btn-danger" onclick="deleteUser(<?= $data['id']?>)">
                          <span>Delete</span>
                        </button>
                      </td>
                    </tr>
                    <?php endforeach ?>
                  </tbody>
                </table>
                <?= $pager->links('users', 'pagination'); ?>
              </div>
            </div>
          </div>
        </div>
      </div>
<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script src="<?= base_url('js/SignOut.js') ?>"></script>
<script src="<?= base_url('js/AddUser.js') ?>"></script>
<script src="<?= base_url('js/EditUser.js') ?>"></script>
<script src="<?= base_url('js/DeleteUser.js') ?>"></script>
<script>
$(document).ready(function() {
  $('#orderTable').DataTable();
});
</script>
<?= $this->endSection() ?>