<aside class="navbar navbar-vertical navbar-expand-lg" data-bs-theme="dark">
    <div class="container-fluid">
        <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu"
            aria-controls="sidebar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="navbar-brand">
            <a href="{{ route('admin.dashboard') }}">
                <img src="{{ asset($logo) }}" width="110" height="32" alt="Logo site" class="navbar-brand-image">
            </a>
        </h1>
        <div class="navbar-nav flex-row d-lg-none">
            @include('admin.layouts.partials.account')
        </div>
        <div class="navbar-collapse collapse" id="sidebar-menu" style="">
            <ul class="navbar-nav pt-lg-3">
                @foreach ($menu as $item)
                    @if(
                        auth('admin')->user()->checkEmptyRouteNameAccessOrSuperAdmin($item['route_name'], false, false)
                        || auth('admin')->user()->checkRouteNamesAccess(array_column($item['sub'] ?? [], 'route_name'))
                    )
                        <li @class(['nav-item', 'dropdown' => count($item['sub']) > 0])>
                            <a @class([
                                'nav-link', 'dropdown-toggle' => count($item['sub']) > 0
                            ])
                                href="{{ $routeName($item['route_name'], $item['param'] ?? []) }}" 
                                @if(count($item['sub'])) 
                                    data-bs-toggle="dropdown"
                                    data-bs-auto-close="false" 
                                    role="button" 
                                    aria-expanded="false"
                                @endif
                            >
                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                    {!! __($item['icon']) !!}
                                </span>
                                <span class="nav-link-title">@lang($item['title'])</span>
                            </a>
                            @if (count($item['sub']))
                                <div class="dropdown-menu">
                                    <div class="dropdown-menu-columns">
                                        <div class="dropdown-menu-column">
                                            @foreach ($item['sub'] as $item)
                                                @adminaccessroutename($item['route_name'])
                                                    <a class="dropdown-item" href="{{ $routeName($item['route_name'], $item['param'] ?? []) }}">
                                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                                            {!! __($item['icon']) !!}
                                                        </span>
                                                        <span class="nav-link-title">@lang($item['title'])</span>
                                                    </a>
                                                @endadminaccessroutename
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>
</aside>

