<link href="<?php echo base_url() ?>assets/front/css/podcast.css?rand=<?= rand(); ?>" rel="stylesheet" />
<link href="<?php echo base_url() ?>assets/front/css/designcompetition.css" rel="stylesheet" />
<link href="<?php echo base_url() ?>assets/front/fullpage/fullpage.css?rand=<?= rand(); ?>" rel="stylesheet" />
<style>



</style>
<div class="new-bs"><h1 style="font-size:2px;margin:0px;padding:0px;">Podcast Naik Kelas</h1>
	<main class="main">
		<div class="page page-pnc">
			<section class="page-pnc__hero pb-5 mb-5">
				<?php if (isset($slide) && count($slide) > 0) { ?>
					<?php foreach ($slide as $idx => $val) { ?>
						<picture>
							<source srcset='<?= base_url('uploads/podcast/' . $val['image']); ?>' media="(max-width: 767px)" />
							<source srcset='<?= base_url('uploads/podcast/' . $val['image']); ?>' media="(min-width: 768px)" />
							<img src='<?= base_url('uploads/podcast/' . $val['image']); ?>' alt="Hero" class="img-full">
						</picture>
					<?php } ?>
				<?php } ?>
			</section>
			<section class="page-pnc__lists">
				<div class='container'>
					<?php

					if (isset($podcast) && count($podcast) > 0) {
						foreach ($podcast as $key => $value) {
							if ($key != '') {

					?>
								<div class="section-title">
									<h3><?= str_replace(' ', '_', $key) ?></h3>
								</div>


								<div class='row pb-5'>
									<?php
									foreach ($value as $row) {
									?>
										<div class='col-lg-3 col-md-6 thumbpod'>
											<a href='javascript:void(0);'>
												<img class='imghome hov' src="<?= base_url() . 'uploads/podcast/' . $row['image'] ?>" alt="<?= $row['judul'] ?>" style='width:100%;'>
											</a><br>
											<a class='watchnow' y="<?= $row['youtube'] ?>" j="<?= str_replace(["'", '"', "`"], "", $row['judul']); ?>" href='javascript:void(0);'><i class='fa fa-play'></i> Watch Now</a>
										</div>
									<?php
									}
									?>


								</div>


					<?php
							}
						}
					}
					?>
				</div>
			</section>
		</div>
		<div class="modal fade" id="watchmodal" tabindex="-1" role="dialog" aria-labelledby="watchmodal" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-body">
						<div class="embed-responsive embed-responsive-16by9">
							<iframe class="embed-responsive-item" src="" id="youtube_player" frameborder="0" allowfullscreen="true" allowscriptaccess="always"></iframe>

						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger closewatch">Close</button>
					</div>
				</div>
			</div>
		</div>
	</main>
</div>

<script src="<?php echo base_url() ?>assets/front/js/jquery.js" type="text/javascript"></script>
<script>
	$(document).on('ready', function() {
		$('.carousel').carousel();
		$('.closewatch').click(function() {
			$('#youtube_player')[0].contentWindow.postMessage('{"event":"command","func":"' + 'stopVideo' + '","args":""}', '*');
			$('#watchmodal').modal('hide');
		});
		$('.watchnow').click(function() {
			var y = $(this).attr('y');
			$('#watchmodal').modal({
				backdrop: 'static',
				keyboard: false
			});
			$('#watchmodal .modal-body iframe').attr('src', 'https://www.youtube.com/embed/' + y + '?rel=0&amp;controls=1&amp;showinfo=0&amp;html5=1&amp;autoplay=1&amp;enablejsapi=1&amp;version=3&amp;playerapiid=ytplayer');

		});
		$('.twatchnow').click(function() {
			var y = $(this).attr('y');
			$('#watchmodal').modal({
				backdrop: 'static',
				keyboard: false
			});
			$('#watchmodal .modal-body iframe').attr('src', 'https://www.youtube.com/embed/' + y + '?rel=0&amp;controls=1&amp;showinfo=0&amp;html5=1&amp;autoplay=1&amp;enablejsapi=1&amp;version=3&amp;playerapiid=ytplayer');

		});

	});

	//$(function(){
	function scrollto(from, to) {
		$('html, body').animate({
			scrollTop: $("#" + to).offset().top
		}, 300);
	}
	//});
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