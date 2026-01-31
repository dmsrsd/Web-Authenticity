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
					<th width=''>Member</th> <th width=''>Alamat</th>  <th width=''>Tgl Submit</th> 
					<th width='100'>Image Cover</th>
					<th width='100'>Image Box</th>
					<th width='100'>Image Lighter</th>
					<th width='100'>Image Tincase</th>
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
					<td><?=isset($row['member']) ? $row['member'] : ''?><br>(<?=isset($row['memberemail']) ? $row['memberemail'] : ''?>)</td> 
					<td><?=isset($row['memberalamat']) ? $row['memberalamat'] : ''?></td> 
					<td><?=isset($row['created_date']) ? $row['created_date'] : ''?></td> 
					<td>
						<div class='thumbnail'>
						<a class='fancybox ' href='<?php echo base_url()."uploads/designcompetition/".$row[$row['cover']];?>'><img src='<?=isset($row[$row['cover']]) ? base_url()."uploads/designcompetition/thumb/".$row[$row['cover']] : base_url().'uploads/no_image.png'?>'></a>
						</div>
					</td>
					<td>
						<div class='thumbnail'>
						<a class='fancybox ' href='<?php echo base_url()."uploads/designcompetition/".$row['box'];?>'><img src='<?=isset($row['box']) ? base_url()."uploads/designcompetition/thumb/".$row['box'] : base_url().'uploads/no_image.png'?>'></a>
						</div>
					</td>
					<td>
						<div class='thumbnail'>
						<a class='fancybox ' href='<?php echo base_url()."uploads/designcompetition/".$row['lighter'];?>'><img src='<?=isset($row['lighter']) ? base_url()."uploads/designcompetition/thumb/".$row['lighter'] : base_url().'uploads/no_image.png'?>'></a>
						</div>
					</td>
					<td>
						<div class='thumbnail'>
						<a class='fancybox ' href='<?php echo base_url()."uploads/designcompetition/".$row['tincase'];?>'><img src='<?=isset($row['tincase']) ? base_url()."uploads/designcompetition/thumb/".$row['tincase'] : base_url().'uploads/no_image.png'?>'></a>
						</div>
					</td>
					<td><?=isset($row['approve']) ? $approve[$row['approve']] : ''?></td>					
					<td align='center'>
						<a href='javascript:void(0);' class="label label-success" id='st-<?php echo $row['id_designcompetition'];?>' onclick="change_status('st-<?php echo $row['id_designcompetition'];?>','<?=isset($row['status']) ?  $status[$row['status']] : '-'?>','<?=$row['id_designcompetition']?>','<?=base_url()?>cms/logic/delete_ajax/designcompetition/<?=$row['id_designcompetition']?>')">
							<?php echo isset($row['status']) ?  $status[$row['status']] : '-'?>
						</a>
					</td>
					<td align='center'>
						<a href="<?=$url?>designcompetition-new?_id=<?=$row['id_designcompetition']?>" class='btn btn-xs btn-success  '><i class="fa fa-edit "></i></a>
						<a class='btn btn-xs btn-danger' onclick="return confirm('Are you sure you want to delete this item?');" href="<?=base_url()?>cms/logic/delete/designcompetition/<?=$row['id_designcompetition']?>?part=write" class="text-danger"><i class="fa fa-trash-o"></i></a>					
					</td>
				</tr>
				<?php $no++; endforeach; endif; ?>
			</tbody>
		</table>
	</div>
</div>
</div>