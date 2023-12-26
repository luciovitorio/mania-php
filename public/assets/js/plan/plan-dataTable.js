$(document).ready(function () {
    var table = $('.plan_datatable').DataTable({
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
            url: '/planos',
        },
        columns: [
            {data: 'name', name: 'name'},
            {data: 'piece_quantity', name: 'piece_quantity'},
            {data: 'simple_piece_quantity', name: 'simple_piece_quantity'},
            {data: 'difficult_piece_quantity', name: 'difficult_piece_quantity'},
            {
                data: 'simple_piece_value',
                name: 'simple_piece_value',
                render: function (data) {
                    return 'R$ ' + data
                }
            },
            {
                data: 'difficult_piece_value',
                name: 'difficult_piece_value',
                render: function (data) {
                    return 'R$ ' + data
                }
            },
            {
                data: 'additional_simple_piece_value',
                name: 'additional_simple_piece_value',
                render: function (data) {
                    return 'R$ ' + data
                }
            },
            {
                data: 'additional_difficult_piece_value',
                name: 'additional_difficult_piece_value',
                render: function (data) {
                    return 'R$ ' + data
                }
            },
            {
                data: 'is_active',
                name: 'is_active',
                render: function (data) {
                    if (data) {
                        return '<span class="badge bg-green text-green-fg">Ativo</span>';
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
    $('.plan_datatable').on('draw.dt', function () {
        const tooltipTriggerList = document.querySelectorAll('[data-bs-tooltip="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    });

    $('.link-warning').mouseenter(function () {
        $('.link-warning').tooltip('show');
    })
})
