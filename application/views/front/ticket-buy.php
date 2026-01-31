<style>

</style>

<div class='min-height ticket-box' style='min-height:350px;'>
	<div class='container'>
		<div class='row'>
			<div class='col-sm-12'>
				<h2 class="head blue" align='center'>Ticket Box</h2>
			</div>
		</div>
		<br><br>
		<form action="<?=base_url()?>ticket/submitbuy" method="post" data-parsley-validate enctype="multipart/form-data" id='form-buy'>
			<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
			<input type="hidden" name="xcode" value="<?=$ticketitem['id_ticket'];?>">
			<div class='row'>
				<div class='col-sm-6'>
					<div class='box-ticket-buy'>
						<h3 style='margin-top:0px;'><?=$ticketitem['judul'];?></h3>
						<img src='<?=base_url()."uploads/ticket/".$ticketitem['image_mobile'];?>' class='img-responsive img-rounded mobile-image'>
						<img src='<?=base_url()."uploads/ticket/".$ticketitem['image'];?>' class='img-responsive img-rounded desktop-image'>
						<h3>Harga Ticket : Rp. <?=number_format($ticketitem['harga']);?></h3>
						<h4>Jumlah Pesanan :</h4>
						<select class='form-control' required name='qty' id='qty'>
							<?php
								for($x=1; $x<=$ticketitem['qty_online']; $x++){
									if($x<=2){
										echo "<option value='$x'>$x Tiket</option>";
									}
								}
							?>
						</select>
						<div align='left'>*) Maksimal pemesanan 4 tiket</div>
						<hr class='batas-ticket'/>
						<h3>Total Tagihan : Rp. <span id='total-pesanan'><?=number_format($ticketitem['harga']);?></span></h3>
					</div>
				</div>
				<div class='col-sm-6 '>
					<?php $response = $this->session->flashdata('response'); if(isset($response["status"]) && $response["status"] == "error"): ?>
						<div class="alert alert-danger" style='padding:10px;'>
							<?=$response["message"]?>
						</div>
					<?php endif; ?>

					<div class='form-buy'>
						<h2 >Isi Data 1</h2>
						<div class='form-group'>
							<div class="row">
								<div class="col-sm-4">
									<label class="control-label">Nama Lengkap <span class="text-danger">*</span></label>
								</div>
								<div class="col-sm-8">
									<input type='text' class='form-control' name='nama[]' placeholder='Nama Lengkap Anda' required>
								</div>
							</div>
						</div>
						<div class='form-group'>
							<div class="row">
								<div class="col-sm-4">
									<label class="control-label">Email <span class="text-danger">*</span></label>
								</div>
								<div class="col-sm-8">
									<input type='email' class='form-control' name='email[]' placeholder='emailanda@mail.com' required>
								</div>
							</div>
						</div>
						<div class='form-group'>
							<div class="row">
								<div class="col-sm-4">
									<label class="control-label">No. Whatsapp <span class="text-danger">*</span></label>
								</div>
								<div class="col-sm-8">
									<div class="input-group">
										<span class="input-group-addon">+62</span>
										<input type='text' id='hp' class='form-control' name='hp[]' placeholder='8111222333' required>
									</div>
									<div style='color:red; text-align:left; margin:5px 0px;'>*)*Pastikan data aktif dan sesuai karena Kami akan mengirimkan verifikasi tiket melalui whatsapp.</div>
								</div>
							</div>
						</div>
						<br><br>
						<div id='div-qty'>

						</div>
					</div>
					<div class='row'>
						<div class='col-sm-4 col-sm-offset-4'>
							<button class='btn btn-lg btn-block btn-blue' type='submit' name='buy' id='bayar' value='1'>Bayar</button>
						</div>
					</div>


				</div>
			</div>
		</form>
	</div>
</div>
<br><br><br><br><br><br>
<?php $this->load->view('front/podcast/footerfp');?>
<script>
	$(document).on('ready', function() {
		//$('.overlay-all').hide();
		$('#bayar').on('click', function(e) {
			$('.overlay-all').show();
		});
		$('#form-buy').on('submit', function(e) {
			$('.overlay-all').show();
		});

		$('#qty').change(function(){
			var val = $(this).val();
			if(val>1){
				var html="";
				for(var x=1; x<val;x++){
					var xx = x + 1;
					html+="<h2>Isi Data "+xx+"</h2>";
					html+="<div class='form-group'><div class='row'><div class='col-sm-4'><label class='control-label'>Nama Lengkap <span class='text-danger'>*</span></label></div><div class='col-sm-8'><input type='text' class='form-control' name='nama[]' placeholder='Nama Lengkap Anda' required></div></div></div>";
					html+="<div class='form-group'><div class='row'><div class='col-sm-4'><label class='control-label'>Email <span class='text-danger'>*</span></label></div><div class='col-sm-8'><input type='email' class='form-control' name='email[]' placeholder='emailanda@mail.com' required></div></div></div>";
					html+="<div class='form-group'><div class='row'><div class='col-sm-4'><label class='control-label'>No. Whatsapp <span class='text-danger'>*</span></label></div><div class='col-sm-8'><div class='input-group'><span class='input-group-addon'>+62</span><input type='text' id='hp' class='form-control' name='hp[]' placeholder='8111222333' required></div><div style='color:red; text-align:left; margin:5px 0px;'>*)*Pastikan data aktif dan sesuai karena Kami akan mengirimkan verifikasi tiket melalui whatsapp.</div></div></div></div>";
					html+="<br><br>";
				}
				$('#div-qty').html(html);
			}else{
				$('#div-qty').html('');
			}
		});
	});

	function setInputFilter(textbox, inputFilter) {
	  ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
		textbox.addEventListener(event, function() {
		  if (inputFilter(this.value)) {
			this.oldValue = this.value;
			this.oldSelectionStart = this.selectionStart;
			this.oldSelectionEnd = this.selectionEnd;
		  } else if (this.hasOwnProperty("oldValue")) {
			this.value = this.oldValue;
			this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
		  }
		});
	  });
	}
	setInputFilter(document.getElementById("hp"), function(value) {
		return /^\d*\.?\d*$/.test(value);
	});
</script>
