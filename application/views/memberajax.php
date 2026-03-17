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
			<a href="<?=$url?>member-csv<?=isset($n) ? $n : ''?>" class="btn btn-success btn-sm"><i class="fa fa-download"></i> Download CSV (All)</a>
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
					<th>Alamat</th> 
					<th>Point</th> 
					<th width='100'>Last Login</th> 
					<th width='100'>Register Date</th> 
					<th width='100'>Resend Verification</th> 
				</tr>
			</thead> 
		</table>
	</div>
</div>
</div>