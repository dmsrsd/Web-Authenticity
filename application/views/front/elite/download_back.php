<!DOCTYPE html>
<html>
    <?php $this->load->view("front/elite/head.php");?>
    <?php 
        if($this->uri->segment(3)==1){ 
            $url= base_url('assets/elite-html/images/flower.jpeg');
            $kartu ="the flow";
        } else if($this->uri->segment(3)==2){ 
            $kartu ="the hidden edge";
            $url= base_url('assets/elite-html/images/star.jpeg');
        } else { 
            
            $kartu ="the slow burner";
            $url= base_url('assets/elite-html/images/love.jpeg');
        } 
    ?>
    <!-- OPEN GRAPH TAGS -->
  <meta property="og:title" content="<?php echo $kartu; ?>">
  <meta property="og:description" content="Siapkan dirimu, dan dengerin apa kata semesta di balik noise harian lo.">
  <meta property="og:image" content="<?php echo $url; ?>">
  <meta property="og:url" content="<?php echo base_url('elite/download/'.$this->uri->segment(3)) ?>">
  <meta property="og:type" content="website">

  <!-- Untuk Twitter -->
  <meta name="twitter:card" content="DEFINE Your Elite By Authenticity">
  <meta name="twitter:title" content="<?php echo $kartu; ?>">
  <meta name="twitter:description" content="Siapkan dirimu, dan dengerin apa kata semesta di balik noise harian lo.">
  <meta name="twitter:image" content="<?php echo $url; ?>">

