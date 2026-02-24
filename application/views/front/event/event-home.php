<div class="new-bs">
	<main class="main">
		<div class="page page-pnc">
            <div class="container">
				<h2 class="tittle-event">UPCOMING EVENT</h2>
				<div class="row">
				<?php foreach($event_aktif as $row){ ?>
					<div class="col-md-6 pb-3">
						<a href="<?php echo base_url('event-detail/'.$row['id_event']);?>" target="_self"><img class="img-full" src="<?php echo base_url('uploads/events/'.$row['image']) ?>"></a>
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
			<div class="container mt-5">
				<div class="row">
				<div class="section-title">
					<h3>HISTORICAL EVENT</h3>
				</div>
				<?php foreach($event_setelahnya as $row){ ?>
					<div class="col-md-4 mt-5">
						<a href="<?php echo base_url('event-detail/'.$row['id_event']);?>" target="_self"><img class="img-full" src="<?php echo base_url('uploads/events/'.$row['image']) ?>"></a>
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
				<div class="col-md-4"></div>
			</div>
			</div>
		</div>
	</main>
</div>
<style>
	.section-title::before, .section-title::after {
		position: absolute;
		top: ;
		transform: translateY(-50%);
		height: 3px;
		width: 37%;
		background-color: #0A559E;
		content: "";
		}
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
	.mt-5{
		margin-top: 2rem;
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
	@media screen and (max-width:768px){
	.main {
  padding-top: 58px;
}
		.section-title::before, .section-title::after {
		position: absolute;
		top: ;
		transform: translateY(-50%);
		height: 3px;
		width: 17%;
		background-color: #0A559E;
		content: "";
		}
}
</style>
