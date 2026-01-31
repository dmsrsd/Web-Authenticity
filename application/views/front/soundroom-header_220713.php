<?php
	@session_start();
	//echo session_id(); 
	$top = $this->uri->segment(1);
	$top3 = $this->uri->segment(2);
	function cur($ini,$now){
		if($ini==$now){
			return "active";
		}
	}
	function cur2($ini,$now){
		global $top3;
			if($ini==$now){
				return "active";
			}
	}
?>
<!DOCTYPE html>
<html lang="id">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="<?php echo $website['meta_description'];?>">
		<meta name="keyword" content="<?php echo $website['meta_keyword'];?>">
		<meta name="author" content="Anggi Rahman Syamsuddin | 085817386747"> 
		<meta name="theme-color" content="#0053A0" />
		<meta name="msapplication-navbutton-color" content="#0053A0" />
		<meta name="apple-mobile-web-app-capable" content="yes" />
		<meta name="apple-mobile-web-app-status-bar-style" content="#0053A0" />		
		<link rel="icon" href="<?php echo base_url()?>uploads/<?php echo $website['meta_favicon'];?>">
		<meta http-equiv="Cache-control" content="public">
		
		<?php
			$ogimg = base_url()."assets/front/img/fb-icon-image.jpg";
			if(isset($website['meta_image'])){
				$ogimg = $website['meta_image'];
			}
		?>
		<meta name="twitter:card" content="summary_large_image">
		<meta name="twitter:site" content="">
		<meta name="twitter:creator" content="">
		<meta name="twitter:title" content="<?php echo $website['meta_title'].@$subtitle;?>">
		<meta name="twitter:description" content="<?php echo $website['meta_description'];?>">
		<meta name="twitter:image" content="<?php echo $ogimg;?>">
		
		<meta property="fb:app_id"  content="2153941954652615">
		<meta property="og:url" content="<?=(isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"?>">
		<meta property="og:type" content="website">
		<meta property="og:title" content="<?php echo $website['meta_title'].@$subtitle;?>">
		<meta property="og:description" content="<?php echo $website['meta_description'];?>">
		<meta property="og:image" content="<?php echo $ogimg;?>">		
		
		<title><?php echo $website['meta_title'].@$subtitle;?></title>
		<link href="<?php echo base_url()?>assets/front/css/bootstrap.css" rel="stylesheet" />
		<link href="<?php echo base_url()?>assets/front/css/font-awesome.css" rel="stylesheet" />
		<link href="<?php echo base_url()?>assets/front/css/style.css?r=<?=rand();?>" rel="stylesheet" />
		<link href="<?php echo base_url()?>assets/front/css/style-soundroom.css?r=<?=rand();?>" rel="stylesheet" />
		<link href="<?php echo base_url()?>assets/front/css/animations.css" rel="stylesheet" /> 
		<link href="<?php echo base_url()?>assets/datepicker/css/datepicker.css" rel="stylesheet" />  
		<script>//document.documentElement.className = 'js';</script> 
		<script>
			var base = '<?=base_url();?>';
			document.documentElement.className = 'js';
		</script> 
		<?php
			$page = @$this->uri->segment(1);
			if(isset($page)){
				$page2 = @$this->uri->segment(2);
				if($page!=""){
					if($page=="rewards"){
						if($page2!=""){
							echo "<style>body{background:#FFFFFF !important;}</style>"; 
						}
					}else{
						echo "<style>body{background:#FFFFFF !important;}</style>"; 
					}
				} 
			} 
		
		?>
<!-- Google Tag Manager --> 
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-P4SKZ9R');</script>
<!-- End Google Tag Manager -->	
	</head>
	<body  data-spy="scroll" data-target=".navbar" data-offset="10"> 
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-P4SKZ9R"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<style>
 
</style>
	<div class='containers'>
	<div class='rows'>
	<div class='col-md-12s'>
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    	  <div class="container"> 
		    <div class="navbar-header">
		      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-brand-centered">
		        <span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		      </button>
		      <div class="navbar-brand navbar-brand-centered"><a href='<?=base_url();?>soundroom'><img src='<?=base_url();?>uploads/room-top.png'></a></div>
		    </div>
 
		    <div class="collapse navbar-collapse" id="navbar-brand-centered">
		      <ul class="nav navbar-nav">
		        <li>
				<?php
					if(empty($this->datamember)){
						echo "<a href='".base_url()."login'>Login / Sign Up</a><br>"; 
					}else{
						echo "<a href='".base_url()."profile' class='name' style='font-family:dinbold;'>Hi!, ".ucwords($this->datamember['fullname'])."</a><br>"; 
					}
				?>				 
				</li>
		        <li><!--<a href="<?=base_url();?>soundroom" class='<?=cur("soundroom",$top);?>'>--><a href="https://www.authenticity.id/">Home</a></li>
		        <li><a href="<?=base_url();?>soundroom-mechanism" class='<?=cur("soundroom-mechanism",$top);?>'>Mechanism</a></li>
		      </ul>
		      <ul class="nav navbar-nav navbar-right">
		        <li><a href="<?=base_url();?>soundroom-vote" class='<?=cur("soundroom-vote",$top);?>'>Vote</a></li>
		        <li><a href="<?=base_url();?>soundroom-video" class='<?=cur("soundroom-video",$top);?>'>Video</a></li>
		        <li><a href="javascript:void(0);" class='menu-cari'><i class='fa fa-search'></i> Cari ...</a></li>		        
		      </ul>
		    </div>
		  </div>
		</nav>
    </div>
    </div>
    </div>
<br><br><br>
<div class='min-height'>