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
<?php
	$kudu ="";
	@$page = $this->uri->segment(1);
	if(empty($this->datamember)){
		$kudu = " kudu-login";
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
						echo "<style>bodys{background:#FFFFFF !important;}</style>";
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

<!-- Global site tag (gtag.js) - Google Ads: 592941727 -->
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-592941727"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'AW-592941727');
</script>

<!-- Global site tag (gtag.js) - Google Ads: 400197189 -->
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-400197189"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'AW-400197189');
</script>

<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window,document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
 fbq('init', '2808783446063669');
fbq('track', 'PageView');
</script>
<noscript>
 <img height="1" width="1"
src="https://www.facebook.com/tr?id=2808783446063669&ev=PageView
&noscript=1"/>
</noscript>
<!-- End Facebook Pixel Code -->

<meta name="facebook-domain-verification" content="oasvsakpotut3wap2b4gn331lq8pzk" />

	</head>
	<body  data-spy="scroll" data-target=".navbar" data-offset="10">
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-P4SKZ9R"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
			<div class='top-nav'>
				<div class='container-fluid'>
				<div class='row'>
					<div class='col-sm-12'>
						<div class='header no-gutters  hidden-xs'>
							<div class='col-sm-4 hidden-xs'>
								<div class='link-login'>
									<?php
									if(empty($this->datamember)){
										echo "<i class='fa fa-user'></i> <a href='".base_url()."login'>Login</a> | <a href='".base_url()."register'>Sign Up</a><br>";
										// echo "<a style='margin-top:3px;' href='javascript:void(0);' class='cyp'>Check Your Point</a>";
									}else{
										echo "<a href='".base_url()."profile' class='name' style='font-family:dinbold;'>Hi!, ".ucwords($this->datamember['fullname'])."</a><br>";
										echo "<a href='".base_url()."profile/out'>Sign Out</a>";
									}
									?>
								</div>
							</div>
							<div class='col-sm-4 hidden-xs'>
								<div class='text-center'>
									<a href='<?=base_url()?>'><img src='<?php echo base_url()?>uploads/<?php echo $website['logo'];?>' style='width:200px;'></a>
								</div>
							</div>
							<div class='col-sm-4 hidden-xs'>
								<div class='text-right mt30'>
									<!--<a href='<?=base_url()?>soundroom' class='top-soundroom'><img src='<?php echo base_url()?>uploads/room-top.png' style='width:110px;'></a>-->
								</div>
							</div>
							<div class='cl'></div>
						</div>
					</div>
				</div>
				</div>
			</div>

			<nav class="navbar navbar-default " role="navigation"   id="nav" data-spy="affix" data-offset-top="100">
				<div class="container-fluid">
					<div class="navbar-header" id="myGroup">
						<button style='margin-left:15px;' type="button" class="pull-left navbar-toggle collapsed navbar-icon-menu" data-toggle="collapse" data-target="#navbarx" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						</button>
						<button style='margin-right:15px;' type="button" class=" pull-right navbar-toggle collapsed navbar-icon-search" >
							<span class="sr-only">Toggle navigation</span>
							<i class='fa fa-search'></i>
						</button>
						<div class="navbar-brand navbar-brand-centered"><a href='<?=base_url()?>'><img src='<?php echo base_url()?>uploads/logow.png' style='width:130px;'></a></div>
					</div>

					<div id="navbar" class="navbar-collapse collapse" aria-expanded="false" style="height: 1px;">
						<ul class="nav navbar-nav menu-mobile">
							<li class='din'><a href="<?=base_url()?>" style=' padding:16px 12px 10px 12px;'><i class='fa fa-home' style='font-size:23px; color:#FFFFFF;'></i></a></li>
							<?php
							if(empty($this->datamember)){
							?>
							<li class='din menu  hidden-sm hidden-md hidden-lg'><a href="<?=base_url()?>login">Login</a></li>
							<li class='din menu  hidden-sm hidden-md hidden-lg'><a href="<?=base_url()?>register">Sign Up</a></li>
							<?php
							}else{
							?>
							<li class='din menu  hidden-sm hidden-md hidden-lg'><a href="<?=base_url()?>profile">Hi, <?=ucwords($this->datamember['fullname']);?></a></li>
							<li class='din menu hidden-sm hidden-md hidden-lg'><a href="<?=base_url()?>profile/out">Sign Out</a></li>
							<?php }?>
							<!--<?php
								foreach($this->headkategori as $key=>$value){
									$len = strlen($value);
									$lenr = $len - 4;
									$val1 = substr($value,0,4);
									$val2 = substr($value,4,$lenr);
									switch($value){
										case "Classified Echoes":
											$totval = $val1."<span style='color:#FF1731;'>".$val2."</span>";
										break;
										case "Classified Space":
											$totval = $val1."<span style='color:#000000;'>".$val2."</span>";
										break;
										case "Classified Edge":
										break;
									}
									$totval = "<span style='color:#FF1731;'>".$val1."</span>".$val2;
									$top3 = $this->uri->segment(2);

									echo "<li class='dropdown menu-center'><a href='' class='dropdown-toggle ".cur2($key,$top3)." ' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>$totval</a>";
									echo "<ul class='dropdown-menu'>";
									$kats = $this->model_global->get_data(array('select' => '*', 'table' => 'kategori','where' => array('status' => 1,'head_kategori'=>$key), 'order_by' => 'nama asc'));
									foreach($kats as $kat){
										echo "<li><a href='".base_url()."category/$key/$kat[slug]'>$kat[nama]</a></li>";
									}
									if($key=="arts"){
										echo "<li><a href='".base_url()."poster-challenge'>Poster Challenge</a></li>";
									}
									echo "<li><a href='".base_url()."category/$key/all'>All</a></li>";
									echo "</ul>";
									echo "</li>";
								}
							?>-->
							<li class=' menu-center'><a href="<?=base_url()?>">INI ASLI GUE</a></li>
							<!--<li class=' menu-center'><a href="<?=base_url()?>darbotzlive/">DARBOTZ LIVE DRAWING</a></li>-->
							<!--<li class=' menu-center'><a href="<?=base_url()?>rewards">AUTHENTIC REWARDS</a></li>-->

							<?php if($kudu==""){ ?>
							<li class=' menu-center'><a href="<?=base_url()?>rewards">AUTHENTIC REWARDS</a>

							<?php }else{ ?>
							<li class=' menu-center'><a href="javascript:void(0);" class='btn btn-md <?php echo $kudu; ?>'>AUTHENTIC REWARDS</a></li>
							<?php } ?>



							<li class=' menu-center'><a href="<?=base_url()?>ticket" class="<?=cur("ticket",$top);?>">TICKET BOX</a></li>
							<li class=' menu-center'><a href="<?=base_url()?>lab" class="<?=cur("authentic-store",$top);?>">LAB</a></li>
							<!--<li class='din menu hidden-sm hidden-md hidden-lg'><a href="<?=base_url()?>soundroom"><img src='<?php echo base_url()?>uploads/toproom.png' style='width:110px;'></a></li>-->
						</ul>
						<form role="form" class="navbar-form navbar-right form-mobile" action="<?=base_url()?>search"  method="post" data-parsley-validate  autocomplete="off">
							<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
							<div class="container-fluid">
								<div class="row no-gutter">
									<div class="col-xs-2">
										<button type="button" class="btn btn-default btnsearch navbar-icon-search"><i class='fa fa-search'></i></button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</nav>

