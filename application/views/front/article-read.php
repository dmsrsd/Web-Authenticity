
<div class='min-height'>
	<div class='container'>
		<div class='row'>
			<div class='col-sm-12'>
				<img src='<?=base_url()?>uploads/article/<?=$artikel['image'];?>' class='img-responsive' style='width:100%;'>
			</div>
		</div>
		<div class='row'>
			<div class='col-sm-2'>

			</div>
			<div class='col-md-8'>
				<div class='bread'><?=$bread;?> | <?=namadatetime($artikel['created_date'],FALSE);?></div>
				<h1 class='head-article'><?=$artikel['judul'];?></h1>
				<h2 class='head2-article'>
					<?=$artikel['deskripsi_singkat'];?>
				</h2>
				<!-- <div class='div-share' style='font-size:14px; color: #0053A0;'>
					<b>Share buat tambahin poin lo!</b><br>
					<a class='btn-fb btn btn-md btn-primary' onclick="postArtikel()" style='margin-top:5px;'><i class='fa fa-facebook'></i> Share</a> &nbsp;
					<a class='btn-tw btn btn-md btn-info' onclick="postArtikelTw()" style='margin-top:5px;'><i class='fa fa-twitter'></i> Tweet</a>
				</div> -->
				<div class='content-article'>
					<img src='<?=base_url()?>uploads/article/<?=$artikel['thumbnail'];?>'  style='max-width:200px; float:left; margin:0px 10px 10px 0px;'>
					<?=$artikel['deskripsi'];?>
					<br>
					<div class='cl'></div>
				</div>
				<b>Photography By : <?=$artikel['photography'];?>
				<!--<?php
					if($artikel['created_by']=="1"){
						if($artikel['id_kontributor']!="" && $artikel['id_kontributor']!="0"){
							echo "<br>Contributor : $kontributor[nama]";
						}
					}
				?>-->

				</b>
				<br>
				<!--<br>
				<img src='<?=base_url()?>assets/front/img/logo.png' width='100' >
				<br>-->
				<br>
				<!-- <div class='div-share' style='font-size:14px; color: #0053A0;'>
					<b>Share buat tambahin poin lo!</b><br>
					<a class='btn-fb btn btn-md btn-primary' onclick="postArtikel()" style='margin-top:5px;'><i class='fa fa-facebook'></i> Share</a> &nbsp;
					<a class='btn-tw btn btn-md btn-info' onclick="postArtikelTw()" style='margin-top:5px;'><i class='fa fa-twitter'></i> Tweet</a>
				</div>
				<br> -->
				<div class='tag hide'><b>TAGGED :
					<?php
						$tag = "";
						if($artikel['tags']!=""){
							$p = explode(",",$artikel['tags']);
							foreach($p as $s){
								$tag.= "<a href='".base_url()."tag/".strtolower($s)."'>".ucwords($s)."</a>, ";
							}
						}
						echo rtrim($tag,', ');
					?>

				</b></div>
			</div>
			<div class='col-sm-2'>

			</div>

		</div>
		<!-- <div class='batas'></div>
		<div class='row'>
			<div class='col-md-12'>
				<h1 class='head-section'><?php if(isset($relatedartikel) && count($relatedartikel) > 1){ echo "Related Article";}?></h1>
			</div>
		</div> -->

		<!-- <div class='row row-artikel'>
		<?php
			// if(isset($relatedartikel) && count($relatedartikel) > 0){foreach($relatedartikel as $row){
			// 	$head = "CLASSIFIED ".strtoupper($row['head_kategori']);
			// 	$judul = substr($row['judul'],0,50)." ...";
			// 	if($row['id_artikel']!=$artikel['id_artikel']){
			// 		echo"
			// 			<div class='col-md-3 col-sm-6 ' >
			// 				<div class='box-article' >
			// 					<div class='category'><a href='".base_url()."category/$row[head_kategori]/all'><b>$head</b></a> | <a href='".base_url()."category/$row[head_kategori]/$row[slugkat]'>".strtoupper($row['kategori'])."</a></div>
			// 					<img src='".base_url()."uploads/article/thumb/$row[thumbnail]' class='img-responsive'>
			// 					<div class='head'><a href='".base_url()."read/$row[slug]' title='$row[judul]'>$judul</a></div>
			// 					<div class='desc'>".substr(strip_tags($row['deskripsi_singkat']),0,100)." ...</div>
			// 				</div>
			// 			</div>
			// 	";
			// 	}
			// }}
		?>
		</div> -->
	</div>
