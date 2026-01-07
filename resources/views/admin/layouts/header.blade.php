<header class="admin-header">
    <div class="header-left">
        <h4>{{ ucfirst(request()->segment(2) ?? 'Dashboard') }}</h4>
        <p>{{ now()->format('l, F j, Y') }}</p>
    </div>

    <div class="header-right">
        <div class="header-search">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" placeholder="Search orders, products...">
        </div>

        <div class="header-icon">
            <i class="fa-regular fa-bell"></i>
            <span class="badge">3</span>
        </div>

        <div class="header-icon position-relative">
            <a href="{{ route('admin.support-messages.index') }}" class="text-dark">
                <i class="fa-regular fa-envelope"></i>
                <span
                    class="badge position-absolute top-0 start-100 translate-middle bg-danger rounded-pill support-unread-badge"
                    style="display: none; font-size: 0.6rem;">0</span>
            </a>
        </div>

        <div class="user-profile dropdown">
            <div class="user-avatar dropdown-toggle" data-bs-toggle="dropdown" style="cursor: pointer;">
                {{ substr(Auth::guard('admin')->user()->name ?? 'A', 0, 1) }}{{ substr(explode(' ', Auth::guard('admin')->user()->name ?? 'D')[1] ?? '', 0, 1) }}
            </div>
            <div class="user-info dropdown-toggle" data-bs-toggle="dropdown" style="cursor: pointer;">
                <h6>{{ Auth::guard('admin')->user()->name ?? 'Admin' }}</h6>
                <p>{{ ucfirst(Auth::guard('admin')->user()->role ?? 'Admin') }}</p>
            </div>
            <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2">
                <li><a class="dropdown-item py-2" href="{{ route('admin.settings.index') }}"><i
                            class="fa-solid fa-gear me-2 text-muted"></i> Settings</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li>
                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item py-2"><i
                                class="fa-solid fa-right-from-bracket me-2 text-muted"></i> Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</header>