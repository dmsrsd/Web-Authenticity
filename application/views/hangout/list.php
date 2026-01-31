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
			<a href="<?=base_url('cms/event/hangoutnew')?>" class="btn btn-success btn-sm"><i class=" fa fa-plus"></i> Tambah</a>
		</div>
			
	</div>
</div>
<div class="panel-body">
	<div class="table-responsive">
		<table class="table table-striped table-bordered table-hover dataTablesmember" >
			<thead>
				<tr>
					<th width='35'>No</th>
					<th>Kota</th> 
					<th>Nama Outlet</th> 
					<th>Gambar</th>
					<th>Status</th>
					<th>created date</th> 
					<th></th> 
				</tr>
			</thead>
			<tbody>
			<?php
				$no=1;
				if(isset($data) && count($data) > 0): foreach($data as $row):
			?>
				<tr>
					<td><?=$no;?></td> 
					<td><?=isset($row['kota']) ? $row['kota'] : ''?></td> 
					<td><?=isset($row['nama_outlet']) ? $row['nama_outlet'] : ''?></td>
					<td><?=isset($row['media_source']) ? '<a href="'.$row['media_source'].'" target="_blank"><img src="'.$row['media_source'].'" width="100px"></a>' : ''?></td> 
					
					<td><?=($row['status'] ==1) ? 'active' : 'disabled'?></td>
					<td><?=isset($row['created_date']) ? $row['created_date'] : ''?></td> 
					<td align='center'>
						<a href="<?=base_url()?>cms/event/hangoutedit/<?=$row['id_outlet']?>" class='btn btn-xs btn-success '><i class="fa fa-edit "></i></a>
						<a title="Delete" class='btn btn-xs btn-danger' onclick="return confirm('Are you sure you want to delete this item?');" href="<?=base_url()?>cms/event/hangoutdeletesoft/<?=$row['id_outlet']?>" class="text-danger"><i class="fa fa-trash-o"></i></a>
					</td>
				</tr>
				<?php $no++;endforeach; endif; ?>
			</tbody>
		</table>
	</div>
</div>
</div>