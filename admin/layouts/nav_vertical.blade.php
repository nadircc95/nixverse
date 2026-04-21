@inject('Menus', 'App\Models\Admin\Menu')
@inject('UserRoles', 'App\Models\Admin\UserRole')

@php
    $menus = $Menus->whereNull('parent')->where('active', '1')->with(['childs'])->orderBy('zindex')->get();
    $user_roles = $UserRoles->select(['menu_id'])->where('active', '1')->where('role_code', Auth::user()->role_code)->get();

    $my_menu = Array();
    foreach ($user_roles as $key => $value) {
      array_push($my_menu, "$value->menu_id");
    }
@endphp

<nav class="navbar navbar-light navbar-vertical navbar-expand-xl">
    <script>
      var navbarStyle = localStorage.getItem("navbarStyle");
      if (navbarStyle && navbarStyle !== 'transparent') {
        document.querySelector('.navbar-vertical').classList.add(`navbar-${navbarStyle}`);
      }
    </script>
    <div class="d-flex align-items-center">
      <div class="toggle-icon-wrapper">

        <button class="btn navbar-toggler-humburger-icon navbar-vertical-toggle" data-bs-toggle="tooltip" data-bs-placement="left" title="Toggle Navigation"><span class="navbar-toggle-icon"><span class="toggle-line"></span></span></button>

      </div><a class="navbar-brand" href="{{url('')}}">
        <div class="d-flex align-items-center py-3"><img class="me-2" src="{{url('falcon')}}/assets/img/eii.png" alt="" height="45" />
        </div>
      </a>
    </div>
    <div class="collapse navbar-collapse" id="navbarVerticalCollapse">
      <div class="navbar-vertical-content scrollbar">
        <ul class="navbar-nav flex-column mb-3" id="navbarVerticalNav">

          <li class="nav-item">
            <!-- label-->
            <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
              <div class="col-auto navbar-vertical-label">Menu
              </div>
              <div class="col ps-0">
                <hr class="mb-0 navbar-vertical-divider" />
              </div>
            </div>
            <!-- parent pages--><a class="nav-link" href="{{url('starter')}}" role="button">
              <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-flag"></span></span><span class="nav-link-text ps-1">Starter</span>
              </div>
            </a>
          </li>
          @foreach ($menus as $parent)
          <li class="nav-item">

            @if ($parent->url === '#' && count($parent->childs) > 0)

              @php
                  $id_ref = "$parent->name"."_"."$parent->id";
                  $id_ref = strtolower($id_ref);
                  $id_ref = preg_replace('/\s+/', '_', $id_ref);
              @endphp
              <a class="nav-link dropdown-indicator" href="#{{$id_ref}}" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="{{$id_ref}}">
                <div class="d-flex align-items-center">
                  <span class="nav-link-icon">
                    <span class="fas fa-flag"></span>
                  </span>
                  <span class="nav-link-text ps-1">{{$parent->name}}</span>
                </div>
              </a>
              <ul class="nav collapse" id="{{$id_ref}}">
                @foreach ($parent->childs as $childs)
                  @if ($childs->url === '#' && count($childs->childs2) > 0)
                  @php
                      $id_ref = "$childs->name"."_"."$childs->id";
                      $id_ref = strtolower($id_ref);
                      $id_ref = preg_replace('/\s+/', '_', $id_ref);
                  @endphp
                  <li class="nav-item">
                    <a class="nav-link dropdown-indicator" href="#{{$id_ref}}" data-bs-toggle="collapse" aria-expanded="true" aria-controls="{{$id_ref}}">
                    <div class="d-flex align-items-center"><span class="nav-link-text ps-1">{{$childs->name}}</span>
                    </div>
                    </a>
                    <ul class="nav collapse" id="{{$id_ref}}">
                      @foreach ($childs->childs2 as $childs2)
                        @if (in_array("$childs2->id", $my_menu))   

                        <li class="nav-item">
                          <a class="nav-link" href="{{url($childs2->url)}}">
                            <div class="d-flex align-items-center"><span class="nav-link-text ps-1">{{$childs2->name}}</span>
                            </div>
                          </a>
                          <!-- more inner pages-->
                        </li>
                        @endif
                      @endforeach
                    </ul>
                  </li>
                  @else
                    @if (in_array("$childs->id", $my_menu))   
                    <li class="nav-item">
                      <a class="nav-link" href="{{url($childs->url)}}">
                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">{{$childs->name}}</span>
                        </div>
                      </a>
                    </li>
                    @endif    
                  @endif    
                
                @endforeach
              </ul>
            @else

            @if (in_array("$parent->id", $my_menu))    
              @if ($parent->url === "#!")
              <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                <div class="col-auto navbar-vertical-label">{{$parent->name}}
                </div>
                <div class="col ps-0">
                  <hr class="mb-0 navbar-vertical-divider" />
                </div>
              </div>
              @else
              <a class="nav-link" href="{{url($parent->url)}}" role="button">
                <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-flag"></span></span><span class="nav-link-text ps-1">{{$parent->name}}</span>
                </div>
              </a>
              @endif
            @endif
            @endif
          </li>
          @endforeach
        </ul>
      </div>
    </div>
</nav>