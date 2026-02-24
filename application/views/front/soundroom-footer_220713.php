		</div>
		<footer class='container-fluid visible-xs'>
			<div class='containers'>
				<div class='row'>
					<div class='col-xs-7 text-left'> 
						<a href='<?=base_url()?>'><img src='<?php echo base_url()?>uploads/logow.png' style='width:120px;'></a><br><br>
						<div style='font-size:12px;'>2019 Simply Authentic. All Rights Reserved.</div>
			
					</div>
					<div class='col-xs-5'> 
					<div class='text-right'>
						<a href='<?=base_url()?>tentang'>Tentang</a><br>
						<a href='<?=base_url()?>tnc'>Syarat &amp; Ketentuan</a><br>
						<a href='<?=base_url()?>privacy'>Kebijakan Privasi</a><br>
						<a href=''><i class='fa fa-instagram'></i> Instagram</a><br>
						<a href=''><i class='fa fa-youtube'></i> Youtube</a>
					</div>
					</div>
				</div>
			</div>
		</footer>
		<footer class='container-fluid hidden-xs'>
			<div class='containers'>
			<div class='row'>
				<div class='col-sm-4'> 
					<div class='text-left'>
						<a href='<?=base_url()?>tentang'>Tentang</a><br>
						<a href='<?=base_url()?>tnc'>Syarat &amp; Ketentuan</a><br>
						<a href='<?=base_url()?>privacy'>Kebijakan Privasi</a><br>
						<a href='mailto:info@simplyauthentic.id'>Hubungi Kami</a>
					</div>
				</div>
				<div class='col-sm-4'>
					<div class='text-center'>
						<a href='<?=base_url()?>'><img src='<?php echo base_url()?>uploads/logow.png' style='width:120px;'></a><br><br>
						2019 Simply Authentic. All Rights Reserved.
					</div>
				</div>
				<div class='col-sm-4'>
					<div class='text-right'> 
						<a href='http://instagram.com/<?=$website['instagram'];?>' target='_blank'><i class='fa fa-instagram'></i> Instagram</a><br>
						<a href='<?=$website['youtube'];?>' target='_blank'><i class='fa fa-youtube'></i> Youtube</a>
					
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
		<div class='sticky  hide'>
			<div class=''>
				<img src='<?=base_url()?>assets/front/img/login-sticky.gif' width='280'>
				<!--
				<div class='left-sticky'><i class='fa fa-chevron-right'></i> Login for More Benefit</div>
				<div class='right-sticky'><img src='<?=base_url()?>assets/front/img/sticky.png' width='65'></div>
				<div class='cl'></div>
				-->
			</div>
		</div>
		<div class="modal  fade" id="stickymodal" tabindex="-1" role="dialog" aria-labelledby="stickymodal" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<button type="button" class="sticky-close" data-dismiss="modal" aria-label="Close"><i class='fa fa-times'></i></button>
				<div class="modal-content">
					<div class="modal-header">
						<h2 align='center' class='auth' >Login dan Dapatkan Benefits!</h2>
					</div>
					<div class="modal-body">
						<div class='row'>
							<div class='col-sm-6'>
								<img src='<?=base_url();?>assets/front/img/imgpopupsticky.png' style='width:100%;'><br>
								Hadiah yang bisa lo incar seperti di gambar ini.<br>Walaupun tidak sama mereknya, yang pasti nilainya sebanding. 
							</div>
							<div class='col-sm-6'>
								<div class='head-sticky'>
									Ayo aktif, dan tingkatkan terus point Lo!  
								</div>
								<p>
									Tukarkan poin yang lo kumpulkan menjadi barang impian lo. Login lalu mainkan games dan aktivasi untuk mendapatkan poin sebanyak-banyaknya.
								</p>
								<div class='row' style=''>
									<div class='col-sm-8 col-sm-offset-2 button-sticky'>
										<a href='<?=base_url()?>tnc-rewards' class='btn btn-red btn-block'>Term &amp; Condition</a>
										<a href='<?=base_url()?>login' class='btn  btn-blue btn-block'>Login / Sign Up</a>
									</div>
								</div>
							</div>
						</div>
					</div> 				
				</div>
			</div>
		</div>		
		<?php }}?>
	<div class="modal  fade" id="mdlcari" tabindex="-1" role="dialog" aria-labelledby="mdlcari" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h2 align='center' class='auth' >Cari band favorit Lo!</h2>
				</div>
				<div class="modal-body"> 
					<form role="form" class="navbar-form " action="<?=base_url()?>soundroom/search"  method="post" data-parsley-validate  autocomplete="off">
						<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
						<div class="container-fluid">
							<div class="row no-gutter">
								<div class="col-xs-10">
									<input type="text" name='txtsearch' required class="form-control txtsearch" placeholder="Search" style='width:100%;'>
								</div>
								<div class="col-xs-2"> 
									<button type="submit" style='margin-top:4px; padding:4px 12px;' class="btn btn-default btnsearchmodal"><i class='fa fa-search'></i></button>
								</div>
							</div>
						</div>
					</form>	
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>				
			</div>
		</div>
	</div>		
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
								<button type="submit" class="btn btn-default btnsearch"><i class='fa fa-search'></i></button>
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
		<script src="<?php echo base_url()?>assets/front/js/css3-animate-it.js" type="text/javascript"></script>	
		<?php if (!is_localhost()) { ?>
		<script src='https://connect.facebook.net/en_US/all.js' type="text/javascript"></script>
		<?php } ?>
		<script>
			//document.getElementById('bdstat').src='';
			$(document).ready(function () {  
				$('.overlay-all').hide();
				$('.menu-cari').on('click',function(){
					$('#mdlcari').modal('show');
				});
			});
			
			
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
