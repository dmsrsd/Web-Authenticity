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
	<form action="<?=base_url()?>cms/logic/kategoriProses" method="post" data-parsley-validate enctype="multipart/form-data">
	<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
		<div class="panel-body">
			<?php if(isset($data['id_kategori']) && $data['id_kategori'] != ''): ?>
				<input type="hidden" name="_id" value="<?=$data['id_kategori']?>" /> 
				<input type="hidden" name="action" value="edit" /> 
				<input type="hidden" name="banner_awal" value="<?=$data['banner']?>" />
			<?php endif; ?> 
			<div class="form-group">
				<div class="row">
					<div class="col-sm-3">
						<label class="control-label">Head Kategori <span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-3"> 
						<select name="head_kategori" class="form-control" required>
							<option value="">- Select -</option>
							<?php  foreach ($headkategori as $key => $value) { ?>
								<option value="<?=$key?>" <?=(isset($data['head_kategori']) && $data['head_kategori'] == $key) ? 'selected' : ''?>><?=$value?></option>  
							<?php } ?>
						</select>
					</div>
				</div>
			</div>
			
			<div class="form-group">
				<div class="row">
					<div class="col-sm-3">
						<label class="control-label">Kategori<span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-9"> 
						<input type='text' class='form-control' id='nama' name='nama' value='<?=(isset($data['nama']) ? $data['nama'] : '')?>' required>
					</div>
				</div>
			</div>	   
			<div class="form-group">
				<div class="row">
					<div class="col-sm-3">
						<label class="control-label">Slug<span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-9"> 
						<input type='text' class='form-control' id='slug' name='slug' value='<?=(isset($data['slug']) ? $data['slug'] : '')?>' required>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-sm-3">
						<label class="control-label">Meta Description<span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-9"> 
						<input type='text' class='form-control' name='meta_description' value='<?=(isset($data['meta_description']) ? $data['meta_description'] : '')?>' required>
					</div>
				</div>
			</div>	 
			<hr>
			<div class="form-group">
				<div class="row">
					<div class="col-sm-3">
						<label class="control-label">Banner  </label>
					</div>
					<div class="col-sm-5"> 
						<?php if(isset($data['id_kategori']) && $data['id_kategori'] != '' && $data['banner'] != ''): ?>
						<img src='<?php echo base_url();?>uploads/kategori/<?php echo $data['banner'];?>' height='150' class='img'>
						<?php endif?>
						<input name="banner" type="file" class="form-control" id="banner" <?php if(isset($data['id_kategori']) && $data['id_kategori'] != ''){}else{echo "required";} ?> >
					</div>
				</div>
			</div>	
			<div class="form-group">
				<div class="row">
					<div class="col-sm-3">
						<label class="control-label">Header<span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-9"> 
						<input type='text' class='form-control' name='header' value='<?=(isset($data['header']) ? $data['header'] : '')?>' required>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-sm-3">
						<label class="control-label">Header 2<span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-9"> 
						<input type='text' class='form-control' name='header2' value='<?=(isset($data['header']) ? $data['header2'] : '')?>' required>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-sm-3">
						<label class="control-label">Deskripsi<span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-9"> 
						<input type='text' class='form-control' name='deskripsi' value='<?=(isset($data['deskripsi']) ? $data['deskripsi'] : '')?>' required>
					</div>
				</div>
			</div>			
			<div class="form-group">
				<div class="row">
					<div class="col-sm-3">
						<label class="control-label">Status <span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-3"> 
						<select name="status" class="form-control" required>
							<option value="">- Select -</option>
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
			<a href='<?=$url?>kategori' class='btn btn-default'>Kembali</a>
			<button type="reset" class="btn btn-inverse">Bersihkan</button>
		</div>
	</form>
</div>