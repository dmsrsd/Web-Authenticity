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
	.soundroom-data__title{
		min-height: 90px;
	}
	.frame img {
		vertical-align: middle;
		max-height: 203px;
		max-width: 203px;
	}

	.icon .fa-pause {
		color: #FF0020;
	}
	.page-soundroom .section-participants {
  padding-top: 0;
	}
	@media (min-width: 768px) {
	.ten-columns > .col-sm-2 {
		width: 20%;
	}
	}
	@media (max-width: 768px) {
	.page-soundroom .section-participants {
  padding-top: 10px;
	}
	}
	/* Decorations */
	.ten-columns .col-sm-2 {
	color: #fff;
	font-size: 28px;
	font-weight: bold;
	min-height: 150px; 
	padding-top: 6px;
	padding-bottom: 20px; 
	}
	.col-sm-2:nth-of-type(even) { }
	.page-soundroom {
	background-image: url("<?= base_url() ?>assets/front/img/soundroom/vote/bg-paper.png");
	background-size: cover;
	background-position: bottom center;
	overflow: hidden;
	}

	:root {
	--form-control-color: rebeccapurple;
	}

	*,
	*:before,
	*:after {
	box-sizing: border-box;
	}

	body {
	margin: 0;
	}

	form {
	display: grid;
	place-content: center;
	min-height: 100vh;
	}

	.form-control {
	font-family: system-ui, sans-serif;
	font-size: 1rem;
	font-weight: bold;
	line-height: 1.1;
	display: grid;
	grid-template-columns: 1em auto;
	gap: 0.5em;
	}

	.form-control + .form-control {
	margin-top: 1em;
	}

	.form-control:focus-within {
	color: var(--form-control-color);
	}
	.juara .form-control{
		box-shadow: none;
		border: none;
	}

	.juara input[type="radio"] {
	/* Add if not using autoprefixer */
	-webkit-appearance: none;
	/* Remove most all native input styles */
	appearance: none;
	/* For iOS < 15 */
	background-color: var(--form-background);
	/* Not removed via appearance */
	margin: 0;

	font: inherit;
	color: #0453a2;
	width: 1.3em;
	height: 1.3em;
	border: 0.15em solid #0453a2;
	border-radius: 50%;
	-webkit-border-radius :50%!important;
	transform: translateY(-0.075em);

	display: grid;
	place-content: center;
	}
	.juara input[type="radio"]::before {
	content: "";
	width: 0.65em;
	height: 0.65em;
	border-radius: 50%;
	transform: scale(0);
	transition: 120ms transform ease-in-out;
	box-shadow: inset 1em 1em #f00a0a;
	/* Windows High Contrast Mode */
	background-color: CanvasText;
	}

	.juara input[type="radio"]:checked::before {
	transform: scale(1);
	}

	.juara input[type="radio"]:focus {
	outline: max(2px, 0.15em) solid currentColor;
	outline-offset: max(2px, 0.15em);
	}
</style>
<div class="page-soundroom page-soundroom--winner new-bs" style="padding-top: 4.5rem;">
	<div class="container-fluid px-0">
		<div class="row align-items-start gx-0">
			<div class="col-lg-12">
					<div class="container-fluid">
						<img src="<?= base_url() ?>assets/front/img/soundroom/vote/banner-2025.jpg" width="100%">
					</div>
			</div>
		</div>
	</div>
	<div class="container container--winner" style="padding-top: 74px; display:none;">
		<section class="section-winner">
			<img src="<?= base_url() ?>assets/front/img/soundroom/vote/winner-title.png" class="section-winner__title">
			<div class="row gx-5"></div>
		</section>
	</div>

