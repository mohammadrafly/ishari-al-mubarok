$(document).ready(function() {
    $("#form").submit( function (e) {
        e.preventDefault();
            var email = $("#email").val();
            Swal.fire({
                title: 'Mengirim..',
                text: 'Silahkan tunggu beberapa saat.',
                imageUrl: base_url+'assets_be/img/bg1.jpg',
                showConfirmButton: false,
                allowOutsideClick: false,
            })
            $.ajax({
                url : base_url+'signin/forgot-password',
                type: "POST",
                data: {
                    'email': email
                },
                dataType: "JSON",
                success: function(respond){
                    if (respond.status == true) {
                        Swal.fire({
                            icon: respond.icon,
                            title: respond.title,
                            text: respond.text,
                            timer: 5000,
                            showCancelButton: false,
                            showConfirmButton: false
                        })
                        .then (function() {
                            window.location.href = base_url+'signin';
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