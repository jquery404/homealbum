<h3><?php echo $cab_name; ?></h3>

<?php 
if($root):
echo form_open('cabinet/search_file');
?>

<div class="search_cabinet_file left">
	<input class="datepicker" name="cab_file_search" type="text" />	
</div>

<?php 
$options = array(                  
  'file_name'   => 'File Name',
  'file_type' => 'File Type',
  'file_create_date' => 'Date'
);

echo "<div class='search_type left'>".form_dropdown('search_by', $options, 'file_name')."</div>";
echo form_submit('submit', 'Search', 'class="searchbtn left gbqfb"');
echo form_close(); 
?>

<div class="file_tree_options left">
	<ul>
		<li class="slt_all">All</li>
		<li class="delete_files">Delete</li>	
		<li class="print_order">Order for Print</li>
		<li class="share_files"><a href="#share_this" rel="prettyPhoto">Share</a></li>
	</ul>
</div>
<span class="clear"></span>


<?php	
function fileSizeConvert($size)
{
	if($size > 999)
	{
		if($size > 999999)		
			$size = sprintf ("%.2f", $size / (1024 * 1024)) . ' MB';		
		else
			$size = sprintf ("%.2f", $size / 1024) . ' KB';
	}	
	else
	{
		$size .= ' bytes';	
	}
	
	return $size;
}

$this->table->set_heading('', 'File Name', 'File Type', 'File Size', 'Created', 'Modified', 'Download');

if(isset($records)):
foreach ($records as $item)
{
	$idCheck = "<div class='checkbox' atr='{$item->id}' rel='{$item->cabinet_id}'></div>";
	$this->table->add_row(
		$idCheck,
		$item->file_name, 
		$item->file_type, 
		fileSizeConvert($item->file_size),
		$item->file_create_date, 
		$item->file_modify_date,		
		'<a href="#" class="download_file" rel="'.$item->file_name.'">Download</a>'
	);
}
endif;
echo $this->table->generate();	
echo $this->pagination->create_links();
?> 

<div class="asd"></div>
<div class="sub_form hide"></div>

<?php else: ?>
<div style="text-align: center;padding: 20px;color: #FF3434;font-size: 16px;"><?php echo $cabinet_info; ?></div>

<?php endif; ?>


<div id="share_this" class="hide">
	<br/><br/>
	<h4>Share with someone </h4>
		
	<div class="can_wrap">	
	<?php 			
	echo form_open("share/files", 'class="share_file"');			
	echo "<div class='c_cab_w'><label class='left'>To</label><div class='left can_wap'>" . form_input('share_email', '', 'class="ccname"') . "</div><div class='left err companyname-error'><span>Name is required</span></div><span class='clear'></span></div>";	
	echo "<div class='c_cab_w'><label class='left'>Message</label><div class='left can_wap'>" . form_textarea('share_msg', '', 'class="ccname"') . "</div><div class='left err companyname-error'><span>Write a message.</span></div><span class='clear'></span></div>";	
	echo "<div class='attchment c_cab_w'><label class='left'>Attachment</label><div class='left can_wap'>" . form_input('share_attachement', '', "class='ccname' readonly") . "</div><div class='left err companyname-error'><span></span></div><span class='clear'></span></div>";	
	echo "<div class='c_cab_w'><label class='left'></label><div class='left can_wap'>" . form_submit("submit", "Share", "class='cr_cabb btn btn-bluish'") . "</div><div class='left err companyname-error'><span></span></div><span class='clear'></span></div>";			
	echo form_close();
	?>	
	<div class="errne"></div>
	</div>
	
</div>





