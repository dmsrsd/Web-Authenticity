
<div class='min-height'>
	<div class='container'>
		<div class='row'>
			<div class='col-sm-12'>
			</div>
		</div>
		<div class='row'>
		<br><br>
			<div class='col-sm-6'>
				<h2 class="head blue" align='center'>Payment Redirect</h2>
				<br>
				<h3>Please Wait ...</h3>
				<div class='alert alert-danger'><h3>Don't close or refersh page !!</h3></div>

				<?php
				$order_number = $_POST['TRANSIDMERCHANT'];
				$purchase_amt = $_POST['AMOUNT'];
				$status_code = $_POST['STATUSCODE'];
				$words = $_POST['WORDS'];
				$paymentchannel = $_POST['PAYMENTCHANNEL'];
				$session_id = $_POST['SESSIONID'];
				$paymentcode = $_POST['PAYMENTCODE'];
				$redirect_url = base_url()."dpay/status/".$order_number;

				$dokuform="<form name=\"param_pass\" id=\"param_pass\" method=\"post\" action='".base_url()."dpay/result'>"; //example redirect link
				$dokuform.="<input name='".$this->security->get_csrf_token_name()."' type=\"hidden\" id='".$this->security->get_csrf_token_name()."' value='".$this->security->get_csrf_hash()."'>\n";
				$dokuform.="<input name=\"inv\" type=\"hidden\" id=\"inv\" value=\"$order_number\">\n";
				$dokuform.="<input name=\"AMOUNT\" type=\"hidden\" id=\"AMOUNT\" value=\"$purchase_amt\">\n";
				$dokuform.="<input name=\"STATUSCODE\" type=\"hidden\" id=\"STATUSCODE\" value=\"$status_code\">\n";
				$dokuform.="<input name=\"PAYMENTCHANNEL\" type=\"hidden\" id=\"PAYMENTCHANNEL\" value=\"$paymentchannel\">\n";
				$dokuform.="<input name=\"PAYMENTCODE\" type=\"hidden\" id=\"PAYMENTCODE\" value=\"$paymentcode\">\n";

				$dokuform.="</form>\n";
				$dokuform.="<script language=\"JavaScript\" type=\"text/javascript\">";
				$dokuform.="document.getElementById('param_pass').submit();";
				$dokuform.="</script>";

				//FIREFOX FIX
				$redirect_url = str_replace('&amp;', '&', $redirect_url);

				?>
				<body>
				<?php print $dokuform; ?>
				<noscript>
				If you are not redirected please <a href="<?php echo $redirect_url; ?>">click here</a> to confirm your order.
				</noscript>

			</div>
		</div>
	</div>
</div>

<?php $this->load->view('front/podcast/footerfp');?>
<script>
	$(document).on('ready', function() {
		$('.overlay-all').show();

	});
	jQuery(window).load(function () {
		$('.overlay-all').hide();
	});
</script>
