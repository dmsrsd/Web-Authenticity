	<h2 class="page-header">
	<?php echo $judul; 
	?> 
</h2>
<form action="<?=base_url()?>cms/logic/websiteProses" method="post" data-parsley-validate enctype="multipart/form-data">
<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
	<?php if(isset($data['id_website']) && $data['id_website'] != ''): ?>
		<input type="hidden" name="image_1" value="<?=$data['logo']?>" />
		<input type="hidden" name="image_2" value="<?=$data['meta_favicon']?>" />
		<input type="hidden" name="image_3" value="<?=$data['soundroombanner']?>" /> 
	<?php endif; ?>

	<div class="panel panel-default">
 		
		<div class="panel-heading">
			<div class="row">
				<div class='col-sm-6'>Website</div>
				<div class='col-sm-6' align='right'></div>
			</div>
		</div>
		<div class="panel-body">
			<div class="form-group"> 
				<div class="row">
					<div class="col-sm-3">
						<label>Meta Title</label>
					</div>
					<div class="col-sm-9">
						<input type='text' class='form-control' name='meta_title' value='<?=(isset($data['meta_title']) ? $data['meta_title'] : '')?>'>
					</div>
				</div>
			</div>
			<div class="form-group"> 
				<div class="row">
					<div class="col-sm-3">
						<label>Meta Description</label>
					</div>
					<div class="col-sm-9">
						<input type='text' class='form-control' name='meta_description' value='<?=(isset($data['meta_description']) ? $data['meta_description'] : '')?>'>
					</div>
				</div>
			</div>
			<div class="form-group"> 
				<div class="row">
					<div class="col-sm-3">
						<label>Meta Keyword</label>
					</div>
					<div class="col-sm-9">
						<input type='text' class='form-control' name='meta_keyword' value='<?=(isset($data['meta_keyword']) ? $data['meta_keyword'] : '')?>'>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-sm-3">
						<label class="control-label">Icon</em></label>
					</div>
					<div class="col-sm-4"> 
						<?php if(isset($data['meta_favicon']) && $data['meta_favicon'] != '' && $data['meta_favicon'] != ''): ?>
						<img src='<?php echo base_url();?>uploads/<?php echo $data['meta_favicon'];?>' height='150' class='img'>
						<?php endif?>
						<input name="meta_favicon" type="file" class="form-control" id="meta_favicon" <?=(isset($data['meta_favicon']) ? '' : 'required')?> >
					</div>
				</div>
			</div>			
			<div class="form-group">
				<div class="row">
					<div class="col-sm-3">
						<label class="control-label">Logo</em></label>
					</div>
					<div class="col-sm-4"> 
						<?php if(isset($data['logo']) && $data['logo'] != '' && $data['logo'] != ''): ?>
						<img src='<?php echo base_url();?>uploads/<?php echo $data['logo'];?>' height='150' class='img img-responsive'>
						<?php endif?>
						<input name="logo" type="file" class="form-control" id="logo" <?=(isset($data['logo']) ? '' : 'required')?> >
					</div>
				</div>
			</div>			
			<div class="form-group">
				<div class="row">
					<div class="col-sm-3">
						<label class="control-label">Banner Soundroom</em></label>
					</div>
					<div class="col-sm-4"> 
						<?php if(isset($data['soundroombanner']) && $data['soundroombanner'] != '' && $data['soundroombanner'] != ''): ?>
						<img src='<?php echo base_url();?>uploads/<?php echo $data['soundroombanner'];?>' height='150' class='img img-responsive'>
						<?php endif?>
						<input name="soundroombanner" type="file" class="form-control"  <?=(isset($data['soundroombanner']) ? '' : 'required')?> >
					</div>
				</div>
			</div>			
			<!--<div class="form-group"> 
				<div class="row">
					<div class="col-sm-3">
						<label>Facebook</label>
					</div>
					<div class="col-sm-5">
						<input type='text' class='form-control' name='facebook' value='<?=(isset($data['facebook']) ? $data['facebook'] : '')?>'>
					</div>
				</div>
			</div>-->
			<div class="form-group"> 
				<div class="row">
					<div class="col-sm-3">
						<label>Instagram</label>
					</div>
					<div class="col-sm-5">
						<input type='text' class='form-control' name='instagram' value='<?=(isset($data['instagram']) ? $data['instagram'] : '')?>'>
					</div>
				</div>
			</div>
			<div class="form-group"> 
				<div class="row">
					<div class="col-sm-3">
						<label>Youtube</label>
					</div>
					<div class="col-sm-5">
						<input type='text' class='form-control' name='youtube' value='<?=(isset($data['youtube']) ? $data['youtube'] : '')?>'>
					</div>
				</div>
			</div> 
			<hr>
			<div class="form-group"> 
				<div class="row">
					<div class="col-sm-3">
						<label>TNC Redeem</label>
					</div>
					<div class="col-sm-9">
						<textarea rows='15' class="form-control tinymce-editoradv"  name="tnc_redeem"><?=(isset($data['tnc_redeem']) ? $data['tnc_redeem'] : '')?></textarea>
					</div>
				</div>
			</div> 
			<div class="form-group"> 
				<div class="row">
					<div class="col-sm-3">
						<label>Time Read Article</label>
					</div>
					<div class="col-sm-2">
						<input type='number' class='form-control'  name='time_read' value='<?=(isset($data['time_read']) ? $data['time_read'] : '')?>'>
						<em>Satuan Menit</em>
					</div>
				</div>
			</div> 
			<div class="form-group"> 
				<div class="row">
					<div class="col-sm-3">
						<label>TNC Scrable</label>
					</div>
					<div class="col-sm-9">
						<textarea rows='15' class="form-control tinymce-editoradv"  name="tnc_scrable"><?=(isset($data['tnc_scrable']) ? $data['tnc_scrable'] : '')?></textarea>
					</div>
				</div>
			</div> 
			<div class="form-group"> 
				<div class="row">
					<div class="col-sm-3">
						<label>Time Simply Scrable</label>
					</div>
					<div class="col-sm-2">
						<input type='number' class='form-control'  name='time_scrable' value='<?=(isset($data['time_scrable']) ? $data['time_scrable'] : '')?>'>
						<em>Satuan Menit</em>
					</div>
				</div>
			</div> 
			<br>
			<hr>
			<h3>Midtrans</h3>
			</br>
			<div class="form-group"> 
				<div class="row">
					<div class="col-sm-3">
						<label>Merchang ID</label>
					</div>
					<div class="col-sm-2">
						<input type='text' class='form-control'  name='mpaymerchant' value='<?=(isset($data['mpaymerchant']) ? $data['mpaymerchant'] : '')?>'>
					</div>
				</div>
			</div> 
			<div class="form-group"> 
				<div class="row">
					<div class="col-sm-3">
						<label>Client Key</label>
					</div>
					<div class="col-sm-8">
						<input type='text' class='form-control'  name='mpaykey' value='<?=(isset($data['mpaykey']) ? $data['mpaykey'] : '')?>'>
					</div>
				</div>
			</div> 
			<div class="form-group"> 
				<div class="row">
					<div class="col-sm-3">
						<label>Server Key</label>
					</div>
					<div class="col-sm-8">
						<input type='text' class='form-control'  name='mpaysec' value='<?=(isset($data['mpaysec']) ? $data['mpaysec'] : '')?>'>
					</div>
				</div>
			</div> 
			
		</div> 

		 
		 
		 

		<div class="panel-footer">
			<button type="submit" onclick=" " class="btn btn-primary">Proses</button> 
		</div>
	</div>
</form>