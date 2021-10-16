

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
            <div class="content-header-left col-12 mb-2 mt-1">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h5 class="content-header-title float-left pr-1">ثبت رای</h5>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb p-0 mb-0">
                                <li class="breadcrumb-item"><a href="<?php echo home_url('panel')?>"><i class="bx bx-home-alt"></i></a>
                                </li>
                                <li class="breadcrumb-item active"><a href="<?php echo home_url('panel')?>">ثبت رای</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body"><!-- Dashboard Analytics Start -->
            <section id="candidate_list_content">
                <div class="row">
                    <div class="col-md-8 offset-md-2  col-12 dashboard-marketing-campaign">
                        <div class="alert bg-rgba-secondary alert-dismissible mb-2" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="بستن">
                                <span aria-hidden="true">×</span>
                            </button>
                            <div class="d-flex align-items-center">
                                <i class="bx bxs-info-circle"></i>
                                <span>
                                    جهت مشاهده مشخصات نمایندهُ برروی تصویر نماینده کلیک نمایید!
                                </span>
                            </div>
                        </div>
                        <div class="alert bg-rgba-primary alert-dismissible mb-2" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="بستن">
                                <span aria-hidden="true">×</span>
                            </button>
                            <div class="d-flex align-items-center">
                                <i class="bx bxs-info-circle"></i>
                                <span>
                                  برای انتخاب نماینده مورد نظرتان ار ردیف (کد انتخاباتی) استفاده نمایید!
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 offset-md-3  col-12 dashboard-marketing-campaign">
                        <div class="card marketing-campaigns">
                            <div class="card-header d-flex justify-content-between align-items-center pb-1">
                                <h4 class="card-title">لیست نامزدها</h4>
                                <i class="bx bx-dots-vertical-rounded font-medium-3 cursor-pointer"></i>
                            </div>
                            <div class="table-responsive">
                                <table class="table  table-striped table-hover mb-0" id="table_candidate">
                                    <thead>
                                    <tr>
                                        <th>کد انتخاباتی</th>
                                        <th>نام و نام خانوادگی</th>
                                        <th>رشته تحصیلی</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr class="group">
                                        <td colspan="3">کاندیدهای سمت بازرسی</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <fieldset>
                                                <div class="checkbox">
                                                    <input type="checkbox" class="checkbox-input" id="508" name="508" data-fl_name="محمد رضا تیزکاری" data-group="بازرسی" data-field="بازرس">
                                                    <label for="508">508</label>
                                                </div>
                                            </fieldset>
                                        </td>
                                        <td class="w-45 pr-0 candidate_fl_name_click" style="cursor: pointer;">
                                            <div class="d-flex align-items-center text-bold-500">
                                                <!--                                                    <img class="rounded-circle mr-1" src="--><!--" alt="avatar" height="32" width="32">-->
                                                <img class="rounded-circle mr-1" src="https://snk-kj.ir/wp-content/uploads/2021/07/WhatsApp-Image-2021-07-07-at-9.59.06-AM-150x150.jpeg" alt="avatar" height="32" width="32">
                                                <div class="flex-content" id="candidate_fl_name">
                                                    محمد رضا تیزکاری                                                        <input type="hidden" value="508">
                                                </div>
                                            </div>
                                        </td>
                                        <td class="w-45 pr-0  text-bold-500">برق و قدرت</td>
                                    </tr>
                                    <tr >
                                        <td>
                                            <fieldset>
                                                <div class="checkbox">
                                                    <input type="checkbox" class="checkbox-input" id="101" name="101" data-fl_name="امین دره گی" data-group="بازرسی" data-field="بازرس">
                                                    <label for="101">101</label>
                                                </div>
                                            </fieldset>
                                        </td>
                                        <td class="w-45 pr-0 candidate_fl_name_click" style="cursor: pointer;">
                                            <div class="d-flex align-items-center text-bold-500">
                                                <!--                                                    <img class="rounded-circle mr-1" src="--><!--" alt="avatar" height="32" width="32">-->
                                                <img class="rounded-circle mr-1" src="https://snk-kj.ir/wp-content/uploads/2021/07/WhatsApp-Image-2021-07-07-at-10.00.29-AM-150x150.jpeg" alt="avatar" height="32" width="32">
                                                <div class="flex-content" id="candidate_fl_name">
                                                    امین دره گی                                                        <input type="hidden" value="101">
                                                </div>
                                            </div>
                                        </td>
                                        <td class="w-45 pr-0  text-bold-500">نقشه کشی معماری</td>
                                    </tr>
                                    <tr class="group">
                                        <td colspan="3">کاندیدهای رشته عمران </td>
                                    </tr>
                                    <tr >
                                        <td>
                                            <fieldset>
                                                <div class="checkbox">
                                                    <input type="checkbox" class="checkbox-input" id="309" name="309" data-fl_name="علیرضا کیانی" data-group="عمران" data-field="عمران">
                                                    <label for="309">309</label>
                                                </div>
                                            </fieldset>
                                        </td>
                                        <td class="w-45 pr-0 candidate_fl_name_click" style="cursor: pointer;">
                                            <div class="d-flex align-items-center text-bold-500">
                                                <!--                                                    <img class="rounded-circle mr-1" src="--><!--" alt="avatar" height="32" width="32">-->
                                                <img class="rounded-circle mr-1" src="https://snk-kj.ir/wp-content/uploads/2021/07/WhatsApp-Image-2021-07-07-at-10.01.06-AM-150x150.jpeg" alt="avatar" height="32" width="32">
                                                <div class="flex-content" id="candidate_fl_name">
                                                    علیرضا کیانی                                                        <input type="hidden" value="309">
                                                </div>
                                            </div>
                                        </td>
                                        <td class="w-45 pr-0  text-bold-500">عمران -کارهای عمومی ساختمان</td>
                                    </tr>
                                    <tr >
                                        <td>
                                            <fieldset>
                                                <div class="checkbox">
                                                    <input type="checkbox" class="checkbox-input" id="301" name="301" data-fl_name="مهدی آرزومندان"  data-group="عمران" data-field="عمران">
                                                    <label for="301">301</label>
                                                </div>
                                            </fieldset>
                                        </td>
                                        <td class="w-45 pr-0 candidate_fl_name_click" style="cursor: pointer;">
                                            <div class="d-flex align-items-center text-bold-500">
                                                <!--                                                    <img class="rounded-circle mr-1" src="--><!--" alt="avatar" height="32" width="32">-->
                                                <img class="rounded-circle mr-1" src="https://snk-kj.ir/wp-content/uploads/2021/07/WhatsApp-Image-2021-07-07-at-10.02.28-AM-150x150.jpeg" alt="avatar" height="32" width="32">
                                                <div class="flex-content" id="candidate_fl_name">
                                                    مهدی آرزومندان                                                        <input type="hidden" value="301">
                                                </div>
                                            </div>
                                        </td>
                                        <td class="w-45 pr-0  text-bold-500">عمران -کارهای عمومی ساختمان</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <fieldset>
                                                <div class="checkbox">
                                                    <input type="checkbox" class="checkbox-input" id="303" name="303" data-fl_name="سید حسین رضوی"  data-group="عمران" data-field="عمران">
                                                    <label for="303">303</label>
                                                </div>
                                            </fieldset>
                                        </td>
                                        <td class="w-45 pr-0 candidate_fl_name_click" style="cursor: pointer;">
                                            <div class="d-flex align-items-center text-bold-500">
                                                <!--                                                    <img class="rounded-circle mr-1" src="--><!--" alt="avatar" height="32" width="32">-->
                                                <img class="rounded-circle mr-1" src="https://snk-kj.ir/wp-content/uploads/2021/09/Picture1.png" alt="avatar" height="32" width="32">
                                                <div class="flex-content" id="candidate_fl_name">
                                                    سید حسین رضوی                                                        <input type="hidden" value="303">
                                                </div>
                                            </div>
                                        </td>
                                        <td class="w-45 pr-0  text-bold-500">عمران -کارهای عمومی ساختمان</td>
                                    </tr>
                                    <tr class="group">
                                        <td colspan="3">کاندیدهای رشته معماری و شهرسازی </td>
                                    </tr>
                                    <tr >
                                        <td>
                                            <fieldset>
                                                <div class="checkbox">
                                                    <input type="checkbox" class="checkbox-input" id="102" name="102" data-fl_name="رحمان روبیاتی" data-group="معماری -شهرسازی" data-field="معماری">
                                                    <label for="102">102</label>
                                                </div>
                                            </fieldset>
                                        </td>
                                        <td class="w-45 pr-0 candidate_fl_name_click" style="cursor: pointer;">
                                            <div class="d-flex align-items-center text-bold-500">
                                                <!--                                                    <img class="rounded-circle mr-1" src="--><!--" alt="avatar" height="32" width="32">-->
                                                <img class="rounded-circle mr-1" src="https://snk-kj.ir/wp-content/uploads/2021/07/WhatsApp-Image-2021-07-07-at-10.00.49-AM-150x150.jpeg" alt="avatar" height="32" width="32">
                                                <div class="flex-content" id="candidate_fl_name">
                                                    رحمان روبیاتی                                                        <input type="hidden" value="102">
                                                </div>
                                            </div>
                                        </td>
                                        <td class="w-45 pr-0  text-bold-500">نقشه کشی معماری</td>
                                    </tr>
                                    <tr >
                                        <td>
                                            <fieldset>
                                                <div class="checkbox">
                                                    <input type="checkbox" class="checkbox-input" id="103" name="103" data-fl_name="حسین هاشمی فرد" data-group="معماری -شهرسازی" data-field="معماری">
                                                    <label for="103">103</label>
                                                </div>
                                            </fieldset>
                                        </td>
                                        <td class="w-45 pr-0 candidate_fl_name_click" style="cursor: pointer;">
                                            <div class="d-flex align-items-center text-bold-500">
                                                <!--                                                    <img class="rounded-circle mr-1" src="--><!--" alt="avatar" height="32" width="32">-->
                                                <img class="rounded-circle mr-1" src="https://snk-kj.ir/wp-content/uploads/2021/09/Picture1-1.png" alt="avatar" height="32" width="32">
                                                <div class="flex-content" id="candidate_fl_name">
                                                    حسین هاشمی فرد                                                        <input type="hidden" value="103">
                                                </div>
                                            </div>
                                        </td>
                                        <td class="w-45 pr-0  text-bold-500">معماری</td>
                                    </tr>
                                    <tr class="group">
                                        <td colspan="3">کاندیدهای رشته نقشه برداری </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <fieldset>
                                                <div class="checkbox">
                                                    <input type="checkbox" class="checkbox-input" id="604" name="604" data-fl_name="محمد فدوی" data-group="نقشه برداری" data-field="نقشه برداری">
                                                    <label for="604">604</label>
                                                </div>
                                            </fieldset>
                                        </td>
                                        <td class="w-45 pr-0 candidate_fl_name_click" style="cursor: pointer;">
                                            <div class="d-flex align-items-center text-bold-500">
                                                <!--                                                    <img class="rounded-circle mr-1" src="--><!--" alt="avatar" height="32" width="32">-->
                                                <img class="rounded-circle mr-1" src="https://snk-kj.ir/wp-content/uploads/2021/09/Picture1-2.png" alt="avatar" height="32" width="32">
                                                <div class="flex-content" id="candidate_fl_name">
                                                    محمد فدوی                                                       <input type="hidden" value="604">
                                                </div>
                                            </div>
                                        </td>
                                        <td class="w-45 pr-0  text-bold-500">نقشه برداری</td>
                                    </tr>
                                    <tr class="group">
                                        <td colspan="3">کاندیدهای تاسیسات برقی  </td>
                                    </tr>
                                    <tr >
                                        <td>
                                            <fieldset>
                                                <div class="checkbox">
                                                    <input type="checkbox" class="checkbox-input" id="501" name="501" data-fl_name="محمد رضا حسنی" data-group=" تاسیسات برقی" data-field="برق">
                                                    <label for="501">501</label>
                                                </div>
                                            </fieldset>
                                        </td>
                                        <td class="w-45 pr-0 candidate_fl_name_click" style="cursor: pointer;">
                                            <div class="d-flex align-items-center text-bold-500">
                                                <!--                                                    <img class="rounded-circle mr-1" src="--><!--" alt="avatar" height="32" width="32">-->
                                                <img class="rounded-circle mr-1" src="https://snk-kj.ir/wp-content/uploads/2021/07/WhatsApp-Image-2021-07-07-at-10.03.31-AM-150x150.jpeg" alt="avatar" height="32" width="32">
                                                <div class="flex-content" id="candidate_fl_name">
                                                    محمد رضا حسنی                                                        <input type="hidden" value="501">
                                                </div>
                                            </div>
                                        </td>
                                        <td class="w-45 pr-0  text-bold-500">برق و قدرت</td>
                                    </tr>
                                    <tr class="group">
                                        <td colspan="3">کاندیدهای تاسیسات مکانیکی  </td>
                                    </tr>
                                    <tr >
                                        <td>
                                            <fieldset>
                                                <div class="checkbox">
                                                    <input type="checkbox" class="checkbox-input" id="403" name="403" data-fl_name="محمد نخعی" data-group="تاسیسات مکانیکی" data-field="مکانیک">
                                                    <label for="403">403</label>
                                                </div>
                                            </fieldset>
                                        </td>
                                        <td class="w-45 pr-0 candidate_fl_name_click" style="cursor: pointer;">
                                            <div class="d-flex align-items-center text-bold-500">
                                                <!--                                                    <img class="rounded-circle mr-1" src="--><!--" alt="avatar" height="32" width="32">-->
                                                <img class="rounded-circle mr-1" src="https://snk-kj.ir/wp-content/uploads/2021/07/WhatsApp-Image-2021-07-07-at-9.59.45-AM-150x150.jpeg" alt="avatar" height="32" width="32">
                                                <div class="flex-content" id="candidate_fl_name">
                                                    محمد نخعی                                                        <input type="hidden" value="403">
                                                </div>
                                            </div>
                                        </td>
                                        <td class="w-45 pr-0  text-bold-500">مکانیک-تاسیسات آبرسانی و گازرسانی</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <fieldset>
                                                <div class="checkbox">
                                                    <input type="checkbox" class="checkbox-input" id="402" name="402" data-fl_name="غلامعلی چمنی" data-group="تاسیسات مکانیکی" data-field="مکانیک">
                                                    <label for="402">402</label>
                                                </div>
                                            </fieldset>
                                        </td>
                                        <td class="w-45 pr-0 candidate_fl_name_click" style="cursor: pointer;">
                                            <div class="d-flex align-items-center text-bold-500">
                                                <!--                                                    <img class="rounded-circle mr-1" src="--><!--" alt="avatar" height="32" width="32">-->
                                                <img class="rounded-circle mr-1" src="https://snk-kj.ir/wp-content/uploads/2021/07/WhatsApp-Image-2021-07-07-at-10.01.26-AM-150x150.jpeg" alt="avatar" height="32" width="32">
                                                <div class="flex-content" id="candidate_fl_name">
                                                    غلامعلی چمنی                                                        <input type="hidden" value="402">
                                                </div>
                                            </div>
                                        </td>
                                        <td class="w-45 pr-0  text-bold-500">مکانیک-تاسیسات حرارتی</td>
                                    </tr>



                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
