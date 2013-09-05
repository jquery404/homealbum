
<script type="text/javascript">

function buildFileTree(files)
{
	var tree= $("<ul>");
	
	for(x in files)
	{
		if(typeof files[x] == 'object')
		{
			var span = $("<span>").html(x).appendTo(
				$('<li>').appendTo(tree).addClass('folder')
			);
			
			var subtree = buildFileTree(files[x]);
			span.after(subtree);
			span.click(function(){
				$(this).parent().find('ul:first').toggle();
			});
		}		
		else
		{
			$('<li>').html(files[x]).appendTo(tree).addClass('file');
		}
	
	}
	
	return tree;
}
	
function create_caBB()
{	
	$('.pp_inline input.ccprt').click(function(){
		if ($(this).is(":checked"))
		{
			$('.pp_inline .c_as_it').removeClass('hide');		
		}
		else
		{
			$('.pp_inline .c_as_it').addClass('hide');
		}	
	});
	
	$('.pp_inline .cr_cabb').click(function(){		
		var name = $('.pp_inline input.ccname').val();
		var desc = $('.pp_inline input.ccdesc').val();
		var protect = false;
		var password = ""; 
		if($('.pp_inline input.ccprt:checked').val() != undefined)
		{
			protect = true;				
			password = $('.pp_inline input.ccprpass').val();			
		}
		
		if(name == "" || desc == "")
		{
			dialogBox("Warning", "Fill required field");
			return false;
		}
		else if(protect)
		{
			if(password == "")
			{
				dialogBox("Warning", "Enter password");
				return false;
			}
			else 
			{
				var data = {						
					id: <?php echo $this->session->userdata('userid'); ?>,
					name: name,
					description: desc,
					protect:1,
					pass: password					
				};
					
				$.ajax({
					type:'POST',
					url:'<?php echo site_url(); ?>/cabinet/create',
					data: data,
					
					success: function(response){
						
						if(response)
						{
							$.prettyPhoto.close();
							window.location.reload();
						}
						else 
						{
							dialogBox("Warning", "Error occured");
						}
					}
				});	
			}
		}
		else
		{
			var data = {						
					id: <?php echo $this->session->userdata('userid'); ?>,
					name: name,
					description: desc,
					protect:0,
					pass: ''					
				};
				
			$.ajax({
				type:'POST',
				url:'<?php echo site_url(); ?>/cabinet/create',
				data: data,
				
				
				success: function(response){
					if(response == "true")
					{
						dialogBox("Success", "Cabinet successfully created.");
						$.prettyPhoto.close();
						window.location.reload();
					
					}
					else 
					{
						dialogBox("Warning", "Error occured");
					}
				}
			});	
		}
		
		
		return false;
	});

}


var cabinetHead,
	cabinetTitle;

var editCabinet = function (name){
	var a = name, markup='';
	if(a == "edit_cab open")
	{	
		$('.pp_inline input[name="cab_id"]').val(cabinetHead);
		$('.pp_inline input[name="cab_name"]').val(cabinetTitle);
		
		$('.pp_inline .cr_cabb_pro').click(function(){
			if($('.pp_inline input.ccprpass').val() == '')
			{
				dialogBox("Warning", "Please enter password");
				return false;
			}
			
			return;
		});
	}
	else if(a == "edit_cab rename")
	{
		$('.pp_inline input[name="cab_id"]').val(cabinetHead);		
		$('.pp_inline input[name="cab_name"]').val(cabinetTitle);
		
		$('.pp_inline .cr_cabb').click(function(){
		
			$.post("<?php echo site_url(); ?>/cabinet/rename_cabinet", $('.pp_inline .rename_cab').serialize())
			.success(function(response) { alert(response); if(response == "Update Successfull")window.location = "<?php echo site_url(); ?>/login";});
			
			return false;
		});		
	}
	else if(a == "edit_cab cng_password")
	{
		$('.pp_inline input[name="cab_id"]').val(cabinetHead);		
		$('.pp_inline input[name="cab_name"]').val(cabinetTitle);
		
		$('.pp_inline .cr_cabb').click(function(){
		
			$.post("<?php echo site_url(); ?>/cabinet/repass_cabinet", $('.pp_inline .repass_cab').serialize())
			.success(function(response) { alert(response); $.prettyPhoto.close();});
			
			return false;
		});
	}
	else if(a == "edit_cab delete")
	{
		$('.pp_inline').find('input[name="cab_id"]').val(cabinetHead);		
	}
	
	$('.pp_inline').append(markup);

};

