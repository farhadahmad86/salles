@extends('print.print_index')

@if ($type !== 'download_excel')
    @section('print_title', $pge_title_content)
@endif

@section('print_cntnt')
    @if ($count_row > 0)
        @if ($datas->isNotEmpty())
            @php $info = $datas->first(); @endphp
            {{ $info->version }}
            <div class="modal fade" id="invoice_modal_{{ $info->invoice_id }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" style="max-width: 90%" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Quotations</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body has_invoices">
                            <header class="header">
                                <div class="row">
                                    <div class="c-logo float-left">
                                        <img src="{{ asset('storage/img/' . $business_profile->business_profile_logo) }}">
                                    </div>
                                    <div class="purposal float-left text-center">
                                        <h1>Proposal</h1>
                                    </div>
                                    <div class="ref-date float-left">
                                        <p><b>Subject:</b> {{ $info->subject }}</p>
                                        <p><b>Version:</b> {{ $info->version }}</p>
                                        <p><b>Date:</b> <span class="border-dotted">{{ $info->inv_date }}</span></p>
                                    </div>
                                </div>
                            </header>
                            <section class="content">
                                <div class="row">
                                    <div class="width-50 float-left">
                                        <fieldset class="p-2 fieldset">
                                            <legend class="float-none w-auto p-2 legend">Seller Info</legend>
                                            <p><b>Company Name:</b> {{ $business_profile->business_profile_name }}</p>
                                            <p><b>Address:</b> {{ $info->address }}</p>
                                            <p><b>Contact #:</b> {{ $info->mob }}</p>
                                            <p><b>Prepared By:</b> {{ $info->name }}</p>
                                        </fieldset>
                                    </div>
                                    <div class="width-50 float-left">
                                        <fieldset class="p-2 fieldset">
                                            <legend class="float-none w-auto p-2 legend">Buyer Info</legend>
                                            <p><b>Company Name:</b> {{ $info->company_name }}</p>
                                            <p><b>P.O.C:</b> {{ $info->poc_name }}</p>
                                            <p><b>Contact #:</b> {{ $info->comp_mobile_no }}</p>
                                            <p><b>Email:</b> {{ $info->comp_email }}</p>
                                            <p><b>Subject Id:</b> {{ $info->unique_id }}</p>
                                        </fieldset>
                                    </div>
                                </div>
                            </section>
                            <table class="table" style="border-collapse:collapse; border:1px solid #dee2e6;">
                                <thead style="border-color:#dee2e6">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col" style="width: 70%">Item Description</th>
                                        <th scope="col">Qty</th>
                                        <th scope="col">UOM</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Total</th>
                                    </tr>
                                </thead>
                                <tbody class="invoice_view_table_row" style="border-color:#dee2e6">
                                    <!-- Here you should iterate over the items related to the current $info object -->
                                </tbody>
                            </table>
                            <div class="row">
                                <h3>Terms & Conditions</h3>
                                <div class="set_tandc"></div>
                            </div>
                            <h1 class="modal_dummy_data text-center mt-5 mb-5" style="display: none">No Data Found</h1>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <h1 class="text-center">Data Not Found</h1>
        @endif
    @endif
@endsection
