<!DOCTYPE html>
<html lang="en-US" dir="ltr">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} @yield('title')</title>
    @include('admin.layouts.script_top')
  </head>


  <body>

    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
      <div class="container" data-layout="container">
        <script>
          var isFluid = JSON.parse(localStorage.getItem('isFluid'));
          if (isFluid) {
            var container = document.querySelector('[data-layout]');
            container.classList.remove('container');
            container.classList.add('container-fluid');
          }else{
            var container = document.querySelector('[data-layout]');
            container.classList.remove('container');
            container.classList.add('container-fluid');
          }
        </script>
        {{-- @include('admin.layouts.nav_vertical') --}}
        <div class="content">
          {{-- @include('admin.layouts.nav_top') --}}
          @include('admin.layouts.nav_top_url')

          @yield('filter')

          <div class="row g-3" id="header_menu">
            <div class="col-lg-12">
                <div class="card mb-3">
                    <div class="card-header">
                        <div class="row flex-between-end">
                        <div class="col-auto align-self-center">
                            <h4 class="mb-0 title_ams" data-anchor="data-anchor"></h4>
                        </div>
                        
                        </div>
                    </div>
                </div>
            </div>
          </div>
          @yield('content')

          @include('admin.layouts.footer')
        </div>
        @yield('modal_form')
        @yield('modal_second')

      </div>
    </main>
    <!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->
    @include('admin.layouts.script_bottom')
  </body>

</html>
