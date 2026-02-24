<meta http-equiv="Refresh" content="0; url=<?php echo base_url('social-distancing-experience') ?>" />
<div class='min-height'>
	<div class='container'>
		<div class='row'>
			<div class='col-sm-12'>
				<h2 class='head'>Profile</h2>
				<!--<h3>Semua terekam tak pernah mati</h3>-->
				<h3><a href="<?php echo base_url('social-distancing-experience') ?>" style="text-decoration:underline;">
				<img src="<?php echo base_url('uploads/head22.jpg') ?>" width=100% />

				</a></h3>
			</div>
		</div>
	</div>
	<div class='container'>
		<div class='row no-gutter' style='padding:15px;'>
			<div class='col-sm-3'>
				<div class='box-profile'>
					<div class='in-pad'>
						<?php
							if($member['pp']!=""){
								$pp = base_url()."uploads/pp/".$member['pp'];
							}else{
								$pp = base_url()."uploads/nopp.png";
							}
						?>
						<img src='<?=$pp;?>' class='img-circle' width='100'>
						<br>
						<h3><?=ucwords($member['fullname']);?></h3>
						<div class='small-info'>
							<?=$member['email'];?><br>
							<?=$member['hp'];?><br>
							<?=$member['provinsi'].", ".$member['kota'];?>
						</div>
						<div class='small-link'>

							<i class='fa fa-gear'></i> <a href='<?=base_url();?>profile/edit'>Edit Profile</a>
						</div>
					</div>
					<div class='total-point'>
						<h2>Total Point</h2>
						<h1 id='tot'><?=$total_point;?></h1>
					</div>
				</div>
				<div class='get-member'>
					<a href='javascript:void(0);' class='share-code btn btn-block btn-red' ><i class='fa fa-share'></i> Share buat tambahin point lo!</a>
				</div>
			</div>
			<div class='col-sm-4'>
				<div class='box-point'>
					<div class='in-pad'>
						<h3>History Point</h3>
						<div class='scroll-point'>
							<table width='100%' cellpadding='1' cellspacing='1'>
								<?php
									if(isset($redeem) && count($redeem) > 0){ foreach($redeem as $row){
										$tgl = explode(" ",$row['created_date']);
										$tgl = explode("-",$tgl[0]);
										$tgl = $tgl[2]."/".$tgl[1]."/".substr($tgl[0],-2);
										echo "<tr><td width='80'>$tgl</td><td>Redeem Point</td><td width='50'>-$row[point]</td></tr>";
									}}
									if(isset($point) && count($point) > 0){ foreach($point as $row){
										$tgl = explode(" ",$row['created_date']);
										$tgl = explode("-",$tgl[0]);
										$tgl = $tgl[2]."/".$tgl[1]."/".substr($tgl[0],-2);
										$iraha = explode(" ",$row['created_date']);
										if($row['id_jenis_point']=="12"){
											$query = $this->db->query("select sum(point) as total from pointacak  where date(created_date) = '".$iraha[0]."' and id_member='".$this->datamember['id']."'")->result_array();
											$row['pts'] =  $query[0]['total'];

										}
										if($row['id_jenis_point']=="27"){
											$query = $this->db->query("select count(id_member) as total from pointband  where date(created_date) = '".$iraha[0]."' and  id_member='".$this->datamember['id']."'")->result_array();
											$jum = $this->model_global->get_data(array('data' => 'row','table' => 'jenis_point','where' => array( 'id_jenis_point' =>'27')));
											$row['pts'] =  $query[0]['total'] * $jum['pts'];

										}
										if($row['id_jenis_point']>="14" && $row['id_jenis_point']<="23"){
											$ticketitem = $this->model_global->get_data(array('data' => 'row','table' => 'ticket', 'where' => array( 'id_ticket' =>$row['id_resource'])));
											$row['nama_point'] = $row['nama_point'] ." ".$ticketitem['kota'];
										}
										echo "<tr><td width='80' valign='top'>$tgl</td><td valign='top'>$row[nama_point]</td><td width='50' valign='top'>$row[pts]</td></tr>";
									}}
								?>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class='col-sm-5'>
				<div class='box-artikel'>

					<div class='in-pad'>
						<div id='yhome'>
							<h2>Masih banyak jalan buat<br>nambahin point lo!</h2>
							<br>
							<?php if(isset($artikel) && count($artikel) > 0){$h1="href='javascript:void(0);' class='show-article'";}else{$h1="href='".base_url()."profile/write'";}?>
							<?php if(isset($song) && count($song) > 0){$h2="href='javascript:void(0);' class='show-soundroom'";}else{$h2="href='".base_url()."profile/soundroom'";}?>
							<a <?=$h1;?>>Upload Article</a>
							<?php $live="off"; if($live=="on"){?>
							<a href='<?=base_url();?>category/music/all'>Read &amp; Share Article</a>
							<a href='<?=base_url();?>ticket'>Buy Ticket</a>
							<a href='<?=base_url();?>rewards/scrable'>Simply Scrabble</a>
							<a href='<?=base_url();?>rewards/what-band-are-you'>What Band Are You</a>
							<a href='<?=base_url();?>rewards/on-ground'>Authentic On Ground</a>
							<a <?=$h2;?>>Authenticity SoundRoom</a>
							<a href='<?=base_url();?>rewards/scan-special-edition'>Scan Special Edition</a>
							<?php }else{?>
							<a href='<?=base_url();?>category/music/all'>Read &amp; Share Article</a>
							<a href='<?=base_url();?>ticket'>Buy Ticket</a>
							<a href='<?=base_url();?>rewards/scrable'>Simply Scrabble</a>
							<a href='<?=base_url();?>rewards/what-band-are-you'>What Band Are You</a>
							<a href='<?=base_url();?>rewards/on-ground' >Authentic On Ground</a>
							<a <?=$h2;?>>Authenticity SoundRoom</a>
							<a href='<?=base_url();?>rewards/qr-special' >Scan Special Edition</a>
							<?php }?>
						</div>
						<div id='ysong'>
							<h3>Your Song Status</h3>
							<div class='scroll-artikel'>
								<table width='100%' cellpadding='1' cellspacing='1'>
									<?php
										if(isset($song) && count($song) > 0){ foreach($song as $row){
											$judul = substr($row['judul'],0,22)."...";
											$link = "";
											$class="";
											switch($row['approve']){
												case "0":$class = "waiting";$link = $judul; break;
												//case "1":$class = "approve";$link = "<a href='".base_url()."read/$row[slug]'>".$judul."</a>"; break;
												case "1":$class = "approve";$link = $judul; break;
												case "2":$class = "rejected";$link = $judul; break;
											}
											$statusapprove = $this->approvesong[$row['approve']];
											$tgl = explode(" ",$row['created_date']);
											$tgl = explode("-",$tgl[0]);
											$tgl = $tgl[2]."/".$tgl[1]."/".substr($tgl[0],-2);
											echo "<tr><td width='100'>$tgl</td><td>$link</td><td width=''><div class='$class'>$statusapprove</div></td></tr>";

										}}

									?>
								</table>
							</div>
							<div class='btn-upload'>

							</div>
							<div align='right'><a href='javascript:vod(0);' class='backyour'><i class='fa fa-chevron-left'></i> Back</a></div>
						</div>
						<div id='yarticle'>
							<h3>Your Article Status</h3>
							<div class='scroll-artikel'>
								<table width='100%' cellpadding='1' cellspacing='1'>
									<?php
										if(isset($artikel) && count($artikel) > 0){ foreach($artikel as $row){
											$judul = substr($row['judul'],0,22)."...";
											$link = "";
											$class="";
											switch($row['approve']){
												case "0":$class = "waiting";$link = $judul; break;
												case "1":$class = "approve";$link = "<a href='".base_url()."read/$row[slug]'>".$judul."</a>"; break;
												case "2":$class = "rejected";$link = $judul; break;
											}
											$statusapprove = $this->approve[$row['approve']];
											$tgl = explode(" ",$row['created_date']);
											$tgl = explode("-",$tgl[0]);
											$tgl = $tgl[2]."/".$tgl[1]."/".substr($tgl[0],-2);
											echo "<tr><td width='100'>$tgl</td><td>$link</td><td width=''><div class='$class'>$statusapprove</div></td></tr>";

										}}

									?>
								</table>
							</div>
							<div class='btn-upload'>
								<a href='<?=base_url()?>profile/write' class='btn'><i class='fa fa-newspaper-o'></i> Upload Article</a>
							</div>
							<div align='right'><a href='javascript:vod(0);' class='backyour'><i class='fa fa-chevron-left'></i> Back</a></div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
	<br>
	<?php
	if(isset($order) && count($order) > 0){
	?>
	<br>
	<div class='container'>
		<h1 class='head-blue'>Your Order</h1>
		<br>
		<div class='row'>
			<div class='col-sm-12'>
			<div style='max-height:500px; overflow-y:auto;border-top:1px solid #DDDDDD; border-bottom:1px solid #DDDDDD;'>
			<table width='100%' class='table table-striped table-bordered table-hover dataTables'>
				<tr>
					<th width='50'>No</th>
					<th width=''>Ticket</th>
					<th width='50'>Qty</th>
					<th width='150'>Total</th>
					<th width=''>Status</th>
					<th width='100'>Tgl Order</th>
					<th width='100'>Tgl Bayar</th>
				</tr>
			<?php
			$no=1;
			if(isset($order) && count($order) > 0){ foreach($order as $row){
				$tiket = $this->model_global->get_data(array('data' => 'row','table' => 'ticket', 'where' => array( 'id_ticket' =>$row['id_ticket'])));

				$va = "";
				switch($row['paid']){
					case "1":
						$status = "BERHASIL";
						$bank = $this->model_global->get_data(array('data' => 'row','table' => 'doku_payment_channel', 'where' => array( 'code' =>$row['PAYMENTCHANNEL'])));
						$va = str_replace("VA","Virtual Account",$bank['description']);
						$va = $bank['description'];
					break;
					case "2":
						$status = "Selesaikan Pembayaran";
						$bank = $this->model_global->get_data(array('data' => 'row','table' => 'doku_payment_channel', 'where' => array( 'code' =>$row['PAYMENTCHANNEL'])));
						$va = str_replace("VA","Virtual Account",$bank['description']);
						$va = $bank['description'];
					break;
					case "0":
						$status = "Pilih Metode Pembayaran";
					break;
				}
				echo "
					<tr>
						<td align='center'>$no</td>
						<td>$tiket[judul]</td>
						<td>$row[qty]</td>
						<td>IDR ".number_format($row['AMOUNT'])."</td>
						<td>$status<br><b>$va</b></td>
						<td>".namadatetime($row['created_date'])."</td>
						<td>".namadatetime($row['paid_date'])."</td>

					</tr>
				";
				$no++;
			}}
			?>
			</table>
			</div>
			</div>


		</div>
	</div>
	<?php
	}
	?>
	<div class='container'>
		<h1 class='head-blue'>Redeem Point</h1>
		<h4>Lesu liat point masih segitu? Yuk ikutan lagi games dan aktivasinya. Semangat jangan dikasi kendor dulu</h4>
		<br>
		<div class='row'>
			<?php
			$okredeem = "";
			if(isset($redeempoint) && count($redeempoint) > 0){ foreach($redeempoint as $row){
				if(empty($this->datamember)){
					$btnredeem = "btn-redeemlogin btn-blue ";
				}else{
					$query = $this->db->query("SELECT COUNT(id_redeempoint) as redeem FROM `redeemmember` where id_redeempoint='$row[id_redeempoint]' and  id_member='".$this->datamember['id']."'")->result_array();
					$total =  $query[0]['redeem'];
					if($total > 0){
						$btnredeem = "btn-redeemed btn-blue ";
					}else{
						if($total_point>=$row['point']){
							$okredeem = "ok";
							$btnredeem = "btn-blue btn-redeem";
						}else{
							$btnredeem = "btn-blue btn-redeemnot";
						}
					}
				}
				echo "
				<div class='col-md-2 col-sm-4'>
					<div class='box-redeem'>
						<img src='".base_url()."uploads/redeem/$row[image]' class='img-responsive' style='width:100%;'>
						<div class='redeem-data'>
							<h2>$row[nama]</h2>
							<h1>$row[point] Point</h1>
						</div>
						<button class='btn btn-md btn-block $btnredeem' id='btnv-$row[id_redeempoint]' data-res='$row[id_redeempoint]'>Redeem</button>
					</div>
				</div>
				";
			}}
			?>



		</div>
	</div>
