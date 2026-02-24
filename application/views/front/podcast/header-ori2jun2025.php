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
<?php
$kudu = "";
@$page = $this->uri->segment(1);
if (empty($this->datamember)) {
	$kudu = " kudu-login";
}

?>
<!DOCTYPE html>
<html lang="id">

<head>
<!-- GRID!! -->


<!-- MOENGAGE START -->

<script type="text/javascript">
var moeDataCenter = "dc_6"; // Replace "DC" with the actual Data center value from the above table
var moeAppID = "GZPAHVPBNRUL40E93ZF53429"; // Replace "WorkspaceID" available in the settings page of MoEngage Dashboard.
var sdkVersion = "2"; // Replace this value with the version of Web SDK that you intend to use. It is recommended to use the format x (major)
      
!function(e,n,i,t,a,r,o,d){if(!moeDataCenter||!moeDataCenter.match(/^dc_[0-9]+$/gm))return console.error("Data center has not been passed correctly. Please follow the SDK installation instruction carefully.");var s=e[a]=e[a]||[];if(s.invoked=0,s.initialised>0||s.invoked>0)return console.error("MoEngage Web SDK initialised multiple times. Please integrate the Web SDK only once!"),!1;e.moengage_object=a;var l={},g=function n(i){return function(){for(var n=arguments.length,t=Array(n),a=0;a<n;a++)t[a]=arguments[a];(e.moengage_q=e.moengage_q||[]).push({f:i,a:t})}},u=["track_event","add_user_attribute","add_first_name","add_last_name","add_email","add_mobile","add_user_name","add_gender","add_birthday","destroy_session","add_unique_user_id","update_unique_user_id","moe_events","call_web_push","track","location_type_attribute"],m={onsite:["getData","registerCallback"]};for(var c in u)l[u[c]]=g(u[c]);for(var v in m)for(var f in m[v])null==l[v]&&(l[v]={}),l[v][m[v][f]]=g(v+"."+m[v][f]);r=n.createElement(i),o=n.getElementsByTagName("head")[0],r.async=1,r.src=t,o.appendChild(r),e.moe=e.moe||function(){return(s.invoked=s.invoked+1,s.invoked>1)?(console.error("MoEngage Web SDK initialised multiple times. Please integrate the Web SDK only once!"),!1):(d=arguments.length<=0?void 0:arguments[0],l)},r.addEventListener("load",function(){if(d)return e[a]=e.moe(d),e[a].initialised=e[a].initialised+1||1,!0}),r.addEventListener("error",function(){return console.error("Moengage Web SDK loading failed."),!1})}(window,document,"script","https://cdn.moengage.com/release/"+moeDataCenter+"/versions/"+sdkVersion+"/moe_webSdk.min.latest.js","Moengage");
 
Moengage = moe({
  app_id: moeAppID,
  debug_logs: 1
});
</script>

<link rel="preconnect" href="https://cdn.moengage.com/" crossorigin />
<link rel="dns-prefetch" href="https://cdn.moengage.com/" />
<link rel="preconnect" href="https://sdk-06.moengage.com/" crossorigin />
<link rel="dns-prefetch" href="https://sdk-06.moengage.com/" />
<script src="https://cdn.moengage.com/release/dc_6/versions/2/moe_webSdk_webp.min.latest.js?app_id=GZPAHVPBNRUL40E93ZF53429&debug_logs=1"></script>

	<meta http-equiv="Content-Security-Policy" content="default-src 'self'; connect-src 'self' https://*.moengage.com https://sdk-06.moengage.com https://cdn.moengage.com; script-src 'self' 'unsafe-eval' https://app.midtrans.com/snap/snap.js https://cdn.moengage.com 'unsafe-inline'; style-src 'self' 'unsafe-inline' *.moengage.com; img-src 'self' data:; font-src 'self' *.moengage.com;">

<!-- MOENGAGE END -->


<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-2S17WRC5V6"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-2S17WRC5V6');
</script>

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-NCH9H63EHN"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-NCH9H63EHN');
</script>

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-H5SRWHD89B"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-H5SRWHD89B');
</script>



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
	<link href="<?php echo base_url() ?>assets/front/css/animations.css" rel="stylesheet" />
	<link href="<?php echo base_url() ?>assets/datepicker/css/datepicker.css" rel="stylesheet" />
	<link href="<?php echo base_url() ?>assets/front/css/podcast.css?rand=<?= rand(); ?>" rel="stylesheet" />
	<!-- FancyBox -->
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/front/css/fancyapps.css" />
	<link href="<?php echo base_url() ?>assets/front/css/soundroom.css?r=<?= rand(); ?>" rel="stylesheet" />
	<link href="<?php echo base_url() ?>stat/merch/select2/select2.min.css?r=<?= rand(); ?>" rel="stylesheet" />
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
				echo "<style>bodys{background:#FFFFFF !important;}</style>";
			}
		}
	}

	?>

	<!-- Google tag (gtag.js) -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-J3S21SJ94V"></script>
	<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());

	gtag('config', 'G-J3S21SJ94V');
	</script>

	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-5Q5GBNF');</script>
	<!-- End Google Tag Manager -->

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-103854955-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];

		function gtag() {
			dataLayer.push(arguments);
		}
		gtag('js', new Date());

		gtag('config', 'UA-103854955-1');
	</script>


	<!-- Global site tag (gtag.js) - Google Ads: 592941727 -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=AW-592941727"></script>
	<script>
		window.dataLayer = window.dataLayer || [];

		function gtag() {
			dataLayer.push(arguments);
		}
		gtag('js', new Date());

		gtag('config', 'AW-592941727');
	</script>

	<!-- Global site tag (gtag.js) - Google Ads: 400197189 -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=AW-400197189"></script>
	<script>
		window.dataLayer = window.dataLayer || [];

		function gtag() {
			dataLayer.push(arguments);
		}
		gtag('js', new Date());

		gtag('config', 'AW-400197189');
	</script>

	<?php if (!is_localhost()): ?>
	<!-- Facebook Pixel Code -->
	<script>
		! function(f, b, e, v, n, t, s) {
			if (f.fbq) return;
			n = f.fbq = function() {
				n.callMethod ?
					n.callMethod.apply(n, arguments) : n.queue.push(arguments)
			};
			if (!f._fbq) f._fbq = n;
			n.push = n;
			n.loaded = !0;
			n.version = '2.0';
			n.queue = [];
			t = b.createElement(e);
			t.async = !0;
			t.src = v;
			s = b.getElementsByTagName(e)[0];
			s.parentNode.insertBefore(t, s)
		}(window, document, 'script',
			'https://connect.facebook.net/en_US/fbevents.js');
		fbq('init', '2808783446063669');
		fbq('track', 'PageView');
	</script>
	<noscript>
		<img height="1" width="1" src="https://www.facebook.com/tr?id=2808783446063669&ev=PageView
