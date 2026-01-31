<head>
    <?php $this->load->view("front/duoverse/header.php");?>
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
                            <img src="<?=base_url('assets/duoverse-html')?>/images/logo_duoverse.png" class="">
							<p  class="caption">Ikut Movement, Bawa Temen, dan Dapetin Excitement!</p>
                            <span><img src="<?=base_url('assets/duoverse-html')?>/images/button" alt=""></span>
                        </div>
                    </div>
                 </div>
            </div> 
            <div class="container" style="background-color: black; color: #fff;">
                <div class="row board-center">
                    <div class="col-sm-12 col-lg-3">
                        <h2>Leader</br>Board</h2>
                    </div>
                    <div class="col-sm-12 col-lg-8">
                        <p class="text-board" style="color: #fff; margin-top: 30px;">Share link, dapet poin. Temen klik, dapet lagi bonus poin!.</p>
                    </div>  
                </div>
                <div class="row name">
                    <div class="col-sm-12 col-lg-3"></div>
                    <div class="col-sm-12 col-lg-3 text-center"><h3>USERNAME</h3></div>
                    <div class="col-sm-12 col-lg-3 text-center"><h3>INSTAGRAM</h3></div>
                    <div class="col-sm-12 col-lg-3 text-center"><h3>POIN</h3></div>
                </div>
                <?php
                foreach($list_point as $row){
                    if($row['pp']!=""){
                        $pp = base_url()."uploads/pp/".$row['pp'];
                    }else{
                        $pp = base_url()."uploads/nopp.png";
                    }
                ?>
                
                <div class="row table">
                    <div class="col-sm-12 col-lg-3 tablecell">
                        <div class="frame-foto"><img src="<?= $pp ?>" class="img-fluid"></div>
                    </div>
                    <div class="col-sm-12 col-lg-3 tablecell"><?php echo $row['fullname'] ?></div>
                    <div class="col-sm-12 col-lg-3 tablecell"><?php echo $row['instagram'] ?></div>
                    <div class="col-sm-12 col-lg-3 tablecell"><?php echo $row['total_poin'] ?></div>
                </div>
                <?php } ?>
                
                <!-- Pagination -->
                <div class="text-center mt-4">
                    <?= $pagination; ?>
                </div>
                <div class="row">
                    <div class="col-12 pd50">
                       <a href="<?=base_url('duoverse')?>" target="_self"> <img src="<?=base_url('assets/duoverse-html')?>/images/but-back.png"></a>
                    </div>
                </div>
            </div>        
        </main>
    </div>
    <?php $this->load->view("front/duoverse/footer.php");?>
    
  <!-- //moengage Start -->
		<script type="text/javascript">
		Moengage.track_event("Duoverse Circle", {
			"member": "<?php echo $this->datamember['id'] ?>",
			"halaman": "leaderboard duoverse"
		});
	</script>
	<!-- //moengage End -->
</body>
