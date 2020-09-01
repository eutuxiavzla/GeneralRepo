<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.0.1">
    <title>@yield('title')</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style_cms.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/dist/css/bootstrap.min.css') }}">
    <!--datables CSS básico-->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/datatables/datatables.min.css') }}" />
    <!--datables estilo bootstrap 4 CSS-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('vendor/datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css') }}">
    <!--font awesome con CDN-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
        integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

    <!-- Axios -->
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <!-- Jquery -->
    <script src="{{ asset('vendor/jquery/dist/jquery.min.js') }}"></script>

</head>

<body>
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-auto col-sm-3 col-md-2 mr-0" href="{{ route('cms.home') }}">Dashboard</a>
        <ul class="navbar-nav px-3 col-auto">
            <li class="nav-item text-nowrap">
                <form action="{{route('login.logout')}}" method="POST" id="form_salir_sesion">
                    @csrf
                    <a class="nav-link" onclick="cerrarSesion()" href="#">Sign out</a>
                </form>
            </li>
        </ul>
    </nav>
    <div class="container-fluid">
        <div class="row">
            <!-- Navbar movil -->
            <nav class="navbar navbar-expand-lg navbar-light d-md-none mt-5 bg-light col-12">
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                  <li class="nav-item active">
                    <a class="nav-link" href="{{ route('cms.users') }}">
                        <span data-feather="file"></span>
                        Usuarios
                    </a>
                  </li>

                </ul>
              </div>
            </nav>
            <!-- Navbar Desktop -->
            <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        @if(auth()->user()->roles->title == 'administrador')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('cms.users') }}">
                                <span data-feather="file"></span>
                                Usuarios
                            </a>
                        </li>
                        @endif

                        @if(auth()->user()->roles->title == 'editor' || auth()->user()->roles->title == 'administrador')
                        <li class="nav-item items">
                          <a class="nav-link" href="#">
                            <span data-feather="file"></span>
                            Pagina web
                          </a>
                          <ul class="acordeon_container">
                            <li class="acordeon_item">
                              <a href="{{route('banners.home')}}" class="nav-link">Home</a>
                            </li>
                          </ul>
                        </li>
                        @endif
                    </ul>
                </div>
            </nav>
            <section class="col-md-10">
                <main role="main" class="main_cms pb-4">
                    @yield('content')
                </main>
            </section>
        </div>
    </div>

    <script src="{{ asset('vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script type="text/javascript">
        function cerrarSesion() {
            document.querySelector('#form_salir_sesion').submit();
        }
    </script>
    <!-- datatables JS -->
    <script src="{{ asset('vendor/datatables/datatables.min.js') }}"></script>
    <!-- para usar botones en datatables JS -->
    <script src="{{ asset('vendor/datatables/Buttons-1.5.6/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/JSZip-2.5.0/jszip.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/pdfmake-0.1.36/pdfmake.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/pdfmake-0.1.36/vfs_fonts.js') }}"></script>
    <script src="{{ asset('vendor/datatables/Buttons-1.5.6/js/buttons.html5.min.js') }}"></script>
</body>

</html>
