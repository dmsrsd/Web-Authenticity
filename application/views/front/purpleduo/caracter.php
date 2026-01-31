<div class="container-fluid">
    <div class="row p-2">
        <div class="col-12 col-lg-6 left-cont"><img src="<?php echo base_url('stat/purpleduo/preview/images/title_head_xs.png') ?>" class="logo_main"></div>
        <div class="col-12 col-lg-6 right-cont"><img src="<?php echo base_url('stat/purpleduo/preview/images/logo_pd.png') ?>" class="logo_pd_main"></div>
    </div>
</div>
<div class="container t-black">
    <div class="row">
        <div class="frame-quis element_glow">
            <div class="col-12 col-lg-6 p-4">
                <img  src="<?php echo base_url('stat/purpleduo/media/'.$character['gambar_kotak']) ?>" class="img-fluid">
                <!-- <img  src="<?php echo base_url('stat/purpleduo/preview/images/character/carakter.png') ?>" class="img-fluid"> -->
            </div>
            <div class="col-12 col-lg-6 p-4">
                <img src="<?php echo base_url('stat/purpleduo/preview/images/duo_verse.png') ?>" class="mb-4" style="width: 60%; margin: 0 auto;">
                <h1 class="mb-4"><strong><?php echo $character['genre'] ?></strong> </h1>
                <p><?php echo $character['deskripsi'] ?></p>
            </div>
            <div class="col-sm-12 text-center btn-frame">
            <a href="<?php echo base_url('card/'.$this->datamember['id']); ?>" class="btn btn-warning">DOWNLOAD CARD</a>
            </div>
    </div>
    </div> 
</div>