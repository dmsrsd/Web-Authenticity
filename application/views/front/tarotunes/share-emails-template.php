<html>
<head>
<style>
	@font-face {
		font-family: myriad;
		src: url('<?=base_url()?>assets/front/fonts/MyriadPro-Cond.otf');
	}
	@font-face {
		font-family: din;
		src: url('<?=base_url()?>assets/front/fonts/din/DINPro.otf');
	}
	div,html,body,td,th{
		font-family:Calibri;
	}
	.kurung{
		borders:2px solid #000000;
	}
	.head img{
		width:150px;
	}
	.head{
		border-bottom:3px solid #0053A0;
		padding:20px;
		text-align:center;
		backgrounds:#000000;
	}
	.isi{
		border-bottom:3px solid #FF0020;
		padding:20px;
		font-size:17px;
		line-height:20px;
		min-height:100px;
	}
	.footer a{
		text-decoration:underline;
		color:#fff;
	}
	.footer{ 
		font-size:12px;
		text-align:center;
		padding:10px;
		line-height:20px;
	}
	.h1 .s2{
		color:#FFF;
	}
	.h1 .s1{
		color:#FFF200;
	}
	.h1{
		font-size:30px;
	}
	.h2{
		margin:0 auto;
		width:300px;
		background:#FFFFFF;
		color:#FFF;
		font-size:13px;
		padding:10px;
		-moz-border-radius:10px;
		-webkit-border-radius:10px;
		border-radius: 10px;
		
	}
</style>
</head>
<body>
<div class='kurung'>
	<div class='head'> 
		<div class='h2' align='center'>
			<img src='<?=base_url()?>assets/front/img/logocity.png' width='200'>
		</div>
	</div>
	<div class='isi' align='center'>
            <?php if($_GET['type']==1){ ?> 
                <table border="0" cellpadding="10" cellspacing="0" width="100%" style="font-family: Arial, sans-serif;">
                    <tr>
                        <td width="20%" valign="top" style="text-align: center;">
                            <img src="<?php echo base_url('assets/tarotunes-html/images/card/'. $kartu_1['gambar']) ?>" alt="<?php echo $kartu_1['nama_kartu']; ?>" width="100" style="display: block; margin-bottom: 10px;">
                            <img src="<?php echo base_url('assets/tarotunes-html/images/card/'. $kartu_2['gambar']) ?>" alt="<?php echo $kartu_2['nama_kartu']; ?>" width="100" style="display: block; margin-bottom: 10px;">
                            <img src="<?php echo base_url('assets/tarotunes-html/images/card/'. $kartu_3['gambar']) ?>" alt="<?php echo $kartu_3['nama_kartu']; ?>" width="100" style="display: block;">
                        </td>
                        <td width="80%" valign="top">
                            <h3 style="margin: 0; font-size: 18px;">Opening Track</h3>
                            <h2 style="margin: 5px 0 15px; font-size: 24px;">
                                <?php echo $kartu_1['nama_kartu']; ?>, <?php echo $kartu_2['nama_kartu']; ?>, <?php echo $kartu_3['nama_kartu']; ?>
                            </h2>
                            <p style="margin: 0 0 10px;"><?php echo $kartu_1['up']; ?></p>
                            <p style="margin: 0 0 10px;"><?php echo $kartu_2['up']; ?></p>
                            <p style="margin: 0;"><?php echo $kartu_3['up']; ?></p>
                        </td>
                    </tr>
                </table>
            <?php } else if($_GET['type']==2){ ?>
                <table border="0" cellpadding="10" cellspacing="0" width="100%" style="font-family: Arial, sans-serif;">
                    <tr>
                        <td width="20%" valign="top" style="text-align: center;">
                            <img src="<?php echo base_url('assets/tarotunes-html/images/card/'. $kartu_4['gambar']) ?>" alt="<?php echo $kartu_4['nama_kartu']; ?>" width="100" style="display: block; margin-bottom: 10px;">
                            <img src="<?php echo base_url('assets/tarotunes-html/images/card/'. $kartu_5['gambar']) ?>" alt="<?php echo $kartu_5['nama_kartu']; ?>" width="100" style="display: block; margin-bottom: 10px;">
                            <img src="<?php echo base_url('assets/tarotunes-html/images/card/'. $kartu_6['gambar']) ?>" alt="<?php echo $kartu_6['nama_kartu']; ?>" width="100" style="display: block;">
                        </td>
                        <td width="80%" valign="top">
                            <h3 style="margin: 0; font-size: 18px;">Now Playing</h3>
                            <h2 style="margin: 5px 0 15px; font-size: 24px;">
                                <?php echo $kartu_4['nama_kartu']; ?>, <?php echo $kartu_5['nama_kartu']; ?>, <?php echo $kartu_6['nama_kartu']; ?>
                            </h2>
                            <p style="margin: 0 0 10px;"><?php echo $kartu_4['up']; ?></p>
                            <p style="margin: 0 0 10px;"><?php echo $kartu_5['up']; ?></p>
                            <p style="margin: 0;"><?php echo $kartu_6['up']; ?></p>
                        </td>
                    </tr>
                </table>
            <?php } else { ?>
                <table border="0" cellpadding="10" cellspacing="0" width="100%" style="font-family: Arial, sans-serif;">
                    <tr>
                        <td width="20%" valign="top" style="text-align: center;">
                            <img src="<?php echo base_url('assets/tarotunes-html/images/card/'. $kartu_7['gambar']) ?>" alt="<?php echo $kartu_7['nama_kartu']; ?>" width="100" style="display: block; margin-bottom: 10px;">
                            <img src="<?php echo base_url('assets/tarotunes-html/images/card/'. $kartu_8['gambar']) ?>" alt="<?php echo $kartu_8['nama_kartu']; ?>" width="100" style="display: block; margin-bottom: 10px;">
                            <img src="<?php echo base_url('assets/tarotunes-html/images/card/'. $kartu_9['gambar']) ?>" alt="<?php echo $kartu_9['nama_kartu']; ?>" width="100" style="display: block;">
                        </td>
                        <td width="80%" valign="top">
                            <h3 style="margin: 0; font-size: 18px;">Encore</h3>
                            <h2 style="margin: 5px 0 15px; font-size: 24px;">
                                <?php echo $kartu_7['nama_kartu']; ?>, <?php echo $kartu_8['nama_kartu']; ?>, <?php echo $kartu_9['nama_kartu']; ?>
                            </h2>
                            <p style="margin: 0 0 10px;"><?php echo $kartu_7['up']; ?></p>
                            <p style="margin: 0 0 10px;"><?php echo $kartu_8['up']; ?></p>
                            <p style="margin: 0;"><?php echo $kartu_9['up']; ?></p>
                        </td>
                    </tr>
                </table>
            <?php } ?>
	</div>
	<div class='footer'>
		<?php echo date("Y"); ?> Authenticity. All Rights Reserved.
	</div>
</div>
</body>
</html>