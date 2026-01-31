<div class='min-height'>
	<div class='container scrable'>
		<div class='row'>
			<div class='col-sm-12'>
				<h1 class='head-rewards'>What Band Are You</h1>
				<h3>Jujur aja jawabnya, biar ngepas sama bandnya</h3>
			</div>
		</div>
		<br><br>
		<div class='row'>
			<form role="form" id="frmband"  action="<?=base_url()?>rewards/submitband"  method="post" data-parsley-validate  autocomplete="off">
			<div class='col-sm-8 col-sm-offset-2 noselect' align='left' id='jadinya'>
				<?php
					$no=1;
					if(isset($band) && count($band) > 0){ foreach($band as $row){
						$answer = "answer-".$no;
						echo "<div class='step step-$no'>";
						echo "<h3>$row[question]</h3><br>";
						echo "<label><input type='radio' value='a' name='$answer' class='$answer'> $row[a]</label><br>";
						echo "<label><input type='radio' value='b' name='$answer' class='$answer' > $row[b]</label><br>";
						echo "<label><input type='radio' value='c' name='$answer' class='$answer' > $row[c]</label><br>";
						echo "</div>";
						$no++;
					}}
				?>
				<br>
				<div class='col-sm-6 col-sm-offset-3'>
					<button class='btn btn-md btn-red btn-submit-scrable btn-block btn-next' data-now='1'  type='button'>Next <i class='fa fa-chevron-right'></i></button>
					<button class='btn btn-md btn-red btn-submit-scrable btn-block btn-submit' type='submit'>Next <i class='fa fa-chevron-right'></i></button>
				</div>
			</div>
			</form>
		</div>
	</div>
</div>
<?php $this->load->view('front/podcast/footerfp');?>
<script>
	document.addEventListener('contextmenu', event => event.preventDefault());

	function postArtikel(band,pic) {
		var obj = {
			method: 'feed',
			redirect_uri: '<?=base_url()?>rewards/what-band-are-you',
			link: '<?=base_url()?>rewards/what-band-are-you-share?share='+band,
			picture: pic,
			name: 'Simply Authentic',
			caption: 'What Band Are You',
			description: 'Simply Authentic - What Band Are You : ' + band
		};
		function callback(response) {
			if (response && response.post_id) {
				console.dir('Shared!');
			}
		}
		FB.ui(obj, callback);
	}
	  function postArtikelTw(desk,pic) {
		var link = '<?=base_url()?>rewards/what-band-are-you-share?share='+desk;
	  	window.open('https://twitter.com/intent/tweet?text=Simply Authentic - What Band Are You : '+desk+'&amp;hashtags=simplyauthentic&amp;url='+link+'&amp;related=twitterapi%2Ctwitter&amp;lang=en', "myWindowName", "width=500, height=400");

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
		$('.step').hide();
		$('.btn-submit').hide();
		$('.step-1').show();

		$('.btn-next').click(function(){
			var now = $(this).attr('data-now');
			var radioValue = $("input[name='answer-"+now+"']:checked").val();
			//console.log(radioValue);
			if(radioValue){
				var next = eval(now) + 1;
				$('.step').hide();
				$('.step-'+next).show();
				$(this).attr('data-now',next);
				if(next==7){
					$('.btn-next').hide();
					$('.btn-submit').show();
				}
			}else{
				alert('Jawab terlebih dahulu!');
			}
		});

		$("#frmband").submit(function (eve) {
			eve.preventDefault();
			var dataform2 = new FormData();
			dataform2.append('<?php echo $this->security->get_csrf_token_name(); ?>', '<?php echo $this->security->get_csrf_hash(); ?>');
			var inputtxt = $('#frmband').serializeArray();
			for (var i = 0; i < inputtxt.length; i++) {
				dataform2.append(inputtxt[i]["name"], inputtxt[i]["value"]);
			}
			$.ajax({
				type: "POST",
				data: dataform2,
				dataType: "json",
				contentType: false,
				processData: false,
				url: "<?php echo base_url();?>rewards/submitband",
				beforeSend: function () {
					$('.overlay-all').show();
				},
				success: function (e) {
					$('#jadinya').html('');
					if(e.status=="true"){
						$('#jadinya').html(e.html);
					}else{
						$('#jadinya').html(e.html);
					}
					$('.overlay-all').hide();
				},
				error: function () {
					$('.overlay-all').hide();
				}
			});
		});

	});
</script>