<?php
	$now = @$this->uri->segment(3);
?>
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
	<form action="<?=base_url()?>cms/logic/darbotzProses" method="post" data-parsley-validate enctype="multipart/form-data">
	<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
		<div class="panel-body"> 
			<?php if(isset($data['id_darbotz']) && $data['id_darbotz'] != ''): ?>
				<input type="hidden" name="_id" value="<?=$data['id_darbotz']?>" />
				<input type="hidden" name="img_awal" value="<?=$data['banner']?>" />
				<input type="hidden" name="img_awal2" value="<?=$data['banner2']?>" />
				<input type="hidden" name="action" value="edit" /> 
			<?php endif; ?>  
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Nama<span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-7"> 
						<input type='text' class='form-control' id='judul' name='nama' value='<?=(isset($data['nama']) ? $data['nama'] : '')?>' required>
					</div>
				</div>
			</div> 	 
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Slug<span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-7"> 
						<input type='text' class='form-control'  id='slug' name='slug' value='<?=(isset($data['slug']) ? $data['slug'] : '')?>' required>
					</div>
				</div>
			</div> 	 
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Deskripsi<span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-7"> 
						<input type='text' class='form-control'  name='deskripsi' value='<?=(isset($data['deskripsi']) ? $data['deskripsi'] : '')?>' required>
					</div>
				</div>
			</div> 	 
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Qty<span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-4"> 
						<input type='number' class='form-control'  name='qty' value='<?=(isset($data['qty']) ? $data['qty'] : '')?>' required>
					</div>
				</div>
			</div> 	 
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Harga<span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-4"> 
						<input type='number' class='form-control'  name='harga' value='<?=(isset($data['harga']) ? $data['harga'] : '')?>' required>
					</div>
				</div>
			</div> 	 
 
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Banner  </label>
					</div>
					<div class="col-sm-5"> 
						<?php if(isset($data['id_darbotz']) && $data['id_darbotz'] != '' && $data['banner'] != ''): ?>
						<img src='<?php echo base_url();?>uploads/darbotz/<?php echo $data['banner'];?>' height='150' class='img'>
						<?php endif?>
						<input name="banner" type="file" class="form-control" id="banner" <?php if(isset($data['id_darbotz']) && $data['id_darbotz'] != ''){}else{echo "required";} ?> >
						<em>1140 x 654</em>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Banner 2</label>
					</div>
					<div class="col-sm-5"> 
						<?php if(isset($data['id_darbotz']) && $data['id_darbotz'] != '' && $data['banner2'] != ''): ?>
						<img src='<?php echo base_url();?>uploads/darbotz/<?php echo $data['banner2'];?>' height='150' class='img'>
						<?php endif?>
						<input name="banner2" type="file" class="form-control" id="banner2" <?php if(isset($data['id_darbotz']) && $data['id_darbotz'] != ''){}else{echo "required";} ?> >
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Buy <span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-3"> 
						<select name="buy" class="form-control" required>
							<option value="">Select</option>
							<?php  foreach ($status as $key => $value) { ?>
								<option value="<?=$key?>" <?=(isset($data['buy']) && $data['buy'] == $key) ? 'selected' : ''?>><?=$value?></option>  
							<?php } ?>
						</select>
					</div>
				</div>
			</div> 	
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Buy Type<span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-3"> 
						<select name="buy_type" class="form-control" required>
							<option value="">Select</option>
							<?php  foreach ($buytype as $key => $value) { ?>
								<option value="<?=$key?>" <?=(isset($data['buy_type']) && $data['buy_type'] == $key) ? 'selected' : ''?>><?=$value?></option>  
							<?php } ?>
						</select>
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
			<button type="submit" onclick=" " class="btn btn-primary">Submit</button>
			<a href='<?=$url?>darbotz' class='btn btn-default'>Back</a>
			<button type="reset" class="btn btn-inverse">Clear</button>
		</div>
	</form>
</div>