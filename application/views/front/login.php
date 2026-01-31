<div class="new-bs"><h1 style="font-size:2px;margin:0px;padding:0px;">Authenticity Login/Sign Upe</h1>
	<main class="main">
		<div class="page page-login">
			<section class="py-5">
				<div class="container">
					<div class="card card--shadow">
						<div class="card-left">
							<img src="<?php echo base_url() ?>assets/front/img/login/bg.png" alt="Authenticity">
						</div>
						<div class="card-right">
							<img src="<?php echo base_url() ?>assets/front/img/login/right.png" alt="Authenticity" class="img-full">
							<!-- Nav tabs -->
							<ul class="nav nav-tabs" role="tablist">
								<li role="presentation" id="signinTab" class="active"><a href="#login" role="tab" data-toggle="tab">Login</a></li>
								<li role="presentation" id="signupTab"><a href="#signUp" role="tab" data-toggle="tab">Sign Up</a></li>
							</ul>

							<!-- Tab panes -->
							<div class="tab-content">
								<div role="tabpanel" class="tab-pane fade in active" id="login">
									<?php
									$response = $this->session->flashdata('responsereset');
									if (isset($response["status"])) {
										$df = "";
										$dl = "none";
									} else {
										$df = "none";
										$dl = "";
									}
									?>
									<div id="CustomerLoginForm" style='display:<?= $dl; ?>'>
										<?php
										@$to = $_GET['to'];
										?>
										<form role="form" id="frmLogin" action="<?= base_url() ?>login/in?to=<?= $to; ?>" method="post" data-parsley-validate autocomplete="off">
											<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
											<input type="hidden" name="se" value="<?= $se; ?>" style="display: none">
											<div id="lblStatusLogin">
												<?php $response = $this->session->flashdata('response');
												if (isset($response["status"]) && $response["status"] == "error") : ?>
													<div class="alert alert-danger" id="notif-message" style='padding:10px;'>
														<?= $response["message"] ?>
													</div>
												<?php endif; ?>
											</div>
											<div class="form-group">
												<label for="emailLogin" class="d-none">Email</label>
												<input type="email" class="form-control" id="emailLogin" required maxlength="50" tabindex="1" placeholder="Email" name="email" autocomplete="off">
											</div>
											<div class="form-group">
												<label for="password" class="d-none">Password</label>
												<input type="password" class="form-control" id="password" required maxlength="50" tabindex="2" placeholder="Password" autocomplete="off" name="password">
												<span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
											</div>
											<div class="form-group">
												<input type="checkbox" name="rememberMe" id="rememberMe">&nbsp;Keep me logged in
											</div>
											<div class="form-group">
												<button type="submit" class="btn btn-primary btn-sm d-block img-full text-uppercase text-center">
													Login
												</button>
											</div>
											<p class="text-end">
												<a href="javascript:void(0);" id="RecoverPassword" class="text-red">Forgot password?</a>
											</p>
										</form>
									</div>
									<div id="RecoverPasswordForm" style='display:<?= $df; ?>'>
										<div class="new-color">Reset Password</div>

										<?php if (isset($this->session->flashdata('responsereset')["status"]) && $this->session->flashdata('responsereset')["status"] == "error") { ?>
											<div class="alert alert-danger" style='padding:10px;'>
												<?= $this->session->flashdata('responsereset')["message"] ?>
											</div>
										<?php } else if (isset($this->session->flashdata('responsereset')["status"]) && $this->session->flashdata('responsereset')["status"] == "success") { ?>
											<div class="alert alert-success" style='padding:10px;'>
												<?= $this->session->flashdata('responsereset')["message"] ?>
											</div>
										<?php } ?>

										<?php if( !isset($this->session->flashdata('responsereset')["status"]) || $this->session->flashdata('responsereset')["status"] == "error") : ?>
											<form method="post" action="<?= base_url() ?>login/reset" accept-charset="UTF-8" id='form-reset'>
												<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
												<input type="hidden" name="utf8" value="✓">
												<span class="hide reset-password-success"></span>
												<div class="form-group">
													<label for="RecoverEmail" class="control-label">
														Email
													</label>
													<input type="email" name="email" class="form-control" placeholder="Email" spellcheck="false" autocomplete="off" autocapitalize="off" required>
												</div>

												<div class="form-group">
													<div class="row justify-content-center">
														<div class="col-auto">
															<input type="button" class="btn btn-outline-primary btn-sm" id='cancelreset' value="Cancel">
														</div>
														<div class="col-auto">
															<input type="submit" class="btn btn-primary btn-sm text-uppercase" value="Submit">
														</div>
													</div>
												</div>
											</form>
										<?php else: ?>
											<div class="form-group">
												<input type="button" class="btn btn-outline-primary btn-sm d-block w-100" id='cancelreset' value="back to login">
											</div>
										<?php endif ?>
									</div>

									<div class="card-right__socials">
										<p>or login with</p>
										<ul>
											<li>
												<a href="<?php echo $google_login_url; ?>">
													<img src="<?php echo base_url() ?>assets/front/img/login/google.png" alt="Authenticity">
												</a>
											</li>
										</ul>
										<div style="color:red; margin-bottom:20px;">
											<?php echo $this->session->flashdata('connect_message'); ?>
										</div>

										<p>Don't have an account? <a href="#signUp" role="tab" data-toggle="tab">Create new now!</a></p>
										<p>By signing up, you are agree with our <a href="<?php echo site_url('tnc'); ?>">Terms & Conditions</a></p>
									</div>
								</div>
								<div role="tabpanel" class="tab-pane" id="signUp">
									<?php $this->load->view('front/register'); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
	</main>
</div>
<script>
	document.addEventListener('DOMContentLoaded', function() {
		const container = document.querySelector('.container');
		const togglePasswordButtons = container.querySelectorAll('.toggle-password');
		const recoverPasswordButton = document.getElementById('RecoverPassword');
		const cancelResetButton = document.getElementById('cancelreset');

		// hide notif kalo sudah lama
		const notifMessage = document.getElementById("notif-message");
		if(notifMessage){
			setTimeout(function() {
				notifMessage.style.display = 'none';
				notifMessage.innerHTML = ''; // Remove the content
			}, 3000);
		}
		

		container.addEventListener('click', function(event) {
			if (event.target.classList.contains('toggle-password')) {
				event.target.classList.toggle('fa-eye');
				event.target.classList.toggle('fa-eye-slash');
				const input = document.querySelector(event.target.getAttribute('toggle'));
				input.type = input.type === 'password' ? 'text' : 'password';
			}
		});

		if (recoverPasswordButton) {
			recoverPasswordButton.addEventListener('click', function() {
				const customerLoginForm = document.getElementById('CustomerLoginForm');
				const recoverPasswordForm = document.getElementById('RecoverPasswordForm');
				if (customerLoginForm && recoverPasswordForm) {
					customerLoginForm.style.display = 'none';
					recoverPasswordForm.style.display = 'block';
				}
			});
		}

		if (cancelResetButton) {
			cancelResetButton.addEventListener('click', function() {
				const recoverPasswordForm = document.getElementById('RecoverPasswordForm');
				const customerLoginForm = document.getElementById('CustomerLoginForm');
				if (recoverPasswordForm && customerLoginForm) {
					recoverPasswordForm.style.display = 'none';
					customerLoginForm.style.display = 'block';
				}
			});
		}
	});
</script>