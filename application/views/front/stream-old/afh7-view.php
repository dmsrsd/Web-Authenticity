<div class="container">
	<img src="<?php echo base_url('uploads/') ?>head_cc.jpg" width="100%">
	<div class="row" style="margin-top: 30px">
		<div class="col-md-8">
			<div class="video-container">

			<!--<h1>AFH 7</h1>-->
			<style>
			.bokitem{
			width:100%;background-color:#000000;
			height:400px;color:#ffffff;
			text-align:center;
			padding-top:150px;
			padding-left: 10px;
			padding-right: 10px;
			}

			@media only screen and (max-width: 600px) {
			.bokitem{
			height:400px;
			padding-top:40px;
			}
			}



			</style>

				<div class="bokitem">

				<h3>Live streaming akan mulai pukul 15.30</h3>
				<h4>kalo mau live comment, pakai desktop ya guys!!</h4>
				</div>



				<!--<iframe width="853" height="480" src="https://www.youtube.com/embed/JQkui4LeQPI?autoplay=1&auto_play=true" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>-->
			</div>
			<div>



			</div>
		</div>
		<div class="col-md-4 hidden-xs">
			<!-- <img src="<?php echo base_url('uploads/') ?>chat.jpg" width="100%"> -->
			<iframe width="100%" height="500" src="https://www.youtube.com/live_chat?v=JQkui4LeQPI&embed_domain=www.authenticity.id" frameborder="0"></iframe>
			</iframe>

		</div>



	</div>
</div>
<center>
	<?php // include "counter.php"; ?>
</center>

<?php $this->load->view('front/podcast/footerfp');?>