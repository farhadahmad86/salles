<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Jadeed Sales</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{--    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> --}}
    {{--    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"> --}}
    {{--    <link rel="stylesheet" href="{{ asset('Date-Time-Picker-Bootstrap-4/build/css/bootstrap-datetimepicker.min.css') }}"> --}}
    {{--    <link rel="stylesheet" href="{{asset('css/app.css')}}"> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://kit.fontawesome.com/4cdc277a61.css" crossorigin="anonymous">
    {{-- <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/5.1.2/collection/components/icon/icon.min.css"> --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/overlayscrollbars/1.12.0/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.0.5/css/adminlte.min.css">
    <link rel="stylesheet" href="{{ asset('css/stylesheet.css') }}">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css" />
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet">
    <style>
        .card-body {
            -ms-flex: 1 1 auto;
            flex: 1 1 auto;
            min-height: 1px;
            padding: 0.5px 1rem;
        }

        .form-check {
            padding-left: 2.25rem !important
        }

        .card-header {
            padding: 2px 20px;
            margin-bottom: 5px
        }

        .fa-file-pen {
            color: rgb(0, 61, 126) !important;
        }

        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        thead {
            background-color: #6C79E0;
            color: white;
        }



        tr:nth-child(even) {
            background-color: #dddddd;
        }

        .table td,
        .table th {
            padding: 0px 3px !important;
            vertical-align: top !important;
            border-top: 1px solid #dee2e6;
            font-size: 12px !important;
            border: 1px solid black;
            text-align: left;
            padding: 8px;
        }

        dl,
        ol,
        ul {
            margin-top: 0;
            margin-bottom: 0 !important;
        }

        .btn-info {
            font-size: 12px;
        }

        p {
            margin-top: 0;
            margin-bottom: 0rem;
        }

        .nav-link {
            padding: 4px;
        }

        .nav-item .has-treeview .nav-link {
            padding-left: 40px;
            padding: 1px;

        }

        .nav-icon {
            margin-left: 0.05rem;
            margin-right: 0.2rem;
            text-align: center;
            width: 1.6rem;
            font-size: 12px !important;
        }

        .nav-item {

            font-size: 12px
        }

        .main-sidebar {
            width: 225px;
        }

        .nav-sidebar .nav-header {
            font-size: 16px;
            padding: 0.5rem 2rem;
            background-color: #020276;
        }

        .nav-sidebar .nav-header:not(:first-of-type) {
            padding: 9px 2rem;
        }

        .nav-sidebar .nav-link>p>.right {
            top: 5px !important;
        }

        .main-sidebar {
            overflow-y: unset !important;
        }

        .child {
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 1%;
            border-top: 1px solid #4b545c;
        }

        .layout-fixed .brand-link {
            width: 225px !important;
        }

        .error {
            color: red !important;
            font-size: 12px !important;
        }

        .fa-search {
            color: black !important;
        }
        .w-5 {
            width: 2% !important;
        }

        .flex .items-center .justify-between,
        .flex-1 {
            display: none !important;
        }

        .leading-5 {
            margin-bottom: 8px !important;
        }

        .border {
            border: none !important;
        }
    </style>
    @yield('styles')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        @include('include.navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('include.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @include('include/messages')
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    @yield('content')
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->

        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">
            <strong>Copyright &copy; 2019-{{ date('Y') }} <a href="http://sales.csp.com.pk/">Sales
                    Force</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 1.0.0
            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script> --}}
    {{--    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script> --}}
    {{--    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script> --}}
    {{--    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> --}}
    {{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.12.0/moment.js"></script> --}}
    {{--    <script src="{{asset('Date-Time-Picker-Bootstrap-4/build/js/bootstrap-datetimepicker.min.js')}}"></script> --}}
    {{--    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script> --}}
    {{-- <script src="{{asset('js/app.js')}}"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-ui-monthpicker@1.0.3/jquery.ui.monthpicker.min.js"></script>
    <script src="https://kit.fontawesome.com/4cdc277a61.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.0.5/js/adminlte.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    {{-- <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.17.0/jquery.validate.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.17.0/additional-methods.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/overlayscrollbars/1.12.0/js/OverlayScrollbars.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('js/js.js') }}"></script>
    <!-- CDN -->
    <script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
    @yield('javascript')

</body>

</html>
