<?php

$totalfile;
$totalwords;
$_title;
$desc;

switch($type)
{
	case 3:	
		$totalfile = 13;
		$totalwords = 200;
		$price = 2.50;
		$_title = "Order for 10 copies 4R photos & Get";
		$desc = "FREE 3 copies of 4R photos and a 200-words message/document.<br/>
				Description: Under this promotion, if you order for at least 10 copies of 4R size photo print for sending anywhere in Bangladesh, you will then get extra 3 copies 4R size photo and a 200-words letter or message. Here, you will have to upload total 13 4R photos and you can also write a FREE 200-words  letter or message.";
	
	break;
	
	case 6:
		$totalfile = 26;
		$totalwords = 200;
		$price = 4.00;
		$_title = "Order for 20 copies 4R photos & Get";
		$desc="FREE 6 copies of 4R photos and a 200-words message/document.<br/>
				Description: Under this promotion, if you order for at least 20 copies of 4R size photo print for sending anywhere in Bangladesh, you will then get extra 6 copies 4R size photo and a 200-words letter or message. Here, you will have to upload total 26 4R photos and you can also write a FREE 200-words  letter or message.";
		
	break;
	
	case 10:
		$totalfile = 50;
		$totalwords = 300;
		$price = 7.00;
		$_title = "Order for 40 copies 4R photos & Get";
		$desc="FREE 10 copies of 4R photos and a 200-words message/document.<br/>
				Description: Under this promotion, if you order for at least 40 copies of 4R size photo print for sending anywhere in Bangladesh, you will then get extra 10 copies 4R size photo and a 300-words letter or message. Here, you will have to upload total 50 4R photos and you can also write a FREE 300-words  letter or message.";
		
	break;
	
	default:
	
	break;

}

?>


<div class='photos_pp'>

<h2><?php echo $_title;?></h2>
<p><?php echo $desc;?></p>

<div style="padding-top: 10px;">
	<h4>Upload <?php echo $totalfile; ?> 4R Photos</h4>
</div>

<?php
echo form_open_multipart('package/do_packup', 'class="P10" name="faisal"'); 
echo '<h4><em>Please upload a file (supported format i.e. jpg, jpeg, png, bmp, gif)</em></h4>';
echo "<input type='file' name='mystuff[]' id='cab_file_uploader' style='margin:10px;'/>";
echo "<div id='cab_file_uploader-list' style='border: 2px solid #6678B1;margin: 10px 10px 0;padding: 10px;'>
	Selected files will be populated here...
	<br/><br/>
	</div><br/>";
echo "<h4>Write a Message : (up to {$totalwords} words)</h4>";
echo form_textarea('write_mail', '', 'class="message"');
echo "<div class='wordcounts' style='padding: 10px 0;color: #CE2C2C;'>{$totalwords} characters left</div>";	
?>	


</div>



<!--contact options-->

<div style="margin:20px;"><h4>Choose Recipient Address &amp; Sender Address</h4></div>
<div class="contactlist_all left">
	<div class="contact_opts">
		<ul>
			<li class="anc"><a href="#add_new_contact" rel="prettyPhoto">Add new contact</a></li>
			<li class="stm"><a href="#">My Address</a></li>
		</ul>
 	</div>
	<div class="contact_box_order left">
		
		<?php if (count($contact_list) == 0): ?>
		<table id="" class="cabinet_tree_list">
			<tr>
				<td><strong>No contact has been found</strong></td>
			</tr>			
		</table>	
		<?php else: ?>
		<table id="contactlist" class="cabinet_tree_list">
			<tr style="background: #d3d3d3;">
			<th style="padding: 0 10px;">Contacts</th>
			</tr>
			<?php foreach($contact_list as $key=>$con_list): ?>			
			<tr>
				
				<td>	
					<?php 
					$tm=0;
					foreach($con_list as $i=>$c_list): 
						$tm++;	
						if($tm==1):
							echo "<span rel='".$c_list."'></span>";
						elseif($tm==2): 
							echo "<b>".$c_list."</b><br/>";
						else: 
							echo $c_list.", ";
						endif;
					endforeach;				
					?>	
				</td> 
			</tr>	
			<?php endforeach; ?>
		</table>			
		<?php endif; ?>
		
		<table id="mycontactlist" class="hide">
		
		<tr style="background: #d3d3d3;">
		<th style="padding: 0 10px;">Your address</th>
		</tr>
		<?php foreach($user_contact as $key=>$con_list): ?>			
			<tr>
				
				<td id="mycon_name">	
					<?php 
					$tm=0;
					foreach($con_list as $i=>$c_list): 
						$tm++;	
						if($tm==1): 
							echo "<span rel='-".$this->session->userdata('userid')."'></span><b>".$c_list."</b><br/>";
						else: 
							echo $c_list.", ";
						endif;
					endforeach;				
					?>	
				</td> 
			</tr>	
		<?php endforeach; ?>
		</table>

	</div>
</div>

