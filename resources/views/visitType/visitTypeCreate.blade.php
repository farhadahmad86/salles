@extends('layouts.app')
@section('styles')
@endsection
@section('content')
    <div class="card">
        <div class="card-header">Add Visit Type</div>
        <div class="card-body">
            <form action="{{ route('visitTypeStore') }}" method="post" id="visitType">
                @csrf
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Visit Type<span style="color: red">*</span></label>
                            <input type="text" class="form-control form-control-sm" autocomplete="off" name="visitType"
                                placeholder="Add Visit Type">
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
@endsection


@section('javascript')
    <script>
        $('.date').datepicker({
            dateFormat: 'yy-mm-dd'
        });

        $('document').ready(function() {
            $('#visitType').validate({
                rules: {
                    visitType: {
                        required: true,
                        minlength: 3,
                        maxlength: 50,
                    },
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
    </script>
@endsection
