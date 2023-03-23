<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
    <div class="position-sticky pt-3 text-sm">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" aria-current="page" href="/dashboard">
                    <i class="bi bi-grid"></i>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('banner') ? 'active' : '' }}" aria-current="page"
                    href="{{ route('banner.index') }}">
                    <i class="bi bi-image"></i>
                    Banners
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('category') ? 'active' : '' }}" aria-current="page"
                    href="{{ route('category.index') }}">
                    <i class="bi bi-tags"></i>
                    Categories
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('product') ? 'active' : '' }}" aria-current="page"
                    href="{{ route('product.index') }}">
                    <i class="bi bi-briefcase"></i>
                    Products
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('brand') ? 'active' : '' }}" aria-current="page"
                    href="{{ route('brand.index') }}">
                    <i class="bi bi-handbag"></i>
                    Brands
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('carts') ? 'active' : '' }}" aria-current="page" href="/dashboard">
                    <i class="bi bi-cart"></i>
                    Carts
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('order') ? 'active' : '' }}" aria-current="page" href="/dashboard">
                    <i class="bi bi-truck"></i>
                    Orders
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('post') ? 'active' : '' }}" aria-current="page" href="/dashboard">
                    <i class="bi bi-journal"></i>
                    Posts
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('post-category') ? 'active' : '' }}" aria-current="page"
                    href="/dashboard">
                    <i class="bi bi-bookmark"></i>
                    Post Categories
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('tag') ? 'active' : '' }}" aria-current="page" href="/dashboard">
                    <i class="bi bi-tag-fill"></i>
                    Post Tags
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('review') ? 'active' : '' }}" aria-current="page" href="/dashboard">
                    <i class="bi bi-pen"></i>
                    Reviews
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('setting') ? 'active' : '' }}" aria-current="page" href="/dashboard">
                    <i class="bi bi-check-circle"></i>
                    Coupons
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('user') ? 'active' : '' }}" aria-current="page"
                    href="{{ route('user.index') }}">
                    <i class="bi bi-person"></i>
                    Users
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('setting') ? 'active' : '' }}" aria-current="page" href="/dashboard">
                    <i class="bi bi-chat-left-text"></i>
                    Comments
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('setting') ? 'active' : '' }}" aria-current="page" href="/dashboard">
                    <i class="bi bi-gear"></i>
                    Settings
                </a>
            </li>
        </ul>
    </div>
</nav>
