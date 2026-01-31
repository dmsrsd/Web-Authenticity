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
<div class="panel panel-default">
	<div class="panel-heading">
		<div class="row">
			<div class='col-sm-6'><?php echo $judul;?></div>
			<div class='col-sm-6' align='right'>

			</div>
		</div>
	</div>
	<?php
	if(isset($_GET['s'])){
		switch($_GET['s']){
			case "true" : $c="success"; break;
			case "false": $c="danger"; break;
		}
			echo"
			<br>
			<div class='container' style='width:100%;'><div class='row'><div class='col-md-12'>
			<div class='alert alert-$c' role='alert'>
				<span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span>
				<span class='sr-only'>Error:</span>
				$_GET[m]
			</div></div></div>
			</div>
			";
	}

    $form_url = 'soundroomProses';
	$year = '2024';
    if (isset($_GET['_year'])) {
		//if (in_array($_GET['_year'], ['2024', '2023','2022', '2019'])) {
			$year = $_GET['_year'];
		//}

		$form_url = 'soundroomProses?_year='.$year;
    }
	?>
	<form action="<?=base_url()?>cms/logic/<?=$form_url?>" method="post" data-parsley-validate enctype="multipart/form-data">
		<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
		<div class="panel-body">
			<?php if(isset($data['id_soundroom']) && $data['id_soundroom'] != ''): ?>
				<input type="hidden" name="created_by" value="<?=$data['created_by']?>" />
				<input type="hidden" name="_id" value="<?=$data['id_soundroom']?>" />
				<input type="hidden" name="img_awal" value="<?=$data['image']?>" />
				<input type="hidden" name="img_awal_thumbnail" value="<?=$data['thumbnail']?>" />
				<input type="hidden" name="img_awal_sound" value="<?=$data['sound']?>" />
				<input type="hidden" name="action" value="edit" />
			<?php endif; ?>
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Member <span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-8">
						<b><?=ucwords($member['fullname'])."</b> ".$member['email']." ".$member['hp'];?>
					</div>
				</div>
			</div>

			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Nama Band <span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-8">
						<input type='text' name='judul' id='judul' required value='<?=(isset($data['judul']) ? $data['judul'] : '')?>' class='form-control '>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Slug Url <span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-8">
						<input type='text' name='slug' id='slug' required value='<?=(isset($data['slug']) ? $data['slug'] : '')?>' class='form-control '>
					</div>
				</div>
			</div>
			<!-- <div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Personil <span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-10">
						<input type='text' name='personil' id='personil' required value='<?=(isset($data['personil']) ? $data['personil'] : '')?>' class='form-control '>
						<em>[personil name-position],[personil name-position],[personil name-position]</em>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Deskripsi <span class="text-danger">*</span></label>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<textarea rows='15' class="form-control tinymce-editoradv"  name="deskripsi"><?=(isset($data['deskripsi']) ? $data['deskripsi'] : '')?></textarea>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Cover Sound  </label><br><em>180px x 180px</em>
					</div>
					<div class="col-sm-8">
						<?php if(isset($data['id_soundroom']) && $data['id_soundroom'] != '' && $data['thumbnail'] != ''): ?>
						<img src='<?php echo base_url();?>uploads/soundroom/<?php echo $data['thumbnail'];?>' height='150' class='img'>
						<?php endif?>
						<input name="thumbnail" type="file" class="form-control"  <?php if(isset($data['id_soundroom']) && $data['id_soundroom'] != ''){}else{echo "required";} ?> >
						<em>*) Max. size image (1MB), 180px X 180px</em>
					</div>
				</div>
			</div> -->
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Image  </label>
					</div>
					<div class="col-sm-8">
						<?php if(isset($data['id_soundroom']) && $data['id_soundroom'] != '' && $data['image'] != ''): ?>
						<img src='<?php echo base_url();?>uploads/soundroom/<?php echo $data['image'];?>' height='150' class='img'>
						<?php endif?>
						<input name="image" type="file" class="form-control" <?php if(isset($data['id_soundroom']) && $data['id_soundroom'] != ''){}else{echo "required";} ?> >
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Sound  </label>
					</div>
					<div class="col-sm-8">
						<?php if(isset($data['id_soundroom']) && $data['id_soundroom'] != '' && $data['sound'] != ''): ?>
						<a href='<?php echo base_url();?>uploads/soundroom/<?php echo $data['sound'];?>' target='_blank'><?php echo $data['sound'];?></a>
						<?php endif?>
						<input name="sound" type="file" class="form-control" <?php if(isset($data['id_soundroom']) && $data['id_soundroom'] != ''){}else{echo "required";} ?> >
					</div>
				</div>
			</div>

			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Approve <span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-3">
						<select name="approve" class="form-control" required>
							<option value="">Select</option>
							<?php  foreach ($approve as $key => $value) { ?>
								<option value="<?=$key?>" <?=(isset($data['approve']) && $data['approve'] == $key) ? 'selected' : ''?>><?=$value?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-sm-5">
					<input type='text' name='rejected_info' id='rejected-info' value='<?=(isset($data['rejected_info']) ? $data['rejected_info'] : '')?>' class='form-control' placeholder='Rejected info'>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Status <span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-3">
						<select name="status" class="form-control" required>
							<option value="">Select</option>
							<?php  foreach ($status as $key => $value) { ?>
								<option value="<?=$key?>" <?=(isset($data['status']) && $data['status'] == $key) ? 'selected' : ''?>><?=$value?></option>
							<?php } ?>
						</select>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">
							<?php if ($year == '2023') { ?>
								Top 15
							<?php } elseif ($year == '2024') { ?>
								Top 15
							<?php } else { ?>
								Top 3
							<?php } ?>
							<span class="text-danger">*</span>
						</label>
					</div>
					<div class="col-sm-3">
						<select name="top3" class="form-control">
							<option value="0" <?=(isset($data['top3']) && $data['top3'] != '1') ? 'selected' : ''?>>No</option>
							<option value="1" <?=(isset($data['top3']) && $data['top3'] == '1') ? 'selected' : ''?>>Yes</option>
						</select>
					</div>
				</div>
				<?php if ($year >= '2025') { ?>
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">
								Top 10
							<span class="text-danger">*</span>
						</label>
					</div>
					<div class="col-sm-3">
						
							<select name="top10" class="form-control">
								<option value="0" <?=(isset($data['top10']) && $data['top10'] != '1') ? 'selected' : ''?>>No</option>
								<option value="1" <?=(isset($data['top10']) && $data['top10'] == '1') ? 'selected' : ''?>>Yes</option>
							</select>
					</div>
				</div>
				<?php } ?>
			</div>

			<?php if ($year >= '2023') { ?>
				<div class="form-group">
					<div class="row">
						<div class="col-sm-2">
							<label class="control-label">
								Rank <span class="text-danger">*</span>
							</label>
						</div>
						<div class="col-sm-3">
							<input type='number' name='rank' id='rank' required value='<?=(isset($data['rank']) ? $data['rank'] : '0')?>' class='form-control ' min='0' max='15'>
						</div>
					</div>
				</div>
			<?php } ?>


			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Instagram<span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-8">
						<input type='text' name='instagram' id='instagram' required value='<?=(isset($data['instagram']) ? $data['instagram'] : '')?>' class='form-control '>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Spotify</label>
					</div>
					<div class="col-sm-8">
						<input type='text' name='spotify' id='spotify' value='<?=(isset($data['spotify']) ? $data['spotify'] : '')?>' class='form-control '>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Youtube Channel</label>
					</div>
					<div class="col-sm-8">
						<input type='text' name='youtube' id='youtube' value='<?=(isset($data['youtube']) ? $data['youtube'] : '')?>' class='form-control '>
					</div>
				</div>
			</div>

		</div>
		<div class="panel-footer">
			<button type="submit" onclick=" " class="btn btn-primary">Proses</button>
			<button type="reset" class="btn btn-inverse">Bersihkan</button>
		</div>
	</form>
</div>
