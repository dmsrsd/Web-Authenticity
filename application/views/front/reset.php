<br><br><br>
<div class='min-height'>
	<div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default box-login-1" style="box-shadow: 0 0 8px #e2e2e2;">
                    <div class="panel-body">
					<?php
						$response = $this->session->flashdata('responsereset');
						if(isset($response["status"])){
							$df = "";
							$dl = "none";
						}else{
							$df = "none";
							$dl = "";
						}
					?>
						<div id="CustomerLoginForm" style='display:<?=$dl;?>'>
							<div class="text-center">
							  <img class="login-log" src="<?=base_url()?>assets/front/img/lock.png" width='70'>
							</div>
							<div class="new-color">Reset Password</div>
							<img class="shadow-log" src="<?=base_url()?>assets/front/img/shadow.png">
							<form role="form" id="frmLogin"  action="<?=base_url()?>login/submitresetform?ver=<?=@$_GET['ver'];?>"  method="post" data-parsley-validate  autocomplete="off">
								<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
								<div id="lblStatusLogin">
								<?php $response = $this->session->flashdata('response'); if(isset($response["status"]) && $response["status"] == "error"): ?>
									<div class="alert alert-danger" style='padding:10px;'>
										<?=$response["message"]?>
									</div>
								<?php endif; ?>
								<?php $response = $this->session->flashdata('response'); if(isset($response["status"]) && $response["status"] == "success"): ?>
									<div class="alert alert-success" style='padding:10px;'>
										<?=$response["message"]?>
									</div>
								<?php endif; ?>
								</div>
								<div class="form-group">
									<label for="password">New Password</label>
									<input type="password" class="form-control  big-text" id="password" required maxlength="50" tabindex="2" placeholder="Enter Your New Password" autocomplete="off" name="password"  readonly onfocus="this.removeAttribute('readonly');" >
									<span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
								</div>
								<!--<div class="form-group">
									<label for="password">Re-type Password</label>
									<input type="password" class="form-control  big-text" id="password" required maxlength="50" tabindex="2" placeholder="Enter Your Password" autocomplete="off" name="password"  readonly onfocus="this.removeAttribute('readonly');" >
									<span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
								</div>-->
								<div class="btn-log1">
								  <button type="submit" id="btnLogin" class="btn btn-find hauto2">
									Reset
								  </button>
								</div>
							</form>
						</div>

                    </div>

                    <div class="panel-footer" style='background-color:#FFFFFF;'>
                      <div class="row">
                        <div class="col-md-12">
                        </div>
                      </div>
                      <div class="row">
                            <div class="col-sm-12">
								  <h4 class="mera">Don't have an account?</h4>
								  <a href='<?=base_url()?>register'>Regsiter Here</a>
                            </div>
                        </div>
						<br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('front/podcast/footerfp');?>
<script>
	$(document).on('ready', function() {
		$(".toggle-password").click(function() {

			$(this).toggleClass("fa-eye fa-eye-slash");
			var input = $($(this).attr("toggle"));
			if (input.attr("type") == "password") {
			input.attr("type", "text");
			} else {
			input.attr("type", "password");
			}
		});
		$('#RecoverPassword').click(function(){
			$('#CustomerLoginForm').hide();
			$('#RecoverPasswordForm').slideDown();
		});
		$('#cancelreset').click(function(){
			$('#RecoverPasswordForm').slideUp();
			$('#CustomerLoginForm').show();
		});

	});
</script>
