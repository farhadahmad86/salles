@extends('layouts.app')
@section('styles')
    <!-- Fonts -->
    {{--    <link rel="dns-prefetch" href="//fonts.gstatic.com">--}}
    {{--    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">--}}
    <!-- Styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('Date-Time-Picker-Bootstrap-4/build/css/bootstrap-datetimepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/stylesheet.css') }}">
    {{--    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />--}}
    {{--    <link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
@endsection
@section('content')


    <div class="btn-group">
        <button type="button" class="btn btn-primary grp_btn" onclick="prnt_cus('pdf')">Print</button>
        <button type="button" class="btn btn-primary dropdown-toggle grp_btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="caret"></span>
            <span class="sr-only">Toggle Dropdown</span>
        </button>

        <div class="dropdown-menu dropdown-menu-right print_act_drp hide_column" x-placement="bottom-end">
            <button type="button" class="dropdown-item" id="" onclick="prnt_cus('download_pdf')">
                <i class="fa fa-print"></i> Download PDF
            </button>
            <button type="button" class="dropdown-item"  onclick="prnt_cus('download_excel')">
                <i class="fa fa-file-excel-o"></i> Excel Sheet
            </button>
        </div>
    </div>

{{--    <form class="prnt_lst_frm">--}}
{{--        <input type="text" name="companies" placeholder="Company Name" />--}}
{{--        <input type="text" name="created_by" placeholder="Created By" />--}}
{{--        <input type="text" name="visit_type" placeholder="Visit Type" />--}}
{{--        <input type="text" name="from" placeholder="Date From" />--}}
{{--        <input type="text" name="to" placeholder="Date To" />--}}
{{--    </form>--}}

    <table class="table">

        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Date</th>
            <th scope="col">Company</th>
            <th scope="col">Type of Visit</th>
            <th scope="col">Reminder Reason</th>
            <th scope="col">Schedule Status</th>
        </tr>
        </thead>
        <tbody>
        @forelse($datas as $key => $item)
            <tr>
                <td>{{($key+1)}}</td>
                <td>{{$item->date}}</td>
                <td>{{$item->company_id}}</td>
                <td>{{$item->type_of_visit}}</td>
                <td>{{$item->sch_reminder_reason}}</td>
                <td>{{$item->schedule_status}}</td>
            </tr>
        @empty
            <tr>
                <td colspan="11">
                    <center><h3 style="color:#554F4F">No Account Group</h3></center>
                </td>
            </tr>
        @endforelse
        </tbody>

    </table>

@endsection
@section('javascript')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    {{--    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.17.0/jquery.validate.min.js"></script>--}}
    {{--    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.17.0/additional-methods.min.js"></script>--}}
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('select2/dist/js/select2.full.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.12.0/moment.js"></script>
    <script src="{{asset('Date-Time-Picker-Bootstrap-4/build/js/bootstrap-datetimepicker.min.js')}}"></script>
    {{--    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>--}}
    {{--    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>--}}
    {{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>--}}
    {{--    <script src="{{ asset('js/js.js') }}"></script>--}}
    <script type="text/javascript">
        var base = '{{ route('pdf') }}',url;
        @include('print.print_script_sh')
    </script>
@endsection