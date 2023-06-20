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
          <span>Booking Pentas</span>
          <h2>Booking Pentas</h2>
        </div>
        <form id="orders" role="form">
        <div class="row">

          <div class="col-lg-4 d-flex align-items-stretch">
            <div class="info">
              <div class="form-group col-md-12">
                <label for="name">Tanggal Acara</label>
                <input class="form-control" id="username" name="username" type="text" value="<?= session()->get('username') ?>" hidden>
                <input class="form-control" id="tanggal_event" name="tanggal_event" type="date" required onchange="checkAvailability()">
              </div>
              <div class="form-group">
                <label for="waktu_event">Waktu Event</label>
                <div class="row" id="waktu_event_options">
                  <input type="hidden" id="selected_waktu_event" name="waktu_event">
                  <div class="col mt-1">
                    <button type="button" class="btn btn-primary waktu-event-btn" data-value="06:00">06:00</button>
                  </div>
                  <div class="col mt-1">
                    <button type="button" class="btn btn-primary waktu-event-btn" data-value="07:00">07:00</button>
                  </div>
                  <div class="col mt-1">
                    <button type="button" class="btn btn-primary waktu-event-btn" data-value="08:00">08:00</button>
                  </div>
                  <div class="col mt-1">
                    <button type="button" class="btn btn-primary waktu-event-btn" data-value="09:00">09:00</button>
                  </div>
                  <div class="col mt-1">
                    <button type="button" class="btn btn-primary waktu-event-btn" data-value="10:00">10:00</button>
                  </div>
                  <div class="col mt-1">
                    <button type="button" class="btn btn-primary waktu-event-btn" data-value="11:00">11:00</button>
                  </div>
                  <div class="col mt-1">
                    <button type="button" class="btn btn-primary waktu-event-btn" data-value="12:00">12:00</button>
                  </div>
                  <div class="col mt-1">
                    <button type="button" class="btn btn-primary waktu-event-btn" data-value="13:00">13:00</button>
                  </div>
                  <div class="col mt-1">
                    <button type="button" class="btn btn-primary waktu-event-btn" data-value="14:00">14:00</button>
                  </div>
                  <div class="col mt-1">
                    <button type="button" class="btn btn-primary waktu-event-btn" data-value="15:00">15:00</button>
                  </div>
                  <div class="col mt-1">
                    <button type="button" class="btn btn-primary waktu-event-btn" data-value="16:00">16:00</button>
                  </div>
                  <div class="col mt-1">
                    <button type="button" class="btn btn-primary waktu-event-btn" data-value="17:00">17:00</button>
                  </div>
                  <div class="col mt-1">
                    <button type="button" class="btn btn-primary waktu-event-btn" data-value="18:00">18:00</button>
                  </div>
                  <div class="col mt-1">
                    <button type="button" class="btn btn-primary waktu-event-btn" data-value="19:00">19:00</button>
                  </div>
                  <div class="col mt-1">
                    <button type="button" class="btn btn-primary waktu-event-btn" data-value="20:00">20:00</button>
                  </div>
                  <div class="col mt-1">
                    <button type="button" class="btn btn-primary waktu-event-btn" data-value="21:00">21:00</button>
                  </div>
                </div>
              </div>
              <div class="form-group col-md-12">
                <label for="name">Nomer Handphone</label>
                <input type="number" class="form-control" id="no_hp" name="no_hp" required></input>
              </div>
            </div>
          </div>
          <div class="col-lg-8 mt-5 mt-lg-0 d-flex align-items-stretch">
            <div class="php-email-form">
              <div class="row">
                <div class="form-group col-md-6">
                  <label for="name">Kategori Hadrah</label>
                  <select class="form-control" id="kategori_event" name="kategori_event" required>
                    <option selected value="">Pilih Kategori</option>
                    <option value="Hadrah Tradisional">Hadrah Tradisional</option>
                    <option value="Hadrah Modern">Hadrah Modern</option>
                  </select>
                </div>
                <div class="form-group col-md-6">
                  <label for="name">Harga</label>
                  <input class="form-control" id="harga" name="harga" readonly />
                </div>
                <div class="form-group col-md-12">
                  <h4>Detail Harga</h4>
                  <p>Harga/km: 10rb </p>
                  <p id="distanceInfo">Jarak: </p>
                  <p id="additionalCostInfo">Harga Tambahan: </p>
                </div>
              </div>
              <div class="row mt-4">
              <div id="map" style="height: 400px;"></div>
              <button class="button-send scrollto" id="currentLocationButton" type="button">Get Current Location</button>
              </div>
              <div class="pt-3">
                <button class="button-send scrollto" type="button" onclick="Order()">BOOK</button>
              </div>
            </div>
          </div>

        </div>
        </form>
        <div class="section-title mt-5">
          <span>Pesanan Saya</span>
          <h2>Pesanan Saya</h2>
        </div>
        <table class="table table-striped mt-2">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Tanggal Event</th>
              <th scope="col">Waktu Event</th>
              <th scope="col">Harga</th>
              <th scope="col">Status</th>
              <th scope="col">Opsi</th>
            </tr>
          </thead>
          <tbody>
          <?php if($content): ?>
            <?php 
            $no = 1;
            //dd($content);
            foreach($content as $dd): ?>
              <tr>
                <th><?= $no++ ?></th>
                <td><?= $dd->tanggal_event ?></td>
                <td><?= $dd->waktu_event ?></td>
                <td><?= number_to_currency($dd->harga , 'IDR')?></td>
                <td>
                  <?php if($dd->status == 'dalam_pemeriksaan'): ?>
                    Menunggu Pembayaran
                  <?php elseif($dd->status == 'pending'): ?>
                    Pending
                  <?php elseif($dd->status == 'done'): ?>
                    Selesai
                  <?php elseif($dd->status == 'on_progres'): ?>
                    Dalam Progres
                  <?php endif ?>
                </td>
                <td>
                  <?php if ($dd->foto_pembayaran === null): ?>
                    <?php if ($dd->status === 'dalam_pemeriksaan'): ?>
                      <button class="button-send scrollto" type="button" onclick="bayar(<?= $dd->id_order ?>)">
                        Bayar
                      </button>
                    <?php endif; ?>
                  <?php else: ?>
                    <?php if ($dd->status === 'on_progres'): ?>
                      <a href="<?= 'https://wa.me/'.$admin['nomor_hp'].'?text=Halo min!,%20saya%20ingin%20menanyakan%20booking%20dengan%20KODE:%20'.$dd->kode_pembayaran ?>" class="btn btn-primary">Chat Admin</a>
                    <?php elseif ($dd->status === 'done'): ?>
                      Booking telah selesai
                    <?php endif ?>
                  <?php endif; ?>
                </td>
              </tr>

              <!-- Modal -->
              <div class="modal fade" id="myModalUpload" tabindex="-1" role="dialog" aria-labelledby="myModalLabelUpload" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="myModalLabelUpload">Bayar Online</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form id="form-upload" enctype="multipart/form-data">
                      <div class="modal-body">
                        <!-- Additional information -->
                        <p>Silakan transfer jumlah pembayaran ke rekening bank berikut:</p>
                        <p>Nama Bank: Bank Anda</p>
                        <p>Nomor Rekening: 1234567890</p>
                        
                        <!-- Upload file form -->
                        <input type="text" hidden id="id" name="id">
                        <div class="form-group">
                          <label for="fileInput">Bukti Pembayaran:</label>
                          <input type="file" class="form-control-file" id="fileInput" name="fileInput">
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" onclick="doBayar()" class="btn btn-primary">Kirim</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <!-- End Modal -->

            <?php endforeach ?>
          <?php endif ?>
          </tbody>
        </table>

      </div>
    </section><!-- End Contact Section -->
