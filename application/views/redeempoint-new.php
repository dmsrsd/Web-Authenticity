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
	<form action="<?=base_url()?>cms/logic/redeempointProses" method="post" data-parsley-validate enctype="multipart/form-data">
	<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
		<div class="panel-body"> 
			<?php if(isset($data['id_redeempoint']) && $data['id_redeempoint'] != ''): ?>
				<input type="hidden" name="_id" value="<?=$data['id_redeempoint']?>" />
				<input type="hidden" name="img_awal" value="<?=$data['image']?>" /> 
				<input type="hidden" name="action" value="edit" /> 
			<?php endif; ?> 

			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Nama<span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-7"> 
						<input type='text' class='form-control'  name='nama' value='<?=(isset($data['nama']) ? $data['nama'] : '')?>' required>
					</div>
				</div>
			</div>  	 
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Image  </label>
					</div>
					<div class="col-sm-5"> 
						<?php if(isset($data['id_redeempoint']) && $data['id_redeempoint'] != '' && $data['image'] != ''): ?>
						<img src='<?php echo base_url();?>uploads/redeem/<?php echo $data['image'];?>' height='150' class='img'>
						<?php endif?>
						<input name="image" type="file" class="form-control" id="image" <?php if(isset($data['id_redeempoint']) && $data['id_redeempoint'] != ''){}else{echo "required";} ?> >
						<em>*) Max. size image (1MB), 180px X 180px</em>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Point<span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-3"> 
						<input type='number' class='form-control'  name='point' value='<?=(isset($data['point']) ? $data['point'] : '')?>' required>
					</div>
				</div>
			</div> 	 
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Qty<span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-3"> 
						<input type='number' class='form-control'  name='qty' value='<?=(isset($data['qty']) ? $data['qty'] : '')?>' required>
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
			<a href='<?=$url?>redeempoint' class='btn btn-default'>Kembali</a>
			<button type="reset" class="btn btn-inverse">Bersihkan</button>
		</div>
	</form>
</div>