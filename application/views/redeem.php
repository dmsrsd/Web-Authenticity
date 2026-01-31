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
					<th width=''>Nama</th> 
					<th width=''>Hp</th> 
					<th width=''>Email</th> 
					<th width=''>Alamat</th> 
					<th width=''>Redeem</th> 
					<th width=''>Point</th>  
					<th width=''>Tanggal</th>  
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
					<td align='left'><?=$row['member'];?></td> 
					<td align='left'><?=$row['hp'];?></td> 
					<td align='left'><?=$row['email'];?></td> 
					<td align='left'><?=$row['address'];?></td> 
					<td align='left'><?=$row['redeem'];?></td> 
					<td align='left'><?=$row['point'];?></td> 
					<td align='left'><?=$row['created_date'];?></td> 
				</tr>
				<?php $no++; endforeach; endif; ?>
			</tbody>
		</table>
	</div>
</div>
</div>