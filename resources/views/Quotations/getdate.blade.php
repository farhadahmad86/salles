{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <input type="text" id="d1" name="d1">

    <script>
        var d = new Date();
        var yr = d.getFullYear();
        var month = d.getMonth() + 1;

        // if (month < 10) {
        //     month = '0' + month;
        // }
        var date = d.getDate();
        if (date < 10) {
            date = '0' + date;
        }
        var c_date = `${date}-${month}-${yr}`;

        document.getElementById('d1').value = c_date;
    </script>
</body>

</html> --}}
{{-- <!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Hello, world!</title>
    <style>
        .fieldset {
            border: 2px solid
        }

        .legend {
            font-weight: 500
        }

        .heading {
            text-align: center;
            border: 2px solid;
            padding: 5px;
        }

        .logo {
            width: 70px;
            height: auto;
            margin-left: 45px;
        }
    </style>
</head>

<body>
    {{-- <div class="container mt-5">
        <div class="row">
            <div class="col-xl-2">
                <img src="{{ asset('storage/img\rehmatfoods.jpg') }}" alt="logo" class="logo">
            </div>
            <div class="col-xl-7">
                <h3 class="heading">Purposal</h3>
            </div>
            <div class="col-xl-3">
                <p><b>Ref</b></p>
                <p><b>Date</b></p>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-3">
                <fieldset class="p-2 fieldset">
                    <legend class="float-none w-auto p-2 legend">Seller Info</legend>
                    <p><b>Company Name</b></p>
                    <p><b>Address</b></p>
                    <p><b>Contact #</b></p>
                    <p><b>Prepared By</b></p>
                </fieldset>
            </div>
            <div class="col-xl-3">
                <fieldset class="p-2 fieldset">
                    <legend class="float-none w-auto p-2 legend">Buyer Info</legend>
                    <p><b>Company Name</b></p>
                    <p><b>P.O.C</b></p>
                    <p><b>Contact #</b></p>
                    <p><b>Email</b></p>
                </fieldset>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Item Discription</th>
                            <th scope="col">Qty</th>
                            <th scope="col">UOM</th>
                            <th scope="col">Price</th>
                            <th scope="col">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>2</td>
                            <td>Feet</td>
                            <td>35</td>
                            <td>70</td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Jacob</td>
                            <td>2</td>
                            <td>Feet</td>
                            <td>35</td>
                            <td>70</td>
                        </tr>
                        <tr>
                            <td colspan="4"></td>
                            <td><b class="float-right">Grand Total: </b></td>
                            <td><b>140</b></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6">
                <h4>Terms & Conditions</h4>
                <p>hixan finish</p>
                <p>hixan finish</p>
                <p>hixan finish</p>
            </div>
        </div>
    </div>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Launch demo modal
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 90%" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button onClick="window.print()">Print this page</button>
                    <div class="row">
                        <div class="col-xl-2">
                            <img src="{{ asset('storage/img\rehmatfoods.jpg') }}" alt="logo" class="logo">
                        </div>
                        <div class="col-xl-7">
                            <h3 class="heading">Purposal</h3>
                        </div>
                        <div class="col-xl-3">
                            <p><b>Ref</b></p>
                            <p><b>Date</b></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6">
                            <fieldset class="p-2 fieldset">
                                <legend class="float-none w-auto p-2 legend">Seller Info</legend>
                                <p><b>Company Name</b></p>
                                <p><b>Address</b></p>
                                <p><b>Contact #</b></p>
                                <p><b>Prepared By</b></p>
                            </fieldset>
                        </div>
                        <div class="col-xl-6">
                            <fieldset class="p-2 fieldset">
                                <legend class="float-none w-auto p-2 legend">Buyer Info</legend>
                                <p><b>Company Name</b></p>
                                <p><b>P.O.C</b></p>
                                <p><b>Contact #</b></p>
                                <p><b>Email</b></p>
                            </fieldset>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Item Discription</th>
                                        <th scope="col">Qty</th>
                                        <th scope="col">UOM</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Mark</td>
                                        <td>2</td>
                                        <td>Feet</td>
                                        <td>35</td>
                                        <td>70</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td>Jacob</td>
                                        <td>2</td>
                                        <td>Feet</td>
                                        <td>35</td>
                                        <td>70</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"></td>
                                        <td><b class="float-right">Grand Total: </b></td>
                                        <td><b>140</b></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6">
                            <h4>Terms & Conditions</h4>
                            <p>hixan finish</p>
                            <p>hixan finish</p>
                            <p>hixan finish</p>
                        </div>
                    </div>
                </div>
                {{-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html> --}}
{{-- The following example shows the time in the format “hh:mm:ss”.
<!DOCTYPE html>
<html>

<head>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css"
        rel="stylesheet">
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js">
    </script>
    <title>Bootstrap TimePicker Example</title>
</head>
<style>
    body {
        background-color: black;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .para {
        color: white;
    }

    /*
    .container {
        margin-top: 80px;
        width: 800px;
    } */

    .content {
        position: relative;
    }
</style>

<body>
    <div class="container">
        <div class="row">
            <p class="para">Following is an example to demonstrate the TimePicker Example using Bootstrap.</p>
            <div class='col-sm-12 my-auto'>
                <div class="content">
                    <input class="form-control" type="text" id="datetimepicker" />
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#datetimepicker').datetimepicker({
            format: 'hh:mm:ss a'
        });
    </script>
</body>

</html> --}}
<!DOCTYPE html>
<html>

<head>
    <title>jQuery Testing</title>
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.1.js"></script>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(".addSpan").click(function() {
                var i = $("#dateTab input").length + 1;
                $("#dateTab").append($("<label>Date</label><input class='getDate id_" + i +
                    "' type='text' name='name[]' />").datepicker()); //reinitiate the datepicker
            });

            $(".getDate").datepicker();
        });
    </script>
