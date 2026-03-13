<?php //print_r($data); exit;
	$now = @$this->uri->segment(3);
?>
<div class="panel panel-default">
	<div class="panel-heading">
		<div class="row">
			<div class='col-sm-6'><?php echo isset($data['nama_outlet']) ? htmlspecialchars($data['nama_outlet']) : 'Tambah Hangout';?></div>
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
	<?php if(isset($data)){ ?> 
		<form action="<?=base_url()?>cms/event/Prosesedithangout" method="post" data-parsley-validate enctype="multipart/form-data">
		<input type="hidden" name="image_old" value="<?= $data['media_source']; ?>">
		<input type="hidden" name="_id" value="<?= $data['id_outlet']; ?>">
	<?php } else { ?>
		<form action="<?=base_url()?>cms/event/Prosescreatehangout" method="post" data-parsley-validate enctype="multipart/form-data">
	<?php } ?>
		<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
		<div class="panel-body"> 
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Kota<span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-8"> 
						<select name="kota" class="form-control" required>
							<option value="">Select</option>
							<?php foreach($provinsi as $row){ ?> 
								<option value="<?php echo $row['nama_kota'] ?>" <?=(isset($data['kota']) && $data['kota'] == $row['nama_kota']) ? 'selected' : ''?>><?php echo $row['nama_kota'] ?></option> 
							<?php } ?>
						</select>
					</div>
				</div>
			</div> 	  
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Nama <span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-8">
						<input type='text' name='nama_outlet' id='nama_outlet' required value='<?=(isset($data['nama_outlet']) ? $data['nama_outlet'] : '')?>' class='form-control '>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Alamat (gmaps) <span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-8">
						<input type='text' name='alamat' id='alamat' required value='<?=(isset($data['alamat']) ? $data['alamat'] : '')?>' class='form-control '>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Sosial Media<span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-8">
						<input type='text' name='sosmed' id='sosmed' required value='<?=(isset($data['sosmed']) ? $data['sosmed'] : '')?>' class='form-control '>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Sosial Media Link<span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-8">
						<input type='text' name='sosmed_url' id='sosmed_url' required value='<?=(isset($data['sosmed_url']) ? $data['sosmed_url'] : '')?>' class='form-control '>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Image Source <span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-4"> 
						<?php if(isset($data['media_source']) && $data['media_source'] != ''): ?>
						<img src='<?php echo $data['media_source'];?>' height='150' class='img'>
						<?php endif?>
						<input name="image" type="file" class="form-control" id="image" <?php if(isset($data['media_source']) && $data['media_source'] != ''){}else{echo "required";} ?> >
						<em>1140 x 654</em>
					</div>
					<div class="col-sm-1">
						<label class="control-label">Status <span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-3"> 
						<select name="status" class="form-control" required>
								<option value="1" <?=(isset($data['status']) && $data['status'] == '1') ? 'selected' : ''?>>Publish</option> 
								<option value="0" <?=(isset($data['status']) && $data['status'] == '0') ? 'selected' : ''?>>Disabled</option> 
						</select>
					</div>
				</div>
			</div> 	
		</div> 
		
		<div class="panel-footer">
			<button type="submit" onclick=" " class="btn btn-primary">Submit</button>
			<a href='<?=base_url('cms/event/hangout')?>' class='btn btn-default'>Back</a>
			<button type="reset" class="btn btn-inverse">Clear</button>
		</div>
	</form>
</div>

<script>
	function formatRupiah(angka) {
		return new Intl.NumberFormat('id-ID', {
			style: 'currency',
			currency: 'IDR',
			minimumFractionDigits: 0
		}).format(angka);
	}

	document.querySelectorAll('.rupiah').forEach(function(input) {
		input.addEventListener('keyup', function(e) {
			let angka = this.value.replace(/[^,\d]/g, '');
			if(angka) {
				this.value = formatRupiah(angka);
			} else {
				this.value = '';
			}
		});
	});
</script>
