
@extends('layouts.app')
@section('styles')

@endsection
@section('content')
    <div class="card mt-4">
        <div class="card-header">Total Work</div>
        <div class="card-body">
            <table class="table" id="myTable">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Companies</th>
                    <th>Date</th>
                    <th>Visit Type</th>
                    <th>Created By</th>
                    <th>Remarks</th>
                    <th>Created At</th>
                </tr>
                </thead>
                <tbody>
                @foreach($sch as $key => $schedule)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$schedule->company_name}}</td>
                        <td>{{date('d-M-Y', strtotime($schedule->date))}}</td>
                        <td>{{$schedule->visit_type_name}}</td>
                        <td>{{$schedule->name}}</td>
                        <td>{{$schedule->sch_remarks}}</td>
                        <td>{{date('d-M-Y', strtotime($schedule->created_at))}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        $('.sch_datetime').datetimepicker({
            minDate: new Date(),
            format: 'YYYY-MM-DD HH:mm:ss'
        });
        // $('.date').datepicker({
        //     minDate: new Date(),
        //     dateFormat: 'dd-mm-yy'
        // });
    </script>
@endsection
