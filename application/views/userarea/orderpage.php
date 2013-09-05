
<h4>Printing Option :</h4>
<div class="local_wrap">
	<h5>Choose a package</h5>
	<div class="location_opt">
		<ul>
		  <li rel="local" class="selected">Local</li>
		  <li rel="inter">International</li>  
		</ul>
	</div>	

</div>

<div class="list_wrap">
	<div class="file_list_edit">
		<ul>
			<li class="slt_all">select all</li>
			<li class="delete_files">delete</li>
		</ul>
	</div>
	<!--table of order list -->
	<table id="minimalist" class="cabinet_tree_list fileList">

	<tr><th></th><th>File Name</th><th>Types</th><th>Packages</th><th>Number of Pages/Photos</th> <th class="price_type">Prices</th></tr>
	<?php for($i=0; $i<count($file_list); $i++):?>
		<tr>
			<td><div class="checkbox"></div></td>
			<td><div rel="<?php echo $file_id[$i]; ?>"><?php echo $file_list[$i]; ?></div></td>
			<td>
				<select class="pack_type_chs">
				  <option value="documents">Documents</option>
				  <option value="photos">Photos</option>
				</select>
			</td>
			<td>
				<div class="odocuments local"></div>
				
				<div class="odocuments inter hide"></div>
				
				<div class="ophotos local hide"></div>
				
				<div class="ophotos inter hide"></div>
			</td>
			<td><div class="cng_number_page"><?php echo form_input('','1'); ?></div></td>		
			<td class="total_row_pr"></td>
		</tr>
	<?php endfor; ?>
	</table>

</div>


<!--
Binding options
50tk local, .75 Inter 
-->
<!-- finising options -->
<div class="finish_options">
	<div class="head">Finishing Options</div>
	<ul style="list-style:none;">
		<li>		
			<div class="asd_dd_d"></div>
			<input class="finish_options_itm" type="radio" name="binding_opt" value="-1" checked="checked" />None
		</li>
		<li>
			<div class="asd_dd_d saddle"></div>
			<input class="finish_options_itm" type="radio" name="binding_opt" value="1"/>Saddle Stitch
		</li>
		<li>
			<div class="asd_dd_d coil"></div>
			<input class="finish_options_itm" type="radio" name="binding_opt" value="2"/>Coil Binding
		</li>
		<li>
			<div class="asd_dd_d comb"></div>
			<input class="finish_options_itm" type="radio" name="binding_opt" value="3"/>Comb Binding
		</li>
		<li>
			<div class="asd_dd_d perfect"></div>
			<input class="finish_options_itm" type="radio" name="binding_opt" value="4"/>Perfect Binding
		</li>
	</ul>

</div>

<!-- end finising -->

<div class="page_color">	
	<input type="checkbox" id="color_value" />First page in color	
</div>	


<div class="special_ins">	
	<div class="left">Special Instruction</div> 
	<div class="left"><input type="text" value="" name="spcial_ins_txt"/></div>	
	<span class="clear"></span>
</div>	


<!--contact options-->

<div style="margin:20px;"><h4>Choose Recipient Address &amp; Sender Address</h4></div>
<div class="contactlist_all left">
	<div class="contact_opts">
		<ul>
			<li class="anc"><a href="#add_new_contact" rel="prettyPhoto">Add new contact</a></li>
			<li class="stm"><a href="#">My Address</a></li>
			<li class="searchBox"><a href="#"><?php echo form_input('search_contact_id', '', 'class="searchConId" placeholder="Search and Enter"'); ?></a></li>			
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
							echo "<span class='contId conI{$c_list}' rel='{$c_list}'>{$c_list}</span> ";
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

<!--end of table -->
<table id="minimalist" class="total_cost" style="background: #FFF5A8;font-weight: 700;">
	<tr>
		<td width="60%"></td>
		<td>COURIER COST</td>
		<td class="_courier_cost"></td>
	</tr>
	
	<tr>
		<td width="60%"></td>
		<td>TOTAL COST</td>
		<td class="_total_cost"></td>
	</tr>
