@inject('menuTreeService', 'App\Services\Config\MenuTreeService')
@inject('cMenuRoles', 'App\Models\Config\CMenuRole')

@php
    $menus = $menuTreeService->getTree(true); // return seperti JSON kamu

    $my_menu = $cMenuRoles
        ->where('active', 1)
        ->where('code_role', Auth::user()->code_role)
        ->pluck('menu_id')
        ->toArray();
@endphp

<nav class="navbar navbar-light navbar-glass navbar-top navbar-expand-lg">
    <button class="btn navbar-toggler-humburger-icon navbar-toggler me-1 me-sm-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarStandard" aria-controls="navbarStandard" aria-expanded="false" aria-label="Toggle Navigation"><span class="navbar-toggle-icon"><span class="toggle-line"></span></span></button>
    <a class="navbar-brand me-1 me-sm-3" href="{{url('/dashboard')}}">
      <div class="d-flex align-items-center">
        <!-- <img class="me-2" src="{{url('aps')}}/image/logo-asinusa.png" alt="" height="45" /> -->
        <img class="me-2" src="{{url('falcon')}}/assets/img/icons/spot-illustrations/falcon.png" alt="" height="45" />
      </div>
    </a>
    <div class="collapse navbar-collapse scrollbar" id="navbarStandard">
      <ul class="navbar-nav" data-top-nav-dropdowns="data-top-nav-dropdowns">

        @foreach ($menus as $menu)
            @include('admin.layouts.menu-tree', [
                'menu' => $menu,
                'my_menu' => $my_menu
            ])
        @endforeach

        
      </ul>
    </div>
    <ul class="navbar-nav navbar-nav-icons ms-auto flex-row align-items-center">
      <li class="nav-item">
        <div class="theme-control-toggle fa-icon-wait px-2">
          <input class="form-check-input ms-0 theme-control-toggle-input" id="themeControlToggle" type="checkbox" data-theme-control="theme" value="dark" />
          <label class="mb-0 theme-control-toggle-label theme-control-toggle-light" for="themeControlToggle" data-bs-toggle="tooltip" data-bs-placement="left" title="Switch to light theme"><span class="fas fa-sun fs-0"></span></label>
          <label class="mb-0 theme-control-toggle-label theme-control-toggle-dark" for="themeControlToggle" data-bs-toggle="tooltip" data-bs-placement="left" title="Switch to dark theme"><span class="fas fa-moon fs-0"></span></label>
        </div>
      </li>
        <!-- @if (auth()->user()->code_role === config('asinusa.code_su'))
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="config_4">Config</a>
            <div class="dropdown-menu dropdown-caret dropdown-menu-card border-0 mt-0" aria-labelledby="config_4">
                <div class="bg-white dark__bg-1000 rounded-3 py-2">
                    <a class="dropdown-item link-600 fw-medium" href="{{route('c.app')}}">App</a>
                    <a class="dropdown-item link-600 fw-medium" href="{{route('c.menu')}}">Menu</a>
                    <a class="dropdown-item link-600 fw-medium" href="{{route('c.menu_role')}}">Menu Role</a>
                    <a class="dropdown-item link-600 fw-medium" href="{{route('c.user_role')}}">User Role</a>
                    <a class="dropdown-item link-600 fw-medium" href="{{route('c.user')}}">Users</a>
                </div>
            </div>
        </li>
        @endif -->
      <li class="nav-item dropdown">
        <a class="nav-link pe-0 ps-2" id="config_4" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <div class="avatar avatar-xl">
            <img class="rounded-circle" src="{{url('falcon')}}/assets/img/team/1-thumb.png" alt="" />
          </div>
        </a>
        <div class="dropdown-menu dropdown-caret dropdown-caret dropdown-menu-end py-0" aria-labelledby="config_4">
          <div class="bg-white dark__bg-1000 rounded-2 py-2">
            <a class="dropdown-item fw-bold text-warning" href="{{route('profile')}}/"><span class="fas fa-crown me-1"></span><span>My Profile</span></a>
            @can('super')
            <div class="dropdown-divider"></div>
            <p class="dropdown-item text-700 mb-0 fw-bold"><span class="text-muted me-1"></span>Config</p>
            <a class="dropdown-item link-600 fw-medium py-0" href="{{route('c.app')}}"><span class="text-muted me-1">├─ </span>App</a>
            <a class="dropdown-item link-600 fw-medium py-0" href="{{route('c.menu')}}"><span class="text-muted me-1">├─ </span>Menu</a>
            <a class="dropdown-item link-600 fw-medium py-0" href="{{route('c.menu_role')}}"><span class="text-muted me-1">├─ </span>Menu Role</a>
            <a class="dropdown-item link-600 fw-medium py-0" href="{{route('c.user_role')}}"><span class="text-muted me-1">├─ </span>User Role</a>
            <a class="dropdown-item link-600 fw-medium py-0" href="{{route('c.user')}}"><span class="text-muted me-1">└─ </span>Users</a>

            <div class="dropdown-divider"></div>
            <a class="dropdown-item link-600 fw-medium py-0" href="{{route('admin.terminal')}}">Terminal</a>


            @endcan
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{url('logout')}}">Logout</a>
          </div>
        </div>
      </li>
    </ul>
</nav>
