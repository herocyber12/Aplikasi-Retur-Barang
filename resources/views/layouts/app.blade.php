<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @if (Session::has('kondisibaik'))
        <meta http-equiv="refresh" content="3;url={{ route('retur.getLaporan')}}">
    @endif
    @if (Session::has('laporanreturpembelian'))
        <meta http-equiv="refresh" content="3;url={{ route('returpembelian.laporanRetur')}}">
    @endif
    <title>Sistem Retur Pembelian</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <style>
    .sidebar {
        height: 100vh;
        position: fixed;
        width: 250px;
        top: 0;
        left: 0;
        background-color: #B50003;
        transition: transform 0.3s ease;
        z-index: 1030; /* Tambahkan z-index lebih tinggi dari navbar */
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

    @media (max-width: 768px) {
        .sidebar {
            transform: translateX(-250px);
        }

        .sidebar.collapse.show {
            transform: translateX(0);
        }

        .content {
            margin-left: 0;
        }

        .btn {
            margin: 20px;
        }
    }
  </style>

    @yield('css')
</head>

<body>
    <div class="sidebar h-100 collapse show" id="sidebarMenu">
        <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark h-100">
                <span class="fs-4">Task WebDev</span>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                @if(Auth::user()->id_role === 2 || Auth::user()->id_role === 1)
                <li class="nav-item">
                    <a href="{{route('retur.index')}}" class="nav-link text-white {{ request()->routeIs('retur.index') ? 'active':'' }}" aria-current="page">
                        <i class="fa-solid fa-dice-d6"></i>
                        Data Gudang
                    </a>
                </li>
                @endif
                @if (Auth::user()->id_role  === 1 || Auth::user()->id_role === 3)
                <li class="nav-item">
                    <a href="{{route('returpembelian.index')}}" class="nav-link text-white {{ request()->routeIs('returpembelian.index') ? 'active':'' }}">
                        <i class="fa fa-scroll"></i>
                        Data Barang Rusak
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('returpembelian.returShow')}}" class="nav-link text-white {{ request()->routeIs('returpembelian.returShow') ? 'active':'' }}">
                        <i class="fa fa-share-from-square"></i>
                        Data Barang di Retur
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('laporan.keluar')}}" class="nav-link text-white {{ request()->routeIs('laporan.keluar') ? 'active':'' }}">
                        <i class="fa fa-arrow-right-from-bracket"></i>
                        Data Barang Keluar
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('laporan.masuk')}}" class="nav-link text-white {{ request()->routeIs('laporan.masuk') ? 'active':'' }}">
                        <i class="fa fa-arrow-right-to-bracket"></i>
                        Data Barang Masuk
                    </a>
                </li>
                @endif
                <li class="nav-item">
                    <a href="{{route('stok')}}" class="nav-link text-white {{ request()->routeIs('stok') ? 'active':'' }}">
                        <i class="fa fa-list"></i>
                        Stok
                    </a>
                </li>
                @if (Auth::user()->id_role === 1)
                    
                <li class="nav-item">
                    <a href="{{route('data.sr')}}" class="nav-link text-white {{ request()->routeIs('data.sr') ? 'active':'' }}">
                        <i class="fa fa-people-group"></i>
                        Data User
                    </a>
                </li>
                @endif

                <li class="nav-item">
                    <button class="btn btn-secondary d-md-none" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu">
                        <i class="fa fa-arrow-left"></i>
                    </button>
                </li>
            </ul>
        </div>
    </div>
    <div class="content">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <button class="btn btn-primary d-md-none" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu">
                    <i class="fa fa-arrow-right"></i>
                </button>
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

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/js/all.min.js" integrity="sha512-6sSYJqDreZRZGkJ3b+YfdhB3MzmuP9R7X1QZ6g5aIXhRvR1Y/N/P47jmnkENm7YL3oqsmI6AK+V6AD99uWDnIw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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