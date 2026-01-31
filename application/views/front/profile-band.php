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
												<?php 
													if($member['fullname']!=''){
														$nama_mem=$member['fullname'];
													}else{
														$nama_mem=$member['username'];
													}
												?>
												<input type="text" class="form-control " required maxlength="100" placeholder="Entry Your Fullname" name="fullname" value="<?php echo ucwords($nama_mem);?>" autocomplete="off">
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
						<?php if(isset($data['id_soundroom']) && $data['id_soundroom'] != ''): ?>
						<div class="col-lg-8 col-md-10 mt-3">
							<div class="card card--shadow pt-3">
								<div class="panel-body">
									<div class='row'>
										<div class='col-sm-12'>
											<h3>My Band</h3>
											<?php if($_GET['info']) { ?>
												<div class="alert alert-info text-center" role="alert">
													<?php echo $_GET['info']; ?>
												</div>
											<?php } ?>
											<div class="panel panel-default box-login-1 mt-0 pt-5" style="box-shadow: 1px 3px 13px rgba(0, 0, 0, 0.25);">
												<form role="form" id="frmWrite" action="<?= base_url() ?>profile/updatesoundroom" method="post" data-parsley-validate enctype="multipart/form-data">
													<input type="hidden" name="created_by" value="<?=$data['created_by']?>" />
													<input type="hidden" name="_id" value="<?=$data['id_soundroom']?>" />
													<input type="hidden" name="img_awal" value="<?=$data['image']?>" />
													<input type="hidden" name="img_awal_thumbnail" value="<?=$data['thumbnail']?>" />
													<input type="hidden" name="img_awal_sound" value="<?=$data['sound']?>" />
													<div class="panel-body pt-5">
														<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
														<div id="lblStatusLogin">
															<?php $response = $this->session->flashdata('response');
															if (isset($response["status"]) && $response["status"] == "error") : ?>
																<div class="alert alert-danger" style='padding:10px;'>
																	<?= $response["message"] ?>
																</div>
															<?php endif; ?>
															<?php $response = $this->session->flashdata('response');
															if (isset($response["status"]) && $response["status"] == "success") : ?>
																<div class="alert alert-success" style='padding:10px;'>
																	<?= $response["message"] ?>
																</div>
															<?php endif; ?>
														</div>
														<div class="form-group">
															<label for="txtSahkoposti">Nama Band*</label>
															<input type="judul" class="form-control " id="judul" maxlength="150" placeholder="Nama Band" name="judul" required value='<?=(isset($data['judul']) ? $data['judul'] : '')?>'>
														</div>
														<div class="form-group">
															<label for="genre">Genre *</label>
															<select class="form-control" name="gendre" id="genre">
																<option value="">Pilih data</option>
																<option <?=(($data['gendre']=="rock") ? 'selected' : '')?> value="rock">Rock</option>
																<option <?=(($data['gendre']=="hiphop") ? 'selected' : '')?> value="hiphop">HipHop</option>
																<option <?=(($data['gendre']=="metal") ? 'selected' : '')?> value="metal">Metal</option>
																<option <?=(($data['gendre']=="pop") ? 'selected' : '')?> value="pop">Pop</option>
																<option <?=(($data['gendre']=="r&b") ? 'selected' : '')?> value="r&b">R&B</option>
																<option <?=(($data['gendre']=="blues") ? 'selected' : '')?> value="blues">Blues</option>
																<option <?=(($data['gendre']=="alternative") ? 'selected' : '')?> value="alternative">Alternative</option>
																<option <?=(($data['gendre']=="electronic") ? 'selected' : '')?> value="electronic">Electronic</option>
																<option <?=(($data['gendre']=="others") ? 'selected' : '')?> value="others">Others</option>
															</select>
														</div>
														<div class="form-group">
															<div class='row'>
																<div class='col-sm-6'>
																	<label for="fullname">Province*</label>
																	<select class='form-control rokok' name='id_provinsi' id="id_provinsi">
																		<option value=''>--</option>
																		<?php
																		if (isset($provinsi) && count($provinsi) > 0) {
																			foreach ($provinsi as $row) {
																				if ($row['provinsi'] != "-") {
																					echo "<option ".(($prov_selected['provinsi']==$row['provinsi']) ? 'selected' : '')." value='$row[provinsi]'>$row[provinsi]</option>";
																				}
																			}
																		}
																		?>
																	</select>
																	<!--<input type="text" maxlength="2" tabindex='7' name="id_provinsi" id="id_provinsi" autocomplete="off">-->
																</div>
																<div class='col-sm-6'>
																	<label for="fullname">City*</label>
																	<select class='form-control rokok' name='id_kota' id="id_kota">
																		<?php
																			if ($prov_selected) {
																				echo "<option value='$prov_selected[id_kota]'>$prov_selected[kota]</option>";
																			}
																		?>
																	</select>
																	<!--<input type="text" maxlength="2" tabindex='7' name="id_provinsi" id="id_provinsi" autocomplete="off">-->
																</div>

															</div>
														</div>

														<div class="form-group">
															<label for="pic">Nama PIC Band*</label>
															<input type="text" class="form-control " id="pic" maxlength="150" placeholder="Nama PIC" name="pic" required value='<?=(isset($data['pic']) ? $data['pic'] : '')?>'>
														</div>
														<div class="form-group">
															<label for="contact">Band Contact*</label>
															<input type="text" class="form-control " id="contact" maxlength="150" placeholder="No HP" name="contact" required value='<?=(isset($data['contact']) ? $data['contact'] : '')?>'>
														</div>
														<div class="form-group">
															<label for="instagram">Instagram Account</label>
															<input type="text" class="form-control " id="instagram" maxlength="150" placeholder="Instagram link" name="instagram" value='<?=(isset($data['instagram']) ? $data['instagram'] : '')?>'>
														</div>
														<div class="form-group">
															<label for="spotify">Spotify Link <i>(optional)</i></label>
															<input type="text" class="form-control " id="spotify" maxlength="150" placeholder="Spotify link" name="spotify" value='<?=(isset($data['spotify']) ? $data['spotify'] : '')?>'>
														</div>
														<div class="form-group">
															<label for="youtube">Youtube Channel Link <i>(optional)</i></label>
															<input type="text" class="form-control " id="youtube" maxlength="150" placeholder="Youtube link" name="youtube" value='<?=(isset($data['youtube']) ? $data['youtube'] : '')?>' >
														</div>

														<!--
														<div class="form-group">
															<label for="txtSahkoposti">Deskripsi</label>
															<textarea rows='15' class="form-control tinymce-editor"  name="deskripsi"></textarea>
														</div>
														<div class="form-group">
															<label for="txtSahkoposti">Sound Cover</label>
															<img id="prev-thumbnail" src="<?= base_url(); ?>uploads/no_image.png" alt="your thumbnail" class='img-responsive' style='cursor:pointer;'/>
															<input name="thumbnail" id="thumbnail" type="file" class="form-control"  accept="image/x-png,image/gif,image/jpeg">
															<em>*) Max. size image (1MB), 180px X 180px</em>
														</div>
														-->
														<div class="form-group">
															<label>Upload Foto Profil Band*</label>
															<div class="form-group--upload">
																<label for="image">
																	<?php if($data['image'] != ''): ?>
																		<img src='<?php echo base_url();?>uploads/soundroom/<?php echo $data['image'];?>' height='150' class='img'>
																	<?php else:?>
																		<img id="prev-image" src="<?= base_url(); ?>assets/front/img/upload-icon.png" alt="your image" class='img-responsive' style='cursor:pointer;' />
																	<?php endif?>
																	<input name="image" id="image" type="file" class="form-control" accept="image/x-png,image/gif,image/jpeg,image/tiff">
																	<span>or Drag and Drop files here</span>
																</label>
															</div>
															<em>* Maksimal file size 1MB. 180px x 180px. Format file : jpeg, png, atau tiff</em>
														</div>
														<div class="form-group">
															<label>Upload Sound Demo*</label>
															<div class="form-group--upload">
																<label for="sound">
																	<?php if(isset($data['id_soundroom']) && $data['id_soundroom'] != '' && $data['sound'] != ''): ?>
																		<a href='<?php echo base_url();?>uploads/soundroom/<?php echo $data['sound'];?>' target='_blank'><?php echo $data['sound'];?></a>
																	<?php else:?>
																		<img src="<?= base_url(); ?>assets/front/img/upload-icon.png" alt="your image" class='img-responsive' style='cursor:pointer;' />
																	<?php endif?>
																	<input name="sound" id="sound" type="file" class="form-control" accept=".mp3, .wav">
																	<span>or Drag and Drop files here</span>
																</label>
															</div>
															<em>* Maksimal file size 6MB. Format file : mp3 / wav</em>
														</div>
														<div class="form-group">
															<em>* harus diisi</em>
															<br>
															<input type="checkbox" class="" id="tnc" name="tnc" value="1" checked>
															<!-- <em>Kami bersedia musik yang kami unggah di sini, dapat digunakan untuk Clasmild dan diputar di Authenticity</em> -->
															<em>Saya adalah perokok dewasa berumur 18 tahun ke atas. Saya setuju musik dan foto saya dan/atau group saya, digunakan untuk keperluan Authenticity.id dan akan diputar dan ditayangkan di website, media sosial Authenticity, dan aset online/offline lainnya.</em>
														</div>
													</div>

													<div class="panel-footer pb-5" style='background-color:#FFFFFF; border: none; padding-top: 0;'>
														<div class="row">
															<div class="col-sm-12">
																<div class="btn-log1">
																	<button type="submit" id='btnWrite' name='submit' value='1' class="btn btn-primary text-uppercase">
																		Update
																	</button>
																</div>
															</div>
														</div>
													</div>
												</form>
											</div>
										</div>										
									</div>
								</div>
								<img src="<?php echo base_url() ?>assets/front/img/profile/bg.png" alt="BG" class="img-full" />
							</div>
						</div>
						<?php endif; ?>
					</div>
				</div>
			</section>
		</div>
	</main>
