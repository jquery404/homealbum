<?php 
	echo form_open('cabinet/search_file');
?>

<div class="search_cabinet_file left">
	<input class="datepicker" name="cab_file_search" type="text"/>
	pdf, img	
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
	<!-- <li class="upload_to_cabinet" id="<?php echo $cab_id;?>">Upload</li> -->
	<li class="print_order">Order for Print</li>
	<li>Share</li>
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
	echo '<div style="padding: 0 10px 0;margin: 0 10px 0;">';	
	echo "<br/>Search results for <strong>".$search_for."</strong>...";
	echo '</div>';
	$this->table->set_heading('', 'File Name', 'File Type', 'File Size', 'Created', 'Modified', 'Download');
	$path="";
	foreach ($records as $item)
	{
		$idCheck = "<div class='checkbox' rel='{$item->cabinet_id}'></div>";
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
	
	echo $this->table->generate();	
	echo $this->pagination->create_links();
	echo "<div style='padding:20px'>" . anchor('cabinet/cabinate_files', 'Back to Cabinet', 'class="gbqfb" style="padding:4px"') . "</div>";
?> 

<div class="sub_form hide"></div>


<script type="text/javascript">

	$(function() {		
		var dpath = "<?php echo site_url(); ?>/login/download/";
		
		$('.upload_to_cabinet').live('click', function(){
			var id = $(this).attr('id');
			$('cab_file_upload')
			window.location = "<?php echo base_url(); ?>index.php/upload/add/"+id;
		});
		
		$(".slt_all").live("click", function(){
			
			$('.checkbox').each(function(){
				if(!$(this).hasClass('click'))			
				{
					$(this).addClass('click');
					$(this).closest('tr').addClass('selected');
				}
				
			
			});	
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
			console.log(file_lists);
			
			var data = {						
				cab_id: cab_id,				
				files: file_lists
			}; 
			
			$.ajax({
				type:'POST',
				url:'<?php echo site_url(); ?>/cabinet/delete_file',
				data: data,
				success: function(response){				
					console.log(response);
				}
			});
			
		});

		
		
		// ddfile
		$.each($('.download_file'), function(){
			$(this).click(function(){				
				var parent = $(this).parent().parent();
				var cab_id = $('td:eq(0) div', parent).attr('rel')+"/";
				var pathurl = dpath + cab_id + $(this).attr('rel');
				console.log('asd');				
				window.open(pathurl, "_blank");
				
				return false;			
			});			
		});
		
		// delete_file
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
		
		
		$('#cab_file_uploader').MultiFile({
			max: 10,
			list: '#cab_file_uploader-list',
			accept: 'ai|ait|bmp|cdr|cgm|dwg|dxf|doc|docx|eps|epsf|emf|pdf|fxg|html|gif|jpg|png|pct|psd|pdd|pcx|pxr|ppt|pptx|swf|tif|tiff|tga|txt|svgz|svg|wmf|xl|xls'
		});

		
		$('.print_order').live('click', function(){			
			var file_list = new Array();
			
			$('#minimalist tr').each(function(){
				if($(this).hasClass('selected'))
					file_list.push($('td:eq(1)', this).html());
				
			});	
			if(file_list.length == 0){
				alert("Please choose some files before you place an order.");
			}else{
				
				var f_list = file_list.toString();
					
				var p_markup='';
				
				p_markup += '<?php $attributes = array('id' => 'myform'); echo form_open('orderpage/place', $attributes);?><input type="text" name="filelist" value="'+f_list+'"><?php echo form_close();?>';
				
				$('.sub_form').html(p_markup);	
				$('#myform').submit();
			}
		});
		
	});
	
</script>