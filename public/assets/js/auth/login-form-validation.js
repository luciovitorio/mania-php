$(document).ready(function () {
    // Adicionando regra de validação para o CPF
    $.validator.addMethod("cpf", function (value, element) {
        value = value.replace(/[^\d]/g, ''); // Remove caracteres não numéricos
        if (value.length !== 11 || /^(\d)\1{10}$/.test(value)) {
            return false;
        }
        let soma = 0;
        for (let i = 0; i < 9; i++) {
            soma += parseInt(value.charAt(i)) * (10 - i);
        }
        let resto = soma % 11;
        let digitoVerificador1 = resto < 2 ? 0 : 11 - resto;

        if (digitoVerificador1 !== parseInt(value.charAt(9))) {
            return false;
        }

        soma = 0;
        for (let i = 0; i < 10; i++) {
            soma += parseInt(value.charAt(i)) * (11 - i);
        }
        resto = soma % 11;
        let digitoVerificador2 = resto < 2 ? 0 : 11 - resto;

        if (digitoVerificador2 !== parseInt(value.charAt(10))) {
            $(element).addClass('is-invalid');
            return false;
        }

        $(element).removeClass('is-invalid');
        return true;
    }, "Por favor, insira um CPF válido.");

    $('#loginForm').validate({
        errorPlacement: function (error, element) {
            element.removeClass('error');
            error.addClass('small text-danger mt-1');
            element.addClass('is-invalid');
            error.insertAfter(element);
        },
        rules: {
            cpf: {
                required: true,
                cpf: true
            },
            password: {
                required: true,
            }
        },
        messages: {
            cpf: {
                required: "Por favor, preencha esse campo.",
            },
            password: {
                required: "Por favor, preencha esse campo",
            }
        },
        success: function (label, element) {
            $(element).removeClass('is-invalid');
        },
        submitHandler: function (form) {
            $('#loginButton').prop('disabled', true);
            $('#buttonText').addClass('d-none');
            $('#loginSpinner').removeClass('d-none');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '/login',
                method: 'POST',
                data: $(form).serialize(),
                success: function (response) {
                    if (response.errors) {
                        toastr.error(response.errors, {
                            timeOut: 3000,
                            closeButton: true
                        });
                        $('#loginButton').prop('disabled', false);
                        $('#buttonText').removeClass('d-none');
                        $('#loginSpinner').addClass('d-none');
                        return;
                    }

                    if (response.success) {
                        window.location.href = '/';
                    }
                },
                error: function (xhr, status, error) {
                    if (xhr.status === 422) {
                        var errors = xhr.responseJSON.errors;
                        $.each(errors, function (key, value) {
                            $('#' + key).addClass('is-invalid');
                            $('#' + key).after('<div class="small text-danger mt-1">' + value + '</div>');
                        });
                        $('#loginButton').prop('disabled', false);
                        $('#buttonText').removeClass('d-none');
                        $('#loginSpinner').addClass('d-none');
                    }
                }
            });
        }
    });
});
