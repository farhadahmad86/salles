@extends('layouts/app')
@section('styles')
<style>
    .select2.select2-container{
        width:100% !important;
    }
    </style>
@endsection
@section('content')

    {{--    <div class="row" id="schedule_title" style="display: none"> --}}
    {{--        <div class="col-md-12 title"> --}}
    {{--            <h1 class="text-center">Schedule Target</h1> --}}
    {{--        </div> --}}
    {{--    </div> --}}
    {{--    <div class="row" id="funnel_title" style="display: none"> --}}
    {{--        <div class="col-md-12 title"> --}}
    {{--            <h1 class="text-center">Funnel Target</h1> --}}
    {{--        </div> --}}
    {{--    </div> --}}
    {{--    <div class="row" id="quotation_title" style="display: none"> --}}
    {{--        <div class="col-md-12 title"> --}}
    {{--            <h1 class="text-center">Quotation Target</h1> --}}
    {{--        </div> --}}
    {{--    </div> --}}
    {{--    <div class="row" id="order_title" style="display: none"> --}}
    {{--        <div class="col-md-12 title"> --}}
    {{--            <h1 class="text-center">Order Target</h1> --}}
    {{--        </div> --}}
    {{--    </div> --}}

    <ul class="nav nav-tabs mt-4">
        <li class="nav-item">
            <a class="nav-link nav-link-color" style="background: #bcddff" id="schedule_link" href="#schedule"
                data-toggle="tab">Schedule</a>
        </li>
        <li class="nav-item">
            <a class="nav-link nav-link-color" id="funnel_link" href="#funnel" data-toggle="tab">Funnel</a>
        </li>
        <li class="nav-item">
            <a class="nav-link nav-link-color" id="quotation_link" href="#quotation" data-toggle="tab">Quotation</a>
        </li>
        <li class="nav-item">
            <a class="nav-link nav-link-color" id="order_link" href="#order" data-toggle="tab">Order</a>
        </li>
        <li class="nav-item">
            <a class="nav-link nav-link-color" id="product_group_link" href="#product_group" data-toggle="tab">Product
                Group</a>
        </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        {{--        SCHEDULE --}}
        <div id="schedule" class="tab-pane active">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-1" style="padding-right: 0px">
                            <div class="form-group">
                                <label for="">Date<span style="color: red">*</span></label>
                                <input type="text" class="form-control form-control-sm schedule_date date"
                                    placeholder="Choose..." autocomplete="off" name="schedule_date">
                            </div>
                        </div>
                        @if (Auth::user()->role != 'Supervisor')
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="">Role<span style="color: red">*</span></label>
                                    <select name="schedule_role" class="form-control form-control-sm" id="schedule_role">
                                        <option disabled selected hidden>Choose...</option>
                                        <option value="Supervisor">Supervisor</option>
                                        <option value="Sale Person">Sale Person</option>
                                    </select>
                                </div>
                            </div>
                        @endif
                        @if (Auth::user()->role == 'Admin')
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="">Name<span style="color: red">*</span></label>
                                    <select name="schedule_user_id" class="form-control form-control-sm"
                                        id="schedule_username">
                                        <option disabled selected hidden>Choose...</option>
                                    </select>
                                </div>
                            </div>
                        @else
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="">Name<span style="color: red">*</span></label>
                                    <select name="schedule_user_id" class="form-control form-control-sm"
                                        id="schedule_username">
                                        <option disabled selected hidden>Choose...</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endif
                        <input type="hidden" name="schedule_your_manager" id="schedule_your_manager">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Business Category<span style="color: red">*</span></label>
                                <select name="schedule_business_category" id="schedule_business_category"
                                    class="form-control form-control-sm">
                                    <option disabled selected hidden>Choose...</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Total Visits<span style="color: red">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="schedule_total_visits"
                                    name="schedule_total_visits">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Minimum New Visits<span style="color: red">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="schedule_min_new_visits"
                                    name="schedule_new_visits">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-2">
                            <button type="submit" class="btn btn-sm btn-primary btn-top-m" id="insert_schedule_target">Submit</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-5">
                <div class="card-header">Schedule Target</div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Username</th>
                                <th>Supervisor</th>
                                <th>Target By</th>
                                <th>Business Category</th>
                                <th>Total Visits</th>
                                <th>Minimum New Visits</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody id="schedule_targets">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{--        FUNNEL --}}
        <div id="funnel" class="tab-pane fade" style="padding-right: 0px">
            <div class="card mb-5">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-1">
                            <div class="form-group">
                                <label for="">Date<span style="color: red">*</span></label>
                                <input type="text" class="form-control form-control-sm funnel_date date"
                                    placeholder="Choose..." autocomplete="off" name="funnel_date">
                            </div>
                        </div>
                        @if (Auth::user()->role != 'Supervisor')
                            <div class="col-md-2">
                                <label for="">Role<span style="color: red">*</span></label>
                                <div class="form-group">
                                    <select name="funnel_role" class="form-control form-control-sm" id="funnel_role">
                                        <option disabled selected hidden>Choose...</option>
                                        <option value="Supervisor">Supervisor</option>
                                        <option value="Sale Person">Sale Person</option>
                                    </select>
                                </div>
                            </div>
                        @endif
                        @if (Auth::user()->role == 'Admin')
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="">Name<span style="color: red">*</span></label>
                                    <select name="schedule_user_id" class="form-control form-control-sm"
                                        id="funnel_username">
                                        <option disabled selected hidden>Choose...</option>
                                    </select>
                                </div>
                            </div>
                        @else
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="">Name<span style="color: red">*</span></label>
                                    <select name="schedule_user_id" class="form-control form-control-sm"
                                        id="funnel_username">
                                        <option disabled selected hidden>Choose...</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endif
                        <input type="hidden" name="funnel_your_manager" id="funnel_your_manager">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Product Category<span style="color: red">*</span></label>
                                <select name="funnel_product_category" id="funnel_product_category"
                                    class="form-control form-control-sm">
                                    <option disabled selected hidden>Choose...</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">OTC<span style="color: red">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="funnel_otc"
                                    name="funnel_otc">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">MRC<span style="color: red">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="funnel_mrc"
                                    name="funnel_mrc">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-2">
                            <button type="submit" class="btn btn-sm btn-primary btn-top-m" id="insert_funnel_target">Submit</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-5">
                <div class="card-header">Funnel Target</div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Username</th>
                                <th>Supervisor</th>
                                <th>Target By</th>
                                <th>Product Category</th>
                                <th>OTC</th>
                                <th>MRC</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody id="funnel_targets">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{--        QUOTATION --}}
        <div id="quotation" class="tab-pane fade">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-1">
                            <div class="form-group">
                                <label for="">Date<span style="color: red">*</span></label>
                                <input type="text" class="form-control form-control-sm quotation_date date"
                                    placeholder="Choose..." autocomplete="off" name="quotation_date">
                            </div>
                        </div>
                        @if (Auth::user()->role != 'Supervisor')
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="">Role<span style="color: red">*</span></label>
                                    <select name="quotation_role" class="form-control form-control-sm"
                                        id="quotation_role">
                                        <option disabled selected hidden>Choose...</option>
                                        <option value="Supervisor">Supervisor</option>
                                        <option value="Sale Person">Sale Person</option>
                                    </select>
                                </div>
                            </div>
                        @endif
                        @if (Auth::user()->role == 'Admin')
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="">Name<span style="color: red">*</span></label>
                                    <select name="schedule_user_id" class="form-control form-control-sm"
                                        id="quotation_username">
                                        <option disabled selected hidden>Choose...</option>
                                    </select>
                                </div>
                            </div>
                        @else
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="">Name<span style="color: red">*</span></label>
                                    <select name="schedule_user_id" class="form-control form-control-sm"
                                        id="quotation_username">
                                        <option disabled selected hidden>Choose...</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endif
                        <input type="hidden" name="quotation_your_manager" id="quotation_your_manager">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Product Category<span style="color: red">*</span></label>
                                <select name="quotation_product_category" id="quotation_product_category"
                                    class="form-control form-control-sm">
                                    <option disabled selected hidden>Choose...</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">OTC<span style="color: red">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="quotation_otc"
                                    name="quotation_otc">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">MRC<span style="color: red">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="quotation_mrc"
                                    name="quotation_mrc">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-2">
                            <button type="submit" class="btn btn-sm btn-primary btn-top-m" id="insert_quotation_target">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-5">
                <div class="card-header">Quotation Target</div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Username</th>
                                <th>Supervisor</th>
                                <th>Target By</th>
                                <th>Product Category</th>
                                <th>OTC</th>
                                <th>MRC</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody id="quotation_targets">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{--        ORDER --}}
        <div id="order" class="tab-pane fade">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-1">
                            <div class="form-group">
                                <label for="">Date<span style="color: red">*</span></label>
                                <input type="text" class="form-control form-control-sm order_date date"
                                    placeholder="Choose..." autocomplete="off" name="order_date">
                            </div>
                        </div>
                        @if (Auth::user()->role != 'Supervisor')
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="">Role<span style="color: red">*</span></label>
                                    <select name="order_role" class="form-control form-control-sm" id="order_role">
                                        <option disabled selected hidden>Choose...</option>
                                        <option value="Supervisor">Supervisor</option>
                                        <option value="Sale Person">Sale Person</option>
                                    </select>
                                </div>
                            </div>
                        @endif
                        @if (Auth::user()->role == 'Admin')
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="">Name<span style="color: red">*</span></label>
                                    <select name="schedule_user_id" class="form-control form-control-sm"
                                        id="order_username">
                                        <option disabled selected hidden>Choose...</option>
                                    </select>
                                </div>
                            </div>
                        @else
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="">Name<span style="color: red">*</span></label>
                                    <select name="schedule_user_id" class="form-control form-control-sm"
                                        id="order_username">
                                        <option disabled selected hidden>Choose...</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endif
                        <input type="hidden" name="order_your_manager" id="order_your_manager">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Product Category<span style="color: red">*</span></label>
                                <select name="order_product_category" id="order_product_category"
                                    class="form-control form-control-sm">
                                    <option disabled selected hidden>Choose...</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">OTC<span style="color: red">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="order_otc"
                                    name="order_otc">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">MRC<span style="color: red">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="order_mrc"
                                    name="order_mrc">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-2">
                            <button type="submit" class="btn btn-sm btn-primary btn-top-m" id="insert_order_target">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-5">
                <div class="card-header">Order Target</div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Username</th>
                                <th>Supervisor</th>
                                <th>Target By</th>
                                <th>Product Category</th>
                                <th>OTC</th>
                                <th>MRC</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody id="order_targets">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{--        PRODUCT GROUP --}}
        <div id="product_group" class="tab-pane fade">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-1">
                            <div class="form-group">
                                <label for="">Date<span style="color: red">*</span></label>
                                <input type="text" class="form-control form-control-sm product_group_date date"
                                    placeholder="Choose..." autocomplete="off" name="product_group_date">
                            </div>
                        </div>
                        @if (Auth::user()->role != 'Supervisor')
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="">Role<span style="color: red">*</span></label>
                                    <select name="product_group_role" class="form-control form-control-sm"
                                        id="product_group_role">
                                        <option disabled selected hidden>Choose...</option>
                                        <option value="Supervisor">Supervisor</option>
                                        <option value="Sale Person">Sale Person</option>
                                    </select>
                                </div>
                            </div>
                        @endif
                        @if (Auth::user()->role == 'Admin')
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="">Name<span style="color: red">*</span></label>
                                    <select name="product_group_user_id" class="form-control form-control-sm"
                                        id="product_group_username">
                                        <option disabled selected hidden>Choose...</option>
                                    </select>
                                </div>
                            </div>
                        @else
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="">Name<span style="color: red">*</span></label>
                                    <select name="product_group_user_id" class="form-control form-control-sm"
                                        id="product_group_username">
                                        <option disabled selected hidden>Choose...</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endif
                        <input type="hidden" name="product_group_your_manager" id="product_group_your_manager">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Product Group<span style="color: red">*</span></label>
                                <select name="product_group_id" id="product_group_id"
                                    class="form-control form-control-sm">
                                    <option disabled selected hidden>Choose...</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-2">
                            <button type="submit" class="btn btn-sm btn-primary btn-top-m" id="insert_product_group_target">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-5">
                <div class="card-header">Product Group Target</div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Username</th>
                                <th>Supervisor</th>
                                <th>Target By</th>
                                <th>Product Group</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody id="product_group_targets">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{--    <div class="card mt-5 mb-5">
            <div class="card-header">Create Target</div>
            <div class="card-body">
                <form action="{{route('storeTask')}}" method="post" id="task_form">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Date</label>
                                <input type="text" id="date" class="form-control form-control-sm" placeholder="Choose..." autocomplete="off" name="date">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Role</label>
                                <select name="role" class="form-control form-control-sm" id="role">
                                    <option disabled selected hidden>Choose...</option>
                                    <option value="Supervisor">Supervisor</option>
                                    <option value="Sale Person">Sale Person</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Username</label>
                                <select name="user_id" class="form-control form-control-sm" id="username">
                                    <option disabled selected hidden>Choose...</option>
                                </select>
                            </div>
                        </div>
                        <input type="hidden" name="your_manager" id="your_manager">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Total Visits</label>
                                <input type="text" class="form-control form-control-sm" name="total_visits">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Minimum New Visits</label>
                                <input type="text" class="form-control form-control-sm" name="new_visits">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Agreement Target</label>
                                <div class="row">
                                    <div class="col-md-6"><input type="text" class="form-control form-control-sm" name="otc" placeholder="OTC"></div>
                                    <div class="col-md-6"><input type="text" class="form-control form-control-sm" name="mrc" placeholder="MRC"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Quotation Target</label>
                                <input type="text" class="form-control form-control-sm" name="quotation">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Order Target</label>
                                <input type="text" class="form-control form-control-sm" name="order" autocomplete="off" id="username">
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary" style="margin-top: 31px">Submit</button>
                    </div>
                </form>
            </div>
        </div> --}}
