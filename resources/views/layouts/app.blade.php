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
        
        @include('includes.sidebar')

        <div id="main">
            
            <div class="page-heading">
                @yield('heading')
            </div>

            <div class="page-content">
                @yield('content')
            </div>

            <footer>
                @include('includes.footer')
            </footer>

        </div>

    </div>

    @stack('before-scripts')
    @include('includes.scripts')
    @stack('after-scripts')

</body>
</html>