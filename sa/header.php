<?php include '../config/sessions.php';?>
<?php include '../config/constants.php';?>

<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../layouts/assets/images/ims-logo.png">
    <title><?php echo APP_NAME?></title>
    <!-- Charts -->
    <link href="../layouts/assets/libs/flot/css/float-chart.css" rel="stylesheet">
    <!-- dataTables -->
<!--    <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">-->
<!--     <link href="../layouts/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">-->
    <link href="../layouts/dist/DataTables/datatables.min.css" rel="stylesheet">
    <!-- toastr alert -->
    <link href="../layouts/assets/libs/toastr/build/toastr.min.css" rel="stylesheet">
    <!-- custom select -->
    <link rel="stylesheet" type="text/css" href="../layouts/assets/libs/select2/dist/css/select2.min.css">
    <!-- Custom CSS -->
    <link href="../layouts/dist/css/style.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
    <style>
        input{
            height: 40px;
        }
    </style>
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>