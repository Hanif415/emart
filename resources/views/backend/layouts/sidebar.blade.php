<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" aria-current="page" href="/dashboard">
                <span data-feather="home" class="align-text-bottom"></span>
                Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('banner') ? 'active' : '' }}"  data-toggle="collapse" aria-current="page" href="#">
                    <span data-feather="flag" class="align-text-bottom"></span>
                    Banner Management
                </a>
                <ul class="submenu collapse">
                    <li>
                        <a class="nav-link {{ Request::is('banner') ? 'active' : '' }}" href="{{ route('banner.index') }}">
                            All Banners
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{ route('banner.create') }}">
                            Add Banners
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('category') ? 'active' : '' }}" aria-current="page" href="/dashboard">
                <span data-feather="hash" class="align-text-bottom"></span>
                Category Management
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('product') ? 'active' : '' }}" aria-current="page" href="/dashboard">
                <span data-feather="gift" class="align-text-bottom"></span>
                Product Management
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('carts') ? 'active' : '' }}" aria-current="page" href="/dashboard">
                <span data-feather="shopping-cart" class="align-text-bottom"></span>
                Carts Management
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('order') ? 'active' : '' }}" aria-current="page" href="/dashboard">
                <span data-feather="package" class="align-text-bottom"></span>
                Order Management
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('category') ? 'active' : '' }}" aria-current="page" href="/dashboard">
                <span data-feather="hash" class="align-text-bottom"></span>
                Post Category
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('tag') ? 'active' : '' }}" aria-current="page" href="/dashboard">
                <span data-feather="tag" class="align-text-bottom"></span>
                Post Tag
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('post') ? 'active' : '' }}" aria-current="page" href="/dashboard">
                <span data-feather="book" class="align-text-bottom"></span>
                Post Management
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('review') ? 'active' : '' }}" aria-current="page" href="/dashboard">
                <span data-feather="edit-2" class="align-text-bottom"></span>
                Review Management
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('setting') ? 'active' : '' }}" aria-current="page" href="/dashboard">
                <span data-feather="settings" class="align-text-bottom"></span>
                Setting
                </a>
            </li>
        </ul>
    </div>
</nav>