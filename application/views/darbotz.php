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
			<a href="<?=$url?>darbotz-new" class="btn btn-success btn-sm"><i class=" fa fa-plus"></i> Tambah</a>
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
					<th width='70'>Banner</th>
					<th width='70'>Qty</th>
					<th width='70'>Harga</th>
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
						<a class='fancybox fancybox.iframe' href='<?php echo base_url()."uploads/darbotz/".$row['banner'];?>'><img class='img-rounded' height="100" src='<?=isset($row['banner']) ? base_url()."uploads/darbotz/".$row['banner'] : base_url().'uploads/no_image.png'?>'></a>
					</td>
					<td align='center'>
						<?php echo number_format($row['qty'])?>
					</td>
					<td align='center'>
						<?php echo number_format($row['harga'])?>
					</td>
					<td align='center'>
						<a href='javascript:void(0);' class="label label-success" id='st-<?php echo $row['id_darbotz'];?>' onclick="change_status('st-<?php echo $row['id_darbotz'];?>','<?=isset($row['status']) ?  $status[$row['status']] : '-'?>','<?=$row['id_darbotz']?>','<?=base_url()?>cms/logic/delete_ajax/darbotz/<?=$row['id_darbotz']?>')">
							<?php echo isset($row['status']) ?  $status[$row['status']] : '-'?>
						</a>
					</td>
					<td align='center'>
						<a title="Add Product" href="<?=$url?>darbotz-product?_id=<?=$row['id_darbotz']?>" class='btn btn-xs btn-success '><i class="fa fa-tag "></i></a>
						<a title="Edit" href="<?=$url?>darbotz-new?_id=<?=$row['id_darbotz']?>" class='btn btn-xs btn-success '><i class="fa fa-edit "></i></a>
						<a title="Delete" class='btn btn-xs btn-danger' onclick="return confirm('Are you sure you want to delete this item?');" href="<?=base_url()?>cms/logic/delete/darbotz/<?=$row['id_darbotz']?>?part=<?=$now;?>" class="text-danger"><i class="fa fa-trash-o"></i></a>					
					</td>
				</tr>
				<?php $no++; endforeach; endif; ?>
			</tbody>
		</table>
	</div>
</div>
</div>