<div id="app"></div>

<!-- Bootstrap Bundle Js -->
<script src="<?=base_url()?>assets/js/boostrap.bundle.min.js"></script>
<!-- Phosphor Js -->
<script src="<?=base_url()?>assets/js/phosphor-icon.js"></script>
<!-- file upload -->
<script src="<?=base_url()?>assets/js/file-upload.js"></script>
<!-- file upload -->
<script src="<?=base_url()?>assets/js/plyr.js"></script>
<!-- dataTables -->
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
<!-- full calendar -->
<script src="<?=base_url()?>assets/js/full-calendar.js"></script>
<!-- jQuery UI -->
<script src="<?=base_url()?>assets/js/jquery-ui.js"></script>
<!-- jQuery UI -->
<script src="<?=base_url()?>assets/js/editor-quill.js"></script>
<!-- apex charts -->
<script src="<?=base_url()?>assets/js/apexcharts.min.js"></script>
<!-- jvectormap Js -->
<script src="<?=base_url()?>assets/js/jquery-jvectormap-2.0.5.min.js"></script>
<!-- jvectormap world Js -->
<script src="<?=base_url()?>assets/js/jquery-jvectormap-world-mill-en.js"></script>
<!-- main js -->
<script src="<?=base_url()?>assets/js/main.js"></script>
<script>
const baseUrl = "<?=base_url()?>";
const baseUrlOfApp = window.location.href.split("post-login-student/")[0] + "post-login-student/";
const restOfBaseUrl = window.location.href.split("post-login-student/")[1];
// Core SPA Navigation Function
function navigateTo(route, push = true) {
    var storage = window.localStorage;
    var token = storage.getItem("authToken");
    var tokenCookie = Cookies.get("authToken");
    var authToken = token || tokenCookie;
    $.ajax({
        url: baseUrlOfApp + route,
        method: "POST",
        headers: {
            'Authorization': 'Bearer ' + authToken
        },
        success: function(data) {
            $("#app").html(data);

            // Update browser history if needed
            if (push) {
                let newUrl = baseUrlOfApp + route;
                if (route === "") newUrl = baseUrlOfApp + "/";
                history.pushState({
                    route: route
                }, "", newUrl);
            }
            $('.preloader').hide();

            jQuery(document).off("click", "#logoutBtn").on("click", "#logoutBtn", function() {
                // alert("User inactive for 1 minute!");
                // You can also redirect or logout user here
                // window.location.href = "/logout";
                // authToken cookie delete
                Cookies.remove('authToken');
                localStorage.removeItem('authToken');
                window.location.href = baseUrl + "pre-login";
            });
        },
        error: function() {
            Cookies.remove('authToken');
            localStorage.removeItem('authToken');
            window.location.href = baseUrl + "pre-login";
        }
    });
}

// Click handler for links and .nav_js
$(document).on("click", "a.nav_js, .nav_js", function(e) {
    e.preventDefault();
    let route = $(this).attr("href") || $(this).data("route");
    $('.preloader').show();
    if (route) {
        if (route == "/") {
            route = "";
        }
        navigateTo(route);
    }
});

// Handle browser back/forward buttons
window.onpopstate = function(event) {
    if (event.state && event.state.route) {
        navigateTo(event.state.route, false); // don't push again
    }
};

// Initial load (load from URL bar's last segment)
$(document).ready(function() {
    var storage = window.localStorage;
    jQuery(function() {
        var token = storage.getItem("authToken");
        var tokenCookie = Cookies.get("authToken");
        if (!token && !tokenCookie) {
            // Redirect to post-login.html if token exists
            window.location.href = baseUrl + "pre-login/";
        }
    });
    let path = "";
    if (restOfBaseUrl != "") {
        path = restOfBaseUrl;
    } else {
        path = ""; // 👈 default route
    }
    // console.log(path);
    jQuery(document).off("click", "#logoutBtn").on("click", "#logoutBtn", logout);
    navigateTo(path, false);
    let inactivityTime = function() {
        let timeout;
        let inactivityLimit = 10000000; // 1 minute (set your own limit)

        function resetTimer() {
            clearTimeout(timeout);
            timeout = setTimeout(logout, inactivityLimit);
        }



        // Reset timer on these events
        window.onload = resetTimer;
        document.onmousemove = resetTimer;
        document.onkeypress = resetTimer;
        document.onscroll = resetTimer;
        document.onclick = resetTimer;
        document.ontouchstart = resetTimer; // for mobile
    };
    inactivityTime();
});

function logout() {
    // alert("User inactive for 1 minute!");
    // You can also redirect or logout user here
    // window.location.href = "/logout";
    // authToken cookie delete
    Cookies.remove('authToken');
    // authToken localStorage से delete
    localStorage.removeItem('authToken');
    window.location.href = baseUrl + "pre-login";
}
</script>