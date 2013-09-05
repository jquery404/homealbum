<html>
<head>
<link href="<?php echo base_url(); ?>/assets/imgs/favicon.ico" rel="shortcut icon" type="image/x-icon" />	
<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/cerulean.css" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/charisma-app.css" type="text/css" />	
<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/prettyPhoto.css" type="text/css" media="screen" title="prettyPhoto main stylesheet" charset="utf-8" />
<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/jquery-ui.css" type="text/css" />	

<script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/jquery-ui.min.js"></script>	
<script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/jquery.prettyPhoto.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/bootstrap-dropdown.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/adminpanel.js"></script>
</head>


<body>

<?php	
	//print_r($allpackages);				
	if(isset($allpackages)):
	$localPhotos = $allpackages['local_photos'];
	$interPhotos = $allpackages['inter_photos'];
	$localDocs = $allpackages['local_docs'];
	$interDocs = $allpackages['inter_docs'];
	$orderFees = $allpackages['order_fees'];
	endif;
?>
				
				
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
					<li><a href="#">Menu</a> <span class="divider">/</span></li>
					<li><a href="#">Packages</a></li>
				</ul>
			</div>
			<div class="alert alert-info">
				<?php 
					echo $msg; 
					echo validation_errors();
				?>			
			</div>
			
			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well">
						<h2><i class="icon-user"></i> OPTIONS</h2>					
					</div>
					<div class="box-content">					
						<a href="#" class="control_lp">Local Photos</a> <span class="divider">/</span>
						<a href="#" class="control_ip">International Photos</a> <span class="divider">/</span>
						<a href="#" class="control_ld">Local Documents</a> <span class="divider">/</span> 
						<a href="#" class="control_id">International Documents</a> <span class="divider">/</span> 
						<a href="#" class="control_of">Other Fees</a>
					</div>
				</div>	
			</div>	
			
			<!-- editing Local Photos -->
			<div class="row-fluid sortable edit_lp hide">		
				<div class="box span12">
					<div class="box-header well">
						<h2><i class="icon-user"></i> Order</h2>					
					</div>
					<div class="box-content">
						<?php echo form_open('admin/eLocalPhotos', 'class="form-horizontal"');?>						
							<fieldset>	
								<div class="control-group hide">
								  <label class="control-label" for="typeahead"> </label>
								  <div class="controls">
									<input type="text" class="span6 typeahead" name="lp_id" id="typeahead" />
								  </div>
								</div>
								
								<div class="control-group">
								  <label class="control-label" for="typeahead">Package </label>
								  <div class="controls">
									<input type="text" class="span6 typeahead" name="lp_name" id="typeahead" />
								  </div>
								</div>
								
								<div class="control-group">
								  <label class="control-label" for="typeahead">Price (Taka) </label>
								  <div class="controls">
									<input type="text" class="span6 typeahead" name="lp_price" id="typeahead" />
								  </div>
								</div>
								
								<div class="form-actions">
								  <button type="submit" class="btn btn-primary">Submit</button>
								  <button type="reset" class="btn">Reset</button>						  
								</div>
							</fieldset>
						<?php echo form_close(); ?>
					</div>
				</div>
			</div>
			
			<!-- editing International Photos -->
			<div class="row-fluid sortable edit_ip hide">		
				<div class="box span12">
					<div class="box-header well">
						<h2><i class="icon-user"></i> Order</h2>					
					</div>
					<div class="box-content">
						<?php echo form_open('admin/eInterPhotos', 'class="form-horizontal"'); ?>						
							<fieldset>	
								<div class="control-group hide">
								  <label class="control-label" for="typeahead"> </label>
								  <div class="controls">
									<input type="text" class="span6 typeahead" name="ip_id" id="typeahead" />								
								  </div>
								</div>
								
								<div class="control-group">
								  <label class="control-label" for="typeahead">Package </label>
								  <div class="controls">
									<input type="text" class="span6 typeahead" name="ip_name" id="typeahead" />								
								  </div>
								</div>
								
								<div class="control-group">
								  <label class="control-label" for="typeahead">No Discount Upto </label>
								  <div class="controls">
									<input type="text" class="span6 typeahead" name="ip_no_discount" id="typeahead" />								
								  </div>
								</div>
								
								<div class="control-group">
								  <label class="control-label" for="typeahead">Discount From </label>
								  <div class="controls">
									<input type="text" class="span6 typeahead" name="ip_discount_form" id="typeahead" />								
								  </div>
								</div>
								
								<div class="control-group">
								  <label class="control-label" for="typeahead">Price - Without Discount (USD) </label>
								  <div class="controls">
									<input type="text" class="span6 typeahead" name="ip_discount_price" id="typeahead" />								
								  </div>
								</div>
								
								<div class="control-group">
								  <label class="control-label" for="typeahead">Price - With Discount (USD) </label>
								  <div class="controls">
									<input type="text" class="span6 typeahead" name="ip_no_discount_price" id="typeahead" />								
								  </div>
								</div>
								
								<div class="form-actions">
								  <button type="submit" class="btn btn-primary">Submit</button>
								  <button type="reset" class="btn">Reset</button>						  
								</div>
							</fieldset>
						<?php echo form_close(); ?>
					</div>
				</div>
			</div>
						
			<!-- editing Local Docs -->
			<div class="row-fluid sortable edit_ld hide">		
				<div class="box span12">
					<div class="box-header well">
						<h2><i class="icon-user"></i> Order</h2>					
					</div>
					<div class="box-content">
						
						<?php echo form_open('admin/eLocalDocs', 'class="form-horizontal"'); ?>						
							<fieldset>	
								<div class="control-group hide">
								  <label class="control-label" for="typeahead"> </label>
								  <div class="controls">
									<input type="text" class="span6 typeahead" name="ld_id" id="typeahead" />								
								  </div>
								</div>
								
								<div class="control-group">
								  <label class="control-label" for="typeahead">Package </label>
								  <div class="controls">
									<input type="text" class="span6 typeahead" name="ld_name" id="typeahead" />								
								  </div>
								</div>
								
								<div class="control-group">
								  <label class="control-label" for="typeahead">Price (Taka) </label>
								  <div class="controls">
									<input type="text" class="span6 typeahead" name="ld_price" id="typeahead" />								
								  </div>
								</div>
								
								<div class="form-actions">
								  <button type="submit" class="btn btn-primary">Submit</button>
								  <button type="reset" class="btn">Reset</button>						  
								</div>
							</fieldset>
						<?php echo form_close(); ?>
					</div>
				</div>
			</div>
			
			<!-- editing International Docs -->
			<div class="row-fluid sortable edit_id hide">		
				<div class="box span12">
					<div class="box-header well">
						<h2><i class="icon-user"></i> Order</h2>					
					</div>
					<div class="box-content">
						
						<?php echo form_open('admin/eInterDocs', 'class="form-horizontal"'); ?>	
							<fieldset>	
								<div class="control-group hide">
								  <label class="control-label" for="typeahead"> </label>
								  <div class="controls">
									<input type="text" class="span6 typeahead" name="id_id" id="typeahead" />								
								  </div>
								</div>
								
								<div class="control-group">
								  <label class="control-label" for="typeahead">Package </label>
								  <div class="controls">
									<input type="text" class="span6 typeahead" name="id_name" id="typeahead" />								
								  </div>
								</div>
								
								<div class="control-group">
								  <label class="control-label" for="typeahead">Price (USD) </label>
								  <div class="controls">
									<input type="text" class="span6 typeahead" name="id_price" id="typeahead" />								
								  </div>
								</div>
								
								<div class="form-actions">
								  <button type="submit" class="btn btn-primary">Submit</button>
								  <button type="reset" class="btn">Reset</button>						  
								</div>
							</fieldset>
						<?php echo form_close(); ?>
					</div>
				</div>
			</div>
						
			<!-- editing Misc Price -->
			<div class="row-fluid sortable edit_of hide">		
				<div class="box span12">
					<div class="box-header well">
						<h2><i class="icon-user"></i> Order</h2>					
					</div>
					<div class="box-content">
						
						<?php echo form_open('admin/eOtherFees', 'class="form-horizontal"'); ?>	
							<fieldset>	
								<div class="control-group hide">
								  <label class="control-label" for="typeahead"> </label>
								  <div class="controls">
									<input type="text" class="span6 typeahead" name="of_id" id="typeahead" />								
								  </div>
								</div>
								
								<div class="control-group">
								  <label class="control-label" for="typeahead">Package </label>
								  <div class="controls">
									<input type="text" class="span6 typeahead" name="of_name" id="typeahead" />								
								  </div>
								</div>
								
								<div class="control-group">
								  <label class="control-label" for="typeahead">Finishing Cost </label>
								  <div class="controls">
									<input type="text" class="span6 typeahead" name="of_finish_cost" id="typeahead" />								
								  </div>
								</div>
								
								<div class="control-group">
								  <label class="control-label" for="typeahead">Firstpage Color </label>
								  <div class="controls">
									<input type="text" class="span6 typeahead" name="of_firstpage_color" id="typeahead" />								
								  </div>
								</div>
								<div class="control-group">
								  <label class="control-label" for="typeahead">Courier without Discount </label>
								  <div class="controls">
									<input type="text" class="span6 typeahead" name="of_courier_nodiscount" id="typeahead" />								
								  </div>
								</div>
								<div class="control-group">
								  <label class="control-label" for="typeahead">Courier with Discount </label>
								  <div class="controls">
									<input type="text" class="span6 typeahead" name="of_courier_discount" id="typeahead" />								
								  </div>
								</div>
								<div class="control-group">
								  <label class="control-label" for="typeahead">Courier Price (no discount) </label>
								  <div class="controls">
									<input type="text" class="span6 typeahead" name="of_courier_price_a" id="typeahead" />								
								  </div>
								</div>
								<div class="control-group">
								  <label class="control-label" for="typeahead">Courier Price (with discount) </label>
								  <div class="controls">
									<input type="text" class="span6 typeahead" name="of_courier_price_b" id="typeahead" />								
								  </div>
								</div>
								
								<div class="form-actions">
								  <button type="submit" class="btn btn-primary">Submit</button>
								  <button type="reset" class="btn">Reset</button>						  
								</div>
							</fieldset>
						</form>	
					</div>
				</div>
			</div>
			
			
			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well">
						<h2><i class="icon-user"></i> Local Photos</h2>					
					</div>
					
					<div class="box-content">
						<table class='table table-striped table-bordered bootstrap-datatable datatable'>
							<thead>
							  <tr><th>ID.</th><th>Package</th><th>Price (Taka)</th><th>Action</th></tr>
							</thead>
							<tbody>
								<?php
									$action = "<div class='p_options'>
										<a class='btn btn-info editLocalPhoto' href='#'><i class='icon-edit icon-white'></i>  Edit</a>
										<a href='#' class='btn btn-danger delLocalPhoto'><i class='icon-trash icon-white'></i> Delete</a>
									</div>";
									foreach ($localPhotos as $j=>$pack)
									{
										echo "<tr>";										
										foreach ($pack as $k=>$p)
										{	
											echo "<td>" . $p . "</td>";
											
											if($k == 'price')												
												echo "<td class='center'>{$action}</td>";
										}
										echo "</tr>";
									}	
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div><!--/row-->	
					
			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well">
						<h2><i class="icon-user"></i> International Photos</h2>					
					</div>
					
					<div class="box-content">
						<table class='table table-striped table-bordered bootstrap-datatable datatable'>
							<thead>
							  <tr><th>ID.</th><th>Package</th><th>No Discount Upto</th><th>Discount From</th><th>Price - Without Discount (USD)<th>Price - With Discount (USD)</th><th>Action</th></tr>
							</thead>
							<tbody>
								<?php
									$action = "<div class='p_options'>
										<a class='btn btn-info editInterPhoto' href='#'><i class='icon-edit icon-white'></i>  Edit</a>
										<a href='#' class='btn btn-danger delInterPhoto'><i class='icon-trash icon-white'></i> Delete</a>
									</div>";
									foreach ($interPhotos as $j=>$pack)
									{
										echo "<tr>";
										foreach ($pack as $k=>$p)
										{	
											echo "<td>" . $p . "</td>";
											
											if($k == 'price_b')												
												echo "<td class='center'>{$action}</td>";
										}
										echo "</tr>";
									}	
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div><!--/row-->	
						
			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well">
						<h2><i class="icon-user"></i> Local Documents</h2>					
					</div>
					
					<div class="box-content">
						<table class='table table-striped table-bordered bootstrap-datatable datatable'>
							<thead>
							  <tr><th>ID.</th><th>Package</th><th>Price (Taka)</th><th>Action</th></tr>
							</thead>
							<tbody>
								<?php
									$action = "<div class='p_options'>
										<a class='btn btn-info editLocalDocs' href='#'><i class='icon-edit icon-white'></i>  Edit</a>
										<a href='#' class='btn btn-danger delLocalDocs'><i class='icon-trash icon-white'></i> Delete</a>
									</div>";
									foreach ($localDocs as $j=>$pack)
									{
										echo "<tr>";
										foreach ($pack as $k=>$p)
										{	
											echo "<td>" . $p . "</td>";
											
											if($k == 'price')												
												echo "<td class='center'>{$action}</td>";
										}
										echo "</tr>";
									}	
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div><!--/row-->	
			
						
			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well">
						<h2><i class="icon-user"></i> International Documents</h2>					
					</div>
					
					<div class="box-content">
						<table class='table table-striped table-bordered bootstrap-datatable datatable'>
							<thead>
							  <tr><th>ID.</th><th>Package</th><th>Price (USD)</th><th>Action</th></tr>
							</thead>
							<tbody>
								<?php
									$action = "<div class='p_options'>
										<a class='btn btn-info editInterDocs' href='#'><i class='icon-edit icon-white'></i>  Edit</a>
										<a href='#' class='btn btn-danger delInterDocs'><i class='icon-trash icon-white'></i> Delete</a>
									</div>";
									
									foreach ($interDocs as $j=>$pack)
									{
										echo "<tr>";
										foreach ($pack as $k=>$p)
										{	
											echo "<td>" . $p . "</td>";
											
											if($k == 'price')												
												echo "<td class='center'>{$action}</td>";
										}
										echo "</tr>";
									}	
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div><!--/row-->	
			
			
			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well">
						<h2><i class="icon-user"></i> Other Fees</h2>					
					</div>
					
					<div class="box-content">
						<table class='table table-striped table-bordered bootstrap-datatable datatable'>
							<thead>
							  <tr><th>ID.</th><th>Package</th><th>Finishing Cost</th><th>Firstpage Color</th><th>Courier without Discount</th><th>Courier with Discount</th><th>Courier Price (no discount)</th><th>Courier Price (with discount)</th><th>Action</th></tr>
							</thead>
							<tbody>
								<?php
									$action = "<div class='p_options'>
										<a class='btn btn-info editOtherFees' href='#'><i class='icon-edit icon-white'></i>  Edit</a>
										<a href='#' class='btn btn-danger delOtherFees'><i class='icon-trash icon-white'></i> Delete</a>
									</div>";
									
									foreach ($orderFees as $j=>$pack)
									{
										echo "<tr>";
										foreach ($pack as $k=>$p)
										{	
											echo "<td>" . $p . "</td>";
											
											if($k == 'courier_price_b')												
												echo "<td class='center'>{$action}</td>";
										}
										echo "</tr>";
									}	
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div><!--/row-->	
			
			
			<!-- content ends -->
		</div><!--/#content.span10-->
			
	</div><!--/fluid-row-->
	
	<footer>
		<p class="pull-left">&copy; <a href="http://jquery404.com" target="_blank">jQuery404</a> 2013</p>
		<p class="pull-right">Powered by: <a href="http://jquery404.com">jQuery404</a></p>
	</footer>
	
