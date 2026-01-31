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
		<div class='col-sm-6' align='right' style="display: flex;justify-content: flex-end;">
			<a href="<?php echo base_url('cms/kotak/exportresi?type='.$_GET['type']) ?>" class="btn btn-success btn-sm"><i class=" fa fa-file"></i> Export Excel</a>
			<?php if($datasession["group"]=="1"){?>
			<form action="<?php echo base_url('cms/kotak/listresi') ?>" method="get">
				<div class="input-group mb-3" style="display: flex;float: inline-end;">
					<select name="type" class="form-control" style="width:200px;">
						<option value="redmax">horeca</option>
						<option value="silver">event</option>
						<option value="purple">lab</option>
					</select> 
					<div class="input-group-append">
						<button class="btn btn-primary" type="submit">Filter</button>
					</div>
				</div>
			</form>
			<?php } ?>
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
					<th>Nama</th> 
					<th>Tempat Beli / No Resi</th>
					<th>Gambar</th>
					<th>Type</th>
					<th>Status</th> 
				</tr>
			</thead>
			<tbody>
			<?php
				$no=1;
				if(isset($data) && count($data) > 0): foreach($data as $row):
			?>
				<tr>
					<td align='center'><?=$no;?></td>
					<td><?=isset($row['created_date']) ? $row['created_date'] : ''?></td> 
					<td><?=isset($row['member']) ? $row['member'] : ''?></td>
					<td><?=isset($row['lokasi_pembelian']) ? $row['lokasi_pembelian'] : ''?></td>
					<td><?=isset($row['resi']) ? '<a href="'.base_url('uploads/resi/'.$row['resi']).'" target="_blank"><img src="'.base_url('uploads/resi/'.$row['resi']).'" width="100px"></a>' : ''?></td> 
					
						<?php if($row['type']=="silver"){?>
							<td> Event </td>
						<?php } else if($row['type']=="purple"){?>
							<td> Lab </td>
						<?php } else {?>
							<td> Horeka </d>
						<?php } ?>
					<td align='center'>
						<?= ($row['status']==0)? '<a href="'.base_url('cms/kotak/konfimresi/'.$row['id_kotak_confirm']).'" class="btn btn-xs btn-warning">Konfirm</a><a href="'.base_url('cms/kotak/hapusresi/'.$row['id_kotak_confirm']).'" class="btn btn-xs btn-danger">Hapus</a>' : '<a class="btn btn-xs btn-success">Selesai Konfirm</a>';?>				
					</td>
				</tr>
				<?php $no++;endforeach; endif; ?>
			</tbody>
		</table>
	</div>
</div>
</div>