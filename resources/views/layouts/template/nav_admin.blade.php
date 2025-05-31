<!--begin::Sidebar-->
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
        <!--begin::Brand Link-->
        <a href="{{ route('dashboard') }}" class="brand-link">
            <img src="{{ asset('dist/assets/img/tienda_sin_letras.png') }}" alt="Tienda Logo"
                class="brand-image opacity-75 shadow" />
            <span class="brand-text fw-light">JEMP</span>
        </a>
        <!--end::Brand Link-->
    </div>
    <!--end::Sidebar Brand-->
    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                {{-- Dashboard --}}
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}"
                        class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-speedometer"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                {{-- Tienda (categorías + productos) --}}
                <li
                    class="nav-item has-treeview {{ request()->routeIs('categories.*') || request()->routeIs('products.*') ? 'menu-open' : '' }}">
                    <a href="#"
                        class="nav-link {{ request()->routeIs('categories.*') || request()->routeIs('products.*') ? 'active' : '' }}">
                        <i class="nav-icon fa-solid fa-box-archive"></i>
                        <p>
                            Tienda
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('categories.index') }}"
                                class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Categorías</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('products.index') }}"
                                class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Productos</p>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- Proveedores --}}
                <li class="nav-item">
                    <a href="{{ route('providers.index') }}"
                        class="nav-link {{ request()->routeIs('providers.*') ? 'active' : '' }}">
                        <i class="nav-icon fa-solid fa-users"></i>
                        <p>Proveedores</p>
                    </a>
                </li>

                {{-- Clientes --}}
                <li class="nav-item">
                    <a href="{{ route('clients.index') }}"
                        class="nav-link {{ request()->routeIs('clients.*') ? 'active' : '' }}">
                        <i class="nav-icon fa-solid fa-user"></i>
                        <p>Clientes</p>
                    </a>
                </li>

                {{-- Compras --}}
                <li class="nav-item">
                    <a href="{{ route('purchases.index') }}"
                        class="nav-link {{ request()->routeIs('purchases.*') ? 'active' : '' }}">
                        <i class="nav-icon fa-solid fa-cart-shopping"></i>
                        <p>Compras</p>
                    </a>
                </li>

                {{-- Ventas --}}
                <li class="nav-item">
                    <a href="{{ route('sales.index') }}"
                        class="nav-link {{ request()->routeIs('sales.*') ? 'active' : '' }}">
                        <i class="nav-icon fa-solid fa-dollar-sign"></i>
                        <p>Ventas</p>
                    </a>
                </li>
            </ul>
            <!--end::Sidebar Menu-->
        </nav>
    </div>
    <!--end::Sidebar Wrapper-->
</aside>
<!--end::Sidebar-->
