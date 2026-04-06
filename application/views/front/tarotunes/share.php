<?php 
    $type = isset($type) ? (int) $type : (isset($_GET['type']) ? (int) $_GET['type'] : 1);
    $memberId = !empty($this->datamember['id']) ? (int) $this->datamember['id'] : 0;
    $sendEmailUrl = $memberId > 0
        ? base_url('tarotunes/shareemails/'.$this->uri->segment(3).'?type='.$type.'&id='.$memberId)
        : '';
    if($type === 1){ 
        $gambar= base_url('assets/tarotunes-html/images/card/'. $kartu_1['gambar']);
        $kartu = $kartu_1['nama_kartu'];
        $desk = $kartu_1['down'];
    } else if($type === 2){ 
        $gambar= base_url('assets/tarotunes-html/images/card/'. $kartu_4['gambar']);
        $kartu = $kartu_4['nama_kartu'];
        $desk = $kartu_4['down'];
    } else { 
        $gambar= base_url('assets/tarotunes-html/images/card/'. $kartu_7['gambar']);
        $kartu = $kartu_7['nama_kartu'];
        $desk = $kartu_7['down'];
    } 
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
        <meta charset="utf-8"> 
        <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
        <title><?php echo $kartu; ?></title> 
        <meta name="description" content="<?php echo $desk; ?>">

        <!-- Mobile Metas --> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <link rel="stylesheet" href="<?php echo base_url('assets/tarotunes-html/css/bootstrap.css') ?>"> 
        <link rel="stylesheet" href="<?php echo base_url('assets/tarotunes-html/css/animate.css') ?>"> 
        <link rel="stylesheet" href="<?php echo base_url('assets/tarotunes-html/css/style.css') ?>"> 
        <link rel="stylesheet" href="<?php echo base_url('assets/tarotunes-html/css/global.css') ?>"> 

        <meta property="fb:app_id" content="2153941954652615"/>
        <meta property="og:title" content="<?php echo $kartu;  ?>"/>
        <meta property="og:description" content="<?php echo $desk;  ?>"/>
        <meta property="og:type" content="article"/>
        <meta property="og:url" content="<?php echo base_url('tarotunes/share/'.$this->uri->segment(3).'?type='.$type) ?>"/>
        <meta property="og:image" content="<?php echo $gambar;  ?>"> 
        <meta property="og:site_name" content="Authenticity">
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content=""/>
        <meta name="twitter:creator" content="">
        <meta name="twitter:title" content="<?php echo $kartu;  ?>">
        <meta name="twitter:description" content="Download dan share character lo ke sosmed">
        <meta name="twitter:image" content="<?php echo $gambar;  ?>">
        <meta name="twitter:url" content="<?php echo $gambar;  ?>" >
        <meta name="twitter:domain" content="<?php echo $gambar;  ?>">

        <!-- MOENGAGE START -->
        <script type="text/javascript">
            var moeDataCenter = "dc_6"; // Replace "DC" with the actual Data center value from the above table
            var moeAppID = "GZPAHVPBNRUL40E93ZF53429"; // Replace "WorkspaceID" available in the settings page of MoEngage Dashboard.
            var sdkVersion = "2"; // Replace this value with the version of Web SDK that you intend to use. It is recommended to use the format x (major)
                
            !function(e,n,i,t,a,r,o,d){if(!moeDataCenter||!moeDataCenter.match(/^dc_[0-9]+$/gm))return console.error("Data center has not been passed correctly. Please follow the SDK installation instruction carefully.");var s=e[a]=e[a]||[];if(s.invoked=0,s.initialised>0||s.invoked>0)return console.error("MoEngage Web SDK initialised multiple times. Please integrate the Web SDK only once!"),!1;e.moengage_object=a;var l={},g=function n(i){return function(){for(var n=arguments.length,t=Array(n),a=0;a<n;a++)t[a]=arguments[a];(e.moengage_q=e.moengage_q||[]).push({f:i,a:t})}},u=["track_event","add_user_attribute","add_first_name","add_last_name","add_email","add_mobile","add_user_name","add_gender","add_birthday","destroy_session","add_unique_user_id","update_unique_user_id","moe_events","call_web_push","track","location_type_attribute"],m={onsite:["getData","registerCallback"]};for(var c in u)l[u[c]]=g(u[c]);for(var v in m)for(var f in m[v])null==l[v]&&(l[v]={}),l[v][m[v][f]]=g(v+"."+m[v][f]);r=n.createElement(i),o=n.getElementsByTagName("head")[0],r.async=1,r.src=t,o.appendChild(r),e.moe=e.moe||function(){return(s.invoked=s.invoked+1,s.invoked>1)?(console.error("MoEngage Web SDK initialised multiple times. Please integrate the Web SDK only once!"),!1):(d=arguments.length<=0?void 0:arguments[0],l)},r.addEventListener("load",function(){if(d)return e[a]=e.moe(d),e[a].initialised=e[a].initialised+1||1,!0}),r.addEventListener("error",function(){return console.error("Moengage Web SDK loading failed."),!1})}(window,document,"script","https://cdn.moengage.com/release/"+moeDataCenter+"/versions/"+sdkVersion+"/moe_webSdk.min.latest.js","Moengage");
            
            Moengage = moe({
            app_id: moeAppID,
            debug_logs: 0
            });
        </script>
        <link rel="preconnect" href="https://cdn.moengage.com/" crossorigin />
        <link rel="dns-prefetch" href="https://cdn.moengage.com/" />
        <link rel="preconnect" href="https://sdk-06.moengage.com/" crossorigin />
        <link rel="dns-prefetch" href="https://sdk-06.moengage.com/" />
        <script src="https://cdn.moengage.com/release/dc_6/versions/2/moe_webSdk_webp.min.latest.js?app_id=GZPAHVPBNRUL40E93ZF53429&debug_logs=1"></script>
        <!-- MOENGAGE END -->
        <style>
            body, html {
                height: 100%;
                margin: 0;
            }

            .bg {
                /* The image used */
                background-image: url('<?php echo base_url("assets/tarotunes-html/images/bg_tarotunes.png"); ?>');
            
                /* Full height */
                height: 100%; 

                /* Center and scale the image nicely */
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
            }

            /* ===== Overlay Spinner ===== */
            .loader-overlay{
            position:fixed; inset:0; display:none;
            align-items:center; justify-content:center; gap:12px;
            background:rgba(17,24,39,.55); backdrop-filter:blur(2px);
            z-index:9999; font-family:system-ui, -apple-system, "Segoe UI", Roboto;
            color:#e5e7eb; text-align:center;
            }
            .loader-overlay.is-active{ display:flex; }
            .spinner{
            width:56px; height:56px; border-radius:50%;
            border:4px solid transparent;
            border-top-color:#22d3ee; border-right-color:#22d3ee;
            animation:spin .8s linear infinite !important;
            }
            .loader-text{ font-size:14px; letter-spacing:.2px; }
            @keyframes spin{ to{ transform:rotate(360deg); } }

            /* Motion-friendly */
            @media (prefers-reduced-motion: reduce){
            .spinner{ animation: none; border-top-color:#93c5fd; border-right-color:#93c5fd; }
            }

        </style>
        
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
		
		
    </head>
<body>

<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5Q5GBNF" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WH8ZRXFD" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
	
<div class="loader-overlay " id="appLoader" aria-live="polite" aria-busy="true">
  <div class="spinner"></div>
  <p class="loader-text">Loading…</p>
</div>
<div class="bg">
    <div class="container-full">
        <div class="row header">
            <div class="col-md-6 text-left"><img src="<?php echo base_url("assets/tarotunes-html/images/logo_tarotunes_single.png"); ?>"></div>
            <div class="col-md-6 text-right" style="top:15px"><img src="<?php echo base_url("assets/tarotunes-html/images/auth-white.png"); ?>"></div>
        </div>
        <div class="row header2">
            <div class="col-md-12 text-center"><img src="<?php echo base_url("assets/tarotunes-html/images/logo_tarotunes_m.png"); ?>"></div>
        </div>
    </div>
    <div class="container">
        <div class="row row-card">
            <div class="col-md-12">
                <h2>Download dan Share</h2>
            </div>
        </div>
        <div class="row row-card2 bg-white">
            <?php if($type === 1){ ?> 
                <div class="col-md-2">
                    <div class="row">
                        <div class="col-xs-4 col-md-12 detil-card">
                            <img src="<?php echo base_url('assets/tarotunes-html/images/card/'. $kartu_1['gambar']) ?>" alt="<?php echo $kartu_1['nama_kartu']; ?>">
                        </div>
                        <div class="col-xs-4 col-md-12 detil-card">
                            <img src="<?php echo base_url('assets/tarotunes-html/images/card/'. $kartu_2['gambar']) ?>" alt="<?php echo $kartu_2['nama_kartu']; ?>">
                        </div>
                        <div class="col-xs-4 col-md-12 detil-card">
                            <img src="<?php echo base_url('assets/tarotunes-html/images/card/'. $kartu_3['gambar']) ?>" alt="<?php echo $kartu_3['nama_kartu']; ?>">
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <h3 class="detil-card-up">Opening Track</h3>
                    <h2 class="detil-card-up2"><?php echo $kartu_1['nama_kartu']; ?>, <?php echo $kartu_2['nama_kartu']; ?>, <?php echo $kartu_3['nama_kartu']; ?></h2>
                    <p><?php echo $kartu_1['up']; ?></p>
                    <p><?php echo $kartu_2['up']; ?></p>
                    <p><?php echo $kartu_3['up']; ?></p>
                    <p></p>
                </div>
            <?php } else if($type === 2){ ?>
                <div class="col-md-2">
                    <div class="row">
                        <div class="col-xs-4 col-md-12 detil-card">
                            <img src="<?php echo base_url('assets/tarotunes-html/images/card/'. $kartu_4['gambar']) ?>" alt="<?php echo $kartu_4['nama_kartu']; ?>">
                        </div>
                        <div class="col-xs-4 col-md-12 detil-card">
                            <img src="<?php echo base_url('assets/tarotunes-html/images/card/'. $kartu_5['gambar']) ?>" alt="<?php echo $kartu_5['nama_kartu']; ?>">
                        </div>
                        <div class="col-xs-4 col-md-12 detil-card">
                            <img src="<?php echo base_url('assets/tarotunes-html/images/card/'. $kartu_6['gambar']) ?>" alt="<?php echo $kartu_6['nama_kartu']; ?>">
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <h3 class="detil-card-up">Now Playing</h3>
                    <h2 class="detil-card-up2"><?php echo $kartu_4['nama_kartu']; ?>, <?php echo $kartu_5['nama_kartu']; ?>, <?php echo $kartu_6['nama_kartu']; ?></h2>
                    <p><?php echo $kartu_4['up']; ?></p>
                    <p><?php echo $kartu_5['up']; ?></p>
                    <p><?php echo $kartu_6['up']; ?></p>
                    <p></p>
                </div>
            <?php } else { ?>
                <div class="col-md-2">
                    <div class="row">
                        <div class="col-xs-4 col-md-12 detil-card">
                            <img src="<?php echo base_url('assets/tarotunes-html/images/card/'. $kartu_7['gambar']) ?>" alt="<?php echo $kartu_7['nama_kartu']; ?>">
                        </div>
                        <div class="col-xs-4 col-md-12 detil-card">
                            <img src="<?php echo base_url('assets/tarotunes-html/images/card/'. $kartu_8['gambar']) ?>" alt="<?php echo $kartu_8['nama_kartu']; ?>">
                        </div>
                        <div class="col-xs-4 col-md-12 detil-card">
                            <img src="<?php echo base_url('assets/tarotunes-html/images/card/'. $kartu_9['gambar']) ?>" alt="<?php echo $kartu_9['nama_kartu']; ?>">
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <h3 class="detil-card-up">Encore</h3>
                    <h2 class="detil-card-up2"><?php echo $kartu_7['nama_kartu']; ?>, <?php echo $kartu_8['nama_kartu']; ?>, <?php echo $kartu_9['nama_kartu']; ?></h2>
                    <p><?php echo $kartu_7['up']; ?></p>
                    <p><?php echo $kartu_8['up']; ?></p>
                    <p><?php echo $kartu_9['up']; ?></p>
                    <p></p>
                </div>
            <?php } ?>
        </div>
        <div class="row box-share">
            <div class="col-md-4 text-center">
                <a href="<?php echo base_url('tarotunes/share/'.$this->uri->segment(3)); ?>" class="btn-download">Back</a>
            </div>
            <div class="col-md-4 text-center">
            <?php if($memberId > 0){ ?>
                <a href="" class="btn-download"><div onclick="kirimData(this,'<?php echo $sendEmailUrl; ?>')">Send E Mail</div></a>
            <?php } else { ?>
                <a href="<?php echo base_url('login?to=tarotunes'); ?>" class="btn-download">Login to Send Email</a>
            <?php } ?>
            </div>
            <div class="col-md-4 text-center">
                <a href="<?php echo base_url('tarotunes/download/'.$this->uri->segment(3).'?type='.$type); ?>" class="btn-download">Share</a>
                <!-- <div class="btn-download text-center" onclick="sharePage()">Share</div> -->
            </div>
        </div>
        
        
    </div>
</div>
    <?php $this->load->view("front/tarotunes/footer.php");?>
	
    <?php if (!empty($member['email'])) { ?>
	<script type="text/javascript">
		Moengage.track_event("Tarotunes", {
		"email": "<?php echo $member['email'] ?>",
		"halaman": "share tarotunes"
    });
	</script>
    <?php } ?>
	
    <script>
        // Fungsi Share
        function sharePage() {
            if (navigator.share) {
                navigator.share({
                title: document.title,
                url: window.location.href
                })
                .then(() => document.getElementById('message').textContent = 'Berhasil dibagikan!')
                .catch((error) => document.getElementById('message').textContent = 'Gagal membagikan: ' + error);
            } else {
                document.getElementById('message').textContent = 'Fitur share tidak didukung di browser ini.';
            }
        }
        //fungsi kirim email
        const loader = document.getElementById('appLoader');
        function kirimData(el,url) {
            el.removeAttribute('onclick');
            el.classList.remove('disabled');
            loader.classList.add('is-active');
            $.ajax({
                url: url,
                method: 'GET',
                success: function(response) {
                    alert("Berhasil Di simpan ke Email Lo!");
                    el.textContent = 'Email Sent';
                    console.log(response);
                    loader.classList.remove('is-active');
                },
                error: function(xhr, status, error) {
                    alert("Jaringan sibuk coba lagi nanti");
                    console.log(xhr.responseText);
                    loader.classList.remove('is-active');
                }
            });
        }
    </script>

</body>
</html>