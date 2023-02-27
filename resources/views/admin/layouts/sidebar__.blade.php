<aside
    class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 sidebar"
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="/dashboard">
            <img src="/img/logo-ct-dark.png" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold">E Mart</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" href="/dashboard">
                    <span data-feather="monitor" class="align-text-bottom me-2 me-2"></span> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('banner') ? 'active' : '' }} {{ Request::is('banner/create') ? 'active' : '' }}"
                    href="#" data-toggle="collapse">
                    <i data-feather="flag" class="align-text-bottom me-2"></i> Banner Management
                </a>
                <ul class="submenu collapse">
                    <li>
                        <a class="nav-link {{ Request::is('banner') ? 'active' : '' }}"
                            href="{{ route('banner.index') }}">
                            All Banners
                        </a>
                    </li>
                    <li>
                        <a class="nav-link {{ Request::is('banner/create') ? 'active' : '' }}"
                            href="{{ route('banner.create') }}">
                            Add Banners
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('category') ? 'active' : '' }}" href="#">
                    <i data-feather="hash" class="align-text-bottom me-2"></i> Category Management
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('product') ? 'active' : '' }}" href="#">
                    <span data-feather="gift" class="align-text-bottom me-2"></span> Product Management
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('carts') ? 'active' : '' }}" href="#">
                    <span data-feather="shopping-cart" class="align-text-bottom me-2"></span> Carts Management
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('order') ? 'active' : '' }}" href="#">
                    <span data-feather="package" class="align-text-bottom me-2"></span> Order Management
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('post-category') ? 'active' : '' }}" href="#">
                    <span data-feather="hash" class="align-text-bottom me-2"></span> Post Category
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('post-tag') ? 'active' : '' }}" href="#">
                    <span data-feather="tag" class="align-text-bottom me-2"></span> Post Tag
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('post') ? 'active' : '' }}" href="#">
                    <span data-feather="book" class="align-text-bottom me-2"></span> Post Management
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('review-management') ? 'active' : '' }}" href="#">
                    <span data-feather="edit-2" class="align-text-bottom me-2"></span> Review Management
                </a>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('setting') ? 'active' : '' }}" href="#">
                    <span data-feather="settings" class="align-text-bottom me-2"></span> Setting
                </a>
            </li>
        </ul>
    </div>
</aside>
