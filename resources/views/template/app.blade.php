<!doctype html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sunny Mart</title>
    <link rel="icon" href="{{ asset('storage/images/logo.png')}}">
    @include('template.css')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('styles')
    @yield('head_khusus')
    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }

        .no-margin {
            margin: 0 !important;
        }
    </style>


</head>

<body class="hold-transition sidebar-mini">

    <div class="wrapper">
        @include('template.navbar')

        @if(Auth::check())
        @if(Auth::user()->role == 4)
        @include('template.sidebar')
        @endif
        @endif

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper @if(!auth()->check() || !auth()->user()->isAdmin()) no-margin @endif">
            <!-- Content Header (Page header) -->
            @if(isset($page_title))
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">

                        <div class="col-sm-6">
                            <h1 class="m-0">{{ $page_title }}</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">@yield('page_title_actions')</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            @endif
            <!-- /.content-header -->
            <!-- Page body -->
            <div class="page-body mx-8">
                @yield('page_content')
            </div>
            @include('template.footer')
        </div>
    </div>
    </div>


    @include('template.js')
    @yield('scripts')
</body>

</html>