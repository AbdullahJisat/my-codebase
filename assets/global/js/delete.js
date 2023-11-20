// /** BEGIN:: DELETE FORM TRIGGER CODE **/
// $(document).on("click", ".deleteBtn", function () {
//     var row = table.row($(this).parents("tr"));
//     var id = $(this).data("id");
//     var url = "{{ route('admin.roles.destroy', ':id') }}";
//     url = url.replace(":id", id);
//     delete_data(table, row, id, url);
// });



/** BEGIN:: DELETE DATA FUNCTION CODE **/
function delete_data(table, row, id, url) {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        type: "warning",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#34c38f",
        cancelButtonColor: "#fd397a",
        confirmButtonText: "Yes, delete it!",
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: url,
                type: "DELETE",
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
                                table.row(row).remove().draw(false);
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
/** END:: SAVE DATA FUNCTION CODE **/
/** END:: SAVE FORM TRIGGER CODE **/
