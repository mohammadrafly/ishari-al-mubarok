<?= $this->extend('layout/dashboardLayout') ?>

<?= $this->section('content') ?>
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>List Pesanan</h6>
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
                            <form action="#" id="form">
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control" id="id" name="id" hidden>
                                    <input type="text" disabled class="form-control" id="nama" name="nama" autocomplete="Nama" placeholder="Username">
                                </div>
                                <div class="form-group">
                                    <label for="tanggal_event">Tanggal Event</label>
                                    <input type="text" disabled class="form-control" id="tanggal_event" name="tanggal_event" autocomplete="Tanggal Event" placeholder="Tanggal Event">
                                </div>
                                <div class="form-group">
                                    <label for="waktu_event">Waktu Event</label>
                                    <input type="text" disabled class="form-control" id="waktu_event" name="waktu_event" autocomplete="Waktu Event" placeholder="Waktu Event">
                                </div>
                                <div class="form-group">
                                    <label for="kategori_event">Kategori Hadrah</label>
                                    <input type="text" disabled class="form-control" id="kategori_event" name="kategori_event" autocomplete="Kategori Event" placeholder="Kategori Event">
                                </div>
                                <div class="form-group">
                                    <label for="harga">Harga</label>
                                    <input type="text" disabled class="form-control" id="harga" name="harga" autocomplete="Harga" placeholder="Harga">
                                </div>
                                <div class="form-group">
                                    <label for="harga">Foto Pembayaran</label>
                                    <img id="foto_pembayaran_preview" src="" style="display: none;" width="200px" alt="Foto Pembayaran" class="zoomable-image">
                                </div>
                                <div id="locationContainer" class="map-container"></div>
                                <div class="form-group">
                                  <label for="exampleFormControlSelect1">Status</label>
                                  <select class="form-control" id="status" name="status">
                                    <option value="pending">Pending</option>
                                    <option value="on_progres">Ditolak</option>
                                    <option value="done">Disetujui</option>
                                  </select>
                                </div>
                                <div class="mt-3">
                                    <button id="viewMapButton" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Lihat di Map</button>
                                    <button type="button" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0" onclick="updateOrder()">Simpan</button>
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
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nomor HP</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal Event</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Waktu Event</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Harga</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Lokasi</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Created At</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Updated At</th>
                        <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($content as $data): ?>
                    <tr>
                      <td class="align-middle text-center"> 
                        <span class="text-secondary text-xs font-weight-bold"><?= $data['no_hp'] ?></span>
                      </td>
                      <td class="align-middle text-center"> 
                        <span class="text-secondary text-xs font-weight-bold"><?= $data['nama'] ?></span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold"><?= $data['tanggal_event'] ?></span>
                      </td>
                      <td class="align-middle text-center"> 
                        <span class="text-secondary text-xs font-weight-bold"><?= $data['waktu_event'] ?></span>
                      </td>
                        <?php if ($data['status'] == 'done'): ?>
                            <td class="align-middle text-center"> 
                            <span class="badge bg-gradient-success">Disetujui</span>
                            </td>
                        <?php elseif ($data['status'] == 'on_progres'): ?>
                            <td class="align-middle text-center"> 
                                <span class="badge bg-gradient-danger">Ditolak</span>
                            </td>
                        <?php else: ?>
                            <td class="align-middle text-center"> 
                                <span class="badge bg-gradient-warning">PENDING</span>
                            </td>
                        <?php endif ?>
                      <td class="align-middle text-center"> 
                        <span class="text-secondary text-xs font-weight-bold"><?= number_to_currency($data['harga'], 'IDR') ?></span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold">
                          <a href="https://www.google.com/maps/search/?api=1&query=<?= $data['lokasi_event']; ?>,<?= $data['detail_lokasi']; ?>" target="_blank">
                            <?= $data['lokasi_event']; ?>, <?= $data['detail_lokasi']; ?>
                          </a>  
                        </span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold"><?= $data['created_at'] ?></span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold"><?= $data['updated_at'] ?></span>
                      </td>
                      <td class="align-middle text-center">
                        <button type="button" class="btn btn-info" onclick="detailOrder(<?= $data['id_order']?>)">
                          <span>Detail</span>
                        </button>

                      </td>
                    </tr>
                    <?php endforeach ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
                <div class="modal fade" id="konfirmasiOrder" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Detail Pesanan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="#" id="form-upload">
                                <input type="text" hidden id="id" name="id">
                                <div class="form-group">
                                    <label for="harga">Harga Baru Untuk Ongkos</label>
                                    <input type="number"class="form-control" id="harga" name="harga" autocomplete="Harga" placeholder="Harga">
                                </div>
                                <div class="mt-3">
                                    <button type="button" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0" onclick="saveChanges()">Simpan</button>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-lg btn-secondary btn-lg w-100 mt-4 mb-0" data-bs-dismiss="modal">Close</button>
                        </div>
                      </div>
                  </div>
                </div>

<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
<script src="https://cdn.jsdelivr.net/npm/medium-zoom@1.0.6/dist/medium-zoom.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script src="<?= base_url('js/SignOut.js') ?>"></script>
<script src="<?= base_url('js/DetailOrder.js') ?>"></script>
<script src="<?= base_url('js/UpdateOrder.js') ?>"></script>
<script>
const base_url = 'http://localhost:8080/'
$(document).ready(function() {
  $('#orderTable').DataTable();
});
document.addEventListener('DOMContentLoaded', function () {
    const zoomableImages = document.querySelectorAll('.zoomable-image');
    const zoom = mediumZoom(zoomableImages, {
      margin: 24, // Add margin to the zoomed image
    });

    // Listen for the open event and adjust the position of the zoomed image
    zoom.on('open', (event) => {
      const { zoomContainer } = event.detail;
      zoomContainer.style.zIndex = 1050; // Set a higher z-index value to overlap the modal
      zoomContainer.style.position = 'fixed';
    });
  });

function konfirmasiOrder(id) {
  $.ajax({
    url: base_url + 'dashboard/list/pesanan/detail/' + id,
    type: 'GET',
    dataType: 'JSON',
    success: function (respond){
      $('[name="id"]').val(respond.data.id);
      $('[name="harga"]').val(respond.data.harga);
      $('[name="status"]').val(respond.data.status);

      $('#konfirmasiOrder').modal('show');
      $('.modal-title').text('Update Ongkos');
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.log(jqXHR);
      swal.fire({
        icon: 'error',
        title: errorThrown,
        text: 'Error get data from ajax.',
      });
    },
  });

  $('#exampleModal').on('hidden.bs.modal', function () {
    location.reload();
  });
}


function saveChanges() {
  $.ajax({
    url: `${base_url}dashboard/list/pesanan/update`,
    type: 'POST',
    data: $('#form-upload').serialize(),
    success: function(response) {
      alert(response.message);
      location.reload()
    },
    error: function(xhr, status, error) {
      alert('Error');
    }
  });
  $('#myModal').modal('hide');
}

</script>
<?= $this->endSection() ?>