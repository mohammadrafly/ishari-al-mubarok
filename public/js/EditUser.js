function editUser(id) {
    $('#form')[0].reset(); 
    $.ajax({
        url : base_url + 'dashboard/list/users/update/' + id,
        type: 'GET',
        dataType: 'JSON',
        success: function(respond)
        {
            console.log(respond.data);

            $('[name="id"]').val(respond.data.id);
            $('[name="nama"]').val(respond.data.nama);
            $('[name="username"]').val(respond.data.username);
            $('[name="email"]').val(respond.data.email);
            $('[name="role"]').val(respond.data.role);

            $('#exampleModal').modal('show');
            $('.modal-title').text('Edit'); 
            $('#pass').hide();
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            console.log(jqXHR);
            swal.fire({
                icon: 'error',
                title: errorThrown,
                text: 'Error get data from ajax.'
            })
        }
    });

    var modal = document.getElementById('exampleModal');
    modal.addEventListener('hidden.bs.modal', function (event) {
        location.reload();
    })
}