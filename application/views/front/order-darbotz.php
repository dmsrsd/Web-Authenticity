<?php
	//if($darbotz['banner']!=''){
?>
<style>

	.navbar{
		margin-bottom:0px;
	}

		.navbar-default ~ .min-height, .navbar-default ~ .container {
			top: 0px;
		}
		.min-height{
			padding-top:0px;
		}
		.affix ~ .min-height, .affix ~ .container{
			top:0px;
		}
	@media screen and (max-width:767px){
		.page-darbotz{
			margin-top:71px;
		}

	}
	.header-judul h1{
		font-size:40px;
		font-family:dinbold;
	}
	.header-judul h2{
		font-family:din;
		font-size:15px;
		margin-top:3px;
	}
	.header-judul h3{
		font-family:myriad;
		font-size:18px;
		margin-top:20px;
	}
	.header-judul{
		color:#ffffff;
		text-align:left;
	}
	.package-header{
		font-family:oswaldm;
		color:#0053A0;
		font-size:50px;
	}
	h2.package-header{
		font-family:oswaldm;
		color:#0053A0;
		font-size:30px;
	}
	.package p{
		font-family:din;
		font-size:20px;
	}
	.package{
		padding:50px 0px;
		backgrounds:url('<?=base_url();?>assets/front/img/darbotz-package-bg.jpg') center no-repeat;
		background-size:cover;
	}
	.bg-product{
		padding:50px 0px;
		background:url('<?=base_url();?>assets/front/img/darbotz-product-bg.jpg') center no-repeat;
		background-size:cover;
	}
	.bg-article{
		padding:15px;
	}
</style>
<div class='container-fluid page-darbotz'>
	<div class='row no-gutter'>
		<div class="col-md-12">
			<img src='<?=base_url()."uploads/darbotz/".$darbotz['banner'];?>' class='img-responsive' style='width:100%;'>

		</div>
		<div class="col-md-12" style="background: linear-gradient(#fff,#8d8c8c);">
			<div class='package'>
				<div class='container'>
					<div class='row'>
						<div class='col-sm-8'>
							<img src='<?=base_url()."uploads/darbotz/".$darbotz['banner2'];?>' class='img-responsive' style='width:100%;'>
						</div>
						<div class='col-sm-4'>
							<h1 class='package-header'>KREASI DONASI BOX SET</h1>
							<p><?=$darbotz['deskripsi'];?></p>
							<br>
							<h2 class='package-header'>IDR <?=number_format($darbotz['harga']);?></h2>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>
<?php //}?>

<?php
	/*
	if(isset($result) && count($result)>0){
		echo "<pre>";
		print_r($_POST);
		print_r($result);
		echo "</pre>";
	}
	*/
?>
<div class='min-height bg-product'>
	<div class='container'>
		<div class='row darbotz_pr'>
			<?php
				if($darbotz['product']!=''){
					$dec = json_decode($darbotz['product']);
					foreach($dec as $key=>$product){

						echo"
						<div class='col-sm-6' align='center' style='margin:15px 0px;'>
							<div class='bg-article'>
								<div class='product-div1'>
									<img src='".base_url()."uploads/darbotz/".$product->image."' class='img-responsive transition clickthumb' data-title='".$product->nama."' data-img='".$product->image."' style='width:100%;'>
								</div>
								<br>
								<h3 class='head'>
									<img src='".base_url()."assets/front/img/logocity.png' class='img-responsive' style='max-width:140px;'>X<br>
									".$product->nama."
								</h3>
								<p>".$product->deskripsi."</p>
							</div>
						</div>
						";
					}
				}
			?>

		</div>
		<div class='row'>
			<div class='col-md-4 col-md-offset-4'>
				<div align='center'>
					<br>
					<?php
						$btnlabel = "";
						if($darbotz['buy']==1){
							if($darbotz['buy_type']==0){
								$btnlabel="Pre Order";
							}else{
								$btnlabel="Buy Now";
							}
							if($darbotz['qty']>0){
								if(empty($this->datamember)){
									echo "<a href='javascript:void(0);' class='btn btn-lg btn-blue btn-block kudu-login'><i class='fa fa-shopping-cart'></i> $btnlabel</a>";
								}else{
									echo "<a href='javascript:void(0);' class='btn btn-lg btn-blue btn-block clickorder'><i class='fa fa-shopping-cart'></i> $btnlabel</a>";
								}
							}else{
								echo "<a href='javascript:void(0);' class='btn btn-lg btn-blue btn-block'><i class='fa fa-shopping-cart'></i> Stok Habis</a>";
							}
						}
					?>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal  fade" id="thumbdarbotz" tabindex="-1" role="dialog" aria-labelledby="thumbdarbotz" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h2 align='center' class='auth' ></h2>
			</div>
			<div class="modal-body">
				<img src='' class='img-responsive' style='width:100%;'>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<?php if(!empty($this->datamember)){ if($btnlabel!=""){?>
<div class="modal  fade" id="order" tabindex="-1" role="dialog" aria-labelledby="order" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h2 align='center' class='auth' >FORM PENGIRIMAN</h2>
			</div>
			<div class="modal-body">
				<form id="payment-form" method="post" action="<?=site_url()."order/".$darbotz['slug']?>"  data-parsley-validate  autocomplete="off">
					<input type="hidden" id='hash' name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
					<input type="hidden" name="result_type" id="result-type" value=""/>
					<input type="hidden" name="result_data" id="result-data" value=""/>

					<div class="form-group">
						<div class="row">
							<div class="col-sm-6">
								<label class="control-label">First Name <span class="text-danger">*</span></label>
								<input type='text' name='first_name' required value='<?=(isset($member['fullname']) ? $member['fullname'] : '')?>' class='form-control '>
							</div>
							<div class="col-sm-6">
								<label class="control-label">Last Name <span class="text-danger">*</span></label>
								<input type='text' name='last_name'  value='' class='form-control '>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-sm-6">
								<label class="control-label">HP <span class="text-danger">*</span></label>
								<input type='text' name='hp' required class='form-control' value='<?=(isset($member['hp']) ? $member['hp'] : '')?>' >
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class='row'>
							<div class='col-sm-6'>
								<label for="fullname">Province</label>
								<select class='form-control rokok' name='id_provinsi' id="id_provinsi"  required>
									<?php
										if(isset($provinsi) && count($provinsi) > 0){ foreach($provinsi as $row){
											echo "<option value='$row[provinsi]'>$row[provinsi]</option>";
										}}
									?>
								</select>
							</div>
							<div class='col-sm-6'>
								<label for="fullname">City</label>
								<select class='form-control rokok' name='id_kota' id="id_kota"  required>
									<option value=''>--</option>
								</select>
							</div>

						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-sm-6">
								<label class="control-label">Address <span class="text-danger">*</span></label>
								<textarea name='alamat' required  class='form-control' ><?=(isset($member['address']) ? $member['address'] : '')?></textarea>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-sm-6">
								<label class="control-label">Postal Code <span class="text-danger">*</span></label>
								<input type='number' name='kode_pos' required class='form-control' value='0' maxlength='5'>
							</div>
						</div>
					</div>
					<button type='submit' id="pay-button" class='btn btn-lg btn-block btn-blue'>Submit & Donate Now</button>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<?php }}?>
