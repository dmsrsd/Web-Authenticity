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
		<div class='col-sm-6'><?php echo $judul;?></div> 
		<div class='col-sm-6' align='right'>
			<a href="<?=base_url('cms/event/new')?>" class="btn btn-success btn-sm"><i class=" fa fa-plus"></i> Tambah</a>
		</div>
			
	</div>
</div>
<div class="panel-body">
	<div class="table-responsive">
		<table class="table table-striped table-bordered table-hover dataTablesmember" >
			<thead>
				<tr>
					<th width='35'>No</th>
					<th>Tanggal</th> 
					<th>Judul event</th> 
					<th>HTM</th>
					<th>Gambar</th>
					<th>Status</th> 
					<th></th> 
				</tr>
			</thead>
			<tbody>
			<?php
				$no=1;
				if(isset($data) && count($data) > 0): foreach($data as $row):
			?>
				<tr>
					<td align='center'><?=isset($row['urutan']) ? $row['urutan'] : ''?></td>
					<td><?=isset($row['periode_start']) ? $row['periode_start'] : ''?>- <?=isset($row['periode_end']) ? $row['periode_end'] : ''?></td> 
					<td><?=isset($row['judul']) ? $row['judul'] : ''?></td>
					<td><?=isset($row['htm_start']) ? $row['htm_start'] : ''?>-<?=isset($row['htm_end']) ? $row['htm_end'] : ''?></td>
					<td><?=isset($row['image']) ? '<a href="'.base_url('uploads/events/'.$row['image']).'" target="_blank"><img src="'.base_url('uploads/events/'.$row['image']).'" width="100px"></a>' : ''?></td> 
					
					<td><?=isset($row['status']) ? $row['status'] : ''?></td>
					<td align='center'>
						<a href="<?=base_url()?>cms/event/edit/<?=$row['id_event']?>" class='btn btn-xs btn-success '><i class="fa fa-edit "></i></a>
						<a title="Delete" class='btn btn-xs btn-danger' onclick="return confirm('Are you sure you want to delete this item?');" href="<?=base_url()?>cms/event/deletesoft/<?=$row['id_event']?>" class="text-danger"><i class="fa fa-trash-o"></i></a>
					</td>
				</tr>
				<?php $no++;endforeach; endif; ?>
			</tbody>
		</table>
	</div>
</div>
</div>