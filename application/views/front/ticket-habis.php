<style>

</style>

<div class='min-height ticket-box' style='min-height:350px;'>
	<div class='container'>
		<div class='row'>
			<div class='col-sm-12'>
				<h2 class="head blue" align='center'>Ticket Box</h2>
			</div>
		</div>
		<br><br>
		<div class='row'>
			<div class='col-sm-6 col-sm-offset-3'>
				<div class='box-ticket-buy'>
					<img src='<?=base_url()."uploads/ticket/".$ticketitem['image_mobile'];?>' class='img-responsive img-rounded mobile-image'>
					<img src='<?=base_url()."uploads/ticket/".$ticketitem['image'];?>' class='img-responsive img-rounded desktop-image'>
					<h3><?=$ticketitem['judul'];?></h3>
					<h4>Tiket yang sudah habis di sini, masih bisa lo dapatkan di<br>
					<a href='<?=$ticketitem['urlbuyother'];?>' target='_blank' style='color:#FFFFFF;'>
					<img src='<?=base_url();?>assets/front/img/loket.png' width='140' style='margin:10px 0px; padding:10px; background:#FFFFFF;'>
					</a></h4>
					<br>
					<a href='<?=$ticketitem['urlbuyother'];?>' target='_blank' class='btn btn-md btn-red'><i class='fa fa-shopping-cart'></i> Beli</a>
				</div>
			</div>
		</div>
	</div>
</div>
<br><br><br><br><br><br>
<?php $this->load->view('front/podcast/footerfp');?>
<script>
	$(document).on('ready', function() {
		//$('.overlay-all').hide();

	});

</script>
