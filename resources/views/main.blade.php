<!doctype html>
<html lang="zh-TW">
    <head>
        @include('partials/_head')
    </head>

<body>
    @include('partials/_nav')
    
    @include('partials/_messages')

    <div class="container">
        {{ Auth::check() ? "Logged in" : "Logged out"}}
        @yield('content')
        <hr>
    </div> <!-- end of container -->

    @include('partials/_footer')
    @include('partials/_script')
    </body>
</html>