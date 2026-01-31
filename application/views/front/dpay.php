
<div class='min-height'>
	<div class='container'>
		<div class='row'>
			<div class='col-sm-12'>
			</div>
		</div>
		<br><br>
		<div class='row'>
		<br><br>
			<div class='col-sm-6'>
				<div class='box-ticket-buy'>
					<h3 style='margin-top:0px;'><?=$ticket['judul'];?></h3>
					<img src='<?=base_url()."uploads/ticket/".$ticket['image_mobile'];?>' class='img-responsive img-rounded mobile-image'>
					<img src='<?=base_url()."uploads/ticket/".$ticket['image'];?>' class='img-responsive img-rounded desktop-image'>
					<h4>Jumlah Pesanan :</h4>
					<select class='form-control' required name='qty' id='qty'>
						<option value='<?=$order['qty'];?>'><?=$order['qty'];?> Tiket</option>
					</select>
					<hr class='batas-ticket'/>

					<h3>Total Tagihan : Rp. <span id='total-pesanan'><?=number_format($order['AMOUNT']);?></span></h3>
				</div>
			</div>
			<div class='col-sm-6'>
				<h2 class="head blue" align='center'>Payment Method</h2>
				<br>

			<?php



				$merc = rand();
				$mb = sha1("55000"."11304934"."NtFK9e7u6Ua1"."INV20190812SA00006");
				//echo $mb;
				//$words = sha1("10000.0011304934eRePSaYw9JbJSaZyxLAvBJT9");
				$words = sha1("20000.0011304934bZD2lbKxfkCWSaZyxLAvBJT9".$merc);
				//echo $words;
				$date =  date("YmdHms");
				$words2 = sha1("20000.0011304934bZD2lbKxfkCWSaZyxLAvBJT91865692655");
				//WORDS = sha1 (AMOUNT + MALLID + Shared Key + TRANSIDMERCHANT )

			?>

				<!--<form action="https://pay.doku.com/Suite/Receive" method="post" id="form1" name="form1"  data-parsley-validate  autocomplete="off">-->
				<!--<form action="https://staging.doku.com/Suite/Receive" method="post" id="form1" name="form1"  data-parsley-validate  autocomplete="off">-->
				<form action="<?=$eo['urlpaydoku'];?>" method="post" id="form1" name="form1"  data-parsley-validate  autocomplete="off">
					<pre>
					<select class='form-control' name='PAYMENTCHANNEL' required id='channel'>
						<option value=''>-- Choose payment method --</option>
						<?php
							if(isset($paymentmethod) && count($paymentmethod) > 0){ foreach($paymentmethod as $row){
								$row['description'] = str_replace("VA","Virtual Account",$row['description']);
								$s = "";
								if($row['code']==$order['PAYMENTCHANNEL']){
									$s = "selected";
								}
								echo "<option $s value='$row[code]'>$row[description]</option>";
							}}
						?>
					</select>
					</pre>
					<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none" required>
					<input type=hidden name="MALLID" value="<?=$eo['mallid'];?>" required>
					<input type=hidden name="WORDS" id='dokwo' value="<?=$order['WORDS'];?>" required>
					<!--<input type=hidden name="BASKET" value="testing item,20000.00,2,10000.00" required> -->
					<input type=hidden name="BASKET" id='basket' value="<?=$order['BASKET'];?>" required>
					<input type=hidden name="TRANSIDMERCHANT" value="<?=$order['inv'];?>" required>
					<input type=hidden name="CHAINMERCHANT" value="NA" required>
					<input type=hidden name="AMOUNT" id='dokam' value="<?=$order['AMOUNT'];?>" required>
					<input type=hidden name="PURCHASEAMOUNT" id='dokam2' value="<?=$order['AMOUNT'];?>" required>
					<input type=hidden name="REQUESTDATETIME" value="<?=$order['PAYMENTDATETIME'];?>" required>
					<input type=hidden name="CURRENCY" value="360" required>
					<input type=hidden name="PURCHASECURRENCY" value="360" required>
					<input type=hidden name="SESSIONID" value="<?=$order['SESSIONID'];?>" required>
					<input type=hidden name="NAME" value="<?=$member['fullname'];?>" required>
					<input name="EMAIL" type="hidden" value="<?=$member['email'];?>" required>
					<!--<input name="PAYMENTCHANNEL" type="hidden" value="" >-->
					<br>
				<button type='submit' class='btn btn-lg btn-red btn-block' id='pay'>Pay Now!</button>
				</FORM>

				<!--<form action="https://staging.doku.com/Suite/CheckStatus" method="post" id="form2" name="form2">
					<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
					<input type=hidden name="MALLID" value="11304934">
					<input type=hidden name="CHAINMERCHANT" value="NA">
					<input type=hidden name="TRANSIDMERCHANT" value="SaZyxLAvBJT91865692655">
					<input type=hidden name="SESSIONID" value="234asdf2341865692655">
					<input type=hidden name="WORDS" value="<?=$words2;?>">
				<button type='submit' class='btn btn-md btn-success'>Cek status</button>
				</FORM>-->

			</div>
		</div>
	</div>
</div>

<?php $this->load->view('front/podcast/footerfp');?>
<script>
	$(document).on('ready', function() {
		if($('#channel').val()==""){
			$("#pay").attr("disabled", true);
		}
		$('#channel').change(function(){
			var opt = $(this).val();
			var inv = '<?=$order['inv'];?>';
			$("#pay").attr("disabled", true);
				var dataform = new FormData();
				dataform.append('<?php echo $this->security->get_csrf_token_name(); ?>', '<?php echo $this->security->get_csrf_hash(); ?>');
				dataform.append('kode', inv);
				dataform.append('channel', opt);
				$.ajax({
					type: "POST",
					data: dataform,
					dataType: "json",
					contentType: false,
					processData: false,
					url: "<?php echo base_url();?>dpay/changechannel",
					beforeSend: function () {
						$("#pay").attr("disabled", true);
						$("#pay").html("Loading ...");
					},
					success: function (e) {
						if(e.status=="true"){
							if(e.total!="0"){
								$('#total-pesanan').html(e.total);
								$('#dokam').val(e.dokam+".00");
								$('#dokam2').val(e.dokam+".00");
								$('#dokwo').val(e.WORDS);
								$('#basket').val(e.BASKET);
							}
						}else{
							alert(e.message);
						}
						$("#pay").html("Pay Now!");
						$("#pay").attr("disabled", false);
					},
					error: function () {
						alert('Fatal Error!!!');
					}
				});

		});
	});
</script>
