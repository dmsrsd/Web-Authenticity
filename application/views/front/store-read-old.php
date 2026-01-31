<style>
.navbar{
	margin-bottom:0px;
}

.navbar-default ~ .min-height, .navbar-default ~ .container {
	top: 0px;
}
.min-height{
	padding-top:0px;
	padding-bottom:0px;
}
.affix ~ .min-height, .affix ~ .container{
	top:0px;
}
@media screen and (max-width:767px){
	.affix ~ .min-height, .affix ~ .container {
		padding-bottom: 0px;
	}
	.page-product{
		margin-top:71px;
		padding-bottom: 0px;
	}

}
.slideproduct{
	background: rgba(255,255,255,1.00);
	/*background: linear-gradient(180deg, rgba(220,220,220,1) 32%, rgba(255,255,255,1) 100%);*/
	min-height:400px;
	padding:30px 30px 70px 30px;
	-moz-box-shadow:    0px 0px 15px 2px #636363;
	-webkit-box-shadow: 0px 0px 15px 2px #636363;
	box-shadow:         0px 0px 15px 2px #636363;
}
body{
	background:#FFFFFF;
}
.imgslide{
	margin:50px;
}
.carousel-control.left,
.carousel-control.right{
	background:none;
}
.carousel-indicators .active{
	background:#000000;
}
.carousel-indicators li{
	background:#CCCCCC;
}
.carousel-indicators{
	bottom:-50px;
}
.carousel-control{
	width:5%;
}
.glyphicon-chevron-left:before,
.glyphicon-chevron-right:before{
	color:#000000;
}
.slideproduct .judulslide{
	color:#014F99;
	font-size:35px;
	font-weight:bold;
	margin:15px 15px 25px 0px;
	font-family: oswaldm;
}
.slideproduct p{
	font-size:20px;
	color:#000000;
}
.buttonslide{

}
</style>
<div class='page-product' style="min-height:500px;background:url('<?=base_url()."uploads/store/$store[background]";?>') center top no-repeat; background-size:cover;">
	<div class='container'>
		<div class='row'>
			<div class='col-sm-offset-4 col-sm-4' align='center'>
				<br>
				<img src='<?=base_url()?>uploads/store/<?=$store['logo'];?>'  >
				<br>
			</div>
		</div>
		<br>
	</div>
</div>
<div class='container' style='margin-top:-200px;'>
	<?php //if(isset($product) && count($product) > 0){?>
	<div class="row">
		<div class="col-sm-12">
			<div class="slideproduct">
				<div id="myCarousel" class="carousel slide" data-ride="carousel">
					<ol class="carousel-indicators">
						<?php
							$in=0;
							if(isset($product) && count($product) > 0){
								foreach($product as $row){
									$ac="";if($in==0){$ac="active";}
									echo "<li data-target='#myCarousel1' data-slide-to='$in' class='$ac'></li>";
									$in++;
								}
							}
						?>
					</ol>

					<div class="carousel-inner">
					<?php
						$in=0;
						if(isset($product) && count($product) > 0){
							foreach($product as $row){
								$ac="";if($in==0){$ac="active";}
								$url="javascript:void(0);";
								$target="";
								if($row['url']!=""){
									$url = $row['url'];
									$target="target='_blank'";
								}
								echo "
									<div class='item $ac '  >
										<div class='row'>
											<div class='col-sm-6'>
												<div class='imgslide'>
													<img src='".base_url()."uploads/store/$row[image]' alt='$row[judul]' style='width:100%;'>
												</div>
											</div>
											<div class='col-sm-6'>
												<div class='judulslide'>
													$row[judul]
												</div>
												<p>
													$row[deskripsi]
												</p>
												<br>
												<br>
												<br>
												<a class='btn btn-lg btn-red' href='$url' $target>$row[button]</a><br><br>";

													if($row['button2']!=''){
														echo "<div class='row'>";
														$dec = json_decode($row['button2']);
														foreach($dec as $key=>$button2){

															echo"
															<div class='col-sm-3' align='center' style='margin:15px 0px;'>
																	<a href='".$button2->url."' target='_blank'>
																	<img src='".base_url()."uploads/store/".$button2->image."' class='' style='width:100%;'>
																	".$button2->button."
																	</a>
																<br>
															</div>
															";
														}
														echo "</div>";
													}
												echo"
												<br>
												<br>
											</div>
										</div>
									</div>

								";
								$in++;
							}
						}
					?>
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
	</div>
	<?php //}?>
</div>
<br><br>
<?php $this->load->view('front/podcast/footerfp');?>
<script>

	$(document).on('ready', function() {
	});
</script>
