<?php
$red = '';
if (isset($_GET['req']) && $_GET['req'] !== '') {
	$red = '?req=' . $_GET['req'];
}
?>
<div class="step-wizard">
	<!-- <ul class="step-wizard__indicator">
		<li class="step active"><span>1</span></li>
		<li class="step"><span>2</span></li>
		<li class="step"><span>3</span></li>
	</ul> -->
	<form role="form" id="step-form" action="<?= base_url(); ?>login/submitregister<?= $red; ?>" method="post" data-parsley-validate autocomplete="off">
		<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
		<input type="hidden" name="se" value="<?= isset($se) ? htmlspecialchars($se) : ''; ?>" style="display: none">
		<input type="hidden" name="to" value="<?= isset($_GET['to']) ? htmlspecialchars($_GET['to']) : ''; ?>" style="display: none">
		<input type="hidden" name="red" id="red-val" value="<?= isset($_GET['action'])? $_GET['action']:''; ?>" style="display: none">
		<?php $response = $this->session->flashdata('response');
		if (isset($response["status"]) && $response["status"] == "error") : ?>
			<div class="alert alert-danger" id="notif-message" style='padding:10px;'>
				<?= $response["message"] ?>
			</div>
		<?php endif; ?>

		<div id="lblStatusSignup">

		</div>
		<div class="step-wizard__content">
			<?php 
			$reg_issmoke = 0;
			$reg_username = $reg_fullname = $reg_email = $reg_gender = $reg_hp = $reg_rokok = $reg_rokoklain = $reg_nik = '';
			$reg_tgl = $reg_bln = $reg_thn = $reg_provinsi = $reg_kota = $reg_instagram = $reg_passion = $reg_district = '';
			$socialmedia_connect = $this->session->userdata('social_media');
			if( $socialmedia_connect=='twitter' || $socialmedia_connect=='facebook' || $socialmedia_connect=='google' ){
				$socialmedia_info = $this->session->userdata('socialmedia_info');
				$reg_fullname = $socialmedia_info['sosmed_name'];
				$reg_email = $socialmedia_info['sosmed_email'];
				echo '<input type="hidden" name="socialmedia_connect" value="'.$socialmedia_info.'" style="display: none">';
				echo '<input type="hidden" name="socialmedia_id" value="'.$socialmedia_info['sosmed_id'].'" style="display: none">';
			}
			
			//--- untuk tamp
			$tamp_register = $this->session->flashdata('tamp_register');
			if($tamp_register!=''){
				$reg_fullname = isset($tamp_register['fullname']) ? $tamp_register['fullname'] : '';
				$reg_username = isset($tamp_register['username']) ? $tamp_register['username'] : $reg_fullname;
				$reg_email = isset($tamp_register['email']) ? $tamp_register['email'] : '';
				$reg_gender = isset($tamp_register['gender']) ? $tamp_register['gender'] : '';
				$reg_hp = isset($tamp_register['hp']) ? $tamp_register['hp'] : '';
				$reg_issmoke = isset($tamp_register['issmoke']) ? $tamp_register['issmoke'] : 0;
				$reg_rokok = isset($tamp_register['rokok']) ? $tamp_register['rokok'] : '';
				$reg_rokoklain = isset($tamp_register['rokok_lain']) ? $tamp_register['rokok_lain'] : '';
				$reg_nik = isset($tamp_register['nik']) ? $tamp_register['nik'] : '';
				$reg_tgl = isset($tamp_register['tgl_lahir']) ? $tamp_register['tgl_lahir'] : '';
				$reg_bln = isset($tamp_register['bulan_lahir']) ? $tamp_register['bulan_lahir'] : '';
				$reg_thn = isset($tamp_register['tahun_lahir']) ? $tamp_register['tahun_lahir'] : '';
				$reg_provinsi = isset($tamp_register['id_provinsi']) ? $tamp_register['id_provinsi'] : '';
				$reg_kota = isset($tamp_register['id_kota']) ? $tamp_register['id_kota'] : '';
				$reg_district = isset($tamp_register['district']) ? $tamp_register['district'] : '';
				$reg_instagram = isset($tamp_register['instagram']) ? $tamp_register['instagram'] : '';
				$reg_passion = isset($tamp_register['passion']) ? (is_array($tamp_register['passion']) ? implode(', ', $tamp_register['passion']) : $tamp_register['passion']) : '';
			}
			?>
			<div class="step-wizard__page active">
				<div class="form-group" style="display:none">
					<label>Fullname </label>
					<input type="text" class="form-control " maxlength="100" placeholder="Entry Your Full Name" name="fullname" autocomplete="off" value="<?php echo $reg_fullname; ?>">
				</div>
				<div class="form-group">
					<label>Fullname <span class="text-danger">*</span></label>
					<input type="text" class="form-control " required maxlength="100" placeholder="Entry Your fullname" name="username" autocomplete="off" value="<?php echo $reg_username; ?>">
				</div>
				<div class="form-group">
					<label for="email">Email <span class="text-danger">*</span></label>
					<input type="email" class="form-control " required maxlength="50" placeholder="ex: your@gmail.com" name="email" id="emailSignup" autocomplete="off" value="<?php echo $reg_email; ?>">
					<div class="mt-1">
						<em class="text-red">* Check your email for the verification link!</em><br>
						<em class="text-red">* Google Mail is preferred to ensure the verification is smooth</em>
					</div>
				</div>
				<div class="form-group">
					<div class='row'>
						<div class='col-sm-6'>
							<label for="email">Gender</label>
							<select class='form-control' name='gender'>
								<option value=''>--</option>
								<option value='male' <?php echo ($reg_gender=='male')? 'selected':''; ?> >Male</option>
								<option value='female' <?php echo ($reg_gender=='female')? 'selected':''; ?> >Female</option>
							</select>
						</div>
						<div class='col-sm-6'>
							<label>Mobile Phone Number <span class="text-danger">*</span></label>
							<?php
								$regHpDigits = preg_replace('/\D+/', '', (string) $reg_hp);
								if (strpos($regHpDigits, '62') === 0) {
									$regHpDigits = substr($regHpDigits, 2);
								} elseif (strpos($regHpDigits, '0') === 0) {
									$regHpDigits = ltrim($regHpDigits, '0');
								}
							?>
							<div class="input-group">
								<span class="input-group-addon">+62</span>
								<input type="text" class="form-control" required maxlength="13" placeholder="8xxxxxxxxxx" name="hp" id="hp" inputmode="numeric" pattern="[0-9]*" autocomplete="off" value="<?php echo $regHpDigits; ?>">
							</div>
						</div>
					</div>
				</div>
				
				<div class="form-group" style="display:none">
					<label>Passion </label>
					<div class='row'>
						<div class='col-sm-6'>
							<input type="checkbox" id="passion1" name="passion[]" value="Basket">
							<label for="passion1"> Basket</label><br>
							<input type="checkbox" id="passion2" name="passion[]" value="Bola">
							<label for="passion2"> Bola</label><br>
							<input type="checkbox" id="passion3" name="passion[]" value="Musik">
							<label for="passion3"> Musik</label><br>
							<input type="checkbox" id="passion4" name="passion[]" value="Gaming">
							<label for="passion4"> Gaming</label>
						</div>
						<div class='col-sm-6'>
							<input type="checkbox" id="passion5" name="passion[]" value="Motoran">
							<label for="passion5"> Motoran</label><br>
							<input type="checkbox" id="passion6" name="passion[]" value="film">
							<label for="passion6"> film</label><br>
							<input type="checkbox" id="passion7" name="passion[]" value="Mobil">
							<label for="passion7"> Mobil</label><br>
							<input type="checkbox" id="passion8" name="passion[]" value="Travelling">
							<label for="passion8"> Travelling</label><br>
						</div>
					</div>
					<input type="text" class="form-control " maxlength="100" placeholder="Others" name="passion[]" value="<?php echo $reg_passion; ?>">
				</div>
				<div class="form-group" style="display:none">
					<div class='row'>
						<div class='col-sm-6'>
							<label class="me-3">Smoker ? <span class="text-danger">*</span></label>
							<label class="me-2"><input type='radio' name='issmoke' value='1' class='smoker' <?php echo ($reg_issmoke==1)? 'checked="checked"':''; ?> onclick="handleSmokerChange(this.value)"> Yes</label>
							<label><input type='radio' name='issmoke' value='0' class='smoker' <?php echo ($reg_issmoke==0)? 'checked="checked"':''; ?> onclick="handleSmokerChange(this.value)"> No</label>
						</div>
					</div>
				</div>
				<div class="form-group" id='smokerdiv'>
					<div class='row'>
						<div class='col-sm-6'>
							<label for="rokok">&nbsp;</label>
							<select class='form-control rokok' name='rokok' id="select-rokok" onchange="handleRokokChange(this.value)">
								<option value=''>-Choose your cigarette-</option>
								<option value='Clas Mild' <?php echo ($reg_rokok=='Clas Mild')? 'selected':''; ?>>Clas Mild</option>
								<option value='Dunhill Mild' <?php echo ($reg_rokok=='Dunhill Mild')? 'selected':''; ?>>Dunhill Mild</option>
								<option value='Gudang Garam Surya' <?php echo ($reg_rokok=='Gudang Garam Surya')? 'selected':''; ?>>Gudang Garam Surya</option>
								<option value='Sampoerna Ultra Mild' <?php echo ($reg_rokok=='Sampoerna Ultra Mild')? 'selected':''; ?>>Sampoerna Ultra Mild</option>
								<option value='LA Lights' <?php echo ($reg_rokok=='LA Lights')? 'selected':''; ?>>LA Lights</option>
								<option value='LA Bold' <?php echo ($reg_rokok=='LA Bold')? 'selected':''; ?>>LA Bold</option>
								<option value='Esse' <?php echo ($reg_rokok=='Esse')? 'selected':''; ?>>Esse</option>
								<option value='Marlboro' <?php echo ($reg_rokok=='Marlboro')? 'selected':''; ?>>Marlboro</option>
								<option value='Magnum Mild' <?php echo ($reg_rokok=='Magnum Mild')? 'selected':''; ?>>Magnum Mild</option>
								<option value='iQos' <?php echo ($reg_rokok=='iQos')? 'selected':''; ?>>iQos</option>
								<option value='Vape' <?php echo ($reg_rokok=='Vape')? 'selected':''; ?>>Vape</option>
								<option value='Pods' <?php echo ($reg_rokok=='Pods')? 'selected':''; ?>>Pods</option>
								<option value='Lainnya' <?php echo ($reg_rokok=='Lainnya')? 'selected':''; ?>>Lainnya</option>
							</select>
						</div>
						<div class='col-sm-6'>
							<label for="rokoklain">&nbsp;</label>
							<input type="text" class="form-control rokok-lain" placeholder="" name="rokok_lain" id="rokok-lain" autocomplete="off" value="<?php echo $reg_rokoklain; ?>" style="display:none;">
						</div>
					</div>
				</div>

				<div class="form-group" style="display:none">
					<label for="ktp">ID Number </label>
					<input type="tel" class="form-control" maxlength="16" placeholder="KTP / SIM / Passport Number here" name="nik" autocomplete="off" value="<?php echo $reg_nik; ?>" id="ktp">
				</div>
				<div class="row">
					<div class="col-md-12">
						<label for="confirmAge">Year of Birth </label>
					</div>
					<div class="col-md-3" style="display:none">
						<div class="form-group">
							<select class='form-control' id="date" name="tgl_lahir" >
								<option value=''>Date</option>
								<?php
								for ($i = 1; $i <= 31; $i++) {
								?>
									<option value='<?= $i ?>' <?php echo ($reg_tgl==$i)? 'selected':''; ?>><?= $i ?></option>
								<?php
								}
								?>

							</select>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<select class='form-control' id="month" name="bulan_lahir">
								<option value=''>Month</option>
								<?php
								$selected_month = date('m'); //current month
								// replace and add new months list
								// $months_name = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
								$months_name = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];


								for ($i_month = 1; $i_month <= 12; $i_month++) {
									// $selected = ($selected_month == $i_month ? ' selected' : '');
									$selected = '';
									if($reg_bln==$i_month){ $selected="selected"; } 
									echo '<option value="' . $i_month . '"' . $selected . '>' . $months_name[$i_month - 1] . '</option>' . "\n";
								}

								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<select class='form-control' id="year" name="tahun_lahir" >
								<option value=''>Year</option>
								<?php
								$max_age = 70;
								$min_age = 17;
								$current_date = date('Y');
								$max_year = $current_date - $min_age;
								$min_year = $max_year - $max_age;
								for ($i = $max_year; $i >= $min_year; $i--) {
									$selected_year = ($reg_thn == $i ? ' selected' : '');
									echo '<option value=' . $i . ' '.$selected_year.'>' . $i . '</option>';
								}

								?>
							</select>
						</div>
					</div>
					<div class="col-md-12">
						<label for="confirmAge"><span class="text-danger">*</span> This website and its membership only for people above 21 years old</label>
					</div>

				</div>
				<div class="form-group">
					<div class='row'>
						<div class='col-sm-6'>
							<label>Province *</label>
							<select class='form-control rokok' name='id_provinsi' id="id_provinsi" onchange="getKotaByProv(this.value)" required>
								<option value=''>--</option>
								<?php
								if (isset($provinsi) && count($provinsi) > 0) {
									foreach ($provinsi as $row) {
										$selected_provinsi = ($reg_provinsi == $row['provinsi'] ? ' selected' : '');
										echo "<option value='$row[id]' ".$selected_provinsi.">$row[provinsi]</option>";
									}
								}
								?>
							</select>
						</div>
						<div class='col-sm-6'>
							<label>City *</label>
							<select class='form-control kota' name='id_kota' id="id_kota" onchange="getKecByKota(this.value)" required>
								<option value=''>--</option>
							</select>
						</div>
						<div class='col-sm-12'>
							<label>District *</label>
							<select class='form-control kec' name='district' id="id_kec" value="<?php echo $reg_district; ?>" required>
								<option value=''>--</option>
							</select>
						</div>
						<div id="overlayAll" style="display: none;">Loading...</div>

					</div>
				</div>
				<div class="form-group">
					<label for="passwordSignup">Password</label>
					<input type="password" class="form-control" required maxlength="50" placeholder="Enter Your Password" autocomplete="off" name="password" id="passwordSignup" readonly onfocus="this.removeAttribute('readonly');">
					<span class="fa fa-fw fa-eye field-icon" onclick="handleTogglePasswordSignup(this)"></span>
				</div>
				<div class="form-group">
					<label for="passwordSignupConfirm">Confirm Password</label>
					<input type="password" class="form-control" required maxlength="50" placeholder="Re-entry Your Password" autocomplete="off" name="confirmpassword" id="passwordSignupConfirm" readonly onfocus="this.removeAttribute('readonly');">

					<span class="fa fa-fw fa-eye field-icon toggle-passwordconfirm-signup" onclick="handleTogglePasswordSignupConfirm(this)"></span>

				</div>
				<div class="form-group">
					<label for="password">Instagram Account</label>
					<input type="text" class="form-control " maxlength="50" placeholder="@youraccount" autocomplete="off" name="instagram" value="<?php echo $reg_instagram; ?>">
					<label for="register-message">* By submitting your data to Authenticity, you are willing to receive our updates and promotions via email</label>
				</div>
				

				<div class="form-group" >
					<div class='row'>
						<div class='col-sm-12'>
							<div class="form-check">
								<input class="form-check-input" type="checkbox" id="check1" name="option1" value="terms of use" required>
								<label class="form-check-label">Saya Menyetujui <a href="<?php echo base_url('tnc') ?>">Terms and Condition</a></label>
							</div>
							<div class="form-check">
								<input class="form-check-input" type="checkbox" id="check1" name="option1" value="privacy policy" required>
								<label class="form-check-label">Saya Menyetujui <a href="<?php echo base_url('privacy') ?>">Personal Information Processor Privacy</a></label>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="step-wizard__action">
			<!-- <button type="button" class="prev-button btn btn-outline-primary btn-sm">BACK</button>
			<button type="button" class="next-button btn btn-primary btn-sm">NEXT</button> -->
			<button type="submit" class="submit-button btn btn-primary btn-sm">SUBMIT</button>
		</div>
	</form>
