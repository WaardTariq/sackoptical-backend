<aside class="sidebar">
    <div class="sidebar-logo">
        <h3>SACKS OPTICAL</h3>
        <p>Admin Panel</p>
    </div>

    <div class="sidebar-menu">
        <div class="menu-section-title">Main</div>
        <div class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <a href="{{ route('admin.dashboard') }}">
                <i class="fa-solid fa-chart-line"></i> Dashboard
            </a>
        </div>

        <div class="menu-section-title">Catalog</div>
        <div class="menu-item {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
            <a href="{{ route('admin.categories.index') }}">
                <i class="fa-solid fa-layer-group"></i> Categories
            </a>
        </div>
        <div class="menu-item {{ request()->routeIs('admin.sub-categories.*') ? 'active' : '' }}">
            <a href="{{ route('admin.sub-categories.index') }}">
                <i class="fa-solid fa-folder-tree"></i> Sub Categories
            </a>
        </div>
        <div class="menu-item {{ request()->routeIs('admin.attributes.*') ? 'active' : '' }}">
            <a href="{{ route('admin.attributes.index') }}">
                <i class="fa-solid fa-list-ul"></i> Attributes
            </a>
        </div>
        <div class="menu-item {{ request()->routeIs('admin.brands.*') ? 'active' : '' }}">
            <a href="{{ route('admin.brands.index') }}">
                <i class="fa-solid fa-copyright"></i> Brands
            </a>
        </div>
        <div class="menu-item {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
            <a href="{{ route('admin.products.index') }}">
                <i class="fa-solid fa-glasses"></i> Products
            </a>
        </div>

        <div class="menu-section-title">Optical</div>
        <div class="menu-item {{ request()->routeIs('admin.lens-types.*') ? 'active' : '' }}">
            <a href="{{ route('admin.lens-types.index') }}">
                <i class="fa-solid fa-eye"></i> Lens Types
            </a>
        </div>
        <div class="menu-item {{ request()->routeIs('admin.lens-coatings.*') ? 'active' : '' }}">
            <a href="{{ route('admin.lens-coatings.index') }}">
                <i class="fa-solid fa-spray-can"></i> Lens Coatings
            </a>
        </div>

        <div class="menu-section-title">Sales</div>
        <div class="menu-item {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
            <a href="{{ route('admin.orders.index') }}">
                <i class="fa-solid fa-cart-shopping"></i> Orders
            </a>
        </div>
        <div class="menu-item {{ request()->routeIs('admin.transactions.*') ? 'active' : '' }}">
            <a href="{{ route('admin.transactions.index') }}">
                <i class="fa-solid fa-file-invoice-dollar"></i> Transactions
            </a>
        </div>
        <div class="menu-item {{ request()->routeIs('admin.coupons.*') ? 'active' : '' }}">
            <a href="{{ route('admin.coupons.index') }}">
                <i class="fa-solid fa-ticket"></i> Coupons
            </a>
        </div>

        <div class="menu-section-title">Content</div>
        <div class="menu-item {{ request()->routeIs('admin.sliders.*') ? 'active' : '' }}">
            <a href="{{ route('admin.sliders.index') }}">
                <i class="fa-solid fa-images"></i> Sliders
            </a>
        </div>
        <div class="menu-item {{ request()->routeIs('admin.pages.*') ? 'active' : '' }}">
            <a href="{{ route('admin.pages.index') }}">
                <i class="fa-solid fa-file-lines"></i> Pages
            </a>
        </div>

        <div class="menu-section-title">Support</div>
        <div class="menu-item {{ request()->routeIs('admin.chats.*') ? 'active' : '' }}">
            <a href="{{ route('admin.chats.index') }}">
                <i class="fa-solid fa-comments"></i> Live Chats
            </a>
        </div>
        <div class="menu-item {{ request()->routeIs('admin.reviews.*') ? 'active' : '' }}">
            <a href="{{ route('admin.reviews.index') }}">
                <i class="fa-solid fa-star"></i> Reviews
            </a>
        </div>
        <div class="menu-item {{ request()->routeIs('admin.support-messages.*') ? 'active' : '' }}">
            <a href="{{ route('admin.support-messages.index') }}">
                <i class="fa-solid fa-envelope-open-text"></i> Support Messages
            </a>
        </div>

        <div class="menu-section-title">System</div>
        <div class="menu-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
            <a href="{{ route('admin.users.index') }}">
                <i class="fa-solid fa-users"></i> Customers
            </a>
        </div>
        <div class="menu-item {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
            <a href="{{ route('admin.settings.index') }}">
                <i class="fa-solid fa-gear"></i> Settings
            </a>
        </div>

        <form action="{{ route('admin.logout') }}" method="POST" class="mt-4 px-3">
            @csrf
            <button class="btn btn-light w-100 btn-sm">
                <i class="fa-solid fa-right-from-bracket me-2"></i> Logout
            </button>
        </form>
    </div>
</aside>