</head>

<body>
    <div id="dateTab">
        <label>Date</label><input type="text" class="getDate id_1" name="name[]" />
    </div>
    <span class="addSpan">Add</span>
</body>

</html>
{{-- <!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Hello, world!</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        h1 {
            font-size: 3.5rem;
        }

        .float-left {
            float: left;
        }

        .text-center {
            text-align: center
        }

        .header,
        .content {
            width: 100%;
            display: block;
        }

        .c-logo {
            width: 15%;
        }

        .c-logo img {
            width: 100%;
            max-width: 70px;
            margin: 0;
            display: block;
        }

        .purposal {
            width: 65%;
        }

        .ref-date {
            width: 20%;
        }

        .ref-date p {
            white-space: nowrap;
            margin-bottom: 0 !important;
        }

        .width-50 {
            width: 50%;
        }

        .row {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            margin-bottom: 15px;
        }

        .border-dotted {
            border-bottom: 1px dotted #444;
        }

        legend {
            font-weight: 500;
            margin-bottom: -14px;
        }

        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }

        .fieldset {
            border: 2px solid
        }

        .fieldset p {
            margin-block: 0 !important;
        }

        .modal-body {
            margin: 3rem !important;
        }

        @media screen {
            #printSection {
                display: none;
            }
        }

        @media print {
            body * {
                visibility: hidden;
            }

            #printSection,
            #printSection * {
                visibility: visible;
            }

            #printSection {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%
            }
        }
    </style>
</head>

<body>


    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
        Launch demo modal
    </button>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 90%" role="document">
            <div class="modal-content">
                <div id="printThis" class="modal-body">
                    <header class="header">
                        <div class="row">
                            <div class="c-logo float-left">
                                <img src="{{ asset('storage/img\rehmatfoods.jpg') }}">
                            </div>
                            <div class="purposal float-left text-center">
                                <h1>Purposal</h1>
                            </div>
                            <div class="ref-date float-left">
                                <p><b>Ref:</b> <span>#5683415651465</span></p>
                                <p><b>Date:</b> <span class="border-dotted">27-01-2023</span></p>
                            </div>
                        </div>
                    </header>
                    <section class="content">
                        <div class="row">
                            <div class="width-50 float-left">
                                <fieldset class="p-2 fieldset">
                                    <legend class="float-none w-auto p-2 legend">Seller Info</legend>
                                    <p><b>Company Name</b></p>
                                    <p><b>Address</b></p>
                                    <p><b>Contact #</b></p>
                                    <p><b>Prepared By</b></p>
                                </fieldset>
                            </div>
                            <div class="width-50 float-left">
                                <fieldset class="p-2 fieldset">
                                    <legend class="float-none w-auto p-2 legend">Buyer Info</legend>
                                    <p><b>Company Name</b></p>
                                    <p><b>P.O.C</b></p>
                                    <p><b>Contact #</b></p>
                                    <p><b>Email</b></p>
                                </fieldset>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-12">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col" style="width: 70%">Item Discription</th>
                                            <th scope="col">Qty</th>
                                            <th scope="col">UOM</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>Mark</td>
                                            <td>2</td>
                                            <td>Feet</td>
                                            <td>350000000</td>
                                            <td>70</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">2</th>
                                            <td>Jacob</td>
                                            <td>2</td>
                                            <td>Feet</td>
                                            <td>350000000</td>
                                            <td>70</td>
                                        </tr>
                                        <tr>
                                            <td colspan="4"></td>
                                            <td><b class="float-right" style="font-size: 13px">Grand Total: </b></td>
                                            <td><b>1400000000</b></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <h3>Terms &amp; Conditions</h3>
                            <p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to
                                demonstrate the visual form of a document or a typeface without relying on meaningful
                                content. Lorem ipsum may be used as a placeholder before final copy is available.</p>
                        </div>
                    </section>
                </div>
                <div class="modal-footer">
                    <button type="button" id="Print" class="btn btn-primary">Print</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById("Print").onclick = function() {
            printElement(document.getElementById("printThis"));
        };

        function printElement(elem) {
            var domClone = elem.cloneNode(true);

            var $printSection = document.getElementById("printSection");

            if (!$printSection) {
                var $printSection = document.createElement("div");
                $printSection.id = "printSection";
                document.body.appendChild($printSection);
            }

            $printSection.innerHTML = "";
            $printSection.appendChild(domClone);
            window.print();
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html> --}}
{{-- <!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Hello, world!</title>
    <style>
        .fieldset {
            border: 2px solid
        }

        .legend {
            font-weight: 500
        }

        .heading {
            text-align: center;
            border: 2px solid;
            padding: 5px;
        }

        .logo {
            width: 70px;
            height: auto;
            margin-left: 45px;
        }

        @media screen {
            #printSection {
                display: none;
            }
        }

        @media print {
            body * {
                visibility: hidden;
            }

            #printSection,
            #printSection * {
                visibility: visible;
            }

            #printSection {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%
            }
        }
    </style>
