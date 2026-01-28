jQuery(document).ready(async function () {

  const baseUrl = jQuery("#baseUrl").val();

  const getItem = (key) =>
    localStorage.getItem(key) || Cookies.get(key);

  const clearAuth = () => {
    localStorage.removeItem("authToken");
    localStorage.removeItem("loginType");
    Cookies.remove("authToken");
    Cookies.remove("loginType");
  };

  const loadLogin = () => {
    jQuery.ajax({
      url: baseUrl + "login",
      type: "POST",
      success: function (reshtml) {
        jQuery("#app").html(reshtml);
        jQuery(".preloader").hide();
      },
    });
  };

  const token     = getItem("authToken");
  const loginType = getItem("loginType");

  if (!token || !loginType) {
    loadLogin();
    return;
  }

  let dashboardUrl = "";

  if (loginType === "student") {
    dashboardUrl = baseUrl + "post-login-student/dashboard";
  } 
  else if (loginType === "employee") {
    dashboardUrl = baseUrl + "post-login-employee/admin/dashboard";
  } 
  else {
    clearAuth();
    loadLogin();
    return;
  }

  try {
    const res = await jQuery.ajax({
      url: dashboardUrl,
      method: "POST",
      headers: {
        Authorization: "Bearer " + token
      }
    });

    if (res?.error) {
      clearAuth();
      loadLogin();
      return;
    }
    window.location.href(dashboardUrl);

  } catch (err) {
    console.error("Auth check failed:", err);
    clearAuth();
    loadLogin();
  }

});
