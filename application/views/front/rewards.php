<?php
	$kudu ="";
	@$page = $this->uri->segment(1);
	if(empty($this->datamember)){
		$kudu = " kudu-login";
	}

?>
<div class='min-height' >
	<div class='container rewards'>
		<div class='row'>
			<div class='col-sm-12'>
				<h1 class='head-rewards'>Authentic Rewards</h1>
			</div>
		</div>

		<img src="<?php echo base_url('assets/front/img/banner-rewards-2020.jpg') ?>" width="100%">
		<!--<img src="https://www.authenticity.id/uploads/head-rewards.jpeg" width="100%">-->


		<br><br><hr>



		<!--<div class='row'>
			<div class='col-md-8'>
				<br>
				<img src='<?=base_url()?>assets/front/img/banner-rewards.png' class='img-responsive' style='width:100%;'>
				<br>
				Hadiah yang bisa lo incar seperti di gambar ini.<br>Walaupun tidak sama mereknya, yang pasti nilainya sebanding.

			</div>
			<div class='col-md-4'>
				<div class='paper-rewards'>
					<div class='in-paper-rewards'>
						<h2>Perjuangkan Barang Impian Lo!</h2>
						<h4>
							Hanya butuh senang-senang dengan main games dan aktivasi di bawah ini, lo udah dianggap berjuang untuk barang-barang keren impian lo yang bisa dibawa pulang. Kumpulkan dan tukar poin biar banyak.
						</h4>
					</div>
				</div>
				<div class='row button-rewards'>
					<div class='col-sm-8 col-sm-offset-2'>
						<a href='<?=base_url();?>tnc-rewards' class='btn btn-block btn-red'>Terms &amp; Conditions</a>
						<br>
						<a href='<?=base_url();?>profile' class='btn btn-block btn-blue'>Check Your Rewards & Point</a>
					</div>
				</div>
			</div>
		</div> -->

		<br><br>
		<div class='row button-rewards'>
					<div class='col-sm-8 col-sm-offset-2'>
						<a href='<?=base_url();?>tnc-rewards' class='btn btn-block btn-red'>Terms &amp; Conditions</a>
						<br>
						<a href='<?=base_url();?>profile' class='btn btn-block btn-blue'>Check Your Rewards & Point</a>
					</div>
				</div>
		<br><br>


		<div class='row'>
			<div class='col-sm-12'>
				<h1 class='head-rewards'>Tambahin Poin Lo Sekarang!</h1>
				<h3 class='din'><b>Mau games atau aktivasi?</b></h3>


				<!--<div style="float:right;width:330px;">
				<div class='row button-rewards'>
					<div class='col-sm-8 col-sm-offset-2'>
						<a href='<?=base_url();?>tnc-rewards' class='btn btn-block btn-red'>Terms &amp; Conditions</a>
						<br>
						<a href='<?=base_url();?>profile' class='btn btn-block btn-blue'>Check Your Rewards & Point</a>
					</div>
				</div>
				</div>-->



			</div>
		</div>
		<br>
		<div class='row'>
			<div class='col-md-4 col-sm-6'>
				<div class='border-rewards'>
					<div  class='pin'>
						<img src="<?=base_url();?>assets/front/img/pin.png">
					</div>
					<div class="container-rewards product-div1">
						<img src="<?=base_url();?>assets/front/img/item-rewards1.png" alt="SIMPLY SCRABBLE"  class='transition' style="width:100%;">
						<div class="centered"><h1><a href='<?=($kudu=="") ? base_url()."rewards/scrable" : "javascript:void(0);";?>' class='<?=$kudu;?>'>SIMPLY<br>SCRABBLE</a></h1></div>
