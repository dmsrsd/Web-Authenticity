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
	<form action="<?=base_url()?>cms/logic/podcastProses" method="post" data-parsley-validate enctype="multipart/form-data">
	<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
		<div class="panel-body"> 
			<?php if(isset($data['id_podcast']) && $data['id_podcast'] != ''): ?>
				<input type="hidden" name="_id" value="<?=$data['id_podcast']?>" />
				<input type="hidden" name="img_awal" value="<?=$data['image']?>" />
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
						<label class="control-label">Kode Embed Youtube</label>
					</div>
					<div class="col-sm-8"> 
						<input type='text' class='form-control'  name='youtube' value='<?=(isset($data['youtube']) ? $data['youtube'] : '')?>' >
						<em>https://www.youtube.com/watch?v=4Xn0QORDxwo : <b>4Xn0QORDxwo</b></em>
					</div>
				</div>
			</div> 	  
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Thumbnail  </label>
					</div>
					<div class="col-sm-5"> 
						<?php if(isset($data['id_podcast']) && $data['id_podcast'] != '' && $data['image'] != ''): ?>
						<img src='<?php echo base_url();?>uploads/podcast/<?php echo $data['image'];?>' height='150' class='img'>
						<?php endif?>
						<input name="image" type="file" class="form-control" id="image" <?php if(isset($data['id_podcast']) && $data['id_podcast'] != ''){}else{echo "required";} ?> >
						<em>1140 x 654</em>
					</div>
				</div>
			</div> 
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Session <span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-3"> 
						<select name="season" class="form-control" required>
							<option value="">Select</option>
							<option value="season_01" <?=(isset($data['season']) && $data['season'] == 'season_01') ? 'selected' : ''?>>Season 1</option>
							<option value="season_02" <?=(isset($data['season']) && $data['season'] == 'season_02') ? 'selected' : ''?>>Season 2</option>
							<option value="season_03" <?=(isset($data['season']) && $data['season'] == 'season_03') ? 'selected' : ''?>>Season 3</option>
							<option value="season_04" <?=(isset($data['season']) && $data['season'] == 'season_04') ? 'selected' : ''?>>Season 4</option>
							<option value="season_05" <?=(isset($data['season']) && $data['season'] == 'season_05') ? 'selected' : ''?>>Season 5</option>
							<option value="season_06" <?=(isset($data['season']) && $data['season'] == 'season_06') ? 'selected' : ''?>>Season 6</option>
							<option value="season_07" <?=(isset($data['season']) && $data['season'] == 'season_07') ? 'selected' : ''?>>Season 7</option>
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
			<a href='<?=$url?>podcast' class='btn btn-default'>Back</a>
			<button type="reset" class="btn btn-inverse">Clear</button>
		</div>
	</form>
</div>