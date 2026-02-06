<div class='footerbg'>

</div>
<footer class='container-fluid'>
	<div class='containers'>
		<div class='row'>
			<div class='col-lg-6 col-xs-12 text-left'>
				<div class="footer-left">
					<div class="footer-left__logo">
						<img src='<?php echo base_url() ?>assets/front/img/iniasligue.png' />
					</div>
					<div class="foter-left__nav">
						<a href='<?= base_url() ?>'><img src='<?php echo base_url() ?>uploads/logow.png' style='width:120px;'></a>
						<div class='text-left2'>
							2021 Simply Authentic. All Rights Reserved.
							<br>
							<a href='<?= base_url() ?>tentang'>Tentang</a> |
							<a href='<?= base_url() ?>tnc'>Syarat &amp; Ketentuan</a> |
							<a href='<?= base_url() ?>privacy'>Kebijakan Privasi</a>
						</div>
					</div>
				</div>

			</div>
			<div class='col-lg-6 col-xs-12'>
				<div class='text-right'>
					<div class='link-topsosmed'>
						<a href='https://www.tiktok.com/@authenticity_id' target='_blank'><img src='<?php echo base_url() ?>assets/front/img/socmed/tiktok.png'> Authenticity_id</a>
						<a href='https://instagram.com/authenticity_id' target='_blank'><img src='<?php echo base_url() ?>assets/front/img/socmed/ig.png'> authenticity_id</a>
						<a href='https://www.youtube.com/channel/UCCRi6YZ63-6HT7L8nD3Lvhw' target='_blank'><img src='<?php echo base_url() ?>assets/front/img/socmed/yt.png'> Authenticity ID</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</footer>
<footer class='footer2'>
	<div class='container-fluid'>
		<div class="warning">
			<img src='<?php echo base_url() ?>assets/front/img/peringatan.png'>
		</div>
		<!-- <div class='row'>
					<div class='col-sm-4'>
						<div class='text-left'>
							<img src='<?= base_url() ?>assets/front/img/kanker.jpg' alt='clasmild-footer-kanker' width='120' class='img'>
						</div>
					</div>
					<div class='col-sm-4'>
						<div align='center'>
							<h3>PERINGATAN:</h3>
							KARENA MEROKOK, SAYA TERKENA KANKER TENGGOROKAN<BR>
							<div class='foot-small'>LAYANAN BERHENTI MEROKOK (0800-177-6565)</div>
						</div>
					</div>
					<div class='col-sm-4'>
						<div class='text-right'>
							<a class='plus18'>
								18+
							</a>
						</div>
					</div>
				</div> -->
	</div>
</footer>
</div>
</div>
<style>
	footer {
		background: #02529A;
	}
</style>
<?php @$page = $this->uri->segment(1);
if (empty($this->datamember)) {
	if ($page != "login" && $page != "register") { ?>
		<div class='sticky hide'>
			<div class=''>
				<!--<a href="https://www.authenticity.id/authentic-store" target="_self">--><img src='<?= base_url() ?>assets/front/img/login-sticky.gif' width='280'>
				<!--</a>-->
				<!--
				<div class='left-sticky'><i class='fa fa-chevron-right'></i> Login for More Benefit</div>
				<div class='right-sticky'><img src='<?= base_url() ?>assets/front/img/sticky.png' width='65'></div>
				<div class='cl'></div>
				-->
			</div>
		</div>
		<div class="modal hide fade" id="stickymodal" role="dialog" aria-labelledby="stickymodal" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<button type="button" class="sticky-close" data-dismiss="modal" aria-label="Close"><i class='fa fa-times'></i></button>
				<div class="modal-content">
					<div class="modal-header">
						<h2 align='center' class='auth'>Register / Login dulu untuk memulai</h2>
					</div>
					<div class="modal-body">
						<div class='row'>
							<div class='col-sm-6'>
								<img src='<?= base_url(); ?>uploads/newcampaign/art_logo.png' style='width:100%;'><br>

							</div>
							<div class='col-sm-6'>
								<div class='head-sticky'>
									Ayo Register / Login, supaya bisa akses apapun yang ada di Authenticity.id & ikutan Cover Artwork Competition!
								</div>
								<div class='row' style=''>
									<div class='col-sm-8 col-sm-offset-2 button-sticky'>
										<!--<a href='<?= base_url() ?>tnc-rewards' class='btn btn-red btn-block'>Term &amp; Condition</a>-->
										<br>
										<a href='<?= base_url() ?>login' class='btn  btn-blue btn-block' id='linklogin'>Register / Login</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php }
} ?>
<div class='overlay-all'>
	<div class='inoverlay'>
		<div class='contentoverlay'>
			Please wait...
		</div>
	</div>
