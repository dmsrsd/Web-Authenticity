<html xmlns="http://www.w3.org/1999/xhtml" style='padding:0px; margin:0px;'> 
<head>
<style>
	@page { margin: -0;padding:0px; margin-top:0em;}
	body { margin: 0px; padding:0px;}		
	html { margin: 0px; padding:0px;}		
	div,html,body,td,th{
		font-family:Courier;
	}
	.kurung{
		borders:2px solid #000000;
	}
	.head img{
		width:150px;
	}
	.head{
		border-bottom:1px solid #A6A6A6;
		padding:5px;
		text-align:center;
		background:#000000;
	}
	.isi{
		padding:0px 20px;
		font-size:15px;
		line-height:20px;
	}
	.footer a{
		text-decoration:underline;
		color:#fff;
	}
	.footer{
		backgrounds:#000000;
		color:#FFF;
		font-size:11px;
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
		background:#000000;
		color:#FFF;
		font-size:13px;
		padding:10px;
		-moz-border-radius:10px;
		-webkit-border-radius:10px;
		border-radius: 10px;
		
	}
</style>
</head>
<body style='padding:0px; margin:0px;'>
<?php
	$root = $_SERVER["DOCUMENT_ROOT"]."/";
?>
<div class='kurung'>
	<div class='head'> 
		<div class='h2' align='center'>
			<img src='<?=$root?>assets/front/img/logo.png' width='100'>
		</div>
	</div>
	<div class='isi' align='center'>
		<?=$data?>
	</div>
	<div class='footer'>
		&nbsp;
	</div>
</div>
</body>
</html>