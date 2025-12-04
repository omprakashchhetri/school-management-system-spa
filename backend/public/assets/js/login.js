jQuery(document).ready(function () {
  var baseUrl = jQuery("#baseUrl").val();
  var storage = window.localStorage;
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
    var type = $("input[name='type']:checked").val();
    $.ajax({
      url: baseUrl + "api/login",
      type: "POST",
      data: {
        email: $("#email").val(),
        password: $("#password").val(),
        type: type,
      },
      dataType: "json",
      success: function (response) {
        if (response.token) {
          // Store JWT in localStorage
          storage.setItem("authToken", response.token);
          Cookies.set("authToken", response.token);
          storage.setItem("loginType", type);
          Cookies.set("loginType", type);
          console.log(response.token);
          if (type.trim() === "student") {
            window.location.href =
              baseUrl + "post-login-student/dashboard";
          } else if (type.trim() === "employee") {
            window.location.href =
              baseUrl + "post-login-employee/admin/dashboard";
          }
        }

        // $("#response").text(JSON.stringify(response));
      },
      error: function (xhr) {
        $("#response").text("Error: " + xhr.responseText);
      },
    });
  });
});
