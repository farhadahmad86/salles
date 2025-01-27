@extends('layouts/app')
@section('styles')
    <style>
        #category-error {
            position: fixed;
            margin-top: 62px;
            margin-left: -64px;
        }
    </style>
@endsection
@section('content')
    <div class="card ">
        <div class="card-header">Create Funnel</div>
        <div class="card-body">
            <form action="{{ route('storeFunnel') }}" method="post" id="funnel_form">
                @csrf
                <div class="row">
                    <div class="col-md-1">
                        <div class="form-group">
                            <label for="">Date<span style="color: red">*</span></label>
                            <input type="text" name="date" id="date" class="form-control form-control-sm"
                                autocomplete="off" placeholder="Choose Date..." style="width: 103%" />
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Company<span style="color: red">*</span></label>
                            <select class="form-control form-control-sm" name="comp_id" id="myComp">
                                <option disabled hidden selected>Choose...</option>
                                @foreach ($comp_name as $name)
                                    <option value="{{ $name->id }}">{{ ucfirst($name->company_name) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group">
                            <label for="">OTC<span style="color: red">*</span></label>
                            <input type="text" class="form-control form-control-sm" id="" name="otc">
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group">
                            <label for="">MRC<span style="color: red">*</span></label>
                            <input type="text" class="form-control form-control-sm" id="" name="mrc">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Category<span style="color: red">*</span></label>
                            <select class="form-control form-control-sm select2" multiple="multiple" name="category[]"
                                data-placeholder="Choose Category" id="category">
                                @foreach ($category as $cat)
                                    <option value="{{ $cat->cat_id }}">{{ $cat->cat_category }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Category Remarks</label>
                            <textarea name="cat_remarks" class="form-control form-control-sm" id="" cols="30" rows="1"></textarea>
                        </div>
                    </div>
                    {{-- <div class="col-md-1">
                        <div class="form-group">
                            <label for="">Status<span style="color: red">*</span></label>
                            <select class="form-control form-control-sm" name="status">
                                <option disabled hidden selected>Choose...</option>
                                @foreach ($status as $sta)
                                    <option value="{{ $sta->sta_id }}">{{ $sta->sta_status }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div> --}}
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Status Remarks</label>
                            <textarea name="sta_remarks" id="" cols="30" rows="1" class="form-control form-control-sm"></textarea>
                        </div>
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-primary btn-sm float-right">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection


@section('javascript')
    <script>
        $('#date').datepicker({
            minDate: new Date(),
            dateFormat: 'dd-mm-yy'
        });
        $('document').ready(function() {
            $('#myComp').select2();
            $('#category').select2();
            $('#funnel_form').validate({
                ignore: [],
                rules: {
                    date: {
                        required: true,
                    },
                    comp_id: {
                        required: true,
                    },
                    poc: {
                        required: true,
                    },
                    offAdd: {
                        maxlength: 500,
                    },
                    status: {
                        required: true,
                    },
                    sta_remarks: {
                        maxlength: 500,
                    },
                    category: {
                        required: true,
                    },
                    cat_remarks: {
                        maxlength: 500,
                    },
                    potenCus: {
                        required: true,
                        digits: true,
                    },
                    mrc: {
                        required: true,
                        digits: true,
                    },
                    otc: {
                        required: true,
                        digits: true,
                    },
                    'category[]': {
                        required: true,
                    },
                }
            });
        });

        $('#mob').keyup(function() {
            $('#w_mob').val($(this).val());
        });

        // Show poc after click on company
        $('#myComp').change(function() {
            var value = $('#myComp option:selected').val();
            $.ajax({
                url: '/get_poc',
                method: 'GET',
                datatype: 'text',
                data: {
                    'value': value
                },
                success: function(response) {
                    console.log(response);
                    $('#poc').html(response);
                },
                error: function(XMLHttpRequest) {
                    console.log(XMLHttpRequest.responseText);
                }
            })
        });
    </script>
@endsection
