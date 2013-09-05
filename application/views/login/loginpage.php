<div class="title_pad_d"><h2>Member Login</h2></div>
<div id="signin-overlay-box">	
	<div class="login-overlay-header"></div>
	
	<div class="register-overlay-info">
	<div class="logomini_area left"></div>
	<div class="register-form-info left">
	
	<?php echo form_open('login/validate_login', array('class'=>'login_form')); ?>
	
	<div class="error_msgs">
	<p class="error"><?php if(isset($error_msg)) {echo $error_msg;} ?></p>
	</div>
	
	<div class="error_msgs">
	<?php echo validation_errors('<p class="error">'); 	?>
	</div>
	
	<?php echo form_input('username', '', 'placeholder="USERNAME"'); ?>
	
	<?php echo form_password('password', '', 'placeholder="PASSWORD"'); ?>
	<div class="login_util">
		
		<div class="right" style="padding: 0 0 10px 0;">
		<?php echo anchor('login/forget_password', 'Forget password', array('title' => 'Forget Password', 'class' => 'forget_pass')); ?>
		</div>
		<br class="clearfix"/>
		<?php echo form_submit(array('name' => 'submit', 'class' => 'login submit', 'value' => 'Login')); ?>
		
		
	</div>
	<?php
	echo form_close();
	echo "<div class='right'>" . anchor('login/signup', 'Not a member yet? Create Account', array('title' => 'Login to Homealbum', 'class' => 'signup')). "</div>";	
	?>
	</div>
	<span class="clear"></span>
	</div>
</div>
