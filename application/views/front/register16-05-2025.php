<?php
// $red = "";
// if (isset($_GET['req'])) {
// 	if ($_GET['req'] != "") {
// 		$red = "?req=" . $_GET['req'];
// 	}
// }
?>

<div class="step-wizard">
	<ul class="step-wizard__indicator">
		<li class="step active"><span>1</span></li>
		<li class="step"><span>2</span></li>
		<li class="step"><span>3</span></li>
	</ul>
	<form role="form" id="step-form" action="<?= base_url(); ?>login/submitregister<?= $red; ?>" method="post" data-parsley-validate autocomplete="off">
		<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
		<input type="hidden" name="se" value="<?= $se; ?>" style="display: none">
		<input type="hidden" name="to" value="<?= $_GET['to']; ?>" style="display: none">
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
			$reg_fullname = $reg_email = $reg_gender = $reg_hp = $reg_rokok = $reg_rokoklain = $reg_nik = '';
			$reg_tgl = $reg_bln = $reg_thn = $reg_provinsi = $reg_kota = $reg_instagram = '';
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
				$reg_fullname = $tamp_register['fullname'];
				$reg_email = $tamp_register['email'];
				$reg_gender = $tamp_register['gender'];
				$reg_hp = $tamp_register['hp'];
				$reg_issmoke = $tamp_register['issmoke'];
				$reg_rokok = $tamp_register['rokok'];
				$reg_rokoklain = $tamp_register['rokok_lain'];
				$reg_nik = $tamp_register['nik'];
				$reg_tgl = $tamp_register['tgl_lahir'];
				$reg_bln = $tamp_register['bulan_lahir'];
				$reg_thn = $tamp_register['tahun_lahir'];
				$reg_provinsi = $tamp_register['id_provinsi'];
				$reg_kota = $tamp_register['id_kota'];
				$reg_instagram = $tamp_register['instagram'];
			}
			?>
			<div class="step-wizard__page active">
				<div class="form-group">
					<label>Name <span class="text-danger">*</span></label>
					<input type="text" class="form-control " required maxlength="100" placeholder="Entry Your Full Name" name="fullname" autocomplete="off" value="<?php echo $reg_fullname; ?>">
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
							<label for="email">Gender <span class="text-danger">*</span></label>
							<select class='form-control' name='gender' required>
								<option value=''>--</option>
								<option value='male' <?php echo ($reg_gender=='male')? 'selected':''; ?> >Male</option>
								<option value='female' <?php echo ($reg_gender=='female')? 'selected':''; ?> >Female</option>
							</select>
						</div>
						<div class='col-sm-6'>
							<label>Phone number <span class="text-danger">*</span></label>
							<input type="text" data-country="ID" class="form-control bfh-phone" data-format="+62 (ddd) ddd-dddd" required maxlength="13" placeholder="08xxxxxxxxxx" name="hp" id="hp" autocomplete="off" value="<?php echo $reg_hp; ?>">
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class='row'>
						<div class='col-sm-6'>
							<label class="me-3">Smoker ? </label>
							<label class="me-2"><input type='radio' name='issmoke' value='1' class='smoker' <?php echo ($reg_issmoke==1)? 'checked="checked"':''; ?>> Yes</label>
							<label><input type='radio' name='issmoke' value='0' class='smoker' <?php echo ($reg_issmoke==0)? 'checked="checked"':''; ?>> No</label>
						</div>
					</div>
				</div>
				<div class="form-group" id='smokerdiv'>
					<div class='row'>
						<div class='col-sm-6'>
							<label for="rokok">&nbsp;</label>
							<select class='form-control rokok' name='rokok' id="select-rokok">
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

				<div class="form-group" >
					<div class='row'>
						<div class='col-sm-12'>
							<div class="form-check">
								<input class="form-check-input" type="checkbox" id="check1" name="option1" value="terms of use" required>
								<label class="form-check-label">Saya Menyetujui <a href="https://www.authenticity.id/tnc">Terms and Condition</a></label>
							</div>
							<div class="form-check">
								<input class="form-check-input" type="checkbox" id="check1" name="option1" value="privacy policy" required>
								<label class="form-check-label">Saya Menyetujui <a href="https://www.authenticity.id/privacy">Personal Information Processor Privacy</a></label>
							</div>
						</div>
					</div>
				</div>

			</div>
			<div class="step-wizard__page">
				<div class="form-group">
					<label for="ktp">ID Number <span class="text-danger">*</span></label>
					<input type="tel" class="form-control" required maxlength="16" placeholder="KTP / SIM / Passport Number here" name="nik" autocomplete="off" value="<?php echo $reg_nik; ?>" id="ktp">
				</div>
				<div class="row">
					<div class="col-md-12">
						<label for="confirmAge">Birth date for age confirmation <span class="text-danger">*</span></label>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<select class='form-control' id="date" name="tgl_lahir" required>
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
					<div class="col-md-5">
						<div class="form-group">
							<select class='form-control' id="month" name="bulan_lahir" required>
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
					<div class="col-md-4">
						<div class="form-group">
							<select class='form-control' id="year" name="tahun_lahir" required>
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
						<label for="confirmAge"><span class="text-danger">*</span> This website and its membership only for people above 18 years old</label>
					</div>

				</div>
				<div class="form-group">
					<div class='row'>
						<div class='col-sm-6'>
							<label>Province</label>
							<select class='form-control rokok' name='id_provinsi' id="id_provinsi" required>
								<option value=''>--</option>
								<?php
								if (isset($provinsi) && count($provinsi) > 0) {
									foreach ($provinsi as $row) {
										$selected_provinsi = ($reg_provinsi == $row['provinsi'] ? ' selected' : '');
										echo "<option value='$row[provinsi]' ".$selected_provinsi.">$row[provinsi]</option>";
									}
								}
								?>
							</select>
						</div>
						<div class='col-sm-6'>
							<label>City</label>
							<select class='form-control kota' name='id_kota' id="id_kota" required>
								<option value=''>--</option>
							</select>
						</div>

					</div>
				</div>
			</div>
			<div class="step-wizard__page">
				<div class="form-group">
					<label for="passwordSignup">Password</label>
					<input type="password" class="form-control " required maxlength="50" placeholder="Entry Your Password" autocomplete="off" name="password" id="passwordSignup" readonly onfocus="this.removeAttribute('readonly');">
					<span toggle="#passwordSignup" class="fa fa-fw fa-eye field-icon toggle-password-signup"></span>
				</div>
				<div class="form-group">
					<label for="passwordSignupConfirm">Confirm Password</label>
					<input type="password" class="form-control " required maxlength="50" placeholder="Re-entry Your Password" autocomplete="off" name="confirmpassword" id="passwordSignupConfirm" readonly onfocus="this.removeAttribute('readonly');">
					<span toggle="#passwordSignupConfirm" class="fa fa-fw fa-eye field-icon toggle-passwordconfirm-signup"></span>
				</div>
				<div class="form-group">
					<label for="password">Instagram Account</label>
					<input type="text" class="form-control " required maxlength="50" placeholder="@youraccount" autocomplete="off" name="instagram" value="<?php echo $reg_instagram; ?>">
					<label for="register-message">* By submitting your data to Authenticity, you are willing to receive our updates and promotions via email</label>
				</div>
			</div>
		</div>
		<div class="step-wizard__action">
			<button type="button" class="prev-button btn btn-outline-primary btn-sm">BACK</button>
			<button type="button" class="next-button btn btn-primary btn-sm">NEXT</button>
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
		let allowSubmit = false;

		const redVal = document.getElementById("red-val");
		if(redVal.value=='register'){
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
			emailInput.value = '';
			passwordInput.value = '';
			confirmPasswordInput.value = '';

			// Hide smoker div by default
			smokerDiv.style.display = "none";
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
		updateStep(currentStep);

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

			if (step === 0) {
				document.querySelector(".prev-button").style.display = "none";
				document.querySelector(".submit-button").style.display = "none";
			} else {
				document.querySelector(".prev-button").style.display = "block";
			}

			if (step === steps.length - 1) {
				document.querySelector(".next-button").style.display = "none";
				document.querySelector(".submit-button").style.display = "block";
			} else {
				document.querySelector(".next-button").style.display = "block";
				document.querySelector(".submit-button").style.display = "none";
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

		document.querySelector(".next-button").addEventListener("click", function() {
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

		document.querySelector(".prev-button").addEventListener("click", function() {
			currentStep--;
			updateStep(currentStep);
		});

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
			input.type = input.type === "password" ? "text" : "password";
		}

		// Event listener for password toggle button
		togglePasswordButtonSignUp.addEventListener("click", function() {
			togglePasswordVisibilitySignup(passwordInput);
		});
		// Event listener for password-confirm toggle button
		togglePasswordConfirmButtonSignUp.addEventListener("click", function() {
			togglePasswordVisibilitySignup(confirmPasswordInput);
		});

		// Event listener for rokok select change
		selectrokok.addEventListener("change", function(){
			const rokok = selectrokok.value;
			if( rokok == 'Lainnya' ){
				rokoklain.style.display = 'block';
			}else{
				rokoklain.style.display = 'none';
			}
		});

		// Event listener for smoker radio buttons
		smokerDiv.style.display = "none";
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
		confirmPasswordInput.addEventListener("keyup", function(e) {
			const pass = passwordInput.value;
			const confpass = confirmPasswordInput.value;
			if (pass === confpass) {
				// lblStatusSignup.innerHTML = '';
				lblStatusSignup.innerHTML = "<div class='alert alert-success'>Password is match</div>";
				allowSubmit = true;
			} else {
				lblStatusSignup.innerHTML = "<div class='alert alert-danger'>Password not matching</div>";
				allowSubmit = false;

				setTimeout(function() {
					lblStatusSignup.innerHTML = ''; // Remove the content
				}, 3000);
			}
		});


		// Event listener for province select change
		idProvinsi.addEventListener("change", function() {
			const prov = idProvinsi.value;
			const dataform = new FormData();
			dataform.append('<?php echo $this->security->get_csrf_token_name(); ?>', '<?php echo $this->security->get_csrf_hash(); ?>');
			dataform.append('id', prov);
			dataform.append('search', prov);

			fetch('<?= base_url() ?>home/combocity', {
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
						const ids = item.id_kota;
						const kotas = item.kota;
						idKota.innerHTML += `<option value="${ids}">${kotas}</option>`;
					});
				})
				.catch((error) => {
					overlayAll.style.display = "none";
					console.error(error);
					alert('Failed..!!');
				});
		});
	});


</script>