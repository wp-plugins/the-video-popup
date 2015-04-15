function tvpp_popup_setCookie(name,value,days) {
	if (days) {
		var date = new Date();
		date.setTime(date.getTime()+(days*24*60*60*1000));
		var expires = "; expires="+date.toGMTString();
	}
	else var expires = "";
	document.cookie = name+"="+value+expires+"; path=/";
}
function tvpp_popup_getCookie(name) {
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');
	for(var i=0;i < ca.length;i++) {
		var c = ca[i];
		while (c.charAt(0)==' ') c = c.substring(1,c.length);
		if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
	}
	return null;
}
jQuery(document).ready(function($){
		divWidth = $(".tvpp_popup").outerWidth(true);
		divheight =$(".tvpp_popup").outerHeight(true);
		var maxwidth = divWidth + 20;
		$(".tvpp_popup").animate({right : -maxwidth});

			if(tvpp_popup_getCookie("close_tvpp_box")=='yes')
			{
			$(".tvpp_popup").animate({right:-2},200);
			$(".tvpp_popup_heading").hide();
			$(".tvpp_popup").css({height : 26, width : 22});
			$(".tvpp_popup_close").hide();
			$(".tvpp_popup_max").show();
			}
		$(window).scroll(function(){
				var chkd=$(window).scrollTop();
				var scrollBottom =$(document).height()-$(window).height()-40;
				if(chkd>=scrollBottom)
				{
				$(".tvpp_popup").animate({right:-2},200);
				}
		});
});
jQuery(document).ready(function(){
	jQuery('.tvpp_popup_close').click(function(){
	jQuery(".tvpp_popup_heading").hide();
	jQuery(".tvpp_popup").animate({height : 26, width : 22},400);
	jQuery(this).hide();
	jQuery(".tvpp_popup_max").show();
	tvpp_popup_setCookie("close_tvpp_box",'yes',1);
	});
});
jQuery(document).ready(function(){
	jQuery('.tvpp_popup_max').click(function(){
	jQuery(".tvpp_popup").animate({height : divheight, width : divWidth},400);
	jQuery(".tvpp_popup_heading").show();
	jQuery(this).hide();
	jQuery(".tvpp_popup_close").show();
 	tvpp_popup_setCookie("close_tvpp_box",'no',1);
	});
});
