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
		<div class='col-sm-6'><?php echo $judul;?> List</div>
		<div class='col-sm-6' align='right'>
			<?php if($datasession["group"]=="1"){?>
				<a href="<?=$url?>user-new" class="btn btn-success btn-sm fancybox "><i class=" fa fa-plus"></i> Tambah</a>
			<?php }?>
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
					<th>Username</th> 
					<th>Akses</th> 
					<th width='70'>Status</th>
					<th width='100'></th>
				</tr>
			</thead>
			<tbody>
				<?php
					$no=1;
					if(isset($data) && count($data) > 0): foreach($data as $row):   
						
				?>
				<tr>
					<td align='center'><?=$no;?></td>
					<td><?=isset($row['name']) ? $row['name'] : ''?></td>
					<td><?=isset($row['username']) ? $row['username'] : ''?></td> 
					<td align=''>
						<?php echo isset($row['group']) ?  $group[$row['group']] : '-'?>
					</td>
					<td align='center'>
						<a href='javascript:void(0);' class="label label-success" id='st-<?php echo $row['id_user'];?>' onclick="change_status('st-<?php echo $row['id_user'];?>','<?=isset($row['status']) ?  $status[$row['status']] : '-'?>','<?=$row['id_user']?>','<?=base_url()?>cms/logic/delete_ajax/user/<?=$row['id_user']?>')">
							<?php echo isset($row['status']) ?  $status[$row['status']] : '-'?>
						</a>
					</td>
					<td align='center'>
						<a href="<?=$url?>user-new?_id=<?=$row['id_user']?>" class='btn btn-xs btn-success '><i class="fa fa-edit "></i></a>
						<a title="Delete" class='btn btn-xs btn-danger' onclick="return confirm('Are you sure you want to delete this item?');" href="<?=base_url()?>cms/logic/delete/user/<?=$row['id_user']?>?part=<?=$now;?>" class="text-danger"><i class="fa fa-trash-o"></i></a>
					</td>
				</tr>
				<?php $no++;endforeach; endif; ?>
			</tbody>
		</table>
	</div>
</div>
</div>