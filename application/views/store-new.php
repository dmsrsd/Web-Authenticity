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
	<form action="<?=base_url()?>cms/logic/storeProses" method="post" data-parsley-validate enctype="multipart/form-data">
	<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
		<div class="panel-body"> 
			<?php if(isset($data['id_store']) && $data['id_store'] != ''): ?>
				<input type="hidden" name="_id" value="<?=$data['id_store']?>" />
				<input type="hidden" name="img_logo" value="<?=$data['logo']?>" />
				<input type="hidden" name="img_background" value="<?=$data['background']?>" />
				<input type="hidden" name="img_thumbnail" value="<?=$data['thumbnail']?>" />
				<input type="hidden" name="action" value="edit" /> 
			<?php endif; ?> 
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Judul/Store<span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-8"> 
						<input type='text' class='form-control' id='judul' name='judul' value='<?=(isset($data['judul']) ? $data['judul'] : '')?>'  required >
					</div>
				</div>
			</div> 	  
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Slug<span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-8"> 
						<input type='text' class='form-control' id='slug' name='slug' value='<?=(isset($data['slug']) ? $data['slug'] : '')?>'  required >
					</div>
				</div>
			</div> 	  
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
						<em>*) Kosongkan bila tidak ada spesific url</em>
					</div>
				</div>
			</div> 	  
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Logo  </label>
					</div>
					<div class="col-sm-5"> 
						<?php if(isset($data['id_store']) && $data['id_store'] != '' && $data['logo'] != ''): ?>
						<img src='<?php echo base_url();?>uploads/store/<?php echo $data['logo'];?>' height='150' class='img'>
						<?php endif?>
						<input name="logo" type="file" class="form-control" <?php if(isset($data['id_store']) && $data['id_store'] != ''){}else{echo "required";} ?> >
						
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Banner Background  </label>
					</div>
					<div class="col-sm-5"> 
						<?php if(isset($data['id_store']) && $data['id_store'] != '' && $data['background'] != ''): ?>
						<img src='<?php echo base_url();?>uploads/store/<?php echo $data['background'];?>' height='150' class='img'>
						<?php endif?>
						<input name="background" type="file" class="form-control" <?php if(isset($data['id_store']) && $data['id_store'] != ''){}else{echo "required";} ?> >
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Thumbnail</label>
					</div>
					<div class="col-sm-5"> 
						<?php if(isset($data['id_store']) && $data['id_store'] != '' && $data['thumbnail'] != ''): ?>
						<img src='<?php echo base_url();?>uploads/store/<?php echo $data['thumbnail'];?>' height='150' class='img'>
						<?php endif?>
						<input name="thumbnail" type="file" class="form-control"  <?php if(isset($data['id_store']) && $data['id_store'] != ''){}else{echo "required";} ?> >
					</div>
					<div class="col-sm-2">
						<label class="control-label">Size Thumbnail</label>
					</div>
					<div class="col-sm-2">
						<select class='form-control' name='thumbnail_size'>
						<?php
							for($x=1; $x<=12; $x++){
								$ac = "";
								if(isset($data['id_store']) && $data['id_store'] != '' && $data['thumbnail_size'] != ''){
									if($data['thumbnail_size']==$x){
										$ac = "selected";
									}
								}
								echo "<option value='$x' $ac>$x</option>";
							}
						?>
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
			<a href='<?=$url?>store' class='btn btn-default'>Back</a>
			<button type="reset" class="btn btn-inverse">Clear</button>
		</div>
	</form>
</div>