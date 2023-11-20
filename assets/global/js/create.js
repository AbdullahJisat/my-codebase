// /** BEGIN:: SAVE FORM TRIGGER CODE **/
// $('#'+ roleForm).on('submit', function (event) {
//     event.preventDefault();
//     var data = new FormData(this);
//     var id = $('#updateId').val();
//     if (id) {
//         var method = 'update';
//         var url = "{{ route('admin.roles.update', ':id') }}";
//         url = url.replace(':id', id);
//     } else {
//         var method = 'store';
//         var url = "{{ route('admin.roles.store') }}";
//     }
//     storeData(table, url, method, data);
// });

/** BEGIN:: SAVE DATA FUNCTION CODE **/
function storeData(table, url, method, data) {
  // event.preventDefault();
  // CKEDITOR.instances.description.updateElement();
  $.ajax({
    url: url,
    type: "POST",
    data: data,
    dataType: "JSON",
    contentType: false,
    cache: false,
    processData: false,
    beforeSend: function () {
      $("#saveBtn").addClass("disabled")
    },
    complete: function () {
      $("#saveBtn").removeClass("disabled")
    },
    success: function (data) {
      console.log(data.errors)
      $("#dataForm").find(".is-invalid").removeClass("is-invalid")
      $("#dataForm").find(".error").remove()
      $("#dataForm table tbody").find(".is-invalid").removeClass("is-invalid")
      $("#dataForm table tbody").find(".error").remove()
      if (data.status) {
        toastMessage(data.status, data.message)
        $("#dataForm")[0].reset()
        $("#dataForm").trigger("reset")
        $("#updateId").val("")
        // $("#dataForm .selectpicker").selectpicker('refresh');
        if (data.status == "success") {
          if (method == "update") {
            table.ajax.reload(null, false)
          } else {
            table.ajax.reload()
          }

          $("#dataModal").modal("hide")
        }
      } else {
        console.log(data.errors)
        alert("ds")
        $.each(data.errors, function (key, value) {
          var key = key.split(".").join("_")
          $("#dataForm input[name='" + key + "']").addClass("is-invalid")
          $("#dataForm select#" + key + ".selectpicker")
            .parent()
            .addClass("is-invalid")
          $("#dataForm textarea[name='" + key + "']").addClass("is-invalid")
          $("#dataForm input[name='" + key + "']").after(
            '<div id="' +
              key +
              '" class="error invalid-feedback">' +
              value +
              "</div>"
          )
          $("#dataForm select#" + key + ".selectpicker")
            .parent()
            .after(
              '<div id="' +
                key +
                '" class="error invalid-feedback">' +
                value +
                "</div>"
            )
          $("#dataForm textarea[name='" + key + "']").after(
            '<div id="' +
              key +
              '" class="error invalid-feedback">' +
              value +
              "</div>"
          )
          if (key == "primary_image") {
            $("#choose-picture-box").css({
              border: "1px dashed red",
            })
          }

          $("#dataForm table tbody")
            .find("#" + key)
            .addClass("is-invalid")
          $("#dataForm table tbody")
            .find("#" + key)
            .after(
              '<div id="' +
                key +
                '" class="error invalid-feedback">' +
                value +
                "</div>"
            )
        })
      }
    },
    error: function (xhr, ajaxOptions, thrownError) {
      console.log(
        thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText
      )
    },
  })
}
/** END:: SAVE DATA FUNCTION CODE **/
/** END:: SAVE FORM TRIGGER CODE **/
