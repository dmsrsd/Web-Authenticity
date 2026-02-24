<!DOCTYPE html>
<html>
    <?php $this->load->view("front/elite/head.php");?>
	<style>
		label {
			display: inline-block;
			max-width: 100%;
			margin-bottom: 5px;
			font-weight: normal;
			font-size: 14px!important;
			font-style: italic;
		}
		label a{
			color:blue;
			text-decoration: underline;
		}
		.tnc .row{
			margin: 5px 0;
		}
		input[type="email"] {
			margin: 4px 0 0;
			line-height: normal;
			border-color: #1c4e95;
		}
		@media (max-width: 767px) {
			button.btn.btn-link.text-but {
				font-size: 20px !important;
				margin-top: 0px !important;
				padding: 0px !important;
			}
		}
	</style>
<body class="circle h-full"> 
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5Q5GBNF" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WH8ZRXFD" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
	<form action="<?php echo base_url('elite/tncProses') ?>" method="post" data-parsley-validate enctype="multipart/form-data">
		<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
				
		<div class="container-full">
			<div class="row p-2">
				<div class="col-md-12 text-right2">
					<img src="<?php echo base_url('assets/elite-html') ?>/images/logo_small.png" class="">
				</div>
			</div>
		</div>
		<div class="container-full form-check"> 
				<div class="container pos-rel">
					<div class="merch01"><img src="<?php echo base_url('assets/elite-html') ?>/images/kaos.png" class=""></div>
					<div class="merch02"><img src="<?php echo base_url('assets/elite-html') ?>/images/merch2.png" class=""></div>
					<div class="row">
						<div class="col-md-12 box-head"></div>
							<div class="col-md-12 box-body tnc">
								<h4 class="text-left">DAPETIN TIKET PESTAPORA DAN BOXSET MERCHANDISE DARI AUTHENTICITY</h4>
								<div>
								<p style="display:none">Lo mau dapet elite experience dari Authenticity di konser yang mana?</p>
								<p style="display:none"><input type="radio" name="tnc_hadiah" value="1" style="margin-right: 2rem" >The Sounds Project </input></p>
								<p style="display:none"><input type="radio" name="tnc_hadiah" value="2" style="margin-right: 2rem" checked>Pestapora </input></p>
								<p style="display:none">*Isi data berikut supaya lo eligible buat dapetin exclusive merchandise dan elite experience dari Authenticity di konser paling hype di 2025. Langsung gas lengkapin form di bawah ini :</p>
								<p>**Isi data berikut supaya lo bisa dapetin rewards-nya :</p>
								</div>
								<div class="row">
									<div class="col-md-7">
										Email Authenticity &nbsp;&nbsp;
										<?php /* if(empty($this->datamember)){ ?>
										<a href="<?php echo base_url('login?to=elite/tnc') ?>"><span style="font-size: 0,3rem; font-style: italic; text-decoration: underline; color: rgba(67,152,244,1.00)">Login/sign up</span></a> *wajib isi
										<?php } */?>
									</div>
									<div class="col-md-5">
										<input type="email" class="form-control" name="email" maxlength="50" value="<?php echo $member['email'] ?>" <?php /* if(empty($this->datamember)){ ?>readonly<?php  } */ ?> required>
									</div>
								</div>
								<div class="row">
									<div class="col-md-7">
										Nomor WA (Buat info treatment premium dari Authenticity)
									</div>
									<div class="col-md-5">
										<input type="text" class="form-control" name="hp"  value="<?php echo $member['hp'] ?>" maxlength="50" <?php /* if(empty($this->datamember)){ ?>readonly<?php }  */?> required>
									</div>
								</div>
								<div class="row">
									<div class="col-md-7">
									IG Account (wajib follow @authenticity_id) &nbsp;<a href="https://instagram.com/authenticity_id" target="_blank"><img src="<?php echo base_url('assets/elite-html') ?>/images/ig-ic.png" class="ic-sosmed"></a>
									</div>
									<div class="col-md-5">
										<input type="text" class="form-control" name="instagram"  maxlength="50" value="<?php echo $member['instagram'] ?>" <?php /* if(empty($this->datamember)){ ?>readonly<?php }  */?> required>
									</div>
								</div>
								<div class="row">
									<div class="col-md-7">
									TikTok Account (wajib follow @authenticity_id) &nbsp;<a href="https://www.tiktok.com/@authenticity_id" target="_blank"> <img src="<?php echo base_url('assets/elite-html') ?>/images/tik-tok-ic.png" class="ic-sosmed"></a> 
									</div>
									<div class="col-md-5">
										<input type="text" class="form-control" name="tiktok"  maxlength="50" value="<?php echo $member['tiktok'] ?>" <?php /* if(empty($this->datamember)){ ?>readonly<?php }  */?> required>
									</div>
								</div>
								<div class="row">
									<div class="col-md-7">
										Upload Bukti Screenshot Kalo Lo Udah Subscribe YouTube @authenticity_id
									</div>
									<div class="col-md-5">
									<input type="file" name="buktiSubscribeYoutube" class="form-control" required="" accept="image/*" style="margin: 4px 0 0; line-height: normal; border-color: #1c4e95;"></div>
								</div>
								
								<div class="row">
									<div class="col-sm-12">
										<div class="form-check">
											<input class="form-check-input" type="checkbox" id="check1" name="tnc1" value="1" required="">
											<label class="form-check-label">Saya Menyetujui <a href="<?php echo base_url('tnc') ?>" target="_blank">Terms and Condition</a></label>
										</div>
										<div class="form-check">
											<input class="form-check-input" type="checkbox" id="check1" name="tnc2" value="1" required="">
											<label class="form-check-label">Saya Menyetujui <a href="<?php echo base_url('privacy') ?>" target="_blank">Personal Information Processor Privacy</a></label>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-12 box-foot"></div>
						</div>
						
					</div>
				</div>
				<div class="container">
					<div class="col-md-12 text-center">
						<div class="button-nav"> 
							<div class="row">
								<!--<div class="col-md-6 col-xs-6 text-center"><h3 class="text-but">
								<a href="<?php echo base_url('elite/home?tnc=0') ?>" id="skipLink">Skip >>
								</a></h3></div>-->
								<div class="col-md-12 col-xs-12 text-center">
								<button type="submit" class="btn btn-link text-but"style="color: #273478;font-size: 2.8rem;font-weight: 500;line-height: 5rem;text-align: center;text-decoration: none;margin-top: 13px;text-transform: none;font-family: &quot;Goldman&quot;, sans-serif;font-style: normal;">Submit >></button>
								</div>
							</div>
							
							
						</div>
					</div>
				</div>
		</div> 
	</form>
	<!--<div style="height:150px;">&nbsp;</div>-->
	<!-- content --> 
    <?php $this->load->view("front/elite/footer.php");?>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<?php $info = isset($_GET['info']) ? $_GET['info'] : null; ?>
	<?php if ($info): ?>
		<script>
			// Jalankan alert dari PHP
			Swal.fire({
				title: 'Pemberitahuan',
				html: <?= json_encode($info) ?>,
				icon: 'info'
			});
		</script>
	<?php endif; ?>
	<?php  if (!empty($this->datamember)) {  ?>
		<!-- //mongage halaman -->
		<script type="text/javascript">
			Moengage.track_event("Define your elite", {
				"email": "<?php echo $member['email'] ?>",
				"halaman": "tnc"
			});
		</script>
		<!-- //skip form -->
		<script>
			document.getElementById("skipLink").addEventListener("click", function(e) {
				e.preventDefault(); // Cegah langsung redirect

				const targetUrl = e.target.href;

				Moengage.track_event("Define your elite", {
				"email": "<?php echo $member['email'] ?>",
				"tombol": "skip"
				});

				setTimeout(function() {
				window.location.href = targetUrl;
				}, 300); 
			});
		</script>
		<!-- //next pages -->
		<script type="text/javascript">
			Moengage.track_event("Define your elite", {
				"email": "<?php echo $member['email'] ?>",
				"tombol": "skip"
			});
		</script>

		<!-- //submit form -->
		<script>
			document.getElementById("eliteForm").addEventListener("submit", function(e) {
			e.preventDefault(); // Mencegah submit langsung

			// Kirim event ke MoEngage
			Moengage.track_event("Define your elite", {
			"email": "<?php echo $member['email'] ?>",
			"tombol": "next"
			});

			// Tunggu sedikit agar event terkirim, lalu submit form
			setTimeout(() => {
				e.target.submit(); // Submit manual setelah tracking
				}, 300); 
			});
		</script>
	<?php } ?>

</body>
</html>