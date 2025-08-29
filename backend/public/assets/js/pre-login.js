jQuery(document).ready(async function () {
  var baseUrl = jQuery("#baseUrl").val();

  // ✅ Unified getItem
  async function getItem(key) {
    return window.localStorage.getItem(key) || Cookies.get(key);
  }

  // ✅ Unified setItem
  async function setItem(key, value) {
    window.localStorage.setItem(key, value);
    Cookies.set(key, value);
  }

  // Get token + login type
  const token = await getItem("authToken");
  const loginType = await getItem("loginType");

  if (token && loginType) {
    if (loginType === "student") {
      window.location.href = baseUrl + "post-login-student/";
      return;
    } else if (loginType === "employee") {
      window.location.href = baseUrl + "post-login-employee/admin/dashboard";
      return;
    }
  }

  // No token → load login page
  function getLoginPage() {
    jQuery.ajax({
      url: baseUrl + "login",
      type: "POST",
      success: function (reshtml) {
        jQuery("#app").html(reshtml);
        jQuery(".preloader").hide();
      },
    });
  }

  getLoginPage();
});