$(document).ready(function(){
	var currentEvent;
	var path = "<?php echo site_url(); ?>/login/download/";
	$('.backbtn').click(function(){
		switch(currentEvent)
		{
			case 1:
				//hide file_tree and show file_list
				$('.file_tree').hide();
				$('.cabinet_pass').hide();
				$('.file_list').show();
				currentEvent = '';
				
				break;
		
		}
		
		return false;	
	});
	
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

	$('.cabinet_wrap').each(function(){		
		$(this).click(function(e){
			
			var base = $(this), x = e.clientX, y = e.clientY;
			
			if($('.cabinet_head',this).hasClass('no_pass'))
			{
				cabinetHead = $('.cabinet_head',this).attr('id');				
				cabinetTitle = $('.cabinet_head',this).html();	
				$('.mask').show();		
				$('.cabinet_edit_menu_nopass').show().offset({'left':x, 'top':y});
				$('.cabinet_edit_menu_nopass li').unbind('click');
				
				$('.cabinet_edit_menu_nopass li').bind('click', function(){
					$('.mask').hide();		
					if($(this).hasClass('open_nopass')){
						$('.without_pass .cccid').val(cabinetHead);
						$('.without_pass .ccchead').val(cabinetTitle);
						$('#cabnopasssub')[0].submit.click();
					}				
				});
				
				
			}
			else
			{
				/* $('.cabinet_pass', this).show();				
				var head = $('.cabinet_pass', this).parent().find('.cabinet_head').html();				
				var $this = $(this);
				var sub = $('.cabinet_pass', this).find('.cabinet_sub');				
				var sub_pass = $('.cabinet_pass', this).find('.cabinet_private');				
				
				 */
				cabinetHead = $('.cabinet_head',this).attr('id');				
				cabinetTitle = $('.cabinet_head',this).html();				
				$('.mask').show();
				$('.cabinet_edit_menu').show().offset({'left':x, 'top':y});
				$('.cabinet_edit_menu li').unbind('click');
				 
				 
				/* sub.unbind('click');				
				sub.click(function(){
					var passcode = $('.cabinet_private',$this).val();
					$('.cabinet_private',$this).val('');
					var data = {
						ajax: '1',
						id: cab_head,
						pass: passcode
					
					};
					
					$.ajax({
						type:'POST',
						url:'<?php echo site_url(); ?>/cabinet/file_list',
						data: data,
						
						
						success: function(response){
							
							var results = $.parseJSON(response);
							
							console.log(results);
							var markup = '\
							<h3>'+ head +':</h3>\
							<div class="search_cabinet_file left"><input type="text" /></div><input type="button" value="Search" class="searchbtn left gbqfb"/>\
							<div class="file_tree_options left">\
							<ul><li class="slt_all">All</li><li>Delete</li><li class="upload_to_cabinet" id="'+cab_head+'">Upload</li><li>Order for Print</li><li>Share</li></ul></div><span class="clear"></span>\
							<table id="minimalist" class="cabinet_tree_list">\
							<tr>\
							<th></th><th>File Name</th> <th>Type</th> <th>Size</th> <th>Created</th> <th>Modified</th> <th>Tags</th> <th>Download</th>\
							</tr>';
	
							$.each(results, function(key, val){
								markup += '\
								<tr>\
								<td><div class="checkbox"></div></td>\
								<td>' + val.file_name + '</td>\
								<td>' + val.file_type + '</td>\
								<td>' + val.file_size + '</td>\
								<td>' + val.file_create_date + '</td>\
								<td>' + val.file_modify_date + '</td>\
								<td>' + val.tag_name + '</td>\
								<td><a href="' + path + val.file_name + '">Download</a></td>\
								</tr>';
							});
							
							markup += '</table>';
							
							$('.file_list').hide();
							currentEvent = 1;
							$('.file_tree').html('').html(markup).show();
							
						}, 
						error: function(){
						
						}						
					});
					
					
				});
			 */
			}
		});
	});
	
	
	$('.upload_to_cabinet').live('click', function(){
		var id = $(this).attr('id');
		window.location = "<?php echo base_url(); ?>index.php/upload/add/"+id;
	
	
	});
	
	
	$(".slt_all").live("click", function(){
		$(this).toggle(function(){
			$(this).css("color", "red");
		});
		
		$('.checkbox').each(function(){
			if(!$(this).hasClass('click'))			
			{
				$(this).addClass('click');
				$(this).closest('tr').addClass('selected');
			}
		});	
		return false;
	});
	
	
	
	$(".cw a[rel^='prettyPhoto']").prettyPhoto({	
		theme:'facebook',
		show_title: false, 
		social_tools: false,
		show_description:false,
		deeplinking: false,
		default_width: 660,	
		changepicturecallback: function(){ create_caBB(); }
	});
	
	
	$('.cabinet_edit_menu li, .cabinet_edit_menu_nopass li').each(function(){
		var that = $(this);		
		$("a[rel^='prettyPhoto']", this).prettyPhoto({	
			theme:'facebook',
			show_title: false, 
			social_tools: false,
			show_description:false,
			allow_resize: true,
			deeplinking: false,
			default_width: 660,	
			changepicturecallback: function(){ 
				$('.cabinet_edit_menu').hide();	
				$('.cabinet_edit_menu_nopass').hide();	
				editCabinet(that.attr('class'));
				$('.mask').hide();
			}
		});
	});
	
	
});

