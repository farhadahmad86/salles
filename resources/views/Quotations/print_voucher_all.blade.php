<html>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Print Fees Voucher All</title>

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<script>
    window.print()
</script>
<style>
    @page {
        size: A4 portrait;
        margin: 0;
    }

    #home {
        size: 7in 9in;
        /* margin: 15mm 1mm 5mm 5mm; */
        float: left;
        margin: 0 5vh;
        min-height: 100vh;
        padding-top: 10px;

    }

    @font-face {
        font-family: 'SourceSansPro';
        font-style: normal;
        font-weight: normal;

    }

    .footer_urdu {
        width: 340px;
    }


    .FID_Title {
        font-family: inherit;
        font-weight: 500;
        line-height: 1.1;
        text-align: center;
        margin-top: 20px;
        background-color: #AAAAAA !important;
        -webkit-print-color-adjust: exact;
    }
</style>


<div class="row" style="">
    <div id="home">
        <div class="size col-xs-4" style="margin-top:12px;margin-left: 40px; border-right: 1px solid #000">
            <div class="row" id="logo-row">
                <div class="" style="float:left;">
                    <div style="margin-top: 4px; margin-left: 3px;">
                        <img style="height: 60px;" src="{{ asset('storage/img/download.jpg') }}" alt="Logo city">
                    </div>
                </div>
                <div class="" style="text-align: center; margin-top:10px;">
                    <h3><strong>City College</strong></h3>
                    <h4><strong>Jinnah Campus</strong></h4>
                    <h4><strong>STUDENT COPY</strong></h4>
                    <h5><strong>(CASH DEPOSIT SLIP)</strong></h5>
                </div>
            </div>
            <div class="row " style="margin-top: 1px">
                <table class="table">
                    <tbody style="border: 1px solid black;">
                        <tr>
                            <th class="th-1"> Issue Date</th>
                            <th class="th-1">29-Nov-2022</td>
                            </th>
                            <th class="th-1">Due Date
                            </th>
                            <th class="th-1">12-Dec-2022</td>

                            </th>
                        </tr>
                    </tbody>
                </table>

                <h2 class="FID_Title">FID: 349217</h2>

            </div>
            <div style="margin-bottom:10px;"></div>
            <div class="row">
                <p style="padding-left: 2.5%;"><strong>Account Title:</strong> <strong>City College of Science and
                        Commerce</strong> </p>
                <p style="padding-left: 2.5%;"><strong>Account#:</strong> <strong>0010060200620020</strong></p>
                <p style="padding-left: 2.5%;"><strong>Branch Code:</strong><strong>0752</strong></p>
                <p style="padding-left: 2.5%;"><strong>Branch Name:</strong><strong>Allied Bank Limited (Any
                        Branch)</strong></p>
            </div>

            <div style="margin-bottom: 0px;margin-top: 1em;"></div>
            <div class="row">
                <h4 style="padding-left: 2.5%; font-weight: 600">Student Name / Father Name:</h4>
                <h4 style="padding-left: 2.5%; font-weight: 600">Farhad Ahmad / Muhammad Dilsahd</h4>
                <p style="padding-left: 2.5%;"><strong>Admission #</strong> <strong>202211920</strong>
                </p>
                <p style="padding-left: 2.5%;"><strong>Class:</strong> <strong>Regular 22-24(I.Com(A-2))(22-24)</strong>
                </p>

                {{--  --}}
                <p style="padding-left: 2.5%;"><strong>Tution Fee : 5000</strong></p>
                <p style="padding-left: 2.5%;"><strong>Annual Fund : 5000</strong></p>
                <!--<p style="padding-left: 2.5%;"><strong>Arrears : </strong><strong>0</strong></p>-->
                <hr style="border: 1px solid black;">
                <p style="padding-left: 2.5%;"><strong>Net Fee: </strong><strong>10000</strong></p>
                <p style="padding-left: 2.5%;"><strong>Rupees: </strong><strong style="text-transform: uppercase;">TEn
                        Thousand Only /-</strong></p>
                <p style="padding-left: 2.5%;"><strong>Note: </strong><strong>After due date, late fee fine @ Rs.
                        20/ -
                        Per day</strong></p>
            </div>

            <div class="signature">
                <p>
                    Depositor Signature:____________ Authorized sign:_______________
                </p>
            </div>
        </div>

        <div class="size col-xs-4" style="margin-top:12px;margin-left: 40px; border-right: 1px solid #000">
            <div class="row" id="logo-row">
                <div class="" style="float:left;">
                    <div style="margin-top: 4px; margin-left: 3px;">
                        <img style="height: 60px;" src="{{ asset('storage/img/download.jpg') }}" alt="Logo city">
                    </div>
                </div>
                <div class="" style="text-align: center; margin-top:10px;">
                    <h3><strong>City College</strong></h3>
                    <h4><strong>Jinnah Campus</strong></h4>
                    <h4><strong>Bank COPY</strong></h4>
                    <h5><strong>(CASH DEPOSIT SLIP)</strong></h5>
                </div>
            </div>
            <div class="row " style="margin-top: 1px">
                <table class="table">
                    <tbody style="border: 1px solid black;">
                        <tr>
                            <th class="th-1"> Issue Date</th>
                            <th class="th-1">29-Nov-2022</td>
                            </th>
                            <th class="th-1">Due Date
                            </th>
                            <th class="th-1">12-Dec-2022</td>

                            </th>
                        </tr>
                    </tbody>
                </table>

                <h2 class="FID_Title">FID: 349217</h2>

            </div>
            <div style="margin-bottom:10px;"></div>
            <div class="row">
                <p style="padding-left: 2.5%;"><strong>Account Title:</strong> <strong>City College of Science and
                        Commerce</strong> </p>
                <p style="padding-left: 2.5%;"><strong>Account#:</strong> <strong>0010060200620020</strong></p>
                <p style="padding-left: 2.5%;"><strong>Branch Code:</strong><strong>0752</strong></p>
                <p style="padding-left: 2.5%;"><strong>Branch Name:</strong><strong>Allied Bank Limited (Any
                        Branch)</strong></p>
            </div>

            <div style="margin-bottom: 0px;margin-top: 1em;"></div>
            <div class="row">
                <h4 style="padding-left: 2.5%; font-weight: 600">Student Name / Father Name:</h4>
                <h4 style="padding-left: 2.5%; font-weight: 600">Farhad Ahmad / Muhammad Dilsahd</h4>
                <p style="padding-left: 2.5%;"><strong>Admission #</strong> <strong>202211920</strong>
                </p>
                <p style="padding-left: 2.5%;"><strong>Class:</strong> <strong>Regular 22-24(I.Com(A-2))(22-24)</strong>
                </p>

                {{--  --}}
                <p style="padding-left: 2.5%;"><strong>Tution Fee : 5000</strong></p>
                <p style="padding-left: 2.5%;"><strong>Annual Fund : 5000</strong></p>
                <!--<p style="padding-left: 2.5%;"><strong>Arrears : </strong><strong>0</strong></p>-->
                <hr style="border: 1px solid black;">
                <p style="padding-left: 2.5%;"><strong>Net Fee: </strong><strong>10000</strong></p>
                <p style="padding-left: 2.5%;"><strong>Rupees: </strong><strong style="text-transform: uppercase;">TEn
                        Thousand Only /-</strong></p>
                <p style="padding-left: 2.5%;"><strong>Note: </strong><strong>After due date, late fee fine @ Rs.
                        20/ -
                        Per day</strong></p>
            </div>

            <div class="signature">
                <p>
                    Depositor Signature:____________ Authorized sign:_______________
                </p>
            </div>
        </div>
    </div> <!-- Home -->
