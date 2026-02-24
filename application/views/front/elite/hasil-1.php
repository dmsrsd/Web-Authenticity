<!DOCTYPE html>

<html>
    <?php $this->load->view("front/elite/head.php");?>
<body class="circle h-full"> 
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5Q5GBNF" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WH8ZRXFD" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
	<div class="container-full">
        <div class="row p-2">
            <div class="col-md-6"></div>
            <div class="col-md-6 text-right">
                <img src="<?php echo base_url('assets/elite-html') ?>/images/logo_small.png" class="">
            </div>
        </div>
    </div>
	<?php if($data_elite['kode_pemenang']==1){ ?>
		<div class="container-full"> 
			<div class="container">
				<div class="row">
					<div class="col-md-12 box-head"></div>
					<div class="col-md-12 box-body" style="min-height: 300px">
						<div class="row">
							<div class="col-md-4">
								<img src="<?php echo base_url('assets/elite-html') ?>/images/flower-img.jpeg" class="img-responsive mb-2">
							</div>
							<div class="col-md-8">
								<h4 class="text-left f3">This is Your Elite Vibe</h4>
								<p style="font-size: 2rem"><strong>Smooth talker, smooth walker.</strong></p>
								<p>Lo peka, cair, dan bisa bikin semua orang nyaman tanpa kehilangan arah. Gaya lo santai tapi tetap punya kelas.</p>
								<p></p>
								<p>
								<img src="<?php echo base_url('assets/elite-html') ?>/images/hasil01.png" class="img-responsive">
								</p>
								<p style="font-size: 2rem; text-transform: uppercase;"><strong>#intensesmoothness</p>
							</div>
						</div>
					</div>
					<div class="col-md-12 box-foot"></div>
				</div>
			</div>
			<div class="container">
				<div class="col-md-12 text-center">
					<div class="button-nav"> 
						<div class="row">
							<div class="col-md-12 text-center"><h3 class="text-but">
								<a href="<?php echo base_url('elite/download/1') ?>">Next >></a>
							</h3></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php } else if($data_elite['kode_pemenang']==2){ ?>
		<div class="container-full"> 
			<div class="container">
				<div class="row">
					<div class="col-md-12 box-head"></div>
					<div class="col-md-12 box-body" style="min-height: 300px">
						<div class="row">
							<div class="col-md-4">
								<img src="<?php echo base_url('assets/elite-html') ?>/images/star-img.jpeg" class="img-responsive mb-2">
							</div>
							<div class="col-md-8">
								<h4 class="text-left f3">This is Your Elite Vibe</h4>
								<p style="font-size: 2rem"><strong>Nggak banyak bicara, tapi tajamnya terasa.</strong></p>
								<p>Elegan dari dalam, dan makin lo diam, makin orang penasaran. Inner strength lo bikin lo berkelas dengan cara lo sendiri.</p>
								<p></p>
								<p>
								<img src="<?php echo base_url('assets/elite-html') ?>/images/hasil02.png" class="img-responsive">
								</p>
								<p style="font-size: 2rem; text-transform: uppercase;"><strong>#intensesmoothness</p>
							</div>
						</div>
					</div>
					<div class="col-md-12 box-foot"></div>
				</div>
			</div>
            <div class="container">
                <div class="col-md-12 text-center">
                    <div class="button-nav"> 
                        <div class="row">
                            <div class="col-md-12 text-center"><h3 class="text-but">
								<a href="<?php echo base_url('elite/download/2') ?>">Next >></a>
							</h3></div>
                        </div>
                    </div>
                </div>
            </div>
		</div> 
	<?php } else { ?>
		<div class="container-full"> 
			<div class="container">
				<div class="row">
					<div class="col-md-12 box-head"></div>
					<div class="col-md-12 box-body" style="min-height: 300px">
						<div class="row">
							<div class="col-md-4">
								<img src="<?php echo base_url('assets/elite-html') ?>/images/love-img.jpeg" class="img-responsive mb-2">
							</div>
							<div class="col-md-8">
								<h4 class="text-left f3">This is Your Elite Vibe</h4>
								<p style="font-size: 2rem"><strong>Tenang, tapi selalu ninggalin bekas.</strong></p>
								<p>Lo nggak nyari spotlight, tapi selalu jadi orang yang bikin suasana stabil.  Respectfulness. Yang kenal lo, pasti respect.</p>
								<p></p>
								<p>
								<img src="<?php echo base_url('assets/elite-html') ?>/images/hasil03.png" class="img-responsive">
								</p>
								<p style="font-size: 2rem; text-transform: uppercase;"><strong>#intensesmoothness</p>
							</div>
						</div>
					</div>
					<div class="col-md-12 box-foot"></div>
				</div>
			</div>
            <div class="container">
                <div class="col-md-12 text-center">
                    <div class="button-nav"> 
                        <div class="row">
                            <div class="col-md-12 text-center"><h3 class="text-but">
								<a href="<?php echo base_url('elite/download/3') ?>">Next >></a>
							</h3></div>
                        </div>
                    </div>
                </div>
            </div>
		</div> 
	<?php } ?>
	
	<!-- Modal -->
	<div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="videoModalLabel">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-content">
					<div class="modal-body" style="padding:0">
						<div class="modal-body d-flex justify-content-center align-items-center" style="max-width: 600px;">
							<img src="<?php echo base_url('assets/elite-html/images/banner_elite.gif') ?>" alt="Banner Elite" class="img-fluid" width="100%">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--<div style="height:150px;">&nbsp;</div>-->
	<!-- content --> 
    <?php $this->load->view("front/elite/footer.php");?>
	<script>
		$(document).ready(function(){
			$('#videoModal').modal('show');
			setTimeout(function() {
				$('#videoModal').modal('hide');
			}, 6000);
			// var video = document.querySelector('#videoModal video');
			// video.addEventListener('ended', function() {
			// 	$('#videoModal').modal('hide');
			// });
		});
	</script>
</body>
</html>