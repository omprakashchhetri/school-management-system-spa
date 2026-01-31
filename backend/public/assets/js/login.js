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
        if (!response.token) {
          $("#response").text("Invalid login response");
          return;
        }

        const token = response.token;
        const loginType = type.trim();

        /* -----------------------------------------
				   1. Store token in localStorage (primary for SPA)
				----------------------------------------- */
        try {
          localStorage.setItem("authToken", token);
          localStorage.setItem("loginType", loginType);
        } catch (e) {
          console.warn("localStorage unavailable", e);
        }

        /* -----------------------------------------
				   2. Store token in cookie (browser reload fallback)
				----------------------------------------- */
        Cookies.set("authToken", token, {
          expires: 7, // 🔑 persistent
          path: "/",
          sameSite: "Lax",
        });

        Cookies.set("loginType", loginType, {
          expires: 7,
          path: "/",
          sameSite: "Lax",
        });

        /* -----------------------------------------
				   3. VERIFY persistence (important!)
				----------------------------------------- */
        const lsToken = localStorage.getItem("authToken");
        const ckToken = Cookies.get("authToken");

        if (!lsToken && !ckToken) {
          alert(
            "Your browser is blocking storage. " +
              "Login may not persist after restart.",
          );
        }

        /* -----------------------------------------
				   4. Redirect
				----------------------------------------- */
        if (loginType === "student") {
          window.location.href = baseUrl + "post-login-student/dashboard";
        } else {
          window.location.href =
            baseUrl + "post-login-employee/admin/view-modules";
        }
      },
      error: function (xhr) {
        $("#response").text("Error: " + xhr.responseText);
      },
    });
  });
});
