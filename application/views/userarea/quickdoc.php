

<?php

$_title = "Quickmail";
$desc = "Send a FREE message or document anywhere in Bangladesh.<br/>
		Description: Under this promotion, any registered individual can send a FREE printed letter/message/document anywhere in Bangladesh. The offer is applicable only to individuals who are staying outside Bangladesh. The FREE printed message will be in black & white and should not be more than 250 words.";


	
echo "<div class='quickdoc'>";
?>

<h2><?php echo $_title;?></h2>
<p><?php echo $desc;?></p>

<?php 
echo "<h4>Write a Message : (up to 250 words)</h4>";
echo form_open_multipart('package/do_upload', 'class="P10" name="faisal"'); 
echo form_textarea('write_mail', '', 'class="message"');
echo '<div class="wordcounts" style="padding: 10px 0;color: #CE2C2C;">250 characters left</div>';
echo '<h4>or, <em>Please upload a file (supported format i.e. doc, docx, pdf)</em></h4>';
echo "<input type='file' name='mystuff[]' id='cab_file_uploader' style='margin:10px;'/>";
echo "<div id='cab_file_uploader-list' style='border: 2px solid #6678B1;margin: 10px 10px 0;padding: 10px;'>
	Selected files will be populated here...
	<br/><br/>
	</div><br/>";
?>


<?php
echo "</div>";
?>

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
echo form_submit('submit', 'Submit Order', 'class="btn btn-bluish" style="margin: 20px;"');
echo form_close(); 
?>



