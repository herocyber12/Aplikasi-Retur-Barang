<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @if (Session::has('kondisibaik'))
        <meta http-equiv="refresh" content="3;url={{ route('retur.getLaporan')}}">
    @endif
    <title>Sistem Retur Pembelian</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <style>
    .sidebar {
        height: 100hv;
        position: fixed;
        width: 250px;
        top: 0;
        left: 0;
        background-color: #B50003;
    }

    .sidebar a {
        color: white;
        padding: 20px;
        text-decoration: none;
        display: block;
    }

    .sidebar a:hover {
        background-color: #000000;
        transition: 0.2s;
    }

    .content {
        margin-left: 250px;
    }
    </style>
    @yield('css')
</head>

<body>
    <div class="sidebar h-100 collapse show" id="">
        <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark h-100">
            <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                <svg class="bi me-2" width="40" height="32">
                    <use xlink:href="#bootstrap"></use>
                </svg>
                <span class="fs-4">Sidebar</span>
            </a>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="{{route('retur.index')}}" class="nav-link text-white {{  request()->routeIs('retur.index') ? 'active':'' }}" aria-current="page">
                        <svg class="bi me-2" width="16" height="16">
                            <use xlink:href="#home"></use>
                        </svg>
                        Data Gudang
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('returpembelian.index')}}" class="nav-link text-white {{  request()->routeIs('returpembelian.index') ? 'active':'' }}">
                        <svg class="bi me-2" width="16" height="16">
                            <use xlink:href="#speedometer2"></use>
                        </svg>
                        Data Barang Rusak
                    </a>
                </li>

            </ul>

        </div>
    </div>
    <div class="content">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <div class="ms-auto">
                        <span>{{Auth::user()->roles->nama_role ?? 'Role Undefined'}} | {{Auth::user()->email}}</span>
                        <button class="btn btn-sm btn-danger text-white ms-3" type="button" onclick="window.location.href='{{route('logout')}}'"> Logout </button>
                    </div>
                </div>
            </div>
        </nav>
        <div class="container-fluid">
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    @yield('js')
    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('success') }}',
            });
        </script>
    @endif

    @if(session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '{{ session('error') }}',
            });

        </script>
        @endif
</body>

</html>