<style>
	div#loader {
    position: fixed;
    top: 0;
    left: 0;
    background-color: #0003;
    width: 100%;
    height: 100vh;
}
.loader {
	position: absolute;
	top: 50%;
	right: 50%;
	transform: translate(-50%, -50%);
	width: 48px;
	height: 48px;
	border-radius: 50%;
	display: inline-block;
	border: 3px solid;
	border-color: #FFF #FFF transparent transparent;
	box-sizing: border-box;
	animation: rotation 1s linear infinite;
}
.loader::after,
.loader::before {
  content: '';  
  box-sizing: border-box;
  position: absolute;
  left: 0;
  right: 0;
  top: 0;
  bottom: 0;
  margin: auto;
  border: 3px solid;
  border-color: transparent transparent #FF3D00 #FF3D00;
  width: 40px;
  height: 40px;
  border-radius: 50%;
  box-sizing: border-box;
  animation: rotationBack 0.5s linear infinite;
  transform-origin: center center;
}
.loader::before {
  width: 32px;
  height: 32px;
  border-color: #FFF #FFF transparent transparent;
  animation: rotation 1.5s linear infinite;
}
    
@keyframes rotation {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
} 
@keyframes rotationBack {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(-360deg);
  }
}
    
</style>
<div class="new-bs">
	<main class="main">
		<div class="page page-profile">
			<section class="py-5">
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-lg-8 col-md-10">
							<div class="card card--shadow">
								<form action="<?php echo base_url(); ?>unlock/prosesconfirm" id="myForm" method="post" data-parsley-validate enctype="multipart/form-data">
									<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
									<input type="hidden" name="type" value="purple" style="display: none">
									<div class="row">
										<div class="col-lg">
											<h3>Upload Resi Lo Untuk Klaim Hadiah</h3>
											<div class="form-group">
												<label>Nomor Invoice</label>
												<input type="text" class="form-control " required maxlength="100" placeholder="Nomor Invoice" name="pembelian">
											</div>
											<!-- <div class="form-group">
												<label>Nama Marketplace</label>
												<select name="pembelian" class="form-control">
													<option value="Shopee">Shopee</option>
													<option value="Tokopedia">Tokopedia</option>
												</select>
											</div> -->
											<div class="form-group">
												<label for="email">Screnshoot Invoice : </label>
												<input type="file" id="fileInput" class="form-control" required name="resi" accept=".jpg,.png" >
												<p id="fileSizeError" style="color:red; display:none;">File maksimal 1MB!</p>
											</div>
											<div class="row mt-5">
												<div class="col-md-6">
													<a href="<?php echo base_url('campaign-merch'); ?>" class="btn btn-outline-primary btn-sm d-block img-full">KEMBALI</a>
												</div>
												<div class="col-md-6">
													<button type="submit" id="submitButton" class="btn btn-primary btn-sm d-block img-full">KIRIM</button>
												</div>
											</div>
										</div>
									</div>
								</form>
								<img src="<?php echo base_url() ?>assets/front/img/profile/bg.png" alt="BG" class="img-full" />
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
	</main>
</div>
<div id="loader" style="display:none;">
<span class="loader"></span>
</div>
<script src="<?php echo base_url() ?>assets/front/js/jquery.js"></script>
<script>
$(document).ready(function() {
    $('#myForm').on('submit', function(event) {
        //event.preventDefault();

        var $submitButton = $('#submitButton');
		$('#loader').show();

        $submitButton.prop('disabled', true); 

    });
});
</script>
<script>
  document.getElementById("fileInput").addEventListener("change", function() {
    const file = this.files[0];
    const maxSize = 1 * 1024 * 1024; // 1MB in bytes
    
    if (file && file.size > maxSize) {
      document.getElementById("fileSizeError").style.display = "block";
      this.value = ""; // Clear the file input if size exceeds the limit
    } else {
      document.getElementById("fileSizeError").style.display = "none";
    }
  });
</script>