$(document).ready(function () {
    var currentUrl;
    var currentMethod;
    var deleteButtonClicked = false;

    $('.piece-input').on('input', function () {
        const easy = parseFloat($('#simple_piece_quantity').val()) || 0;
        const difficult = parseFloat($('#difficult_piece_quantity').val()) || 0;

        const total = easy + difficult;

        $('#totalPiecesDisabled').val(total);
        $('#hiddenTotalPieces').val(total);
    });

    function setupValidation(url, method) {
        currentUrl = url;
        currentMethod = method;
        var rules = {
            name: {
                required: true,
            },
            piece_quantity: {
                required: true,
            },
            simple_piece_quantity: {
                required: true,
            },
            difficult_piece_quantity: {
                required: true,
            },
            simple_piece_value: {
                required: true,
            },
            difficult_piece_value: {
                required: true,
            },
            additional_simple_piece_value: {
                required: true,
            },
            additional_difficult_piece_value: {
                required: true,
            },
        };

        $('#plan-form').validate({
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
                piece_quantity: {
                    required: "Por favor, preencha esse campo.",
                },
                simple_piece_quantity: {
                    required: "Por favor, preencha esse campo.",
                },
                difficult_piece_quantity: {
                    required: "Por favor, preencha esse campo.",
                },
                simple_piece_value: {
                    required: "Por favor, preencha esse campo.",
                },
                difficult_piece_value: {
                    required: "Por favor, preencha esse campo.",
                },
                additional_simple_piece_value: {
                    required: "Por favor, preencha esse campo.",
                },
                additional_difficult_piece_value: {
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
                            $('.plan_datatable').DataTable().ajax.reload();
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

    $('#plan-modal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var action = button.data('action');

        if (action === 'create') {
            $(this).find('.modal-title').text('Adicionar Plano');
            $(this).find('#buttonText').text('Criar Plano');
            var url = '/planos';
            var method = 'POST';

            setupValidation(url, method);
        } else if (action === 'edit') {
            $(this).find('.modal-title').text('Editar Plano');
            $(this).find('#buttonText').text('Atualizar Plano');
            var planId = button.data('id');

            $.ajax({
                url: '/planos/' + planId,
                method: 'GET',
                success: function (response) {
                    $('#name').val(response.name);
                    $('#piece_quantity').val(response.piece_quantity);
                    $('#simple_piece_quantity').val(response.simple_piece_quantity);
                    $('#difficult_piece_quantity').val(response.difficult_piece_quantity);
                    $('#simple_piece_value').val(response.simple_piece_value);
                    $('#difficult_piece_value').val(response.difficult_piece_value);
                    $('#additional_simple_piece_value').val(response.additional_simple_piece_value);
                    $('#additional_difficult_piece_value').val(response.additional_difficult_piece_value);
                    $('#is_active').prop('checked', response.is_active);
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

            var url = '/planos/' + planId;
            var method = 'PUT';

            setupValidation(url, method);
        }
    });

    $('#plan-modal').on('hidden.bs.modal', function () {
        $(this).find('form')[0].reset();
        $(this).find('.text-danger').remove();
        $(this).find('.is-invalid').removeClass('is-invalid');
    });

    $('.plan_datatable').on('click', '.link-danger', function (event) {
        event.preventDefault();

        var planId = $(this).data('id');

        $('#plan-modal-delete a#delete').data('planId', planId);

    });

    $('#plan-modal-delete a#delete').on('click', function (event) {
        event.preventDefault();

        var planId = $(this).data('planId');

        if (planId) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/planos/' + planId,
                method: 'DELETE',
                success: function (response) {
                    if (response.success) {
                        toastr.success(response.success, {
                            timeOut: 3000,
                            closeButton: true
                        });
                        $('.plan_datatable').DataTable().ajax.reload();
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
