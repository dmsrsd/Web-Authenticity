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
		<table class="table table-striped table-bordered table-hover dataTables" >
			<thead>
				<tr>
					<th width='35'>No</th>
					<th width='35'>ID</th>
					<th>Fullname</th>
					<th>Email</th> 
					<th>Hp</th> 
					<th>Gender</th> 
					<th width='100'>DOB</th> 
					<th>Alamat</th> 
				</tr>
			</thead>
			<tbody>
			<?php
				$no=1;
				if(isset($data) && count($data) > 0): foreach($data as $row):
			?>
				<tr>
					<td align='center'><?=$no;?></td>
					<td><?=isset($row['oo_id']) ? $row['oo_id'] : ''?></td>
					<td><?=isset($row['Fullname']) ? $row['Fullname'] : ''?></td>
					<td><?=isset($row['email']) ? $row['email'] : ''?></td> 
					<td><?=isset($row['PhoneNumber']) ? $row['PhoneNumber'] : ''?></td> 
					<td><?=isset($row['gender']) ? $row['gender'] : ''?></td> 
					<td><?=isset($row['Dob']) ? $row['Dob'] : ''?></td> 
					<td><?=isset($row['address']) ? $row['address'] : ''?></td>  
				</tr>
				<?php $no++;endforeach; endif; ?>
			</tbody>
		</table>
	</div>
</div>
</div>