<aside
    class="navbar navbar-vertical navbar-expand-lg"
    data-bs-theme="dark">
    <div class="container-fluid">
        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#sidebar-menu"
            aria-controls="sidebar-menu"
            aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="navbar-brand navbar-brand-autodark">
            <a href=".">
                <img
                    src="{{ asset('assets/static/logo.svg') }}"
                    width="110"
                    height="32"
                    alt="Tabler"
                    class="navbar-brand-image">
            </a>
        </h1>
        <div class="navbar-nav flex-row d-lg-none">
            <div class="nav-item dropdown">
                <a
                    href="#"
                    class="nav-link d-flex lh-1 text-reset p-0"
                    data-bs-toggle="dropdown"
                    aria-label="Open user menu">
                        <span
                            class="avatar avatar-sm"
                            style="background-image: url({{ asset('assets/static/avatars/000m.jpg') }})"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <a
                        href="#"
                        class="dropdown-item">Status</a>
                    <a
                        id="profile-menu-mobile"
                        data-user-id="{{ Auth::user()->id }}"
                        href="#"
                        data-bs-toggle="modal"
                        data-bs-target="#user-perfil-modal"
                        class="dropdown-item">Perfil</a>
                    <a
                        href="#"
                        class="dropdown-item">Feedback</a>
                    <div class="dropdown-divider"></div>
                    <a
                        href="./settings.html"
                        class="dropdown-item">Settings</a>
                    <a
                        href="{{ route('logout') }}"
                        class="dropdown-item">Sair</a>
                </div>
            </div>
        </div>
        <div
            class="collapse navbar-collapse"
            id="sidebar-menu">
            <ul class="navbar-nav pt-lg-3">
                <li class="nav-item">
                    <a
                        class="nav-link"
                        href="./">
                  <span class="nav-link-icon d-md-none d-lg-inline-block">
                    @include('icons.home-icon')
                  </span>
                        <span class="nav-link-title">
                    Home
                  </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a
                        class="nav-link"
                        href="./">
                  <span class="nav-link-icon d-md-none d-lg-inline-block">
                    @include('icons.checkup-icon')
                  </span>
                        <span class="nav-link-title">
                    Gerar e-Rol
                  </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a
                        class="nav-link"
                        href="{{ route('client.index') }}"
                    >
                      <span class="nav-link-icon d-md-none d-lg-inline-block">
                        @include('icons.briefcase-icon')
                      </span>
                        <span class="nav-link-title">
                            Clientes
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a
                        class="nav-link"
                        href="{{ route('client.index') }}"
                    >
                      <span class="nav-link-icon d-md-none d-lg-inline-block">
                        @include('icons.package-icon')
                      </span>
                        <span class="nav-link-title">
                            Operação
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a
                        class="nav-link"
                        href="{{ route('client.index') }}"
                    >
                      <span class="nav-link-icon d-md-none d-lg-inline-block">
                        @include('icons.truck-icon')
                      </span>
                        <span class="nav-link-title">
                            Entregas/Coleta
                        </span>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a
                        class="nav-link dropdown-toggle"
                        href="#navbar-help"
                        data-bs-toggle="dropdown"
                        data-bs-auto-close="false"
                        role="button"
                        aria-expanded="false">
                  <span class="nav-link-icon d-md-none d-lg-inline-block">
                      @include('icons.money-icon')
                  </span>
                        <span class="nav-link-title">
                    Financeiro
                  </span>
                    </a>
                    <div class="dropdown-menu">
                        <a
                            class="dropdown-item"
                            href="{{ route('clothin.index') }}"
                        >
                            - Gerar fechamento
                        </a>
                        <a
                            class="dropdown-item"
                            href="{{ route('clothin.index') }}"
                        >
                            - Extrato de fechamento
                        </a>
                        <a
                            class="dropdown-item"
                            href="{{ route('clothin.index') }}"
                        >
                            - Lista de fechamento
                        </a>
                        <a
                            class="dropdown-item"
                            href="{{ route('clothin.index') }}"
                        >
                            - Extrato de produção
                        </a>
                    </div>
                </li>
                <li class="nav-item">
                    <a
                        class="nav-link"
                        href="{{ route('user.index') }}"
                    >
                      <span class="nav-link-icon d-md-none d-lg-inline-block">
                        @include('icons.users-icon')
                      </span>
                        <span class="nav-link-title">
                            Usuários
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a
                        class="nav-link"
                        href="{{ route('branch.index') }}">
                  <span class="nav-link-icon d-md-none d-lg-inline-block">
                      @include('icons.branch-icon')
                  </span>
                        <span class="nav-link-title">
                    Filiais
                  </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a
                        class="nav-link"
                        href="{{ route('plan.index') }}">
                  <span class="nav-link-icon d-md-none d-lg-inline-block">
                      @include('icons.hanger-icon')
                  </span>
                        <span class="nav-link-title">
                    Planos
                  </span>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a
                        class="nav-link dropdown-toggle"
                        href="#navbar-help"
                        data-bs-toggle="dropdown"
                        data-bs-auto-close="false"
                        role="button"
                        aria-expanded="false">
                  <span class="nav-link-icon d-md-none d-lg-inline-block">
                      @include('icons.settings-icon')
                  </span>
                        <span class="nav-link-title">
                    Configurações
                  </span>
                    </a>
                    <div class="dropdown-menu">
                        <a
                            class="dropdown-item"
                            href="{{ route('clothin.index') }}"
                        >
                            - Roupas
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</aside>