</div>
<div class="modal fade" id="modalSuccess" tabindex="-1" role="dialog" aria-labelledby="modalSuccess" aria-hidden="true">
	<div class="modal-dialog modal-dialog--alert">
		<div class="modal-content">
			<div class="modal-body">
				<h3>Selamat!</h3>
				<img src='<?= base_url(); ?>assets/front/img/soundroom/line.png' class="separator">
				<p>
					Musik lo berhasil di-update!<br />
					<a href="<?= base_url(); ?>soundroom">Klik di sini buat dengerin playlistnya</a>
				</p>

				<a href="<?= base_url(); ?>" class="btn btn-outline-light">BACK TO HOME</a>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="modalFailed2" tabindex="-1" role="dialog" aria-labelledby="modalFailed" aria-hidden="true">
	<div class="modal-dialog modal-dialog--alert">
		<div class="modal-content">
			<div class="modal-body">
				<p id="modalFailed2Message" class="error-message"></p>
				<button type="button" class="btn btn-outline-light" data-dismiss="modal">CLOSE</button>
			</div>
		</div>
	</div>
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

<!-- kusus soundroom -->
<script src="https://www.authenticity.id/assets/front/js/jquery.js" type="text/javascript"></script>
<script>
	$(document).on('ready', function() {
		$('#id_provinsi').change(function() {
			var prov = $(this).val();
			var dataform = new FormData();
			dataform.append('<?php echo $this->security->get_csrf_token_name(); ?>', '<?php echo $this->security->get_csrf_hash(); ?>');
			dataform.append('id', prov);
			dataform.append('search', prov);
			$.ajax({
				url: '<?= base_url() ?>home/combocity',
				type: "POST",
				dataType: "json",
				contentType: false,
				processData: false,
				data: dataform,
				beforeSend: function() {
					$('.overlay-all').show();
				},
				error: function() {
					$('.overlay-all').hide();
					alert('Failed..!!');
				},
				success: function(e) {
					$('.overlay-all').hide();
					$('#id_kota option').remove();
					$('#id_kota').append($("<option></option>").attr("value", "").text("--"));
					var dats = e.data;
					$.each(dats, function(i, item) {
						var ids = item.id_kota;
						var kotas = item.kota;
						$('#id_kota').append($("<option></option>").attr("value", ids).text(kotas));
					});
				}
			});

		});
		$("#frmWrite").submit(function(eve) {
			eve.preventDefault();
			var dataform = new FormData();
			var inputtxt = $('#frmWrite').serializeArray();
			for (var i = 0; i < inputtxt.length; i++) {
				dataform.append(inputtxt[i]["name"], inputtxt[i]["value"]);
			}
			var thumb = $('#thumbnail');
			var img = $('#image');
			var sound = $('#sound');
			// dataform.append('thumbnail', thumb[0].files[0]);
			dataform.append('image', img[0].files[0]);
			dataform.append('sound', sound[0].files[0]);
			dataform.append('submit', "1");
			dataform.append('<?php echo $this->security->get_csrf_token_name(); ?>', '<?php echo $this->security->get_csrf_hash(); ?>');
			$.ajax({
				type: "POST",
				data: dataform,
				dataType: "json",
				contentType: false,
				processData: false,
				url: "<?php echo base_url(); ?>profile/updatesoundroom",
				beforeSend: function() {
					$('.overlay-all').show();
					$('#btnWrite').prop("disabled", true);
					$('#lblStatusLogin').html("");
				},
				success: function(e) {
					$('.overlay-all').hide();
					$('#btnWrite').prop("disabled", false);
					$('html, body').animate({
						scrollTop: 50
					}, 'slow');
					if (e.status == "true") {
						$('#modalSuccess').modal({
							backdrop: 'static',
							keyboard: false
						});
						// window.location.reload();
						// // $('#lblStatusLogin').html("<div class='alert alert-success'>" + e.message + "</div>");
						// document.getElementById("frmWrite").reset();
						// $('#prev-thumbnail').attr('src', '<?= base_url(); ?>uploads/no_image.png');
						// $('#prev-image').attr('src', '<?= base_url(); ?>uploads/no_image.png');
					} else {
						$('#modalFailed2').modal({
							backdrop: 'static',
							keyboard: false
						});
						$('#modalFailed2Message').text(e.message)
						//$('#lblStatusLogin').html("<div class='alert alert-danger'>" + e.message + "</div>");
					}
				},
				error: function() {
					$('.overlay-all').hide();
					$('#btnWrite').prop("disabled", false);
					//alert('Failed..!!');
                    $('#modalFailed').modal({
                        backdrop: 'static',
                        keyboard: false
                    });
                    $('.error-message').text('Halo, data yang kamu submit belum lengkap. Dimohon untuk melengkapi semua data sesuai persyaratan yang sudah ada');
				}
			});
		});
	});
</script>