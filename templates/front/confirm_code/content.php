
<!-- BEGIN: Content-->
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body"><!-- reset password start -->
            <section class="row flexbox-container">
                <div class="col-xl-7 col-10">
                    <div class="card bg-authentication mb-0">
                        <div class="row m-0">
                            <!-- left section-login -->
                            <div class="col-md-6 col-12 px-0">
                                <div class="card disable-rounded-right d-flex justify-content-center mb-0 p-2 h-100">
                                    <div class="card-header pb-1">
                                        <div class="card-title">
                                            <h6 class="text-center mb-2"> پنجمین دوره انتخابات </h6>
                                            <h5 class="text-center mb-2">هیئت مدیره و بازرسی نظام کاردانی  </h5>
                                            <h6 class="text-center mb-2">استان خراسان جنوبی </h6>
                                        </div>
                                    </div>
                                    <div class="card-content">
                                        <div class="card-body">
                                            <form class="mb-2" method="post" action="<?php echo home_url('otp_verification')?>" novalidate>
                                                <div class="form-group form-label-group position-relative has-icon-left">
                                                    <label class="text-bold-700" for="mobile">موبایل</label>
                                                    <input type="text"  class="form-control text-center"
                                                           id="mobile"
                                                           name="mobile"
                                                           placeholder="۰ ۹ - -  - - -  - - -"
                                                           dir="ltr"
                                                           required=""
                                                           data-validation-required-message="وارد کردن موبایل الزامی است"
                                                           pattern="09(1[0-9]|3[1-9]|2[1-9])-?[0-9]{3}-?[0-9]{4}"
                                                           data-validation-pattern-message="موبایل وارد شده نامعتبر است."
                                                           aria-invalid="true">
                                                    <p class="help-block"></p>
                                                    <div class="form-control-position">
                                                        <i class="bx bx-phone"></i>
                                                    </div>
                                                </div>

                                                <button type="submit"  name="get_otp_code_button" class="btn btn-primary glow position-relative w-100">
                                                    دریافت رمز ورود بروی موبایل
                                                    <i id="icon-arrow" class="bx bx-message-square-dots"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- right section image -->
                            <div class="col-md-6 d-md-block d-none text-center align-self-center p-3">
                                <img class="img-fluid" src="<?php echo $dash_assets_url.'images/pages/otp_icon.png'?>" alt="branding logo">
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- reset password ends -->

        </div>
    </div>
</div>
<!-- END: Content-->