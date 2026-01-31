<h1 class="page-header">
	<?php echo $judul;?>
</h1>
<div class="panel panel-default">
<div class="panel-heading">
	<div class="row">
		<div class='col-sm-6'><?php echo $judul;?> List</div>
		<div class='col-sm-6' align='right'> 
		</div>
	</div>
</div>
<div class="panel-body">
	<div class="table-responsive">
		<table class="table table-striped table-bordered table-hover dataTables" >
			<thead>
				<tr>
					<th width='35'>No</th> 
					<th>Nama Point</th> 
					<th>Point</th>  
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
					<td align='left'><?=$row['nama_point'];?></td> 
					<td align='left'><?=$row['pts'];?></td> 
					<td align='center'>
						<a href="<?=$url?>point-new?_id=<?=$row['id_jenis_point']?>" class='btn btn-xs btn-success '><i class="fa fa-edit "></i></a>
					</td>
				</tr>
				<?php $no++; endforeach; endif; ?>
			</tbody>
		</table>
	</div>
</div>
</div>