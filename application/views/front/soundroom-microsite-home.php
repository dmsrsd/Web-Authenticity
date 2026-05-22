<style>
	.frame {
		height: 203px;
		display: table;
		margin: 0 auto;
	}

	.frame .helper {
		display: table-cell;
		height: 100%;
		vertical-align: middle;
	}

	.frame img {
		vertical-align: middle;
		max-height: 203px;
		max-width: 203px;
	}

	.icon .fa-pause {
		color: #FF0020;
	}

	/* .footerbg, .footer1{
	display: none;
} */
</style>
<div class="page-soundroom page-soundroom--winner new-bs" style="padding-top: initial;">
	<div class="container-fluid px-0">
		<div class="row align-items-start gx-0">
			<div class="col-lg-8 banner-left">
				<div class="page-soundroom__banner" style="margin: 100px 10px 20px 10px;">
					<?php
						$season = isset($_GET['year']) ? $_GET['year'] : '2023';
						if ($season == '2025'){
					?>
						<img src='<?= base_url() ?>assets/front/img/soundroom/bg-soundroom-new-2025.png'>
					<?php } else if ($season == '2024') { ?>
						<img src='<?= base_url() ?>assets/front/img/soundroom/bg-soundroom-new-2024.png'>
					<?php } else { ?>
						<img src='<?= base_url() ?>assets/front/img/soundroom/bg-soundroom-new.png'>
					<?php } ?>
				</div>
				<div class="row justify-content-center">
					<div class="col-md-11">
						<div class="page-soundroom__cta">
							<!--<h2>
								<?php
								if ($season == '2019'){
								?>
								Perjalanan Authenticity Soundroom dimulai 2019, menjadi sebuah kolaborasi yang menyuguhkan kreasi musik untuk generasi muda. Authenticity Soundroom konsisten mengajak pemusik indie lokal untuk berpartisipasi dalam event skena lokal di Indonesia.
								<br><br>
								Dengerin playlist Soundroom 2019 dan ikutan Soundroom 2023 sekarang!
								<?php
								} elseif($season == '2022') {
								?>
								Antusias Authenticity Soundroom di 2019 membuat Soundroom kembali hadir di 2022. Dalam kurun waktu 7 hari, sebanyak lebih dari 350 band mengikuti ajang ini. Tiga band terbaik pilihan Kiki Aulia Ucup: Sunwich, Natinson, The Senior High School berhasil tampil di panggung Pestapora 2022!
								<br><br>
								Dengerin playlist Soundroom 2019 dan ikutan Soundroom 2023 sekarang!
								<?php
								} elseif($season == '2025') {
								?>
								Mau band lo manggung di Authenticity Soundroom 2025?</br> Kirim karya lagu terbaik lo yang akan dikurasi tim Authenticity. Mau apapun genre lo, lo punya kesempatan beraksi di panggung festival musik terbesar tahun ini!
								<?php
								} elseif($season == '2024') {
								?>
								Mau band lo manggung di Pestapora 2024? Kirim karya lagu terbaik lo yang akan dikurasi tim Authenticity dan Pestapora. Mau apapun genre lo, lo punya kesempatan beraksi di panggung festival musik terbesar tahun ini!
								<?php
								} else {
								?>
								Ini saatnya buktiin kalo musikalitas band lo pantes buat manggung di Pestapora bareng Authenticity Soundroom! Siapkan track terbaik, karena nantinya karya lo akan dikurasi oleh Kiki Aulia Ucup dan tim Authenticity. Menangin kesempatan manggung di salah satu festival terbesar di Indonesia, yang saat ini ada di depan mata!
								<?php
								}
								?>
							</h2>-->
							<?php

							if($season == '2025'){
							// $limit_date = '2025-07-04 00'; //tanggal selesai event
							$limit_date = '2027-07-04 00'; //tanggal selesai event
							$valid_date = date('Y-m-d H');
							if ($valid_date < $limit_date) { ?>
								<?php if (empty($this->datamember)) { ?>
									<a href='<?php echo site_url("login?to=profile/soundroom?year=".$season) ?>'>
										<img src='<?= base_url() ?>assets/front/img/soundroom/btn-cta.png'>
									</a>
								<?php } else { ?>
									<a href='<?php echo site_url("profile/soundroom?year=".$season) ?>'>
										<img src='<?= base_url() ?>assets/front/img/soundroom/btn-cta.png'>
									</a>
								<?php } ?>

							<?php } }?>
						</div>
					</div> 
				</div>
			</div>
			<div class="col-lg-4">
				<div class="page-soundroom__playlist">
					<div class="playlist-filter">
						<div class="row justify-content-between align-items-center">
							<div class="col-xl-auto col-7 position-relative">
								<i class='fa fa-search'></i>
								<input id="search-artist" type="text" placeholder="Search artist" class="form-control">
							</div>
							<?php if($season == '2025' ||$season == '2024' || $season == '2023' || $season == '') { ?>
							<div class="col-auto">
								<select class="form-select" id="genre" style="background-color: #1c4e95 !important;">
							<!-- <div class="col-xl-auto col-5">
								<select class="form-control" id="genre"> -->
									<option value="">All Genre</option>
									<option value="rock">Rock</option>
									<option value="hiphop">HipHop</option>
									<option value="metal">Metal</option>
									<option value="pop">Pop</option>
									<option value="r&b">R&B</option>
									<option value="blues">Blues</option>
									<option value="alternative">Alternative</option>
									<option value="electronic">Electronic</option>
									<option value="others">Others</option>
								</select>
							</div>
							<?php } ?>
                            <div>
                                <input id="season-year" type="hidden" value="<?=$year;?>">
                            </div>
						</div>
					</div>
					<div class='playlist-all'>
						<table width='100%' cellpadding='0' cellspacing='0' class='thead'>
							<tr>
								<th width='150'>
									<div align='center'>#</div>
								</th>
								<th>Artist</th>
								<th width="50">
									<div align='center'><i class='fa fa-clock-o'></i></div>
								</th>
							</tr>
						</table>
						<div class='divtbody' id='divtbody'>
							<!-- <table width="100%" cellpadding="0" cellspacing="0" class="tbody">
								<tbody>
									<tr class="trbody">
										<td width="150" align="center">
											<div class="noindex noindex-soloist">1</div>
											<div class="playno playno-soloist hide">
												<a href="javascript:void(0);" onclick="currentplaytop(this)" class="icon  pl-2 idpl-3" data-now="2" data-audio1="a1-3" data-audio="http://authenticity.local/uploads/soundroom/soundroom_8735_wahyusaputro_-_Epilog_Senja.mp3" data-band="soloist" data-progress="prog-3" data-progress1="prog1-3"><i class="fa fa-play"></i></a>
											</div>
										</td>
										<td>
											<div class="playlist-artist">
												<img src='<?= base_url() ?>assets/front/img/soundroom/bg-soundroom-new.png'>
												<div class="playlist-artist__caption">
													<h6>Sunwich</h6>
													<p>Jakarta Utara</p>
												</div>
											</div>
										</td>
										<td width="50" align="center">04:27</td>
									</tr>
								</tbody>
							</table> -->
							<div id='listtableplay' align='center'>Please Wait ...</div>
						</div>
					</div>
					<div class="d-none">
						<div id='currentPlay'></div>
					</div>
				</div>
			</div>
			<?php if ($season == '2025'){ ?>
				<!--<div class="col-lg-12">
					<div class='container' style="display:box; margin-top:10px;">
						<a href="<?php echo base_url('profile/vote?year=2025') ?>" target="_blank"><img src='<?= base_url() ?>assets/front/img/soundroom/banner_wner.png' width="100%"></a>
					</div>
				</div>-->
			<?php } ?>
		</div>
	</div>
	<div class="container container--winner" style="padding-top: 74px; display:none;">

		<section class="section-winner">
			<img src='<?= base_url() ?>assets/front/img/soundroom/winner-title.png' class="section-winner__title">
			<div class="row gx-5">
				<?php foreach ($soundroomtop as $top) { ?>
					<div class="col-md-4">
						<div class="card">
							<div class="card-img">
								<img src='<?= base_url() ?>uploads/soundroom/<?= $top["image"]; ?>' />
							</div>
							<div class="card-title">
								<h5><?= $top["judul"]; ?></h5>
								<p><?= $top["kota"]; ?></p>
							</div>
						</div>
					</div>
				<?php } ?>
			</div>
		</section>
	</div>
	<div class='container'>
		<section class="section-participants">
			<div class='head-blue filter'>
				<div class="container">
					<div class='row'>
						<div class='col-sm-9'>
							Urut Berdasarkan : <b>
								<select id='filter2'>
									<option value='kota'>Kota</option>
								</select>
								<select id='provinsi2'>
									<option value=''>--</option>
									<?php
									if (isset($provinsi) && count($provinsi) > 0) {
										foreach ($provinsi as $row) {
											if ($row['provinsi'] != "-") {
												echo "<option value='$row[provinsi]'>$row[provinsi]</option>";
											}
										}
									}
									?>
								</select>
								<select id='kota2'>
									<option value=''>--</option>
								</select>
							</b>
						</div>
					</div>
				</div>
				<img src='<?= base_url() ?>assets/front/img/soundroom/participant.png' class="section-participants__title">
			</div>
			<br>

			<div class="row participant-list">
				<?php
				$top15 = range(9, 15);
				$top7 = range(2, 8);
				?>
				<?php foreach ($soundroom as $row) {
					$link_ig = $link_yt = $link_spotify = '';
					if(isset($row['instagram']) && $row['instagram']!=''){
						$link_ig = "<a href='".$row['instagram']."' target='_blank'><img src='". base_url() ."assets/front/img/soundroom/instagram.png'></a>";
					}
					if(isset($row['youtube']) && $row['youtube']!=''){
						$link_yt = "<a href='".$row['youtube']."' target='_blank'> <img src='". base_url() ."assets/front/img/soundroom/youtube.png'> </a>";
					}
					if(isset($row['spotify']) && $row['spotify']!=''){
						$link_spotify = "<a href='".$row['spotify']."' target='_blank'><img src='". base_url() ."assets/front/img/soundroom/spotify.png'></a>";
					}
					echo
					"<div class='col-lg-2 col-md-4 col-sm-4'>
						<div class='box-soundroom'>";

					if ($row['top3'] == 1 && isset($row['rank'])) {
						if (in_array($row['rank'], $top15)) {
							echo "<div class='badge-winner'><img src='". base_url() ."assets/front/img/soundroom/badge-15.svg'></div>";
						} elseif (in_array($row['rank'], $top7)) {
							echo "<div class='badge-winner'><img src='". base_url() ."assets/front/img/soundroom/badge-7.png'></div>";
						} elseif ($row['rank'] == 1) {
							echo "<div class='badge-winner'><img class='golden' src='". base_url() ."assets/front/img/soundroom/badge-golden.svg'></div>";
						}
					}
					if ($row['top10'] == 1) {
						if ($row['rank'] < 7) {
							echo "<div class='badge-winner'><img src='". base_url() ."assets/front/img/soundroom/badge-6.png'></div>";
						}else{
							echo "<div class='badge-winner'><img src='". base_url() ."assets/front/img/soundroom/badge-10.png'></div>";
						}
					}
					$url_share = base_url()."soundroom/share/".$row['id_soundroom']."?year=".$year."&utm_source=sroom25&utm_medium=sroom25visitor&utm_campaign=sr25".$row['judul']."&utm_id=sroom25visitor&utm_term=sroom25visitor";
					
					if ($season >= '2024'){
						echo "<div class='box-play'>
								<div class='frame' style=\"display:block;background:url('" . base_url() . "uploads/soundroom/$row[thumbnail]') center no-repeat; background-size:cover;\">
									<div class='helper'></div>
								</div>
								<div class='overlay-play'>
									<a href='javascript:void(0);' id='play-$row[id_soundroom]' class='icon' onClick=\"jumpPlay('$row[id_soundroom]')\" style='left: 30%;'><i class='fa fa-play' ></i> </a>
									<a href='" . $url_share . "' class='icon' style='left: 70%;'><i class='fa fa-share' ></i> </a>
								</div>
								<audio class='audio5' id='a-$row[id_soundroom]' src='" . base_url() . "uploads/soundroom/$row[sound]'></audio>
								<div class='progress-play' id='prog-$row[id_soundroom]'></div>
							</div>
							<div class='soundroom-data'>
								<div class='row align-items-center'>
									<div class='col-8'>
										<div class='soundroom-data__title'>
											<h2><a href='javascript:void(0);' onClick=\"jumpPlay('$row[id_soundroom]')\">$row[judul]</a></h2>
											<h2 >$row[kota]</h2>";
					} else {
						echo "<div class='box-play'>
								<div class='frame' style=\"display:block;background:url('" . base_url() . "uploads/soundroom/$row[thumbnail]') center no-repeat; background-size:cover;\">
									<div class='helper'></div>
								</div>
								<div class='overlay-play'>
									<a href='javascript:void(0);' id='play-$row[id_soundroom]' class='icon' onClick=\"jumpPlay('$row[id_soundroom]')\"><i class='fa fa-play' ></i> </a>
								</div>
								<audio class='audio5' id='a-$row[id_soundroom]' src='" . base_url() . "uploads/soundroom/$row[sound]'></audio>
								<div class='progress-play' id='prog-$row[id_soundroom]'></div>
							</div>
							<div class='soundroom-data'>
								<div class='row align-items-center'>
									<div class='col-8'>
										<div class='soundroom-data__title'>
											<h2><a href='javascript:void(0);' onClick=\"jumpPlay('$row[id_soundroom]')\">$row[judul]</a></h2>
											<h2 >$row[kota]</h2>";
					}

					if ($row['top3'] == 1 && isset($row['rank']) && in_array($row['rank'], $top15)) {
						echo "<p class='badge-winner-text'>Top 15</p>";
					}

										echo "</div>
									</div>
									<div class='col-4'>
										<div class='dropup'>
											<a href='#' class='dropdown-toggle text-end d-block' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>
												<i class='fa fas fa-ellipsis-h'></i>
											</a>
											<div class='dropdown-menu dropdown-menu-right'>
												<div class='soundroom-data__socmed'>
													".$link_ig.$link_yt.$link_spotify."
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>";
				} ?>
			</div>
			<?php if ($galpage > 1) { ?>
				<div class="text-center">
					<a class="btn btn-outline-primary btn-loadmore" href="javascript:void(0);" onclick='get_more();' data-page='1'>Load more</a>
				</div>
			<?php } ?>
			<br />
			<br />
			<br />
		</section>

		<!--
		<?php if (count($video) < 0) { ?>
		<h1 class='head-blue filter'>
			<div class='row'>
				<div class='col-sm-3' style='padding-top:22px;'>
					Video
				</div>
			</div>
		</h1>
		<div class='row'>
			<div class='col-sm-10 col-sm-offset-1'>
				<br>
				<div class="embed-responsive embed-responsive-16by9">
					<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?= $video['youtube']; ?>?rel=0&controls=1&showinfo=0&html5=1&autoplay=0"></iframe>
				</div>
				<br>
				<div style='font-weight:bold; color: #0053A0;font-size:18px; font-family:dinl;'>
					<?= $video['judul']; ?>
				</div>
				<br>
				<br>
				<div align='center' style='font-weight:bold; text-decoration:underline; font-size:20px; font-family:dinbold;'>
					<a href='<?= base_url(); ?>soundroom-video'>Lihat Semua Video</a>
				</div>
				<br>
			</div>
		</div>
		<?php } ?>
		-->

	</div>
	<audio id='audio' src=''></audio>
	<div class='soundbar'>
		<div class='row'>
			<div class='col-sm-2'>
				<table width='100%' cellpadding='0' cellspacing='0'>
					<tr>
						<td><img class='img-soundbar' height='70'></td>
						<td width='100%'>
							<div class='namaband-soundbar'></div>
							<div class='kota-soundbar'></div>
						</td>
					</tr>
				</table>
			</div>
			<div class='col-sm-4'>
				<div class="icon-soundbar-wrapper">
					<table width='100%' cellpadding='0' cellspacing='0' class='icon-soundbar'>
						<tr>
							<td width='16%' class="hide-mobile">
								<a href='javascript:void(0);' class='sb-random onof disabled' data-type='suffle'><i class='fa fa-random'></i></a>
							</td>
							<td width='16%' class="hide-mobile">
								<a href='javascript:void(0);' class='sb-backward'><i class='fa fa-step-backward'></i></a>
							</td>
							<td width=''>
								<a href='javascript:void(0);' class='sb-playpause' data-audio="" data-progress1="" data-band="" data-slug=""><i class='fa fa-play'></i></a>
							</td>
							<td width='16%' class="hide-mobile">
								<a href='javascript:void(0);' class='sb-forward'><i class='fa fa-step-forward'></i></a>
							</td>
							<td width='16%' class="hide-mobile">
								<a href='javascript:void(0);' class='sb-repeat onof' data-type='repeat'><i class='fa fa-repeat'></i></a>
							</td>
							<td width='16%' class="hide-mobile">
								<a href='javascript:void(0);' class='sb-heart disabled'><i class='fa fa-heart'></i></a>
							</td>
						</tr>
					</table>
				</div>
			</div>
			<div class='col-sm-2'>
				<div class="slidecontainer hide-mobile">
					<input id="vol-control" class="slider" type="range" min="0" max="100" step="1" value='50' oninput="SetVolume(this.value)" onchange="SetVolume(this.value)"></input>
				</div>
			</div>
			<div class='col-sm-4'>
				<div class="soundbar-progress">
					<div id='timecur' class="hide-mobile" style='margin-top:0px; color:#FFFFFF;float:right;margin-right:10px;'>
						00:00
					</div>
					<div class="slidecontainer" style='width:80%;float:right'>
						<input id="srek-control" class="slider" type="range" min="0" max="100" step="1" value='0' oninput="SetSrek(this.value)" onchange="SetSrek(this.value)"></input>
					</div>
					<div id='timedur' class="hide-mobile" style='margin-top:0px; color:#FFFFFF;float:right;margin-left:10px;'>
						00:00
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal  fade" id="votelogin" tabindex="-1" role="dialog" aria-labelledby="votelogin" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h2 align='center' class='auth'>Notifikasi</h2>
				</div>
				<div class="modal-body">
					Please sign in or sign up for this action<br><br>
					<a href='<?= base_url() ?>login' class='btn btn-md btn-red'>Sign In</a>
					<a href='<?= base_url() ?>register' class='btn btn-md btn-blue'>Sign Up Now</a>
					<br>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal  fade" id="votemodal" tabindex="-1" role="dialog" aria-labelledby="votemodal" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h2 align='center' class='auth'>Notifikasi</h2>
				</div>
				<div class="modal-body">
					<h3>Are you sure want to vote for this contestant ?</h3>
					<div class='part-share'></div>
				</div>
				<div class="modal-footer">
					<button class='btn btn-md btn-blue  btn-x' data-x='0'><i class='fa fa-plus'></i> Vote</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal  fade" id="votenotif" tabindex="-1" role="dialog" aria-labelledby="votenotif" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h2 align='center' class='auth'>Notifikasi</h2>
				</div>
				<div class="modal-body">
					<div class='notif'>
						<h3>You have voted for this contestant</h3>
					</div>
					<div class='part-share'></div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<input type='hidden' id='repeat' value='1'>
	<input type='hidden' id='suffle' value='0'>
	<input type='hidden' id='pl-list' value=''>
	<input type='hidden' id='pl-now' value='1'>
	<input type='hidden' id='pl-done' value='0'>
	<?php $this->load->view('front/podcast/footerfp'); ?>
