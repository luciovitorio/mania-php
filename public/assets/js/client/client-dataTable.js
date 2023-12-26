$(document).ready(function () {
    var table = $('.client_datatable').DataTable({
        language: {
            paginate: {
                first: 'Primeira',
                last: 'Última',
                next: 'Próxima',
                previous: 'Anterior'
            },
            info: "Mostrando _START_ até _END_ de _TOTAL_ registros",
        },
        dom: '<"top">cti<"top"p><"clear">',
        processing: true,
        serverSide: true,
        ajax: {
            url: '/clientes',
        },
        columns: [
            {data: 'branch.name', name: 'branch.name'},
            {data: 'name', name: 'name'},
            {data: 'cpf', name: 'cpf'},
            {
                data: null,
                name: 'address',
                render: function (data, type, full, meta) {
                    var address = full.address;
                    var formattedAddress = address.street + ' ' + address.number;

                    if (address.complement) {
                        formattedAddress += ', ' + address.complement;
                    }

                    formattedAddress += ', ' + address.district + ', ' + address.city;

                    return formattedAddress;
                }
            },
            {data: 'cell_phone', name: 'cell_phone'},
            {data: 'plan.name', name: 'plan.name'},
            {
                data: 'is_active',
                name: 'is_active',
                render: function (data) {
                    if (data) {
                        return '<span class="badge bg-primary text-green-fg">Ativo</span>';
                    } else {
                        return '<span class="badge bg-red text-red-fg">Bloqueado</span>';
                    }
                }
            },
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    })

    $('#filterBox').keyup(function () {
        table.search(this.value).draw();
    })

    $('#customPageLength').on('change keyup', function () {
        var pageLength = $(this).val();
        table.page.len(pageLength).draw();
    });

    // Ativar os tooltips após a renderização da tabela
    $('.user_datatable').on('draw.dt', function () {
        const tooltipTriggerList = document.querySelectorAll('[data-bs-tooltip="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    });

    $('.link-warning').mouseenter(function () {
        $('.link-warning').tooltip('show');
    })
})
