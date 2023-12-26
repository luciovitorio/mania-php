<html lang="pt-br">
<head>
    <meta charset="utf-8"/>
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta
        http-equiv="X-UA-Compatible"
        content="ie=edge"/>
    <meta
        name="csrf-token"
        content="{{ csrf_token() }}">
    <title>Login</title>
    <!-- CSS files -->
    <link
        href="{{ asset('assets/css/tabler.min.css') }}"
        rel="stylesheet"/>
    <link
        href="{{ asset('assets/css/toastr.min.css') }}"
        rel="stylesheet"/>
    <link
        href="{{ asset('assets/css/tabler-flags.min.css') }}"
        rel="stylesheet"/>
    <link
        href="{{ asset('assets/css/tabler-payments.min.css') }}"
        rel="stylesheet"/>
    <link
        href="{{ asset('assets/css/tabler-vendors.min.css') }}"
        rel="stylesheet"/>
    <link
        href="{{ asset('assets/css/demo.min.css') }}"
        rel="stylesheet"/>
    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }
    </style>
</head>
<body class=" d-flex flex-column">
<script src="{{ asset('assets/js/demo-theme.min.js') }}"></script>
<div class="page page-center">
    <div id="showmessage"></div>
    <div class="container container-normal py-4">
        <div class="row align-items-center g-4">
            <div class="col-lg">
                <div class="container-tight">
                    <div class="text-center mb-4">
                        <a
                            href="."
                            class="navbar-brand navbar-brand-autodark"><img
                                src="{{ asset('assets/static/logo.svg') }}"
                                height="36"
                                alt=""></a>
                    </div>
                    <div class="card card-md">
                        <div class="card-body">
                            <h2 class="h2 text-center mb-4">Entre com sua conta</h2>
                            @if(session('error'))
                                <div
                                    class="alert alert-danger"
                                    role="alert">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="icon alert-icon"
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
                                                    fill="none"></path>
                                                <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                                                <path d="M12 8v4"></path>
                                                <path d="M12 16h.01"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            {{ session('error') }}
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <form
                                id="loginForm"
                                autocomplete="off"
                            >
                                @csrf
                                <div class="mb-3">
                                    <label
                                        class="form-label"
                                        for="cpf">Digite seu CPF*
                                    </label>
                                    <input
                                        id="cpf"
                                        type="text"
                                        name="cpf"
                                        class="form-control mask-cpf"
                                        placeholder="999.999.999-99"
                                        autocomplete="off">
                                </div>
                                <div class="mb-2">
                                    <label
                                        class="form-label"
                                        for="password">
                                        Senha*
                                        <span class="form-label-description">
                                            <a href="./forgot-password.html">
                                                Esqueci minha senha
                                            </a>
                                        </span>
                                    </label>
                                    <input
                                        type="password"
                                        id="password"
                                        name="password"
                                        class="form-control"
                                        placeholder="Sua senha"
                                        autocomplete="off">
                                </div>
                                <div class="form-footer">
                                    <button
                                        type="submit"
                                        id="loginButton"
                                        class="btn btn-primary w-100">
                                        <span id="buttonText">Entrar</span>
                                        <span
                                            id="loginSpinner"
                                            class="spinner-border spinner-border-sm d-none"
                                            role="status"
                                            aria-hidden="true"></span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg d-none d-lg-block">
                <img
                    src="{{ asset('assets/static/illustrations/undraw_secure_login_pdn4.svg') }}"
                    height="300"
                    class="d-block mx-auto"
                    alt="">
            </div>
        </div>
    </div>
</div>
<!-- Libs JS -->
<!-- Tabler Core -->
<script
    src="{{ asset('assets/js/tabler.min.js') }}"
    defer></script>
<script
    src="{{ asset('assets/js/demo.min.js') }}"
    defer></script>
<script
    src="{{ asset('assets/js/jquery.min.js') }}"
    defer></script>
<script
    src="{{ asset('assets/js/toastr.min.js') }}"
    defer></script>
<script
    src="{{ asset('assets/js/jquery.validate.min.js') }}"
    defer></script>
<script
    src="{{ asset('assets/js/jquery.mask.js') }}"
    defer></script>
<script
    src="{{ asset('assets/js/auth/login-form-validation.js') }}"
    defer></script>
<script
    src="{{ asset('assets/js/auth/login-form-mask.js') }}"
    defer></script>
</body>
</html>

