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
                    <th onclick="sortTable(1)">Companies</th>
                    <th onclick="sortTable(2)">Date</th>
                    <th onclick="sortTable(3)">Visit Type</th>
                    <th onclick="sortTable(4)">Created By</th>
                    <th onclick="sortTable(5)">Remarks</th>
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
            <tbody id="table_row">
                @foreach ($datas as $key => $schedule)
                    <tr>
                        <td>{{ $key + $datas->firstItem() }}</td>
                        <td>{{ $schedule->company_name }}</td>
                        {{--                <td>{{date('d-M-Y', strtotime($schedule->date))}}</td> --}}
                        <td>{{ $schedule->schedule_date }}</td>
                        <td>{{ $schedule->visit_type_name }}</td>
                        <td>{{ $schedule->name }}</td>
                        <td>{{ $schedule->sch_remarks }}</td>
                        <td>{{ date('d-M-Y', strtotime($schedule->schedule_created_at)) }}</td>
                        @if (empty($type))
                            <td>
                                {{-- <div class="dropdown">
                                    <button type="button" class="btn btn-primary btn-sm dropdown-toggle"
                                        data-toggle="dropdown">
                                        Action
                                    </button>
                                    <div class="dropdown-menu"> --}}
                                <?php
                                    if (Auth::user()->role != 'Tele Caller'){
                                    ?>
                                <a href="{{ Route('schedule_edit', 'id=' . $schedule->schId) }}" class=""><i
                                        class="fa-solid fa-file-pen" style="font-size:16px;color: gray"></i></a>
                                <a href="{{ Route('schedule_delete', ['id' => $schedule->schId, 'comp_id' => $schedule->compId]) }}"
                                    onclick="return confirm('Are you to Delete this data?');" class=""><i
                                        class="fa-sharp fa-solid fa-trash" style="font-size:16px;color: red"></i></a>
                                @if (count($reminder) > 0)
                                    @if ($schedule->sch_user_id == Auth::user()->id)
                                        <a class="" href="#" data-toggle="modal"
                                            data-target=".reminder_no_{{ $schedule->schId }}"><i class="fa-solid fa-bell"
                                                style="font-size:16px; color: #ffbb00 "></i></a>
                                    @endif
                                @endif
                                <?php
                                    }else{
                                    ?>
                                {{--                                        @if ($schedule->sch_reminder_reason != null) --}}
                                {{--                                            <a class="" href="#" data-toggle="modal" data-target=".has_reminder_{{$schedule->schId}}">Reminder <span class="fa fa-check" style="color: #00ff80"></span></a> --}}
                                {{--                                            @else --}}
                                {{--                                            <a class="" href="#" data-toggle="modal" data-target=".reminder_no_{{$schedule->schId}}">Reminder</a> --}}
                                {{--                                        @endif --}}
                                <a class="" href="#" data-toggle="modal"
                                    data-target=".remarks_no_{{ $schedule->schId }}"><i class="fa-brands fa-rocketchat"
                                        style="font-size:16px; color: #920CA4"></i></a>
                                <?php
                                    }
                                    ?>
                                </div>
                                </div>
                            </td>
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
