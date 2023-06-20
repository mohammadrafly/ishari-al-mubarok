$(document).ready(function() {
    $("#profile").submit( function (e) {
        e.preventDefault();
            var base_url = 'http://localhost:8080/';
            var formData = new FormData(this);
            var email = $("#email").val();
            $.ajax({
                url : base_url+'dashboard/profile/'+email,
                type: "POST",
                data: formData,
                dataType: "JSON",
                processData: false,
                contentType: false,
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
    }); 
});
