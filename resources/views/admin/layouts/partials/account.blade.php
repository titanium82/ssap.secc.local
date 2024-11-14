<div class="nav-item dropdown">
    <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
        aria-label="Open user menu">
        <span class="avatar avatar-sm" style="background-image: url({{ auth('admin')->user()->avatar }})"></span>
        <div class="d-none d-xl-block ps-2">
            <div>{{ auth('admin')->user()->fullname }}</div>
            <div class="mt-1 small text-secondary">{{ auth('admin')->user()->getRoleNames() }}</div>
        </div>
    </a>
    <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
        <a href="{{ route('admin.profile.index') }}" class="dropdown-item">@lang('Profile')</a>
        <a href="{{ route('admin.password.change') }}" class="dropdown-item">@lang('Change Password')</a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalLogout">@lang('logout')</a>
    </div>
</div>