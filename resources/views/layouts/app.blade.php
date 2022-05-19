<!DOCTYPE html>
<html lang="en">
<head>

    @include('includes.meta')

    <title>@yield('title') | Politeknik Hasnur</title>

    @stack('before-styles')
    @include('includes.styles')
    @stack('after-styles')

</head>
<body>
    
    <div class="app">
        
        @include('includes.sidebar')

        <div id="main" class="layout-navbar">

            <header class="mb-3">
                @include('includes.navbar')
            </header>
            
            <div id="main-content">

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

    </div>

    @stack('before-scripts')
    @include('includes.scripts')
    @stack('after-scripts')

</body>
</html>