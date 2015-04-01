<html>
<head>
    <title>Promotional Website</title>

    {{ HTML::style('css/bootstrap.min.css') }}
    {{ HTML::style('css/bootstrap-theme.min.css') }}
    {{ HTML::style('css/timeline.css') }}
    {{ HTML::style('css/simple-sidebar.css') }}
    {{ HTML::style('css/website-custom.css') }}
    {{ HTML::style('css/blueimp-gallery.min.css') }}
    {{ HTML::style('font-awesome-4.2.0/css/font-awesome.min.css') }}

    {{ HTML::script('js/jquery-1.11.0.min.js') }}
    {{ HTML::script('js/bootstrap.min.js') }}
    {{ HTML::script('js/website-custom.js') }}
    {{ HTML::script('js/blueimp-gallery.js') }}
    <style>
        body{
            background-attachment:fixed
        }
    </style>
    @yield('master-head')
</head>
<body>
    <div class="website-nav">
        <div class="pull-right" style="margin-right: 0.4em">
            <button class="btn website-nav-btn" onclick="return location.href='/home'">HOME</button>
            <button class="btn website-nav-btn" onclick="return location.href='/gallery'">GALLERY</button>
<!--            <button class="btn website-nav-btn">ABOUT</button>-->
            <button class="btn website-nav-btn" onclick="return location.href='/about'">ABOUT</button>
            <button class="btn website-nav-btn" onclick="return location.href='/contactus'">CONTACT US</button>
            @if(!Auth::check())
                <button class="btn website-nav-btn" onclick="return location.href='/login'">LOGIN</button>
                <button class="btn website-nav-btn" onclick="return location.href='/register'" style="background-color: #1ABC9C;">REGISTER</button>
            @else
                <button class="btn website-nav-btn" onclick="return location.href='/profile'" style="background-color: #F39C12;">{{ Auth::user()->firstname }}</button>
                <button class="btn website-nav-btn" onclick="return location.href='/doLogout'" style="background-color: #E74C3C;">Logout</button>
            @endif
        </div>
    </div>
    @yield('master-body')
</body>
</html>