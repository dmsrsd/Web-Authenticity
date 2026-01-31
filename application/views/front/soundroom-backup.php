<style>
.frame {
    height: 165px;
    display:table;
	margin:0 auto;
}

.frame .helper {
    display: table-cell;
    height: 100%;
    vertical-align: middle;
}

.frame img {
    vertical-align: middle;
    max-height: 165px;
    max-width: 165px;
}
.icon .fa-pause{
	color:#FF0020;
}
</style>
<div class='min-height'>
	<div class='container'>
		<div class='row  sec-room'>
			<div class='col-sm-12'>
				<div>
					<div class='col-sm-7'>
						<div class='kotak-table'  style='height:300px;' >
							<div class='in-kotak-table'>
								<div class='text-center'>
									<img src='<?=base_url()?>uploads/<?=$website['soundroombanner'];?>' class=' ' style='width:70%;'>
								</div>
							</div>
						</div>
					</div>
					<div class='col-sm-5'>
						<div class='kotak-table'  style='height:300px;' >
							<div class='in-kotak-table'>
								<div class='inads'>
									<h3 class='text-blue' style='font-weight:bold; font-family:din;'>
										BANDUNG, JAKARTA JOGJAKARTA, DAN KOTA LAINNYA.<br>KAMI MENANTI LAGU KALIAN!<br><br>
										KALIAN PUNYA LAGU OTENTIK? KALAU LAYAK, KITA NIKMATI BERSAMA DI AUTHENTICITY SPACE
									</h3>

								</div>
							</div>
						</div>
					</div>
					<div class='cl'></div>
				</div>
			</div>
		</div>
		<div class='row'>
			<div class='col-md-12'>
				<div class='head-blue' style='border-bottom:none;'>
					Caranya :
				</div>
			</div>
		</div>
		<div class='row'>
			<div class='col-sm-4'>
				<div align='center'>
					<img src='<?=base_url()?>assets/front/img/soundstep1.png'>
				</div>
				<div class='soundstep'>
					1. Jangan keribetan sendiri mau pilih lagu yang mana. Yakin aja lagu lo emang keren.

				</div>
			</div>
			<div class='col-sm-4'>
				<div align='center'>
					<img src='<?=base_url()?>assets/front/img/soundstep2.png'>
				</div>
				<div class='soundstep'>
					2. Langkah berikutnya jangan sampai lupa diupload. Masa udah bikin lagu keren cuma buat ditaro di handphone.

				</div>
			</div>
			<div class='col-sm-4'>
				<div align='center'>
					<img src='<?=base_url()?>assets/front/img/soundstep3.png'>
				</div>
				<div class='soundstep'>
					3. Ajak teman nongkrong, temannya pacar, temannya teman pacar lo untuk ikutan vote lagu yang sudah diupload! Buktikan kalau lagu lo juga disukain banyak orang.
				</div>
			</div>
		</div>
		<div class='row' id='topart'>
			<div class='col-sm-4 col-sm-offset-4'>
				<div align='center'>
					<a class='btn btn-md btn-red btn-block' style='font-weight:bold; font-family:din;' href='<?=base_url()?>profile/soundroom' >UPLOAD YOUR SOUND</a>
				</div>
			</div>
		</div>

	</div>
	<br><br>
	<div class='container'>
		<h1 class='head-blue'>
			<div class='row'>
				<div class='col-sm-4'>
					Participants
				</div>
				<div class='col-sm-8'>
					<div class='right-filter'>
						Urut Berdasarkan : <b>
						<select id='filter' style='padding:3px 6px; cursor:pointer;margin-top:5px;'>
							<option value='vote'>Voting Tertinggi</option>
							<option value='kota'>Kota</option>
						</select>
						<select id='provinsi' style='padding:3px 6px; cursor:pointer;margin-top:5px;'>
							<option value=''>--</option>
							<?php
								if(isset($provinsi) && count($provinsi) > 0){ foreach($provinsi as $row){
									if($row['provinsi']!="-"){
										echo "<option value='$row[provinsi]'>$row[provinsi]</option>";
									}
								}}
							?>
						</select>
						<select id='kota' style='padding:3px 6px; cursor:pointer;margin-top:5px;'>
							<option value=''>--</option>
						</select>
						</b>
					</div>
				</div>
			</div>
		</h1>
		<br>
		<div class='row'>
		<?php
		$nv = 0;
		$okvote = "";
		$page = 0 ;
		if(isset($soundroom) && count($soundroom) > 0){ foreach($soundroom as $row){
			$query = $this->db->query("SELECT COUNT(id_resource) as vote FROM `point` where id_resource='$row[id_soundroom]' and id_jenis_point='10'")->result_array();
			$total =  $query[0]['vote'];
			if(empty($this->datamember)){
				$vote = "btn-votelogin btn-blue ";
			}else{
				$qsudah = $this->db->query("SELECT COUNT(id_resource) as vote FROM `point` where id_resource='$row[id_soundroom]' and id_jenis_point='10' and id_member='".$this->datamember['id']."'")->result_array();
				$sudah =  $qsudah[0]['vote'];
				if($sudah > 0){
					$vote = "btn-votehave btn-red ";
				}else{
					$qbrp = $this->db->query("SELECT COUNT(id_resource) as vote FROM `point` where id_jenis_point='10' and id_member='".$this->datamember['id']."'  and date(created_date)=CURDATE() ")->result_array();
					$berapa =  $qbrp[0]['vote'];
					if($berapa=="2"){
						$vote = "btn-blue btn-votemax";
					}else{
						$vote = "btn-blue btn-vote";
						$okvote = "ok";
					}
				}
			}
			if( $nv % 12 ==0){
				$page++;
			}
			echo"
			<div class='col-md-2 col-sm-4 by-$row[id_kota] all-soundroom page-$page'>
				<div class='box-soundroom'>
					<div class='box-play'>
						<div class='frame'>
							<div class='helper'><img src='".base_url()."uploads/soundroom/$row[thumbnail]' class='img-responsive' style='widths:100%;'></div>
						</div>
						<div class='overlay-play'>
							<a href='javascript:void(0);' id='play-$row[id_soundroom]' onClick='togglePlay()' class='icon' data-audio='a-$row[id_soundroom]' data-progress='prog-$row[id_soundroom]'><i class='fa fa-play' ></i> </a>
						</div>
						<audio id='a-$row[id_soundroom]' src='".base_url()."uploads/soundroom/$row[sound]'></audio>
						<div class='progress-play' id='prog-$row[id_soundroom]'></div>
						<div class='progress-srek'></div>
					</div>
					<div class='soundroom-data'>
						<h1><a href='".base_url()."soundroom/$row[slug]'>$row[judul]</a></h1>
						<h2>$row[kota]<br><b><span id='tot-$row[id_soundroom]'>$total</span> Votes</b></h2>
					</div>
					<div class='row'>
						<div class='col-md-12'>
							<a class='btn btn-md btn-block $vote' id='btnv-$row[id_soundroom]' data-res='$row[id_soundroom]'><i class='fa fa-plus'></i> Vote &amp; Share</a>
						</div>
					</div>
				</div>
			</div>

			";
			$nv++;
		}}
		?>

			<br>
			<div class='cl'></div>
			<div class='col-sm-4 col-sm-offset-4'>
				<?php
				if($page>1){
				?>
				<a href='javascript:void(0);' id='load-more' class='btn btn-md btn-block btn-load-more'>LOAD MORE</a>
				<?php }?>
			</div>
		</div>
	</div>
