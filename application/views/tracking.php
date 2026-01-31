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
	<form action="<?=base_url()?>cms/dashboard/tracking" method="post" data-parsley-validate enctype="multipart/form-data">
	<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Email Member <span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-4">
						<input type='text' name='email'  required value='<?=(isset($_POST['email']) ? $_POST['email'] : '')?>' class='form-control '>
					</div>
					<div class="col-sm-2">
						<button type="submit" onclick=" " class="btn btn-primary find">Find ...</button>
					</div>
				</div>
			</div>	
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Scrable </label>
					</div>
					<div class="col-sm-4">
						<b><?=(isset($acak) ? $acak : '')?></b>
					</div>
				</div>
			</div>	
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Band </label>
					</div>
					<div class="col-sm-4">
						<b><?=(isset($band) ? $band : '')?></b>
					</div>
				</div>
			</div>	
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Total Tanpa Redeem </label>
					</div>
					<div class="col-sm-4">
						<b><?=(isset($total_point) ? $total_point : '')?></b>
					</div>
				</div>
			</div>	
			<hr>
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Total Redeem </label>
					</div>
					<div class="col-sm-4">
						<b><?=(isset($totalredeem) ? $totalredeem : '')?></b>
					</div>
				</div>
			</div>	
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label">Total Akhir </label>
					</div>
					<div class="col-sm-4">
						<b><?=(isset($total2) ? $total2 : '')?></b>
					</div>
				</div>
			</div>	
	<?php
		if(isset($_POST['email'])){
			if($message!=""){
				echo $message;
			}else{
	?>
	<hr>
	<h2> History</h2>
	<hr>	
	<div class="table-responsive">
		<table class="table table-striped table-bordered table-hover dataTables" > 
			<thead>
				<tr>
					<th width='35'>No</th>
					<th>Nama</th>
					<th>Email</th> 
					<th>Point</th> 
					<th>Nama Point</th> 
					<th>TGL</th> 
					<th></th> 
				</tr>
			</thead> 
			<tbody>
			<?php
				$no=1;
				if(isset($data) && count($data) > 0): foreach($data as $row):
				if($row['id_jenis_point']=="4" || $row['id_jenis_point']=="5"){
					$order = $this->model_global->get_data(array('data' => 'row','table' => 'order', 'where' => array('id_order' => $row['id_resource'])));
					$ticket = $this->model_global->get_data(array('data' => 'row','table' => 'ticket', 'where' => array('id_ticket' => $order['id_ticket'])));
					if(count($ticket)>0){
						$row['nama_point'] = $row['nama_point']." : ".$ticket['judul']." - ".$ticket['dimana'];
					}
				}
				if($row['id_jenis_point']=="12" ){
					$query3 = $this->db->query("select point as total from pointacak  where  id_pointacak='".$row['id_resource']."'")->result_array(); 
					if(count($query3)>0){
						$total3 =  $query3[0]['total'];
						$row['pts'] = $total3;
					}
				}
			?>
				<tr>
					<td align='center'><?=$no;?></td>
					<td><?=isset($row['fullname']) ? $row['fullname'] : ''?></td>
					<td><?=isset($row['email']) ? $row['email'] : ''?></td> 
					<td><?=isset($row['pts']) ? $row['pts'] : ''?></td> 
					<td><?=isset($row['nama_point']) ? $row['nama_point'] : ''?></td> 
					<td><?=isset($row['created_date']) ? $row['created_date'] : ''?></td> 
					<td align='center'>
						<a class='btn btn-xs btn-danger hapus-point'  href="javascript:void(0);" data-id="<?=$row['id_point']?>"><i class="fa fa-times"></i></a>					
					</td>
				</tr>
				<?php $no++;endforeach; endif; ?>
			</tbody>			
		</table>
	</div>
	<hr>
	<h2> Redeem</h2>
	<hr>
	<div class="table-responsive">
		<table class="table table-striped table-bordered table-hover dataTables" > 
			<thead>
				<tr>
					<th width='35'>No</th>
					<th>Item</th>
					<th>Point</th> 
					<th>Tanggal</th> 
					<th></th> 
				</tr>
			</thead> 
			<tbody>
			<?php
				$no=1;
				if(isset($dataredeem) && count($dataredeem) > 0): foreach($dataredeem as $row):
			?>
				<tr>
					<td align='center'><?=$no;?></td>
					<td><?=isset($row['nama']) ? $row['nama'] : ''?></td>
					<td><?=isset($row['point']) ? $row['point'] : ''?></td> 
					<td><?=isset($row['created_date']) ? $row['created_date'] : ''?></td> 
					<td align='center'>
						<a class='btn btn-xs btn-danger hapus-redeem'  href="javascript:void(0);" data-id="<?=$row['id_redeemmember']?>"><i class="fa fa-times"></i></a>					
					</td>				</tr>
				<?php $no++;endforeach; endif; ?>
			</tbody>			
		</table>
	</div>
		<?php }}?>
</div>
</div>