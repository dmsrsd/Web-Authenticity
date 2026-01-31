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
			<a href="<?=$url?>store" class="btn btn-info btn-sm"><i class=" fa fa-chevron-left"></i> Kembali</a>
			<?php 
			if(isset($_GET['p'])){
				echo '<a href="'.$url.'storeproduct-new?p='.$_GET['p'].'" class="btn btn-success btn-sm"><i class=" fa fa-plus"></i> Tambah</a>';
			}else{
				echo '<a href="'.$url.'storeproduct-new" class="btn btn-success btn-sm"><i class=" fa fa-plus"></i> Tambah</a>';
			}
			?>
			<!-- <a href="<?=$url."storeproduct-new?p=".$_GET['p']?>" class="btn btn-success btn-sm"><i class=" fa fa-plus"></i> Tambah</a> -->
		</div>
	</div>
</div>
<div class="panel-body">
	<div class="table-responsive">
		<table class="table table-striped table-bordered table-hover dataTables" >
			<thead>
				<tr>
					<th width='35'>No</th> 
					<th width='200'>Judul</th> 
					<th width=''>Deskripsi</th> 
					<th width=''>Image</th> 
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
					<td><?=$row['judul'];?></td>
					<td><?=$row['deskripsi'];?></td>
					<td align='center'>
						<a class='fancybox fancybox.iframe' href='<?php echo base_url()."uploads/store/".$row['image'];?>'><img class='img-rounded' height="100" src='<?=isset($row['image']) ? base_url()."uploads/store/".$row['image'] : base_url().'uploads/no_image.png'?>'></a>
					</td>
					<td align='center'>
						<a href='javascript:void(0);' class="label label-success" id='st-<?php echo $row['id_storeproduct'];?>' onclick="change_status('st-<?php echo $row['id_storeproduct'];?>','<?=isset($row['status']) ?  $status[$row['status']] : '-'?>','<?=$row['id_storeproduct']?>','<?=base_url()?>cms/logic/delete_ajax/storeproduct/<?=$row['id_storeproduct']?>')">
							<?php echo isset($row['status']) ?  $status[$row['status']] : '-'?>
						</a>
					</td>
					<td align='center'>
						<a title="Add Button" href="<?=$url?>storeproduct-button?_id=<?=$row['id_storeproduct']?>" class='btn btn-xs btn-warning '><i class="fa fa-link "></i></a>
						<a title="Edit" href="<?=$url?>storeproduct-new?p=<?=$row['id_store']?>&_id=<?=$row['id_storeproduct']?>" class='btn btn-xs btn-success '><i class="fa fa-edit "></i></a>
						<a title="Delete" class='btn btn-xs btn-danger' onclick="return confirm('Are you sure you want to delete this item?');" href="<?=base_url()?>cms/logic/delete/storeproduct/<?=$row['id_storeproduct']?>?part=<?=$now;?>" class="text-danger"><i class="fa fa-trash-o"></i></a>					
					</td>
				</tr>
				<?php $no++; endforeach; endif; ?>
			</tbody>
		</table>
	</div>
</div>
</div>