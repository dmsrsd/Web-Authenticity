<?php
	$red = "";
	if(isset($_GET['req'])){
		if($_GET['req']!=""){
			$red = "?req=".$_GET['req'];
		}
	}
?>

<link href="<?=base_url()?>assets/selectize/selectize.default.css" rel="stylesheet" />
<br>

<center style="margin-top: 69px;">
<h3><a href="<?=base_url()?>podcast/naik-kelas" style="text-decoration:underline;">
				<img src="<?=base_url()?>uploads/live-login.jpg" width=100% />

				</a></h3>
				</center>


<div class='min-height'>
	<div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default box-login-1" style="box-shadow: 0 0 8px #e2e2e2;">
                    <div class="panel-body">
                        <div class="text-center">
                          <img class="login-log" src="<?=base_url()?>assets/front/img/sticky.png">
                        </div>
                        <div class="new-color">REGISTER</div>
                        <img class="shadow-log" src="<?=base_url()?>assets/front/img/shadow.png">
                        <form role="form" id="frmRegister" action="<?=base_url();?>login/submitregister<?=$red;?>"  method="post" data-parsley-validate  autocomplete="off">
							<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
							<input type="hidden" name="se" value="<?=$se;?>" style="display: none">
							<?php $response = $this->session->flashdata('response'); if(isset($response["status"]) && $response["status"] == "error"): ?>
								<div class="alert alert-danger" style='padding:10px;'>
									<?=$response["message"]?>
								</div>
							<?php endif; ?>

                            <div id="lblStatusLogin">

							</div>
                            <div class="form-group">
                                <label for="fullname">Fullname</label>
                                <input type="text" class="form-control " required maxlength="100" placeholder="Entry Your Fullname" name="fullname" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="email">Email </label>
                                <input type="email" class="form-control " required maxlength="50"  placeholder="ex: your@gmail.com" name="email" id="email" autocomplete="off" >
								<em style='color:red;'>* Verifikasi akun akan dikirimkan melalui email. Pastikan email Anda aktif!</em><br>
								<em style='color:red;'>* Pastikan Anda menggunakan email gmail, bukan yang lain agar dapat dilakukan verifikasi</em>
                            </div>
                            <div class="form-group">
								<div class='row'>
									<div class='col-sm-6'>
										<label for="email">Gender</label>
										<select class='form-control' name='gender' required>
											<option value=''>--</option>
											<option value='male'>Male</option>
											<option value='female'>Female</option>
										</select>
									</div>
									<div class='col-sm-6'>
										<label for="fullname">Handphone</label>
										<input type="text" data-country="ID" class="form-control bfh-phone"  data-format="+62 (ddd) ddd-dddd" required maxlength="13" placeholder="081234567891" name="hp" id="hp" autocomplete="off">
									</div>
									<!--<div class='col-sm-6'>
										<label for="fullname">Date Of Birth</label>
										<div class='row'>
											<div class='col-sm-12 cbodob'>
											<input type="text" class="form-control datecombo" data-format="DD-MM-YYYY" data-template="D MMM YYYY"  value=""  name="dob">
											</div>
										</div>
									</div>									-->
								</div>
                            </div>
                            <!--<div class="form-group">
								<div class='row'>
									<div class='col-sm-6'>
										<label for="fullname">Handphone</label>
										<input type="text" data-country="ID" class="form-control bfh-phone"  data-format="+62 (ddd) ddd-dddd" required maxlength="12" placeholder="081234567891" name="hp" id="hp" autocomplete="off">
									</div>

								</div>
                            </div>-->
                            <div class="form-group">
								<div class='row'>
									<div class='col-sm-6'>
										<label for="fullname">Smoker ? </label>
										<label><input type='radio' name='issmoke' value='1' class='smoker'> Yes</label>
										<label><input type='radio' name='issmoke' value='0' class='smoker' checked='checked'> No</label>
									</div>
								</div>
                            </div>
                            <div class="form-group" id='smokerdiv'>
								<div class='row'>
									<div class='col-sm-6'>
										<select class='form-control rokok' name='rokok'>
											<option value=''>-Choose your cigarette-</option>
											<option value='Clas Mild'>Clas Mild</option>
											<option value='A Mild'>A Mild</option>
											<option value='Dunhill Mild'>Dunhill Mild</option>
											<option value='Gudang Garam Surya'>Gudang Garam Surya</option>
											<option value='Sampoerna Ultra Mild'>Sampoerna Ultra Mild</option>
											<option value='LA Lights'>LA Lights</option>
											<option value='LA Bold'>LA Bold</option>
											<option value='Esse'>Esse</option>
											<option value='Marlboro'>Marlboro</option>
											<option value='Magnum Mild'>Magnum Mild</option>
											<option value='Lainnya'>Lainnya</option>


											<!-- <option value='Clas Mild Silver'>Clas Mild Silver</option>
											<option value='Clas Mild'>Clas Mild</option>
											<option value='Marlboro'>Marlboro</option>
											<option value='Sampoerna'>Sampoerna</option>
											<option value='LA'>LA</option>
											<option value='A Mild'>A Mild</option>
											<option value='Dunhil Mild'>Dunhil Mild</option>
											<option value='LA Bold'>LA Bold</option>
											<option value='GG Surya'>GG Surya</option>
											<option value='U Mild'>U Mild</option>
											<option value='Magnum Mild'>Magnum Mild</option>
											<option value='Others'>Others</option> -->
										</select>
									</div>
								</div>
                            </div>
                            <!--<div class="form-group">
								<div class='row'>
									<div class='col-sm-12'>
										<label for="fullname">How do you get this information</label>
										<select class='form-control rokok' name='dari' required>
											<option value=''>-From-</option>
											<option value='Social Media'>Social Media</option>
											<option value='Others'>Event</option>
											<option value='SPG'>SPG</option>
											<option value='Komunitas'>Komunitas</option>
											<option value='Personal'>Personal Referal</option>
										</select>
									</div>
								</div>
                            </div>-->
							<div class="form-group">
                                <label for="ktp">Nomor KTP <span class="text-danger">*</span></label>
                                <input type="tel" class="form-control " required maxlength="16" minlength="16" placeholder="Tulis nomor KTP di sini" name="nik" autocomplete="off">
                            </div>
							<div class="row">
								<div class="col-md-12">
									<label for="confirmAge">Konfirmasi Usia Dengan Nomor KTP <span class="text-danger">*</span></label>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<select class='form-control'  id="date" name="tgl_lahir"  required>
											<option value=''>Tanggal</option>
											<?php
												for ($i= 1; $i <= 31; $i++) {
											?>
												<option value='<?= $i ?>'><?= $i ?></option>
											<?php
												}
											?>

										</select>
									</div>
								</div>
								<div class="col-md-5">
									<div class="form-group">
										<select class='form-control' id="month" name="bulan_lahir"  required>
											<option value=''>Bulan</option>
											<?php
												$selected_month = date('m'); //current month
												// replace and add new months list
												$months_name = ["Januari", "Februari", "Maret", "April", "Mungkin", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];


												for ($i_month = 1; $i_month <= 12; $i_month++) {
													// $selected = ($selected_month == $i_month ? ' selected' : '');
													$selected = '';
													echo '<option value="'.$i_month.'"'.$selected.'>'. $months_name[$i_month-1].'</option>'."\n";
												}

											?>
										</select>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<select class='form-control' id="year" name="tahun_lahir" required>
											<option value=''>Tahun</option>
											<?php
												$max_age = 70;
												$min_age = 17;
												$current_date = date('Y');
												$max_year = $current_date - $min_age;
												$min_year = $max_year - $max_age;
												for ($i = $min_year; $i <= $max_year; $i++){
													echo '<option value='.$i.'>'. $i .'</option>';
												}

											?>
										</select>
									</div>
								</div>

							</div>
                            <div class="form-group">
								<div class='row'>
									<div class='col-sm-6'>
										<label for="fullname">Province</label>
										<select class='form-control rokok' name='id_provinsi' id="id_provinsi"  required>
											<option value=''>--</option>
											<?php
												if(isset($provinsi) && count($provinsi) > 0){ foreach($provinsi as $row){
													echo "<option value='$row[provinsi]'>$row[provinsi]</option>";
												}}
											?>
										</select>
										<!--<input type="text" required maxlength="2" tabindex='7' name="id_provinsi" id="id_provinsi" autocomplete="off">-->
									</div>
									<div class='col-sm-6'>
										<label for="fullname">City</label>
										<select class='form-control rokok' name='id_kota' id="id_kota"  required>
											<option value=''>--</option>
										</select>
										<!--<input type="text" required maxlength="2" tabindex='7' name="id_provinsi" id="id_provinsi" autocomplete="off">-->
									</div>

								</div>
                            </div>
                            <!--<div class="form-group">
								<div class='row'>
									<div class='col-sm-12'>
										<label for="fullname">City</label>
										<input type="text" required maxlength="2" tabindex='7' name="id_kota" id="id_kota" autocomplete="off">
									</div>

								</div>
                            </div>-->
                            <!--<div class="form-group">
								<div class='row'>
									<div class='col-sm-12'>
										<label for="fullname">Address</label>
										<textarea class="form-control" required  placeholder="Address" name="address" autocomplete="off" style='resize:none;'></textarea>
									</div>

								</div>
                            </div>-->


                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control " required maxlength="50" placeholder="Entry Your Password" autocomplete="off" name="password" id="password"  readonly onfocus="this.removeAttribute('readonly');" >
								<span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                            </div>
                            <div class="form-group">
                                <label for="password">Confirm Password</label>
                                <input type="password" class="form-control " required maxlength="50" placeholder="Entry Your Password" autocomplete="off" name="confirmpassword" id="confirmpassword"  readonly onfocus="this.removeAttribute('readonly');" >
								<span toggle="#confirmpassword" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                            </div>
                            <div class="btn-log1">
								<button type="submit" id="btnRegister" class="btn btn-find hauto2" >
									Submit
								</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('front/podcast/footerfp');?>
