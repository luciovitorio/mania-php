<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="card-body">
                    <ol class="breadcrumb breadcrumb-arrows">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Início</a></li>
                        <li class="breadcrumb-item active"><a href="#">{{ $page ?? 'Page name' }}</a></li>
                    </ol>
                </div>
            </div>
            <!-- Page title actions -->
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <a
                        href="javascript:void(0);"
                        class="btn btn-primary"
                        data-action="create"
                        data-bs-toggle="modal"
                        data-bs-target="{{ '#'.$modalName ?? 'modal-name' }}">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="icon"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            stroke-width="2"
                            stroke="currentColor"
                            fill="none"
                            stroke-linecap="round"
                            stroke-linejoin="round">
                            <path
                                stroke="none"
                                d="M0 0h24v24H0z"
                                fill="none"/>
                            <path d="M12 5l0 14"/>
                            <path d="M5 12l14 0"/>
                        </svg>
                        {{ $btnText ?? 'Texto do botão' }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
