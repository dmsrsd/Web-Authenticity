<h1 class="page-header">
	<?php echo $judul;?>
</h1>
<div class="panel panel-default">
<div class="panel-heading">
	<div class="row">
		<div class='col-sm-6'><?php echo $judul;?> List</div>
		<div class='col-sm-6' align='right'>
			<a href="<?=$url?>galeri-new" class="btn btn-success btn-md"><i class=" fa fa-plus"></i> Tambah</a>
		</div>
	</div>
</div>
<div class="panel-body">
	<div class="table-responsive">
		<table class="table table-striped table-bordered table-hover dataTables" >
			<thead>
				<tr>
					<th width='35'>No</th> 
					<th>Nama</th> 
					<th width='70'>Status</th>
					<th width='70'></th>
				</tr>
			</thead>
			<tbody>
				<?php
					$no=1;
					if(isset($data) && count($data) > 0): foreach($data as $row):  
				?>
				<tr>
					<td align='center'><?=$no;?></td> 
					<td align='left'><?=$row['nama'];?></td> 
					<td align='center'>
						<a href='javascript:void(0);' class="label label-success" id='st-<?php echo $row['id_galeri'];?>' onclick="change_status('st-<?php echo $row['id_galeri'];?>','<?=isset($row['status']) ?  $status[$row['status']] : '-'?>','<?=$row['id_galeri']?>','<?=base_url()?>cms/logic/delete_ajax/galeri/<?=$row['id_galeri']?>')">
							<?php echo isset($row['status']) ?  $status[$row['status']] : '-'?>
						</a>
					</td>
					<td align='center'>
						<a href="<?=$url?>galeri-new?_id=<?=$row['id_galeri']?>" class='btn btn-xs btn-success '><i class="fa fa-edit "></i></a>
						<a class='btn btn-xs btn-danger' onclick="return confirm('Are you sure you want to delete this item?');" href="<?=base_url()?>cms/logic/delete/galeri/<?=$row['id_galeri']?>?part=galeri" class="text-danger"><i class="fa fa-trash-o"></i></a>					
					</td>
				</tr>
				<?php $no++; endforeach; endif; ?>
			</tbody>
		</table>
	</div>
</div>
</div>