<style>
.ticket-box .carousel-indicators{
	top:50%;
	z-index:0;
}
.carousel-caption p{
	margin:0px;
}
.carousel-caption h3{
	text-align:center;
}
.carousel-caption {
    right: auto;
    left: auto;
    padding-bottom: 30px;
    padding-top: 20px;
    position: relative;
	color:#0053A0;
	text-shadow: none;
	text-align:left;
}
</style>
<?php
	$item = $this->uri->segment(2);
	if($item!="item"){
		$col = "col-sm-6 col-sm-offset-3";
	}else{
		$col = "col-sm-6";
	}
?>
<?php
	$kudu ="";
	@$page = $this->uri->segment(1);
	if(empty($this->datamember)){
		$kudu = " kudu-login";
	}

?>
<!--<img src="https://www.authenticity.id/assets/front/img/bg_landing.jpg" style="width: 100%; ">-->
<div class='min-height ticket-box bg-tiket-pamit' style='min-height:844px; position: relative; top: -20px; padding-bottom: 0px'>
	<div class='container'>
		<div class="row text-center"><img src='<?php echo base_url()?>assets/front/img/kamipun_teks.png' style="width: 70%; margin-top: 30px"></div>
	</div>
</div>
<!--
<br><br><br>
<div class='min-height ticket-box' style='min-height:350px;'>
	<div class='container'>




		<div class='row' style="display:none;">

			<div class='col-sm-6'>
				<h1>TICKET BOX</h1>
				<div class='list-ticket'>
				<?php
					$no=0;
					if(isset($ticket) && count($ticket) > 0){ foreach($ticket as $row){
						$slug = $this->uri->segment(3);
						if($no=="0"){
							$ac = "active";
						}else{
							$ac = "";
						}
						echo "
							<a href='' class='$ac indi' data-target='#myCarousel' data-slide-to='$no'>
								<div class='head-list'>$row[judul] | $row[dimana]</div>
								<div class='date-list'>".namadate($row['tanggal'])."</div>
							</a>
						";
						$no++;
					}}
				?>
				</div>
			</div>
			<div class='col-sm-6'>
				<div id="myCarousel" class="carousel slide" data-ride="carousel">
					<ol class="carousel-indicators hide">
						<?php
							$no=0;
							if(isset($ticket) && count($ticket) > 0){ foreach($ticket as $row){
								$ac="";
								if($no==0){$ac = "active";}
								echo "<li data-target='#myCarousel' data-slide-to='$no' class='$ac'></li>";
								$no++;
							}}
						?>
					</ol>

					<div class="carousel-inner">
						<?php
							$no=1;
							if(isset($ticket) && count($ticket) > 0){ foreach($ticket as $row){
								$ac = "";
								$harga = "";
								if($row['harga']!="0"){
									$harga = "Rp.  ".number_format($row['harga']);
								}
								if($no==1){$ac = "active";}
								echo "
									<div class='item $ac'>
										<img src='".base_url()."uploads/ticket/$row[image]' alt='Los Angeles'>
										<div class='carousel-caption'>
											<h3>$row[judul]</h3>
											<p>$row[tanggal]</p>
											<p>$row[dimana]</p>
											<p>$row[deskripsi]</p>
											<div class='buy-ticket'>
												<h3>$harga</h3>
												<br>";

													if($row['mode']==0){
														//echo "<a href='".base_url()."ticket/buy/$row[slug]' class='btn btn-md btn-red'><i class='fa fa-shopping-cart'></i> Buy Ticket</a>";
													}else{
														if($row['btncomingsoon']==1){
															echo "<a href='javascript:void(0);' class='btn btn-md btn-red'><i class='fa fa-lock'></i> Coming Soon</a>";
														}else{
															if($row['btnsoldout']==1){
																echo "<a href='javascript:void(0);' class='btn btn-md btn-red'><i class='fa fa-lock'></i> Sold Out</a>";
															}else{
																if($row['btnbuy']==1){
																	if($kudu==""){
																		echo "<a href='".base_url()."ticket/buy/$row[slug]' class='btn btn-md btn-red'><i class='fa fa-shopping-cart'></i> Buy Ticket</a>";
																	}else{
																		echo "<a href='javascript:void(0);' class='btn btn-md btn-red $kudu'><i class='fa fa-shopping-cart'></i> Buy Ticket</a>";
																	}
																}
															}
														}
													}
												echo "
											</div>
										</div>
									</div>
								";
								$no++;
							}}
						?>

					</div>
				</div>
				<br><br>

			</div>
		</div>
	</div>
</div>
<br><br><br><br>-->


<?php $this->load->view('front/podcast/footerfp');?>
<script>
	$(document).on('ready', function() {
		$('.indi').click(function(){
			$('.indi').removeClass('active');
			$(this).addClass('active');
		});


		var $carousel = $('#myCarousel');
		$carousel.carousel();
		var handled=false;//global variable

		$carousel.bind('slide.bs.carousel', function (e) {
			var current=$(e.target).find('.item.active');
			var indx=$(current).index();
			if((indx+2)>$('.carousel-indicators li').length)
				indx=-1
			 if(!handled)
			 {
				$('.indi').removeClass('active')
				$('.indi:nth-child('+(indx+2)+')').addClass('active');
			 }
			 else
			 {
				handled=!handled;//if handled=true make it back to false to work normally.
			 }
		});

		$(".carousel-indicators li").on('click',function(){
		   //Click event for indicators
		   $(this).addClass('active').siblings().removeClass('active');
		   //remove siblings active class and add it to current clicked item
		   handled=true; //set global variable to true to identify whether indicator changing was handled or not.
		});

	});
</script>
