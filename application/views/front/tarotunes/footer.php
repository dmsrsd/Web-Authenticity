<script src="<?php echo base_url('assets/tarotunes-html/js/jquery.js') ?>"></script> 
<script src="<?php echo base_url('assets/tarotunes-html/js/bootstrap.js') ?>"></script> 
<!-- <script src="<?php echo base_url('assets/tarotunes-html/js/script.js') ?>"></script>  -->
<?php if (!empty($this->datamember)) {  ?>
	<script type="text/javascript">
		if (typeof Moengage !== 'undefined') {
			if (typeof Moengage.identifyUser === 'function') {
				Moengage.identifyUser("<?php echo $this->datamember['id'] ?>");
			} else if (typeof Moengage.add_unique_user_id === 'function') {
				Moengage.add_unique_user_id("<?php echo $this->datamember['id'] ?>");
			}
		}
	</script>

<?php } 