<!DOCTYPE html>
<html>
    <?php $this->load->view("front/elite/head.php");?>
	<style>
		@media (max-width: 767px) {
			button.btn.btn-link.text-but {
				font-size: 20px !important;
				margin-top: 0px !important;
				padding: 0px !important;
			}
		}
	</style>
<body class="circle"> 
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
	<div class="container-full"> 
		<form action="<?php echo base_url('elite/mainProses') ?>" method="post" data-parsley-validate enctype="multipart/form-data">
		<input type="hidden" name="tnc" value="<?php echo $_GET['tnc']; ?>">
		<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
			<?php $i=1; foreach ($pertanyaan as $row) {  ?>
				<div id="step-<?php echo $i ?>" style="<?php if($i != 1){ echo 'display:none'; } ?>">
					<div class="container">
						<div class="row">
							<div class="col-md-12 box-head"></div>
							<div class="col-md-12 box-body" style="min-height: 300px">
								<h4 class="pertanyaan"><?php echo $row['soal']; ?></h4>
								<div class="row" style="margin-top: 2rem">
									<div class="col-md-1 col-xs-1 p-0"><input name="soal<?php echo $i ?>" value="<?php echo $row['nilai_jawaban_1']; ?>" type="radio" required></input></div>
									<div class="col-md-11 col-xs-11 p-0"><span class="text-quis"><?php echo $row['jawaban_1']; ?></span></div>
									<?php  /*
										if($row['nilai_jawaban_1']==1){
											echo "the flow";
										} else if($row['nilai_jawaban_1']==2){
											echo "the hidden edge";
										}else{
											echo "the slow burner";
										} */
									?>
								</div>
								<div class="row">
									<div class="col-md-1 col-xs-1 p-0"><input name="soal<?php echo $i ?>" value="<?php echo $row['nilai_jawaban_2']; ?>" type="radio" required></input></div>
									<div class="col-md-11 col-xs-11 p-0"><span class="text-quis"><?php echo $row['jawaban_2']; ?></span></div>
									<?php  /*
										if($row['nilai_jawaban_2']==1){
											echo "the flow";
										} else if($row['nilai_jawaban_2']==2){
											echo "the hidden edge";
										}else{
											echo "the slow burner";
										} */
									?>
								</div>
								<div class="row">
									<div class="col-md-1 col-xs-1 p-0"><input  name="soal<?php echo $i ?>" value="<?php echo $row['nilai_jawaban_3']; ?>" type="radio" required></input></div>
									<div class="col-md-11 col-xs-11 p-0"><span class="text-quis"><?php echo $row['jawaban_3']; ?></span></div>
									<?php /*
										if($row['nilai_jawaban_3']==1){
											echo "the flow";
										} else if($row['nilai_jawaban_3']==2){
											echo "the hidden edge";
										}else{
											echo "the slow burner";
										} */
									?>
								</div>
							</div>
							<div class="col-md-12 box-foot"></div>
						</div>
					</div>
					<div class="container">
						<div class="col-md-12 text-center">
							<div class="button-nav"> 
								<div class="row">
									<div class="col-md-6 col-xs-6 text-center"><h3 class="text-but"><?php echo $i ?> of 5</h3></div>
									<?php if($i==5){ ?>
										<div class="col-md-6 col-xs-6 text-center">
											<button type="submit" class="btn btn-link text-but"style="color: #273478;font-size: 2.8rem;font-weight: 500;line-height: 5rem;text-align: center;text-decoration: none;margin-top: 15px;text-transform: none;font-family: &quot;Goldman&quot;, sans-serif;font-style: normal;">Next >></button>
										</div>
									<?php }else{ ?>
									<div class="col-md-6 col-xs-6 text-center next-step" data-id="<?php echo $i ?>"><h3 class="text-but">Next >></h3></div>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php $i=$i+1; } ?>
		</form>
	</div> 
	<!-- content --> 
    <?php $this->load->view("front/elite/footer.php");?>
	<script>
		$('.next-step').on('click', function() {
			var stepId = $(this).data('id'); 
			var stepNumber = parseInt(stepId); 

			var data_aktif = 'data_' + stepNumber;
			var data_next = 'data_' + (stepNumber + 1);

			var radioName = 'soal' + stepNumber;
			var isChecked = $('input[name="' + radioName + '"]:checked').length > 0;

			if (!isChecked) {
				alert('Silakan pilih salah satu jawaban terlebih dahulu.');
				return false; // hentikan jika belum pilih
			} else {
				$('#step-' + stepNumber).hide();
				$('#step-' + (stepNumber + 1)).show();
				//alert(data_aktif);
				//kirim data mongage
				Moengage.track_event("Define your elite", {
					"email": "<?php echo $member['email'] ?>",
					"halaman": "q" + stepNumber
				});

			}
		});
	</script>
	<script>
	$('#CloseAds').click(function() {
		$('#BannerAds').hide();
	});
</script>
</body>
</html>