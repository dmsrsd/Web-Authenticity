<?php //print_r($data); exit;
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
	<?php if(isset($data)){ ?> 
		<form action="<?=base_url()?>cms/event/Prosesedit" method="post" data-parsley-validate enctype="multipart/form-data">
		<input type="hidden" name="image_old" value="<?= $data['image']; ?>">
		<input type="hidden" name="_id" value="<?= $data['id_event']; ?>">
	<?php } else { ?>
		<form action="<?=base_url()?>cms/event/Prosescreate" method="post" data-parsley-validate enctype="multipart/form-data">
	<?php } ?>
		<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
		<div class="panel-body"> 
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
						<label class="control-label">Event mulai<span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-3">
						<input type='date' name='periode_start' id='periode_start' 
							value="<?= isset($data['periode_start']) ? $data['periode_start'] : '' ?>" 
							required class='form-control'>
					</div>
					<div class="col-sm-2">
						<label class="control-label">Event selesai<span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-3">
						<input type='date' name='periode_end' id='periode_end' 
							value="<?= isset($data['periode_end']) ? $data['periode_end'] : '' ?>" 
							class='form-control'>
					</div>
				</div>
			</div> 				

			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">HTM mulai<span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-3">
						<input type='text' name='htm_start' id='htm_start' 
							value="<?= isset($data['htm_start']) ? $data['htm_start'] : '' ?>" 
							required class='form-control rupiah'>
					</div>
					<div class="col-sm-2">
						<label class="control-label">HTM selesai<span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-3">
						<input type='text' name='htm_end' id='htm_end' 
							value="<?= isset($data['htm_end']) ? $data['htm_end'] : '' ?>" 
							required class='form-control rupiah'>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Lokasi <span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-8">
						<input type='text' name='lokasi' id='lokasi' 
							value='<?=(isset($data['lokasi']) ? $data['lokasi'] : '')?>' 
							class='form-control '>
					</div>
				</div>
			</div> 
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Link IG <span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-8">
						<input type='text' name='link_ig' id='link_ig' required 
							value='<?=(isset($data['link_ig']) ? $data['link_ig'] : '')?>' 
							class='form-control '>
					</div>
				</div>
			</div>  

			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">URL Tiket <span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-8">
						<input type='text' name='url_tiket' id='url_tiket' required 
							value='<?=(isset($data['url_tiket']) ? $data['url_tiket'] : '')?>' 
							class='form-control '>
					</div>
				</div>
			</div> 	  
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Thumbnail  </label>
					</div>
					<div class="col-sm-5"> 
						<?php if(isset($data['id_event']) && $data['id_event'] != '' && $data['image'] != ''): ?>
						<img src='<?php echo base_url();?>uploads/events/<?php echo $data['image'];?>' height='150' class='img'>
						<?php endif?>
						<input name="image" type="file" class="form-control" id="image" <?php if(isset($data['id_event']) && $data['id_event'] != ''){}else{echo "required";} ?> >
						<em>1140 x 654</em>
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
								<option value="sold out" <?=(isset($data['status']) && $data['status'] == 'sold out') ? 'selected' : ''?>>sold out</option> 
								<option value="ready" <?=(isset($data['status']) && $data['status'] == 'ready') ? 'selected' : ''?>>ready</option> 
						</select>
					</div>
				</div>
			</div> 	
		</div> 
		
		<div class="panel-footer">
			<button type="submit" onclick=" " class="btn btn-primary">Submit</button>
			<a href='<?=base_url('cms/event')?>podcast' class='btn btn-default'>Back</a>
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
