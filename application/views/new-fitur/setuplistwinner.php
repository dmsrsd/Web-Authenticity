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
		<a href="<?=base_url()?>cms/kotak/setupwinnerNew/<?= $this->uri->segment(4); ?>" class="btn btn-success btn-sm"><i class=" fa fa-plus"></i> Tambah</a>
			<!--<a href="<?=$url?>member-excel" class="btn btn-success btn-sm"><i class=" fa fa-file"></i> Export Excel</a>-->
		</div>		
	</div>
</div>
<div class="panel-body">
	<div class="table-responsive">
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
			<?php
				$no=1;
				if(isset($data) && count($data) > 0): foreach($data as $row):
			?>
				<tr>
					<td align='center'><?=$no;?></td>
					<td><?=isset($row['member']) ? $row['member'] : ''?></td> 
					<td><?=isset($row['email']) ? $row['email'] : ''?></td> 
					<td><?=isset($row['nama_hadiah']) ? $row['nama_hadiah'] : ''?></td>
					<td align='center'>
						<?= ($row['status']==0)? '<a class="btn btn-xs btn-warning">diklaim</a>' : '<a class="btn btn-xs btn-success">aktif</a>';?>				
					</td>
				</tr>
				<?php $no++;endforeach; endif; ?>
			</tbody>
		</table>
	</div>
</div>
</div>