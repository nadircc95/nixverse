@inject('Menus', 'App\Models\Config\CMenu')
@inject('cMenuRoles', 'App\Models\Config\CMenuRole')

@php
    $menus = $Menus->whereNull('parent')->where('active', '1')->with(['childs'])->orderBy('index')->get();
    $menu_roles = $cMenuRoles->select(['menu_id'])->where('active', '1')->where('code_role', Auth::user()->code_role)->get();

    // dd($menu_roles);
    $my_menu = Array();
    foreach ($menu_roles as $key => $value) {
      array_push($my_menu, "$value->menu_id");
    }

    // dd($my_menu);

@endphp

<nav class="navbar navbar-light navbar-glass navbar-top navbar-expand-lg">
    <button class="btn navbar-toggler-humburger-icon navbar-toggler me-1 me-sm-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarStandard" aria-controls="navbarStandard" aria-expanded="false" aria-label="Toggle Navigation"><span class="navbar-toggle-icon"><span class="toggle-line"></span></span></button>
    <a class="navbar-brand me-1 me-sm-3" href="{{url('/dashboard')}}">
      <div class="d-flex align-items-center"><img class="me-2" src="{{url('aps')}}/image/logo-asinusa.png" alt="" height="45" />
      </div>
    </a>
    <div class="collapse navbar-collapse scrollbar" id="navbarStandard">
      <ul class="navbar-nav" data-top-nav-dropdowns="data-top-nav-dropdowns">

        @php
            $chhilds = false;
            $shhows = false;
        @endphp
        @foreach ($menus as $parent)
            @if ($parent->url === '#' && count($parent->childs) > 0)
                @foreach ($parent->childs as $childs)
                @if ($childs->url === '#' && count($childs->childs2) > 0)
                    @php
                    $chhilds = true;
                    @endphp
                @endif
                @endforeach

                @php
                    $id_ref = "$parent->name"."_"."$parent->id";
                    $id_ref = strtolower($id_ref);
                    $id_ref = preg_replace('/\s+/', '_', $id_ref);
                @endphp

                @if ($chhilds === false)
                @foreach ($parent->childs as $childs)
                    @if (count($childs->childs2) == 0)
                    @if (in_array("$childs->id", $my_menu) )
                    @php
                        $shhows = true;
                    @endphp
                    @endif
                    @endif
                @endforeach

                @if ($shhows)
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="{{url($parent->url)}}" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="{{$id_ref}}">{{$parent->name}}</a>
                    <div class="dropdown-menu dropdown-caret dropdown-menu-card border-0 mt-0" aria-labelledby="{{$id_ref}}">
                    <div class="bg-white dark__bg-1000 rounded-3 py-2">
                        @foreach ($parent->childs as $childs)
                        @if (count($childs->childs2) == 0)
                            @if (in_array("$childs->id", $my_menu) )
                            <a class="dropdown-item link-600 fw-medium" href="{{url($childs->url)}}">{{$childs->name}}</a>
                            @endif
                        @endif
                        @endforeach
                    </div>
                    </div>
                </li>
                @endif
                @else

                @foreach ($parent->childs as $childs)
                @if ($childs->url === '#' && count($childs->childs2) > 0)
                        @if (in_array("$childs->id", $my_menu))
                        @foreach ($childs->childs2 as $childs2)
                            @if (in_array("$childs2->id", $my_menu) )
                            @php
                                $shhows = true;
                            @endphp
                            @endif
                        @endforeach
                        @endif
                @else
                    @if (in_array("$childs->id", $my_menu) )
                    @php
                        $shhows = true;
                    @endphp
                    @endif
                @endif
                @endforeach

                @if ($shhows)
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="{{url($parent->url)}}" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="{{$id_ref}}">{{$parent->name}}</a>
                <div class="dropdown-menu dropdown-caret dropdown-menu-card border-0 mt-0" aria-labelledby="apps">
                    <div class="card navbar-card-app shadow-none dark__bg-1000">
                    <div class="card-body scrollbar max-h-dropdown">
                        <img class="img-dropdown" src="{{url('falcon')}}/assets/img/icons/spot-illustrations/authentication-corner.png" width="130" alt="" />
                        <div class="row">
                        @foreach ($parent->childs as $childs)
                            @if ($childs->url === '#' && count($childs->childs2) > 0)
                            <div class="col-6 col-md-5">
                                <div class="nav flex-column">
                                @if (in_array("$childs->id", $my_menu))
                                <p class="nav-link text-500 mb-0 fw-bold" data-id="{{$childs->id}}">{{$childs->name}}</p>
                                    @foreach ($childs->childs2 as $childs2)
                                    @if (in_array("$childs2->id", $my_menu) )
                                        <a class="nav-link py-1 link-600 fw-medium ms-2" data-id="{{$childs2->id}}" data-parent="{{$childs2->parent}}" href="{{url($childs2->url)}}">{{$childs2->name}}</a>
                                    @endif
                                    @endforeach
                                @endif
                                </div>
                            </div>
                            @else
                            @if (in_array("$childs->id", $my_menu) )
                            <div class="col-6 col-md-5">
                                <div class="nav flex-column">
                                <a class="nav-link py-1 link-600 fw-medium text-700 fw-bold" data-id="{{$childs->id}}" data-parent="{{$childs->parent}}" href="{{url($childs->url)}}">{{$childs->name}}</a>
                                </div>
                            </div>
                            @endif
                            @endif
                        @endforeach
                        </div>
                    </div>
                    </div>
                </div>
                </li>
                @endif

                @endif
            @else
                <a class="nav-link" href="{{url($parent->url)}}" role="button">{{$parent->name}}</a>

            @endif

          @php
            $chhilds = false;
            $shhows = false;
          @endphp
        @endforeach

        @if (auth()->user()->code_role === config('asinusa.code_su'))
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
        @endif
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
      <li class="nav-item dropdown"><a class="nav-link pe-0 ps-2" id="navbarDropdownUser" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <div class="avatar avatar-xl">
            <img class="rounded-circle" src="{{url('falcon')}}/assets/img/team/3-thumb.png" alt="" />

          </div>
        </a>
        <div class="dropdown-menu dropdown-caret dropdown-caret dropdown-menu-end py-0" aria-labelledby="navbarDropdownUser">
          <div class="bg-white dark__bg-1000 rounded-2 py-2">
            <a class="dropdown-item fw-bold text-warning" href="{{route('profile')}}/"><span class="fas fa-crown me-1"></span><span>My Profile</span></a>

            {{-- <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{route('welcome')}}">Asinusa</a> --}}
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{url('logout')}}">Logout</a>
          </div>
        </div>
      </li>
    </ul>
</nav>
