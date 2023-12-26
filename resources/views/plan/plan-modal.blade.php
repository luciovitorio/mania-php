<div
    class="modal modal-blur fade"
    id="plan-modal"
    tabindex="-1"
    role="dialog"
    aria-hidden="true">
    <form
        id="plan-form"
        autocomplete="off">
        @csrf
        <div
            class="modal-dialog modal-lg"
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
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label
                                    class="form-label"
                                    for="totalPiecesDisabled">
                                    Quantidade de peças
                                </label>
                                <input
                                    type="number"
                                    class="form-control"
                                    id="totalPiecesDisabled"
                                    name="total_pieces_disabled"
                                    disabled
                                >
                                <input
                                    type="hidden"
                                    name="piece_quantity"
                                    id="hiddenTotalPieces"
                                >
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label
                                    class="form-label"
                                    for="simple_piece_quantity">
                                    Quantidade de peças simples
                                </label>
                                <input
                                    type="number"
                                    class="form-control piece-input"
                                    name="simple_piece_quantity"
                                    id="simple_piece_quantity"
                                >
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label
                                    class="form-label"
                                    for="difficult_piece_quantity">
                                    Quantidade de peças difíceis
                                </label>
                                <input
                                    type="number"
                                    class="form-control piece-input"
                                    name="difficult_piece_quantity"
                                    id="difficult_piece_quantity"
                                >
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label
                                    class="form-label"
                                    for="simple_piece_value">
                                    Valor da peça simples
                                </label>
                                <input
                                    type="text"
                                    class="form-control mask-money"
                                    name="simple_piece_value"
                                    id="simple_piece_value"
                                >
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label
                                    class="form-label"
                                    for="difficult_piece_value">
                                    Valor da peça difícil
                                </label>
                                <input
                                    type="text"
                                    class="form-control mask-money"
                                    name="difficult_piece_value"
                                    id="difficult_piece_value"
                                >
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label
                                    class="form-label"
                                    for="additional_simple_piece_value">
                                    Valor adicional da peça simples
                                </label>
                                <input
                                    type="text"
                                    class="form-control mask-money"
                                    name="additional_simple_piece_value"
                                    id="additional_simple_piece_value"
                                >
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label
                                    class="form-label"
                                    for="additional_difficult_piece_value">
                                    Valor adicional da peça difícil
                                </label>
                                <input
                                    type="text"
                                    class="form-control mask-money"
                                    name="additional_difficult_piece_value"
                                    id="additional_difficult_piece_value"
                                >
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-check">
                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        name="is_active"
                                        id="is_active"
                                        checked>
                                    <span class="form-check-label">
                                        Plano ativo?
                                    </span>
                                </label>
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


