<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('page-title', 'Laravel Upload')</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="css/app.css"/>
    @yield('head')
</head>
<body>
<div class="flex-center position-ref full-height">
    <div class="content">
        <div class="title m-b-md">
            @yield('page-title', 'Laravel chunked upload')
        </div>
        {{ csrf_field() }}
        @yield('content')
    </div>
    <link rel="stylesheet"
          href="{{asset('/css/libs/default.min.css')}}">
    <script src="{{asset('/js/libs/highlight.min.js')}}"></script>
    <script src="{{asset('/js/libs/jquery.min.js')}}"></script>
    @yield('body-end')
    <script src="{{ asset('js/app.js') }}"></script>
    <script>hljs.initHighlightingOnLoad();</script>
</body>
</html>
