<link href="<?php echo base_url()?>assets/front/css/podcast.css?rand=<?=rand();?>" rel="stylesheet" />  
<link href="<?php echo base_url()?>assets/front/css/newcampaign.css?r=<?=rand();?>" rel="stylesheet" />  
<link href="<?php echo base_url()?>assets/front/fullpage/fullpage.css?rand=<?=rand();?>" rel="stylesheet" />  
<style>
footer .text-left {
    margin-top: -2px;
}


</style>
<div class='page-newcampaign'>
	<section class='container-fluid bgbanner'>
		<div class='container'>
			<div class='row'>
				<div class='col-md-12'>
					<img src='<?=base_url();?>uploads/newcampaign/new_banner.png' class='img-responsive img-desktop' style='width:100%;'>
					<img src='<?=base_url();?>uploads/newcampaign/banner-mobile.png' class='img-responsive img-mobile' style='width:100%;'>
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
						<!--<h1>Design<br>Competition</h1>
						<h2>with</h2>
						<h3>DARBOTZ</h3>-->
						<img src='<?=base_url();?>uploads/newcampaign/art_logo.png' class='img-responsive img-desktop' style='width:100%;'>
					</div>
					<div style='font-size:25px;'>Periode submit karya :</div>
					<div class='bgperiode' style="margin-bottom: 30px">22 Sept - 22 Okt 2021</div>
					<!--<div style='font-size:18px;'>Pengumuman pemenang : 15 Juni 2020</div>-->
					<br>
					<br><!--
					<?php 
						$class = "kudu-login";
						if(!empty($this->datamember)){ 
							$class = "clickupload";
							echo "
							<a href='https://bit.ly/downloadmemorirasa' class='btn btn-block btn-blue btn-lg'>Download logo & template IG</a>
							";
						}else{
							echo "
							<a href='javascript:void(0);' class='btn btn-block btn-blue btn-lg $class'>Download logo & template IG</a>
							";
						}
					?>
					<br>-->
					<br>
					<!--<a href='javascript:void(0);' class='btn btn-block btn-blue btn-lg <?=$class;?>'>Upload File</a>-->
					<br>
					<br>
				</div>
				<div class='col-sm-2'>
				</div>
				<div class='col-sm-6'>
					<p>Hampir semua orang pasti punya memori dengan lagu <strong>'Matraman'</strong> yang dipopulerkan <strong>The Upstairs</strong>, mulai dari kisah LDR, inget tempat bikin skripsi atau keingetan selalu goyang karena elo adalah seorang Modern Darling. </p>

