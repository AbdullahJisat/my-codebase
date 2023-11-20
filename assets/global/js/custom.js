/**************************************************
 ******* Start :: Bootstrap Notify Functions *******
 **************************************************/

function toastMessage(type, message) {
  console.log(type)
  toastr.options = {
    closeButton: true,
    progressBar: true,
  }
  switch (type) {
    case "success":
      toastr.success(message)
      break
    case "error":
      toastr.error(message)
      break
    case "warning":
      toastr.warning(message)
      break
    default:
      toastr.info(message)
      break
  }
}
/**************************************************
 ******* End :: Bootstrap Notify Functions *******
 **************************************************/

/**************************************************
 ******* Start :: Bootstrap Notify Functions *******
 **************************************************/

/**************************************************
 ******* End :: Bootstrap Notify Functions *******
 **************************************************/

/*************************************
 ******* Start :: URL Generator *******
 **************************************/
function urlGenerator(input_value, output_id) {
  var value = input_value.toLowerCase()
  var str = value.replace(/ +(?= )/g, "")
  var name = str.split(" ").join("-")
  $("#" + output_id).val(name)
}
/*************************************
 ******* End :: URL Generator *******
 **************************************/
function proPicURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader()
    reader.onload = function (e) {
      var preview = $(input).parents(".thumb").find(".profilePicPreview")
      $(preview).css("background-image", "url(" + e.target.result + ")")
      $(preview).addClass("has-image")
      $(preview).hide()
      $(preview).fadeIn(650)
    }
    reader.readAsDataURL(input.files[0])
  }
}
$(".profilePicUpload").on("change", function () {
  proPicURL(this)
})

$(".remove-image").on("click", function () {
  $(this).parents(".profilePicPreview").css("background-image", "none")
  $(this).parents(".profilePicPreview").removeClass("has-image")
  $(this).parents(".thumb").find("input[type=file]").val("")
})

/******* Start :: Permission Tree *******/
$.fn.extend({
  treed: function (o) {
    var openedClass = "fa-minus-square"
    var closedClass = "fa-plus-square"

    if (typeof o != "undefined") {
      if (typeof o.openedClass != "undefined") {
        openedClass = o.openedClass
      }
      if (typeof o.closedClass != "undefined") {
        closedClass = o.closedClass
      }
    }

    //initialize each of the top levels
    var tree = $(this)
    tree.addClass("tree")
    tree
      .find("li")
      .has("ul li")
      .each(function () {
        var branch = $(this) //li with children ul
        branch.prepend("<i class='indicator fas " + closedClass + "'></i>")
        branch.addClass("branch")
        branch.on("click", function (e) {
          if (this == e.target) {
            var icon = $(this).children("i:first")
            icon.toggleClass(openedClass + " " + closedClass)
            $(this).children().children().slideToggle(500)
          }
        })
        branch.children().children().slideToggle(500)
      })
    //fire event from the dynamically added icon
    tree.find(".branch .indicator").each(function () {
      $(this).on("click", function () {
        $(this).closest("li").click()
      })
    })
    //fire event to open branch if the li contains an anchor instead of text
    tree.find(".branch>a").each(function () {
      $(this).on("click", function (e) {
        $(this).closest("li a").click()
        e.preventDefault()
      })
    })
    //fire event to open branch if the li contains a button instead of text
    tree.find(".branch>button").each(function () {
      $(this).on("click", function (e) {
        $(this).closest("li a").click()
        e.preventDefault()
      })
    })
  },
})
/******* End :: Permission Tree *******/

$("#showModal").on("click", function () {
  $("#dataForm")[0].reset() //reset form
  $("#updateId").val("") //empty id input field

  $(".error").each(function () {
    $(this).empty() //remove error text
  })
  $("#dataForm").find(".is-invalid").removeClass("is-invalid") //remover red border color

  $("#dataModal").modal("show")

  // $(".selectpicker").selectpicker("refresh") //empty selectpicker field

  $(".modal-title").html('<i class="fas fa-plus-square"></i> <span>Add</span>') //set modal title

  $("#saveBtn").text("Save") //set save button text
})
