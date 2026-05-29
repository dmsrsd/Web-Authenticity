<style>
	.selectize-control.form-control {
		border: none;
	}

	.selectize-control.form-control.input-sm.single {
		padding: 0px;
	}

	.selectize-input {
		-webkit-border-radius: 0;
		-moz-border-radius: 0;
		border-radius: 0;
	}

	.selectize-dropdown.form-control {
		padding: 0px;
		height: auto;
	}
</style>
<link href="<?= base_url() ?>assets/selectize/selectize.default.css" rel="stylesheet" />
<br><br><br>

<div class="page-soundroom new-bs">
	<div class='min-height'>
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-8">
					<div class="panel-banner">
						<div class="panel-banner__img">
							<!-- TAMBAHKAN BANNER 2026 NANTI -->
						</div>
						<h1>Submit band lo, bawa sound lo ke stage dan tunjukin energi ‘Ini Asli Gue’ lewat musik lo!</h1>
						<input type="hidden" name="tahun_season" value="2026">
						<div class="panel-banner__title">
							<img src='<?= base_url(); ?>assets/front/img/soundroom/btn-register.png'>
						</div>
					</div>
					<div class="panel panel-default box-login-1 mt-0 pt-5" style="box-shadow: 1px 3px 13px rgba(0, 0, 0, 0.25);">
						<form role="form" id="frmWrite" action="<?= base_url() ?>profile/submitsound2026" method="post" data-parsley-validate enctype="multipart/form-data">
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
									<input type="text" class="form-control" id="judul" maxlength="150" placeholder="Nama Band" name="judul" value="<?= isset($band_old['judul']) ? $band_old['judul'] : '' ?>">
									<input type='hidden' name='slug' id='slug' value='<?= (isset($data['slug']) ? $data['slug'] : $band_old['slug']) ?>' class='form-control '>
								</div>
								<div class="form-group">
									<label for="genre">Genre *</label>
									<select class="form-control" name="gendre" id="genre">
										<option value="">Pilih data</option>
										<option value="rock">Rock</option>
										<option value="hiphop">HipHop</option>
										<option value="metal">Metal</option>
										<option value="pop">Pop</option>
										<option value="r&b">R&B</option>
										<option value="blues">Blues</option>
										<option value="alternative">Alternative</option>
										<option value="electronic">Electronic</option>
										<option value="others">Others</option>
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
															echo "<option value='$row[provinsi]'>$row[provinsi]</option>";
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
												<option value=''>--</option>
											</select>
											<!--<input type="text" maxlength="2" tabindex='7' name="id_provinsi" id="id_provinsi" autocomplete="off">-->
										</div>

									</div>
								</div>

								<div class="form-group">
									<label for="pic">Nama PIC Band*</label>
									<input type="text" class="form-control" id="pic" maxlength="150" placeholder="Nama PIC" name="pic" value="<?= isset($band_old['pic']) ? $band_old['pic'] : '' ?>">								</div>
								<div class="form-group">
									<label for="contact">Band Contact*</label>
									<input type="text" class="form-control " id="contact" maxlength="150" placeholder="No HP" value="+62" name="contact" required>
								</div>
								<div class="form-group">
									<label for="instagram">Instagram Account*</label>
									<input type="text" class="form-control " id="instagram" maxlength="150" placeholder="https://Instagram link" name="instagram" required>
								</div>
								<div class="form-group">
									<label for="spotify">Spotify Link (copy link to artist)* </label>
									<input type="text" class="form-control " id="spotify" maxlength="150" placeholder="https://Profile Spotify link" name="spotify" required>
								</div>
								<div class="form-group">
									<label for="youtube">Youtube Channel Link <i>(optional)</i></label>
									<input type="text" class="form-control " id="youtube" maxlength="150" placeholder="https://Youtube link" name="youtube">
								</div>
								<!-- <div class="form-group">
									<label for="manggung">Dari beberapa konser ini, lo kira-kira paling pengen manggung di mana?*</label>
									<select class="form-control" name="manggung" id="manggung">
										<option value="">Pilih data</option>
										<option value="Pestapora">Pestapora</option>
									</select>
								</div> -->
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
											<img id="prev-image" src="<?= base_url(); ?>assets/front/img/upload-icon.png" alt="your image" class='img-responsive' style='cursor:pointer;' />
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
											<img src="<?= base_url(); ?>assets/front/img/upload-icon.png" alt="your image" class='img-responsive' style='cursor:pointer;' />
											<input name="sound" id="sound" type="file" class="form-control" accept=".mp3, .wav">
											<span>or Drag and Drop files here</span>
										</label>
									</div>
									<em>* Maksimal file size 6MB. Format file : mp3 / wav</em>
								</div>
                                <div class="form-group">
                                    <em>* harus diisi</em>
                                    <br>
                                    <input type="checkbox" class="" id="tnc" name="tnc" value="1">
                                    <!-- <em>Kami bersedia musik yang kami unggah di sini, dapat digunakan untuk Clasmild dan diputar di Authenticity</em> -->
									<em>Saya adalah perokok dewasa berumur 21 tahun ke atas. Saya setuju musik dan foto saya dan/atau group saya, digunakan untuk keperluan Authenticity.id dan akan diputar dan ditayangkan di website, media sosial Authenticity, dan aset online/offline lainnya.</em>
                                </div>
							</div>

							<div class="panel-footer pb-5" style='background-color:#FFFFFF; border: none; padding-top: 0;'>
								<div class="row">
									<div class="col-sm-12">
										<div class="btn-log1">
											<button type="submit" id='btnWrite' name='submit' value='1' class="btn btn-primary text-uppercase">
												Submit
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
	</div>

	<?php $this->load->view('front/podcast/footerfp'); ?>
