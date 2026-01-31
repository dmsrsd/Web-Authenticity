<style>
.frame {
    height: 203px;
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
    max-height: 203px;
    max-width: 203px;
}
.icon .fa-pause{
	color:#FF0020;
}

</style>
<div class='container'>
	<div class='row  sec-room'>
		<div class='col-sm-12'>
			<div>
				<div class='col-sm-6'>
					<div class='kotak-table'  style='height:300px;' >
						<div class='in-kotak-table'>
							<div class='text-center'>
								<img src='<?=base_url()?>uploads/<?=$website['soundroombanner'];?>' class=' ' style='width:80%;'>
							</div>
						</div>
					</div>
				</div>
				<div class='col-sm-6'>
					<div class='kotak-table'  style='height:300px;' >
						<div class='in-kotak-table'>
							<div class='inads'>
								<h3 class='text-blue' style='font-weight:bold; font-family:din;'>
									Terbukti kan kalau band lo emang keren! Buktinya ada di dalam daftar ini. Udah siap manggung di
									Authenticity Space belum? Yuk ajak teman2 lo lagi untuk vote ya! Biar Impian lo jadi kenyataan. Band
									kamu yg belum terpilih jangan sedih ya. Tahun depan bakalan bisa ikut acara Authenticity yg gak
									kalah keren ...
									<br><br>
									<b><a href=''>Mechanism</a>
								</h3>

							</div>
						</div>
					</div>
				</div>
				<div class='cl'></div>
			</div>
		</div>
	</div>
	<div class='top5'>
		<div class="container-fluid">
			<h1 class='head-blue' style='margin:0px;'>
				3 Terbaik Pilihan Juri
			</h1>
		<br>
		<div class="row" >
		<?php
		$nv = 0;
		$okvote = "";
		$class = "col-md-5th-1 col-sm-4 col-md-offset-0 col-sm-offset-2";
		if(isset($soundroomtop) && count($soundroomtop) > 0){ foreach($soundroomtop as $row){
			$query = $this->db->query("SELECT COUNT(id_resource) as vote FROM `point` where id_resource='$row[id_soundroom]' and id_jenis_point='28'")->result_array();
			$total =  $query[0]['vote'];
			$total =  $row['votes5'];
			if(empty($this->datamember)){
				$vote = "btn-votelogin btn-blue ";
			}else{
				$qsudah = $this->db->query("SELECT COUNT(id_resource) as vote FROM `point` where id_resource='$row[id_soundroom]' and id_jenis_point='28' and id_member='".$this->datamember['id']."'")->result_array();
				$sudah =  $qsudah[0]['vote'];
				if($sudah > 0){
					$vote = "btn-votehave btn-red ";
				}else{
					$qbrp = $this->db->query("SELECT COUNT(id_resource) as vote FROM `point` where id_jenis_point='28' and id_member='".$this->datamember['id']."'  and date(created_date)=CURDATE() ")->result_array();
					$berapa =  $qbrp[0]['vote'];
					if($berapa=="2"){
						$vote = "btn-blue btn-votemax";
					}else{
						$vote = "btn-blue btn-vote5";
						$okvote = "ok";
					}
				}
			}
			if($nv>0){
				$class="col-md-5th-1 col-sm-4";
			}
			echo"
			<div class='$class '>
				<div class='box-soundroom'>
					<div class='box-play'>
						<div class='frame' style=\"display:block;background:url('".base_url()."uploads/soundroom/$row[thumbnail]') center no-repeat; background-size:cover;\">
							<div class='helper'></div>
						</div>
						<div class='overlay-play'>
							<!--<a href='javascript:void(0);' id='play-$row[id_soundroom]' onClick=\"togglePlay5()\" class='icon' data-audio='a-$row[id_soundroom]' data-band='$row[slug]' data-progress='prog-$row[id_soundroom]'><i class='fa fa-play' ></i> </a>-->
							<a href='javascript:void(0);' id='play-$row[id_soundroom]' class='icon' onClick=\"jumpPlay('$row[id_soundroom]')\"><i class='fa fa-play' ></i> </a>
						</div>
						<audio class='audio5' id='a-$row[id_soundroom]' src='".base_url()."uploads/soundroom/$row[sound]'></audio>
						<div class='progress-play' id='prog-$row[id_soundroom]'></div>
						<div class='progress-srek'></div>
					</div>
					<div class='soundroom-data'>
						<h1><a href='".base_url()."soundroom/$row[slug]'>$row[judul]</a></h1>
						<h2 class='d-none'>$row[kota]<br><b><span id='tot-$row[id_soundroom]'>$total</span> Votes</b></h2>
					</div>
					<div class='row d-none'>
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
			</div>
		</div>
	</div>
	<br><br>
	<h1 class='head-blue filter'>
		<div class='row'>
			<div class='col-sm-3' style='padding-top:22px;'>
				Playlist All Participants
			</div>
			<!--<div class='col-sm-3'>
				<div align='center' style='padding-top:22px;'>
					<i class='fa fa-search'></i>
					Cari ...
				</div>
			</div>-->
			<div class='col-sm-9'>
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
		<div class='col-sm-9'>
			<div class='playlist-all'>
				<table width='100%' cellpadding='0' cellspacing='0' class='thead'>
					<tr>
						<th width='150'><div align='center'>No.</div></th>
						<th>Name</th>
						<th width='230'><div align='center'>Play</div></th>
					</tr>
				</table>
				<div class='divtbody' id='divtbody'>
					<div id='listtableplay' align='center'>Please Wait ...</div>
				</div>
			</div><br><br>
		</div>
		<div class='col-sm-3'>
			<div id='currentPlay'></div>
		</div>
	</div>
	<h1 class='head-blue filter'>
		<div class='row'>
			<div class='col-sm-3' style='padding-top:22px;'>
				Video
			</div>
		</div>
	</h1>
	<?php
		if(count($video)>0){
	?>
	<div class='row'>
		<div class='col-sm-10 col-sm-offset-1'>
			<br>
			<div class="embed-responsive embed-responsive-16by9">
				<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?=$video['youtube'];?>?rel=0&controls=1&showinfo=0&html5=1&autoplay=0"></iframe>
			</div>
			<br>
			<div style='font-weight:bold; color: #0053A0;font-size:18px; font-family:dinl;'>
				<?=$video['judul'];?>
			</div>
			<br>
			<br>
			<div align='center' style='font-weight:bold; text-decoration:underline; font-size:20px; font-family:dinbold;'>
				<a href='<?=base_url();?>soundroom-video'>Lihat Semua Video</a>
			</div>
			<br>
		</div>
	</div>
	<?php }?>
</div>
<audio id='audio' src=''></audio>
<div class='soundbar'>
	<div class='row'>
		<div class='col-sm-2'>
			<table width='100%' cellpadding='0' cellspacing='0'>
				<tr>
					<td ><img class='img-soundbar' height='70'></td>
					<td width='100%'>
						<div class='namaband-soundbar'></div>
						<div class='kota-soundbar'></div>
					</td>
				</tr>
			</table>
		</div>
		<div class='col-sm-4'>
			<table width='100%' cellpadding='0' cellspacing='0' class='icon-soundbar'>
				<tr>
					<td width='16%'>
						<a href='javascript:void(0);' class='sb-random onof disabled' data-type='suffle'><i class='fa fa-random'></i></a>
					</td>
					<td width='16%'>
						<a href='javascript:void(0);' class='sb-backward'><i class='fa fa-step-backward'></i></a>
					</td>
					<td width=''>
						<a href='javascript:void(0);' class='sb-playpause' data-audio="" data-progress1="" data-band=""><i class='fa fa-play'></i></a>
					</td>
					<td width='16%'>
						<a href='javascript:void(0);' class='sb-forward'><i class='fa fa-step-forward'></i></a>
					</td>
					<td width='16%'>
						<a href='javascript:void(0);' class='sb-repeat onof' data-type='repeat'><i class='fa fa-repeat'></i></a>
					</td>
					<td width='16%'>
						<a href='javascript:void(0);' class='sb-heart disabled'><i class='fa fa-heart'></i></a>
					</td>
				</tr>
			</table>
		</div>
		<div class='col-sm-2'>
			<div class="slidecontainer">
				<input id="vol-control"  class="slider"  type="range" min="0" max="100" step="1" value='50' oninput="SetVolume(this.value)" onchange="SetVolume(this.value)"></input>
			</div>
		</div>
		<div class='col-sm-4'>
			<div id='timedur' style='margin-top:20px; color:#FFFFFF;float:right;margin-left:10px;'>
				00:00
			</div>
			<div class="slidecontainer" style='width:85%;float:right'>
				<input id="srek-control"  class="slider"  type="range" min="0" max="100" step="1" value='0' oninput="SetSrek(this.value)" onchange="SetSrek(this.value)"></input>
			</div>
			<div id='timecur' style='margin-top:20px; color:#FFFFFF;float:right;margin-right:10px;'>
				00:00
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
<input type='hidden' id='repeat' value='1'>
<input type='hidden' id='suffle' value='0'>
<input type='hidden' id='pl-list' value=''>
<input type='hidden' id='pl-now' value='1'>
<input type='hidden' id='pl-done' value='0'>
<?php $this->load->view('front/soundroom-footer');?>
<script>
function sToTime(t) {
	if(isNaN(t)){
		return "00:00";
	}else{
		return padZero(parseInt((t / (60)) % 60)) + ":" + padZero(parseInt((t) % 60));
	}
}
function padZero(v) {
  return (v < 10) ? "0" + v : v;
}
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
    function SetVolume(val)
    {
        var player = document.getElementById('audio');
        player.volume = val / 100;
    }
    function SetSrek(val)
    {
        var player = document.getElementById('audio');
		var to = (val  * player.duration)/100;
        player.currentTime  = to;
    }

	function soundbar(slug,band,kota,img,loved){
		$('.soundbar').show();
		$('.img-soundbar').attr('src',img);
		$('.namaband-soundbar').html(band);
		$('.kota-soundbar').html(kota);
		$('.sb-heart').addClass('disabled');
		if(loved=="true"){
			$('.sb-heart').removeClass('disabled');
			$('.sb-heart').addClass('onof');
		}
	}
	function togglePlay5 (e) {

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
	function currentplaytop5(dis){
		var band = $(dis).attr('data-band');
		var dataform = new FormData();
		dataform.append('<?php echo $this->security->get_csrf_token_name(); ?>', '<?php echo $this->security->get_csrf_hash(); ?>');
		dataform.append('band', band);
		$.ajax({
			url: '<?=base_url()?>soundroom/getBand',
			type: "POST",
			data: dataform,
			dataType: "json",
			contentType: false,
			processData: false,
			beforeSend: function () {

			},
			error: function () {
				//$('#currentPlay').html('Failed..!!');
			},
			success: function (e) {
				if(e.status=="true"){
					$('#currentPlay').html(e.html);
					soundbar(e.slug,e.namaband,e.kota,e.img,e.loved);
					togglePlay(dis,"data-progress",e.slug,e.namaband,e.kota,e.img,e.loved);
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
				}else{
					//$('#currentPlay').html('No data..!!');
				}
			}
		});

	}
	function currentplaytop(dis){
		var band = $(dis).attr('data-band');
		var dataform = new FormData();
		dataform.append('<?php echo $this->security->get_csrf_token_name(); ?>', '<?php echo $this->security->get_csrf_hash(); ?>');
		dataform.append('band', band);
		$.ajax({
			url: '<?=base_url()?>soundroom/getBand',
			type: "POST",
			data: dataform,
			dataType: "json",
			contentType: false,
			processData: false,
			beforeSend: function () {

			},
			error: function () {
				$('#currentPlay').html('Failed..!!');
			},
			success: function (e) {
				if(e.status=="true"){
					$('#currentPlay').html(e.html);
					soundbar(e.slug,e.namaband,e.kota,e.img,e.loved);
					togglePlay(dis,"data-progress1",e.slug,e.namaband,e.kota,e.img,e.loved);
					var myElement = document.getElementById('play-' + band);
					var topPos = myElement.offsetTop - 100;
					$(".divtbody").animate({
						scrollTop: topPos
					});
					var btn = myElement.childNodes;
					//$( "#play-" +band + " .playno a i").attr( "class", "fa fa-pause" );
					klik(band);
					$('.klikplaylist').removeClass('curractive');
					$('.play-'+band).addClass('curractive');
				}else{
					$('#currentPlay').html('No data..!!');
				}
			}
		});

	}


	window.setInterval(function(){
		if($('#pl-done').val()=="1"){
			nextpl();
		}
	}, 1000);
	function nextpl(){
		var plnow = $('#pl-now').val();
		var pllist = $('#pl-list').val();
		$('.pl-'+plnow).find('i').attr('class','fa fa-play');
		if($('#repeat').val()=="1"){
			if($('#suffle').val()=="0"){
				var plus = eval(plnow)+1;
				if(plus>eval(pllist)){}else{
					$('.pl-'+plus).trigger('click');
				}
			}else{
				var rand = Math.floor(Math.random() * pllist) + 1;
				$('.pl-'+rand).trigger('click')
			}
			$('.sb-playpause').find('i').attr('class','fa fa-play');
		}
	}
	function playpause(){
		var cur = document.getElementById("pl-done").value;
		if(cur=="1"){
			document.getElementById("pl-done").value = "0";
		}else{
			document.getElementById("pl-done").value = "1";
		}
	}
	function togglePlay (e,progresss,slug,band,kota,img,loved) {
		soundbar(slug,band,kota,img,loved);
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
		var beforeplay = document.getElementsByClassName('pl-'+plke);

		beforeplay[0].childNodes[0].className='fa fa-play';
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
			increment = 10/duration;
			percent = Math.min(increment * element.currentTime * 10, 100);
			progress.style.width = percent+'%'
			startTimer(duration, element);
			var srek = document.getElementById('srek-control');
			srek.value = percent;
		}
		var startTimer = function(duration, element){
			if(percent < 100) {
				timer = setTimeout(function (){advance(duration, element)}, 100);

			}
		}
		var soundbarplaypause = document.getElementsByClassName('sb-playpause');
		var listnow = document.getElementsByClassName('pl-'+datanow);

		soundbarplaypause[0].setAttribute('data-progress1',dataprogress);
		soundbarplaypause[0].setAttribute('data-audio',dataaudiosoundroom);
		soundbarplaypause[0].setAttribute('data-band',slug);

		if (soundbarplaypause[0].childNodes[0].className=='fa fa-pause') {
			soundbarplaypause[0].childNodes[0].className='fa fa-play';
			listnow[0].childNodes[0].className='fa fa-play';
			audio.pause();
		} else {
			var player = document.getElementById('audio');
			player.volume = 50 / 100;
			var playerseek = document.getElementById('audio');
			//playerseek.seekable.end(0);
			soundbarplaypause[0].childNodes[0].className='fa fa-pause';
			listnow[0].childNodes[0].className='fa fa-pause';
			audio.play();
		}


	}
	function klik(band){
		$('.klikplaylist').removeClass('active');
		$('.play-'+band).addClass('active');
		$('.noindex').show();
		$('.noindex-'+band).hide();
		$('.playno').removeAttr('style');
		$('.playno-'+band).attr('style','display:inline-block !important;');

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
	function jumpPlay(ke){
		$('.sb-playpause').find('i').attr('class','fa fa-play');
		if($('#filter').val()=='kota'){
			$('#provinsi').hide();
			$('#kota').hide();
			$('#load-more').show();
			load(ke,'ALL','ALL','ALL');
		}else{
			$('.idpl-'+ke).trigger('click');
		}
		var myElement = document.getElementsByClassName('filter');
		var topPos = myElement.offsetTop - 100;
		$('html, body').animate({
			scrollTop: ($("#filter").offset().top)-110
		}, 1000);

	}
	function load(ke,kota,start,end){
		var dataform = new FormData();
		dataform.append('<?php echo $this->security->get_csrf_token_name(); ?>', '<?php echo $this->security->get_csrf_hash(); ?>');
		dataform.append('kota', kota);
		dataform.append('start', start);
		dataform.append('end', end);
		$.ajax({
			url: '<?=base_url()?>soundroom/getPlayList',
			type: "POST",
			data: dataform,
			dataType: "json",
			contentType: false,
			processData: false,
			beforeSend: function () {

			},
			error: function () {
				$('#listtableplay').html('Failed..!!');
			},
			success: function (e) {
				if(e.status=="true"){
					$('#listtableplay').html(e.html);
					if(ke!='0'){
						$('.idpl-'+ke).trigger('click');
					}else{
						$('.bp1').trigger('click');
					}
					$('#pl-list').val(e.pl);
					$('#pl-now').val('1');
					$('#pl-done').val('0');
					//$('.soundbar').hide();
					pauseAll();
				}else{
					$('#listtableplay').html('No data..!!');
				}
			}
		});
	}
$(document).ready(function () {

	//$('.soundbar').hide();

	$(".sb-playpause").click(function(){
		var idaudio = $('#audio');
		var plnow = $('#pl-now').val();
		var pllist = $('#pl-list').val();
		$('.pl-'+plnow).trigger('click');
	});
	$('.sb-backward').click(function(){
		var idaudio = $('#audio');
		var plnow = $('#pl-now').val();
		var pllist = $('#pl-list').val();
		$('.sb-playpause').find('i').attr('class','fa fa-play');
		if($('#suffle').val()=="0"){
			var min = eval(plnow)-1;
			if(min<1){}else{
				$('.pl-'+min).trigger('click');
			}

		}else{
			var rand = Math.floor(Math.random() * pllist) + 1;
			$('.pl-'+rand).trigger('click');
		}

	});
	$('.sb-forward').click(function(){
		var idaudio = $('#audio');
		var plnow = $('#pl-now').val();
		var pllist = $('#pl-list').val();
		$('.sb-playpause').find('i').attr('class','fa fa-play');
		if($('#suffle').val()=="0"){
			var plus = eval(plnow)+1;
			if(plus>eval(pllist)){}else{
				$('.pl-'+plus).trigger('click');
			}
		}else{
			var rand = Math.floor(Math.random() * pllist) + 1;
			$('.pl-'+rand).trigger('click')
		}
	});
	$('.onof').click(function(){
		var klas = $(this).attr('class');
		var type = $(this).attr('data-type');
		if(klas.indexOf("disabled") != -1){
			$(this).removeClass("disabled");
			$('#'+type).val(1);
		}else{
			$(this).addClass("disabled");
			$('#'+type).val(0);
		}
	});

	load("0",'ALL','ALL','ALL');

	function currentplay(band){
		var dataform = new FormData();
		dataform.append('<?php echo $this->security->get_csrf_token_name(); ?>', '<?php echo $this->security->get_csrf_hash(); ?>');
		dataform.append('band', band);
		$.ajax({
			url: '<?=base_url()?>soundroom/getBand',
			type: "POST",
			data: dataform,
			dataType: "json",
			contentType: false,
			processData: false,
			beforeSend: function () {

			},
			error: function () {
				$('#currentPlay').html('Failed..!!');
			},
			success: function (e) {
				if(e.status=="true"){
					$('#currentPlay').html(e.html);
					//soundbar(e.namaband,e.kota,e.img,e.loved);
				}else{
					$('#currentPlay').html('No data..!!');
				}
			}
		});

	}
	$(document).on("click", '.klikplaylist', function() {
		var no = $(this).attr('data-no');
		var band = $(this).attr('data-band');
		klik(band);
		currentplay(band);
	});
	$(document).ready(function () {
		//
		if($('#filter').val()=='vote'){
			$('#provinsi').hide();
			$('#kota').hide();
		}
		$('#filter').change(function(){
			var val = $(this).val();
			if(val=="vote"){
				$('#provinsi').hide();
				$('#kota').hide();
				$('#load-more').show();
				load("0",'ALL','ALL','ALL');
			}else{
				$('#provinsi').show();
				$('#kota').show();
			}
		});
		$('#kota').change(function(){
			var next = 'ALL';
			var kota = $(this).val();
			load("0",kota,'12',next);
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
	});
	$('.tes').click(function(){
		var myElement = document.getElementById('play-30');
		var topPos = myElement.offsetTop - 100;
		$(".divtbody").animate({
			scrollTop: topPos
		});
		//klik(30);
	});
});




		$(document).on("click", '.btn-votelogin', function() {
		//$('.btn-votelogin').click(function(){
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
		$(document).on("click", '.btn-votehave', function() {
		//$('.btn-votehave').click(function(){
			$('#votenotif').modal('show');
			$('#votenotif .notif').html('<h3>You have voted for this contestant!</h3>');
			var part = $(this).attr('data-res');
			getsoundroom(part,"part-share");
		});
		$(document).on("click", '.btn-votemax', function() {
		//$('.btn-votemax').click(function(){
			$('#votenotif').modal('show');
			$('#votenotif .notif').html('<h3>The vote limit is only 2 times today!</h3>');
			var part = $(this).attr('data-res');
			getsoundroom(part,"part-share");
		});
		$(document).on("click", '.btn-vote', function() {
		//$('.btn-vote').click(function(){
			var x = $(this).attr('data-res');
			$('#votemodal .btn-x').attr('data-x',x);
			$('#votemodal').modal('show');
			var part = $(this).attr('data-res');
			getsoundroom(part,"part-share");
		});
		$(document).on("click", '.btn-vote5', function() {
			var x = $(this).attr('data-res');
			$('#votemodal .btn-x').attr('data-x',x);
			$('#votemodal .btn-x').attr('dtp',x);
			$('#votemodal').modal('show');
			var part = $(this).attr('data-res');
			getsoundroom(part,"part-share");
		});
		$(document).on("click", '.btn-x', function() {
		//$('.btn-x').click(function(){
			var dataform = new FormData();
			var attr = $(this).attr('dtp');
			if (typeof attr !== typeof undefined && attr !== false) {
				dataform.append('dtp', attr);
			}else{
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

		});
		<?php }?>
</script>