<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script src="<?= base_url('js/SignOut.js') ?>"></script>
<script src="<?= base_url('js/AddOrder.js') ?>"></script>
<script>
const base_url = 'http://localhost:8080/';

// JavaScript code
var waktuEventButtons = document.querySelectorAll('.waktu-event-btn');
var selectedWaktuEventInput = document.getElementById('selected_waktu_event');

waktuEventButtons.forEach(function(button) {
  button.addEventListener('click', function() {
    var selectedValue = button.getAttribute('data-value');
    selectedWaktuEventInput.value = selectedValue;
    updateSelectedButtonColor();
  });
});

function updateSelectedButtonColor() {
  waktuEventButtons.forEach(function(button) {
    if (button.getAttribute('data-value') === selectedWaktuEventInput.value) {
      button.classList.add('selected');
    } else {
      button.classList.remove('selected');
    }
  });
}


function checkAvailability() {
  var tanggal = document.getElementById('tanggal_event').value;
  var xhr = new XMLHttpRequest();
  xhr.open('GET', `${base_url}avail/${tanggal}`, true);
  xhr.onload = function() {
    if (xhr.status === 200) {
      var response = JSON.parse(xhr.responseText);
      var availableWaktuEvent = response.map(function(item) {
        return item.waktu_event;
      });
      var waktuEventButtons = document.querySelectorAll('.waktu-event-btn');

      waktuEventButtons.forEach(function(button) {
        var value = button.dataset.value;

        if (!availableWaktuEvent.includes(value)) {
          button.disabled = false;
          button.classList.remove('btn-secondary');
          button.classList.add('btn-primary');
        } else {
          button.disabled = true;
          button.classList.remove('btn-primary');
          button.classList.add('btn-secondary');
        }

        button.addEventListener('click', function() {
          var selectedWaktuEvent = document.getElementById('selected_waktu_event');
          selectedWaktuEvent.value = button.dataset.value;

          waktuEventButtons.forEach(function(btn) {
            btn.classList.remove('selected');
          });

          button.classList.add('selected');
        });
      });
    }
  };
  xhr.send();
}

