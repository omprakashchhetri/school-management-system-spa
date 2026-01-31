<div id="app"></div>

<!-- Bootstrap Bundle Js -->
<script src="<?= base_url() ?>assets/js/boostrap.bundle.min.js"></script>
<!-- Phosphor Js -->
<script src="<?= base_url() ?>assets/js/phosphor-icon.js"></script>
<!-- file upload -->
<script src="<?= base_url() ?>assets/js/file-upload.js"></script>
<!-- file upload -->
<script src="<?= base_url() ?>assets/js/plyr.js"></script>
<!-- dataTables -->
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
<!-- full calendar -->
<script src="<?= base_url() ?>assets/js/full-calendar.js"></script>
<!-- jQuery UI -->
<script src="<?= base_url() ?>assets/js/jquery-ui.js"></script>
<!-- jQuery UI -->
<script src="<?= base_url() ?>assets/js/editor-quill.js"></script>
<!-- apex charts -->
<script src="<?= base_url() ?>assets/js/apexcharts.min.js"></script>
<!-- jvectormap Js -->
<script src="<?= base_url() ?>assets/js/jquery-jvectormap-2.0.5.min.js"></script>
<!-- jvectormap world Js -->
<script src="<?= base_url() ?>assets/js/jquery-jvectormap-world-mill-en.js"></script>
<!-- main js -->
<script src="<?= base_url() ?>assets/js/main.js"></script>
<script>
    /* =========================== CONFIGURATION =========================== */
    const baseUrl = "<?= base_url() ?>";
    const baseUrlOfApp =
        window.location.href.split("post-login-student/")[0] + "post-login-student/";
    const restOfBaseUrl =
        window.location.href.split("post-login-student/")[1] || "";

    /* =========================== AUTH BOOTSTRAP =========================== */
    const Auth = (function () {
        const token =
            localStorage.getItem('authToken') ||
            (typeof Cookies !== 'undefined' ? Cookies.get('authToken') : null);

        return {
            token,
            isAuthenticated: !!token
        };
    })();

    /* 🔒 HARD FAIL EARLY */
    if (!Auth.isAuthenticated) {
        window.location.href = baseUrl + "pre-login/";
        throw new Error("Authentication required");
    }

    /* =========================== GLOBAL AJAX AUTH =========================== */
    $.ajaxSetup({
        beforeSend: function (xhr) {
            if (Auth.token) {
                xhr.setRequestHeader("Authorization", "Bearer " + Auth.token);
            }
        }
    });

    /* =========================== CORE NAVIGATION =========================== */
    function navigateTo(route, push = true) {

        $('.preloader').show();

        $.ajax({
            url: baseUrlOfApp + route,
            method: "POST",

            success: function (data) {
                $("#app").html(data);

                if (push) {
                    let newUrl = baseUrlOfApp + route;
                    if (route === "") newUrl = baseUrlOfApp;
                    history.pushState({ route }, "", newUrl);
                }

                $('.preloader').hide();
                bindLogout();
            },

            error: function (xhr) {
                if (xhr.status === 401 || xhr.status === 403) {
                    logout();
                } else {
                    $('.preloader').hide();
                    logout();
                }
            }
        });
    }

    /* =========================== LOGOUT =========================== */
    function logout() {
        Cookies.remove('authToken', { path: '/' });
        Cookies.remove('loginType', { path: '/' });

        localStorage.removeItem('authToken');
        localStorage.removeItem('loginType');

        window.location.href = baseUrl + "pre-login/";
    }

    /* =========================== LOGOUT BINDING =========================== */
    function bindLogout() {
        $(document)
            .off("click", "#logoutBtn")
            .on("click", "#logoutBtn", function (e) {
                e.preventDefault();
                logout();
            });
    }

    /* =========================== GLOBAL 401 HANDLER =========================== */
    $(document).ajaxError(function (event, xhr) {
        if (xhr.status === 401) {
            logout();
        }
    });

    /* =========================== INITIAL LOAD =========================== */
    $(document).ready(function () {

        let path = restOfBaseUrl || "";
        navigateTo(path, false);

        /* ---------------- Inactivity Timer ---------------- */
        let inactivityTimer;

        function resetInactivityTimer() {
            clearTimeout(inactivityTimer);
            inactivityTimer = setTimeout(logout, 600000); // 10 mins
        }

        ['load', 'mousemove', 'keypress', 'scroll', 'click', 'touchstart']
            .forEach(evt => window.addEventListener(evt, resetInactivityTimer));

        resetInactivityTimer();
    });

    /* =========================== HISTORY =========================== */
    window.onpopstate = function (event) {
        if (event.state && event.state.route !== undefined) {
            navigateTo(event.state.route, false);
        }
    };

    /* =========================== VISIBILITY =========================== */
    document.addEventListener("visibilitychange", function () {
        if (!document.hidden) {
            // optional refresh hook
        }
    });

    /* =========================== GLOBAL ERROR GUARDS =========================== */
    window.addEventListener("error", e => console.error(e.error));
    window.addEventListener("unhandledrejection", e => console.error(e.reason));
</script>