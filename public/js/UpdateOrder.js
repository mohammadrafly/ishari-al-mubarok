function updateOrder() {
    var base_url = 'http://localhost:8080/';
    var id = $("#id").val();
    Swal.fire({
        title: 'Loading..',
        text: 'Silahkan tunggu beberapa saat.',
        showConfirmButton: false,
        allowOutsideClick: false,
    })
    $.ajax({
        url : base_url+'dashboard/list/pesanan/detail/'+id,
        type: 'POST',
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function(respond){
            if (respond.status == true) {
                Swal.fire({
                    icon: respond.icon,
                    title: respond.title,
                    text: respond.text,
                    timer: 3000,
                    showCancelButton: false,
                    showConfirmButton: false
                })
                .then (function() {
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
                title: errorThrown,
                text: 'Silahkan coba lagi.'
            })
        }
    });
}