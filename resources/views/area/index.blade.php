@extends('layouts.app')
@section('styles')
@endsection
@section('content')
    <div class="card">
        <div class="card-header">Add Area</div>
        <div class="card-body">
            <form action="{{ route('storeArea') }}" method="post" id="area_form">
                @csrf
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Region<span style="color: red">*</span></label><span
                                class="float-right"><button type="button" class="btn btn-sm btn-primary fa fa-plus"
                                    data-toggle="modal" data-target="#area_add_region"></button></span>
                            <select name="region" id="area_region" class="form-control form-control-sm select2">
                                <option selected disabled hidden>Choose Region</option>
                                @foreach ($get_all_region as $db_region)
                                    <option value="{{ $db_region->region_id }}">{{ $db_region->reg_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Area<span style="color: red">*</span></label>
                            <input type="text" class="form-control form-control-sm" name="area">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Remarks</label>
                            <textarea name="area_remarks" class="form-control form-control-sm" cols="30" rows="1"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-2">
                        <button type="submit" class="btn btn-sm btn-primary btn-top-m">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{--    Area Modal --}}

    {{-- Area Add Region Modal --}}
    <div class="modal fade" id="area_add_region" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add Region</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    {{--                    <form action="" method="post"> --}}
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Region</label>
                                <input type="text" class="form-control form-control-sm" autocomplete="off"
                                    id="mod_add_area_region" name="mod_region">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Remarks</label>
                                <textarea name="mod_reg_remarks" id="mod_area_reg_remarks" class="form-control form-control-sm" cols="30"
                                    rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                    <button type="button" data-dismiss="modal" id="area_add_reg_submit"
                        class="btn btn-primary">Submit</button>
                    {{--                    </form> --}}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        $('.date').datepicker({
            dateFormat: 'yy-mm-dd'
        });

        var base = '{{ route('area') }}',
            url;
        @include('print.print_script_sh')

        $('document').ready(function() {
            $('#area_region').select2();
            $.validator.addMethod("letterandspace", function(value, element) {
                return this.optional(element) || /^[a-z\s]+$/i.test(value);
            }, "Only alphabetical characters");
            $('#area_form').validate({
                rules: {
                    region: {
                        required: true,
                    },
                    area: {
                        required: true,
                        // letterandspace: true,
                        // minlength: 3,
                        // maxlength: 30,
                    },
                    mod_reg_remarks: {
                        maxlength: 500,
                    }
                }
            });

            $('.dataTable').DataTable({ //datatable
                "scrollX": true,
                "paging": false,
                "searching": false,
                "info": false,
                "sScrollXInner": "100%",
            });
        });

        //Add Region on Area page
        $('#area_add_reg_submit').click(function() {
            var region = $('#mod_add_area_region').val();
            var region_remarks = $('#mod_area_reg_remarks').val();
            $.ajax({
                url: '{{ route('insert_region')}}',
                method: 'get',
                datatype: 'text',
                data: {
                    'region': region,
                    'region_remarks': region_remarks,
                },
                success: function(response) {
                    console.log(response);
                    $('#area_region').html(response);
                }
            })
        });
    </script>
@endsection
