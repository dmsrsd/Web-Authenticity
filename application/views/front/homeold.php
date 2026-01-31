<link href="<?php echo base_url()?>assets/front/css/fade.css?r=<?=rand();?>" rel="stylesheet" />
<div class='min-height scroll-animations'>
	<div class='container'>
		<div class='row no-gutters'>
			<div class='col-md-12  ' style='margin-bottom:15px;'>

				<div class="carousel fade-carousel slide carousel-fade" data-ride="carousel" data-interval="4000" id="bs-carousel">
					<ol class="carousel-indicators">
						<?php
							$nos = 0;
							if(isset($slide) && count($slide) > 0){ foreach($slide as $row){
								if($nos ==0){$ac="active";}else{$ac="";}
								echo "<li data-target='#bs-carousel' data-slide-to='$nos' class='$ac'></li> ";
								$nos++;
							}}
						?>
					</ol>

					<div class="carousel-inner">
						<?php
							$nos2 = 0;
							if(isset($slide) && count($slide) > 0){ foreach($slide as $row){
								if($nos2 ==0){$ac="active";}else{$ac="";}
								if($row['status_youtube']=="1"){
									$attra="  data-video='https://www.youtube.com/embed/$row[youtube]' data-keyboard='false'   data-backdrop='static' data-toggle='modal' data-target='#videoModal'";
									$adtc = "btn-play";
									$adts = "cursor:pointer;";
									$ovr = "";
								}else{
									$adtc = "";
									$adts = "";
									$attra="href='$row[url]'";
									$ovr = "<div class='overlay'></div>";
								}
								echo "
								<div class='item slides $ac'>
									<div class='slide-obj $adtc ' style=\"background-image:url('".base_url()."uploads/slide/$row[image]'); $adts\" $attra>
										$ovr
									</div>
									<div class='hero'>
										<hgroup>
											<a $attra class='$adtc'>
												<h3>$row[judul] </h3>
												<h1>$row[judul2] </h1>
												<h4>$row[judul3] </h4>
											</a>
										</hgroup>
									</div>
								</div>
								";
								$nos2++;
							}}
						?>

					</div>
				</div>
				<div class=" duplicate-slide carousel fade-carousel slide carousel-fade" data-ride="carousel" data-interval="4000" id="bs-carousel2">
					<div class="carousel-inner">
						<?php
							$nos3 = 0;
							if(isset($slide) && count($slide) > 0){ foreach($slide as $row){
								if($nos3 ==0){$ac="active";}else{$ac="";}
								if($row['status_youtube']=="1"){
									$attra="href='javascript:void(0);'  data-video='https://www.youtube.com/embed/$row[youtube]' data-keyboard='false'  data-backdrop='static' data-toggle='modal' data-target='#videoModal'";
									$obs=" height:30px";
									$adtc = "btn-play";
								}else{
									$adtc = "";
									$attra="href='$row[url]'";
									$obs = "";
								}
								echo "
									<div class='item slides $ac'>
										<div class='slide-obj $adtc' style='background:#FFFFFF; $obs' $attra>
										</div>
										<div class='hero'>
											<a $attra class='$adtc'>
												<h3>$row[judul] </h3>
												<h1>$row[judul2] </h1>
												<h4>$row[judul3] </h4>
											</a>
											</hgroup>
										</div>
									</div>
								";
								$nos3++;
							}}
						?>

					</div>
				</div>
			</div>
			<div class='cl'></div>
		</div>
	</div>
	<div class='container'>
   <div class="modal modal-fullscreen fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	   <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <iframe width="100%" height="100%" src="" frameborder="0" allowfullscreen="allowfullscreen" frameBorder="0"></iframe>
        </div>
      </div>
    </div>
  </div>
  <?php
	//echo str_shuffle ( "anggi");
  ?>
    <div id="jumboCarousel" class="carousel slide " data-ride="carousel">


        <ol class="carousel-indicators ">
		<?php
			$not = 0;
			if(isset($ticket) && count($ticket) > 0){ foreach($ticket as $row){
				if($not ==0){$ac="active";}else{$ac="";}
				echo"
					<li data-target='#jumboCarousel' data-slide-to='$not' class='$ac'></li>
				";
				$not++;
			}}
		?>
        </ol>
      <div class="containers">
		<div class="carousel-inner" role="listbox" >
		<?php
			$not = 0;
			if(isset($ticket) && count($ticket) > 0){ foreach($ticket as $row){
				if($not ==0){$ac="active";}else{$ac="";}
					echo"
					<div class='item $ac'>
						<div class='row  bg-blue'>
							<div class='col-sm-6'>
								<!--<a href='".base_url()."ticket/buy/$row[slug]'>-->
								<a href='javascript:void(0);'>
									<img src='".base_url()."uploads/ticket/$row[image]' alt='$row[judul]' class='img-responsive desktop-image'>
									<img src='".base_url()."uploads/ticket/$row[image_mobile]' alt='$row[judul]' class='img-responsive mobile-image'>
								</a>
							</div>
							<div class='col-sm-6'>
								<div class='carousel-caption'>
									<div class='kotak-table' id='adsright'>
										<div class='in-kotak-table'>
											<div class='inads text-left'>
												<h1>$row[judul]</h1>
												<h2>$row[dimana] - ".namadate($row['tanggal'])."</h2>
												<!--<a href='".base_url()."ticket/buy/$row[slug]' onclick=\"alert('Coming Soon');\" class='button'>GET TICKET HERE</a>-->
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					";
				$not++;
			}}
		?>

        </div>

    </div>

      </div>
		<div class='row bg-blue no-gutter animatedParent hide'>
			<div class='col-sm-6 animated bounceInLeft'>
				<a href=''>
					<img src='<?=base_url()?>uploads/ads/adshome1city.jpg' class='img-responsive imgfull'>
				</a>
			</div>
			<div class='col-sm-6 animated bounceInRight'>
				<div class='kotak-table' id='adsright'>
					<div class='in-kotak-table'>
						<div class='inads'>
							<h3>AUTHENTIC MOMMENT WITH: EFEK RUMAH KACA, HIGWAY, LEONARDO.</h3>
							<a href='<?=base_url()?>ticket' target='_blank'>GET TICKET HERE</a>
						</div>
					</div>
				</div>
			</div>
			<div class='cl'></div>
		</div>
		<div class='batas'></div>
		<div class='row'>
			<div class='col-md-12'>
				<h1 class='head-section'>Article</h1>
			</div>
		</div>

		<div class='row row-artikel' style='margin-bottom:0px;'>
		<?php
		$noad = 1;
			if(isset($artikeladmin) && count($artikeladmin) > 0){ foreach($artikeladmin as $row){
				$head = "CLASSIFIED ".strtoupper($row['head_kategori']);
				$judul = substr($row['judul'],0,50)." ...";
				if($noad<=8){
				echo"
					<div class='col-md-3 col-sm-6 ' >
						<div class='box-article' >
							<div class='category'><a href='".base_url()."category/$row[head_kategori]/all'><b>$head</b></a> | <a href='".base_url()."category/$row[head_kategori]/$row[slugkat]'>".strtoupper($row['kategori'])."</a></div>
							<div class='product-div1'>
								<a href='".base_url()."read/$row[slug]' title='$row[judul]'><img src='".base_url()."uploads/article/$row[thumbnail]' class='img-responsive transition'> </a>
							</div>
							<div class='head'><a href='".base_url()."read/$row[slug]' title='$row[judul]'>$judul</a></div>
							<div class='desc'>".substr(strip_tags($row['deskripsi_singkat']),0,100)." ...</div>
						</div>
					</div>
				";
				}
				if($noad>=9){
					if($noad==9){
						echo "</div>";
						echo"
							<div class='row animatedParents sec-room'>
								<div class='col-sm-12'>
									<div style=\"background:url('".base_url()."uploads/ads/bgsoundroom.gif') center no-repeat; background-size:cover\" class='desktop-image'>
										<div class='col-sm-7 animated bounceInLefts'>
											<div class='kotak-table'  style='height:300px;' >
												<div class='in-kotak-table'>
													<div class='text-center'> </div>
												</div>
											</div>
										</div>
										<div class='col-sm-5 animated bounceInRights'>
											<div class='kotak-table'  style='height:300px;'  >
												<div class='in-kotak-table'>
													<div class='inads'>
														<h3 class='text-blue'>Waktunya berkolaborasi dengan mengunggah karya musik otentik lo di Authenticity Soundroom</h3>
														<a class='text-blue' href='".base_url()."soundroom' >MORE INFO</a>
													</div>
												</div>
											</div>
										</div>
										<div class='cl'></div>
									</div>
									<div style=\"background:url('".base_url()."uploads/ads/bgsoundroom-mobile.gif') center top no-repeat; background-size:cover\" class='mobile-image'>
										<div class='col-sm-7 animated bounceInLefts'>
											<div class='kotak-table'  style='height:280px !important;' >
												<div class='in-kotak-table'>
													<div class='text-center'></div>
												</div>
											</div>
										</div>
										<div class='col-sm-5 animated bounceInRights'>
											<div class='kotak-table'  >
												<div class='in-kotak-table'>
													<div class='inads'>
														<h3 class='text-blue'>Waktunya berkolaborasi dengan mengunggah karya musik otentik lo di Authenticity Soundroom</h3>
														<a class='text-blue' href='".base_url()."soundroom' >MORE INFO</a>
													</div>
												</div>
											</div>
										</div>
										<div class='cl'></div>
									</div>
								</div>
								<div class='cl'></div>
							</div>
						";
						echo "<div class='row row-artikel'>";
					}

					echo"
					<div class='col-md-3 col-sm-6 ' >
						<div class='box-article' >
							<div class='category'><a href='".base_url()."category/$row[head_kategori]/all'><b>$head</b></a> | <a href='".base_url()."category/$row[head_kategori]/$row[slugkat]'>".strtoupper($row['kategori'])."</a></div>
							<div class='product-div1'>
								<a href='".base_url()."read/$row[slug]' title='$row[judul]'><img src='".base_url()."uploads/article/$row[thumbnail]' class='img-responsive transition'> </a>
							</div>
							<div class='head'><a href='".base_url()."read/$row[slug]' title='$row[judul]'>$judul</a></div>
							<div class='desc'>".substr(strip_tags($row['deskripsi_singkat']),0,100)." ...</div>
						</div>
					</div>
					";

				}
			$noad++;
			}
			}
		?>

		</div>

		<div class='cl'></div>
		<!--<div class='row row-artikel'>
		<?php
			/*if(isset($artikelmember) && count($artikelmember) > 0){ foreach($artikelmember as $row){
				$head = "CLASSIFIED ".strtoupper($row['head_kategori']);
				echo"
					<div class='col-md-3 col-sm-6 ' >
						<div class='box-article' >
							<div class='category'><a href='".base_url()."category/$row[head_kategori]/all'><b>$head</b></a> | <a href='".base_url()."category/$row[head_kategori]/$row[slugkat]'>".strtoupper($row['kategori'])."</a></div>
							<div class='product-div1'>
								<a href='".base_url()."read/$row[slug]'><img src='".base_url()."uploads/article/$row[thumbnail]' class='img-responsive transition'></a>
							</div>
							<div class='head'><a href='".base_url()."read/$row[slug]'>$row[judul]</a></div>
							<div class='desc'>".substr(strip_tags($row['deskripsi_singkat']),0,100)." ...</div>
						</div>
					</div>
				";
			}}*/
		?>
		</div>-->
		<div class='cl'></div>
		<div class='row'>
			<div class='col-md-12'>
				<div class='text-center'>
					<a href='<?=base_url();?>article' class='btn btn-readmore'>Read More</a>
				</div>
			</div>
		</div>
	</div>
