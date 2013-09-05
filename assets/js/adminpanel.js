function orderManage(r)
{	
	var type = $('.pp_inline h2').attr('class');
	var id = r.attr('alt');
	if(type == "v")	viewOrderDetails(id);	
	else if(type == "e") editOrderDetails(r);
	else if(type == "d") delOrderDetails(r);
	
}

function viewOrderDetails(p)
{	
	var dpath = "/login/download/";
	var markup = "";
	$.ajax({
		type:'POST',
		url:'/admin/getOrder/' + p,		
		success: function(response){
			var obj  = $.parseJSON(response);
			//console.log(obj);
			//console.log(obj.allfiles);
			markup += "<h3>File Lists</h3>";
			markup += "<table class='table table-striped table-bordered bootstrap-datatable datatable'>";
			markup += "<tr><th>File Name</th><th>Type</th><th>Package</th><th>User id</th></tr>";			
			
			$.each(obj.allfiles, function(i, val){
				markup += "<tr>";
				var file = val.split(',');
				var catId;
				$.each(file, function(j, v){					
					if(j==0) catId = v;
					else if(j==1) markup += "<td rel='"+catId+"'><a href='#' class='download_file'>" + v + "</a></td>";
					else markup += "<td>" + v + "</td>";
				});	
				markup += "</tr>";
			});
			
			markup += "</table>";
			
			markup += "<h3>Sender address</h3>";
			markup += "<table class='table table-striped table-bordered bootstrap-datatable datatable'>";
			markup += "<tr><th>Name</th><th>Address</th><th>Phone</th><th>Email</th><th>Country</th></tr>";
			
			$.each(obj.sender, function(i, val){
				markup += "<tr>";
				$.each(val, function(j, v){
					markup += "<td>" + v + "</td>";
				});
				markup += "</tr>";
			});
			markup += "</table>";
						
			markup += "<h3>Receiver address</h3>";
			markup += "<table class='table table-striped table-bordered bootstrap-datatable datatable'>";
			markup += "<tr><th>Name</th><th>Address</th><th>Phone</th><th>Email</th><th>Country</th></tr>";
			$.each(obj.receiver, function(i, val){								
				markup += "<tr>";
				$.each(val, function(j, v){
					markup += "<td>" + v + "</td>";
				});
				markup += "</tr>";
			});
			markup += "</table>";
					
			$('.pp_inline .m_content').html(markup);			
			$('.pp_content').css('height', $('#pp_full_res').height());
			
			//dl file
			$.each($('.download_file'), function(){
				$(this).click(function(){				
					var cab_id = $(this).parent().attr('rel')+"/";
					var pathurl = dpath + cab_id + $(this).html();
								
					window.open(pathurl, "_blank");
					
					return false;			
				});			
			});
			lightboxResNormal();
		}
	});
}

var lightboxResNormal = function(){
    var h = $('#pp_full_res').height();
	
    if(h>560){
        $('.pp_content').height(h);
    }else{
        /* $('.pp_inline .buildingBox .buildingBox_wrap').height(440); */
        $('.pp_content').height(560);
    }
    $('.pp_overlay').height(($(document).height())+'px');
    $('html,body').animate({
        scrollTop: 1
    },'fast');
    $('html,body').animate({
        scrollTop: -1
    },'fast');
	$('.pp_pic_holder').css('top', '35px');
}
function editOrderDetails(p)
{	
	var id = p.attr('alt');
	var root = $(p).closest("tr");
	var divM = $("td:eq(7) span", root);

	$.ajax({
		type:'POST',
		url:'/admin/editOrderStatus/' + id,		
		success: function(response){		
			if(response == "true")
			{
				divM.attr("class", "label label-success");
				divM.html("active");
				$.prettyPhoto.close();
			}			
		}
	});
}

function delOrderDetails(p)
{
	var id = p.attr('alt');
	var root = $(p).closest("tr");
	
	$(".pp_inline .yes_pretty").click(function(){	
		$.ajax({
			type:'POST',
			url:'/admin/delOrder/' + id,
			success: function(response){		
				if(response == "true")
				{	
					root.remove();
					$.prettyPhoto.close();
				}			
			}
		});
	});
	
	$(".pp_inline .cancel_pretty").click(function(){
		$.prettyPhoto.close();
	});
}

$(function(){
	$.each($('.p_options'), function(){
		var that = $('a', this);
		$("a[rel^='prettyPhoto']", this).prettyPhoto({
			theme:'facebook',
			show_title: false, 
			social_tools: false,
			show_description:false,
			deeplinking: false,
			default_width: 660,	
			allow_resize:false,
			changepicturecallback: function(){ orderManage(that); }
		});	
	});	
	
	$('.btn-minimize').click(function(e){
		e.preventDefault();
		var $target = $(this).parent().parent().next('.box-content');
		if($target.is(':visible')) $('i',$(this)).removeClass('icon-chevron-up').addClass('icon-chevron-down');
		else 					   $('i',$(this)).removeClass('icon-chevron-down').addClass('icon-chevron-up');
		$target.slideToggle();
	});


});