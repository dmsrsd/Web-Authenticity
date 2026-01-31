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
		<table class="table table-striped table-bordered table-hover dataTableshistorypoint" >
			<thead>
				<tr>
					<th width='35'>No</th>
					<th width=''>Nama</th> 
					<th width=''>Hp</th> 
					<th width=''>Email</th> 
					<th width=''>Jenis Point</th> 
					<th width=''>Point</th>  
					<th width=''>Tanggal</th>  
				</tr>
			</thead> 
		</table>
	</div>
</div>
</div>