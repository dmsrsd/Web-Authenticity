<?php
	$now = @$this->uri->segment(3);
?>
<div class="panel panel-default">
	<div class="panel-heading">
		<div class="row">
			<div class='col-sm-6'><?php echo $judul;?></div>
			<div class='col-sm-6' align='right'>

			</div>
		</div>
	</div>
	<?php
	if(isset($_GET['s'])){
		switch($_GET['s']){
			case "true" : $c="success"; break;
			case "false": $c="danger"; break;
		}
			echo"
			<br>
			<div class='container' style='width:100%;'><div class='row'><div class='col-md-12'>
			<div class='alert alert-$c' role='alert'>
				<span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span>
				<span class='sr-only'>Error:</span>
				$_GET[m]
			</div></div></div>
			</div>
			";
	}
	?>	
	<style>
		.table th{
			text-align:center;
			vertical-align:middle !important;
			background:#EFEFEF;
			padding:2px !important;
		}
		.table td{
			padding:2px !important;
		}
		hr{
			border-top:2px solid #000000;
		}
	</style>
	<form action="<?=base_url()?>cms/logic/darbotzproductProses" method="post" data-parsley-validate enctype="multipart/form-data">
	<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
		<div class="panel-body">  
			<?php if(isset($data['id_darbotz']) && $data['id_darbotz'] != ''): ?>
				<input type="hidden" name="_id" value="<?=$data['id_darbotz']?>" /> 
				<input type="hidden" name="action" value="edit" /> 
			<?php endif; ?>  
			<div class="form-group">
				<div class="row"> 
					<div class="col-sm-12">
						<?php if(isset($data['id_darbotz']) && $data['id_darbotz'] != ''){
						if($data['product']!=''){
							$dec = json_decode($data['product']);  
							$jum=0;
							echo "<div class='classnext'>";
							echo " 
							<table width='100%' class='table' id='listablerank-$jum' data-klass='$jum'>
								<tr>
									<th  width='200'>Nama</th>
									<th >Deskripsi</th>
									<th align='center' width='200'>Image</th>
									<th width='50'></th>
								</tr>";
								$no=0; 
								foreach($dec as $key=>$product){
									$addclass="";  
									if($no==0){
										$listicon = "<a href='javascript:void(0);' class='btn btn-sm btn-success addklassvalue' data-klass='$jum'><i class='fa fa-plus'></i></a>";
									}else{
										$listicon = "<a class='btn btn-sm btn-danger del-row' ><i class='fa fa-trash'></i></a>";
									}
									$image = "";
									$reqimage = "required";
									if($product->image!=""){
										$image = "<img src='".base_url()."uploads/darbotz/".$product->image."' class='img-responsive img-thumbnail'>";
										$reqimage = "";
									}
									
									echo "
									<tr>
										<td><input type='text' name='product[$no][]' class='form-control' required placeholder='Nama' value='".$product->nama."'></td>
										<td><input type='text' name='product[$no][]' class='form-control' required placeholder='deskripsi' value='".$product->deskripsi."'></td>
										<td>$image <br><input type='file' name='imaged-$no' class='form-control' $reqimage placeholder='image'><input type='hidden' name='product[$no][]' value='".$product->image."'></td>
										<td align='center'>$listicon</td>
									</tr>";
									$no++;  
								}
							echo"
							</table>
							<hr>
							";
							echo "</div>"; 
						}else{
						?> 
						<table width='100%' class='table' id='listablerank-0' data-klass='0'>
							<tr>
								<th width='200'>Nama</th>
								<th >Deskripsi</th>
								<th  width='200'>Image</th>
								<th  width='50'></th>
							</tr> 
							<tr>
								<td><input type='text' name='product[0][]' class='form-control' required placeholder='Nama'></td>
								<td><input type='text' name='product[0][]' class='form-control' required placeholder='Deskripsi'></td>
								<td><input type='file' name='imaged-0' class='form-control' required placeholder='Image'><input type='hidden' name='product[0][]'value=''></td>
								<td align='center'><a href='javascript:void(0);' class='btn btn-sm btn-success addklassvalue' data-klass='0'><i class='fa fa-plus'></i></a></td>
							</tr>
						</table>
						<hr> 
						<div class='classnext'></div>
						<?php }?>
						<?php }?>
					</div>
				</div>
			</div>   	
		</div> 
		
		<div class="panel-footer">
			<button type="submit" onclick=" " class="btn btn-primary">Submit</button>
			<a href='<?=$url?>darbotz' class='btn btn-default'>Back</a> 
		</div>
	</form>
</div>