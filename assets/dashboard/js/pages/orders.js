
(function () {
    if (jQuery && jQuery.fn && jQuery.fn.select2 && jQuery.fn.select2.amd) var e = jQuery.fn.select2.amd;
    return e.define("select2/i18n/fa", [], function () {
        return {
            errorLoading: function () {
                return "امکان بارگذاری نتایج وجود ندارد."
            },
            inputTooLong: function (e) {
                var t = e.input.length - e.maximum,
                    n = "لطفاً " + t + " کاراکتر را حذف نمایید";
                return n
            },
            inputTooShort: function (e) {
                var t = e.minimum - e.input.length,
                    n = "لطفاً تعداد " + t + " کاراکتر یا بیشتر وارد نمایید";
                return n
            },
            loadingMore: function () {
                return "در حال بارگذاری نتایج بیشتر..."
            },
            maximumSelected: function (e) {
                var t = "شما تنها می‌توانید " + e.maximum + " آیتم را انتخاب نمایید";
                return t
            },
            noResults: function () {
                return "هیچ نتیجه‌ای یافت نشد"
            },
            searching: function () {
                return "در حال جستجو ..."
            },
            removeAllItems: function () {
                return "همه موارد را حذف کنید"
            }
        }
    }), {
        define: e.define,
        require: e.require
    }
})();


jQuery(document).ready(function ($) {


    Validator.useLang('fa');
    Validator.register('mobile', function (val) {
        return val.match(/^09[0-9]{9}$/g);
    }, 'شماره موبایل اشتباه است');

    $('body').on('click','#add_buy_from',function (){
        console.log('sssw');
        $(".select2").select2({
            dropdownAutoWidth: true,
            width: '100%',
            language: "fa",
            maximumSelectionLength: 2,
            placeholder: "حداکثر 2 گزینه انتخاب کنید"
        });
    });

    $(".select2").select2({
        dropdownAutoWidth: true,
        width: '100%',
        language: "fa",
        maximumSelectionLength: 2,
        placeholder: "حداکثر 2 گزینه انتخاب کنید"
    });

    $.extend( true, $.fn.dataTable.defaults, {
        language: {
            "sEmptyTable":     "کاربری یافت نشد",
            "sInfo":           "نمایش _START_ تا _END_ از _TOTAL_ رکورد",
            "sInfoEmpty":      "رکوردی یافت نشد",
            "sInfoFiltered":   "(ÙÛŒÙ„ØªØ± Ø´Ø¯Ù‡ Ø§Ø² _MAX_ Ø±Ú©ÙˆØ±Ø¯)",
            "sInfoPostFix":    "",
            "sInfoThousands":  ",",
            "sLengthMenu":     "نمایش _MENU_ رکورد",
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
    var new_order=$('#new_order');
    var new_order_modal=$('div#new_order_modal');
    var order_date2=$('#order_date2');

    order_date2.pDatepicker({

        "autoClose": true,
        "altField": "#order_date",
        "format" : "DD MMMM YYYY ",
        "altFieldFormatter" :function (unixDate) {
            var self = this;
            var pd = new persianDate(unixDate).toCalendar('gregorian').format('X');
            return pd;
        }
    });
    new_order.on('click',function (event) {
        $('#add_user_name').removeClass('my-red-border');
        new_order_modal.modal('toggle');

    });

    $('.repeater-default').repeater({
        initEmpty: true,
        show: function () {
            $(this).slideDown();
        },
        hide: function (deleteElement) {
            if (confirm('آیا از حذف این آیتم مطمئن هستید؟')) {
                $(this).slideUp(deleteElement);
            }
        }
    });


});