</div>


<script src="<?php echo base_url() ?>assets/front/js/moment.js"></script>
<script>
	document.addEventListener("DOMContentLoaded", function() {
		const form = document.getElementById("step-form");
		const steps = document.querySelectorAll(".step-wizard__page");
		const stepIndicators = document.querySelectorAll(".step");
		let currentStep = 0;
		const emailInput = document.getElementById("emailSignup");
		const passwordInput = document.getElementById("passwordSignup");
		const confirmPasswordInput = document.getElementById("passwordSignupConfirm");
		const togglePasswordButtonSignUp = document.querySelector(".toggle-password-signup");
		const togglePasswordConfirmButtonSignUp = document.querySelector(".toggle-passwordconfirm-signup");
		const smokerDiv = document.getElementById("smokerdiv");
		const smokerRadioButtons = document.querySelectorAll('.smoker');
		const selectrokok = document.getElementById('select-rokok');
		const rokoklain = document.getElementById('rokok-lain');
		const lblStatusSignup = document.getElementById("lblStatusSignup");
		// const frmRegister = document.getElementById("frmRegister");
		const frmRegister = document.getElementById("step-form");
		const btnRegister = document.getElementById("btnRegister");
		const idProvinsi = document.getElementById("id_provinsi");
		const overlayAll = document.querySelector(".overlay-all");
		const urlParams = new URLSearchParams(window.location.search);
		const isDebugMoe = urlParams.get('debug_moe') === '1';
		const nextButton = document.querySelector(".next-button");
		const prevButton = document.querySelector(".prev-button");
		let allowSubmit = false;

		const redVal = document.getElementById("red-val");
		if(redVal && redVal.value=='register'){
			const signinTab = document.getElementById('signinTab');
			const signupTab = document.getElementById('signupTab');
			signinTab.classList.remove('active');
			signupTab.classList.add('active');

			const login = document.getElementById('login');
			const signUp = document.getElementById('signUp');
			login.classList.remove('active');
			signUp.classList.add('active');

			const rokok = selectrokok.value;
			if( rokok == 'Lainnya' ){
				rokoklain.style.display = 'block';
			}else{
				rokoklain.style.display = 'none';
			}
		}else{

			// Clear input values
			if (emailInput) emailInput.value = '';
			if (passwordInput) passwordInput.value = '';
			if (confirmPasswordInput) confirmPasswordInput.value = '';

			// Hide smoker div by default
			if (smokerDiv) smokerDiv.style.display = "none";
		}

		// hide notif kalo sudah lama
		const notifMessage = document.getElementById("notif-message");
		if(notifMessage){
			setTimeout(function() {
				notifMessage.style.display = 'none';
				notifMessage.innerHTML = ''; // Remove the content
			}, 3000);
		}
		


		// Initialize the form
		//updateStep(currentStep);

		function updateStep(step) {
			steps.forEach((s, index) => {
				if (index === step) {
					s.classList.add("active");
					stepIndicators[index].classList.add("active");
				} else {
					s.classList.remove("active");
					stepIndicators[index].classList.remove("active");
				}

				if (index === step || step > index) {
					stepIndicators[index].classList.add('active')
				} else {
					stepIndicators[index].classList.remove('active')
				}
			});

			if (prevButton) {
				if (step === 0) {
					prevButton.style.display = "none";
				} else {
					prevButton.style.display = "block";
				}
			}

			const submitButton = document.querySelector(".submit-button");
			if (submitButton && nextButton) {
				if (step === steps.length - 1) {
					nextButton.style.display = "none";
					submitButton.style.display = "block";
				} else {
					nextButton.style.display = "block";
					submitButton.style.display = "none";
				}
			}
		}

		function validateStep(step) {
			const stepContainer = steps[step];
			const inputs = stepContainer.querySelectorAll("input[required], select[required]");

			for (const element of inputs) {
				if (!element.value) {
					return false;
				}
			}

			return true;
		}

		if (nextButton) {
			nextButton.addEventListener("click", function() {
				if (validateStep(currentStep)) {
					currentStep++;
					updateStep(currentStep);
				} else {
					lblStatusSignup.innerHTML = "<div class='alert alert-danger'>Please fill in all required fields</div>";
					allowSubmit = false;
					setTimeout(function() {
						lblStatusSignup.innerHTML = ''; // Remove the content
					}, 3000);
				}
			});
		}

		if (prevButton) {
			prevButton.addEventListener("click", function() {
				currentStep--;
				updateStep(currentStep);
			});
		}

		stepIndicators.forEach((step, index) => {
			step.addEventListener("click", function() {
				if (index !== currentStep) {
					currentStep = index;
					updateStep(currentStep);
				}
			});
		});

		// Function to set input filter
		function setInputFilter(textbox, inputFilter) {
			if (!textbox) return;
			const events = ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"];

			events.forEach((event) => {
				textbox.addEventListener(event, function() {
					if (inputFilter(this.value)) {
						this.oldValue = this.value;
						this.oldSelectionStart = this.selectionStart;
						this.oldSelectionEnd = this.selectionEnd;
					} else if (this.hasOwnProperty("oldValue")) {
						this.value = this.oldValue;
						this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
					}
				});
			});
		}

		// Set input filter for element with id "ktp"
		setInputFilter(document.getElementById("ktp"), function(value) {
			return /^\d*\.?\d*$/.test(value);
		});
		// Set input filter for element with id "hp"
		setInputFilter(document.getElementById("hp"), function(value) {
			return /^\d*\.?\d*$/.test(value);
		});

		// Function to toggle password visibility
		function togglePasswordVisibilitySignup(input) {
			if (!input) return;
			input.type = input.type === "password" ? "text" : "password";
		}

		function normalizePhoneTo62(rawValue) {
			const digits = String(rawValue || "").replace(/\D/g, "");
			if (!digits) return "";
			if (digits.startsWith("62")) return digits;
			if (digits.startsWith("0")) return "62" + digits.slice(1);
			return "62" + digits;
		}

		// Event listener for password toggle button
		if (togglePasswordButtonSignUp) {
			togglePasswordButtonSignUp.addEventListener("click", function() {
				togglePasswordVisibilitySignup(passwordInput);
			});
		}
		// Event listener for password-confirm toggle button
		if (togglePasswordConfirmButtonSignUp) {
			togglePasswordConfirmButtonSignUp.addEventListener("click", function() {
				togglePasswordVisibilitySignup(confirmPasswordInput);
			});
		}

		// Event listener for rokok select change
		if (selectrokok) {
			selectrokok.addEventListener("change", function(){
				const rokok = selectrokok.value;
				if( rokok == 'Lainnya' ){
					if (rokoklain) rokoklain.style.display = 'block';
				}else{
					if (rokoklain) rokoklain.style.display = 'none';
				}
			});
		}

		// Event listener for smoker radio buttons
		if (smokerDiv) smokerDiv.style.display = "none";
		smokerRadioButtons.forEach((radio) => {
			radio.addEventListener("click", function() {
				const val = radio.value;
				if (val === "1") {
					document.querySelectorAll(".rokok").forEach((rokok) => {
						rokok.setAttribute("required", "required");
					});
					smokerDiv.style.display = "block";
				} else {
					document.querySelectorAll(".rokok").forEach((rokok) => {
						rokok.removeAttribute("required");
					});
					smokerDiv.style.display = "none";
				}
			});
		});

		// Event listener for confirmPasswordInput keyup
		if (confirmPasswordInput && passwordInput && lblStatusSignup) {
			confirmPasswordInput.addEventListener("keyup", function(e) {
				const pass = passwordInput.value;
				const confpass = confirmPasswordInput.value;
				if (pass === confpass) {
					lblStatusSignup.innerHTML = "<div class='alert alert-success'>Password is match</div>";
					allowSubmit = true;
				} else {
					lblStatusSignup.innerHTML = "<div class='alert alert-danger'>Password not matching</div>";
					allowSubmit = false;

					setTimeout(function() {
						lblStatusSignup.innerHTML = '';
					}, 3000);
				}
			});
		}

		// Debug payload untuk inspeksi form submit (tanpa kirim event dari halaman register).
		if (form) {
			form.addEventListener("submit", function (e) {
				try {
					if (form.hp) {
						form.hp.value = normalizePhoneTo62(form.hp.value);
					}
					const payload = {
						fullname: form.username ? form.username.value : "",
						email: form.email ? form.email.value : "",
						gender: form.gender ? form.gender.value : "",
						mobile_number: form.hp ? form.hp.value : "",
						year_of_birth: form.tahun_lahir ? form.tahun_lahir.value : "",
						month_of_birth: form.bulan_lahir ? form.bulan_lahir.value : "",
						day_of_birth: form.tgl_lahir ? form.tgl_lahir.value : "",
						province_id: form.id_provinsi ? form.id_provinsi.value : "",
						city_id: form.id_kota ? form.id_kota.value : "",
						district: form.district ? form.district.value : "",
						instagram_account: form.instagram ? form.instagram.value : "",
						smoker: (function () {
							const checked = document.querySelector("input[name='issmoke']:checked");
							return checked ? checked.value : "";
						})(),
						cigarette: form.rokok ? form.rokok.value : "",
						passion: (function () {
							const passions = form.querySelectorAll("input[name='passion[]']:checked");
							return Array.from(passions).map(function (p) { return p.value; });
						})()
					};

					if (window.console && console.log) {
						console.log("MoEngage registration payload:", payload);
						console.table ? console.table(payload) : null;
					}

					// Jika ada ?debug_moe=1 di URL, tahan submit supaya payload bisa dibaca dengan jelas
					if (isDebugMoe) {
						e.preventDefault();
						alert('Payload telah dicetak di DevTools Console (lihat \"MoEngage registration payload\")');
					}
				} catch (e) {
					if (window.console && console.error) {
						console.error("Error building MoEngage debug payload:", e);
					}
				}
			});
		}

	});


