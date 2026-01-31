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
			<a href="<?=$url?>redeempoint-new" class="btn btn-success btn-sm"><i class=" fa fa-plus"></i> Tambah</a>
		</div>
	</div>
</div>
<div class="panel-body">
	<div class="table-responsive">
		<table class="table table-striped table-bordered table-hover dataTables" >
			<thead>
				<tr>
					<th width='35'>No</th>
					<th width=''>Nama</th>  
					<th width='70'>Image</th>
					<th width='70'>Point</th>
					<th width='70'>Qty</th>
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
					<td align='left'><?=$row['nama'];?></td>  
					<td align='center'>
						<a class='fancybox fancybox.iframe' href='<?php echo base_url()."uploads/redeem/".$row['image'];?>'><img class='img-rounded' height="100" src='<?=isset($row['image']) ? base_url()."uploads/redeem/".$row['image'] : base_url().'uploads/no_image.png'?>'></a>
					</td>
					<td align='left'><?=$row['point'];?></td> 
					<td align='left'><?=$row['qty'];?></td>  
					<td align='center'>
						<a href='javascript:void(0);' class="label label-success" id='st-<?php echo $row['id_redeempoint'];?>' onclick="change_status('st-<?php echo $row['id_redeempoint'];?>','<?=isset($row['status']) ?  $status[$row['status']] : '-'?>','<?=$row['id_redeempoint']?>','<?=base_url()?>cms/logic/delete_ajax/redeempoint/<?=$row['id_redeempoint']?>')">
							<?php echo isset($row['status']) ?  $status[$row['status']] : '-'?>
						</a>
					</td>
					<td align='center'>
						<a title="Edit" href="<?=$url?>redeempoint-new?_id=<?=$row['id_redeempoint']?>" class='btn btn-xs btn-success '><i class="fa fa-edit "></i></a>
						<a title="Delete" class='btn btn-xs btn-danger' onclick="return confirm('Are you sure you want to delete this item?');" href="<?=base_url()?>cms/logic/deletesoft/redeempoint/<?=$row['id_redeempoint']?>?part=<?=$now;?>" class="text-danger"><i class="fa fa-trash-o"></i></a>					
					</td>
				</tr>
				<?php $no++; endforeach; endif; ?>
			</tbody>
		</table>
	</div>
</div>
</div>