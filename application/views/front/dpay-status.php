<script>
/**
*
*  Secure Hash Algorithm (SHA1)
*  http://www.webtoolkit.info/
*
**/

	function SHA1 (msg) {

		function rotate_left(n,s) {
			var t4 = ( n<<s ) | (n>>>(32-s));
			return t4;
		};

		function lsb_hex(val) {
			var str="";
			var i;
			var vh;
			var vl;

			for( i=0; i<=6; i+=2 ) {
				vh = (val>>>(i*4+4))&0x0f;
				vl = (val>>>(i*4))&0x0f;
				str += vh.toString(16) + vl.toString(16);
			}
			return str;
		};

		function cvt_hex(val) {
			var str="";
			var i;
			var v;

			for( i=7; i>=0; i-- ) {
				v = (val>>>(i*4))&0x0f;
				str += v.toString(16);
			}
			return str;
		};


		function Utf8Encode(string) {
			string = string.replace(/\r\n/g,"\n");
			var utftext = "";

			for (var n = 0; n < string.length; n++) {

				var c = string.charCodeAt(n);

				if (c < 128) {
					utftext += String.fromCharCode(c);
				}
				else if((c > 127) && (c < 2048)) {
					utftext += String.fromCharCode((c >> 6) | 192);
					utftext += String.fromCharCode((c & 63) | 128);
				}
				else {
					utftext += String.fromCharCode((c >> 12) | 224);
					utftext += String.fromCharCode(((c >> 6) & 63) | 128);
					utftext += String.fromCharCode((c & 63) | 128);
				}

			}

			return utftext;
		};

		var blockstart;
		var i, j;
		var W = new Array(80);
		var H0 = 0x67452301;
		var H1 = 0xEFCDAB89;
		var H2 = 0x98BADCFE;
		var H3 = 0x10325476;
		var H4 = 0xC3D2E1F0;
		var A, B, C, D, E;
		var temp;

		msg = Utf8Encode(msg);

		var msg_len = msg.length;

		var word_array = new Array();
		for( i=0; i<msg_len-3; i+=4 ) {
			j = msg.charCodeAt(i)<<24 | msg.charCodeAt(i+1)<<16 |
			msg.charCodeAt(i+2)<<8 | msg.charCodeAt(i+3);
			word_array.push( j );
		}

		switch( msg_len % 4 ) {
			case 0:
				i = 0x080000000;
			break;
			case 1:
				i = msg.charCodeAt(msg_len-1)<<24 | 0x0800000;
			break;

			case 2:
				i = msg.charCodeAt(msg_len-2)<<24 | msg.charCodeAt(msg_len-1)<<16 | 0x08000;
			break;

			case 3:
				i = msg.charCodeAt(msg_len-3)<<24 | msg.charCodeAt(msg_len-2)<<16 | msg.charCodeAt(msg_len-1)<<8	| 0x80;
			break;
		}

		word_array.push( i );

		while( (word_array.length % 16) != 14 ) word_array.push( 0 );

		word_array.push( msg_len>>>29 );
		word_array.push( (msg_len<<3)&0x0ffffffff );


		for ( blockstart=0; blockstart<word_array.length; blockstart+=16 ) {

			for( i=0; i<16; i++ ) W[i] = word_array[blockstart+i];
			for( i=16; i<=79; i++ ) W[i] = rotate_left(W[i-3] ^ W[i-8] ^ W[i-14] ^ W[i-16], 1);

			A = H0;
			B = H1;
			C = H2;
			D = H3;
			E = H4;

			for( i= 0; i<=19; i++ ) {
				temp = (rotate_left(A,5) + ((B&C) | (~B&D)) + E + W[i] + 0x5A827999) & 0x0ffffffff;
				E = D;
				D = C;
				C = rotate_left(B,30);
				B = A;
				A = temp;
			}

			for( i=20; i<=39; i++ ) {
				temp = (rotate_left(A,5) + (B ^ C ^ D) + E + W[i] + 0x6ED9EBA1) & 0x0ffffffff;
				E = D;
				D = C;
				C = rotate_left(B,30);
				B = A;
				A = temp;
			}

			for( i=40; i<=59; i++ ) {
				temp = (rotate_left(A,5) + ((B&C) | (B&D) | (C&D)) + E + W[i] + 0x8F1BBCDC) & 0x0ffffffff;
				E = D;
				D = C;
				C = rotate_left(B,30);
				B = A;
				A = temp;
			}

			for( i=60; i<=79; i++ ) {
				temp = (rotate_left(A,5) + (B ^ C ^ D) + E + W[i] + 0xCA62C1D6) & 0x0ffffffff;
				E = D;
				D = C;
				C = rotate_left(B,30);
				B = A;
				A = temp;
			}

			H0 = (H0 + A) & 0x0ffffffff;
			H1 = (H1 + B) & 0x0ffffffff;
			H2 = (H2 + C) & 0x0ffffffff;
			H3 = (H3 + D) & 0x0ffffffff;
			H4 = (H4 + E) & 0x0ffffffff;

		}

		var temp = cvt_hex(H0) + cvt_hex(H1) + cvt_hex(H2) + cvt_hex(H3) + cvt_hex(H4);

		return temp.toLowerCase();

		}

		function getWords() {
			var msg = document.OneCheckoutTester.MALLID.value + document.OneCheckoutTester.SHAREDKEY.value + document.OneCheckoutTester.TRANSIDMERCHANT.value;
			 document.OneCheckoutTester.WORDS.value = SHA1(msg);
		}

	</script>