</div>
	<div class="modal  fade" id="votelogin" tabindex="-1" role="dialog" aria-labelledby="votelogin" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h2 align='center' class='auth' >Notifikasi</h2>
				</div>
				<div class="modal-body">
					Please sign in or sign up for this action<br><br>
					<a href='<?=base_url()?>login' class='btn btn-md btn-red'>Sign In</a>
					<a href='<?=base_url()?>register' class='btn btn-md btn-blue'>Sign Up Now</a>
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
					<h2 align='center' class='auth' >Notifikasi</h2>
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
					<h2 align='center' class='auth' >Notifikasi</h2>
				</div>
				<div class="modal-body">
					<div class='notif'><h3>You have voted for this contestant</h3></div>
					<div class='part-share'></div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
<?php $this->load->view('front/podcast/footerfp');?>
<script>
	function postArtikel(desk,cap,pic,ling) {
		var obj = {
			method: 'feed',
			redirect_uri: ling,
			link: ling,
			picture: pic,
			name: 'Simply Authentic',
			caption: 'Simply Authentic Soundroom - '+cap,
			description: desk
		};
		function callback(response) {
		}
		FB.ui(obj, callback);
	}
	function postArtikelTw(desk,cap,pic,ling) {
		window.open('https://twitter.com/intent/tweet?text=Simply Authentic Soundroom - '+cap+'&amp;hashtags=simplyauthentic&amp;url='+ling+'&amp;related=twitterapi%2Ctwitter&amp;lang=en', "myWindowName", "width=500, height=400");
	}

	function togglePlay (e) {

		e = e || window.event;
		var btn = e.target;
		var tar = e.currentTarget;
		var dataaudio = tar.getAttribute('data-audio');
		var dataprogress = tar.getAttribute('data-progress');
		var timer;
		var percent = 0;
		var audio = document.getElementById(dataaudio);
		var allaudio = document.getElementsByTagName("audio");
		i = allaudio.length;
		var allicon = document.getElementsByClassName('fa-pause'),
		ic = allicon.length;
		audio.addEventListener("playing", function(_event) {
			var duration = _event.target.duration;
			advance(duration, audio);
		});
		audio.addEventListener("pause", function(_event) {
			clearTimeout(timer);
		});
		var advance = function(duration, element) {
			var progress = document.getElementById(dataprogress);
			increment = 10/duration
			percent = Math.min(increment * element.currentTime * 10, 100);
			progress.style.width = percent+'%'
			startTimer(duration, element);
		}
		var startTimer = function(duration, element){
			if(percent < 100) {
				timer = setTimeout(function (){advance(duration, element)}, 100);

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
				allicon[ic].className= "fa fa-play";
			}
			btn.classList.add('fa-pause');
			audio.play();
			isPlaying = true;
		}
	}

	$(document).on('ready', function() {
		<?php
			$slug = $this->uri->segment(2);
			if($slug!=""){

		?>
		//var ad = document.getElementById("a-<?=$detil['id_soundroom'];?>");
		//ad.play();
		function togglePlay2 (id,dataaudio,dataprogress) {
			var btn = document.getElementById(id).children[0];
			var timer;
			var percent = 0;
			var audio = document.getElementById(dataaudio);
			var allaudio = document.getElementsByTagName("audio");
			i = allaudio.length;
			var allicon = document.getElementsByClassName('fa-pause'),
			ic = allicon.length;
			audio.addEventListener("playing", function(_event) {
				var duration = _event.target.duration;
				advance(duration, audio);
			});
			audio.addEventListener("pause", function(_event) {
				clearTimeout(timer);
			});
			var advance = function(duration, element) {
				var progress = document.getElementById(dataprogress);
				increment = 10/duration
				percent = Math.min(increment * element.currentTime * 10, 100);
				progress.style.width = percent+'%'
				startTimer(duration, element);
			}
			var startTimer = function(duration, element){
				if(percent < 100) {
					timer = setTimeout(function (){advance(duration, element)}, 100);

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
					allicon[ic].className= "fa fa-play";
				}
				btn.classList.add('fa-pause');
				audio.play();
				isPlaying = true;
			}
		}
		togglePlay2("play-<?=$detil['id_soundroom'];?>","a-<?=$detil['id_soundroom'];?>","prog-<?=$detil['id_soundroom'];?>");
		$('html, body').animate({
			scrollTop: $("#topart").offset().top
		}, 1000);

		<?php }?>


		var page = <?=$page;?>;
		for(var x = 1; x<=page; x++){
			$('.page-'+x).hide();
		}
		$('.page-1').show();
		$('#load-more').click(function(){
			var page = <?=$page;?>;
			var ke = 2;
			for(var x = 1; x<=page; x++){
				var att = $('.page-'+x).attr('style');
				if(att == "display: none;"){
					$('.page-'+x).show();
					if(x==page){
						$('#load-more').hide();
					}
					break;
				}
			}
			console.log(ke + " "+ page);
		});

		$('#provinsi').hide();
		$('#kota').hide();
		$('#kota').change(function(){
			var val = $(this).val();
			$('.all-soundroom').hide();
			$('.by-'+val).show();
		});
		$('#filter').change(function(){
			var val = $(this).val();
			if(val=="vote"){
				$('#provinsi').hide();
				$('#kota').hide();
				$('.all-soundroom').show();
				for(var x = 1; x<=page; x++){
					$('.page-'+x).hide();
				}
				$('.page-1').show();
				$('#load-more').show();

			}else{
				$('#provinsi').show();
				$('#kota').show();
			}
		});
		$('#provinsi').change(function(){
			var prov = $(this).val();
			var dataform = new FormData();
			dataform.append('<?php echo $this->security->get_csrf_token_name(); ?>', '<?php echo $this->security->get_csrf_hash(); ?>');
			dataform.append('id', prov);
			dataform.append('search', prov);
			$.ajax({
				url: '<?=base_url()?>home/combocity',
				type: "POST",
				dataType: "json",
				contentType: false,
				processData: false,
				data: dataform,
				beforeSend: function () {
					$('.overlay-all').show();
				},
				error: function () {
					$('.overlay-all').hide();
					alert('Failed..!!');
				},
				success: function (e) {
					$('.overlay-all').hide();
					$('#kota option').remove();
					$('#kota').append($("<option></option>").attr("value","").text("--"));
					var dats = e.data;
					$.each(dats, function(i, item) {
						var ids = item.id_kota;
						var kotas = item.kota;
						$('#kota').append($("<option></option>").attr("value",ids).text(kotas));
					});
				}
			});

		});

		$('.btn-votelogin').click(function(){
			$('#stickymodal').modal({backdrop: 'static', keyboard: false});
		});
		<?php if(!empty($this->datamember)){ ?>
		function getsoundroom(part,target){
			var dataform = new FormData();
			dataform.append('<?php echo $this->security->get_csrf_token_name(); ?>', '<?php echo $this->security->get_csrf_hash(); ?>');
			dataform.append('res', part);
			$.ajax({
				type: "POST",
				data: dataform,
				dataType: "json",
				contentType: false,
				processData: false,
				url: "<?php echo base_url();?>soundroom/getsoundroom",
				beforeSend: function () {
					$('.'+target).html("Loading participant ...");
				},
				success: function (e) {
					$('.'+target).html(e.message);
				},
				error: function () {
				}
			});
		}

		$('.btn-votehave').click(function(){
			$('#votenotif').modal('show');
			$('#votenotif .notif').html('<h3>You have voted for this contestant!</h3>');
			var part = $(this).attr('data-res');
			getsoundroom(part,"part-share");
		});
		$('.btn-votemax').click(function(){
			$('#votenotif').modal('show');
			$('#votenotif .notif').html('<h3>The vote limit is only 2 times today!</h3>');
			var part = $(this).attr('data-res');
			getsoundroom(part,"part-share");
		});
		$('.btn-vote').click(function(){
			var x = $(this).attr('data-res');
			$('#votemodal .btn-x').attr('data-x',x);
			$('#votemodal').modal('show');
			var part = $(this).attr('data-res');
			getsoundroom(part,"part-share");
		});
		$('.btn-x').click(function(){
			<?php if($okvote=="ok"){?>
			var x = $(this).attr('data-x');
			var dataform = new FormData();
			dataform.append('<?php echo $this->security->get_csrf_token_name(); ?>', '<?php echo $this->security->get_csrf_hash(); ?>');
			dataform.append('x', x);
			$.ajax({
				type: "POST",
				data: dataform,
				dataType: "json",
				contentType: false,
				processData: false,
				url: "<?php echo base_url();?>soundroom/getpoint",
				beforeSend: function () {
					$('.btn-x').prop("disabled", true);
				},
				success: function (e) {
					$('.btn-x').prop("disabled", false);
					$('#votemodal').modal('hide');
					$('#votenotif').modal('show');
					var html = "";
					if(e.status=="false"){
						html = "<div class='alert alert-danger'>"+ e.message +"</div>";
					}else{
						$('#'+e.btnv).attr('class','btn btn-md btn-block btn-votehave btn-red');
						$('#'+e.tot).html(e.qtot);
						html = "<div class='alert alert-success'>"+ e.message +"</div>";
					}
					$('#votenotif .notif').html(html);
				},
				error: function () {
					$('#votemodal').modal('hide');
					$('#votenotif').modal('show');
					$('#votenotif .notif').html('ERROR!');
					$('.btn-x').prop("disabled", false);
				}
			});
			<?php }?>
		});
		<?php }?>

	});
</script>
