<?php
	$now = @$this->uri->segment(3);
	$cat = substr($now,-1);
?>

<h3 class="page-header">
	<?php echo $judul;?>
</h3>
<div class="panel panel-default">
<div class="panel-heading">
	<div class="row">
		<div class='col-sm-6'><?php echo $judul;?> List</div>
		<div class='col-sm-6' align='right'>
			<a href="<?=$url?>section-new" class="btn btn-success btn-sm"><i class=" fa fa-plus"></i> Tambah</a>
		</div>
	</div>
</div>
<div class="panel-body">
	<div class="table-responsive">
		<table class="table table-striped table-bordered table-hover dataTables" >
			<thead>
				<tr>
					<th width='35'>No</th> 
					<th width='120'>Mini</th> 
					<th width='120'>Landing</th> 
					<th width=''>Section Name</th> 
					<th width='50'>Order</th> 
					<th width='70'>Status</th>
					<th width='120'></th>
				</tr>
			</thead>
			<tbody>
				<?php
					$no=1;
					if(isset($data) && count($data) > 0): foreach($data as $row):  
					$now = @$this->uri->segment(3);
				?>
				<tr>
					<td align='center'><?=$no;?></td>
					<td style="text-align:center; background:#0260db;"><img src="<?=base_url().'uploads/section/'.$row['mini_banner'];?>" height="20px" title="<?=$row['section_name'];?>" alt="<?=$row['section_name'];?>" /></td>
					<td style="text-align:center;"><img src="<?=base_url().'uploads/section/'.$row['landing_banner'];?>" height="20px" title="<?=$row['section_name'];?>" alt="<?=$row['section_name'];?>" /></td>
					<td><?=$row['section_name'];?></td>
					<td><?=$row['order_number'];?></td>
					<td align='center'>
						<a href='javascript:void(0);' class="label label-success" id='st-<?php echo $row['id'];?>' onclick="change_status('st-<?php echo $row['id'];?>','<?=isset($row['status']) ?  $status[$row['status']] : '-'?>','<?=$row['id']?>','<?=base_url()?>cms/logic/delete_ajax/podcast/<?=$row['id']?>')">
							<?php echo isset($row['status']) ?  $status[$row['status']] : '-'?>
						</a>
					</td>
					<td align='center'>
						<a title="Edit" href="<?=$url?>section-new?_id=<?=$row['id']?>" class='btn btn-xs btn-success '><i class="fa fa-edit "></i></a>
						<a title="Delete" class='btn btn-xs btn-danger' onclick="return confirm('Are you sure you want to delete this item?');" href="<?=base_url()?>cms/logic/deletesoft/web_section/<?=$row['id']?>?part=<?=$now;?>" class="text-danger"><i class="fa fa-trash-o"></i></a>					
					</td>
				</tr>
				<?php $no++; endforeach; endif; ?>
			</tbody>
		</table>
	</div>
</div>
</div>