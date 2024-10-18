function createCustomer() {
    let form = $('#createCustomerForm')
    let url = form.attr('action')

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
                }).then((result) => {

                    if (result.isConfirmed) {
                        $('#createUserModal').modal('hide');
                        location.reload();
                    }
                })

                setTimeout(function () {
                    $('#createUserModal').modal('hide')
                    location.reload()
                }, 2000)
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Ops...',
                    text: response.message,
                })
            }
        },
        error: function () {

            Swal.fire({
                icon: 'error',
                title: 'Ops...',
                text: 'Ocorreu um erro ao tentar cadastrar o cliente.',
            })
        }
    })
}

function editCustomer() {

    let form = $('#editCustomerForm');
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
                    title: 'Edição Realizada',
                    text: response.message,

                }).then((result) => {

                    if (result.isConfirmed) {
                        $('#editCustomerModal').modal('hide');
                        location.reload();
                    }
                });

            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Ops...',
                    text: response.message,
                });
            }
        },
    });
}

function fillEditModal(button) {
    const id = $(button).data('id');
    const name = $(button).data('name');
    const email = $(button).data('email');
    const status = $(button).data('status');

    $('input[name="idCustomer"]').val(id);
    $('input[name="nameCustomer"]').val(name);
    $('input[name="emailCustomer"]').val(email);
    $('select[name="statusCustomer"]').val(status);

    $('#editCustomerModal').modal('show');
}

function confirmDelete(button) {

    const url = $(button).data('url');
    const id  = $(button).data('id')

    Swal.fire({
        title: 'Tem certeza?',
        text: "Você não poderá reverter isso!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Excluir',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            deleteCustomer(url, id);
        }
    });
}

function deleteCustomer(url, id) {
    $.ajax({
        type: 'POST',
        url: url,
        data: { idCustomer: id },
        dataType: 'json',
        success: function(response) {

            if (response) {
                Swal.fire('Excluído', 'O cliente foi desativado com sucesso.', 'success')
                location.reload();
            } else {
                Swal.fire('Erro!', 'Ocorreu um erro ao tentar desativar o cliente.', 'error');
            }
        }
    });
}

function searchCustomers() {

    const form = $('#searchCustomerForm');
    const url = form.data('url');

    $.ajax({
        type: 'POST',
        url: url,
        data: form.serialize(),
        dataType: 'json',
        success: function(response) {

            if (response.status === 'success') {
                $('#searchCustomerModal').modal('hide');

            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Ops...',
                    text: response.message,
                });
            }
        }
    });
}


$(document).ready(function () {
    $('.list-btn-more').on('click', function (e) {
        e.stopPropagation()
        $(this).siblings('.dropdown-options').toggle()
    })

    $('.filter-btn').on('click', function (e) {
        e.preventDefault();
        $('#searchCustomerModal').modal('show');
    });


    $(document).on('click', function () {
        $('.dropdown-options').hide()
    })

    $('.dropdown-options').on('click', function (e) {
        e.stopPropagation()
    })

    $('#createCustomerForm').on('submit', function (e) {
        e.preventDefault();
    });

    $('.edit-button').on('click', function (e) {

        e.preventDefault();

        let url = $(this).attr('href');

        $.ajax({
            type: 'GET',
            url: url,
            dataType: 'json',
            success: function (response) {

                if (response.status === 'success') {

                    $('#nome').val(response.data.name);
                    $('#email').val(response.data.email);
                    $('#status').val(response.data.status);
                    $('#date').val(response.data.admission);

                    $('#editCustomerModal').modal('show');

                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Ops...',
                        text: 'Não foi possível carregar os dados do cliente.',
                    });
                }
            },
        });
    });
})
