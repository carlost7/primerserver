//Functions to get new password
function get_password() {
    var pass = $.post(
            base_url + '/get_password',
            function (data) {
                $('#Usarpass').empty().append(data);
            }
    );
}

//Functions to copy password in textboxes
function accept_password() {
    var pass = $('#Usarpass').text();
    $("#password").val(pass);
    $("#password_confirmation").val(pass);
}

function confirmDelete(id) {
    bootbox.confirm("<h2>¿Eliminar?<h2>", function (result) {
        if (result) {
            $("#"+id).submit();
        }
    });
}