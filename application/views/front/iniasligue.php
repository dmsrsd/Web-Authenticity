<link href="<?php echo base_url()?>assets/front/css/iniasligue.css" rel="stylesheet" />
<link href="<?php echo base_url()?>assets/front/css/designcompetition.css" rel="stylesheet" />
<style>



</style>
<div class='min-height page-iniasligue'>
	<div class="container-fluid">
        <div class="row no-gutter">
			<div class="col-sm-12">
				<div id="myCarousel" class="carousel slide" data-ride="carousel">
					<ol class="carousel-indicators">
						<?php
							$in=0;
							if(isset($slide) && count($slide) > 0){ foreach($slide as $row){
								$ac="";if($in==0){$ac="active";}
								echo "<li data-target='#myCarousel1' data-slide-to='$in' class='$ac'></li>";
								$in++;
							}}
						?>
					</ol>

					<div class="carousel-inner">
					<?php
						$in=0;
						if(isset($slide) && count($slide) > 0){ foreach($slide as $row){
							$ac="";if($in==0){$ac="active";}
							$url="javascript:void(0);";
							if($row['url']!=""){
								$url = $row['url'];
							}
							echo "
								<div class='item $ac '  >
									<a href='$url'><img src='".base_url()."uploads/iniasligue/$row[image]' alt='$row[judul]' style='width:100%;' class='img-desktop'>
									<img src='".base_url()."uploads/iniasligue/$row[image_mobile]' alt='$row[judul]' style='width:100%;' class='img-mobile'>
									</a>
								</div>

							";
							$in++;
						}}
					?>
						<!--<div class="item active">
							<img src="<?=base_url();?>uploads/iniasligue/slider-uus.png" alt="Los Angeles">
						</div>

						<div class="item active">
							<img src="<?=base_url();?>uploads/iniasligue/Live-Stream-Darbotz-Grey.jpg" alt="Chicago">
						</div>-->

						<!--<div class="item">
							<img src="<?=base_url();?>uploads/iniasligue/200404-Grid-BrandAmbassador.jpg" alt="New York">
						</div>-->
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

			</div>
        </div>
		<div class='topmenugue' style='z-index:1;'>
			<div class="row no-gutter hide">
				<div class="col-sm-2 col-sm-offset-1">
					<a href='javascript:void(0);' onclick="scrollto($(this),'darbotz')" class='link'>KREASI DONASI</a>
				</div>
				<div class="col-sm-2"><a href='javascript:void(0);' onclick="scrollto($(this),'article')" class='link'>ARTICLE</a></div>
				<div class="col-sm-2"><a href='javascript:void(0);' onclick="scrollto($(this),'article')" class='link'>ARTICLE</a></div>
				<div class="col-sm-2"><a href='javascript:void(0);' onclick="scrollto($(this),'berani')" class='link'>BERANI CERITA ASLI</a></div>
				<div class="col-sm-2"><a href='javascript:void(0);' onclick="scrollto($(this),'katague')" class='link'>INI ASLI KATA GUE</a></div>
				<div class="col-sm-2"><a href='javascript:void(0);' onclick="scrollto($(this),'suara')" class='link'>SUARA MEREKA</a></div>
			</div>
			<!--<div class="row no-gutter">
				<div class="col-sm-3"></div>
				<div class="col-sm-2"><a href='javascript:void(0);' onclick="scrollto($(this),'darbotz')" class='link'>KREASI DONASI</a></div>
				<div class="col-sm-2"><a href='javascript:void(0);' onclick="scrollto($(this),'article')" class='link'>ARTICLE</a></div>
				<div class="col-sm-2"><a href='javascript:void(0);' onclick="scrollto($(this),'soundroom')" class='link'>SOUNDROOM</a></div>
				<div class="col-sm-3"></div>
			</div>	-->
		</div>

		<div class="row bg-darbotz hide" id="darbotz">
			<div class='col-sm-6'>

			</div>
			<div class='col-sm-6'>
				<div class='kotak-table iag-darbotz'>
					<div class='in-kotak-table'>
						<h3 class='broken'><span style="font-size: 30px"><img src='<?=base_url();?>uploads/logo.png'/ width="200px"> X Darbotz</span> <br>
						KREASI DONASI BOX SET</h3>
						<div align='left'>
							<img src='<?=base_url();?>uploads/iniasligue/darbotz-package-set.png'/ width="100%">
						</div>
						<p style="font-size: 18px; font-weight: bold; color: #fff; background-color: #00579e; width: 74%; margin: 0 auto; padding:20px 0px;'">Dapatkan Limited Merchandise Authenticity X Darbotz <br> dan jadilah donatur untuk program kepedulian atas wabah covid 19</p>
						<br>
						<a class='btn btn-lg btn-red' href='<?=base_url();?>order/kreasi-donasi-box-set' style='width:300px;'>PRE ORDER</a>
					</div>
				</div>
			</div>
			<div class='col-sm-2'>
			</div>
		</div>
		<div class='row hide' style='padding:0px 0px; background-color: rgba(0,0,0,1.00); positon:inherit; z-index:0;'>
			<div class='container'>
				<div class='row'>
					<div class="col-sm-12">
						<a href='https://www.authenticity.id/authentic-store/' target='_self'><img src='https://www.authenticity.id/uploads/store/store_7521_auth_lab.jpg' style='width:100%'></a>
					</div>
				</div>
			</div>
		</div>
		<div class="row " id="article">
			<div class='container'>
				<div class='row'>
					<div class='col-sm-12'><h3 class='headiniasligue'>DENGAR <span>CERITA</span></h3></div>
				</div>
				<br>
				<br>
				<div class='row'>
				<?php
				$noad = 1;
				if(isset($artikeladmin) && count($artikeladmin) > 0){ foreach($artikeladmin as $row){
					$head = "CLASSIFIED ".strtoupper($row['head_kategori']);
					$judul = substr($row['judul'],0,50)." ...";
					$judul = $row['judul'];
					echo"
						<div class='col-sm-4' >
							<div class='product-div1 hide'>
								<img src='".base_url()."uploads/article/$row[thumbnail]' class='img-responsive transition articleimage'>
							</div>
							<div class='articletext transition' style='background:url(\"".base_url()."uploads/article/$row[thumbnail]\")'>
								<div class='inarticletext' >
									<div class='kotak-table'  style='height:460px;' >
										<div class='in-kotak-table'>
											<div class='text-center'>
												<div class='articlejudul'>$judul</div>
												<br><br>
												<a href='".base_url()."read/$row[slug]' title='$row[judul]' class='btn btn-md btn-red'>DETIL</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					";
					$noad++;
					}
				}
			?>
				</div>
			</div>
		</div>
		<br>
		<br>
		<div class="row " id="soundroom">
			<div class="container" >
			<?php

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
			?>
			</div>
		</div>
		<div class="row  hide" id="berani">

		</div>
		<div class="row  hide" id="katague">

		</div>
		<div class="row hide" id="suara">
		 <section class='contributor'>
			<div class='container'>
				<h1  align='center'>SUARA MEREKA</h1><br>
				<div class='row'>
					<?php
					if(isset($kontributor) && count($kontributor) > 0){ foreach($kontributor as $row){
						echo "
						<div class='col-md-4 col-sm-8 col-xs-8'>
							<div class='row'>
								<div class='col-md-12'>

								</div>
								<div class='col-sm-4'>
									<img src='".base_url()."uploads/contributor/$row[image]' class='img-responsive'>
								</div>
								<div class='col-sm-8'>
									<h2><a href='".base_url()."contributor/$row[slug]'>$row[nama]</a></h2>
									<p>$row[deskripsi]</p>
									<br>
								</div>
							</div>
							<br>
						</div>
						";
					}}
					?>

				</div>
			</div>
		</section>
		</div>
    </div>
</div>
<?php $this->load->view('front/podcast/footerfp');?>
<script>
	$(document).on('ready', function() {
		$('.carousel').carousel();


	});
	//$(function(){
		function scrollto(from,to){
			$('html, body').animate({
				scrollTop: $("#"+to).offset().top
			}, 300);
		}
	//});
</script>
