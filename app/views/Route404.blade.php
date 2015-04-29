<html>
<head>
    <title>ERROR 404</title>

    {{ HTML::style('css/bootstrap.min.css') }}
    {{ HTML::style('css/bootstrap-theme.min.css') }}
    {{ HTML::style('css/sb-admin-2.css') }}
    {{ HTML::style('css/timeline.css') }}
    {{ HTML::style('css/simple-sidebar.css') }}
    {{ HTML::style('css/custom.css') }}
    {{ HTML::style('font-awesome-4.2.0/css/font-awesome.min.css') }}

    {{ HTML::script('js/jquery-1.11.0.min.js') }}
    {{ HTML::script('js/bootstrap.min.js') }}
    {{ HTML::script('js/custom.js') }}
    <style>
        body {
            background-color: #34495E;
        }
    </style>
</head>
<body>
    <div class="col-md-offset-4 col-md-4 panel-body" style="background-color: white; border-top-left-radius: 0.4em; border-top-right-radius: 0.4em; margin-top: 6em;">
        <center>
                <h3><i class="fa fa-warning" style="color : #E74C3C;"></i> ERROR 404 : URL not found!</h3>
<!--            <a href="/admin/"><i class="fa fa-arrow-circle-left"></i> proceed to Administrator Login page</a>-->
        </center>
    </div>
    <div class="col-md-offset-4 col-md-4 panel-footer custom-footer">
        Dynamic Promotional Website - Project in ITSQ133<br/>
        Powered by Laravel 4.2
    </div>
</body>
</html>