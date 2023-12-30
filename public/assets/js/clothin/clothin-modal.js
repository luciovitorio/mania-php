$(document).ready(function () {
    var currentUrl;
    var currentMethod;
    var deleteButtonClicked = false;

    // Chamada Ajax para buscar dados das filiais ao carregar a página
    $.ajax({
        url: '/filiais',
        method: 'GET',
        success: function (data) {
            branchesData = data.data;
        },
        error: function (error) {
            console.log('Erro ao buscar as filiais:', error);
        }
    });

    // Função para preencher o select de filiais
    function fillBranchesSelect() {
        $('#branch_id').empty();
        $('#branch_id').append('<option value="">Escolha uma filial</option>');

        if (branchesData) {
            branchesData.forEach(function (branch) {
                $('#branch_id').append('<option value="' + branch.id + '">' + branch.name + '</option>');
            });
        }
    }

    function setupValidation(url, method) {
        currentUrl = url;
        currentMethod = method;
        var rules = {
            branch_id: {
                required: true,
            },
            name: {
                required: true,
            },
            type: {
                required: true,
            },
        };

        $('#clothin-form').validate({
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
                branch_id: {
                    required: "Por favor, preencha esse campo.",
                },
                type: {
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
                            $('.clothin_datatable').DataTable().ajax.reload();
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

    $('#clothin-modal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var action = button.data('action');

        fillBranchesSelect();

        if (action === 'create') {
            $(this).find('.modal-title').text('Adicionar Roupa');
            $(this).find('#buttonText').text('Cadastrar');
            var url = '/roupas';
            var method = 'POST';

            setupValidation(url, method);
        } else if (action === 'edit') {
            $(this).find('.modal-title').text('Editar Roupa');
            $(this).find('#buttonText').text('Atualizar');
            var clothinId = button.data('id');

            $.ajax({
                url: '/roupas/' + clothinId,
                method: 'GET',
                success: function (response) {
                    $('#branch_id').val(response.branch.id);
                    $('#name').val(response.name);
                    $('#type').val(response.type);
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

            var url = '/roupas/' + clothinId;
            var method = 'PUT';

            setupValidation(url, method);
        }
    });

    $('#clothin-modal').on('hidden.bs.modal', function () {
        $(this).find('form')[0].reset();
        $(this).find('.text-danger').remove();
        $(this).find('.is-invalid').removeClass('is-invalid');
    });

    $('.clothin_datatable').on('click', '.link-danger', function (event) {
        event.preventDefault();

        var clothinId = $(this).data('id');

        $('#clothin-modal-delete a#delete').data('clothinId', clothinId);

    });

    $('#clothin-modal-delete a#delete').on('click', function (event) {
        event.preventDefault();

        var clothinId = $(this).data('clothinId');

        if (clothinId) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/roupas/' + clothinId,
                method: 'DELETE',
                success: function (response) {
                    if (response.success) {
                        toastr.success(response.success, {
                            timeOut: 3000,
                            closeButton: true
                        });
                        $('.clothin_datatable').DataTable().ajax.reload();
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
