<!DOCTYPE html>
<html>
<head>
    <title>{{ isset($title) ? $title : '' }}</title>
    <link rel="stylesheet" href="{{ asset('cruddy/assets/vendor/bootstrap/dist/css/bootstrap.min.css') }}">
</head>
<body>
    <div class="container" style="margin-top: 20px">@yield('content', isset($content) ? $content : '')</div>
    @yield('scripts')
</body>
</html>