</div>

<?php $this->load->view('front/podcast/footerfp');?>
<script>
		var sudah = "false";
		var limit = <?=$website['time_read'] * 60;?>;
		var desk = "<?=$artikel['deskripsi_singkat'];?>";
		var cap = "<?=$artikel['judul'];?>";
		var pic = "<?=base_url()."uploads/article/thumb/$artikel[thumbnail]"?>";
		var ling = '<?=base_url()."read/".$artikel['slug']?>';
		function postArtikel() {
			var obj = {
				method: 'feed',
				redirect_uri: '<?=base_url()."read/".$artikel['slug']?>',
				link: ling,
				picture: pic,
				name: 'Simply Authentic',
				caption: 'Simply Authentic - '+cap,
				description: desk
			};
			function callback(response) {
				if (response) {
					console.dir('Shared!');
					<?php if(!empty($this->datamember)){?>
					<?php if(count($sudah)==0){?>
					var dataform = new FormData();
					dataform.append('<?php echo $this->security->get_csrf_token_name(); ?>', '<?php echo $this->security->get_csrf_hash(); ?>');
					dataform.append('x', '<?php echo $artikel['id_artikel']; ?>');
					$.ajax({
						type: "POST",
						data: dataform,
						dataType: "json",
						contentType: false,
						processData: false,
						url: "<?php echo base_url();?>artikel/getpoint",
						beforeSend: function () {
						},
						success: function (e) {
						},
						error: function () {
						}
					});
					<?php }?>
					<?php }?>
				}
			}
			FB.ui(obj, callback);
		}
		  function postArtikelTw() {
			window.open('https://twitter.com/intent/tweet?text=Simply Authentic - '+cap+'&amp;hashtags=simplyauthentic&amp;url='+ling+'&amp;related=twitterapi%2Ctwitter&amp;lang=en', "myWindowName", "width=500, height=400");
			<?php if(!empty($this->datamember)){?>
			<?php if(count($sudah)==0){?>
			var dataform = new FormData();
			dataform.append('<?php echo $this->security->get_csrf_token_name(); ?>', '<?php echo $this->security->get_csrf_hash(); ?>');
			dataform.append('x', '<?php echo $artikel['id_artikel']; ?>');
			$.ajax({
				type: "POST",
				data: dataform,
				dataType: "json",
				contentType: false,
				processData: false,
				url: "<?php echo base_url();?>artikel/getpoint",
				beforeSend: function () {
				},
				success: function (e) {
				},
				error: function () {
				}
			});
			<?php }?>
			<?php }?>

			/*$.ajax({
				type : 'GET',
				url : '/web/gtpnt/1/'+id+'-2',
				dataType : 'html',
				success : function(data){
				}
			});
			return false;*/
		  }
	  $(document).on('ready', function() {

		<?php if(!empty($this->datamember)){?>
			<?php if(count($sudah)>0){?>sudah="true";<?php }?>
			var start = new Date;
			setInterval(function() {
				var detik = (new Date - start) / 1000;
				detik = Math.round(detik * 1);
				if(sudah == "false"){
					if(detik == limit){
						<?php if(count($sudah)==0){?>
						var dataform = new FormData();
						dataform.append('<?php echo $this->security->get_csrf_token_name(); ?>', '<?php echo $this->security->get_csrf_hash(); ?>');
						dataform.append('x', '<?php echo $artikel['id_artikel']; ?>');
						$.ajax({
							type: "POST",
							data: dataform,
							dataType: "json",
							contentType: false,
							processData: false,
							url: "<?php echo base_url();?>artikel/getpoint",
							beforeSend: function () {
							},
							success: function (e) {
							},
							error: function () {
							}
						});
						<?php }?>
					}
				}
			}, 1000);

		<?php }?>
	});
</script>
