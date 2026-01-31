<div class="new-bs">
	<main class="main">
		<div class="page page-store">
			<?php $this->load->view('front/store-hero'); ?>

			<section class="page-store__detail">
				<div class="container">
					<div class="page-store__detail-card">
						<div class="row align-items-center">
							<div class="col-md-4">
								<div class="card card--store">
									<div class="card-img">
										<img src="<?php echo base_url('uploads/store/'.$product['image']); ?>" alt="<?php echo $product['judul'] ?>">
									</div>
								</div>
							</div>
							<div class="col-md-8 ps-md-5 ps-0">
								<div class="page-store__detail-info">
									<h2><?php echo $product['judul']; ?></h2>
									<h5><?php echo $product['deskripsi']; ?></h5>
									<h3>Rp. <?php echo number_format($product['harga']); ?>,-</h3>
								</div>

								<?php if($product['button2']!=''): ?>
								<div class="page-store__detail-cta">
									<p>Available at:</p>
									<ul>
										<?php
											$arr_toko = json_decode($product['button2']);
											foreach($arr_toko as $key=>$tk){
												echo '<li>
													<a href="'.$tk->url.'" target="_blank" onclick="trackAndRedirect(event, this)" data-value="'.$tk->button.'">
														<img src="'.base_url('uploads/store/'.$tk->image).'" alt="'.$tk->button.'">
													</a>
												</li>';
											}
										?>
									</ul>
								</div>
								<?php endif; ?>
							</div>
						</div>
						<div class="row justify-content-center">
							<div class="col-md-11">
								<div class="page-store__detail-description">
									<h4 class="title-line">Product detail</h4>
									<?php echo ($product['detail_produk']); ?>
									<!-- <p>
										<strong>Tin Pack AUTHENTICITY X STEREO FLOW</strong> adalah merchandise eksklusif yang dibuat atas semangat kolaborasi antara AUTHENTICITY dan artis desain ternama yang bernama STEREO FLOW, untuk mendukung gaya lo yang berbeda dan keren.
									</p>
									<p>
										Ukuran : Panjang 16cm x lebar 10cm x tinggi 6 cm
									</p> -->
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>

			<?php if( count($product_related) >0 ): ?>
			<section class="page-store__list">
				<div class="container">
					<h3 class="title-line text-uppercase">Produk Terkait</h3>
					<div class="page-store__list-body">
						<div class="row gx-5">
							<?php foreach ($product_related as $key=>$prod) : ?>
								<div class="col-lg-4 col-md-6">
									<a href="<?php echo site_url('lab-detail/'.$prod['slug']) ?>" class="card card--store">
										<div class="card-img">
											<img src="<?php echo base_url('uploads/store/'.$prod['image']); ?>" alt="<?php echo $prod['judul'] ?>">
										</div>
										<div class="card-body">
											<h3><?php echo $prod['judul'] ?></h3>
											<?php
											if( intval($prod['harga']) > 0 ){
												echo '<h4>IDR '.number_format($prod['harga']).'</h4>';
											}
											?>
											<p><?php echo $prod['deskripsi'] ?></p>
											<h6 class="btn btn-primary"><?php echo $prod['button'] ?></h6>
										</div>
									</a>
								</div>
							<?php endforeach; ?>

								<!-- <div class="col-lg-4 col-md-6">
									<a class="card card--store">
										<div class="card-img">
											<img src="<?php echo base_url() ?>assets/front/img/store/product.png" alt="Lab">
										</div>
										<div class="card-body">
											<h3>authenticity & stereoflow longsleeve tshirt</h3>
											<h4>IDR 100.000</h4>
											<p>
												Tin Pack AUTHENTICITY X STEREO FLOW adalah merchandise eksklusif
												yang dibuat atas semangat kolaborasi antara AUTHENTICITY dan artis
												desain ternama yang bernama STEREO FLOW, untuk mendukung gaya lo
												yang berbeda dan keren.
											</p>
											<h6 class="btn btn-primary">Beli Sekarang</h6>
										</div>
									</a>
								</div> -->
						</div>
					</div>
				</div>
			</section>
			<?php endif ?>
		</div>
	</main>
</div>

<script>
	document.addEventListener("DOMContentLoaded", function() {
		const buttons = document.querySelectorAll("button[data-toggle-filter]");
		const content = document.querySelector(".page-store__list-body");

		buttons.forEach(button => {
			button.addEventListener("click", function() {
				const filter = button.getAttribute("data-toggle-filter");

				// Remove the "active" class from all buttons
				buttons.forEach(btn => btn.classList.remove("active"));

				// Add the "active" class to the clicked button
				button.classList.add("active");

				// Toggle the appropriate class on the content div
				content.classList.remove("grid", "list");
				content.classList.add(filter);
			});
		});
	});
</script>