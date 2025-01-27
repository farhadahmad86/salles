
@extends('print.print_index')

@if( $type !== 'download_excel')
    @section('print_title', $pge_title)
@endif

@section('print_cntnt')
    @if ($count_row > 0)
    <table class="table" id="myTable">
        <thead>
        <tr>
            <th onclick="sortTable(0)">#</th>
            <th onclick="sortTable(1)">Reminder Date</th>
            <th onclick="sortTable(2)">Reminder For</th>
            <th onclick="sortTable(3)">Company</th>
            <th onclick="sortTable(4)">Visit Type</th>
            <th onclick="sortTable(5)">Reminder Remarks</th>
            <th onclick="sortTable(6)">Remarks For</th>
            <th onclick="sortTable(7)">Created By</th>
            <th onclick="sortTable(8)">Created Date</th>
        </tr>
        </thead>
        <tbody class="table_row">
        @foreach($datas as $key => $remarks)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{date('d-M-Y', strtotime($remarks->remarks_date))}}</td>
                <td>{{$remarks->users_remarks_for_name}}</td>
                <td>{{$remarks->company_name}}</td>
                <td>{{$remarks->visit_type_name}}</td>
                <td>{{$remarks->remarks_detail}}</td>
                <td>{{$remarks->remarks_for}}</td>
                <td>{{$remarks->user_id_name}}</td>
                <td>{{date('d-M-Y', strtotime($remarks->remarks_created_at))}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @if (empty($type))
    <div class="m-2">
            {{ $datas->appends(request()->except(['page', '_token']))->links() }}
        </div>
    @endif
    @else
        <h1 class="text-center">Data Not Found</h1>
    @endif
@endsection