<script type="text/javascript">

	$(function() {
	
		var dpath = "<?php echo site_url(); ?>/login/download/";
		
		$('.upload_to_cabinet').live('click', function(){
			var id = $(this).attr('id');
			
			window.location = "<?php echo base_url(); ?>index.php/upload/add/"+id;
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
			
			selected_all = !selected_all;
			
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
				
		$('select[name="search_by"]').change(function(){
			if($(this).val() == "file_create_date")
			{
				$( ".datepicker" ).datepicker();
			}
			else
			{
				$(".datepicker").datepicker("destroy");
			}
			
		});
		
		$('.delete_files').live('click', function(){
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
			if(confirm('Do you really want to delete the file?'))
			{
				var file_list = new Array(); 
				var cab_id;
				
				$('#minimalist tr').each(function(){
					if($(this).hasClass('selected')){
						cab_id = $('td:eq(0) div', this).attr('rel');										
						file_list.push($('td:eq(1)', this).html());					
						$(this).remove();
					}
				});		
				var file_lists = (file_list.length > 1) ? file_list.join() : file_list.toString();
				//console.log(file_lists);
				
				var data = {						
					cab_id: cab_id,				
					files: file_lists
				}; 
				
				$.ajax({
					type:'POST',
					url:'<?php echo site_url(); ?>/cabinet/delete_file',
					data: data,
					success: function(response){				
						alert(response);
					}
				});
			}	
			}
		});

		$.each($('.download_file'), function(){
			$(this).click(function(){				
				var parent = $(this).parent().parent();
				var cab_id = $('td:eq(0) div', parent).attr('rel')+"/";
				var pathurl = dpath + cab_id + $(this).attr('rel');
							
				window.open(pathurl, "_blank");
				
				return false;			
			});			
		});
		
		$('#cab_file_uploader').MultiFile({
			max: 10,
			list: '#cab_file_uploader-list',
			accept: 'ai|ait|bmp|cdr|cgm|dwg|dxf|doc|docx|eps|epsf|emf|pdf|fxg|html|gif|jpg|png|pct|psd|pdd|pcx|pxr|ppt|pptx|swf|tif|tiff|tga|txt|svgz|svg|wmf|xl|xls'
		});

		
		$('.print_order').live('click', function(){			
			var file_list = new Array();
			var file_id = new Array();
			
			$('#minimalist tr').each(function(){
				if($(this).hasClass('selected')){
					file_list.push($('td:eq(1)', this).html());
					file_id.push($('td:eq(0) div', this).attr('atr'));
				}				
			});	
			if(file_list.length == 0){
				dialogBox("Warning", "Please choose some files before you place an order.");
			}else{				
				var f_list = file_list.toString();
				var f_id = file_id.toString();
					
				var p_markup='';
				
				p_markup += '<?php $attributes = array('id' => 'myform');echo form_open('orderpage/place', $attributes);?><input type="text" name="filelist" value="'+f_list+'"><input type="text" name="fileid" value="'+f_id+'"><?php echo form_close();?>';
				
				$('.sub_form').html(p_markup);	
				$('#myform').submit();
			}
		});
		
			
		//window.location = "<?php echo base_url(); ?>index.php/share/files";
		$(".share_files a[rel^='prettyPhoto']").prettyPhoto({
			theme:'facebook',
			show_title: false, 
			social_tools: false,
			show_description:false,
			deeplinking: false,
			default_width: 660,	
			changepicturecallback: function(){ shareCab(); }
		});
			
			
		$('.up_cab_f').click(function(){
			if($("#cab_file_uploader-list .MultiFile-label").length == 0)
			{
				dialogBox("Warning", "Please upload some files");
				return false;
			}
			return;
		});	
		
		
	});
	
	
	
	// function
	
	function shareCab()
	{	
		var file_selected = new Array();
		$('#minimalist tr').each(function(){
			if($(this).hasClass('selected')){					
				file_selected.push($('td:eq(1)', this).html());					
			}
		});	
		
		if(file_selected.length == 0)// no file choosen
			$('.pp_inline .attchment').addClass('hide');
				
		
		
		$('.pp_inline .attchment input').val(file_selected.toString());
		// files choosen
			
		
		$('.pp_inline .cr_cabb').click(function(){
			
			$.post("<?php echo site_url(); ?>/share/files", $('.share_file').serialize())
			.success(function(response) { /*alert(response);*/
				
				var val = $.parseJSON(response);	
				
				if(val.results == "error")
				{
					$('.errne').html(val.msg).show();
				}
				else if(val.results == "success")
				{	
					alert("Thanks for sharing.");
					$(".pp_inline").html('');
					$(".pp_content").addClass('preloader');
					$.prettyPhoto.close();
				}
			});
			return false;
		});
	
	}
	
	
</script>


<?php if($cabinet_info == "Your cabinet password didnot match"): ?>
<div class="cabinet_password_form">
	<h4>Cabinet : <?php echo $cab_name;?></h4>		
	<div class="can_wrap">
		<?php 		
		echo form_open("cabinet/cabinate_files", 'class="open_cabin"');			
		echo "<div class='c_cab_w hide'><label class='left'>Name</label><div class='left can_wap'>" . form_input('cab_id', $cab_id, "class='ccname'") . "</div><div class='left err companyname-error'><span>Name is required</span></div><span class='clear'></span></div>";
		echo "<div class='c_cab_w hide'><label class='left'>Name</label><div class='left can_wap'>" . form_input('cab_name', $cab_name, "class='ccname'") . "</div><div class='left err companyname-error'><span>Name is required</span></div><span class='clear'></span></div>";
		echo "<div class='c_cab_w c_as_it'><label class='left'></label><div class='left can_wap'>Please enter the password</div><div class='left err companyname-error'><span></span></div><span class='clear'></span></div>";
		echo "<div class='c_cab_w c_as_it'><label class='left'>Password</label><div class='left can_wap'>" . form_password('cab_pass', '', "class='ccprpass'") . "</div><div class='left err companyname-error'><span></span></div><span class='clear'></span></div>";
		echo "<div class='c_cab_w'><label class='left'></label><div class='left can_wap'>" . form_submit("submit", "Open Cabinet", "class='cr_cabb btn btn-bluish'") . "</div><div class='left err companyname-error'><span></span></div><span class='clear'></span></div>";			
		echo form_close();
		?>	
	</div>	
</div>
<?php else: ?>

<em>Please upload some files</em>
<div class="toc">
	<h4>Terms &amp; Conditions</h4>
	<p>If you choose a package you have to upload files or photos from local sources like local hardware or 
	hard drive, flash drive etc. <br/>You can not choose files from <strong>"My Office"</strong> if you choose a package.</p>	
</div>

<?php 
echo form_open_multipart('cabinet/do_upload', 'class="P10" name="faisal"'); 
echo "<input type='file' name='mystuff[]' id='cab_file_uploader' style='margin:10px;'/>";
echo form_input('cabid', $cab_id, 'class="hide"');
echo "<div id='cab_file_uploader-list' style='border: 2px solid #6678B1;margin: 10px 10px 0;padding: 10px;'>
	Selected files will be populated here...
	<br/><br/>
	</div><br/>";

echo form_submit('submit', 'Upload', 'class="up_cab_f btn btn-bluish" style="margin: 0 10px;"');
echo form_close();  
?>
<!--<form action="" class="P10">-->



<span class="clear"></span>

<?php endif; ?>
