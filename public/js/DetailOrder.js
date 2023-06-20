function detailOrder(id) {
    var base_url = 'http://localhost:8080/';
    $('#form')[0].reset();
    $.ajax({
      url: base_url + 'dashboard/list/pesanan/detail/' + id,
      type: 'GET',
      dataType: 'JSON',
      success: function (respond) {
        console.log(respond.data);
  
        $('[name="id"]').val(respond.data.id);
        $('[name="nama"]').val(respond.data.nama);
        $('[name="tanggal_event"]').val(respond.data.tanggal_event);
        $('[name="waktu_event"]').val(respond.data.waktu_event);
        $('[name="kategori_event"]').val(respond.data.kategori_event);
        $('[name="harga"]').val(respond.data.harga);
        $('[name="lokasi_event"]').val(respond.data.lokasi_event);
        $('[name="detail_lokasi"]').val(respond.data.detail_lokasi);
        $('[name="status"]').val(respond.data.status);

        if (respond.data.foto_pembayaran) {
            var imageUrl = base_url + 'uploads/fotopembayaran/' + respond.data.foto_pembayaran;
            $('#foto_pembayaran_preview').attr('src', imageUrl);
            $('#foto_pembayaran_preview').show();
          } else {
            $('#foto_pembayaran_preview').hide();
          }
  
        var button = document.getElementById('viewMapButton');
        var latitude = respond.data.lokasi_event; // Assuming the latitude is stored in the "lokasi_event" field
        var longitude = respond.data.detail_lokasi; // Assuming the longitude is stored in the "detail_lokasi" field
  
        button.addEventListener('click', function () {
          var url = 'https://www.google.com/maps/search/?api=1&query=' + latitude + ',' + longitude;
          window.open(url, '_blank');
        });
  
        $('#exampleModal').modal('show');
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
    $('#exampleModal').on('hidden.bs.modal', function () {
      location.reload();
    });
  }
  