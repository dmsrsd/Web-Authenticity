
		<div class='footerbg'>

		</div>
		<footer class='footer1 container-fluid '>
			<div class='containers'>
				<div class='row'>
					<div class='col-xs-7 text-left'>
						<a href='<?=base_url()?>'><img src='<?php echo base_url()?>uploads/logow.png' style='width:120px;'></a>
						<!--<div style='font-size:12px;'>2020 Authenticity. All Rights Reserved.</div>-->
						<div class='text-left'>
							2021 Simply Authentic. All Rights Reserved.
							<br>
							<a href='<?=base_url()?>tentang'>Tentang</a> | <a href='<?=base_url()?>tnc'>Syarat &amp; Ketentuan</a> | <a href='<?=base_url()?>privacy'>Kebijakan Privasi</a></div>

					</div>
					<div class='col-xs-5'>
					<div class='text-right'>
						<div class='link-topsosmed'>
							<a href='https://www.youtube.com/channel/UCCRi6YZ63-6HT7L8nD3Lvhw'  target='_blank'><i class='fa fa-youtube'></i> Authenticity ID</a>
							<a href='http://instagram.com/authenticity_id' target='_blank'><i class='fa fa-instagram'></i> authenticity_id</a>
						</div>
					</div>
					</div>
				</div>
			</div>
		</footer>
		<!--<footer class='container-fluid footer2'>
			<div class='container-fluid'>
				<div class='row'>
					<div class='col-sm-4'>
						<div class='text-left'>
							<img src='<?=base_url()?>assets/front/img/kanker.jpg' alt='clasmild-footer-kanker' width='120' class='img'>
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
				</div>
			</div>
		</footer>-->
		<?php  @$page = $this->uri->segment(1); if(empty($this->datamember)){ if($page!="login" && $page!="register"){?>
		<div class='sticky hide'>
			<div class=''>
				<!--<a href="<?php echo base_url('authentic-store') ?>" target="_self">--><img src='<?=base_url()?>assets/front/img/login-sticky.gif' width='280'><!--</a>-->
				<!--
				<div class='left-sticky'><i class='fa fa-chevron-right'></i> Login for More Benefit</div>
				<div class='right-sticky'><img src='<?=base_url()?>assets/front/img/sticky.png' width='65'></div>
				<div class='cl'></div>
				-->
			</div>
		</div>
		<div class="modal hide fade" id="stickymodal" tabindex="-1" role="dialog" aria-labelledby="stickymodal" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<button type="button" class="sticky-close" data-dismiss="modal" aria-label="Close"><i class='fa fa-times'></i></button>
				<div class="modal-content">
					<div class="modal-header">
						<h2 align='center' class='auth' >Register / Login dulu untuk memulai</h2>
					</div>
					<div class="modal-body">
						<div class='row'>
							<div class='col-sm-6'>
								<img src='<?=base_url();?>assets/front/img/imgpopupsticky.png' style='width:100%;'><br>

							</div>
							<div class='col-sm-6'>
								<div class='head-sticky'>
									Ayo Register / Login, supaya bisa akses apapun yang ada di Authenticity.id
								</div>
								<p>
									Biar tambah semangat, tungguin kejutan yang akan kita kasih buat lo yang setia sama kita!
								</p>
								<div class='row' style=''>
									<div class='col-sm-8 col-sm-offset-2 button-sticky'>
										<!--<a href='<?=base_url()?>tnc-rewards' class='btn btn-red btn-block'>Term &amp; Condition</a>-->
										<br>
										<a href='<?=base_url()?>login' class='btn  btn-blue btn-block'>Register / Login</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php }}?>
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
  padding: 0!important;
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
				<form role="form" class="navbar-form " action="<?=base_url()?>search"  method="post" data-parsley-validate  autocomplete="off">
					<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
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
		<script src="<?php echo base_url()?>assets/front/js/block.js"  type="text/javascript"></script>
		<script src="<?php echo base_url()?>assets/front/js/jquery.js"  type="text/javascript"></script>
		<script src="<?php echo base_url()?>assets/front/js/bootstrap.min.js"  type="text/javascript"></script>
		<script src="<?=base_url()?>assets/datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>
		<script src="<?php echo base_url()?>assets/front/js/css3-animate-it.js" type="text/javascript"></script>
		<?php if (!is_localhost()) { ?>
		<script src='https://connect.facebook.net/en_US/all.js' type="text/javascript"></script>
		<?php } ?>
		<script>
			//document.getElementById('bdstat').src='';
			$(document).ready(function () {
				$('.overlay-all').hide();
				$('.sticky').click(function(){
					$('#stickymodal').modal({backdrop: 'static', keyboard: false});
				});
				$('.cyp').click(function(){
					$('#stickymodal').modal({backdrop: 'static', keyboard: false});
				});
				$('.kudu-login').click(function(){
					$('#stickymodal').modal({backdrop: 'static', keyboard: false});
				});
				$('.sticky-close').click(function(){
					//$('#stickymodal').modal('hide');
				});
				$('.navbar-icon-menu').click(function(){
					if($('#navbar').is( ":visible" )){
						if($('.menu-mobile').is( ":visible" )){
							$('#navbar').collapse('hide');
						}else{
							$('#navbar').attr("class","navbar-collapse collapse in a");
							$('#navbar').attr("style","height:auto;");
							$('#navbar').collapse('show');
						}
					}else{
						$('#navbar').collapse('show');
					}
					$('.menu-mobile').show();
					$('.form-mobile').hide();
				});
				$('.navbar-icon-search').click(function(){
					$('#searchmodal').modal();
				});
				$('.snavbar-icon-search').click(function(){
					if($('#navbar').is( ":visible" )){
						if($('.form-mobile').is( ":visible" )){
							$('#navbar').collapse('hide');
						}else{
							$('#navbar').attr("class","navbar-collapse collapse in c");
							$('#navbar').attr("style","height:auto;");
							$('#navbar').collapse('show');
						}
					}else{
						$('#navbar').collapse('show');
					}
					$('.menu-mobile').hide();
					$('.form-mobile').show();
					$('.txtsearch').focus();
				});
				$(window).on('resize', function(){
					var h = $(window).width();
					if(h<768){
						$('.menu-mobile').hide();
						$('.form-mobile').hide();
					}else{
						$('.menu-mobile').show();
						$('.form-mobile').show();
					}
				});


				var iScrollPos = 0;
				$(window).scroll(function() {
					var total = $(window).scrollTop();
					var iCurScrollPos = $(this).scrollTop();
					if (iCurScrollPos > iScrollPos) {

					}else{

					}
					iScrollPos = iCurScrollPos;

				});
                $(".datepicker").datepicker({
                    dateFormat: "yy-mm-dd",
				});


			});
			<?php  @$page = $this->uri->segment(1); if(empty($this->datamember)){ if($page!="login" && $page!="register"){?>
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
			<?php }}?>

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

      twttr.ready(function (twttr) {
          // console.dir("Tweet");
      });

	<?php if (!is_localhost()) { ?>
	FB.init({appId: "2153941954652615", status: true, cookie: true, version    : '3.2'});
	<?php } else { ?>
	window.FB = window.FB || { init: function(){} };
	<?php } ?>

		</script>
	</body>
</html>
