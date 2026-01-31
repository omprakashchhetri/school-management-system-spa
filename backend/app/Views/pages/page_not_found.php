<!DOCTYPE html>
<html>

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Favicon icon-->
    <!-- <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png" /> -->

    <!-- Core Css -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/main.css" />
    <style>
        .dashboard-main-wrapper {
            margin: 0;
        }

        .mx-auto {
            margin: auto;
        }
    </style>

    <title>404 - Page Not Found</title>
</head>

<body>
    <div class="dashboard-main-wrapper flex-align">
        <div
            class="position-relative overflow-hidden min-vh-100 w-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100 px-20">
                <div class="row justify-content-center w-100">
                    <div class="col-lg-4">
                        <div class="flex-align flex-column">
                            <img src="<?= base_url() ?>assets/images/bg/errorimg.svg" alt="not-found"
                                class="max-w-280 img-fluid mx-auto" width="500">
                            <h1 class="fw-semibold mb-7 fs-9">Opps!!!</h1>
                            <h4 class="text-center fw-semibold mb-10">This page you are looking for could not be found.
                            </h4>
                            <a class="btn btn-main rounded-pill" href="pre-login" role="button">Go Back to
                                Home</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="dark-transparent sidebartoggler"></div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            console.log('[Capacitor] boot');

            if (!window.Capacitor) {
                console.warn('[Capacitor] Capacitor missing');
                return;
            }

            console.log('[Capacitor] version', window.Capacitor.getPlatform?.());

            const Plugins = window.Capacitor.Plugins || {};
            const App = Plugins.App;
            const Toast = Plugins.Toast;

            console.log('[Capacitor] Plugins available:', Object.keys(Plugins));

            if (!App) {
                console.error('[Capacitor] App plugin NOT available');
                return;
            }

            console.log('[Capacitor] App plugin OK');

            let lastBack = 0;

            App.addListener('backButton', () => {
                console.log('[Capacitor] HARDWARE BACK');

                if (window.history.length > 1) {
                    window.history.back();
                    return;
                }

                const now = Date.now();
                if (now - lastBack < 2000) {
                    App.exitApp();
                } else {
                    lastBack = now;
                    Toast?.show({ text: 'Press back again to exit', duration: 'short' });
                }
            });

        });
    </script>
</body>

</html>