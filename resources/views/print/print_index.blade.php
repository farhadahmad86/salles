
@if( $type !== 'download_excel')
<!DOCTYPE html>
<html>
<head>

    @if (!empty($type))
        <link rel="stylesheet" href='{{asset("public/css/print_main_style.css")}}' media="screen, print">
        <link rel="stylesheet" href='{{asset("public/css/table_styles.css")}}' media="screen, print">
    @endif

    <title> @yield('print_title') </title>

{{--    <style type="text/css">--}}
{{--        @yield('print_styles')--}}
{{--    </style>--}}


</head>

<body>

@endif
        @yield('print_cntnt')

@if( isset($type) && $type !== 'download_excel')
        <table class="table border-0 m-0 p-0">
            <tfoot>
                <tr class="bg-transparent">
                    <td colspan="4" class="border-0 m-0 p-0">
                        <div class="page-footer-space"></div>
                    </td>
                </tr>
            </tfoot>
        </table>

        @if($type === 'print')
            <!-- Split button -->
            <div class="btns_bx">
                <div class="btn-group">
                    <button type="button" class="btn btn-primary grp_btn" onclick="prnt_cus('print')">Print</button>
                    <button type="button" class="btn btn-primary dropdown-toggle grp_btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right print_act_drp hide_column" x-placement="bottom-end">
                        <button type="button" class="dropdown-item" id="" onclick="prnt_cus()">
                            <i class="fa fa-print"></i> PDF
                        </button>
                        <button type="button" class="dropdown-item" id="excelTable">
                            <i class="fa fa-file-excel-o"></i> Excel
                        </button>
                    </div>
                </div>
            </div>

            <script type="text/javascript">

                function prnt_cus(str){
                    window.focus();
                    if( str === 'print') {
                        window.print();
                    }
                }

            </script>
        @endif


{{--    @yield('print_scrpt')--}}

</body>
</html>
@endif
