<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Title -->
    <title> Login</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?=base_url()?>assets/images/logo/favicon.png">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="<?=base_url()?>assets/css/bootstrap.min.css">
    <!-- file upload -->
    <link rel="stylesheet" href="<?=base_url()?>assets/css/file-upload.css">
    <!-- file upload -->
    <link rel="stylesheet" href="<?=base_url()?>assets/css/plyr.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
    <!-- full calendar -->
    <link rel="stylesheet" href="<?=base_url()?>assets/css/full-calendar.css">
    <!-- jquery Ui -->
    <link rel="stylesheet" href="<?=base_url()?>assets/css/jquery-ui.css">
    <!-- editor quill Ui -->
    <link rel="stylesheet" href="<?=base_url()?>assets/css/editor-quill.css">
    <!-- apex charts Css -->
    <link rel="stylesheet" href="<?=base_url()?>assets/css/apexcharts.css">
    <!-- calendar Css -->
    <link rel="stylesheet" href="<?=base_url()?>assets/css/calendar.css">
    <!-- jvector map Css -->
    <link rel="stylesheet" href="<?=base_url()?>assets/css/jquery-jvectormap-2.0.5.css">
    <!-- Main css -->
    <link rel="stylesheet" href="<?=base_url()?>assets/css/main.css">
    <style>
    .max-w-100 {
        max-width: 100px;
    }

    /* Dark text when not selected */
    .btn-group .btn-outline-primary {
        color: #212529 !important;
        /* Bootstrap text-dark */
    }

    /* Keep Bootstrap's normal highlight when active */
    .btn-group .btn-outline-primary.active,
    .btn-group .btn-outline-primary:active,
    .btn-group input:checked+.btn-outline-primary {
        color: #fff !important;
        /* white text when selected */
    }

    .role-toggle {
        border-radius: 20px;
    }
    </style>
</head>

<body>

    <!--==================== Preloader Start ====================-->
    <div class="preloader">
        <div class="loader"></div>
    </div>
    <!--==================== Preloader End ====================-->

    <!--==================== Sidebar Overlay End ====================-->
    <div class="side-overlay"></div>
    <!--==================== Sidebar Overlay End ====================-->

    <section class="auth d-flex">
        <div class="auth-left bg-main-50 flex-center p-24">
            <img src="<?=base_url()?>assets/images/thumbs/auth-img1.png" alt="">
        </div>
        <div class="auth-right py-40 px-24 flex-center flex-column">
            <div class="auth-right__inner mx-auto w-100">
                <a href="index.html" class="auth-right__logo max-w-100 mx-auto mb-15 d-block">
                    <img src="<?=base_url()?>assets/images/logo/school-demo-logo.png" alt="">
                </a>
                <h2 class="text-center mb-8">Welcome to Back! &#128075;</h2>
                <p class="text-center text-gray-600 text-15 mb-32">Please sign in to your account and start the
                    adventure</p>

                <form id="loginForm">
                    <div class="mb-20">
                        <!-- Bootstrap segmented toggle for Student / Teacher -->
                        <div class="d-flex justify-content-center align-items-center">
                            <div class="btn-group w-75" role="toolbar" aria-label="Select role" id="roleToggle">
                                <input type="radio" class="btn-check" name="type" id="role-student" value="student"
                                    autocomplete="off" checked>
                                <label class="role-toggle border border-primary px-4 btn btn-outline-primary"
                                    for="role-student">Student</label>

                                <input type="radio" class="btn-check" name="type" id="role-teacher" value="employee"
                                    autocomplete="off">
                                <label class="role-toggle border border-primary px-4 btn btn-outline-primary"
                                    for="role-teacher">Teacher</label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-24">
                        <label for="email" class="form-id-label form-label mb-8 h6">Student Id</label>
                        <div class="position-relative">
                            <input type="text" name="email" class="form-control py-11 ps-40" id="email"
                                placeholder="Type your username" required>
                            <span class="position-absolute top-50 translate-middle-y ms-16 text-gray-600 d-flex"><i
                                    class="ph ph-user"></i></span>
                        </div>
                    </div>
                    <div class="mb-24">
                        <label for="password" class="form-label mb-8 h6">Password</label>
                        <div class="position-relative">
                            <input type="password" name="password" class="form-control py-11 ps-40" id="password"
                                placeholder="Enter Current Password" required>
                            <span
                                class="toggle-password position-absolute top-50 inset-inline-end-0 me-16 translate-middle-y ph ph-eye-slash"
                                id="#password"></span>
                            <span class="position-absolute top-50 translate-middle-y ms-16 text-gray-600 d-flex"><i
                                    class="ph ph-lock"></i></span>
                        </div>
                    </div>
                    <div class="mb-32 flex-between flex-wrap gap-8">
                        <div class="form-check mb-0 flex-shrink-0">
                            <input class="form-check-input flex-shrink-0 rounded-4" type="checkbox" value=""
                                id="remember">
                            <label class="form-check-label text-15 flex-grow-1" for="remember">Remember Me </label>
                        </div>
                        <a href="forgot-password.html"
                            class="text-main-600 hover-text-decoration-underline text-15 fw-medium">Forgot Password?</a>
                    </div>
                    <button type="submit" class="btn btn-main rounded-pill w-100">Sign In</button>

                    <div id="response" style="margin-top:20px; color:blue;"></div>

                    <div class="divider my-32 position-relative text-center">
                        <span class="divider__text text-gray-600 text-13 fw-medium px-26 bg-white"></span>
                    </div>

                    <div class="flex-align gap-10 flex-column  justify-content-center ">
                        <small class="text-muted">Developed By</small>
                        <img class="max-w-100" src="<?=base_url('assets/images/logo/logo-echo.png')?>" alt="">
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Jquery js -->
    <script src="<?=base_url()?>assets/js/jquery-3.7.1.min.js"></script>
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
    <script src="<?=base_url()?>assets/js/login.js"></script>



</body>

</html>