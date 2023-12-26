<div
    class="modal modal-blur fade"
    id="client-modal"
    tabindex="-1"
    role="dialog"
    aria-hidden="true">
    <form
        id="client-form"
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
                        <div class="col-lg-3">
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
                                    for="plan">
                                    Selecione um plano
                                </label>
                                <select
                                    class="form-select"
                                    name="plan"
                                    id="plan"
                                >
                                </select>
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
                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label
                                    class="form-label"
                                    for="rg">
                                    RG
                                </label>
                                <input
                                    type="text"
                                    class="form-control"
                                    name="rg"
                                    id="rg"
                                >
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label
                                    class="form-label"
                                    for="home-phone">
                                    Telefone Residencial
                                </label>
                                <input
                                    type="text"
                                    class="form-control"
                                    name="home-phone"
                                    id="home-phone"
                                >
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label
                                    class="form-label"
                                    for="cell-phone">
                                    Telefone Celular
                                </label>
                                <input
                                    type="text"
                                    class="form-control"
                                    name="cell-phone"
                                    id="cell-phone"
                                >
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="mb-3">
                                <div class="form-label">Cliente ativo?</div>
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
                    </div>
                </div>
                <div class="modal-body">
                    <div class="row">
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
                    </div>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label
                                    class="form-label"
                                    for="collection_frequency">
                                    Frequencia da coleta
                                </label>
                                <select
                                    class="form-select"
                                    name="collection_frequency"
                                    id="collection_frequency"
                                >
                                    <option
                                        value="">
                                        Selecione a frequencia
                                    </option>
                                    <option value="semanal">Semanal</option>
                                    <option value="quinzenal">Quinzenal</option>
                                    <option value="mensal">Mensal</option>
                                    <option value="avulso">Avulso</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label
                                    class="form-label"
                                    for="collection_day">
                                    Dia da coleta
                                </label>
                                <select
                                    class="form-select"
                                    name="collection_day"
                                    id="collection_day"
                                >
                                    <option
                                        value="">
                                        Selecione o dia da coleta
                                    </option>
                                    <option value="segunda">Segunda</option>
                                    <option value="terca">Terça</option>
                                    <option value="quarta">Quarta</option>
                                    <option value="quinta">Quinta</option>
                                    <option value="sexta">Sexta</option>
                                    <option value="sabado">Sábado</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label
                                    class="form-label"
                                    for="collection_time">
                                    Hora da coleta
                                </label>
                                <input
                                    type="time"
                                    class="form-control"
                                    name="collection_time"
                                    id="collection_time"
                                >
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label
                                    class="form-label"
                                    for="delivery_day">
                                    Dia da entrega
                                </label>
                                <select
                                    class="form-select"
                                    name="delivery_day"
                                    id="delivery_day"
                                >
                                    <option
                                        value="">
                                        Selecione a frequencia
                                    </option>
                                    <option value="segunda">Segunda</option>
                                    <option value="terca">Terça</option>
                                    <option value="quarta">Quarta</option>
                                    <option value="quinta">Quinta</option>
                                    <option value="sexta">Sexta</option>
                                    <option value="sabado">Sábado</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label
                                    class="form-label"
                                    for="delivery_time">
                                    Hora da entrega
                                </label>
                                <input
                                    type="time"
                                    class="form-control"
                                    name="delivery_time"
                                    id="delivery_time"
                                >
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label
                                    class="form-label"
                                    for="collection_start">
                                    Início da coleta
                                </label>
                                <input
                                    type="date"
                                    class="form-control"
                                    name="collection_start"
                                    id="collection_start"
                                >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label
                                    class="form-label"
                                    for="description">
                                    Observação
                                    <span
                                        class="form-label-description"
                                        id="charCount">
                                        0/100
                                    </span>
                                </label>
                                <textarea
                                    class="form-control"
                                    name="description"
                                    id="description"
                                    maxlength="100"
                                ></textarea>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="mb-3">
                                <div class="form-label">Taxa de entrega?</div>
                                <div>
                                    <label class="form-check form-check-inline">
                                        <input
                                            class="form-check-input"
                                            type="checkbox"
                                            name="delivery_fee"
                                            id="delivery_fee"
                                        >
                                        <span class="form-check-label">Sim</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label
                                    class="form-label"
                                    for="delivery_amount">
                                    Valor da taxa de entrega
                                </label>
                                <input
                                    type="text"
                                    class="form-control bg-gray-600"
                                    name="delivery_amount"
                                    id="delivery_amount"
                                    disabled
                                >
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label
                                    class="form-label"
                                    for="due_date">
                                    Dia do vencimento
                                </label>
                                <input
                                    type="number"
                                    class="form-control"
                                    name="due_date"
                                    id="due_date"
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
</div>
</form>
</div>


