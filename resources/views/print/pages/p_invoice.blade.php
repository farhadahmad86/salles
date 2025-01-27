
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
            <th onclick="sortTable(1)">Quotation No</th>
            <th onclick="sortTable(2)">Date</th>
            <th onclick="sortTable(3)">Company</th>
            <th onclick="sortTable(4)">Grand Total</th>
            <th onclick="sortTable(5)">Created By</th>
            <th onclick="sortTable(6)">Created At</th>
            @if (empty($type))
                <?php
                if (Auth::user()->role != 'Tele Caller'){
                ?>
                <th>Action</th>
                <?php
                }else{
                ?>
                <th>Action</th>
                <?php
                }
                ?>
            @endif
        </tr>
        </thead>
        <tbody class="table_row">
        @foreach($datas as $key => $info)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$info->invoice_no}}</td>
                <td>{{$info->date}}</td>
                <td>{{$info->company_name}}</td>
                <td>{{$info->grand_total}}</td>
                <td>{{$info->name}}</td>
                <td>{{$info->created_at}}</td>
                @if (empty($type))
                    <td>
                    <div class="dropdown">
                        <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                            Action
                        </button>
                        <div class="dropdown-menu">
                            @if (Auth::user()->role != 'Tele Caller')
                            <a href="#" class="dropdown-item invoice_view_modal" data-toggle="modal" data-target=".invoice_modal_{{$info->invoice_id}}">View</a>
                                @if (count($reminder) > 0)
                                    @if ($info->invoice_user_id == Auth::user()->id)
                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target=".reminder_no_{{$info->invoice_id}}">Reminder</a>
                                    @endif
                                @endif
                            @else
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target=".remarks_no_{{$info->invoice_id}}">Remarks</a>
                            @endif
                            @if(\Illuminate\Support\Facades\Auth::user()->role == 'Admin')
                                <a href="/deleteInvoice?id={{$info->invoice_id}}" class="dropdown-item" onclick="return confirm('Are you to Delete this data?');">Delete</a>
                            @endif
                        </div>
                    </div>
                    </td>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>
        @if (empty($type))
            <div class="mt-4 float-right">
                {{ $datas->appends(request()->except(['page', '_token']))->links() }}
            </div>
        @endif
    @else
        <h1 class="text-center">Data Not Found</h1>
    @endif
@endsection

