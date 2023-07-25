<!doctype html>
<html lang="en">

<head>

    @include('web.skelton.Top')

</head>

<body>
    <div class="preloader">
        <div class="spin">
            <div class="cube1"></div>
            <div class="cube2"></div>
        </div>
    </div>
    <header class="header-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg">
                        <a class="navbar-brand" href="{{route('pasar')}}">
                            <img src="{{asset('template/assets/images/cow1.png')}}" alt="Logo">
                        </a> <!-- Logo -->
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="bar-icon"></span>
                            <span class="bar-icon"></span>
                            <span class="bar-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul id="nav" class="navbar-nav ml-auto">
                                <li class="nav-item active">
                                    <a data-scroll-nav="0" href="#home">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a data-scroll-nav="0" href="#about">About</a>
                                </li>
                                <li class="nav-item">
                                    <a data-scroll-nav="0" href="#menu">Menu</a>
                                </li>
                                <li class="nav-item">
                                    <a data-scroll-nav="0" href="#profile">Profile</a>
                                </li>
                            </ul> <!-- navbar nav -->
                        </div>
                    </nav> <!-- navbar -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </header>

    @yield('content')
    @include('web.skelton.Footer')

    @include('web.skelton.Bottom')
    @yield('script')
</body>

</html>
