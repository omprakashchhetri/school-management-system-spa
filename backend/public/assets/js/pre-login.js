jQuery(document).ready(async function () {
  var baseUrl = jQuery("#baseUrl").val();

  // ✅ Get Preferences safely
  const Preferences =
    window.Capacitor && window.Capacitor.Plugins
      ? window.Capacitor.Plugins.Preferences
      : null;

  // ✅ Unified getItem
  async function getItem(key) {
    if (Preferences) {
      const { value } = await Preferences.get({ key });
      return value;
    } else {
      return window.localStorage.getItem(key) || Cookies.get(key);
    }
  }

  // ✅ Unified setItem
  async function setItem(key, value) {
    if (Preferences) {
      await Preferences.set({ key, value });
    } else {
      window.localStorage.setItem(key, value);
      Cookies.set(key, value);
    }
  }

  // Get token + login type
  const token = await getItem("authToken");
  const loginType = await getItem("loginType");

  if (token && loginType) {
    if (loginType === "student") {
      window.location.href = baseUrl + "post-login-student/";
      return;
    } else if (loginType === "employee") {
      window.location.href = baseUrl + "post-login-employee/";
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
