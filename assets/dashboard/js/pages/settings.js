jQuery(document).ready(function ($) {

    Validator.useLang('fa');
    Validator.register('mobile', function (val) {
        return val.match(/^09[0-9]{9}$/g);
    }, 'شماره موبایل اشتباه است');

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
            mobile: 'required|phone',
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
                            $('#auth_forms_countainer').append(' <form class="mb-2" id="confirm_opt_form" method="post"  novalidate>\n' +
                                '                                                <div class="form-group form-label-group position-relative has-icon-left">\n' +
                                '                                                    <fieldset>\n' +
                                '                                                        <div class="input-group">\n' +
                                '                                                            <div class="input-group-prepend">\n' +
                                '                                                                <span class="input-group-text">کد تایید</span>\n' +
                                '                                                            </div>\n' +
                                '                                                            <input type="text"  class="form-control text-center"\n' +
                                '                                                                   id="otp"\n' +
                                '                                                                   name="otp"\n' +
                                '                                                                   placeholder=" - - - - "\n' +
                                '                                                                   dir="ltr"\n' +
                                '                                                                   aria-invalid="true">\n' +
                                '                                                            <input type="hidden" id="confirm_mobile" name="confirm_mobile" value="'+result.mobile+'">\n' +
                                '                                                            <div class="input-group-append">\n' +
                                '                                                                <span class="input-group-text" dir="ltr"><span id="timer"></span></span>\n' +
                                '                                                            </div>\n' +
                                '                                                        </div>\n' +
                                '                                                    </fieldset>\n' +
                                '                                                </div>\n' +
                                '\n' +
                                '                                                <button type="button"  disabled="disabled" name="confirm_otp_code_button"  id="confirm_otp_code_button" class="btn btn-primary glow position-relative w-100">\n' +
                                '                                                    ورود به پنل کاربری\n' +
                                '                                                    <i id="icon-arrow" class="bx bx-log-in-circle"></i></button>\n' +
                                '                                            </form>');

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
                    }
                }
            });
        }
    });


    $(document).on("keypress change", "#otp", function() {
        if($(this).val().length == 3)
        {
            $('#confirm_otp_code_button').prop('disabled', false);
        }
    });
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
                    data :FormsData,
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
                                window.location.replace('/panel');
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

                    }
                }
            });
        }

    });



    $('#send-code-register-btn').click(function () {
        $(this).html("");
        $(this).attr('disabled', 'disabled');
        $(this).html('  <span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>\n' +
            '  ');
        $('#register_form').trigger('submit');
    });
    $('form#register_form').on("submit", function (e) {
        e.preventDefault();
        var $inputs = $('form#register_form :input');
        var FormsData = {};
        $inputs.each(function () {
            FormsData[this.name] = $(this).val();
        });

        let validation = new Validator({
            mobile: FormsData.register_mobile,
        }, {
            mobile: 'required|mobile',
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

            if (validation.errors.errors.mobile && validation.errors.errors.mobile.length > 0) {
                toastr.error(validation.errors.errors.mobile[0]);
                $('#register_mobile').addClass('my-red-border');
            }

            $('#send-code-register-btn').html("ثبت نام").removeAttr("disabled");
        }
        else
        {
            $.ajax({
                type: "POST",
                url: myData.ajax_url,
                data :{
                    action : 'send_register_code',
                    data :FormsData
                },
                success:function (result)
                {
                    toastr.options = {
                        timeOut: 3000,
                        progressBar: true,
                        showMethod: "slideDown",
                        hideMethod: "slideUp",
                        showDuration: 200,
                        hideDuration: 200
                    };

                    switch (result.status)
                    {
                        case 'true':
                            toastr.success('کد تایید به همراه شما ارسال گردید!');
                            $('#send-code-register-btn').html("ارسال کد تایید شماره همراه").removeAttr("disabled");
                            $('#register_form').hide();
                            $('#set_user_info_form').show();

                            $('#register_confirm_btn').attr('data-mobile',result.mobile);


                            var timer3 = "03:00";
                            var interval = setInterval(function() {
                                var timer = timer3.split(':');
                                //by parsing integer, I avoid all extra string processing
                                var minutes = parseInt(timer[0], 10);
                                var seconds = parseInt(timer[1], 10);
                                --seconds;
                                minutes = (seconds < 0) ? --minutes : minutes;
                                seconds = (seconds < 0) ? 59 : seconds;
                                seconds = (seconds < 10) ? '0' + seconds : seconds;
                                //minutes = (minutes < 10) ?  minutes : minutes;
                                $('.countdown-register').html(minutes + ':' + seconds);
                                if (minutes < 0) clearInterval(interval);
                                //check if both minutes and seconds are 0
                                if ((seconds <= 0) && (minutes <= 0))
                                {
                                    clearInterval(interval);
                                    $('#register_form').show();
                                    $('#set_user_info_form').hide();
                                    $('#register_code').removeClass('my-red-border').val('');
                                    $('#register_password').removeClass('my-red-border').val('');
                                    $('#register_fname').removeClass('my-red-border').val('');
                                    $('#register_lname').removeClass('my-red-border').val('');
                                    $.ajax({
                                        type: "POST",
                                        url: myData.ajax_url,
                                        data: {
                                            action: 'delete_all_sended_code',
                                            mobile: result.mobile,
                                        },
                                        success: function (result) {
                                        }
                                    });
                                    toastr.error('کد ارسالی به همراه شما منقضی شده است! لطفا مجدد تلاش نمایید.');
                                }

                                timer3 = minutes + ':' + seconds;
                            }, 1000);

                            break;
                        case 'false':
                            toastr.error(result.msg);
                            $('#send-code-register-btn').html("ارسال کد تایید شماره همراه").removeAttr("disabled");
                            break;
                        case 'user_exist':
                            toastr.error('کاربری با این شماره همراه قبلا ثبت شده است! از صفحه بازگردانی رمز استفاده نمایید.');
                            var ref=getUrlVars()["ref"];
                            if (ref != undefined)
                            {
                                setTimeout(function() {
                                    window.location.replace('/recover-password?ref='+ref);
                                }, 3000);
                            }
                            else
                            {
                                setTimeout(function() {
                                    window.location.replace('/recover-password');
                                }, 3000);
                            }

                            break;
                    }
                }
            });
        }

    });



    $('#register_confirm_btn').click(function () {
        $(this).html("");
        $(this).attr('disabled', 'disabled');
        $(this).html('  <span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>\n' +
            '  ');
        $('#set_user_info_form').trigger('submit');
    });

    $('form#set_user_info_form').on("submit", function (e) {
        e.preventDefault();
        var $inputs = $('form#set_user_info_form :input');
        var FormsData = {};
        $inputs.each(function () {
            FormsData[this.name] = $(this).val();
        });

        var $button = $('form#set_user_info_form :button');

        $button.each(function () {
            if(this.id == 'register_confirm_btn')
            {
                FormsData['mobile'] = $(this).data('mobile');
            }
        });
        let validation = new Validator({
            code : FormsData.register_code,
            password : FormsData.register_password,
            f_name : FormsData.register_fname,
            l_name : FormsData.register_lname,
        }, {
            code: 'required',
            password:'required',
            f_name: 'required',
            l_name: 'required',
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

            if (validation.errors.errors.code) {
                toastr.error(validation.errors.errors.code[0]);
                $('#register_code').addClass('my-red-border');
            }

            if (validation.errors.errors.password) {
                toastr.error(validation.errors.errors.password[0]);
                $('#register_password').addClass('my-red-border');
            }

            if (validation.errors.errors.f_name) {
                toastr.error(validation.errors.errors.f_name[0]);
                $('#register_fname').addClass('my-red-border');
            }

            if (validation.errors.errors.l_name) {
                toastr.error(validation.errors.errors.l_name[0]);
                $('#register_lname').addClass('my-red-border');
            }

            $('#register_confirm_btn').html("ثبت نام").removeAttr("disabled");
        }
        else
        {
            $.ajax({
                type: "POST",
                url: myData.ajax_url,
                data :{
                    action : 'aral_register_user',
                    data :FormsData
                },
                success:function (result)
                {
                    toastr.options = {
                        timeOut: 3000,
                        progressBar: true,
                        showMethod: "slideDown",
                        hideMethod: "slideUp",
                        showDuration: 200,
                        hideDuration: 200
                    };

                    switch (result.status)
                    {
                        case 'verify_code':
                            toastr.success('ثبت نام شما با موفقیت انجام شد!');

                            $('#send-code-register-btn').html("ارسال کد تایید شماره همراه").removeAttr("disabled");
                            $('#register_form').show();
                            $('#set_user_info_form').hide();
                            var ref=getUrlVars()["ref"];
                            if (ref != undefined)
                            {
                                setTimeout(function() {
                                    window.location.replace(ref);
                                }, 3000);
                            }
                            else
                            {
                                setTimeout(function() {
                                    window.location.replace('/');
                                }, 3000);
                            }
                            break;
                        case 'not_verify_code':
                            toastr.error('کد تایید وارد شده مطابقت ندارد!');
                            $('#register_confirm_btn').html("ثبت نام").removeAttr("disabled");
                            break;
                    }
                }
            });
        }

    });


    function getUrlVars()
    {
        var vars = [], hash;
        var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
        for(var i = 0; i < hashes.length; i++)
        {
            hash = hashes[i].split('=');
            vars.push(hash[0]);
            vars[hash[0]] = hash[1];
        }
        return vars;
    }


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
        $('#auth_forms_countainer').append(' <form class="mb-2" id="send_opt_form" method="post"  novalidate>\n' +
                '                                                <div class="form-group form-label-group position-relative has-icon-left">\n' +
                '                                                    <fieldset>\n' +
                '                                                        <div class="input-group">\n' +
                '                                                            <div class="input-group-prepend">\n' +
                '                                                                <span class="input-group-text">موبایل</span>\n' +
                '                                                            </div>\n' +
                '                                                            <input type="text"  class="form-control text-center"\n' +
                '                                                                   id="mobile"\n' +
                '                                                                   name="mobile"\n' +
                '                                                                   placeholder="۰ ۹ - -  - - -  - - -"\n' +
                '                                                                   dir="ltr"\n' +
                '                                                                   required=""\n' +
                '                                                                   data-validation-required-message="وارد کردن موبایل الزامی است"\n' +
                '                                                                   pattern="09(1[0-9]|3[1-9]|2[1-9])-?[0-9]{3}-?[0-9]{4}"\n' +
                '                                                                   data-validation-pattern-message="موبایل وارد شده نامعتبر است."\n' +
                '                                                                   aria-invalid="true">\n' +
                '                                                            <div class="input-group-append">\n' +
                '                                                                <span class="input-group-text" dir="ltr"> <i class="bx bx-phone"></i></span>\n' +
                '                                                            </div>\n' +
                '                                                            <p class="help-block"></p>\n' +
                '                                                        </div>\n' +
                '                                                    </fieldset>\n' +
                '                                                </div>\n' +
                '\n' +
                '                                                <button type="button"  name="get_otp_code_button"  id="get_otp_code_button" class="btn btn-primary glow position-relative w-100">\n' +
                '                                                    دریافت کد تایید بروی موبایل\n' +
                '                                                    <i id="icon-arrow" class="bx bx-message-square-dots"></i></button>\n' +
                '                                            </form>');
    }



});

