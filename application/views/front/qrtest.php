<style>
#my_camera{
 width: 320px;
 height: 320px;
 border: 1px solid black;
}
#qr-video{
	width:320px !important;
	height:320px !important;
}
.modal {
  text-align: center;
  padding: 0!important;
}

.modal:before {
  content: '';
  display: inline-block;
  height: 100%;
  vertical-align: middle;
  margin-right: -4px;
}

.modal-dialog {
  display: inline-block;
  text-align: left;
  vertical-align: middle;
}

</style>
<div class='min-height'>
	<div class='container'>
		<div class='row'>
			<div class='col-sm-12'>
				<h1>Scan QR Code</h1>
					<br>
				<div class="">
					<div id='scanner'>
						<span id="cam-has-camera"></span>
						<video muted playsinline id="qr-video" style='width:100%'></video>
						<input type='hidden' id="cam-qr-result">
					</div>
				</div>
				<div id='scannerimage'>
					<h3>Browser Anda tidak mendukung QR code scanner!<br>
					Silahkan ambil gambar QR Code (menggunakan camera)</h3>
					<br>
					<div align='center'>
						<div id="my_camera"></div>
						<br>
						<img src='<?=base_url()?>assets/front/img/no_image.png' class='img-responsive' id='hasilimage'>
						<br>
						<button class='btn btn-default btn-lg btn-primary cekrek'><i class='fa fa-camera'></i> Ambil Gambar</button>
						<input type='hidden' id='hasil'>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal  fade" id="onground" tabindex="-1" role="dialog" aria-labelledby="onground" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h2 align='center' class='auth' >Notifikasi</h2>
			</div>
			<div class="modal-body">
					<div class='notif'>
					</div>
				<br>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<?php $this->load->view('front/podcast/footerfp');?>
<script>
	var secname = '<?php echo $this->security->get_csrf_token_name(); ?>';
	var sechash = '<?php echo $this->security->get_csrf_hash(); ?>';
</script>
<!--<script type="module"  src="<?php echo base_url()?>assets/front/js/module.js"></script>-->
<script type="text/javascript" src="<?php echo base_url();?>assets/front/js/webcam.js?r=<?=rand();?>"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/front/js/getqrimage.js"></script>
<script src="<?php echo base_url()?>assets/front/js/nomodule.js?r=<?=rand();?>"></script>
<script>
	$(document).on('ready', function() {
		/*
		if ("geolocation" in navigator){
			navigator.geolocation.getCurrentPosition(function(position){
					console.log("Found your location <br />Lat : "+position.coords.latitude+" </br>Lang :"+ position.coords.longitude);
				});
		}else{
			console.log("Browser doesn't support geolocation!");
		}
		*/
	});
</script>
