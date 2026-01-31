<link href="<?php echo base_url()?>assets/front/css/designcompetition.css?r=<?=rand();?>" rel="stylesheet" />
<style>



</style>
<div class='page-designcompetition'>
	<section class='container-fluid bgbanner'>
		<div class='container'>
			<div class='row'>
				<div class='col-md-12'>
					<img src='<?=base_url();?>uploads/designcompetition/banner.jpg' class='img-responsive img-desktop' style='width:100%;'>
					<img src='<?=base_url();?>uploads/designcompetition/banner-mobile.jpg' class='img-responsive img-mobile' style='width:100%;'>
				</div>
			</div>
		</div>
	</section>
	<section class='container-fluid bgtnc'>

	</section>
	<section class='container-fluid tnc'>
		<div class='container'>
			<div class='row'>
				<div class='col-sm-4'>
					<div class ='head'>
						<h1>Design<br>Competition</h1>
						<h2>with</h2>
						<h3>DARBOTZ</h3>
					</div>
					<div style='font-size:25px;'>Periode submit karya :</div>
					<div class='bgperiode' style="margin-bottom: 30px">11 Mei - 10 Juni 2020</div>
					<!--<div style='font-size:18px;'>Pengumuman pemenang : 15 Juni 2020</div>-->
					<br>
					<br>
					<a href='<?=base_url();?>design-competition-download-template' class='btn btn-block btn-blue btn-lg'>Download Template</a>
					<br>
					<br>
					<?php
						$class = "kudu-login";
						if(!empty($this->datamember)){
							$class = "clickupload";
						}
					?>
					<!--<a href='javascript:void(0);' class='btn btn-block btn-blue btn-lg <?=$class;?>'>Upload File</a>-->
					<br>
					<br>
				</div>
				<div class='col-sm-2'>
				</div>
				<div class='col-sm-6'>
					Ekspresikan diri kalian, Ikutan Kreasi Donasi Design Competition!
					Sambil #EkspresiBaruDariRumah ,kalian juga bisa berdonasi karena design pemenang akan kita wujudkan menjadi Kreasi Donasi Box Set yang hasil penjualannya akan kita donasikan sebagai bentuk kepedulian terhadap dampak wabah covid 19
					<br><br>
					<b class='b'>Caranya :</b>
					<ul>
						<li>Registrasi peserta di wwww.authenticity.id</li>
						<li>Download template merchandise set yang akan di design.</li>
						<li>Kreasikan Design Box Set versi lo !</li>
						<li>Submit hasilnya di web Authenticity</li>
						<li>Periode kompetisi dimulai dari 11 May – 10 Juni 2020</li>
					</ul>
					<br>
					<b class='b'>Hadiah :</b>
					<ul>
						<li>Desain terbaik, uang senilai Rp 25.000.000 & Desain terpilih akan diimplementasikan menjadi Kreasi Donasi Box Set 2 berkolaborasi dengan @authenticity_id & @darbotz </li>
						<li>2 desain terpilih versi juri, uang senilai @ Rp 10.000.000.</li>
					</ul>
					<br>
					<b class='b'>Syarat & Ketentuan :</b>
					<ul>
						<li>Peserta dapat membuat lebih dari 1 desain.</li>
						<li>Peserta diwajibkan membuat kreasi atas 3 item produk (Box set, Tin Pack & Lighter.</li>
						<li>Peserta wajib membuat design produk (mock up) & design pola produksi sesuai template yang sudah disediakan.</li>
						<li>Pemenang harus followers IG @Authenticity_id & sudah melakukan registrasi di www.authenticity.id</li>
						<li>Informasi pemenang melalui story & feed IG @authenticity_id</li>
						<li>Pemenang desain terbaik, harus bersedia melakukan desain untuk kebutuhan produksi Box Set. Dan apabila tidak dapat terpenuhi, maka Juri berhak mengganti pemenang.</li>
						<li>Keputusan juri adalah mutlak, dan tidak dapat diganggu gugat.</li>
						<li>Pajak hadiah ditanggung pemenang</li>

					</ul>
				</div>
			</div>
		</div>
		<br>
		<br>
	</section>
	<section class='container-fluid gallery'>
		<div class='container'>
			<div class='row'>
				<div class='col-sm-12'>
					<h1 class='headgallery'>Gallery<br>Peserta</h1>

					<br>
					<div class='row'>
						<?php
						if(isset($design) && count($design) > 0){ foreach($design as $row){
							echo"
								<div class='col-sm-3'>
									<div class='boxgallery' style='padding:5px; height:250px;'>
										<br>
										<img class='clickthumb' src='".base_url()."uploads/designcompetition/thumb/".$row[$row['cover']]."' data-box='$row[box]' data-lighter='$row[lighter]' data-tincase='$row[tincase]' data-title='".$row['fullname']."' style='width:100%; cursor:pointer;'><br><br>
										<div class='namagallery'>$row[fullname]</div>
										<!--<div class='tglgallery'>".namadatetime($row['created_date'],FALSE)."</div>-->
									</div>
								</div>

							";
						}}
						?>
						<div class='cl'></div>
					</div>
					<br>
					<div class='row'>
						<div class='col-sm-4 col-sm-offset-4'>
							<!--<a href='' class='btn btn-block btn-blue btn-lg'>Karya Lainnya</a>-->
						</div>
					</div>
				</div>
			</div>
		</div>
		<br><br><br>
	</section>
</div>
<?php if(!empty($this->datamember)){?>
<div class="modal  fade" id="modalupload" tabindex="-1" role="dialog" aria-labelledby="order" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h2 align='center' class='auth' >FORM UPLOAD FILE</h2>
			</div>
			<form id="formupload" method="post" action="<?=base_url()."designcompetition"?>"  data-parsley-validate  autocomplete="off"  enctype="multipart/form-data">
				<div class="modal-body">
					<div id='status'></div>
					<input type="hidden" id='hash' name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
					<div class="form-group mhform">
						<div class="row">
							<div class="col-sm-5">
								<label class="control-label">Box <span class="text-danger">*</span></label>
								<br>
								<img id='prev-box' src='<?=base_url();?>uploads/no_image.png' class='img-thumbnail img-responsive' style='width:100%;'>
								<input id='imginp-box' data-target="prev-box" type='file' name='box' required class='form-control' accept="image/x-png,image/gif,image/jpeg">
							</div>
							<div class="col-sm-5">
								<label class="control-label">Box Cetak<span class="text-danger">*</span></label>
								<br>
								<img id='prev-box-cetak' src='<?=base_url();?>uploads/no_image.png' class='img-thumbnail img-responsive' style='width:100%;'>
								<input id='imginp-box-cetak' data-target="prev-box-cetak" type='file' name='box_cetak' required class='form-control' accept="image/x-png,image/gif,image/jpeg">
							</div>
							<div class="col-sm-2">
								<label class="control-label">Set Cover</label><br>
								<input type='radio' name='cover' class='form-conterol' value='box'/>
							</div>
						</div>
					</div>
					<div class='cl'></div>
					<hr>
					<div class="form-group mhform">
						<div class="row">
							<div class="col-sm-5">
								<label class="control-label">Lighter <span class="text-danger">*</span></label>
								<br>
								<img id='prev-lighter' src='<?=base_url();?>uploads/no_image.png' class='img-thumbnail img-responsive' style='width:100%;'>
								<input id='imginp-lighter' data-target="prev-lighter" type='file' name='lighter' required class='form-control' accept="image/x-png,image/gif,image/jpeg">
							</div>
							<div class="col-sm-5">
								<label class="control-label">Lighter Cetak<span class="text-danger">*</span></label>
								<br>
								<img id='prev-lighter-cetak' src='<?=base_url();?>uploads/no_image.png' class='img-thumbnail img-responsive' style='width:100%;'>
								<input id='imginp-lighter-cetak' data-target="prev-lighter-cetak" type='file' name='lighter_cetak' required class='form-control' accept="image/x-png,image/gif,image/jpeg">
							</div>
							<div class="col-sm-2">
								<label class="control-label">Set Cover</label><br>
								<input type='radio' name='cover' class='form-conterol' value='lighter'/>
							</div>
						</div>
					</div>
					<div class='cl'></div>
					<hr>
					<div class="form-group mhform">
						<div class="row">
							<div class="col-sm-5">
								<label class="control-label">Tincase <span class="text-danger">*</span></label>
								<br>
								<img id='prev-tincase' src='<?=base_url();?>uploads/no_image.png' class='img-thumbnail img-responsive' style='width:100%;'>
								<input id='imginp-tincase' data-target="prev-tincase" type='file' name='tincase' required class='form-control' accept="image/x-png,image/gif,image/jpeg">
							</div>
							<div class="col-sm-5">
								<label class="control-label">Tincase Cetak<span class="text-danger">*</span></label>
								<br>
								<img id='prev-tincase-cetak' src='<?=base_url();?>uploads/no_image.png' class='img-thumbnail img-responsive' style='width:100%;'>
								<input id='imginp-tincase-cetak' data-target="prev-tincase-cetak" type='file' name='tincase_cetak' required class='form-control' accept="image/x-png,image/gif,image/jpeg">
							</div>
							<div class="col-sm-2">
								<label class="control-label">Set Cover</label><br>
								<input type='radio' name='cover' class='form-conterol' value='tincase'/>
							</div>
						</div>
					</div>
					<div class='cl'></div>
				</div>
				<div class="modal-footer">
					<button type='submit' id="upload-button" class='btn btn-lg   btn-blue'>Submit & Upload</button>
					<button type="button" class="btn btn-lg btn-default" data-dismiss="modal">Close</button>
				</div>
			</form>
		</div>
	</div>
</div>
<?php }?>

<div class="modal  fade" id="thumbdesign" tabindex="-1" role="dialog" aria-labelledby="thumbdesign" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h2 align='center' class='auth' ></h2>
			</div>
			<div class="modal-body">
				<div class='row'>
					<div class='col-sm-4'>
						<b>Box</b><br>
						<img src='' class='img-responsive box' style='width:100%;'>
					</div>
					<div class='col-sm-4'>
						<b>Lighter</b><br>
						<img src='' class='img-responsive lighter' style='width:100%;'>
					</div>
					<div class='col-sm-4'>
						<b>Tincase</b><br>
						<img src='' class='img-responsive tincase' style='width:100%;'>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<?php $this->load->view('front/podcast/footerfp');?>
<script>
	$(document).on('ready', function() {
		$('.carousel').carousel();
		$('.clickthumb').click(function(){
			var title = $(this).attr('data-title');
			var box = $(this).attr('data-box');
			var lighter = $(this).attr('data-lighter');
			var tincase = $(this).attr('data-tincase');
			$('#thumbdesign .modal-header h2.auth').html(title);
			$('#thumbdesign').modal('show');
			$('#thumbdesign .modal-body img.box').attr('src','<?=base_url();?>uploads/designcompetition/'+box);
			$('#thumbdesign .modal-body img.lighter').attr('src','<?=base_url();?>uploads/designcompetition/'+lighter);
			$('#thumbdesign .modal-body img.tincase').attr('src','<?=base_url();?>uploads/designcompetition/'+tincase);
		});

		<?php if(!empty($this->datamember)){?>

			$('.clickupload').click(function(){
				$('#modalupload').modal({backdrop: 'static', keyboard: false});
				$('#upload-button').removeAttr("disabled");
			});
			$("#formupload").submit(function (eve) {
				event.preventDefault();
				$(this).attr("disabled", "disabled");
				var dataform = new FormData();
				dataform.append('<?php echo $this->security->get_csrf_token_name(); ?>', '<?php echo $this->security->get_csrf_hash(); ?>');
				var inputtxt = $('#formupload').serializeArray();
				for (var i = 0; i < inputtxt.length; i++) {
					dataform.append(inputtxt[i]["name"], inputtxt[i]["value"]);
				}
				dataform.append('box', $('input[type=file]')[0].files[0]);
				dataform.append('box-cetak', $('input[type=file]')[1].files[0]);
				dataform.append('lighter', $('input[type=file]')[2].files[0]);
				dataform.append('lighter-cetak', $('input[type=file]')[3].files[0]);
				dataform.append('tincase', $('input[type=file]')[4].files[0]);
				dataform.append('tincase-cetak', $('input[type=file]')[5].files[0]);
				$('#upload-button').html("Silahkan Tunggu ... ");
				$('#upload-button').prop('disabled', true);
				$('.overlay-all').show();
				$.ajax({
					type: "POST",
					data: dataform,
					dataType: "json",
					contentType: false,
					processData: false,
					url: "<?php echo base_url();?>designcompetition/upload",
					beforeSend: function () {
					},
					success: function (e) {
						$('#status').html(e.html);
						$('#upload-button').html("Submit & Upload");
						$('#upload-button').prop('disabled', false);
						$("#modalupload").scrollTop(0);
						$('.overlay-all').hide();
						$("#formupload")[0].reset();
						$('#prev-box, #prev-box-cetak, #prev-lighter, #prev-lighter-cetak, #prev-tincase, #prev-tincase-cetak').attr('src',"<?=base_url();?>uploads/no_image.png");
					},
					error: function () {
						$('#status').html("Error!");;
						$("#modalupload").scrollTop(0);
						$('.overlay-all').hide();
						$("#formupload")[0].reset();
						$('#prev-box, #prev-box-cetak, #prev-lighter, #prev-lighter-cetak, #prev-tincase, #prev-tincase-cetak').attr('src',"<?=base_url();?>uploads/no_image.png");
					}
				});

			});
		<?php }?>

	});
	function readURL(input,imgtarget) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();

			reader.onload = function (e) {
				$('#'+imgtarget).attr('src', e.target.result);
			}

			reader.readAsDataURL(input.files[0]);
		}
	}

	$("#imginp-box, #imginp-box-cetak, #imginp-lighter, #imginp-lighter-cetak, #imginp-tincase, #imginp-tincase-cetak").change(function(){
		var imgtar = $(this).attr("data-target");;
		readURL(this,imgtar);
	});
</script>
