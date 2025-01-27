<!DOCTYPE HTML>
<html>
<head>

    <link rel="stylesheet" href='{{asset("public/css/print_main_style.css")}}' media="screen, print">

</head>
<body>

    <?php
    $business_profile = App\Models\BusinessProfile::find(1);
    ?>
    <table class="table border-0 table-sm p-0">
        <tr class="bg-transparent">
            <td class="wdth_50_prcnt p-0 border-0">
                <img src="{{ asset('public/storage/img/'.$business_profile->business_profile_logo) }}" alt="Company Logo" width="140" class="m-0 p-0" />
                <p class="invoice_para m-0 pt-0">
                    <b> Company Name: {{$business_profile->business_profile_name}} </b>
                </p>
                <p class="invoice_para adrs m-0 pt-0" title="">
                    <b> Address: {{$business_profile->business_profile_address}}</b>

                </p>
                <p class="invoice_para adrs mt-0 mb-10 pt-0">
                    <b> Search Filter: </b>
                    {!! (isset($srch_fltr) && !empty($srch_fltr)) ? implode(",",$srch_fltr) : 'N/A' !!}
                </p>
            </td>
            <td class="wdth_50_prcnt p-0 border-0 text-right align_right">
                <h4 class="invoice_hdng p-0 mb-3">
                    {{ (isset($pge_title) && !empty($pge_title)) ? $pge_title : 'N/A' }} Report
                </h4>
                <p class="invoice_para m-0 pt-0">
                    <b> Mobile #: {{$business_profile->business_profile_mobile_no}}</b>

                </p>
                <p class="invoice_para m-0 pt-0">
                    <b> PTCL #: {{$business_profile->business_profile_ptcl_no}}</b>

                </p>
                <p class="invoice_para m-0 pt-0">
                    <b> Email: {{$business_profile->business_profile_email}}</b>

                </p>
            </td>
        </tr>
    </table>


</body>
</html>