</div>
	<div class="modal  fade" id="redeemlogin" tabindex="-1" role="dialog" aria-labelledby="redeemlogin" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h2 align='center' class='auth' >Notifikasi</h2>
				</div>
				<div class="modal-body">
					<br>
					Please sign in or sign up for this action<br><br>
					<a href='<?=base_url()?>login' class='btn btn-md btn-red'>Sign In</a>
					<a href='<?=base_url()?>register' class='btn btn-md btn-blue'>Sign Up Now</a>
					<br>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal  fade" id="redeemmodal" tabindex="-1" role="dialog" aria-labelledby="redeemmodal" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h2 align='center' class='auth' >Notifikasi</h2>
				</div>
				<div class="modal-body">
					<br>
					Satu langkah lagi dapatkan barang impian lo, yakin dong?<br><br>

					<br>
				</div>
				<div class="modal-footer">
					<button class='btn btn-md btn-blue  btn-x' data-x='0'>Redeem</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal  fade" id="redeemnotif" tabindex="-1" role="dialog" aria-labelledby="redeemnotif" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h2 align='center' class='auth' >Notifikasi</h2>
				</div>
				<div class="modal-body">
					<br>
					<div class='notif'>You have voted for this contestant</div>
					<br>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal  fade" id="sharecodemodal" tabindex="-1" role="dialog" aria-labelledby="sharecodemodal" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h2 align='center' class='auth' >Code Referal</h2>
				</div>
				<div class="modal-body">
					<br>
					<div class='notif'>
						<div class='row'>
							<div class='col-sm-8'>
								<input type='text' class='form-control' readonly value='<?=base_url()."register?req=".$member['my_referal'];?>' style='text-align:center;' id='myInput'>
							</div>
							<div class='col-sm-4'>
								<button class='btn btn-md btn-block btn-primary' onclick="myFunction()"><i class='fa fa-copy'></i> Copy &amp; Share</button>
								<div class='' id='mobilereferal'>
									<button type='button' class='btn btn-md btn-block btn-success btnwhatsapp' style='color:#FFFFFF;margin-top:5px;' data-text="Yuk gabung di Simply Authentic" data-link="<?=base_url().'register?req='.$member['my_referal'];?>"><i class='fa fa-whatsapp'></i> Share on Whatsapp</button>
								</div>
							</div>
						</div>
					</div>
					<br>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
