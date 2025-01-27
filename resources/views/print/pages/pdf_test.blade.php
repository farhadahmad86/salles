
@extends('print.print_index')

@if( $type !== 'download_excel')
    @section('print_title', $pge_title)
@endif

@section('print_cntnt')
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

