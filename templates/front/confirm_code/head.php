
<!DOCTYPE html>
<html class="loading" lang="fa" data-textdirection="rtl" dir="rtl">
<!-- BEGIN: Head-->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>تایید کد ورود</title>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo $dash_assets_url.'images/ico/favicon.ico'?>">
    <meta name="theme-color" content="#5A8DEE">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo $dash_assets_url.'vendors/css/vendors.min.css'?>">
    <link rel="stylesheet" type="text/css" href="<?php echo $dash_assets_url.'vendors/css/extensions/toastr.css'?>">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo $dash_assets_url.'css/bootstrap.min.css'?>">
    <link rel="stylesheet" type="text/css" href="<?php echo $dash_assets_url.'css/bootstrap-extended.css'?>">
    <link rel="stylesheet" type="text/css" href="<?php echo $dash_assets_url.'css/colors.css'?>">
    <link rel="stylesheet" type="text/css" href="<?php echo $dash_assets_url.'css/components.css'?>">
    <link rel="stylesheet" type="text/css" href="<?php echo $dash_assets_url.'css/themes/dark-layout.css'?>">
    <link rel="stylesheet" type="text/css" href="<?php echo $dash_assets_url.'css/themes/semi-dark-layout.css'?>">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo $dash_assets_url.'css/core/menu/menu-types/vertical-menu.css'?>">
    <link rel="stylesheet" type="text/css" href="<?php echo $dash_assets_url.'css/pages/authentication.css'?>">
    <link rel="stylesheet" type="text/css" href="<?php echo $dash_assets_url.'css/plugins/extensions/toastr.css'?>">

    <!-- END: Page CSS-->

    <style type="text/css">
        .my-red-border {
            border: 1px solid red;
        }

        html body.bg-full-screen-image {
            background: url(<?php echo $dash_assets_url.'images/pages/auth-bg.jpg'?>) no-repeat center center;
            background-size: cover;
        }
       .help-block{
           color: red;
       }

         .validate input:focus{
            border: 1px solid green;
            background: rgb(42 228 48 / 16%);
       }
    </style>
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->
<body class="vertical-layout vertical-menu-modern 1-column  navbar-sticky footer-static bg-full-screen-image  blank-page blank-page" data-open="click" data-menu="vertical-menu-modern" data-col="1-column">
  