<script type="text/javascript" src="https://app.midtrans.com/snap/snap.js" data-client-key="<?=$website['mpaykey'];?>"></script>
<?php $this->load->view('front/podcast/footerfp');?>
<script>
	$(document).on('ready', function() {
		$('iframe').load( function() {
			$('iframe').contents().find("head").append($("<style type='text/css'>	#snap-body{overflow-x:hidden;}  </style>"));
		});

		<?php if(!empty($this->datamember)){ if($btnlabel!=""){?>

			$('.clickorder').click(function(){
				$('#order').modal({backdrop: 'static', keyboard: false});
				$('#pay-button').removeAttr("disabled");
			});
			$("#payment-form").submit(function (eve) {
			//$('#pay-button').click(function (event) {
				event.preventDefault();
				$(this).attr("disabled", "disabled");
				var dataform = new FormData();
				dataform.append('<?php echo $this->security->get_csrf_token_name(); ?>', '<?php echo $this->security->get_csrf_hash(); ?>');
				dataform.append('slug', '<?=$darbotz['slug'];?>');
				var inputtxt = $('#payment-form').serializeArray();
				for (var i = 0; i < inputtxt.length; i++) {
					dataform.append(inputtxt[i]["name"], inputtxt[i]["value"]);
				}
				$('#pay-button').html("Silahkan Tunggu ... ");
				$('#pay-button').prop('disabled', true);
				$('.overlay-all').show();
				$.ajax({
					url: '<?=base_url()?>mpay/token',
					type: "POST",
					//dataType: "json",
					contentType: false,
					processData: false,
					cache: false,
					data: dataform,
					success: function(datas) {
						//location = data;
						if(datas!=""){
							console.log('token = '+datas);

							var resultType = document.getElementById('result-type');
							var resultData = document.getElementById('result-data');

							function changeResult(type,datas){
								$("#result-type").val(type);
								$("#result-data").val(JSON.stringify(datas));
								//resultType.innerHTML = type;
								//resultData.innerHTML = JSON.stringify(data);
							}

							snap.pay(datas, {
							onSuccess: function(result){
								changeResult('success', result);
								console.log(result.status_message);
								console.log(result);
								$("#payment-form").submit();
								$('#pay-button').html(result.status_message+" ... ");
							},
							onPending: function(result){
								changeResult('pending', result);
								console.log(result.status_message);
								$("#payment-form").submit();
								$('#pay-button').html(result.status_message+" ... ");
							},
							onError: function(result){
								changeResult('error', result);
								console.log(result.status_message);
								$("#payment-form").submit();
								$('#pay-button').html(result.status_message+" ... ");
							}
							});
						}
					}
				});
			});
		<?php }}?>

		$('.clickthumb').click(function(){
			var title = $(this).attr('data-title');
			var img = $(this).attr('data-img');
			$('#thumbdarbotz .modal-header h2.auth').html(title);
			$('#thumbdarbotz .modal-body img').attr('src','<?=base_url();?>uploads/darbotz/'+img);
			$('#thumbdarbotz').modal('show');
		});

		$('#id_provinsi').change(function(){
			var prov = $(this).val();
			var dataform = new FormData();
			dataform.append('<?php echo $this->security->get_csrf_token_name(); ?>', '<?php echo $this->security->get_csrf_hash(); ?>');
			dataform.append('id', prov);
			dataform.append('search', prov);
			$.ajax({
				url: '<?=base_url()?>home/combocity',
				type: "POST",
				dataType: "json",
				contentType: false,
				processData: false,
				data: dataform,
				beforeSend: function () {
					$('.overlay-all').show();
				},
				error: function () {
					$('.overlay-all').hide();
					alert('Failed..!!');
				},
				success: function (e) {
					$('.overlay-all').hide();
					$('#id_kota option').remove();
					$('#id_kota').append($("<option></option>").attr("value","").text("--"));
					var dats = e.data;
					$.each(dats, function(i, item) {
						var ids = item.id_kota;
						var kotas = item.kota;
						$('#id_kota').append($("<option></option>").attr("value",ids).text(kotas));
					});
				}
			});

		});
	});
</script>
