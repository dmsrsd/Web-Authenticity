<div class="new-bs">
	<main class="main">
		<div class="page page-store">
			<?php $this->load->view('front/store-hero'); ?>

			<section class="page-store__list" id="product-section">
				<div class="container">
					<div class="page-store__list-filter">
						<div class="row align-items-center justify-content-between">
							<div class="col-md-auto">
								<div class="page-store__list-filter__btn">
									<button type="button" data-toggle-filter="list">
										<img src="<?php echo base_url() ?>assets/front/img/store/list.svg" alt="Filter List">
									</button>
									<button type="button" data-toggle-filter="grid" class="active">
										<img src="<?php echo base_url() ?>assets/front/img/store/grid.svg" alt="Filter Grid">
									</button>
								</div>
							</div>
							<div class="col-md-auto">
								<form>
									<label>
										Urut Berdasarkan :
									</label>
									<select id="product-sorting" name="product_sorting">
										<option value="terbaru">Terbaru</option>
										<option value="terlama">Terlama</option>
										<option value="termurah">Termurah</option>
										<option value="termahal">Termahal</option>
									</select>
								</form>
							</div>
						</div>
					</div>
					<div class="page-store__list-body" id="product-list">
						<div class="row gx-5">
							<?php foreach ($products as $key=>$prod) : ?>
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
											<?php 
												if($prod['status']==1){
													echo '<h6 class="btn btn-primary">'.$prod['button'].'</h6>';
												}else{
													echo '<h6 class="btn btn-primary text-danger">Sold Out</h6>';
												}
											?>
											<!-- <h6 class="btn btn-primary"><?php echo $prod['button'] ?></h6> -->
										</div>
									</a>
								</div>
							<?php endforeach; ?>
						</div>

						<?php if( intval($products_page) > 1){ ?>
							<nav aria-label="Page navigation" class="pt-md-5 pt-3">
								<ul class="pagination justify-content-center">
									<?php 
									if( isset($_GET['page']) && $_GET['page']!='' ){
										$cur_page = intval($_GET['page']);
									}else{
										$cur_page = 1;
									}
									$prev_page = $cur_page - 1;
									$next_page = $cur_page + 1;

									if ($cur_page!=1): ?>
										<li>
											<a href="<?php echo $products_url.'?page='.$prev_page.'#product-section'; ?>" aria-label="Next">
												<i class='fa fa-chevron-left'></i>
											</a>
										</li>
									<?php endif ?>

									<?php 
									for($i=1; $i<=$products_page; $i++) {
										$aktip = '';
										if($cur_page==$i){ $aktip = 'active'; }

										echo '<li><a href="'.$products_url.'?page='.$i.'#product-section" class="'.$aktip.'">'.$i.'</a></li>';
									} 
									?>

									<?php if ($cur_page!=$products_page): ?>
										<li>
											<a href="<?php echo $products_url.'?page='.$next_page.'#product-section'; ?>" aria-label="Next">
												<i class='fa fa-chevron-right'></i>
											</a>
										</li>
									<?php endif ?>
								</ul>
							</nav>
						<?php } ?>
					</div>
				</div>
			</section>
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

		
		const productSorting = document.getElementById("product-sorting");
		productSorting.addEventListener("change", function(ev) {
			const sorting = productSorting.value;
			const dataform = new FormData();
			dataform.append('<?php echo $this->security->get_csrf_token_name(); ?>', '<?php echo $this->security->get_csrf_hash(); ?>');
			dataform.append('sorting', sorting);

			fetch('<?= base_url() ?>store/changesorting', {
					method: "POST",
					body: dataform,
			})
			.then((response) => response.json())
			.then((ret) => {
				const productList = document.getElementById("product-list");
				productList.innerHTML = ret.data;
			})
			.catch((error) => {
				console.error(error);
				alert('Failed..!!');
			});
		});
	});
</script>