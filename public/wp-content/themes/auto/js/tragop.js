function format_price(n) {
    return n.toFixed(0).replace(/./g, function(c, i, a) {
        return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "." + c : c;
    });
}


function ConditionCheck(percentcurr, typeCompany) {
    if (typeCompany == '1002') {
            if ('10000000' < parseInt(jQuery('.trg-sr-price>strong').attr('data-price')) && parseInt(jQuery('.trg-sr-price>strong').attr('data-price')) < '15000000' && percentcurr < '40') {
                jQuery('.trg-sr-price-first').hide();
                jQuery('.trg-slp-order').hide();
                jQuery('.trg-sr-conditioncheck').show();
            } else {
                jQuery('.trg-sr-price-first').show();
                jQuery('.trg-slp-order').show();
                jQuery('.trg-sr-conditioncheck').hide();
            }
            if ('15000000' < parseInt(jQuery('.trg-sr-price>strong').attr('data-price')) && parseInt(jQuery('.trg-sr-price>strong').attr('data-price')) < '21000000' && percentcurr < '50') {
                jQuery('.trg-sr-price-first').hide();
                jQuery('.trg-slp-order').hide();
                jQuery('.trg-sr-conditioncheck').show();
            } else {
                jQuery('.trg-sr-price-first').show();
                jQuery('.trg-slp-order').show();
                jQuery('.trg-sr-conditioncheck').hide();
            }
            if ('21000000' < parseInt(jQuery('.trg-sr-price>strong').attr('data-price'))) {
                jQuery('.trg-sr-price-first').hide();
                jQuery('.trg-slp-order').hide();
                jQuery('.trg-sr-conditioncheck').show();
            }
    }
		else {
        jQuery('.trg-sr-price-first').show();
        //jQuery('.trg-slp-order').show();
        //jQuery('.trg-sr-conditioncheck').hide();
    }
        
}


function calculator(trgprice, trgpercent, trgmonth) {
    var p = trgprice*trgpercent/100;
    var m = (trgprice - trgprice*trgpercent/100);
    var m_con = m / month[trgmonth];
    m_phaitra = Math.ceil(m_con + m_con*arr[trgmonth]/100);
    
	$('#tientratruoc').val(trgprice*trgpercent/100);
	$('#tientrahangthang').val(Math.ceil(m_con + m_con*arr[trgmonth]/100));
    
    if (jQuery('input[name=trg-service]:checked').val() == '9') {
        jQuery('.dieukien>strong').html('HD SaiSon hiện tại chỉ hỗ trợ trả trước từ 20% - 70% với kì hạn tối thiểu là 9 tháng, tối đa là 12 tháng . Bạn vui lòng liên hệ 18006601 để nghe tư vấn');
    }
    if (jQuery('input[name=trg-service]:checked').val() == '10') {
        jQuery('.dieukien>strong').html('PPF hiện tại chỉ hỗ trợ trả trước với mức từ 20% - 50% với kỳ hạn dưới 12 tháng, lớn hơn 50% bạn vui lòng liên hệ 18006601 để nghe tư vấn');
    }
    if (jQuery('input[name=trg-service]:checked').val() == '11') {
        jQuery('.dieukien>strong').html('ACS chỉ hỗ trợ trả góp trong kỳ hạn: 6, 9, 12, 15, 18 tháng và trả trước tối thiểu là 10%. Bạn vui lòng liên hệ 18006601 để nghe tư vấn');
    }
    
    jQuery('.trg-price-prepaid>strong, #checkout_user_info #qb_tratruoc').html(format_price(p) + 'đ');
    jQuery('.trg-price-monthly>strong, #checkout_user_info #qb_trahthang').html(format_price(m_phaitra) + 'đ');

    /*Push trg-month vào modal form*/
    var qb_timevay  = jQuery('.trg-month-active option:selected').text(),
        qb_trg_item = jQuery('.trg-services-main .current .trg-hang-item').attr('data-bankname'); 

    jQuery('#qb_timevay').html(qb_timevay);
    jQuery('#qb_trg_item').html(qb_trg_item);
}


jQuery(document).on('change', '.trg-ipradio', function (event) {
    jQuery('.trg-ipradio').removeClass('active');
    var pricecurent = jQuery('.price>strong').attr('data-price');
    var x = jQuery("input[type='radio'][name='trg-service']:checked");

    event.preventDefault();
    var percentcurr = jQuery('.trg-percent option:selected').val();
    var monthcurr = jQuery('#trg-month'+x.val()+' option:selected').val();
    
    var typeCompany = jQuery(this).val();
    jQuery(this).addClass('active');
    ConditionCheck(percentcurr, typeCompany);
    if ((jQuery('.trg-details').attr('style') != 'display: none;')) {
        calculator(pricecurent, percentcurr, monthcurr);
    }
});


jQuery(document).on('change', '.trg-percent', function () {
    
    var pricecurent = jQuery('.price>strong').attr('data-price');
    var percentchg = jQuery('.trg-percent option:selected').val();
    
    var percentmonthchg = jQuery('.trg-month option:selected').val();
    calculator(pricecurent, percentchg, percentmonthchg);

});

jQuery(document).on('change', '.trg-month', function (event) {
    var pricecurent = jQuery('.price>strong').attr('data-price');
    var monthchg = jQuery(this).val();
    var monthpercentchg = jQuery('.trg-percent option:selected').val();
	
    calculator(pricecurent, monthpercentchg, monthchg);
});

(function(jQuery){
    jQuery(document).ready(function (){

        jQuery(".trg-hang-item").click(function(event) {
            //event.preventDefault();
            jQuery(this).parent().addClass("current");
            jQuery(this).parent().siblings().removeClass("current");
            var tab = jQuery(this).attr("data-href");
            var id = jQuery(this).attr('data-id');
            jQuery(".trg-info-sv").not(tab).css("display", "none");
            jQuery(tab).fadeIn();
            jQuery(".trg-month").css("display", "none").removeClass('trg-month-active');
            jQuery("#trg-month"+id).css("display", "block").addClass('trg-month-active');
           
            goToByScroll($(this).attr("id")); 
        });

    });


})(window.jQuery);
