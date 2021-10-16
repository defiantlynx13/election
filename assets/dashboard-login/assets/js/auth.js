jQuery(document).ready(function ($) {
    Validator.useLang('fa');
    Validator.register('mobile', function (val) {
        return val.match(/^09[0-9]{9}$/g);
    }, 'شماره موبایل اشتباه است');
    Validator.register('phone', function (val) {
        return (val.match(/^[1-9]{1}[0-9-]{6,7}$/g) || val.match(/^0[0-9-]{7,14}$/g) || val.match(/^[^0]{1}[0-9]{3}$/g) );
    }, 'شماره تلفن اشتباه است');

    $('#login-btn').click(function () {
        $(this).html("");
        $(this).attr('disabled', 'disabled');
        $(this).html('  <span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>\n' +
            '  ');
        $('#login_form').trigger('submit');
    });

    $('form#login_form').on("submit", function (e) {
        e.preventDefault();
        $('#user_name').removeClass('my-red-border');
        $('#password').removeClass('my-red-border');
        var $inputs = $('form#login_form :input');
        var FormsData = {};
        $inputs.each(function () {
            FormsData[this.name] = $(this).val();
        });

        let validation = new Validator({
            user_name: FormsData.user_name,
            password: FormsData.password
        }, {
            user_name: 'required',
            password: 'required'
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

            if (validation.errors.errors.user_name && validation.errors.errors.user_name.length > 0) {
                toastr.error(validation.errors.errors.user_name[0]);
                $('#user_name').addClass('my-red-border');
            }

            if (validation.errors.errors.password && validation.errors.errors.password.length > 0) {
                toastr.error(validation.errors.errors.password[0]);
                $('#password').addClass('my-red-border');
            }

            $('#login-btn').html("ورود").removeAttr("disabled");
        }
        else
        {
            $.ajax({
                type: "POST",
                url: myData.ajax_url,
                data :{
                    action : 'user_login_process',
                     data :FormsData,
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
                        toastr.success('در حال انتقال به سامانه مدیریت سفارشات!');
                        setTimeout(function() {
                            location.reload();
                        }, 3000);
                    break;
                    case 'false':
                        toastr.error('نام کاربری یا رمز عبور اشتباه نادرست است!');
                        $('#login-btn').html("ورود").removeAttr("disabled");
                        break;
                    case 'npt_secure':
                        toastr.error('خطای امنیتی رخ داده است!');
                        break;
                }
            }
        });
        }

    });


    $('#send_code_btn').click(function () {
        $(this).html("");
        $(this).attr('disabled', 'disabled');
        $(this).html('  <span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>\n' +
            '  ');
        $('#rp_form').trigger('submit');
    });

    $('form#rp_form').on("submit", function (e) {
        e.preventDefault();
        $('#mobile').removeClass('my-red-border');
        var $inputs = $('form#rp_form :input');
        var FormsData = {};
        $inputs.each(function () {
            FormsData[this.name] = $(this).val();
        });

        let validation = new Validator({
            mobile: FormsData.mobile,
        }, {
            mobile: 'required|mobile'
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
                $('#mobile').addClass('my-red-border');
            }
            $('#send_code_btn').html("ارسال کد احراز هویت").removeAttr("disabled");
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
                        timeOut: 5000,
                        progressBar: true,
                        showMethod: "slideDown",
                        hideMethod: "slideUp",
                        showDuration: 200,
                        hideDuration: 200
                    };

                    switch (result.status)
                    {
                        case 'true':
                            toastr.success('کد احراز هویت به شماره همراه شما پیامک گردید!');
                            $('#send_code_btn').html("ارسال کد احراز هویت").removeAttr("disabled");
                            $('#rp_form').hide();
                            $('#confirm_code_form').show();
                            $('#confirm_code_btn').attr('data-mobile',result.mobile);
                            $('#new_password_btn').attr('data-mobile',result.mobile);


                            var timer2 = "03:00";
                            var interval = setInterval(function() {


                                var timer = timer2.split(':');
                                //by parsing integer, I avoid all extra string processing
                                var minutes = parseInt(timer[0], 10);
                                var seconds = parseInt(timer[1], 10);
                                --seconds;
                                minutes = (seconds < 0) ? --minutes : minutes;
                                seconds = (seconds < 0) ? 59 : seconds;
                                seconds = (seconds < 10) ? '0' + seconds : seconds;
                                //minutes = (minutes < 10) ?  minutes : minutes;
                                $('.countdown').html(minutes + ':' + seconds);
                                if (minutes < 0) clearInterval(interval);
                                //check if both minutes and seconds are 0
                                if ((seconds <= 0) && (minutes <= 0))
                                {
                                    clearInterval(interval);
                                    $('#rp_form').show();
                                    $('#confirm_code_form').hide();
                                    $('#code').removeClass('my-red-border').val('');
                                    $('#new_password').removeClass('my-red-border').val('');
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

                                timer2 = minutes + ':' + seconds;
                            }, 1000);

                            break;
                        case 'false':
                            toastr.error('خطایی رخ داده است، لطفا مجدد تلاش نمایید!');
                            $('#send_code_btn').html("ارسال کد احراز هویت").removeAttr("disabled");
                            break;

                        case 'user_not_exist':
                            toastr.error('شماره همراه وارد شده ثبت نشده است!');
                            $('#send_code_btn').html("ارسال کد احراز هویت").removeAttr("disabled");
                            break;

                    }
                }
            });
        }

    });



    $('#confirm_code_btn').click(function () {
        $(this).html("");
        $(this).attr('disabled', 'disabled');
        $(this).html('  <span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>\n' +
            '  ');
        $('#confirm_code_form').trigger('submit');
    });
    $('form#confirm_code_form').on("submit", function (e) {
        e.preventDefault();
        var $inputs = $('form#confirm_code_form :input');
        var FormsData = {};
        $inputs.each(function () {
            FormsData[this.name] = $(this).val();
        });

        var $buttons = $('form#confirm_code_form :button');
        $buttons.each(function () {
            if(this.name == 'confirm_code_btn')
            {
                FormsData[this.name] = $(this).data('mobile');
            }
        });

        let validation = new Validator({
            code: FormsData.code,
            new_password: FormsData.new_password,
        }, {
            code: 'required',
            new_password: 'required',
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

            if (validation.errors.errors.code && validation.errors.errors.code.length > 0) {
                toastr.error(validation.errors.errors.code[0]);
                $('#code').addClass('my-red-border');
            }

            if (validation.errors.errors.new_password && validation.errors.errors.new_password.length > 0) {
                toastr.error(validation.errors.errors.new_password[0]);
                $('#new_password').addClass('my-red-border');
            }

            $('#confirm_code_btn').html("تایید کد ارسال شده").removeAttr("disabled");
        }
        else
        {
            $.ajax({
                type: "POST",
                url: myData.ajax_url,
                data :{
                    action : 'confirm_code',
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
                            toastr.success('پسورد شما با موفقیت تغییر داده شد!');
                            var ref=getUrlVars()["ref"];
                            setTimeout(function() {
                                window.location.replace('/auth?ref='+ref);
                            }, 3000);
                            break;
                        case 'not_verify_code':
                            toastr.error('کد وارد شده مطابقت ندارد یا منتقضی شده است.');
                            $('#confirm_code_btn').html("ثبت گذرواژه جدید").removeAttr("disabled");
                            break;
                        case 'code_mobile_not_set':
                            toastr.error('خطای امنیتی رخ داده است!');
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
});

