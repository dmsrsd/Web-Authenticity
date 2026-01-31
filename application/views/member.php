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
		<div class='col-sm-6' align='right'>
			<!--<a href="<?=$url?>member-excel" class="btn btn-success btn-sm"><i class=" fa fa-file"></i> Export Excel</a>-->
		</div>		
	</div>
</div>
<div class="panel-body">
	<div class="table-responsive">
		<table class="table table-striped table-bordered table-hover dataTablesmember" >
			<thead>
				<tr>
					<th width='35'>No</th>
					<th>Nama</th>
					<th>Email</th> 
					<th>Hp</th> 
					<!--<th>Kota</th> -->
					<th>Alamat</th> 
					<th>Point</th> 
					<th width='100'>Last Login</th> 
					<th width='100'>Register Date</th> 
					<th width='100'>Resend Verification</th> 
					<!--<th width='70'></th>-->
				</tr>
			</thead>
			<tbody>
			<?php
				$no=1;
				if(isset($data) && count($data) > 0): foreach($data as $row):
					$query = $this->db->query("select sum(b.pts) as total from point a left join jenis_point b on b.id_jenis_point = a.id_jenis_point where a.id_member='".$row['id_member']."'")->result_array(); 
					$total =  $query[0]['total'];			
			?>
				<tr>
					<td align='center'><?=$no;?></td>
					<td><?=isset($row['fullname']) ? $row['fullname'] : ''?></td>
					<td><?=isset($row['email']) ? $row['email'] : ''?></td> 
					<td><?=isset($row['hp']) ? $row['hp'] : ''?></td> 
					<!--<td><?=isset($row['kota']) ? $row['provinsi'].", ".$row['kota'] : ''?></td> -->
					<td><?=isset($row['address']) ? $row['address'] : ''?></td> 
					<td><?=$total;?></td> 
					<td><?=isset($row['last_login']) ? namadatetime($row['last_login']) : ''?></td> 
					<td><?=isset($row['created_date']) ? namadatetime($row['created_date']) : ''?></td> 
					<td align='center'>
						<a class='btn btn-xs btn-success resend-regis'  href="javascript:void(0);" data-id="<?=$row['id_member']?>"><i class="fa fa-envelope"></i></a>					
					</td>
				</tr>
				<?php $no++;endforeach; endif; ?>
			</tbody>
		</table>
	</div>
</div>
</div>