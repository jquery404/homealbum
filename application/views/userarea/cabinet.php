

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
	


$(document).ready(function(){
	var currentEvent;
	var path="/download/"
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
		$(this).click(function(){
			if($('.cabinet_head',this).hasClass('no_pass'))
			{
				var link = "<?php echo site_url('cabinet/show_files/'); ?>/" + $('.cabinet_head',this).attr('id');
				window.location.href = link;
			}
			else
			{
				$('.cabinet_pass', this).show();				
				var head = $('.cabinet_pass', this).parent().find('.cabinet_head').html();				
				var $this = $(this);
				var sub = $('.cabinet_pass', this).find('.cabinet_sub');				
				var sub_pass = $('.cabinet_pass', this).find('.cabinet_private');				
				var cab_head = $('.cabinet_head',this).attr('id');				
				
				sub.unbind('click');				
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
							<ul><li>All</li><li>Delete</li><li>Upload</li><li>Order for Print</li><li>Share</li></ul></div><span class="clear"></span>\
							<table id="minimalist" class="cabinet_tree_list">\
							<tr>\
							<th></th><th>File Name</th> <th>Type</th> <th>Size</th> <th>Created</th> <th>Modified</th> <th>Tags</th><th>Download</th>\
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
								<td><a href="' + path+file_name + '">Download</a></td>\
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
			}
		});
	});
});

</script>


<h2>My Office(Logged as <?php echo $username; ?>)</h2>
<div class="user_panel">
	<p class="left">
		<img class="left" src="<?php echo base_url(); ?>/assets/imgs/people_icon.png" alt="">
		
		<span class="name-login left">
			<strong><?php echo $this->session->userdata('username'); ?></strong>											
		</span>
		<span class="clear"></span>
	</p>
	
	<p class="left">
		<?php echo anchor('user/iframe', 'My Office'); ?>
	</p>	
	
	<p class="left">
		<?php echo anchor('user/orderpage', 'Orderpage'); ?>
	</p>
	
	<p class="left backbtn">
		<?php echo anchor('#', 'Back'); ?>
	</p>

	<p class="right">
		<?php echo anchor('login/logout', 'Logout'); ?>
	</p>
	
	<span class="clear"></span>
</div>

<div class="file_list">
	<?php foreach($cabinet_info as $row): ?>

	
	<div class="cabinet_wrap left">	
		
		<?php if($row->protected): ?>
			<div class="cabinet_head" id="<?php echo $row->id ; ?>"><?php echo $row->cname;	?></div>	
			<span style="font-size:10px; display:block; font-weight:700;">
				<?php echo $row->description; ?>
			</span>
			
			<div class="cabinet_pass">
				<span>Please Enter the Password</span>
				<?php echo form_password('password', '', "class='cabinet_private'"); ?>
				<?php echo form_button('button', 'Submit', "class='cabinet_sub'"); ?>				
			</div>
			
		<?php else: ?>
		
			<div class="cabinet_head no_pass" id="<?php echo $row->id ; ?>"><?php echo $row->cname; ?></div>	
			<span style="font-size:10px; display:block; font-weight:700;">
				<?php echo $row->description; ?>
			</span>
		
		<?php endif; ?>
	
	</div>	
	<?php endforeach; ?>	
	<span class="clear"></span>
</div>


<div class="file_tree">





</div>












