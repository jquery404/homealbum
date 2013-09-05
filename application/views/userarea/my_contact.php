
<h4>My Contacts</h4>

<div class="navigator_contact">
	<ul>
		<li rel="contact_add">New Contact</li>
		<li rel="contact_box">My Contacts</li>		
		<li rel="contact_del">Delete Contact</li>		
	</ul>
</div>

<div class="">



	<div class="contact_box">
		<?php if (count($contact_list) == 0): ?>
		<table id="minimalist" class="cabinet_tree_list">
			<tr>
				<td><strong>No contact has been found</strong></td>
			</tr>			
		</table>	
		<?php else: ?>
		<table id="minimalist" class="cabinet_tree_list">
			<tr>
			<th><div class="checkbox all"></div></th><th>Sl. No.</th> <th>Name</th> <th>Address</th> <th>Phone Number</th> <th>Email Address</th> <th>Country</th><th></th>
			</tr>
			<?php foreach($contact_list as $key=>$con_list): ?>			
			<tr>
				<?php 
				$tm=0;
				foreach($con_list as $i=>$c_list): $tm++; ?>				
				<?php if($tm == 1): ?>
					<td><div class="checkbox" rel="<?php echo $c_list; ?>"></div></td>
				<?php elseif ($tm == 2): ?>
					<td><?php echo ($key + 1); ?> </td>
					<td><?php echo $c_list;?></td>				
				<?php elseif($tm == 7): ?>				
					<td><div class="edd"><a href="#edit_contact" class="edit_con" rel="prettyPhoto">Edit</a></div></td>
				<?php else: ?>
					<td><?php echo $c_list;?></td>					
				<?php endif;?>	
				<?php endforeach; ?>
				
			</tr>	
			<?php endforeach; ?>
		</table>			
		<?php endif; ?>
		
	</div>
	
	<div class="contact_add hide">
		<h5>Add New Contact</h5>
		<?php echo form_open('mycontact/addnew', 'class="addACon"');?>
		<div class="contact_add_form">
			<table>		
				<tr>
					<td>Full Name</td>
					<td><?php echo form_input('c_full_name', '', 'class="r_name"');?></td>	
				</tr>
				<tr>
					<td>Address</td>
					<td><?php echo form_textarea('c_address', '', 'class="r_address"'); ?></td>			
				</tr>
				<tr>
					<td>Email Address</td>
					<td><?php echo form_input('c_emailid', '', 'class="r_email"'); ?></td>			
				</tr>
				<tr>
					<td>Phone</td>
					<td><?php echo form_input('c_pnumber', '', 'class="r_phone"'); ?></td>
				</tr>
				<tr>
					<td>Country</td>
					<td>
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
						echo form_dropdown('c_country', $country, '-1', 'class="r_country" style="border: 2px solid #6678B1;"');
					?>
					</td>			
				</tr>
				<tr>
					<td></td>
					<td><?php echo form_submit('submit', 'Add Contact', 'class="addIcont btn btn-bluish"'); ?> </td>
				</tr>
			</table>
			
		</div>
		<?php echo form_close(); ?>
		
		<div class="errne"></div>
	</div>

	<div id="edit_contact" class="hide">
		<div class="can_wrap">
			<?php
				echo form_open("mycontact/edit_contact", 'class="open_cabin"');				
				echo "<div class='c_cab_w c_as_it hide'><label class='left'></label><div class='left can_wap'>" . form_input('con_id', '', "class='ccprpass'") . "</div><div class='left err companyname-error'><span></span></div><span class='clear'></span></div>";
				echo "<div class='c_cab_w c_as_it'><label class='left'>Name</label><div class='left can_wap'>" . form_input('con_name', '', "class='ccprpass'") . "</div><div class='left err companyname-error'><span></span></div><span class='clear'></span></div>";
				echo "<div class='c_cab_w c_as_it'><label class='left'>Address</label><div class='left can_wap'>" . form_textarea('con_address', '', "class='ccprpass'") . "</div><div class='left err companyname-error'><span></span></div><span class='clear'></span></div>";
				echo "<div class='c_cab_w c_as_it'><label class='left'>Phone Number</label><div class='left can_wap'>" . form_input('con_phone', '', "class='ccprpass'") . "</div><div class='left err companyname-error'><span></span></div><span class='clear'></span></div>";
				echo "<div class='c_cab_w c_as_it'><label class='left'>Email Address</label><div class='left can_wap'>" . form_input('con_email', '', "class='ccprpass'") . "</div><div class='left err companyname-error'><span></span></div><span class='clear'></span></div>";
				echo "<div class='c_cab_w c_as_it'><label class='left'>Country</label><div class='left can_wap'>" . form_dropdown('con_country', $country, '-1', 'class="r_country"') . "</div><div class='left err companyname-error'><span></span></div><span class='clear'></span></div>";
				echo "<div class='c_cab_w'><label class='left'></label><div class='left can_wap'>" . form_submit("submit", "Edit Contact", "class='cr_cabb btn btn-bluish'") . "</div><div class='left err companyname-error'><span></span></div><span class='clear'></span></div>";
				echo form_close();
			?>
		</div>
	</div>	
	
</div>








