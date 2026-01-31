<!DOCTYPE html>
<html>
    <?php $this->load->view("front/elite/head.php");?>
<body class="circle"> 
	<script>
		window.location.href = "https://www.authenticity.id/elite/main?tnc=<?php echo $_GET['tnc'] ?>";
	</script>script>
	<div class="container-full"> 
			<div class="container">
				<div class="row row-card">
					<div class="col-md-12 text-center">
						<div class="web-box"><img src="<?php echo base_url('assets/elite-html') ?>/images/logo_front2.png" class="logo_large"> </div>
						<div class="m-box"><img src="<?php echo base_url('assets/elite-html') ?>/images/logo_m.png" class="logo_large"> </div>
						<p class="text-front">Elite isn't just a label-it's your vibe. Take our quiz, unlock your persona, and claim exclusive merch plus a premium festival experience at our booth. Limited spots. Don’t miss out!</p>
						<div class="pos_but">
							<a href="<?php echo base_url('elite/main?tnc='.$_GET['tnc']) ?>">
								<img src="<?php echo base_url('assets/elite-html') ?>/images/button_front.png" class="">
							</a>
						</div>
					</div>
				</div>
			</div>
	</div>
	<!-- content --> 
    <?php $this->load->view("front/elite/footer.php");?>
	<script type="text/javascript">
		Moengage.track_event("Define your elite", {
		"email": "email@email.com",
		"halaman": "home"
		});
	</script>

</body>
</html>