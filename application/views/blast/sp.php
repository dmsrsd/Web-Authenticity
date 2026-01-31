<div class='alert alert-info'>
	User : <b><?php echo $datasession["idUser"];?></b><br>
Event : <b><?php echo $tiket["judul"];?></b>
</div>
<div class="list-group">
	<a href="javascript:void(0);" class="list-group-item active">
	<i class='fa fa-home'></i> Home
	</a>
	<a href="#" class="list-group-item"><span class="badge"><i class='fa fa-chevron-right'></i></span><i class='glyphicon glyphicon-qrcode'></i> Scan QR Tiket</a>
	<a href="javascript:void(0);" data-target="purchase" class="list-group-item showmodal">
		<span class="badge"><i class='fa fa-chevron-right'></i></span><i class='glyphicon glyphicon-qrcode'></i> Show QR Purchase
	</a>
	<a href="javascript:void(0);" data-target="game" class="list-group-item showmodal">
		<span class="badge"><i class='fa fa-chevron-right'></i></span><i class='glyphicon glyphicon-qrcode'></i> Show QR Game
	</a>
	<a href="#" class="list-group-item"><span class="badge"><i class='fa fa-chevron-right'></i></span><i class='fa fa-user'></i> Register New Member</a>
</div>

<div id="purchase" class="modal fade" role="dialog">
	<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<h4 class="modal-title">QR Purchase</h4>
		</div>
		<img src='<?=base_url()?>uploads/ticket/qr/<?=$tiket['qrpurchase'];?>' style='width:100%;'>
		<div class="modal-body">
		<div class='alert alert-success' align='center'>Tunjukan QR Code ini kepada member untuk di scan melalui website <b>Simplyauthentic.id</b> di halaman <b>Reward - Authentic On Ground</b></div>
		<button data-target='purchase' class='closemodal btn btn-lg btn-block btn-danger'><i class='fa fa-times'></i> Close</button>
		</div>
	</div>
	</div>
</div>
<div id="game" class="modal fade" role="dialog">
	<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<h4 class="modal-title">QR Game</h4>
		</div>
	  <img src='<?=base_url()?>uploads/ticket/qr/<?=$tiket['qrgame'];?>' style='width:100%;'>
	  <div class="modal-body">
		<div class='alert alert-success' align='center'>Tunjukan QR Code ini kepada member untuk di scan melalui website <b>Simplyauthentic.id</b> di halaman <b>Reward - Authentic On Ground</b></div>
		<button  data-target='game' class='closemodal btn btn-lg btn-block btn-danger'><i class='fa fa-times'></i> Close</button>
		</div>
	</div>
	</div>
</div>

<?php $this->load->view('sp/footer-sp');?>
<script type="text/javascript">

	$(document).ready(function () {
		
		
		$('.showmodal').click(function() {
			var target = $(this).attr('data-target');
			$('#'+target).modal({backdrop: 'static', keyboard: false});
			fs("open",target);
		});
		$('.closemodal').click(function() {
			var target = $(this).attr('data-target');
			$('#' + target).modal('hide');
			fs("close",target);
		});
	});
</script>