<div class='min-height'>
	<div class='container'>
		<div class='row'>
			<div class='col-sm-12'>
			</div>
		</div>
		<div class='row'>
		<br><br>
			<div class='col-sm-offset-3 col-sm-6'>
				<h2 class="head blue" align='center'>Payment Status</h2>
				<br>

				<?php
					if(count($order) > 0 ){
						$member = $this->model_global->get_data(array('data' => 'row','table' => 'member', 'where' => array( 'id_member' =>$order['id_member'])));
						if($order['paid']=="1"){
							echo "<div class='alert alert-success' align='center'><h3><i class='fa fa-check'></i> Pembayaran Berhasil</h3></div>";
							$bank = $this->model_global->get_data(array('data' => 'row','table' => 'doku_payment_channel', 'where' => array( 'code' =>$order['PAYMENTCHANNEL'])));

							echo "<div align='center'><img src='".base_url()."uploads/bank/".$bank['image']."' class='img-responsive'></div><br>";
							echo "<br>
								<table width='100%' class='table'>
									<tr>
										<td colspan='2' align='center'>Payment Code<br>
										<h3>$order[PAYMENTCODE]</h3>
										</td>

									</tr>
									<tr>
										<td>Amount</td>
										<td align='right'><b>IDR $order[AMOUNT]</b></td>
									</tr>
									<tr>
										<td>Invoice Number</td>
										<td align='right'><b>$order[inv]</b></td>
									</tr>
									<tr>
										<td>Order Date</td>
										<td align='right'><b>".namadatetime($order['created_date'])."</b></td>
									</tr>
									<tr>
										<td>Request Order Date</td>
										<td align='right'><b>".namadatetime($order['request_pay'])."</b></td>
									</tr>
									<tr>
										<td><blink>Paid Date</blink></td>
										<td align='right'><blink><b>".namadatetime($order['paid_date'])."</b></blink></td>
									</tr>
								</table>
								<br>
							";
						}else if($order['paid']=="2"){
							$wordcek = sha1($eo['mallid'].$eo['sharedkey'].$order['inv']);
							if($order['expired_pay'] < date("Y-m-d H:i:s")){
								echo "<div class='alert alert-danger' align='center'><h3><i class='fa fa-times'></i> Status Pembayaran Telah Kadaluarsa</h3></div>";
							}else{
								echo "<div class='alert alert-warning' align='center'><h3><i class='fa fa-shopping-cart'></i> Silahkan Untuk Melakukan Pembayaran</h3></div>";
							}
							/*echo "<div class='alert alert-info' align='center'><h3><i class='fa fa-shopping-cart'></i> Check status pembayaran</h3>";
							echo"<form name='checkstatus' id='checkstatus' method=post action='https://staging.doku.com/Suite/CheckStatus'>
									<input type='text' name='MALLID' value='".$website['malid']."'/>
									<input type='text' name='SHAREDKEY' value='".$website['sharedkey']."'/>
									<input type='text' name='CHAINMERCHANT' value='NA'/>
									<input type='text' name='TRANSIDMERCHANT' value='$order[inv]'/>
									<input type='text' name='SESSIONID' value='$order[SESSIONID]'>
									<input type='text' id='WORDS' name='WORDS' value='$wordcek'/>
									<input type='submit' value='Klik Disini' class='btn btn-md btn-info btncekstatus'>
								</form>";*/
							//echo  "</div>";
							$bank = $this->model_global->get_data(array('data' => 'row','table' => 'doku_payment_channel', 'where' => array( 'code' =>$order['PAYMENTCHANNEL'])));
							echo "<div align='center'><img src='".base_url()."uploads/bank/".$bank['image']."' class='img-responsive'></div>";
							echo "<br>
								<table width='100%' class='table'>
									<tr>
										<td colspan='2' align='center'>Payment Code<br>
										<h3 style='font-family:dinbold;'>$order[PAYMENTCODE]</h3>
										</td>

									</tr>
									<tr>
										<td colspan='2'>Order Description
										<img src='".base_url()."uploads/ticket/$ticket[image]' class='img-responsive img-rounded desktop-image'>
										<img src='".base_url()."uploads/ticket/$ticket[image_mobile]' class='img-responsive img-rounded mobile-image'>
										<h4>$ticket[judul]</h4></td>
									</tr>
									<tr>
										<td>Amount</td>
										<td align='right'><b>IDR $order[AMOUNT]</b></td>
									</tr>
									<tr>
										<td>Invoice Number</td>
										<td align='right'><b>$order[inv]</b></td>
									</tr>
									<tr>
										<td>Order Date</td>
										<td align='right'><b>".namadatetime($order['created_date'])."</b></td>
									</tr>
									<tr>
										<td>Request Order Date</td>
										<td align='right'><b>".namadatetime($order['request_pay'])."</b></td>
									</tr>
									<tr>
										<td><blink>Expired Date</blink></td>
										<td align='right'><blink><b>".namadatetime($order['expired_pay'])."</b></blink></td>
									</tr>
								</table>
							";
						}
					}

					//MALLID+<sharedkey>+TRANSIDMERCHANT
					//$words = sha1($website['malid'].$website['sharedkey']."INV20190512SA00003");
				?>
			<!--<form action="https://staging.doku.com/Suite/CheckStatus" method="post" id="form1" name="form1"  data-parsley-validate  autocomplete="off">
				<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none" required>
				<input type=text name="MALLID" value="<?=$website['malid'];?>" required>
				<input type=text name="CHAINMERCHANT" value="NA" required>
				<input type=text name="TRANSIDMERCHANT" value="INV20190512SA00003" required>
				<input type=text name="SESSIONID" value="INV20190512SA00003305356771" required>
				<input type=text name="WORDS" value="<?=$words;?>" required>
				<input type='submit' class='btn btn-md btn-warning' value="Cek">
			</form>-->
			<?php
			if(count($order) > 0 ){
				if($order['paid']=="2"){
					if($order['expired_pay'] < date("Y-m-d H:i:s")){
						echo "<div align='center'><a href='".base_url()."profile' class='btn btn-lg btn-red'><i class='fa fa-user'></i> Back To Profile</a> </div>";
					}else{
					?>
					<form action="http://staging.doku.com/Suite/Receive" method="post" id="form1" name="form1"  data-parsley-validate  autocomplete="off">
						<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none" required>
						<input type=hidden name="MALLID" value="11304934" required>
						<input type=hidden name="WORDS" value="<?=$order['WORDS'];?>" required>
						<!--<input type=hidden name="BASKET" value="testing item,20000.00,2,10000.00" required> -->
						<input type=hidden name="BASKET" value="<?=$order['BASKET'];?>" required>
						<input type=hidden name="TRANSIDMERCHANT" value="<?=$order['inv'];?>" required>
						<input type=hidden name="CHAINMERCHANT" value="NA" required>
						<input type=hidden name="AMOUNT" value="<?=$order['AMOUNT'];?>" required>
						<input type=hidden name="PURCHASEAMOUNT" value="<?=$order['AMOUNT'];?>" required>
						<input type=hidden name="REQUESTDATETIME" value="<?=$order['PAYMENTDATETIME'];?>" required>
						<input type=hidden name="CURRENCY" value="360" required>
						<input type=hidden name="PURCHASECURRENCY" value="360" required>
						<input type=hidden name="SESSIONID" value="<?=$order['SESSIONID'];?>" required>
						<input type=hidden name="NAME" value="<?=$member['fullname'];?>" required>
						<input name="EMAIL" type="hidden" value="<?=$member['email'];?>" required>
						<input name="PAYMENTCHANNEL" type="hidden" value="<?=$order['PAYMENTCHANNEL'];?>" >
						<br>
					<div align='center'><a href='<?=base_url();?>profile' class='btn btn-lg btn-red'><i class='fa fa-user'></i> Back To Profile</a>
					<?php /*<button type='submit' class='btn btn-lg btn-red'>Pay Now!</button>*/;?>
					</div>
					</FORM>	<br>
					<?php
					}
					if($order['expired_pay'] < date("Y-m-d H:i:s")){

					}else{
						echo "<h3 align='center'>Cara Pembayaran</h3>".$bank['petunjuk'];
					}

					?>
			<?php
				}else{
					echo"<br><div align='center'>
						<a href='".base_url()."profile' class='btn btn-lg btn-red'><i class='fa fa-user'></i> Back To Profile</a>
					</div>";

				}
			}else{
				echo"<br><div align='center'>
					<a href='".base_url()."profile' class='btn btn-lg btn-red'><i class='fa fa-user'></i> Back To Profile</a>
				</div>";

			}

			?>
			</div>
			</div>
		</div>
	</div>
