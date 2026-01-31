
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
.box-soundroom .progress-srek {
    width: 100%;
    height: 5px;
    background: #FF0020;
    position: relative;
    z-index: 0;
    margin-top: -5px;
}
</style>
<div class='min-height'>
	<br><br>
	<div class='container'>
		<h1 class='head-blue'>
			<div class='row'>
				<div class='col-sm-4'>
					Playlist All Participants
				</div>
				<div class='col-sm-8'>
					<div class='right-filter'>
						Urut Berdasarkan : <b>
						<select id='filter1' style='padding:3px 6px; cursor:pointer;margin-top:5px;'>
							<option value='vote'>Voting Tertinggi</option>
							<option value='kota'>Kota</option>
						</select>
						<select id='provinsi1' style='padding:3px 6px; cursor:pointer;margin-top:5px;'>
							<option value=''>--</option>
							<?php
								if(isset($provinsi) && count($provinsi) > 0){ foreach($provinsi as $row){
									if($row['provinsi']!="-"){
										echo "<option value='$row[provinsi]'>$row[provinsi]</option>";
									}
								}}
							?>
						</select>
						<select id='kota1' style='padding:3px 6px; cursor:pointer;margin-top:5px;'>
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
					<div id='listtableplay1' align='center'>Please Wait ...</div>
				</div>
			</div><br><br>
		</div>
		<div class='col-sm-3'>
			<div id='currentPlay'></div>
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
		<div id='listtableplaystatus'></div>
		<div id='listtableplay'>Please wait...</div>

			<br>
			<div class='cl'></div>
			<div class='col-sm-4 col-sm-offset-4'>
				<a href='javascript:void(0);' id='load-more' data-next='1' data-kota='ALL' class='btn btn-md btn-block btn-load-more'>LOAD MORE</a>
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
<audio id='audio' src=''></audio>
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
					togglePlay1(dis);
					var myElement = document.getElementById('play-' + band);
					var topPos = myElement.offsetTop - 100;
					$(".divtbody").animate({
						scrollTop: topPos
					});
					var btn = myElement.childNodes;
					$( "#play-" +band + " .playno a i").attr( "class", "fa fa-pause" );
					klik(band);
					$('.klikplaylist').removeClass('curractive');
					$('.play-'+band).addClass('curractive');
				}else{
					$('#currentPlay').html('No data..!!');
				}
			}
		});

	}
	function togglePlay1 (e) {
		//e = e || window.event;
		var btn = e.childNodes;
		var dataprogress = e.getAttribute('data-progress1');
		var dataaudiosoundroom = e.getAttribute('data-audio1');
		var mp3 = e.getAttribute('data-audio');
		var audio = document.getElementById('audio');
		var timer;
		var percent = 0;
		var allaudio = document.getElementsByTagName("audio");
		audio.src = mp3;
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
		if (btn[0].className=='fa fa-pause') {
			btn[0].className='fa fa-play';
			while (i--) {
				allaudio[i].pause();
			}
			while (ic--) {
				allicon[ic].className= "fa fa-pause";
			}
			btn[0].className='fa fa-play';
			audio.pause();
		} else {
			while (i--) {
				allaudio[i].pause();
			}
			while (ic--) {
				allicon[ic].className= "fa fa-play";
			}
			btn[0].className='fa fa-pause';
			audio.play();
		}

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

	function load(diappend,kota,start,end){
		var dataform = new FormData();
		dataform.append('<?php echo $this->security->get_csrf_token_name(); ?>', '<?php echo $this->security->get_csrf_hash(); ?>');
		dataform.append('kota', kota);
		dataform.append('start', start);
		dataform.append('end', end);
		$.ajax({
			url: '<?=base_url()?>soundroom/getPlayList2',
			type: "POST",
			data: dataform,
			dataType: "json",
			contentType: false,
			processData: false,
			beforeSend: function () {
				$('#listtableplaystatus').html('');
				$('#load-more').show();
			},
			error: function () {
				$('#listtableplaystatus').html('Failed..!!');
			},
			success: function (e) {
				if(e.status=="true"){
					if(diappend=="html"){
						$('#listtableplay').html(e.html);
					}else{
						$('#listtableplay').append(e.html);

					}
					$('#load-more').attr('data-next',e.next);
					$('#load-more').attr('data-kota',e.kota);
				}else{
					$('#listtableplaystatus').html(e.pesan);
					$('#load-more').hide();
				}
			}
		});
	}
	function load1(kota,start,end){
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
				$('#listtableplay1').html('Failed..!!');
			},
			success: function (e) {
				if(e.status=="true"){
					$('#listtableplay1').html(e.html);
					//$('.bp1').click();
				}else{
					$('#listtableplay1').html('No data..!!');
				}
			}
		});
	}
	function klik(band){
		$('.klikplaylist').removeClass('active');
		$('.play-'+band).addClass('active');
		$('.noindex').show();
		$('.noindex-'+band).hide();
		$('.playno').removeAttr('style');
		$('.playno-'+band).attr('style','display:inline-block !important;');

	}
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
	$(document).on('ready', function() {
		load('html','ALL','ALL','ALL');
		load1('ALL','ALL','ALL');


		$('#load-more').click(function(){
			var next = $(this).attr('data-next');
			var kota = $(this).attr('data-kota');
			load('append',kota,'12',next);
		});
		$('#kota').change(function(){
			var next = 'ALL';
			var kota = $(this).val();
			load('html',kota,'12',next);
		});
		$('#kota1').change(function(){
			var next = 'ALL';
			var kota = $(this).val();
			load1(kota,'12',next);
		});
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
		//togglePlay2("play-<?=$detil['id_soundroom'];?>","a-<?=$detil['id_soundroom'];?>","prog-<?=$detil['id_soundroom'];?>");
		$('html, body').animate({
			scrollTop: $("#topart").offset().top
		}, 1000);

		<?php }?>
	});



		$('#provinsi1').hide();
		$('#kota1').hide();
		$('#filter1').change(function(){
			var val = $(this).val();
			if(val=="vote"){
				$('#provinsi1').hide();
				$('#kota1').hide();
			}else{
				$('#provinsi1').show();
				$('#kota1').show();
			}
		});


		$('#provinsi').hide();
		$('#kota').hide();
		$('#filter').change(function(){
			var val = $(this).val();
			if(val=="vote"){
				$('#provinsi').hide();
				$('#kota').hide();
				$('#load-more').show();
				load('html','ALL','ALL','ALL');
			}else{
				$('#provinsi').show();
				$('#kota').show();
			}
		});

		$('#provinsi1').change(function(){
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
					$('#kota1 option').remove();
					$('#kota1').append($("<option></option>").attr("value","").text("--"));
					var dats = e.data;
					$.each(dats, function(i, item) {
						var ids = item.id_kota;
						var kotas = item.kota;
						$('#kota1').append($("<option></option>").attr("value",ids).text(kotas));
					});
				}
			});

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

