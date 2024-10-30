  jQuery(function() {
	 var valMap = [1000, 1100, 1200, 1300, 1400, 1500, 1600, 1700, 1800, 1900, 2000, 2500, 3000, 3500, 4000, 4500, 5000, 6000, 7000, 8000, 9000, 10000, 12000,  14000, 16000, 18000, 20000];
     jQuery(".slider").slider({
        // min: 0,
         max: valMap.length - 1,
         slide: function(event, ui) {
		   jQuery('#intrestrate').html("$"+valMap[ui.value]);
		   calculation();
         }
     });
	 
	 jQuery(".slider2").slider({
		 min: 4,
		 max: 24,
		 step: 1,
         slide: function(event, ui) {
		   jQuery('#loadterm').html(ui.value+ " Weekly");
		   jQuery('#weekly_change').html(ui.value);
		   calculation();
         }
     });
    });
	function calculation(){
	    //debugger;
		var numberOfMonths = Number(parseFloat(removeSpecial(jQuery("#intrestrate").html())));
        var rateOfInterest = Number(parseFloat(removeSpecial(jQuery("#loadterm").html())));
        var file_charge = Number(parseFloat(removeSpecial(jQuery("#file_charge").html())));
        var interest_charge = Number(parseFloat(removeSpecial(jQuery("#lec_monthly_interest").html())));
		var M; //monthly mortgage payment
		var P = Number(numberOfMonths.toFixed(2)); //principle / initial amount borrowed
		var N = ((rateOfInterest*52)/12).toFixed(0); //number of payments months
		var I = interest_charge / 100; //monthly interest rate
		
		Average_weekly=((P*I)/52);
		repayment=(((P+file_charge)/N)+(Average_weekly)).toFixed(2);
		upper=((P+file_charge)/17)
		lower=((P*I)/52)
		combine=upper+lower;
		var interest_fees_res = ((Average_weekly*N)+file_charge).toFixed(2); 
		var repay_res = (repayment*N).toFixed(2);
		P=P.toFixed(2);
		jQuery("#borrow_amount_res").html('$' + P);
		jQuery("#interest_fees_res").html('$' + interest_fees_res);
		jQuery("#repay_res").html('$' + repay_res);
		jQuery("#weekly_payment_res").html('$' + repayment);
	}

function removeSpecial(value)
{
   value = value.replace(/[^0-9.]/g, " ");

	return value;
}

 jQuery(document).ready(function() {
		calculation();
 });