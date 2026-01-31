<!DOCTYPE html>
<html>
    <?php $this->load->view("front/tarotunes/head.php");?>
<body> 

<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5Q5GBNF" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WH8ZRXFD" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->

	<!-- content --> 
	<div class="content"> 
    <section class="dark-section"> 
			<div class="container">
				<div class="row row-card">
					<div class="col-md-12 text-center">
						<img src="<?php echo base_url('assets/tarotunes-html/images/logo_tarotunes_large.png')?>" class="logo_large"> 
						<p>Hidup lo kayak playlist yang lagi shuffle kadang mellow, kadang meledak.
							Tarot ini bukan ramalan mistis, tapi kayak lirik lagu yang nyindir pelan-pelan.
							Tarik satu kartu, dan dengerin apa kata semesta di balik noise harian lo.</p>
						<a href="<?php echo base_url('tarotunes/main') ?>" class="btn-primary">KLIK BUAT CARI TAU</a>
					</div>
				</div>
			</div>
		</section> 
	</div> 
	<!-- content --> 
    <?php $this->load->view("front/tarotunes/footer.php");?>
	
	<script type="text/javascript">
		Moengage.track_event("Tarotunes", {
		"email": "<?php echo $member['email'] ?>",
		"halaman": "home tarotunes"
    });
	</script>
	
</body>
</html>