<script type="text/javascript">
	function create_caBB(p){
		var parent = $(p).parent().parent();
		
		var id = $('td:eq(0) div', parent).attr('rel');
		var name = $('td:eq(2)', parent).html();
		var address = $('td:eq(3)', parent).html();
		var phone = $('td:eq(4)', parent).html();
		var email = $('td:eq(5)', parent).html();
		var country = $('td:eq(6)', parent).html();
		
		$('.pp_inline input[name="con_id"]').val(id);
		$('.pp_inline input[name="con_name"]').val(name);
		$('.pp_inline textarea[name="con_address"]').val(address);
		$('.pp_inline input[name="con_phone"]').val(phone);
		$('.pp_inline input[name="con_email"]').val(email);
		$(".pp_inline .r_country option[value="+country+"]").attr("selected","selected");
		
		$(".pp_inline .cr_cabb").live('click', function(){
		
		
			$.post("<?php echo site_url(); ?>/mycontact/edit_contact", $('.pp_inline .open_cabin').serialize())
			.success(function(response) { if(response)window.location = "<?php echo site_url(); ?>/mycontact/init";else alert("Error occured! ");});
			
					
			return false;
		
		});
		
	}

	$(document).ready(function(){
		var selected_all = true;
		$('.checkbox').live('click', function(){
			if($(this).hasClass('all'))
			{
				if(selected_all)
				{
					$(this).addClass('click');
					$('.checkbox').each(function(){
						if(!$(this).hasClass('click') && !$(this).hasClass('all'))			
						{
							$(this).addClass('click');
							$(this).closest('tr').addClass('selected');
						}
					});	
				}
				else
				{
					$(this).removeClass('click');
					$('.checkbox').each(function(){
						if($(this).hasClass('click') && !$(this).hasClass('all'))			
						{
							$(this).removeClass('click');
							$(this).closest('tr').removeClass('selected');
						}
					});	
				}
				selected_all = !selected_all;
					
			}
			else
			{
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
			}
			
			
		});

	
		$('.addIcont').click(function(){
			$.post("<?php echo site_url(); ?>/mycontact/addContact", $('.addACon').serialize())
			.success(function(response) { /*alert(response);*/
			
				var val = $.parseJSON(response);
				

				
				if(val.results == "error")
				{
					$('.errne').html(val.msg).show();
				}
				else if(val.results == "success")
				{	
					window.location = "<?php echo site_url(); ?>/mycontact/init";
				}
			
			});
			
			return false;
		});
	
		$('.submit_new_contact').click(function(){
			
			var name = $('.r_name').val();
			var address = $('.r_address').val();
			var email = $('.r_email').val();
			var phone = $('.r_phone').val();
			var country = $('.r_country').val();			
			
			
			
			if(	name == '' || address == '' || 
				email == '' || phone == '' || country == '-1'){
					
					alert('Something went wrong!');
					return false;
			}else {
			
				 var data = {						
					rid: <?php echo $this->session->userdata('userid'); ?>,
					rname: name,
					raddress: escape(address),
					remail: email,
					rphone:phone,
					rcountry: country					
				};
				
				
				
				$.ajax({
					type:'POST',
					url:'<?php echo site_url(); ?>/mycontact/addnew',
					data: data,
					
					
					success: function(response){
					
						if(response)
						{
							alert('Your contact has been added successfully!');
							$('.r_name').val(''); 
							$('.r_address').val(''); 
							$('.r_email').val('');
							$('.r_phone').val('');
							$('.r_country').val('-1');
							
						}
						else 
						{
							alert("Error occured");
						}
					}
				});	
			 
			}
			return false;		
		});
	
	
		$('.navigator_contact ul li').click(function(){
			var src = $(this).attr('rel');
			
			if(src =="contact_add")
			{
				$('.contact_add').removeClass('hide');
				$('.contact_box').addClass('hide');				
			}else if(src =="contact_box")
			{
				$('.contact_add').addClass('hide');
				$('.contact_box').removeClass('hide');
			}else if(src == "contact_del")
			{
				
				var file_selected = new Array();
				$('#minimalist tr').each(function(){
					if($(this).hasClass('selected')){					
						file_selected.push($('td:eq(5)', this).html());					
					}
				});		
							
				if(file_selected.length == 0)
				{
					alert('Please select a contact first.');
				}
				else
				{
					if(confirm('Do you really want to delete these Contact'))
					{
						var data = {									
							contacts: file_selected
						}; 
						
						$.ajax({
							type:'POST',
							url:'<?php echo site_url(); ?>/mycontact/delete',
							data: data,
							success: function(response){								
								$('#minimalist tr').each(function(){
									if($(this).hasClass('selected')){					
										$(this).remove();
									}
								});	
								
								alert(response);
								
							}
						});
					
					}
				}
			}
			
		});
	
		$.each($('.edd'), function(){
			var that = $(this);
			$("a[rel^='prettyPhoto']", this).prettyPhoto({
				theme:'facebook',
				show_title: false, 
				social_tools: false,
				show_description:false,
				deeplinking: false,
				default_width: 660,	
				changepicturecallback: function(){ create_caBB(that); }
			});
			
		});
		
		
	});	

</script>

