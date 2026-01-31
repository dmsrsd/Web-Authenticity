<?php
	@session_start(); 
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
		<link href="<?php echo base_url()?>assets/front/css/style-se.css?ver=<?=rand();?>" rel="stylesheet" /> 
		<script>//document.documentElement.className = 'js';</script> 
		<script>
			var base = '<?=base_url();?>';
			document.documentElement.className = 'js';
		</script> 
 
<!-- Google Tag Manager --> 
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-P4SKZ9R');</script>
<!-- End Google Tag Manager -->	
	</head>
	<body > 
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-P4SKZ9R"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
		
 
