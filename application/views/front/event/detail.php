<div class="new-bs">
	<main class="main">
		<div class="page page-pnc">
			<div class="container">
				<div class="row event">
					<div class="col-md-6">
						<h2 class="tittle-thumb"><?php echo $event['judul'];?></h2>
						<?php 
						// Ubah string ke timestamp
						$tglStart = strtotime($event['periode_start']);
						$tglEnd   = strtotime($event['periode_end']);

						// Format tanggal jadi "25 September 2025"
						$formatStart = date('d F Y', $tglStart);
						$formatEnd   = date('d F Y', $tglEnd);

						// Cek apakah sama
						if ($formatStart == $formatEnd) {
							echo "<p class='isian'>{$formatStart}</p>";
						} else {
							echo "<p class='isian'>{$formatStart} - {$formatEnd}</p>";
						}
						?>
						<p class="isian"><?php echo $event['lokasi'];?></p>
						<p class="isian"><strong>HTM : <?php  echo "Rp " . number_format($event['htm_start'], 0, ',', '.');  ?> -  <?php  echo "Rp " . number_format($event['htm_end'], 0, ',', '.'); ?> </strong></p>
						<a href="<?php echo $event['link_ig'];?>" target="_blank"><p class="sosmed">Cek IG Promotor <img src="https://www.authenticity.id/assets/front/img/event/ig-new.png"></p></a>
						<a href="<?php echo $event['url_tiket'];?>" target="_self"><p class="btn btn-primary"><?php echo $event['status'];?></p></a>
						
					</div>
					<div class="col-md-6 text-right">
						<img class="img-full" src="https://www.authenticity.id/uploads/events/<?php echo $event['image'];?>" style="">
					</div>
				</div>
				
				<div class="row event">
					<div class="section-title">
						<h3>MORE EVENT</h3>
					</div>
					<?php foreach($event_setelahnya as $row){ ?>
						<div class="col-md-4 mt-5">
							<a href="<?php echo base_url('event-detail/'.$row['id_event']);?>" target="_self"><img class="img-full" src="https://www.authenticity.id/uploads/events/<?php echo $row['image'];?>"></a>
							<a href="<?php echo base_url('event-detail/'.$row['id_event']);?>" target="_self"><h2 class="tittle-thumb"><?php echo $row['judul'];?></h2></a>
							<?php 
								// Ubah string ke timestamp
								$tglStart = strtotime($row['periode_start']);
								$tglEnd   = strtotime($row['periode_end']);

								// Format tanggal jadi "25 September 2025"
								$formatStart = date('d F Y', $tglStart);
								$formatEnd   = date('d F Y', $tglEnd);

								// Cek apakah sama
								if ($formatStart == $formatEnd) {
									echo "<p class='isian'>{$formatStart}</p>";
								} else {
									echo "<p class='isian'>{$formatStart} - {$formatEnd}</p>";
								}
								?>
							<p class="isian"><?php echo $row['lokasi'];?></p>
						</div>
					<?php } ?>
				</div>
				
			</div>
		</div>
	</main>
</div>

<style>
	.tittle-event{
		font-family: "Rubik",sans-serif;
		font-weight : bold;
		font-size : 34px;
		color: #1c4e95;
		padding: 20px 0;
	}
	.tittle-thumb{
		font-family: "Rubik",sans-serif;
		font-weight : bold;
		font-size : 24px;
		color: #1c4e95;
		padding: 5px 0 0 0;
	}
	.isian{
		color: #000;
font-family: "Rubik",sans-serif;
font-size: 16px;
font-style: normal;
font-weight: 500;
line-height: normal;
text-transform: uppercase;
margin-bottom: 5px;
margin-top: 0;
	}
	.event .btn-primary{
		font-size: 20px;
  font-style: normal;
  font-weight: 900;
  line-height: normal;
  text-transform: uppercase;
  color: #fff;
}
.event{
		margin-top:4rem !important;;
	}
.sosmed img{
	width: 20px;
}
@media screen and (max-width:768px){
	.main {
  padding-top: 58px;
}
}
	
</style>