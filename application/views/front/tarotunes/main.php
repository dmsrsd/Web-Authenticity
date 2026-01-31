<!DOCTYPE html>
<html>
    <?php $this->load->view("front/tarotunes/head.php");?>
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
        #all-card {
            top:10vh;
        }
        .baru{
            color: #fff;
font-size: 2rem;
font-weight: 500;
line-height: 4rem;
margin: 5.5rem 0 2rem;
text-align: center;
        }
    </style>
<body> 

<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5Q5GBNF" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WH8ZRXFD" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->


    <div class="bg">
        <div class="container-full">
            <div class="row header">
                <div class="col-md-6 text-left"><img src="<?php echo base_url('assets/tarotunes-html/images/logo_tarotunes_single.png') ?>"></div>
                <div class="col-md-6 text-right" style="top:15px"><img src="<?php echo base_url('assets/tarotunes-html/images/auth-white.png') ?>"></div>
            </div>
            <div class="row header2">
                <div class="col-md-12 text-center"><img src="<?php echo base_url('assets/tarotunes-html/images/logo_tarotunes_m.png') ?>"></div>
            </div>
        </div>
        <div class="container">
            <div class="row row-card">
                <div class="col-md-12" id="all-card">
                    <h2 class="baru">Pilih 10 (Sepuluh) Kartu secara acak</h2>
                    <div class="card">
                        <?php
                            // Acak urutan kartu
                            $i=1;
                            shuffle($kartu);
                            $seen = [];
                            $unique = [];
                        ?>
                        <ul class="inline">
                            <?php foreach ($kartu as $row):
                                $key = $row['nama_kartu'];
                                if (!isset($seen[$key])) {
                                    $seen[$key] = true;
                                ?>
                                <li id="card<?php echo $i+1; ?>" data-rank="<?php echo $row['id_tarrots']; ?>">
                                    <a href="#" > 
                                        <img src="<?php echo base_url('assets/tarotunes-html/images/cards_back.png') ?>" alt="card" class="back-card"> 
                                        <img src="<?php echo base_url('assets/tarotunes-html/images/card/'. $row['gambar']) ?>" alt="<?php echo $row['nama_kartu']; ?>" dataId="<?php echo $row['id_tarrots']; ?>" class="hidden-card" loading="lazy"> 
                                    </a>
                                </li>
                            <?php  $i++; } endforeach; ?>
                        </ul>
                    </div>
                </div>
                <div class="col-md-12" id="10-card" style="display:none">
                    <h2 id="step-1">Pilih 3 (Tiga) Kartu Opening Track</h2>
                    <h2 id="step-2" style="display:none">Pilih 3 (Tiga) Kartu Now Playing</h2>
                    <h2 id="step-3" style="display:none">Pilih 3 (Tiga) Kartu Encore</h2>
                    <div class="card-chosen">
                        <ul class="inline" id="kartu-pilihan">
                            <!-- <li><a title="Justice" href=""><img src="<?php echo base_url('assets/tarotunes-html'); ?>/images/card/justice.png" alt="Justice"></a></li> -->
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $this->load->view("front/tarotunes/footer.php");?>
	
	<script type="text/javascript">
		Moengage.track_event("Tarotunes", {
		"email": "<?php echo $member['email'] ?>",
		"halaman": "main tarotunes"
    });
	</script>
	
    <script>
        $(document).ready(function () {
            const baseUrl = '<?php echo base_url(); ?>';
            const oWindowWidth = $(window).width();
            const oWindowHeight = $(window).height();
            let oNbCard = 1;
            let nbrCard = 0;
            let zIndex = 24;
            const NombreDeCases = 22;
            const NombreMaximum = 22;
            const TirageEffectue = [];

            if (oWindowWidth <= 640) {
                $('.detail.row').remove().clone().insertAfter('.row.row-card');
            }

            function nombreAleatoire() {
                return Math.floor(Math.random() * NombreMaximum) + 1;
            }

            function isNumberPresent(num) {
                for (let i = 1; i <= NombreDeCases; i++) {
                    const rank = $('#card' + i).attr('data-rank');
                    if (parseInt(rank) === num) {
                    return true;
                    }
                }
                return false;
            }
            // vAlign Plugin
            (function ($) {
                $.fn.vAlign = function () {
                    let maxH = 0;
                    $(this).each(function () {
                    const h = $(this).height();
                    if (h > maxH) maxH = h;
                    });
                    $(this).css('height', maxH);
                };
            })(jQuery);

            if (oWindowWidth >= 768) {
                setTimeout(function () {
                    $('.about-section .h3').vAlign();
                    $('.about-section .h3 + p').vAlign();
                }, 2000);
            }

            $('.card a').hover(
                function () {
                    $(this).children('img').addClass('hover');
                },
                function () {
                    $(this).children('img').removeClass('hover');
                }
            );

            $('.card li a').click(function () {
                const cardImg = $(this).children('.hidden-card');
                const imgSrc = cardImg.attr('src');
                $('input[name="card-' + oNbCard + '"]').val(imgSrc);

                const li = $(this).parent('li');
                const imgWidth = $(this).children('img').width();
                const cardWidth = oWindowWidth > 500 ? imgWidth / 2 : imgWidth / 3;
                const maskWidth = imgWidth;
                const maskHeight = $(this).children('img').height();
                const toMove = cardWidth * nbrCard;
                const ulWidth = li.parent('ul').width();
                const oLimit = toMove + cardWidth;

                $('<div class="hide-mask"></div>').insertBefore('.card li a');
                $('.hide-mask').css('width', maskWidth).css('height', maskHeight);

                li.css('z-index', 23);

                if (oNbCard <= 10) {
                    $(this).children('.back-card').addClass('rotate').delay(250).fadeOut();
                    setTimeout(() => $('.card .back-card.rotate').removeClass('rotate'), 1000);
                    setTimeout(() => $('.card .back-card.rotate + .hidden-card').addClass('rotate-in'), 200);

                    $('.card li').addClass('block');

                    const moveAmount = oWindowWidth > 500
                    ? (oLimit <= ulWidth ? -270 : 240)
                    : -190;

                    setTimeout(() => {
                    $('.card .back-card.rotate + .hidden-card')
                        .parent('a')
                        .parent('li')
                        .animate({ top: "+=" + moveAmount + "px" }, 100);
                    }, 250);

                    setTimeout(() => {
                    $('.card .back-card.rotate + .hidden-card')
                        .parent('a')
                        .parent('li')
                        .animate({ left: toMove }, 100);
                    }, 500);

                    setTimeout(() => $('.hidden-card:not(".rotate-in")').parent('a').prev('div').remove(), 1250);
                    setTimeout(() => $('.card li').removeClass('block'), 2500);

                    li.css('z-index', zIndex);

                    if (oNbCard == 10) {
                        $('#all-card').hide();
                        $('#10-card').show('slow');
                    }
                    //add data img
                    const img = $(this).find('img.hidden-card');
                    const imgSrc = img.attr('src');
                    const imgAlt = img.attr('alt');
                    const idKartu = img.attr('dataId');

                    // Buat elemen HTML baru
                    const newItem = `<li><img src="${imgSrc}" alt="${imgAlt}" class="pilihan-kartu" dataid="${idKartu}"> </li>`;

                    // Tambahkan ke dalam ul#kartu-pilihan
                    $('#kartu-pilihan').append(newItem);

                    nbrCard++;
                    oNbCard++;
                    zIndex++;
                } else {
                    alert('You have already drawn the 10 cards');
                }

                return false;
            });

            


            $('.card a .rotate-in').click(function () {
                return false;
            });

            if (oWindowWidth < 768) {
                $('.interpretation-step .row > div:last-child')
                    .remove()
                    .clone()
                    .appendTo('.interpretation-step .row > div:nth-child(2)');
            }

            // Card chosen click
            let oInit = 1;
            let formData = {
                id_member: <?php echo $this->datamember['id']; ?>
            };
            $(document).on('click', '.pilihan-kartu', function () {
                //$(this).find('img').addClass('saturate-hover');
                $(this).parent().attr('style', 'z-index: 24; top: -55px; left: 0px; opacity: 0.5; filter: saturate(0%); position: relative;');
                $(this).removeClass('pilihan-kartu');
                let a = $(this).attr('dataid'); // id kartu yang diklik
                formData[`id_tarrots_${oInit}`] = a;
                //console.log(formData);


                if (oInit === 3) {
                    $('#step-1').hide();
                    $('#step-2').show('slow');
                }
                if (oInit === 6) {
                    $('#step-1').hide();
                    $('#step-2').hide();
                    $('#step-3').show('slow');
                }
                if (oInit === 9) {
                    let lastCard = $('#kartu-pilihan img.pilihan-kartu').last();
                    let lastCardId = lastCard.attr('dataid');

                    if (lastCardId) {
                        formData[`id_tarrots_10`] = lastCardId;
                        if (lastCardId) {
                            formData[`id_tarrots_10`] = lastCardId;

                            // Tambahkan efek visual juga
                            //lastCard.parent().attr('style', 'z-index: 24; top: -70px; left: 0px; opacity: 0.5; filter: saturate(0%); position: relative;');
                            lastCard.removeClass('pilihan-kartu');

                            // Kirim data via AJAX
                            $.ajax({
                                url: '<?php echo base_url('tarotunes/kirimkartu'); ?>',
                                method: 'GET',
                                data: formData,
                                dataType: "json",
                                success: function(e) {
                                    console.log(e);
                                    if(e.status == true) {
                                        window.location.href = '<?= base_url('tarotunes/share'); ?>/' + e.message;
                                    } else {
                                        alert(e.message);
                                    }
                                },
                                error: function(err) {
                                    alert('Gagal mengirim data');
                                    console.error(err);
                                }
                            });
                        }
                    }
                }

                oInit++;
                return false;
            });
        });

        // Handle window resize
        $(window).resize(function () {
        const oWindowWidth = $(window).width();

        (function ($) {
        $.fn.vAlign = function () {
            let j = 0;
            $(this).each(function () {
            const h = $(this).height();
            if (h > j) j = h;
            });
            $(this).css('height', j);
        };
        })(jQuery);

        if (oWindowWidth >= 768) {
        setTimeout(function () {
            $('.about-section .h3').vAlign();
            $('.about-section .h3 + p').vAlign();
        }, 2000);
        }
        });
    </script>
</body>
</html>