@extends('layouts/app')
@section('styles')
<style>
    .select2.select2-container {
        width: 100% !important;
    }
</style>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Filters</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-search" style="color: white"></i></button>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                @if (Auth::user()->role != 'Supervisor')
                    <div class="col-md-2">
                        <select name="role" id="funnel_role" class="form-control form-control-sm">
                            <option disabled selected hidden>Choose Role...</option>
                            <option value="Supervisor">Supervisor</option>
                            <option value="Sale Person">Sale Person</option>
                        </select>
                    </div>
                @endif
                <div class="col-md-2">
                    <select name="user" class="form-control form-control-sm" id="funnel_user">
                        @if (Auth::user()->role == 'Supervisor')
                            <option selected disabled hidden>Choose...</option>
                            @foreach ($sale_persons as $sale_person)
                                <option value="{{ $sale_person->id }}">{{ $sale_person->name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="col-md-2"><input type="text" name="from_date" class="form-control date form-control-sm"
                        id="from_date" readonly placeholder="Start Date"></div>
                <div class="col-md-2"><input type="text" class="form-control date form-control-sm" readonly
                        placeholder="End Date" name="to_date" id="to_date"></div>
                <div class="col-md-1"><button name="filter" id="filter"
                        class="btn btn-primary btn-sm float-right">Filter</button></div>
                <div class="col-md-1"><button name="filter" id="refresh" class="btn btn-primary"><i
                            class="fas fa-sync"></i></button></div>
            </div>
        </div>
    </div>
    <div class="card mt-4">
        <div class="card-header">Funnel Report</div>
        <div class="card-body table-responsive">
            <h3 class="text-center" id="table_text">No Data</h3>
            <table class="table table-bordered" id="myTable" width="100%" style="display: none">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Target OTC</th>
                        <th>Target MRC</th>
                        <th>Achieved OTC</th>
                        <th>Achieved MRC</th>
                        <th>Percentage</th>
                        <th>View</th>
                    </tr>
                </thead>
                <tbody class="funnel_target">
                </tbody>
            </table>
        </div>
    </div>

    {{--    Modal --}}
    {{-- Total Funnel Target --}}
    <div class="modal fade total_funnel_target" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Total Funnel Target (<span class="show_name"></span>)
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table" id="myTable" width="100%">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Company</th>
                                <th>OTC</th>
                                <th>MRC</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody class="insert_funnel_targets">
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        $('.date').datepicker({
            dateFormat: 'dd-mm-yy'
        });
        // get users after click on role
        $('#funnel_role').change(function() {
            var funnel_role = $('#funnel_role option:selected').val();
            $.ajax({
                url: 'showFunnelUsers',
                method: 'post',
                datatype: 'json',
                data: {
                    _token: '{{ csrf_token() }}',
                    funnel_role: funnel_role,
                },
                success: function(data) {
                    console.log(data);
                    $('#funnel_user').html(data.funnel_users);
                },
                error: function(XMLHttpRequest) {
                    console.log(XMLHttpRequest.responseJSON.message);
                }
            })
        });
        $('#filter').click(function() {
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();
            var user_id = $('#funnel_user').val();
            // alert(user_id);
            $.ajax({
                url: "{{ route('funnel_target') }}",
                method: 'get',
                dataType: 'json',
                data: {
                    from_date: from_date,
                    to_date: to_date,
                    user_id: user_id
                },
                success: function(data) {
                    if (data.hasOwnProperty('data')) {
                        if (data.data.length > 0) {
                            $('.funnel_target').html(data.data);
                        } else {
                            console.log(data)
                        }
                    } else {
                        var output = '';
                        output += '<tr>';
                        output += '<td>' + data.username.name.charAt(0).toUpperCase() + data.username
                            .name.slice(1) + '</td>';
                        output += '<td>' + data.total_targets.funnel_target_otc + '</td>';
                        output += '<td>' + data.total_targets.funnel_target_mrc + '</td>';
                        output += '<td>' + data.total_otc + '</td>';
                        output += '<td>' + data.total_mrc + '</td>';
                        output += '<td>' + parseInt(((parseInt(data.total_otc) + parseInt(data
                                .total_mrc)) / (parseInt(data.total_targets.funnel_target_otc) +
                                parseInt(data.total_targets.funnel_target_mrc)) * 100)) +
                            '&nbsp;<b>%</b></td>';
                        output +=
                            '<td><a class="C_total_funnel_target" data-toggle="modal" data-user_id="' +
                            user_id + '" data-from_date="' + from_date + '" data-to_date="' + to_date +
                            '" data-target=".total_funnel_target"><i class="fa-solid fa-eye"style="font-size:16px;color: rgb(50, 152, 195)"></i></a></td>';
                        output += '</tr>';
                        $('.funnel_target').html(output);
                    }
                },
                error: function(XMLHttpRequest) {
                    console.log(XMLHttpRequest.responseJSON.message);
                }
            });
            $('#myTable').show();
            $('#table_text').hide();
        });

        $('#refresh').click(function() {
            location.reload();
        });

        $(document).on('click', '.C_total_funnel_target', function() {
            var user_id = $(this).attr('data-user_id');
            var from_date = $(this).attr('data-from_date');
            var to_date = $(this).attr('data-to_date');
            $.ajax({
                url: '{{ route('total_funnel_target') }}',
                method: 'get',
                datatype: 'json',
                data: {
                    user_id: user_id,
                    from_date: from_date,
                    to_date: to_date
                },
                success: function(data) {
                    var i, total = data.total_targets.length,
                        output = '';
                    for (i = 0; i < total; i++) {
                        output += '<tr>';
                        output += '<td>' + data.total_targets[i].date + '</td>';
                        output += '<td>' + data.total_targets[i].company_name + '</td>';
                        output += '<td>' + data.total_targets[i].otc + '</td>';
                        output += '<td>' + data.total_targets[i].mrc + '</td>';
                        output += '<td>' + data.total_targets[i].created_at + '</td>';
                        output += '</tr>';
                    }
                    $('.insert_funnel_targets').html(output);
                    $('.show_name').html(data.total_targets[0].name);
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    console.log(XMLHttpRequest.responseJSON.message);
                }
            })
        })
        $('document').ready(function() {
            $('#funnel_role').select2();
            $('#funnel_user').select2();
        });
    </script>
@endsection
