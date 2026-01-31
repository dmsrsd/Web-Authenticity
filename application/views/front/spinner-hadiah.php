<!-- <link href="<?php echo base_url() ?>assets/front/css/spinner.css" rel="stylesheet" /> -->
<style>
  #wrapper {
    margin: 40px auto 0;
    width: 266px;
    position: relative;
  }
  #txt {
    color: #eaeaea;
  }
  #wheel {
    width: 250px;
    height: 250px;
    border-radius: 50%;
    position: relative;
    overflow: hidden;
    border: 8px solid #fff;
    box-shadow: rgba(0, 0, 0, 0.2) 0px 0px 10px, rgba(0, 0, 0, 0.05) 0px 3px 0px;
    transform: rotate(0deg);
  }
  #wheel:before {
    content: '';
    position: absolute;
    border: 4px solid rgba(0, 0, 0, 0.1);
    width: 242px;
    height: 242px;
    border-radius: 50%;
    z-index: 1000;
    transform: translate(-50%, -50%);
    left: 50%;
    top: 50%;
  }
  #inner-wheel {
    width: 100%;
    height: 100%;
    transition: all 6s cubic-bezier(0, .99, .44, .99);
  }
  #wheel .sec {
    position: absolute;
    width: 0;
    height: 0;
    border-style: solid;
    border-width: 120px 39px 0;
    border-color: #19c transparent;
    transform-origin: 39px 120px;
    left: 78px;
    top: -4px;
    opacity: 1;
  }
  #wheel .sec:nth-child(1) {
    transform: rotate(36deg);
    border-color: #a01695 transparent;
  }
  #wheel .sec:nth-child(2) {
    transform: rotate(72deg);
    border-color: #3c763d transparent;
  }
  #wheel .sec:nth-child(3) {
    transform: rotate(108deg);
    border-color: #8a6d3b transparent;
  }
  #wheel .sec:nth-child(4) {
    transform: rotate(144deg);
    border-color: #f39c12 transparent;
  }
  #wheel .sec:nth-child(5) {
    transform: rotate(180deg);
    border-color: #d35400 transparent;
  }
  #wheel .sec:nth-child(6) {
    transform: rotate(216deg);
    border-color: #16a085 transparent;
  }
  #wheel .sec:nth-child(7) {
    transform: rotate(252deg);
    border-color: #2980b9 transparent;
  }
  #wheel .sec:nth-child(8) {
    transform: rotate(288deg);
    border-color: #34495e transparent;
  }
  #wheel .sec:nth-child(9) {
    transform: rotate(324deg);
    border-color: #0b3b7f transparent;
  }
  #wheel .sec:nth-child(10) {
    transform: rotate(360deg);
    border-color: #c0392b transparent;
  }
  #wheel .sec .fa {
    transform: rotateZ(85deg);
    margin-top: -108px;
    color: #fff;
    position: relative;
    z-index: 1000000;
    display: block;
    text-align: center;
    font-size: 11px;
    margin-left: -3px;
    text-shadow: rgba(255, 255, 255, 0.1) 0px -1px 0px, rgba(0, 0, 0, 0.2) 0px 1px 0px;
  }
  #spin {
    width: 68px;
    height: 68px;
    position: absolute;
    top: 50%;
    left: 50%;
    margin: -34px 0 0 -34px;
    border-radius: 50%;
    box-shadow: rgba(0, 0, 0, 0.1) 0px 3px 0px;
    z-index: 1000;
    background: #fff;
    cursor: pointer;
    font-family: "Exo 2", sans-serif;
    user-select: none;
  }

  img.label-roulette {
      position: absolute;
      z-index: 999;
      left: 5px;
      top: 12px;
      transform: rotate(-45deg);
  }
  /* #spin:before {
    content: '';
    position: absolute;
    width: 0;
    height: 0;
    border-style:  solid;
    border-width: 0 20px 28px 20px;
    border-color: transparent transparent #fff transparent;
    top: -12px;
    left: 14px;
  } */
  #inner-spin {
      width: 54px;
      height: 54px;
      position: absolute;
      top: 50%;
      left: 50%;
      margin: -27px 0 0 -27px;
      border-radius: 50%;
      z-index: 999;
      color: #fff;
      background: #0b3b7f;
      font-size: 22pt;
      padding: 6px 0px 0px 7px;
  }
  #spin:active #inner-spin {
    box-shadow: rgba(0, 0, 0, 0.4) 0px 0px 5px inset;
  }
  #spin:active:after {
    font-size: 15px;
  }
  #shine {
    width: 250px;
    height: 250px;
    position: absolute;
    top: 0;
    left: 0;
    background: radial-gradient(ellipse at center, rgba(255, 255, 255, 1) 0%, rgba(255, 255, 255, 0.99) 1%, rgba(255, 255, 255, 0.91) 9%, rgba(255, 255, 255, 0) 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr = '#ffffff', endColorstr='#00ffffff', GradientType=1);
    opacity: 0.1;
  }
  @keyframes hh {
    0%, 100% {
      transform: rotate(0deg);
    }
    50% {
      transform: rotate(7deg);
    }
  }
  .spin {
    animation: hh 0.1s;
  }
  .content-spinner .btn.btn-spin {
    min-width: 150px;
    background-color: #0d549c;
    color: #fff;
  }