<div class="contact_wrapper left">
	<div class="local_wrap sender">
		<span class="conTy">Sender Address</span>	
	</div>
	<div class="contacts_for_sender"></div>

	<div class="local_wrap recipient">
		<span class="conTy">Recipient Address</span>	
	</div>
	<div class="contacts_for_recipient"></div>
</div>

<span class="clear"></span>

<!--end contact-->


<?php
echo form_input('sender_id','', 'class="hide"');
echo form_input('recip_id','', 'class="hide"');
echo form_input('tcosting',$price, 'class="hide"');
echo form_submit('submit', 'Submit Order', 'class="btn btn-bluish" style="margin: 20px;"');
echo form_close(); 
?>



<script type="text/javascript">

$(document).ready(function(){
	
	$('.message_2').keyup(function(){	
		countChar($(this), ".wordcounts", <?php echo $totalwords;?>);
	});
		
	// contact list chooser	
	$('#contactlist').delegate('tr', 'click' , function(){		
		addContactToList($(this)); 	
		prepareFormData();
	});
	
	// contact new click	
	$('.contact_opts li.stm').click(function(){
		if($('.contacts_for_sender').html() == ""){
			$('.contacts_for_sender').html("<div class='rep_wrap'><div class='del'></div>" + $('#mycon_name').html()+'</div>');
		}
		else if($('.contacts_for_recipient').html() == ""){
			$('.contacts_for_recipient').append("<div class='rep_wrap'><div class='del'></div>" + $('#mycon_name').html()+'</div>');
			//addContactToList($(this));
		}	
		prepareFormData();
		return false;
	});
	
	// new contact
	$(".anc a[rel^='prettyPhoto']").prettyPhoto({
		theme:'facebook',
		show_title: false, 
		social_tools: false,
		show_description:false,
		deeplinking: false,
		default_width: 660,	
		changepicturecallback: function(){ addnewCon(); }
	}); 
	 
	// del click
	$('.del').live('click', function(){
		$(this).parent('div').remove();
		calculatePrice();
	});
	
	$('#cab_file_uploader').MultiFile({
		max: <?php echo $totalfile; ?>,
		list: '#cab_file_uploader-list',
		accept: 'jpg|jpeg|bmp|png|gif'
	});

	
	
	
	function addContactToList(that)
	{
		if($('.contacts_for_sender').html() == ""){
			$('.contacts_for_sender').html("<div class='rep_wrap'><div class='del'></div>" + $('td', that).html()+'</div>');
		}
		else{
			var contactAdded = [];
			
			var markup = parseInt($('td', that).find('span').attr('rel'));
			
			$('.contacts_for_recipient .rep_wrap').each(function(){
				contactAdded.push(parseInt($('span', this).attr('rel')));	
			});
			
			if($.inArray(markup, contactAdded) == '-1')
			{
				$('.contacts_for_recipient').append("<div class='rep_wrap'><div class='del'></div>" + $('td', that).html()+'</div>');
			}
		}	
	}
	
	function addnewCon()
	{
		$('.cr_cabb').click(function(){
		
			$.post("<?php echo site_url(); ?>/mycontact/addContact", $('.pp_inline .addcon_cab').serialize())
			.success(function(response) { /*alert(response);*/
				var val = $.parseJSON(response);
				
				if(val.results == "error")
				{
					$('.pp_inline .errne').html(val.msg).show();
				}
				else if(val.results == "success")
				{	
					var name = $('.pp_inline input[name="c_full_name"]').val();
					var email = $('.pp_inline input[name="c_emailid"]').val();
					var phone = $('.pp_inline input[name="c_pnumber"]').val();
					var address = $('.pp_inline textarea[name="c_address"]').val();
					var country = $('.pp_inline select[name="c_country"]').val();
					
					if($('#contactlist').length == 0)
					{
						var markup = '<tr style="background: #d3d3d3;"><th style="padding: 0 10px;">Contacts</th></tr><tr><td><span rel="'+val.msg+'"></span><b>'+name+'</b><br/>'+address+', Email: '+email+', Phone: '+phone+', '+country+'.</td></tr>';	
						$('.cabinet_tree_list').remove();
						$('<table id="contactlist" class="cabinet_tree_list"/>').append(markup).appendTo($('.contact_box_order'));
						// add listener
						$('#contactlist').delegate('tr', 'click' , function(){addContactToList($(this));});
					}
					else
					{
						var markup = '<tr><td><span rel="'+val.msg+'"></span><b>'+name+'</b><br/>'+address+', Email: '+email+', Phone: '+phone+', '+country+'.</td></tr>';	
						$('#contactlist tr:last').after(markup);
					}
					
					$.prettyPhoto.close();
				}
				
			});
			
			return false;
		});
	}
	
	
	function prepareFormData()
	{
		var senderID = $('.contacts_for_sender .rep_wrap span').attr('rel');
		var recepID = [];
		
		$.each($('.contacts_for_recipient .rep_wrap'), function(){
			recepID.push(parseFloat($('span', this).attr('rel')));
		});
			
		$("input[name='sender_id']").val(senderID);
		$("input[name='recip_id']").val(recepID.toString());
	}
	

	
});
	
	
</script>	
	