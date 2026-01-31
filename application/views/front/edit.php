<link href="<?=base_url()?>assets/selectize/selectize.default.css" rel="stylesheet" />
<link href="<?php echo base_url()?>assets/front/croppie/croppie.css" rel="stylesheet" />
<link href="<?php echo base_url()?>assets/front/croppie/demo.css" rel="stylesheet" />
<br><br><br>
<div class='min-height'>
	<div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default box-login-1" style="box-shadow: 0 0 8px #e2e2e2;">
                    <div class="panel-body">
                        <div class="text-center">
                          <img class="login-log" src="<?=base_url()?>assets/front/img/sticky.png">
                        </div>
                        <div class="new-color">Edit Profile</div>
                        <img class="shadow-log" src="<?=base_url()?>assets/front/img/shadow.png">
                        <form role="form" id="frmRegister"  method="post" data-parsley-validate action="<?=base_url();?>profile/submitedit" autocomplete="off"   enctype="multipart/form-data">
							<input type="hidden" id='hash' name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
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
                            <div id="lblStatusLogin">
							</div>
							<?php
							if($member['pp']!=""){
								$req = "";
								if(!file_exists("uploads/pp/".$member['pp'])){
									$img = base_url()."uploads/nopp.png";
									$req = "required";
								}else{
									$img = base_url()."uploads/pp/$member[pp]";
								}
							}else{
								$req = "required";
								$img = base_url()."uploads/nopp.png";
							}
							?>
                            <div class="form-group">
								<div class='insec-culator'>
									<div class='row'>
										<div class='col-sm-6 col-sm-offset-3' align='center'>
											<a href='javascript:void(0);' class='btn btn-md btn-primary' style='width:70%;padding:10px;' id='choose'>Unggah Foto <i class='fa fa-camera'></i></a>
										</div>
									</div>
									<div class='row'>
										<div align='center' class='imgprev'>
											<div class="demo-wrap upload-demo">
												<div class="upload-demo-wrap" >
													<div id="upload-demo"></div>
												</div>
												<div class="form-group">
													<div class="form-group">
														<div class="actions-crop" style="display:none; margin-bottom:15px;" >
															<a class="upload-result  btn btn-success" href="javascript:;">Crop</a>
														</div>
													</div>
												</div>
											</div>
											<label class="hide">Photo</label>
											<input type='file' id="imgInp"  class="form-control" style='display:none;' />
											<input type='hidden' id="hasilnya" name='pp' />
											<img src='<?=$img;?>' style='width:280px;' class='img-responsive img-circle' id='hasilimage'>
										</div>
									</div>
								</div>
							</div>
                            <div class="form-group">
                                <label for="fullname">Fullname</label>
                                <input type="text" class="form-control " required maxlength="100" placeholder="Entry Your Fullname" name="fullname" autocomplete="off" value='<?=$member['fullname'];?>'>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control " required maxlength="50"  placeholder="your@mail.com" name="emailx" autocomplete="off" readonly   value='<?=$member['email'];?>'>
                            </div>
                            <div class="form-group">
								<div class='row'>
									<div class='col-sm-6'>
										<label for="email">Gender</label>
										<select class='form-control' name='gender' required>
											<option value=''>--</option>
											<?php
											$g = array("male","female");
											foreach($g as $k){
												$s="";
												if($k==$member['gender']){
													$s = "selected";
												}
												echo "<option value='$k' $s>".ucwords($k)."</option>";
											}
											?>
										</select>
									</div>
									<div class='col-sm-6'>
										<label for="fullname">Date Of Birth</label>
										<div class='row'>
											<div class='col-sm-12 cbodob'>
											<input type="text" class="form-control datecombo" data-format="DD-MM-YYYY" data-template="D MMM YYYY"  value='<?=$dob;?>'  name="dob">
											</div>
										</div>
									</div>
								</div>
                            </div>
                            <div class="form-group">
								<div class='row'>
									<div class='col-sm-6'>
										<label for="fullname">Handphone</label>
										<input type="text"  value='<?=$member['hp'];?>' data-country="ID" class="form-control bfh-phone"  data-format="+62 (ddd) ddd-dddd" required maxlength="12" placeholder="081234567891" name="hp" id="hp" autocomplete="off">
									</div>

								</div>
                            </div>
                            <div class="form-group">
								<div class='row'>
									<div class='col-sm-6'>
										<label for="fullname">Smoker ? </label>
										<label><input type='radio' name='issmoke' value='1' class='smoker smokeyes'> Yes</label>
										<label><input type='radio' name='issmoke' value='0' class='smoker smokeno'> No</label>
									</div>
								</div>
                            </div>
                            <div class="form-group" id='smokerdiv'>
								<div class='row'>
									<div class='col-sm-6'>
										<select class='form-control rokok' id='rokoknya' name='rokok'>
											<option value=''>-Choose your cigarette-</option>
											<option value='Clasmild'>Clasmild</option>
											<option value='Marlboro'>Marlboro</option>
											<option value='Sampoerna'>Sampoerna</option>
											<option value='LA'>LA</option>
											<option value='A Mild'>A Mild</option>
											<option value='Dunhil Mild'>Dunhil Mild</option>
											<option value='LA Bold'>LA Bold</option>
											<option value='GG Surya'>GG Surya</option>
											<option value='U Mild'>U Mild</option>
											<option value='Magnum Mild'>Magnum Mild</option>
											<option value='Others'>Others</option>
										</select>
									</div>
								</div>
                            </div>
                            <div class="form-group">
								<div class='row'>
									<div class='col-sm-12'>
										<label for="fullname">How do you get this information</label>
										<select class='form-control rokok' id='darinya' name='dari' required>
											<option value=''>-From-</option>
											<option value='Social Media'>Social Media</option>
											<option value='Event'>Event</option>
											<option value='SPG'>SPG</option>
											<option value='Komunitas'>Komunitas</option>
											<option value='Personal'>Personal Referal</option>
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
                            <div class="form-group">
								<div class='row'>
									<div class='col-sm-12'>
										<label for="fullname">Address</label>
										<textarea class="form-control" required  placeholder="Address" name="address" autocomplete="off" style='resize:none;'><?=$member['address'];?></textarea>
									</div>

								</div>
                            </div>


							<hr>
							<em>Kosongkan bila tidak ingin merubah password.</em>
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
<script src="<?php echo base_url()?>assets/front/croppie/croppie.js"  type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/front/js/html2canvas.js"></script>
<script src="<?php echo base_url()?>assets/front/croppie/crop.js?v=<?=rand()?>"  type="text/javascript"></script>
<script>
	Demo.init();
	document.getElementById('choose').onclick = function() {
		document.getElementById('imgInp').click();
	};


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



		var perokok = <?=$member['issmoke'];?>;
		var provinsi = <?=$member['id_kota'];?>;
		$("#smokerdiv").hide();
		if(perokok==1){
			$("input[name=issmoke][value=" + 1 + "]").attr('checked', 'checked');
			$("#smokerdiv").show();

		}else{
			$("input[name=issmoke][value=" + 0 + "]").attr('checked', 'checked');
			$("#smokerdiv").hide();
		}
		<?php if($member['id_kota']!=''){?>
		if(provinsi!=''){
			$('#id_provinsi').val('<?=$kota['provinsi'];?>');
			var prov = '<?=$kota['provinsi'];?>';
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
					$('#id_kota').val('<?=$kota['id_kota'];?>');
				}
			});

		}
		<?php }?>
		//alert(perokok);
		$('#rokoknya').val('<?=$member['rokok'];?>');
		$('#darinya').val('<?=$member['dari'];?>');

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
			eve.preventDefault();
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
				var dataform = new FormData();
				var inputtxt = $('#frmRegister').serializeArray();
				for (var i = 0; i < inputtxt.length; i++) {
					dataform.append(inputtxt[i]["name"], inputtxt[i]["value"]);
				}
				dataform.append('<?php echo $this->security->get_csrf_token_name(); ?>', '<?php echo $this->security->get_csrf_hash(); ?>');
				dataform.append('from_referal', '<?php echo @$_GET['req']; ?>');
				$.ajax({
					type: "POST",
					data: dataform,
					dataType: "json",
					contentType: false,
					processData: false,
					url: "<?php echo base_url();?>profile/submitedit",
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
							//document.getElementById("frmRegister").reset();
							//location.href='<?=base_url()?>register-thanks';
						}else{
							$('#lblStatusLogin').html("<div class='alert alert-danger'>"+e.message+"</div>");
						}
					},
					error: function () {
						$('.overlay-all').hide();
						$('#btnRegister').prop("disabled", false);
						alert('Failed..!!');
					}
				});
			}else{

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
