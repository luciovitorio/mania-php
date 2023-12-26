$(document).ready(function () {
    var currentUrl;
    var currentMethod;
    var deleteButtonClicked = false;

    // Função para pesquisa de CEP
    $(document).ready(function () {
        $('#cep').on('blur', function () {
            var cep = $(this).val().replace(/\D/g, '');

            if (cep.length === 8) {
                $.ajax({
                    url: 'https://viacep.com.br/ws/' + cep + '/json/',
                    dataType: 'json',
                    success: function (data) {
                        if (!data.erro) {
                            $('.is-invalid').removeClass('is-invalid');
                            $('.text-danger').remove();

                            $('#street').val(data.logradouro);
                            $('#district').val(data.bairro);
                            $('#city').val(data.localidade);
                            $('#state').val(data.uf);
                        } else {
                            handleCepError();
                        }
                    },
                    error: function () {
                        handleAjaxError();
                    }
                });
            }
        });
    });

    function handleCepError() {
        $('.is-invalid').removeClass('is-invalid');
        $('.text-danger').remove();

        $('#cep').addClass('is-invalid');
        $('#cep').after('<div class="small text-danger mt-1">Erro ao obter informações do CEP.</div>');
    }

    function handleAjaxError() {
        toastr.error('Erro ao buscar o CEP. Por favor, tente novamente.', {
            timeOut: 3000,
            closeButton: true
        });
    }

    function setupValidation(url, method) {
        currentUrl = url;
        currentMethod = method;
        var rules = {
            name: {
                required: true,
            },
            email: {
                email: true,
            },
            street: {
                required: true,
            },
            number: {
                required: true,
            },
            district: {
                required: true,
            },
            city: {
                required: true,
            },
            state: {
                required: true,
            },
            cep: {
                required: true,
            }
        };

        $('#branch-form').validate({
            errorPlacement: function (error, element) {
                element.removeClass('error');
                error.addClass('small text-danger mt-1');
                element.addClass('is-invalid');
                if (error.text() !== '') {
                    error.addClass('small text-danger');
                    error.insertAfter(element);
                }
            },
            rules: rules,
            messages: {
                name: {
                    required: "Por favor, preencha esse campo.",
                },
                email: {
                    email: "Por favor, preencha com um endereço de e-mail válido",
                },
                cep: {
                    required: "Por favor, preencha esse campo.",
                },
                street: {
                    required: "Por favor, preencha esse campo.",
                },
                number: {
                    required: "Por favor, preencha esse campo.",
                },
                district: {
                    required: "Por favor, preencha esse campo.",
                },
                city: {
                    required: "Por favor, preencha esse campo.",
                },
                state: {
                    required: "Por favor, preencha esse campo.",
                },
            },
            success: function (label, element) {
                $(element).removeClass('is-invalid');
            },
            submitHandler: function (form) {
                $('#createButton').prop('disabled', true);
                $('#buttonText').addClass('d-none');
                $('#loginSpinner').removeClass('d-none');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: currentUrl,
                    method: currentMethod,
                    data: $(form).serialize(),
                    success: function (response) {
                        if (response.success) {
                            toastr.success(response.success, {
                                timeOut: 3000,
                                closeButton: true
                            });
                            $('#createButton').prop('disabled', false);
                            $('#buttonText').removeClass('d-none');
                            $('#loginSpinner').addClass('d-none');

                            $("#cancelButton").click()
                            $('.branch_datatable').DataTable().ajax.reload();
                        }
                    },
                    error: function (xhr, status, error) {
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
                            // Limpa todas as mensagens de erro antes de adicionar novas
                            $('.is-invalid').removeClass('is-invalid');
                            $('.text-danger').remove();

                            $.each(errors, function (key, value) {
                                $('#' + key).addClass('is-invalid');
                                $('#' + key).after('<div class="small text-danger mt-1">' + value + '</div>');
                            });
                            $('#createButton').prop('disabled', false);
                            $('#buttonText').removeClass('d-none');
                            $('#loginSpinner').addClass('d-none');
                            return;
                        }

                        if (error) {
                            toastr.error('Estamos com um problema no momento, tente novamente mais tarde!', {
                                timeOut: 3000,
                                closeButton: true
                            });
                        }
                    }
                });
            }
        });
    }

    $('#branch-modal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var action = button.data('action');

        if (action === 'create') {
            $(this).find('.modal-title').text('Adicionar Filial');
            $(this).find('#buttonText').text('Criar Filial');
            var url = '/filiais';
            var method = 'POST';

            setupValidation(url, method);
        } else if (action === 'edit') {
            $(this).find('.modal-title').text('Editar Filial');
            $(this).find('#buttonText').text('Atualizar Filial');
            var branchId = button.data('id');

            $.ajax({
                url: '/filiais/' + branchId,
                method: 'GET',
                success: function (response) {
                    $('#name').val(response.name);
                    $('#email').val(response.email);
                    $('#phone').val(response.phone);
                    $('#whatsapp').val(response.whatsapp);
                    $('#cep').val(response.address.cep);
                    $('#street').val(response.address.street);
                    $('#number').val(response.address.number);
                    $('#complement').val(response.address.complement);
                    $('#district').val(response.address.district);
                    $('#city').val(response.address.city);
                    $('#state').val(response.address.state);
                },
                error: function (xhr, status, error) {
                    if (error) {
                        toastr.error('Estamos com um problema no momento, tente novamente mais tarde!', {
                            timeOut: 3000,
                            closeButton: true
                        });
                    }
                }
            });

            var url = '/filiais/' + branchId;
            var method = 'PUT';

            setupValidation(url, method);
        }
    });

    $('#branch-modal').on('hidden.bs.modal', function () {
        $(this).find('form')[0].reset();
        $(this).find('.text-danger').remove();
        $(this).find('.is-invalid').removeClass('is-invalid');
    });

    $('.branch_datatable').on('click', '.link-danger', function (event) {
        event.preventDefault();

        var branchId = $(this).data('id');

        $('#branch-modal-delete a#delete').data('branchId', branchId);

    });

    $('#branch-modal-delete a#delete').on('click', function (event) {
        event.preventDefault();

        var branchId = $(this).data('branchId');

        if (branchId) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/filiais/' + branchId,
                method: 'DELETE',
                success: function (response) {
                    if (response.success) {
                        toastr.success(response.success, {
                            timeOut: 3000,
                            closeButton: true
                        });
                        $('.branch_datatable').DataTable().ajax.reload();
                    }
                },
                error: function (xhr, status, error) {
                    if (error) {
                        toastr.error('Estamos com um problema no momento, tente novamente mais tarde!', {
                            timeOut: 3000,
                            closeButton: true
                        });
                    }
                },
                complete: function () {
                    deleteButtonClicked = false;
                }
            });
        }
    });
});
