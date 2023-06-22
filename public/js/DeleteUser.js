function deleteUser(id) {
    Swal.fire({
        title: 'Anda yakin?',
        text: 'Aksi ini tidak dapat dipulihkan!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus!'
    }).then(function (result) {
        if (result.value) {
            $.ajax({
                url: base_url+'dashboard/list/users/delete/'+id,
                type: 'GET',
                dataType: 'JSON',
                success: function (respond) {
                    swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'User berhasil dihapus!',
                        showConfirmButton: false,
                        timer: 2000
                    })
                    .then (function() {
                        location.reload();
                    });
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    swal.fire(thrownError, "Ada yang salah! coba lagi beberapa saat.", "error");
                }
            });
        };
    });
}