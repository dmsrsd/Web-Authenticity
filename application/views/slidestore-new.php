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
	<form action="<?=base_url()?>cms/logic/slidestoreProses" method="post" data-parsley-validate enctype="multipart/form-data">
	<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
		<div class="panel-body"> 
			<input type="hidden" name="kategori" value="3" />
			<?php if(isset($data['id_slide']) && $data['id_slide'] != ''): ?>
				<input type="hidden" name="_id" value="<?=$data['id_slide']?>" />
				<input type="hidden" name="img_awal" value="<?=$data['image']?>" />
				<input type="hidden" name="img_awal_mobile" value="<?=$data['image_mobile']?>" />
				<input type="hidden" name="action" value="edit" /> 
			<?php endif; ?> 
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Urutan<span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-2"> 
						<input type='text' class='form-control'  name='urutan' value='<?=(isset($data['urutan']) ? $data['urutan'] : '')?>'  required >
					</div>
				</div>
			</div> 	  
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">URL</label>
					</div>
					<div class="col-sm-8"> 
						<input type='text' class='form-control'  name='url' value='<?=(isset($data['url']) ? $data['url'] : '')?>' >
					</div>
				</div>
			</div> 	  
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Image  </label>
					</div>
					<div class="col-sm-5"> 
						<?php if(isset($data['id_slide']) && $data['id_slide'] != '' && $data['image'] != ''): ?>
						<img src='<?php echo base_url();?>uploads/store/<?php echo $data['image'];?>' height='150' class='img'>
						<?php endif?>
						<input name="image" type="file" class="form-control" id="image" <?php if(isset($data['id_slide']) && $data['id_slide'] != ''){}else{echo "required";} ?> >
						<em>1140 x 654</em>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Image  Mobile</label>
					</div>
					<div class="col-sm-5"> 
						<?php if(isset($data['id_slide']) && $data['id_slide'] != '' && $data['image_mobile'] != ''): ?>
						<img src='<?php echo base_url();?>uploads/store/<?php echo $data['image_mobile'];?>' height='150' class='img'>
						<?php endif?>
						<input name="image_mobile" type="file" class="form-control" id="image_mobile" <?php if(isset($data['id_slide']) && $data['id_slide'] != ''){}else{echo "required";} ?> >
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
			<a href='<?=$url?>slidestore' class='btn btn-default'>Back</a>
			<button type="reset" class="btn btn-inverse">Clear</button>
		</div>
	</form>
</div>