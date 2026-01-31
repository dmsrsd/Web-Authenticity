<footer class='footer2 banner-ads' id="BannerAds">
	<div class='container content-ads'>
		<button class="btn-close-red close-ads" id="CloseAds"  title="Close"><i class='fa fa-times'></i></button>
		<a href="https://clas-mild.com/" target="_blank" class="warning-desktop">
			<img class="image-ads" src='<?php echo base_url() ?>assets/front/img/profile/banner-ads.gif'>
		</a>
		<a href="https://clas-mild.com/" target="_blank" class="warning-mobile">
			<img class="image-ads" src='<?php echo base_url() ?>assets/front/img/profile/banner-ads-m.gif'>
		</a>
	</div>
</footer>

<script src="<?php echo base_url('assets/elite-html/js/jquery.js') ?>"></script> 
<script src="<?php echo base_url('assets/elite-html/js/bootstrap.js') ?>"></script> 
<?php  if (!empty($this->datamember)) {  ?>
	<script type="text/javascript">
		Moengage.identifyUser("<?php echo $this->datamember['id'] ?>");
	</script>
<?php }  ?>
<script>
	$('#CloseAds').click(function() {
		$('#BannerAds').hide();
	});
</script>