<div id="add_new_contact" class="hide">
	<br/><br/>
	<h5>Add New Contact</h5>
	<div class="can_wrap">	
	<?php
	$country = array(
		"-1" => "Select Country",
		"AF" => "Afghanistan",
		"AL" => "Albania",
		"DZ" => "Algeria",
		"AS" => "American Samoa",
		"AD" => "Andorra",
		"AO" => "Angola",
		"AI" => "Anguilla",
		"AQ" => "Antarctica",
		"AG" => "Antigua and Barbuda",
		"AR" => "Argentina",
		"AM" => "Armenia",
		"AW" => "Aruba",
		"AU" => "Australia",
		"AT" => "Austria",
		"AZ" => "Azerbaijan",
		"BS" => "Bahamas",
		"BH" => "Bahrain",
		"BD" => "Bangladesh",
		"BB" => "Barbados",
		"BY" => "Belarus",
		"BE" => "Belgium",
		"BZ" => "Belize",
		"BJ" => "Benin",
		"BM" => "Bermuda",
		"BT" => "Bhutan",
		"BO" => "Bolivia",
		"BA" => "Bosnia and Herzegowina",
		"BW" => "Botswana",
		"BV" => "Bouvet Island",
		"BR" => "Brazil",
		"IO" => "British Indian Ocean Territory",
		"BN" => "Brunei Darussalam",
		"BG" => "Bulgaria",
		"BF" => "Burkina Faso",
		"BI" => "Burundi",
		"KH" => "Cambodia",
		"CM" => "Cameroon",
		"CA" => "Canada",
		"CV" => "Cape Verde",
		"KY" => "Cayman Islands",
		"CF" => "Central African Republic",
		"TD" => "Chad",
		"CL" => "Chile",
		"CN" => "China",
		"CX" => "Christmas Island",
		"CC" => "Cocos (Keeling) Islands",
		"CO" => "Colombia",
		"KM" => "Comoros",
		"CG" => "Congo",
		"CK" => "Cook Islands",
		"CR" => "Costa Rica",
		"CI" => "Cote D'Ivoire",
		"HR" => "Croatia",
		"CU" => "Cuba",
		"CY" => "Cyprus",
		"CZ" => "Czech Republic",
		"DK" => "Denmark",
		"DJ" => "Djibouti",
		"DM" => "Dominica",
		"DO" => "Dominican Republic",
		"TL" => "East Timor",
		"EC" => "Ecuador",
		"EG" => "Egypt",
		"SV" => "El Salvador",
		"GQ" => "Equatorial Guinea",
		"ER" => "Eritrea",
		"EE" => "Estonia",
		"ET" => "Ethiopia",
		"FK" => "Falkland Islands (Malvinas)",
		"FO" => "Faroe Islands",
		"FJ" => "Fiji",
		"FI" => "Finland",
		"FR" => "France",
		"FX" => "France, Metropolitan",
		"GF" => "French Guiana",
		"PF" => "French Polynesia",
		"TF" => "French Southern Territories",
		"GA" => "Gabon",
		"GM" => "Gambia",
		"GE" => "Georgia",
		"DE" => "Germany",
		"GH" => "Ghana",
		"GI" => "Gibraltar",
		"GR" => "Greece",
		"GL" => "Greenland",
		"GD" => "Grenada",
		"GP" => "Guadeloupe",
		"GU" => "Guam",
		"GT" => "Guatemala",
		"GN" => "Guinea",
		"GW" => "Guinea-bissau",
		"GY" => "Guyana",
		"HT" => "Haiti",
		"HM" => "Heard and Mc Donald Islands",
		"HN" => "Honduras",
		"HK" => "Hong Kong",
		"HU" => "Hungary",
		"IS" => "Iceland",
		"IN" => "India",
		"ID" => "Indonesia",
		"IR" => "Iran (Islamic Republic of)",
		"IQ" => "Iraq",
		"IE" => "Ireland",
		"IL" => "Israel",
		"IT" => "Italy",
		"JM" => "Jamaica",
		"JP" => "Japan",
		"JO" => "Jordan",
		"KZ" => "Kazakhstan",
		"KE" => "Kenya",
		"KI" => "Kiribati",
		"KP" => "Korea, Democratic People's Republic of",
		"KR" => "Korea, Republic of",
		"KW" => "Kuwait",
		"KG" => "Kyrgyzstan",
		"LA" => "Lao People's Democratic Republic",
		"LV" => "Latvia",
		"LB" => "Lebanon",
		"LS" => "Lesotho",
		"LR" => "Liberia",
		"LY" => "Libyan Arab Jamahiriya",
		"LI" => "Liechtenstein",
		"LT" => "Lithuania",
		"LU" => "Luxembourg",
		"MO" => "Macau",
		"MK" => "Macedonia, The Former Yugoslav Republic of",
		"MG" => "Madagascar",
		"MW" => "Malawi",
		"MY" => "Malaysia",
		"MV" => "Maldives",
		"ML" => "Mali",
		"MT" => "Malta",
		"MH" => "Marshall Islands",
		"MQ" => "Martinique",
		"MR" => "Mauritania",
		"MU" => "Mauritius",
		"YT" => "Mayotte",
		"MX" => "Mexico",
		"FM" => "Micronesia, Federated States of",
		"MD" => "Moldova, Republic of",
		"MC" => "Monaco",
		"MN" => "Mongolia",
		"MS" => "Montserrat",
		"MA" => "Morocco",
		"MZ" => "Mozambique",
		"MM" => "Myanmar",
		"NA" => "Namibia",
		"NR" => "Nauru",
		"NP" => "Nepal",
		"NL" => "Netherlands",
		"AN" => "Netherlands Antilles",
		"NC" => "New Caledonia",
		"NZ" => "New Zealand",
		"NI" => "Nicaragua",
		"NE" => "Niger",
		"NG" => "Nigeria",
		"NU" => "Niue",
		"NF" => "Norfolk Island",
		"MP" => "Northern Mariana Islands",
		"NO" => "Norway",
		"OM" => "Oman",
		"PK" => "Pakistan",
		"PW" => "Palau",
		"PA" => "Panama",
		"PG" => "Papua New Guinea",
		"PY" => "Paraguay",
		"PE" => "Peru",
		"PH" => "Philippines",
		"PN" => "Pitcairn",
		"PL" => "Poland",
		"PT" => "Portugal",
		"PR" => "Puerto Rico",
		"QA" => "Qatar",
		"RE" => "Reunion",
		"RO" => "Romania",
		"RU" => "Russian Federation",
		"RW" => "Rwanda",
		"KN" => "Saint Kitts and Nevis",
		"LC" => "Saint Lucia",
		"VC" => "Saint Vincent and the Grenadines",
		"WS" => "Samoa",
		"SM" => "San Marino",
		"ST" => "Sao Tome and Principe",
		"SA" => "Saudi Arabia",
		"SN" => "Senegal",
		"SC" => "Seychelles",
		"SL" => "Sierra Leone",
		"SG" => "Singapore",
		"SK" => "Slovakia (Slovak Republic)",
		"SI" => "Slovenia",
		"SB" => "Solomon Islands",
		"SO" => "Somalia",
		"ZA" => "South Africa",
		"GS" => "South Georgia and the South Sandwich Islands",
		"ES" => "Spain",
		"LK" => "Sri Lanka",
		"SH" => "St. Helena",
		"PM" => "St. Pierre and Miquelon",
		"SD" => "Sudan",
		"SR" => "Suriname",
		"SJ" => "Svalbard and Jan Mayen Islands",
		"SZ" => "Swaziland",
		"SE" => "Sweden",
		"CH" => "Switzerland",
		"SY" => "Syrian Arab Republic",
		"TW" => "Taiwan",
		"TJ" => "Tajikistan",
		"TZ" => "Tanzania, United Republic of",
		"TH" => "Thailand",
		"TG" => "Togo",
		"TK" => "Tokelau",
		"TO" => "Tonga",
		"TT" => "Trinidad and Tobago",
		"TN" => "Tunisia",
		"TR" => "Turkey",
		"TM" => "Turkmenistan",
		"TC" => "Turks and Caicos Islands",
		"TV" => "Tuvalu",
		"UG" => "Uganda",
		"UA" => "Ukraine",
		"AE" => "United Arab Emirates",
		"GB" => "United Kingdom",
		"US" => "United States",
		"UM" => "United States Minor Outlying Islands",
		"UY" => "Uruguay",
		"UZ" => "Uzbekistan",
		"VU" => "Vanuatu",
		"VA" => "Vatican City State (Holy See)",
		"VE" => "Venezuela",
		"VN" => "Viet Nam",
		"VG" => "Virgin Islands (British)",
		"VI" => "Virgin Islands (U.S.)",
		"WF" => "Wallis and Futuna Islands",
		"EH" => "Western Sahara",
		"YE" => "Yemen",
		"RS" => "Serbia",
		"CD" => "The Democratic Republic of Congo",
		"ZM" => "Zambia",
		"ZW" => "Zimbabwe",
		"JE" => "Jersey",
		"BL" => "St. Barthelemy",
		"XU" => "St. Eustatius",
		"XC" => "Canary Islands",
		"ME" => "Montenegro"
	);
	?>
	
	<?php 
	echo "<div class='errne'></div>";	
	echo form_open("mycontact/addnew", 'class="addcon_cab"');			
	echo "<div class='c_cab_w'><label class='left'>Full Name</label><div class='left can_wap'>" . form_input('c_full_name', '', 'class="ccname"') . "</div><div class='left err companyname-error'><span></span></div><span class='clear'></span></div>";	
	echo "<div class='c_cab_w'><label class='left'>Address</label><div class='left can_wap'>" . form_textarea('c_address', '', 'class="ccname"') . "</div><div class='left err companyname-error'><span></span></div><span class='clear'></span></div>";	
	echo "<div class='c_cab_w'><label class='left'>Email Address</label><div class='left can_wap'>" . form_input('c_emailid', '', "class='ccname'") . "</div><div class='left err companyname-error'><span></span></div><span class='clear'></span></div>";	
	echo "<div class='c_cab_w'><label class='left'>Phone Number</label><div class='left can_wap'>" . form_input('c_pnumber', '', "class='ccname'") . "</div><div class='left err companyname-error'><span></span></div><span class='clear'></span></div>";	
	echo "<div class='c_cab_w'><label class='left'>Country</label><div class='left can_wap'>" . form_dropdown('c_country', $country, '-1', 'class="r_country"') . "</div><div class='left err companyname-error'><span></span></div><span class='clear'></span></div>";	
	echo "<div class='c_cab_w'><label class='left'></label><div class='left can_wap'>" . form_submit("submit", "Add Contact", "class='cr_cabb btn btn-bluish'") . "</div><div class='left err companyname-error'><span></span></div><span class='clear'></span></div>";			
	echo form_close();
	?>	
	</div>
</div>



<script type="text/javascript">
$(function(){
	
	
	
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
		max: 1,
		list: '#cab_file_uploader-list',
		accept: 'doc|docx|pdf'
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