<body class="circle"> 
    <div class="container-full">
        <div class="row p-2">
            <div class="col-md-6"></div>
            <div class="col-md-6 text-right">
                <img src="<?php echo base_url('assets/elite-html') ?>/images/logo_small.png" class="">
            </div>
        </div>
    </div>
	<div class="container-full"> 
			<div class="container">
				<div class="row">
					<div class="col-md-12 box-head"><p id="message"></p></div>
					<div class="col-md-12 box-body" style="min-height: 300px">
						<div class="row">
							<div class="col-md-4">
                                <img src="<?php echo $url; ?>" class="img-responsive">
							</div>
							<div class="col-md-8">
								<p></p>
								<div class="row">
									<div class="col-md-12 text-center"><h3 class="button-nav2 text-but" onclick="kirimData(this,'<?php echo base_url('elite/shareemails/'.$this->uri->segment(3).'?id='.$this->datamember['id']); ?>')" style="cursor: pointer;">Send Email
                                    </h3></div>
									<div class="col-md-12 text-center"><h3 class="button-nav2 text-but" onclick="sharePage()"  style="cursor: pointer;">Share
                                    </h3></div>
									<div class="col-md-12 text-center"><h3 class="button-nav2 text-but"><a id="download" href="<?php echo $url ?>" target="_blank" download>Download</a>
                                    </h3></div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-12 box-foot"></div>
				</div>
			</div>
            <div class="container">
                <div class="col-md-12 text-center">
                    <div class="button-nav"> 
                        <div class="row">
                            <div class="col-md-12 text-center"><h3 class="text-but">
								<a href="<?php echo base_url('elite') ?>">Back to Home</a>
							</h3></div>
                        </div>
                    </div>
                </div>
            </div>
	</div> 
    <!-- //modal share -->
    <div class="modal fade bd-example-modal-sm" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Share</h5>
        </div>
        <div class="modal-body text-center">
            
            <a href="javascript:void(0);" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=<?php echo $url ?>', '_blank', 'width=600,height=600,scrollbars=yes,status=yes,resizable=yes,screenx=0,screeny=0');">
                <img src="<?php echo base_url('stat/purpleduo/preview/images/facebook.svg') ?>" alt="share facebook" width="30" height="30" loading="lazy">
            </a>
            <a href="javascript:void(0);" onclick="window.open('https://twitter.com/share?text=<?php echo $kartu ?>&url=<?php echo $url ?>', '_blank', 'width=600,height=600,scrollbars=yes,status=yes,resizable=yes,screenx=0,screeny=0');">
                <img src="<?php echo base_url('stat/purpleduo/preview/images/twitter.svg') ?>" alt="share twitter" width="30" height="30" loading="lazy">
            </a>
            <a href="javascript:void(0);" onclick="window.open('https://telegram.me/share/url?text=<?php echo $kartu ?>&url=<?php echo $url ?>', '_blank', 'width=600,height=600,scrollbars=yes,status=yes,resizable=yes,screenx=0,screeny=0');">
                <img src="<?php echo base_url('stat/purpleduo/preview/images/telegram.svg') ?>" alt="share telegram" width="30" height="30" loading="lazy">
            </a>
            <a href="javascript:void(0);" onclick="window.open('https://api.whatsapp.com/send?text=<?php echo $kartu ?>%0a %0a<?php echo $url ?>%0a', '_blank', 'width=600,height=600,scrollbars=yes,status=yes,resizable=yes,screenx=0,screeny=0');">
                <img src="<?php echo base_url('stat/purpleduo/preview/images/whatsapp.svg') ?>" alt="share wa" width="30" height="30" loading="lazy">
            </a>
        </div>
        <div class="modal-footer mx-auto">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
    </div>
	<!-- content --> 
    <?php $this->load->view("front/elite/footer.php");?>
    <script>
        let isSharing = false;

        function sharePage() {
            $('#exampleModal').modal('show');
            
            // if (isSharing) return; // Cegah klik ganda
            // isSharing = true;
            // Pas visitor klik tombol share di Result 
            Moengage.track_event("Define your elite", {
                "email": "<?php echo $member['email'] ?>",
                "tombol": "share"
            });
            // if (navigator.share) {
            //     navigator.share({
            //         // title: document.title,
            //         // url: window.location.href
            //     })
            //     .then(() => {
            //         //document.getElementById('message').textContent = 'Berhasil dibagikan!';
            //     })
            //     .catch((error) => {
            //         document.getElementById('message').textContent = 'Gagal membagikan: ' + error;
            //     })
            //     .finally(() => {
            //         isSharing = false; // Izinkan share berikutnya setelah selesai
            //     });
            // } else {
            //     document.getElementById('message').textContent = 'Fitur share tidak didukung di browser ini.';
            //     isSharing = false;
            // }
        }
        function kirimData(el,url) {
            el.removeAttribute('onclick');
            el.classList.remove('disabled');
            $.ajax({
                url: url,
                method: 'GET',
                success: function(response) {
                    alert("Berhasil Di simpan ke Email Lo!");
                    el.textContent = 'Email Sent';
                    console.log(response);
                    //kirim mengage
                    Moengage.track_event("Define your elite", {
                        "email": "<?php echo $member['email'] ?>",
                        "tombol": "email"
                    });
                },
                error: function(xhr, status, error) {
                    alert("Jaringan sibuk coba lagi nanti");
                    console.log(xhr.responseText);
                }
            });
        }
    </script>
    
	<!-- //Pas visitor ke halaman result -->
	<script type="text/javascript">
		Moengage.track_event("Define your elite", {
			"email": "<?php echo $member['email'] ?>",
			"halaman": "result"
		});
	</script>

	<!-- //Pas visitor klik tombol download di Result -->
    <script type="text/javascript">
        document.getElementById("download").addEventListener("click", function(e) {
            e.preventDefault(); // Cegah download langsung

            const link = e.currentTarget;
            const url = link.href;

            // Kirim event ke MoEngage
            Moengage.track_event("Define your elite", {
                "email": "<?php echo $member['email'] ?>",
                "tombol": "download"
            });

            // Setelah delay, buat link download manual
            setTimeout(() => {
            const tempLink = document.createElement("a");
            tempLink.href = url;
            tempLink.setAttribute("download", "");
            document.body.appendChild(tempLink);
            tempLink.click();
            tempLink.remove();
            }, 300); // delay untuk pastikan event terkirim
        });
    </script>

</body>
</html>