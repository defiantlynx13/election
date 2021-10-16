<body class="vertical-layout vertical-menu-modern 2-columns navbar-sticky footer-static menu-expanded pace-done" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns"><div class="pace  pace-inactive"><div class="pace-progress" data-progress-text="100%" data-progress="99" style="transform: translate3d(-100%, 0px, 0px);">
        <div class="pace-progress-inner"></div>
    </div>
    <div class="pace-activity"></div></div>

<?php

use PhpOffice\PhpSpreadsheet\IOFactory;
use Plugin_Name_Dir\Includes\Functions\Utility;
$voting_data=get_user_meta($cu_id,'voting_data',true);
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
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <h5>لیست نامزدهای انتخابی شما </h5>
                                    <div class="row">
                                        <div class="col-8">
                                            <ul class="list-unstyled mb-0">
                                                <?php
                                                    foreach ($voting_data['candidate_list'] as $temp)
                                                    {
                                                        $candidate=get_users(array(
                                                            'meta_key' => 'candidate_code',
                                                            'meta_value' => $temp
                                                        ));
                                                        $candidate_meta=get_user_meta($candidate[0]->ID);
                                                        ?>
                                                        <li class="media my-2">
                                                            <a href="JavaScript:void(0);">
                                                                <div class="avatar mr-1">
                                                                    <img src="<?php echo wp_get_attachment_url($candidate_meta['candidate_image'][0])?>" alt="avtar images" width="32" height="32">
                                                                </div>
                                                            </a>
                                                            <div class="media-body">
                                                                <h6 class="media-heading mb-0 mt-n25 primary-font"><a href="javaScript:void(0);"><?php echo $candidate_meta['fl_name'][0]?></a></h6>
                                                                <small class="text-muted"><div class="badge badge-pill badge-primary mr-1 mb-1"> کد انتخاباتی : <?php echo $temp?></div></small>
                                                                <small class="text-muted"><div class="badge badge-pill badge-warning mr-1 mb-1"><?php echo $candidate_meta['candidate_group'][0].'/'.$candidate_meta['candidate_field'][0]?></div></small>
                                                            </div>
                                                        </li>
                                                        <?php
                                                    }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <!-- user profile right side content birthday card start -->
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center pb-50">
                                <h4 class="card-title">اطلاعات موبایل یا رایانه ثبت رای</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body p-0 pb-1 ps ps--active-y">
                                    <ul class="list-group list-group-flush">
                                        <?php
                                        if (!empty($voting_data['ip']))
                                        {
                                            ?>
                                               <li class="list-group-item list-group-item-action border-0 d-flex align-items-center justify-content-between">
                                                <div class="list-left d-flex align-items-center">
                                                    <div class="list-icon mr-1">
                                                        <div class="avatar bg-rgba-black m-0">
                                                            <div class="avatar-content">
                                                                <i class="bx bxs-shield-alt-2 text-black-50 font-size-base"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="list-content mt-n25">
                                                        <span class="list-title">آی پی</span>
                                                    </div>
                                                </div>
                                                   <span style="direction: ltr"><?php echo $voting_data['ip']?></span>

                                               </li>

                                            <?php
                                        }
                                        ?>
                                        <?php
                                        if (!empty($voting_data['date']))
                                        {
                                            ?>
                                            <li class="list-group-item list-group-item-action border-0 d-flex align-items-center justify-content-between">
                                                <div class="list-left d-flex align-items-center">
                                                    <div class="list-icon mr-1">
                                                        <div class="avatar bg-rgba-warning m-0">
                                                            <div class="avatar-content">
                                                                <i class="bx bxs-calendar text-warning font-size-base"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="list-content mt-n25">
                                                        <span class="list-title">تاریخ و ساعت</span>
                                                    </div>
                                                </div>
                                                <span style="direction: ltr"><?php echo $voting_data['date']?></span>

                                            </li>

                                            <?php
                                        }
                                        ?>
                                        <?php
                                        if (!empty($voting_data['browser']))
                                        {
                                            ?>
                                            <li class="list-group-item list-group-item-action border-0 d-flex align-items-center justify-content-between">
                                                <div class="list-left d-flex align-items-center">
                                                    <div class="list-icon mr-1">
                                                        <div class="avatar bg-rgba-primary m-0">
                                                            <div class="avatar-content">
                                                                <i class="bx bxs-zap text-primary font-size-base"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="list-content mt-n25">
                                                        <span class="list-title">مرورگر</span>
                                                    </div>
                                                </div>
                                                <span><?php echo $voting_data['browser']?></span>

                                            </li>

                                            <?php
                                        }
                                        ?>
                                        <?php
                                        if (!empty($voting_data['os']))
                                        {
                                            ?>
                                                 <li class="list-group-item list-group-item-action border-0 d-flex align-items-center justify-content-between">
                                                <div class="list-left d-flex align-items-center">
                                                    <div class="list-icon mr-1">
                                                        <div class="avatar bg-rgba-info m-0">
                                                            <div class="avatar-content">
                                                                <i class="bx bxl-redux text-info font-size-base"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="list-content mt-n25">
                                                        <span class="list-title">سیستم عامل</span>
                                                    </div>
                                                </div>
                                                     <span><?php echo $voting_data['os']?></span>
                                                 </li>
                                            <?php
                                        }
                                        ?>
                                        <?php
                                        if (!empty($voting_data['device']))
                                        {
                                            ?>
                                             <li class="list-group-item list-group-item-action border-0 d-flex align-items-center justify-content-between">
                                                <div class="list-left d-flex align-items-center">
                                                    <div class="list-icon mr-1">
                                                        <div class="avatar bg-rgba-danger m-0">
                                                            <div class="avatar-content">
                                                                <i class="bx bx-chalkboard text-danger font-size-base"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="list-content mt-n25">
                                                        <span class="list-title">نوع دستگاه</span>
                                                    </div>
                                                </div>
                                                <span><?php echo $voting_data['device']?></span>
                                            </li>
                                            <?php
                                            }
                                        ?>
                                        <?php
                                        if (!empty($voting_data['brand']))
                                        {
                                        ?>
                                            <li class="list-group-item list-group-item-action border-0 d-flex align-items-center justify-content-between">
                                                <div class="list-left d-flex align-items-center">
                                                    <div class="list-icon mr-1">
                                                        <div class="avatar bg-rgba-primary m-0">
                                                            <div class="avatar-content">
                                                                <i class="bx bx-mobile text-primary font-size-base"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="list-content mt-n25">
                                                        <span class="list-title"> برند</span>
                                                    </div>
                                                </div>
                                                <span><?php echo $voting_data['brand'];?></span>
                                            </li>
                                            <?php
                                        }
                                        ?>
                                        <?php
                                        if (!empty($voting_data['model']))
                                        {
                                        ?>
                                        <li class="list-group-item list-group-item-action border-0 d-flex align-items-center justify-content-between">
                                            <div class="list-left d-flex align-items-center">
                                                <div class="list-icon mr-1">
                                                    <div class="avatar bg-rgba-danger m-0">
                                                        <div class="avatar-content">
                                                            <i class="bx bx-barcode text-danger font-size-base"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="list-content mt-n25">
                                                    <span class="list-title">مدل</span>
                                                </div>
                                            </div>
                                            <span><?php echo $voting_data['model'] ?></span>
                                        </li>
                                        <?php
                                        }
                                        ?>
                                    </ul>
                                    <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; height: 331px; left: 345px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 223px;"></div></div></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
<!-- END: Content-->







