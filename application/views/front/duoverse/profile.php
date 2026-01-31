<head>
    <?php $this->load->view("front/duoverse/header.php");?>
    <script src="<?=base_url('assets/duoverse-html')?>/sweetalert2@11.js"></script>
    <style>
        .form-block{
            padding-left: 30px;
            margin-top: 11%;
            text-align: left;
        }
        .mput {
            z-index: 1 !important;
        }
    </style>
</head>
<body>
<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5Q5GBNF" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WH8ZRXFD" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
  <div class="new-bs">
        <main class="main">
            <div class="section01 bg-gradien2 bg-fire2">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12 align-middle logo2">
                            <!--<h1 style="margin-top: 30%;">DUOVERSE </br>CIRCLE</span></h1>-->
                            <img src="<?=base_url('assets/duoverse-html')?>/images/logo_duoverse.png" class="">
							<p  class="caption">Ikut Movement, Bawa Temen, dan Dapetin Excitement!</p>
                            <span><img src="<?=base_url('assets/duoverse-html')?>/images/button" alt=""></span>
                        </div>
                    </div>
                 </div>
            </div> 
            <div class="container">
                <div class="row p30">
                    <h2 style="margin-bottom: 30px;">Download & Share</h2>
                    <p style="color: #fff; margin-bottom: 20px;font-size:24px;">Download template & copy link referral, terus attach link pas upload ke instagram story!</p>
                    <div class="col-sm-12 col-lg-6 text-center">
                        <img src="<?=base_url('assets/duoverse-html')?>/images/thumb-template.png" class="img-temp ">
                    </div>
                    <div class="col-sm-12 col-lg-6 text-center form-block">
                        <input type="text" id="teks_input" name="teks_input" placeholder="Salin link referral" class="mput" value="<?= base_url('duoverse/klaim/'.$referal_code) ?>"></br>
						
						<button id="copyButton" onclick="copyToClipboard();Moengage.track_event('Duoverse Circle', { 'member': '<?php echo $this->datamember['id'] ?>', 'tombol': 'Copy Duoverse' });" style="background-color: red; color: white;padding:10px;width:286px;justify-content: center;">COPY LINK!</button>
        

        <div id="feedbackMessage" style="color:#ffffff!important;"></div>
						
						</br>
                        <img id="btnDownload" src="<?=base_url('assets/duoverse-html')?>/images/button-download.png" class="" style="margin-top: 10px; z-index: 999; position: relative;" onclick="Moengage.track_event('Duoverse Circle', { 'member': '<?php echo $this->datamember['id'] ?>', 'tombol': 'Download di sini' });">
                    </div>
                </div>
                <div class="row" style="z-index: 999; position: relative;">
                    <div class="col-12 pd50" style="padding-top:70px!important;">
                       <a href="<?=base_url('duoverse')?>" target="_self"> <img src="<?=base_url('assets/duoverse-html')?>/images/but-back.png"></a>
                    </div>
                </div>
            </div>        
        </main>
    </div>
    <div class="new-bs"><img src="<?=base_url('assets/duoverse-html')?>/images/circle01.png" class="circle"></div>
    
    <?php $this->load->view("front/duoverse/footer.php");?>
    <script>
        document.getElementById('btnDownload').addEventListener('click', function() {
        const input = document.getElementById('teks_input');
        const imageUrl = "https://www.authenticity.id/assets/duoverse-html/images/template.png";

        // 1Salin teks ke clipboard
        navigator.clipboard.writeText(input.value)
            .then(() => {
            // Unduh gambar dari URL
            const link = document.createElement('a');
            link.href = imageUrl;
            link.download = imageUrl.split('/').pop(); // nama file otomatis
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);

            // Notifikasi sukses
            Swal.fire({
                icon: 'success',
                title: 'Gambar diunduh! Lanjut copy link!',
                html: `<small>${input.value}</small>`,
                showConfirmButton: false,
                timer: 2500
            });
            })
            .catch(() => {
            Swal.fire({
                icon: 'error',
                title: 'Gagal menyalin link!',
                text: 'Coba salin manual atau ulangi.',
            });
            });
            //kirim moengage
            Moengage.track_event("Duoverse Circle", {
                "email": "<?php echo $member['email']; ?>",
                "tombol": "Download di sini"
            });
        });
    </script>
	
	
	
	
	<script>
        /**
         * Fungsi untuk menyalin isi dari elemen input ke clipboard.
         */
        function copyToClipboard() {
            const inputElement = document.getElementById('teks_input');
            const copyButton = document.getElementById('copyButton');
            const feedbackElement = document.getElementById('feedbackMessage');
            
            // 1. Pilih teks di dalam input
            inputElement.select();
            inputElement.setSelectionRange(0, 99999); // Untuk perangkat mobile

            try {
                // 2. Jalankan perintah salin (metode yang direkomendasikan untuk kompatibilitas iFrame)
                const success = document.execCommand('copy');
                
                if (success) {
                    // 3. Berikan umpan balik visual
                    const originalText = copyButton.innerText;
                    
                    // Ubah teks tombol dan warna
                    copyButton.innerText = 'Tersalin!';
                    copyButton.classList.remove('bg-indigo-600', 'hover:bg-indigo-700');
                    copyButton.classList.add('bg-green-600', 'hover:bg-green-700');

                    // Tampilkan pesan di bawah
                    feedbackElement.innerText = 'Tautan referensi berhasil disalin ke clipboard.';
                    feedbackElement.classList.remove('text-red-500');
                    feedbackElement.classList.add('text-green-600', 'opacity-100');


                    // Kembalikan teks tombol dan warna setelah 3 detik
                    setTimeout(() => {
                        copyButton.innerText = originalText;
                        copyButton.classList.remove('bg-green-600', 'hover:bg-green-700');
                        copyButton.classList.add('bg-indigo-600', 'hover:bg-indigo-700');
                        feedbackElement.classList.remove('opacity-100');
                        feedbackElement.classList.add('opacity-0');
                    }, 3000);
                    
                } else {
                    // Jika execCommand gagal (jarang terjadi di browser modern)
                    feedbackElement.innerText = 'Gagal menyalin teks. Silakan salin manual.';
                    feedbackElement.classList.add('text-red-500', 'opacity-100');
                    console.error('Copy command was not successful.');
                }
            } catch (err) {
                // Tangani kesalahan (misalnya, izin diblokir)
                feedbackElement.innerText = 'Kesalahan saat menyalin. Periksa izin browser.';
                feedbackElement.classList.add('text-red-500', 'opacity-100');
                console.error('Error in copying:', err);
            }

            //kirim moengage
            Moengage.track_event("Duoverse Circle", {
                "email": "<?php echo $member['email']; ?>",
                "tombol": "download di sini"
            });

            
            // Batalkan seleksi setelah selesai (opsional)
            window.getSelection().removeAllRanges();
        }
    </script>
	
  
  <!-- //moengage Start -->
		<script type="text/javascript">
            Moengage.track_event("Duoverse Circle", {
                "member": "<?php echo $this->datamember['id'] ?>",
                "halaman": "download duoverse"
            });
        </script>
	<!-- //moengage End -->
</body>
