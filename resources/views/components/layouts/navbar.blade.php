<header class="navbar">

    <div class="navbar-left">

        <button class="menu-toggle" id="menuToggle">
            ☰
        </button>

        <h1>
            Dashboard
        </h1>

    </div>

    <div class="navbar-actions">

        <div class="navbar-user">

            <span>
                {{ auth()->user()->name }}
            </span>

        </div>

        <button class="theme-toggle" id="themeToggle">
            🌙
        </button>

        <form method="POST" action="{{ route('logout') }}">

            @csrf

            <button type="button" class="btn btn-danger" id="logoutButton">
                Sair
            </button>
        </form>

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
