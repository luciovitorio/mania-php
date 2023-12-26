$(document).ready(function () {
    var currentUrl;
    var currentMethod;
    var deleteButtonClicked = false;
    var maxChars = 100;

    // Captura o evento de digitação no textarea
    $('#description').on('input', function () {
        var currentChars = $(this).val().length;
        if (currentChars > maxChars) {
            $(this).val($(this).val().substring(0, maxChars));
            currentChars = maxChars;
        }
        $('#charCount').text(currentChars + '/' + maxChars);
    });

    // Se o checkbox estiver marcado, habilitar o input; caso contrário, desabilitar
    $('#delivery_fee').change(function () {
        $('#delivery_amount').prop('disabled', !this.checked);
        $('#delivery_amount').removeClass('is-invalid');
        $('#delivery_amount-error').remove();
        $('#delivery_amount').toggleClass('bg-gray-600', !this.checked);
    });

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

    // Chamada Ajax para buscar dados dos planos ao carregar a página
    $.ajax({
        url: '/planos',
        method: 'GET',
        success: function (data) {
            plansData = data.data;
        },
        error: function (error) {
            console.log('Erro ao buscar os planos:', error);
        }
    });

    // Função para preencher o select de filiais
    function fillBranchesSelect() {
        $('#branch').empty();
        $('#branch').append('<option value="">Escolha uma filial</option>');

        if (branchesData) {
            branchesData.forEach(function (branch) {
                $('#branch').append('<option value="' + branch.id + '">' + branch.name + '</option>');
            });
        }
    }

    // Função para preencher o select de planos
    function fillPlansSelect() {
        $('#plan').empty();
        $('#plan').append('<option value="">Escolha um plano</option>');

        if (plansData) {
            plansData.forEach(function (plan) {
                $('#plan').append('<option value="' + plan.id + '">' + plan.name + '</option>');
            });
        }
    }

    function setupValidation(url, method) {
        currentUrl = url;
        currentMethod = method;
        var rules = {
            branch: {
                required: true,
            },
            name: {
                required: true,
            },
            email: {
                email: true,
            },
            plan: {
                required: true,
            },
            collection_frequency: {
                required: true
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
            },
            delivery_amount: {
                required: function () {
                    return $('#delivery_fee').is(':checked');
                }
            }
        };

        if (method === 'PUT') {
            delete rules.password
        }

        $('#client-form').validate({
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
                branch: {
                    required: "Por favor, preencha esse campo.",
                },
                plan: {
                    required: "Por favor, preencha esse campo.",
                },
                collection_frequency: {
                    required: "Por favor, preencha esse campo."
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
                delivery_amount: {
                    required: 'Por favor, preencha esse campo'
                }
            },
            success: function (label, element) {
                $(element).removeClass('is-invalid');
            },
            submitHandler: function (form) {
                $('#createButton').prop('disabled', true);
                $('#buttonText').addClass('d-none');
                $('#loginSpinner').removeClass('d-none');

                // limpando o cpf para enviar apenas os dígitos
                var cpfValue = $('#cpf').val();
                var cleanedCPF = cpfValue.replace(/\D/g, '');
                $('#cpf').val(cleanedCPF);

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
                            $('.client_datatable').DataTable().ajax.reload();
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

    $('#client-modal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var action = button.data('action');

        fillBranchesSelect();
        fillPlansSelect();

        if (action === 'create') {
            $(this).find('.modal-title').text('Adicionar Cliente');
            $(this).find('#buttonText').text('Criar Cliente');
            var url = '/clientes';
            var method = 'POST';

            setupValidation(url, method);
        } else if (action === 'edit') {
            $(this).find('.modal-title').text('Editar Usuário');
            $(this).find('#buttonText').text('Atualizar Usuário');
            var userId = button.data('id');

            $.ajax({
                url: '/usuarios/' + userId,
                method: 'GET',
                success: function (response) {
                    console.log(response)
                    var profileWithLowerFirstChar = response.profile.charAt(0).toLowerCase() + response.profile.slice(1);
                    $('#branch').val(response.branch.id);
                    $('#name').val(response.name);
                    $('#email').val(response.email);
                    $('#cpf').val(response.cpf);
                    $('#date_of_birth').val(response.date_of_birth);
                    $('#profile').val(profileWithLowerFirstChar);
                    $('#percent').val(response.percent);
                    $('#is_active').prop('checked', response.is_active);
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

            var url = '/usuarios/' + userId;
            var method = 'PUT';

            setupValidation(url, method);
        }
    });

    $('#user-modal').on('hidden.bs.modal', function () {
        $(this).find('form')[0].reset();
        $(this).find('.text-danger').remove();
        $(this).find('.is-invalid').removeClass('is-invalid');
    });

    $('.user_datatable').on('click', '.link-danger', function (event) {
        event.preventDefault();

        var userId = $(this).data('id');

        $('#user-modal-delete a#delete').data('userId', userId);

    });

    $('#user-modal-delete a#delete').on('click', function (event) {
        event.preventDefault();

        var userId = $(this).data('userId');

        if (userId) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/usuarios/' + userId,
                method: 'DELETE',
                success: function (response) {
                    if (response.success) {
                        toastr.success(response.success, {
                            timeOut: 3000,
                            closeButton: true
                        });
                        $('.user_datatable').DataTable().ajax.reload();
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
