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
	<form action="<?=base_url()?>cms/logic/ticketProses" method="post" data-parsley-validate enctype="multipart/form-data">
	<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
		<div class="panel-body">  
			<?php if(isset($data['id_ticket']) && $data['id_ticket'] != ''): ?>
				<input type="hidden" name="_id" value="<?=$data['id_ticket']?>" />
				<input type="hidden" name="img_awal" value="<?=$data['image']?>" />
				<input type="hidden" name="img_awal_mobile" value="<?=$data['image_mobile']?>" />
				<input type="hidden" name="action" value="edit" /> 
			<?php endif; ?>  
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">EO <span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-4">
						<select name="id_eo" class="form-control" required>
							<option value="">Select</option>
							<?php
							if(isset($eo) && count($eo) > 0): foreach($eo as $row ):?>
								<option value="<?=$row['id_eo']?>" <?=(isset($data['id_eo']) && $data['id_eo'] == $row['id_eo']) ? 'selected' : ''?>><?=$row['nama']?> |  MID : <?=$row['mallid']?> | SK : <?=$row['sharedkey']?></option>  
							<?php endforeach; endif;  ?>
						</select>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Jenis Event <span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-3"> 
						<select name="id_jenistiket" class="form-control" required>
							<option value="">Select</option>
							<?php  foreach ($jenistiket as $key => $value) { ?>
								<option value="<?=$key?>" <?=(isset($data['id_jenistiket']) && $data['id_jenistiket'] == $key) ? 'selected' : ''?>><?=$value?></option>  
							<?php } ?>
						</select>
					</div>
				</div>
			</div> 	
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Judul<span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-7"> 
						<input type='text' class='form-control'  name='judul'  id='judul-ticket' value='<?=(isset($data['judul']) ? $data['judul'] : '')?>' required>
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
						<label class="control-label">Di<span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-7"> 
						<input type='text' class='form-control'   name='dimana' value='<?=(isset($data['dimana']) ? $data['dimana'] : '')?>' required>
					</div>
				</div>
			</div> 
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Kota<span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-7"> 
						<input type='text' class='form-control'   name='kota' value='<?=(isset($data['kota']) ? $data['kota'] : '')?>' required>
					</div>
				</div>
			</div> 
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Tanggal<span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-3"> 
						<input type='text' class='form-control datepicker' data-date-format='yyyy-mm-dd'  name='tanggal' value='<?=(isset($data['tanggal']) ? $data['tanggal'] : '')?>' required>
					</div>
				</div>
			</div> 
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Harga<span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-3"> 
						<input type='number' class='form-control' name='harga' value='<?=(isset($data['harga']) ? $data['harga'] : '')?>'>
					</div>
				</div>
			</div> 
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Qty Online Set<span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-3"> 
						<input type='text' class='form-control'  name='qty_online_start'  value='<?=(isset($data['qty_online_start']) ? $data['qty_online_start'] : '')?>' required>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Qty Online<span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-3"> 
						<input type='text' class='form-control'  name='qty_online'  value='<?=(isset($data['qty_online']) ? $data['qty_online'] : '')?>' required>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Qty Offline<span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-3"> 
						<input type='text' class='form-control'  name='qty_offline'   value='<?=(isset($data['qty_offline']) ? $data['qty_offline'] : '')?>' required>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Deskripsi<span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-7"> 
						<textarea class='form-control tinymce-editoradv'   name='deskripsi' ><?=(isset($data['deskripsi']) ? $data['deskripsi'] : '')?></textarea>
					</div>
				</div>
			</div> 
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Note<span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-7"> 
						<textarea class='form-control'   name='note' ><?=(isset($data['note']) ? $data['note'] : '')?></textarea>
					</div>
				</div>
			</div> 
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Image  </label>
					</div>
					<div class="col-sm-4"> 
						<?php if(isset($data['id_ticket']) && $data['id_ticket'] != '' && $data['image'] != ''): ?>
						<img src='<?php echo base_url();?>uploads/ticket/<?php echo $data['image'];?>' height='150' class='img'>
						<?php endif?>
						<input name="image" type="file" class="form-control" id="image" <?php if(isset($data['id_ticket']) && $data['id_ticket'] != ''){}else{echo "required";} ?> >
						<em>1140 x 654</em>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Image  Mobile</label>
					</div>
					<div class="col-sm-4"> 
						<?php if(isset($data['id_ticket']) && $data['id_ticket'] != '' && $data['image_mobile'] != ''): ?>
						<img src='<?php echo base_url();?>uploads/ticket/<?php echo $data['image_mobile'];?>' height='150' class='img'>
						<?php endif?>
						<input name="image_mobile" type="file" class="form-control" id="image_mobile" <?php if(isset($data['id_ticket']) && $data['id_ticket'] != ''){}else{echo "required";} ?> >
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Preview QR (Game)<span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-3"> 
						<?php if(isset($data['id_ticket']) && $data['id_ticket'] != ''): ?>
						<img src='<?=base_url();?>uploads/ticket/qr/<?=$data['qrgame'];?>' id='prev-qr'  class='img img-responsive'>
						<a href='<?=base_url();?>uploads/ticket/qr/<?=$data['qrgame'];?>' download='<?=$data['qrgame'];?>' class='btn btn-md btn-default'><i class='fa fa-download'></i> Download</a>
						<?php endif?>
					</div>
				</div>
			</div> 	
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Preview QR (Purchase)<span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-3"> 
						<?php if(isset($data['id_ticket']) && $data['id_ticket'] != ''): ?>
						<img src='<?=base_url();?>uploads/ticket/qr/<?=$data['qrpurchase'];?>' id='prev-qr'  class='img img-responsive'>
						<a href='<?=base_url();?>uploads/ticket/qr/<?=$data['qrpurchase'];?>' download='<?=$data['qrpurchase'];?>' class='btn btn-md btn-default'><i class='fa fa-download'></i> Download</a>
						<?php endif?>
					</div>
				</div>
			</div> 	
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Publish <span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-3"> 
						<select name="mode" class="form-control" required>
							<option value="">Select</option>
							<?php  foreach ($status as $key => $value) { ?>
								<option value="<?=$key?>" <?=(isset($data['mode']) && $data['mode'] == $key) ? 'selected' : ''?>><?=$value?></option>  
							<?php } ?>
						</select>
					</div>
				</div>
			</div> 	
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Button Coming Soon <span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-3"> 
						<select name="btncomingsoon" class="form-control" required>
							<option value="">Select</option>
							<?php  foreach ($status as $key => $value) { ?>
								<option value="<?=$key?>" <?=(isset($data['btncomingsoon']) && $data['btncomingsoon'] == $key) ? 'selected' : ''?>><?=$value?></option>  
							<?php } ?>
						</select>
					</div>
				</div>
			</div> 	
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Button Sold Out <span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-3"> 
						<select name="btnsoldout" class="form-control" required>
							<option value="">Select</option>
							<?php  foreach ($status as $key => $value) { ?>
								<option value="<?=$key?>" <?=(isset($data['btnsoldout']) && $data['btnsoldout'] == $key) ? 'selected' : ''?>><?=$value?></option>  
							<?php } ?>
						</select>
					</div>
				</div>
			</div> 	
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Button Buy <span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-3"> 
						<select name="btnbuy" class="form-control" required>
							<option value="">Select</option>
							<?php  foreach ($status as $key => $value) { ?>
								<option value="<?=$key?>" <?=(isset($data['btnbuy']) && $data['btnbuy'] == $key) ? 'selected' : ''?>><?=$value?></option>  
							<?php } ?>
						</select>
					</div>
				</div>
			</div> 	
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Url Buy Website lain<span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-8"> 
						<input type='text' class='form-control'  name='urlbuyother'   value='<?=(isset($data['urlbuyother']) ? $data['urlbuyother'] : '')?>'>
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
			<a href='<?=$url?>ticket' class='btn btn-default'>Back</a>
			<button type="reset" class="btn btn-inverse">Clear</button>
		</div>
	</form>
</div>