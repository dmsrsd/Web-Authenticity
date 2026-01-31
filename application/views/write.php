<h2 class="page-header">
	<?php echo $judul;?>
</h2>
<div class="panel panel-default">
<div class="panel-heading">
	<div class="row">
		<div class='col-sm-6'><?php echo $judul;?> List</div>
		<div class='col-sm-6' align='right'>
			<!--<a href="<?=$url."write-new?k=".$_GET['k']?>" class="btn btn-success btn-sm"><i class=" fa fa-plus"></i> Tambah</a>-->
		</div>
	</div>
</div>
<div class="panel-body">
	<div class="table-responsive">
		<table class="table table-striped table-bordered table-hover dataTables" >
			<thead>
				<tr>
					<th width='35'>No</th>
					<th width=''>Member</th> 
					<th width=''>Judul</th> 
					<th width='200'>Deskripsi Singkat</th>
					<th width='200'>Kategori</th>
					<th width='100'>Slug</th>
					<th width='100'>Image</th>
					<th width='130'>Approve</th>
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
					<td><?=isset($row['member']) ? $row['member'] : ''?></td> 
					<td><?=isset($row['judul']) ? $row['judul'] : ''?></td> 
					<td><?=isset($row['deskripsi_singkat']) ? substr(strip_tags($row['deskripsi_singkat']),0,100)." ..." : ''?></td>
					<td><?=isset($row['kategoria']) ? "Classified ".ucwords($row['head_kategori'])." - ".$row['kategoria'] : ''?> </td>
					<td><?=isset($row['slug']) ? $row['slug'] : ''?></td>					
					<td>
						<div class='thumbnail'>
						<a class='fancybox ' href='<?php echo base_url()."uploads/article/".$row['image'];?>'><img src='<?=isset($row['image']) ? base_url()."uploads/article/thumb/".$row['image'] : base_url().'uploads/no_image.png'?>'></a>
						</div>
					</td>
					<td><?=isset($row['approve']) ? $approve[$row['approve']] : ''?></td>					
					<td align='center'>
						<a href='javascript:void(0);' class="label label-success" id='st-<?php echo $row['id_artikel'];?>' onclick="change_status('st-<?php echo $row['id_artikel'];?>','<?=isset($row['status']) ?  $status[$row['status']] : '-'?>','<?=$row['id_artikel']?>','<?=base_url()?>cms/logic/delete_ajax/artikel/<?=$row['id_artikel']?>')">
							<?php echo isset($row['status']) ?  $status[$row['status']] : '-'?>
						</a>
					</td>
					<td align='center'>
						<a href="<?=$url?>write-new?_id=<?=$row['id_artikel']?>" class='btn btn-xs btn-success  '><i class="fa fa-edit "></i></a>
						<!--<a class='btn btn-xs btn-danger' onclick="return confirm('Are you sure you want to delete this item?');" href="<?=base_url()?>cms/logic/delete/artikel/<?=$row['id_artikel']?>?part=write" class="text-danger"><i class="fa fa-trash-o"></i></a>-->
					</td>
				</tr>
				<?php $no++; endforeach; endif; ?>
			</tbody>
		</table>
	</div>
</div>
</div>