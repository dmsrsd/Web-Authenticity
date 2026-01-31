<link href="<?php echo base_url() ?>assets/front/css/podcast.css?rand=<?= rand(); ?>" rel="stylesheet" />
<link href="<?php echo base_url() ?>assets/front/css/designcompetition.css" rel="stylesheet" />
<link href="<?php echo base_url() ?>assets/front/fullpage/fullpage.css?rand=<?= rand(); ?>" rel="stylesheet" />
<style>



</style>
<div id='fullpage'>
	<div class=' page-podcast section fp-auto-height' id="section1">
		<div class="container-fluid">
			<div class="row no-gutter">
				<div class="col-sm-12">
					<img class='img-responsive' src="<?= base_url().'uploads/section/'.$campaign[0]['landing_banner']?>" style='width:100%;'>
				</div>

			</div>

		</div>
	</div>
	<div class='section' id="section2">
		<br />
		<br />
		<br />
		<div class="container">
			<div class="row">
				<?php
					if(isset($campaign_video) && !empty($campaign_video)) {
						foreach($campaign_video as $list) {
                            $access_setting = $list['access_setting'];
                ?>
                        <div class="col-md-3 thumbpod">
                            <a href="javascript:void(0);">
                                <img class="imghome hov border-none" src="<?= base_url()."uploads/districtcampaign/".$list['mini_banner'] ?>" alt="<?= $list['campaign_name'] ?>" style="width:100%;">
                            </a><br>
                            <a class="watchnow" y="<?= $list['youtube'] ?>" href="javascript:void(0);" data-access-setting="<?=$access_setting?>"><i class="fa fa-play"></i> Watch Now</a>
                        </div>
                <?php

						}
					}
				?>

			</div>
			<br>
		</div>
	</div>

	<div class=' section fp-auto-height' id="section3">
		<?php $this->load->view('front/podcast/footerfp'); ?>
		<div class="  modal fade" id="watchmodal" tabindex="-1" role="dialog" aria-labelledby="watchmodal" aria-hidden="true">
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

		<div class="  modal fade" id="loginmodal" tabindex="-1" role="dialog" aria-labelledby="loginmodal" aria-hidden="true">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">
					<div class="modal-body">
						<div class="embed-responsive embed-responsive-16by9">
							<p>Untuk melihat video, harap melakukan <a href="<?= base_url().'login' ?>">Login</a> terlebih dahulu</p>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger closemsg">Close</button>
					</div>
				</div>
			</div>
		</div>
		<!-- <script src="<?php echo base_url() ?>assets/front/fullpage/fullpage.js" type="text/javascript"></script> -->
		<script>
			$(document).on('ready', function() {
				$('.carousel').carousel();
				$('.closewatch').click(function() {
					$('#youtube_player')[0].contentWindow.postMessage('{"event":"command","func":"' + 'stopVideo' + '","args":""}', '*');
					$('#watchmodal').modal('hide');
				});

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
			// 	anchors: ['1', '2', '3'],
			// 	///sectionsColor: ['#C63D0F', '#1BBC9B', '#7E8F7C'],
			// 	responsiveHeight: 300,
			// 	responsiveWidth: 800,
			// 	afterResponsive: function(isResponsive) {

			// 	}
			// });
		</script>