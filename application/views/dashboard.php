<style>
.panel-green {
    border-color: #5cb85c;
}
.panel-yellow {
    border-color: #f0ad4e;
}
.panel-red {
    border-color: #d9534f;
}
.panel-green > .panel-heading {
    border-color: #5cb85c;
    color: white;
    background-color: #5cb85c;
}
.panel-yellow > .panel-heading {
    border-color: #f0ad4e;
    color: white;
    background-color: #f0ad4e;
}
.panel-red > .panel-heading {
    border-color: #d9534f;
    color: white;
    background-color: #d9534f;
}
.huge {
    font-size: 20px; 
}
.panel-green > a {
    color: #5cb85c;
}
.panel-yellow > a {
    color: #f0ad4e;
}
.panel-red > a {
    color: #d9534f;
}
</style>
<?php
	$j = $this->db->query("select sum(total) as total from `order` where paid='1'")->result_array(); 
	$totalj =  $j[0]['total'];

	$b = $this->db->query("select sum(AMOUNT) as total from `order` where paid='1'")->result_array(); 
	$totalb =  $b[0]['total'];

	$b = $this->db->query("select count(id_member) as total from member where active='1'")->result_array(); 
	$ma1 =  $b[0]['total'];

	$b = $this->db->query("select count(id_member) as total from member where active='0'")->result_array(); 
	$ma2 =  $b[0]['total'];

	$b = $this->db->query("select count(id_member) as total from member")->result_array(); 
	$ma3 =  $b[0]['total'];

	$b = $this->db->query("select sum(qty) as total from `order` where paid='1'")->result_array(); 
	$totaltiket =  $b[0]['total'];

 

?>
<h1 class="page-header">
	Selamat Datang <?php echo $datasession["idUser"];?>
</h1>
<div class="panel panel-default">
	<div class="panel-heading">
		<div class="row">
			<div class='col-sm-6'></div>
			<div class='col-sm-6' align='right'>

			</div>
		</div>
	</div>
	<div class="panel-body"> 
		<br>
		<div class="row">
			<div class="col-lg-3 col-md-6">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<i class="fa fa-dollar fa-5x"></i>
							</div>
							<div class="col-xs-9 text-right">
								<div class="huge">Rp. <?=number_format($totalj)?></div>
								<div>Total Penjualan</div>
							</div>
						</div>
					</div>
					<a href="<?=$url?>order">
						<div class="panel-footer">
							<span class="pull-left">View Details</span>
							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<div class="panel panel-green">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<i class="fa fa-shopping-cart fa-5x"></i>
							</div>
							<div class="col-xs-9 text-right">
								<div class="huge">Rp. <?=number_format($totalb)?></div>
								<div>Total Pembayaran</div>
							</div>
						</div>
					</div>
					<a href="<?=$url?>order">
						<div class="panel-footer">
							<span class="pull-left">View Details</span>
							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<div class="panel panel-yellow">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<i class="fa fa-briefcase fa-5x"></i>
							</div>
							<div class="col-xs-9 text-right">
								<div class="huge"><?=$totaltiket?></div>
								<div>Total Tiket Terjual</div>
							</div>
						</div>
					</div>
					<a href="<?=$url?>order">
						<div class="panel-footer">
							<span class="pull-left">View Details</span>
							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<div class="panel panel-red">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<i class="fa fa-users fa-5x"></i>
							</div>
							<div class="col-xs-9 text-right">
								<div class="huge"><?//=$totalu?></div>
								<div>
									Member Aktif : <?=number_format($ma1)?><br>
									Member Non Aktif : <?=number_format($ma2)?><br>
									Total Member : <?=number_format($ma3)?><br>
								</div>
							</div>
						</div>
					</div>
					<a href="<?=$url?>member">
						<div class="panel-footer">
							<span class="pull-left">View Details</span>
							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
			</div>
		</div>		
	</div>
</div>