</script>
<script>
	function getKotaByProv(prov) {
		// Tampilkan overlay
		const overlayAll = document.getElementById("overlayAll");
		overlayAll.style.display = "block";

		const dataform = new FormData();
		dataform.append('<?= $this->security->get_csrf_token_name(); ?>', '<?= $this->security->get_csrf_hash(); ?>');
		dataform.append('id', prov);
		dataform.append('search', prov);

		fetch('<?= base_url() ?>home/getcity', {
			method: "POST",
			body: dataform,
		})
		.then((response) => response.json())
		.then((e) => {
			overlayAll.style.display = "none";
			const idKota = document.getElementById("id_kota");
			idKota.innerHTML = "<option value=''>--</option>";

			const dats = e.data;
			dats.forEach((item) => {
				const ids = item.id;
				const kotas = item.kabupaten_kota;
				idKota.innerHTML += `<option value="${ids}">${kotas}</option>`;
			});
		})
		.catch((error) => {
			overlayAll.style.display = "none";
			console.error(error);
			alert('Error Jaringan..!!');
		});
	}
	function getKecByKota(kot) {
		// Tampilkan overlay
		const overlayAll = document.getElementById("overlayAll");
		overlayAll.style.display = "block";

		const dataform = new FormData();
		dataform.append('<?= $this->security->get_csrf_token_name(); ?>', '<?= $this->security->get_csrf_hash(); ?>');
		dataform.append('id', kot);
		dataform.append('search', kot);

		fetch('<?= base_url() ?>home/getkec', {
			method: "POST",
			body: dataform,
		})
		.then((response) => response.json())
		.then((e) => {
			overlayAll.style.display = "none";
			const idKec = document.getElementById("id_kec");
			idKec.innerHTML = "<option value=''>--</option>";

			const dats = e.data;
			dats.forEach((item) => {
				const ids = item.kabkot_id;
				const kecamatan = item.kecamatan;
				idKec.innerHTML += `<option value="${kecamatan}">${kecamatan}</option>`;
			});
		})
		.catch((error) => {
			overlayAll.style.display = "none";
			console.error(error);
			alert('Error Jaringan..!!');
		});
	}
	function handleTogglePasswordSignup(el) {
		const passwordInput = document.getElementById("passwordSignup");

		// Toggle visibility
		if (passwordInput.type === "password") {
			passwordInput.type = "text";
			el.classList.remove("fa-eye");
			el.classList.add("fa-eye-slash");
		} else {
			passwordInput.type = "password";
			el.classList.remove("fa-eye-slash");
			el.classList.add("fa-eye");
		}
	}
	function handleTogglePasswordSignupConfirm(el) {
		const confirmPasswordInput = document.getElementById("passwordSignupConfirm");

		if (confirmPasswordInput.type === "password") {
			confirmPasswordInput.type = "text";
			el.classList.remove("fa-eye");
			el.classList.add("fa-eye-slash");
		} else {
			confirmPasswordInput.type = "password";
			el.classList.remove("fa-eye-slash");
			el.classList.add("fa-eye");
		}
	}
	function handleSmokerChange(val) {
		const smokerDiv = document.getElementById("smokerdiv");

		if (val === "1") {
			document.querySelectorAll(".rokok").forEach((rokok) => {
				rokok.setAttribute("required", "required");
			});
			smokerDiv.style.display = "block";
		} else {
			document.querySelectorAll(".rokok").forEach((rokok) => {
				rokok.removeAttribute("required");
			});
			smokerDiv.style.display = "none";
		}
	}
	function handleRokokChange(rokok) {
		const rokoklain = document.getElementById("rokok-lain");
		if (rokok === 'Lainnya') {
			rokoklain.style.display = 'block';
		} else {
			rokoklain.style.display = 'none';
		}
	}
</script>