</div><!--/.fluid-container -->
	
	
<script type="text/javascript">

$(function(){
	$('.editLocalPhoto').each(function(){
		$(this).click(function(){
			$('.edit_lp').removeClass('hide');
			$('.edit_ip').addClass('hide');
			$('.edit_ld').addClass('hide');
			$('.edit_id').addClass('hide');
			$('.edit_of').addClass('hide');
			
			var lp = $(this).parent().parent().parent();
			var id = $('td:eq(0)', lp).html();			
			var pack = $('td:eq(1)', lp).html();			
			var price = $('td:eq(2)', lp).html();			
			$("input[name='lp_id']").val(id);
			$("input[name='lp_name']").val(pack);
			$("input[name='lp_price']").val(price);
			
			
		});
	});

	$('.editInterPhoto').each(function(){
		$(this).click(function(){
			$('.edit_lp').addClass('hide');
			$('.edit_ip').removeClass('hide');
			$('.edit_ld').addClass('hide');
			$('.edit_id').addClass('hide');
			$('.edit_of').addClass('hide');
			
			var lp = $(this).parent().parent().parent();
			var id = $('td:eq(0)', lp).html();			
			var pack = $('td:eq(1)', lp).html();			
			var noDiscount = $('td:eq(2)', lp).html();			
			var discountForm = $('td:eq(3)', lp).html();			
			var discountPrice = $('td:eq(4)', lp).html();			
			var noDiscountPrice = $('td:eq(5)', lp).html();
			
			$("input[name='ip_id']").val(id);
			$("input[name='ip_name']").val(pack);
			$("input[name='ip_no_discount']").val(noDiscount);
			$("input[name='ip_discount_form']").val(discountForm);
			$("input[name='ip_discount_price']").val(discountPrice);
			$("input[name='ip_no_discount_price']").val(noDiscountPrice);
			
			
		});
	});

	$('.editLocalDocs').each(function(){
		$(this).click(function(){
			$('.edit_lp').addClass('hide');
			$('.edit_ip').addClass('hide');
			$('.edit_ld').removeClass('hide');
			$('.edit_id').addClass('hide');
			$('.edit_of').addClass('hide');
			
			var lp = $(this).parent().parent().parent();
			var id = $('td:eq(0)', lp).html();			
			var pack = $('td:eq(1)', lp).html();			
			var price = $('td:eq(2)', lp).html();	
			
			$("input[name='ld_id']").val(id);
			$("input[name='ld_name']").val(pack);
			$("input[name='ld_price']").val(price);
			
			
			
		});
	});

	$('.editInterDocs').each(function(){
		$(this).click(function(){
			$('.edit_lp').addClass('hide');
			$('.edit_ip').addClass('hide');
			$('.edit_ld').addClass('hide');
			$('.edit_id').removeClass('hide');
			$('.edit_of').addClass('hide');
			
			var lp = $(this).parent().parent().parent();
			var id = $('td:eq(0)', lp).html();			
			var pack = $('td:eq(1)', lp).html();			
			var price = $('td:eq(2)', lp).html();	
			
			$("input[name='id_id']").val(id);
			$("input[name='id_name']").val(pack);
			$("input[name='id_price']").val(price);
			
			
			
		});
	});

	$('.editOtherFees').each(function(){
		$(this).click(function(){
			$('.edit_lp').addClass('hide');
			$('.edit_ip').addClass('hide');
			$('.edit_ld').addClass('hide');
			$('.edit_id').addClass('hide');
			$('.edit_of').removeClass('hide');
			
			var lp = $(this).parent().parent().parent();
			var id = $('td:eq(0)', lp).html();			
			var pack = $('td:eq(1)', lp).html();			
			var finishCost = $('td:eq(2)', lp).html();	
			var firstpageCost = $('td:eq(3)', lp).html();	
			var courierNoDis = $('td:eq(4)', lp).html();	
			var courierDis = $('td:eq(5)', lp).html();	
			var courierPriceA = $('td:eq(6)', lp).html();	
			var courierPriceB = $('td:eq(7)', lp).html();	
			
			$("input[name='of_id']").val(id);
			$("input[name='of_name']").val(pack);
			$("input[name='of_finish_cost']").val(finishCost);
			$("input[name='of_firstpage_color']").val(firstpageCost);
			$("input[name='of_courier_nodiscount']").val(courierNoDis);
			$("input[name='of_courier_discount']").val(courierDis);
			$("input[name='of_courier_price_a']").val(courierPriceA);
			$("input[name='of_courier_price_b']").val(courierPriceB);
			
			
			
		});
	});


	$('.delLocalPhoto').each(function(){				
		$(this).click(function(){
			var that = $(this);
			$(that).html('please wait...');
			var lp = $(this).parent().parent().parent();
			var ids = $('td:eq(0)', lp).html();		
			
			$.post("<?php echo site_url();?>/admin/dLocalPhotos", { id: ids })
			.success(function(response){ 
				if(response)
				{
					location.reload();
				}	
				else
				{
					$(that).html('Error');
				}				
			});
			
			return false;
		});
	});
	
	$('.delInterPhoto').each(function(){	
		$(this).click(function(){
			var that = $(this);
			$(that).html('please wait...');
			var lp = $(this).parent().parent().parent();
			var ids = $('td:eq(0)', lp).html();		
			
			$.post("<?php echo site_url();?>/admin/dInterPhotos", { id: ids })
			.success(function(response){ 
				if(response)
				{
					location.reload();
				}	
				else
				{
					$(that).html('Error');
				}				
			});
			
			return false;
		});
	});
	
	$('.delLocalDocs').each(function(){
	
		$(this).click(function(){
			var that = $(this);
			$(that).html('please wait...');
			var lp = $(this).parent().parent().parent();
			var ids = $('td:eq(0)', lp).html();		
			
			$.post("<?php echo site_url();?>/admin/dLocalDocs", { id: ids })
			.success(function(response){ 
				if(response)
				{
					location.reload();
				}	
				else
				{
					$(that).html('Error');
				}				
			});
			
			return false;
		});
	});
	
	$('.delInterDocs').each(function(){
		$(this).click(function(){
			var that = $(this);
			$(that).html('please wait...');
			var lp = $(this).parent().parent().parent();
			var ids = $('td:eq(0)', lp).html();		
			
			$.post("<?php echo site_url();?>/admin/dInterDocs", { id: ids })
			.success(function(response){ 
				if(response)
				{
					location.reload();
				}	
				else
				{
					$(that).html('Error');
				}				
			});
			
			return false;
		});
	
	});
	
	$('.delOtherFees').each(function(){
		$(this).click(function(){
			var that = $(this);
			$(that).html('please wait...');
			var lp = $(this).parent().parent().parent();
			var ids = $('td:eq(0)', lp).html();		
			
			$.post("<?php echo site_url();?>/admin/dOtherFees", { id: ids })
			.success(function(response){ 
				if(response)
				{
					location.reload();
				}	
				else
				{
					$(that).html('Error');
				}				
			});
			
			return false;
		});
	});
	
	
	
	
	
	$('.control_lp').click(function(){
		$('.edit_lp').removeClass('hide');
		$('.edit_ip').addClass('hide');
		$('.edit_ld').addClass('hide');
		$('.edit_id').addClass('hide');
		$('.edit_of').addClass('hide');
		return false;
	});
	
	$('.control_ip').click(function(){
		$('.edit_lp').addClass('hide');
		$('.edit_ip').removeClass('hide');
		$('.edit_ld').addClass('hide');
		$('.edit_id').addClass('hide');
		$('.edit_of').addClass('hide');
		return false;
	});
	
	$('.control_ld').click(function(){
		$('.edit_lp').addClass('hide');
		$('.edit_ip').addClass('hide');
		$('.edit_ld').removeClass('hide');
		$('.edit_id').addClass('hide');
		$('.edit_of').addClass('hide');
		return false;
	});
	
	$('.control_id').click(function(){
		$('.edit_lp').addClass('hide');
		$('.edit_ip').addClass('hide');
		$('.edit_ld').addClass('hide');
		$('.edit_id').removeClass('hide');
		$('.edit_of').addClass('hide');
		return false;
	});
	
	$('.control_of').click(function(){
		$('.edit_lp').addClass('hide');
		$('.edit_ip').addClass('hide');
		$('.edit_ld').addClass('hide');
		$('.edit_id').addClass('hide');
		$('.edit_of').removeClass('hide');
		return false;
	});
	
	
});

</script>	
	
	
</body>

</html>