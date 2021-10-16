jQuery(document).ready(function ($) {


    const p2e = s => s.replace(/[۰-۹]/g, d => '۰۱۲۳۴۵۶۷۸۹'.indexOf(d));

    $('body').tooltip({
        selector : '[data-toggle="tooltip"]'
    });

    persian={0:'۰',1:'۱',2:'۲',3:'۳',4:'۴',5:'۵',6:'۶',7:'۷',8:'۸',9:'۹'};
    function traverse(el){
        if(el.nodeType==3){
            var list=el.data.match(/[0-9]/g);
            if(list!=null && list.length!=0){
                for(var i=0;i<list.length;i++)
                    el.data=el.data.replace(list[i],persian[list[i]]);
            }
        }
        for(var i=0;i<el.childNodes.length;i++){
            traverse(el.childNodes[i]);
        }
    }

    $.extend( true, $.fn.dataTable.defaults, {
        language: {
            "sEmptyTable":     "هیچ داده ای در جدول وجود ندارد",
            "sInfo":           "نمایش _START_ تا _END_ از _TOTAL_ رکورد",
            "sInfoEmpty":      "نمایش 0 تا 0 از 0 رکورد",
            "sInfoFiltered":   "(فیلتر شده از _MAX_ رکورد)",
            "sInfoPostFix":    "",
            "sInfoThousands":  ",",
            "sLengthMenu":     "نمایش _MENU_ رکورد",
            "sLoadingRecords": "در حال بارگزاری...",
            "sProcessing":     "در حال پردازش...",
            "sSearch":         "جستجو: ",
            "sZeroRecords":    "رکوردی با این مشخصات پیدا نشد",
            "oPaginate": {
                "sFirst":    "ابتدا",
                "sLast":     "انتها",
                "sNext":     "بعدی",
                "sPrevious": "قبلی"
            },
            "oAria": {
                "sSortAscending":  ": فعال سازی نمایش به صورت صعودی",
                "sSortDescending": ": فعال سازی نمایش به صورت نزولی"
            }
        }
    } );

    fetch_data_users_vote();
    function fetch_data_users_vote()
    {
        $('#user_vote_table').DataTable({
            "pageLength":10,
            "lengthMenu": [[5,10, 25, -1], [5,10, 25, "همه"]],
            "info": false,
            "serverSide": true,
            "ajax": {
                "url"  : myData.ajax_url+'?action=get_users_vote&user_id='+myData.user_id
            },
            "fnDrawCallback" : function() {
                traverse(document.body);
            }
        } );
    }

    $(document).on('click','.get_selected_candidate_list',function (){
        $.ajax({
            type: "POST",
            url: myData.ajax_url,
            data :{
                action : 'get_voted_candidate_list',
                info_user_id :$(this).data('user_id'),
                user_id :myData.user_id,
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
                    case 'ok':
                        var final='';
                        $.each(result.final,function (index,value){
                            final+='<li className="media my-2">\n' +
                                '                            <a href="JavaScript:void(0);">\n' +
                                '                                <div className="avatar mr-1">\n' +
                                '                                    <img src="'+value['image']+'"\n' +
                                '                                         alt="avtar images" width="32" height="32">\n' +
                                '                                </div>\n' +
                                '                            </a>\n' +
                                '                            <div className="media-body">\n' +
                                '                                <h6 className="media-heading mb-0 mt-n25 primary-font"><a\n' +
                                '                                    href="javaScript:void(0);"></a>' +
                                value['fl_name']+
                                '</h6>\n' +
                                '                                <small className="text-muted">\n' +
                                '                                    <div className="badge badge-pill badge-primary mr-1 mb-1"> کد انتخاباتی :\n' +
                                                                        value['code']+
                                '                                    </div>\n' +
                                '                                </small>\n' +
                                '                                <small className="text-muted">\n' +
                                '                                    <div\n' +
                                '                                        className="badge badge-pill badge-warning mr-1 mb-1">\n' +
                                value['group']+'/'+value['field']+
                                '                                    </div>\n' +
                                '                                </small>\n' +
                                '                            </div>\n' +
                                '                        </li>';
                        });
                        $('#final_list').empty();
                        $('#final_list').html(final);
                        $('#selected_candidate_list_modal').modal('toggle');
                        break;
                    case 'not_secure':
                        toastr.error('خطای امنیتی رخ داده است!');
                        setTimeout(function() {
                            location.reload();
                        }, 3000);
                        break;
                }
            }
        });
    });
    $(document).on('click','.get_voting_device_data',function (){
        $.ajax({
            type: "POST",
            url: myData.ajax_url,
            data :{
                action : 'get_voting_device_data',
                info_user_id :$(this).data('user_id'),
                user_id :myData.user_id,
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
                    case 'ok':
                        var final2='                <ul class="list-group list-group-flush">\n' +
                            '                    <li class="list-group-item list-group-item-action border-0 d-flex align-items-center justify-content-between">\n' +
                            '                        <div class="list-left d-flex align-items-center">\n' +
                            '                            <div class="list-icon mr-1">\n' +
                            '                                <div class="avatar bg-rgba-black m-0">\n' +
                            '                                    <div class="avatar-content">\n' +
                            '                                        <i class="bx bxs-shield-alt-2 text-black-50 font-size-base"></i>\n' +
                            '                                    </div>\n' +
                            '                                </div>\n' +
                            '                            </div>\n' +
                            '                            <div class="list-content mt-n25">\n' +
                            '                                <span class="list-title">آی پی</span>\n' +
                            '                            </div>\n' +
                            '                        </div>\n' +
                            '                        <span style="direction: ltr">' +
                            result.final2[0]['ip'] +
                            '</span>\n' +
                            '\n' +
                            '                    </li>\n' +
                            '\n' +
                            '                    <li class="list-group-item list-group-item-action border-0 d-flex align-items-center justify-content-between">\n' +
                            '                        <div class="list-left d-flex align-items-center">\n' +
                            '                            <div class="list-icon mr-1">\n' +
                            '                                <div class="avatar bg-rgba-warning m-0">\n' +
                            '                                    <div class="avatar-content">\n' +
                            '                                        <i class="bx bxs-calendar text-warning font-size-base"></i>\n' +
                            '                                    </div>\n' +
                            '                                </div>\n' +
                            '                            </div>\n' +
                            '                            <div class="list-content mt-n25">\n' +
                            '                                <span class="list-title">تاریخ و ساعت</span>\n' +
                            '                            </div>\n' +
                            '                        </div>\n' +
                            '                        <span style="direction: ltr">' +
                            result.final2[0]['date'] +
                            '</span>\n' +
                            '\n' +
                            '                    </li>\n' +
                            '\n' +
                            '                    <li class="list-group-item list-group-item-action border-0 d-flex align-items-center justify-content-between">\n' +
                            '                        <div class="list-left d-flex align-items-center">\n' +
                            '                            <div class="list-icon mr-1">\n' +
                            '                                <div class="avatar bg-rgba-primary m-0">\n' +
                            '                                    <div class="avatar-content">\n' +
                            '                                        <i class="bx bxs-zap text-primary font-size-base"></i>\n' +
                            '                                    </div>\n' +
                            '                                </div>\n' +
                            '                            </div>\n' +
                            '                            <div class="list-content mt-n25">\n' +
                            '                                <span class="list-title">مرورگر</span>\n' +
                            '                            </div>\n' +
                            '                        </div>\n' +
                            '                        <span>' +
                            result.final2[0]['browser'] +
                            '</span>\n' +
                            '\n' +
                            '                    </li>\n' +
                            '\n' +
                            '                    <li class="list-group-item list-group-item-action border-0 d-flex align-items-center justify-content-between">\n' +
                            '                        <div class="list-left d-flex align-items-center">\n' +
                            '                            <div class="list-icon mr-1">\n' +
                            '                                <div class="avatar bg-rgba-info m-0">\n' +
                            '                                    <div class="avatar-content">\n' +
                            '                                        <i class="bx bxl-redux text-info font-size-base"></i>\n' +
                            '                                    </div>\n' +
                            '                                </div>\n' +
                            '                            </div>\n' +
                            '                            <div class="list-content mt-n25">\n' +
                            '                                <span class="list-title">سیستم عامل</span>\n' +
                            '                            </div>\n' +
                            '                        </div>\n' +
                            '                        <span>' +
                            result.final2[0]['os'] +
                            '</span>\n' +
                            '                    </li>\n' +
                            '                    <li class="list-group-item list-group-item-action border-0 d-flex align-items-center justify-content-between">\n' +
                            '                        <div class="list-left d-flex align-items-center">\n' +
                            '                            <div class="list-icon mr-1">\n' +
                            '                                <div class="avatar bg-rgba-danger m-0">\n' +
                            '                                    <div class="avatar-content">\n' +
                            '                                        <i class="bx bx-chalkboard text-danger font-size-base"></i>\n' +
                            '                                    </div>\n' +
                            '                                </div>\n' +
                            '                            </div>\n' +
                            '                            <div class="list-content mt-n25">\n' +
                            '                                <span class="list-title">نوع دستگاه</span>\n' +
                            '                            </div>\n' +
                            '                        </div>\n' +
                            '                        <span>' +
                            result.final2[0]['device'] +
                            '</span>\n' +
                            '                    </li>\n' +
                            '                    <li class="list-group-item list-group-item-action border-0 d-flex align-items-center justify-content-between">\n' +
                            '                        <div class="list-left d-flex align-items-center">\n' +
                            '                            <div class="list-icon mr-1">\n' +
                            '                                <div class="avatar bg-rgba-primary m-0">\n' +
                            '                                    <div class="avatar-content">\n' +
                            '                                        <i class="bx bx-mobile text-primary font-size-base"></i>\n' +
                            '                                    </div>\n' +
                            '                                </div>\n' +
                            '                            </div>\n' +
                            '                            <div class="list-content mt-n25">\n' +
                            '                                <span class="list-title"> برند</span>\n' +
                            '                            </div>\n' +
                            '                        </div>\n' +
                            '                        <span>' +
                            result.final2[0]['brand'] +
                            '</span>\n' +
                            '                    </li>\n';

                        if (result.final2[0]['model'] != undefined)
                        {
                            final2+=' <li class="list-group-item list-group-item-action border-0 d-flex align-items-center justify-content-between">\n' +
                                '                                            <div class="list-left d-flex align-items-center">\n' +
                                '                                                <div class="list-icon mr-1">\n' +
                                '                                                    <div class="avatar bg-rgba-danger m-0">\n' +
                                '                                                        <div class="avatar-content">\n' +
                                '                                                            <i class="bx bx-barcode text-danger font-size-base"></i>\n' +
                                '                                                        </div>\n' +
                                '                                                    </div>\n' +
                                '                                                </div>\n' +
                                '                                                <div class="list-content mt-n25">\n' +
                                '                                                    <span class="list-title">مدل</span>\n' +
                                '                                                </div>\n' +
                                '                                            </div>\n' +
                                '                                            <span>' +
                                result.final2[0]['model'] +
                                '</span>\n' +
                                '                                        </li>';
                        }

                        final2+='                </ul>\n';
                        $('#final_list2').empty();
                        $('#final_list2').html(final2);
                        $('#voting_device_data_modal').modal('toggle');
                        break;
                    case 'not_secure':
                        toastr.error('خطای امنیتی رخ داده است!');
                        setTimeout(function() {
                            location.reload();
                        }, 3000);
                        break;
                }
            }
        });
    });
    $(document).on('click','.show_candidate_vote_list',function (){
        $.ajax({
            type: "POST",
            url: myData.ajax_url,
            data :{
                action : 'get_candidate_vote_list',
                candidate_id :$(this).data('candidate_id'),
                candidate_code :$(this).data('candidate_code'),
                user_id :myData.user_id,
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
                    case 'ok':
                        var info='';
                        var count=1;
                        $.each(result.candidate_vote_list,function (index,value){
                            info+='<tr>\n' +
                                '                            <td >'+count+'</td>\n' +
                                '                            <td class="text-bold-500">'+value['fl_name']+'</td>\n' +
                                '                            <td class="text-bold-500">'+value['user_login']+'</td>\n' +
                                '                        </tr>';
                            count++;
                        });
                        $('#candidate_voting_list_table').empty();
                        $('#candidate_voting_list_table').html(info);

                        $('#candidate_name_vote_list').empty();
                        $('#candidate_name_vote_list').html(result.candidate_name+' [ '+result.candidate_code+' ] ');
                        $('#candidate_voting_list').modal('toggle');
                        break;
                    case 'not_secure':
                        toastr.error('خطای امنیتی رخ داده است!');
                        setTimeout(function() {
                            location.reload();
                        }, 3000);
                        break;
                }
            }
        });
    });

    fetch_data_candidate_vote();
    function fetch_data_candidate_vote()
    {
        $('#candidate_vote_table').DataTable({
            "pageLength":20,
            "lengthMenu": [[5,10, 25, -1], [5,10, 25, "همه"]],
            "info": false,
            "searching": false,
            "paging": false,
            "serverSide": true,
            "ajax": {
                "url"  : myData.ajax_url+'?action=get_candidate_vote&user_id='+myData.user_id
            },
            "fnDrawCallback" : function() {
                traverse(document.body);
            }
        } );
    }
});

