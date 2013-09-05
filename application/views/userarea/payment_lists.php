

<div class="payment_wrapper">
<h3>Payment</h3>
<p>A payment <strong><?php echo $total_amount;?><?php if($pack=='local')echo ' Taka'; else echo ' USD'; ?></strong> is due for order number <strong><?php echo $order_id;?></strong></p>

<p>Please choose your preferred payment method from those listed below.
Please note that your order may not be completed until payment has cleared.</p>
	
	<div class="payment_options">	
		<ul>
			<li rel="1">Payment by Brac bank</li>
			<li rel="2">Payment by bKash account</li>
			<li rel="3">Pay using HSBC Bank account</li>
			<li rel="4">Instruction for payment pickup for your order</li>
			<li rel="5">Payment by western Union, Moneygram or Xpressmoney</li>
			<li rel="6">Pay by Courier Service or SA Paribahan</li>
		</ul>
		<?php
			echo form_open('orderpage/confirmation');
			echo form_input('p_choosed', '', 'class="hide"');
			echo form_input('p_pack', $pack, 'class="hide"');
			echo form_input('p_amount', $total_amount, 'class="hide"');
			echo form_input('p_sender', $sender, 'class="hide"');
			echo form_input('p_receiver', $recipent, 'class="hide"');
			echo form_submit('submit', 'Submit', 'class="cr_cabb btn btn-bluish payment_submit"');
			echo form_close();
		?>
	</div>
	
	<div class="checkout_paypal">
	<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
	<input type="hidden" name="cmd" value="_xclick">
	<input type="hidden" name="business" value="moinul548@yahoo.com">
	<input type="hidden" name="item_name" value="Homealbum | Order for print">
	<input type="hidden" name="currency_code" value="USD">
	<input type="hidden" name="amount" value="<?php echo $total_amount;?>">
	<input type="image" src="https://www.paypal.com/en_US/i/btn/btn_paynowCC_LG.gif" name="submit" alt="Make payments with PayPal - it's fast, free and secure!">	
	</form>
	
	<!--
	<a href="#" onclick="javascript:window.open('https://www.paypal.com/us/cgi-bin/webscr?cmd=xpt/cps/popup/OLCWhatIsPayPal-outside','olcwhatispaypal','toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=400, height=350');"><img src="https://www.paypal.com/en_US/i/bnr/horizontal_solution_PPeCheck.gif" border="0" alt="Solution Graphics"></a>	
	 -->
	</div>
	
</div>


<script>
$(function(){
	var prev = null;
	$('.payment_options li').click(function(){		
		if(prev != null)
		{
			prev.removeClass('selected');
		}
		$(this).addClass('selected');
		$('input[name="p_choosed"]').val($(this).attr('rel'));
		prev = $(this);
	});

});
</script>