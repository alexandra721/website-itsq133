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
            background-attachment:fixed;
            transition : 0.8s;
        }

        .contactUsModal-body {
            text-align: center;
        }

        .contact-details {
            color: #2980B9;
            font-weight: bold;
            padding-top: 1.3em;
        }
    </style>
    <script>
        $(document).ready(function(){
            $('.contact-us-btn').click(function(){
                $('#contactUsModal').modal().show();
            });
        })
    </script>
    @yield('master-head')
</head>
<body>
    <div class="website-nav">
        <div class="pull-right" style="margin-right: 0.4em">
            <button class="btn website-nav-btn" onclick="return location.href='/home'" style="width: 10em;">HOME</button>
            <button class="btn website-nav-btn" onclick="return location.href='/gallery'" style="width: 10em;">GALLERY</button>
<!--            <button class="btn website-nav-btn">ABOUT</button>-->
            <button class="btn website-nav-btn" onclick="return location.href='/about'" style="width: 10em;">ABOUT</button>
            <button class="btn website-nav-btn contact-us-btn" style="width: 10em;" data-target="modal">CONTACT US</button>
            @if(!Auth::check())
                <button class="btn website-nav-btn" onclick="return location.href='/login'" style="width: 10em;">LOGIN</button>
                <button class="btn website-nav-btn" onclick="return location.href='/register'" style="background-color: #1ABC9C; width: 10em; font-weight: bold;">REGISTER</button>
            @else
                <button class="btn website-nav-btn" onclick="return location.href='/profile'" style="background-color: #F39C12;">{{ Auth::user()->firstname }}</button>
                <button class="btn website-nav-btn" onclick="return location.href='/doLogout'" style="background-color: #E74C3C;">Logout</button>
            @endif
        </div>
    </div>
    <div class="modal fade" id="contactUsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel" style="text-align: center;"><i class="fa fa-heart" style="color: red"></i> Contact us!</h4>
                </div>
                <div class="modal-body contactUsModal-body">
                    <h4>{{ Content::where('type', 'slogan')->pluck('content') }}</h4>
                   {{ Content::where('type', 'homeslogan')->pluck('content') }}
                    <div class="contact-details">
                        (63) 927-6274-649<br/>
                        loremipsum@email.com
                    </div>
                </div>
                <div class="modal-footer custom-footer">
                    Dynamic Promotional Website - Project in ITSQ133<br/>
                    Powered by Laravel 4.2
                </div>
            </div>
        </div>
    </div>
    @yield('master-body')
</body>
</html>