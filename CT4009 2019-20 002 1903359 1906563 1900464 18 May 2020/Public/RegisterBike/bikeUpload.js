$(document).ready(function ($) {

  $('#formRegBike').on('submit', function (e) {
    var formData = new FormData(this);

    if ($('#genderSelect').val() === '0') { //guard against empty selection input
      alert("Please Select a Gender");
      return false;
    }

    //ajax to post data from form and alert user on success
    e.preventDefault();
    $.ajax({
      url: "RegisterBikeDAO.php", //action of form
      method: "POST",
      data: formData,
      contentType: false,
      cache: false,
      processData: false,
      success: function (echoedMsg) {
        alert("Bike Successfully Registered");
        location.reload();
      }
    });

  });

});