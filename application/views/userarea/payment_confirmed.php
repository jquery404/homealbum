<?php
	$value = null;
	$pack = ($pack == 'local') ? ' Tk' : 'USD';
	$amount = $total_amount. $pack; 
	if($payment_id != null)
	{
		switch($payment_id)
		{
			case 1:
				// brac bank
				$value="brac";
				break;
			case 2:
				// bKash bank
				$value="bkash";
				break;
			case 3:
				// HSBC bank
				$value="hsbc";
				break;
			case 4:
				// payment pickup bank
				$value="pickup";
				break;
			case 5:
				// western union bank
				$value="western";
				break;	
			case 6:
				// SA Paribahan
				$value="sa";
				break;	
			default:
				break;
				
		}
	}
?>

<br/><br/>

<div style="margin: auto; width: 900px; border: 2px solid #6678B1; background-color:#FFFFFF;">
	<div class="congrats">
		<p>Congratulations! Your order has been placed successfully.<br/>
		Thank you for using our service !</p>
	</div>
	
<table border="0" width="100%" align="center" cellpadding="4" cellspacing="0" style="table-layout: fixed;">
    <tr>
		<td colspan="2" align="left" valign="top" bgcolor="#FFDAD9" class="style7">
			<div align="center">
				<span style="font-weight: bold;">
				<span class="style2">Homealbum.org - Your online printing partner</span><br />
				</span>
			</div>
		</td>
    </tr>

	

	<tr>
		<td align="left" valign="top" class="style7">
			<strong>Order Date &amp; Time: </strong><br />
			Order of <?php echo $order_date; ?>
		</td>

		<td align="left" valign="top" class="style7">
			<strong><span class="style1">Order Number:</span> </strong><br />
			<?php echo $order_number; ?>
		</td>
	</tr>
	
	
	
    <tr>
		<td align="left" valign="top" bgcolor="#F2F2FF" class="style7">
			
			<div style="padding: 10px;">
				<table id="mycontactlist">
	
					<tr style="background: #d3d3d3;">
					<th style="padding: 0 10px;"><strong>Invoice to</strong></th>
					</tr>
					<?php foreach($sender as $key=>$con_list): ?>			
						<tr>
							
							<td id="mycon_name">	
								<?php 
								$tm=0;
								foreach($con_list as $i=>$c_list): 
									$tm++;	
									if($tm==1): 
										echo "<b>".$c_list."</b><br/>";
									else: 
										echo $c_list.", ";
									endif;
								endforeach;				
								?>	
							</td> 
						</tr>	
					<?php endforeach; ?>
				</table>
			</div>
		</td>



		<td align="left" valign="top" bgcolor="#F2F2FF" class="style7">
			
			<div style="padding: 10px;">
				<table id="mycontactlist">
	
					<tr style="background: #d3d3d3;">
					<th style="padding: 0 10px;"><strong>Deliver to</strong></th>
					</tr>
					<?php if(isset($extracon)): foreach($extracon as $key=>$con_list): ?>	
						<tr>							
							<td id="mycon_name">
							<?php 
								
									$tp=0;
									foreach($con_list as $i=>$c_list): 
										$tp++;	
										if($tp==1): 
											echo "<b>".$c_list."</b><br/>";
										else: 
											echo $c_list.", ";
										endif;
									endforeach;
								
							?>	
							</td> 
						</tr>	
					<?php endforeach; endif;?>
					
					<?php foreach($receiver as $key=>$con_list): ?>			
						<tr>
							
							<td id="mycon_name">	
								<?php 
								$tm=0;								
								foreach($con_list as $i=>$c_list): 
									$tm++;	
									if($tm==1): 
										echo "<b>".$c_list."</b><br/>";
									else: 
										echo $c_list.", ";
									endif;
								endforeach;								
								?>	
							</td> 
						</tr>	
					<?php endforeach; ?>
				</table>
			</div> 
		</td>
    </tr>



	
	
	<tr>
		<td colspan="2" align="left" valign="bottom" class="style4" style="padding: 0px;">
			<table width="100%" border="0" cellpadding="7" cellspacing="0" style="padding: 7px;">
				<!--
				<tr>
					<td class="style8"><strong>Product</strong></td>					
					<td class="style8"><strong>Qty</strong></td>
					<td align="right" class="style8"><strong>Price</strong></td>
				</tr>
				
				<tr>
					<td class="style8">Jock the ripper book.pdf</td>					
					<td class="style8">11</td>
					<td align="right" class="style8">4676.10Tk</td>
				</tr>
				
				
				<tr>
					<td class="style8">Jock the ripper book.pdf</td>					
					<td class="style8">14</td>
					<td align="right" class="style8">4676.10Tk</td>
				</tr>
				
				
				<tr>
					<td class="style8">Jock the ripper book.pdf</td>					
					<td class="style8">12</td>
					<td align="right" class="style8">4676.10Tk</td>
				</tr>
				 -->

				<tr>
					<td rowspan="6">&nbsp;</td>
					<td class="style8">Subtotal:</td>
					<td align="right" class="style8"><?php echo $amount; ?></td>
				</tr>
				
				
				
				<tr>
					<tr>
						<td class="style8">Discount:</td>
						<td align="right" class="style8">0.00Tk</td>
					</tr>
					
					<tr>
						<td class="style8">Total Tax:</td>
						<td align="right" class="style8">0.00Tk</td>
					</tr>
					
					<tr>
						<td class="style8" style="border-top: 1px solid #000000;"><strong>Grand Total:</strong></td>
						<td align="right" class="style8" style="border-top: 1px solid #000000;"><strong><?php echo $amount;?></strong></td>
					</tr>
				</tr>			
			</table>	
		</td>
	</tr>
