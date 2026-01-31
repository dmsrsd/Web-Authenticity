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
	?>		
	<form action="<?=base_url()?>cms/logic/artikelProses?k=<?=$_GET['k']?>" method="post" data-parsley-validate enctype="multipart/form-data">
		<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
		<div class="panel-body"> 
			<?php if(isset($data['id_artikel']) && $data['id_artikel'] != ''): ?>
				<input type="hidden" name="_id" value="<?=$data['id_artikel']?>" />
				<input type="hidden" name="img_awal" value="<?=$data['image']?>" />
				<input type="hidden" name="img_awal_thumbnail" value="<?=$data['thumbnail']?>" />
				<input type="hidden" name="action" value="edit" /> 
			<?php endif; ?>
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Kategori <span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-4">
						<select name="id_kategori" class="form-control" required>
							<option value="">Select</option>
							<?php
							if(isset($kategori) && count($kategori) > 0): foreach($kategori as $row ):?>
								<option value="<?=$row['id_kategori']?>" <?=(isset($data['id_kategori']) && $data['id_kategori'] == $row['id_kategori']) ? 'selected' : ''?>><?=$row['nama']?></option>  
							<?php endforeach; endif;  ?>
						</select>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Judul <span class="text-danger">*</span></label>
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
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Deskripsi Singkat <span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-8">
						<textarea rows='5' class="form-control" name="deskripsi_singkat"><?=(isset($data['deskripsi_singkat']) ? $data['deskripsi_singkat'] : '')?></textarea>
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
						<label class="control-label">Thumbnail  </label><br><em>700 x 500</em>
					</div>
					<div class="col-sm-8"> 
						<?php if(isset($data['id_artikel']) && $data['id_artikel'] != '' && $data['thumbnail'] != ''): ?>
						<img src='<?php echo base_url();?>uploads/article/thumb/<?php echo $data['thumbnail'];?>' height='150' class='img'>
						<?php endif?>
						<input name="thumbnail" type="file" class="form-control"  <?php if(isset($data['id_artikel']) && $data['id_artikel'] != ''){}else{echo "required";} ?> >
					</div>
				</div> 
			</div> 
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Image  </label><br><em>1140 x 640</em>
					</div>
					<div class="col-sm-8"> 
						<?php if(isset($data['id_artikel']) && $data['id_artikel'] != '' && $data['image'] != ''): ?>
						<img src='<?php echo base_url();?>uploads/article/thumb/<?php echo $data['image'];?>' height='150' class='img'>
						<?php endif?>
						<input name="image" type="file" class="form-control" <?php if(isset($data['id_artikel']) && $data['id_artikel'] != ''){}else{echo "required";} ?> >
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Tags</label>
					</div>
					<div class="col-sm-8">
						<input type='text' name='tags' id='tags'  value='<?=(isset($data['tags']) ? $data['tags'] : '')?>' >
					</div>
				</div>
			</div> 		
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Kontributor <span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-4">
						<select name="id_kontributor" class="form-control"> 
							<option value="">Select</option>
							<?php
							if(isset($kontributor) && count($kontributor) > 0): foreach($kontributor as $row ):?>
								<option value="<?=$row['id_kontributor']?>" <?=(isset($data['id_kontributor']) && $data['id_kontributor'] == $row['id_kontributor']) ? 'selected' : ''?>><?=$row['nama']?></option>  
							<?php endforeach; endif;  ?>
						</select>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Photography <span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-8">
						<input type='text' name='photography'  required value='<?=(isset($data['photography']) ? $data['photography'] : '')?>' class='form-control '>
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
		</div>
		<div class="panel-footer">
			<button type="submit" onclick=" " class="btn btn-primary">Proses</button>
			<button type="reset" class="btn btn-inverse">Bersihkan</button>
		</div>
	</form>
</div>