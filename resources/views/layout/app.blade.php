<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        @if(!isset($title))
        U-manage
        @else
        {{ $title }} | U-manage
        @endif
    </title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

</head>

<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light mb-3">
            <a class="navbar-brand" href="{{ url("") }}">U-manage</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ (request()->segment(1)=='create-user'?' active':'') }}"
                            href="{{ url('create-user') }}">Create User</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ (request()->segment(1)=='delete-user'?' active':'') }}"
                            href="{{ url('delete-user') }}">Delete User</a>
                    </li>
                    {{-- <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Dropdown
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                    </li> --}}
                </ul>
                {{-- <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search"
                        id="search-input">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit" id="btn-search">Search</button>
                </form> --}}
            </div>
        </nav>

        @yield('content')


    </div>

    {{-- <script src="{{ url("../vendor/components/jquery/jquery.min.js") }}"></script>
    <script src="{{ url("../vendor/twbs/bootstrap/dist/js/bootstrap.min.js") }}"></script> --}}

    <script src="https://code.jquery.com/jquery-3.6.0.min.js">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://kit.fontawesome.com/0f853fcb5c.js" crossorigin="anonymous"></script>

    @stack('js')

</body>

</html>