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
        <div class="card-header">Visit Remarks</div>
        <div class="card-body table-responsive">
            <h3 class="text-center" id="table_text">No Data</h3>
            <table class="table dataTable" id="myTable" width="100%" style="display: none">

            </table>
        </div>
    </div>
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

            $('#refresh').click(function() {
                location.reload();
            })

        });

        function filter() {
            // $('#filter').click(function () {
            var role = $('#role option:selected').val();
            var user_id = $('#users option:selected').val();
            var user_table = $('#user_table option:selected').val();
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();
            $.ajax({
                url: "{{ route('fetching_remarks') }}",
                method: 'post',
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
                    console.log(data);
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
    </script>
@endsection
