<!DOCTYPE html>
<html>
<head>
    <?php 
        header("Content-Security-Policy: font-src 'self' data: https://fonts.gstatic.com https://fonts.googleapis.com;");
    ?>
    <?php 
        if($this->uri->segment(3)==1){ 
            $url= base_url('assets/elite-html/images/flower.jpeg');
            $kartu ="the flow";
            //$desk = "Smooth talker, smoth walker,lo peka, cair, dan bisa bikin semua orang nyaman tanpa kehilangan";
        } else if($this->uri->segment(3)==2){ 
            $kartu ="the hidden edge";
            $url= base_url('assets/elite-html/images/star.jpeg');
            //$desk = "ga banyak bicara,tapi tajamnya terasa elegan dari dalam,dan makin lo diam,makin orang penasaran";
        } else { 
            $kartu ="the slow burner";
            $url= base_url('assets/elite-html/images/love.jpeg');
            //$desk = "Tenang, tapi selalu ninggalin bekas."
        } 
        $desk = "Download dan share character lo ke sosmed";
    ?>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
	<meta charset="utf-8"> 
	<meta http-equiv="X-UA-Compatible" content="IE=edge"> 
	<title><?php echo $kartu;  ?></title> 
	<meta name="description" content="<?php echo $desk;  ?>">

	<!-- Mobile Metas --> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
	<link rel="stylesheet" href="<?php echo base_url('assets/elite-html/css/bootstrap.css') ?>"> 
	<link rel="stylesheet" href="<?php echo base_url('assets/elite-html/css/animate.css') ?>"> 
	<link rel="stylesheet" href="<?php echo base_url('assets/elite-html/css/style.css') ?>"> 
	<link rel="stylesheet" href="<?php echo base_url('assets/elite-html/css/global.css') ?>"> 
    <link href="https://www.authenticity.id/assets/front/css/font-awesome.css" rel="stylesheet">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Electrolize&family=Goldman&display=swap" rel="stylesheet">
    <link rel="canonical" href="https://www.authenticity.id/elite/download/<?php echo $this->uri->segment(3) ?>"/>
    <meta property="fb:app_id" content="2153941954652615"/>
    <meta property="og:title" content="<?php echo $kartu;  ?>"/>
    <meta property="og:description" content="<?php echo $desk;  ?>"/>
    <meta property="og:type" content="article"/>
    <meta property="og:url" content="https://www.authenticity.id/elite/download/<?php echo $this->uri->segment(3) ?>"/>
    <meta property="og:image" content="<?php echo $url;  ?>"> 
    <meta property="og:site_name" content="Authenticity">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content=""/>
    <meta name="twitter:creator" content="">
    <meta name="twitter:title" content="<?php echo $kartu;  ?>">
    <meta name="twitter:description" content="Download dan share character lo ke sosmed">
    <meta name="twitter:image" content="<?php echo $url;  ?>">
    <meta name="twitter:url" content="<?php echo $url;  ?>" >
    <meta name="twitter:domain" content="<?php echo $url;  ?>">
  
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
		<img height="1" width="1" src="https://www.facebook.com/tr?id=2808783446063669&ev=PageView&noscript=1" />
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
</head>
<body class="circle h-full"> 
    <div class="container-full">
        <div class="row p-2">
            <div class="col-md-6"></div>
            <div class="col-md-6 text-right">
                <img src="<?php echo base_url('assets/elite-html') ?>/images/logo_small.png" class="">
            </div>
        </div>
    </div>
	<div class="container-full"> 
			<div class="container">
				<div class="row">
					<div class="col-md-12 box-head"><p id="message"></p></div>
					<div class="col-md-12 box-body" style="min-height: 300px">
						<div class="row">
							<div class="col-md-4">
                                <img src="<?php echo $url; ?>" class="img-responsive">
							</div>
							<div class="col-md-8">
								<p></p>
								<div class="row">
									<div class="col-md-12 text-center"><h3 class="button-nav2 text-but" onclick="kirimData(this,'<?php echo base_url('elite/shareemails/'.$this->uri->segment(3).'?id='.$this->datamember['id']); ?>')" style="cursor: pointer;">Send Email
                                    </h3></div>
									<div class="col-md-12 text-center"><h3 class="button-nav2 text-but" id="shareFileBtn"  style="cursor: pointer;">Share
                                    </h3></div>
									<div class="col-md-12 text-center"><h3 class="button-nav2 text-but"><a id="download" href="<?php echo $url ?>" target="_blank" download>Download</a>
                                    </h3></div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-12 box-foot"></div>
				</div>
			</div>
            <div class="container">
                <div class="col-md-12 text-center">
                    <div class="button-nav"> 
                        <div class="row">
                            <div class="col-md-12 text-center"><h3 class="text-but">
								<a href="<?php echo base_url() ?>">Back to Home</a>
							</h3></div>
                        </div>
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
            
            <a href="javascript:void(0);" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=<?php echo $url ?>', '_blank', 'width=600,height=600,scrollbars=yes,status=yes,resizable=yes,screenx=0,screeny=0');">
                <img src="<?php echo base_url('stat/purpleduo/preview/images/facebook.svg') ?>" alt="share facebook" width="30" height="30" loading="lazy">
            </a>
            <a href="javascript:void(0);" onclick="window.open('https://twitter.com/share?text=<?php echo $kartu ?>&url=<?php echo $url ?>', '_blank', 'width=600,height=600,scrollbars=yes,status=yes,resizable=yes,screenx=0,screeny=0');">
                <img src="<?php echo base_url('stat/purpleduo/preview/images/twitter.svg') ?>" alt="share twitter" width="30" height="30" loading="lazy">
            </a>
            <a href="javascript:void(0);" onclick="window.open('https://telegram.me/share/url?text=<?php echo $kartu ?>&url=<?php echo $url ?>', '_blank', 'width=600,height=600,scrollbars=yes,status=yes,resizable=yes,screenx=0,screeny=0');">
                <img src="<?php echo base_url('stat/purpleduo/preview/images/telegram.svg') ?>" alt="share telegram" width="30" height="30" loading="lazy">
            </a>
            <a href="javascript:void(0);" onclick="window.open('https://api.whatsapp.com/send?text=<?php echo $kartu ?>%0a %0a<?php echo $url ?>%0a', '_blank', 'width=600,height=600,scrollbars=yes,status=yes,resizable=yes,screenx=0,screeny=0');">
                <img src="<?php echo base_url('stat/purpleduo/preview/images/whatsapp.svg') ?>" alt="share wa" width="30" height="30" loading="lazy">
            </a>
            <a href="https://www.instagram.com/username/" target="_blank" rel="noopener">
                <img src="<?php echo base_url('stat/purpleduo/preview/images/instagram.svg') ?>" alt="share instagram" width="30" height="30" loading="lazy">
            </a>

        </div>
        <div class="modal-footer mx-auto">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
    </div>
	<!-- content --> 
    <?php $this->load->view("front/elite/footer.php");?>
    <script>
        let isSharing = false;

        function sharePage() {
            $('#exampleModal').modal('show');
            
            // if (isSharing) return; // Cegah klik ganda
            // isSharing = true;
            // Pas visitor klik tombol share di Result 
            Moengage.track_event("Define your elite", {
                "email": "<?php echo $member['email'] ?>",
                "tombol": "share"
            });
            // if (navigator.share) {
            //     navigator.share({
            //         // title: document.title,
            //         // url: window.location.href
            //     })
            //     .then(() => {
            //         //document.getElementById('message').textContent = 'Berhasil dibagikan!';
            //     })
            //     .catch((error) => {
            //         document.getElementById('message').textContent = 'Gagal membagikan: ' + error;
            //     })
            //     .finally(() => {
            //         isSharing = false; // Izinkan share berikutnya setelah selesai
            //     });
            // } else {
            //     document.getElementById('message').textContent = 'Fitur share tidak didukung di browser ini.';
            //     isSharing = false;
            // }
        }
        function kirimData(el,url) {
            el.removeAttribute('onclick');
            el.classList.remove('disabled');
            $.ajax({
                url: url,
                method: 'GET',
                success: function(response) {
                    alert("Berhasil Di simpan ke Email Lo!");
                    el.textContent = 'Email Sent';
                    console.log(response);
                    //kirim mengage
                    Moengage.track_event("Define your elite", {
                        "email": "<?php echo $member['email'] ?>",
                        "tombol": "email"
                    });
                },
                error: function(xhr, status, error) {
                    alert("Jaringan sibuk coba lagi nanti");
                    console.log(xhr.responseText);
                }
            });
        }
    </script>
    <script>

        const shareFileButton = document.querySelector('#shareFileBtn')

        shareFileButton.addEventListener('click', () => {
            shareImage('<?php echo $url; ?>')
        })
        
        async function shareImage(imageUrl) {
            console.log(`clicked shareImageAsset: ${imageUrl}`)
            const fetchedImage = await fetch(imageUrl)
            const blobImage = await fetchedImage.blob()
            const fileName = imageUrl.split('/').pop()
            const filesArray = [
                new File([blobImage], fileName, {
                    type: 'image/png',
                    lastModified: Date.now(),
                }),
            ]
            const shareData = {
                title: fileName,
                files: filesArray,
                url: window.location.href,
            }
            if (navigator.canShare && navigator.canShare(shareData)) {
                await navigator.share(shareData)
            }
        }
    </script>
    
	<!-- //Pas visitor ke halaman result -->
	<script type="text/javascript">
		Moengage.track_event("Define your elite", {
			"email": "<?php echo $member['email'] ?>",
			"halaman": "result"
		});
	</script>

	<!-- //Pas visitor klik tombol download di Result -->
    <script type="text/javascript">
        document.getElementById("download").addEventListener("click", function(e) {
            e.preventDefault(); // Cegah download langsung

            const link = e.currentTarget;
            const url = link.href;

            // Kirim event ke MoEngage
            Moengage.track_event("Define your elite", {
                "email": "<?php echo $member['email'] ?>",
                "tombol": "download"
            });

            // Setelah delay, buat link download manual
            setTimeout(() => {
            const tempLink = document.createElement("a");
            tempLink.href = url;
            tempLink.setAttribute("download", "");
            document.body.appendChild(tempLink);
            tempLink.click();
            tempLink.remove();
            }, 300); // delay untuk pastikan event terkirim
        });
    </script>

</body>
</html>