@extends('layouts/app')
@section('styles')
    <style>
        .select2.select2-container {
            width: 100% !important;
        }
    </style>
@endsection
@section('content')
    <form class="prnt_lst_frm" action="{{ route('product_price_update') }}">
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
                <select id="product_category" class="form-control form-control-sm advance_search" name="product_category">
                    <option selected value="0">All</option>
                    @foreach ($all_product_category as $item)
                        <option value="{{ $item->cat_id }}" {{ $item->cat_id == $product_category ? 'selected' : '' }}>
                            {{ $item->cat_category }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label for="">Product</label>
                <select id="product" class="form-control form-control-sm advance_search" name="product">
                    <option selected value="0">All</option>
                    @foreach ($all_product as $item)
                        <option value="{{ $item->id }}" {{ $item->id == $product ? 'selected' : '' }}>
                            {{ $item->product_name }}</option>
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
            {{-- <div class="col-md-1">
                <label for="">From Date</label>
                <input type="text" name="from_date" class="form-control date advance_search form-control-sm"
                    value="{{ $from_date }}" id="from_date" placeholder="Choose..." autocomplete="off">
            </div>
            <div class="col-md-1">
                <label for="">To Date</label>
                <input type="text" name="to_date" class="form-control date advance_search form-control-sm"
                    value="{{ $to_date }}" id="to_date" placeholder="Choose..." autocomplete="off">
            </div> --}}
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
                    {{-- <button type="button" class="btn btn-secondary btn-sm" onclick="prnt_cus('pdf')">Print</button>
                    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button> --}}
                    {{-- <div class="dropdown-menu dropdown-menu-right print_act_drp hide_column" x-placement="bottom-end">
                        <button type="button" class="dropdown-item" id="" onclick="prnt_cus('download_pdf')">
                            <i class="fa fa-print"></i> Download PDF
                        </button>
                        <button type="button" class="dropdown-item" onclick="prnt_cus('download_excel')">
                            <i class="fa fa-file-excel-o"></i> Excel Sheet
                        </button>
                    </div> --}}
                    <div class="col-md-1"><a href="{{ route('product_price_update') }}" name="refresh" id="refresh"
                            class="btn btn-primary"><i class="fas fa-sync"></i></a></div>
                </div>
            </div>
        </div>
    </form>
    <div class="card mt-5">
        <div class="card-header">Product</div>
        <div class="card-body table-responsive">
            {{-- {{$count_row}} --}}
            @if ($count_row > 0)
                <form action="{{ route('update_product_price') }}" method="post" autocomplete="off">
                    @csrf
                    <table class="table" id="myTable">
                        <thead>
                            <tr>
                                <th onclick="sortTable(0)">#</th>
                                <th onclick="sortTable(1)">Product Group</th>
                                <th onclick="sortTable(1)">Product Category</th>
                                <th onclick="sortTable(1)">Product Name</th>
                                <th onclick="sortTable(3)">Bottom Price</th>
                                <th onclick="sortTable(2)">Sale</th>
                                {{--                <th onclick="sortTable(0)">Unit</th> --}}
                                <th onclick="sortTable(4)">Created By</th>
                                {{-- <th onclick="sortTable(5)">Created At</th>
                                @if (empty($type))
                                    <th>Actions</th>
                                @endif
                            </tr> --}}
                        </thead>
                        <tbody>
                            @foreach ($datas as $index => $info)
                                <tr>
                                    <input type="hidden" name="id[]" class="form-control"
                                        value="{{ $info->product_price_id }}" />
                                    <td>{{ $index }}</td>
                                    <td>{{ $info->product_group_name }}</td>
                                    <td>{{ $info->cat_category }}</td>
                                    <td>{{ $info->product_name }}</td>
                                    <td>
                                        <input type="text" name="purchase_price[]"
                                            id="purchase_price_{{ $info->id }}" oninput="validateNumberInput(this)"
                                            value="{{ $info->product_price_purchase }}">
                                    </td>
                                    <td>
                                        <input type="text" name="sale_price[]" id="sale_price_{{ $info->id }}"
                                            oninput="validateNumberInput(this)" value="{{ $info->product_price_sale }}">
                                    </td>
                                    <td>{{ $info->name }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if (empty($type))
                        <div class="m-2">
                            {{ $datas->appends(request()->except(['page', '_token']))->links() }}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col m-2">
                            <button type="submit" class="btn btn-sm btn-primary btn-top-m"
                                onclick="updatePrices({{ $info->id }})">Update Prices</button>
                        </div>
                    </div>
                </form>
            @else
                <h1 class="text-center">Data Not Found</h1>
            @endif
            {{-- @endsection --}}

        </div>
    </div>
@endsection


@section('javascript')
    <script>
        function validateNumberInput(input) {
            input.value = input.value.replace(/[^\d]/g, ''); // Allow only numeric values
        }
    </script>

    <script>
         $('document').ready(function() {
            $('#product_group').select2();
            $('#product_category').select2();
            $('#product').select2();
            $('#unit').select2();
            $('#created_by').select2();
        });
        $('.date').datepicker({
            dateFormat: 'yy-mm-dd'
        });

        var base = '{{ route('productPrice') }}',
            url;
        @include('print.print_script_sh')
    </script>
@endsection
