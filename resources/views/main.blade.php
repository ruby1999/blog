<!doctype html>
<html lang="zh-TW">
@include('partials/_head')

<body>
    @include('partials/_nav')

    <div class="container">
        @yield('content')
        
    </div> <!-- end of container -->

    @include('partials/_footer')
    @include('partials/_script')
    </body>
</html>