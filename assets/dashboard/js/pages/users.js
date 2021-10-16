jQuery(document).ready(function ($) {


    Validator.useLang('fa');
    Validator.register('mobile', function (val) {
        return val.match(/^09[0-9]{9}$/g);
    }, 'شماره موبایل اشتباه است');

    $.extend( true, $.fn.dataTable.defaults, {
        language: {
            "sEmptyTable":     "کاربری یافت نشد",
            "sInfo":           "نمایش _START_ تا _END_ از _TOTAL_ رکورد",
            "sInfoEmpty":      "رکوردی یافت نشد",
            "sInfoFiltered":   "(ÙÛŒÙ„ØªØ± Ø´Ø¯Ù‡ Ø§Ø² _MAX_ Ø±Ú©ÙˆØ±Ø¯)",
            "sInfoPostFix":    "",
            "sInfoThousands":  ",",
            "sLengthMenu":     "نمابش _MENU_ رکورد",
            "sLoadingRecords": "Ø¯Ø± Ø­Ø§Ù„ Ø¨Ø§Ø±Ú¯Ø²Ø§Ø±ÛŒ...",
            "sProcessing":     "در حال پردازش ...",
            "sSearch":         "جستجو: ",
            "sZeroRecords":    "Ø±Ú©ÙˆØ±Ø¯ÛŒ Ø¨Ø§ Ø§ÛŒÙ† Ù…Ø´Ø®ØµØ§Øª Ù¾ÛŒØ¯Ø§ Ù†Ø´Ø¯",
            "oPaginate": {
                "sFirst":    "اولین",
                "sLast":     "اخرین",
                "sNext":     "بعدی",
                "sPrevious": "قبلی"
            },
            "oAria": {
                "sSortAscending":  ": ÙØ¹Ø§Ù„ Ø³Ø§Ø²ÛŒ Ù†Ù…Ø§ÛŒØ´ Ø¨Ù‡ ØµÙˆØ±Øª ØµØ¹ÙˆØ¯ÛŒ",
                "sSortDescending": ": ÙØ¹Ø§Ù„ Ø³Ø§Ø²ÛŒ Ù†Ù…Ø§ÛŒØ´ Ø¨Ù‡ ØµÙˆØ±Øª Ù†Ø²ÙˆÙ„ÛŒ"
            }
        }
    } );

    fetch_all_commerce_users();
    function fetch_all_commerce_users()
    {


        $('#table_users').DataTable({
            "scrollY": 200,
            "scrollX": true,
            "autoWidth" : false,
            "bSort" : false,
            "serverSide": true,
            "ajax": {
                "url"  : myData.ajax_url+'?action=get_all_commerce_users&user_id='+myData.user_id
            }
        } );
    }


    var allFormsData={};
    var add_user_form = $('#add_user_form');
    var add_user_password = $('#add_user_password');
    var add_user_btn = $('#add_user_btn');
    add_user_password.keydown(function (e) {
        if (e.keyCode == 13) {
            add_user_btn.trigger('click');
            e.stopPropagation();
            return false;
        }
    });

    add_user_btn.on('click',function (event) {

        $('#add_user_name').removeClass('my-red-border');
        $('#add_user_work_position').removeClass('my-red-border');
        $('#add_user_user_name').removeClass('my-red-border');
        $('#add_user_password').removeClass('my-red-border');

        $("form#add_user_form :input").each(function(){
            allFormsData[$(this).attr('name')]=$(this).val();
        });

        let new_user_data = {
            add_user_name: allFormsData.add_user_name,
            add_user_work_position: allFormsData.add_user_work_position,
            add_user_user_name: allFormsData.add_user_user_name,
            add_user_password: allFormsData.add_user_password,
        };

        let rules = {
            add_user_name: 'required',
            add_user_work_position: 'required',
            add_user_user_name: 'required',
            add_user_password: 'required',
        };


        let validation = new Validator(new_user_data, rules);


        toastr.options = {
            timeOut: 3000,
            progressBar: true,
            showMethod: "slideDown",
            hideMethod: "slideUp",
            showDuration: 200,
            hideDuration: 200,
            positionClass: "toast-top-left",
        };

        if (validation.fails())
        {
            var add_user_work_position_errors = validation.errors.get('add_user_work_position');
            if (add_user_work_position_errors && add_user_work_position_errors.length > 0)
            {
                toastr.error(validation.errors.errors.add_user_work_position[0]);
                $('#add_user_work_position').addClass('my-red-border');
            }

            var add_user_name_errors = validation.errors.get('add_user_name');
            if (add_user_name_errors && add_user_name_errors.length > 0)
            {
                toastr.error(validation.errors.errors.add_user_name[0]);
                $('#add_user_name').addClass('my-red-border');
            }

            var add_user_user_name_errors = validation.errors.get('add_user_user_name');
            if (add_user_user_name_errors && add_user_user_name_errors.length > 0)
            {
                toastr.error(validation.errors.errors.add_user_user_name[0]);
                $('#add_user_user_name').addClass('my-red-border');
            }

            var add_user_password_errors = validation.errors.get('add_user_password');
            if (add_user_password_errors && add_user_password_errors.length > 0)
            {
                toastr.error(validation.errors.errors.add_user_password[0]);
                $('#add_user_password').addClass('my-red-border');
            }
        }
        else
        {

            add_user_btn.html('<i class="bx bx-loader bx-spin"></i>  ثبت');
            add_user_btn.prop('disabled', true);


            $.post(
                myData.ajax_url,
                {
                    action : 'os_add_user',
                    data:allFormsData,
                    user_id:  myData.user_id
                },
                function (response)
                {
                    add_user_btn.html(' ثبت');
                    add_user_btn.prop('disabled', false);

                    toastr.options = {
                        timeOut: 3000,
                        progressBar: true,
                        showMethod: "slideDown",
                        hideMethod: "slideUp",
                        showDuration: 200,
                        hideDuration: 200,
                        positionClass: "toast-top-left",
                    };
                    switch (response.success)
                    {
                        case 'not_secure':
                            toastr.error('خطای امنیتی رخ داده است!');
                            toastr.error('تا چند ثانیه دیگر به صفحه ورود منتقل می شوید!');

                            setTimeout(
                                function()
                                {
                                    window.location.href=myData.home_url+'/auth';
                                }, 3000);

                            break;

                        case 'repeat':
                            toastr.error(response.error);
                            break;

                        case 'ok':
                            toastr.success(response.error);
                            $('#table_users').DataTable().clear().destroy();
                            fetch_all_commerce_users();
                            $('form#add_user_form :input').not(':checkbox, :submit').val('');
                            break;
                    }
                });
        }

    });

    $('body').on('click','#deactive_user',function (event) {
        $.post(
            myData.ajax_url,
            {
                action : 'deactive_user',
                user_id:  myData.user_id,
                deactive_user_id:  $(this).data('user_id'),
            },
            function (response)
            {
                toastr.options = {
                    timeOut: 3000,
                    progressBar: true,
                    showMethod: "slideDown",
                    hideMethod: "slideUp",
                    showDuration: 200,
                    hideDuration: 200,
                    positionClass: "toast-top-left",
                };
                switch (response.success)
                {
                    case 'not_secure':
                        toastr.error('خطای امنیتی رخ داده است!');
                        toastr.error('تا چند ثانیه دیگر به صفحه ورود منتقل می شوید!');

                        setTimeout(
                            function()
                            {
                                window.location.href=myData.home_url+'/auth';
                            }, 3000);

                        break;

                    case 'ok':
                        toastr.success(response.msg);
                        $('#table_users').DataTable().clear().destroy();
                        fetch_all_commerce_users();
                        break;
                }
            });
    });

    $('body').on('click','#active_user',function (event) {
        $.post(
            myData.ajax_url,
            {
                action : 'active_user',
                user_id:  myData.user_id,
                active_user_id:  $(this).data('user_id'),
            },
            function (response)
            {
                toastr.options = {
                    timeOut: 3000,
                    progressBar: true,
                    showMethod: "slideDown",
                    hideMethod: "slideUp",
                    showDuration: 200,
                    hideDuration: 200,
                    positionClass: "toast-top-left",
                };
                switch (response.success)
                {
                    case 'not_secure':
                        toastr.error('خطای امنیتی رخ داده است!');
                        toastr.error('تا چند ثانیه دیگر به صفحه ورود منتقل می شوید!');

                        setTimeout(
                            function()
                            {
                                window.location.href=myData.home_url+'/auth';
                            }, 3000);

                        break;

                    case 'ok':
                        toastr.success(response.msg);
                        $('#table_users').DataTable().clear().destroy();
                        fetch_all_commerce_users();
                        break;
                }
            });
    });

    $('body').on('click','#change_pass',function (event) {

        $('#user_new_password').removeClass('my-red-border');
        $('#user_new_password').val('');
        $('#change_pass_submit').prop('disabled', false);
        $('#change_pass_submit').html('ثبت');
        $('#change_pass_submit').attr('data-user_id',$(this).data('user_id'));
        $('div#chenge_pass_modal').modal('toggle');
    });
    $('body').on('click','#change_pass_submit',function (event) {

        let new_pass_data = {
            new_pass: $('#user_new_password').val(),
        };

        let rules = {
            new_pass: 'required',
        };


        let validation = new Validator(new_pass_data, rules);

        if (validation.fails())
        {
            toastr.options = {
                timeOut: 3000,
                progressBar: true,
                showMethod: "slideDown",
                hideMethod: "slideUp",
                showDuration: 200,
                hideDuration: 200,
                positionClass: "toast-top-left",
            };

            var new_pass_errors = validation.errors.get('new_pass');
            if (new_pass_errors && new_pass_errors.length > 0)
            {
                toastr.error(validation.errors.errors.new_pass[0]);
                $('#user_new_password').addClass('my-red-border');
            }
        }
        else
        {

            $('#change_pass_submit').html('<i class="bx bx-loader bx-spin"></i>  ثبت');
            $('#change_pass_submit').prop('disabled', true);


            $.post(
                myData.ajax_url,
                {
                    action : 'change_pass',
                    user_id:  myData.user_id,
                    change_user_id:  $(this).data('user_id'),
                    new_pass:  $('#user_new_password').val(),
                },
                function (response)
                {
                    toastr.options = {
                        timeOut: 3000,
                        progressBar: true,
                        showMethod: "slideDown",
                        hideMethod: "slideUp",
                        showDuration: 200,
                        hideDuration: 200,
                        positionClass: "toast-top-left",
                    };
                    switch (response.success)
                    {
                        case 'not_secure':
                            toastr.error('خطای امنیتی رخ داده است!');
                            toastr.error('تا چند ثانیه دیگر به صفحه ورود منتقل می شوید!');

                            setTimeout(
                                function()
                                {
                                    window.location.href=myData.home_url+'/auth';
                                }, 3000);

                            break;

                        case 'ok':
                            $('div#chenge_pass_modal').modal('toggle');
                            toastr.success(response.msg);
                            $('#table_users').DataTable().clear().destroy();
                            fetch_all_commerce_users();
                            break;
                    }
                });
        }

    });

    $('body').on('click','#edit_user',function (event) {

        $('#edit_user_fl_name').removeClass('my-red-border');
        $('#edit_user_work_position').removeClass('my-red-border');
        $('#edit_user_fl_name').val($(this).data('fl_name'));
        $('#edit_user_work_position').val($(this).data('work_position'));

        $('#edit_user_submit').prop('disabled', false);
        $('#edit_user_submit').html('ویرایش');

        $('#edit_user_submit').removeData('user_id');
        $('#edit_user_submit').attr('data-user_id',$(this).data('user_id'));
        $('div#edit_user_modal').modal('toggle');
    });

    $('body').on('click','#edit_user_submit',function (event) {

        let edit_user_data = {
            edit_user_fl_name: $('#edit_user_fl_name').val(),
            edit_user_work_position: $('#edit_user_work_position').val(),
        };

        let rules = {
            edit_user_fl_name: 'required',
            edit_user_work_position: 'required',
        };


        let validation = new Validator(edit_user_data, rules);

        if (validation.fails())
        {
            toastr.options = {
                timeOut: 3000,
                progressBar: true,
                showMethod: "slideDown",
                hideMethod: "slideUp",
                showDuration: 200,
                hideDuration: 200,
                positionClass: "toast-top-left",
            };

            var edit_user_fl_name_errors = validation.errors.get('edit_user_fl_name');
            if (edit_user_fl_name_errors && edit_user_fl_name_errors.length > 0)
            {
                toastr.error(validation.errors.errors.edit_user_fl_name[0]);
                $('#edit_user_fl_name').addClass('my-red-border');
            }

            var edit_user_work_position_errors = validation.errors.get('edit_user_work_position');
            if (edit_user_work_position_errors && edit_user_work_position_errors.length > 0)
            {
                toastr.error(validation.errors.errors.edit_user_work_position[0]);
                $('#edit_user_work_position').addClass('my-red-border');
            }

        }
        else
        {

            $('#edit_user_submit').html('<i class="bx bx-loader bx-spin"></i>  ویرایش');
            $('#edit_user_submit').prop('disabled', true);


            $.post(
                myData.ajax_url,
                {
                    action : 'edit_user',
                    user_id:  myData.user_id,
                    edit_user_id:  $(this).data('user_id'),
                    edit_user_fl_name:  $('#edit_user_fl_name').val(),
                    edit_user_work_position:  $('#edit_user_work_position').val(),
                },
                function (response)
                {
                    toastr.options = {
                        timeOut: 3000,
                        progressBar: true,
                        showMethod: "slideDown",
                        hideMethod: "slideUp",
                        showDuration: 200,
                        hideDuration: 200,
                        positionClass: "toast-top-left",
                    };
                    switch (response.success)
                    {
                        case 'not_secure':
                            toastr.error('خطای امنیتی رخ داده است!');
                            toastr.error('تا چند ثانیه دیگر به صفحه ورود منتقل می شوید!');

                            setTimeout(
                                function()
                                {
                                    window.location.href=myData.home_url+'/auth';
                                }, 3000);

                            break;

                        case 'ok':
                            $('div#edit_user_modal').modal('toggle');
                            toastr.success(response.msg);
                            $('#table_users').DataTable().clear().destroy();
                            fetch_all_commerce_users();
                            break;
                    }
                });
        }

    });



});