</div>
<!--<section class='contributor'>
	<div class='container'>
		<h1>Authentic Contributors</h1><br>
		<div class='row'>
			<?php
			if(isset($kontributor) && count($kontributor) > 0){ foreach($kontributor as $row){
				echo "
				<div class='col-md-3 col-sm-6 col-xs-6'>
					<div align='center'>
						<img src='".base_url()."uploads/contributor/$row[image]' class='img-responsive'>
					</div>
					<br>
					<h2><a href='".base_url()."contributor/$row[slug]'>$row[nama]</a></h2>
					<p>$row[deskripsi]</p>
					<br>
				</div>
				";
			}}
			?>

		</div>
	</div>
</section>-->
<?php $this->load->view('front/podcast/footerfp');?>
<script>
	$(document).on('ready', function() {
		var h = $(window).height();

		$(".btn-play").click(function () {
			var theModal = $(this).data("target"),
			videoSRC = $(this).attr("data-video"),
			videoSRCauto = videoSRC + "?modestbranding=0&rel=0&controls=0&showinfo=0&html5=1&autoplay=1",
			videolas = videoSRC + "?rel=0&controls=1&showinfo=0&html5=1&autoplay=1";
			$(theModal + ' iframe').attr('src', videolas);
			$(theModal + ' iframe').attr('height', h-120);
			$(theModal + ' button.close').click(function () {
				$(theModal + ' iframe').attr('src', videoSRC);
			});
		});

		$('.carousel').carousel({
			pause: "false"
		});
        $('.carousel-indicators li').on('click', function() {
            $('#bs-carousel2').carousel(parseInt($(this).attr('data-slide-to')));
            $(this).addClass('active');
        });
		var w = $(window).width();
		/*
		if(h<768){
			height = 200;
		}else{
			var img = document.getElementById('adsfoto');
			var width = (img.clientWidth );
			var height = (img.clientHeight );
		}
		$("#adsright").attr("style","height:"+height+"px");
		$(window).on('resize', function(){
			var h = $(window).width();
			if(h<768){
				height = 200;
			}else{
				var img = document.getElementById('adsfoto');
				var width = (img.clientWidth );
				var height = (img.clientHeight );
			}
			console.log(height);
			$("#adsright").attr("style","height:"+height+"px");
		});
		*/
	});
</script>
