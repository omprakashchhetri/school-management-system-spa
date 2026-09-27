jQuery(document).ready(function () {
  var baseUrl = jQuery("#baseUrl").val();
  var storage = window.localStorage;
  function showLoginError(message) {
    if (typeof Swal !== "undefined") {
      Swal.fire({
        icon: "error",
        title: "Login failed",
        text: message,
        confirmButtonColor: "#487FFF",
      });
    } else {
      alert(message);
    }
  }

  jQuery("#loginForm").on("submit", function (e) {
    e.preventDefault();
    var type = $("input[name='type']:checked").val();
    var $submitBtn = jQuery("#loginForm button[type='submit']").prop("disabled", true);

    $.ajax({
      url: baseUrl + "api/login",
      type: "POST",
      data: {
        email: $("#email").val(),
        password: $("#password").val(),
        type: type,
      },
      dataType: "json",
      complete: function () {
        $submitBtn.prop("disabled", false);
      },
      success: function (response) {
        if (!response.token) {
          showLoginError(response.message || "Invalid email/ID or password.");
          return;
        }

        const token = response.token;
        const loginType = type.trim();
        const remember = jQuery("#remember").is(":checked");

        /* -----------------------------------------
				   1. Store token in localStorage (primary for SPA)
				   Only when "Remember Me" is checked — localStorage
				   never expires on its own, so writing it unconditionally
				   would keep the session alive after the browser closes
				   regardless of the checkbox.
				----------------------------------------- */
        if (remember) {
          try {
            localStorage.setItem("authToken", token);
            localStorage.setItem("loginType", loginType);
          } catch (e) {
            console.warn("localStorage unavailable", e);
          }
        } else {
          try {
            localStorage.removeItem("authToken");
            localStorage.removeItem("loginType");
          } catch (e) {
            console.warn("localStorage unavailable", e);
          }
        }

        /* -----------------------------------------
				   2. Store token in cookie (browser reload fallback)
				   Remembered → persists 7 days. Not remembered → a
				   session cookie that clears when the browser closes.
				----------------------------------------- */
        const cookieOptions = remember
          ? { expires: 7, path: "/", sameSite: "Lax" }
          : { path: "/", sameSite: "Lax" };

        Cookies.set("authToken", token, cookieOptions);
        Cookies.set("loginType", loginType, cookieOptions);

        /* -----------------------------------------
				   3. VERIFY persistence (important!)
				----------------------------------------- */
        const lsToken = localStorage.getItem("authToken");
        const ckToken = Cookies.get("authToken");

        if (!lsToken && !ckToken) {
          if (typeof Swal !== "undefined") {
            Swal.fire({
              icon: "warning",
              title: "Storage blocked",
              text: "Your browser is blocking storage, so login may not persist after restart.",
              confirmButtonColor: "#487FFF",
            });
          } else {
            alert(
              "Your browser is blocking storage. " +
                "Login may not persist after restart.",
            );
          }
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
        let message = "Something went wrong. Please try again.";
        try {
          const parsed = JSON.parse(xhr.responseText);
          message = parsed.message || message;
        } catch (e) {
          // Non-JSON error body (e.g. a raw 500 page) — keep the default message.
        }
        showLoginError(message);
      },
    });
  });
});