</table>



<div class="order_pl_checkout">
	<?php
	// parameters for this 	
	$file_id = implode(",", $file_id);
	
	echo form_open('orderpage/payment');
	//echo form_input('order_files','', 'class="hidess"');
	//echo form_input('binding','', 'class="hidess"');
	//echo form_input('first_page_color','', 'class="hidess"');
	//echo form_input('special_ins','', 'class="hidess"');
	echo form_input('file_id', $file_id, 'class="hide"');
	echo form_input('file_type', '', 'class="hide"');	
	echo form_input('file_pack', '', 'class="hide"');	
	echo form_input('file_number', '', 'class="hide"');		
	echo form_input('binding', '', 'class="hide"');		
	echo form_input('fpageclr', '', 'class="hide"');		
	echo form_input('spinstruction', '', 'class="hide"');		
	echo form_input('sender_id','', 'class="hide"');
	echo form_input('recip_id','', 'class="hide"');
	echo form_input('tcosting','', 'class="hide"');
	echo form_input('package_n','', 'class="hide"');
	echo form_submit('submit', 'Submit Order', 'class="btn btn-bluish"');
	echo form_close();
	?>
</div>

<div style="padding:0 20px;" class="hide">
<?php
// parameters for this 
$va = implode(",", $file_list);
/* 

echo "<input type='text' name='files_name' value='{$va}'/>";
echo form_input('binding_opt','', 'class="hides"');
echo form_input('first_page_clr','', 'class="hides"');
echo form_input('special_msg','', 'class="hides"');
echo form_input('recep_add','', 'class="hides"');
echo form_input('sender_add','', 'class="hides"');




echo form_submit('submit', 'Submit', 'class="cr_cabb btn btn-bluish"');
echo form_close(); */
?>
</div>

<span class="clear"></span>

<div class="all_package_price">


</div>

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

<div class="popover">
	<div class="popover-inner">Type the serial no of the contact &amp; enter to add in the Recipient Address</div>
</div>

<?php

	$file = base_url() . "assets/" . "1.pdf";
	
?>

<script>
var _local =
{
	photo:
	{
		cats :
		{
		'4R':9,
		'5R':25,
		'6R':50, 
		'8R':100
		}
	},
	
	docs:
	{
		cats : 
		{
		'BW': 6,
		'COLOR': 12
		}		
	},
		
	courier: 
	{
		cats : 
		{
		'a': 20, // 25
		'b': 10	 // more than 25	
		}				
	},
	
	finishing: 50,
	firstpage_color: 12,
	
	getPhotoPrice:function(pack){		
		return this.photo.cats[pack];
	},
	
	getDocPrice:function(pack){		
		return this.docs.cats[pack];
	},
	
	getCourierPrice:function(pack){		
		return this.courier.cats[pack];
	}
};

var _international =
{
	finishing: 0.75,
	firstpage_color: 0.18,
	photo:
	{
		cats : 
		{
		'4R':{'a': 0.15, 'b': 0.12}, 
		'5R':{'a': 0.35, 'b': 0.30}, 
		'6R':{'a': .80, 'b': 0.65}, 
		'8R':{'a': 2, 'b': 1.5}
		}		
	},
	
	docs:
	{
		cats : 
		{
		'BW': 0.10,
		'COLOR': 0.18
		}		
	},
	
	courier: 
	{
		cats : 
		{
		'a': 1, 	// 50
		'b': 0.5 	// more than 25	
		}				
	},
	
	getPhotoPrice:function(pack, type){
		if(type=="alpha")
			return this.photo.cats[pack].a;
		else
			return this.photo.cats[pack].b;
	},
	
	getDocPrice:function(pack){		
		return this.docs.cats[pack];
	},
	
	getCourierPrice:function(pack){		
		return this.courier.cats[pack];
	}
	
};


