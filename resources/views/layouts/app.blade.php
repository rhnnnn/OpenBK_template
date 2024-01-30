<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>{{ "$title | ".config('app.name')}}</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@4.0.1/fonts/remixicon.min.css" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
        <link rel="stylesheet" href="{{asset('assets/css/style.css')}}" />

    </head>
    <body>
        {{-- navbar start --}}
        <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #a42424;">
            <div class="container-fluid">
                <a class="navbar-brand" href="/"><b>OpenBK</b></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">                
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        @auth
                        <li class="nav-item">
                            <a class="nav-link @if(Request::is('home')) active @endif" aria-current="page" href="/home">Home </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if(Request::is('siswa')) active @endif" href="/siswa">Siswa </a>
                        </li>
                        @role('Administrator')
                        <li class="nav-item">
                            <a href="/petugas" class="nav-link @if(Request::is('petugas')) active @endif">Petugas </a>
                        </li>
                        @endrole
                        <li class="nav-item">
                            <a href="/pelanggaran" class="nav-link @if(Request::is('pelanggaran')) active @endif">Pelanggaran </a>
                        </li>
                        <li class="nav-item">
                            <a href="/tanggapan" class="nav-link @if(Request::is('tanggapan')) active @endif">Tanggapan </a>
                        </li>
                        @endauth
                    </ul>


                    <ul class="navbar-nav mb-2 mb-lg-0">
                        @guest
                        <li class="nav-item dropdown">
                            <a href="/login" type="button" class="btn btn-primary">Login </a>
                        </li>
                        @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{Auth::user()->username}}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="#">profile </a></li>
                                <li><hr class="dropdown-divider" /></li>
                                <li>
                                    <form action="{{url('/logout')}}" method="post">
                                        @csrf
                                        <button type="submit" class="dropdown-item">logout </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        {{-- navbar end --}} {{-- Content Container --}}
        <div class="container py-4 mx-7">
            @yield('content')

        </div>

        {{-- Script libir --}} 
        {{-- Online Script --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
        {{-- Local Script --}}
        <script src="{{asset('assets/js/app.js')}}"></script>
    </body>

</html>
