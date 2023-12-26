$(document).ready(function () {
//     Preenchendo os dados dos inputs quando clico no botão de perfil
//     Estou fazendo isso aqui pois como eu estou preenchendo os dados do formulário com os dados
//     da sessão. Quando eu altero o valor do modal e cancelo e depois eu abro o modal novamente,
//     o valor dos inputs não são recuperados. Então vou fazer com que quando eu clico no botão
//     de perfil, eu vou no back, pego os dados do usuário e preencho os inputs.
    $('#profile-menu, #profile-menu-mobile').click(function (e) {
        e.preventDefault();

        var userId = $(this).data('user-id');

        function phoneFormatter(phone) {
            // Verifica se o telefone tem 11 dígitos
            if (phone.length === 11) {
                return phone.replace(/(\d{2})(\d{5})(\d{4})/, "($1) $2-$3");
            } else if (phone.length === 10) { // Verifica se o telefone tem 10 dígitos
                return phone.replace(/(\d{2})(\d{4})(\d{4})/, "($1) $2-$3");
            } else {
                // Retorna o telefone sem formatação, se não for 10 nem 11 dígitos
                return phone;
            }
        }

        $.ajax({
            url: '/users/' + userId,
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                let cpf = data.cpf;
                let cpfFormatado = cpf.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, "$1.$2.$3-$4");
                let phoneFormatted = phoneFormatter(data.phone);

                $('#name').val(data.name);
                $('#email').val(data.email);
                $('#phone').val(phoneFormatted);
                $('#cpf').val(cpfFormatado);

                if (data.photo) {
                    $('#preview').attr('src', '/storage/' + data.photo);
                }
            },
            error: function (xhr, status, error) {
                console.error(error)
            }
        })
    })

    /**
     * Validação e tratamento da imagem no formulário. Estamos validando se realmente é uma imagem,
     * o tamanho máximo dela que seria de 2MB e mostrando um preview da imagem selecionada
     * */

    var defaultImage = $('#preview').attr('src');
    var message = $('#message');
    var messageText = $('#message-text')

    $('#photo').on('change', function (e) {
        var file = e.target.files[0];
        var previewImage = $('#preview');
        var maxSizeInBytes = 2 * 1024 * 1024; // 2 MB

        if (file) {
            var imageType = /^image\//;

            if (!imageType.test(file.type)) {
                $('#photo').val(''); // Limpa a seleção do arquivo
                previewImage.attr('src', defaultImage);
                messageText.text('Selecione um arquivo de imagem válido.')
                message.show();
                setTimeout(function () {
                    message.hide();
                }, 5000)
            } else if (file.size > maxSizeInBytes) {
                $('#photo').val(''); // Limpa a seleção do arquivo
                previewImage.attr('src', defaultImage);
                messageText.text('A imagem selecionada é muito grande. Selecione uma imagem menor que 2MB')
                message.show();
                setTimeout(function () {
                    message.hide();
                }, 5000)
            } else {
                var reader = new FileReader();
                reader.onload = function (e) {
                    previewImage.attr('src', e.target.result);
                };
                reader.readAsDataURL(file);
            }
        } else {
            previewImage.attr('src', 'http://127.0.0.1:8000/storage/profile-images/photo-off.png'); // Define a imagem padrão
        }
    });

    // MASK
    var cellMaskBehavior = function (val) {
            return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
        },
        cellOptions = {
            onKeyPress: function (val, e, field, options) {
                field.mask(cellMaskBehavior.apply({}, arguments), options);
            }
        };

    $('.mask-phone').mask(cellMaskBehavior, cellOptions);
    // $('.mask-phone').mask('(00) 0000-0000');
    $(".mask-date").mask('00/00/0000');
    $(".mask-datetime").mask('00/00/0000 00:00');
    $(".mask-month").mask('00/0000', {reverse: true});
    $(".mask-cpf").mask('000.000.000-00', {reverse: true});
    $(".mask-cnpj").mask('00.000.000/0000-00', {reverse: true});
    $(".mask-zipcode").mask('00000-000', {reverse: true});
    $(".mask-money").mask('R$ 000.000.000.000.000,00', {reverse: true, placeholder: "R$ 0,00"});
})