<!-- END: Content-->


<div class="buy-now" id="buy_now">
    <button type="button" class="btn btn-success" id="save_voting">
        <i class="bx bx-check"></i>
        <span class="align-middle ml-25">
            ثبت رای
        </span>
    </button>

</div>

<div class="modal modal-borderless fade text-left show" id="candidate_info" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-modal="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="myModalLabel1"> رزومه نامزد انتخاباتی</h3>
                <button type="button" class="close rounded-pill" data-dismiss="modal" aria-label="بستن">
                    <i class="bx bx-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-12">
                    <div class="row">
                        <div class="col-12 col-sm-3 text-center mb-1 mb-sm-0">
                            <img id="candidate_image" class="rounded" alt="group image" height="120" width="120">
                        </div>
                        <div class="col-12 col-sm-9">
                            <div class="row">
                                <div class="col-12 text-center text-sm-left">
                                    <h4 class="media-heading mb-0 primary-font" id="candidate_info_fl_name">
                                        cc
                                    </h4>
                                    <h6 class="text-muted align-top line-height-2">
                                        <span class="mr-1">
                                            <div class="badge badge-primary  d-inline-flex align-items-center mr-1 mb-1" >
                                              <span id="candidate_info_code" ></span>
                                            </div>
                                        </span>
                                    </h6>
                                </div>
                                <div class="col-12 text-center text-sm-left">
                                    <div class="mb-1 mt-50 line-height-2">
                                        <span class="mr-1">
                                            <div class="badge badge-secondary  d-inline-flex align-items-center mr-1 mb-1" >
                                              <span id="candidate_info_job" ></span>
                                            </div>
                                        </span>
                                        <span class="mr-1" >
                                            <div class="badge badge-info  d-inline-flex align-items-center mr-1 mb-1">
                                              <span id="candidate_info_group"></span>
                                            </div>
                                        </span>
                                        <span class="mr-1">
                                            <div class="badge badge-danger d-inline-flex align-items-center mr-1 mb-1">
                                              <span id="candidate_info_field"></span>
                                            </div>
                                        </span>
                                        <span class="mr-1">
                                            <div class="badge badge-warning d-inline-flex align-items-center mr-1 mb-1">
                                              <span id="candidate_info_field_study"></span>
                                            </div>
                                        </span>
                                        <span class="mr-1">
                                            <div class="badge badge-success d-inline-flex align-items-center mr-1 mb-1">
                                              <span id="candidate_info_university"></span>
                                            </div>
                                        </span>

                                    </div>
                                    <ul class="list-unstyled line-height-2 mb-1">
