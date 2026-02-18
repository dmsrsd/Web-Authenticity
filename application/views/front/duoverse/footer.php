<div class="new-bs"><img src="<?=base_url('assets/duoverse-html')?>/images/circle01.png" class="circle"></div>
<div class="new-bs">
    <div class='footerbg'>
        <img src="<?=base_url('assets/duoverse-html')?>/images/bg-footer.png" class="img-fluid">
    </div>
    <div class='footerbg1'>
        <img src="<?=base_url('assets/duoverse-html')?>/images/bg-footer-m.png" class="img-fluid">
    </div>
    <footer class='footer1 container-fluid'>
        <div class='containers'>
            <div class='row justify-content-between'>
                <div class='col-lg-auto col-xs-12 text-left'>
                    <div class="footer-left">
                        <div class="footer-left__logo">
                            <a href="https://clas-mild.com/" target="_blank">
                                <img src='<?=base_url('assets/duoverse-html')?>/images/iniasligue.png' />
                            </a>
                        </div>
                        <div class="foter-left__nav">
                            <a href='<?php echo base_url() ?>'><img src='<?=base_url('assets/duoverse-html')?>/images/logow.png' style='width:120px;'></a>
                            <div class='text-left2'>
                                2025 Authenticity. All Rights Reserved.
                                <br>
                                <a href='<?php echo base_url("tentang") ?>' style="color:white;">About</a> |
                                <a href='<?php echo base_url("tnc") ?>' style="color:white;">Terms &amp; Condition</a> |
                                <a href='<?php echo base_url("privacy") ?>' style="color:white;">Privacy Policy</a> |
                                <a href='<?php echo base_url("article") ?>' style="color:white;">Article</a>
                            </div>
                        </div>
                    </div>

                </div>
                <div class='col-lg-auto order-md-2 order-1'>
                    <p class="text-uppercase mb-0 text-md-start text-center">STAY CONNECTED WITH authenticity.id</p>
                    <div class='link-topsosmed'>
                        <a href='https://www.tiktok.com/@authenticity_id' target='_blank'><img src='<?=base_url('assets')?>/front/img/socmed/tiktok.png'> Authenticity_id</a>
                        <a href='https://instagram.com/authenticity_id' target='_blank'><img src='<?=base_url('assets')?>/front/img/socmed/ig.png'> authenticity_id</a>
                        <a href='https://www.youtube.com/channel/UCCRi6YZ63-6HT7L8nD3Lvhw' target='_blank'><img src='<?=base_url('assets')?>/front/img/socmed/yt.png'> Authenticity ID</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>
<script src="<?=base_url('assets/front/js/jquery.js')?>" type="text/javascript"></script>
<?php  //if ($this->cookie == "") { ?>
    <footer class='footer2 banner-ads' id="BannerAds">
        <div class='container content-ads'>
            <button class="btn-close-red close-ads" id="CloseAds"  title="Close"><i class='fa fa-times'></i></button>
            <a href="<?php echo base_url('duoverse/') ?>" target="_blank" class="warning-desktop">
                <img class="image-ads" src='<?php echo base_url() ?>assets/front/img/profile/banner-ads-duoverse.gif'>
            </a>
            <a href="<?php echo base_url('duoverse/') ?>" target="_blank" class="warning-mobile">
                <img class="image-ads" src='<?php echo base_url() ?>assets/front/img/profile/banner-ads-duoverse-m.gif'>
            </a>
        </div>
    </footer>
    <script>
        $('#CloseAds').click(function() {
            $('#BannerAds').hide();
        });
    </script>
<?php //} ?>
