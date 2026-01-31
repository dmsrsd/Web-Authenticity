<?php
	if($headkategori['banner']!=''){
?>
<style>
	.navbar{
		margin-bottom:0px;
	}
	.kotak-table{
		height:600px;
	}
	@media screen and (max-width:767px){
		.kotak-table{
			height:300px;
			margin-top:74px;
		}
		.navbar-default ~ .min-height, .navbar-default ~ .container {
			top: 0px;
		}
		.min-height{
			padding-top:0px;
		}
	}
	.header-judul h1{
		font-size:40px;
		font-family:dinbold;
	}
	.header-judul h2{
		font-family:din;
		font-size:15px;
		margin-top:3px;
	}
	.header-judul h3{
		font-family:myriad;
		font-size:18px;
		margin-top:20px;
	}
	.header-judul{
		color:#ffffff;
		text-align:left;
	}
</style>
<!--<div class='container-fluid'>
	<div class='row no-gutter'>
		<div class="col-md-12">
			<div class="kotak-table" style="background:url('<?=base_url()."uploads/headkategori/".$headkategori['banner'];?>');background-size:cover;">
				<div class="in-kotak-table">
					<div class='container'>
						<div class='row'>
							<div class='col-sm-6 header-judul'>
								<h1><?=$headkategori['header'];?></h1>
								<h2><?=$headkategori['header2'];?></h2>
								<h3><?=$headkategori['deskripsi'];?></h3>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>-->
<br><br>
<?php }?>
<div class='min-height'>
	<div class='container'>
		<div class='bg-article'>
			<div class='row'>
				<div class='col-md-12'>
					<h3 class='head'><?=ucwords($bread);?> </h3>
				</div>
			</div>
			<div class='row row-artikel'>
			<?php
				if(isset($artikel) && count($artikel) > 0){ foreach($artikel as $row){
					$head = "CLASSIFIED ".strtoupper($row['head_kategori']);
					$judul = substr($row['judul'],0,50)." ...";
					echo"
						<div class='col-md-3 col-sm-6 ' >
							<div class='box-article' >
								<div class='category'><a href='".base_url()."category/$row[head_kategori]/all'><b>$head</b></a> | <a href='".base_url()."category/$row[head_kategori]/$row[slugkat]'>".strtoupper($row['kategori'])."</a></div>
								<div class='product-div1'>
									<img src='".base_url()."uploads/article/$row[thumbnail]' class='img-responsive transition'>
								</div>
								<div class='head'><a href='".base_url()."read/$row[slug]' title='$row[judul]'>$judul</a></div>
								<div class='desc'>".substr(strip_tags($row['deskripsi_singkat']),0,100)." ...</div>
							</div>
						</div>
					";
				}}
			?>
			</div>

		</div>
	</div>
</div>

<?php $this->load->view('front/podcast/footerfp');?>
<script>
	$(document).on('ready', function() {

	});
</script>
