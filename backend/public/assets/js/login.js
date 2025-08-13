jQuery(document).ready(function () {
  function updateRoleUI() {
    let selected = $('input[name="type"]:checked').val();
    console.log(selected);
    if (selected === "student") {
      jQuery(".form-id-label").text("Student Id");
    } else {
      jQuery(".form-id-label").text("Teacher Id");
    }
  }

  // Listen for changes on the radio buttons
  jQuery('input[name="type"]').on("change", updateRoleUI);

  // Initialize on page load
  updateRoleUI();
  jQuery("#loginForm").on("submit", function (e) {
    e.preventDefault();

    $.ajax({
      url: "api/login",
      type: "POST",
      data: {
        email: jQuery("#email").val(),
        password: jQuery("#password").val(),
        type: jQuery("input[name='type']:checked").val(),
      },
      dataType: "json",
      success: function (response) {
        jQuery("#response").text(JSON.stringify(response));
      },
      error: function (xhr) {
        jQuery("#response").text("Error: " + xhr.responseText);
      },
    });
  });
});
