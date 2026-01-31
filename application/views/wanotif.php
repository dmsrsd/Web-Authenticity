<h1 class="page-header">
	<?php echo $judul;?>
</h1>
<div class="panel panel-default">
<div class="panel-heading">
	<div class="row">
		<div class='col-sm-6'>Saldo : $<?php echo $saldo['credit'];?></div>  
	</div>
</div>
<div class="panel-body">
	<div class="table-responsive">
		<table class="table table-striped table-bordered table-hover dataTables" >
			<thead>
				<tr>
					<th width='35'>No</th> 
					<th>Ke</th> 
					<th>Text</th> 
					<th width='170'>Create Date</th> 
					<th width='170'>Proccess Date</th>  
				</tr>
			</thead>
			<tbody>
				<?php
					$no=1;
					if(isset($ret) && count($ret) > 0){ foreach(array_reverse($ret,true) as $k){
				?>
				<tr>
					<td align='center'><?=$no;?></td> 
					<td align='left'><?=$k->to;?></td> 
					<td align='left'><?=$k->text;?></td> 
					<td align='left'><?=namadatetime($k->creation_date);?></td> 
					<td align='left'><?=namadatetime($k->process_date);?></td>  
				</tr>
					<?php $no++; }} ?>
			</tbody>
		</table>
	</div>
</div>
</div>