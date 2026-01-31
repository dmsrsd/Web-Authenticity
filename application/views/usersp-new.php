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
	<form action="<?=base_url()?>cms/logic/userspProses" method="post" data-parsley-validate enctype="multipart/form-data">
	<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
		<div class="panel-body">  
			<?php if(isset($data['id_usersp']) && $data['id_usersp'] != ''): ?>
				<input type="hidden" name="_id" value="<?=$data['id_usersp']?>" /> 
				<input type="hidden" name="action" value="edit" /> 
			<?php endif; ?> 
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Event/Ticket <span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-4">
						<select name="id_ticket" class="form-control" required <?=isset($data['id_usersp']) ? "disabled":"" ;?>>
							<option value="">Select</option>
							<?php
							if(isset($tiket) && count($tiket) > 0): foreach($tiket as $row ):?>
								<option value="<?=$row['id_ticket']?>" <?=(isset($data['id_usersp']) && $data['id_ticket'] == $row['id_ticket']) ? 'selected' : ''?>><?=$row['judul']?></option>  
							<?php endforeach; endif;  ?>
						</select>
					</div>
				</div>
			</div>

			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Name<span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-7"> 
						<input type='text' class='form-control' name='name' value='<?=(isset($data['name']) ? $data['name'] : '')?>' required>
					</div>
				</div>
			</div>			
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Tlp./HP<span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-7"> 
						<input type='text' class='form-control' name='tlp' value='<?=(isset($data['tlp']) ? $data['tlp'] : '')?>' required>
					</div>
				</div>
			</div>			
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Alamat<span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-7"> 
						<input type='text' class='form-control' name='alamat' value='<?=(isset($data['alamat']) ? $data['alamat'] : '')?>' required>
					</div>
				</div>
			</div>			
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Username<span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-7"> 
						<input type='text' class='form-control' name='username' value='<?=(isset($data['username']) ? $data['username'] : '')?>' required>
					</div>
				</div>
			</div>			
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Password<span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-7"> 
						<input type='password' class='form-control' name='password' value='' >
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
			<a href='<?=$url?>usersp' class='btn btn-default'>Back</a>
			<button type="reset" class="btn btn-inverse">Clear</button>
		</div>
	</form>
</div>