</div>


<style>
    p {
        margin-top: -0.4em !important;
    }

    .mb-0 {
        font-size: 14px;
    }

    .centerAlign {
        text-align: center;
    }

    .size0 {
        height: 99%;
    }

    .fontSize-12 {
        font-size: 12px;
    }

    .border {
        border: 1px solid #000 !important;
        padding: 0px;
        // margin-right: 8px;
        // height: 99vh
    }

    .totalfee {
        border: 1px solid;
        padding: 5px 30px;
    }

    .totalfeePosition {
        text-align: left;
        position: absolute;
        width: 99%;
    }

    .dueDatePosition {
        text-align: right;
        position: absolute;
        width: 99%;

    }

    #logo-row {
        top: 13px;
    }

    th {
        border: 1px solid #333 !important;
        font-size: 14px;
        padding-top: 2px !important;
        padding-bottom: 2px !important;
    }

    .th-1 {
        text-align: center;
        font-size: 12px;
        padding: 3px 3px !important;
    }

    .th-2 {
        text-align: left;
    }

    .th-3 {
        text-align: right;
    }

    p {
        font-size: 11px;
    }

    .col-xs-3 {
        max-width: 33%;
    }

    .col-xs-4 {
        width: 31%;
        float: left;
    }

    .childTfeep:last-child {
        margin-bottom: 22.5%;
    }

    p {
        font-size: 13px;
    }

    .alert {
        top: 0;
        position: absolute;
        margin-bottom: 0 !important;
        border: 1px solid transparent;
        border-radius: 4px;
        z-index: 9999;
        width: 102.5%;
        padding: 14px;
        opacity: 0.8;
    }

    .alert-success {
        background-color: #389168 !important;
        text-align: center;
        font-size: 15px;
        font-weight: 700;
    }

    .alert-error {
        background-color: #be3737 !important;
        text-align: center;
        font-size: 15px;
        font-weight: 700;
    }

    .label-report {
        background-color: #10316b;
        color: white;
        cursor: pointer;
    }

    .label-promote {
        background-color: #34a7b2;
        color: white;
        cursor: pointer;
    }

    h3 {
        margin-top: -17px;
    }

    h4 {
        margin-top: -13px;
    }

    h5 {
        margin-top: -5px;
        margin-bottom: 5px;
    }

    .row {
        margin-right: 0px !important;

    }
</style>
