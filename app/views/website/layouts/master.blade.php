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
            background-color: #2C3E50;
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
        $(document).ready(function(){ scripts_Master(); })

        var timeout = null;
        $(document).on('mousemove', function() {
            clearTimeout(timeout);

            timeout = setTimeout(function() {
                console.log('Mouse idle for 3 sec');
            }, 1000);
        });
    </script>
    @yield('master-head')
</head>
<body>
    <div class="website-nav">
        <div class="col-md-2"><button class="website-nav-btn" onclick="return location.href='/home'">HOME</button></div>
        <div class="col-md-2"><button class="website-nav-btn" onclick="return location.href='/gallery'">GALLERY</button></div>
        <div class="col-md-2"><button class="website-nav-btn" onclick="return location.href='/about'">ABOUT</button></div>
        <div class="col-md-2"><button class="website-nav-btn contact-us-btn" data-target="modal">CONTACT US</button></div>

        @if(Auth::check())
            <div class="col-md-2"><button class="website-nav-btn profile">Hi, {{ Auth::user()->firstname }}</button></div>
            <div class="col-md-2"><button class="website-nav-btn logout" onclick="return location.href='/doLogout'">LOGOUT</button></div>
        @else
            <div class="col-md-2"><button class="website-nav-btn" onclick="return location.href='/login'">LOGIN</button></div>
            <div class="col-md-2"><button class="website-nav-btn" onclick="return location.href='/register'">REGISTER</button></div>
        @endif
<!--        <button class="website-nav-btn" onclick="return location.href='/home'">HOME</button>-->
<!--        <button class="website-nav-btn" onclick="return location.href='/gallery'">GALLERY</button>-->
<!--        <button class="website-nav-btn" onclick="return location.href='/about'">ABOUT</button>-->
<!--        <button class="website-nav-btn contact-us-btn" data-target="modal">CONTACT US</button>-->
<!---->
<!--        @if(Auth::check())-->
<!--            <button class="website-nav-btn profile">Hi, {{ Auth::user()->firstname }}</button>-->
<!--            <button class="website-nav-btn logout" onclick="return location.href='/doLogout'">LOGOUT</button>-->
<!--        @else-->
<!--            <button class="website-nav-btn" onclick="return location.href='/login'">LOGIN</button>-->
<!--            <button class="website-nav-btn" onclick="return location.href='/register'">REGISTER</button>-->
<!--        @endif-->

<!--        <div class="pull-right" style="margin-right: 0.4em">-->
            <!--            <button class="btn website-nav-btn" onclick="return location.href='/home'" style="width: 10em;">HOME</button>-->
<!--            <button class="btn website-nav-btn" onclick="return location.href='/gallery'" style="width: 10em;">GALLERY</button>-->
<!--            <button class="btn website-nav-btn" onclick="return location.href='/about'" style="width: 10em;">ABOUT</button>-->
<!--            <button class="btn website-nav-btn contact-us-btn" style="width: 10em;" data-target="modal">CONTACT US</button>-->
<!--            @if(!Auth::check())-->
<!--                <button class="btn website-nav-btn" onclick="return location.href='/login'" style="width: 10em;">LOGIN</button>-->
<!--                <button class="btn website-nav-btn" onclick="return location.href='/register'" style="background-color: #1ABC9C; width: 10em; font-weight: bold;">REGISTER</button>-->
<!--            @else-->
<!--                <button class="btn website-nav-btn" style="background-color: #F39C12; width: 10em; font-weight: bold;">Hi, {{ Auth::user()->firstname }}</button>-->
<!--                <button class="btn website-nav-btn" onclick="return location.href='/doLogout'" style="background-color: #E74C3C; width: 10em; font-weight: bold;">Logout</button>-->
<!--            @endif-->
<!--        </div>-->
    </div>
    <div class="modal fade" id="contactUsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel" style="text-align: center; color: #000000;"><i class="fa fa-heart" style="color: red"></i> Contact us!</h4>
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

    <div class="modal fade" id="profileModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="$('.profile-input').val('')"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel" style="text-align: center;">Welcome, {{ @Auth::user()->firstname }} {{ @Auth::user()->lastname }}</h4>
                </div>
                <div class="modal-body contactUsModal-body">
                    <div class="profile-btns">
                        <button class="btn btn-default btn-block changePass"><i class="glyphicon glyphicon-asterisk"></i> Change Password</button>
                        <button class="btn btn-default btn-block changeEmail"><i class="fa fa-envelope-o"></i> Change Email</button>
                    </div>

                    <div class="div-changeemail" style="display: none;">
                        <form method="POST" action="/changeEmail">
                            <input type="hidden" value="{{ @Auth::user()->id }}" name="user_id"/>
                            <input type="text" class="profile-input form-control margin-bottom-10" placeholder="Enter old email" required="true"/>
                            <input type="text" class="profile-input form-control margin-bottom-10" placeholder="Enter new email" required="true"/>
                            <input type="text" class="profile-input form-control" style="margin-bottom: 2em;" placeholder="Confirm new email" required="true"/>
                            <button type="submit" class="btn btn-primary btn-block margin-bottom-10"><i class="fa fa-envelope-o"></i> Change Email</button>
                            <button type="button" class="btn btn-danger btn-block cancel-btn">Cancel</button>
                        </form>
                    </div>

                    <div class="div-changepass" style="display: none;">
                        <form method="POST" action="/changePass">
                            <input type="hidden" value="{{ @Auth::user()->id }}" name="user_id"/>
                            <input type="password" class="profile-input form-control margin-bottom-10" placeholder="Enter old password" required="true"/>
                            <input type="password" class="profile-input form-control margin-bottom-10" placeholder="Enter new password" required="true"/>
                            <input type="password" class="profile-input form-control" style="margin-bottom: 2em;" placeholder="Confirm new password" required="true"/>
                            <button type="submit" class="btn btn-primary btn-block margin-bottom-10" style="margin-top: 0.4em"><i class="glyphicon glyphicon-asterisk"></i> Change Password</button>
                            <button type="button" class="btn btn-danger btn-block cancel-btn">Cancel</button>
                        </form>
                    </div>
                </div>
                <div class="modal-footer custom-footer">
                    Dynamic Promotional Website - Project in ITSQ133<br/>
                    Powered by Laravel 4.2
                </div>
            </div>
        </div>
    </div>

    <div id="blueimp-gallery" class="blueimp-gallery">
        <div class="slides"></div>
        <h3 class="title"></h3>
        <a class="prev">‹</a>
        <a class="next">›</a>
        <a class="close">×</a>
        <a class="play-pause"></a>
        <ol class="indicator"></ol>
    </div>
    @yield('master-body')
</body>
</html>