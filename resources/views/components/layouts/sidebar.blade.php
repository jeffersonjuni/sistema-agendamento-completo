<aside class="sidebar" id="sidebar">

    <div class="sidebar-logo">

        <i data-lucide="calendar-days" class="sidebar-logo-icon"></i>

        <h2 class="sidebar-logo-text">
            AgendaPro
        </h2>

    </div>

    <nav class="sidebar-nav">

        <ul>

            <li>

                <a href="{{ auth()->user()->role === 'admin'
    ? route('admin.dashboard')
    : route('client.dashboard') }}"
                    class="{{ request()->routeIs('admin.dashboard', 'client.dashboard') ? 'active' : '' }}"
                    data-tooltip="Dashboard">

                    <i data-lucide="layout-dashboard" class="sidebar-icon"></i>

                    <span>
                        Dashboard
                    </span>

                </a>

            </li>

            <li>

                <a href="{{ auth()->user()->role === 'admin'
    ? route('admin.profile.index')
    : route('client.profile.index') }}"
                    class="{{ request()->routeIs('admin.profile.*', 'client.profile.*') ? 'active' : '' }}"
                    data-tooltip="Meu Perfil">

                    <i data-lucide="user-circle" class="sidebar-icon"></i>

                    <span>
                        Meu Perfil
                    </span>

                </a>

            </li>

        </ul>

    </nav>

</aside>
