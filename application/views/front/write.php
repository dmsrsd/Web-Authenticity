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
	.mce-tooltip{
		display:none;
	}
	</style>

<br><br><br>
<div class='min-height'>
	<div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default box-login-1" style="box-shadow: 0 0 8px #e2e2e2;">
					<form role="form" id="frmWrite"  action="<?=base_url()?>profile/submitarticle"  method="post" data-parsley-validate  enctype="multipart/form-data">
                    <div class="panel-body">
						<div class="new-color">Write Your Article</div>
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
								<label for="txtSahkoposti">Judul</label>
								<input type="judul" class="form-control " id="judul" required maxlength="150" placeholder="Judul" name="judul">
								<input type='hidden' name='slug' id='slug' required value='<?=(isset($data['slug']) ? $data['slug'] : '')?>' class='form-control '>
							</div>
							<div class="form-group">
								<label for="password">Kategori</label>
								<select name="id_kategori" class="form-control" required>
									<option value="">Select</option>
									<?php
									if(isset($kategori) && count($kategori) > 0): foreach($kategori as $row ): $head = "Classified ".ucwords($row['head_kategori']);?>

										<option value="<?=$row['id_kategori']?>" <?=(isset($data['id_kategori']) && $data['id_kategori'] == $row['id_kategori']) ? 'selected' : ''?>><?=$head." - ".$row['nama']?></option>
									<?php endforeach; endif;  ?>
								</select>
							</div>
							<div class="form-group">
								<label for="txtSahkoposti">Deskripsi Singkat</label>
								<textarea rows='5' class="form-control" name="deskripsi_singkat"></textarea>
							</div>
							<div class="form-group">
								<label for="txtSahkoposti">Deskripsi</label>
								<textarea rows='15' class="form-control tinymce-editor"  name="deskripsi"></textarea>
							</div>
							<div class="form-group">
								<label for="txtSahkoposti">Thumbnail</label>
								<img id="prev-thumbnail" src="<?=base_url();?>uploads/no_image.png" alt="your thumbnail" class='img-responsive' style='cursor:pointer;'/>
								<input name="thumbnail" id="thumbnail" type="file" class="form-control" required  accept="image/x-png,image/gif,image/jpeg">
								<em>*) Max. size image (1MB), 260px X 190px</em>
							</div>
							<div class="form-group">
								<label for="txtSahkoposti">Image </label>
								<img id="prev-image" src="<?=base_url();?>uploads/no_image.png" alt="your image"  class='img-responsive' style='cursor:pointer;'/>
								<input name="image" id="image" type="file" class="form-control" required  accept="image/x-png,image/gif,image/jpeg">
								<em>*) Max. size image (1MB)</em>
							</div>
							<div class="form-group">
								<label for="txtSahkoposti">Photography </label>
								<input type='text' name='photography' class='form-control' required>
							</div>
							<div class="form-group">
								<label for="txtSahkoposti">Tag </label>
								<input type='text' name='tags' id='tags' required>
								<em>Pisahkan dengan (,) koma</em>
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
<link href="<?=base_url()?>assets/selectize/selectize.default.css" rel="stylesheet" />

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
		$('#prev-thumbnail').click(function(){$("#thumbnail").trigger("click");});
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
			var thumb = $('#thumbnail');
			var img = $('#image');
			dataform.append('thumbnail', thumb[0].files[0]);
			dataform.append('image', img[0].files[0]);
			dataform.append('submit', "1");
			dataform.append('<?php echo $this->security->get_csrf_token_name(); ?>', '<?php echo $this->security->get_csrf_hash(); ?>');
			$.ajax({
				type: "POST",
				data: dataform,
				dataType: "json",
				contentType: false,
				processData: false,
				url: "<?php echo base_url();?>profile/submitarticle",
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
						var $select = $('#tags').selectize();
						var control = $select[0].selectize;
						control.clear();
						control.clearOptions();
						control.renderCache['option'] = {};
						control.renderCache['item'] = {};
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
				plugins: ["advlist autolink lists image charmap print preview"],
				menubar: false,
				resize: false,
				toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
				extended_valid_elements : "script[src|async|defer|type|charset]"
			/*
			plugins: [
				"advlist autolink lists link image charmap print preview hr anchor pagebreak",
				"searchreplace wordcount visualblocks visualchars code fullscreen",
				"insertdatetime media nonbreaking save table contextmenu directionality",
				"emoticons template paste textcolor filemanager"
			],
			toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
			toolbar2: "print preview media | forecolor backcolor emoticons",
			image_advtab: true,
			relative_urls: false
			*/
		});
		$('#tags').selectize({
			delimiter: ',',
			persist: false,
			create: function(input) {
				return {
					value: input,
					text: input
				}
			}
		});
		$('form #judul').keyup(function() {
			slug = $(this).val().toLowerCase().replace(/ +/g, '-').replace('--', '-').replace(/[^a-z0-9\-\.]+/g,'').substring(0, $(this).val().length > 100?100:$(this).val().length);
			$('form #slug').val(slug);
		});

	});
</script>
