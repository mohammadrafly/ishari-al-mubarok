$(document).ready(function() {
    $("#SignIn").submit( function (e) {
        e.preventDefault();
        var username = $("#username").val();
        var password = $("#password").val();
        if (username.length == "") {
            Swal.fire({
            title: 'Oops...',
            text: 'Username harus diisi!'
            });
        } else if(password.length == "") {
            Swal.fire({
            title: 'Oops...',
            text: 'Password harus diisi!'
            });
        } else {
            $.ajax({
                url : base_url + 'signin',
                type: "POST",
                data: {
                    "username": username,
                    "password": password,
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
                            if (respond.sessionRole == 'client') {
                                window.location.href = base_url;
                            } else {
                                window.location.href = base_url+'dashboard';
                            }
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
    }); 
});