<h1 class="page-header">
	<?php echo $judul;?>
</h1>
<div class="panel panel-default">
<div class="panel-heading">
	<div class="row">
		<div class='col-sm-6'><?php echo $judul;?> List</div>
		<div class='col-sm-6' align='right'>
			<!--<a href="<?=$url?>contact-excel" class="btn btn-success btn-sm"><i class=" fa fa-file"></i> Export Excel</a>-->
		</div>
	</div>
</div>
<div class="panel-body">
	<div class="table-responsive">
		<table class="table table-striped table-bordered table-hover dataTables" >
			<thead>
				<tr>
					<th width='35'>No</th>
					<th width='150'>Name</th>
					<th>Message</th> 
					<th width='150'>Email</th>  
					<th width='150'>Tlp</th>  
					<th width='150'>Date</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$no=1;
					if(isset($data) && count($data) > 0): foreach($data as $row):  
				?>
				<tr>
					<td align='center'><?=$no;?></td>
					<td align='left'><?=$row['name'];?></td>
					<td align='left'><?=$row['message'];?></td>
					<td align='left'><?=$row['email'];?></td>  
					<td align='left'><?=$row['phone'];?></td>  
					<td align='center'><?=$row['created_date'];?></td>
				</tr>
				<?php $no++; endforeach; endif; ?>
			</tbody>
		</table>
	</div>
</div>
</div>