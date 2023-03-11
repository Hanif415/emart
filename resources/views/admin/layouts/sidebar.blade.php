<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
    <div class="position-sticky pt-3">
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
                    Banner
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('category') ? 'active' : '' }}" aria-current="page"
                    href="{{ route('category.index') }}">
                    <i class="bi bi-tags"></i>
                    Category
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('product') ? 'active' : '' }}" aria-current="page"
                    href="{{ route('product.index') }}">
                    <i class="bi bi-briefcase"></i>
                    Product
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('brand') ? 'active' : '' }}" aria-current="page"
                    href="{{ route('brand.index') }}">
                    <i class="bi bi-handbag"></i>
                    Brand
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
                    Order
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('post') ? 'active' : '' }}" aria-current="page" href="/dashboard">
                    <i class="bi bi-journal"></i>
                    Post
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('post-category') ? 'active' : '' }}" aria-current="page"
                    href="/dashboard">
                    <i class="bi bi-bookmark"></i>
                    Post Category
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('tag') ? 'active' : '' }}" aria-current="page" href="/dashboard">
                    <i class="bi bi-tag-fill"></i>
                    Post Tag
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('review') ? 'active' : '' }}" aria-current="page" href="/dashboard">
                    <i class="bi bi-pen"></i>
                    Review
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('setting') ? 'active' : '' }}" aria-current="page" href="/dashboard">
                    <i class="bi bi-gear"></i>
                    Setting
                </a>
            </li>
        </ul>
    </div>
</nav>
