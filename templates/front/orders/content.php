
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
        <div class="content-body">
            <section id="dashboard-ecommerce">
                <div class="row">
                    <div class="col-md-2 col-sm-12">
                        <button type="button" class="btn btn-success glow round my-2 compose-btn" id="new_order">
                            <i class="bx bx-plus"></i>
                            سفارش جدید
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12 col-12">
                        <div class="card ">
                            <div class="card-header d-flex justify-content-between align-items-center pb-1">
                                <h4 class="card-title"></h4>
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

        </div>
    </div>

    <div class="modal fade bd-example-modal-sm" id="new_order_modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">سفارش جدید </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form class="form mt-2 mb-2 repeater-default">
                        <div class="form-body">

                            <div class="divider divider-dashed divider-left divider-primary">
                                <div class="divider-text">مشخصات کلی سفارش</div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group validate">
                                        <label for="order_date2"> تاریخ ثبت</label>
                                        <div class="position-relative has-icon-left">
                                            <input type="text" class="form-control pwt-datepicker-input-element" name="order_date2" id="order_date2" placeholder="تاریخ سفارش" aria-invalid="false">
                                            <input type="hidden" id="order_date" name="order_date" value="1618757406" aria-invalid="false">
                                            <div class="form-control-position">
                                                <i class="bx bx-calendar"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="commodity_name">نام کالا</label>
                                        <div class="position-relative has-icon-left">
                                            <select class="select2 form-control" id="commodity_name" placeholder="نام کالا">
                                                <option value="square">مربع</option>
                                                <option value="rectangle">مستطیل</option>
                                                <option value="rombo">شش ضلعی</option>
                                                <option value="romboid">دایره</option>
                                                <option value="trapeze">بیضی</option>
                                                <option value="traible">مثلث</option>
                                                <option value="polygon">چند ضلعی</option>
                                            </select>
                                            <div class="form-control-position">
                                                <i class="bx stack-overflow"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="sale_to">فروش به</label>
                                        <div class="position-relative has-icon-left">
                                            <input type="number" class="form-control" id="sale_to" name="sale_to" placeholder="فروش به">
                                            <div class="form-control-position">
                                                <i class="bx bx-user"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="sale_type">نوع فروش</label>
                                        <div class="position-relative has-icon-left">
                                            <select class="select2 form-control" id="sale_type" name="sale_type" placeholder="نوع فروش">
                                                <option value="square">مربع</option>
                                                <option value="rectangle">مستطیل</option>
                                                <option value="rombo">شش ضلعی</option>
                                                <option value="romboid">دایره</option>
                                                <option value="trapeze">بیضی</option>
                                                <option value="traible">مثلث</option>
                                                <option value="polygon">چند ضلعی</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="sale_price">قیمت</label>
                                        <div class="position-relative has-icon-left">
                                            <input type="number" id="sale_price" class="form-control" name="sale_price" placeholder="قیمت فروش">
                                            <div class="form-control-position">
                                                <i class="bx bx-dollar"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="total_weight">وزن کل</label>
                                        <div class="position-relative has-icon-left">
                                            <input type="number" id="total_weight" class="form-control" name="total_weight" placeholder="وزن کل">
                                            <div class="form-control-position">
                                                <i class="bx bx-pie-chart-alt"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="total_scale">مقیاس</label>
                                        <div class="position-relative has-icon-left">
                                            <ul class="list-unstyled mb-0">
                                                <li class="d-inline-block mr-2 mb-1">
                                                    <fieldset>
                                                        <div class="radio radio-sm radio-primary">
                                                            <input type="radio" name="coloredRadio" id="colorRadio1" checked="">
                                                            <label for="colorRadio1">تناژ</label>
                                                        </div>
                                                    </fieldset>
                                                </li>
                                                <li class="d-inline-block mr-2 mb-1">
                                                    <fieldset>
                                                        <div class="radio radio-sm radio-secondary">
                                                            <input type="radio" name="coloredRadio" id="colorRadio2">
                                                            <label for="colorRadio2">کیلوگرم</label>
                                                        </div>
                                                    </fieldset>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="divider divider-dashed divider-left  divider-primary">
                                <div class="divider-text">لیست تامین کنندگان</div>
                            </div>

                            <div class="row">
                                <div class="col-md-11 offset-1">
                                    <div data-repeater-list="seller_list">
                                        <div data-repeater-item="">
                                            <div class="row justify-content-between">
                                                <div class="col-md-2 col-sm-12 form-group">
                                                    <label for="seller_list[0][buy_date]">تاریخ خرید</label>
                                                    <div class="position-relative has-icon-left">
                                                        <input type="text" class="form-control pwt-datepicker-input-element" name="seller_list[0][buy_date]" placeholder="تاریخ خرید" aria-invalid="false">
                                                        <input type="hidden" id="order_date" name="order_date" value="1618757406" aria-invalid="false">
                                                        <div class="form-control-position">
                                                            <i class="bx bx-calendar"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 col-sm-12 form-group">
                                                    <label for="buy_from">خرید از</label>s
                                                    <select name="seller_list[0][buy_from]"  class="form-control select2">
                                                        <option value="Male">مرد</option>
                                                        <option value="Female">زن</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-2 col-sm-12 form-group">
                                                    <label for="password">نوع خرید</label>
                                                    <input type="password" class="form-control" id="password" placeholder="رمز عبور را وارد کنید">
                                                </div>
                                                <div class="col-md-2 col-sm-12 form-group">
                                                    <label for="password">وزن</label>
                                                    <input type="password" class="form-control" id="password" placeholder="رمز عبور را وارد کنید">
                                                </div>
                                                <div class="col-md-2 col-sm-12 form-group">
                                                    <label for="password">مقیاس</label>
                                                    <ul class="list-unstyled mb-0">
                                                        <li class="d-inline-block mr-2 mb-1">
                                                            <fieldset>
                                                                <div class="radio radio-sm radio-primary">
                                                                    <input type="radio" name="coloredRadio" id="colorRadio1" checked="">
                                                                    <label for="colorRadio1">تناژ</label>
                                                                </div>
                                                            </fieldset>
                                                        </li>
                                                        <li class="d-inline-block mr-2 mb-1">
                                                            <fieldset>
                                                                <div class="radio radio-sm radio-secondary">
                                                                    <input type="radio" name="coloredRadio" id="colorRadio2">
                                                                    <label for="colorRadio2">کیلوگرم</label>
                                                                </div>
                                                            </fieldset>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-md-2 col-sm-12 form-group d-flex align-items-center pt-2">
                                                    <button class="btn btn-danger text-nowrap px-1" data-repeater-delete="" type="button"> <i class="bx bx-x"></i>
                                                        حذف
                                                    </button>
                                                </div>
                                            </div>
                                            <hr>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col p-0">
                                            <button class="btn btn-primary" data-repeater-create="" type="button" id="add_buy_from"><i class="bx bx-plus"></i>
                                                افزودن تامین کننده
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="divider divider-dashed divider-left  divider-primary">
                                <div class="divider-text">لیست تامین کنندگان</div>
                            </div>

                            <div class="row">
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary mr-1 mb-1">ثبت</button>
                                    <button type="reset" class="btn btn-light-secondary mr-1 mb-1">بازنشانی</button>
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