</script>


<!-- Container Section -->

<div class="container">
		
	<div class="file_list">
		<?php if(is_array($cabinet_info) && isset($cabinet_info) && $cabinet_info != null):		
		foreach($cabinet_info as $row): ?>		
		<div class="cabinet_wrap left">		
			<?php if($row->protected): ?>
				<div class="cabinet_w protected"></div>
				<div class="cabinet_head" id="<?php echo $row->id; ?>"><?php echo $row->cname;	?></div>	
				<span style="font-size:10px; display:block; font-weight:700;">
					<?php echo $row->description; ?>
				</span>
				<div class="cabinet_pass">
					<span>Please Enter the Password</span>
					<?php 
					echo form_open('cabinet/cabinate_files');
					echo "<input type='text' name='cab_head' value='{$row->cname}' class='hide' />";
					echo "<input type='text' name='cab_id' value='{$row->id}' class='hide' />";
					echo form_password('cab_pass', '', "class='cabinet_private'");
					echo form_submit('submit', 'Submit', "class='cabinet_sub'"); 				
					echo form_close(); 
					?>
				</div>
				
			<?php else: ?>
				<div class="cabinet_w"></div>
				<div class="cabinet_head no_pass" id="<?php echo $row->id ; ?>"><?php echo $row->cname; ?></div>	
				<span style="font-size:10px; display:block; font-weight:700;">
					<?php echo $row->description; ?>
				</span>			
			<?php endif; ?>			
		</div>	
		<?php endforeach; ?>
		<span class="clear"></span>
		<?php else: ?>
			<p style="padding: 30px;font-size: 18px;color: #FF5200;font-weight: 700;font-family: cursive, sans-serif;">
				You do not have any Cabinet. Please create some Cabinets.
			</p>
		<?php endif; ?>
	</div>
	
	<!--show files-->
	<div class="file_tree"></div>
		
	<div id="create_cabinet" class="hide">
		<div class="can_wrap">
			<div style="padding-top: 10px;"><h2>Create Cabinet</h2></div>
			<?php 
			echo form_open("cabinet/create");
			echo "<div class='c_cab_w'><label class='left'>Name</label><div class='left can_wap'>" . form_input('cabinet_name', '', "class='ccname'") . "</div><div class='left err companyname-error'><span>Name is required</span></div><span class='clear'></span></div>";
			echo "<div class='c_cab_w'><label class='left'>Description</label><div class='left can_wap'>" . form_input('cabinet_description', '', "class='ccdesc'") . "</div><div class='left err companyname-error'><span>Description is required</span></div><span class='clear'></span></div>";
			echo "<div class='c_cab_w'><label class='left'></label><div class='left can_wap'>" . form_checkbox('protected', '1', false, "class='ccprt'") . "Protected</div><div class='left err companyname-error'><span></span></div><span class='clear'></span></div>";
			echo "<div class='c_cab_w c_as_it hide'><label class='left'>Password</label><div class='left can_wap'>" . form_password('password', '', "class='ccprpass'") . "</div><div class='left err companyname-error'><span></span></div><span class='clear'></span></div>";
			echo "<div class='c_cab_w'><label class='left'></label><div class='left can_wap'>" . form_submit("submit", "Create Cabinet", "class='cr_cabb btn btn-bluish'") . "</div><div class='left err companyname-error'><span></span></div><span class='clear'></span></div>";			
			echo form_close();
			?>	
		</div>	
	</div>
	
