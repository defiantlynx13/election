<?php

$dash_assets_url=trailingslashit( PLUGIN_NAME_URL ) . 'assets/dashboard/';

$dash_assets_url2 = trailingslashit(PLUGIN_NAME_URL) . 'assets/dashboard-login/';

?>
<!DOCTYPE html>
<html class="loading" lang="fa" data-textdirection="rtl" dir="rtl">
<!-- BEGIN: Head-->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>سفارشات </title>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo $dash_assets_url.'images/ico/favicon.ico'?>">
    <meta name="theme-color" content="#5A8DEE">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo $dash_assets_url.'vendors/css/vendors.min.css'?>">
    <link rel="stylesheet" type="text/css" href="<?php echo $dash_assets_url2.'assets/Datepiker/persian-datepicker.css'?>">
    <link rel="stylesheet" type="text/css" href="<?php echo $dash_assets_url.'vendors/css/forms/select/select2.min.css'?>">
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
    <link rel="stylesheet" type="text/css" href="<?php echo $dash_assets_url.'vendors/css/tables/datatable/datatables.min.css'?>'">

    <!-- END: Page CSS-->

    <link rel="stylesheet" type="text/css" href="<?php echo $dash_assets_url.'vendors/css/toastr/toastr.min.css'?>'">

    <style type="text/css">
        .my-red-border {
            border: 1px solid red;
        }

        #table_users_filter{
        float: left;
        }
    </style>

</head>
<!-- END: Head-->