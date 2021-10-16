<?php

$dash__url=trailingslashit( PLUGIN_NAME_URL ) . 'assets/dashboard/';
?>

<!DOCTYPE html>
<html class="loading" lang="fa" data-textdirection="rtl" dir="rtl">
<!-- BEGIN: Head-->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>خطای 404</title>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo $dash__url.'/images/ico/favicon.ico'?>">
    <meta name="theme-color" content="#5A8DEE">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo $dash__url.'vendors/css/vendors.min.css'?>">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo $dash__url.'css/bootstrap.min.css'?>">
    <link rel="stylesheet" type="text/css" href="<?php echo $dash__url.'css/bootstrap-extended.css'?>">
    <link rel="stylesheet" type="text/css" href="<?php echo $dash__url.'css/colors.css'?>">
    <link rel="stylesheet" type="text/css" href="<?php echo $dash__url.'css/components.css'?>">
    <link rel="stylesheet" type="text/css" href="<?php echo $dash__url.'css/themes/dark-layout.css'?>">
    <link rel="stylesheet" type="text/css" href="<?php echo $dash__url.'css/themes/semi-dark-layout.css'?>">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo $dash__url.'css/core/menu/menu-types/vertical-menu.css'?>">
    <!-- END: Page CSS-->


    <style type="text/css">
        html body.bg-full-screen-image {
            background: url(<?php echo $dash__url.'images/pages/auth-bg.jpg'?>) no-repeat center center;
            background-size: cover;
        }
    </style>
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->
<body class="vertical-layout vertical-menu-modern boxicon-layout no-card-shadow 1-column  navbar-sticky footer-static bg-full-screen-image  blank-page blank-page" data-open="click" data-menu="vertical-menu-modern" data-col="1-column">
<!-- BEGIN: Content-->
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body"><!-- error 404 -->
            <section class="row flexbox-container">
                <div class="col-xl-6 col-md-7 col-9">
                    <div class="card bg-transparent shadow-none">
                        <div class="card-content">
                            <div class="card-body text-center bg-transparent miscellaneous">
                                <h1 class="error-title">صفحه یافت نشد :(</h1>
                                <p class="pb-3">
                                    صفحه ای که به دنبال آن هستید موجود نیست</p>
                                <img class="img-fluid" src="<?php echo $dash__url.'images/pages/404.png'?>" alt="404 error">
                                <a href="<?php echo home_url('auth')?>" class="btn btn-primary round glow mt-3">ورود به پنل</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- error 404 end -->
        </div>
    </div>
</div>
<!-- END: Content-->


<!-- BEGIN: Vendor JS-->
<script src="<?php echo $dash__url.'vendors/js/vendors.min.js'?>"></script>
<script src="<?php echo $dash__url.'fonts/LivIconsEvo/js/LivIconsEvo.tools.min.js'?>"></script>
<script src="<?php echo $dash__url.'fonts/LivIconsEvo/js/LivIconsEvo.defaults.js'?>"></script>
<script src="<?php echo $dash__url.'fonts/LivIconsEvo/js/LivIconsEvo.min.js'?>"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="<?php echo $dash__url.'js/core/app-menu.js'?>"></script>
<script src="<?php echo $dash__url.'js/core/app.js'?>"></script>
<script src="<?php echo $dash__url.'js/scripts/components.js'?>"></script>
<script src="<?php echo $dash__url.'js/scripts/footer.js'?>"></script>
<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
<!-- END: Page JS-->

</body>
<!-- END: Body-->
</html>
