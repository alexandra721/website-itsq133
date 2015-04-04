<html>
<head>
    <title>Promotional Website</title>

    {{ HTML::style('css/bootstrap.min.css') }}
    {{ HTML::style('css/bootstrap-theme.min.css') }}
    {{ HTML::style('css/sb-admin-2.css') }}
    {{ HTML::style('css/timeline.css') }}
    {{ HTML::style('css/simple-sidebar.css') }}
    {{ HTML::style('css/custom.css') }}
    {{ HTML::style('font-awesome-4.2.0/css/font-awesome.min.css') }}
    {{ HTML::style('css/blueimp-gallery.min.css') }}
    {{ HTML::style('css/jquery.cleditor.css') }}

    {{ HTML::script('js/jquery-1.11.0.min.js') }}
    {{ HTML::script('js/bootstrap.min.js') }}
    {{ HTML::script('js/custom.js') }}
    {{ HTML::script('js/blueimp-gallery.min.js') }}
    {{ HTML::script('js/jquery.cleditor.min.js') }}

    <style>
        .thumbnail-custom {
            height: 35px;
            border: solid 0.07em;
            border-color: #000000;
            border-radius: 0.2em;
            /*width: 90%;*/
            /*position:relative;*/
            /*left: 50%;*/
            /*top: 50%;*/
            /*transform: translate(-50%, -50%);*/
        }
    </style>

    <script>
        $(function () {
            $('.navbar-toggle').click(function () {
                $('.navbar-nav').toggleClass('slide-in');
                $('.side-body').toggleClass('body-slide-in');
                $('#search').removeClass('in').addClass('collapse').slideUp(200);

                /// uncomment code for absolute positioning tweek see top comment in css
                //$('.absolute-wrapper').toggleClass('slide-in');

            });

            // Remove menu for searching
            $('#search-trigger').click(function () {
                $('.navbar-nav').removeClass('slide-in');
                $('.side-body').removeClass('body-slide-in');

                /// uncomment code for absolute positioning tweek see top comment in css
                //$('.absolute-wrapper').removeClass('slide-in');

            });
        });
    </script>
    @yield('master-head')
</head>
<body>
@if(Auth::check())
<div class="row">
    <!-- uncomment code for absolute positioning tweek see top comment in css -->
    <!-- <div class="absolute-wrapper"> </div> -->
    <!-- Menu -->
    <div class="side-menu">
        <nav class="navbar navbar-default" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <div class="brand-wrapper">
                    <!-- Hamburger -->
                    <button type="button" class="navbar-toggle">
                        <span class="sr-only">Toggle navigation</span>

                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!-- Brand -->
                    <div class="brand-name-wrapper" style="background-color: #34495E;">
                        <a href="admin/yprofile" class="navbar-brand" style="color: white; padding-top: 0.5em;">
<!--                            <i class="fa fa-star" style="color: #F1C40F"></i>-->
                            <img class="thumbnail-custom"  src="{{ Auth::user()->profile_photo }}" style="display: inline"/>&nbsp;&nbsp;&nbsp;{{ Auth::user()->firstname }}
                        </a>
                    </div>

                    <!-- Search -->
<!--                    <a data-toggle="collapse" href="#search" class="btn btn-default" id="search-trigger">-->
<!--                        <span class="glyphicon glyphicon-search"></span>-->
<!--                    </a>-->
                    <!-- Search body -->
<!--                    <div id="search" class="panel-collapse collapse">-->
<!--                        <div class="panel-body">-->
<!--                            <form class="navbar-form" role="search">-->
<!--                                <div class="form-group">-->
<!--                                    <input type="text" class="form-control" placeholder="Search">-->
<!--                                </div>-->
<!--                                <button type="submit" class="btn btn-default "><span class="glyphicon glyphicon-ok"></span></button>-->
<!--                            </form>-->
<!--                        </div>-->
<!--                    </div>-->
                </div>

            </div>

            <!-- Main Menu -->
            <div class="side-menu-container">
                <ul class="nav navbar-nav">
<!--                    <li class="active"><a href="#"><span class="glyphicon glyphicon-plane"></span> Active Link</a></li>-->
                    <li><a href="/admin/home"><span class="glyphicon glyphicon-dashboard"></span> Dashboard</a></li>
                    <li><a href="/admin/users"><span class="glyphicon glyphicon-user"></span> Users</a></li>
<!--                    <li><a href="/admin/comments"><span class="glyphicon glyphicon-comment"></span> Comments</a></li>-->
<!--                    <li><a href="#"><span class="glyphicon glyphicon-pencil"></span> Posts</a></li>-->

                    <li class="panel panel-default" id="dropdown">
                        <a data-toggle="collapse" href="#dropdown-content">
                            <span class="glyphicon glyphicon-th"></span> Content <span class="caret"></span>
                        </a>
                        <div id="dropdown-content" class="panel-collapse collapse">
                            <div class="panel-body">
                                <ul class="nav navbar-nav">
                                    <li><a href="/admin/comments"><span class="glyphicon glyphicon-comment"></span> Comments</a></li>
                                    <li><a href="/admin/aboutus"><span class="glyphicon glyphicon-heart"></span> About us</a></li>
<!--                                    <li><a href="/admin/homeManage"><span class="glyphicon glyphicon-home"></span> Home</a></li>-->
                                    <li><a href="/admin/contactus"><span class="glyphicon glyphicon-earphone"></span> Contact us</a></li>
                                </ul>
                            </div>
                        </div>
                    </li>

                    <!-- Dropdown-->
                    <li class="panel panel-default" id="dropdown">
                        <a data-toggle="collapse" href="#dropdown-lvl1">
                            <span class="glyphicon glyphicon-user"></span> Gallery <span class="caret"></span>
                        </a>
                        <!-- Dropdown level 1 -->
                        <div id="dropdown-lvl1" class="panel-collapse collapse">
                            <div class="panel-body">
                                <ul class="nav navbar-nav">
                                    <li><a href="/admin/images"><span class="glyphicon glyphicon-picture"></span> Images</a></li>
                                    <li><a href="/admin/videos"><span class="glyphicon glyphicon-film"></span> Videos</a></li>
<!---->
<!--                                     Dropdown level 2 -->
<!--                                    <li class="panel panel-default" id="dropdown">-->
<!--                                        <a data-toggle="collapse" href="#dropdown-lvl2">-->
<!--                                            <span class="glyphicon glyphicon-off"></span> Sub Level <span class="caret"></span>-->
<!--                                        </a>-->
<!--                                        <div id="dropdown-lvl2" class="panel-collapse collapse">-->
<!--                                            <div class="panel-body">-->
<!--                                                <ul class="nav navbar-nav">-->
<!--                                                    <li><a href="#">Link</a></li>-->
<!--                                                    <li><a href="#">Link</a></li>-->
<!--                                                    <li><a href="#">Link</a></li>-->
<!--                                                </ul>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                    </li>-->
                                </ul>
                            </div>
                        </div>
                    </li>

                    <li><a href="#"><span class="glyphicon glyphicon-signal"></span> Reports</a></li>
                    <li><a href="/admin/logout"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>

    </div>

    <!-- Main Content -->
    <div class="container-fluid">
        <div class="side-body">
            @yield('master-body')
        </div>
    </div>
</div>
@else
    @yield('master-body')
@endif
</body>
</html>