<script src="<?php echo base_url('assets/tarotunes-html/js/jquery.js') ?>"></script> 
<script src="<?php echo base_url('assets/tarotunes-html/js/bootstrap.js') ?>"></script> 
<!-- <script src="<?php echo base_url('assets/tarotunes-html/js/script.js') ?>"></script>  -->
<?php if (!empty($this->datamember)) {  ?>
	<script type="text/javascript">
		Moengage.identifyUser("<?php echo $this->datamember['id'] ?>");
	</script>

<?php } 