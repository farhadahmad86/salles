
<!DOCTYPE HTML>
<html>
<head>

    <link rel="stylesheet" href='{{asset("public/css/print.css")}}' media="screen, print">

</head>
<body>


<footer class="page-footer">
    <div class="clnt_cmpny">
        &copy; {{date('Y', strtotime(str_replace('/', '-', \Carbon\Carbon::now()->year )))}}
        Company Name | All rights reserved.
    </div>
    <div id="content">
        <div id="pageFooter"></div>
    </div>
    <div class="pwrd_cmpny">
        Designed & Developed by softagics.com
        <p class="invoice_para m-0 pt-0">
            <b> Date: </b>
            {{date('d-M-y H:i:s A', strtotime(str_replace('/', '-', \Carbon\Carbon::now()->toDateTimeString() )))}}
        </p>
    </div>
</footer>

</body>
</html>