<!--START THUMBNILE-->
<form role="form" id="frmWrite" action="<?= base_url() ?>profile/submitvote" method="post" data-parsley-validate enctype="multipart/form-data">
	
	<div class="container juara">
	
	<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
		<section class="section-participants">
			<div class="row">
				<div class="col-lg-12 text-center" style="margin-bottom: 40px"><img src="<?= base_url() ?>assets/front/img/soundroom/vote/title_pemenang.png" style="max-width: 100%;"></div>
			</div>
			<!-- <div class="row ten-columns"> -->
			<div class="row">
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
					
					$url_share = base_url()."soundroom/share/".$row['id_soundroom']."?year=2025&utm_source=sroom25&utm_medium=sroom25visitor&utm_campaign=sr25".$row['judul']."&utm_id=sroom25visitor&utm_term=sroom25visitor";
				?>
					
				<div class="col-6 col-md-2">
					<div class="box-soundroom">
						<div class="box-play">
							<div class="frame" style="display:block;background:url('<?= base_url('uploads/soundroom/'.$row['thumbnail']) ?>') center no-repeat; background-size:cover;">
								<div class="helper"></div>
							</div>
							<div class="overlay-play">
								<a href="javascript:void(0);" id="play-<?= $row['id_soundroom'] ?>" class="icon" onclick="jumpPlay('<?= $row['id_soundroom'] ?>')" style="left: 30%;"><i class="fa fa-play"></i> </a>
								<a href="<?= $url_share ?>" class="icon" style="left: 70%;"><i class="fa fa-share"></i> </a>
							</div>
							<audio class="audio5" id="a-<?= $row['id_soundroom'] ?>" src="<?= base_url('uploads/soundroom/'.$row['sound']) ?>"></audio>
							<div class="progress-play" id="prog-<?= $row['id_soundroom'] ?>"></div>
						</div>
						<div class="soundroom-data">
							<div class="row align-items-center">
								<div class="col-8">
									<div class="soundroom-data__title">
										<h1><a href="javascript:void(0);" onclick="jumpPlay('<?= $row['id_soundroom'] ?>')"><?= $row['judul'] ?></a></h1>
										<h2><?= $row['kota'] ?></h2>
									</div>
								</div>
								<div class="col-4">
									<div class="dropup">
										<a href="#" class="dropdown-toggle text-end d-block" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
											<i class="fa fas fa-ellipsis-h"></i>
										</a>
										<div class="dropdown-menu dropdown-menu-right">
											<div class='soundroom-data__socmed'>
												<?= $link_ig ?>
												<?= $link_yt ?>
												<?= $link_spotify ?>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="position-relative">
							<label class="form-control">
								<input type="radio" name="pilih" value="<?= $row['id_vote'] ?>"> Pilih
							</label>
							<p class="position-absolute" style="font-size: 15px;color: #e1aa25;right: 10px;top: 10px;"><i class="fa fa-heart" aria-hidden="true"></i> <?= $row['jml_vote'] ?></p>
						</div>
					</div>
				</div>
				<?php } ?>
			</div>
			<div class="row">
				<div class="col-lg-12 text-center" style="margin: 40px 0">
					
				</div>
			</div>
		</section>
	<!--END THUMBNILE-->

	</div>
	<audio id="audio" src=""></audio>
	<!-- <div class="soundbar">
		<div class="row">
			<div class="col-sm-2">
				<table width="100%" cellspacing="0" cellpadding="0">
					<tbody><tr>
						<td><img class="img-soundbar" height="70"></td>
						<td width="100%">
							<div class="namaband-soundbar"></div>
							<div class="kota-soundbar"></div>
						</td>
					</tr>
				</tbody></table>
			</div>
			<div class="col-sm-4">
				<div class="icon-soundbar-wrapper">
					<table class="icon-soundbar" width="100%" cellspacing="0" cellpadding="0">
						<tbody><tr>
							<td class="hide-mobile" width="16%">
								<a href="javascript:void(0);" class="sb-random onof disabled" data-type="suffle"><i class="fa fa-random"></i></a>
							</td>
							<td class="hide-mobile" width="16%">
								<a href="javascript:void(0);" class="sb-backward"><i class="fa fa-step-backward"></i></a>
							</td>
							<td width="">
								<a href="javascript:void(0);" class="sb-playpause" data-audio="" data-progress1="" data-band="" data-slug=""><i class="fa fa-play"></i></a>
							</td>
							<td class="hide-mobile" width="16%">
								<a href="javascript:void(0);" class="sb-forward"><i class="fa fa-step-forward"></i></a>
							</td>
							<td class="hide-mobile" width="16%">
								<a href="javascript:void(0);" class="sb-repeat onof" data-type="repeat"><i class="fa fa-repeat"></i></a>
							</td>
							<td class="hide-mobile" width="16%">
								<a href="javascript:void(0);" class="sb-heart disabled"><i class="fa fa-heart"></i></a>
							</td>
						</tr>
					</tbody></table>
				</div>
			</div>
			<div class="col-sm-2">
				<div class="slidecontainer hide-mobile">
					<input id="vol-control" class="slider" type="range" min="0" max="100" step="1" value="50" oninput="SetVolume(this.value)" onchange="SetVolume(this.value)">
				</div>
			</div>
			<div class="col-sm-4">
				<div class="soundbar-progress">
					<div id="timecur" class="hide-mobile" style="margin-top:0px; color:#FFFFFF;float:right;margin-right:10px;">
						00:00
					</div>
					<div class="slidecontainer" style="width:80%;float:right">
						<input id="srek-control" class="slider" type="range" min="0" max="100" step="1" value="0" oninput="SetSrek(this.value)" onchange="SetSrek(this.value)">
					</div>
					<div id="timedur" class="hide-mobile" style="margin-top:0px; color:#FFFFFF;float:right;margin-left:10px;">
						00:00
					</div>
				</div>
			</div>
		</div>
	</div> -->
	<div class="modal  fade" id="votelogin" tabindex="-1" role="dialog" aria-labelledby="votelogin" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h2 class="auth" align="center">Notifikasi</h2>
				</div>
				<div class="modal-body">
					Please sign in or sign up for this action<br><br>
					<a href="<?= base_url() ?>/login" class="btn btn-md btn-red">Sign In</a>
					<a href="<?= base_url() ?>/register" class="btn btn-md btn-blue">Sign Up Now</a>
					<br>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="votemodal" tabindex="-1" role="dialog" aria-labelledby="votemodal" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h2 class="auth text-center">Notifikasi</h2>
				</div>
				<div class="modal-body">
					<h3>Are you sure want to vote for this contestant?</h3>
					<div class="part-share"></div>
				</div>
				<div class="modal-footer">
					<button type="submit" id='btnWrite' name='submit' value='1' class="btn btn-md btn-blue btn-x">
						<i class="fa fa-plus"></i> Vote
					</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				</div>
			</div>
		</div>
	</div>

	<div class="modal  fade" id="votenotif" tabindex="-1" role="dialog" aria-labelledby="votenotif" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h2 class="auth" align="center">Notifikasi</h2>
				</div>
				<div class="modal-body">
					<div class="notif" id="texthasil">
						<h3>Thank you. You have voted for this contestant</h3>
					</div>
					<div class="part-share"></div>
				</div>
				<div class="modal-footer">
					<a href="<?= isset($_SERVER['HTTP_REFERER']) ?  $_SERVER['HTTP_REFERER'] :  base_url('soundroom?year=2025'); ?>" class="btn btn-md btn-blue btn-x"><i class="fa fa-arrow-left"></i>Soundroom</a>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<input type="hidden" id="repeat" value="1">
	<input type="hidden" id="suffle" value="0">
	<input type="hidden" id="pl-list" value="">
	<input type="hidden" id="pl-now" value="1">
	<input type="hidden" id="pl-done" value="0">
	
		