</div>

<!-- end container -->







<!-- Menu Options -->


<div class="cabinet_edit_menu hide">
	<ul>
		<li class="edit_cab open"><a href='#open_cabinet' rel='prettyPhoto'>Open</a></li>
		<li class="edit_cab rename"><a href='#rename_cabinet' rel='prettyPhoto'>Rename</a></li>		
		<li class="edit_cab cng_password"><a href='#cng_cabinet_pass' rel='prettyPhoto'>Edit Password</a></li>
		<li class="edit_cab delete"><a href='#delete_cabinet' rel='prettyPhoto'>Delete</a></li>
	</ul>
</div> 

<div class="cabinet_edit_menu_nopass hide">
	<ul>
		<li class="edit_cab open_nopass"><a href='#'>Open</a></li>
		<li class="edit_cab rename"><a href='#rename_cabinet' rel='prettyPhoto'>Rename</a></li>		
		<li class="edit_cab delete"><a href='#delete_cabinet' rel='prettyPhoto'>Delete</a></li>
	</ul>
</div> 

<div id="open_cabinet" class="hide">
	<br/><br/>
	<h4>Protected Cabinet</h4>
		
	<div class="can_wrap">
		<?php 		
		echo form_open("cabinet/cabinate_files", 'class="open_cabin"');			
		echo "<div class='c_cab_w hide'><label class='left'>Name</label><div class='left can_wap'>" . form_input('cab_id', '', "class='ccname'") . "</div><div class='left err companyname-error'><span>Name is required</span></div><span class='clear'></span></div>";
		echo "<div class='c_cab_w hide'><label class='left'>Name</label><div class='left can_wap'>" . form_input('cab_name', '', "class='ccname'") . "</div><div class='left err companyname-error'><span>Name is required</span></div><span class='clear'></span></div>";
		echo "<div class='c_cab_w c_as_it'><label class='left'></label><div class='left can_wap'>Please enter the password</div><div class='left err companyname-error'><span></span></div><span class='clear'></span></div>";
		echo "<div class='c_cab_w c_as_it'><label class='left'>Password</label><div class='left can_wap'>" . form_password('cab_pass', '', "class='ccprpass'") . "</div><div class='left err companyname-error'><span></span></div><span class='clear'></span></div>";
		echo "<div class='c_cab_w'><label class='left'></label><div class='left can_wap'>" . form_submit("submit", "Open Cabinet", "class='cr_cabb_pro btn btn-bluish'") . "</div><div class='left err companyname-error'><span></span></div><span class='clear'></span></div>";			
		echo form_close();
		?>	
	</div>	
</div>

