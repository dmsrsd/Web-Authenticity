<?php
	$now = @$this->uri->segment(3);
	$cat = substr($now,-1);
?>
<h1 class="page-header">
	<?php
		echo $judul; 
		//echo md5("1q2w3e4r5t");
	?>
</h1>
<div class="panel panel-default">
<div class="panel-heading">
	<div class="row">
		<div class='col-sm-6'><?php echo $judul;?></div> 
		<div class='col-sm-6' align='right'>
			<a href="<?= base_url('cms/kotak/spinnerexport');?>" class="btn btn-success btn-sm"><i class=" fa fa-file"></i> Export Hanya Pemenang</a>
		</div>		
	</div>
</div>
<div class="panel-body">
	<div class="table-responsive" style="overflow-x: auto;">
		<table class="table table-striped table-bordered table-hover dataTablesmember" >
			<thead>
				<tr>
					<th width='35'>No</th>
					<th>Nama</th> 
					<th>Email</th> 
					<th>Instagram</th> 
					<th>Hp</th> 
					<th>Alamat</th> 
					<th>Nama Hadiah</th> 
					<th>Tanggal Spinner</th> 
				</tr>
			</thead>
			<tbody>
			<?php
				$no=1;
				if(isset($data) && count($data) > 0): foreach($data as $row):
					if($row['nama_hadiah']=="belum dapat"){
				?>
				<tr>
					<td align='center'><?=$no;?></td>
					<td><?=isset($row['member_nama']) ? $row['member_nama'] : ''?></td>
					<td><?=isset($row['email']) ? $row['email'] : ''?></td> 
					<td><?=isset($row['instagram']) ? $row['instagram'] : ''?></td>
					<td><?=isset($row['tlp']) ? $row['tlp'] : ''?></td> 
					<td><?=isset($row['address']) ? $row['address'] : ''?></td> 
					<td><?=isset($row['nama_hadiah']) ? $row['nama_hadiah'] : ''?></td> 
					<td><?=isset($row['created_date']) ? $row['created_date'] : ''?></td> 
				</tr>
				<?php
						}else{
				?>
				<tr>
					<td align='center'><?=$no;?></td>
					<td><?=isset($row['nama_user']) ? $row['nama_user'] : ''?></td>
					<td><?=isset($row['email']) ? $row['email'] : ''?></td> 
					<td><?=isset($row['akun_ig']) ? $row['akun_ig'] : ''?></td>
					<td><?=isset($row['hp']) ? $row['hp'] : ''?></td> 
					<td><?=isset($row['alamat']) ? $row['alamat'] : ''?></td> 
					<td><?=isset($row['nama_hadiah']) ? $row['nama_hadiah'] : ''?></td> 
					<td><?=isset($row['created_date']) ? $row['created_date'] : ''?></td> 
				</tr>
				<?php 
				}
				$no++;endforeach; endif; 
				?>
			</tbody>
		</table>
	</div>
</div>
</div>