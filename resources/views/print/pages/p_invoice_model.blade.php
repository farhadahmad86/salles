
@extends('print.print_index')

@if( $type !== 'download_excel')
    @section('print_title', $pge_title)
@endif

@section('print_cntnt')
    <table class="table" id="myTable">
        <thead>
        <tr>
            <th onclick="sortTable(0)">#</th>
            <th onclick="sortTable(1)">Invoice No</th>
            <th onclick="sortTable(2)">Date</th>
            <th onclick="sortTable(3)">Company</th>
            <th onclick="sortTable(4)">Grand Total</th>
            <th onclick="sortTable(5)">Created By</th>
            <th onclick="sortTable(6)">Created At</th>
        </tr>
        </thead>
        <tbody class="table_row">
        @foreach($datas as $key=>$info)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$info->invoice_no}}</td>
                <td>{{$info->date}}</td>
                <td>{{$info->company_name}}</td>
                <td>{{$info->grand_total}}</td>
                <td>{{$info->name}}</td>
                <td>{{$info->created_at}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