<?php $this->load->view('front/podcast/footerfp');?>

<script>
function myFunction() {
  /* Get the text field */
  var copyText = document.getElementById("myInput");

  /* Select the text field */
  copyText.select();

  /* Copy the text inside the text field */
  document.execCommand("copy");

  /* Alert the copied text */
  //copyText.value
  alert("Share & Ajak teman Anda untuk daftar ");
}
		var isMobile = {
			Android: function() {
				return navigator.userAgent.match(/Android/i);
			},
			BlackBerry: function() {
				return navigator.userAgent.match(/BlackBerry/i);
			},
			iOS: function() {
				return navigator.userAgent.match(/iPhone|iPad|iPod/i);
			},
			Opera: function() {
				return navigator.userAgent.match(/Opera Mini/i);
			},
			Windows: function() {
				return navigator.userAgent.match(/IEMobile/i);
			},
			any: function() {
				return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
			}
		};
	$(document).on('ready', function() {

		$('#yarticle').hide();
		$('#ysong').hide();
		$('.backyour').click(function(){
			$('#ysong').hide();
			$('#yarticle').hide();
			$('#yhome').show();
		});
		$('.show-article').click(function(){
			$('#ysong').hide();
			$('#yhome').hide();
			$('#yarticle').show();
		});
		$('.show-soundroom').click(function(){
			$('#yarticle').hide();
			$('#yhome').hide();
			$('#ysong').show();
		});
		$('#mobilereferal').hide();
		if( isMobile.any() ) {
			$('#mobilereferal').show();
			$('.btnwhatsapp').click(function() {
				if( isMobile.any() ) {
					var text = $(this).attr("data-text");
					var url = $(this).attr("data-link");
					var message = encodeURIComponent(text) + " - " + encodeURIComponent(url);
					var whatsapp_url = "whatsapp://send?text=" + message;
					window.location.href = whatsapp_url;
				} else {
					alert("Please share this article in mobile device");
				}
			});
		}


		$('.share-code').click(function(){
			$('#sharecodemodal').modal('show');
		});
		$('.btn-redeemlogin').click(function(){
			$('#redeemlogin').modal('show');
		});
		$('.btn-redeemnot').click(function(){
			$('#redeemnotif').modal('show');
			$('#redeemnotif .notif').html('Kumpulin terus point lo, untuk dapetin barang-barang menarik');
		});
		$('.btn-redeemed').click(function(){
			$('#redeemnotif').modal('show');
			$('#redeemnotif .notif').html('You have redeemed this item');
		});
 		<?php if(!empty($this->datamember)){ ?>

		$('.btn-redeem').click(function(){
			var x = $(this).attr('data-res');
			$('#redeemmodal .btn-x').attr('data-x',x);
			$('#redeemmodal').modal('show');
		});
		$('.btn-x').click(function(){
			<?php if($okredeem=="ok"){?>
			var x = $(this).attr('data-x');
			var dataform = new FormData();
			dataform.append('<?php echo $this->security->get_csrf_token_name(); ?>', '<?php echo $this->security->get_csrf_hash(); ?>');
			dataform.append('x', x);
			$.ajax({
				type: "POST",
				data: dataform,
				dataType: "json",
				contentType: false,
				processData: false,
				url: "<?php echo base_url();?>profile/getredeem",
				beforeSend: function () {
					$('.btn-x').prop("disabled", true);
				},
				success: function (e) {
					$('.btn-x').prop("disabled", false);
					$('#redeemmodal').modal('hide');
					$('#redeemnotif').modal('show');
					var html = "";
					if(e.status=="false"){
						html = "<div class='alert alert-danger'>"+ e.message +"</div>";
					}else{
						$('#'+e.btnv).attr('class','btn btn-md btn-block btn-votehave btn-red');
						$('#tot').html(e.qtot);
						html = "<div class='alert alert-success'>"+ e.message +"</div>";
						html+= e.message2;
					}
					$('#redeemnotif .notif').html(html);
				},
				error: function () {
					$('#redeemmodal').modal('hide');
					$('#redeemnotif').modal('show');
					$('#redeemnotif .notif').html('ERROR!');
					$('.btn-x').prop("disabled", false);
				}
			});
			<?php }?>
		});
		<?php }?>
	});
</script>
