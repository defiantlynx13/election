jQuery(document).ready(function ($) {

    Validator.useLang('fa');
    Validator.register('mobile', function (val) {
        return val.match(/^9[0-9]{9}$/g);
    }, 'شماره موبایل اشتباه است.بدون صفر وارد نمایید ');

    Validator.register('phone', function (val) {
        return (val.match(/^[1-9]{1}[0-9-]{6,7}$/g) || val.match(/^0[0-9-]{7,14}$/g) || val.match(/^[^0]{1}[0-9]{3}$/g) );
    }, 'شماره تلفن اشتباه است');

    const p2e = s => s.replace(/[۰-۹]/g, d => '۰۱۲۳۴۵۶۷۸۹'.indexOf(d))

    $(document).on("keydown","#mobile",function (e){
        if (e.keyCode == 13) {
            $('#get_otp_code_button').trigger('click');
            e.stopPropagation();
            return false;
        }
    });
    $(document).on("click","#get_otp_code_button",function (e){
        $(this).html("");
        $(this).attr('disabled', 'disabled');
        $(this).html('  <span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>\n' +
            '  ');
        $('#send_opt_form').trigger('submit');
    });
    $(document).on("submit","form#send_opt_form", function (e) {
        e.preventDefault();
        $('#mobile').removeClass('my-red-border');
        var $inputs = $('form#send_opt_form :input');
        var FormsData = {};
        $inputs.each(function () {
            FormsData[this.name] = p2e($(this).val());
        });

        let validation = new Validator({
            mobile: FormsData.mobile,
        }, {
            mobile: 'required|mobile',
        });

        if (validation.fails())
        {

            toastr.options = {
                timeOut: 3000,
                progressBar: true,
                showMethod: "slideDown",
                hideMethod: "slideUp",
                showDuration: 300,
                hideDuration: 300,
                rtl: true,
            };

            if (validation.errors.errors.mobile && validation.errors.errors.mobile.length > 0) {
                toastr.warning(validation.errors.errors.mobile[0]);
                $('#mobile').addClass('my-red-border');
            }
            $('#get_otp_code_button').attr('enable', 'enabled');
            $('#get_otp_code_button').html('دریافت کد تایید بروی موبایل'+'<i id="icon-arrow" className="bx bx-message-square-dots"></i>').removeAttr("disabled");
        }
        else
        {
            $.ajax({
                type: "POST",
                url: myData.ajax_url,
                data :{
                    action : 'send_code_to_mobile',
                    data :FormsData,
                    auth_nonce :myData.auth_nonce,
                },
                success:function (result)
                {
                    toastr.options = {
                        timeOut: 3000,
                        progressBar: true,
                        showMethod: "slideDown",
                        hideMethod: "slideUp",
                        showDuration: 300,
                        hideDuration: 300,
                        rtl: true,
                    };

                    switch (result.status)
                    {
                        case '1':
                            toastr.info(' کد تایید به شماره'+' '+result.mobile+' '+'ارسال گردید.');
                            $('#get_otp_code_button').attr('enable', 'enabled');
                            $('#get_otp_code_button').html('دریافت کد تایید بروی موبایل'+'<i id="icon-arrow" className="bx bx-message-square-dots"></i>').removeAttr("disabled");

                            $('#auth_forms_countainer').empty();
                            $('#auth_forms_countainer').append('<form class="mb-2" id="confirm_opt_form" method="post" novalidate="">\n' +
                                '                                                <div class="form-group">\n' +
                                '                                                    <label for="otp">کد تایید</label>\n' +
                                '                                                    <div class="position-relative has-icon-left">\n' +
                                '                                                        <input type="text"\n' +
                                '                                                               class="form-control text-center"\n' +
                                '                                                               id="otp" name="otp" placeholder=" - - - - "\n' +
                                '                                                               dir="ltr" aria-invalid="true">\n' +
                                '                                                        <div class="form-control-position">\n' +
                                '                                                            <i class="bx bx-envelope"></i>\n' +
                                '                                                        </div>\n' +
                                '                                                    </div>\n' +
                                '                                                    <input type="hidden" id="confirm_mobile" name="confirm_mobile" value="'+result.mobile+'">\n' +
                                '                                                    <div class="col-12 col-md-8 offset-md-4 form-group">\n' +
                                '                                                        <fieldset>\n' +
                                '                                                            زمان باقی مانده :\n' +
                                '                                                                <span id="timer"></span>\n' +
                                '                                                        </fieldset>\n' +
                                '                                                    </div>\n' +
                                '                                                </div>\n' +
                                '                                                <button type="button" name="confirm_otp_code_button" id="confirm_otp_code_button" class="btn btn-primary glow position-relative w-100">\n' +
                                '                                                    ورود به پنل کاربری\n' +
                                '                                                    <i id="icon-arrow" class="bx bx-log-in-circle"></i></button>\n' +
                                '                                            </form>\n');

                            timer(120);

                            break;
                        case '2':
                            toastr.error(result.msg);
                            $('#get_otp_code_button').attr('enable', 'enabled');
                            $('#get_otp_code_button').html('دریافت کد تایید بروی موبایل'+'<i id="icon-arrow" className="bx bx-message-square-dots"></i>').removeAttr("disabled");
                            break;
                        case '3':
                            toastr.error(result.msg);
                            $('#get_otp_code_button').attr('enable', 'enabled');
                            $('#get_otp_code_button').html('دریافت کد تایید بروی موبایل'+'<i id="icon-arrow" className="bx bx-message-square-dots"></i>').removeAttr("disabled");
                            break;
                        case '4':
                            toastr.error(result.msg);
                            $('#get_otp_code_button').attr('enable', 'enabled');
                            $('#get_otp_code_button').html('دریافت کد تایید بروی موبایل'+'<i id="icon-arrow" className="bx bx-message-square-dots"></i>').removeAttr("disabled");
                            break;
                    }
                }
            });
        }
    });


    // $(document).on("keypress change", "#otp", function() {
    //     if($(this).val().length == 3)
    //     {
    //         $('#confirm_otp_code_button').prop('disabled', false);
    //     }
    // });
    $(document).on("keydown", "#otp", function (e){
        if (e.keyCode == 13) {
            $('#confirm_otp_code_button').trigger('click');
            e.stopPropagation();
            return false;
        }
    });
    $(document).on("click","#confirm_otp_code_button",function(){
        $(this).html("");
        $(this).attr('disabled', 'disabled');
        $(this).html('  <span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>\n' +
            '  ');
        $('#confirm_opt_form').trigger('submit');
    });
    $(document).on("submit","form#confirm_opt_form", function (e) {
        e.preventDefault();
        $('#otp').removeClass('my-red-border');
        var $inputs = $('form#confirm_opt_form :input');
        var FormsData = {};
        $inputs.each(function () {
            FormsData[this.name] = $(this).val();
        });

        let validation = new Validator({
            otp: FormsData.otp,
        }, {
            otp: 'required|size:4'
        });

        if (validation.fails()) {
            toastr.options = {
                timeOut: 3000,
                progressBar: true,
                showMethod: "slideDown",
                hideMethod: "slideUp",
                showDuration: 200,
                hideDuration: 200
            };

            if (validation.errors.errors.otp && validation.errors.errors.otp.length > 0)
            {
                toastr.error(validation.errors.errors.otp[0]);
                $('#otp').addClass('my-red-border');
            }

            $('#confirm_otp_code_button').html(' ورود به پنل کاربری' +
                '                <i id="icon-arrow" className="bx bx-log-in-circle"></i>').removeAttr("disabled");

        }
        else
        {
            $.ajax({
                type: "POST",
                url: myData.ajax_url,
                data :{
                    action : 'confirm_code',
                    otp :toEnglishDigits(FormsData.otp),
                    confirm_mobile :toEnglishDigits(FormsData.confirm_mobile),
                    confirm_code_nonce :myData.confirm_code_nonce,
                },
                success:function (result)
                {
                    toastr.options = {
                        timeOut: 5000,
                        progressBar: true,
                        showMethod: "slideDown",
                        hideMethod: "slideUp",
                        showDuration: 200,
                        hideDuration: 200
                    };

                    switch (result.status)
                    {
                        case 'verify_code':
                            toastr.success('خوش آمدید!');
                            setTimeout(function() {
                                window.location.replace('/panel?panel_nonce='+myData.panel_nonce_login);
                            }, 3000);
                            break;
                        case 'not_verify_code':
                            toastr.error('کد تایید وارد شده با کد تایید ارسال شده به موبایل مطابقت ندارد!');
                            $('#confirm_otp_code_button').html(' ورود به پنل کاربری' +
                                '                <i id="icon-arrow" className="bx bx-log-in-circle"></i>').removeAttr("disabled");
                            break;

                        case 'code_mobile_not_set':
                            toastr.error('خطا در ارسال اطلاعات به سرور');
                            $('#confirm_otp_code_button').html(' ورود به پنل کاربری' +
                                '                <i id="icon-arrow" className="bx bx-log-in-circle"></i>').removeAttr("disabled");
                            break;
                        case 'security_issue':
                            toastr.error('خطای امنیتی رخ داده است!');

                            $('#auth_forms_countainer').empty();
                            $('#auth_forms_countainer').append('<form class="mb-2" id="send_opt_form" method="post" novalidate="">\n' +
                                '                                                <div class="form-group">\n' +
                                '                                                    <label for="mobile">موبایل (<b class="text-danger"> بدون صفر</b>)</b></label>\n' +
                                '                                                    <div class="position-relative has-icon-left">\n' +
                                '                                                        <input type="text" class="form-control text-center" id="mobile" name="mobile" placeholder="۹ - -  - - -  - - -" dir="ltr" required="" data-validation-required-message="وارد کردن موبایل الزامی است" pattern="09(1[0-9]|3[1-9]|2[1-9])-?[0-9]{3}-?[0-9]{4}" data-validation-pattern-message="موبایل وارد شده نامعتبر است." aria-invalid="true">\n' +
                                '                                                        <div class="form-control-position">\n' +
                                '                                                            <i class="bx bx-mobile"></i>\n' +
                                '                                                        </div>\n' +
                                '                                                    </div>\n' +
                                '                                                </div>\n' +
                                '\n' +
                                '                                                <button type="button" name="get_otp_code_button" id="get_otp_code_button" class="btn btn-primary glow position-relative w-100">\n' +
                                '                                                    دریافت کد تایید بروی موبایل\n' +
                                '                                                    <i id="icon-arrow" class="bx bx-message-square-dots"></i></button>\n' +
                                '                                            </form>');
                            break;

                    }
                }
            });
        }

    });



    let timerOn = true;

    function timer(remaining) {
        var m = Math.floor(remaining / 60);
        var s = remaining % 60;

        m = m < 10 ? '0' + m : m;
        s = s < 10 ? '0' + s : s;
        document.getElementById('timer').innerHTML = m + ':' + s;
        remaining -= 1;

        if(remaining >= 0 && timerOn) {
            setTimeout(function() {
                timer(remaining);
            }, 1000);
            return;
        }

        if(!timerOn) {
            // Do validate stuff here
            return;
        }

        // Do timeout stuff here
        toastr.options = {
            timeOut: 3000,
            progressBar: true,
            showMethod: "slideDown",
            hideMethod: "slideUp",
            showDuration: 300,
            hideDuration: 300,
            rtl: true,
        };
        toastr.warning('کد ارسالی منقضی گردید!');
        $('#auth_forms_countainer').empty();

        $('#auth_forms_countainer').append('<form class="mb-2" id="send_opt_form" method="post" novalidate="">\n' +
            '                                                <div class="form-group">\n' +
            '                                                    <label for="mobile">موبایل (<b class="text-danger"> بدون صفر</b>)</b></label>\n' +
            '                                                    <div class="position-relative has-icon-left">\n' +
            '                                                        <input type="text" class="form-control text-center" id="mobile" name="mobile" placeholder="۹ - -  - - -  - - -" dir="ltr" required="" data-validation-required-message="وارد کردن موبایل الزامی است" pattern="09(1[0-9]|3[1-9]|2[1-9])-?[0-9]{3}-?[0-9]{4}" data-validation-pattern-message="موبایل وارد شده نامعتبر است." aria-invalid="true">\n' +
            '                                                        <div class="form-control-position">\n' +
            '                                                            <i class="bx bx-mobile"></i>\n' +
            '                                                        </div>\n' +
            '                                                    </div>\n' +
            '                                                </div>\n' +
            '\n' +
            '                                                <button type="button" name="get_otp_code_button" id="get_otp_code_button" class="btn btn-primary glow position-relative w-100">\n' +
            '                                                    دریافت کد تایید بروی موبایل\n' +
            '                                                    <i id="icon-arrow" class="bx bx-message-square-dots"></i></button>\n' +
            '                                            </form>');
    }

    function toEnglishDigits(str) {

        // convert persian digits [۰۱۲۳۴۵۶۷۸۹]
        var e = '۰'.charCodeAt(0);
        str = str.replace(/[۰-۹]/g, function(t) {
            return t.charCodeAt(0) - e;
        });

        // convert arabic indic digits [٠١٢٣٤٥٦٧٨٩]
        e = '٠'.charCodeAt(0);
        str = str.replace(/[٠-٩]/g, function(t) {
            return t.charCodeAt(0) - e;
        });
        return str;
    }

    $('#election_help').click(function (){
        $('#election_helo_modal').modal('toggle');
    });

    var i18n =  {
        restart: 'شروع مجدد',
        rewind: 'Rewind {seektime}s',
        play: 'پخش',
        pause: 'مکث',
        fastForward: 'جلو کشیدن {seektime} ثانیه',
        seek: 'Seek',
        seekLabel: '{currentTime} از {duration}',
        played: 'پخش شده',
        buffered: 'بافر شده',
        currentTime: 'زمان کنونی',
        duration: 'مدت',
        volume: 'بلندی صدا',
        mute: 'بی صدا',
        unmute: 'با صدا',
        enableCaptions: 'فعال کردن زیرنویس',
        disableCaptions: 'غیر فعال کردن زیرنویس',
        download: 'دریافت',
        enterFullscreen: 'ورود به تمام صفحه',
        exitFullscreen: 'خروج از تمام صفحه',
        frameTitle: 'پخش کننده برای {title}',
        captions: 'زیرنویس ها',
        settings: 'تنظیمات',
        pip: 'تصویر در تصویر',
        menuBack: 'بازگشت به فهرست قبلی',
        speed: 'سرعت',
        normal: 'طبیعی',
        quality: 'کیفیت',
        loop: 'چرخه',
        start: 'شروع',
        end: 'پایان',
        all: 'همه',
        reset: 'بازنشانی',
        disabled: 'غیرفعال',
        enabled: 'فعال',
        advertisement: 'تبلیغات',
        qualityBadge: {
            2160: '4K',
            1440: 'HD',
            1080: 'HD',
            720: 'HD',
            576: 'SD',
            480: 'SD',
        },
    }

    // video player  define
    var player = new Plyr(".video-player", {
        i18n: i18n
    });

});