<div id="rename_cabinet" class="hide">
	<br/><br/>
	<h4>Rename Cabinet</h4>
		
	<div class="can_wrap">
		<?php 			
		echo form_open("cabinet/rename_cabinet", 'class="rename_cab"');
		echo "<div class='c_cab_w hide'><label class='left'>Name</label><div class='left can_wap'>" . form_input('cab_id', '', "class='ccname'") . "</div><div class='left err companyname-error'><span>Name is required</span></div><span class='clear'></span></div>";		
		echo "<div class='c_cab_w'><label class='left'>Current Name</label><div class='left can_wap'>" . form_input('cab_name', '', 'class="ccname" readonly') . "</div><div class='left err companyname-error'><span>Name is required</span></div><span class='clear'></span></div>";	
		echo "<div class='c_cab_w'><label class='left'>New Name</label><div class='left can_wap'>" . form_input('cab_name_new', '', "class='ccname'") . "</div><div class='left err companyname-error'><span>Name is required</span></div><span class='clear'></span></div>";	
		echo "<div class='c_cab_w'><label class='left'></label><div class='left can_wap'>" . form_submit("submit", "Rename Cabinet", "class='cr_cabb btn btn-bluish'") . "</div><div class='left err companyname-error'><span></span></div><span class='clear'></span></div>";			
		echo form_close();
		?>	
	</div>	
</div>	

<div id="cng_cabinet_pass" class="hide">
	<br/><br/>
	<h4>Edit Password</h4>
		
	<div class="can_wrap">
		<?php 			
		echo form_open("cabinet/repass_cabinet", 'class="repass_cab"');		
		echo "<div class='c_cab_w hide'><label class='left'>Name</label><div class='left can_wap'>" . form_input('cab_id', '', 'class="ccname"') . "</div><div class='left err companyname-error'><span>Name is required</span></div><span class='clear'></span></div>";		
		echo "<div class='c_cab_w hide'><label class='left'>Current Name</label><div class='left can_wap'>" . form_input('cab_name', '', 'class="ccname"') . "</div><div class='left err companyname-error'><span>Name is required</span></div><span class='clear'></span></div>";	
		echo "<div class='c_cab_w'><label class='left'>Current Password</label><div class='left can_wap'>" . form_input('cabinet_pass_prev', '', 'class="ccname"') . "</div><div class='left err companyname-error'><span></span></div><span class='clear'></span></div>";	
		echo "<div class='c_cab_w'><label class='left'>New Password</label><div class='left can_wap'>" . form_input('cabinet_pass', '', "class='ccname'") . "</div><div class='left err companyname-error'><span></span></div><span class='clear'></span></div>";	
		echo "<div class='c_cab_w'><label class='left'></label><div class='left can_wap'>" . form_submit("submit", "Change Password", "class='cr_cabb btn btn-bluish'") . "</div><div class='left err companyname-error'><span></span></div><span class='clear'></span></div>";			
		echo form_close();
		?>	
	</div>	
</div>	

<div id="delete_cabinet" class="hide">
	<br/><br/>
	<h4>Delete Cabinet</h4>
		
	<div class="can_wrap">
		<?php 
		
		echo form_open("cabinet/delete_cabinet");
		echo "<div class='c_cab_w hide'><label class='left'>Name</label><div class='left can_wap'>" . form_input('cab_id', '', "class='ccname'") . "</div><div class='left err companyname-error'><span>Name is required</span></div><span class='clear'></span></div>";
		echo "<div class='c_cab_w'><label class='left'></label><div class='left can_wap'>Are you sure you want to delete this Cabinet?</div><div class='left err companyname-error'><span></span></div><span class='clear'></span></div>";		
		echo "<div class='c_cab_w'><label class='left'></label><div class='left can_wap'>" . form_submit("submit", "Delete Cabinet", "class='btn btn-bluish'") . "</div><div class='left err companyname-error'><span></span></div><span class='clear'></span></div>";			
		echo form_close();
		?>	
	</div>	
</div>	

<div class="without_pass hide">
	<?php 
	$attributes = array('id' => 'cabnopasssub');
	echo form_open("cabinet/cabinate_files", $attributes);
	echo form_input('cab_id', '', "class='cccid'");
	echo form_input('cab_head', '', "class='ccchead'");
	echo form_submit("submit", "Submit", "class='btn btn-bluish'");			
	echo form_close();
	?>	
</div>	



<!-- end Menu Options -->