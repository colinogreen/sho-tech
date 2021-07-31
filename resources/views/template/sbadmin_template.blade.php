<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Covid Stats UK - Dashboard</title>
    <link href="{{ asset('css/app.css') }}?v=2.15" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <?php //<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"> ?>
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="{{ isset($bodyid)? $bodyid : "" }}" class="{{ isset($bodyclass)? $bodyclass : "" }}">

    @yield("sbadmin2_content")

    <!-- Bootstrap core JavaScript-->
   <?php // <script src="vendor/jquery/jquery.min.js"></script>
    //<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script> ?>
     <script src="{{ asset('js/app.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/sb-admin-2/demo/chart-area-demo.js"></script>
    <script src="js/sb-admin-2/demo/chart-pie-demo.js"></script>

</body>

</html>
