<style>
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
	<div class='container scrable'>
		<div class='row  noselect'>
			<form role="form" id="frmsrable"  action="<?=base_url()?>rewards/scrableanswer"  method="post" data-parsley-validate  autocomplete="off">
				<div class='col-sm-6 col-sm-offset-3'>
					<h1>Simply Scrabble</h1>
					<h2 id='time'>00:00</h2>
					<br>
				</div>
				<div class='col-sm-12'>
					<div align='center'>
						<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
						<div class='question'>
							<span>S</span>
							<span>I</span>
							<span>M</span>
							<span>P</span>
							<span>L</span>
							<span>Y</span>
							&nbsp;
							<span>S</span>
							<span>C</span>
							<span>R</span>
							<span>A</span>
							<span>B</span>
							<span>L</span>
							<span>E</span>
						</div>
					</div>
				</div>
				<div class='col-sm-6 col-sm-offset-3'>
					<div class='row'>
						<div class='col-sm-12'>
							<input type='text' class='form-control answer' name='answer' required>
							<br>
						</div>
						<div class='col-sm-6'>
							<button type='button' class='btn btn-md btn-block btn-submit-scrable btn-blue btn-skip' >Skip</button>
						</div>
						<div class='col-sm-6'>
							<button type='submit' class='btn btn-md btn-block btn-submit-scrable btn-red btn-submit' >Submit</button>
						</div>
					</div>

				</div>
			</form>
		</div>
	</div>
</div>
<div class="modal  fade" id="scrablenotif" tabindex="-1" role="dialog" aria-labelledby="scrablenotif" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h2 align='center' class='auth' >Notifikasi</h2>
			</div>
			<div class="modal-body">
				<div class='notif'></div>
			</div>
			<div class="modal-footer" style='text-align:center;'>
				<button type="button" class="btn btn-md btn-submit-scrable btn-red btn-back" style='padding-right:20px;padding-left:20px;font-size:15px;'><i class='fa fa-user'></i> Kembali Ke Profile</button>
			</div>
		</div>
	</div>
</div>
<div class="modal  fade" id="scrablestart" tabindex="-1" role="dialog" aria-labelledby="scrablestart" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h2 align='center' class='auth' >Cara Bermain</h2>
			</div>
			<div class="modal-body">
				<div class='notif'>
					<?=$website['tnc_scrable'];?>
				</div>
			</div>
			<div class="modal-footer" style='text-align:center;'>
				<button type="button" class="btn btn-md btn-submit-scrable btn-blue btn-batal" style='padding-right:20px;padding-left:20px;font-size:15px;'><i class='fa fa-chevron-left'></i> Batal</button>
				<button type="button" class="btn btn-md btn-submit-scrable btn-red btn-mulai" style='padding-right:20px;padding-left:20px; font-size:15px;' >Mulai <i class='fa fa-chevron-right'></i></button>
			</div>
		</div>
	</div>
</div>
<?php $this->load->view('front/podcast/footerfp');?>
<script>
	// Opera 8.0+
	var isOpera = (!!window.opr && !!opr.addons) || !!window.opera || navigator.userAgent.indexOf(' OPR/') >= 0;

	// Firefox 1.0+
	var isFirefox = typeof InstallTrigger !== 'undefined';

	// Safari 3.0+ "[object HTMLElementConstructor]"
	var isSafari = /constructor/i.test(window.HTMLElement) || (function (p) { return p.toString() === "[object SafariRemoteNotification]"; })(!window['safari'] || (typeof safari !== 'undefined' && safari.pushNotification));

	// Internet Explorer 6-11
	var isIE = /*@cc_on!@*/false || !!document.documentMode;

	// Edge 20+
	var isEdge = !isIE && !!window.StyleMedia;

	// Chrome 1 - 71
	var isChrome = !!window.chrome && (!!window.chrome.webstore || !!window.chrome.runtime);

	// Blink engine detection
	var isBlink = (isChrome || isOpera) && !!window.CSS;


  var ua = navigator.userAgent.match(/(opera|chrome|safari|firefox|msie)\/?\s*(\.?\d+(\.\d+)*)/i),
      browser;
  if (navigator.userAgent.match(/Edge/i) || navigator.userAgent.match(/Trident.*rv[ :]*11\./i)) {
    browser = "msie";
  }
  else {
    browser = ua[1].toLowerCase();
  }

	function parseUTC(s) {
		var b = s.split(/\D/);
		return new Date(Date.UTC(b[0],--b[1],b[2],b[3],b[4],b[5]))
	}
	var coount = "0";
	document.addEventListener('contextmenu', event => event.preventDefault());
	$(document).on('ready', function() {
		var enda = "2019-08-31 12:50:10";
		var pisah = enda.split(" ");
		var pisaht = pisah[0].split("-");

		if(browser=="safari" ){
			var jadi = pisaht[0] + "/"+pisaht[1]+"/"+pisaht[2]+"T"+pisah[1];
			var countDownDate = new Date(parseUTC(jadi));
			var now = new Date().getTime();
			alert(countDownDate);
			var distance = countDownDate - now;
			alert(countDownDate + " - "+now+" = "+distance);
		}else{
			var jadi = pisaht[1] + " "+pisaht[2]+", "+pisaht[0]+" "+pisah[1];
			var countDownDate = new Date(jadi).getTime();
			var now = new Date().getTime();
			var distance = countDownDate - now;
			alert(countDownDate + " - "+now+" = "+distance);
		}

		var x = setInterval(function() {
			var now = new Date().getTime();
			var distance = countDownDate - now;
			var days = Math.floor(distance / (1000 * 60 * 60 * 24));
			var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
			var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
			var seconds = Math.floor((distance % (1000 * 60)) / 1000);

			if(minutes.toString().length ==1){
				minutes = "0"+minutes;
			}
			if(seconds.toString().length ==1){
				seconds = "0"+seconds;
			}
			document.getElementById("time").innerHTML = minutes + ":" + seconds;
			if (distance < 1) {
				clearInterval(x);
				document.getElementById("time").innerHTML = "00:00";
				$('#scrablenotif').modal({backdrop: 'static', keyboard: false});
				$('#scrablenotif .notif').html("<div class='alert alert-danger' align='center'>Waktu Anda sudah habis!</div>")  ;

			}
		}, 1000);

	});


	$(document).keydown(function (event) {
		if (event.keyCode == 123) { // Prevent F12
			return false;
		} else if (event.ctrlKey && event.shiftKey && event.keyCode == 73) { // Prevent Ctrl+Shift+I
			return false;
		}
	});
 	document.onkeydown = function(){
		switch (event.keyCode) {
			case 116 : //F5
				event.returnValue = false;
				event.keyCode = 0;
				return false;
			break;
			case 82 : //R
				if (event.ctrlKey) {
					event.returnValue = false;
					event.keyCode = 0;
					return false;
				}
			break;
			case 65 : //A
				if (event.ctrlKey) {
					event.returnValue = false;
					event.keyCode = 0;
					return false;
				}
			break;
			case 123 : //F12
				if (event.ctrlKey) {
					event.returnValue = false;
					event.keyCode = 0;
					return false;
				}
			break;
		}
	}
</script>
