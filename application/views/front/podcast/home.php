<div class="new-bs"><h1 style="font-size:2px;margin:0px;padding:0px;">Authenticity Home</h1>
	<main class="main">
		<div class="page page-home">
			<section class="page-home__hero">
				<div id="myCarousel" class="carousel slide" data-ride="carousel">
					<ol class="carousel-indicators d-none">
						<?php
						$in = 0;
						if (isset($slide) && count($slide) > 0) {
							foreach ($slide as $row) {
								$ac = "";
								if ($in == 0) {
									$ac = "active";
								}
								echo "<li data-target='#myCarousel1' data-slide-to='$in' class='$ac'></li>";
								$in++;
							}
						}
						?>
					</ol>

					<div class="carousel-inner">
						<?php
						$in = 0;
						if (isset($slide) && count($slide) > 0) {
							foreach ($slide as $row) {
								$ac = "";
								if ($in == 0) {
									$ac = "active";
								}
								$url = "javascript:void(0);";
								$target = "";
								if ($row['url'] != "") {
									$url = $row['url'];
									$target = "target='_blank'";
								}
								echo "
									<div class='item $ac '  >
										<a href='$url' class='d-block' $target>
											<picture>
												<source srcset='" . base_url() . "uploads/podcast/$row[image_mobile]' media='(max-width: 767px)' />
												<source srcset='" . base_url() . "uploads/podcast/$row[image]' media='(min-width: 768px)' />
												<img src='" . base_url() . "uploads/podcast/$row[image]' alt='$row[judul]' class='img-full'>
											</picture>
										</a>
									</div>

								";
								$in++;
							}
						}
						?>
					</div>

					<a class="left carousel-control" href="#myCarousel" data-slide="prev">
						<span class="glyphicon glyphicon-chevron-left"></span>
						<span class="sr-only">Previous</span>
					</a>
					<a class="right carousel-control" href="#myCarousel" data-slide="next">
						<span class="glyphicon glyphicon-chevron-right"></span>
						<span class="sr-only">Next</span>
					</a>
				</div>
			</section>
			<section class="page-home__cta">
				<div class="container">
					<div class="row gx-5 justify-content-center">
						<div class="col-md-6">
							<div class="page-home__cta-item">
								<img src="<?php echo base_url() ?>assets/front/img/home/cta-1.png" alt="CTA" class="img-full">
								<p>Langsung dengerin, share ke socmed, and let's support Indonesian talent together!</p>
								<a href="<?php echo site_url('soundroom'); ?>" class="btn btn-outline-primary">Listen Now</a>
							</div>
						</div>
						<div class="col-md-6">
							<div class="page-home__cta-item">
								<img src="<?php echo base_url() ?>assets/front/img/home/cta-2.png" alt="CTA" class="img-full">
								<p>
									Time to grab Authenticity stuff!<br />
									Click and get it!
								</p>
								<a href="<?php echo site_url('lab'); ?>" class="btn btn-outline-primary">Shop Now</a>
							</div>
						</div>
					</div>
				</div>
				<div style="height: 150px; overflow:hidden"><img src="<?php echo base_url() ?>assets/front/img/home/bg-ripped.png" alt="bg" class="img-full"></div>
			</section>
			<!--<section class="page-home__banner pb-5">
				<div class="container">
					<a href="<?php echo base_url('campaign-merch') ?>" target="blank" class="d-block">
						<picture>
							<source srcset="<?php echo base_url() ?>assets/front/img/home/banner-m.png" media="(max-width: 767px)" />
							<source srcset="<?php echo base_url() ?>assets/front/img/home/banner.png" media="(min-width: 768px)" />
							<img src="<?php echo base_url() ?>assets/front/img/home/banner.png" alt="Hero" class="img-full">
						</picture>
					</a>
				</div>
			</section>-->
			<section class="page-home__sections">

				<div class="container">
					<div class="card card--section">
						<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
							<?php foreach ($web_section as $row) { ?>
								<?php if (count($row['campaign']) <= 0){ continue; } ?>
								<div class="panel">
									<div class="panel-heading" role="tab" id="section-<?php echo ($row['slug']); ?>-heading">
										<h4 class="panel-title">
											<a class="collapsed" role="button" data-toggle="collapse" href="#section-<?php echo ($row['slug']); ?>" aria-expanded="false" aria-controls="section-<?php echo ($row['slug']); ?>">
												<img src="<?php echo base_url('uploads/section/'.$row['mini_banner']); ?>" alt="<?php echo ($row['section_name']); ?>">
											</a>
										</h4>
									</div>
									<div id="section-<?php echo ($row['slug']); ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="section-<?php echo ($row['slug']); ?>-heading">
										<div class="panel-body">
											<div class="panel-body__title">
												<img src="<?php echo base_url('uploads/section/'.$row['landing_banner']); ?>" alt="<?php echo ($row['section_name']); ?>" class="d-none">
												<a href="https://www.youtube.com/@Authenticity_ID" target="blank" class="panel-body__title-desc" target="_blank">
													<p>Tonton di</p>
													<img src="<?php echo base_url() ?>assets/front/img/home/yt.png" alt="Youtube">
													<h4>Authenticity id</h4>
												</a>
												
												<?php 
													if($row['description']!=''){
														echo '<h5>'.$row['description'].'</h5>';
													}
												?>
											</div>
											<div class="row gx-4 row-<?php echo ($row['slug']); ?>">
												<?php foreach ($row['campaign'] as $vid) { ?>
													<div class="col-md-4 col-6">
														<a href="https://www.youtube.com/watch?v=<?php echo $vid['youtube']?>" class="card card--video" data-fancybox>
															<div class="card-body">
																<div class="card-img">
																	<img src="<?php echo base_url('uploads/districtcampaign/'.$vid['mini_banner']); ?>" alt="<?php echo $vid['campaign_name']?>">
																</div>
																<p><?php echo $vid['campaign_name']?></p>
															</div>
														</a>
													</div>
												<?php } ?>
											</div>

											<?php if ($row['campaign_more'] == 'yes' ){ ?>
											<div class="panel-cta" id="cta-<?php echo ($row['slug']); ?>">
												<button type="button" class="btn btn-primary btn-sm btn-section-more" id="cta-more-<?php echo ($row['slug']); ?>" data-section="<?php echo ($row['slug']); ?>" data-page="1">Load More</button>
											</div>
											<?php } ?>

										</div>
									</div>
								</div>

							<?php } ?>


						</div>
					</div>
				</div>
			</section>
		</div>
	</main>
</div>
