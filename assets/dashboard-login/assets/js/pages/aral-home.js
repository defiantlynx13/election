jQuery(document).ready(function ($) {

    $('.slick-fade-effect').slick({
        infinite: true,
        speed: 2000,
        fade: true,
        cssEase: 'linear'
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



    var search_city_select=tail.select("#search_city_select",{
        animate: true,
        locale: "fa",
        multiPinSelected: true,
        width:"130px",
        placeholde:"شهر",
    });
    search_city_select.on('change', function (e) {

        $("#search_district_select").empty();
        search_city_select.disable(false);
        search_district_select.disable(false);
        if (e.key == 'مشهد')
        {

            search_region_select.enable(false);
        }
        else
        {
            search_region_select.disable(false);
        }
        search_region_select.reload();
        search_region_select.updateLabel('انتخاب منطقه');


        search_district_select.updateLabel('<div class="spinner-border spinner-border-sm text-info" role="status">\n' +
             '  <span class="sr-only">درحال بارگذاری...</span>\n' +
             '</div>');
        $.ajax({
            type: "POST",
            url: myData.ajax_url,
            data :{
                action : 'aral_get_districts',
                city :e.key,
            },
            success:function (result)
            {
                if (result.status == "found")
                {
                    $.each(result.districts, function( index, value ) {
                        $('#search_district_select').append('<option value="'+value.name+'">'+value.name+'</option>');
                    });
                    search_district_select.reload();
                    search_district_select.updateLabel('محله های شهر' + ' ' + e.key);
                    search_district_select.enable(false);
                    search_city_select.enable(false);

                }
            }
        });

    });


    var search_region_select=tail.select("#search_region_select",{
        animate: true,
        locale: "fa",
        multiPinSelected: true,
        width:"130px",
        placeholde:"شهر",
    });
    search_region_select.updateLabel('انتخاب منطقه');
    // search_region_select.on('change', function (e) {
    //
    //     $("#search_district_select").empty();
    //     search_city_select.disable(false);
    //     search_district_select.disable(false);
    //
    //     search_district_select.updateLabel('<div class="spinner-border spinner-border-sm text-info" role="status">\n' +
    //         '  <span class="sr-only">درحال بارگذاری...</span>\n' +
    //         '</div>');
    //     $.ajax({
    //         type: "POST",
    //         url: myData.ajax_url,
    //         data :{
    //             action : 'aral_get_districts',
    //             city :e.key,
    //         },
    //         success:function (result)
    //         {
    //             if (result.status == "found")
    //             {
    //                 $.each(result.districts, function( index, value ) {
    //                     $('#search_district_select').append('<option value="'+value.name+'">'+value.name+'</option>');
    //                 });
    //                 search_district_select.reload();
    //                 search_district_select.updateLabel('محله های شهر' + ' ' + e.key);
    //                 search_district_select.enable(false);
    //                 search_city_select.enable(false);
    //
    //             }
    //         }
    //     });
    //
    // });

   var search_district_select=tail.select("#search_district_select",{
        animate: true,
        locale: "fa",
        multiPinSelected: true,
        multiple: true,
        width:"250px",
        placeholder:"محله",
       search: true,
       multiSelectAll:true,
       csvOutput:true,
       csvSeparator:'|',
    });
    search_district_select.updateLabel('انتخاب محله');
    search_district_select.on("change", function(item, state)
    {
        var selected_value = $.map($('#search_district_select option:selected') ,function(option) {
            return option.value;
        });

        switch (selected_value.length)
        {
            case 0:
                search_district_select.updateLabel('انتخاب محله');
                break;
            case 1:
                search_district_select.updateLabel(selected_value[0]);
                break;
            case 2:
                search_district_select.updateLabel(selected_value[0] + ' | ' +selected_value[1]);
                break;
            case 3:
                search_district_select.updateLabel( selected_value[0] + ' | ' +selected_value[1]+'| ...');
                break;
        }
    });

    var search_deal_type_select=tail.select("#search_deal_type_select",{
        animate: true,
        locale: "fa",
        multiPinSelected: true,
        width:"150px",
        placeholder:"نوع معامله",
    });
    search_deal_type_select.on("change", function(item, state){
        if (state =='select')
        {
            switch (item.value)
            {
                case 'خرید':
                    $('#search_price').removeClass('d-none');
                    $('#search_deed').removeClass('d-none');
                    $('#search_rent').addClass('d-none');
                    $('#search_mortgage').addClass('d-none');

                    $("#search_price_select option:selected").prop("selected", false);
                    search_price.reload();
                    $("#search_rent_select option:selected").prop("selected", false);
                    search_rent.reload();
                    $("#search_mortgage_select option:selected").prop("selected", false);
                    search_mortgage.reload();
                    $("#search_deed_select option:selected").prop("selected", false);
                    search_deed.reload();
                    break;
                case 'رهن واجاره':
                    $('#search_price').addClass('d-none');
                    $('#search_deed').addClass('d-none');
                    $('#search_rent').removeClass('d-none');
                    $('#search_mortgage').removeClass('d-none');
                    $("#search_price_select option:selected").prop("selected", false);
                    search_price.reload();
                    $("#search_rent_select option:selected").prop("selected", false);
                    search_rent.reload();
                    $("#search_mortgage_select option:selected").prop("selected", false);
                    search_mortgage.reload();
                    $("#search_deed_select option:selected").prop("selected", false);
                    search_deed.reload();
                    break;
                case 'رهن کامل':
                    $('#search_price').addClass('d-none');
                    $('#search_deed').addClass('d-none');
                    $('#search_rent').addClass('d-none');
                    $('#search_mortgage').removeClass('d-none');
                    $("#search_price_select option:selected").prop("selected", false);
                    search_price.reload();
                    $("#search_rent_select option:selected").prop("selected", false);
                    search_rent.reload();
                    $("#search_mortgage_select option:selected").prop("selected", false);
                    search_mortgage.reload();
                    $("#search_deed_select option:selected").prop("selected", false);
                    search_deed.reload();
                    break;

            }
        }
    });

    var search_prop_type_select=tail.select("#search_prop_type_select",{
        animate: true,
        locale: "fa",
        multiPinSelected: true,
        width:"115px",
        placeholder:"نوع ملک",
    });
    search_prop_type_select.on("change", function(item, state){
        $('#search_bedroom').addClass('d-none');
        $('#search_facilities').addClass('d-none');
        $('#search_floor').addClass('d-none');
        $('#search_infrastructure').addClass('d-none');
        $('#search_age').addClass('d-none');
        $('#search_land_area').addClass('d-none');

        if (state =='select' )
        {
            switch (item.value)
            {
                case 'آپارتمان':
                    $('#search_bedroom').removeClass('d-none');
                    $('#search_facilities').removeClass('d-none');
                    $('#search_floor').removeClass('d-none');
                    $('#search_infrastructure').removeClass('d-none');
                    $('#search_age').removeClass('d-none');
                    break;
                case 'خانه ویلایی':
                    $('#search_bedroom').removeClass('d-none');
                    $('#search_facilities').removeClass('d-none');
                    $('#search_infrastructure').removeClass('d-none');
                    $('#search_age').removeClass('d-none');
                    $('#search_land_area').removeClass('d-none');
                case 'ویلا':
                    $('#search_bedroom').removeClass('d-none');
                    $('#search_facilities').removeClass('d-none');
                    $('#search_infrastructure').removeClass('d-none');
                    $('#search_age').removeClass('d-none');
                    break;
                case 'مغازه تجاری':
                case 'دفتر کار اداری':
                    $('#search_facilities').removeClass('d-none');
                    $('#search_floor').removeClass('d-none');
                    $('#search_infrastructure').removeClass('d-none');
                    $('#search_age').removeClass('d-none');
                    break;
                case 'زمین':
                    $('#search_land_area').removeClass('d-none');
                    break;
            }
        }
    });

var search_price=tail.select("#search_price_select",{
        animate: true,
        locale: "fa",
        width:"250px",
        placeholder:"قیمت",
        multiLimit: 2,
      multiShowCount: false,
        // multiContainer: ".tail-move-container",
        multiShowLimit:true,
        // multiSelectAll: true,
        multiPinSelected:false,
    csvOutput:true,
    csvSeparator:'|',
    });

    search_price.on("change", function(item, state)
    {
        var selected_value = $.map($('#search_price_select option:selected') ,function(option) {
            return [option.value,option.title];
        });

        switch (selected_value.length)
        {
            case 0:
                search_price.updateLabel('حداقل و حداکثر قیمت');
                break;
            case 2:
                search_price.updateLabel('قیمت تا' + ' '+selected_value[1]);
                break;
            case 4:
                search_price.updateLabel('قیمت از' + ' '+selected_value[1]+' '+'تا'+selected_value[3]);
                break;
        }
    });

    search_price.updateLabel('حداقل و حداکثر قیمت');

var search_rent=tail.select("#search_rent_select",{
        animate: true,
        locale: "fa",
        width:"250px",
        placeholder:"اجاره",
        multiLimit: 2,
      multiShowCount: false,
        // multiContainer: ".tail-move-container",
        multiShowLimit:true,
        // multiSelectAll: true,
        multiPinSelected:false,
    csvOutput:true,
    csvSeparator:'|',
    });
    search_rent.on("change", function(item, state)
    {
        var selected_value = $.map($('#search_rent_select option:selected') ,function(option) {
            return [option.value,option.title];
        });

        switch (selected_value.length)
        {
            case 0:
                search_rent.updateLabel('حداقل و حداکثر اجاره');
                break;
            case 2:
                search_rent.updateLabel('اجاره تا' + ' '+selected_value[1]);
                break;
            case 4:
                search_rent.updateLabel('اجاره از' + ' '+selected_value[1]+' '+'تا'+selected_value[3]);
                break;
        }
    });
    search_rent.updateLabel('حداقل و حداکثر اجاره');

var search_mortgage=tail.select("#search_mortgage_select",{
        animate: true,
        locale: "fa",
        width:"250px",
        placeholder:"رهن",
        multiLimit: 2,
      multiShowCount: false,
        // multiContainer: ".tail-move-container",
        multiShowLimit:true,
        // multiSelectAll: true,
        multiPinSelected:false,
    csvOutput:true,
    csvSeparator:'|',
    });
    search_mortgage.updateLabel('حداقل و حداکثر رهن');

    search_mortgage.on("change", function(item, state)
    {
        var selected_value = $.map($('#search_mortgage_select option:selected') ,function(option) {
            return [option.value,option.title];
        });

        switch (selected_value.length)
        {
            case 0:
                search_mortgage.updateLabel('حداقل و حداکثر رهن');
                break;
            case 2:
                search_mortgage.updateLabel('رهن تا' + ' '+selected_value[1]);
                break;
            case 4:
                search_mortgage.updateLabel('رهن از' + ' '+selected_value[1]+' '+'تا'+selected_value[3]);
                break;
        }
    });





    var search_deed=tail.select("#search_deed_select",{
        locale: "fa",
        width:200,
        hideDisabled: true,
      multiShowCount: false,
        multiContainer: ".npr-deed_type-container",
        multiShowLimit:true,
        // multiSelectAll: true,
        multiPinSelected:false,
        placeholder:"نوع سند",
        csvOutput:true,
        csvSeparator:'|',
    });
    search_deed.on("change", function(item, state)
    {
        var selected_value = $.map($('#search_deed_select option:selected') ,function(option) {
            return option.value;
        });

        switch (selected_value.length)
        {
            case 0:
                search_deed.updateLabel('نوع سند');
                break;
            case 1:
                search_deed.updateLabel(selected_value[0]);
                break;
            case 2:
                search_deed.updateLabel(selected_value[0] + ' | ' +selected_value[1]);
                break;
            case 3:
                search_deed.updateLabel( selected_value[0] + ' | ' +selected_value[1]+'| ...');
                break;
        }
    });

    var search_bedroom=tail.select("#search_bedroom_select",{
        locale: "fa",
        width:200,
        hideDisabled: true,
        multiLimit: 2,
      multiShowCount: false,
        // multiContainer: ".tail-move-container",
        multiShowLimit:true,
        // multiSelectAll: true,
        multiPinSelected:false,
        placeholder:"تعداد خواب",
        csvOutput:true,
        csvSeparator:'|',
    });

    search_bedroom.on("change", function(item, state)
    {
        var selected_value = $.map($('#search_bedroom_select option:selected') ,function(option) {
            return option.value;
        });

        switch (selected_value.length)
        {
            case 0:
                search_bedroom.updateLabel('تعداد خواب');
                break;
            case 1:
                search_bedroom.updateLabel(  ' تا '+selected_value[0] +' خواب ');
                break;
            case 2:
                search_bedroom.updateLabel(' از '+selected_value[0] + ' تا ' +selected_value[1] +' خواب ');
                break;
        }
    });
    search_bedroom.updateLabel('تعداد خواب');


    var search_facilities=tail.select("#search_facilities_select",{
        locale: "fa",
        width:200,
        hideDisabled: true,
      multiShowCount: false,
        // multiContainer: ".tail-move-container",
        multiShowLimit:true,
        // multiSelectAll: true,
        multiPinSelected:false,
        placeholder:"تجهیزات",
        csvOutput:true,
        csvSeparator:'|',
    });

    search_facilities.on("change", function(item, state)
    {
        var selected_value = $.map($('#search_facilities_select option:selected') ,function(option) {
            return option.value;
        });

        search_facilities.updateLabel('تجهیزات');
    });
    search_facilities.updateLabel('تجهیزات');


    var search_floor=tail.select("#search_floor_select",{
        locale: "fa",
        width:200,
        hideDisabled: true,
        multiLimit: 2,
      multiShowCount: false,
        // multiContainer: ".tail-move-container",
        multiShowLimit:true,
        // multiSelectAll: true,
        multiPinSelected:false,
        placeholder:"طبقه",
        csvOutput:true,
        csvSeparator:'|',
    });

    search_floor.on("change", function(item, state)
    {
        var selected_value = $.map($('#search_floor_select option:selected') ,function(option) {
            return option.value;
        });

        switch (selected_value.length)
        {
            case 0:
                search_floor.updateLabel('طبقه');
                break;
            case 1:
                search_floor.updateLabel(  ' تا '+selected_value[0] +' طبقه ');
                break;
            case 2:
                search_floor.updateLabel(' از '+selected_value[0] + ' تا  طبقه' +selected_value[1]);
                break;
        }
    });
    search_floor.updateLabel('طبقه');


    var search_infrastructure=tail.select("#search_infrastructure_select",{
        locale: "fa",
        width:200,
        hideDisabled: true,
        multiLimit: 2,
      multiShowCount: false,
        // multiContainer: ".tail-move-container",
        multiShowLimit:true,
        // multiSelectAll: true,
        multiPinSelected:false,
        placeholder:"زیربنا",
        csvOutput:true,
        csvSeparator:'|',
    });

    search_infrastructure.on("change", function(item, state)
    {
        var selected_value = $.map($('#search_infrastructure_select option:selected') ,function(option) {
            return option.value;
        });

        switch (selected_value.length)
        {
            case 0:
                search_infrastructure.updateLabel('طبقه');
                break;
            case 1:
                search_infrastructure.updateLabel(  ' زیربنا تا '+selected_value[0] +' متر ');
                break;
            case 2:
                search_infrastructure.updateLabel(' زیربنا از '+selected_value[0] + ' تا ' +selected_value[1]+' متر ');
                break;
        }
    });
    search_infrastructure.updateLabel('زیربنا');

    var search_age=tail.select("#search_age_select",{
        locale: "fa",
        width:200,
        hideDisabled: true,
        multiLimit: 2,
        multiShowCount: false,
        // multiContainer: ".tail-move-container",
        multiShowLimit:true,
        // multiSelectAll: true,
        multiPinSelected:false,
        placeholder:"سال ساخت",
        csvOutput:true,
        csvSeparator:'|',
    });

    search_age.on("change", function(item, state)
    {
        var selected_value = $.map($('#search_age_select option:selected') ,function(option) {
            return option.value;
        });

        switch (selected_value.length)
        {
            case 0:
                search_age.updateLabel(' سال ساخت');
                break;
            case 1:
                search_age.updateLabel(  ' سال ساخت تا '+selected_value[0]);
                break;
            case 2:
                search_age.updateLabel(' سال ساخت از '+selected_value[0] + ' تا ' +selected_value[1]);
                break;
        }
    });
    search_age.updateLabel('سال ساخت');

    var search_land_area=tail.select("#search_land_area_select",{
        locale: "fa",
        width:200,
        hideDisabled: true,
        multiLimit: 2,
      multiShowCount: false,
        // multiContainer: ".tail-move-container",
        multiShowLimit:true,
        // multiSelectAll: true,
        multiPinSelected:false,
        placeholder:"متراژ زمین",
        csvOutput:true,
        csvSeparator:'|',
    });

    search_land_area.on("change", function(item, state)
    {
        var selected_value = $.map($('#search_land_area_select option:selected') ,function(option) {
            return option.value;
        });

        switch (selected_value.length)
        {
            case 0:
                search_land_area.updateLabel('متراژ');
                break;
            case 1:
                search_land_area.updateLabel(  ' متراژ تا '+selected_value[0] +' متر ');
                break;
            case 2:
                search_land_area.updateLabel(' متراژ از '+selected_value[0] + ' تا ' +selected_value[1]+' متر ');
                break;
        }
    });

    search_land_area.updateLabel('متراژ زمین');

    $('#aral-home-search-btn').on('click',function (e) {
        $("#aral-home-search-form").submit();
        return false;
    });

    traverse(document.body);

    $('#Section1').on('click',function (e) {
        console.log('saeed');
    });



});