function alertPopUp() {
  alert('Maaf saat ini orderan anda sedang dalam pemeriksaan, tunggun 1x24 jam')
}


function bayar(id) {
  var base_url = 'http://localhost:8080/';
    $.ajax({
      url: base_url + 'dashboard/list/pesanan/detail/' + id,
      type: 'GET',
      dataType: 'JSON',
      success: function (respond) {
        console.log(respond.data);
  
        $('[name="id"]').val(respond.data.id);
  
        $('#myModalUpload').modal('show');
        $('.modal-title').text('Edit');
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
  
    // Reload the page when the modal is closed
    $('#myModalUpload').on('hidden.bs.modal', function () {
      location.reload();
    });
}

function doBayar() {
  var form = $('#form-upload');
  var fileInput = $('#fileInput');

  var file = fileInput[0].files[0];

  var formData = new FormData();
  formData.append('fileInput', file);
  formData.append('id', $('#id').val());

  $.ajax({
    url: `${base_url}pesanan/bayar`,
    type: 'POST',
    data: formData,
    contentType: false,
    processData: false,
    success: function(response) {
      alert(response.message);
      location.reload()
    },
    error: function(xhr, status, error) {
      alert('Error uploading file.');
    }
  });
  $('#myModal').modal('hide');
}

// Get the select element
var kategoriSelect = document.getElementById('kategori_event');

// Add event listener for the change event
kategoriSelect.addEventListener('change', function() {
  var hargaInput = document.getElementById('harga');
  var selectedOption = kategoriSelect.value;

  // Update the price based on the selected category
  if (selectedOption === 'Hadrah Tradisional') {
    hargaInput.value = '300000';
  } else if (selectedOption === 'Hadrah Modern') {
    hargaInput.value = '500000';
  }

  // Retrieve the additional cost info element
  var additionalCostInfo = document.getElementById('additionalCostInfo');

  // Update the additional cost based on the selected category
  if (selectedOption === 'Hadrah Tradisional') {
    var basePrice = 300000;
    var additionalPrice = calculateAdditionalPrice();
    additionalCostInfo.textContent = "Additional Cost: Rp " + roundToNearestTenThousand(additionalPrice).toFixed(0);
  } else if (selectedOption === 'Hadrah Modern') {
    var basePrice = 500000;
    var additionalPrice = calculateAdditionalPrice();
    additionalCostInfo.textContent = "Additional Cost: Rp " + roundToNearestTenThousand(additionalPrice).toFixed(0);
  }
});

var baseMap = [-7.734565298254148, 113.68891716931151];
var map = L.map('map').setView([0, 0], 10);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
  maxZoom: 19
}).addTo(map);

var marker;

function initializeMap() {
  map.on('click', handleMapClick);

  if ("geolocation" in navigator) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var userLat = position.coords.latitude;
      var userLng = position.coords.longitude;

      setViewAndAddMarker(userLat, userLng);
      calculateAndLogDistance(userLat, userLng, baseMap[0], baseMap[1]);
      map.panTo([userLat, userLng]);
    });
  }

  var currentLocationButton = document.getElementById('currentLocationButton');
  currentLocationButton.addEventListener('click', getCurrentLocation);
}

