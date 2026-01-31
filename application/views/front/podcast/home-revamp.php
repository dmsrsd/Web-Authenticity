<div class="new-bs">
	<main class="main">
		<div class="page page-home">
			<section class="page-home__hero">
				<div id="myCarousel" class="carousel slide" data-ride="carousel">
					<ol class="carousel-indicators">
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
								<p>Get ready to experience an unforgettable night of music that will make you want to dance all night long!</p>
								<a href="#" class="btn btn-outline-primary">Join Now</a>
							</div>
						</div>
						<div class="col-md-6">
							<div class="page-home__cta-item">
								<img src="<?php echo base_url() ?>assets/front/img/home/cta-2.png" alt="CTA" class="img-full">
								<p>
									Time to grab Authenticity stuff!<br />
									Click and get it!
								</p>
								<a href="#" class="btn btn-outline-primary">Shop Now</a>
							</div>
						</div>
					</div>
				</div>
				<img src="<?php echo base_url() ?>assets/front/img/home/bg-ripped.png" alt="bg" class="img-full">
			</section>
			<section class="page-home__banner pb-5">
				<div class="container">
					<a href="https://www.youtube.com/channel/UCCRi6YZ63-6HT7L8nD3Lvhw/videos" target="blank" class="d-block">
						<picture>
							<source srcset="<?php echo base_url() ?>assets/front/img/home/banner-m.png" media="(max-width: 767px)" />
							<source srcset="<?php echo base_url() ?>assets/front/img/home/banner.png" media="(min-width: 768px)" />
							<img src="<?php echo base_url() ?>assets/front/img/home/banner.png" alt="Hero" class="img-full">
						</picture>
					</a>
				</div>
			</section>
			<section class="page-home__sections">
				<div class="container">
					<div class="card card--section">
						<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
							<?php foreach ($web_section as $row) { ?>

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
												<img src="<?php echo base_url('uploads/section/'.$row['landing_banner']); ?>" alt="<?php echo ($row['section_name']); ?>">
												<a href="#" class="panel-body__title-desc" target="_blank">
													<p>Tonton di</p>
													<img src="<?php echo base_url() ?>assets/front/img/home/yt.png" alt="Youtube">
													<h4>Authenticity id</h4>
												</a>
												<h5>Dengerin musik dari musisi kesukaan lo udah biasa. Biar makin sah jadi fansnya, lo perlu tau cerita dari produksi, berita, sampe gosip-gosipnya! Temuin semuanya di Authenticity Luar Clas, eksklusif buat lo!</h5>
											</div>
											<div class="row gx-4">
												<div class="col-md-4 col-6">
													<a href="https://www.youtube.com/watch?v=xwSqb7QCNdQ" class="card card--video" data-fancybox>
														<div class="card-body">
															<div class="card-img">
																<img src="<?php echo base_url() ?>assets/front/img/home/sections/playlist/1.png" alt="Youtube">
															</div>
															<p>Pergantian Nama Band Indonesia - LUAR CLAS EP 01</p>
														</div>
													</a>
												</div>
											</div>
											<div class="panel-cta">
												<button type="button" class="btn btn-primary btn-sm">Load More</button>
											</div>
										</div>
									</div>
								</div>

							<?php } ?>

							<div class="panel">
								<div class="panel-heading" role="tab" id="sectionBackstageHeading">
									<h4 class="panel-title">
										<a class="collapsed" role="button" data-toggle="collapse" href="#sectionBackstage" aria-expanded="false" aria-controls="sectionBackstage">
											<img src="<?php echo base_url() ?>assets/front/img/home/sections/1.png" alt="Backstage">
										</a>
									</h4>
								</div>
								<div id="sectionBackstage" class="panel-collapse collapse" role="tabpanel" aria-labelledby="sectionBackstageHeading">
									<div class="panel-body">
										<div class="panel-body__title">
											<img src="<?php echo base_url() ?>assets/front/img/home/sections/color/1.png" alt="Backstage">
											<a href="#" class="panel-body__title-desc" target="_blank">
												<p>Tonton di</p>
												<img src="<?php echo base_url() ?>assets/front/img/home/yt.png" alt="Youtube">
												<h4>Authenticity id</h4>
											</a>
											<h5>Dengerin musik dari musisi kesukaan lo udah biasa. Biar makin sah jadi fansnya, lo perlu tau cerita dari produksi, berita, sampe gosip-gosipnya! Temuin semuanya di Authenticity Luar Clas, eksklusif buat lo!</h5>
										</div>
										<div class="row gx-4">
											<div class="col-md-4 col-6">
												<a href="https://www.youtube.com/watch?v=xwSqb7QCNdQ" class="card card--video" data-fancybox>
													<div class="card-body">
														<div class="card-img">
															<img src="<?php echo base_url() ?>assets/front/img/home/sections/playlist/1.png" alt="Youtube">
														</div>
														<p>Pergantian Nama Band Indonesia - LUAR CLAS EP 01</p>
													</div>
												</a>
											</div>
											<div class="col-md-4 col-6">
												<a href="https://www.youtube.com/watch?v=-4ex_ePl2Ao" class="card card--video" data-fancybox>
													<div class="card-body">
														<div class="card-img">
															<img src="<?php echo base_url() ?>assets/front/img/home/sections/playlist/2.png" alt="Youtube">
														</div>
														<p>Sheila on 7 Band tanpa Haters - LUAR CLAS EP 021</p>
													</div>
												</a>
											</div>
											<div class="col-md-4 col-6">
												<a href="https://www.youtube.com/watch?v=xwSqb7QCNdQ" class="card card--video" data-fancybox>
													<div class="card-body">
														<div class="card-img">
															<img src="<?php echo base_url() ?>assets/front/img/home/sections/playlist/3.png" alt="Youtube">
														</div>
														<p>Fans Fanatik Garis Keras: Menguntungkan atau Merugikan Musisi? - LUAR CLAS EP 01</p>
													</div>
												</a>
											</div>
											<div class="col-md-4 col-6">
												<a href="https://www.youtube.com/watch?v=xwSqb7QCNdQ" class="card card--video" data-fancybox>
													<div class="card-body">
														<div class="card-img">
															<img src="<?php echo base_url() ?>assets/front/img/home/sections/playlist/4.png" alt="Youtube">
														</div>
														<p>Standar Kesuksesan Baru Untuk Musisi = Viral di Tiktok - LUAR CLAS EP 01</p>
													</div>
												</a>
											</div>
											<div class="col-md-4 col-6">
												<a href="https://www.youtube.com/watch?v=-4ex_ePl2Ao" class="card card--video" data-fancybox>
													<div class="card-body">
														<div class="card-img">
															<img src="<?php echo base_url() ?>assets/front/img/home/sections/playlist/5.png" alt="Youtube">
														</div>
														<p>Sheila on 7 Band tanpa Haters - LUAR CLAS EP 021</p>
													</div>
												</a>
											</div>
											<div class="col-md-4 col-6">
												<a href="https://www.youtube.com/watch?v=xwSqb7QCNdQ" class="card card--video" data-fancybox>
													<div class="card-body">
														<div class="card-img">
															<img src="<?php echo base_url() ?>assets/front/img/home/sections/playlist/6.png" alt="Youtube">
														</div>
														<p>Fans Fanatik Garis Keras: Menguntungkan atau Merugikan Musisi? - LUAR CLAS EP 01</p>
													</div>
												</a>
											</div>
										</div>
										<div class="panel-cta">
											<button type="button" class="btn btn-primary btn-sm">Load More</button>
										</div>
									</div>
								</div>
							</div>
							<div class="panel">
								<div class="panel-heading" role="tab" id="sectionLuarClasHeading">
									<h4 class="panel-title">
										<a class="collapsed" role="button" data-toggle="collapse" href="#sectionLuarClas" aria-expanded="false" aria-controls="sectionLuarClas">
											<img src="<?php echo base_url() ?>assets/front/img/home/sections/2.png" alt="Luar Clas">
										</a>
									</h4>
								</div>
								<div id="sectionLuarClas" class="panel-collapse collapse" role="tabpanel" aria-labelledby="sectionLuarClasHeading">
									<div class="panel-body">
										<div class="panel-body__title">
											<img src="<?php echo base_url() ?>assets/front/img/home/sections/color/2.png" alt="Backstage">
											<a href="#" class="panel-body__title-desc" target="_blank">
												<p>Tonton di</p>
												<img src="<?php echo base_url() ?>assets/front/img/home/yt.png" alt="Youtube">
												<h4>Authenticity id</h4>
											</a>
											<h5>Dengerin musik dari musisi kesukaan lo udah biasa. Biar makin sah jadi fansnya, lo perlu tau cerita dari produksi, berita, sampe gosip-gosipnya! Temuin semuanya di Authenticity Luar Clas, eksklusif buat lo!</h5>
										</div>
										<div class="row gx-4">
											<div class="col-md-4 col-6">
												<a href="https://www.youtube.com/watch?v=xwSqb7QCNdQ" class="card card--video" data-fancybox>
													<div class="card-body">
														<div class="card-img">
															<img src="<?php echo base_url() ?>assets/front/img/home/sections/playlist/1.png" alt="Youtube">
														</div>
														<p>Pergantian Nama Band Indonesia - LUAR CLAS EP 01</p>
													</div>
												</a>
											</div>
											<div class="col-md-4 col-6">
												<a href="https://www.youtube.com/watch?v=-4ex_ePl2Ao" class="card card--video" data-fancybox>
													<div class="card-body">
														<div class="card-img">
															<img src="<?php echo base_url() ?>assets/front/img/home/sections/playlist/2.png" alt="Youtube">
														</div>
														<p>Sheila on 7 Band tanpa Haters - LUAR CLAS EP 021</p>
													</div>
												</a>
											</div>
											<div class="col-md-4 col-6">
												<a href="https://www.youtube.com/watch?v=xwSqb7QCNdQ" class="card card--video" data-fancybox>
													<div class="card-body">
														<div class="card-img">
															<img src="<?php echo base_url() ?>assets/front/img/home/sections/playlist/3.png" alt="Youtube">
														</div>
														<p>Fans Fanatik Garis Keras: Menguntungkan atau Merugikan Musisi? - LUAR CLAS EP 01</p>
													</div>
												</a>
											</div>
											<div class="col-md-4 col-6">
												<a href="https://www.youtube.com/watch?v=xwSqb7QCNdQ" class="card card--video" data-fancybox>
													<div class="card-body">
														<div class="card-img">
															<img src="<?php echo base_url() ?>assets/front/img/home/sections/playlist/4.png" alt="Youtube">
														</div>
														<p>Standar Kesuksesan Baru Untuk Musisi = Viral di Tiktok - LUAR CLAS EP 01</p>
													</div>
												</a>
											</div>
											<div class="col-md-4 col-6">
												<a href="https://www.youtube.com/watch?v=-4ex_ePl2Ao" class="card card--video" data-fancybox>
													<div class="card-body">
														<div class="card-img">
															<img src="<?php echo base_url() ?>assets/front/img/home/sections/playlist/5.png" alt="Youtube">
														</div>
														<p>Sheila on 7 Band tanpa Haters - LUAR CLAS EP 021</p>
													</div>
												</a>
											</div>
											<div class="col-md-4 col-6">
												<a href="https://www.youtube.com/watch?v=xwSqb7QCNdQ" class="card card--video" data-fancybox>
													<div class="card-body">
														<div class="card-img">
															<img src="<?php echo base_url() ?>assets/front/img/home/sections/playlist/6.png" alt="Youtube">
														</div>
														<p>Fans Fanatik Garis Keras: Menguntungkan atau Merugikan Musisi? - LUAR CLAS EP 01</p>
													</div>
												</a>
											</div>
										</div>
										<div class="panel-cta">
											<button type="button" class="btn btn-primary btn-sm">Load More</button>
										</div>
									</div>
								</div>
							</div>
							<div class="panel">
								<div class="panel-heading" role="tab" id="sectionDistrikHeading">
									<h4 class="panel-title">
										<a class="collapsed" role="button" data-toggle="collapse" href="#sectionDistrik" aria-expanded="false" aria-controls="sectionDistrik">
											<img src="<?php echo base_url() ?>assets/front/img/home/sections/3.png" alt="Luar Clas">
										</a>
									</h4>
								</div>
								<div id="sectionDistrik" class="panel-collapse collapse" role="tabpanel" aria-labelledby="sectionDistrikHeading">
									<div class="panel-body">
										<div class="panel-body__title">
											<img src="<?php echo base_url() ?>assets/front/img/home/sections/color/3.png" alt="Backstage">
											<a href="#" class="panel-body__title-desc" target="_blank">
												<p>Tonton di</p>
												<img src="<?php echo base_url() ?>assets/front/img/home/yt.png" alt="Youtube">
												<h4>Authenticity id</h4>
											</a>
											<h5>Dengerin musik dari musisi kesukaan lo udah biasa. Biar makin sah jadi fansnya, lo perlu tau cerita dari produksi, berita, sampe gosip-gosipnya! Temuin semuanya di Authenticity Luar Clas, eksklusif buat lo!</h5>
										</div>
										<div class="row gx-4">
											<div class="col-md-4 col-6">
												<a href="https://www.youtube.com/watch?v=xwSqb7QCNdQ" class="card card--video" data-fancybox>
													<div class="card-body">
														<div class="card-img">
															<img src="<?php echo base_url() ?>assets/front/img/home/sections/playlist/1.png" alt="Youtube">
														</div>
														<p>Pergantian Nama Band Indonesia - LUAR CLAS EP 01</p>
													</div>
												</a>
											</div>
											<div class="col-md-4 col-6">
												<a href="https://www.youtube.com/watch?v=-4ex_ePl2Ao" class="card card--video" data-fancybox>
													<div class="card-body">
														<div class="card-img">
															<img src="<?php echo base_url() ?>assets/front/img/home/sections/playlist/2.png" alt="Youtube">
														</div>
														<p>Sheila on 7 Band tanpa Haters - LUAR CLAS EP 021</p>
													</div>
												</a>
											</div>
											<div class="col-md-4 col-6">
												<a href="https://www.youtube.com/watch?v=xwSqb7QCNdQ" class="card card--video" data-fancybox>
													<div class="card-body">
														<div class="card-img">
															<img src="<?php echo base_url() ?>assets/front/img/home/sections/playlist/3.png" alt="Youtube">
														</div>
														<p>Fans Fanatik Garis Keras: Menguntungkan atau Merugikan Musisi? - LUAR CLAS EP 01</p>
													</div>
												</a>
											</div>
											<div class="col-md-4 col-6">
												<a href="https://www.youtube.com/watch?v=xwSqb7QCNdQ" class="card card--video" data-fancybox>
													<div class="card-body">
														<div class="card-img">
															<img src="<?php echo base_url() ?>assets/front/img/home/sections/playlist/4.png" alt="Youtube">
														</div>
														<p>Standar Kesuksesan Baru Untuk Musisi = Viral di Tiktok - LUAR CLAS EP 01</p>
													</div>
												</a>
											</div>
											<div class="col-md-4 col-6">
												<a href="https://www.youtube.com/watch?v=-4ex_ePl2Ao" class="card card--video" data-fancybox>
													<div class="card-body">
														<div class="card-img">
															<img src="<?php echo base_url() ?>assets/front/img/home/sections/playlist/5.png" alt="Youtube">
														</div>
														<p>Sheila on 7 Band tanpa Haters - LUAR CLAS EP 021</p>
													</div>
												</a>
											</div>
											<div class="col-md-4 col-6">
												<a href="https://www.youtube.com/watch?v=xwSqb7QCNdQ" class="card card--video" data-fancybox>
													<div class="card-body">
														<div class="card-img">
															<img src="<?php echo base_url() ?>assets/front/img/home/sections/playlist/6.png" alt="Youtube">
														</div>
														<p>Fans Fanatik Garis Keras: Menguntungkan atau Merugikan Musisi? - LUAR CLAS EP 01</p>
													</div>
												</a>
											</div>
										</div>
										<div class="panel-cta">
											<button type="button" class="btn btn-primary btn-sm">Load More</button>
										</div>
									</div>
								</div>
							</div>
							<div class="panel">
								<div class="panel-heading" role="tab" id="sectionJournalHeading">
									<h4 class="panel-title">
										<a class="collapsed" role="button" data-toggle="collapse" href="#sectionJournal" aria-expanded="false" aria-controls="sectionJournal">
											<img src="<?php echo base_url() ?>assets/front/img/home/sections/4.png" alt="Luar Clas">
										</a>
									</h4>
								</div>
								<div id="sectionJournal" class="panel-collapse collapse" role="tabpanel" aria-labelledby="sectionJournalHeading">
									<div class="panel-body">
										<div class="panel-body__title">
											<img src="<?php echo base_url() ?>assets/front/img/home/sections/color/4.png" alt="Backstage">
											<a href="#" class="panel-body__title-desc" target="_blank">
												<p>Tonton di</p>
												<img src="<?php echo base_url() ?>assets/front/img/home/yt.png" alt="Youtube">
												<h4>Authenticity id</h4>
											</a>
											<h5>Dengerin musik dari musisi kesukaan lo udah biasa. Biar makin sah jadi fansnya, lo perlu tau cerita dari produksi, berita, sampe gosip-gosipnya! Temuin semuanya di Authenticity Luar Clas, eksklusif buat lo!</h5>
										</div>
										<div class="row gx-4">
											<div class="col-md-4 col-6">
												<a href="https://www.youtube.com/watch?v=xwSqb7QCNdQ" class="card card--video" data-fancybox>
													<div class="card-body">
														<div class="card-img">
															<img src="<?php echo base_url() ?>assets/front/img/home/sections/playlist/1.png" alt="Youtube">
														</div>
														<p>Pergantian Nama Band Indonesia - LUAR CLAS EP 01</p>
													</div>
												</a>
											</div>
											<div class="col-md-4 col-6">
												<a href="https://www.youtube.com/watch?v=-4ex_ePl2Ao" class="card card--video" data-fancybox>
													<div class="card-body">
														<div class="card-img">
															<img src="<?php echo base_url() ?>assets/front/img/home/sections/playlist/2.png" alt="Youtube">
														</div>
														<p>Sheila on 7 Band tanpa Haters - LUAR CLAS EP 021</p>
													</div>
												</a>
											</div>
											<div class="col-md-4 col-6">
												<a href="https://www.youtube.com/watch?v=xwSqb7QCNdQ" class="card card--video" data-fancybox>
													<div class="card-body">
														<div class="card-img">
															<img src="<?php echo base_url() ?>assets/front/img/home/sections/playlist/3.png" alt="Youtube">
														</div>
														<p>Fans Fanatik Garis Keras: Menguntungkan atau Merugikan Musisi? - LUAR CLAS EP 01</p>
													</div>
												</a>
											</div>
											<div class="col-md-4 col-6">
												<a href="https://www.youtube.com/watch?v=xwSqb7QCNdQ" class="card card--video" data-fancybox>
													<div class="card-body">
														<div class="card-img">
															<img src="<?php echo base_url() ?>assets/front/img/home/sections/playlist/4.png" alt="Youtube">
														</div>
														<p>Standar Kesuksesan Baru Untuk Musisi = Viral di Tiktok - LUAR CLAS EP 01</p>
													</div>
												</a>
											</div>
											<div class="col-md-4 col-6">
												<a href="https://www.youtube.com/watch?v=-4ex_ePl2Ao" class="card card--video" data-fancybox>
													<div class="card-body">
														<div class="card-img">
															<img src="<?php echo base_url() ?>assets/front/img/home/sections/playlist/5.png" alt="Youtube">
														</div>
														<p>Sheila on 7 Band tanpa Haters - LUAR CLAS EP 021</p>
													</div>
												</a>
											</div>
											<div class="col-md-4 col-6">
												<a href="https://www.youtube.com/watch?v=xwSqb7QCNdQ" class="card card--video" data-fancybox>
													<div class="card-body">
														<div class="card-img">
															<img src="<?php echo base_url() ?>assets/front/img/home/sections/playlist/6.png" alt="Youtube">
														</div>
														<p>Fans Fanatik Garis Keras: Menguntungkan atau Merugikan Musisi? - LUAR CLAS EP 01</p>
													</div>
												</a>
											</div>
										</div>
										<div class="panel-cta">
											<button type="button" class="btn btn-primary btn-sm">Load More</button>
										</div>
									</div>
								</div>
							</div>
							<div class="panel">
								<div class="panel-heading" role="tab" id="sectionInSessionHeading">
									<h4 class="panel-title">
										<a class="collapsed" role="button" data-toggle="collapse" href="#sectionInSession" aria-expanded="false" aria-controls="sectionInSession">
											<img src="<?php echo base_url() ?>assets/front/img/home/sections/5.png" alt="Luar Clas">
										</a>
									</h4>
								</div>
								<div id="sectionInSession" class="panel-collapse collapse" role="tabpanel" aria-labelledby="sectionInSessionHeading">
									<div class="panel-body">
										<div class="panel-body__title">
											<img src="<?php echo base_url() ?>assets/front/img/home/sections/color/5.png" alt="Backstage">
											<a href="#" class="panel-body__title-desc" target="_blank">
												<p>Tonton di</p>
												<img src="<?php echo base_url() ?>assets/front/img/home/yt.png" alt="Youtube">
												<h4>Authenticity id</h4>
											</a>
											<h5>Dengerin musik dari musisi kesukaan lo udah biasa. Biar makin sah jadi fansnya, lo perlu tau cerita dari produksi, berita, sampe gosip-gosipnya! Temuin semuanya di Authenticity Luar Clas, eksklusif buat lo!</h5>
										</div>
										<div class="row gx-4">
											<div class="col-md-4 col-6">
												<a href="https://www.youtube.com/watch?v=xwSqb7QCNdQ" class="card card--video" data-fancybox>
													<div class="card-body">
														<div class="card-img">
															<img src="<?php echo base_url() ?>assets/front/img/home/sections/playlist/1.png" alt="Youtube">
														</div>
														<p>Pergantian Nama Band Indonesia - LUAR CLAS EP 01</p>
													</div>
												</a>
											</div>
											<div class="col-md-4 col-6">
												<a href="https://www.youtube.com/watch?v=-4ex_ePl2Ao" class="card card--video" data-fancybox>
													<div class="card-body">
														<div class="card-img">
															<img src="<?php echo base_url() ?>assets/front/img/home/sections/playlist/2.png" alt="Youtube">
														</div>
														<p>Sheila on 7 Band tanpa Haters - LUAR CLAS EP 021</p>
													</div>
												</a>
											</div>
											<div class="col-md-4 col-6">
												<a href="https://www.youtube.com/watch?v=xwSqb7QCNdQ" class="card card--video" data-fancybox>
													<div class="card-body">
														<div class="card-img">
															<img src="<?php echo base_url() ?>assets/front/img/home/sections/playlist/3.png" alt="Youtube">
														</div>
														<p>Fans Fanatik Garis Keras: Menguntungkan atau Merugikan Musisi? - LUAR CLAS EP 01</p>
													</div>
												</a>
											</div>
											<div class="col-md-4 col-6">
												<a href="https://www.youtube.com/watch?v=xwSqb7QCNdQ" class="card card--video" data-fancybox>
													<div class="card-body">
														<div class="card-img">
															<img src="<?php echo base_url() ?>assets/front/img/home/sections/playlist/4.png" alt="Youtube">
														</div>
														<p>Standar Kesuksesan Baru Untuk Musisi = Viral di Tiktok - LUAR CLAS EP 01</p>
													</div>
												</a>
											</div>
											<div class="col-md-4 col-6">
												<a href="https://www.youtube.com/watch?v=-4ex_ePl2Ao" class="card card--video" data-fancybox>
													<div class="card-body">
														<div class="card-img">
															<img src="<?php echo base_url() ?>assets/front/img/home/sections/playlist/5.png" alt="Youtube">
														</div>
														<p>Sheila on 7 Band tanpa Haters - LUAR CLAS EP 021</p>
													</div>
												</a>
											</div>
											<div class="col-md-4 col-6">
												<a href="https://www.youtube.com/watch?v=xwSqb7QCNdQ" class="card card--video" data-fancybox>
													<div class="card-body">
														<div class="card-img">
															<img src="<?php echo base_url() ?>assets/front/img/home/sections/playlist/6.png" alt="Youtube">
														</div>
														<p>Fans Fanatik Garis Keras: Menguntungkan atau Merugikan Musisi? - LUAR CLAS EP 01</p>
													</div>
												</a>
											</div>
										</div>
										<div class="panel-cta">
											<button type="button" class="btn btn-primary btn-sm">Load More</button>
										</div>
									</div>
								</div>
							</div>
							<div class="panel">
								<div class="panel-heading" role="tab" id="sectionSoundroomHeading">
									<h4 class="panel-title">
										<a class="collapsed" role="button" data-toggle="collapse" href="#sectionSoundroom" aria-expanded="false" aria-controls="sectionSoundroom">
											<img src="<?php echo base_url() ?>assets/front/img/home/sections/6.png" alt="Luar Clas">
										</a>
									</h4>
								</div>
								<div id="sectionSoundroom" class="panel-collapse collapse" role="tabpanel" aria-labelledby="sectionSoundroomHeading">
									<div class="panel-body">
										<div class="panel-body__title">
											<img src="<?php echo base_url() ?>assets/front/img/home/sections/color/6.png" alt="Backstage">
											<a href="#" class="panel-body__title-desc" target="_blank">
												<p>Tonton di</p>
												<img src="<?php echo base_url() ?>assets/front/img/home/yt.png" alt="Youtube">
												<h4>Authenticity id</h4>
											</a>
											<h5>Dengerin musik dari musisi kesukaan lo udah biasa. Biar makin sah jadi fansnya, lo perlu tau cerita dari produksi, berita, sampe gosip-gosipnya! Temuin semuanya di Authenticity Luar Clas, eksklusif buat lo!</h5>
										</div>
										<div class="row gx-4">
											<div class="col-md-4 col-6">
												<a href="https://www.youtube.com/watch?v=xwSqb7QCNdQ" class="card card--video" data-fancybox>
													<div class="card-body">
														<div class="card-img">
															<img src="<?php echo base_url() ?>assets/front/img/home/sections/playlist/1.png" alt="Youtube">
														</div>
														<p>Pergantian Nama Band Indonesia - LUAR CLAS EP 01</p>
													</div>
												</a>
											</div>
											<div class="col-md-4 col-6">
												<a href="https://www.youtube.com/watch?v=-4ex_ePl2Ao" class="card card--video" data-fancybox>
													<div class="card-body">
														<div class="card-img">
															<img src="<?php echo base_url() ?>assets/front/img/home/sections/playlist/2.png" alt="Youtube">
														</div>
														<p>Sheila on 7 Band tanpa Haters - LUAR CLAS EP 021</p>
													</div>
												</a>
											</div>
											<div class="col-md-4 col-6">
												<a href="https://www.youtube.com/watch?v=xwSqb7QCNdQ" class="card card--video" data-fancybox>
													<div class="card-body">
														<div class="card-img">
															<img src="<?php echo base_url() ?>assets/front/img/home/sections/playlist/3.png" alt="Youtube">
														</div>
														<p>Fans Fanatik Garis Keras: Menguntungkan atau Merugikan Musisi? - LUAR CLAS EP 01</p>
													</div>
												</a>
											</div>
											<div class="col-md-4 col-6">
												<a href="https://www.youtube.com/watch?v=xwSqb7QCNdQ" class="card card--video" data-fancybox>
													<div class="card-body">
														<div class="card-img">
															<img src="<?php echo base_url() ?>assets/front/img/home/sections/playlist/4.png" alt="Youtube">
														</div>
														<p>Standar Kesuksesan Baru Untuk Musisi = Viral di Tiktok - LUAR CLAS EP 01</p>
													</div>
												</a>
											</div>
											<div class="col-md-4 col-6">
												<a href="https://www.youtube.com/watch?v=-4ex_ePl2Ao" class="card card--video" data-fancybox>
													<div class="card-body">
														<div class="card-img">
															<img src="<?php echo base_url() ?>assets/front/img/home/sections/playlist/5.png" alt="Youtube">
														</div>
														<p>Sheila on 7 Band tanpa Haters - LUAR CLAS EP 021</p>
													</div>
												</a>
											</div>
											<div class="col-md-4 col-6">
												<a href="https://www.youtube.com/watch?v=xwSqb7QCNdQ" class="card card--video" data-fancybox>
													<div class="card-body">
														<div class="card-img">
															<img src="<?php echo base_url() ?>assets/front/img/home/sections/playlist/6.png" alt="Youtube">
														</div>
														<p>Fans Fanatik Garis Keras: Menguntungkan atau Merugikan Musisi? - LUAR CLAS EP 01</p>
													</div>
												</a>
											</div>
										</div>
										<div class="panel-cta">
											<button type="button" class="btn btn-primary btn-sm">Load More</button>
										</div>
									</div>
								</div>
							</div>
							<div class="panel">
								<div class="panel-heading" role="tab" id="sectionOotdHeading">
									<h4 class="panel-title">
										<a class="collapsed" role="button" data-toggle="collapse" href="#sectionOotd" aria-expanded="false" aria-controls="sectionOotd">
											<img src="<?php echo base_url() ?>assets/front/img/home/sections/7.png" alt="Luar Clas">
										</a>
									</h4>
								</div>
								<div id="sectionOotd" class="panel-collapse collapse" role="tabpanel" aria-labelledby="sectionOotdHeading">
									<div class="panel-body">
										<div class="panel-body__title">
											<img src="<?php echo base_url() ?>assets/front/img/home/sections/color/7.png" alt="Backstage">
											<a href="#" class="panel-body__title-desc" target="_blank">
												<p>Tonton di</p>
												<img src="<?php echo base_url() ?>assets/front/img/home/yt.png" alt="Youtube">
												<h4>Authenticity id</h4>
											</a>
											<h5>Dengerin musik dari musisi kesukaan lo udah biasa. Biar makin sah jadi fansnya, lo perlu tau cerita dari produksi, berita, sampe gosip-gosipnya! Temuin semuanya di Authenticity Luar Clas, eksklusif buat lo!</h5>
										</div>
										<div class="row gx-4">
											<div class="col-md-4 col-6">
												<a href="https://www.youtube.com/watch?v=xwSqb7QCNdQ" class="card card--video" data-fancybox>
													<div class="card-body">
														<div class="card-img">
															<img src="<?php echo base_url() ?>assets/front/img/home/sections/playlist/1.png" alt="Youtube">
														</div>
														<p>Pergantian Nama Band Indonesia - LUAR CLAS EP 01</p>
													</div>
												</a>
											</div>
											<div class="col-md-4 col-6">
												<a href="https://www.youtube.com/watch?v=-4ex_ePl2Ao" class="card card--video" data-fancybox>
													<div class="card-body">
														<div class="card-img">
															<img src="<?php echo base_url() ?>assets/front/img/home/sections/playlist/2.png" alt="Youtube">
														</div>
														<p>Sheila on 7 Band tanpa Haters - LUAR CLAS EP 021</p>
													</div>
												</a>
											</div>
											<div class="col-md-4 col-6">
												<a href="https://www.youtube.com/watch?v=xwSqb7QCNdQ" class="card card--video" data-fancybox>
													<div class="card-body">
														<div class="card-img">
															<img src="<?php echo base_url() ?>assets/front/img/home/sections/playlist/3.png" alt="Youtube">
														</div>
														<p>Fans Fanatik Garis Keras: Menguntungkan atau Merugikan Musisi? - LUAR CLAS EP 01</p>
													</div>
												</a>
											</div>
											<div class="col-md-4 col-6">
												<a href="https://www.youtube.com/watch?v=xwSqb7QCNdQ" class="card card--video" data-fancybox>
													<div class="card-body">
														<div class="card-img">
															<img src="<?php echo base_url() ?>assets/front/img/home/sections/playlist/4.png" alt="Youtube">
														</div>
														<p>Standar Kesuksesan Baru Untuk Musisi = Viral di Tiktok - LUAR CLAS EP 01</p>
													</div>
												</a>
											</div>
											<div class="col-md-4 col-6">
												<a href="https://www.youtube.com/watch?v=-4ex_ePl2Ao" class="card card--video" data-fancybox>
													<div class="card-body">
														<div class="card-img">
															<img src="<?php echo base_url() ?>assets/front/img/home/sections/playlist/5.png" alt="Youtube">
														</div>
														<p>Sheila on 7 Band tanpa Haters - LUAR CLAS EP 021</p>
													</div>
												</a>
											</div>
											<div class="col-md-4 col-6">
												<a href="https://www.youtube.com/watch?v=xwSqb7QCNdQ" class="card card--video" data-fancybox>
													<div class="card-body">
														<div class="card-img">
															<img src="<?php echo base_url() ?>assets/front/img/home/sections/playlist/6.png" alt="Youtube">
														</div>
														<p>Fans Fanatik Garis Keras: Menguntungkan atau Merugikan Musisi? - LUAR CLAS EP 01</p>
													</div>
												</a>
											</div>
										</div>
										<div class="panel-cta">
											<button type="button" class="btn btn-primary btn-sm">Load More</button>
										</div>
									</div>
								</div>
							</div>
							<div class="panel">
								<div class="panel-heading" role="tab" id="sectionOotdHeading">
									<h4 class="panel-title">
										<a class="collapsed" role="button" data-toggle="collapse" href="#sectionOotd" aria-expanded="false" aria-controls="sectionOotd">
											<img src="<?php echo base_url() ?>assets/front/img/home/sections/7.png" alt="Luar Clas">
										</a>
									</h4>
								</div>
								<div id="sectionOotd" class="panel-collapse collapse" role="tabpanel" aria-labelledby="sectionOotdHeading">
									<div class="panel-body">
										<div class="panel-body__title">
											<img src="<?php echo base_url() ?>assets/front/img/home/sections/color/7.png" alt="Backstage">
											<a href="#" class="panel-body__title-desc" target="_blank">
												<p>Tonton di</p>
												<img src="<?php echo base_url() ?>assets/front/img/home/yt.png" alt="Youtube">
												<h4>Authenticity id</h4>
											</a>
											<h5>Dengerin musik dari musisi kesukaan lo udah biasa. Biar makin sah jadi fansnya, lo perlu tau cerita dari produksi, berita, sampe gosip-gosipnya! Temuin semuanya di Authenticity Luar Clas, eksklusif buat lo!</h5>
										</div>
										<div class="row gx-4">
											<div class="col-md-4 col-6">
												<a href="https://www.youtube.com/watch?v=xwSqb7QCNdQ" class="card card--video" data-fancybox>
													<div class="card-body">
														<div class="card-img">
															<img src="<?php echo base_url() ?>assets/front/img/home/sections/playlist/1.png" alt="Youtube">
														</div>
														<p>Pergantian Nama Band Indonesia - LUAR CLAS EP 01</p>
													</div>
												</a>
											</div>
											<div class="col-md-4 col-6">
												<a href="https://www.youtube.com/watch?v=-4ex_ePl2Ao" class="card card--video" data-fancybox>
													<div class="card-body">
														<div class="card-img">
															<img src="<?php echo base_url() ?>assets/front/img/home/sections/playlist/2.png" alt="Youtube">
														</div>
														<p>Sheila on 7 Band tanpa Haters - LUAR CLAS EP 021</p>
													</div>
												</a>
											</div>
											<div class="col-md-4 col-6">
												<a href="https://www.youtube.com/watch?v=xwSqb7QCNdQ" class="card card--video" data-fancybox>
													<div class="card-body">
														<div class="card-img">
															<img src="<?php echo base_url() ?>assets/front/img/home/sections/playlist/3.png" alt="Youtube">
														</div>
														<p>Fans Fanatik Garis Keras: Menguntungkan atau Merugikan Musisi? - LUAR CLAS EP 01</p>
													</div>
												</a>
											</div>
											<div class="col-md-4 col-6">
												<a href="https://www.youtube.com/watch?v=xwSqb7QCNdQ" class="card card--video" data-fancybox>
													<div class="card-body">
														<div class="card-img">
															<img src="<?php echo base_url() ?>assets/front/img/home/sections/playlist/4.png" alt="Youtube">
														</div>
														<p>Standar Kesuksesan Baru Untuk Musisi = Viral di Tiktok - LUAR CLAS EP 01</p>
													</div>
												</a>
											</div>
											<div class="col-md-4 col-6">
												<a href="https://www.youtube.com/watch?v=-4ex_ePl2Ao" class="card card--video" data-fancybox>
													<div class="card-body">
														<div class="card-img">
															<img src="<?php echo base_url() ?>assets/front/img/home/sections/playlist/5.png" alt="Youtube">
														</div>
														<p>Sheila on 7 Band tanpa Haters - LUAR CLAS EP 021</p>
													</div>
												</a>
											</div>
											<div class="col-md-4 col-6">
												<a href="https://www.youtube.com/watch?v=xwSqb7QCNdQ" class="card card--video" data-fancybox>
													<div class="card-body">
														<div class="card-img">
															<img src="<?php echo base_url() ?>assets/front/img/home/sections/playlist/6.png" alt="Youtube">
														</div>
														<p>Fans Fanatik Garis Keras: Menguntungkan atau Merugikan Musisi? - LUAR CLAS EP 01</p>
													</div>
												</a>
											</div>
										</div>
										<div class="panel-cta">
											<button type="button" class="btn btn-primary btn-sm">Load More</button>
										</div>
									</div>
								</div>
							</div>
							<div class="panel">
								<div class="panel-heading" role="tab" id="sectionSpaceHeading">
									<h4 class="panel-title">
										<a class="collapsed" role="button" data-toggle="collapse" href="#sectionSpace" aria-expanded="false" aria-controls="sectionSpace">
											<img src="<?php echo base_url() ?>assets/front/img/home/sections/8.png" alt="Luar Clas">
										</a>
									</h4>
								</div>
								<div id="sectionSpace" class="panel-collapse collapse" role="tabpanel" aria-labelledby="sectionSpaceHeading">
									<div class="panel-body">
										<div class="panel-body__title">
											<img src="<?php echo base_url() ?>assets/front/img/home/sections/color/8.png" alt="Backstage">
											<a href="#" class="panel-body__title-desc" target="_blank">
												<p>Tonton di</p>
												<img src="<?php echo base_url() ?>assets/front/img/home/yt.png" alt="Youtube">
												<h4>Authenticity id</h4>
											</a>
											<h5>Dengerin musik dari musisi kesukaan lo udah biasa. Biar makin sah jadi fansnya, lo perlu tau cerita dari produksi, berita, sampe gosip-gosipnya! Temuin semuanya di Authenticity Luar Clas, eksklusif buat lo!</h5>
										</div>
										<div class="row gx-4">
											<div class="col-md-4 col-6">
												<a href="https://www.youtube.com/watch?v=xwSqb7QCNdQ" class="card card--video" data-fancybox>
													<div class="card-body">
														<div class="card-img">
															<img src="<?php echo base_url() ?>assets/front/img/home/sections/playlist/1.png" alt="Youtube">
														</div>
														<p>Pergantian Nama Band Indonesia - LUAR CLAS EP 01</p>
													</div>
												</a>
											</div>
											<div class="col-md-4 col-6">
												<a href="https://www.youtube.com/watch?v=-4ex_ePl2Ao" class="card card--video" data-fancybox>
													<div class="card-body">
														<div class="card-img">
															<img src="<?php echo base_url() ?>assets/front/img/home/sections/playlist/2.png" alt="Youtube">
														</div>
														<p>Sheila on 7 Band tanpa Haters - LUAR CLAS EP 021</p>
													</div>
												</a>
											</div>
											<div class="col-md-4 col-6">
												<a href="https://www.youtube.com/watch?v=xwSqb7QCNdQ" class="card card--video" data-fancybox>
													<div class="card-body">
														<div class="card-img">
															<img src="<?php echo base_url() ?>assets/front/img/home/sections/playlist/3.png" alt="Youtube">
														</div>
														<p>Fans Fanatik Garis Keras: Menguntungkan atau Merugikan Musisi? - LUAR CLAS EP 01</p>
													</div>
												</a>
											</div>
											<div class="col-md-4 col-6">
												<a href="https://www.youtube.com/watch?v=xwSqb7QCNdQ" class="card card--video" data-fancybox>
													<div class="card-body">
														<div class="card-img">
															<img src="<?php echo base_url() ?>assets/front/img/home/sections/playlist/4.png" alt="Youtube">
														</div>
														<p>Standar Kesuksesan Baru Untuk Musisi = Viral di Tiktok - LUAR CLAS EP 01</p>
													</div>
												</a>
											</div>
											<div class="col-md-4 col-6">
												<a href="https://www.youtube.com/watch?v=-4ex_ePl2Ao" class="card card--video" data-fancybox>
													<div class="card-body">
														<div class="card-img">
															<img src="<?php echo base_url() ?>assets/front/img/home/sections/playlist/5.png" alt="Youtube">
														</div>
														<p>Sheila on 7 Band tanpa Haters - LUAR CLAS EP 021</p>
													</div>
												</a>
											</div>
											<div class="col-md-4 col-6">
												<a href="https://www.youtube.com/watch?v=xwSqb7QCNdQ" class="card card--video" data-fancybox>
													<div class="card-body">
														<div class="card-img">
															<img src="<?php echo base_url() ?>assets/front/img/home/sections/playlist/6.png" alt="Youtube">
														</div>
														<p>Fans Fanatik Garis Keras: Menguntungkan atau Merugikan Musisi? - LUAR CLAS EP 01</p>
													</div>
												</a>
											</div>
										</div>
										<div class="panel-cta">
											<button type="button" class="btn btn-primary btn-sm">Load More</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
		<!-- <script src="<?php echo base_url() ?>assets/front/fullpage/fullpage.js" type="text/javascript"></script> -->
		<!-- <script>
			$(document).on('ready', function() {
				$('.carousel').carousel();
				$('.closewatch').click(function() {
					$('#youtube_player')[0].contentWindow.postMessage('{"event":"command","func":"' + 'stopVideo' + '","args":""}', '*');
					$('#watchmodal').modal('hide');
				});
				// $('.watchnow').click(function() {
				// 	var y = $(this).attr('y');
				// 	$('#watchmodal').modal({
				// 		backdrop: 'static',
				// 		keyboard: false
				// 	});
				// 	$('#watchmodal .modal-body iframe').attr('src', 'https://www.youtube.com/embed/' + y + '?rel=0&amp;controls=1&amp;showinfo=0&amp;html5=1&amp;autoplay=1&amp;enablejsapi=1&amp;version=3&amp;playerapiid=ytplayer');

				// });
				$('.closemsg').click(function(){
					$('#loginmodal').modal('hide');
				})

				$('.watchnow').click(function() {
					var y = $(this).attr('y');
					var show_case = $(this).attr('data-access-setting');
					var member_login = "<?= !empty($this->datamember) ? $this->datamember['fullname'] : '' ?>";
					if(show_case == 'after_login' && member_login == ''){
						$('#loginmodal').modal({
							backdrop: 'static',
							keyboard: false
						});
					}else{
						$('#watchmodal').modal({
							backdrop: 'static',
							keyboard: false
						});
						$('#watchmodal .modal-body iframe').attr('src', 'https://www.youtube.com/embed/' + y + '?rel=0&amp;controls=1&amp;showinfo=0&amp;html5=1&amp;autoplay=1&amp;enablejsapi=1&amp;version=3&amp;playerapiid=ytplayer');
					}


				});

			});

			//$(function(){
			function scrollto(from, to) {
				$('html, body').animate({
					scrollTop: $("#" + to).offset().top
				}, 300);
			}
			//});
		</script> -->
		<script type="text/javascript">
			// var myFullpage = new fullpage('#fullpage', {
			// 	anchors: ['1', '2', '3', '4'],
			// 	///sectionsColor: ['#C63D0F', '#1BBC9B', '#7E8F7C'],
			// 	responsiveHeight: 300,
			// 	responsiveWidth: 800,
			// 	afterResponsive: function(isResponsive) {

			// 	}
			// });
		</script>
	</main>
</div>
