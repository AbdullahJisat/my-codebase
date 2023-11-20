/** BEGIN:: FETCHING DATA AJAX CODE **/
function fetchData(id, url) {
    $.ajax({
        url: url,
        type: "GET",
        data: {
            id: id,
            // _token: _token
        },
        dataType: "JSON",
        success: function (data) {
            console.log(data.role);
            $("#dataForm #name").val(data.role.name);
            $("#dataForm #updateId").val(data.role.id);
            $("#dataModal").modal("show");
            // $('.selectpicker').selectpicker('refresh');
            $(".modal-title").html('<i class="fas fa-edit"></i> <span>Edit</span>');
            $("#saveBtn").text("Update");
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(
                thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText
            );
        },
    });
}
/** END: FETCHING DATA AJAX CODE **/
