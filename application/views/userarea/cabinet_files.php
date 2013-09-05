<script type="text/javascript">
$(document).ready(function(){
	
	$(".cw a[rel^='prettyPhoto']").prettyPhoto({	
		theme:'facebook',
		show_title: false, 
		social_tools: false,
		show_description:false,
		deeplinking: false,
		default_width: 660,	
		changepicturecallback: function(){ create_caBB(); }
	});
	
	
	
});
</script>


<div class="user_widgets">
	
	<div class="my_office">
		<h3>My Office</h3>	
		<div class='cw'><a href='#upload' rel='prettyPhoto'>Upload Files</a></div>
	</div>

</div>
<?php 
	if(isset($status))
	{
		echo $status;
	}
	else
	{
		echo $filelist;
	
	}
?>


<div id="upload" class="hide">
	<div style="padding-top: 10px;"><h2>Upload files</h2></div>
	<form>
		<div id="queue"></div>
		<input id="file_upload" name="file_upload" type="file" multiple="true">
	</form>
	
	<?php
	echo form_open_multipart('cabinet/add_files');
	echo form_upload('userfile');
	echo form_submit('upload', 'Upload');	
	echo form_close();
	
	?>
	
	
</div>