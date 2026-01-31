<!DOCTYPE html>
<html>
    <?php $this->load->view("front/tarotunes/head.php");?>
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
        }
    </style>
<body> 
<div class="bg">
    <div class="container-full">
        <div class="row header">
            <div class="col-md-6 text-left"><img src="<?php echo base_url("assets/tarotunes-html/images/logo_tarotunes_single.png"); ?>"></div>
            <div class="col-md-6 text-right" style="top:15px"><img src="<?php echo base_url("assets/tarotunes-html/images/auth-white.png"); ?>"></div>
        </div>
        <div class="row header2">
            <div class="col-md-12 text-center"><img src="<?php echo base_url("assets/tarotunes-html/images/logo_tarotunes_m.png"); ?>"></div>
        </div>
    </div>
    <div class="container">
        <div class="row row-card">
            <div class="col-md-12">
                <h2 class="baru">Arti 3(tiga) Kartu Pilihanmu</h2>
            </div>
        </div>
        <div class="row row-card2">
        <div class="col-md-2">
                <div class="row">
                    <div class="col-xs-4 col-md-12 detil-card">
                        <img src="<?php echo base_url('assets/tarotunes-html/images/card/'. $kartu_1['gambar']) ?>" alt="<?php echo $kartu_1['nama_kartu']; ?>">
                    </div>
                    <div class="col-xs-4 col-md-12 detil-card">
                        <img src="<?php echo base_url('assets/tarotunes-html/images/card/'. $kartu_2['gambar']) ?>" alt="<?php echo $kartu_2['nama_kartu']; ?>">
                    </div>
                    <div class="col-xs-4 col-md-12 detil-card">
                        <img src="<?php echo base_url('assets/tarotunes-html/images/card/'. $kartu_3['gambar']) ?>" alt="<?php echo $kartu_3['nama_kartu']; ?>">
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <h3 class="detil-card-up">Opening Track</h3>
                <h2 class="detil-card-up2"><?php echo $kartu_1['nama_kartu']; ?>, <?php echo $kartu_2['nama_kartu']; ?>, <?php echo $kartu_3['nama_kartu']; ?></h2>
                <p><?php echo $kartu_1['up']; ?></p>
                <p><?php echo $kartu_2['up']; ?></p>
                <p><?php echo $kartu_3['up']; ?></p>
                <p></p>
                <a href="<?php echo base_url('tarotunes/share/'.$this->uri->segment(3).'?type=1'); ?>" class="btn-download">DOWNLOAD</a>
            </div>
        </div>
        <div class="row row-card2">
            <div class="col-md-2">
                <div class="row">
                    <div class="col-xs-4 col-md-12 detil-card">
                        <img src="<?php echo base_url('assets/tarotunes-html/images/card/'. $kartu_4['gambar']) ?>" alt="<?php echo $kartu_4['nama_kartu']; ?>">
                    </div>
                    <div class="col-xs-4 col-md-12 detil-card">
                        <img src="<?php echo base_url('assets/tarotunes-html/images/card/'. $kartu_5['gambar']) ?>" alt="<?php echo $kartu_5['nama_kartu']; ?>">
                    </div>
                    <div class="col-xs-4 col-md-12 detil-card">
                        <img src="<?php echo base_url('assets/tarotunes-html/images/card/'. $kartu_6['gambar']) ?>" alt="<?php echo $kartu_6['nama_kartu']; ?>">
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <h3 class="detil-card-up">Now Playing</h3>
                <h2 class="detil-card-up2"><?php echo $kartu_4['nama_kartu']; ?>, <?php echo $kartu_5['nama_kartu']; ?>, <?php echo $kartu_6['nama_kartu']; ?></h2>
                <p><?php echo $kartu_4['up']; ?></p>
                <p><?php echo $kartu_5['up']; ?></p>
                <p><?php echo $kartu_6['up']; ?></p>
                <p></p>
                <a href="<?php echo base_url('tarotunes/share/'.$this->uri->segment(3).'?type=2'); ?>" class="btn-download">DOWNLOAD</a>
            </div>
        </div>
        <div class="row row-card2">
            <div class="col-md-2">
                <div class="row">
                    <div class="col-xs-4 col-md-12 detil-card">
                        <img src="<?php echo base_url('assets/tarotunes-html/images/card/'. $kartu_7['gambar']) ?>" alt="<?php echo $kartu_7['nama_kartu']; ?>">
                    </div>
                    <div class="col-xs-4 col-md-12 detil-card">
                        <img src="<?php echo base_url('assets/tarotunes-html/images/card/'. $kartu_8['gambar']) ?>" alt="<?php echo $kartu_8['nama_kartu']; ?>">
                    </div>
                    <div class="col-xs-4 col-md-12 detil-card">
                        <img src="<?php echo base_url('assets/tarotunes-html/images/card/'. $kartu_9['gambar']) ?>" alt="<?php echo $kartu_9['nama_kartu']; ?>">
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <h3 class="detil-card-up">Encore</h3>
                <h2 class="detil-card-up2"><?php echo $kartu_7['nama_kartu']; ?>, <?php echo $kartu_8['nama_kartu']; ?>, <?php echo $kartu_9['nama_kartu']; ?></h2>
                <p><?php echo $kartu_7['up']; ?></p>
                <p><?php echo $kartu_8['up']; ?></p>
                <p><?php echo $kartu_9['up']; ?></p>
                <p></p>
                
                <a href="<?php echo base_url('tarotunes/share/'.$this->uri->segment(3).'?type=3'); ?>" class="btn-download">DOWNLOAD</a>
            </div>
        </div>
    </div>
    <div class="container-full" style="background-color: #000;">
        <div class="container">
            <div class="row row-card2" style="margin-bottom: 50px;">
                <div class="col-md-2">
                    <div class="row">
                        <div class="col-md-12 detil-card2">
                        <img src="<?php echo base_url('assets/tarotunes-html/images/card/'. $kartu_10['gambar']) ?>" alt="<?php echo $kartu_10['nama_kartu']; ?>">
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <h3 class="detil-card-up">Skip Track</h3>
                    <span style="font-size: 10px; color: #fff; font-weight: 100; padding-left: 5px; display: block;">(Kartu yang lo lewatin, tapi sebenernya ngasih hint vibe tersembunyi di balik shuffle lo.)</span>
                    <h2 class="detil-card-up2"><?php echo $kartu_10['nama_kartu']; ?></h2>
                    <p><?php echo $kartu_10['up']; ?></p>
                </div>

            </div>
        </div>
    </div>
</div>
</body>
</html>