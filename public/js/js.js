function sortTable(n) {
    var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
    table = document.getElementById("myTable");
    switching = true;
    //Set the sorting direction to ascending:
    dir = "asc";
    /*Make a loop that will continue until
    no switching has been done:*/
    while (switching) {
        //start by saying: no switching is done:
        switching = false;
        rows = table.rows;
        /*Loop through all table rows (except the
        first, which contains table headers):*/
        for (i = 1; i < (rows.length - 1); i++) {
            //start by saying there should be no switching:
            shouldSwitch = false;
            /*Get the two elements you want to compare,
            one from current row and one from the next:*/
            x = rows[i].getElementsByTagName("TD")[n];
            y = rows[i + 1].getElementsByTagName("TD")[n];
            /*check if the two rows should switch place,
            based on the direction, asc or desc:*/
            if (dir == "asc") {
                if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                    //if so, mark as a switch and break the loop:
                    shouldSwitch= true;
                    break;
                }
            } else if (dir == "desc") {
                if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                    //if so, mark as a switch and break the loop:
                    shouldSwitch = true;
                    break;
                }
            }
        }
        if (shouldSwitch) {
            /*If a switch has been marked, make the switch
            and mark that a switch has been done:*/
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
            //Each time a switch is done, increase this count by 1:
            switchcount ++;
        } else {
            /*If no switching has been done AND the direction is "asc",
            set the direction to "desc" and run the while loop again.*/
            if (switchcount == 0 && dir == "asc") {
                dir = "desc";
                switching = true;
            }
        }
    }
}

$(document).ready(function () {
    $('.select2').select2();             //Select 2








    // $('.dataTable').DataTable({         //datatable
    //     "scrollX": true,
    //     "paging": false,
    //     "searching": false,
    //     "info": false,
    //     "sScrollXInner": "100%",
    // });

    // $('.dataTable').DataTable({         //datatable
    //     "scrollX": true,
    //     "sScrollXInner": "100%",
    //     dom: 'Bfrtip',
    //     buttons: {
    //         buttons: [
    //             // { extend: 'copy', className: 'btn btn-secondary'},
    //             { extend: 'excel', className: 'btn btn-outline-dark btn-sm'},
    //             { extend: 'csv', className: 'btn btn-outline-dark btn-sm'},
    //             { extend: 'pdf', className: 'btn btn-outline-dark btn-sm'},
    //             { extend: 'print', className: 'btn btn-outline-dark btn-sm'}
    //         ],
    //         dom: {
    //             button: {
    //                 className: 'btn'
    //             }
    //         }
    //     }
    // });

    // remove previous date in simple input type date
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
    // });

    // tinymce.init({                      //tinymce(texteditor)
//     selector:'textarea.textarea',
//     width: '100%',
//     height: 100
// });

    // function justNo(evt) {
//     var theEvent = evt || window.event;
//
//     // Handle paste
//     if (theEvent.type === 'paste') {
//         key = event.clipboardData.getData('text/plain');
//     } else {
//         // Handle key press
//         var key = theEvent.keyCode || theEvent.which;
//         key = String.fromCharCode(key);
//     }
//     var regex = /[0-9]|\./;
//     if( !regex.test(key) ) {
//         theEvent.returnValue = false;
//         if(theEvent.preventDefault) theEvent.preventDefault();
//     }
// }
// function justLetter(evt) {
//     var theEvent = evt || window.event;
//
//     // Handle paste
//     if (theEvent.type === 'paste') {
//         key = event.clipboardData.getData('text/plain');
//     } else {
//         // Handle key press
//         var key = theEvent.keyCode || theEvent.which;
//         key = String.fromCharCode(key);
//     }
//     var regex = /[a-z]|\./;
//     if( !regex.test(key) ) {
//         theEvent.returnValue = false;
//         if(theEvent.preventDefault) theEvent.preventDefault();
//     }
// }

    // notification();
// function notification() {
//     // setInterval(function () {
//     $.ajax({
//         url : '/notification',
//         method: 'post',
//         datatype: 'json',
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         },
//         success: function (data) {
//             console.log(data);
//             $('.notification').html(data.add_reminders);
//             // // schedule
//             // var i=0, sch_reminder = '', sch_length = data.sch_reminder.length;
//             // for (i; i < sch_length; i++){
//             //     sch_reminder +=
//             //         '<div class="item-title"><b>Company: </b>'+data.sch_reminder[i].company_name+' (<span style="font-size: 13px">Schedule</span>)</div>\n' +
//             //         '<b>Reminder Date: </b><span>'+data.sch_reminder[i].sch_reminder+'</span>\n' +
//             //         '<div><a href="#">View</a></div>\n' +
//             //         '<hr>';
//             // }
//             // // funnel
//             // var j=0, funnel_reminder = '', funnel_length = data.funnel_reminder.length;
//             // for (j; j < funnel_length; j++){
//             //     funnel_reminder +=
//             //         '<div class="item-title"><b>Company: </b>'+data.funnel_reminder[j].company_name+' (<span style="font-size: 13px">Funnel</span>)</div>\n' +
//             //         '<b>Reminder Date: </b><span>'+data.funnel_reminder[j].funnel_reminder+'</span>\n' +
//             //         '<div><a href="#">View</a></div>\n' +
//             //         '<hr>';
//             // }
//             // // purposal
//             // var k=0, invoice_reminder = '', purposal_length = data.invoice_reminder.length;
//             // for (k; k < purposal_length; i++){
//             //     invoice_reminder +=
//             //         '<div class="item-title"><b>Company: </b>'+data.invoice_reminder[k].company_name+' (<span style="font-size: 13px">Purposal</span>)</div>\n' +
//             //         '<b>Reminder Date: </b><span>'+data.invoice_reminder[k].invoice_reminder+'</span>\n' +
//             //         '<div><a href="#">View</a></div>\n' +
//             //         '<hr>';
//             // }
//             // // order
//             // var l=0, order_reminder = '', order_length = data.order_reminder.length;
//             // for (l; l < order_length; i++){
//             //     order_reminder +=
//             //         '<div class="item-title"><b>Company: </b>'+data.order_reminder[l].company_name+' (<span style="font-size: 13px">Order</span>)</div>\n' +
//             //         '<b>Reminder Date: </b><span>'+data.order_reminder[l].order_reminder+'</span>\n' +
//             //         '<div><a href="#">View</a></div>\n' +
//             //         '<hr>';
//             // }
//             // // outputs
//             // $('.schedule-wrapper .notification-item').html(sch_reminder);
//             // $('.funnel-wrapper .notification-item').html(funnel_reminder);
//             // $('.purposal-wrapper .notification-item').html(order_reminder);
//             // $('.order-wrapper .notification-item').html(order_reminder);
//         },
//         error: function (XMLHttpRequest) {
//             console.log(XMLHttpRequest.responseJSON.message);
//         }
//     });
// }, 6000);
//     }

    // USE myInput ID IN INPUT TAG AND myTable ID IN TABLE BODY TAG
    // $(document).ready(function(){
    //     $("#myInput").on("keyup", function() {
    //         var value = $(this).val().toLowerCase();
    //         $("#myTable tr").filter(function() {
    //             $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    //         });
    //     });
    // });

});


