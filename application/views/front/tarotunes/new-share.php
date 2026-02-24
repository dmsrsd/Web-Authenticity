<?php 
    $requestUri = $_SERVER['REQUEST_URI'];
    $Url = base_url($requestUri);
    if($_GET['type']==1){ 
        $name="Opening Track";
        $gambar1= base_url('assets/tarotunes-html/images/card/'. $kartu_1['gambar']);
        $gambar2= base_url('assets/tarotunes-html/images/card/'. $kartu_2['gambar']);
        $gambar3= base_url('assets/tarotunes-html/images/card/'. $kartu_3['gambar']);
        $kartu1 = $kartu_1['nama_kartu'];
        $kartu2 = $kartu_2['nama_kartu'];
        $kartu3 = $kartu_3['nama_kartu'];
        $desk1 = $kartu_1['down'];
        $desk2 = $kartu_2['down'];
        $desk3 = $kartu_3['down'];
    } else if($_GET['type']==2){ 
        $name="Now Playing";
        $gambar1= base_url('assets/tarotunes-html/images/card/'. $kartu_4['gambar']);
        $gambar2= base_url('assets/tarotunes-html/images/card/'. $kartu_5['gambar']);
        $gambar3= base_url('assets/tarotunes-html/images/card/'. $kartu_6['gambar']);
        $kartu1 = $kartu_4['nama_kartu'];
        $kartu2 = $kartu_5['nama_kartu'];
        $kartu3 = $kartu_6['nama_kartu'];
        $desk1 = $kartu_4['down'];
        $desk2 = $kartu_5['down'];
        $desk3 = $kartu_6['down'];
    } else { 
        $name="Opening Track";
        $gambar1= base_url('assets/tarotunes-html/images/card/'. $kartu_7['gambar']);
        $gambar2= base_url('assets/tarotunes-html/images/card/'. $kartu_8['gambar']);
        $gambar3= base_url('assets/tarotunes-html/images/card/'. $kartu_9['gambar']);
        $kartu1 = $kartu_7['nama_kartu'];
        $kartu2 = $kartu_8['nama_kartu'];
        $kartu3 = $kartu_9['nama_kartu'];
        $desk1 = $kartu_7['down'];
        $desk2 = $kartu_8['down'];
        $desk3 = $kartu_9['down'];
    } 
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
        <meta charset="utf-8"> 
        <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
        <title><?php echo $kartu; ?></title> 
        <meta name="description" content="<?php echo $desk; ?>">

        <!-- Mobile Metas --> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <link rel="stylesheet" href="<?php echo base_url('assets/tarotunes-html/css/bootstrap.css') ?>"> 
        <link rel="stylesheet" href="<?php echo base_url('assets/tarotunes-html/css/animate.css') ?>"> 
        <link rel="stylesheet" href="<?php echo base_url('assets/tarotunes-html/css/style.css') ?>"> 
        <link rel="stylesheet" href="<?php echo base_url('assets/tarotunes-html/css/global.css') ?>"> 

        <meta property="fb:app_id" content="2153941954652615"/>
        <meta property="og:title" content="<?php echo $kartu1;  ?>"/>
        <meta property="og:description" content="<?php echo $desk1;  ?>"/>
        <meta property="og:type" content="article"/>
        <meta property="og:url" content="<?php echo $Url ?>"/>
        <meta property="og:image" content="<?php echo $gambar1;  ?>"> 
        <meta property="og:site_name" content="Authenticity">
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content=""/>
        <meta name="twitter:creator" content="">
        <meta name="twitter:title" content="<?php echo $kartu1;  ?>">
        <meta name="twitter:description" content="Download dan share character lo ke sosmed">
        <meta name="twitter:image" content="<?php echo $gambar1;  ?>">
        <meta name="twitter:url" content="<?php echo $gambar1;  ?>" >
        <meta name="twitter:domain" content="<?php echo $gambar1;  ?>">

        <style>
            body, html {
                height: 100%;
                margin: 0;
            }

            .bg {
                /* The image used */
                background-image: url('<?php echo base_url("assets/tarotunes-html/images/bg_tarotunes.png"); ?>');
            
                /* Full height */
                height: 100%; 

                /* Center and scale the image nicely */
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
                padding:15px;
            }
            h2 {
                text-align: left;
                font-size: 20px;
                margin-bottom: 12px;
            }
            p {
                color: #ffff;
                font-size: 14px;
                margin-left: 11px;
            }
            .list-data {
                display: inline-flex;
            }
            h3 {
                font-size: 13px;
                text-align: left;
                margin-top:3rem;
            }
            .mt-15 {
                margin-top: 5rem ;
            }
            .toolstip {
                position: relative;
                display: inline-block;
            }

            .toolstip .tooltiptext {
                visibility: hidden;
                width: 100%;
                background-color: #555;
                color: #fff;
                text-align: center;
                border-radius: 6px;
                padding: 5px;
                position: absolute;
                z-index: 1;
                bottom: 150%;
                left: 50%;
                margin-left: -50%;
                opacity: 0;
                transition: opacity 0.3s;
            }

            .toolstip .tooltiptext::after {
                content: "";
                position: absolute;
                top: 100%;
                left: 50%;
                margin-left: -5px;
                border-width: 5px;
                border-style: solid;
                border-color: #555 transparent transparent transparent;
            }

            .toolstip:hover .tooltiptext {
                visibility: visible;
                opacity: 1;
            }
            .p0{
                padding:0px;
            }
            button.btn-download {
                padding: 10px;
                font-size: 10pt;
                border: none;
                background: #1c4e95;
            }
            .mb-2{
                margin-bottom: 1pt;
            }
			@media screen and (max-width: 640px){
			.meet{
				margin-top:1rem!important; 
				margin-bottom: 1rem!important;
			}
			}
        </style>
        
    </head>
