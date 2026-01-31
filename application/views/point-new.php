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
	<form action="<?=base_url()?>cms/logic/pointProses" method="post" data-parsley-validate enctype="multipart/form-data">
	<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
		<div class="panel-body">
			<?php if(isset($data['id_jenis_point']) && $data['id_jenis_point'] != ''): ?>
				<input type="hidden" name="_id" value="<?=$data['id_jenis_point']?>" /> 
				<input type="hidden" name="action" value="edit" /> 
			<?php endif; ?> 
 
			<div class="form-group">
				<div class="row">
					<div class="col-sm-3">
						<label class="control-label">Nama Point<span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-9"> 
						<input type='text' class='form-control' name='nama_point' value='<?=(isset($data['nama_point']) ? $data['nama_point'] : '')?>' required readonly>
					</div>
				</div>
			</div>	   
			<div class="form-group">
				<div class="row">
					<div class="col-sm-3">
						<label class="control-label">Point<span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-3"> 
						<input type='text' class='form-control' name='pts' value='<?=(isset($data['pts']) ? $data['pts'] : '')?>' required>
					</div>
				</div>
			</div> 
			 			
		</div> 
		
		<div class="panel-footer">
			<button type="submit" onclick=" " class="btn btn-primary">Proses</button>
			<a href='<?=$url?>point' class='btn btn-default'>Kembali</a>
			<button type="reset" class="btn btn-inverse">Bersihkan</button>
		</div>
	</form>
</div>