<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="author" content="Creative Tim">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ isset($title) ? $title : 'E-Paten'}}</title>
    <!-- Fonts -->
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/bootstrap/bootstrap.css') }}" type="text/css"> --}}
    <style>
        *, ::before, ::after {
            box-sizing: border-box;
        }
        html {
            font-family: sans-serif;
            line-height: 1.15;
            -webkit-text-size-adjust: 100%;
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
        }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, 'Noto Sans', sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji';
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            text-align: left;
            color: #212529;
            margin: 0;
        }
        .container-fluid {
            width: 100%;
            margin-right: auto;
            margin-left: auto;
            padding-right: 15px;
            padding-left: 15px;
        }
        .row {
            display: flex;
            margin-right: -15px;
            margin-left: -15px;
            flex-wrap: wrap;
        }
        .col {
            position: relative;
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
            max-width: 100%;
            flex-basis: 0;
            flex-grow: 1;
        }
        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            border: 1px solid rgba(0, 0, 0, .125);
            border-radius: .25rem;
            background-color: #fff;
            background-clip: border-box;
        }
        .pb-4, .py-4 {
            padding-bottom: 1.5rem !important;
        }
        .pt-4, .py-4 {
            padding-top: 1.5rem !important;
        }
        .table-responsive {
            display: block;
            overflow-x: auto;
            width: 100%;
            -webkit-overflow-scrolling: touch;
        }
        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
        }
        table {
            border-collapse: collapse;
        }
        .table th, .table td {
            padding: .75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }
        .table-bordered {
            border: 1px solid #dee2e6;
        }
        .table-bordered th, .table-bordered td {
            border: 1px solid #dee2e6;
            border-top-color: rgb(222, 226, 230);
            border-top-style: solid;
            border-top-width: 1px;
        }
        .mb-5, .my-5 {
            margin-bottom: 3rem !important;
        }
        .mt-5, .my-5 {
            margin-top: 2rem !important;
        }
        div.page-break {page-break-after: always;}
        @media print {
            div.page-break {page-break-after: always;}
        }
        .text-center {
            text-align: center;
        }
        .heading * {
            margin: 0;
        }
        .heading img {
            float: left;
            margin-left: 0.8cm;
        }
    </style>
</head>
<body>    
    <div class="main-content" id="panel">
        <!-- Page content -->
        <div class="container-fluid mt--6">
            @yield('page_content')
        </div>
    </div>

    @yield('optional_scripts')
    <script src="{{ asset('assets/js/argon.js?v=1.1.0') }}"></script>
    @yield('custom_script')
</body>
</html>