</head>

<body>
    {{-- <div class="container mt-5">
        <div class="row">
            <div class="col-xl-2">
                <img src="{{ asset('storage/img\rehmatfoods.jpg') }}" alt="logo" class="logo">
            </div>
            <div class="col-xl-7">
                <h3 class="heading">Purposal</h3>
            </div>
            <div class="col-xl-3">
                <p><b>Ref</b></p>
                <p><b>Date</b></p>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-3">
                <fieldset class="p-2 fieldset">
                    <legend class="float-none w-auto p-2 legend">Seller Info</legend>
                    <p><b>Company Name</b></p>
                    <p><b>Address</b></p>
                    <p><b>Contact #</b></p>
                    <p><b>Prepared By</b></p>
                </fieldset>
            </div>
            <div class="col-xl-3">
                <fieldset class="p-2 fieldset">
                    <legend class="float-none w-auto p-2 legend">Buyer Info</legend>
                    <p><b>Company Name</b></p>
                    <p><b>P.O.C</b></p>
                    <p><b>Contact #</b></p>
                    <p><b>Email</b></p>
                </fieldset>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Item Discription</th>
                            <th scope="col">Qty</th>
                            <th scope="col">UOM</th>
                            <th scope="col">Price</th>
                            <th scope="col">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>2</td>
                            <td>Feet</td>
                            <td>35</td>
                            <td>70</td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Jacob</td>
                            <td>2</td>
                            <td>Feet</td>
                            <td>35</td>
                            <td>70</td>
                        </tr>
                        <tr>
                            <td colspan="4"></td>
                            <td><b class="float-right">Grand Total: </b></td>
                            <td><b>140</b></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6">
                <h4>Terms & Conditions</h4>
                <p>hixan finish</p>
                <p>hixan finish</p>
                <p>hixan finish</p>
            </div>
        </div>
    </div>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
        Launch demo modal
    </button>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 90%" role="document">
            <div class="modal-content">
                <div id="printThis" class="modal-body">
                    <div class="row">
                        <div class="col-xl-2">
                            <img src="{{ asset('storage/img\rehmatfoods.jpg') }}" alt="logo" class="logo">
                        </div>
                        <div class="col-xl-7">
                            <h3 class="heading">Purposal</h3>
                        </div>
                        <div class="col-xl-3">
                            <p><b>Ref</b></p>
                            <p><b>Date</b></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6">
                            <fieldset class="p-2 fieldset">
                                <legend class="float-none w-auto p-2 legend">Seller Info</legend>
                                <p><b>Company Name</b></p>
                                <p><b>Address</b></p>
                                <p><b>Contact #</b></p>
                                <p><b>Prepared By</b></p>
                            </fieldset>
                        </div>
                        <div class="col-xl-6">
                            <fieldset class="p-2 fieldset">
                                <legend class="float-none w-auto p-2 legend">Buyer Info</legend>
                                <p><b>Company Name</b></p>
                                <p><b>P.O.C</b></p>
                                <p><b>Contact #</b></p>
                                <p><b>Email</b></p>
                            </fieldset>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Item Discription</th>
                                        <th scope="col">Qty</th>
                                        <th scope="col">UOM</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Mark</td>
                                        <td>2</td>
                                        <td>Feet</td>
                                        <td>35</td>
                                        <td>70</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td>Jacob</td>
                                        <td>2</td>
                                        <td>Feet</td>
                                        <td>35</td>
                                        <td>70</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"></td>
                                        <td><b class="float-right">Grand Total: </b></td>
                                        <td><b>140</b></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6">
                            <h4>Terms & Conditions</h4>
                            <p>hixan finish</p>
                            <p>hixan finish</p>
                            <p>hixan finish</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="Print" class="btn btn-primary">Print</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById("Print").onclick = function() {
            printElement(document.getElementById("printThis"));
        };

        function printElement(elem) {
            var domClone = elem.cloneNode(true);

            var $printSection = document.getElementById("printSection");

            if (!$printSection) {
                var $printSection = document.createElement("div");
                $printSection.id = "printSection";
                document.body.appendChild($printSection);
            }

            $printSection.innerHTML = "";
            $printSection.appendChild(domClone);
            window.print();
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html> --}}
