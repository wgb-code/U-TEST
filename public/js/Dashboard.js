function submitCustomerForm() {
    let form = $('#createCustomerForm');
    let url = form.attr('action');

    $.ajax({
        type: 'POST',
        url: url,
        data: form.serialize(),
        dataType: 'json',
        success: function (response) {

            if (response.status === 'success') {

                Swal.fire({
                    icon: 'success',
                    title: 'Cadastro Realizado',
                    text: response.message,
                });

                setTimeout(function () {
                    $('#createUserModal').modal('hide');
                    location.reload();
                }, 5000);

            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Ops...',
                    text: response.message,
                });
            }
        },
        error: function () {

            Swal.fire({
                icon: 'error',
                title: 'Ops...',
                text: 'Ocorreu um erro ao tentar cadastrar o cliente.',
            });
        }
    });
}
