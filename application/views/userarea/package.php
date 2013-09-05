<h2>Select your Order</h2>
<ul class="choose">
	<li class="locals">Local Order</li>
	<li>International Order</li>
</ul>

<hr/>
<div class="local hide">
<h3>Local Order</h3>
<div class="block three">
<fieldset style="width:400px;">
	<legend>Sender Information</legend>
	
	<input type="text" value="Sender Name" />
	<input type="text" value="Address" />
	<input type="text" value="Contact Number" />
	<input type="text" value="Email Address" />
	<select>
		<option>Country</option>
	</select>
	<input type="checkbox" value="agree" checked>Terms and Conditions
	
</fieldset>


<fieldset style="width:400px;">
	<legend>Destination Information</legend>
	
	<input type="text" value="Recipient Name" />
	<input type="text" value="Address" />
	<input type="text" value="Contact Number" />
	<input type="text" value="Email Address" />
	<select>
		<option>Country</option>
	</select>
	
</fieldset>
</div>

<div class="block five" style="width:400px;">
<fieldset>
	<legend>Upload Stuff</legend>
	What do you want to upload
	<select>
		<option>Type</option>
		<option>PHOTOS</option>
		<option>DOCUMENTS</option>
		<option>MESSAGE</option>
	</select>
	<ul>
		
		<li>
			<p>PHOTOS</p>
			<select>
				<option>Size</option>
				<option>4R</option>
				<option>5R</option>
				<option>6R</option>
			</select>
			
			<select>
				<option>Type</option>
				<option>Color</option>
				<option>Black and White</option>		
			</select>
		</li>
		
		
		<li>
			<p>DOCUMENTS</p>
			<input type="file" />
			<input type="text" value="Number of pages in file" />
		</li>
		
		
		<li>
			<p>MESSAGE</p>
			
			<textarea>Maximum 250 words</textarea>
		</li>
	</ul>	
	
</fieldset>
</div>

<span class="clear"></span>
<?php 
echo form_open('orderpage/success');
echo form_submit('submit', 'Submit');
echo form_close();
?>
</div>



<div class="init hide">
<h3>International Order</h3>

<div class="block three">
<fieldset style="width:400px;">
	<legend>Sender Information</legend>
	
	<input type="text" value="Sender Name" />
	<input type="text" value="Address" />
	<input type="text" value="Contact Number" />
	<input type="text" value="Email Address" />
	<select>
		<option>Country</option>
	</select>
	<input type="checkbox" value="agree" checked>Terms and Conditions
	
</fieldset>



<fieldset style="width:400px;">
	<legend>Destination Information</legend>
	
	<input type="text" value="Recipient Name" />
	<input type="text" value="Address" />
	<input type="text" value="Contact Number" />
	<input type="text" value="Email Address" />
	<select>
		<option>Country</option>
	</select>
	
</fieldset>


</div>


<div class="block five" style="width:400px;">
<fieldset>
	<legend>Upload Stuff</legend>
	What do you want to upload
	<select>
		<option>Type</option>
		<option>PHOTOS</option>
		<option>DOCUMENTS</option>
		<option>MESSAGE</option>
	</select>
	<ul>
		
		<li>
			<p>PHOTOS</p>
			<select>
				<option>Package</option>
				<option>10 copies 4R (4"X6") photos + 3 copies 4R (4"X6") photos FREE + 1 pages (200 words) FREE : 2.50 USD</option>
				<option>20 copies 4R (4"X6") photos + 6 copies 4R (4"X6") photos FREE + 1 pages (200 words) FREE : 4.00 USD</option>
				<option>40 copies 4R (4"X6") photos + 10 copies 4R (4"X6") photos FREE + 1 pages (300 words) FREE : 7.00 USD</option>
			</select>
			
			<select>
				<option>Type</option>
				<option>Color</option>
				<option>Black and White</option>		
			</select>
		</li>
		
		
		<li>
			<p>DOCUMENTS</p>
			<input type="file" />
			<input type="text" value="Number of pages in file" />
		</li>
		
		
		<li>
			<p>MESSAGE</p>
			
			<textarea>Maximum 250 words</textarea>
		</li>
	</ul>	
	
</fieldset>
</div>


<span class="clear"></span>

<?php 
echo form_open('orderpage/success');
echo form_submit('submit', 'Submit');
echo form_close();
?>
</div>



<script>
$(document).ready(function(){
	$('.choose li').click(function(){
		if($(this).hasClass('locals'))
		{
			$('.local').removeClass('hide');
			$('.init').addClass('hide');
		}
		else
		{
			$('.init').removeClass('hide');
			$('.local').addClass('hide');
		}
	
	});
});
</script>