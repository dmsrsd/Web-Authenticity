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
	<form action="<?=base_url()?>cms/logic/headkategoriProses" method="post" data-parsley-validate enctype="multipart/form-data">
	<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
		<div class="panel-body">  
			<?php if(isset($data['id_kategori']) && $data['id_kategori'] != ''): ?>
				<input type="hidden" name="_id" value="<?=$data['id_kategori']?>" />
				<input type="hidden" name="banner_awal" value="<?=$data['banner']?>" />
				<input type="hidden" name="action" value="edit" /> 
			<?php endif; ?> 

			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Head Kategori</label>
					</div>
					<div class="col-sm-7"> 
						<?=(isset($data['head_kategori']) ? $data['head_kategori'] : '')?>
					</div>
				</div>
			</div> 	 
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Header<span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-10"> 
						<input type='text' class='form-control' name='header' value='<?=(isset($data['header']) ? $data['header'] : '')?>' required>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Header 2<span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-10"> 
						<input type='text' class='form-control' name='header2' value='<?=(isset($data['header']) ? $data['header2'] : '')?>' required>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Deskripsi<span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-10"> 
						<input type='text' class='form-control' name='deskripsi' value='<?=(isset($data['deskripsi']) ? $data['deskripsi'] : '')?>' required>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Banner  </label>
					</div>
					<div class="col-sm-5"> 
						<?php if(isset($data['id_kategori']) && $data['id_kategori'] != '' && $data['banner'] != ''): ?>
						<img src='<?php echo base_url();?>uploads/headkategori/<?php echo $data['banner'];?>' height='150' class='img'>
						<?php endif?>
						<input name="banner" type="file" class="form-control" id="banner" <?php if(isset($data['id_kategori']) && $data['id_kategori'] != ''){}else{echo "required";} ?> >
					</div>
				</div>
			</div>
 	
		</div> 
		
		<div class="panel-footer">
			<button type="submit" onclick=" " class="btn btn-primary">Submit</button>
			<a href='<?=$url?>headkategori' class='btn btn-default'>Back</a> 
		</div>
	</form>
</div>