</div>
 <br><br>
<?php $this->load->view('front/podcast/footerfp');?>
<script>
	$(document).on('ready', function() {
		$("#checkstatus").submit(function (eve) {
			eve.preventDefault();


			var dataform = new FormData();
			var inputtxt = $('#checkstatus').serializeArray();
			for (var i = 0; i < inputtxt.length; i++) {
				dataform.append(inputtxt[i]["name"], inputtxt[i]["value"]);
			}
			dataform.append('<?php echo $this->security->get_csrf_token_name(); ?>', '<?php echo $this->security->get_csrf_hash(); ?>');
			$.ajax({
				type: "POST",
				data: dataform,
				dataType: "json",
				contentType: false,
				processData: false,
				url: "<?php echo base_url();?>dpay/checkstatus",
				//url: "https://staging.doku.com/Suite/CheckStatus",
				beforeSend: function () {
					$('.overlay-all').show();
					$('.btncekstatus').prop("disabled", true);
				},
				success: function (e) {
					$('.overlay-all').hide();
					$('.btncekstatus').prop("disabled", false);
					$('html, body').animate({ scrollTop: 50 }, 'slow');
					if(e.status=="true"){
					}else{
					}
				},
				error: function () {
					$('.overlay-all').hide();
					$('.btncekstatus').prop("disabled", false);
					alert('Failed..!!');
				}
			});

		});
	});
</script>