</div>
<style>
	.mdalse {
		text-align: center;
		padding: 0 !important;
	}

	.mdalse:before {
		content: '';
		display: inline-block;
		height: 100%;
		vertical-align: middle;
		margin-right: -4px;
	}

	.mdalse .modal-dialog {
		display: inline-block;
		text-align: left;
		vertical-align: middle;
	}
</style>
<div class="  modal fade" id="searchmodal" tabindex="-1" role="dialog" aria-labelledby="searchmodal" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-body">
				<form role="form" class="navbar-form " action="<?= base_url() ?>search" method="post" data-parsley-validate autocomplete="off">
					<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
					<div class="container-fluid">
						<div class="row no-gutter">
							<div class="col-xs-10">
								<input type="text" name='txtsearch' required class="form-control txtsearch" placeholder="Search" style='width:100%;'>
							</div>
							<div class="col-xs-2">
								<button type="submit" class="btn btn-default btnsearchmodal"><i class='fa fa-search'></i></button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="  modal fade" id="cookiemodal" tabindex="-1" role="dialog" aria-labelledby="cookiemodal" aria-hidden="true">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Situs web ini menggunakan cookie</h4>
			</div>
			<div class="modal-body">
				Kami menggunakan cookie untuk mempersonalisasi konten dan iklan, untuk menyediakan fitur media sosial dan untuk menganalisis lalu lintas kami. Kami juga membagikan informasi tentang penggunaan Anda atas situs kami dengan mitra media sosial, periklanan, dan analitik kami yang mungkin menggabungkannya dengan informasi lain yang Anda berikan kepada mereka atau yang mereka kumpulkan dari penggunaan Anda atas layanan mereka.
			</div>
			<div class="modal-footer">
				<div class='row'>
					<div class='col-xs-4' align='left'>
						<button type="button" class="btn btn-primary acccookie">Izinkan Cookie</button>
					</div>
					<div class='col-xs-8'>
						<a href="<?= base_url(); ?>tnc" class="btn btn-default">Syarat &amp; Ketentuan Cookie</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="<?php echo base_url() ?>assets/front/js/block.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/front/js/jquery.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/front/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>assets/datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/front/js/css3-animate-it.js" type="text/javascript"></script>
<?php if (!is_localhost()) { ?>
<script src='https://connect.facebook.net/en_US/all.js' type="text/javascript"></script>
<?php } ?>
<script>
	$(document).ready(function() {
		<?php
		@$page = $this->uri->segment(1);
		if ($page == "tnc") {
		} else {
		?>
			<?php if ($this->cookie == "") { ?>
				$('.overlay-all').show();
				$('#cookiemodal').modal({
					backdrop: 'static',
					keyboard: false
				});
			<?php } ?>
		<?php } ?>
	});
	$(document).on("click", '.acccookie', function() {
		$.ajax({
			type: "GET",
			dataType: "json",
			contentType: false,
			processData: false,
			url: "<?php echo base_url(); ?>accept-cookie",
			beforeSend: function() {
				$(this).html("Silahkan tunggu ...");
				$(this).attr("disable", "disable");
			},
			success: function(e) {
				$(this).html("Izinkan Semua Cookie");
				$(this).removeAttr("disable");
				$('#cookiemodal').modal('hide');
			},
			error: function() {}
		});
	});
