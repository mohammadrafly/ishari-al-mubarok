function saveUsers() {
    var url;
    var id = $("#id").val();
    if(id) {
        url = base_url+'dashboard/list/users/update/'+id;
    } else {
        url = base_url+'dashboard/list/users/add';
    }
    $.ajax({
        url : url,
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
                title: 'Terjadi error!',
                text: 'Silahkan coba lagi.'
            })
        }
    });
}