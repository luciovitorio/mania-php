<div
    class="modal modal-blur fade"
    id="user-modal"
    tabindex="-1"
    role="dialog"
    aria-hidden="true">
    <form
        id="branch-form"
        autocomplete="off">
        @csrf
        <div
            class="modal-dialog modal-xl"
            role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label
                                    class="form-label"
                                    for="name">Nome
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
                                    for="branch">
                                    Filial
                                </label>
                                <select
                                    class="form-select"
                                    name="branch"
                                    id="branch"
                                >
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label
                                    class="form-label"
                                    for="cep">CEP
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
                                    for="email">E-mail
                                </label>
                                <input
                                    type="email"
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
                                    for="cpf">
                                    CPF
                                </label>
                                <input
                                    type="text"
                                    class="form-control mask-cpf"
                                    name="cpf"
                                    id="cpf"
                                >
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label
                                    class="form-label"
                                    for="date_of_birth">Data de Nascimento</label>
                                <input
                                    type="date"
                                    class="form-control"
                                    placeholder="Selecione uma data"
                                    id="date_of_birth"
                                    name="date_of_birth"
                                >
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label
                                    class="form-label"
                                    for="password">
                                    Senha
                                </label>
                                <input
                                    type="password"
                                    class="form-control"
                                    name="password"
                                    id="password"
                                >
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label
                                    class="form-label"
                                    for="profile">
                                    Perfil
                                </label>
                                <select
                                    class="form-select"
                                    name="profile"
                                    id="profile"
                                >
                                    <option
                                        value="">
                                        Selecione um Perfil
                                    </option>
                                    <option value="administrador">Administrador</option>
                                    <option value="supervisao">Supervisão</option>
                                    <option value="passadeira">Passadeira</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="mb-3">
                                <div class="form-label">Usuário ativo?</div>
                                <div>
                                    <label class="form-check form-check-inline">
                                        <input
                                            class="form-check-input"
                                            type="checkbox"
                                            name="is_active"
                                            id="is_active"
                                            checked>
                                        <span class="form-check-label">Ativo</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label
                                    class="form-label"
                                    for="street">
                                    Rua
                                </label>
                                <input
                                    type="text"
                                    class="form-control bg-gray-600"
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
                                    for="complement">
                                    Complemento
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
                                    for="district">
                                    Bairro
                                </label>
                                <input
                                    type="text"
                                    class="form-control bg-gray-600"
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
                                    class="form-control bg-gray-600"
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
                                    for="state">
                                    UF
                                </label>
                                <input
                                    type="text"
                                    class="form-control bg-gray-600"
                                    name="state"
                                    id="state"
                                    readonly
                                >
                            </div>
                        </div>
                        <div
                            class="col-lg-3"
                            id="percentContainer">
                            <div class="mb-3">
                                <label
                                    class="form-label"
                                    for="percent">
                                    % Comissão
                                </label>
                                <input
                                    type="number"
                                    class="form-control"
                                    name="percent"
                                    id="percent"
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
                        class="btn btn-primary ms-auto"
                    >
                        <span
                            id="buttonText"
                            class=""></span>
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


