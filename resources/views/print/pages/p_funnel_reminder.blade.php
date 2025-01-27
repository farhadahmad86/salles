@extends('print.print_index')

@if ($type !== 'download_excel')
    @section('print_title', $pge_title)
@endif

@section('print_cntnt')
    @if ($count_row > 0)
        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th onclick="sortTable(0)">#</th>
                    <th onclick="sortTable(1)">Reminder Date</th>
                    <th onclick="sortTable(2)">Created For</th>
                    <th onclick="sortTable(3)">Company</th>
                    <th onclick="sortTable(4)">Reminder Remarks</th>
                    <th onclick="sortTable(5)">OTC</th>
                    <th onclick="sortTable(6)">MRC</th>
                    <th onclick="sortTable(7)">Status</th>
                    <th onclick="sortTable(8)">Created By</th>
                    <th onclick="sortTable(9)">Created Date</th>
                    @if (empty($type))
                        <th>Actions</th>
                    @endif
                </tr>
            </thead>
            <tbody class="table_row">
                @foreach ($datas as $key => $reminder)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ date('d-M-Y', strtotime($reminder->reminder_date)) }}</td>
                        <td>{{ $reminder->users_reminder_for_name }}</td>
                        <td>{{ $reminder->company_name }}</td>
                        <td>{{ $reminder->reminder_remarks }}</td>
                        <td>{{ $reminder->otc }}</td>
                        <td>{{ $reminder->mrc }}</td>
                        <td>{{ $reminder->sta_status }}</td>
                        <td>{{ $reminder->user_id_name }}</td>
                        <td>{{ date('d-M-Y', strtotime($reminder->reminder_created_at)) }}</td>
                        @if (empty($type))
                            @if ($reminder->reminder_reason == null)
                                <td style="text-align: center">
                                    {{-- <div class="dropdown">
                                    <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                                        Action
                                    </button>
                                    <div class="dropdown-menu"> --}}
                                    <a href="{{ route('delete_funnel_reminder', 'reminder_id=' . $reminder->reminder_id) }}"
                                        onclick="return confirm('Are you sure to Delete this data?');" class=""><i
                                            class="fa-sharp fa-solid fa-trash" style="font-size:16px;color: red"></i></a>
                                    {{-- </div>
                                    </div> --}}
                                </td>
                            @endif
                        @endif
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
