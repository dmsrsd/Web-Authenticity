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
		<?=$data?>
	</div>
	<div class='footer'>
		2020 Authenticity. All Rights Reserved.
	</div>
</div>
</body>
</html>