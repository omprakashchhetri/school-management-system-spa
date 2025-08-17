<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Title -->
    <title> Login</title>
    <!-- Jquery js -->
    <script src="<?=base_url()?>/js/jquery-3.7.1.min.js"></script>
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?=base_url()?>/images/logo/favicon.png">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="<?=base_url()?>/css/bootstrap.min.css">
    <!-- file upload -->
    <link rel="stylesheet" href="<?=base_url()?>/css/file-upload.css">
    <!-- file upload -->
    <link rel="stylesheet" href="<?=base_url()?>/css/plyr.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
    <!-- full calendar -->
    <link rel="stylesheet" href="<?=base_url()?>/css/full-calendar.css">
    <!-- jquery Ui -->
    <link rel="stylesheet" href="<?=base_url()?>/css/jquery-ui.css">
    <!-- editor quill Ui -->
    <link rel="stylesheet" href="<?=base_url()?>/css/editor-quill.css">
    <!-- apex charts Css -->
    <link rel="stylesheet" href="<?=base_url()?>/css/apexcharts.css">
    <!-- calendar Css -->
    <link rel="stylesheet" href="<?=base_url()?>/css/calendar.css">
    <!-- jvector map Css -->
    <link rel="stylesheet" href="<?=base_url()?>/css/jquery-jvectormap-2.0.5.css">
    <!-- Main css -->
    <link rel="stylesheet" href="<?=base_url()?>/css/main.css">
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
    <input type="hidden" id="baseUrl" value="http://localhost:8080/">
    <div id="app"></div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/js-cookie/2.2.1/js.cookie.min.js"></script>

    <script src="pre-login.js"></script>



</body>

</html>