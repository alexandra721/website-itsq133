<html>
<head>
    <title>Promotional Website</title>

    {{ HTML::style('css/bootstrap.min.css') }}
    {{ HTML::style('css/bootstrap-theme.min.css') }}
    {{ HTML::style('css/sb-admin-2.css') }}
    {{ HTML::style('css/timeline.css') }}
    {{ HTML::style('css/custom.css') }}
    {{ HTML::style('font-awesome-4.2.0/css/font-awesome.min.css') }}

    {{ HTML::script('js/jquery-1.11.0.min.js') }}
    {{ HTML::script('js/boostrap.min.js') }}
    {{ HTML::script('js/sb-admin-2.js') }}
    {{ HTML::script('js/npm.js') }}

    @yield('master-head')
</head>
<body>
@yield('master-body')
</body>
</html>