</div>
<div class="modal fade" id="modalSuccess" tabindex="-1" role="dialog" aria-labelledby="modalSuccess" aria-hidden="true">
	<div class="modal-dialog modal-dialog--alert">
		<div class="modal-content">
			<div class="modal-body">
				<h3>Selamat!</h3>
				<img src='<?= base_url(); ?>assets/front/img/soundroom/line.png' class="separator">
				<p>
					Musik lo berhasil di-submit!<br />
					<a href="<?= base_url(); ?>soundroom">Klik di sini buat dengerin playlistnya</a>
				</p>

				<a href="<?= base_url(); ?>" class="btn btn-outline-light">BACK TO HOME</a>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="modalFailed" tabindex="-1" role="dialog" aria-labelledby="modalFailed" aria-hidden="true">
	<div class="modal-dialog modal-dialog--alert">
		<div class="modal-content">
			<div class="modal-body">
				<h3>Oops!</h3>
				<p class="error-message"></p>
				<button type="button" class="btn btn-outline-light" data-dismiss="modal">COBA LAGI</button>
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
<script type="text/javascript" src="<?= base_url() ?>assets/front/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>assets/front/tinymce/jquery.tinymce.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>assets/selectize/selectize.js"></script>

<script>
	function readURLimage(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				$('#prev-image').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}

	function readURLthumbnail(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				$('#prev-thumbnail').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}

	$(document).on('click', '.del-row', function(e) {
		if (confirm("Hapus ?")) {
			$(this).closest('tr').remove();
		}
	});
	$(document).on('ready', function() {
		$('.navbar-brand').addClass('d-none');
		$('.addpersonil').click(function() {
			$('#listable tr:last').after('<tr> <td><input type="text" class="form-control" name="personil[]" required placeholder="Personil Name"></td> <td><input type="text" class="form-control" name="position[]" required placeholder="ex: Vocalist, Guitar, Bass, Drum etc."></td><td align="center"><a class="btn btn-sm btn-danger del-row" ><i class="fa fa-trash"></i></a></td> </tr>');
		});
		$('#prev-thumbnail').click(function() {
			$("#thumbnail").trigger("click");
		});
		$('#prev-image').click(function() {
			$("#image").trigger("click");
		});
		$("#image").change(function() {
			readURLimage(this);
		});
		$("#thumbnail").change(function() {
			readURLthumbnail(this);
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
				url: "<?php echo base_url(); ?>profile/submitsound2026",
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
						// $('#lblStatusLogin').html("<div class='alert alert-success'>" + e.message + "</div>");
						document.getElementById("frmWrite").reset();
						$('#prev-thumbnail').attr('src', '<?= base_url(); ?>uploads/no_image.png');
						$('#prev-image').attr('src', '<?= base_url(); ?>uploads/no_image.png');
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
                    $('.error-message').text('Halo, data Season 2026 yang kamu submit belum lengkap. Dimohon untuk melengkapi semua data sesuai persyaratan yang sudah ada');
				}
			});
		});
		$('textarea.tinymce-editor').tinymce({
			selector: "#resizable",
			plugins: ["advlist autolink lists  charmap print preview anchor"],
			menubar: false,
			resize: false,
			toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
			extended_valid_elements: "script[src|async|defer|type|charset]"
		});
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
		$('form #judul').keyup(function() {
			slug = $(this).val().toLowerCase().replace(/ +/g, '-').replace('--', '-').replace(/[^a-z0-9\-\.]+/g, '').substring(0, $(this).val().length > 100 ? 100 : $(this).val().length);
			$('form #slug').val(slug);
		});

	});
</script>
