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
	<form action="<?=base_url()?>cms/logic/sectionProses" method="post" data-parsley-validate enctype="multipart/form-data">
	<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
		<div class="panel-body"> 
			<?php if(isset($data['id']) && $data['id'] != ''): ?>
				<input type="hidden" name="_id" value="<?=$data['id']?>" />
				
				<input type="hidden" name="action" value="edit" /> 
				<input type="hidden" name="mini_banner_awal" value="<?=$data['mini_banner']?>" />
				<input type="hidden" name="landing_banner_awal" value="<?=$data['landing_banner']?>" />
			<?php endif; ?> 
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Campaign Name <span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-8">
						<input type='text' name='section_name' id='section_name' required value='<?=(isset($data['section_name']) ? $data['section_name'] : '')?>' class='form-control slugable'>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Slug  <span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-8">
						<input type='text' name='slug' id='slug' required value='<?=(isset($data['slug']) ? $data['slug'] : '')?>' class='form-control '>
					</div>
				</div>
			</div>

			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Description</label>
					</div>
					<div class="col-sm-8">
						<textarea name="description" id="description" cols="30" rows="5" class="form-control"><?=(isset($data['description']) ? $data['description'] : '')?></textarea>
						
					</div>
				</div>
			</div>
			
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Home Mini Banner  </label>
					</div>
					<div class="col-sm-5"> 
						<?php if(isset($data['id']) && $data['id'] != '' && $data['mini_banner'] != ''): ?>
						<img src='<?php echo base_url();?>uploads/section/<?php echo $data['mini_banner'];?>' height='150' class='img' style="background:#0260db;">
						<?php endif?>
						<input name="mini_banner" type="file" class="form-control" id="mini_banner" <?php if(isset($data['id']) && $data['id'] != ''){}else{echo "required";} ?> >
						<!-- <em>1140 x 654</em> -->
					</div>
				</div>
			</div> 
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Campaign Landing Banner  </label>
					</div>
					<div class="col-sm-5"> 
						<?php if(isset($data['id']) && $data['id'] != '' && $data['landing_banner'] != ''): ?>
						<img src='<?php echo base_url();?>uploads/section/<?php echo $data['landing_banner'];?>' height='150' class='img'>
						<?php endif?>
						<input name="landing_banner" type="file" class="form-control" id="landing_banner" <?php if(isset($data['id']) && $data['id'] != ''){}else{echo "required";} ?> >
						<!-- <em>1140 x 654</em> -->
					</div>
				</div>
			</div> 
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Urutan<span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-2"> 
						<input type='number' class='form-control'  name='order_number' value='<?=(isset($data['order_number']) ? $data['order_number'] : '')?>'  required >
					</div>
				</div>
			</div>
			
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Show at Homepage <span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-3"> 
						<input type="checkbox" name="show_at_homepage"  id="show_at_homepage" <?= isset($data['show_at_homepage']) ? ($data['show_at_homepage'] == 1 ? 'checked' : '') : '' ?>>
				</div>
			</div> 

			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Show at Menu <span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-3"> 
						<input type="checkbox" name="show_at_menu"  id="show_at_menu" <?= isset($data['show_at_menu']) ? ($data['show_at_menu'] == 1 ? 'checked' : '') : '' ?>>
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
			<a href='<?=$url?>section' class='btn btn-default'>Back</a>
			<button type="reset" class="btn btn-inverse">Clear</button>
		</div>
	</form>
</div>