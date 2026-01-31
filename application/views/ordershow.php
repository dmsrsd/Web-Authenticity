<style>
	.label{
		font-size:13px;
	}
</style>
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
					<th>Member</th>  
					<th width='100'>Create Date</th>  
					<th width='100'>Request Date</th>  
					<th width='150'>Qty</th>  
					<th width='90'>Amount</th>  
					<th width='150'>Bank</th> 
					<?php if($_GET['type']=='paid'){?><th width='100'>Paid Date</th> <?php }?>
					<th width='50'>Status</th> 
					<th width='50'></th> 
				</tr>
			</thead>
			<tbody>
				<?php
					$no=1;
					if(isset($order) && count($order) > 0): foreach($order as $row):    
						$action = "<a href='javascript:void(0);' class='label label-success showresend' data-order='$row[id_order]'><i class='fa fa-users'></i> Detail</a>";
						if($row['paid']==1){
							$status="Paid";
						}
						if($row['paid']!=1){
							if($row['expired_pay']>=date('Y-m-d H:i:s')){
								$status="Pending";
							}
							if($row['expired_pay']<=date('Y-m-d H:i:s')){
								$status="Expired";
							}
						}
				?>
				<tr>
					<td align='center'><?=$no;?></td> 
					<td><?=$row['fullname'];?><br><?=$row['inv'];?><br><?=$row['hp'];?><br><?=$row['email'];?></td> 
					<td><?=$row['created_date'];?></td> 
					<td><?=$row['request_pay'];?></td> 
					<td align='center'>
						<a href='javascript:void(0);' class='label label-info showresend' data-order='<?=$row['id_order'];?>'><?=$row['qty'];?></a>
						
						<div align='left' style='margin-top:10px;'>
						<?php
							$ma = $this->model_global->get_data(array('select' => '*', 'table' => 'orderdetail','where' => array('id_order' => $row['id_order']), 'order_by' => 'id_orderdetail desc'));
							foreach($ma as $m){
								echo $m['nama']." ";
								echo $m['hp']." ";
								echo $m['email'];
								echo "<hr style='margin:0px; border:1px dashed #cccccc;'>";
							}
						?>
						</div>
					</td> 
					<td align='right'>Rp. <?=number_format($row['AMOUNT']);?></td> 
					<td><?=$row['bank'];?><br><?=$row['PAYMENTCODE'];?></td> 
					<?php if($_GET['type']=="paid"){?><td><?=$row['paid_date'];?></td> <?php }?>
					<td><?=ucwords($status);?></td> 
					<td align='center'><?=$action;?></td> 
				</tr>
				<?php $no++; endforeach; endif; ?>
			</tbody>
		</table>
	</div>
 

</div>
</div>
<div class="modal  fade" id="modalresend" tabindex="-1" role="dialog" aria-labelledby="redeemlogin" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header alert alert-success">
				<h3 align='center' class='auth' >Detail Order</h3>
			</div>
			<div class="modal-body">

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>				
		</div>
	</div>
</div>
