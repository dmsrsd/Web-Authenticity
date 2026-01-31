
<?php $this->load->view('front/podcast/footerfp');?>

<script>
function myFunction() {
  /* Get the text field */
  var copyText = document.getElementById("myInput");

  /* Select the text field */
  copyText.select();

  /* Copy the text inside the text field */
  document.execCommand("copy");

  /* Alert the copied text */
  //copyText.value
  alert("Share & Ajak teman Anda untuk daftar ");
}
		var isMobile = {
			Android: function() {
				return navigator.userAgent.match(/Android/i);
			},
			BlackBerry: function() {
				return navigator.userAgent.match(/BlackBerry/i);
			},
			iOS: function() {
				return navigator.userAgent.match(/iPhone|iPad|iPod/i);
			},
			Opera: function() {
				return navigator.userAgent.match(/Opera Mini/i);
			},
			Windows: function() {
				return navigator.userAgent.match(/IEMobile/i);
			},
			any: function() {
				return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
			}
		};
	$(document).on('ready', function() {

		$('#yarticle').hide();
		$('#ysong').hide();
		$('.backyour').click(function(){
			$('#ysong').hide();
			$('#yarticle').hide();
			$('#yhome').show();
		});
		$('.show-article').click(function(){
			$('#ysong').hide();
			$('#yhome').hide();
			$('#yarticle').show();
		});
		$('.show-soundroom').click(function(){
			$('#yarticle').hide();
			$('#yhome').hide();
			$('#ysong').show();
		});
		$('#mobilereferal').hide();
		if( isMobile.any() ) {
			$('#mobilereferal').show();
			$('.btnwhatsapp').click(function() {
				if( isMobile.any() ) {
					var text = $(this).attr("data-text");
					var url = $(this).attr("data-link");
					var message = encodeURIComponent(text) + " - " + encodeURIComponent(url);
					var whatsapp_url = "whatsapp://send?text=" + message;
					window.location.href = whatsapp_url;
				} else {
					alert("Please share this article in mobile device");
				}
			});
		}


		$('.share-code').click(function(){
			$('#sharecodemodal').modal('show');
		});
		$('.btn-redeemlogin').click(function(){
			$('#redeemlogin').modal('show');
		});
		$('.btn-redeemnot').click(function(){
			$('#redeemnotif').modal('show');
			$('#redeemnotif .notif').html('Kumpulin terus point lo, untuk dapetin barang-barang menarik');
		});
		$('.btn-redeemed').click(function(){
			$('#redeemnotif').modal('show');
			$('#redeemnotif .notif').html('You have redeemed this item');
		});
 		<?php if(!empty($this->datamember)){ ?>

		$('.btn-redeem').click(function(){
			var x = $(this).attr('data-res');
			$('#redeemmodal .btn-x').attr('data-x',x);
			$('#redeemmodal').modal('show');
		});
		$('.btn-x').click(function(){
			<?php if($okredeem=="ok"){?>
			var x = $(this).attr('data-x');
			var dataform = new FormData();
			dataform.append('<?php echo $this->security->get_csrf_token_name(); ?>', '<?php echo $this->security->get_csrf_hash(); ?>');
			dataform.append('x', x);
			$.ajax({
				type: "POST",
				data: dataform,
				dataType: "json",
				contentType: false,
				processData: false,
				url: "<?php echo base_url();?>profile/getredeem",
				beforeSend: function () {
					$('.btn-x').prop("disabled", true);
				},
				success: function (e) {
					$('.btn-x').prop("disabled", false);
					$('#redeemmodal').modal('hide');
					$('#redeemnotif').modal('show');
					var html = "";
					if(e.status=="false"){
						html = "<div class='alert alert-danger'>"+ e.message +"</div>";
					}else{
						$('#'+e.btnv).attr('class','btn btn-md btn-block btn-votehave btn-red');
						$('#tot').html(e.qtot);
						html = "<div class='alert alert-success'>"+ e.message +"</div>";
						html+= e.message2;
					}
					$('#redeemnotif .notif').html(html);
				},
				error: function () {
					$('#redeemmodal').modal('hide');
					$('#redeemnotif').modal('show');
					$('#redeemnotif .notif').html('ERROR!');
					$('.btn-x').prop("disabled", false);
				}
			});
			<?php }?>
		});
		<?php }?>
	});
</script>
