<!doctype html>

<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>{{$page_title}}</title>
    @include('template.css')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('styles')
    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }
    </style>

    <script src="https://kit.fontawesome.com/0ef72646e9.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="page">
        @include('template.sidebar')
        @include('template.navbar')
        <div class="page-wrapper">
            <!-- Page header -->
            <div class="page-header d-print-none">
                <div class="container-xl">
                    <div class="row g-2 align-items-center">
                        <div class="col">
                            <!-- Page pre-title -->
                            <div class="page-pretitle">
                                &nbsp;
                            </div>
                            <h2 class="page-title">
                                {{ $page_title }}
                            </h2>
                        </div>
                        @yield('page_title_actions')
                    </div>
                </div>
            </div>
            <!-- Page body -->
            <div class="page-body mx-8">
                @yield('page_content')
            </div>
            @include('template.footer')
        </div>
    </div>
</body>

</html>