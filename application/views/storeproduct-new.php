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
	<form action="<?=base_url()?>cms/logic/storeproductProses?p=<?=$_GET['p'];?>" method="post" data-parsley-validate enctype="multipart/form-data">
		<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
		<?php if(isset($_GET['p']) && $_GET['p'] != ''){ ?>
			<input type="hidden" name="id_store" value="<?=$_GET['p'];?>" style="display: none">
		<?php } else { ?> 
			<div class="panel-body"> 
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Store<span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-8"> 
						<select name="id_store" class="form-control" required>
							<option value="">Select Store</option>
							<?php  foreach ($store as $key => $value) { ?>
								<option value="<?=$value['id_store']?>"<?=(isset($data['id_store']) && $data['id_store'] == $value['id_store']) ? 'selected' : ''?>><?=$value['judul']?></option>  
							<?php } ?>
						</select>
					</div>
				</div>
			</div>  
		<?php } ?>
		<div class="panel-body"> 
			<?php if(isset($data['id_storeproduct']) && $data['id_storeproduct'] != ''): ?>
				<input type="hidden" name="_id" value="<?=$data['id_storeproduct']?>" />
				<input type="hidden" name="img" value="<?=$data['image']?>" />
				<input type="hidden" name="action" value="edit" /> 
			<?php endif; ?> 
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Judul<span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-8"> 
						<input type='text' class='form-control' id='judul' name='judul' value='<?=(isset($data['judul']) ? $data['judul'] : '')?>'  required >
					</div>
				</div>
			</div>    
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Slug<span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-8"> 
						<input type='text' class='form-control' id='slug' name='slug' value='<?=(isset($data['slug']) ? $data['slug'] : '')?>'  required >
					</div>
				</div>
			</div> 
				
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Deskripsi <span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-8">
						<textarea rows='5' class="form-control" name="deskripsi"><?=(isset($data['deskripsi']) ? $data['deskripsi'] : '')?></textarea>
					</div>
				</div>
			</div> 		
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Detail Produk <span class="text-danger">*</span></label>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12"> 
						<textarea rows='15' class="form-control tinymce-editoradv"  name="detail_produk"><?=(isset($data['detail_produk']) ? $data['detail_produk'] : '')?></textarea>
					</div>
				</div>
			</div>
			
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">URL</label>
					</div>
					<div class="col-sm-8"> 
						<input type='text' class='form-control'  name='url' value='<?=(isset($data['url']) ? $data['url'] : '')?>' >
						<em>*) Kosongkan bila tidak ada spesific url</em>
					</div>
				</div>
			</div> 	  
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Button Label</label>
					</div>
					<div class="col-sm-4"> 
						<input type='text' class='form-control'  name='button' value='<?=(isset($data['button']) ? $data['button'] : '')?>' required>
					</div>
				</div>
			</div> 	  
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Harga</label>
					</div>
					<div class="col-sm-4"> 
						<input type='number' class='form-control'  name='harga' value='<?=(isset($data['harga']) ? $data['harga'] : '')?>' required>
					</div>
				</div>
			</div> 	  
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Image  </label>
					</div>
					<div class="col-sm-5"> 
						<?php if(isset($data['id_storeproduct']) && $data['id_storeproduct'] != '' && $data['image'] != ''): ?>
						<img src='<?php echo base_url();?>uploads/store/<?php echo $data['image'];?>' height='150' class='img'>
						<?php endif?>
						<input name="image" type="file" class="form-control" <?php if(isset($data['id_storeproduct']) && $data['id_storeproduct'] != ''){}else{echo "required";} ?> >
						
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
			<a href='<?=$url."storeproduct?p=".$_GET['p']?>' class='btn btn-default'>Back</a>
			<button type="reset" class="btn btn-inverse">Clear</button>
		</div>
	</form>
</div>