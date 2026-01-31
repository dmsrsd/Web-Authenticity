<h1 class="page-header">
	<?php echo $judul;?>
</h1>
<div class="panel panel-default">
<div class="panel-heading">
	<div class="row">
		<div class='col-sm-6'><?php echo $judul;?> List</div>
		<div class='col-sm-6' align='right'>
			<a href="<?=$url?>kategori-new" class="btn btn-success btn-sm"><i class=" fa fa-plus"></i> Tambah</a>
		</div>
	</div>
</div>
<div class="panel-body">
	<div class="table-responsive">
		<table class="table table-striped table-bordered table-hover dataTables" >
			<thead>
				<tr>
					<th width='35'>No</th> 
					<th>Head Kategori</th> 
					<th>Kategori</th> 
					<th>Slug</th> 
					<th width='100'>Banner</th>
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
					<td align='left'><?=$headkategori[$row['head_kategori']];?></td> 
					<td align='left'><?=$row['nama'];?></td> 
					<td align='left'><?=$row['slug'];?></td> 
					<td>
						<div class='thumbnail'>
						<a class='fancybox ' href='<?php echo base_url()."uploads/kategori/".$row['banner'];?>'><img src='<?=isset($row['banner']) ? base_url()."uploads/kategori/".$row['banner'] : base_url().'uploads/no_image.png'?>'></a>
						</div>
					</td>
					<td align='center'>
						<a href='javascript:void(0);' class="label label-success" id='st-<?php echo $row['id_kategori'];?>' onclick="change_status('st-<?php echo $row['id_kategori'];?>','<?=isset($row['status']) ?  $status[$row['status']] : '-'?>','<?=$row['id_kategori']?>','<?=base_url()?>cms/logic/delete_ajax/kategori/<?=$row['id_kategori']?>')">
							<?php echo isset($row['status']) ?  $status[$row['status']] : '-'?>
						</a>
					</td>
					<td align='center'>
						<a href="<?=$url?>kategori-new?_id=<?=$row['id_kategori']?>" class='btn btn-xs btn-success '><i class="fa fa-edit "></i></a>
						<a class='btn btn-xs btn-danger' onclick="return confirm('Are you sure you want to delete this item?');" href="<?=base_url()?>cms/logic/delete/kategori/<?=$row['id_kategori']?>?part=kategori" class="text-danger"><i class="fa fa-trash-o"></i></a>					
					</td>
				</tr>
				<?php $no++; endforeach; endif; ?>
			</tbody>
		</table>
	</div>
</div>
</div>