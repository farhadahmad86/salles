@extends('layouts/app')
@section('styles')
@endsection
@section('content')
    <div class="card collapsed-card">
        <div class="card-header">
            <h3 class="card-title">Filters</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-search" style="color: white"></i></button>
            </div>
        </div>
        <div class="card-body">
            <form class="prnt_lst_frm" action="{{ route('role') }}">
                <div class="row mt-4">
                    <div class="col-md-3">
                        <label for="">Name</label>
                        <select id="name" class="form-control form-control-sm advance_search" name="name">
                            <option selected value="0">All</option>
                            @foreach ($all_name as $item)
                                <option value="{{ $item->id }}" {{ $item->id == $name ? 'selected' : '' }}>
                                    {{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="">Role</label>
                        <select id="role" class="form-control form-control-sm advance_search" name="role">
                            <option selected value="0">All</option>
                            <option value="Supervisor">Supervisor</option>
                            <option value="Sale Person">Sale Person</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="">From Date</label>
                        <input type="text" name="from_date" class="form-control date advance_search form-control-sm"
                            value="{{ $from_date }}" id="from_date" placeholder="Choose...">
                    </div>
                    <div class="col-md-3">
                        <label for="">To Date</label>
                        <input type="text" name="to_date" class="form-control date advance_search form-control-sm"
                            value="{{ $to_date }}" id="to_date" placeholder="Choose...">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-3">
                        <label for="">Search</label>
                        <input type="text" name="search" class="form-control form-control-sm advance_search"
                            id="search" value="{{ $search }}">
                    </div>
                    <div class="col-md-1" style="margin-top: 31px">
                        <input type="submit" class="btn btn-primary btn-sm" value="Search">
                    </div>
                    <div class="offset-6 col-md-2 text-right">
                        <div class="btn-group btn-sm" style="margin-top: 24px">
                            <button type="button" class="btn btn-secondary grp_btn"
                                onclick="prnt_cus('pdf')">Print</button>
                            <button type="button" class="btn btn-secondary dropdown-toggle grp_btn" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>

                            <div class="dropdown-menu dropdown-menu-right print_act_drp hide_column"
                                x-placement="bottom-end">
                                <button type="button" class="dropdown-item" id=""
                                    onclick="prnt_cus('download_pdf')">
                                    <i class="fa fa-print"></i> Download PDF
                                </button>
                                <button type="button" class="dropdown-item" onclick="prnt_cus('download_excel')">
                                    <i class="fa fa-file-excel-o"></i> Excel Sheet
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card mt-4">
        <div class="card-header">Users</div>
        <div class="card-body table-responsive">
            @include('print.pages.p_role')
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        $('.date').datepicker({
            dateFormat: 'dd-mm-yy'
        });

        var base = '{{ route('user') }}',
            url;
        @include('print.print_script_sh')

        $(document).ready(function() {
            $('.dataTable').DataTable({ //datatable
                "scrollX": true,
                "paging": false,
                "searching": false,
                "info": false,
                "sScrollXInner": "100%",
            });
        })
    </script>
@endsection
