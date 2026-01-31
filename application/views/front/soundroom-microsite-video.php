
<div class='container'>
	<h1 class="head-blue filter" style='border-bottom:none;'>
		<div class="row">
			<div class="col-sm-3" style="padding-top:22px;">
				Video
			</div>
		</div>
	</h1>
	<?php
		if(count($top)>0){
	?>
	<div class='row'>
		<div class='col-sm-10 col-sm-offset-1'>
			<br>
			<div class="embed-responsive embed-responsive-16by9">
				<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?=$top['youtube'];?>?rel=0&controls=1&showinfo=0&html5=1&autoplay=0"></iframe>
			</div>
			<br>
			<div style='font-weight:bold; color: #0053A0;font-size:18px; font-family:dinl;'>
				<?=$top['judul'];?>
			</div>
			<br>
		</div>
	</div>
	<?php }?>
	<h1 class="head-blue filter">
		<div class="row">
			<div class="col-sm-3" style="padding-top:22px;">
				All Video
			</div>
		</div>
	</h1>
	<div class='row'>
		<?php
			if(isset($video) && count($video) > 0){ foreach($video as $row){
		?>
		<div class='col-sm-4'>
			<br>
			<div class="embed-responsive embed-responsive-16by9">
				<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?=$row['youtube'];?>?rel=0&controls=1&showinfo=0&html5=1&autoplay=0"></iframe>
			</div>
			<br>
			<div style='font-weight:bold; color: #0053A0;font-size:18px; font-family:dinl;'>
				<?=$row['judul'];?>
			</div>
			<br>
		</div>
		<?php }}?>
	</div>
</div>
<?php $this->load->view('front/podcast/footerfp');?>
