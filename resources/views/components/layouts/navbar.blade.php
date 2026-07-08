<header class="navbar">

    <div class="navbar-left">

        <button class="menu-toggle" id="menuToggle">
            ☰
        </button>

        <h1>
            @yield('title', 'Sistema')
        </h1>

    </div>

    <div class="navbar-actions">

        <a href="{{ auth()->user()->role === 'admin'
    ? route('admin.profile.index')
    : route('client.profile.index') }}" class="navbar-user">

            <img src="{{ auth()->user()->avatar
    ? asset('storage/' . auth()->user()->avatar)
    : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) }}" alt="{{ auth()->user()->name }}"
                class="navbar-avatar">

            <span>
                {{ auth()->user()->name }}
            </span>

        </a>

        <button class="theme-toggle" id="themeToggle">
            🌙
        </button>

        <button type="button" class="btn btn-danger" id="logoutButton">
            Sair
        </button>

    </div>

</header>

<div class="modal-overlay" id="logoutModal">

    <div class="modal">

        <h3>
            Confirmar saída
        </h3>

        <p>
            Tem certeza que deseja sair do sistema?
        </p>

        <div class="modal-actions">

            <button type="button" class="btn btn-secondary" id="cancelLogout">
                Cancelar
            </button>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="btn btn-danger">
                    Sair
                </button>

            </form>

        </div>

    </div>

</div>
