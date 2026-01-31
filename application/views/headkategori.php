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
		</div>
	</div>
</div>
<div class="panel-body">
	<div class="table-responsive">
		<table class="table table-striped table-bordered table-hover dataTables" >
			<thead>
				<tr>
					<th width='35'>No</th>
					<th width=''>Head Kategori</th> 
					<th width='70'>Banner</th>
					<th width='10'></th>
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
					<td align='left'><?=$row['head_kategori'];?></td> 
					<td align='center'>
						<a class='fancybox fancybox.iframe' href='<?php echo base_url()."uploads/headkategori/".$row['banner'];?>'><img class='img-rounded' height="100" src='<?=isset($row['banner']) ? base_url()."uploads/headkategori/".$row['banner'] : base_url().'uploads/no_image.png'?>'></a>
					</td>
					<td align='center'>
						<a title="Edit" href="<?=$url?>headkategori-new?_id=<?=$row['id_kategori']?>" class='btn btn-xs btn-success '><i class="fa fa-edit "></i></a>
					</td>
				</tr>
				<?php $no++; endforeach; endif; ?>
			</tbody>
		</table>
	</div>
</div>
</div>