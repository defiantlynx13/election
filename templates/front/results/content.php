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
                        <h5 class="content-header-title float-left pr-1">نتایج</h5>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb p-0 mb-0">
                                <li class="breadcrumb-item"><a href="<?php echo home_url('panel')?>"><i class="bx bx-home-alt"></i></a>
                                </li>
                                <li class="breadcrumb-item active"><a href="#">نتایج</a>
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
                    <div class="col-8">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">آرا ثبت شده برای هر نماینده</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-responsive table-hover mb-0" id="candidate_vote_table">
                                            <thead>
                                            <tr>
                                                <th>نام و نام خانوادگی</th>
                                                <th>گروه</th>
                                                <th>کد انتخاباتی</th>
                                                <th>مجموع آرا</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">آرا ثبت شده توسط اعضا</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-responsive table-hover mb-0" id="user_vote_table">
                                            <thead>
                                            <tr>
                                                <th>نام و نام خانوادگی</th>
                                                <th>نام کاربری</th>
                                                <th>لیست انتخاب ها</th>
                                                <th>اطلاعات ثبت</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
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

<div class="modal modal-borderless fade text-left show" id="selected_candidate_list_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-modal="true">
    <div class="modal-dialog  modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="myModalLabel1">لیست نامزدهای انتخابی</h3>
                <button type="button" class="close rounded-pill" data-dismiss="modal" aria-label="بستن">
                    <i class="bx bx-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-8">
                        <ul class="list-unstyled mb-0" id="final_list">

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal modal-borderless fade text-left show" id="candidate_voting_list" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-modal="true">
    <div class="modal-dialog  modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="myModalLabel1">لیست آرا <b id="candidate_name_vote_list" class="text-success"></b></h3>
                <button type="button" class="close rounded-pill" data-dismiss="modal" aria-label="بستن">
                    <i class="bx bx-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>ردیف</th>
                            <th>نام و نام خانوادگی</th>
                            <th>نام کاربری</th>
                        </tr>
                        </thead>
                        <tbody id="candidate_voting_list_table">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal modal-borderless fade text-left show" id="voting_device_data_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-modal="true"1>
    <div class="modal-dialog  modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="myModalLabel1">اطلاعات موبایل یا رایانه ثبت رای</h3>
                <button type="button" class="close rounded-pill" data-dismiss="modal" aria-label="بستن">
                    <i class="bx bx-x"></i>
                </button>
            </div>
            <div class="modal-body" id="final_list2">
            </div>
        </div>
    </div>
</div>







