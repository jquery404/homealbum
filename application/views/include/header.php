<!doctype html>
<html>

<head>

	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="robots" content="index, follow" />
	<meta name="keywords" content="smart web printing service, bangladesh facts, send free letters,send photos, free file download,cheapest online space|" />
	<meta name="description" content="cheapest web space|Online storage|Send a free letter in Bangladesh|send photos in Bangladesh|" />	  
	<title><?php echo $title; ?></title>
	
	<link href="<?php echo base_url(); ?>/assets/imgs/favicon.ico" rel="shortcut icon" type="image/x-icon" />	
	<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/style.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/background.css" type="text/css" />	
	<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/prettyPhoto.css" type="text/css" media="screen" title="prettyPhoto main stylesheet" charset="utf-8" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/jquery-ui.css" type="text/css" />	
	
	
    <!--<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>-->
    <script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/jquery-ui.min.js"></script>	
    <script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/jquery.prettyPhoto.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/jquery.placeholder.min.js"></script>
	<script type='text/javascript' src='<?php echo base_url(); ?>/assets/js/main.js'></script>
	<script type='text/javascript' src='<?php echo base_url(); ?>/assets/js/jquery.MultiFile.pack.js'></script>
	

	


	
	
</head>

<body class="backgroundlevel-high">
<div class="mask hide"></div>

	
	<div id="rt-mainbg-overlay"><div class="rt-surround-wrap"><div class="rt-surround"><div class="rt-surround2"><div class="rt-surround3">
		
		
		<div class="rt-container">
			
			
			<div id="rt-navigation"><div id="rt-navigation2">
			<?php if($main_content=="login/loginpage" ||
					 $main_content=="login/signup" ||
					 $main_content=="login/forget_password"): ?>
			<br/><br/><br/><br/>
			<?php else: ?>
			<div id="rt-navigation3">
			<div class="logo left"></div>
			<div class="nopill">
				<ul class="menutop level1 ">
					
					<li class="item164 parent root f-main-parent">
					<a class="daddy item bullet" href="http://homealbum.org/index.php?option=com_content&amp;view=article&amp;id=85&amp;Itemid=164" id="a-1357274253256504">
					<span>Who We Are</span>
					</a>				
					</li>	
					
					<li class="item167 root">
					<a class="orphan item bullet" href="http://homealbum.org/index.php?option=com_content&amp;view=article&amp;id=88&amp;Itemid=167" id="a-1357274253261730">
					<span>Promotional Offer</span>
					</a>
					<div class="dropdownmenu hide" id="dd-services">
						<ul class="dropdownul">
							<li><a href="<?php echo site_url(); ?>/package/quickdoc"><img src="<?php echo base_url(); ?>/assets/imgs/quickdoc.jpg" alt="QUICKDOC" title="Graphic Design"></a></li>
							<li><a href="<?php echo site_url(); ?>/package/photos/3"><img src="<?php echo base_url(); ?>/assets/imgs/3copyfree.jpg" alt="3 COPIES FREE" title="3 COPIES FREE"></a></li>
							<li><a href="<?php echo site_url(); ?>/package/photos/6"><img src="<?php echo base_url(); ?>/assets/imgs/6copyfree.jpg" alt="6 COPIES FREE" title="6 COPIES FREE"></a></li>
							<li><a href="<?php echo site_url(); ?>/package/photos/10"><img src="<?php echo base_url(); ?>/assets/imgs/10copyfree.jpg" alt="10 COPIES FREE" title="10 COPIES FREE"></a></li>
						</ul>
						<div class="clearBoth"></div>
					</div>
					</li>	
					
					<li class="item171 parent root f-main-parent f-mainparent-item">
					<a class="daddy item bullet" href="http://homealbum.org/index.php?option=com_content&amp;view=article&amp;id=99&amp;Itemid=171" id="a-1357274253264698">
					<span>Q &amp; A</span>
					</a>
					</li>	
					
					<li class="item174 root">
					<a class="orphan item bullet" href="http://homealbum.org/index.php?option=com_content&amp;view=article&amp;id=90&amp;Itemid=174" id="a-1357274253269407">
					<span>Offer details</span>
					</a>
					</li>	
					
					<li class="item27 parent root f-main-parent f-mainparent-item">
					<a class="daddy item bullet" href="http://homealbum.org/index.php?option=com_jdownloads&amp;view=viewcategories&amp;Itemid=27" id="a-1357274253270193">
					<span>Document Gallery</span>
					</a>
					</li>	
					<?php if($this->session->userdata('is_logged_in')):?>
					
					<li class="item27 parent root f-main-parent f-mainparent-item">
					
					<?php echo anchor('login/logout', '<span>Logout</span>', 'class="item"'); ?>
					
					</li>	
					
					<?php endif; ?>
					
					
				</ul>
			</div>
			</div>
			<?php endif;?>
			
			</div></div>
			
			
			<?php if($this->session->userdata('is_logged_in')):?>
			<div class="user_panel">
				<ul>
					<li class="username_">			
						<a href="#user_profile" rel="prettyPhoto">
						Logged in as <strong><?php echo $this->session->userdata('username'); ?></strong>
						</a>
					</li>		
					<li class="my_office"><a href='<?php echo site_url();?>/login'> My Office</a></li>	
					<?php if($this->uri->segment(1)=="login" ||
							$this->uri->segment(1)==""): ?>
					<li class='create_cabnet cw'><a href='#create_cabinet' rel='prettyPhoto'>Create Cabinet</a></li>
					<?php endif;?>
					<li class="address_book"><?php echo anchor('mycontact/init', 'Address Book'); ?></li>
				</ul>	
			</div>
			<?php endif; ?>
			
			
			<!--profile-->
			<div id="user_profile" class="hide">
				<br/><br/>
				<h4>Edit Profile </h4>
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
					
				<div class="user_edit_panel left">
					<span class="a">User Information</span>
					<span class="b">Change Password</span>
				</div>	
					
				<div class="can_wrap pro_edit_fe left">	
									
					<div class="user_info_cng">
					<?php 
					echo form_open("login/editProfile", 'class="cng_prodp"');			
					echo "<div class='c_cab_w hide'><label class='left'>id</label><div class='left can_wap'>" . form_input('user_id', $this->session->userdata('userid'), 'class="ccname"') . "</div><div class='left err companyname-error'><span>Name is required</span></div><span class='clear'></span></div>";	
					echo "<div class='c_cab_w'><label class='left'>Full Name</label><div class='left can_wap'>" . form_input('user_fullname',  $this->session->userdata('fullname'), 'class="ccname"') . "</div><div class='left err companyname-error'><span>Name is required</span></div><span class='clear'></span></div>";	
					echo "<div class='c_cab_w'><label class='left'>Username</label><div class='left can_wap'>" . form_input('user_name',  $this->session->userdata('username'), 'class="ccname"') . "</div><div class='left err companyname-error'><span>Name is required</span></div><span class='clear'></span></div>";	
					echo "<div class='c_cab_w'><label class='left'>Address</label><div class='left can_wap'>" . form_textarea('user_address',  $this->session->userdata('address'), 'class="ccname"') . "</div><div class='left err companyname-error'><span>Write a message.</span></div><span class='clear'></span></div>";	
					echo "<div class='c_cab_w'><label class='left'>Contact Number</label><div class='left can_wap'>" . form_input('user_contact',  $this->session->userdata('contactno'), 'class="ccname"') . "</div><div class='left err companyname-error'><span>Name is required</span></div><span class='clear'></span></div>";	
					echo "<div class='c_cab_w c_as_it'><label class='left'>Country</label><div class='left can_wap'>" . form_dropdown('user_country', $country, $this->session->userdata('country'), 'class="r_country"') . "</div><div class='left err companyname-error'><span></span></div><span class='clear'></span></div>";
					echo "<div class='c_cab_w'><label class='left'></label><div class='left can_wap'>" . form_submit("submit", "Submit", "class='ppEdiProd btn btn-bluish'") . "</div><div class='left err companyname-error'><span></span></div><span class='clear'></span></div>";			
					echo form_close();
					?>	
					</div>
					
					<div class="password_cng hide">
					<?php 
					echo form_open("login/changePassword", 'class="cng_ppp"');			
					echo "<div class='c_cab_w hide'><label class='left'>id</label><div class='left can_wap'>" . form_input('user_id', $this->session->userdata('userid'), 'class="ccname"') . "</div><div class='left err companyname-error'><span>Name is required</span></div><span class='clear'></span></div>";	
					echo "<div class='c_cab_w'><label class='left'>Old Password</label><div class='left can_wap'>" . form_password('old_pass', '', 'class="ccname"') . "</div><div class='left err companyname-error'><span>Name is required</span></div><span class='clear'></span></div>";	
					echo "<div class='c_cab_w'><label class='left'>New Password</label><div class='left can_wap'>" . form_password('new_pass', '', 'class="ccname"') . "</div><div class='left err companyname-error'><span>Name is required</span></div><span class='clear'></span></div>";					
					echo "<div class='c_cab_w'><label class='left'>Confirm Password</label><div class='left can_wap'>" . form_password('conf_new_pass', '', "class='ccname'") . "</div><div class='left err companyname-error'><span></span></div><span class='clear'></span></div>";	
					echo "<div class='c_cab_w'><label class='left'></label><div class='left can_wap'>" . form_submit("submit", "Submit", "class='cng_pass_sub cr_cabb btn btn-bluish'") . "</div><div class='left err companyname-error'><span></span></div><span class='clear'></span></div>";			
					echo form_close();				
					?>	
					</div>
				</div>
				
				
				<span class="clear"></span>
				<div class="errne hide"></div>
			</div>
			
			
			<div id="dialog" class="hide" title=""><p></p></div>
					

