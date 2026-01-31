<style>
#my_camera{
 width: 320px;
 height: 320px;
 border: 3px solid black;
}
#scanner.wrong{
	border: 3px solid red;
}
#scanner.right{
	border: 3px solid green;
}
#qr-video{
 width:100%;
 height: 100%;
  -moz-transform:scale(3) !important;
  -webkit-transform:scale(3) !important;
  -o-transform:scale(3) !important;
  -ms-transform:scale(3) !important;
  transform:scale(3) !important; 
  position:absolute;
  left:0;
  top:0;
} 
#scanner{
 border: 3px solid black;
 width: 320px;
 height: 320px;	
 position:relative;
 overflow:hidden;
 margin:0 auto;
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
.modal .modal-header .auth{
	margin:0px;
	color:#0053A0;

}
@font-face {
	font-family: auth;
	src: url('<?=base_url();?>assets/front/fonts/AuthenticSans-Regular.otf');
}
.auth{
	font-family:auth;
}

</style> 
<div class='min-height'>
	<div class='container'>
		<div class='row'>
			<div class='col-sm-12'>
				<h1 align='center' class='head-rewards'>Scan Tiket Masuk</h1> 
					<br> 
				<div class="">
					<div id='scanner'>
						<span id="cam-has-camera"></span>
						<video muted playsinline id="qr-video" ></video>
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
						<button class='btn btn-default btn-primary cekrek'><i class='fa fa-camera'></i> Ambil Gambar</button>
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
				<button type="button" class="btn btn-default closemodal" >Close</button>
			</div>				
		</div>
	</div>
</div> 
<?php $this->load->view('sp/footer-sp');?>
<script>
	var base = '<?=base_url();?>';
	document.documentElement.className = 'js';
	var secname = '<?php echo $this->security->get_csrf_token_name(); ?>';
	var sechash = '<?php echo $this->security->get_csrf_hash(); ?>';
</script>
<script type="module"  src="<?php echo base_url()?>assets/front/js/module-sptiket.js?r=<?=rand();?>"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/front/js/webcam.js?r=<?=rand();?>"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/front/js/getqrimage.js"></script>
<script src="<?php echo base_url()?>assets/front/js/nomodule-sptiket.js?r=<?=rand();?>" nomodule defer></script>
<script>  

	$(document).on('ready', function() { 
 
		
		$('.closemodal').click(function(){
			$('#onground').modal('hide');
			location.href=base + 'sp/dashboard/tiketmasuk';
		}); 
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
