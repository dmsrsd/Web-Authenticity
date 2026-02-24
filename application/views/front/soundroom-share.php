<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $soundroom['judul'] ?></title>
	<link href="<?php echo base_url() ?>assets/front/css/bootstrap.css" rel="stylesheet" />
	<link href="<?php echo base_url() ?>assets/front/css/font-awesome.css" rel="stylesheet" />
    <link href="<?php echo base_url() ?>assets/front/css/soundroom.css?r=<?= rand(); ?>" rel="stylesheet" />
	<link href="<?php echo base_url() ?>assets/front/css/style-soundroom.css?r=<?= rand(); ?>" rel="stylesheet" />
	<link href="<?php echo base_url() ?>assets/front/soundroom/style-soundroom.css?r=<?= rand(); ?>" rel="stylesheet" />
    <script src="<?php echo base_url('assets/front/soundroom/capture.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/front/js/jquery.js') ?>" type="text/javascript"></script>
    <script type="text/javascript">
        function downloadimage() {
            var container = document.getElementById("screnshoot");
            html2canvas(container, { allowTaint: true }).then(function (canvas) {

                var link = document.createElement("a");
                document.body.appendChild(link);
                link.download = "<?php echo $soundroom['judul'] ?>.jpg";
                link.href = canvas.toDataURL();
                link.target = '_blank';
                link.click();
                
            });
        }
        function myFunction() {
            var copyText = document.getElementById("myInput");
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            navigator.clipboard.writeText(copyText.value);
            alert("Copied the text: " + copyText.value);
        }
        document.addEventListener('DOMContentLoaded', function() {
            var audio = document.getElementById('audio');
            var playPauseBtn = document.querySelector('.sb-playpause');
            var icon = playPauseBtn.querySelector('i');

            playPauseBtn.addEventListener('click', function() {
                if (audio.paused) {
                    audio.play();
                    icon.classList.remove('fa-play');
                    icon.classList.add('fa-pause');
                } else {
                    audio.pause();
                    icon.classList.remove('fa-pause');
                    icon.classList.add('fa-play');
                }
            });
        });

    </script>
    <style>
        @font-face {
            font-family: 'Exetegue';
            font-style: normal;
            font-weight: normal;
            src: local('Exetegue'), url('<?php echo base_url();?>assets/front/css/Exetegue.otf') format('truetype');
        }
        .exetegue {
            font-family: 'Exetegue', serif !important;
            text-transform: uppercase;
        }
        .label-title > p.exetegue {
            letter-spacing: 1px;
        }
        .container-width{
            max-width: 450px;
            position: relative;
            margin: 0px auto;
            text-align: center;
            padding-top: 15px;
            margin-bottom: 100px;
        }        
        .soundbar {
            max-width: 450px;
            position: fixed;
            left: 50%;
            transform: translateX(-50%);
            text-align: left;
        }
        a.sb-playpause {
            float: inline-end;
        }
		body{
			background-image: url("<?php echo base_url();?>assets/front/soundroom/bg_story.jpg");
			background-size: cover;
            background-repeat: no-repeat;
		}
        .container {
           background-color: rgba(0,0,0,0.30);
           background-image: url("<?php echo base_url();?>assets/front/soundroom/bg-hitam.png");
			background-size: cover;
            background-repeat: no-repeat;
            position:relative;
            max-width: 365px;
            max-height: 800px;
            margin: 0px auto;
			margin-top: 30px;
            text-align: center;
            color: #fff;
            padding-top: 15px;
        }
        .cont_photo{
            display: block;
            position: relative;
            overflow: hidden;
            width: 100%;
            background-color: #fff;
            margin-top:20px;
            
        }
        .place_photo{
            width: 100%;
            height: 300px;
            background-image: url("<?php echo base_url();?>uploads/soundroom/<?php echo $soundroom['image'];?>");
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;

        }
        .label-gambar {
            position: absolute;
            top: 65%;
            text-align: center;
            width: 100%;
        }
        .label-gambar > h1 {
            background-color: #04549b;
            width: fit-content;
            margin: 0px auto;
            padding: 10px 20px 0px 20px;
        }
        p {
            font-size: 16px;
        }
        p.bg-black {
            background-color: #000;
            width: fit-content;
            margin: 0px auto;
            padding: 0px 10px;
        }
        .label-title {
            padding: 30px 30px 30px 30px;
        }
        .label-title > p {
            margin-bottom: 0px;
        }
        .label-title > img {
            margin: 20px;
            width:200px;
        }
        button.clickbtn {
            background: #04549b;
            border: 1px solid #000;
            color: #fff;
            width: 222px;
            margin: 20px auto;
            display: flex;
            font-size: 16px;
            justify-content: center;
            padding: 5px;
        }
        @media only screen and (max-width: 460px) {
		.container-width{
            max-width: 450px;
            position: relative;
            margin: 0px auto;
            text-align: center;
            padding-top: 15px;
            margin-bottom: 100px;
        }  
			.container {
           background-color: rgba(0,0,0,0.30);
            position:relative;
            max-width: 70%;
            max-height: 800px;
            margin: 0px auto;
			margin-top: 30px;
            text-align: center;
            color: #fff;
            padding-top: 15px;
        }
			.label-title {
 				 padding: 20px;
			}
			.label-title p{
 				 font-size: 14px;
			}
			.label-title > img {
  				margin: 20px;
  				width: 160px;
			}
            .place_photo{
                width: 100%;
                height: 220px;
                background-image: url("<?php echo base_url();?>uploads/soundroom/<?php echo $soundroom['image'];?>");
                background-position: center;
                background-size: cover;
                background-repeat: no-repeat;
            }
            .label-gambar {
                position: absolute;
                top: 70%;
                text-align: center;
                width: 100%;
            }
            .label-gambar > h1 {
                background-color: #04549b;
                width: fit-content;
                margin: 0px auto;
                padding: 5px 20px;
                font-size: 28px;
            }
        }
        button.clickbtn i.fa {
            margin-right: 10px;
            margin-top: 3px;
        }
        .d-flex {
            display: flex;
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
        .tek-uk{text-align: left;}
        .tek-uk p{font-size:12px;line-height: 20px;
        }
        .tek-uk li{
            text-align: left;
            font-size:12px;line-height: 20px;
        }
        .logo_ig{
            position: absolute;
            text-align: center;
            height: 50px;
            top: 7px;
            z-index: 999;
            width: 92%;
        }
    .img-fluid{width: 50%;}
    </style>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-5Q5GBNF');
    </script>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-NCH9H63EHN"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-NCH9H63EHN');
    </script>
    <!-- End Google Tag Manager -->
</head>
<body>    
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5Q5GBNF"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
        <?php
            // Dapatkan skema (http atau https)
            $scheme = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';

            // Dapatkan nama host
            $host = $_SERVER['HTTP_HOST'];

            // Dapatkan path dan query string
            $requestUri = $_SERVER['REQUEST_URI'];

            // Gabungkan semuanya menjadi satu URL lengkap
            //https://www.authenticity.id/soundroom/share/1536?year=2023&utm_source=sroom24&utm_medium=sroom24visitor&utm_campaign=sr24reza%20aden&utm_id=sroom24visitor&utm_term=sroom24visitor)
            if($_GET['utm_medium'] == 'sroom24visitor'){
                $labelling = "Hey ".$soundroom['judul']." Gue dukung lo buat manggung di Soundroom.";
                $fullUrl = "Hey ".$soundroom['judul']." Gue dukung lo buat manggung di Soundroom. Cek di webnya Authenticity ya ".$scheme . '://' . $host . $requestUri;
            }else{    
                $labelling = "Gas submit band lo di Authenticity Soundroom kayak gue.";
                $fullUrl = "Gas submit band lo di Authenticity Soundroom kayak gue. Cek di webnya Authenticity ya ".$scheme . '://' . $host . $requestUri;
            }
        ?>
        <div class="container tek-uk">
                <p>Buat lo yang udah submit ke Authenticity Soundroom, ada satu langkah penting yang WAJIB lo lakuin:</p>
                <ul>
                <li>Download template feed-nya</li>
                <li>Posting di Instagram band lo</li>
                <li>Buat caption semenarik mungkin dan jangan lupa mention & tag @authenticity_id + pakai hashtag #AuthenticitySoundroomSubmission</li>
        </ul>
<p>
Jangan sampe ketinggalan! Ini langkah penting biar band lo makin dilirik!</p>
            </div>
        <div class="container" id="screnshoot">
            <div class="logo_ig">
                <img src="<?php echo base_url('assets/front/img/soundroom/logo.png') ?>" class="img-fluid">
            </div>
            <div class="cont_photo">
                <div class="place_photo"></div>
                <div class="label-gambar">
                    <h1 class="title-items exetegue"><?php echo $soundroom['judul'] ?></h1>
                    <p><?php echo $soundroom['provinsi'] ?></p>
                </div>
            </div>
            
            <div class="label-title">
                <p class="exetegue"><?php echo $labelling; ?></p>
                <p class="bg-black">authenticity.id/soundroom</p>
                <!-- <img src="<?php echo base_url('assets/front/img/soundroom/logo.png') ?>"> -->
            </div>
        </div>
        <div class="container-width">
            <input type="text" value="<?php echo $fullUrl; ?>" class="form-control" id="myInput">

            <div class="d-flex">
                <button onclick="myFunction()" onmouseout="outFunc()" class="toolstip clickbtn"><span class="tooltiptext" id="myTooltip">Copy Dan Bagikan</span> <i class="fa fa-copy"></i> Copy Text</button>
                <button onclick="downloadimage()" onmouseout="outFunc()" class="toolstip clickbtn"><span class="tooltiptext" id="myTooltip">Download Dan Bagikan</span> <i class="fa fa-download"></i> Download</button>
            </div>
            <audio id="audio" src="<?php echo base_url('uploads/soundroom/'.$soundroom['sound']) ?>"></audio>
            <div class='soundbar'>
                <div class='row'>
                    <div class='col-xs-6'>
                        <table width="100%" cellpadding="0" cellspacing="0">
                            <tbody><tr>
                                <td><img class="img-soundbar" height="70" src="<?php echo base_url();?>uploads/soundroom/<?php echo $soundroom['thumbnail'];?>"></td>
                                <td width="100%">
                                    <div class="namaband-soundbar"><?php echo $soundroom['judul'] ?></div>
                                    <div class="kota-soundbar"><?php echo $soundroom['provinsi'] ?></div>
                                </td>
                            </tr>
                        </tbody></table>
                    </div>
                    <div class='col-xs-6'>
                        <div class="icon-soundbar-wrapper">
                            <table width='100%' cellpadding='0' cellspacing='0' class='icon-soundbar'>
                                <tr>
                                    <!-- <td width='16%' class="hide-mobile">
                                        <a href='javascript:void(0);' class='sb-random onof disabled' data-type='suffle'><i class='fa fa-random'></i></a>
                                    </td>
                                    <td width='16%' class="hide-mobile">
                                        <a href='javascript:void(0);' class='sb-backward'><i class='fa fa-step-backward'></i></a>
                                    </td> -->
                                    <td width=''>
                                        <a href='javascript:void(0);' class='sb-playpause' data-audio="" data-progress1="" data-band="" data-slug=""><i class='fa fa-play'></i></a>
                                    </td>
                                    <!-- <td width='16%' class="hide-mobile">
                                        <a href='javascript:void(0);' class='sb-forward'><i class='fa fa-step-forward'></i></a>
                                    </td>
                                    <td width='16%' class="hide-mobile">
                                        <a href='javascript:void(0);' class='sb-repeat onof' data-type='repeat'><i class='fa fa-repeat'></i></a>
                                    </td>
                                    <td width='16%' class="hide-mobile">
                                        <a href='javascript:void(0);' class='sb-heart disabled'><i class='fa fa-heart'></i></a>
                                    </td> -->
                                </tr>
                            </table>
                        </div>
                    </div>
                    <!-- <div class='col-sm-2'>
                        <div class="slidecontainer hide-mobile">
                            <input id="vol-control" class="slider" type="range" min="0" max="100" step="1" value='50' oninput="SetVolume(this.value)" onchange="SetVolume(this.value)"></input>
                        </div>
                    </div>
                    <div class='col-sm-4'>
                        <div class="soundbar-progress">
                            <div id='timecur' class="hide-mobile" style='margin-top:0px; color:#FFFFFF;float:right;margin-right:10px;'>
                                00:00
                            </div>
                            <div class="slidecontainer" style='width:80%;float:right'>
                                <input id="srek-control" class="slider" type="range" min="0" max="100" step="1" value='0' oninput="SetSrek(this.value)" onchange="SetSrek(this.value)"></input>
                            </div>
                            <div id='timedur' class="hide-mobile" style='margin-top:0px; color:#FFFFFF;float:right;margin-left:10px;'>
                                00:00
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-1">
                        <div class="icon-soundbar-wrapper">
                            <a href='javascript:void(0);' class='sb-share'><i class="fa fa-share-alt"></i></a>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
        
</body>
</html>