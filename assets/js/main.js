
function countChar(val, div, maxlen){
	var len = val.val().length;
	var left = maxlen - len;
	
	
	if (len > maxlen) {
		val.val(val.val().substr(0, maxlen));
	}else {
		$(div).html(left + " characters left");		
	}
};

function update_profile()
{

	$('.pp_inline .user_edit_panel .a').click(function(){
		
		$('.pp_inline .password_cng').addClass('hide');
		$('.pp_inline .user_info_cng').removeClass('hide');
		
	});
	
	$('.pp_inline .user_edit_panel .b').click(function(){		

		$('.pp_inline .password_cng').removeClass('hide');
		$('.pp_inline .user_info_cng').addClass('hide');
		
	});
	
	
	$('.pp_inline .cng_pass_sub').click(function(){
		
		$.post("/login/changePassword", $('.pp_inline .cng_ppp').serialize())
		.success(function(response) { /*alert(response);*/
			var val = $.parseJSON(response);
		
			if(val.results == "error")
			{
				$('.pp_inline .errne').html(val.msg).show();
			}
			else if(val.results == "success")
			{	
				$.prettyPhoto.close();
				alert(val.msg);
			}
		});
		
		return false;			
	});
	

	$(".pp_inline .ppEdiProd").click(function(){
		
		
		$.post("/login/editProfile", $('.cng_prodp').serialize())
		.success(function(response) {if(response) window.location = "/login"; else alert("Error occured! ");});
		
				
		return false;
	
	});
}
	
	
function calculate_local_price(val){

	var price = 0
	
	
	switch(val){
		case "4R":
			price = 9;
			break;
			
		case "5R":
			price = 25;
			break;
	
		case "6R":
			price = 50;
			break;
	
	}	
	
	return price;


}


function dialogBox(title, markup)
{
	$( "#dialog" )
	.attr('title', title)
	.html(markup)
	.dialog({
		zIndex: 90000,
		stack: true,
		buttons: { "Ok": function() { $( this ).dialog( "close" ); } }
	});
}


$(document).ready(function(){
	
	$('.local_order_head').click(function(){
		$('.inter_order').slideUp();
		$('.local_order').toggle();
	});
	
	$('.init_order_head').click(function(){
		$('.local_order').slideUp();
		$('.inter_order').toggle();
	
	});
	
	$('.photWrap .addmore, .docWrap .addmore').click(function(){
		
		var tarDiv = $(this).prev('.fu');
		
		$(tarDiv).after($(tarDiv).clone());
	
	});
	
	
	$('.loc_photo_sprice').live('change', function(){
		var total = 0;
	
		$('.loc_photo_sprice').each(function(){
			total += calculate_local_price($(this).val());
		
		});
		
		$(".price_tag").html("Total cost " + total);
	
		
	});
		
	
	$('.loc_select_type').change(function(){
	
		$('option', this).each(function(){
			if($(this).attr('selected'))
			{
				var a = $(this).val();
				
				switch(a)
				{
					case 'pnf':
						$('.localmessage').slideUp();
						$('.local_photo_file').toggle();
						break;
					case 'msg':
						$('.local_photo_file').slideUp();
						$('.localmessage').toggle();
						break;
				
				}
			}
		});
		
	});
	
	
	$('.message, .description').keyup(function(){	
		countChar($(this), ".wordcounts", 250);
	});
	
	$('.menutop li').mouseenter(function(){
		$(this).find('.dropdownmenu').stop().slideDown();
	}).mouseleave(function(){
		$(this).find('.dropdownmenu').stop().slideUp();		
	});
	

	$('.mask').click(function(){
		
		$('.cabinet_edit_menu').hide();
		$('.cabinet_edit_menu_nopass').hide();
		$(this).hide();		
	});
	
	$(".username_ a[rel^='prettyPhoto']").prettyPhoto({
		theme:'facebook',
		show_title: false, 
		social_tools: false,
		show_description:false,
		deeplinking: false,
		default_width: 660,	
		changepicturecallback: function(){ update_profile(); }
	});
	
	
});