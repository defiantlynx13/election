<body class="vertical-layout vertical-menu-modern 2-columns navbar-sticky footer-static menu-expanded pace-done" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns"><div class="pace  pace-inactive"><div class="pace-progress" data-progress-text="100%" data-progress="99" style="transform: translate3d(-100%, 0px, 0px);">
        <div class="pace-progress-inner"></div>
    </div>
    <div class="pace-activity"></div></div>

<?php

use Plugin_Name_Dir\Includes\Functions\Utility;

Utility::load_template( 'general.header', compact( array('user_type_and_permissions','dash_assets_url','cu_id','user_info')), 'front' );
Utility::load_template( 'general.main-menu', compact( array('user_type_and_permissions','dash_assets_url','cu_id','user_info')), 'front' );
?>

<!-- BEGIN: Content-->
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body"><!-- Dashboard Ecommerce Starts -->
            <section id="dashboard-ecommerce">
                <div class="row">
                    <div class="col-xl-3 col-12 dashboard-latest-update">
                        <div class="card" style="height: 450px;">
                            <div class="card-header">
                                <h4 class="card-title">کاربر جدید</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <form  class="form" id="add_user_form"">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <div class="form-label-group controls position-relative has-icon-left">
                                                        <input type="text" id="add_user_name" class="form-control" name="add_user_name" placeholder="نام و نام خانوادگی">
                                                        <div class="form-control-position">
                                                            <i class="bx bx-user"></i>
                                                        </div>
                                                        <label for="add_user_name">نام و نام خانوادگی</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <div class="form-label-group controls position-relative has-icon-left">
                                                        <input type="text" id="add_user_work_position" class="form-control" name="add_user_work_position" placeholder="سمت کاری">
                                                        <div class="form-control-position">
                                                            <i class="bx bx-user"></i>
                                                        </div>
                                                        <label for="add_user_work_position">سمت کاری</label>
                                                        <div class="help-block"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <div class="form-label-group controls position-relative has-icon-left">
                                                        <input type="text" id="add_user_user_name" class="form-control" name="add_user_user_name" placeholder="نام کاربری">
                                                        <div class="form-control-position">
                                                            <i class="bx bx-user-check"></i>
                                                        </div>
                                                        <label for="add_user_user_name">نام کاربری</label>
                                                        <div class="help-block"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <div class="form-label-group controls position-relative has-icon-left">
                                                        <input type="password" id="add_user_password" class="form-control" name="add_user_password" placeholder="رمز عبور">
                                                        <div class="form-control-position">
                                                            <i class="bx bx-lock"></i>
                                                        </div>
                                                        <label for="add_user_password">رمز عبور</label>
                                                        <div class="help-block"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    <div class="clearfix">
                                        <button type="button" class="btn  btn-primary btn-block float-right" name="add_user_btn" id="add_user_btn">ثبت</button>
                                    </div>

                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-9 col-12 dashboard-marketing-campaign">
                        <div class="card marketing-campaigns">
                            <div class="card-header d-flex justify-content-between align-items-center pb-1">
                                <h4 class="card-title">کاربران</h4>
                                <i class="bx bx-dots-vertical-rounded font-medium-3 cursor-pointer"></i>
                            </div>
                            <div class="table-responsive ps">
                                <!-- table start -->
                                <table id="table_users" class="table table-borderless table-marketing-campaigns mb-0">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>نام کاربری</th>
                                        <th>نام و نام خانوادگی</th>
                                        <th>سمت کاری</th>
                                        <th>وضعیت</th>
                                        <th class="text-center">عملیات</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                                <!-- table ends -->
                                <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; left: 727px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Dashboard Ecommerce ends -->

        </div>
    </div>

    <div class="modal fade bd-example-modal-sm" id="chenge_pass_modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form" id="change_password_form">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-label-group position-relative has-icon-left">
                                        <input type="password" id="user_new_password" class="form-control" id="user_new_password" placeholder="رمز عبور جدید">
                                        <div class="form-control-position">
                                            <i class="bx bx-lock"></i>
                                        </div>
                                        <label for="user_new_password">رمز عبور جدید</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-label-group position-relative has-icon-left">
                                        <button type="button" class="btn btn-primary btn-block mr-1 mb-1" id="change_pass_submit">ثبت</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-sm" id="edit_user_modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">ویرایش کاربر</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form" id="edit_user_form">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-label-group position-relative has-icon-left">
                                        <input type="text" id="edit_user_fl_name" class="form-control"  placeholder="نام و نام خانوادگی">
                                        <div class="form-control-position">
                                            <i class="bx bx-user"></i>
                                        </div>
                                        <label for="edit_user_fl_name">رمز عبور جدید</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-label-group position-relative has-icon-left">
                                        <input type="text" id="edit_user_work_position" class="form-control"  placeholder="سمت کاری">
                                        <div class="form-control-position">
                                            <i class="bx bx-user-pin"></i>
                                        </div>
                                        <label for="edit_user_work_position">سمت کاری</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-label-group position-relative has-icon-left">
                                        <button type="button" class="btn btn-primary btn-block mr-1 mb-1" id="edit_user_submit">ویرایش</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- END: Content-->




