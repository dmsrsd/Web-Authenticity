
<div class='min-height'>
	<div class='container'>

		<div class='row'>
			<div class='col-md-12'>
				<h1 class='head-section'>Search For : <?php echo ucwords($search)?></h1>
			</div>
		</div>

		<div class='row row-artikel'>
		<?php
			if(isset($artikel) && count($artikel) > 0){foreach($artikel as $row){
				$head = "CLASSIFIED ".strtoupper($row['head_kategori']);
				echo"
					<div class='col-md-3 col-sm-6 ' >
						<div class='box-article' >
							<div class='category'><a href='".base_url()."category/$row[head_kategori]/all'><b>$head</b></a> | <a href='".base_url()."category/$row[head_kategori]/$row[slugkat]'>".strtoupper($row['kategori'])."</a></div>
							<img src='".base_url()."uploads/article/$row[thumbnail]' class='img-responsive'>
							<div class='head'><a href='".base_url()."read/$row[slug]'>$row[judul]</a></div>
							<div class='desc'>".substr(strip_tags($row['deskripsi_singkat']),0,100)." ...</div>
						</div>
					</div>
				";
			}}
		?>
		</div>
	</div>
</div>
<section class='contributor hide'>
	<div class='container'>
		<h1>Authentic Contributors</h1><br>
		<div class='row'>
			<?php
			if(isset($listkontributor) && count($listkontributor) > 0){ foreach($listkontributor as $row){
				echo "
				<div class='col-md-3 col-sm-6 col-xs-6'>
					<div align='center'>
						<img src='".base_url()."uploads/contributor/$row[image]' class='img-responsive'>
					</div>
					<br>
					<h2><a href='".base_url()."contributor/$row[slug]'>$row[nama]</a></h2>
					<p>$row[deskripsi]</p>
					<br>
				</div>
				";
			}}
			?>

		</div>
	</div>
</section>
<?php $this->load->view('front/podcast/footerfp');?>
<script>
	$(document).on('ready', function() {

	});
</script>
