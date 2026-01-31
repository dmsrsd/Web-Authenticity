<div class="new-bs">
	<main class="main">
		<div class="page page-profile">
			<section class="py-5">
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-lg-8 col-md-10">
							<div class="card card--shadow">
								<form action="<?php echo base_url(); ?>profile/updateprofile" method="post" data-parsley-validate enctype="multipart/form-data">
									<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
									<div class="row">
										<div class="col-lg-auto">
											<div class="upload-avatar">
												<div class="upload-avatar__preview">
												<?php
													if($member['pp']!=""){
														$pp = base_url()."uploads/pp/".$member['pp'];
													}else{
														$pp = base_url()."uploads/nopp.png";
													}
												?>
													<img id="imagePreview" src="<?php echo $pp; ?>" alt="<?php echo ($member['fullname']);?>" />
												</div>
												<!-- Hidden file input -->
												<input type="file" name="pp" id="imageInput" accept="image/*" style="display: none;">

												<!-- Button to trigger file input -->
												<button type="button" class="upload-avatar__action" id="uploadButton"><i class="fa fa-pencil"></i></button>

											</div>
											<p class="page-profile__edit">Edit Profile <i class="fa fa-pencil"></i></p>
										</div>
										<div class="col-lg">
											<?php /*
											<h3>My Point</h3>
											<div class="panel panel-default panel-profile">
												<div class="panel-body">
													<div class='row'>
														<?php if($_GET['info']) { ?>
															<div class="col-sm-12">
																<div class="alert alert-info text-center" role="alert">
																	<?php echo $_GET['info']; ?>
																</div>
															</div>
														<?php } ?>
														<div class='col-sm-4'>
															<?php $i = 0;//cek data lebih besar 1
															if($data_silver['total'] > 0){ $i= $i+1; ?>
																<a href="<?= base_url('unlock/confirm/event'); ?>">
																	<img src="<?php echo base_url() ?>assets/front/img/profile/silver.png" width="100%" alt="">
																</a>
																<div class="label-bintang active">
																	<p><?php echo $data_silver['total'] ?> Event</p>
																</div>
															<?php }else{ ?>
																<a href="<?= base_url('unlock/confirm/event'); ?>">
																	<img src="<?php echo base_url() ?>assets/front/img/profile/silver-off.png" width="100%" alt="">
																</a>
																<div class="label-bintang">
																	<p>0 Event</p>
																	<a href="#" id="mytooltip" class="info-bintang" data-toggle="tooltip" title="Wah tinggal satu pin lagi nih kamu bisa dapatkan kesempatan raih bonus spesial. Ayo, beli merch lagi di channel digital Authenticity!!"> i </a>
																</div>
															<?php } ?>
														</div>	
														<div class='col-sm-4'>
															<?php //cek data redmax lebih besar 1
															if($data_redmax['total'] > 0){ $i= $i+1;?>
																<a href="<?= base_url('unlock/confirm/horeka'); ?>">
																	<img src="<?php echo base_url() ?>assets/front/img/profile/redmax.png" width="100%" alt="">
																</a>
																<div class="label-bintang active">
																	<p><?php echo $data_redmax['total'] ?> Horeka</p>
																</div>
															<?php }else{ ?>
																<a href="<?= base_url('unlock/confirm/horeka'); ?>">
																	<img src="<?php echo base_url() ?>assets/front/img/profile/redmax-off.png" width="100%" alt="">
																</a>
																<div class="label-bintang">
																	<p>0 Horeka</p>
																	<a href="#" id="mytooltip" class="info-bintang" data-toggle="tooltip" title="Wah tinggal satu pin lagi nih kamu bisa dapatkan kesempatan raih bonus spesial. Ayo, beli merch lagi di channel digital Authenticity!!"> i </a>
																</div>
															<?php } ?>
															<!-- <img src="<?php echo base_url() ?>assets/front/img/profile/redmax-off.png" width="100%" alt="">
															<div class="label-bintang">
																<p>0 Redmax</p>
																<a href="#" id="mytooltip" class="info-bintang" data-toggle="tooltip" title="Wah tinggal satu pin lagi nih kamu bisa dapatkan kesempatan raih bonus spesial. Ayo, beli merch lagi di channel digital Authenticity!!"> i </a>
															</div> -->
														</div>													
														<div class='col-sm-4'>
															<?php //cek data Purple lebih besar 1 
															if($data_purple['total'] > 0){ $i= $i+1;?>
																<a href="<?= base_url('unlock/confirm/lab'); ?>">
																	<img src="<?php echo base_url() ?>assets/front/img/profile/purple.png" width="100%" alt="">
																</a>
																	<div class="label-bintang active">
																	<p><?php echo $data_purple['total'] ?> Lab</p>
																</div>
															<?php }else{ ?>
																<a href="<?= base_url('unlock/confirm/lab'); ?>">
																	<img src="<?php echo base_url() ?>assets/front/img/profile/purple-off.png" width="100%" alt="">
																</a>
																	<div class="label-bintang">
																	<p>0 Lab</p>
																	<a href="#" id="mytooltip" class="info-bintang" data-toggle="tooltip" title="Wah tinggal satu pin lagi nih kamu bisa dapatkan kesempatan raih bonus spesial. Ayo, beli merch lagi di channel digital Authenticity!!"> i </a>
																</div>
															<?php } ?>
															<!-- <img src="<?php echo base_url() ?>assets/front/img/profile/purple-off.png" width="100%" alt="">
															<div class="label-bintang">
																<p>0 Purple</p>
																<a href="#" id="mytooltip" class="info-bintang" data-toggle="tooltip" title="Wah tinggal satu pin lagi nih kamu bisa dapatkan kesempatan raih bonus spesial. Ayo, beli merch lagi di channel digital Authenticity!!"> i </a>
															</div> -->
														</div>	
														<div class="col-sm-12 mt-3">
															<p class="label-kata-profil">Beli Product untuk bisa mengikuti bonus utama (lucky wheel).<br> Klik Bintang untuk Upload Resi</p><br>
															<?php if(($i >= 1)and(empty($cek_roulette))){ ?>
																<a href="<?php echo base_url('unlock/roulette'); ?>" class="btn btn-lucky-whell actived"> IKUTI  LUCKY WHELL </a>
															<?php }else{ ?>
																<a href="#" class="btn btn-lucky-whell"> IKUTI  LUCKY WHELL </a>
															<?php } ?>
														</div>												
													</div>
												</div>
											</div>
											*/ ?>
											<h3>My Profile</h3>
											<div class="form-group">
												<label>Full Name</label>
												<input type="text" class="form-control " required maxlength="100" placeholder="Entry Your Fullname" name="fullname" value="<?php echo ucwords($member['fullname']);?>" autocomplete="off">
											</div>
											<div class="form-group">
												<label for="email">Email </label>
												<input type="email" class="form-control " required maxlength="50" placeholder="ex: your@gmail.com" name="email" value="<?=$member['email'];?>" id="emailSignup" autocomplete="off">
											</div>
											<div class='row'>
												<div class='col-sm-6'>
													<div class="form-group">
														<label for="email">Gender</label>
														<select class='form-control' name='gender' required>
															<option value=''>--</option>
															<option value='male' <?php echo ($member['gender']=='male')? 'selected':''; ?> >Male</option>
															<option value='female' <?php echo ($member['gender']=='female')? 'selected':''; ?> >Female</option>
														</select>
													</div>
												</div>
												<div class='col-sm-6'>
													<div class="form-group">
														<label>Handphone</label>
														<input type="text" data-country="ID" class="form-control bfh-phone" data-format="+62 (ddd) ddd-dddd" required maxlength="13" placeholder="081234567891" name="hp" value="<?=$member['hp'];?>" id="hp" autocomplete="off">
													</div>
												</div>
											</div>
											<div class="form-group">
												<label for="password">Instagram Account</label>
												<input type="text" class="form-control " required maxlength="50" placeholder="@youraccount" autocomplete="off" name="instagram" value="<?=$member['instagram'];?>">
											</div>
											<div class="row mt-5">
												<!-- <div class="col-md-6">
													<button type="button" class="btn btn-outline-primary btn-sm d-block img-full">CANCEL</button>
												</div> -->
												<div class="col-md-6">
													<button type="submit" class="btn btn-primary btn-sm d-block img-full">UPDATE</button>
												</div>
											</div>
										</div>
									</div>
								</form>
								<img src="<?php echo base_url() ?>assets/front/img/profile/bg.png" alt="BG" class="img-full" />
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
	</main>
</div>

<script>
	// Get references to the input and image elements
	const imageInput = document.getElementById('imageInput');
	const imagePreview = document.getElementById('imagePreview');
	const uploadButton = document.getElementById('uploadButton');

	// Add a click event listener to the button
	uploadButton.addEventListener('click', function() {
		// Trigger a click event on the file input
		imageInput.click();
	});

	// Add a change event listener to the file input
	imageInput.addEventListener('change', function() {
		const file = imageInput.files[0];

		if (file) {
			// Read the selected image file and display it as a preview
			const reader = new FileReader();

			reader.onload = function(e) {
				imagePreview.src = e.target.result;
			};

			reader.readAsDataURL(file);
		} else {
			// If no file is selected, reset the src to the placeholder image
			imagePreview.src = '<?php echo base_url() ?>assets/front/img/profile/avatar.png'; // Replace with your placeholder image URL
		}
	});
</script>