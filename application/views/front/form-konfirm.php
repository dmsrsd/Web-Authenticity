<style>
	span.select2-selection.select2-selection--single > span {
		margin: 9px;
	}
	.select2-container--default .select2-selection--single {
		border: 1px solid #848484;
		border-radius: 0px;
		height: 45px;
	}

	div#loader {
    position: fixed;
    top: 0;
    left: 0;
    background-color: #0003;
    width: 100%;
    height: 100vh;
}
.loader {
	position: absolute;
	top: 50%;
	right: 50%;
	transform: translate(-50%, -50%);
	width: 48px;
	height: 48px;
	border-radius: 50%;
	display: inline-block;
	border: 3px solid;
	border-color: #FFF #FFF transparent transparent;
	box-sizing: border-box;
	animation: rotation 1s linear infinite;
}
.loader::after,
.loader::before {
  content: '';  
  box-sizing: border-box;
  position: absolute;
  left: 0;
  right: 0;
  top: 0;
  bottom: 0;
  margin: auto;
  border: 3px solid;
  border-color: transparent transparent #FF3D00 #FF3D00;
  width: 40px;
  height: 40px;
  border-radius: 50%;
  box-sizing: border-box;
  animation: rotationBack 0.5s linear infinite;
  transform-origin: center center;
}
.loader::before {
  width: 32px;
  height: 32px;
  border-color: #FFF #FFF transparent transparent;
  animation: rotation 1.5s linear infinite;
}
    
