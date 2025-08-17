<!DOCTYPE html>
<html>

<head>
    <title>jQuery SPA Router</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <style>
    a,
    .nav_js {
        cursor: pointer;
    }
    </style>
</head>

<body>
    <nav style="z-index: 9999;">
        <a class="nav_js" href="/">Home</a>
        <a class="nav_js" href="login">Login</a>
        <a class="nav_js" href="test">Test</a>
        <a class="nav_js" href="student-list">Test</a>
        <span class="nav_js" data-route="contact">Contact</span>
    </nav>

    <div id="app">Loading...</div>

    <script>
    const baseUrlOfApp = window.location.href.split("post-login/")[0] + "post-login/";
    const restOfBaseUrl = window.location.href.split("post-login/")[1];
    // Core SPA Navigation Function
    function navigateTo(route, push = true) {
        $.ajax({
            url: "http://localhost:8080/" + route,
            method: "GET",
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
            },
            error: function() {
                $("#app").html("<h2>Page not found</h2>");
            }
        });
    }

    // Click handler for links and .nav_js
    $(document).on("click", "a.nav_js, .nav_js", function(e) {
        e.preventDefault();
        let route = $(this).attr("href") || $(this).data("route");
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
        let path = "";
        if (restOfBaseUrl != "") {
            path = restOfBaseUrl;
        } else {
            path = "";
        }
        navigateTo(path, false);
    });
    </script>
</body>

</html>