$(function(){

	var packageData = <?php echo $package_list; ?>;
	
	/* console.log(packageData);	 */
	
	var markups = '<select>';
	$.each( packageData.localDoc, function( key, value ) {	  
	  if(key == "BW")
		markups += '<option value="'+key+'">A4 size - 80 gsm b/w</option>';
	  else	
		markups += '<option value="'+key+'">A4 size - 80 gsm colour</option>';
	});
	markups += '</select>';
	$('.odocuments.local').append(markups);
	//--------------------------------------
	var markups = '<select>';
	$.each( packageData.interDoc, function( key, value ) {	  
	  if(key == "BW")
		markups += '<option value="'+key+'">A4 size - 80 gsm b/w</option>';
	  else	
		markups += '<option value="'+key+'">A4 size - 80 gsm colour</option>';
	});
	markups += '</select>';
	$('.odocuments.inter').append(markups);
	
	//--------------------------------------
	var markups = '<select>';
	$.each( packageData.localPhoto, function( key, value ) {	  	
		markups += '<option value="'+key+'">'+key+'</option>';	  
	});
	markups += '</select>';
	$('.ophotos.local').append(markups);
	//--------------------------------------
	var markups = '<select>';
	$.each( packageData.interPhoto, function( key, value ) {	  	
		markups += '<option value="'+key+'">'+key+'</option>';	  
	});
	markups += '</select>';
	$('.ophotos.inter').append(markups);
	
	
	
	$('.checkbox').live('click', function(){
		if($(this).hasClass('click'))
		{
			$(this).removeClass('click');
			$(this).closest('tr').removeClass('selected');
		}
		else
		{
			$(this).addClass('click');
			$(this).closest('tr').addClass('selected');
		}		
	});
	
	var selected_all = true;
	$(".slt_all").live("click", function(){
				
		$('.checkbox').each(function(){
			if(!$(this).hasClass('click') && selected_all)			
			{
				$(this).addClass('click');
				$(this).closest('tr').addClass('selected');
			}
			else if($(this).hasClass('click') && !selected_all)			
			{
				$(this).removeClass('click');
				$(this).closest('tr').removeClass('selected');
			}
		});	
		if(selected_all)
			$(this).css('color', '#039');
		else
			$(this).css('color', '#000');
		
		selected_all = !selected_all;
		
		return false;
	});
	
	$('.delete_files').live('click', function(){
		var total_row = 0;
		var file_selected = new Array();
		$('#minimalist tr').each(function(){
			if($(this).hasClass('selected')){					
				file_selected.push($('td:eq(1)', this).html());					
			}
		});			
		if(file_selected.length == 0)
		{
			alert('Please select some files first.');
		}
		else
		{
			if(confirm('Do you really want to remove this file?'))
			{				
				$('#minimalist tr').each(function(){
					if($(this).hasClass('selected')){							
						$(this).remove();
					}
				});		
				
				$('#minimalist tr').each(function(){total_row++});						
				if(total_row == 1)
				{
					window.location = "<?php echo site_url(); ?>/cabinet/cabinate_files";
				}
				calculatePrice();
			}	
		}
	});
	
	$(".add_doc").click(function(){
		var selectVal = $('.buildDocList :selected').val();
		var selectDiv = $('.buildDocList :selected').html();
		
		$('.myDocFinalList').append($('<option>', { 
			value: selectVal,
			text : selectDiv 
		}));
		
	});
	
	$('.st_sub_or').click(function(){
		window.location = "<?php echo base_url(); ?>index.php/orderpage/success";
	});
	
	$('input[name="spcial_ins_txt"]').keyup(function(){
		$("input[name='spinstruction']").val($(this).val());
	});
	
	
	/*
	* Current price
	*/
		
	var local = $('.location_opt ul li:eq(0)');
		
	
	/******
	
	edit
	
	*******/
	
	var packageName = "local";
	var _activePackDiv = "";
	var currency = "Taka";
	
	// pack choose
	$('.location_opt ul li').click(function(){		
		packageName = $(this).attr('rel');
					
		if(local != null)
		{
			local.removeClass('selected');
		}
		$(this).addClass('selected');
		local = $(this);
		
		if($(this).attr('rel') == "local")
		{			
			currency = 'Taka';						
		}
		else
		{
			currency = 'USD';					
		}
		
		selectRelativePackage(); 		
		calculatePrice();
		
	});
	
	// list check	
	$('.fileList tr').each(function(){			
		
		var _localDoc = $('td .odocuments.local', this);
		var _interDoc = $('td .odocuments.inter', this);
		var _localPic = $('td .ophotos.local', this);
		var _interPic = $('td .ophotos.inter', this);
		
		_localDoc.change(function(){calculatePrice();});
		_interDoc.change(function(){calculatePrice();});
		_localPic.change(function(){calculatePrice();});
		_interPic.change(function(){calculatePrice();});
	
		$('td .pack_type_chs', this).change(function(){
			var chooseVal = $(this).val();			
									
			if(chooseVal == "documents" && chooseVal!=undefined)
			{				
				if(packageName == "local")
				{
					_localDoc.removeClass('hide');
					_interDoc.addClass('hide');
					_localPic.addClass('hide');
					_interPic.addClass('hide');	
					
					_activePackDiv = _localDoc;	
					
				}
				else if(packageName == "inter")
				{	
					_localDoc.addClass('hide');
					_interDoc.removeClass('hide');
					_localPic.addClass('hide');
					_interPic.addClass('hide');
					
					_activePackDiv = _interDoc;
					
				}			
			}
			else if(chooseVal == "photos" && chooseVal!=undefined)
			{
				if(packageName == "local")
				{
					_localDoc.addClass('hide');
					_interDoc.addClass('hide');
					_localPic.removeClass('hide');
					_interPic.addClass('hide');
					
					_activePackDiv = _localPic;
				}
				else if(packageName == "inter")
				{
					_localDoc.addClass('hide');
					_interDoc.addClass('hide');
					_localPic.addClass('hide');
					_interPic.removeClass('hide');
					
					_activePackDiv = _interPic;
				}					
			}
			
			calculatePrice();	
		});			
	
		$('td .cng_number_page input', this).keyup(function(){
			calculatePrice();		
		});
	
	});		
		
	// finishing options checkbox
	$(".finish_options_itm").change(function (){
		calculatePrice();
	});
	
	// first page color
	$('.page_color input').click(function(){
		calculatePrice();
	});
		
		
	/*****
	***	end
	******/	
		
		
	// contact list chooser	
	$('#contactlist').delegate('tr', 'click' , function(){		
		addContactToList($(this)); 
		calculatePrice();
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
		
		calculatePrice();
		return false;
	});
	
	$('.contact_opts li.searchBox').mouseenter(function(){
		var position = $(this).offset();
		$('.popover').css({'left': position.left - 220, 'top': position.top + 30}).show();
	}).mouseleave(function(){
		$('.popover').hide();
	});
	
	$('.contact_opts li.searchBox').click(function(){
		return false;
	});
		
	$('input[name="search_contact_id"]').keyup(function (e) {
		var value = $(this).val();
		value = value.replace(/[^0-9\.]/g,'');
		$(this).val(value);
		if (e.keyCode == 13 && $(this).val() != "") {
			var that = $('#contactlist tr').find($('.conI'+$(this).val())).closest('tr');
			if(that.length){
				addContactToList(that); 
				calculatePrice();
			}	
		}
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
	
	
	function selectRelativePackage(){
		var val,localDoc,interDoc,localPic,interPic,numberPage; 
		
		$('.fileList tr').each(function(){			
			val = $('td .pack_type_chs', this).val();
			localDoc = $('td .odocuments.local', this);
			interDoc = $('td .odocuments.inter', this);
			localPic = $('td .ophotos.local', this);
			interPic = $('td .ophotos.inter', this );		
			numberPage = $('td .cng_number_page', this);
			
			// local and inter pack
			if(localDoc != undefined)
			{
				if(val == "documents" && val!=undefined)
				{				
					if(packageName == "local")
					{
						localDoc.removeClass('hide');
						interDoc.addClass('hide');
						localPic.addClass('hide');
						interPic.addClass('hide');	
						_activePackDiv = localDoc;	
						
					}
					else if(packageName == "inter")
					{	
						localDoc.addClass('hide');
						interDoc.removeClass('hide');
						localPic.addClass('hide');
						interPic.addClass('hide');
						_activePackDiv = interDoc;
						
					}				
					
				}
				else if(val == "photos" && val!=undefined)
				{
					if(packageName == "local")
					{
						localDoc.addClass('hide');
						interDoc.addClass('hide');
						localPic.removeClass('hide');
						interPic.addClass('hide');
						
						_activePackDiv = localPic;
					}
					else if(packageName == "inter")
					{
						localDoc.addClass('hide');
						interDoc.addClass('hide');
						localPic.addClass('hide');
						interPic.removeClass('hide');
						
						_activePackDiv = interPic;
					}					
				}								
			}	
		});
		
	}
	
	
	function updateTablePrice(){
		
		var totalprice = 0;
		$('.price_type').html('Prices('+currency+')');
		
		var val,localDoc,interDoc,localPic,interPic,numberPage;
		
		$('.fileList tr').each(function(){			
			if($('td.total_row_pr', this).html()!= undefined)
				totalprice += parseFloat($('td.total_row_pr', this).html());
		});
		
		// finish price
		if(finishing_price != 0 && currency == 'Taka'){
			finishing_price = parseFloat(packageData.otherFees.local.finishing_cost);
		}
		else if(finishing_price != 0 && currency == 'USD'){
			finishing_price = parseFloat(packageData.otherFees.inter.finishing_cost);
		}
		else
		{
			finishing_price = 0;
		}
		
		// first page color
		if($('.page_color input').is(':checked') && currency == 'Taka')
		{
			firstpage_color = parseFloat(packageData.otherFees.local.firstpage_color);
		}
		else if($('.page_color input').is(':checked') && currency == 'USD')
		{
			firstpage_color = parseFloat(packageData.otherFees.inter.firstpage_color);
		}
		else if(!$('.page_color input').is(':checked'))
		{
			firstpage_color = 0;
		}
	
		$('.total_cost td:eq(2)').html(totalprice+finishing_price+firstpage_color + " " + currency );
		$("input[name='total_price']").val($('.total_cost td:eq(2)').html());
	}
	
	
	function calculatePrice()
	{
		var finishPrice = $(".finish_options_itm:checked").val();
		var countfile = 0;
		var _totalPrice = 0;
		var _perPackPrice = 0;
		
		$('.fileList tr').each(function(){
			var packtype = $('td .pack_type_chs', this).val();			
			var root = $('td:eq(3)', this).find('div:visible');
			var packPrice = $('select', root).val();
			var numberPage = $('td .cng_number_page input', this).val();
			var totalPrice = $('td.total_row_pr', this);
			var sumPrice = 0;
			
			if(packtype!=undefined){
				countfile++;				
				
				if(packageName=="local")
				{
					if(packtype == "documents") 
						sumPrice = packageData.localDoc[packPrice];
					else if(packtype == "photos") 
						sumPrice = packageData.localPhoto[packPrice];			
					
					_totalPrice = parseFloat(numberPage * sumPrice).toFixed(2);	
				}
				else
				{
					if(packtype == "documents"){ 					
						sumPrice = packageData.interDoc[packPrice];
						_totalPrice = parseFloat(numberPage * sumPrice).toFixed(2);							
					}else if(packtype == "photos"){
						sumPrice = packageData.interPhoto[packPrice].a;
						if(numberPage >= 50){						
							var nor = 49 * packageData.interPhoto[packPrice].a;
							var abnor = (numberPage - 49) * packageData.interPhoto[packPrice].b;
							_totalPrice = parseFloat(nor + abnor).toFixed(2);							
						}else				
							_totalPrice = parseFloat(numberPage * packageData.interPhoto[packPrice].a).toFixed(2);
					}	
				}
				
				totalPrice.html( _totalPrice + " " +currency);
				
				_perPackPrice += parseFloat(totalPrice.html()); 
			}
		});	
		
		var lFinishPrice = parseFloat(packageData.otherFees.local.finishing_cost);
		var lFirstPageColor = parseFloat(packageData.otherFees.local.firstpage_color);
		var iFinishPrice = parseFloat(packageData.otherFees.inter.finishing_cost);
		var iFirstPageColor = parseFloat(packageData.otherFees.inter.firstpage_color);
		
		var lCourierPriceA = parseFloat(packageData.otherFees.local.courier.a);
		var lCourierPriceB = parseFloat(packageData.otherFees.local.courier.b);
		var iCourierPriceA = parseFloat(packageData.otherFees.inter.courier.a);
		var iCourierPriceB = parseFloat(packageData.otherFees.inter.courier.b);
		
		var lDiscountFrom = parseFloat(packageData.otherFees.local.courier.discount_from);
		var iDiscountFrom = parseFloat(packageData.otherFees.inter.courier.discount_from);
		
		if(packageName=="local")
		{
			// finish price
			if(finishPrice!= "-1")			
				_perPackPrice = parseFloat(_perPackPrice) + lFinishPrice;							
			// firstpageincolor	
			if($('.page_color input').is(':checked'))
				_perPackPrice = parseFloat(_perPackPrice) + lFirstPageColor;				
			// courier price
			var cPrice;			
			if(countfile>lDiscountFrom)
				cPrice = lCourierPriceA + Math.ceil((countfile - lDiscountFrom)/lDiscountFrom) * lCourierPriceB;
			else
				cPrice = lCourierPriceA;
				
		}
		else
		{
			// finish price
			if(finishPrice!= "-1") 
				_perPackPrice = parseFloat(_perPackPrice) + iFinishPrice;				
			// firstpageincolor		
			if($('.page_color input').is(':checked'))
				_perPackPrice = parseFloat(_perPackPrice) + iFirstPageColor;				
			// courier price
			var cPrice;			
			if(countfile>iDiscountFrom)
				cPrice = iCourierPriceA + Math.ceil((countfile - iDiscountFrom)/iDiscountFrom) * iCourierPriceB;
			else
				cPrice = iCourierPriceA;	
		}
				
		var _recep = ($('.contacts_for_recipient .rep_wrap').length < 2) ? 1 : $('.contacts_for_recipient .rep_wrap').length;		
		_perPackPrice = (parseFloat(_perPackPrice) + cPrice) * _recep;		
		
		$('._courier_cost').html(cPrice);
		$('._total_cost').html(parseFloat(_perPackPrice).toFixed(2) + " " +currency);
		prepareFormData(parseFloat(_perPackPrice).toFixed(2));
	}
	
	
	function prepareFormData(c)
	{
		var senderID = $('.contacts_for_sender .rep_wrap span').attr('rel'),
		recepID = [], file_id = [], file_type = [], file_pack = [], file_number = [];
		
		$.each($(".fileList tr"), function(){
			var mark = $("td:eq(1)", this).html();
			if(typeof mark != 'undefined'){
				var fP = $('td:eq(3)', this).find('div:visible'),
					fN = $('td:eq(4)', this).find('div:visible');
				
				file_id.push($("td:eq(1) div", this).attr('rel'));
				file_type.push($('td:eq(2) select option:selected', this).val());
				file_pack.push($('select option:selected', fP).val());
				file_number.push($('input', fN).val());
			}
		});
		
		$.each($('.contacts_for_recipient .rep_wrap'), function(){
			recepID.push(parseFloat($('span', this).attr('rel')));
		});
		
		$("input[name='tcosting']").val(c);
		
		$("input[name='file_id']").val(file_id.toString());
		$("input[name='file_type']").val(file_type.toString());
		$("input[name='file_pack']").val(file_pack.toString());
		$("input[name='file_number']").val(file_number.toString());
		$("input[name='package_n']").val(packageName);
		$("input[name='binding']").val($("input[name='binding_opt']:checked").val());
		$("input[name='fpageclr']").val($('.page_color input').is(':checked'));		
		$("input[name='sender_id']").val(senderID);
		$("input[name='recip_id']").val(recepID.toString());
	}
	
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
	
	calculatePrice();
	
});



</script>
