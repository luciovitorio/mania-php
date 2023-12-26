@extends('layout-dashboard.main-layout')

@section('title', 'SAS Dashboard')

@section('content')
    @include('layout-dashboard.page-header', ['page' => 'Planos', 'btnText' => 'Cadastrar Plano', 'modalName' => 'plan-modal'])
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Planos</h3>
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
            <table class="table card-table  table-striped table-hover text-nowrap plan_datatable">
                <thead>
                <tr>
                    <th>Nome</th>
                    <th>Qtd Peças</th>
                    <th>Qtd Pçs Simples</th>
                    <th>Qtd Pçs Difíceis</th>
                    <th>Valor Pç Simples</th>
                    <th>Valor Pç Difícil</th>
                    <th>Valor Adc Simples</th>
                    <th>Valor Adc Difícil</th>
                    <th>Situação</th>
                    <th>Ações</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
    {{--    MODAL --}}
    @include('plan.plan-modal')
    @include('plan.plan-modal-delete')
@endsection
@section('js')
    <script
        src="{{asset('assets/js/jquery.dataTables.min.js')}}"
        defer></script>
    <script
        src="{{asset('assets/js/jquery.validate.min.js')}}"
        defer></script>
    <script
        src="{{asset('assets/js/plan/plan-dataTable.js')}}"
        defer></script>
    <script
        src="{{asset('assets/js/plan/plan-modal.js')}}"
        defer></script>
    <script
        src="{{asset('assets/js/plan/plan-form-mask.js')}}"
        defer></script>
@endsection
@section('css')
    {{ asset('assets/css/jquery.dataTables.min.css') }}
@endsection