</script>
<script>
	//document.getElementById('bdstat').src='';
	$(document).ready(function() {
		$('.overlay-all').hide();
		$('.sticky').click(function() {
			$('#stickymodal').modal({
				backdrop: 'static',
				keyboard: false
			});
		});
		$('.cyp').click(function() {
			$('#stickymodal').modal({
				backdrop: 'static',
				keyboard: false
			});
		});
		$('.kudu-login').click(function() {
			$('#stickymodal').modal({
				backdrop: 'static',
				keyboard: false
			});
		});
		$('.sticky-close').click(function() {
			//$('#stickymodal').modal('hide');
		});
		$('.navbar-icon-menu').click(function() {
			if ($('#navbar').is(":visible")) {
				if ($('.menu-mobile').is(":visible")) {
					$('#navbar').collapse('hide');
				} else {
					$('#navbar').attr("class", "navbar-collapse collapse in a");
					$('#navbar').attr("style", "height:auto;");
					$('#navbar').collapse('show');
				}
			} else {
				$('#navbar').collapse('show');
			}
			$('.menu-mobile').show();
			$('.form-mobile').hide();
		});
		$('.navbar-icon-search').click(function() {
			$('#searchmodal').modal();
		});
		$('.snavbar-icon-search').click(function() {
			if ($('#navbar').is(":visible")) {
				if ($('.form-mobile').is(":visible")) {
					$('#navbar').collapse('hide');
				} else {
					$('#navbar').attr("class", "navbar-collapse collapse in c");
					$('#navbar').attr("style", "height:auto;");
					$('#navbar').collapse('show');
				}
			} else {
				$('#navbar').collapse('show');
			}
			$('.menu-mobile').hide();
			$('.form-mobile').show();
			$('.txtsearch').focus();
		});
		$(window).on('resize', function() {
			var h = $(window).width();
			if (h < 768) {
				$('.menu-mobile').hide();
				$('.form-mobile').hide();
			} else {
				$('.menu-mobile').show();
				$('.form-mobile').show();
			}
		});


		var iScrollPos = 0;
		$(window).scroll(function() {
			var total = $(window).scrollTop();
			var iCurScrollPos = $(this).scrollTop();
			if (iCurScrollPos > iScrollPos) {

			} else {

			}
			iScrollPos = iCurScrollPos;

		});
		$(".datepicker").datepicker({
			dateFormat: "yy-mm-dd",
		});


	});
	<?php @$page = $this->uri->segment(1);
	if (empty($this->datamember)) {
		if ($page != "login" && $page != "register") { ?>
			$(function() {
				var $postQ = $(".sticky"),
					$postQPos = $postQ.offset().top + $postQ.height(),
					$win = $(window);

				$win.scroll(function() {
					if ($postQPos > $win.scrollTop() + $win.height()) {
						// Post form off-screen
						$('.sticky').addClass('fixed');
					} else {
						$('.sticky').removeClass('fixed');
					}
				}).trigger('scroll'); // trigger the event so it moves into position on page load
			});
	<?php }
	} ?>

	window.twttr = (function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0],
			t = window.twttr || {};
		if (d.getElementById(id)) return t;
		js = d.createElement(s);
		js.id = id;
		js.src = "https://platform.twitter.com/widgets.js";
		fjs.parentNode.insertBefore(js, fjs);

		t._e = [];
		t.ready = function(f) {
			t._e.push(f);
		};

		return t;
	}(document, "script", "twitter-wjs"));

	twttr.ready(function(twttr) {
		// console.dir("Tweet");
	});

	<?php if (!is_localhost()) { ?>
	FB.init({
		appId: "2153941954652615",
		status: true,
		cookie: true,
		version: '3.2'
	});
	<?php } else { ?>
	window.FB = window.FB || { init: function(){} };
	<?php } ?>
</script>

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-2S17WRC5V6"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-2S17WRC5V6');
</script>
</body>
<!--grid-->

</html>