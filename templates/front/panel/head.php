<?php

$dash_assets_url=trailingslashit( PLUGIN_NAME_URL ) . 'assets/dashboard/';
?>
<!DOCTYPE html>
<html class="loading" lang="fa" data-textdirection="rtl" dir="rtl">
<!-- BEGIN: Head-->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>داشبورد | ثبت رای</title>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo $dash_assets_url.'assets/images/ico/favicon.ico'?>">
    <meta name="theme-color" content="#5A8DEE">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo $dash_assets_url.'vendors/css/vendors.min.css'?>">
    <link rel="stylesheet" type="text/css" href="<?php echo $dash_assets_url.'vendors/css/extensions/toastr.css'?>">
    <link rel="stylesheet" type="text/css" href="<?php echo $dash_assets_url.'vendors/css/animate/animate.css'?>">
    <link rel="stylesheet" type="text/css" href="<?php echo $dash_assets_url.'vendors/css/extensions/sweetalert2.min.css'?>">

    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo $dash_assets_url.'css/bootstrap.min.css'?>'">
    <link rel="stylesheet" type="text/css" href="<?php echo $dash_assets_url.'css/bootstrap-extended.css'?>">
    <link rel="stylesheet" type="text/css" href="<?php echo $dash_assets_url.'css/colors.css'?>">
    <link rel="stylesheet" type="text/css" href="<?php echo $dash_assets_url.'css/components.css'?>">
    <link rel="stylesheet" type="text/css" href="<?php echo $dash_assets_url.'css/themes/dark-layout.css'?>">
    <link rel="stylesheet" type="text/css" href="<?php echo $dash_assets_url.'css/themes/semi-dark-layout.css'?>">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo $dash_assets_url.'css/core/menu/menu-types/vertical-menu.css'?>">
    <link rel="stylesheet" type="text/css" href="<?php echo $dash_assets_url.'css/pages/dashboard-ecommerce.css'?>'">
    <link rel="stylesheet" type="text/css" href="<?php echo $dash_assets_url.'/css/plugins/extensions/toastr.css'?>'">
<!--    <link rel="stylesheet" type="text/css" href="--><?php //echo $dash_assets_url.'css/plugins/tour/tour.css'?><!--">-->
    <!-- END: Page CSS-->

    <style type="text/css">
        .brand-text{
                font-size: 0.7em !important;
        }
        .buy-now {
            position: fixed;
            bottom: 5%;
            left: 50px;
            z-index: 1031;
        }
        .buy-now .btn {
            box-shadow: 0 1px 20px 1px #3ada8a !important;
        }


        .preloader {
            position: fixed;
            right: 0;
            left: 0;
            top: 0;
            bottom: 0;
            z-index: 1001;
            background: #fff;
            display: -webkit-box;
            display: -webkit-flex;
            display: -moz-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -webkit-align-items: center;
            -moz-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            -webkit-box-pack: center;
            -webkit-justify-content: center;
            -moz-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -webkit-flex-direction: column;
            -moz-box-orient: vertical;
            -moz-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column
        }

        .preloader .preloader-icon {
            border: 5px solid #eee;
            -webkit-border-radius: 50%;
            -moz-border-radius: 50%;
            border-radius: 50%;
            border-top: 5px solid #3498db;
            width: 50px;
            height: 50px;
            -webkit-animation: spin .5s linear infinite;
            -moz-animation: spin .5s linear infinite;
            -o-animation: spin .5s linear infinite;
            animation: spin .5s linear infinite
        }

        @-webkit-keyframes spin {
            0% {
                -webkit-transform: rotate(0)
            }
            100% {
                -webkit-transform: rotate(360deg)
            }
        }

        @-moz-keyframes spin {
            0% {
                -moz-transform: rotate(0);
                transform: rotate(0)
            }
            100% {
                -moz-transform: rotate(360deg);
                transform: rotate(360deg)
            }
        }

        @-o-keyframes spin {
            0% {
                -o-transform: rotate(0);
                transform: rotate(0)
            }
            100% {
                -o-transform: rotate(360deg);
                transform: rotate(360deg)
            }
        }

        @keyframes spin {
            0% {
                -webkit-transform: rotate(0);
                -moz-transform: rotate(0);
                -o-transform: rotate(0);
                transform: rotate(0)
            }
            100% {
                -webkit-transform: rotate(360deg);
                -moz-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                transform: rotate(360deg)
            }
        }

        .preloader svg path {
            fill: #1565c0
        }
    </style>


</head>
<!-- END: Head-->