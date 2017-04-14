<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Prompt" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
    <link rel="stylesheet" href="{{url('assets/css/style.css')}}">
    @yield('stylesheet')
    <style>
        body, body, h1, h2, h3, h4, h5, h6 {
    font-family: 'Prompt', sans-serif;

}
footer-menu {
    background-color: #222;
    padding-top: 60px;
    border-top: 4px solid #555;
    color: #ccc;
}

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body id="app-layout">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{url('assets/images/e-nihongo.png')}}" height="45" title="logo">
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/course') }}"><i class="fa fa-graduation-cap"></i> คอร์สเรียนออนไลน์</a></li>
                    <li><a href="{{ url('/') }}"><i class="fa fa-briefcase"></i> คอร์สสอนสด</a></li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    <li><a href="{{ url('/') }}"><i class="fa fa-book "></i> คู่มือใช้งาน</a></li>
                    <li><a href="{{ url('/') }}"><i class="fa fa-info"></i> เกี่ยวกับเรา</a></li>
                    <li><a href="{{ url('/') }}"><i class="fa fa-bullseye"></i> ข่าวสาร</a></li>
                    <li><a href="{{ url('/') }}"><i class="fa fa-phone-square"></i> ติดต่อเรา</a></li>
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}"><i class="fa fa-sign-in"></i> Login</a></li>
                        <li><a href="{{ url('/register') }}"><i class="fa fa-lock"></i> Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                              <li><a href="{{ url('/profile') }}"><i class="fa fa-btn fa-user"></i> Profile</a></li>
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                    @endif

                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <footer>


        <div class="footer-menu">
        <div class="container" >
            <div class="row">

                <div class="col-md-4">
                    <h4>เกี่ยวกับเรา<span class="head-line"></span></h4>
                    <p>สถาบันติว PAT ญี่ปุ่นและภาษาญี่ปุ่น ZA-SHI
                        ภาษาญี่ปุ่น (ครูพี่โฮม) คนแรกและคนเดียวที่ได้ PAT ญี่ปุ่น 300 คะแนนเต็ม
                        เกียรตินิยมอันดับ 1 (เหรียญทอง) อักษรศาสตร์ จุฬาฯ</p>

                   <ul>
                    <li><span>Tel:</span> 09-4052-6052 </li>
                    <li><span>Email:</span> info@coursesquare.co </li>
                    <li><span>Website:</span> www.coursesquare.co </li>
                    <li><span>Line Id:</span> coursesquare </li>
                   </ul>

                </div>

                <div class="col-md-4">
                    <h4>หน้าหลัก<span class="head-line"></span></h4>
                </div>

                <div class="col-md-4">
                    <h4>ติดตามข่าวสาร<span class="head-line"></span></h4>
                    <p>คุณสามารถติดตามข่าวสาร โปรโมชั่น และคอร์สใหม่ ๆ ของเราได้จากช่องทางต่อไปนี้</p>

                <ul class="social-icons">
                    <li>
                        <a class="facebook" href="#"><i class="fa fa-facebook"></i></a>
                    </li>
                    <li>
                        <a class="google" href="#"><i class="fa fa-google-plus"></i></a>
                    </li>
                    <li>
                        <a class="twitter" href="#"><i class="fa fa-twitter"></i></a>
                    </li>
                    <li>
                        <a class="google" href="#"><i class="fa fa-youtube"></i></a>
                    </li>
                </ul>

                </div>

                <div class="col-lg-12" style="border-top: 1px solid rgba(255,255,255,.06); margin-top:30px;">

                    <p class="copyright small" style="padding: 15px 0;">Copyright © Your Company 2014. All Rights Reserved</p>
                </div>
            </div>
        </div>
        </div>


    </footer>

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
    @yield('scripts')
</body>
</html>
