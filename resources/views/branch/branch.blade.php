@extends('layout-dashboard.main-layout')

@section('title', 'SAS Dashboard')

@section('content')

    @include('layout-dashboard.page-header', ['page' => 'Filiais', 'btnText' => 'Cadastrar Filial', 'modalName' => 'branch-modal'])
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Filiais</h3>
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
            <table class="table card-table  table-striped table-hover text-nowrap branch_datatable">
                <thead>
                <tr>
                    <th>Nome</th>
                    <th>Endereço</th>
                    <th>Telefone</th>
                    <th>WhatsApp</th>
                    <th>Ações</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
    {{--    MODAL --}}
    @include('branch.branch-modal')
    @include('branch.branch-modal-delete')
@endsection
@section('js')
    <script
        src="{{asset('assets/js/jquery.dataTables.min.js')}}"
        defer></script>
    <script
        src="{{asset('assets/js/jquery.validate.min.js')}}"
        defer></script>
    <script
        src="{{asset('assets/js/branch/branch-dataTable.js')}}"
        defer></script>
    <script
        src="{{asset('assets/js/branch/branch-modal.js')}}"
        defer></script>
    <script
        src="{{asset('assets/js/branch/branch-form-mask.js')}}"
        defer></script>
@endsection
@section('css')
    {{ asset('assets/css/jquery.dataTables.min.css') }}
@endsection

