<link href="<?=base_url()?>assets/selectize/selectize.default.css" rel="stylesheet" />
<br><br><br>
<div class='min-height'>
	<div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default box-login-1" style="box-shadow: 0 0 8px #e2e2e2;">
                    <div class="panel-body">
                        <div ><h1 align='center' STYLE='font-family:auth;color:#0053A0; font-size:50px;'>TERIMAKASIH</h1></div>
                        <img class="shadow-log" src="<?=base_url()?>assets/front/img/shadow.png">
						<div style='font-family:din; text-align:center; font-size:20px;'>Biar aman, cek email (inbox/spam) lo dan lakukan verifikasi<!-- Silakan Login langsung ya.--></div>
						<br>
                    </div>
                    <div class="panel-footer" style='background-color:#FFFFFF;'>
                      <div class="row">
                        <div class="col-md-12">
                        </div>
                      </div>
                      <div class="row">
                            <div class="col-sm-12">
								  <?php
								  $se ="";
									if(isset($_GET['se'])){
										if($_GET['se']=="wxwKQMOtmjWd9G2qsbNlDQb9E52PgrVQwUId9UlUz2ZcIQDANCj2HSs66aq29SjREGdc1Uf8PcfvvwlcGtw"){
											$se ="?se=".$_GET['se'];
										}
									}								  ?>
								  <a href='<?=base_url()."login".$se?>'><i class='fa fa-lock'></i> Login Here</a>
                            </div>
                        </div>
						<br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('front/podcast/footerfp');?>
