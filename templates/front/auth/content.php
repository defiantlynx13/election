
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
                                            <div class="row">
                                                <div class="col-12 col-md-8 offset-md-2">
                                                    <div class="alert alert-warning mb-2 text-center" style="font-size: 0.7em" id="election_help" role="alert">
                                                        <i class="bx bx-play-circle"></i>
                                                        راهنمای سامانه
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-content">
                                        <div class="card-body" id="auth_forms_countainer">
                                            <form class="mb-2" id="send_opt_form" method="post"  novalidate>
                                                <div class="form-group">
                                                    <label for="mobile">موبایل (<b class="text-danger"> بدون صفر</b>)</b></label>
                                                    <div class="position-relative has-icon-left">
                                                        <input type="text"  class="form-control text-center"
                                                               id="mobile"
                                                               name="mobile"
                                                               placeholder="۹ - -  - - -  - - -"
                                                               dir="ltr"
                                                               required=""
                                                               data-validation-required-message="وارد کردن موبایل الزامی است"
                                                               pattern="09(1[0-9]|3[1-9]|2[1-9])-?[0-9]{3}-?[0-9]{4}"
                                                               data-validation-pattern-message="موبایل وارد شده نامعتبر است."
                                                               aria-invalid="true">
                                                        <div class="form-control-position">
                                                            <i class="bx bx-mobile"></i>
                                                        </div>
                                                    </div>
                                                </div>

                                                <button type="button"  name="get_otp_code_button"  id="get_otp_code_button" class="btn btn-primary glow position-relative w-100">
                                                    دریافت کد تایید
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
<div class="modal modal-borderless fade text-left" id="election_helo_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-modal="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close rounded-pill" data-dismiss="modal" aria-label="بستن">
                    <i class="bx bx-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <style>.h_iframe-aparat_embed_frame{position:relative;}.h_iframe-aparat_embed_frame .ratio{display:block;width:100%;height:auto;}.h_iframe-aparat_embed_frame iframe{position:absolute;top:0;left:0;width:100%;height:100%;}</style><div class="h_iframe-aparat_embed_frame"><span style="display: block;padding-top: 57%"></span><iframe src="https://www.aparat.com/video/video/embed/videohash/UOdwB/vt/frame" title="راهنمای سامانه" allowFullScreen="true" webkitallowfullscreen="true" mozallowfullscreen="true"></iframe></div>            </div>
        </div>
    </div>
</div>
