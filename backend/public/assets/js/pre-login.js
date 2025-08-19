jQuery(document).ready(function () {
  var storage = window.localStorage;

  jQuery(function () {
    var token = storage.getItem("authToken");
    var tokenCookie = Cookies.get("authToken");

    if (token || tokenCookie) {
      var loginTypeStorage = storage.getItem("loginType");
      var loginTypeCookies = Cookies.get("loginType");
      if (loginTypeStorage === "student" || loginTypeCookies === "student") {
        // Redirect to post-login.html if token exists
        window.location.href = baseUrl + "post-login-student/";
      } else if (
        loginTypeStorage === "employee" ||
        loginTypeCookies === "employee"
      ) {
        window.location.href = baseUrl + "post-login-employee/";
      }
    }
  });

  var baseUrl = jQuery("#baseUrl").val();

  function getLoginPage() {
    jQuery.ajax({
      url: baseUrl + "login",
      type: "POST",
      success: function (reshtml) {
        jQuery("#app").html(reshtml);
      },
    });
  }

  getLoginPage();
});
