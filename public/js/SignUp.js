$(document).ready(function() {
    $("#SignUp").submit( function (e) {
        e.preventDefault();
        var nama = $("#nama").val();
        var username = $("#username").val();
        var password = $("#password").val();
        var password_confirm = $("#password_confirm").val();
        var email = $("#email").val();
        var nomor_hp = $("#nomor_hp").val();
        if(password != password_confirm) {
            Swal.fire({
            title: 'Oops...',
            text: 'Password anda tidak sama!'
            });
        } else if(nama.length == "") {
            Swal.fire({
            title: 'Oops...',
            text: 'Nama harus diisi!'
            });
        } else if(username.length == "") {
            Swal.fire({
            title: 'Oops...',
            text: 'Username harus diisi!'
            });
        } else if(password.length == "") {
            Swal.fire({
            title: 'Oops...',
            text: 'Password harus diisi!'
            });
        } else if(email.length == "") {
            Swal.fire({
            title: 'Oops...',
            text: 'Email harus diisi!'
            });
        } else if(nomor_hp.length == "") {
            Swal.fire({
            title: 'Oops...',
            text: 'Nomor_hp harus diisi!'
            });
        } else {
            $.ajax({
                url : base_url + 'signup',
                type: "POST",
                data: {
                    "nama": nama,
                    "username": username,
                    "password": password,
                    "email": email,
                    "nomor_hp": nomor_hp,
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
                    alert('Error registering!');
                }
            });
        }
    }); 
});