</table>


</div>



<div class="instruction">

	<?php if($value=="brac"): ?>
	<div class="brac_bank">	
		<p>Please use internet banking to transfer the due amount to following BRAC bank account or go to
		any BRAC bank branch and deposit the due amount in our business account. We will e-mail and
		confirm the payment once we receive the fund. Please deposit in following BRAC account:</p>
		<table>
			<tr>
				<td>Bank Name</td>
				<td>BRAC Bank</td>
			</tr>
			
			<tr>
				<td>Name of Account holder</td>
				<td>Md Moinul Islam (Moin)</td>
			</tr>
			
			<tr>	
				<td>Account Number</td>
				<td>1506200366112001</td>
			</tr>	
				
			</tr>
		</table>
		
		<p>Visit http://www.bracbank.com and login to internet banking for online transfer.
		Visit this link to find a BRAC bank branch close to you: http://www.bracbank.com/branches.php?
		drgn=1</p>	
		
	</div>
	<?php elseif($value=="hsbc"): ?>
	<div class="hsbc_bank">
	
		<p>Please use internet banking to transfer the due amount to following HSBC bank account or go to any HSBC bank branch and deposit the due amount in our business account. We will e-mail and confirm the payment once we receive the fund. Please deposit in following HSBC account: </p>
	
		<table>
			<tr>
				<td>Bank Name</td>
				<td>HongKong Shanghai Banking Corporation (HSBC)</td>
			</tr>
			
			<tr>
				<td>Account Name</td>
				<td>MD MOINUL ISLAM</td>
			</tr>
			
			<tr>
				<td>Name of Account holder</td>
				<td>Md Moinul Islam (Moin)</td>
			</tr>
			
			<tr>	
				<td>Account Number</td>
				<td>007 110547 001 </td>
			</tr>	
				
			</tr>
		</table>
	</div>
	
	<?php elseif($value=="bkash"): ?>
	<div class="bkash_bank">		
		<p>There are two options to pay by bKash.</p>

		<h4>Option 1: Use your existing bKash account and mobile to pay OR go to a bKash point to make
		payment:</h4>

		From your existing bKash account:
		<ul>
			<li>Go to bKash Mobile Menu by dialing *247#</li>
			<li>Choose Payment</li>
			<li>Enter our Merchant bKash Account Number: 01727417345</li>
			<li>Enter the due amount of your order</li>
			<li>Enter your 16 digit order number as reference number</li>
			<li>Enter the counter number = 1</li>
			<li>Now enter your bKash Mobile Menu PIN to confirm</li>
		</ul>
		<p>Thats it ! You and we will receive a confirmation SMS from bKash. You will then receive an
		email confirmation from us.</p>
		<p>Your order will be processed for delivery after the payment is received.</p>

		<h4>Option 2: Register for bKash to open a new account and then pay for your order:</h4>

		<h5>First - Complete registration :</h5>
		
		<ul>
			<li>Go to any of your nearby bKash Agent along with -Your mobile phone</li>
			<li>A copy of your Photo ID (National ID/Passport/Driving License)</li>
			<li>2 copies of Passport size photographs</li>
			<li>Fill out the registration form and put your thumb print & signature properly. Please make
			sure that you have taken your copy (customer copy) from agent and preserve it for future
			reference.</li>
		</ul>

		<h5>Second - Activate new bKash account:</h5>
		You need to activate your bKash Mobile Menu. Follow the steps below to activate your mobile
		menu-
		<ul>
			<li>Go to bKash Mobile Menu by dialing *247#</li>
			<li>Choose Activate Mobile Menu</li>
			<li>Enter a new PIN for your bKash Account</li>
			<li>Enter the PIN again to confirm</li>
		</ul>	

		<h5>Third - Make Payment using new account:</h5>
		<ul>
			<li>Go to bKash Mobile Menu by dialing *247#
			<li>Choose "Payment"</li>
			<li>Enter our Merchant bKash Account Number: 01727417345</li>
			<li>Enter the due amount of your order</li>
			<li>Enter your 16 digit order number as reference number</li>
			<li>Enter the counter number = 1</li>
			<li>Now enter your bKash Mobile Menu PIN to confirm</li>
		</ul>
		<p>Thats it ! You will receive a confirmation message from bKash. Please keep your PIN secret all
		the times.</p>
		
	
	</div>
	
	
	<?php elseif($value=="western"): ?>
	<div class="western_bank">
		Please transfer due amount via Western union, MoneyGram or XpressMoney money
		transfer to our Dhaka office within 24 hours of placing the order.
		Please use following recipient details:

		
		<table>
			<tr>
				<td>Name</td>
				<td>MD MOINUL ISLAM</td>
			</tr>
			
			<tr>
				<td>Country</td>
				<td>Bangladesh</td>
			</tr>
			
			<tr>
				<td>Position</td>
				<td>Chief Coordinator, Homealbum.org</td>
			</tr>
			
			<tr>	
				<td>Address</td>
				<td>House no 540/6, Road no 12, Baridhara DOHS, Dhaka - 1206, Bangladesh.</td>
			</tr>
			
			<tr>	
				<td>Phone</td>
				<td>01727-417345</td>
			</tr>	
				
			</tr>
		</table>
		
		After the transfer, please email following details to info@homealbum.org
		<ul>
		<li>Western Union MTCN number (or MoneyGram/XpressMoney reference #):</li>
		<li>Exact amount that you have transferred (in BDT and your local currency):</li>
		<li>First name of sender in the transfer:</li>
		<li>Last name of sender in the transfer:</li>
		<li>Your address used in the transfer:</li>
		<li>Your phone number used in that transfer:
		OR, you can email us a scan copy/photo of the transfer receipt.</li>
		</ul>
		<p><strong>Note:The order will be processed once the payment is received, else it will be
		canceled if we do not receive payment information within 24 hours.</strong> </p>
	
	
	</div>
	
	<?php elseif($value=="sa"): ?>
	<div class="sa_parib_bank">
	
		<p>Please transfer due amount via any courier company (like sundarban,
		Continental) or SA Paribahan Money Transfer to our Dhaka office. You
		have to go to your closest courier company or SA Paribahan counter to do
		the transfer.</p>
		<p>Please use following recipient details:</p>
		
		<table>
			<tr>
				<td>Name</td>
				<td>MD MOINUL ISLAM</td>
			</tr>
			
			<tr>
				<td>Country</td>
				<td>Bangladesh</td>
			</tr>
			
			<tr>
				<td>Position</td>
				<td>Chief Coordinator, Homealbum.org</td>
			</tr>
			
			<tr>	
				<td>Address</td>
				<td>House no 540/6, Road no 12, Baridhara DOHS, Dhaka - 1206, Bangladesh.</td>
			</tr>
			
			<tr>	
				<td>Phone</td>
				<td>01727-417345</td>
			</tr>	
				
			</tr>
		</table>
			

		<p>After the transfer, please call 01727-417345 (Mr. Moin) or 01913-757549
		(Mr. Helal) to provide the transfer receipt number, amount details in that
		transfer and any other required details. You may email those details to
		info@homealbum.org as well.</p>
		
		<p>The order will be processed once the payment is received.</p>
	
	
	</div>
	
	<?php elseif($value == "pickup"):?>
		<p>Please contact Mr. Moin on 01727-417345 to inform where you would like our staff to meet you to collect the payment. Please notice that an additional charge has been added to the total cost for this pick-up service. Please contact us if you require any information.</p>
		<p>Make a note, pick-up payment option is available in Dhaka only, currently we do not offer pick-up payment facility in other cities.</p>

	<?php endif; ?>
	

</div>

<div style="text-align:center;"><?php echo anchor('cabinet/cabinate_files', 'Back To Cabinet Files', 'class="btn btn-bluish"');?></div>
