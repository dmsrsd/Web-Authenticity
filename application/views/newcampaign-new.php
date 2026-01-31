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
	<form action="<?=base_url()?>cms/logic/newcampaignProses" method="post" data-parsley-validate enctype="multipart/form-data">
		<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
		<div class="panel-body"> 
			<?php if(isset($data['id_newcampaign']) && $data['id_newcampaign'] != ''): ?>
				<input type="hidden" name="id_member" value="<?=$data['id_member']?>" />
				<input type="hidden" name="_id" value="<?=$data['id_newcampaign']?>" />
				<!--<input type="hidden" name="img_box" value="<?=$data['box']?>" /> 
				<input type="hidden" name="img_box_cetak" value="<?=$data['box_cetak']?>" /> 
				<input type="hidden" name="img_lighter" value="<?=$data['lighter']?>" /> 
				<input type="hidden" name="img_lighter_cetak" value="<?=$data['lighter_cetak']?>" /> 
				<input type="hidden" name="img_tincase" value="<?=$data['tincase']?>" /> 
				<input type="hidden" name="img_tincase_cetak" value="<?=$data['tincase_cetak']?>" /> -->
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
						<label class="control-label">Image  </label>
					</div>
					<div class="col-sm-4"> 
						<?php if(isset($data['id_newcampaign']) && $data['id_newcampaign'] != '' && $data['box'] != ''): ?>
						<img src='<?php echo base_url();?>uploads/newcampaign/<?php echo $data['box'];?>' height='150' class='img'>
						<?php endif?>
						<!--<input name="box" type="file" class="form-control" <?php if(isset($data['id_newcampaign']) && $data['id_newcampaign'] != ''){}else{echo "required";} ?> >-->
					</div>
 
				</div>
			</div>   
			<div class='cl'></div>
			<hr> 
			
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
			<a href='<?=$url;?>newcampaign' class="btn btn-info btn-inverse">Kembali</a>
			<button type="submit" onclick=" " class="btn btn-primary">Update</button>
			<button type="reset" class="btn btn-default btn-inverse">Bersihkan</button>
		</div>
	</form>
</div>