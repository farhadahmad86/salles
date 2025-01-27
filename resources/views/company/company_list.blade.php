@extends('layouts.app')
<style>
    .select2.select2-container {
        width: 100% !important;
    }
</style>

@section('content')
    <div class="card collapsed-card mt-2">
        {{-- <div class="card-header">
            <h3 class="card-title">Filters</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-search" style="color: black"></i></button>
            </div>
        </div> --}}
        <div class="card-body">
            {{-- <form class="prnt_lst_frm" action="{{ route('clients') }}">
                <div class="row">
                    <div class="col-md-2">
                        <label for="">Region</label>
                        <select id="region" class="form-control form-control-sm advance_search" name="region">
                            <option selected value="0">All</option>
                            @foreach ($all_region as $item)
                                <option value="{{ $item->region_id }}" {{ $item->region_id == $region ? 'selected' : '' }}>
                                    {{ $item->reg_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="">Area</label>
                        <select id="area" class="form-control form-control-sm advance_search" name="area">
                            <option selected value="0">All</option>
                            @foreach ($all_area as $item)
                                <option value="{{ $item->area_id }}" {{ $item->area_id == $area ? 'selected' : '' }}>
                                    {{ $item->area_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="">Sector</label>
                        <select id="sector" class="form-control form-control-sm advance_search" name="sector">
                            <option selected value="0">All</option>
                            @foreach ($all_sector as $item)
                                <option value="{{ $item->sector_id }}" {{ $item->sector_id == $sector ? 'selected' : '' }}>
                                    {{ $item->sec_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="">Town</label>
                        <select id="town" class="form-control form-control-sm advance_search" name="town">
                            <option selected value="0">All</option>
                            @foreach ($all_town as $item)
                                <option value="{{ $item->town_id }}" {{ $item->town_id == $town ? 'selected' : '' }}>
                                    {{ $item->town_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="">Business Category</label>
                        <select id="business_category" class="form-control form-control-sm advance_search"
                            name="business_category">
                            <option selected value="0">All</option>
                            @foreach ($all_business_category as $item)
                                <option value="{{ $item->business_category_id }}"
                                    {{ $item->business_category_id == $business_category ? 'selected' : '' }}>
                                    {{ $item->business_category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="">Companies</label>
                        <select id="companies" class="form-control form-control-sm advance_search" name="companies">
                            <option selected value="0">All</option>
                            @foreach ($all_companies as $item)
                                <option value="{{ $item->id }}" {{ $item->id == $companies ? 'selected' : '' }}>
                                    {{ $item->company_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="">Created By</label>
                        <select id="created_by" class="form-control form-control-sm advance_search" name="created_by">
                            <option selected value="0">All</option>
                            @foreach ($all_created_by as $item)
                                <option value="{{ $item->id }}" {{ $item->id == $created_by ? 'selected' : '' }}>
                                    {{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="">Status</label>
                        <select id="status" class="form-control form-control-sm advance_search" name="status">
                            <option selected value="">All</option>
                            <option value="1"{{ '1' == $status ? 'selected' : '' }}>Active</option>
                            <option value="0"{{ '0' == $status ? 'selected' : '' }}>Deactive</option>
                            {{-- @foreach ($all_created_by as $item)
                                <option value="{{ $item->id }}" {{ $item->id == $created_by ? 'selected' : '' }}>
                                    {{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-1">
                        <label for="">From Date</label>
                        <input type="text" name="from_date" class="form-control date advance_search form-control-sm"
                            value="{{ $from_date }}" id="from_date" placeholder="Choose...">
                    </div>
                    <div class="col-md-1">
                        <label for="">To Date</label>
                        <input type="text" name="to_date" class="form-control date advance_search form-control-sm"
                            value="{{ $to_date }}" id="to_date" placeholder="Choose...">
                    </div>
                    {{-- <div class="col-md-2">
                        <label for="">Search</label>
                        <input type="text" name="search" class="form-control form-control-sm advance_search"
                            id="search" value="{{ $search }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 btn-top-m mt-3">
                        <input type="submit" class="btn btn-primary btn-sm" value="Search">
                        <div class="btn-group">
                            <button type="button" class="btn btn-secondary btn-sm" onclick="prnt_cus('pdf')">Print</button>
                            <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown"
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
                                {{-- <button type="button" class="dropdown-item" onclick="prnt_cus('download_excel')">
                                    <i class="fa fa-file-excel-o"></i> Excel Sheet
                                </button>
                            </div>
                            <div class="col-md-1">
                                <a href="{{ route('clients') }}" name="refresh" id="refresh" class="btn btn-primary">
                                    <i class="fas fa-sync"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </form> --}}
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header">All Companies</div>
        <div class="card-body table-responsive">
            <table class="table" id="myTable">
                <thead>
                    <tr>
                        <th>Sr#</th>
                        <th>Company Name</th>
                        <th>Company Contact</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($query as $key => $brand)
                        <tr>
                            <td>{{ $key + $query->firstItem() }}</td>
                            <td>{{ $brand->nc_name }}</td>
                            <td>{{ $brand->nc_contact }}</td>
                            {{-- <td>{{$brand->mod_name}}</td> --}}
                            {{-- <td><a href="{{route('edit_Company',$brand->mod_id)}}"><i class="fas fa-edit"></i></a></td> --}}
                        </tr>
                    @endforeach


                </tbody>

            </table>

            <div class="m-2">
                {{ $query->appends(request()->except(['page', '_token']))->links() }}
            </div>
        </div>
    </div>
@endsection


@section('javascript')
    <script>
        $('.date').datepicker({
            dateFormat: 'yy-mm-dd'
        });

        var base = '{{ route('company_list') }}',
            url;
        @include('print.print_script_sh')

        // $(document).ready(function() {
        //     $('#region').select2();
        //     $('#area').select2();
        //     $('#sector').select2();
        //     $('#town').select2();
        //     $('#business_category').select2();
        //     $('#companies').select2();
        //     $('#created_by').select2();
        //     $('#status').select2();
        //     // $('.dataTable').DataTable({ //datatable
        //     //     "scrollX": true,
        //     //     "paging": false,
        //     //     "searching": false,
        //     //     "info": false,
        //     //     "sScrollXInner": "100%",
        //     // });
        // });
        // for Enabe Disable
        // $(function() {
        //     $('.toggle-class').change(function() {


        //         var status = $(this).prop('checked') == true ? 1 : 0;
        //         var company_id = $(this).data('id');
        //         $.ajax({
        //             type: "GET",
        //             dataType: "json",
        //             url: '/changeClientStatus',
        //             data: {
        //                 'status': status,
        //                 'company_id': company_id
        //             },
        //             success: function(data) {
        //                 console.log(data.success)
        //             }
        //         });
        //     })
        // });
    </script>
@endsection
