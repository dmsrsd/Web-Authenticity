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
	?>	<?php echo $data; exit; ?>
	<form action="<?=base_url()?>cms/kotak/memberbarcodeeditProses" method="post" data-parsley-validate enctype="multipart/form-data">
	<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
		<div class="panel-body">
		  <div class="form-group">
            <label>Nama :</label>
            <input type="text" class="form-control" name="nama_user" value="<?=(isset($data['nama_user']) ? $data['nama_user'] : $data['fullname'])?>" required>
          </div>
		  <div class="form-group">
            <label>Nama Hadiah :</label>
            <input type="text" class="form-control" name="nama_hadiah" value="<?=(isset($data['nama_hadiah']) ? $data['nama_hadiah'] : '')?>" required>
          </div>
          <div class="form-group">
            <label>Link Akun IG :</label>
            <input type="text" class="form-control" placeholder="Link Akun IG" name="akun_ig" maxlength="200" value="<?=(isset($data['akun_ig']) ? $data['akun_ig'] : '')?>" required>
          </div>
          <div class="form-group">
            <label>Alamat Lengkap Pengiriman :</label>
            <textarea name="alamat" rows="3" class="form-control"  value="<?=(isset($data['alamat']) ? $data['alamat'] : '')?>" required></textarea>
          </div>
          <div class="form-group">
            <label>No HP :</label>
            <input type="text" class="form-control" placeholder="08XXXXXXXXXX" name="no_hp" maxlength="15" value="<?=(isset($data['hp']) ? $data['hp'] : '')?>" required>
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