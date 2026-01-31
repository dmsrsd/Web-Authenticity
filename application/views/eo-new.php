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
	<form action="<?=base_url()?>cms/logic/eoProses" method="post" data-parsley-validate enctype="multipart/form-data">
	<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
		<div class="panel-body">
			<?php if(isset($data['id_eo']) && $data['id_eo'] != ''): ?>
				<input type="hidden" name="_id" value="<?=$data['id_eo']?>" /> 
				<input type="hidden" name="action" value="edit" /> 
			<?php endif; ?> 
 
			
			<div class="form-group">
				<div class="row">
					<div class="col-sm-3">
						<label class="control-label">Nama<span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-7"> 
						<input type='text' class='form-control' name='nama' value='<?=(isset($data['nama']) ? $data['nama'] : '')?>' required>
					</div>
				</div>
			</div>	   
			<div class="form-group">
				<div class="row">
					<div class="col-sm-3">
						<label class="control-label">Tlp<span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-5"> 
						<input type='text' class='form-control' name='tlp' value='<?=(isset($data['tlp']) ? $data['tlp'] : '')?>' required>
					</div>
				</div>
			</div>	   
			<div class="form-group">
				<div class="row">
					<div class="col-sm-3">
						<label class="control-label">Email<span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-5"> 
						<input type='email' class='form-control' name='email' value='<?=(isset($data['email']) ? $data['email'] : '')?>' required>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-sm-3">
						<label class="control-label">Alamat<span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-9"> 
						<input type='text' class='form-control' name='alamat' value='<?=(isset($data['alamat']) ? $data['alamat'] : '')?>' required>
					</div>
				</div>
			</div>	   
			<div class="form-group">
				<div class="row">
					<div class="col-sm-3">
						<label class="control-label">Mall ID<span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-3"> 
						<input type='text' class='form-control' name='mallid' value='<?=(isset($data['mallid']) ? $data['mallid'] : '')?>' required>
					</div>
				</div>
			</div>	   
			<div class="form-group">
				<div class="row">
					<div class="col-sm-3">
						<label class="control-label">Shared Key<span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-3"> 
						<input type='text' class='form-control' name='sharedkey' value='<?=(isset($data['sharedkey']) ? $data['sharedkey'] : '')?>' required>
					</div>
				</div>
			</div>	   
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">URL DOKU<span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-7"> 
						<input type='text' class='form-control'  name='urlpaydoku'  value='<?=(isset($data['urlpaydoku']) ? $data['urlpaydoku'] : '')?>' required>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-sm-3">
						<label class="control-label">Status <span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-3"> 
						<select name="status" class="form-control" required>
							<option value="">- Select -</option>
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
			<a href='<?=$url?>eo' class='btn btn-default'>Kembali</a>
			<button type="reset" class="btn btn-inverse">Bersihkan</button>
		</div>
	</form>
</div>