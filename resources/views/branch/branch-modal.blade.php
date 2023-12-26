<div
    class="modal modal-blur fade"
    id="branch-modal"
    tabindex="-1"
    role="dialog"
    aria-hidden="true">
    <form
        id="branch-form"
        autocomplete="off">
        @csrf
        <div
            class="modal-dialog modal-lg"
            role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Nova Filial</h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-9">
                            <div class="mb-3">
                                <label
                                    class="form-label"
                                    for="name">Nome*
                                </label>
                                <input
                                    type="text"
                                    class="form-control"
                                    name="name"
                                    id="name"
                                >
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label
                                    class="form-label"
                                    for="cep">CEP*
                                </label>
                                <input
                                    type="text"
                                    class="form-control mask-zipcode"
                                    name="cep"
                                    id="cep"
                                >
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label
                                    class="form-label"
                                    for="street">Rua
                                </label>
                                <input
                                    type="text"
                                    class="form-control"
                                    style="background-color: #f8f8f8"
                                    name="street"
                                    id="street"
                                    readonly
                                >
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label
                                    class="form-label"
                                    for="number">
                                    Número
                                </label>
                                <input
                                    type="text"
                                    class="form-control"
                                    name="number"
                                    id="number"
                                >
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label
                                    class="form-label"
                                    for="complement">Complemento
                                </label>
                                <input
                                    type="text"
                                    class="form-control"
                                    name="complement"
                                    id="complement"
                                >
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label
                                    class="form-label"
                                    for="district">Bairro
                                </label>
                                <input
                                    type="text"
                                    style="background-color: #f8f8f8"
                                    class="form-control"
                                    name="district"
                                    id="district"
                                    readonly
                                >
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label
                                    class="form-label"
                                    for="city">
                                    Cidade
                                </label>
                                <input
                                    type="text"
                                    class="form-control"
                                    style="background-color: #f8f8f8"
                                    name="city"
                                    id="city"
                                    readonly
                                >
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label
                                    class="form-label"
                                    for="state">UF
                                </label>
                                <input
                                    type="text"
                                    style="background-color: #f8f8f8"
                                    class="form-control"
                                    name="state"
                                    id="state"
                                    readonly
                                >
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label
                                    class="form-label"
                                    for="email">E-mail
                                </label>
                                <input
                                    type="text"
                                    class="form-control"
                                    name="email"
                                    id="email"
                                >
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label
                                    class="form-label"
                                    for="phone">Telefone
                                </label>
                                <input
                                    type="text"
                                    class="form-control mask-phone"
                                    name="phone"
                                    id="phone"
                                >
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label
                                    class="form-label"
                                    for="whatsapp">WhatsApp
                                </label>
                                <input
                                    type="text"
                                    class="form-control mask-celphone"
                                    name="whatsapp"
                                    id="whatsapp"
                                >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button
                        type="button"
                        id="cancelButton"
                        class="btn btn-link link-secondary"
                        data-bs-dismiss="modal">
                        Cancelar
                    </button>
                    <button
                        type="submit"
                        id="createButton"
                        class="btn btn-primary ms-auto w-25"
                    >
                        <span
                            id="buttonText"
                            class="">Criar Filial</span>
                        <span
                            id="loginSpinner"
                            class="spinner-border spinner-border-sm d-none"
                            role="status"
                            aria-hidden="true"></span>
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