</form>

<?php $this->load->view('front/podcast/footerfp'); ?>
</div>

<script>
	function openVoteModal(eve) {
		eve.preventDefault();
		var pilih = $('input[name="pilih"]:checked').val();

		// if (!pilih) {
		// 	alert("Silakan pilih salah satu opsi terlebih dahulu.");
		// 	$('#votemodal').modal('hide');
		// 	return;
		// }
		$('#votemodal').modal({
			backdrop: 'static',
			keyboard: false
		});
	}

	$("#frmWrite").submit(function(eve) {
		eve.preventDefault();

		var dataform = new FormData();
		var pilih = $('input[name="pilih"]:checked').val();

		if (!pilih) {
			alert("Silakan pilih salah satu opsi terlebih dahulu.");
			$('#votemodal').modal('hide');
			return;
		}

		dataform.append('pilih', pilih);
		dataform.append('<?php echo $this->security->get_csrf_token_name(); ?>', '<?php echo $this->security->get_csrf_hash(); ?>');

		$.ajax({
			type: "POST",
			data: dataform,
			dataType: "json",
			contentType: false,
			processData: false,
			url: "<?php echo base_url(); ?>profile/submitvote",
			beforeSend: function() {
				$('.overlay-all').show();
				$('#submitform').prop("disabled", true);
			},
			success: function(e) {
				$('#texthasil').html(e.message);
				$('.overlay-all').hide();
				$('#btnWrite').prop("disabled", false);
				$('#votemodal').modal('hide');
				$('#votenotif').modal({
					backdrop: 'static',
					keyboard: false
				});
			},
			error: function(e) {
				$('#texthasil').html(e.message);
				$('#votemodal').modal('hide');
				$('#votenotif').modal({
					backdrop: 'static',
					keyboard: false
				});
				
			}
		});
	});

	function jumpPlay(ke) {
		pauseAll(); // berhentiin semua audio
		var audio = document.getElementById('a-' + ke);
		if (audio) {
			audio.play(); // langsung mainkan audio
		}
	}
	function pauseAll() {
		var audios = document.getElementsByTagName('audio');
		for (var i = 0; i < audios.length; i++) {
		audios[i].pause();
		audios[i].currentTime = 0; // optional: reset to beginning
		}
	}
</script>
