/*-------------------------------------------
  user.js
  By  CBDX
  
  
-------------------------------------------*/

let image_crop = $(".image-crop").croppie({
  enableExif: true,
  viewport: {
    width: 190,
    height: 190,
    type: "circle",
  },
  boundary: {
    width: 224,
    height: 224,
  },
});

let imageSize = {
  width: 400,
  height: 400,
  type: "square",
};

$(".section-croppie-image").hide();

$(".btn-edit-email").click(function (event) {
  $("#txtemailupdate").prop("disabled", false);
  $("#txtemailupdate").focus();

  $(".btn-edit-email").prop("disabled", true);
  $(".btn-edit-email").addClass("disabled");
});

$("#txtemailupdate").change(function (event) {
  $.ajax({
    url: "update_email.php",
    type: "POST",
    data: {
      "user-email": $("#txtemailupdate").val(),
    },
    success: function () {
      location.href = location.href;
      window.location.href = "/user";
    },
  });
  $("#txtemailupdate").prop("disabled", true);

  $(".btn-edit-email").prop("disabled", false);
  $(".btn-edit-email").removeClass("disabled");
});

$(".change-btn").click(function (event) {
  $(".change-btn").blur();
  $("#fileuploadimage").trigger("click");
});

$(".file").click(function (event) {
  $("#fileuploadimage").trigger("click");
});

$("#fileuploadimage").on("change", function () {
  let reader = new FileReader();
  reader.onload = function (event) {
    image_crop
      .croppie("bind", {
        url: event.target.result,
      })
      .then(function () {
        console.log("jQuery bind complete");
      });
  };
  reader.readAsDataURL(this.files[0]);
  $(".section-user-image").hide();
  $(".section-croppie-image").show();
});

$(".crop-btn").click(function (event) {
  image_crop
    .croppie("result", {
      type: "canvas",
      size: imageSize,
      quality: 1,
      circle: false,
    })
    .then(function (response) {
      $(".loader-user").css("visibility", "visible");
      $(".section-user-image").show();
      $(".section-croppie-image").hide();
      $.ajax({
        url: "upload.php",
        type: "POST",
        data: {
          image: response,
        },
        success: function () {
          location.href = location.href;
          window.location.href = "/user";
        },
      });
    });
});
