<div class="title_pad_d"><h2>Reset your Password</h2></div>
<div id="register-overlay-box">	
	<div class="login-overlay-header"></div>
	<div class="register-overlay-info">
		<?php echo form_open('login/validate_forget', array('class'=>'login_form')); ?>	
		<div class="error_msgs">
		<?php echo validation_errors('<p class="error">'); 	?>
		</div>
		<div class="error_msgs">
		<p class="error"><?php if(isset($error_msg)) {echo $error_msg;} ?></p>
		</div>	
		<?php echo form_input('uemail', '', 'placeholder="EMAIL ADDRESS"'); ?>
		<?php echo form_submit(array('name' => 'submit', 'class' => 'login submit', 'value' => 'Submit')); ?>
		<?php echo form_close(); ?>
		
		<div class="login_util">				
			<div class="right">or, <?php echo anchor("/login", "Sign in"); ?> / <?php echo anchor("login/signup", "Sign up"); ?></div>
			<span class="clear"></span>
			
		</div>
	</div>	
	
	
</div>	
