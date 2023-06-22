$(document).ready(function() {
    $("#form").submit( function (e) {
        e.preventDefault();
            var token = $("#token").val();
            var username = $("#username").val();
            var password = $("#password").val();
            var password_confirm = $("#password_confirm").val();
            if (password != password_confirm) {
                Swal.fire({
                    title: 'Oops...',
                    text: 'Password anda tidak sama!'
                });
            } else {
                $.ajax({
                    url : base_url+'signin/recover-account/'+token+'/'+username,
                    type: "POST",
                    data: {
                        'password': password
                    },
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
            }
    }); 
});
