<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Title -->
    <title> Echocrew Learning Dashboard HTML Template</title>
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
    <!-- Jquery js -->
    <script src="<?=base_url()?>assets/js/jquery-3.7.1.min.js"></script>

    <!-- Bootstrap Bundle Js -->
    <script src="<?=base_url()?>assets/js/boostrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/js-cookie/2.2.1/js.cookie.min.js"></script>
    <style>
    a,
    .nav_js {
        cursor: pointer;
    }
    </style>
</head>

<body>
    <input type="hidden" id="globalBaseUrl" value="<?=base_url()?>">
    <!--==================== Preloader Start ====================-->
    <div class="preloader">
        <div class="loader"></div>
        <div class="loader-text">Loading...</div>
    </div>
    <!--==================== Preloader End ====================-->