function getCurrentLocation() {
  if ("geolocation" in navigator) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var userLat = position.coords.latitude;
      var userLng = position.coords.longitude;

      if (marker) {
        map.removeLayer(marker);
      }

      setViewAndAddMarker(userLat, userLng);
      calculateAndLogDistance(userLat, userLng, baseMap[0], baseMap[1]);
      map.panTo([userLat, userLng]);
    });
  }
}

var distanceInfo = document.getElementById('distanceInfo');
var additionalCostInfo = document.getElementById('additionalCostInfo');

function handleMapClick(e) {
  var selectedOption = kategoriSelect.value;
  
  if (!selectedOption) {
    alert("Pilih kategori terlebih dahulu!");
    return;
  }

  if (marker) {
    map.removeLayer(marker);
  }
  marker = L.marker(e.latlng).addTo(map);

  var distance = calculateDistance(e.latlng.lat, e.latlng.lng, baseMap[0], baseMap[1]);
  var pricePerKilometer = 10000;
  var additionalPrice = distance * pricePerKilometer;

  var hargaInput = document.getElementById('harga');
  var selectedOption = kategoriSelect.value;

  if (selectedOption === 'Hadrah Tradisional') {
    var basePrice = 300000;
    var totalHarga = basePrice + additionalPrice;
    hargaInput.value = roundToNearestTenThousand(totalHarga).toFixed(0);
  } else if (selectedOption === 'Hadrah Modern') {
    var basePrice = 500000;
    var totalHarga = basePrice + additionalPrice;
    hargaInput.value = roundToNearestTenThousand(totalHarga).toFixed(0);
  }

  distanceInfo.textContent = "Distance: " + distance.toFixed(2) + " km";
  additionalCostInfo.textContent = "Additional Cost: Rp " + roundToNearestTenThousand(additionalPrice).toFixed(0);

  map.panTo(e.latlng);
}

function roundToNearestTenThousand(price) {
  return Math.ceil(price / 10000) * 10000;
}

function setViewAndAddMarker(lat, lng) {
  map.setView([lat, lng], 10);
  marker = L.marker([lat, lng]).addTo(map);
}

function calculateAndLogDistance(lat1, lon1, lat2, lon2) {
  var distance = calculateDistance(lat1, lon1, lat2, lon2);
  console.log("Distance from baseMap: " + distance.toFixed(2) + " km");
}

function calculateDistance(lat1, lon1, lat2, lon2) {
  var earthRadius = 6371;
  var dLat = degToRad(lat2 - lat1);
  var dLon = degToRad(lon2 - lon1);
  var a =
    Math.sin(dLat / 2) * Math.sin(dLat / 2) +
    Math.cos(degToRad(lat1)) * Math.cos(degToRad(lat2)) *
    Math.sin(dLon / 2) * Math.sin(dLon / 2);
  var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
  var distance = earthRadius * c;
  return distance;
}

function degToRad(degrees) {
  return degrees * (Math.PI / 180);
}

// Initialize the map
initializeMap();

</script>
<?= $this->endSection() ?>