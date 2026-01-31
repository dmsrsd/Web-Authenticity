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
					<th>Ticket</th>  
					<th width='180'>EO</th>  
					<th width='50'>Qty</th>  
					<th width='50'>Sisa</th>  
					<th width='50'>Order</th>  
					<th width='50'>Paid</th>  
					<th width='50'>Pending</th>  
					<th width='50'>Expired</th>  
					<th width='100'>Total Payment</th>  
				</tr>
			</thead>
			<tbody>
				<?php
					$no=1;
					if(isset($tiket) && count($tiket) > 0): foreach($tiket as $row):   
						$all=0;$paid=0;$pending=0;$expired=0;$totalp=0;
						$query = $this->db->query("SELECT sum(qty) as total FROM `order` where PAYMENTCODE!='' and id_ticket='$row[id_ticket]'")->result_array(); 
						$all =  $query[0]['total'];
						$query = $this->db->query("SELECT sum(qty) as total FROM `order` where PAYMENTCODE!='' and id_ticket='$row[id_ticket]' and paid='1'")->result_array(); 
						$paid =  $query[0]['total'];
						$query = $this->db->query("SELECT sum(qty) as total FROM `order` where PAYMENTCODE!='' and id_ticket='$row[id_ticket]' and paid!='0' and expired_pay >= '".date('Y-m-d H:i:s')."'")->result_array(); 
						$pending =  $query[0]['total'];
						$query = $this->db->query("SELECT sum(qty) as total FROM `order` where PAYMENTCODE!='' and id_ticket='$row[id_ticket]' and paid!='1' and expired_pay <= '".date('Y-m-d H:i:s')."'")->result_array(); 
						$expired =  $query[0]['total'];
						$sisa = $row['qty_online_start'] - ($paid + $pending);
						$upt['qty_online'] = $sisa;
						$this->model_global->update($upt, 'ticket', array('id_ticket' => $row['id_ticket']));
						$query = $this->db->query("SELECT sum(AMOUNT) as total FROM `order` where PAYMENTCODE!='' and id_ticket='$row[id_ticket]' and paid='1'")->result_array(); 
						$totalp =  $query[0]['total'];
						$dataorder = $this->model_global->get_data(array('select' => '*', 'table' => 'order','where' => array('expired_status' =>'0','paid !='=>'1')));
						foreach($dataorder as $do){
							if($do['expired_pay'] <= date('Y-m-d H:i:s')){
								$upo['expired_status'] = '1';
								$this->model_global->update($upo, 'order', array('id_order' => $do['id_order']));
							}
						}
						
				?>
				<tr>
					<td align='center'><?=$no;?></td> 
					<td><?=$row['judul'];?></td> 
					<td><?=$row['nama'];?></td> 
					<td align='right'><?=number_format($row['qty_online_start']);?></td> 
					<td align='right'><?=number_format($sisa);?></td> 
					<td align='center'><a href="<?=$url?>ordershow?ticket=<?=$row['id_ticket']?>&type=all" class='label label-info'><?=number_format($all);?></a></td> 
					<td align='center'><a href="<?=$url?>ordershow?ticket=<?=$row['id_ticket']?>&type=paid" class='label label-success'><?=number_format($paid);?></a></td> 
					<td align='center'><a href="<?=$url?>ordershow?ticket=<?=$row['id_ticket']?>&type=pending" class='label label-warning'><?=number_format($pending);?></a></td> 
					<td align='center'><a href="<?=$url?>ordershow?ticket=<?=$row['id_ticket']?>&type=expired" class='label label-danger'><?=number_format($expired);?></a></td> 
					<td align='right'>Rp. <?=number_format($totalp);?></td>  
				</tr>
				<?php $no++; endforeach; endif; ?>
			</tbody>
		</table>
	</div>
 

</div>
</div>