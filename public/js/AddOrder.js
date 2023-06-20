function Order() {
    var username = $("#username").val();
    var tanggal_event = $("#tanggal_event").val();
    var waktu_event = $("#waktu_event").val();
    var kategori_event = $("#kategori_event").val();
    var harga = $("#harga").val();
    var no_hp = $('#no_hp').val();
  
    if (!username || !tanggal_event || !waktu_event || !kategori_event || !harga || !no_hp) {
      alert("Input tidak boleh kosong");
      return;
    }

    // Get the formatted latitude and longitude coordinates
    var latitude = marker.getLatLng().lat;
    var longitude = marker.getLatLng().lng;
    var distance = calculateDistance(latitude, longitude, baseMap[0], baseMap[1]);
  
    if (!latitude || !longitude) {
      alert("Pilih titik pada map!");
      return;
    }
    $.ajax({
      url: base_url + 'dashboard/pesanan/saya/' + username,
      type: 'POST',
      data: {
        'username': username,
        'tanggal_event': tanggal_event,
        'kategori_event': kategori_event,
        'waktu_event': waktu_event,
        'harga': harga,
        'latitude': latitude,
        'longitude': longitude,
        'distance': distance,
        'no_hp': no_hp
      },
      dataType: "JSON",
      success: function (respond) {
        if (respond.status == true) {
          Swal.fire({
            icon: respond.icon,
            title: respond.title,
            text: respond.text,
            timer: 3000,
            showCancelButton: false,
            showConfirmButton: false
          })
            .then(function () {
              location.reload();
            });
        } else if (respond.status == false) {
          Swal.fire({
            icon: respond.icon,
            title: respond.title,
            text: respond.text,
          });
        }
      },
      error: function (jqXHR, textStatus, errorThrown) {
        swal.fire({
          icon: 'error',
          title: 'Terjadi error!',
          text: 'Silahkan coba lagi.'
        })
      }
    });
  }
  