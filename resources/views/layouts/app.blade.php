<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>CFOS</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>

    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">


    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
    
    body {
  margin: 0;
  font-family: Verdana,sans-serif;
}

.sidebar {
  margin: 0;
  padding: 0;
  width: 300px;
  background-color: #fff;;
  position: fixed;
  height: 100%;
  overflow: auto;
}

.sidebar a {
  display: block;
  color: black;
  padding: 16px;
  text-decoration: none;
}

.sidebar a:hover {
    color: black;
    background-color: #e9ecef;
}

.sidebar a.active {
  background-color: #04AA6D;
  color: white;
}

.sidebar a:hover:not(.active) {
  background-color: #555;
  color: white;
}

div.content {
  margin-left: 200px;
  padding: 1px 16px;
  height: 1000px;
}

@media screen and (max-width: 700px) {
  .sidebar {
    width: 100%;
    height: auto;
    position: relative;
  }
  .sidebar a {float: left;}
  div.content {margin-left: 0;}
}

@media screen and (max-width: 400px) {
  .sidebar a {
    text-align: center;
    float: none;
  }
}

    </style>

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('home') }}">
                    CFOS
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                        
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        
        @if(Auth::check())
        
        <div class="sidebar">
        
    
        @can('edit.canteen')
            <a class="nav-link" href="{{ route('canteen.Canteen.index') }}">Menu Management</a>
            <a class="nav-link" href="{{route('manageorder.Manageorder.index') }}">Order Management</a>
        @endcan
        @can('parent.users')
            <a class="nav-link" href="{{ route('parent.Childrens.index') }}">Menu</a>
            <a class="nav-link" href="{{route('menu.Menu.create') }}">Order History</a>
            <a class="nav-link" href="{{route('menu.Menu.index') }}">Cart</a>
        @endcan
        @can('manage.users')
            <a class="dropdown-item" href="{{ route('admin.users.index') }}">User Management</a>
            <a class="dropdown-item" href="{{ route('admin.users.organization') }}">Organization Management</a>
        @endcan
        @can('teacher.users')
            <a class="dropdown-item" href="{{ route('Teacher.Teacher.index') }}">Students Order</a>
        @endcan
        @can('School.Admin')
            <a class="dropdown-item" href="{{ route('Admin.SchAdm.mainAdmin') }}">Manage Staff</a>
            <a class="dropdown-item" href="{{ route('Admin.SchAdm.bannedMenu') }}">Manage Banned Menu</a>
            <a class="dropdown-item" href="{{ route('Admin.SchAdm.priceMenu') }}">Manage Menu Price</a>
        @endcan
        </div> 
        
        @endif
        
        <main class="py-4">
            <div class="content">
                @yield('content')
            </div>
        </main>
        
    </div>

</body>
</html>
