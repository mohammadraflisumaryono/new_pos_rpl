<!doctype html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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

  
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        @include('template.navbar')
        @include('template.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
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


            @include('template.js')
</body>

</html>