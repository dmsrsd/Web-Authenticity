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
	<form action="<?=base_url()?>cms/kotak/kotakbarcodeProses" method="post" data-parsley-validate enctype="multipart/form-data">
	<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
		<div class="panel-body">
			<div class="form-group">
				<div class="row">
					<div class="col-sm-3">
						<label class="control-label">Type Reddem <span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-3"> 
						<select name="type" class="form-control" required>
							<option value="">- Select -</option>
							<option value="silver">Silver</option>
							<option value="redmax">Redmax</option>
							<option value="purple">Purple</option>
							
						</select>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-sm-3">
						<label class="control-label">Jenis Point <span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-3"> 
						<select name="jenis_point" class="form-control" required>
							<option value="">- Select -</option>
							<?php  if(isset($data) && count($data) > 0): foreach($data as $row): ?>
								<option value="<?=$row['id_jenis_point']?>" ><?=$row['nama_point']?>/pts:<?=$row['pts']?></option>  
							<?php endforeach; endif; ?>
						</select>
					</div>
				</div>
			</div>
			   
			<div class="form-group">
				<div class="row">
					<div class="col-sm-3">
						<label class="control-label">Quantity<span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-3"> 
						<input type='number' class='form-control' id='qty' name='qty' value='' required>
					</div>
				</div>
			</div>
			
			 			
		</div> 
		
		<div class="panel-footer">
			<button type="submit" onclick=" " class="btn btn-primary">Proses</button>
			<a href='<?=$url?>kotakbarcode' class='btn btn-default'>Kembali</a>
			<button type="reset" class="btn btn-inverse">Bersihkan</button>
		</div>
	</form>
</div>