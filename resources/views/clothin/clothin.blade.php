@extends('layout-dashboard.main-layout')

@section('title', 'SAS Dashboard')

@section('content')

    @include('layout-dashboard.page-header', ['page' => 'Roupas', 'btnText' => 'Cadastrar Roupa', 'modalName' => 'clothin-modal'])
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Roupas</h3>
        </div>
        <div class="card-body border-bottom py-3">
            <div class="d-flex">
                <div class="text-secondary">
                    Mostrar
                    <div class="mx-2 d-inline-block">
                        <input
                            id="customPageLength"
                            type="text"
                            class="form-control form-control-sm"
                            value="10"
                            size="3"
                            aria-label="Invoices count">
                    </div>
                    registros
                </div>
                <div class="ms-auto text-secondary">
                    Procurar:
                    <div class="ms-2 d-inline-block">
                        <input
                            id="filterBox"
                            type="text"
                            class="form-control form-control-sm"
                            aria-label="Search invoice">
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table card-table  table-striped table-hover text-nowrap clothin_datatable">
                <thead>
                <tr>
                    <th>Filial</th>
                    <th>Nome</th>
                    <th>Tipo</th>
                    <th>Ações</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
    {{--    MODAL --}}
    @include('clothin.clothin-modal')
    @include('clothin.clothin-modal-delete')
@endsection
@section('js')
    <script
        src="{{asset('assets/js/jquery.dataTables.min.js')}}"
        defer></script>
    <script
        src="{{asset('assets/js/jquery.validate.min.js')}}"
        defer></script>
    <script
        src="{{asset('assets/js/clothin/clothin-dataTable.js')}}"
        defer></script>
    <script
        src="{{asset('assets/js/clothin/clothin-modal.js')}}"
        defer></script>
@endsection
@section('css')
    {{ asset('assets/css/jquery.dataTables.min.css') }}
@endsection

