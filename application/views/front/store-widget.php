<div class="row gx-5">
	<?php foreach ($products as $key=>$prod) : ?>
		<div class="col-lg-4 col-md-6">
			<a href="<?php echo $prod['url'] ?>" target="blank" class="card card--store">
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