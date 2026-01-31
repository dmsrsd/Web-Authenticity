<?php
@session_start();
//echo session_id();
$top = $this->uri->segment(1);
$top3 = $this->uri->segment(2);
function cur($ini, $now)
{
	if ($ini == $now) {
		return "active";
	}
}
function cur2($ini, $now)
{
	global $top3;
	if ($ini == $now) {
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
	<meta name="description" content="<?php echo $website['meta_description']; ?>">
	<meta name="keyword" content="<?php echo $website['meta_keyword']; ?>">
	<meta name="author" content="Anggi Rahman Syamsuddin | 085817386747">
	<meta name="theme-color" content="#0053A0" />
	<meta name="msapplication-navbutton-color" content="#0053A0" />
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="apple-mobile-web-app-status-bar-style" content="#0053A0" />
	<link rel="icon" href="<?php echo base_url() ?>uploads/<?php echo $website['meta_favicon']; ?>">
	<meta http-equiv="Cache-control" content="public">

	<?php
	$ogimg = base_url() . "assets/front/img/fb-icon-image.jpg";
	if (isset($website['meta_image'])) {
		$ogimg = $website['meta_image'];
	}
	?>
	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:site" content="">
	<meta name="twitter:creator" content="">
	<meta name="twitter:title" content="<?php echo $website['meta_title'] . @$subtitle; ?>">
	<meta name="twitter:description" content="<?php echo $website['meta_description']; ?>">
	<meta name="twitter:image" content="<?php echo $ogimg; ?>">

	<meta property="fb:app_id" content="2153941954652615">
	<meta property="og:url" content="<?= (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" ?>">
	<meta property="og:type" content="website">
	<meta property="og:title" content="<?php echo $website['meta_title'] . @$subtitle; ?>">
	<meta property="og:description" content="<?php echo $website['meta_description']; ?>">
	<meta property="og:image" content="<?php echo $ogimg; ?>">

	<title><?php echo $website['meta_title'] . @$subtitle; ?></title>
	<link href="<?php echo base_url() ?>assets/front/css/bootstrap.css" rel="stylesheet" />
	<link href="<?php echo base_url() ?>assets/front/css/font-awesome.css" rel="stylesheet" />
	<link href="<?php echo base_url() ?>assets/front/css/style.css?r=<?= rand(); ?>" rel="stylesheet" />
	<link href="<?php echo base_url() ?>assets/front/css/style-soundroom.css?r=<?= rand(); ?>" rel="stylesheet" />
	<link href="<?php echo base_url() ?>assets/front/css/podcast.css?rand=<?= rand(); ?>" rel="stylesheet" />
	<link href="<?php echo base_url() ?>assets/front/css/animations.css" rel="stylesheet" />
	<link href="<?php echo base_url() ?>assets/datepicker/css/datepicker.css" rel="stylesheet" />
	<link href="<?php echo base_url() ?>assets/front/css/soundroom.css?r=<?= rand(); ?>" rel="stylesheet" />
	<script>
		//document.documentElement.className = 'js';
	</script>
	<script>
		var base = '<?= base_url(); ?>';
		document.documentElement.className = 'js';
	</script>
	<?php
	$page = @$this->uri->segment(1);
	if (isset($page)) {
		$page2 = @$this->uri->segment(2);
		if ($page != "") {
			if ($page == "rewards") {
				if ($page2 != "") {
					echo "<style>body{background:#FFFFFF !important;}</style>";
				}
			} else {
				echo "<style>body{background:#FFFFFF !important;}</style>";
			}
		}
	}

	?>
	<!-- Google Tag Manager -->
	<script>
		(function(w, d, s, l, i) {
			w[l] = w[l] || [];
			w[l].push({
				'gtm.start': new Date().getTime(),
				event: 'gtm.js'
			});
			var f = d.getElementsByTagName(s)[0],
				j = d.createElement(s),
				dl = l != 'dataLayer' ? '&l=' + l : '';
			j.async = true;
			j.src =
				'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
			f.parentNode.insertBefore(j, f);
		})(window, document, 'script', 'dataLayer', 'GTM-5Q5GBNF');
	</script>
	<!-- End Google Tag Manager -->
</head>

<body data-spy="scroll" data-target=".navbar" data-offset="10">
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5Q5GBNF" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->

	<nav class="navbar navbar-soundroom navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header" id="myGroup">
				<button style="margin-left:15px;" type="button" class="pull-left navbar-toggle collapsed navbar-icon-menu" data-toggle="collapse" data-target="#navbarx" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<button style="margin-right:15px;" type="button" class=" pull-right navbar-toggle collapsed navbar-icon-search">
					<span class="sr-only">Toggle navigation</span>
					<i class="fa fa-search"></i>
				</button>
				<div class="navbar-brand">
					<a href='<?= base_url(); ?>soundroom'>
						<?php
							$season = isset($_GET['year']) ? $_GET['year'] : '';
							$logo_img = 'assets/front/img/soundroom/logo.png';
							switch ($season) {
								case '2019':
									$logo_img = 'assets/front/img/AUTHENTICITY_SOUNDROOM_2019.png';
									break;
								case '2022':
									$logo_img = 'assets/front/img/soundroom-pestapora-x.png';
									break;

								default:
									$logo_img = 'assets/front/img/soundroom/logo.png';
									break;
							}
						?>
						<!-- <img src='<?= base_url(); ?>assets/front/img/soundroom/logo.png'> -->
						<img src="<?= base_url().$logo_img; ?>">
					</a>
				</div>
			</div>

			<div id="navbar" class="navbar-collapse collapse" aria-expanded="false" style="height: 1px;">
				<ul class="nav navbar-nav menu-mobile">
					<li>
						<a href="<?= base_url(); ?>">
							HOME
						</a>
					</li>
					<li class="dropdown">
						<?php
							$menu_label = 'Season';
							$season = isset($_GET['year']) ? $_GET['year'] : '';
							if($season != ''){
								$menu_label = 'Season '.$season;
							}
						?>
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?= $menu_label ?> </a>
                        <ul class="dropdown-menu">
                            <li><a href="#" class="sound-season" data-year="2023">2023</a></li>
                            <li><a href="#" class="sound-season" data-year="2022">2022</a></li>
                            <li><a href="#" class="sound-season" data-year="2019">2019</a></li>
                        </ul>
					</li>
					<?php if (empty($this->datamember)) { ?>
						<li>
							<a href="<?= base_url() ?>login?to=soundroom" class="text-warning">
								Login/Signup
							</a>
						</li>
					<?php } else { ?>
						<li>
							<a href="<?= base_url() ?>profile" class="text-warning">Hi, <?= ucwords($this->datamember['fullname']); ?></a>
						</li>
						<li>
							<a href="<?= base_url() ?>profile/out" class="text-warning">Sign Out</a>
						</li>
					<?php } ?>
					<li>
						<a href="javascript:void();" class="menu-cari nav-search">
							<i class='fa fa-search'></i>
						</a>
					</li>
				</ul>

			</div>
		</div>
	</nav>
	<div class='min-heights'>