</style>
<div class="new-bs">
	<main class="main">
		<div class="page page-profile">
			<section class="py-5">
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-lg-8 col-md-10">
							<div class="card card--shadow text-center">
                <div id="wrapper">
                    <img src="<?php echo base_url() ?>assets/front/img/profile/tanda.png" width="50px" class="label-roulette">
                  <div id="wheel">
                    <div id="inner-wheel">
                      <?php foreach($datapemenang as $rows): ?>
                      <div class="sec">
                        <span class="fa" data-id="lonceng"><?php echo $rows['nama_hadiah'] ?></span>
                      </div>
                      <?php endforeach; ?>
                      <div class="sec">
                        <span class="fa fa-star-o" data-id="koment"> Coba Lagi</span>
                      </div>
                      <!-- <div class="sec">
                        <span class="fa fa-comment-o" data-id="koment"></span>
                      </div>
                      <div class="sec">
                        <span class="fa fa-smile-o" data-id="senyum"></span>
                      </div>
                      <div class="sec">
                        <span class="fa fa-heart-o" data-id="hati"></span>
                      </div>
                      <div class="sec">
                        <span class="fa fa-star-o" data-id="bintang"></span>
                      </div>
                      <div class="sec">
                        <span class="fa fa-lightbulb-o" data-id="lampu"></span>
                      </div> -->
                    </div>
                    
                    <div id="spin">
                      <div id="inner-spin"><span class="fa fa-play label-play"></span></div>
                    </div>
                    
                    <div id="shine"></div>
                  </div>
                  <div id="txt"></div>
                </div>
								<div class="content-spinner">
                  <div class="text-info" id="info-hasil" style="display:none">
                    <p>Klaim hadiah lo dengan mengeklik tombol di bawah dan <br> isikan dengan detil alamat kirim dan keterangan diri lainnya ya!.</p>
                    <button type="button" class="btn btn-spin" data-toggle="modal" data-target="#myModal">
                        KLAIM HADIAH LO
                    </button>
                  </div>
								</div>								
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
	</main>
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="<?php echo base_url(); ?>unlock/prosesconfirmhadiah" method="post" data-parsley-validate enctype="multipart/form-data">
      <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
      <input type="hidden" name="user_id" value=""  id="memberid" required>
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Form klaim hadiah</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Nama :</label>
            <input type="text" class="form-control" name="nama_user" value="<?php echo $this->datamember['fullname']; ?>" required>
          </div>
          <div class="form-group">
            <label>Link Akun IG :</label>
            <input type="text" class="form-control" placeholder="Link Akun IG" name="akun_ig" maxlength="200" required>
          </div>
          <div class="form-group">
            <label>Alamat Lengkap Pengiriman :</label>
            <textarea name="alamat" rows="3" class="form-control"  required></textarea>
          </div>
          <div class="form-group">
            <label>No HP :</label>
            <input type="text" class="form-control" placeholder="08XXXXXXXXXX" name="no_hp" maxlength="15" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
          <button type="submit" type="button" class="btn bg-info btn-sm" style="background-color: #0d549c; color: #fff;">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>
<script src="<?php echo base_url() ?>assets/front/js/jquery.js"></script>
<script>
   
$(document).ready(function() {
  $('#spin').click(function() {    
      totalDegree = <?php echo $kode_hadiah ?>; 
      $('#wheel .sec').each(function() {
          var t = $(this);
          var noY = 0;          
          var c = 0;
          var n = 700;
          var interval =  setInterval(function () {
            var aoY = t.offset().top;
            //$('#txt').html(aoY);
            
            if(aoY < 300) {
              $('.label-play').remove();
            }
          }, 10);
      
        $('#inner-wheel').css({'transform' : 'rotate(' + totalDegree + 'deg)'});
        
        noY = t.offset().top;
       // console.log(noY);
      });
      setTimeout(function () {
        alert('Yeayyy!!! Peruntungan lo lagi bagus. Lo berhak mendapatkan merchandise : <?php echo $nama_hadiah ?>');
        //jalakan ajax
       var hadiah = '<?php echo $nama_hadiah ?>';
        $.ajax({
          type: "GET",
          url: "<?php echo base_url('unlock/hadiah'); ?>",
          data: {data:hadiah},
          cache: false,
          success: function(data){
            $('#memberid').val(data);
            $('#info-hasil').show('slow');
          },
          error: function(error) {
            alert('kendala jaringan silahkan ulangi lagi');
            location.reload();
        }
        });
      }, 6000);
  });
});
</script>