&noscript=1" />
	</noscript>
	<!-- End Facebook Pixel Code -->
	<?php endif; ?>

	<meta name="facebook-domain-verification" content="oasvsakpotut3wap2b4gn331lq8pzk" />

	<!-- Event snippet for Page view conversion page -->
	<script>
		gtag('event', 'conversion', {
			'send_to': 'AW-400197189/Q6f6CKGPs_YCEMWM6r4B'
		});
	</script>

	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-WH8ZRXFD');</script>
	<!-- End Google Tag Manager -->
<style>
	.main {
  padding-top: 95px;
}
</style>
</head>

<body data-spy="scroll" data-target=".navbar" data-offset="10">

	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5Q5GBNF" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WH8ZRXFD" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
	<div class='top-nav hide'>
		<div class='container-fluid'>
			<div class='row'>
				<div class='col-sm-12'>
					<div class='header no-gutters  hidden-xs'>
						<div class='col-sm-4 hidden-xs'>
							<div class='link-login'>
								<?php
								if (empty($this->datamember)) {
									echo "<i class='fa fa-user'></i> <a href='" . base_url() . "login'>Login</a> | <a href='" . base_url() . "register'>Sign Up</a>";
								} else {
									echo "<a href='" . base_url() . "profile' class='name' style='font-family:dinbold;'>Hi!, " . ucwords($this->datamember['fullname']) . "</a><br>";
									echo "<a href='" . base_url() . "profile/out'>Sign Out</a>";
								}
								?>
							</div>
						</div>
						<div class='col-sm-4 hidden-xs'>
							<div class='text-center'>
								<a href='<?= base_url() ?>'><img src='<?php echo base_url() ?>uploads/<?php echo $website['logo']; ?>' style='width:200px;'></a>
							</div>
						</div>
						<div class='col-sm-4 hidden-xs'>
							<div class='text-right mt30'>
								<!--<a href='<?= base_url() ?>soundroom' class='top-soundroom'><img src='<?php echo base_url() ?>uploads/room-top.png' style='width:110px;'></a>-->
							</div>
						</div>
						<div class='cl'></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<nav class="navbar navbar-default navbar-fixed-top navbar-main">
		<div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbarMain" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="/">
					<img src="<?php echo base_url() ?>uploads/logocity2.png" alt="Authenticity">
				</a>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="navbarMain">
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Playlist</a>
						<ul class="dropdown-menu">
							<!-- <li><a href="/?sectionId=sectionDistrik" data-dynamic-id="sectionDistrik">Distrik</a></li>
							<li><a href="/?sectionId=sectionBackstage" data-dynamic-id="sectionBackstage">Backstage</a></li>
							<li><a href="/?sectionId=sectionLuarClas" data-dynamic-id="sectionLuarClas">Luar Clas</a></li>
							<li><a href="/?sectionId=sectionJournal" data-dynamic-id="sectionJournal">Journal</a></li>
							<li><a href="/?sectionId=sectionInSession" data-dynamic-id="sectionInSession">In Session</a></li>
							<li><a href="/?sectionId=sectionSoundroom" data-dynamic-id="sectionSoundroom">Soundroom</a></li>
							<li><a href="/?sectionId=sectionOotd" data-dynamic-id="sectionOotd">OOTD</a></li>
							<li><a href="/?sectionId=sectionSpace" data-dynamic-id="sectionSpace">Space</a></li> -->
							<?php foreach ($playlist_menu as $row) { ?>
								<li><a href="<?php echo site_url('?sectionId=section-'.$row['slug'].'#section-'.$row['slug'].'-heading');?>" data-dynamic-id="section-<?php echo ($row['slug']); ?>"><?php echo ($row['section_name']); ?></a></li>
							<?php } ?>
						</ul>
					</li>
					<li><a href="<?php echo site_url('podcast/naik-kelas'); ?>">Podcast Naik Clas</a></li>
					<li><a href="<?php echo site_url('lab'); ?>">Authenticity Lab</a></li>
					<li><a href="<?php echo site_url('soundroom?year=2025'); ?>">Soundroom</a></li>
					<?php if (empty($this->datamember)) { ?>
						<li class="navbar-nav__auth">
							<a href="<?= base_url() ?>login">Login/Sign Up</a>
						</li>
					<?php } else { ?>
						<li><a href="<?= base_url() ?>profile">Hi, <?= ucwords($this->datamember['fullname']); ?></a></li>
						<li><a href="<?= base_url() ?>profile/out">Sign Out</a></li>
					<?php } ?>
					<li>
						<a href="#" class="navbar-nav__search"><i class='fa fa-search'></i></a>
					</li>
				</ul>
			</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav>
