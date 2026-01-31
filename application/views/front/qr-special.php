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
</style>
<div class='min-height'>
	<div class='container'>
		<div class='row'>
			<div class='col-sm-12'>
				<h1 align='center' class='head-rewards'>Special Edition</h1>
					<br>
					<div align='center'>Silahkan Scan QR Code yang berada di balik kemasan produk  <b>Special Edition</b>
					<br>
					</div>

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
<?php $this->load->view('front/podcast/footerfp');?>
<script>
	var secname = '<?php echo $this->security->get_csrf_token_name(); ?>';
	var sechash = '<?php echo $this->security->get_csrf_hash(); ?>';
</script>
<script type="module"  src="<?php echo base_url()?>assets/front/js/module-special.js?r=<?=rand();?>"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/front/js/webcam.js?r=<?=rand();?>"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/front/js/getqrimage.js"></script>
<script src="<?php echo base_url()?>assets/front/js/nomodule-special.js?r=<?=rand();?>" nomodule defer></script>
<script>
	var isMobile = false; //initiate as false
	if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent)
		|| /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))) {

	}else{
		alert('Buka di hp');
		location.href='<?=base_url()?>rewards';
	}
	$(document).on('ready', function() {


		$('.closemodal').click(function(){
			$('#onground').modal('hide');
			location.href=base + 'rewards/qr-special';
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
