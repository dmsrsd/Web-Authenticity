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
    <script src="https://www.authenticity.id/assets/front/js/jquery.js" type="text/javascript"></script>
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
        function togglePlay(e, progresss, slug, band, kota, img, loved) {
            soundbar(slug, band, kota, img, loved);
            //e = e || window.event;
            var btn = e.childNodes;
            var audio = document.getElementById('audio');
            var dataprogress = e.getAttribute(progresss);
            var dataaudiosoundroom = e.getAttribute('data-audio');
            var datanow = e.getAttribute('data-now');
            var repeat = document.getElementById('repeat').value;
            var timer;
            var percent = 0;
            var allaudio = document.getElementsByTagName("audio");
            var plke = document.getElementById("pl-now").value;
            var beforeplay = document.getElementsByClassName('pl-' + plke);

            beforeplay[0].childNodes[0].className = 'fa fa-play';
            document.getElementById("pl-now").value = datanow;
            document.getElementById("pl-done").value = "0";
            audio.src = dataaudiosoundroom;

            i = allaudio.length;
            var allicon = document.getElementsByClassName('fa-pause'),
                ic = allicon.length;
            audio.addEventListener("playing", function(_event) {
                var duration = _event.target.duration;
                advance(duration, audio);
            });
            audio.addEventListener("pause", function(_event) {
                clearTimeout(timer);
                document.getElementById("pl-done").value = '1';
            });

            var cur = document.querySelector('#timecur'),
                dur = document.querySelector('#timedur');
            audio.addEventListener('timeupdate', function(e) {
                cur.textContent = sToTime(e.target.currentTime);
                dur.textContent = sToTime(e.target.duration);
            });
            var advance = function(duration, element) {
                var progress = document.getElementById(dataprogress);
                increment = 10 / duration;
                percent = Math.min(increment * element.currentTime * 10, 100);
                progress.style.width = percent + '%'
                startTimer(duration, element);
                var srek = document.getElementById('srek-control');
                srek.value = percent;
            }
            var startTimer = function(duration, element) {
                if (percent < 100) {
                    timer = setTimeout(function() {
                        advance(duration, element)
                    }, 100);

                }
            }
            var soundbarplaypause = document.getElementsByClassName('sb-playpause');
            var listnow = document.getElementsByClassName('pl-' + datanow);

            soundbarplaypause[0].setAttribute('data-progress1', dataprogress);
            soundbarplaypause[0].setAttribute('data-audio', dataaudiosoundroom);
            soundbarplaypause[0].setAttribute('data-band', slug);

            if (soundbarplaypause[0].childNodes[0].className == 'fa fa-pause') {
                soundbarplaypause[0].childNodes[0].className = 'fa fa-play';
                listnow[0].childNodes[0].className = 'fa fa-play';
                audio.pause();
            } else {
                var player = document.getElementById('audio');
                player.volume = 50 / 100;
                var playerseek = document.getElementById('audio');
                //playerseek.seekable.end(0);
                soundbarplaypause[0].childNodes[0].className = 'fa fa-pause';
                listnow[0].childNodes[0].className = 'fa fa-pause';
                audio.play();
            }


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
        .container {
            position:relative;
            max-width: 500px;
            margin: 0px auto;
            text-align: center;
            color: #fff;
            margin-bottom:100px;
        }
        
        #screnshoot{            
            background-image: url("<?php echo base_url('assets/front/soundroom/bg_story.jpg') ?>");
            background-size: cover;
            background-repeat: no-repeat;
            position:relative;
            max-width: 450px;
            max-height: 800px;
            margin: 0px auto;
            text-align: center;
            color: #fff;
            background-color: #04549b;
            padding-top: 15px;
            padding-left: 15px;
            padding-right: 15px;
        }
        .label-gambar {
            position: absolute;
            bottom: 280px;
            text-align: center;
            width: 100%;
        }
        .label-gambar > h1 {
            background-color: #04549b;
            width: fit-content;
            margin: 0px auto;
            padding: 0px 20px;
        }
        p {
            font-size: 20px;
        }
        p.bg-black {
            background-color: #000;
            width: fit-content;
            margin: 0px auto;
            padding: 0px 10px;
        }
        .label-title {
            padding: 30px;
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
            width: 49%;
            margin: 20px auto;
            display: flex;
            font-size: 16px;
            justify-content: center;
            padding: 5px;
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
            width: 200px;
            background-color: #555;
            color: #fff;
            text-align: center;
            border-radius: 6px;
            padding: 5px;
            position: absolute;
            z-index: 1;
            bottom: 150%;
            left: 50%;
            margin-left: -75px;
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
        .soundbar {
            max-width: 500px;
            position: absolute;
            bottom: -150px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div id="screnshoot" >
            <?php if(isset($soundroom['id_soundroom']) && $soundroom['id_soundroom'] != '' && $soundroom['image'] != ''): ?>
                <img src='<?php echo base_url();?>uploads/soundroom/<?php echo $soundroom['image'];?>' width='100%' class='img'>
            <?php endif?>
            <div class="label-gambar">
                <h1 class="title-items"><?php echo $soundroom['judul'] ?></h1>
                <p><?php echo $soundroom['provinsi'] ?></p>
            </div>
            <div class="label-title">
                <p>dengerin lagu asik ini di</p>
                <p class="bg-black">authenticity.id/soundroom</p>
                <img src="<?= base_url('assets/front/img/soundroom/logo-2024.png'); ?>">
            </div>
        </div>
        <!-- The text field -->
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
                $fullUrl = "Band gw udah submit lagu di Soundroom. Cek di webnya Authenticity ya ".$scheme . '://' . $host . $requestUri;
            }else{
                $fullUrl = "Gue dukung band ini buat manggung di Soundroom Pestapora. Cek di webnya Authenticity ya ".$scheme . '://' . $host . $requestUri;
            }
        ?>
        <input type="text" value="<?php echo $fullUrl; ?>" class="form-control" id="myInput">

        <!-- The button used to copy the text -->
        <div class="d-flex">
            <button onclick="myFunction()" onmouseout="outFunc()" class="toolstip clickbtn"><span class="tooltiptext" id="myTooltip">Copy Dan Bagikan</span> <i class="fa fa-copy"></i> Copy Text</button>
            <button onclick="downloadimage()" onmouseout="outFunc()" class="toolstip clickbtn"><span class="tooltiptext" id="myTooltip">Download Dan Bagikan</span> <i class="fa fa-download"></i> Download</button>
        </div>
        <audio id="audio" src="<?php echo base_url('uploads/soundroom/'.$soundroom['sound']) ?>"></audio>
        <div class='soundbar'>
            <div class='row'>
                <div class='col-sm-6'>
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
                <div class='col-sm-6'>
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
        
        <input type='hidden' id='repeat' value='1'>
        <input type='hidden' id='suffle' value='0'>
        <input type='hidden' id='pl-list' value=''>
        <input type='hidden' id='pl-now' value='1'>
        <input type='hidden' id='pl-done' value='0'>        
    </div>
</body>
</html>