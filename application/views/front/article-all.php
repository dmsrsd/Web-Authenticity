<h1 style="font-size:2px;margin:0px;padding:0px;">Authenticity Article</h1>
<div class='min-height'>
	<div class='container'>
		<div class='row'>
			<div class='col-md-12'>
				<h3 class='head'>All Article </h3>
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
							<div class='category'><a href='".base_url()."category/$row[head_kategori]/all'><b>$head</b></a> | ss <a href='".base_url()."category/$row[head_kategori]/$row[slugkat]'>".strtoupper($row['kategori'])."</a></div>
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

<?php $this->load->view('front/podcast/footerfp');?>
<script>
	$(document).on('ready', function() {

	});
</script>