@keyframes rotation {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
} 
@keyframes rotationBack {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(-360deg);
  }
}
</style>
<div class="new-bs">
	<main class="main">
		<div class="page page-profile">
			<section class="py-5">
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-lg-8 col-md-10">
							<div class="card card--shadow">
								<form action="<?php echo base_url(); ?>unlock/prosesconfirm" id="myForm" method="post" data-parsley-validate enctype="multipart/form-data">
									<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
									<input type="hidden" name="type" value="redmax" style="display: none">
									<div class="row">
										<div class="col-lg">
											<h3>Hangout Places</h3>
											<div class="form-group">
												<label style="color: #1c4e95;font-weight: 800;">Mohon tuliskan alamat email ini di struk/bon lo :</label>
												<input type="text" class="form-control " value="<?php echo $member['email'] ?>" name="email" disabled style="background-color: #eee;">
											</div>
											<div class="form-group">
												<label>Lokasi Horeka :</label>
												<select name="pembelian" class="form-control select2">
													<option value="KOPI BOLANK, TANGERANG">KOPI BOLANK, TANGERANG</option>
													<option value="PRANAYAMA SOCIAL AREA, TANGERANG">PRANAYAMA SOCIAL AREA, TANGERANG</option>
													<option value="DOM SOCIAL HUB, TANGERANG">DOM SOCIAL HUB, TANGERANG</option>
													<option value="KOPI TUH, TANGERANG">KOPI TUH, TANGERANG</option>
													<option value="CRYPTO COFFEE, TANGERANG">CRYPTO COFFEE, TANGERANG</option>
													<option value="MINIMAL KOPI, TANGERANG">MINIMAL KOPI, TANGERANG</option>
													<option value="REYS COFFEE & PIZZA, TANGERANG">REYS COFFEE & PIZZA, TANGERANG</option>
													<option value="ALAYA COFFEE, TANGERANG">ALAYA COFFEE, TANGERANG</option>
													<option value="KOPI HOYA, TANGERANG">KOPI HOYA, TANGERANG</option>
													<option value="WARSO, TANGERANG">WARSO, TANGERANG</option>
													<option value="WARUNK BANGJHON, TANGERANG">WARUNK BANGJHON, TANGERANG</option>
													<option value="PETERSBURG COFFEE, TANGERANG">PETERSBURG COFFEE, TANGERANG</option>
													<option value="BANGJHON COFFEE, TANGERANG">BANGJHON COFFEE, TANGERANG</option>
													<option value="NISKALA, TANGERANG">NISKALA, TANGERANG</option>
													<option value="DEPRESSO, SERANG">DEPRESSO, SERANG</option>
													<option value="KEDAI TEPIAN LAUT, SERANG">KEDAI TEPIAN LAUT, SERANG</option>
													<option value="BATIGO, SERANG">BATIGO, SERANG</option>
													<option value="CALDERA, SERANG">CALDERA, SERANG</option>
													<option value="RUMAH TEH WIDIWASA, SERANG">RUMAH TEH WIDIWASA, SERANG</option>
													<option value="KOPI MANING, BEKASI">KOPI MANING, BEKASI</option>
													<option value="KOPI RAGA, BEKASI">KOPI RAGA, BEKASI</option>
													<option value="NU.ETA, BEKASI">NU.ETA, BEKASI</option>
													<option value="BARTEL COFFEE, BEKASI">BARTEL COFFEE, BEKASI</option>
													<option value="AFTERDAYS COFFEE, BEKASI">AFTERDAYS COFFEE, BEKASI</option>
													<option value="WALK THE TALK, BEKASI">WALK THE TALK, BEKASI</option>
													<option value="NAMDUA HOUSE, BEKASI">NAMDUA HOUSE, BEKASI</option>
													<option value="TALK KOPI MATARAM, MATARAM">TALK KOPI MATARAM, MATARAM</option>
													<option value="THE REAM COFFEE, MATARAM">THE REAM COFFEE, MATARAM</option>
													<option value="KASUMBA COFFEE, BANDUNG">KASUMBA COFFEE, BANDUNG</option>
													<option value="LALANA SOCIAL SPACE, BANDUNG">LALANA SOCIAL SPACE, BANDUNG</option>
													<option value="SEIN KIRI COFFEE, KITCHEN & SPACE, BANDUNG">SEIN KIRI COFFEE, KITCHEN & SPACE, BANDUNG</option>
													<option value="PRAYA COFFEE, TASIKMALAYA">PRAYA COFFEE, TASIKMALAYA</option>
													<option value="KIND CULTURE, TASIKMALAYA">KIND CULTURE, TASIKMALAYA</option>
													<option value="RUANG RENJANA, TASIKMALAYA">RUANG RENJANA, TASIKMALAYA</option>
													<option value="RUMAH MESRA/POPTHREE, SUKABUMI">RUMAH MESRA/POPTHREE, SUKABUMI</option>
													<option value="SUNDA COFFEE, SUKABUMI">SUNDA COFFEE, SUKABUMI</option>
													<option value="VERVE BISTRO, SEMARANG">VERVE BISTRO, SEMARANG</option>
													<option value="ARTOTEL GAJAHMADA, SEMARANG">ARTOTEL GAJAHMADA, SEMARANG</option>
													<option value="EXCELSO BOWLING RINJANI, SEMARANG">EXCELSO BOWLING RINJANI, SEMARANG</option>
													<option value="CASA ROBERTO, SEMARANG">CASA ROBERTO, SEMARANG</option>
													<option value="APPERIO, SEMARANG">APPERIO, SEMARANG</option>
													<option value="KM 5 COFFEE, KUDUS">KM 5 COFFEE, KUDUS</option>
													<option value="THEO COFFEE, KUDUS">THEO COFFEE, KUDUS</option>
													<option value="JEMPOLAN COFFEE, YOGYAKARTA">JEMPOLAN COFFEE, YOGYAKARTA</option>
													<option value="KOPI PINGGIR JALAN, YOGYAKARTA">KOPI PINGGIR JALAN, YOGYAKARTA</option>
													<option value="28 Coffee Godean, YOGYAKARTA">28 Coffee Godean, YOGYAKARTA</option>
													<option value="28 Coffee Tamansiswo, YOGYAKARTA">28 Coffee Tamansiswo, YOGYAKARTA</option>
													<option value="28 Coffee Seturan, YOGYAKARTA">28 Coffee Seturan, YOGYAKARTA</option>
													<option value="28 Coffee Jakal Km 11, YOGYAKARTA">28 Coffee Jakal Km 11, YOGYAKARTA</option>
													<option value="Bolivar Coffee, YOGYAKARTA">Bolivar Coffee, YOGYAKARTA</option>
													<option value="HOOP Coffee, YOGYAKARTA">HOOP Coffee, YOGYAKARTA</option>
													<option value="SADARI COFFEE, SOLO">SADARI COFFEE, SOLO</option>
													<option value="HALUAN, SOLO">HALUAN, SOLO</option>
													<option value="DIALOG, SOLO">DIALOG, SOLO</option>
													<option value="MINALE, SOLO">MINALE, SOLO</option>
													<option value="STAR VILLAGE, SOLO">STAR VILLAGE, SOLO</option>
													<option value="ANGARU COFFEE&EATERY, MAKASSAR">ANGARU COFFEE&EATERY, MAKASSAR</option>
													<option value="COFFEE 21, MAKASSAR">COFFEE 21, MAKASSAR</option>
													<option value="CUSHY PRIME, MAKASSAR">CUSHY PRIME, MAKASSAR</option>
													<option value="RC TERAS, MAKASSAR">RC TERAS, MAKASSAR</option>
													<option value="OASE TURATEA, MAKASSAR">OASE TURATEA, MAKASSAR</option>
													<option value="TERATAS KOFFIEBAR, MAKASSAR">TERATAS KOFFIEBAR, MAKASSAR</option>
													<option value="TETESKOPI, MAKASSAR">TETESKOPI, MAKASSAR</option>
													<option value="HEAVEN WITH YOU, MAKASSAR">HEAVEN WITH YOU, MAKASSAR</option>
													<option value="MENAMU, MAKASSAR">MENAMU, MAKASSAR</option>
													<option value="MOVE UP, MAKASSAR">MOVE UP, MAKASSAR</option>
													<option value="INBOX, PAREPARE">INBOX, PAREPARE</option>
													<option value="KOPI LIN, PAREPARE">KOPI LIN, PAREPARE</option>
													<option value="SUDUT LAGI MAJENE, PAREPARE">SUDUT LAGI MAJENE, PAREPARE</option>
													<option value="KEY KOPI, PAREPARE">KEY KOPI, PAREPARE</option>
													<option value="BINRES CAFE, PALOPO">BINRES CAFE, PALOPO</option>
													<option value="KOPI GALUNG, PALOPO">KOPI GALUNG, PALOPO</option>
													<option value="WARKOP D LINO, PALOPO">WARKOP D LINO, PALOPO</option>
													<option value="UPSTREAT, PALOPO">UPSTREAT, PALOPO</option>
													<option value="LANGOA CAFE, PALOPO">LANGOA CAFE, PALOPO</option>
													<option value="Pin Point, PALU">Pin Point, PALU</option>
													<option value="Tagara Coffee Space, PALU">Tagara Coffee Space, PALU</option>
													<option value="168 House, PALU">168 House, PALU</option>
													<option value="WIB Coffee Eatery, MOROWALI">WIB Coffee Eatery, MOROWALI</option>
													<option value="SPOT COFFEE, KENDARI">SPOT COFFEE, KENDARI</option>
													<option value="MANUAL COFFEE, KENDARI">MANUAL COFFEE, KENDARI</option>
													<option value="DISEMEJA, KENDARI">DISEMEJA, KENDARI</option>
													<option value="NUDI CAFE,LAMPUNG">NUDI CAFE,LAMPUNG</option>
													<option value="1000CC,LAMPUNG">1000CC,LAMPUNG</option>
													<option value="ADIKSI PURNAWIRAWAN,LAMPUNG">ADIKSI PURNAWIRAWAN,LAMPUNG</option>
													<option value="ADIKSI RYACUDU,LAMPUNG">ADIKSI RYACUDU,LAMPUNG</option>
													<option value="MARO COFFEA,LAMPUNG">MARO COFFEA,LAMPUNG</option>
													<option value="PAR'S LIFE,LAMPUNG">PAR'S LIFE,LAMPUNG</option>
													<option value="SKAYE CAFE,LAMPUNG">SKAYE CAFE,LAMPUNG</option>
													<option value="WARUNK VIRAL,LAMPUNG">WARUNK VIRAL,LAMPUNG</option>
													<option value="WARUNG KOPI PAHLAWAN,LAMPUNG">WARUNG KOPI PAHLAWAN,LAMPUNG</option>
													<option value="DUNNO COFFEE,LAMPUNG">DUNNO COFFEE,LAMPUNG</option>
													<option value="SPESIES COFFEE,LAMPUNG">SPESIES COFFEE,LAMPUNG</option>
													<option value="KOPI APEK SEKHANAK, PALEMBANG">KOPI APEK SEKHANAK, PALEMBANG</option>
													<option value="OMAH KOPI, PALEMBANG">OMAH KOPI, PALEMBANG</option>
													<option value="SAVIOUR CAFE & RESTO, PALEMBANG">SAVIOUR CAFE & RESTO, PALEMBANG</option>
													<option value="ELEU CAFE, PALEMBANG">ELEU CAFE, PALEMBANG</option>
													<option value="AMO COFFEE BACKYARD, PALEMBANG">AMO COFFEE BACKYARD, PALEMBANG</option>
													<option value="KAUSA, PADANG">KAUSA, PADANG</option>
													<option value="PALIO SPITI, PADANG">PALIO SPITI, PADANG</option>
													<option value="TARA COFFEE, PADANG">TARA COFFEE, PADANG</option>
													<option value="WORKAS COFFEE, PADANG">WORKAS COFFEE, PADANG</option>
													<option value="Cafe Javas Cycle, JAMBI">Cafe Javas Cycle, JAMBI</option>
													<option value="Dimme Place, JAMBI">Dimme Place, JAMBI</option>
													<option value="RUNA'S, JAMBI">RUNA'S, JAMBI</option>
													<option value="DIK COFFE, JAMBI">DIK COFFE, JAMBI</option>
													<option value="MARKA KOPI	MUARA, BUNGO">MARKA KOPI	MUARA, BUNGO</option>
													<option value="STARHOME CAFE, LAHAT">STARHOME CAFE, LAHAT</option>
													<option value="GARIS WAKTU, BENGKULU">GARIS WAKTU, BENGKULU</option>
												</select>
												<!-- <input type="text" class="form-control " required maxlength="100" placeholder="Lokasi Horeka" name="pembelian"> -->
											</div>
											<div class="form-group">
												<label for="email">Photo Langsung :</label>
												<input type="file" id="fileInput" class="form-control hidden-lg hidden-md" required name="resi" accept="image/*" capture="environment">
												<p id="fileSizeError" style="color:red; display:none;">File maksimal 1MB!</p>
												<div class="alert alert-danger hidden-sm hidden-xs">
													<strong>WAJIB MENGGUNAKAN HANDPONE</strong>
												</div>
											</div>
											<div class="row mt-5">
												<div class="col-md-6">
												<a href="<?php echo base_url('campaign-merch'); ?>" class="btn btn-outline-primary btn-sm d-block img-full">KEMBALI</a>
												</div>
												<div class="col-md-6">
													<button type="submit" id="submitButton" class="btn btn-primary btn-sm d-block img-full">KIRIM</button>
												</div>
											</div>
										</div>
									</div>
								</form>
								<img src="<?php echo base_url() ?>assets/front/img/profile/bg.png" alt="BG" class="img-full" />
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
	</main>
</div>
<script src="<?php echo base_url() ?>assets/front/js/jquery.js"></script>
<script>
$(document).ready(function() {
    $('#myForm').on('submit', function(event) {
        //event.preventDefault();

        var $submitButton = $('#submitButton');
		$('#loader').show();

        $submitButton.prop('disabled', true); 
    });
});
</script>
<script>
  document.getElementById("fileInput").addEventListener("change", function() {
    const file = this.files[0];
    const maxSize = 1 * 1024 * 1024; // 1MB in bytes
    
    if (file && file.size > maxSize) {
      document.getElementById("fileSizeError").style.display = "block";
      this.value = ""; // Clear the file input if size exceeds the limit
    } else {
      document.getElementById("fileSizeError").style.display = "none";
    }
  });
</script>