<body> 
<div class="">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-4 col-md-offset-4" >
                <div class="row row-card bg" id="screnshoot">
                    <div class="col-md-12 text-center mt-15">
                        <img src="<?php echo base_url("assets/tarotunes-html/images/logo_tarotunes_m.png"); ?>" width="140px">
                    </div>
                    <div class="col-md-12 p0">
                        <h2><?php echo $name; ?></h2>
                    </div>
                    <div class="list-data">
                        <img src="<?php echo $gambar1 ?>" alt="<?php echo $kartu1; ?>" width="80px">
                        <p><strong><?php echo $kartu1; ?> :</strong> <?php echo $desk1; ?></p>
                    </div>
                    <div class="list-data">
                        <img src="<?php echo $gambar2 ?>" alt="<?php echo $kartu2; ?>" width="80px">
                        <p><strong><?php echo $kartu2; ?> :</strong> <?php echo $desk2; ?></p>
                    </div>
                    <div class="list-data">
                        <img src="<?php echo $gambar3 ?>" alt="<?php echo $kartu3; ?>" width="80px">
                        <p><strong><?php echo $kartu3; ?> :</strong> <?php echo $desk3; ?></p>
                    </div>
                    <div class="col-md-12 p0">
                        <h3 class="meet">authentity.id/tarotunes</h3>
                    </div>
                </div>
                <div class="text-center" style="margin-bottom: 3rem">
                <input type="hidden" value="<?php echo $Url; ?>" class="form-control" id="myInput">
                    <button onclick="downloadimage()" class="toolstip clickbtn btn-download">
                    <!-- <span class="tooltiptext" id="myTooltip">Download Dan Bagikan</span> <i class="fa fa-download"></i>  -->
                    share</button>
                </div>
                
            </div>
        </div>
    </div>
</div>
    <?php // $this->load->view("front/tarotunes/footer.php");?>
    <script src="<?php echo base_url('assets/tarotunes-html/js/jquery.js') ?>"></script> 
    <script src="<?php echo base_url('assets/tarotunes-html/js/bootstrap.js') ?>"></script> 
    <script src="<?php echo base_url('assets/front/soundroom/capture.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/front/js/jquery.js') ?>" type="text/javascript"></script>
   
    <script type="text/javascript">
        // function downloadimage() {
        //     var container = document.getElementById("screnshoot");
        //     html2canvas(container, { allowTaint: true }).then(function (canvas) {

        //         var link = document.createElement("a");
        //         document.body.appendChild(link);
        //         link.download = "<?php echo $name ?>.jpg";
        //         link.href = canvas.toDataURL();
        //         link.target = '_blank';
        //         link.click();
                
        //     });
        // }
        function downloadimage() {
            var container = document.getElementById("screnshoot");
            const csrfName = '<?= $this->security->get_csrf_token_name(); ?>';
            const csrfHash = '<?= $this->security->get_csrf_hash(); ?>';
            html2canvas(container, { allowTaint: true }).then(function (canvas) {
                canvas.toBlob(function(blob) {
                    var formData = new FormData();
                    formData.append('image', blob, 'screenshot.jpg');
                    formData.append(csrfName, csrfHash);
                    fetch('<?= base_url('tarotunes/share_media') ?>', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            console.log('URL Gambar:', data.url);
                            shareImage(data.url);
                        } else {
                            console.error('Gagal upload:', data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
                }, 'image/jpeg', 0.95);
            });
        }
        async function shareImage(imageUrl) {
            try {
                console.log(`clicked shareImageAsset: ${imageUrl}`);
                const fetchedImage = await fetch(imageUrl);
                const blobImage = await fetchedImage.blob();
                const fileName = imageUrl.split('/').pop();

                const filesArray = [
                    new File([blobImage], fileName, {
                        type: 'image/jpeg',
                        lastModified: Date.now(),
                    }),
                ];

                const shareData = {
                    title: fileName,
                    files: filesArray,
                    url: window.location.href,
                };

                if (navigator.canShare && navigator.canShare(shareData)) {
                    await navigator.share(shareData);
                    console.log('Berhasil dibagikan');
                } else {
                    alert('Fitur share tidak didukung di browser ini.');
                }
            } catch (err) {
                console.error('Gagal membagikan:', err);
            }
        }
        function myFunction() {
            var copyText = document.getElementById("myInput");
            navigator.clipboard.writeText(copyText.value);
            alert("Copied the text: " + copyText.value);
        }
    </script>
</body>
</html>