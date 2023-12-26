<html lang="pt-br">
<head>
    <meta charset="utf-8"/>
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta
        http-equiv="X-UA-Compatible"
        content="ie=edge"/>
    <title>Página não encontrada</title>
    <!-- CSS files -->
    <link
        href="{{ asset('assets/css/tabler.min.css') }}"
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
<body class=" border-top-wide border-primary d-flex flex-column">
<script src="{{ asset('assets/js/demo-theme.min.js') }}"></script>
<div class="page page-center">
    <div class="container py-4">
        <div class="empty">
            <div class="empty-header">404</div>
            <p class="empty-title">Oops… Você encontrou um erro na página</p>
            <p class="empty-subtitle text-muted">
                Desculpe, mas a página que você procura não foi encontrada
            </p>
            <div class="empty-action">
                <a
                    href="./."
                    class="btn btn-primary">
                    <!-- Download SVG icon from http://tabler-icons.io/i/arrow-left -->
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
                        <path d="M5 12l14 0"/>
                        <path d="M5 12l6 6"/>
                        <path d="M5 12l6 -6"/>
                    </svg>
                    Voltar ao início
                </a>
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
</body>
</html>