@endsection


@section('javascript')
    <script>
        $('.date').datepicker({
            minDate: new Date(),
            dateFormat: 'dd-mm-yy'
        });
        $('document').ready(function() {
            // alert();
            $('#schedule_role').select2();
            $('#schedule_username').select2();
            $('#schedule_business_category').select2();

            $('#funnel_role').select2();
            $('#funnel_username').select2();
            $('#funnel_product_category').select2();

            $('#quotation_role').select2();
            $('#quotation_username').select2();
            $('#quotation_product_category').select2();

            $('#order_role').select2();
            $('#order_username').select2();
            $('#order_product_category').select2();

            $('#product_group_role').select2();
            $('#product_group_username').select2();
            $('#product_group_your_manager').select2();
            // $(function(){
            //     var dtToday = new Date();
            //
            //     var month = dtToday.getMonth() + 1;
            //     var day = dtToday.getDate();
            //     var year = dtToday.getFullYear();
            //     if(month < 10)
            //         month = '0' + month.toString();
            //     if(day < 10)
            //         day = '0' + day.toString();
            //
            //     var maxDate = year + '-' + month + '-' + day;
            //     $('.date').attr('min', maxDate);
            });

            // SCHEDULE

            $('#schedule_role').change(function() {
                // alert();///
                var role = $('#schedule_role option:selected').val();
                // alert(role);
                // console.log(role)
                $.ajax({
                    url: '{{ route('fetch_users') }}',
                    method: 'post',
                    datatype: 'json',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        role: role
                    },
                    success: function(data) {
                        console.log(data)

                        var i, output = '',
                            total = data.all_users.length;
                        output += '<option disabled selected hidden>Choose...</option>';
                        for (i = 0; i < total; i++) {
                            output += '<option value="' + data.all_users[i].id +
                                '" data-manager="' + data.all_users[i].supervisor + '">' + data
                                .all_users[i].name + '</option>';
                        }
                        $('#schedule_username').html(output);
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        console.log(XMLHttpRequest);
                        console.log(textStatus);
                        console.log(errorThrown);
                    }
                })
            });
            $('#schedule_username').change(function() {
                var your_manager = $('#schedule_username option:selected').data('manager');
                if (your_manager == undefined) {
                    your_manager = '{{ Auth::user()->id }}';
                }
                $('#schedule_your_manager').val(your_manager);
                var schedule_username = $('#schedule_username option:selected').val();
                $.ajax({
                    url: '{{ route('show_users_schedules')}}',
                    method: 'get',
                    datatype: 'json',
                    data: {
                        schedule_username: schedule_username,
                        your_manager: your_manager,
                    },
                    success: function(data) {
                        console.log(data);
                        if (data.schedule_targets == 0) {
                            // alert(1);
                            $('#schedule_targets').html('');
                        } else {
                            // alert(2);
                            $('#schedule_targets').html(data.schedule_targets);
                        }
                        if (data.business_category_options == 0) {
                            // alert(3);
                            $('#schedule_business_category').html('');
                        } else {
                            // alert(4);
                            $('#schedule_business_category').html(data
                                .business_category_options);
                        }
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        console.log(XMLHttpRequest.responseJSON.message);
                    }
                })
            });
            $('#insert_schedule_target').click(function() {
                var schedule_date = $('.schedule_date').val();
                var schedule_role = $('#schedule_role option:selected').val();
                var schedule_user_id = $('#schedule_username option:selected').val();
                var schedule_target_by = '{{ Auth::user()->id }}';
                var schedule_your_manager = $('#schedule_your_manager').val();
                var schedule_business_category_id = $('#schedule_business_category option:selected').val();
                var schedule_total_visits = $('#schedule_total_visits').val();
                var schedule_min_new_visits = $('#schedule_min_new_visits').val();
                if (schedule_date == '') {
                    $('.schedule_date').focus();
                    $('.schedule_date').css('background-color', '#80bdff');
                    return;
                }
                if (schedule_role == 'Choose...') {
                    $('#schedule_role').focus();
                    $('#schedule_role').css('background-color', '#80bdff');
                    return;
                }
                if (schedule_user_id == 'Choose...') {
                    $('#schedule_username').focus();
                    $('#schedule_username').css('background-color', '#80bdff');
                    return;
                }
                if (schedule_business_category_id == 'Choose...') {
                    $('#schedule_business_category').focus();
                    $('#schedule_business_category').css('background-color', '#80bdff');
                    return;
                }
                if (schedule_total_visits == '') {
                    $('#schedule_total_visits').focus();
                    $('#schedule_total_visits').css('background-color', '#80bdff');
                    return;
                }
                if (schedule_min_new_visits == '') {
                    $('#schedule_min_new_visits').focus();
                    $('#schedule_min_new_visits').css('background-color', '#80bdff');
                    return;
                }

                $.ajax({
                    url: '{{ route('schedule_target')}}',
                    method: 'get',
                    datatype: 'json',
                    data: {
                        'schedule_date': schedule_date,
                        'schedule_role': schedule_role,
                        'schedule_user_id': schedule_user_id,
                        'schedule_target_by': schedule_target_by,
                        'schedule_your_manager': schedule_your_manager,
                        'schedule_business_category_id': schedule_business_category_id,
                        'schedule_total_visits': schedule_total_visits,
                        'schedule_min_new_visits': schedule_min_new_visits,
                    },
                    success: function(data) {
                        console.log(data);
                        $('#schedule_targets').html(data.schedule_targets);
                        $('#schedule_business_category').html(data.business_category_options);
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        console.log(XMLHttpRequest.responseJSON.message);
                    }
                });
                $('#schedule_total_visits').val('');
                $('#schedule_min_new_visits').val('');
            });

            // FUNNEL
            $('#funnel_role').change(function() {
                var role = $('#funnel_role option:selected').val();
                $.ajax({
                    url: '{{ route('fetch_users') }}',
                    method: 'post',
                    datatype: 'json',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        role: role
                    },
                    success: function(data) {
                        var i, output = '',
                            total = data.all_users.length;
                        output += '<option disabled selected hidden>Choose...</option>';
                        for (i = 0; i < total; i++) {
                            output += '<option value="' + data.all_users[i].id +
                                '" data-manager="' + data.all_users[i].supervisor + '">' + data
                                .all_users[i].name + '</option>';
                        }
                        $('#funnel_username').html(output);
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        console.log(XMLHttpRequest.responseJSON.message);
                    }
                })
            });
            $('#funnel_username').change(function() {
                var your_manager = $('#funnel_username option:selected').data('manager');
                if (your_manager == undefined) {
                    your_manager = '{{ Auth::user()->id }}';
                }
                $('#funnel_your_manager').val(your_manager);
                var funnel_username = $('#funnel_username option:selected').val();
                $.ajax({
                    url: '{{ route('show_users_funnel')}}',
                    method: 'get',
                    datatype: 'json',
                    data: {
                        funnel_username: funnel_username,
                        your_manager: your_manager,
                    },
                    success: function(data) {
                        console.log(data);
                        if (data.funnel_targets == 0) {
                            $('#funnel_targets').html('');
                        } else {
                            $('#funnel_targets').html(data.funnel_targets);
                        }
                        if (data.product_category_options == 0) {
                            $('#funnel_product_category').html('');
                        } else {
                            $('#funnel_product_category').html(data.product_category_options);
                        }
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        console.log(XMLHttpRequest.responseJSON.message);
                    }
                })
            });
            $('#insert_funnel_target').click(function() {
                var funnel_date = $('.funnel_date').val();
                var funnel_role = $('#funnel_role option:selected').val();
                var funnel_user_id = $('#funnel_username option:selected').val();
                var funnel_target_by = '{{ Auth::user()->id }}';
                var funnel_your_manager = $('#funnel_your_manager').val();
                var funnel_product_category_id = $('#funnel_product_category option:selected').val();
                var funnel_otc = $('#funnel_otc').val();
                var funnel_mrc = $('#funnel_mrc').val();
                if (funnel_date == '') {
                    $('.funnel_date').focus();
                    $('.funnel_date').css('background-color', '#80bdff');
                    return;
                }
                if (funnel_role == 'Choose...') {
                    $('#funnel_role').focus();
                    $('#funnel_role').css('background-color', '#80bdff');
                    return;
                }
                if (funnel_user_id == 'Choose...') {
                    $('#funnel_username').focus();
                    $('#funnel_username').css('background-color', '#80bdff');
                    return;
                }
                if (funnel_product_category_id == 'Choose...') {
                    $('#funnel_product_category').focus();
                    $('#funnel_product_category').css('background-color', '#80bdff');
                    return;
                }
                if (funnel_otc == '') {
                    $('#funnel_otc').focus();
                    $('#funnel_otc').css('background-color', '#80bdff');
                    return;
                }
                if (funnel_mrc == '') {
                    $('#funnel_mrc').focus();
                    $('#funnel_mrc').css('background-color', '#80bdff');
                    return;
                }

                $.ajax({
                    url: '{{ route('show_funnel_target')}}',
                    method: 'get',
                    datatype: 'json',
                    data: {
                        'funnel_date': funnel_date,
                        'funnel_role': funnel_role,
                        'funnel_user_id': funnel_user_id,
                        'funnel_target_by': funnel_target_by,
                        'funnel_your_manager': funnel_your_manager,
                        'funnel_product_category_id': funnel_product_category_id,
                        'funnel_otc': funnel_otc,
                        'funnel_mrc': funnel_mrc,
                    },
                    success: function(data) {
                        console.log(data);
                        $('#funnel_targets').html(data.funnel_targets);
                        $('#funnel_product_category').html(data.product_category_options);
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        console.log(XMLHttpRequest.responseJSON.message);
                    }
                });
                $('#funnel_otc').val('');
                $('#funnel_mrc').val('');
            });

            // QUOTATION
            $('#quotation_role').change(function() {
                var role = $('#quotation_role option:selected').val();
                $.ajax({
                    url: '{{ route('fetch_users') }}',
                    method: 'post',
                    datatype: 'json',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        role: role
                    },
                    success: function(data) {
                        var i, output = '',
                            total = data.all_users.length;
                        output += '<option disabled selected hidden>Choose...</option>';
                        for (i = 0; i < total; i++) {
                            output += '<option value="' + data.all_users[i].id +
                                '" data-manager="' + data.all_users[i].supervisor + '">' + data
                                .all_users[i].name + '</option>';
                        }
                        $('#quotation_username').html(output);
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        console.log(XMLHttpRequest.responseJSON.message);
                    }
                })
            });
            $('#quotation_username').change(function() {
                var your_manager = $('#quotation_username option:selected').data('manager');
                if (your_manager == undefined) {
                    your_manager = '{{ Auth::user()->id }}';
                }
                $('#quotation_your_manager').val(your_manager);
                var quotation_username = $('#quotation_username option:selected').val();
                $.ajax({
                    url: '{{ route('show_users_quotation')}}',
                    method: 'get',
                    datatype: 'json',
                    data: {
                        quotation_username: quotation_username,
                        your_manager: your_manager,
                    },
                    success: function(data) {
                        console.log(data);
                        if (data.quotation_targets == 0) {
                            $('#quotation_targets').html('');
                        } else {
                            $('#quotation_targets').html(data.quotation_targets);
                        }
                        if (data.product_category_options == 0) {
                            $('#quotation_product_category').html('');
                        } else {
                            $('#quotation_product_category').html(data
                                .product_category_options);
                        }
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        console.log(XMLHttpRequest.responseJSON.message);
                    }
                })
            });
            $('#insert_quotation_target').click(function() {
                var quotation_date = $('.quotation_date').val();
                var quotation_role = $('#quotation_role option:selected').val();
                var quotation_user_id = $('#quotation_username option:selected').val();
                var quotation_target_by = '{{ Auth::user()->id }}';
                var quotation_your_manager = $('#quotation_your_manager').val();
                var quotation_product_category_id = $('#quotation_product_category option:selected').val();
                var quotation_otc = $('#quotation_otc').val();
                var quotation_mrc = $('#quotation_mrc').val();
                if (quotation_date == '') {
                    $('.quotation_date').focus();
                    $('.quotation_date').css('background-color', '#80bdff');
                    return;
                }
                if (quotation_role == 'Choose...') {
                    $('#quotation_role').focus();
                    $('#quotation_role').css('background-color', '#80bdff');
                    return;
                }
                if (quotation_user_id == 'Choose...') {
                    $('#quotation_username').focus();
                    $('#quotation_username').css('background-color', '#80bdff');
                    return;
                }
                if (quotation_product_category_id == 'Choose...') {
                    $('#quotation_product_category').focus();
                    $('#quotation_product_category').css('background-color', '#80bdff');
                    return;
                }
                if (quotation_otc == '') {
                    $('#quotation_otc').focus();
                    $('#quotation_otc').css('background-color', '#80bdff');
                    return;
                }
                if (quotation_mrc == '') {
                    $('#quotation_mrc').focus();
                    $('#quotation_mrc').css('background-color', '#80bdff');
                    return;
                }

                $.ajax({
                    url: '{{ route('show_quotation_target')}}',
                    method: 'get',
                    datatype: 'json',
                    data: {
                        'quotation_date': quotation_date,
                        'quotation_role': quotation_role,
                        'quotation_user_id': quotation_user_id,
                        'quotation_target_by': quotation_target_by,
                        'quotation_your_manager': quotation_your_manager,
                        'quotation_product_category_id': quotation_product_category_id,
                        'quotation_otc': quotation_otc,
                        'quotation_mrc': quotation_mrc,
                    },
                    success: function(data) {
                        $('#quotation_targets').html(data.quotation_targets);
                        $('#quotation_product_category').html(data.product_category_options);
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        console.log(XMLHttpRequest.responseJSON.message);
                    }
                });
                $('#quotation_otc').val('');
                $('#quotation_mrc').val('');
            });

            // ORDER
            $('#order_role').change(function() {
                var role = $('#order_role option:selected').val();
                $.ajax({
                    url: '{{ route('fetch_users') }}',
                    method: 'post',
                    datatype: 'json',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        role: role
                    },
                    success: function(data) {
                        var i, output = '',
                            total = data.all_users.length;
                        output += '<option disabled selected hidden>Choose...</option>';
                        for (i = 0; i < total; i++) {
                            output += '<option value="' + data.all_users[i].id +
                                '" data-manager="' + data.all_users[i].supervisor + '">' + data
                                .all_users[i].name + '</option>';
                        }
                        $('#order_username').html(output);
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        console.log(XMLHttpRequest.responseJSON.message);
                    }
                })
            });
            $('#order_username').change(function() {
                var your_manager = $('#order_username option:selected').data('manager');
                if (your_manager == undefined) {
                    your_manager = '{{ Auth::user()->id }}';
                }
                $('#order_your_manager').val(your_manager);
                var order_username = $('#order_username option:selected').val();
                $.ajax({
                    url: '{{ route('show_users_order')}}',
                    method: 'get',
                    datatype: 'json',
                    data: {
                        order_username: order_username,
                        your_manager: your_manager,
                    },
                    success: function(data) {
                        console.log(data);
                        if (data.order_targets == 0) {
                            $('#order_targets').html('');
                        } else {
                            $('#order_targets').html(data.order_targets);
                        }
                        if (data.product_category_options == 0) {
                            $('#order_product_category').html('');
                        } else {
                            $('#order_product_category').html(data.product_category_options);
                        }
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        console.log(XMLHttpRequest.responseJSON.message);
                    }
                })
            });
            $('#insert_order_target').click(function() {
                var order_date = $('.order_date').val();
                var order_role = $('#order_role option:selected').val();
                var order_user_id = $('#order_username option:selected').val();
                var order_target_by = '{{ Auth::user()->id }}';
                var order_your_manager = $('#order_your_manager').val();
                var order_product_category_id = $('#order_product_category option:selected').val();
                var order_otc = $('#order_otc').val();
                var order_mrc = $('#order_mrc').val();
                if (order_date == '') {
                    $('.order_date').focus();
                    $('.order_date').css('background-color', '#80bdff');
                    return;
                }
                if (order_role == 'Choose...') {
                    $('#order_role').focus();
                    $('#order_role').css('background-color', '#80bdff');
                    return;
                }
                if (order_user_id == 'Choose...') {
                    $('#order_username').focus();
                    $('#order_username').css('background-color', '#80bdff');
                    return;
                }
                if (order_product_category_id == 'Choose...') {
                    $('#order_product_category').focus();
                    $('#order_product_category').css('background-color', '#80bdff');
                    return;
                }
                if (order_otc == '') {
                    $('#order_otc').focus();
                    $('#order_otc').css('background-color', '#80bdff');
                    return;
                }
                if (order_mrc == '') {
                    $('#order_mrc').focus();
                    $('#order_mrc').css('background-color', '#80bdff');
                    return;
                }

                $.ajax({
                    url: '{{ route('show_order_target')}}',
                    method: 'get',
                    datatype: 'json',
                    data: {
                        'order_date': order_date,
                        'order_role': order_role,
                        'order_user_id': order_user_id,
                        'order_target_by': order_target_by,
                        'order_your_manager': order_your_manager,
                        'order_product_category_id': order_product_category_id,
                        'order_otc': order_otc,
                        'order_mrc': order_mrc,
                    },
                    success: function(data) {
                        $('#order_targets').html(data.order_targets);
                        $('#order_product_category').html(data.product_category_options)
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        console.log(XMLHttpRequest.responseJSON.message);
                    }
                });
                $('#order_otc').val('');
                $('#order_mrc').val('');
            });

            // PRODUCT GROUP
            $('#product_group_role').change(function() {
                var role = $('#product_group_role option:selected').val();
                $.ajax({
                    url: '{{ route('fetch_users') }}',
                    method: 'post',
                    datatype: 'json',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        role: role
                    },
                    success: function(data) {
                        var i, output = '',
                            total = data.all_users.length;
                        output += '<option disabled selected hidden>Choose...</option>';
                        for (i = 0; i < total; i++) {
                            output += '<option value="' + data.all_users[i].id +
                                '" data-manager="' + data.all_users[i].supervisor + '">' + data
                                .all_users[i].name + '</option>';
                        }
                        $('#product_group_username').html(output);
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        console.log(XMLHttpRequest.responseJSON.message);
                    }
                })
            });
            $('#product_group_username').change(function() {
                var your_manager = $('#product_group_username option:selected').data('manager');
                if (your_manager == undefined) {
                    your_manager = '{{ Auth::user()->id }}';
                }
                $('#product_group_your_manager').val(your_manager);
                var product_group_username = $('#product_group_username option:selected').val();
                $.ajax({
                    url: '{{ route('show_users_product_group')}}',
                    method: 'get',
                    datatype: 'json',
                    data: {
                        product_group_username: product_group_username,
                        your_manager: your_manager,
                    },
                    success: function(data) {
                        console.log(data);
                        if (data.product_group_targets == 0) {
                            $('#product_group_targets').html('');
                        } else {
                            $('#product_group_targets').html(data.product_group_targets);
                        }
                        if (data.product_group_options == 0) {
                            $('#product_group_id').html('');
                        } else {
                            $('#product_group_id').html(data.product_group_options);
                        }
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        console.log(XMLHttpRequest.responseJSON.message);
                    }
                })
            });
            $('#insert_product_group_target').click(function() {
                var product_group_date = $('.product_group_date').val();
                var product_group_role = $('#product_group_role option:selected').val();
                var product_group_user_id = $('#product_group_username option:selected').val();
                var product_group_target_by = '{{ Auth::user()->id }}';
                var product_group_your_manager = $('#product_group_your_manager').val();
                var product_group_id = $('#product_group_id option:selected').val();
                if (product_group_date == '') {
                    $('.product_group_date').focus();
                    $('.product_group_date').css('background-color', '#80bdff');
                    return;
                }
                if (product_group_role == 'Choose...') {
                    $('#product_group_role').focus();
                    $('#product_group_role').css('background-color', '#80bdff');
                    return;
                }
                if (product_group_user_id == 'Choose...') {
                    $('#product_group_username').focus();
                    $('#product_group_username').css('background-color', '#80bdff');
                    return;
                }
                if (product_group_id == 'Choose...') {
                    $('#product_group_id').focus();
                    $('#product_group_id').css('background-color', '#80bdff');
                    return;
                }

                $.ajax({
                    url: '{{ route('show_product_group_target')}}',
                    method: 'get',
                    datatype: 'json',
                    data: {
                        'product_group_date': product_group_date,
                        'product_group_role': product_group_role,
                        'product_group_user_id': product_group_user_id,
                        'product_group_target_by': product_group_target_by,
                        'product_group_your_manager': product_group_your_manager,
                        'product_group_id': product_group_id,
                    },
                    success: function(data) {
                        console.log(data)
                        $('#product_group_targets').html(data.product_groups_targets);
                        $('#product_group_id').html(data.product_groups_options)
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        console.log(XMLHttpRequest.responseJSON.message);
                    }
                });
            });
        // });

        // ACTIVE TABS
        $(".nav-tabs a").click(function() {
            $(this).tab('show');
            $('.nav-link-color').each(function() {
                if ($(this).hasClass('active')) {
                    $(this).css('background', '#bcddff');
                } else {
                    $(this).css('background', '');
                }
            })
        });

        // if($(document).attr('href', 'createTarget#schedule')){
        //     $('#schedule_title').show();
        // }
        // $('#schedule_link').click(function () {
        //     if ($(this).attr('href', 'createTarget#schedule')){
        //         $('#funnel_title').hide();
        //         $('#order_title').hide();
        //         $('#quotation_title').hide();
        //         $('#schedule_title').show();
        //     }
        // })
        // $('#funnel_link').click(function () {
        //     if ($(this).attr('href', 'createTarget#funnel')){
        //         $('#schedule_title').hide();
        //         $('#order_title').hide();
        //         $('#quotation_title').hide();
        //         $('#funnel_title').show();
        //     }
        // })
        // $('#quotation_link').click(function () {
        //     if ($(this).attr('href', 'createTarget#quotation')){
        //         $('#schedule_title').hide();
        //         $('#funnel_title').hide();
        //         $('#order_title').hide();
        //         $('#quotation_title').show();
        //     }
        // })
        // $('#order_link').click(function () {
        //     if ($(this).attr('href', 'createTarget#order')){
        //         $('#schedule_title').hide();
        //         $('#funnel_title').hide();
        //         $('#quotation_title').hide();
        //         $('#order_title').show();
        //     }
        // })
    </script>
@endsection
