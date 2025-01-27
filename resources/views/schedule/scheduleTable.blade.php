<table class="table dataTable" id="myTable">
    <thead>
    <tr>
        <th>#</th>
        <th>Companies</th>
        <th>Date</th>
        <th>Visit Type</th>
        <th>Created By</th>
        <th>Remarks</th>
        <th>Created At</th>
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
    </tr>
    </thead>
    <tbody id="table_row">
    @foreach($datas as $key => $schedule)
        <tr>
            {{--                        <td><abbr title="{{$schedule->comprofile_mobile_no}}">{{$schedule->company_name}}</abbr></td>--}}
            <td>{{$key+1}}</td>
            <td>{{$schedule->company_name}}</td>
            <td>{{date('d-M-Y', strtotime($schedule->date))}}</td>
            <td>{{$schedule->visit_type_name}}</td>
            <td>{{$schedule->name}}</td>
            <td>{{$schedule->sch_remarks}}</td>
            <td>{{date('d-M-Y', strtotime($schedule->created_at))}}</td>
            <td>
                <div class="dropdown">
                    <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                        Action
                    </button>
                    <div class="dropdown-menu">
                        <?php
                        if (Auth::user()->role != 'Tele Caller'){
                        ?>
                        <a href="{{Route('schedule_edit', 'id='.$schedule->schId)}}" class="dropdown-item">Edit</a>
                        <a href="{{Route('schedule_delete', ['id' => $schedule->schId, 'comp_id' => $schedule->compId])}}" onclick="return confirm('Are you to Delete this data?');" class="dropdown-item">Delete</a>
                        @if (count($reminder) > 0)
                            @if ($schedule->sch_user_id == Auth::user()->id)
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target=".reminder_no_{{$schedule->schId}}">Reminder</a>
                            @endif
                        @endif
                        <?php
                        }else{
                        ?>
{{--                                        @if ($schedule->sch_reminder_reason != null)--}}
{{--                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target=".has_reminder_{{$schedule->schId}}">Reminder <span class="fa fa-check" style="color: #00ff80"></span></a>--}}
{{--                                            @else--}}
{{--                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target=".reminder_no_{{$schedule->schId}}">Reminder</a>--}}
{{--                                        @endif--}}
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target=".remarks_no_{{$schedule->schId}}">Remarks</a>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </td>
        </tr>
    @endforeach
    <tr>
        <td colspan="10">
            <div class="mt-4 float-right">
                {{ $datas->appends(request()->except(['page', '_token']))->links() }}
            </div>
        </td>
    </tr>
    </tbody>
</table>
