<link href="<?php echo base_url() ?>assets/front/css/podcast.css?rand=<?= rand(); ?>" rel="stylesheet" />
<link href="<?php echo base_url() ?>assets/front/css/designcompetition.css" rel="stylesheet" />
<link href="<?php echo base_url() ?>assets/front/fullpage/fullpage.css?rand=<?= rand(); ?>" rel="stylesheet" />

<style>
	.navbar {
		margin-bottom: 0px;
	}
</style>
<div id='fullpage'>
	<div class=' page-podcast section fp-auto-height' id="section1">
		<div class='container-fluid'>
			<div class='row'>
				<div class='col-sm-12'>
					<div class="row no-gutter">
						<div class="col-sm-12">
							<div id="myCarousel" class="carousel slide" data-ride="carousel">
								<!--<ol class="carousel-indicators">
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
								</ol>-->

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
											if ($row['url'] != "") {
												$url = $row['url'];
											}
											echo "
												<div class='item $ac '  >
													<a href='$url'><img src='" . base_url() . "uploads/store/$row[image]' alt='$row[judul]' style='width:100%;' class='img-desktop'>
													<img src='" . base_url() . "uploads/store/$row[image_mobile]' alt='$row[judul]' style='width:100%;' class='img-mobile'>
													</a>
												</div>

											";
											$in++;
										}
									}
									?>
								</div>

								<!--<a class="left carousel-control" href="#myCarousel" data-slide="prev">
									<span class="glyphicon glyphicon-chevron-left"></span>
									<span class="sr-only">Previous</span>
								</a>
								<a class="right carousel-control" href="#myCarousel" data-slide="next">
									<span class="glyphicon glyphicon-chevron-right"></span>
									<span class="sr-only">Next</span>
								</a>-->
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class='min-height section  fp-auto-height' id="section2">
		<div class='container'>
			<br><br>
			<br><br>
			<div class='row'>
				<?php
				$startsec = 2;
				$page = 1;
				$in = 0;
				if (isset($store) && count($store) > 0) {
					foreach ($store as $row) {
						$ac = "";
						if ($in == 0) {
							$ac = "active";
						}
						$url = base_url() . "authentic-store/$row[slug]";
						if ($row['url'] != "") {
							$url = $row['url'];
						}
						$ec = "
							<div class='col-sm-$row[thumbnail_size]' style='margin-bottom:15px;'>
								<a href='$url'>
									<img src='" . base_url() . "uploads/store/$row[thumbnail]' alt='$row[judul]' style='width:100%;'>
								</a>
							</div>

						";
						if ($page % 3 == 0) {
							$startsec++;
							echo "</div></div></div>";
							echo "
							<div class='min-height section' id='section" . $startsec . "'>
								<div class='container'>
									<br><br>
									<div class='row'>
							";
							echo $ec;
						} else {
							echo $ec;
						}
						$page++;
						$in++;
					}
				}
				?>

			</div>
		</div>
	</div>

	<div class=' section  fp-auto-height' id="section<?= $startsec + 1; ?>">
		<?php $this->load->view('front/podcast/footerfp'); ?>
		<script src="<?php echo base_url() ?>assets/front/fullpage/fullpage.js" type="text/javascript"></script>
		<script>
			$(document).on('ready', function() {});
		</script>
		<script type="text/javascript">
			// var myFullpage = new fullpage('#fullpage', {
			//     anchors: ['1', '2', '3','4','5','6'],
			//     ///sectionsColor: ['#C63D0F', '#1BBC9B', '#7E8F7C'],
			//     responsiveHeight: 300,
			// 	responsiveWidth: 800,
			//     afterResponsive: function(isResponsive){

			//     }
			// });
		</script>