@extends('layouts.app')
@section('styles')
<style>
    .select2.select2-container {
        width: 100% !important;
    }
</style>
@endsection

@section('content')
    <div class="card collapsed-card">
        <div class="card-header">
            <h3 class="card-title">Filters</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-search" style="color: black"></i></button>
            </div>
        </div>
        <div class="card-body">
            <form class="prnt_lst_frm" action="{{ route('category') }}">
                <div class="row">
                    <div class="col-md-2">
                        <label for="">Product Group</label>
                        <select id="product_group" class="form-control form-control-sm advance_search" name="product_group">
                            <option selected value="0">All</option>
                            @foreach ($all_product_group as $item)
                                <option value="{{ $item->product_group_id }}"
                                    {{ $item->product_group_id == $product_group ? 'selected' : '' }}>
                                    {{ $item->product_group_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="">Category</label>
                        <select id="product_category" class="form-control form-control-sm advance_search"
                            name="product_category">
                            <option selected value="0">All</option>
                            @foreach ($all_product_category as $item)
                                <option value="{{ $item->cat_id }}"
                                    {{ $item->cat_id == $product_category ? 'selected' : '' }}>{{ $item->cat_category }}
                                </option>
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
                    <div class="col-md-1">
                        <label for="">From Date</label>
                        <input type="text" name="from_date" class="form-control date advance_search form-control-sm"
                            value="{{ $from_date }}" id="from_date" placeholder="Choose..." autocomplete="off">
                    </div>
                    <div class="col-md-1">
                        <label for="">To Date</label>
                        <input type="text" name="to_date" class="form-control date advance_search form-control-sm"
                            value="{{ $to_date }}" id="to_date" placeholder="Choose..." autocomplete="off">
                    </div>
                    {{-- <div class="col-md-2">
                        <label for="">Search</label>
                        <input type="text" name="search" class="form-control form-control-sm advance_search"
                            id="search" value="{{ $search }}">
                    </div> --}}
                </div>
                <div class="row mt-3 mb-3">
                    <div class="filter_buttons">
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
                                </button> --}}
                            </div>
                            <div class="col-md-1"><a href="{{ route('category') }}" name="refresh" id="refresh"
                                    class="btn btn-primary"><i class="fas fa-sync"></i></a></div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header">All Product Categories</div>
        <div class="card-body table-responsive">
            @include('print.pages.p_product_category')
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        $('.date').datepicker({
            dateFormat: 'yy-mm-dd'
        });

        var base = '{{ route('category') }}',
            url;
        @include('print.print_script_sh')

        $('.dataTable').DataTable({ //datatable
            "scrollX": true,
            "paging": false,
            "searching": false,
            "info": false,
            "sScrollXInner": "100%",
        });
        $('document').ready(function() {
            $('#product_group').select2();
            $('#product_category').select2();
            $('#created_by').select2();
        });
    </script>
@endsection
