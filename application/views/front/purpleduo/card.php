<div class="container-fluid">
    <div class="row p-2">
        <div class="col-12 col-lg-6 left-cont"><img src="<?php echo base_url('stat/purpleduo/preview/images/title_head_xs.png') ?>" class="logo_main"></div>
        <div class="col-12 col-lg-6 right-cont"><img src="<?php echo base_url('stat/purpleduo/preview/images/logo_pd.png') ?>" class="logo_pd_main"></div>
    </div>
</div>
<div class="container p-4 t-black">
    <div class="row">
        <div class="frame-card p-4 element_glow">
            <div class="col-12 col-lg-6 p-4 text-center">
                <img  src="<?php echo base_url('stat/purpleduo/media/'.$character['gambar_card']) ?>" class="img-fluid card">
            </div>
            <div class="col-12 col-lg-6 p-4">
                <img src="<?php echo base_url('stat/purpleduo/preview/images/duo_verse.png') ?>" class="mb-4" style="width: 60%; margin: 0 auto;">
                <h1 class="mb-4"><strong>HEI, <?php echo $items['nama_member'] ?></strong> </h1>
                <p>Download dan share character card lo ke sosmed</p>
                <div class="row" style="margin-top: 50px;">
                <div class="col-12 col-sm-6 col-lg-6 mb-4 pos">
                    <a href="<?php echo base_url('stat/purpleduo/media/'.$character['gambar_card']) ?>" download><button>Download <img src="<?php echo base_url('stat/purpleduo/preview/images/button_next.png') ?>"></button></a>
                </div>
                <div class="col-12 col-sm-6 col-lg-6 mb-4 pos">
                    <button data-toggle="modal" data-target="#exampleModal">Share <img src="<?php echo base_url('stat/purpleduo/preview/images/button_next.png') ?>"></button> 
                </div>
                </div>
            </div>
            <div class="col-sm-12 text-center btn-frame">
            <div><a href="<?php echo base_url('caracter') ?>" class="btn btn-warning">BACK HOME</a></div>
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
        <?php 
            $url= base_url('card/'.$items['member_id']);
            $judul= $items['nama_member'];
        ?>
        <a href="javascript:void(0);" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=<?php echo $url ?>', '_blank', 'width=600,height=600,scrollbars=yes,status=yes,resizable=yes,screenx=0,screeny=0');">
            <img src="<?php echo base_url('stat/purpleduo/preview/images/facebook.svg') ?>" alt="share facebook" width="30" height="30" loading="lazy">
        </a>
        <a href="javascript:void(0);" onclick="window.open('https://twitter.com/share?text=<?php echo $judul ?>&url=<?php echo $url ?>', '_blank', 'width=600,height=600,scrollbars=yes,status=yes,resizable=yes,screenx=0,screeny=0');">
            <img src="<?php echo base_url('stat/purpleduo/preview/images/twitter.svg') ?>" alt="share twitter" width="30" height="30" loading="lazy">
        </a>
        <a href="javascript:void(0);" onclick="window.open('https://telegram.me/share/url?text=<?php echo $judul ?>&url=<?php echo $url ?>', '_blank', 'width=600,height=600,scrollbars=yes,status=yes,resizable=yes,screenx=0,screeny=0');">
            <img src="<?php echo base_url('stat/purpleduo/preview/images/telegram.svg') ?>" alt="share telegram" width="30" height="30" loading="lazy">
        </a>
        <a href="javascript:void(0);" onclick="window.open('https://api.whatsapp.com/send?text=<?php echo $judul ?>%0a %0a<?php echo $url ?>%0a', '_blank', 'width=600,height=600,scrollbars=yes,status=yes,resizable=yes,screenx=0,screeny=0');">
            <img src="<?php echo base_url('stat/purpleduo/preview/images/whatsapp.svg') ?>" alt="share wa" width="30" height="30" loading="lazy">
        </a>
      </div>
      <div class="modal-footer mx-auto">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- end modal share -->