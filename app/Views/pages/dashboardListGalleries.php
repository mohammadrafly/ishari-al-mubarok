<?= $this->extend('layout/dashboardLayout') ?>

<?= $this->section('content') ?>
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>List Galleries</h6>
                <button type="button" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Tambah Foto
                </button>
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Detail Pesanan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="form" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="formFile" class="form-label">Foto </label>
                                    <input class="form-control form-control-sm" name="picture" id="formFile" type="file">
                                </div>
                                <div class="mt-3">
                                    <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Simpan</button>
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
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive px-4 py-4">
                <table class="table align-items-center mb-0" id="orderTable">
                  <thead>
                    <tr>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Picture</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Created At</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Updated At</th>
                        <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($content as $data): ?>
                    <tr>
                      <td class="align-middle text-center"> 
                        <span class="text-secondary text-xs font-weight-bold"><?= $data['picture'] ?></span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold"><?= $data['created_at'] ?></span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold"><?= $data['updated_at'] ?></span>
                      </td>
                      <td class="align-middle text-center">
                        <button type="button" class="btn btn-danger" onclick="deleteFoto(<?= $data['id']?>)">
                          <span>Delete</span>
                        </button>
                      </td>
                    </tr>
                    <?php endforeach ?>
                  </tbody>
                </table>
                <?= $pager->links('galleries', 'pagination'); ?>
              </div>
            </div>
          </div>
        </div>
      </div>
<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
  <script src="<?= base_url('js/SignOut.js') ?>"></script>
  <script src="<?= base_url('js/AddFoto.js') ?>"></script>
  <script src="<?= base_url('js/DeleteFoto.js') ?>"></script>
  <script>
    $(document).ready(function() {
      $('#orderTable').DataTable();
    });
  </script>
<?= $this->endSection() ?>