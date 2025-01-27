var data_p = "";

// {{-- -----------For fetch data in Table header------------ --}}

function table_head(name) {
    var tabel_header = `<thead>
                    <tr class="header">
                    <th class="col">${name}</th>
                    </tr>
                </thead>`;
    document.getElementById("t_head").innerHTML = tabel_header;
}
// {{-- -------------For fetch data in Table body--------------------------- --}}

function table_body(prod, product_name) {
    console.log(prod);
    var data_p = "";
    $.each(prod, function (index, value) {
        data_p += `<tr class="btnSelect" id='btnSelect'>
                    <td class="col">${product_name}  </td>
                    </tr>`;
    });

    document.getElementById("tb_body").innerHTML = data_p;

    // document.getElementById("myTable").innerHTML = tabel_header;
}
// {{-- -----------For Add data in result table---------- --}}
$("#myTable").on("click", "#btnSelect", function () {
    // get the current row

    // var code = e.keyCode ? e.keyCode : e.which;

    var currentRow = $(this).closest("tr");
    // console.log(currentRow);

    var col1 = currentRow.find("td:eq(0)").text(); // get current row 1st TD value
    var col2 = currentRow.find("td:eq(1)").text(); // get current row 2nd TD
    var col3 = currentRow.find("td:eq(2)").text(); // get current row 3rd TD
    var col4 = currentRow.find("td:eq(3)").text(); // get current row 4th TD
    var data = `<tr>
                 <td> ${col1} </td>
                    <td> ${col2} </td>
                    <td> ${col3} </td>
                    <td>${col4}</td>
                    <td><button class = "deleteBtn"> Delete </button></td>
                    </tr>`;
    document.getElementById("tbl").innerHTML += data;

    document.getElementById("tb_body").innerHTML = data_p;
    remove_class();
});
// {{-- ---------------For Remove Class in Searchable table-------- --}}
function add_class() {
    document.getElementById("myTable").classList.toggle("show");
}
// {{-- -----------------For Remove Class in Searchable table--------------- --}}

function remove_class() {
    var element = document.getElementById("myTable").classList.toggle("show");
    element.classList.remove("show");
}

// {{-- -----------------for Delete row in the Table --------------- --}}

const tableEl = document.getElementById("mytables");

function onDeleteRow(e) {
    if (!e.target.classList.contains("deleteBtn")) {
        return;
    }
    const btn = e.target;
    btn.closest("tr").remove();
}
tableEl.addEventListener("click", onDeleteRow);
// {{-- -----------------for Searching in the Table --------------- --}}

// $("#data").keyup(function () {
function item_search() {
    let filter = document.getElementById("data").value.toUpperCase();
    // console.log(filter);

    $.ajax({
        type: "GET",
        url: "get_products",
        data: {
            filter: filter,
        },
        dataType: "json",
        success: function (response) {
            // console.log(response);
            table_body(response, "code", "title", "p_code", "clubbing");
        },
    });
    let myTable = document.getElementById("myTable");
    let tr = myTable.getElementsByTagName("tr");

    for (var i = 0; i < tr.length; i++) {
        let td = tr[i].getElementsByTagName("td")[0];
        let td2 = tr[i].getElementsByTagName("td")[1];
        let td3 = tr[i].getElementsByTagName("td")[2];
        let td4 = tr[i].getElementsByTagName("td")[3];
        if (td) {
            let textvalue = td.textContent || td.innerHTMl;
            let textvalue1 = td2.textContent || td2.innerHTMl;
            let textvalue2 = td3.textContent || td3.innerHTMl;
            let textvalue3 = td4.textContent || td4.innerHTMl;

            if (textvalue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else if (textvalue1.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else if (textvalue2.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else if (textvalue3.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
    // filter = null;
}

// {{-- -------------For UP & Down/Enter Button Scelect ---------- --}}
$(function () {
    const UP = 38;
    const DOWN = 40;
    const ARROWS = [UP, DOWN, 13];
    const HIGHLIGHT = "highlight_row";
    $("#data").on("keydown", function (e) {
        let $table = $(".child-div");

        let key = e.which;
        if (ARROWS.includes(key)) {
            let selectedRow = -1;
            let $rows = $table.find("tbody tr");
            $rows.each(function (i, row) {
                if ($(row).hasClass(HIGHLIGHT)) {
                    selectedRow = i;
                }
            });
            if (key == UP && selectedRow > 0) {
                $rows.removeClass(HIGHLIGHT);
                $rows.eq(selectedRow - 1).addClass(HIGHLIGHT);
            } else if (key == DOWN && selectedRow < $rows.length - 1) {
                $rows.removeClass(HIGHLIGHT);
                $rows.eq(selectedRow + 1).addClass(HIGHLIGHT);
            } else if (key == 13 && selectedRow >= 0) {
                var col1 = $rows.eq(selectedRow).find(">td").eq(0).text(); // get current row 1st TD value
                var col2 = $rows.eq(selectedRow).find(">td").eq(1).text(); // get current row 2nd TD
                var col3 = $rows.eq(selectedRow).find(">td").eq(2).text(); // get current row 3rd TD
                var col4 = $rows.eq(selectedRow).find(">td").eq(3).text(); // get current row 4th TD
                var data = `<tr>
                                <td> ${col1} </td>
                                    <td> ${col2} </td>
                                    <td> ${col3} </td>
                                    <td>${col4}</td>
                                    <td><button class = "deleteBtn"> Delete </button></td>
                                    </tr>`;
                document.getElementById("tbl").innerHTML += data;

                document.getElementById("tb_body").innerHTML = data_p;
                remove_class();
            }
        }
    });
});
// {------------For Clear Input---------------}
var wage = document.getElementById("data");
wage.addEventListener("keydown", function (e) {
    if (e.code === "Enter") {
        //checks whether the pressed key is "Enter"
        validate(e);
    }
});

function validate(e) {
    e.target.value = "";
    //validation of the input...
}
