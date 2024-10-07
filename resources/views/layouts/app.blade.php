<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'AmbiGestion') }}</title>
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        body, html {
            height: 100%;
            margin: 0;
            padding: 0;
        }
        #app {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .navbar {
            background-color: #39a900;
            padding: 0.5rem 1rem;
            height: 60px;
        }
        .navbar .container-fluid {
            display: flex;
            justify-content: flex-end;
            height: 100%;
        }
        .main-container {
            display: flex;
            flex: 1;
        }
        .sidebar {
            width: 250px;
            background-color: #39a900;
            color: white;
            padding-top: 20px;
        }
        .content-area {
            flex: 1;
            padding: 20px;
            background-color: #f4f4f4;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .content-container {
            width: 100%;
            max-width: 1200px;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .sidebar .logo-container {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px 0;
        }
        .sidebar .logo-container img {
            max-width: 100%;
            height: auto;
        }
        .sidebar a {
            display: flex;
            align-items: center;
            padding: 10px 15px;
            color: white;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        .sidebar a img {
            width: 24px;
            height: 24px;
            margin-right: 10px;
        }
        .sidebar a span {
            transition: opacity 0.3s;
        }
        #sidebarCollapse {
            position: fixed;
            top: 10px;
            left: 10px;
            z-index: 1000;
            display: none;
        }
        @media (max-width: 991px) {
            .sidebar {
                width: 60px;
            }
            .sidebar a span {
                opacity: 0;
                width: 0;
                height: 0;
                overflow: hidden;
            }
            .sidebar .logo-container img {
                max-width: 50%;
                height: 10px;
            }
            #sidebarCollapse {
                display: block;
            }
        }
        @media (max-width: 767px) {
            .sidebar {
                margin-left: -60px;
            }
            .sidebar.active {
                margin-left: 0;
            }
        }
        .content-area {
        flex: 1;
        padding: 20px;
        background-color: #f4f4f4;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .content-container {
        width: 100%;
        max-width: 1200px; /* Ajusta este valor según tus necesidades */
        background-color: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .table-responsive {
        width: 100%;
        overflow-x: auto;
    }

    .table {
        width: 100%;
        margin-bottom: 1rem;
        color: #212529;
        border-collapse: collapse;
    }

    .table th,
    .table td {
        padding: 0.75rem;
        vertical-align: top;
        border-top: 1px solid #dee2e6;
    }

    .table thead th {
        vertical-align: bottom;
        border-bottom: 2px solid #dee2e6;
        background-color: #f8f9fa;
    }

    .table tbody tr:nth-of-type(even) {
        background-color: rgba(0,0,0,.05);
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        color: white;
        padding: 0.375rem 0.75rem;
        border-radius: 0.25rem;
        text-decoration: none;
        display: inline-block;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }

    @media (max-width: 768px) {
        .content-container {
            padding: 10px;
        }

        .table th,
        .table td {
            padding: 0.5rem;
        }
    }
    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    .form-control {
        width: 100%;
        padding: 8px;
        border: 1px solid #ced4da;
        border-radius: 4px;
    }

    .btn-primary {
        background-color: #007bff;
        border: none;
        color: white;
        padding: 10px 20px;
        border-radius: 4px;
        cursor: pointer;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    </style>
</head>
<body>
    <div id="app">
    <nav class="navbar">
    <div class="container-fluid">
        @auth
            <button onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-outline-light">
                Cerrar Sesión
            </button>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        @else
            <a href="{{ route('login') }}" class="btn btn-outline-light me-2">Login</a>
            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="btn btn-outline-light">Register</a>
            @endif
        @endauth
    </div>
</nav>

        <div class="main-container">
            <aside class="sidebar">
                <div class="logo-container">
                    <img src="/img/logosena.png" alt="Logo SENA">
                </div>
    @auth
        @if(auth()->user()->hasRole('admin'))

            <a href="{{ route('home') }}"><img src="/img/home.png" alt=""><span>Dashboard</span></a>
            <a href="{{ route('personas.index') }}"><img src="/img/authorize.png" alt=""><span>Programacion</span></a>
            <a href="{{ route('personas.index') }}"><img src="/img/billboard.png" alt=""><span>Programa de formacion</span></a>
            <a href="{{ route('personas.index') }}"><img src="/img/creativity.png" alt=""><span>Resultado de Aprendizaje</span></a>
            <a href="{{ route('personas.index') }}"><img src="/img/chess.png" alt=""><span>Competencias</span></a>
            <a href="{{ route('personas.index') }}"><img src="/img/repeat.png" alt=""><span>Recursos</span></a>
            <a href="{{ route('personas.index') }}"><img src="/img/feedback.png" alt=""><span>Novedad</span></a>
            <a href="{{ route('personas.index') }}"><img src="/img/user-experience.png" alt=""><span>Ambientes</span></a>
            <a href="{{ route('personas.index') }}"><img src="/img/group.png" alt=""><span>Persona</span></a>
       
            @elseif(auth()->user()->hasRole('instructor'))
            <a href="{{ route('home') }}"><img src="/img/home.png" alt=""><span>Dashboard</span></a>            
            <a href="#"><img src="/img/home.png" alt=""><span>Programacion</span></a>
            <a href="{{ route('personas.index') }}"><img src="/img/group.png" alt=""><span>Persona</span></a>
        
        @elseif(auth()->user()->hasRole('aprendiz'))
        <a href="{{ route('home') }}"><img src="/img/home.png" alt=""><span>Dashboard</span></a>            
            <a href="#"><img src="/img/home.png" alt=""><span>Programacion</span></a>
            <a href="{{ route('personas.index') }}"><img src="/img/group.png" alt=""><span>Persona</span></a>
        
        @endif
    @endauth
</aside>

            <main class="content-area">
                @if($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var sidebar = document.querySelector('.sidebar');
            var sidebarCollapse = document.querySelector('#sidebarCollapse');

            sidebarCollapse.addEventListener('click', function() {
                sidebar.classList.toggle('active');
            });
        });
    </script>
    
    @yield('scripts')
</body>
</html>