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
	<form action="<?=base_url()?>cms/kotak/hadiahProses" method="post" data-parsley-validate enctype="multipart/form-data">
	<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
		<div class="panel-body">
			<div class="form-group">
				<div class="row">
					<div class="col-sm-3">
						<label class="control-label">Nama Hadiah <span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-3"> 
					<input type='text' class='form-control' id='nama_hadiah' name='nama_hadiah' value='<?=(isset($data['nama_hadiah']) ? $data['nama_hadiah'] : '')?>'  required >
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-sm-3">
						<label class="control-label">Jumlah <span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-3"> 
					<input type='text' class='form-control' id='jumlah_hadiah' name='jumlah_hadiah' value='<?=(isset($data['jumlah_hadiah']) ? $data['jumlah_hadiah'] : '')?>'  required >
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-sm-3">
						<label class="control-label">Urutan <span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-3"> 
					<input type='text' class='form-control' id='urutan' name='urutan' value='<?=(isset($data['urutan']) ? $data['urutan'] : '')?>'  required >
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
							<option value="">Select</option>
							<?php  foreach ($status as $key => $value) { ?>
								<option value="<?=$key?>" <?=(isset($data['status']) && $data['status'] == $key) ? 'selected' : ''?>><?=$value?></option>  
							<?php } ?>
						</select>
					</div>
				</div>
			</div> 	
			
			<div class="form-group">
				<div class="row">
					<div class="col-sm-12">
						<label class="control-label">List Pemenang <span class="text-danger"></span></label>
						<table class="table table-striped table-bordered table-hover dataTablesmember" >
							<thead>
								<tr>
									<th width='35'>No</th>
									<th>Nama</th> 
									<th>Email</th> 
									<th>Jenis Hadiah</th> 
									<th>Status Hadiah</th> 
								</tr>
							</thead>
							<tbody>
								<div id="hasil"></div>
								<tr>
									<td colspan="5" class="text-center">
										<a class="btn btn-xs btn-warning" data-toggle="modal" data-target="#member">Tambah Pemenang</a>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		
			 			
		</div> 

		<div class="panel-footer">
			<button type="submit" onclick=" " class="btn btn-primary">Proses</button>
			<a href='<?= base_url('cms/kotak/setuphadiah')?>' class='btn btn-default'>Kembali</a>
			<button type="reset" class="btn btn-inverse">Bersihkan</button>
		</div>
	</form>
</div>

<div id="member" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Pilih dan Cari Pemenang</h4>
      </div>
      <div class="modal-body">
	  		<form>
				<div class="input-group">
					<input type="text" class="form-control" placeholder="Search">
					<div class="input-group-btn">
					<button class="btn btn-default" type="submit">
						<i class="glyphicon glyphicon-search"></i>
					</button>
					</div>
				</div>
			</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>