</div>

<script>
	//Add padding bottom to body based on warning
	function addPaddingBottomSoundBar() {
		let footerHeight = $('.footer2').outerHeight();
		let soundbarHeight = $('.soundbar').outerHeight();
		//$('body').css('padding-bottom', `${footerHeight + soundbarHeight}px`)
		//$('.soundbar').css('bottom', `${footerHeight}px`)
	}

	function equalizeHeightPlaylist(){
		const bannerLeftHeight = $('.banner-left').outerHeight() - 260;
		if($(window).width() > 767){
			$('#divtbody').css({
				'min-height' : `${bannerLeftHeight}px`,
				'max-height' : `${bannerLeftHeight}px`,
			});
		}
	}

	$(document).ready(function() {
		addPaddingBottomSoundBar()
		equalizeHeightPlaylist()
		setTimeout(
			function() {
				addPaddingBottomSoundBar()
			}, 1200);
	});


	$(window).on('resize', function() {
		addPaddingBottomSoundBar()
		equalizeHeightPlaylist()
		setTimeout(
			function() {
				addPaddingBottomSoundBar()
			}, 1200);
	});

	function get_more() {
		var data_page = $('.btn-loadmore').attr('data-page');
		var data_filter = $('#kota2').val();
		var data_provinsi = $('#provinsi2').val();
		var dataform = new FormData();
		dataform.append('<?php echo $this->security->get_csrf_token_name(); ?>', '<?php echo $this->security->get_csrf_hash(); ?>');
		dataform.append('id', data_provinsi);
		dataform.append('search', data_provinsi);
		dataform.append('data_page', data_page);
		dataform.append('data_filter', data_filter);
        dataform.append('year', $('#season-year').val());
		$.ajax({
			url: '<?= base_url() ?>soundroom/getGallery',
			type: "POST",
			dataType: "json",
			contentType: false,
			processData: false,
			data: dataform,
			beforeSend: function() {
				$('.overlay-all').show();
			},
			error: function() {
				$('.overlay-all').hide();
				alert('Failed..!!');
			},
			success: function(e) {
				$('.overlay-all').hide();
				$('.participant-list').append(e.html);
				$('.btn-loadmore').attr('data-page', e.next_page);
				if (e.next_page == '') {
					$('.btn-loadmore').remove();
				}
			}
		});
	}

	$(document).ready(function() {
		$('.overlay-all').hide();
		$('.menu-cari').on('click', function() {
			$('#mdlcari').modal('show');
		});
	});


	function sToTime(t) {
		if (isNaN(t)) {
			return "00:00";
		} else {
			return padZero(parseInt((t / (60)) % 60)) + ":" + padZero(parseInt((t) % 60));
		}
	}

	function padZero(v) {
		return (v < 10) ? "0" + v : v;
	}

	function postArtikel(desk, cap, pic, ling) {
		var obj = {
			method: 'feed',
			redirect_uri: ling,
			link: ling,
			picture: pic,
			name: 'Simply Authentic',
			caption: 'Simply Authentic Soundroom - ' + cap,
			description: desk
		};

		function callback(response) {}
		FB.ui(obj, callback);
	}

	function postArtikelTw(desk, cap, pic, ling) {
		window.open('https://twitter.com/intent/tweet?text=Simply Authentic Soundroom - ' + cap + '&amp;hashtags=simplyauthentic&amp;url=' + ling + '&amp;related=twitterapi%2Ctwitter&amp;lang=en', "myWindowName", "width=500, height=400");
	}

	function SetVolume(val) {
		var player = document.getElementById('audio');
		player.volume = val / 100;
	}

	function SetSrek(val) {
		var player = document.getElementById('audio');
		var to = (val * player.duration) / 100;
		player.currentTime = to;
	}

	function soundbar(slug, band, kota, img, loved) {
		$('.soundbar').show();
		$('.img-soundbar').attr('src', img);
		$('.namaband-soundbar').html(band);
		$('.kota-soundbar').html(kota);
		$('.sb-heart').addClass('disabled');
		if (loved == "true") {
			$('.sb-heart').removeClass('disabled');
			$('.sb-heart').addClass('onof');
		}
	}

	function togglePlay5(e) {

		e = e || window.event;
		var btn = e.target;
		var tar = e.currentTarget;
		var dataaudio = tar.getAttribute('data-audio');
		var dataprogress = tar.getAttribute('data-progress');
		var timer;
		var percent = 0;
		var audio = document.getElementById(dataaudio);
		var allaudio = document.getElementsByClassName("audio5");
		var defaudio = document.getElementById('audio');
		defaudio.pause();

		i = allaudio.length;
		var allicon = document.getElementsByClassName('fa-pause'),
			ic = allicon.length;
		audio.addEventListener("playing", function(_event) {
			var duration = _event.target.duration;
			advance(duration, audio);
		});
		audio.addEventListener("pause", function(_event) {
			clearTimeout(timer);
			btn.classList.remove('fa-pause');
			btn.classList.add('fa-play');
		});
		var advance = function(duration, element) {
			var progress = document.getElementById(dataprogress);
			increment = 10 / duration
			percent = Math.min(increment * element.currentTime * 10, 100);
			progress.style.width = percent + '%'
			startTimer(duration, element);
		}
		var startTimer = function(duration, element) {
			if (percent < 100) {
				timer = setTimeout(function() {
					advance(duration, element)
				}, 100);

			}
		}
		if (!audio.paused) {
			btn.classList.remove('fa-pause');
			audio.pause();
			isPlaying = false;
		} else {
			while (i--) {
				allaudio[i].pause();
			}
			while (ic--) {
				allicon[ic].className = "fa fa-play";
			}

			btn.classList.add('fa-pause');
			audio.play();
			isPlaying = true;
		}
	}

	function currentplaytop5(dis) {
		var band = $(dis).attr('data-band');
		var slug = $(dis).attr('data-slug');
		var dataform = new FormData();
		dataform.append('<?php echo $this->security->get_csrf_token_name(); ?>', '<?php echo $this->security->get_csrf_hash(); ?>');
		dataform.append('band', slug);
        dataform.append('year', $('#season-year').val());
		$.ajax({
			url: '<?= base_url() ?>soundroom/getBand',
			type: "POST",
			data: dataform,
			dataType: "json",
			contentType: false,
			processData: false,
			beforeSend: function() {

			},
			error: function() {
				//$('#currentPlay').html('Failed..!!');
			},
			success: function(e) {
				if (e.status == "true") {
					$('#currentPlay').html(e.html);
					soundbar(e.slug, e.namaband, e.kota, e.img, e.loved);
					togglePlay(dis, "data-progress", e.slug, e.namaband, e.kota, e.img, e.loved);
					//var myElement = document.getElementById('play-' + band);
					//var topPos = myElement.offsetTop - 100;
					/*$(".divtbody").animate({
						scrollTop: topPos
					});*/
					//var btn = myElement.childNodes;
					//$( "#play-" +band + " .playno a i").attr( "class", "fa fa-pause" );
					//klik(band);
					//$('.klikplaylist').removeClass('curractive');
					//$('.play-'+band).addClass('curractive');
				} else {
					//$('#currentPlay').html('No data..!!');
				}
			}
		});

	}

	function currentplaytop(dis) {
		var band = $(dis).attr('data-band');
		var slug = $(dis).attr('data-slug');
		var dataform = new FormData();
		dataform.append('<?php echo $this->security->get_csrf_token_name(); ?>', '<?php echo $this->security->get_csrf_hash(); ?>');
		dataform.append('band', slug);
        dataform.append('year', $('#season-year').val());
		$.ajax({
			url: '<?= base_url() ?>soundroom/getBand',
			type: "POST",
			data: dataform,
			dataType: "json",
			contentType: false,
			processData: false,
			beforeSend: function() {

			},
			error: function() {
				$('#currentPlay').html('Failed..!!');
			},
			success: function(e) {
				if (e.status == "true") {
					$('#currentPlay').html(e.html);
					soundbar(e.slug, e.namaband, e.kota, e.img, e.loved);
					togglePlay(dis, "data-progress1", e.slug, e.namaband, e.kota, e.img, e.loved);
					var myElement = document.getElementById('play-' + band);
					var topPos = myElement.offsetTop - 100;
					$(".divtbody").animate({
						scrollTop: topPos
					});
					var btn = myElement.childNodes;
					//$( "#play-" +band + " .playno a i").attr( "class", "fa fa-pause" );
					klik(band);
					$('.klikplaylist').removeClass('curractive');
					$('.play-' + band).addClass('curractive');
				} else {
					// $('#currentPlay').html('No data..!!');
					$('#currentPlay').html('Oops! Musik yang lo cari ngga ditemukan!');
					$('#currentPlay').html('');
				}
			}
		});

	}


	window.setInterval(function() {
		if ($('#pl-done').val() == "1") {
			nextpl();
		}
	}, 1000);

	function nextpl() {
		var plnow = $('#pl-now').val();
		var pllist = $('#pl-list').val();
		$('.pl-' + plnow).find('i').attr('class', 'fa fa-play');
		if ($('#repeat').val() == "1") {
			if ($('#suffle').val() == "0") {
				var plus = eval(plnow) + 1;
				if (plus > eval(pllist)) {} else {
					$('.pl-' + plus).trigger('click');
				}
			} else {
				var rand = Math.floor(Math.random() * pllist) + 1;
				$('.pl-' + rand).trigger('click')
			}
			$('.sb-playpause').find('i').attr('class', 'fa fa-play');
		}
	}

	function playpause() {
		var cur = document.getElementById("pl-done").value;
		if (cur == "1") {
			document.getElementById("pl-done").value = "0";
		} else {
			document.getElementById("pl-done").value = "1";
		}
	}

	function togglePlay(e, progresss, slug, band, kota, img, loved) {
		soundbar(slug, band, kota, img, loved);
		//e = e || window.event;
		var btn = e.childNodes;
		var audio = document.getElementById('audio');
		var dataprogress = e.getAttribute(progresss);
		var dataaudiosoundroom = e.getAttribute('data-audio');
		var datanow = e.getAttribute('data-now');
		var repeat = document.getElementById('repeat').value;
		var timer;
		var percent = 0;
		var allaudio = document.getElementsByTagName("audio");
		var plke = document.getElementById("pl-now").value;
		var beforeplay = document.getElementsByClassName('pl-' + plke);

		beforeplay[0].childNodes[0].className = 'fa fa-play';
		document.getElementById("pl-now").value = datanow;
		document.getElementById("pl-done").value = "0";
		audio.src = dataaudiosoundroom;

		i = allaudio.length;
		var allicon = document.getElementsByClassName('fa-pause'),
			ic = allicon.length;
		audio.addEventListener("playing", function(_event) {
			var duration = _event.target.duration;
			advance(duration, audio);
		});
		audio.addEventListener("pause", function(_event) {
			clearTimeout(timer);
			document.getElementById("pl-done").value = '1';
		});

		var cur = document.querySelector('#timecur'),
			dur = document.querySelector('#timedur');
		audio.addEventListener('timeupdate', function(e) {
			cur.textContent = sToTime(e.target.currentTime);
			dur.textContent = sToTime(e.target.duration);
		});
		var advance = function(duration, element) {
			var progress = document.getElementById(dataprogress);
			increment = 10 / duration;
			percent = Math.min(increment * element.currentTime * 10, 100);
			progress.style.width = percent + '%'
			startTimer(duration, element);
			var srek = document.getElementById('srek-control');
			srek.value = percent;
		}
		var startTimer = function(duration, element) {
			if (percent < 100) {
				timer = setTimeout(function() {
					advance(duration, element)
				}, 100);

			}
		}
		var soundbarplaypause = document.getElementsByClassName('sb-playpause');
		var listnow = document.getElementsByClassName('pl-' + datanow);

		soundbarplaypause[0].setAttribute('data-progress1', dataprogress);
		soundbarplaypause[0].setAttribute('data-audio', dataaudiosoundroom);
		soundbarplaypause[0].setAttribute('data-band', slug);

		if (soundbarplaypause[0].childNodes[0].className == 'fa fa-pause') {
			soundbarplaypause[0].childNodes[0].className = 'fa fa-play';
			listnow[0].childNodes[0].className = 'fa fa-play';
			audio.pause();
		} else {
			var player = document.getElementById('audio');
			player.volume = 50 / 100;
			var playerseek = document.getElementById('audio');
			//playerseek.seekable.end(0);
			soundbarplaypause[0].childNodes[0].className = 'fa fa-pause';
			listnow[0].childNodes[0].className = 'fa fa-pause';
			audio.play();
		}


	}

	function klik(band) {
		$('.klikplaylist').removeClass('active');
		$('.play-' + band).addClass('active');
		$('.noindex').show();
		$('.noindex-' + band).hide();
		$('.playno').removeAttr('style');
		$('.playno-' + band).attr('style', 'display:inline-block !important;');

	}

	function pauseAll() {
		var media = document.getElementsByTagName('audio'),
			i = media.length;

		while (i--) {
			media[i].pause();
		}
	}
	$(document).on("click", '.sb-heart', function() {
		$('#vovote').trigger('click');
	});

	function jumpPlay(ke) {
		$('.sb-playpause').find('i').attr('class', 'fa fa-play');
		if ($('#filter1').val() == 'kota') {
			$('#provinsi1').hide();
			$('#kota1').hide();
			$('#load-more1').show();
			load(ke, 'ALL', 'ALL', 'ALL');
		} else {
			$('.idpl-' + ke).trigger('click');
		}
		var myElement = document.getElementsByClassName('filter');
		var topPos = myElement.offsetTop - 100;
		$('html, body').animate({
			scrollTop: ($("#filter1").offset().top) - 110
		}, 1000);

	}

	function load(ke, kota, start, end) {
		var dataform = new FormData();
		dataform.append('<?php echo $this->security->get_csrf_token_name(); ?>', '<?php echo $this->security->get_csrf_hash(); ?>');
		dataform.append('kota', kota);
		dataform.append('start', start);
		dataform.append('end', end);
		dataform.append('artist', $('#search-artist').val());
		dataform.append('year', $('#season-year').val());
		dataform.append('genre', $('#genre').val());
		$.ajax({
			url: '<?= base_url() ?>soundroom/getPlayList',
			type: "POST",
			data: dataform,
			dataType: "json",
			contentType: false,
			processData: false,
			beforeSend: function() {

			},
			error: function(xhr, status, error) {
				$('#listtableplay').html('Failed..!!');
				console.error('Error: ', error); // Log the error to the console
				console.error('Status: ', status); // Log the status to the console
				console.error('Response: ', xhr.responseText); // Log the response text
			},
			success: function(e) {
				if (e.status == "true") {
					$('#listtableplay').html(e.html);
					if (ke != '0') {
						$('.idpl-' + ke).trigger('click');
					} else {
						$('.bp1').trigger('click');
					}
					$('#pl-list').val(e.pl);
					$('#pl-now').val('1');
					$('#pl-done').val('0');
					//$('.soundbar').hide();
					pauseAll();
				} else {
					// $('#listtableplay').html('No data..!!');
					$('#listtableplay').html('Oops! Musik yang lo cari ngga ditemukan!');
					$('#currentPlay').html('');
				}
			}
		});
	}

	function loadGallery(ke, kota, start, end) {
		var dataform = new FormData();
		dataform.append('<?php echo $this->security->get_csrf_token_name(); ?>', '<?php echo $this->security->get_csrf_hash(); ?>');
		// dataform.append('data_filter', kota);
		// dataform.append('data_page', start);
		// dataform.append('end', end);
        dataform.append('year', $('#season-year').val());

        if (kota == '') {
            dataform.append('id', $('#provinsi2').val());
            dataform.append('search', $('#provinsi2').val());
            dataform.append('data_page', '0');
            dataform.append('data_filter', '');
        } else {
            dataform.append('data_filter', kota);
            dataform.append('data_page', start);
        }

		$.ajax({
			url: '<?= base_url() ?>soundroom/getGallery',
			type: "POST",
			data: dataform,
			dataType: "json",
			contentType: false,
			processData: false,
			beforeSend: function() {

			},
			error: function() {
				$('.participant-list').html('Failed..!!');
			},
			success: function(e) {
				if (e.status == "true") {
					$('.participant-list').html(e.html);
					if (e.next_page == '') {
						$('.btn-loadmore').remove();
					}
				} else {
					// $('.participant-list').html('No data..!!');
					$('.participant-list').html('Oops! Musik yang lo cari ngga ditemukan!')
					$('.btn-loadmore').hide();
				}
			}
		});
	}
	$(document).ready(function() {

		//$('.soundbar').hide();

		$(".sb-playpause").click(function() {
			var idaudio = $('#audio');
			var plnow = $('#pl-now').val();
			var pllist = $('#pl-list').val();
			$('.pl-' + plnow).trigger('click');
		});
		$('.sb-backward').click(function() {
			var idaudio = $('#audio');
			var plnow = $('#pl-now').val();
			var pllist = $('#pl-list').val();
			$('.sb-playpause').find('i').attr('class', 'fa fa-play');
			if ($('#suffle').val() == "0") {
				var min = eval(plnow) - 1;
				if (min < 1) {} else {
					$('.pl-' + min).trigger('click');
				}

			} else {
				var rand = Math.floor(Math.random() * pllist) + 1;
				$('.pl-' + rand).trigger('click');
			}

		});
		$('.sb-forward').click(function() {
			var idaudio = $('#audio');
			var plnow = $('#pl-now').val();
			var pllist = $('#pl-list').val();
			$('.sb-playpause').find('i').attr('class', 'fa fa-play');
			if ($('#suffle').val() == "0") {
				var plus = eval(plnow) + 1;
				if (plus > eval(pllist)) {} else {
					$('.pl-' + plus).trigger('click');
				}
			} else {
				var rand = Math.floor(Math.random() * pllist) + 1;
				$('.pl-' + rand).trigger('click')
			}
		});
		$('.onof').click(function() {
			var klas = $(this).attr('class');
			var type = $(this).attr('data-type');
			if (klas.indexOf("disabled") != -1) {
				$(this).removeClass("disabled");
				$('#' + type).val(1);
			} else {
				$(this).addClass("disabled");
				$('#' + type).val(0);
			}
		});

		load("0", 'ALL', 'ALL', 'ALL');

		function currentplay(band) {
			var dataform = new FormData();
			dataform.append('<?php echo $this->security->get_csrf_token_name(); ?>', '<?php echo $this->security->get_csrf_hash(); ?>');
			dataform.append('band', band);
            dataform.append('year', $('#season-year').val());
			$.ajax({
				url: '<?= base_url() ?>soundroom/getBand',
				type: "POST",
				data: dataform,
				dataType: "json",
				contentType: false,
				processData: false,
				beforeSend: function() {

				},
				error: function() {
					$('#currentPlay').html('Failed..!!');
				},
				success: function(e) {
					if (e.status == "true") {
						$('#currentPlay').html(e.html);
						//soundbar(e.namaband,e.kota,e.img,e.loved);
					} else {
						// $('#currentPlay').html('No data..!!');
						$('#currentPlay').html('Oops! Musik yang lo cari ngga ditemukan!');
					}
				}
			});

		}
		$(document).on("click", '.klikplaylist', function() {
			var no = $(this).attr('data-no');
			var band = $(this).attr('data-band');
			var slug = $(this).attr('data-slug');
			klik(band);
			currentplay(slug);
		});
		$(document).ready(function() {
			function filterInit(filterID = null) {
				//
				if ($(`#filter${filterID}`).val() == 'vote') {
					$(`#provinsi${filterID}`).hide();
					$(`#kota${filterID}`).hide();
				}
				$(`#filter${filterID}`).change(function() {
					var val = $(this).val();
					if (val == "vote") {
						$(`#provinsi${filterID}`).hide();
						$(`#kota${filterID}`).hide();
						$(`#load-more${filterID}`).show();
						load("0", 'ALL', 'ALL', 'ALL');
					} else {
						$(`#provinsi${filterID}`).show();
						$(`#kota${filterID}`).show();
					}
				});
				$(`#kota${filterID}`).change(function() {
					var next = 'ALL';
					var kota = $(this).val();
					load("0", kota, '12', next);
				});
				$(`#provinsi${filterID}`).change(function() {
					var prov = $(this).val();
					var dataform = new FormData();
					dataform.append('<?php echo $this->security->get_csrf_token_name(); ?>', '<?php echo $this->security->get_csrf_hash(); ?>');
					dataform.append('id', prov);
					dataform.append('search', prov);
					$.ajax({
						url: '<?= base_url() ?>home/combocity',
						type: "POST",
						dataType: "json",
						contentType: false,
						processData: false,
						data: dataform,
						beforeSend: function() {
							$('.overlay-all').show();
						},
						error: function() {
							$('.overlay-all').hide();
							alert('Failed..!!');
						},
						success: function(e) {
							$('.overlay-all').hide();
							$(`#kota${filterID} option`).remove();
							$(`#kota${filterID}`).append($("<option></option>").attr("value", "").text("--"));
							var dats = e.data;
							$.each(dats, function(i, item) {
								var ids = item.id_kota;
								var kotas = item.kota;
								$(`#kota${filterID}`).append($("<option></option>").attr("value", ids).text(kotas));
							});
						}
					});


					dataform.append('kota', $('#kota1').val());
					$.ajax({
						url: '<?= base_url() ?>soundroom/getPlaylist',
						type: "POST",
						data: dataform,
						dataType: "json",
						contentType: false,
						processData: false,
						beforeSend: function() {

						},
						error: function() {
							$('#listtableplay').html('Failed..!!');
						},
						success: function(e) {
							if (e.status == "true") {
								$('#listtableplay').html(e.html);
								// if(ke!='0'){
								// 	$('.idpl-'+ke).trigger('click');
								// }else{
								// 	$('.bp1').trigger('click');
								// }
								$('.bp1').trigger('click');
								$('#pl-list').val(e.pl);
								$('#pl-now').val('1');
								$('#pl-done').val('0');
								//$('.soundbar').hide();
								pauseAll();
							} else {
								// $('#listtableplay').html('No data..!!');
								$('#listtableplay').html('Oops! Musik yang lo cari ngga ditemukan!');
								$('#currentPlay').html('');
							}
						}
					});

				});
			}
			filterInit(1);

			function filterGallery(filterID = null) {
				//
				if ($(`#filter${filterID}`).val() == 'vote') {
					$(`#provinsi${filterID}`).hide();
					$(`#kota${filterID}`).hide();
				}
				$(`#filter${filterID}`).change(function() {
					var val = $(this).val();
					if (val == "vote") {
						$(`#provinsi${filterID}`).hide();
						$(`#kota${filterID}`).hide();
						$(`#load-more${filterID}`).show();
						loadGallery("0", '', "1", 'ALL');
					} else {
						$(`#provinsi${filterID}`).show();
						$(`#kota${filterID}`).show();
					}
				});
				$(`#kota${filterID}`).change(function() {
					var next = 'ALL';
					var kota = $(this).val();
					loadGallery("0", kota, "0", next);
				});
				$(`#provinsi${filterID}`).change(function() {
					var prov = $(this).val();
					var dataform = new FormData();
					dataform.append('<?php echo $this->security->get_csrf_token_name(); ?>', '<?php echo $this->security->get_csrf_hash(); ?>');
					dataform.append('id', prov);
					dataform.append('search', prov);
					$.ajax({
						url: '<?= base_url() ?>home/combocity',
						type: "POST",
						dataType: "json",
						contentType: false,
						processData: false,
						data: dataform,
						beforeSend: function() {
							$('.overlay-all').show();
						},
						error: function() {
							$('.overlay-all').hide();
							alert('Failed..!!');
						},
						success: function(e) {
							$('.overlay-all').hide();
							$(`#kota${filterID} option`).remove();
							$(`#kota${filterID}`).append($("<option></option>").attr("value", "").text("--"));
							var dats = e.data;
							$.each(dats, function(i, item) {
								var ids = item.id_kota;
								var kotas = item.kota;
								$(`#kota${filterID}`).append($("<option></option>").attr("value", ids).text(kotas));
							});
						}
					});


					var data_page = $('.btn-loadmore').attr('data-page');
					var data_filter = $('#kota2').val();
					dataform.append('data_page', '0');
					dataform.append('data_filter', '');
                    dataform.append('year', $('#season-year').val());
					$.ajax({
						url: '<?= base_url() ?>soundroom/getGallery',
						type: "POST",
						data: dataform,
						dataType: "json",
						contentType: false,
						processData: false,
						beforeSend: function() {

						},
						error: function() {
							$('.participant-list').html('Failed..!!');
						},
						success: function(e) {
							if (e.status == "true") {
								$('.participant-list').html(e.html);
								$('.btn-loadmore').attr('data-page', e.next_page);
								if (e.next_page == '') {
									$('.btn-loadmore').remove();
								}
							} else {
								// $('.participant-list').html('No data..!!');
								$('.participant-list').html('Oops! Musik yang lo cari ngga ditemukan!');
								$('.btn-loadmore').hide();
							}
						}
					});

				});
			}
			filterGallery(2);
		});
		$('.tes').click(function() {
			var myElement = document.getElementById('play-30');
			var topPos = myElement.offsetTop - 100;
			$(".divtbody").animate({
				scrollTop: topPos
			});
			//klik(30);
		});
	});

    var timeout = null;
    $('#search-artist').keyup(function() {
        clearTimeout(timeout);
        timeout = setTimeout(function() {
            load("0", 'ALL', 'ALL', 'ALL');
        }, 800);
    });

	$('#genre').change(function(){
		load("0", 'ALL', 'ALL', 'ALL');
	})


	$(document).on("click", '.btn-votelogin', function() {
		//$('.btn-votelogin').click(function(){
		$('#stickymodal').modal({
			backdrop: 'static',
			keyboard: false
		});
	});
	<?php if (!empty($this->datamember)) { ?>

		function getsoundroom(part, target) {
			var dataform = new FormData();
			dataform.append('<?php echo $this->security->get_csrf_token_name(); ?>', '<?php echo $this->security->get_csrf_hash(); ?>');
			dataform.append('res', part);
			$.ajax({
				type: "POST",
				data: dataform,
				dataType: "json",
				contentType: false,
				processData: false,
				url: "<?php echo base_url(); ?>soundroom/getsoundroom",
				beforeSend: function() {
					$('.' + target).html("Loading participant ...");
				},
				success: function(e) {
					$('.' + target).html(e.message);
				},
				error: function() {}
			});
		}
		$(document).on("click", '.btn-votehave', function() {
			//$('.btn-votehave').click(function(){
			$('#votenotif').modal('show');
			$('#votenotif .notif').html('<h3>You have voted for this contestant!</h3>');
			var part = $(this).attr('data-res');
			getsoundroom(part, "part-share");
		});
		$(document).on("click", '.btn-votemax', function() {
			//$('.btn-votemax').click(function(){
			$('#votenotif').modal('show');
			$('#votenotif .notif').html('<h3>The vote limit is only 2 times today!</h3>');
			var part = $(this).attr('data-res');
			getsoundroom(part, "part-share");
		});
		$(document).on("click", '.btn-vote', function() {
			//$('.btn-vote').click(function(){
			var x = $(this).attr('data-res');
			$('#votemodal .btn-x').attr('data-x', x);
			$('#votemodal').modal('show');
			var part = $(this).attr('data-res');
			getsoundroom(part, "part-share");
		});
		$(document).on("click", '.btn-vote5', function() {
			var x = $(this).attr('data-res');
			$('#votemodal .btn-x').attr('data-x', x);
			$('#votemodal .btn-x').attr('dtp', x);
			$('#votemodal').modal('show');
			var part = $(this).attr('data-res');
			getsoundroom(part, "part-share");
		});
		$(document).on("click", '.btn-x', function() {
			//$('.btn-x').click(function(){
			var dataform = new FormData();
			var attr = $(this).attr('dtp');
			if (typeof attr !== typeof undefined && attr !== false) {
				dataform.append('dtp', attr);
			} else {
				dataform.append('dtp', '');
			}
			var x = $(this).attr('data-x');
			dataform.append('<?php echo $this->security->get_csrf_token_name(); ?>', '<?php echo $this->security->get_csrf_hash(); ?>');
			dataform.append('x', x);
			$.ajax({
				type: "POST",
				data: dataform,
				dataType: "json",
				contentType: false,
				processData: false,
				url: "<?php echo base_url(); ?>soundroom/getpoint",
				beforeSend: function() {
					$('.btn-x').prop("disabled", true);
				},
				success: function(e) {
					$('.btn-x').prop("disabled", false);
					$('#votemodal').modal('hide');
					$('#votenotif').modal('show');
					var html = "";
					if (e.status == "false") {
						html = "<div class='alert alert-danger'>" + e.message + "</div>";
					} else {
						$('#' + e.btnv).attr('class', 'btn btn-md btn-block btn-votehave btn-red');
						$('#' + e.tot).html(e.qtot);
						html = "<div class='alert alert-success'>" + e.message + "</div>";
					}
					$('#votenotif .notif').html(html);
				},
				error: function() {
					$('#votemodal').modal('hide');
					$('#votenotif').modal('show');
					$('#votenotif .notif').html('ERROR!');
					$('.btn-x').prop("disabled", false);
				}
			});

		});
	<?php } ?>
</script>
