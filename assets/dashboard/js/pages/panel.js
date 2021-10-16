jQuery(document).ready(function ($) {
    var total_candidate_selected = 0;
    $('input.checkbox-input').change(function () {
        // this will contain a reference to the checkbox
        if (this.checked) {
            if (total_candidate_selected < 8) {
                total_candidate_selected++;
                $(this).parents('tr').addClass('table-success');
            } else {
                $(this).prop('checked', false);
                toastr.options = {
                    timeOut: 5000,
                    progressBar: true,
                    showMethod: "slideDown",
                    hideMethod: "slideUp",
                    showDuration: 200,
                    hideDuration: 200,
                    rtl: 'true',
                    positionClass: 'toast-top-left'
                };
                toastr.error('حداکثر ۸ نماینده می توانید انتخاب نمایید! ');
            }
        } else {
            total_candidate_selected--;
            $(this).parents('tr').removeClass('table-success');
        }

        if (total_candidate_selected == 0) {
            $('#save_voting').empty().html('<i class="bx bx-check"></i>\n' +
                '        <span class="align-middle ml-25">\n' +
                '            ثبت رای\n' +
                '        </span>\n');
        } else {
            $('#save_voting').empty().html('<i class="bx bx-check"></i>\n' +
                '        <span class="align-middle ml-25">\n' +
                '            ثبت رای\n' +
                '        </span>\n' +
                '        <span class="badge badge-pill badge-primary badge-up badge-round">' + total_candidate_selected + '</span>');
        }

    });


    // $('#table_candidate tr').css('cursor', 'pointer').click(function() {
    //     var checkBoxes = $(this).find('input:checkbox');
    //     checkBoxes.prop("checked", !checkBoxes.prop("checked"));
    //
    //    if(checkBoxes.prop("checked")){
    //        $(this).addClass("table-success");
    //    }else {
    //        $(this).removeClass("table-success");
    //    }
    //
    // });

    $('.candidate_fl_name_click').css('cursor', 'pointer').click(function () {
        var candidate_code = $(this).find('input[type="hidden"]').val();
        $.ajax({
            type: "POST",
            url: myData.ajax_url,
            data: {
                action: 'get_candidate_info',
                candidate_code: candidate_code,
                user_id: myData.user_id,
            },
            success: function (result) {
                if (result.success == 'ok') {
                    $('#candidate_image').attr('src', result.candidate_image);
                    $('#candidate_info_fl_name').empty().html(result.candidate_fl_name);
                    $('#candidate_info_job').empty().html('<small> شغل : </small>' + result.candidate_job);
                    $('#candidate_info_code').empty().html('<small>کد انتخاباتی : </small>' + result.candidate_code);
                    $('#candidate_info_group').empty().html('<small> گروه : </small>' + result.candidate_group);
                    $('#candidate_info_field').empty().html('<small> رشته : </small>' + result.candidate_field);
                    $('#candidate_info_field_study').empty().html('<small> رشته تحصیلی : </small>' + result.candidate_field_study);
                    $('#candidate_info_university').empty().html('<small> دانشگاه : </small>' + result.candidate_university);
                    // $('#candidate_info_birth_place').empty().html('<i class="cursor-pointer bx bx-map align-middle mr-50"></i>'+' محل تولد '+result.candidate_birth_place);
                    $('#candidate_info_birthday').empty().html('<i class="cursor-pointer bx bx-calendar-event align-middle mr-50"></i>' + 'تاریخ تولد : ' + result.candidate_birthday);
                    $('#candidate_info_join_date').empty().html('<i class="cursor-pointer bx bx-calendar-event align-middle mr-50"></i>' + 'تاریخ عضویت : ' + result.candidate_join_date);
                    $('#candidate_info_first_certificate_date').empty().html('<i class="cursor-pointer bx bx-calendar-event align-middle mr-50"></i>' + 'تاريخ اخذ اولين پروانه اشتغال : ' + result.candidate_first_certificate_date);
                    $('#candidate_info_last_certificate_base').empty().html('<i class="cursor-pointer bx bx-list-check align-middle mr-50"></i>' + 'آخرین پایه پروانه : ' + result.candidate_last_certificate_base);
                    $('#candidate_info_board_membership_history').empty().html('<i class="cursor-pointer bx bx-award align-middle mr-50"></i>' + 'سابقه عضویت در هیات مدیره : ' + result.candidate_board_membership_history);
                    $('#candidate_info').modal('toggle');
                } else {
                    toastr.options = {
                        timeOut: 5000,
                        progressBar: true,
                        showMethod: "slideDown",
                        hideMethod: "slideUp",
                        showDuration: 200,
                        hideDuration: 200
                    };
                    toastr.error('خظایی رخ داده است!');
                }
            }
        });
    });

    $('#save_voting').click(function () {
        if (total_candidate_selected == 0) {
            toastr.options = {
                timeOut: 5000,
                progressBar: true,
                showMethod: "slideDown",
                hideMethod: "slideUp",
                showDuration: 200,
                hideDuration: 200
            };
            toastr.error('حداقل یک نماینده انتخاب نمایید!');
        } else {
            var $checkbox = $('table#table_candidate input:checkbox:checked');
            var FormsData = {};
            var candidate_tbody = '';
            $checkbox.each(function () {
                FormsData[this.name] = [
                    $(this).data('fl_name'),
                    $(this).data('group'),
                    $(this).data('field'),
                ];
                candidate_tbody += '<tr>\n' +
                    '                            <td class="text-center">' + this.name + '</td>\n' +
                    '                            <td class="text-center">' + $(this).data('fl_name') + '</td>\n' +
                    '                            <td class="text-center">' + $(this).data('group') + '-' + $(this).data('field') + '</td>\n' +
                    '                        </tr>';
            });


            $('#selected_candidates_list_modal_tbody').empty().html(candidate_tbody);
            $('#selected_candidates_list_modal').modal('toggle');

        }
    });

    $('#save_my_candidate').click(function () {
        var $checkbox = $('table#table_candidate input:checkbox:checked');
        var FormsData2 = {};
        $checkbox.each(function () {
            FormsData2[this.name] = this.name;
        });
        $.ajax({
            type: "POST",
            url: myData.ajax_url,
            data: {
                action: 'save_my_candidate',
                candidate_list: FormsData2,
                user_id: myData.user_id,
                save_my_candidate_nonce: myData.save_my_candidate_nonce,
                panel_nonce: myData.panel_nonce,
            },
            success: function (result) {
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
                    case 'ok':
                        toastr.success(result.msg);
                        // setTimeout(function() {
                        //     location.href = location.href;
                        // }, 3000);
                        $('#candidate_list_content').empty();
                        $('#candidate_list_content').append(result.temp_html);
                        $('#buy_now').empty();

                        break;
                    case 'voted':
                        toastr.error(result.msg);
                        setTimeout(function() {
                            location.reload();
                        }, 3000);
                        break;
                    case 'not_secure':
                        toastr.error('خطای امنیتی رخ داده است!');
                        setTimeout(function() {
                            location.reload(true);
                        }, 3000);
                        break;
                }
            }
        });
    });

    $(document).on('readystatechange',function (){
        var state = document.readyState
        if (state == 'interactive') {
            $('.app-content').hide();
        } else if (state == 'complete') {
            setTimeout(function(){
                // document.getElementById('interactive');
                $('.preloader').hide();
                $('.app-content').show();
            },1000);
        }
    });

});

