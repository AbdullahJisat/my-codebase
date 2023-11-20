/** BEGIN:: SELECT ALL ROWS OF TABLE BY CHECKBOX CODE **/
function select_all() {
    if ($(".selectall:checked").length == 1) {
        $("#bulk_action_delete").show();
        $(".select_data").prop("checked", $(this).prop("checked", true));
        if ($(".select_data").is(":checked")) {
            $(".select_data").closest("tr").addClass("bg-danger");
            $(".select_data")
                .closest("tr")
                .children("td")
                .addClass("text-white");
        } else {
            $(".select_data").closest("tr").removeClass("bg-danger");
            $(".select_data")
                .closest("tr")
                .children("td")
                .removeClass("text-white");
        }
    } else {
        $("#bulk_action_delete").hide();
        $(".select_data").prop("checked", false);
        if ($(".select_data").is(":checked")) {
            $(".select_data").closest("tr").addClass("bg-danger");
            $(".select_data")
                .closest("tr")
                .children("td")
                .addClass("text-white");
        } else {
            $(".select_data").closest("tr").removeClass("bg-danger");
            $(".select_data")
                .closest("tr")
                .children("td")
                .removeClass("text-white");
        }
    }
}
/** END:: SELECT ALL ROWS OF TABLE BY CHECKBOX CODE **/
/** BEGIN:: SELECT ALL CHECKBOX CHECKED IF ANY ROW SELECTED CODE **/
$(document).on("change", ".select_data", function () {
    var total = $(".select_data").length;
    var number = $(".select_data:checked").length;
    if ($(this).is(":checked")) {
        $(this).closest("tr").addClass("bg-danger");
        $(this).closest("tr").children("td").addClass("text-white");
    } else {
        $(this).closest("tr").removeClass("bg-danger");
        $(this).closest("tr").children("td").removeClass("text-white");
    }
    if (total == number) {
        $(".selectall").prop("checked", true);
    } else {
        $(".selectall").prop("checked", false);
    }
    if (number > 0) {
        $("#bulk_action_delete").show();
    } else {
        $("#bulk_action_delete").hide();
    }
});
/** END:: SELECT ALL CHECKBOX CHECKED IF ANY ROW SELECTED CODE **/



/** BEGIN:: BULK ACTION DELETE FUNCTION */
function bulk_action_delete(table, url, id, rows) {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#6610f2",
        cancelButtonColor: "#fd397a",
        confirmButtonText: "Yes, delete!",
    }).then((result) => {
        if (result.value) {
            // $.ajaxSetup({
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     }
            // });
            $.ajax({
                url: url,
                type: "POST",
                data: {
                    id: id,
                },
                dataType: "json",
            })
                .done(function (response) {
                    if (response.status == "success") {
                        Swal.fire("Deleted!", response.message, "success").then(
                            function () {
                                // table.ajax.reload();
                                $(".selectall").prop("checked", false);
                                table.rows(rows).remove().draw(false);
                                // table.ajax.reload();
                            }
                        );
                    } else if (response.status == "error") {
                        Swal.fire("Error deleting!", response.message, "error");
                    }
                })
                .fail(function () {
                    swal.fire(
                        "Oops...",
                        "Something went wrong with ajax !",
                        "error"
                    );
                });
        }
    });
}
/** END:: BULK ACTION DELETE FUNCTION */