<!--                                        <li class="mb-1" id="candidate_info_birth_place"></li>-->
                                        <li class="mb-1" id="candidate_info_birthday"></li>
                                        <li class="mb-1" id="candidate_info_join_date"></li>
                                        <li class="mb-1" id="candidate_info_first_certificate_date"></li>
                                        <li class="mb-1" id="candidate_info_last_certificate_base"></li>
                                        <li class="mb-1" id="candidate_info_board_membership_history"></li>
                                    </ul>
<!--                                    <div>-->
<!--                                        <div class="badge badge-light-primary badge-round mr-1 mb-1" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="with 7% growth @valintini_007 is on top 5k"><i class="cursor-pointer bx bx-check-shield"></i>-->
<!--                                        </div>-->
<!--                                        <div class="badge badge-light-warning badge-round mr-1 mb-1" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="last 55% growth @valintini_007 is on weedday"><i class="cursor-pointer bx bx-badge-check"></i>-->
<!--                                        </div>-->
<!--                                        <div class="badge badge-light-success badge-round mb-1" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="got premium profile here"><i class="cursor-pointer bx bx-award"></i>-->
<!--                                        </div>-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<div class="modal modal-borderless fade text-left show" id="selected_candidates_list_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-modal="true" data-backdrop="false">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="myModalLabel1">لیست نامزدهای انتخاب شده شما</h3>
                <button type="button" class="close rounded-pill" data-dismiss="modal" aria-label="بستن">
                    <i class="bx bx-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <!-- table start -->
                    <table id="table-marketing-campaigns" class="table mb-0">
                        <thead>
                        <tr>
                            <th class="text-center">کد انتخاباتی</th>
                            <th  class="text-center">نام و نام خانوادگی</th>
                            <th  class="text-center">گروه-رشته </th>
                        </tr>
                        </thead>
                        <tbody id="selected_candidates_list_modal_tbody">

                        </tbody>
                    </table>
                    <!-- table ends -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success ml-1" data-dismiss="modal" id="save_my_candidate">
                    <span class="d-block">تایید و ثبت نهایی</span>
                </button>
            </div>
        </div>
    </div>
</div>
</div>
