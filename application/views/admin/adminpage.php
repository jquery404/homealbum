<html>
<head>
<link href="<?php echo base_url(); ?>/assets/imgs/favicon.ico" rel="shortcut icon" type="image/x-icon" />	
<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/cerulean.css" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/prettyPhoto.css" type="text/css" media="screen" title="prettyPhoto main stylesheet" charset="utf-8" />
<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/jquery-ui.css" type="text/css" />	

<script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/jquery-ui.min.js"></script>	
<script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/jquery.prettyPhoto.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/adminpanel.js"></script>
<style>.m_content { 
	_height: expression( this.scrollHeight > 445 ? "445px" : "auto" ); 
	max-height: 445px; 
	overflow:scroll;
}</style>
</head>

<body>

<div class="container-fluid">
	<div class="row-fluid">
				
		<!-- left menu starts -->
		<div class="span2 main-menu-span">
			<div class="well nav-collapse sidebar-nav">
				<ul class="nav nav-tabs nav-stacked main-menu">
					<li class="nav-header hidden-tablet">Menu</li>					
					<li><a class="ajax-link" href="<?php echo base_url(); ?>/admin"><i class="icon-font"></i><span class="hidden-tablet"> Order details</span></a></li>
					<li><a class="ajax-link" href="<?php echo base_url(); ?>/admin/packages"><i class="icon-picture"></i><span class="hidden-tablet"> Packages</span></a></li>
				</ul>					
			</div><!--/.well -->
		</div><!--/span-->
		<!-- left menu ends -->
			
		<div id="content" class="span10">
		<!-- content starts -->
		

			<div>
				<ul class="breadcrumb">
					<li>
						<a href="#">Menu</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">Local Order</a>
					</li>
				</ul>
			</div>
			
			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> Local Order</h2>					
					</div>
					<div class="box-content">
						
						
						<?php
																						
							/* $this->table->set_heading('#', 'ID', 'File id', 'File type', 
							'File pack', 'Total copy', 'Sender id', 'Recip id', 'Binding', 'First page color', 
							'Instruction', 'Total Price', 'Printed', 'Date', 'Order no.', 'User id', 'Action');
							 */
							$this->table->set_heading('#', 'Binding', 'First page color', 
							'Instruction', 'Total Price', 'Date', 'Order no.', 'Printed', 'Action');

							if(isset($records)):
							foreach ($records as $i=>$item)
							{		
								$printed = $item->printed == 1 ? '<span class="label label-success">Active</span>' : 
																 '<span class="label label-warning">Pending</span>';
								if($item->binding == -1) $binding = "None";
								else if($item->binding == 1) $binding = "Saddle Stitch"; 
								else if($item->binding == 2) $binding = "Coil Binding"; 
								else if($item->binding == 3) $binding = "Comb Binding"; 
								else if($item->binding == 4) $binding = "Perfect Binding";
								
								$actionM = "<div class='p_options'>
											<a class='btn btn-success' alt='{$item->id}' href='#viewOrder' rel='prettyPhoto'><i class='icon-zoom-in icon-white'></i>View</a>
											<a class='btn btn-info' alt='{$item->id}' href='#editOrder' rel='prettyPhoto'><i class='icon-edit icon-white'></i>Edit</a>
											<a class='btn btn-danger' alt='{$item->id}' href='#delOrder' rel='prettyPhoto'><i class='icon-trash icon-white'></i>Delete</a>
											</div>";
								
								$this->table->add_row(
									$i+1,
									//$item->id,
									//$item->file_id,
									//$item->file_type,
									//$item->file_pack,
									//$item->total_copy,
									//$item->sender_id,
									//$item->recip_id,
									$binding,
									$item->colorpage,
									$item->instruction,
									$item->price,
									$item->create_date, 
									$item->order_id,
									//$item->user_id
									$printed,
									$actionM
								);
							}
							endif;
							echo $this->table->generate();	
							echo $this->pagination->create_links();
						?>							
					
					</div>
				</div><!--/span-->
			
			</div><!--/row-->		
								

				<!-- content ends -->
		</div><!--/#content.span10-->
	
	</div><!--/fluid-row-->
	
	<hr>

	<div class="modal hide fade" id="myModal">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">×</button>
			<h3>Settings</h3>
		</div>
		<div class="modal-body">
			<p>Here settings can be configured...</p>
		</div>
		<div class="modal-footer">
			<a href="#" class="btn" data-dismiss="modal">Close</a>
			<a href="#" class="btn btn-primary">Save changes</a>
		</div>
	</div>

	<footer>
		<p class="pull-left">&copy; <a href="http://jquery404.com" target="_blank">jQuery404</a> 2013</p>
		<p class="pull-right">Powered by: <a href="http://jquery404.com">jQuery404</a></p>
	</footer>
	
	<div id="viewOrder" class="hide"><h2 class="v">View Order</h2><div class="m_content"></div></div>
	<div id="editOrder" class="hide"><h2 class="e">Please wait .....</h2><div class="m_content"></div></div>
	<div id="delOrder" class="hide">
		<h2 class="d">Delete Order</h2>
		<div class="alert alert-error">			
			<strong>Oh snap!</strong> Are you sure you want to delete?<br/><br/>
			<button type="submit" class="yes_pretty btn btn-primary">Yes</button>
			<button type="reset" class="cancel_pretty btn">Cancel</button>			
		</div>
	</div>

</div><!--/.fluid-container
Request format:

{"provide":"allForm"}

Response Format:

{"status":0,"formList":[{"id":1,"title":"NDA FORM"},{"id":2,"title":"FASBSBS"}]}-->


</body>

</html>