<div
    class="modal modal-blur fade"
    id="clothin-modal"
    tabindex="-1"
    role="dialog"
    aria-hidden="true">
    <form
        id="clothin-form"
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
                        <div class="col-lg-4">
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
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label
                                    class="form-label"
                                    for="type">
                                    Dificuldade
                                </label>
                                <select
                                    class="form-select"
                                    name="type"
                                    id="type"
                                >
                                    <option
                                        value="">
                                        Selecione a dificuldade
                                    </option>
                                    <option value="EASY">Fácil</option>
                                    <option value="HARD">Difícil</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label
                                    class="form-label"
                                    for="branch_id">
                                    Filial
                                </label>
                                <select
                                    class="form-select"
                                    name="branch_id"
                                    id="branch_id"
                                >
                                </select>
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