<!--					<div class="centered"><h1><a href="javascript:void(0);" class='<?=$kudu;?>'  onclick="alert('Coming soon');">SIMPLY<br>SCRABBLE</a></h1></div>-->
					</div>
				</div>
			</div>
			<div class='col-md-4 col-sm-6'>
				<div class='border-rewards'>
					<div  class='pin'>
						<img src="<?=base_url();?>assets/front/img/pin.png">
					</div>
					<div class="container-rewards product-div1">
						<img src="<?=base_url();?>assets/front/img/item-rewards2.png" alt="HAT BAND ARE YOU?" class='transition' style="width:100%;">
						<div class="centered"><h1><a href='<?=($kudu=="") ? base_url()."rewards/what-band-are-you" : "javascript:void(0);";?>' class='<?=$kudu;?>'>WHAT BAND<br>ARE YOU?</a></h1></div>
					</div>
				</div>
			</div>
			<div class='col-md-4 col-sm-6' style="display:none;">
				<div class='border-rewards'>
					<div  class='pin'>
						<img src="<?=base_url();?>assets/front/img/pin.png">
					</div>
					<div class="container-rewards product-div1">
						<img src="<?=base_url();?>assets/front/img/item-rewards6.jpg" alt="BUY AUTHENTICITY TICKET" class='transition' style="width:100%;">
						<div class="centered"><h1><a href='<?=($kudu=="") ? base_url()."ticket" : "javascript:void(0);";?>'  class='<?=$kudu;?>'>BUY AUTHENTICITY<br>TICKET</a></h1></div>
					</div>
				</div>
			</div>
			<div class='col-md-4 col-sm-6'>
				<div class='border-rewards'>
					<div  class='pin'>
						<img src="<?=base_url();?>assets/front/img/pin.png">
					</div>
					<div class="container-rewards product-div1">
						<img src="<?=base_url();?>assets/front/img/item-rewards9.jpg" alt="SCAN SPECIAL EDITION" class='transition' style="width:100%;">
						<div class="centered"><h1><a href='<?=($kudu=="") ? base_url()."design-competition-with-darbotz" : "javascript:void(0);";?>' x="<?=$this->datamember['fullname'];?>" class='<?=$kudu;?>'>KREASI DONASI<br>DESIGN COMPETITION</a> </h1></div>
						<!--<div class="centered"><h1><a href='javascript:void(0);' onclick="alert('Coming soon');" x="<?=$this->datamember['fullname'];?>" class='<?=$kudu;?>'>SCAN SPECIAL<br>EDITION</a><br><i class='fa fa-lock'></i></h1></div>-->
					</div>
				</div>
			</div>
			<div class='col-md-4 col-sm-6'>
				<div class='border-rewards'>
					<div  class='pin'>
						<img src="<?=base_url();?>assets/front/img/pin.png">
					</div>
					<div class="container-rewards product-div1">
						<img src="<?=base_url();?>assets/front/img/item-rewards4.jpg" alt="UPLOAD ARTICLE"  class='transition' style="width:100%;">
						<div class="centered"><h1><a href='<?=($kudu=="") ? base_url()."profile/write" : "javascript:void(0);";?>' class='<?=$kudu;?>'>UPLOAD<br>ARTICLE</a></h1></div>
					</div>
				</div>
			</div>
			<div class='col-md-4 col-sm-6'>
				<div class='border-rewards'>
					<div  class='pin'>
						<img src="<?=base_url();?>assets/front/img/pin.png">
					</div>
					<div class="container-rewards product-div1">
						<img src="<?=base_url();?>assets/front/img/item-rewards5.jpg" alt="READ & SHARE ARTICLE" class='transition' style="width:100%;">
						<div class="centered"><h1><a href='<?=base_url()."category/music/all";?>' >READ & SHARE<br>ARTICLE</a></h1></div>
					</div>
				</div>
			</div>
			<div class='col-md-4 col-sm-6' style="display:none;">
				<div class='border-rewards'>
					<div  class='pin'>
						<img src="<?=base_url();?>assets/front/img/pin.png">
					</div>
					<div class="container-rewards product-div1">
						<img src="<?=base_url();?>assets/front/img/item-rewards3.png" alt="AUTHENTIC ON GROUND" class='transition' style="width:100%;">
						<div class="centered"><h1><a href='<?=($kudu=="") ? base_url()."rewards/on-ground" : "javascript:void(0);";?>' x="<?=$this->datamember['fullname'];?>" class='<?=$kudu;?>'>AUTHENTIC<br>ON GROUND</a></h1></div>
						<!--<div class="centered"><h1><a href='javascript:void(0);' onclick="alert('Coming soon');" x="<?=$this->datamember['fullname'];?>" class='<?=$kudu;?>'>AUTHENTIC<br>ON GROUND</a><br><i class='fa fa-lock'></i></h1></div>-->
					</div>
				</div>
			</div>
			<div class='col-md-4 col-sm-6'>
				<div class='border-rewards'>
					<div  class='pin'>
						<img src="<?=base_url();?>assets/front/img/pin.png">
					</div>
					<div class="container-rewards product-div1">
						<img src="<?=base_url();?>assets/front/img/item-rewards7.jpg" alt="AUTHENTIC SOUNDROOM"  class='transition' style="width:100%;">
						<div class="centered"><h1><a href='<?=base_url()."soundroom";?>'>AUTHENTICITY<br>SOUNDROOM</a></h1></div>
					</div>
				</div>
			</div>
		</div>
		<div class='col-md-4 col-sm-6'>
				<div class='border-rewards'>
					<div  class='pin'>
						<img src="<?=base_url();?>assets/front/img/pin.png">
					</div>
					<div class="container-rewards product-div1">
						<img src="<?=base_url();?>assets/front/img/item-rewards8.jpg" alt="SCAN SPECIAL EDITION" class='transition' style="width:100%;">
						<div class="centered"><h1>

						<?php if($kudu==""){ ?>

						<a href='javascript:void(0);' class='share-code btn btn-block' >SHARE<br>REFERRAL CODE</a>
						<?php }else{ ?>
						kudu
						<?php } ?>

						</h1></div>
						<!--<div class="centered"><h1><a href='javascript:void(0);' onclick="alert('Coming soon');" x="<?=$this->datamember['fullname'];?>" class='<?=$kudu;?>'>SCAN SPECIAL<br>EDITION</a><br><i class='fa fa-lock'></i></h1></div>-->
					</div>
				</div>
			</div>



		<!-- CONTENT REWARD -->
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

		<!-- CONTENT REWARD END -->
	</div>
</div>
 <br><br><br>
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


	$(document).on('ready', function() {

 $('.share-code').click(function(){
			$('#sharecodemodal').modal('show');
		});

	});
</script>
