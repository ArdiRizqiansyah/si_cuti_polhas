<!DOCTYPE html>
<html lang="en">
<head>

    @include('includes.meta')

    <title>@yield('title') | YHC</title>

    @stack('before-styles')
    @include('includes.styles')
    @stack('after-styles')

</head>
<body>
    
    <div class="app">

        <div id="auth">

            @yield('content')

        </div>

    </div>

    @stack('script')

</body>
</html>