<p>Ceritain memori lo lewat sentuhan karya autentik dan dapetin kesempatan buat jadi Artwork Cover Single lagu Matraman versi akustik di Spotify!</p>
					<b class='b'>Caranya :</b>
					<ul>
						<li>Registrasi peserta di wwww.authenticity.id</li>
						<li>Download template cover single yang akan di design.</li>
						<li>Kreasikan cover single versi lo !</li>
						<li><strong>Peserta wajib melakukan posting Instagram dengan template yang telah ditentukan menggunakan hastag #IniAsliGue #MemoriRasaMatraman disertai tagging ke @Authenticity_id</strong></li>
						<li>Periode kompetisi dimulai dari 22 September – 22 Oktober 2021</li>
						<li>Pengumuman pemenang pada tanggal 29 Oktober 2021</li>

					</ul>
					<br> 
					<b class='b'>Hadiah :</b>
					<ul>
						<li>Desain terbaik, uang senilai Rp 25.000.000 & Desain terpilih akan menjadi Artwork Cover Single Upstairs-Matraman versi akustik di spotify serta akan diimplementasikan menjadi merchandise T – Shirt dan Sepatu Authenticity X The Upstairs X Beazt </li>
						<li>2 desain terpilih versi juri, uang senilai Rp 15.000.000. & Rp.10.000.000 serta akan diimplementasikan menjadi T-shirt dan Custom Tinpack</li>
					</ul>
					<br> 
					<b class='b'>Syarat & Ketentuan :</b>
					<ul>
						<li>Peserta dapat membuat lebih dari 1 desain.</li>
						<li>Peserta diwajibkan membuat kreasi atas cover art  single lagu Matraman.</li>
						<li>Peserta wajib memuat logo Authenticity X The Upstairs sesuai dengan logo yang dapat diberikan.</li>
						<li>Peserta wajib melakukan posting Instagram dengan template yang telah ditentukan menggunakan hastag #IniAsliGue #MemoriRasaMatraman disertai tagging ke @Authenticity_id.</li>
						<li>Pemenang wajib follow IG @Authenticity_id & sudah melakukan registrasi di <a href="<?php echo base_url() ?>">www.authenticity.id.</a></li>
						<li>Informasi pemenang melalui story & feed IG @authenticity_id.</li>
						<li>3 Design terbaik akan diimplementasikan menjadi kebutuhan komersil merchandise di Authenticity Lab.</li>
						<li>Pemenang desain terbaik, harus bersedia melakukan desain untuk kebutuhan produksi merchandise. Apabila tidak dapat terpenuhi, maka Juri berhak mengganti pemenang.</li>
						<li>Keputusan juri adalah mutlak, dan tidak dapat diganggu gugat.</li>
						<li>Pajak hadiah ditanggung pemenang.</li>
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
									<div class='boxgallery' style='padding:5px; height:270px;'>
										<br>
										<img class='clickthumb' src='".base_url()."uploads/newcampaign/thumb/".$row['box']."' data-box='$row[box]' data-title='".$row['fullname']."' style='width:100%; cursor:pointer;'><br><br>
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
<style>
@media screen and (max-width:767px){
	#modalupload .modal-dialog {
	  width: 100%;
	  height: 100%;
	  margin: 0;
	  padding: 0;
	}

	#modalupload .modal-content {
	  height: auto;
	  min-height: 100%;
	  border-radius: 0;
	}
	#modalupload .modal-footer{
		position: absolute;
		bottom: 0px;
		width: 100%;	
	}
	#prev-box{
		max-height: 300px;
		width:auto !important;
		margin:10px 0px;
	}
}
</style>
<div class="modal  fade" id="modalupload" tabindex="-1" role="dialog" aria-labelledby="order" aria-hidden="true">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<h2 align='center' class='auth' >FORM UPLOAD FILE</h2>
			</div>
			<form id="formupload" method="post" action="<?=base_url()."newcampaign"?>"  data-parsley-validate  autocomplete="off"  enctype="multipart/form-data">
				<div class="modal-body"> 
					<div id='status'></div>
					<input type="hidden" id='hash' name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
					<div class="form-group mhform">
						<div class="row">
							<div class="col-sm-12">
								<label class="control-label">Your Image <span class="text-danger">*</span></label>
								<br>
								<div align='center'>
									<img id='prev-box' src='<?=base_url();?>uploads/no_image.png' class='img-thumbnail img-responsive' style='width:100%;'>
									<input id='imginp-box' data-target="prev-box" type='file' name='box' required class='form-control' accept="image/x-png,image/gif,image/jpeg">
								</div>
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
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<h2 align='center' class='auth' ></h2>
			</div>
			<div class="modal-body">  
				<div class='row'>
					<div class='col-sm-12'>
						<b>Image</b><br>
						<img src='' class='img-responsive box' style='width:100%;'>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>				
		</div>
	</div>
</div>
<?php //$this->load->view('front/footer');?>
<?php $this->load->view('front/podcast/footerfp');?>
<script> 
	$(document).on('ready', function() {   
		//$('#stickymodal').modal('show');
		$('.kudu-login').click(function(){
			var href = $('#linklogin').attr('href') + '?to=memorirasamatraman';
			$('#linklogin').attr('href',href);
			$('#stickymodal').removeClass('hide');
			$('#stickymodal').modal({backdrop: 'static', keyboard: false});
		});		
		$('.carousel').carousel();
		$('.clickthumb').click(function(){
			var title = $(this).attr('data-title');
			var box = $(this).attr('data-box');
			var lighter = $(this).attr('data-lighter');
			var tincase = $(this).attr('data-tincase');
			$('#thumbdesign .modal-header h2.auth').html(title); 
			$('#thumbdesign').modal('show');
			$('#thumbdesign .modal-body img.box').attr('src','<?=base_url();?>uploads/newcampaign/'+box); 
		});		
		
		<?php if(!empty($this->datamember)){?> 
		
			$('.clickupload').click(function(){
				//$('#modalupload').modal({backdrop: 'static', keyboard: false});
				$('#modalupload').modal('show');
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
				$('#upload-button').html("Silahkan Tunggu ... ");
				$('#upload-button').prop('disabled', true);
				$('.overlay-all').show();
				$.ajax({
					type: "POST",
					data: dataform, 
					dataType: "json",
					contentType: false,
					processData: false,
					url: "<?php echo base_url();?>newcampaign/upload",
					beforeSend: function () { 
					},
					success: function (e) { 
						$('#status').html(e.html);
						$('#upload-button').html("Submit & Upload");
						$('#upload-button').prop('disabled', false);
						$("#modalupload").scrollTop(0);
						$('.overlay-all').hide();
						$("#formupload")[0].reset();
						$('#prev-box').attr('src',"<?=base_url();?>uploads/no_image.png");
					},
					error: function () { 
						$('#status').html("Error!");;
						$("#modalupload").scrollTop(0);
						$('.overlay-all').hide();
						$("#formupload")[0].reset();
						$('#prev-box').attr('src',"<?=base_url();?>uploads/no_image.png");
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

	$("#imginp-box").change(function(){
		var imgtar = $(this).attr("data-target");;
		readURL(this,imgtar);
	});	
</script>