<script type="text/javascript" src="<?=base_url()?>assets/selectize/selectize.js"></script>
<script src="<?php echo base_url()?>assets/front/js/moment.js"></script>
<script src="<?php echo base_url()?>assets/front/js/combodate.js"></script>
<script>
	<?php
	if($sestatus=="1"){
	?>
	if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent)
		|| /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))) {

	}else{
		//alert('Buka di hp untuk dapatkan point scan special edition!');
		//location.href='<?=base_url()?>login';
	}
	<?php }?>
	$(function(){
		$('.datecombo').combodate();
	});
	function setInputFilter(textbox, inputFilter) {
	  ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
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
	setInputFilter(document.getElementById("hp"), function(value) {
		return /^\d*\.?\d*$/.test(value);
	});

	$(document).on('ready', function() {
		$('#email').val('');
		$('#password').val('');
		$('#confirmpassword').val('');
		$('.cbodob select').attr('required','required');
		$('.cbodob select').removeAttr('style');
		$(".toggle-password").click(function() {

			$(this).toggleClass("fa-eye fa-eye-slash");
			var input = $($(this).attr("toggle"));
			if (input.attr("type") == "password") {
			input.attr("type", "text");
			} else {
			input.attr("type", "password");
			}
		});

		$("#smokerdiv").hide();

		$('.smoker').click(function(){
			var val = $(this).val();
			if(val=="1"){
				$(".rokok").attr("required","required");
				$("#smokerdiv").show();
			}else{
				$(".rokok").removeAttr("required");
				$("#smokerdiv").hide();
			}
		});

		var date = new Date("2013-07-15");
		var currentMonth = date.getMonth();
		var currentDate = date.getDate();
		var currentYear = date.getFullYear();
		$(".datepickerdob").datepicker({
			inline: true,
			dateFormat: "yy-mm-dd",
			defaultDate:new Date(currentYear, currentMonth, currentDate),
			maxDate: new Date(currentYear, currentMonth, currentDate)
		});

		var allowsubmit = false;
		$('#confirmpassword').keyup(function(e){
			var pass = $('#password').val();
			var confpass = $(this).val();
			if(pass == confpass){
				$('#lblStatusLogin').html('');
				allowsubmit = true;
			}else{
				$('#lblStatusLogin').html("<div class='alert alert-danger'>Password not matching</div>");
				allowsubmit = false;
			}
		});
		$("#frmRegister").submit(function (eve) {

			var pass = $('#password').val();
			var confpass = $('#confirmpassword').val();
			if(pass == confpass){
				allowsubmit = true;
			}else{
				$('#lblStatusLogin').html("<div class='alert alert-danger'>Password not matching</div>");
				allowsubmit = false;
			}
			if($('.cbodob select.day').attr('style')=="border-color: red;"){
				allowsubmit = false;
				$('#lblStatusLogin').html("<div class='alert alert-danger'>Please Check Date of Birth</div>");
			}
			if($('.cbodob select.month').attr('style')=="border-color: red;"){
				allowsubmit = false;
				$('#lblStatusLogin').html("<div class='alert alert-danger'>Please Check Date of Birth</div>");
			}
			if($('.cbodob select.year').attr('style')=="border-color: red;"){
				allowsubmit = false;
				$('#lblStatusLogin').html("<div class='alert alert-danger'>Please Check Date of Birth</div>");
			}
			if (allowsubmit) {
				$('.overlay-all').show();
				$('#btnRegister').prop("disabled", true);
				$('#lblStatusLogin').html("");

				var dataform = new FormData();
				var inputtxt = $('#frmRegister').serializeArray();
				for (var i = 0; i < inputtxt.length; i++) {
					dataform.append(inputtxt[i]["name"], inputtxt[i]["value"]);
				}
				dataform.append('<?php echo $this->security->get_csrf_token_name(); ?>', '<?php echo $this->security->get_csrf_hash(); ?>');
				dataform.append('from_referal', '<?php echo @$_GET['req']; ?>');
				/*$.ajax({
					type: "POST",
					data: dataform,
					dataType: "json",
					contentType: false,
					processData: false,
					url: "<?php echo base_url();?>login/submitregister",
					beforeSend: function () {
						$('.overlay-all').show();
						$('#btnRegister').prop("disabled", true);
						$('#lblStatusLogin').html("");
					},
					success: function (e) {
						$('.overlay-all').hide();
						$('#btnRegister').prop("disabled", false);
						$('html, body').animate({ scrollTop: 50 }, 'slow');
						if(e.status=="true"){
							$('#lblStatusLogin').html("<div class='alert alert-success'>"+e.message+"</div>");
							document.getElementById("frmRegister").reset();
							location.href='<?=base_url()?>register-thanks';
						}else{
							$('#lblStatusLogin').html("<div class='alert alert-danger'>"+e.message+"</div>");
						}
					},
					error: function () {
						$('.overlay-all').hide();
						$('#btnRegister').prop("disabled", false);
						$('#lblStatusLogin').html("<div class='alert alert-danger'>EMAIL TIDAK VALID!!!</div>");
					}
				});
				*/
				return true;
			}else{
				$('.overlay-all').hide();
				eve.preventDefault();
				$('html, body').animate({ scrollTop: 50 }, 'slow');
				return false;
			}
		});
		$('#id_provinsi').change(function(){
			var prov = $(this).val();
			var dataform = new FormData();
			dataform.append('<?php echo $this->security->get_csrf_token_name(); ?>', '<?php echo $this->security->get_csrf_hash(); ?>');
			dataform.append('id', prov);
			dataform.append('search', prov);
			$.ajax({
				url: '<?=base_url()?>home/combocity',
				type: "POST",
				dataType: "json",
				contentType: false,
				processData: false,
				data: dataform,
				beforeSend: function () {
					$('.overlay-all').show();
				},
				error: function () {
					$('.overlay-all').hide();
					alert('Failed..!!');
				},
				success: function (e) {
					$('.overlay-all').hide();
					$('#id_kota option').remove();
					$('#id_kota').append($("<option></option>").attr("value","").text("--"));
					var dats = e.data;
					$.each(dats, function(i, item) {
						var ids = item.id_kota;
						var kotas = item.kota;
						$('#id_kota').append($("<option></option>").attr("value",ids).text(kotas));
					});
				}
			});

		});
		/*
		$('#id_provinsi').selectize({
			maxItems: 1,
			create: false,
			valueField: 'provinsi',
			labelField: 'provinsi',
			searchField: ['provinsi'],
			render: {
				option: function (item, escape) {
					return '<div>' +
						'<span class="title">' +
							'<span class="by">' + escape(item.provinsi) + '</span>' +
						'</span>' +
					'</div>';
				}
			},
			load: function (query, callback) {
				var dtPost = {};
				dtPost.search = encodeURIComponent(query);
				dtPost.<?php echo $this->security->get_csrf_token_name(); ?> = "<?php echo $this->security->get_csrf_hash(); ?>";
				dtPost.id = "";
				var dataform = new FormData();
				dataform.append('id', "");
				dataform.append('search', encodeURIComponent(query));
				dataform.append('<?php echo $this->security->get_csrf_token_name(); ?>', '<?php echo $this->security->get_csrf_hash(); ?>');

				$.ajax({
					url: '<?=base_url()?>home/comboprovince',
					type: "POST",
					dataType: "json",
					contentType: false,
					processData: false,
					data: dataform,
					error: function () {
						callback();
					},
					success: function (res) {
						callback(res.data);
						var $select = $('#id_kota').selectize();
						var control = $select[0].selectize;
						control.clear();
						control.clearOptions();
						control.renderCache['option'] = {};
						control.renderCache['item'] = {};
					}
				});
			},
			onChange: function (value) {
				var prov = value;
				var $select = $('#id_kota').selectize();
				var control = $select[0].selectize;
				control.clear();
				control.clearOptions();
				control.renderCache['option'] = {};
				control.renderCache['item'] = {};
			}
		});


		$('#id_kota').selectize({
			maxItems: 1,
			create: false,
			valueField: 'id_kota',
			labelField: 'kota',
			searchField: ['kota'],
			render: {
				option: function (item, escape) {
					return '<div>' +
						'<span class="title">' +
							'<span class="by">' + escape(item.kota) + '</span>' +
						'</span>' +
					'</div>';
				}
			},
			load: function (query, callback) {
				var dtPost = {};
				dtPost.search = encodeURIComponent(query);
				dtPost.<?php echo $this->security->get_csrf_token_name(); ?> = "<?php echo $this->security->get_csrf_hash(); ?>";
				dtPost.id = $('#id_provinsi').val();
				var dataform = new FormData();
				dataform.append('id', $('#id_provinsi').val());
				dataform.append('search', encodeURIComponent(query));
				dataform.append('<?php echo $this->security->get_csrf_token_name(); ?>', '<?php echo $this->security->get_csrf_hash(); ?>');

				$.ajax({
					url: '<?=base_url()?>home/combocity',
					type: "POST",
					dataType: "json",
					contentType: false,
					processData: false,
					data: dataform,
					error: function () {
						callback();
					},
					success: function (res) {
						callback(res.data);
					}
				});
			}
		});
		*/
	});
</script>
