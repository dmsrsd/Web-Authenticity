<h2 class="page-header">
	<?php echo $judul;?> 
</h2>
<form action="<?=base_url()?>cms/logic/homeProses" method="post"  enctype="multipart/form-data">
	<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
	<?php if(isset($data['id_website']) && $data['id_website'] != ''): ?> 
	<?php endif; ?>
	<input type="hidden" name="id_website" value="<?=$data['id_website']?>" />

	<div class="panel panel-default">
 		
		<div class="panel-heading">
			<div class="row">
				<div class='col-sm-6'>About</div>
				<div class='col-sm-6' align='right'></div>
			</div>
		</div>
		<div class="panel-body">
			<div class="form-group">
				<div class="row">
					<div class="col-sm-3">
						<label class="control-label">Text</label>
					</div>
					<div class="col-sm-9"> 
						<textarea class='form-control  tinymce-editoradv' rows='10' name='history_about'><?=(isset($data['history_about']) ? $data['history_about'] : '')?></textarea>
					</div>
				</div>
			</div> 
			<hr>
			<div class="form-group">
				<div class="row">
					<div class="col-sm-3">
						<label class="control-label">Shipping</label>
					</div>
					<div class="col-sm-9"> 
						<textarea class='form-control  tinymce-editoradv' rows='10' name='shipping'><?=(isset($data['shipping']) ? $data['shipping'] : '')?></textarea>
					</div>
				</div>
			</div>
			<hr>
			<div class="form-group">
				<div class="row">
					<div class="col-sm-3">
						<label class="control-label">Contact</label>
					</div>
					<div class="col-sm-9"> 
						<textarea class='form-control  tinymce-editoradv' rows='10' name='contact'><?=(isset($data['contact']) ? $data['contact'] : '')?></textarea>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-sm-3">
						
					</div>
					<div class="col-sm-9"> 
						<button type="submit" onclick=" " class="btn btn-primary">Update</button> 
					</div>
				</div>
			</div>
		</div>  
 
	</div>
</form>
 