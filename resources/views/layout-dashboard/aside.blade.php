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
                  <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/lifebuoy -->
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
                        stroke-linejoin="round"><path
                            stroke="none"
                            d="M0 0h24v24H0z"
                            fill="none"/><path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"/><path d="M15 15l3.35 3.35"/><path d="M9 15l-3.35 3.35"/><path d="M5.65 5.65l3.35 3.35"/><path d="M18.35 5.65l-3.35 3.35"/></svg>
                  </span>
                        <span class="nav-link-title">
                    Help
                  </span>
                    </a>
                    <div class="dropdown-menu">
                        <a
                            class="dropdown-item"
                            href="https://tabler.io/docs"
                            target="_blank"
                            rel="noopener">
                            Documentation
                        </a>
                        <a
                            class="dropdown-item"
                            href="./changelog.html">
                            Changelog
                        </a>
                        <a
                            class="dropdown-item"
                            href="https://github.com/tabler/tabler"
                            target="_blank"
                            rel="noopener">
                            Source code
                        </a>
                        <a
                            class="dropdown-item text-pink"
                            href="https://github.com/sponsors/codecalm"
                            target="_blank"
                            rel="noopener">
                            <!-- Download SVG icon from http://tabler-icons.io/i/heart -->
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="icon icon-inline me-1"
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
                                <path d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572"/>
                            </svg>
                            Sponsor project!
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</aside>
