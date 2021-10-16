<body class="vertical-layout vertical-menu-modern 2-columns navbar-sticky footer-static menu-expanded pace-done" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns"><div class="pace  pace-inactive"><div class="pace-progress" data-progress-text="100%" data-progress="99" style="transform: translate3d(-100%, 0px, 0px);">
        <div class="pace-progress-inner"></div>
    </div>
    <div class="pace-activity"></div></div>

<?php

use PhpOffice\PhpSpreadsheet\IOFactory;
use Plugin_Name_Dir\Includes\Functions\Utility;

Utility::load_template( 'general.header', compact( array('dash_assets_url','cu_id','user_info')), 'front' );
Utility::load_template( 'general.main-menu', compact( array('dash_assets_url','cu_id','user_info')), 'front' );

?>

<!-- BEGIN: Content-->
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-12 mb-2 mt-1">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h5 class="content-header-title float-left pr-1">تنظیمات</h5>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb p-0 mb-0">
                                <li class="breadcrumb-item"><a href="<?php echo home_url('panel')?>"><i class="bx bx-home-alt"></i></a>
                                </li>
                                <li class="breadcrumb-item active"><a href="#">تنظیمات</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- Basic Horizontal form layout section start -->
            <section id="basic-horizontal-layouts">
                <div class="row match-height">
                    <div class="col-md-6 col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">تنظیمات اصلی</h4>
                                <?php
                                    if (isset($_POST) and !empty($_POST))
                                    {
                                        $options=array(
                                            'voting_day'=>sanitize_text_field($_POST['election_day']),
                                            'voting_start_time'=>sanitize_text_field($_POST['election_start_time']),
                                            'voting_finish_time'=>sanitize_text_field($_POST['election_end_time']),
                                            'voting_status'=>(isset($_POST['voting_status']))? 'enable':'disable',
                                        );
                                        update_option(
                                            'ELEC_settings',
                                            $options,
                                            false
                                        );

                                        echo '<div class="alert bg-rgba-success alert-dismissible mb-2 mt-2" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="بستن">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                    <div class="d-flex align-items-center">
                                        <i class="bx bx-check-circle"></i>
                                        <span>
                                         تنظیمات با موفقیت ثبت گردید!
                                        </span>
                                    </div>
                                </div>';
                                    }
                                ?>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <form class="form form-horizontal" id="form_settings" name="form_settings" method="post">
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label>روز برگزاری انتخابات</label>
                                                </div>
                                                <div class="col-md-8 form-group">
                                                    <fieldset class="form-group">
                                                        <select class="custom-select" id="election_day" name="election_day">
                                                            <?php
                                                                $election_settings=get_option('ELEC_settings');
                                                                for ($i=1;$i<=31;$i++)
                                                                {
                                                                    echo ($election_settings['voting_day'] == $i)?'<option value="'.$i.'" selected="">'.$i.'</option>':'<option value="'.$i.'">'.$i.'</option>';
                                                                }
                                                            ?>
                                                        </select>
                                                    </fieldset>
                                                </div>

                                                <div class="col-md-4">
                                                    <label>ساعت شروع انتخابات</label>
                                                </div>
                                                <div class="col-md-8 form-group">
                                                    <fieldset class="form-group">
                                                        <select class="custom-select" id="election_start_time" name="election_start_time">
                                                            <?php
                                                            for ($i=1;$i<=24;$i++)
                                                            {
                                                                echo ($election_settings['voting_start_time'] == $i)?'<option value="'.$i.'" selected="">'.$i.'</option>':'<option value="'.$i.'">'.$i.'</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </fieldset>
                                                </div>

                                                <div class="col-md-4">
                                                    <label>ساعت پایان انتخابات</label>
                                                </div>
                                                <div class="col-md-8 form-group">
                                                    <fieldset class="form-group">
                                                        <select class="custom-select" id="election_end_time" name="election_end_time">
                                                            <?php
                                                            for ($i=1;$i<=24;$i++)
                                                            {
                                                                echo ($election_settings['voting_finish_time'] == $i)?'<option value="'.$i.'" selected="">'.$i.'</option>':'<option value="'.$i.'">'.$i.'</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </fieldset>
                                                </div>

                                                <div class="col-md-4">
                                                    <label>وضعیت برگزاری انتخابات</label>
                                                </div>
                                                <div class="custom-control custom-switch custom-switch-success custom-switch-glow mb-1">
                                                    <input type="checkbox" class="custom-control-input" <?php echo ($election_settings['voting_status'] == 'enable')? 'checked': '';?> id="voting_status" name="voting_status" value="enable">
                                                    <label class="custom-control-label" for="voting_status">
                                                        <span class="switch-icon-left"><i class="bx bx-check"></i></span>
                                                        <span class="switch-icon-right"><i class="bx bx-x"></i></span>
                                                    </label>
                                                </div>

                                                <div class="col-sm-12 d-flex justify-content-end">
                                                    <button type="submit" class="btn btn-primary mr-1 mb-1">ثبت</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- // Basic Horizontal form layout section end -->
        </div>
    </div>
</div>
<!-- END: Content-->







