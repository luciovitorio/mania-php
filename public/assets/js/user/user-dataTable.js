$(document).ready(function () {
    var table = $('.user_datatable').DataTable({
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
            url: '/usuarios',
        },
        columns: [
            {data: 'branch.name', name: 'branch.name'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'cpf', name: 'cpf'},
            {data: 'profile', name: 'profile'},
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
