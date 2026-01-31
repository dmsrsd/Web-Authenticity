<style>
	.selectize-control.form-control{
		border:none;
	}
	.selectize-control.form-control.input-sm.single{
		padding:0px;
	}
	.selectize-input{
		  -webkit-border-radius:0;
		  -moz-border-radius:0;
		  border-radius:0;
	}
	.selectize-dropdown.form-control{
		padding:0px;
		height:auto;
	}
	</style>
<link href="<?=base_url()?>assets/selectize/selectize.default.css" rel="stylesheet" />
<br><br><br>
<div class='min-height'>
	<div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default box-login-1" style="box-shadow: 0 0 8px #e2e2e2;">
					<form role="form" id="frmWrite"  action="<?=base_url()?>profile/submitposter"  method="post" data-parsley-validate  enctype="multipart/form-data">
					<input type='hidden' name='slug' id='slug' required value='<?=(isset($data['slug']) ? $data['slug'] : '')?>' class='form-control '>
                    <div class="panel-body">
						<div class="new-color">Upload Your Poster</div>
						<img class="shadow-log" src="<?=base_url()?>assets/front/img/shadow.png">
							<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
							<div id="lblStatusLogin">
							<?php $response = $this->session->flashdata('response'); if(isset($response["status"]) && $response["status"] == "error"): ?>
								<div class="alert alert-danger" style='padding:10px;'>
									<?=$response["message"]?>
								</div>
							<?php endif; ?>
							<?php $response = $this->session->flashdata('response'); if(isset($response["status"]) && $response["status"] == "success"): ?>
								<div class="alert alert-success" style='padding:10px;'>
									<?=$response["message"]?>
								</div>
							<?php endif; ?>
							</div>
							<div class="form-group">
								<label for="txtSahkoposti">Nama Poster</label>
								<input type="judul" class="form-control " id="judul" required maxlength="150" placeholder="Nama Poster" name="judul">

							</div>
                            <div class="form-group">
								<div class='row'>
									<div class='col-sm-6'>
										<label for="fullname">Province</label>
										<select class='form-control rokok' name='id_provinsi' id="id_provinsi"  required>
											<option value=''>--</option>
											<?php
												if(isset($provinsi) && count($provinsi) > 0){ foreach($provinsi as $row){
													if($row['provinsi']!="-"){
														echo "<option value='$row[provinsi]'>$row[provinsi]</option>";
													}
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
								<label for="txtSahkoposti">Deskripsi</label>
								<textarea rows='15' class="form-control tinymce-editor"  name="deskripsi"></textarea>
							</div>
							<div class="form-group">
								<label for="txtSahkoposti">Image </label>
								<img id="prev-image" src="<?=base_url();?>uploads/no_image.png" alt="your image"  class='img-responsive' style='cursor:pointer;'/>
								<input name="image" id="image" type="file" class="form-control" required  accept="image/x-png,image/gif,image/jpeg">
								<em>*) Max. size image (1MB) 842px x 1191px Potrait</em>
							</div>
                    </div>

					<div class="panel-footer" style='background-color:#FFFFFF;'>
						<div class="row">
							<div class="col-sm-12">
								<div class="btn-log1">
									<button type="submit" id='btnWrite' name='submit' value='1'  class="btn btn-find hauto2">
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

<?php $this->load->view('front/podcast/footerfp');?>
<script type="text/javascript" src="<?=base_url()?>assets/front/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/front/tinymce/jquery.tinymce.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/selectize/selectize.js"></script>

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

	$(document).on('ready', function() {
		$('#prev-image').click(function(){$("#image").trigger("click");});
		$("#image").change(function() {
			readURLimage(this);
		});
		$("#thumbnail").change(function() {
			readURLthumbnail(this);
		});
		$("#frmWrite").submit(function (eve) {
			eve.preventDefault();
			var dataform = new FormData();
			var inputtxt = $('#frmWrite').serializeArray();
			for (var i = 0; i < inputtxt.length; i++) {
				dataform.append(inputtxt[i]["name"], inputtxt[i]["value"]);
			}
			var img = $('#image');
			dataform.append('image', img[0].files[0]);
			dataform.append('submit', "1");
			dataform.append('<?php echo $this->security->get_csrf_token_name(); ?>', '<?php echo $this->security->get_csrf_hash(); ?>');
			$.ajax({
				type: "POST",
				data: dataform,
				dataType: "json",
				contentType: false,
				processData: false,
				url: "<?php echo base_url();?>profile/submitposter",
				beforeSend: function () {
					$('.overlay-all').show();
					$('#btnWrite').prop("disabled", true);
					$('#lblStatusLogin').html("");
				},
				success: function (e) {
					$('.overlay-all').hide();
					$('#btnWrite').prop("disabled", false);
					$('html, body').animate({ scrollTop: 50 }, 'slow');
					if(e.status=="true"){
						$('#lblStatusLogin').html("<div class='alert alert-success'>"+e.message+"</div>");
						document.getElementById("frmWrite").reset();
						$('#prev-thumbnail').attr('src','<?=base_url();?>uploads/no_image.png');
						$('#prev-image').attr('src','<?=base_url();?>uploads/no_image.png');

					}else{
						$('#lblStatusLogin').html("<div class='alert alert-danger'>"+e.message+"</div>");
					}
				},
				error: function () {
					$('.overlay-all').hide();
					$('#btnWrite').prop("disabled", false);
					alert('Failed..!!');
				}
			});
		});
		$('textarea.tinymce-editor').tinymce({
			selector: "#resizable",
			plugins: ["advlist autolink lists  charmap print preview anchor"],
			menubar: false,
			resize: false,
			toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
			extended_valid_elements : "script[src|async|defer|type|charset]"
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
		$('form #judul').keyup(function() {
			slug = $(this).val().toLowerCase().replace(/ +/g, '-').replace('--', '-').replace(/[^a-z0-9\-\.]+/g,'').substring(0, $(this).val().length > 100?100:$(this).val().length);
			$('form #slug').val(slug);
		});

	});
</script>
