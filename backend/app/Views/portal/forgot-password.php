<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Title -->
    <title> Login</title>
    <!-- Jquery js -->
    <script src="<?=base_url()?>assets/js/jquery-3.7.1.min.js"></script>
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?=base_url()?>assets/images/logo/logo-sm.png">
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
    <!-- Loader css -->
    <link rel="stylesheet" href="<?=base_url()?>assets/css/loader.css">
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
    <input type="hidden" id="baseUrl" value="<?=base_url()?>">

    <!--==================== Preloader Start ====================-->
    <div class="preloader">
        <div class="loader"></div>
    </div>
    <!--==================== Preloader End ====================-->

    <div id="app"></div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/js-cookie/2.2.1/js.cookie.min.js"></script>
    <!-- <script src="<?=base_url('assets/js/forgot-password.js')?>"></script> -->
</body>

</html>