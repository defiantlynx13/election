<body class="vertical-layout vertical-menu-modern 2-columns navbar-sticky footer-static menu-expanded pace-done" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns"><div class="pace  pace-inactive"><div class="pace-progress" data-progress-text="100%" data-progress="99" style="transform: translate3d(-100%, 0px, 0px);">
        <div class="pace-progress-inner"></div>
    </div>
    <div class="pace-activity"></div></div>

<?php

use PhpOffice\PhpSpreadsheet\IOFactory;
use Plugin_Name_Dir\Includes\Functions\Utility;
?>

<!-- BEGIN: Content-->
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body"><!-- Dashboard Analytics Start -->
            <section id="dashboard-analytics">
                <div class="row">

                    <div class="col-md-6 offset-md-3 col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="row no-gutters">
                                    <div class="col-lg-8 col-12">
                                        <div class="card-body">
                                            <h4 class="text-primary font-medium-3 text-bold-500 line-height-1 mb-2 primary-font">زمان رای گیری فرا نرسیده است!<h4>
                                            <p>
                                                زمان راگیری : روز
                                                <?php echo $election_settings['voting_day']?>
                                                اردیبهشت
                                                از ساعت
                                                <?php echo $election_settings['voting_start_time']?>
                                                تا ساعت
                                                <?php echo $election_settings['voting_finish_time']?>

                                            </p>
                                            <button type="button" class="btn btn-success glow mr-1 mb-1">
                                                <span class="align-middle ml-25"> پشتیبانی : 1051 496 0915</span>
                                                <i class="bx bx-phone"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-12">
                                        <img src="<?php echo $dash_assets_url.'images/banner/banner-30.jpg'?>" alt="element 01" class="h-100 w-100 rounded-right">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </section>
        </div>
    </div>
</div>
<!-- END: Content-->







