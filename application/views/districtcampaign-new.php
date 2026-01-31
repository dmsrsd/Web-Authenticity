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
	<form action="<?=base_url()?>cms/logic/districtCampaignProses" method="post" data-parsley-validate enctype="multipart/form-data">
	<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
		<div class="panel-body"> 
			<?php if(isset($data['id']) && $data['id'] != ''): ?>
				<input type="hidden" name="_id" value="<?=$data['id']?>" />
				<input type="hidden" name="main_banner_awal" value="<?=$data['main_banner']?>" />
				<input type="hidden" name="mini_banner_awal" value="<?=$data['mini_banner']?>" />
				<input type="hidden" name="action" value="edit" /> 
			<?php endif; ?> 
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Urutan<span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-2"> 
						<input type='number' class='form-control'  name='urutan' value='<?=(isset($data['urutan']) ? $data['urutan'] : '')?>'  required >
					</div>
				</div>
			</div> 	  
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Video Name <span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-8">
						<input type='text' name='campaign_name' id='campaign_name' required value='<?=(isset($data['campaign_name']) ? $data['campaign_name'] : '')?>' class='form-control '>
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
						<label class="control-label">Kode Embed Youtube</label>
					</div>
					<div class="col-sm-8"> 
						<input type='text' class='form-control'  name='youtube' value='<?=(isset($data['youtube']) ? $data['youtube'] : '')?>' >
						<em>https://www.youtube.com/watch?v=4Xn0QORDxwo : <b>4Xn0QORDxwo</b></em>
					</div>
				</div>
			</div> 	  
			<!-- <div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Main Banner  </label>
					</div>
					<div class="col-sm-5"> 
						<?php if(isset($data['id']) && $data['id'] != '' && $data['main_banner'] != ''): ?>
						<img src='<?php echo base_url();?>uploads/districtcampaign/<?php echo $data['main_banner'];?>' height='150' class='img'>
						<?php endif?>
						<input name="main_banner" type="file" class="form-control" id="main_banner" <?php if(isset($data['id']) && $data['id'] != ''){}else{echo "required";} ?> >

					</div>
				</div>
			</div>  -->
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Mini Banner  </label>
					</div>
					<div class="col-sm-5"> 
						<?php if(isset($data['id']) && $data['id'] != '' && $data['mini_banner'] != ''): ?>
						<img src='<?php echo base_url();?>uploads/districtcampaign/<?php echo $data['mini_banner'];?>' height='150' class='img'>
						<?php endif?>
						<input name="mini_banner" type="file" class="form-control" id="mini_banner" <?php if(isset($data['id']) && $data['id'] != ''){}else{echo "required";} ?> >
						<!-- <em>1140 x 654</em> -->
					</div>
				</div>
			</div> 

			<!-- <div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Description <span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-8">
						<textarea name="description" id="description" cols="30" rows="10" class="form-control"><?=(isset($data['description']) ? $data['description'] : '')?></textarea>
						
					</div>
				</div>
			</div> -->

			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Choose Campaign <span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-3"> 
						<select name="section" class="form-control" required>
							<?php
								$acc_setting = '';
								$is_home = '';
								$section = '';
								if(isset($data['id'])){
									$acc_setting = $data['access_setting'];
									$is_home = $data['is_homevideo'];
									$section = $data['section'];
								}
								
							?>
							<option value="">Select</option>
							<?php  if(!empty($section_list)) { foreach ($section_list as $list) { ?>
								<option value="<?=$list['id']?>" <?= $section == $list['id'] ? 'selected' : ''?>><?= $list['section_name'] ?></option>  
							<?php }} ?>
							<!-- <option value="district_campiagn" <?= $section == 'district_campiagn' ? 'selected' : '' ?>>District Campaign</option>
							<option value="section_2" <?= $section == 'section_2' ? 'selected' : '' ?>>section 2</option>
							<option value="section_3" <?= $section == 'section_3' ? 'selected' : '' ?>>section 3</option>
							<option value="section_4" <?= $section == 'section_4' ? 'selected' : '' ?>>section 4</option> -->
							
						</select>
					</div>
				</div>
			</div> 

			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Access Setting <span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-3"> 
						<select name="access_setting" class="form-control" required>
							<option value="">Select</option>
							<option value="before_login" <?= $acc_setting == 'before_login' ? 'selected' : '' ?>>Before Login</option>
							<option value="after_login" <?= $acc_setting == 'after_login' ? 'selected' : '' ?>>After Login</option>
							
						</select>
					</div>
				</div>
			</div> 

			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Is Homevideo <span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-3"> 
						<input type="checkbox" name="is_homevideo"  id="is_homevideo" <?= $data['is_homevideo'] == 1 ? 'checked' : '' ?>>
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
			<a href='<?=$url?>districtcampaign' class='btn btn-default'>Back</a>
			<button type="reset" class="btn btn-inverse">Clear</button>
		</div>
	</form>
</div>