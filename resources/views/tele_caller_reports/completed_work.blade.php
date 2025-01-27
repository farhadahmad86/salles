@extends('layouts.app')
@section('styles')
@endsection
@section('content')
    <form id="filter-form">
        <div class="row">
            <div class="col-md-2">
                <label for="">Choose Role</label>
                <select name="role" id="role" class="form-control form-control-sm">
                    <option selected hidden disabled>Choose...</option>
                    @if ($auth->role == 'Admin')
                        <option value="Admin">Admin</option>
                    @endif
                    <option value="Supervisor">Supervisor</option>
                    <option value="Sale Person">Sale Person</option>
                </select>
            </div>
            <div class="col-md-2">
                <label for="">Choose User</label>
                <select name="user" class="form-control form-control-sm" id="users">
                    <option value="">All</option>
                </select>
            </div>
            <div class="col-md-2">
                <label for="">Choose Table</label>
                <select name="table" id="user_table" class="form-control form-control-sm">
                    <option selected hidden disabled>Choose...</option>
                    <option value="schedule">Schedule</option>
                    <option value="funnel">Funnel</option>
                    <option value="invoice">Quotation</option>
                    <option value="order">Order</option>
                </select>
            </div>
            <div class="col-md-2">
                <label for="">From Date</label>
                <input type="text" name="from_date" class="form-control date form-control-sm" id="from_date"
                    placeholder="Choose...">
            </div>
            <div class="col-md-2">
                <label for="">To Date</label>
                <input type="text" class="form-control date form-control-sm" placeholder="Choose..." name="to_date"
                    id="to_date">
            </div>
            <div class="col-md-1" style="margin-top: 30px">
                <button name="filter" id="filter" class="btn btn-primary btn-sm" onclick="filter()">Filter</button>
            </div>
            {{--        <div class="col-md-1" style="margin-top: 30px"> --}}
            {{--            <button id="refresh" class="fa fa-refresh form-control form-control-sm"></button> --}}
            {{--        </div> --}}
        </div>
    </form>
    <div class="card mt-4">
        <div class="card-header">Completed Work Report</div>
        <div class="card-body table-responsive">
            <h3 class="text-center" id="table_text">No Data</h3>
            <table class="table dataTable" id="myTable" width="100%" style="display: none">

            </table>
        </div>
    </div>

    {{--    Modal --}}

    <div class="modal fade my_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Reminder</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Choose Date</label>
                                <input type="text" class="form-control datetime" placeholder="Choose Date"
                                    id="reminder_date" name="reminder_date" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Response</label>
                                <select name="reminder_reason" id="reminder_reason" class="form-control">
                                    <option disabled hidden selected>Choose...</option>
                                    <option value="self_reminder">Self Reminder</option>
                                    <option value="kem_reminder">KAM Reminder</option>
                                    <option value="no_response">No Response</option>
                                    <option value="close_reminder">Close</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Remarks</label>
                                <textarea name="reminder_remarks" class="form-control" cols="30" rows="5" id="reminder_remarks"></textarea>
                            </div>
                        </div>
                        <input type="hidden" name="reminder_row_id" value="" id="reminder_row_id">
                        <input type="hidden" name="reminder_for_id" value="" id="reminder_for_id">
                    </div>
                    <input type="submit" class="btn btn-primary" data-dismiss="modal" value="Submit"
                        id="add_reminder">
                </div>
            </div>
        </div>
    </div>


    {{-- Total Schedule Target --}}
    {{--    <div class="modal fade total_sch_target" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true"> --}}
    {{--        <div class="modal-dialog modal-lg modal-dialog-centered" role="document"> --}}
    {{--            <div class="modal-content"> --}}
    {{--                <div class="modal-header"> --}}
    {{--                    <h5 class="modal-title" id="exampleModalLongTitle">Visit Targets (<span class="show_name"></span>)</h5> --}}
    {{--                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> --}}
    {{--                        <span aria-hidden="true">&times;</span> --}}
    {{--                    </button> --}}
    {{--                </div> --}}
    {{--                <div class="modal-body"> --}}
    {{--                    <table class="table" id="myTable" width="100%"> --}}
    {{--                        <thead> --}}
    {{--                        <tr> --}}
    {{--                            <th>Date</th> --}}
    {{--                            <th>Company</th> --}}
    {{--                            <th>Visit Type</th> --}}
    {{--                            <th>Status</th> --}}
    {{--                            <th>Created At</th> --}}
    {{--                        </tr> --}}
    {{--                        </thead> --}}
    {{--                        <tbody class="insert_sch_targets"> --}}
    {{--                        </tbody> --}}
    {{--                    </table> --}}
    {{--                </div> --}}
    {{--                <div class="modal-footer"> --}}
    {{--                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
    {{--                </div> --}}
    {{--            </div> --}}
    {{--        </div> --}}
    {{--    </div> --}}
@endsection

@section('javascript')
    <script>
        $('.date').datepicker({
            dateFormat: 'yy-mm-dd'
        });

        $('.datetime').datetimepicker({
            minDate: new Date(),
            format: 'DD-MM-YYYY HH:mm:ss'
        });

        $(document).ready(function() {
            $('#role').select2();
            $('#users').select2();
            $('#user_table').select2();
            $('#filter-form').validate({
                rules: {
                    role: {
                        required: true,
                    },
                    // Corrected selector to use the id "users"
                    'users': {
                        required: true,
                    },
                    table: {
                        required: true,
                    },
                },
                messages: {
                    role: {
                        required: "Please select a role.",
                    },
                    // You can add custom error messages for each field here
                    users: {
                        required: "Please select a user.",
                    },
                    table: {
                        required: "Please select a table.",
                    },
                },
                submitHandler: function(form) {
                    filter(); // Call your filter function when the form passes validation
                }
                // Add other options as needed
            });
            // get users after click on role
            $('#role').change(function() {
                var role = $('#role option:selected').val();
                $.ajax({
                    url: 'role',
                    method: 'post',
                    datatype: 'json',
                    data: {
                        _token: '{{ csrf_token() }}',
                        role: role,
                    },
                    success: function(data) {
                        $('#users').html(data.data);
                    },
                    error: function(XMLHttpRequest) {
                        console.log(XMLHttpRequest.responseJSON.message);
                    }
                })
            });

            // $('#refresh').click(function () {
            //     location.reload();
            // })

            // {{-- $(document).on('click', '.C_total_sch_target', function () { --}}
            // {{--    var user_id = $(this).attr('data-user_id'); --}}
            // {{--    var from_date = $(this).attr('data-from_date'); --}}
            // {{--    var to_date = $(this).attr('data-to_date'); --}}
            // {{--    // alert(user_id); --}}
            // {{--    // alert($(this).children().text()); --}}
            // {{--    $.ajax({ --}}
            // {{--        url: '{{route('total_sch_target')}}', --}}
            // {{--        method: 'get', --}}
            // {{--        datatype: 'json', --}}
            // {{--        data: {user_id: user_id, from_date: from_date, to_date: to_date}, --}}
            // {{--        success: function (data) { --}}
            // {{--            var i, total = data.total_targets.length, output = ''; --}}
            // {{--            for (i = 0; i < total; i++){ --}}
            // {{--                output += '<tr>'; --}}
            // {{--                output += '<td>'+data.total_targets[i].date+'</td>'; --}}
            // {{--                output += '<td>'+data.total_targets[i].company_name+'</td>'; --}}
            // {{--                output += '<td>'+data.total_targets[i].visit_type_name+'</td>'; --}}
            // {{--                if (data.total_targets[i].schedule_status == 'new'){ --}}
            // {{--                    output += '<td>New</td>'; --}}
            // {{--                } else if(data.total_targets[i].schedule_status == 'reSchedule'){ --}}
            // {{--                    output += '<td>Re Schedule</td>'; --}}
            // {{--                } --}}
            // {{--                // output += '<td>'+data.total_targets[i].schedule_status+'</td>'; --}}
            // {{--                output += '<td>'+data.total_targets[i].created_at+'</td>'; --}}
            // {{--                output += '</tr>'; --}}
            // {{--            } --}}
            // {{--            $('.insert_sch_targets').html(output); --}}
            // {{--            $('.show_name').html(data.total_targets[0].name); --}}
            // {{--        }, --}}
            // {{--        error: function (XMLHttpRequest, textStatus, errorThrown) { --}}
            // {{--            console.log(XMLHttpRequest.responseJSON.message); --}}
            // {{--        } --}}
            // {{--    }) --}}
            // {{-- }); --}}

        });

        function filter() {
            // $('#filter').click(function () {
            var role = $('#role option:selected').val();
            var user_id = $('#users option:selected').val();
            var user_table = $('#user_table option:selected').val();
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();
            $.ajax({
                url: "{{ route('completed_work_data') }}",
                method: 'get',
                dataType: 'json',
                data: {
                    _token: '{{ csrf_token() }}',
                    role: role,
                    user_id: user_id,
                    user_table: user_table,
                    from_date: from_date,
                    to_date: to_date,
                },
                success: function(data) {
                    console.log(data.table_data);
                    $('#myTable').html(data.table_data);
                },
                error: function(XMLHttpRequest) {
                    console.log(XMLHttpRequest.responseJSON.message);
                }
            })
            $('#myTable').show();
            $('#table_text').hide();
            // })
        }


        // $(document).on('click', '.my_reminder', function(){
        //     var reminder_row_id = $(this).data('reminder_row_id');
        //     var reminder_for_id = $(this).data('reminder_for_id');
        //     $('#reminder_date').val('');
        //     $('#reminder_reason').val('');
        //     $('#reminder_remarks').val('');
        //     $('#reminder_row_id').val(reminder_row_id);
        //     $('#reminder_for_id').val(reminder_for_id);
        // });

        {{-- $('#add_reminder').click(function () { --}}
        {{--    var reminder_date = $('#reminder_date').val(); --}}
        {{--    var reminder_reason = $('#reminder_reason').val(); --}}
        {{--    var reminder_remarks = $('#reminder_remarks').val(); --}}
        {{--    var reminder_row_id = $('#reminder_row_id').val(); --}}
        {{--    var reminder_for_id = $('#reminder_for_id').val(); --}}
        {{--    var reminder_table = $('#user_table option:selected').val(); --}}
        {{--    $.ajax({ --}}
        {{--        url: '{{route('add_reminder')}}', --}}
        {{--        method: 'post', --}}
        {{--        dataType: 'json', --}}
        {{--        data: { --}}
        {{--            _token: '{{csrf_token()}}', --}}
        {{--            reminder_date: reminder_date, --}}
        {{--            reminder_reason: reminder_reason, --}}
        {{--            reminder_remarks: reminder_remarks, --}}
        {{--            reminder_row_id: reminder_row_id, --}}
        {{--            reminder_for_id: reminder_for_id, --}}
        {{--            reminder_table: reminder_table --}}
        {{--        }, --}}
        {{--        success: function (data) { --}}
        {{--            console.log(data); --}}
        {{--        }, --}}
        {{--        error: function (XMLHttpRequest) { --}}
        {{--            console.log(XMLHttpRequest); --}}
        {{--        } --}}
        {{--    }); --}}
        {{--    filter(); --}}
        {{-- }) --}}
    </script>
@endsection
