
<link href="<?= base_url('assets/select2/select2.min.css') ?>" rel="stylesheet" />
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
	<form action="<?=base_url()?>cms/kotak/setupwinnerProses" method="post" data-parsley-validate enctype="multipart/form-data">
	<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
		<div class="panel-body">
			<div class="form-group">
				<div class="row">
					<div class="col-sm-3">
						<label class="control-label">Kode Hadiah <span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-3"> 
					<input type="text" class="form-control" value="<?=$data_hadiah['id_hadiah']?>" name="id_hadiah" readonly>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-sm-3">
						<label class="control-label">Nama Hadiah <span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-3"> 
					<input type="text" class="form-control" value="<?=$data_hadiah['nama_hadiah']?>" name="nama_hadiah" readonly>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-sm-3">
						<label class="control-label">Nama Member <span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-3"> 
						<select name="id_member" class="form-control select2" required>
					    <option value="">- Select -</option>
						<?php  if(isset($member) && count($member) > 0): foreach($member as $row): ?>
							<?php if($row['status']!=1){ ?>
								<option value="<?=$row['id_member']?>" ><?=$row['fullname']?></option>  
							<?php } ?>
						<?php endforeach; endif; ?>
						</select>
					</div>
				</div>
			</div>
		</div> 
		
		<div class="panel-footer">
			<button type="submit" onclick=" " class="btn btn-primary">Proses</button>
			<a href='<?= base_url('cms/kotak/setupwinner')?>' class='btn btn-default'>Kembali</a>
			<button type="reset" class="btn btn-inverse">Bersihkan</button>
		</div>
	</form>
</div>
<script src="<?= base_url('assets/front/js/jquery.js') ?>"></script>
<script src="<?= base_url('assets/select2/select2.min.js') ?>"></script>
<script>
// In your Javascript (external .js resource or <script> tag)
$('.select2').select2();
</script>