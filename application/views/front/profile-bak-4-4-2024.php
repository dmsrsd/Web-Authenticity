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