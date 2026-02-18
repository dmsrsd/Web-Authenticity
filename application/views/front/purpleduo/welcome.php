<div class="container-fluid">
    <div class="row p-2">
        <div class="col-12 col-lg-6 left-cont"><img src="<?php echo base_url('stat/purpleduo/preview/images/title_head_xs.png') ?>" class="logo_main"></div>
        <div class="col-12 col-lg-6 right-cont"><img src="<?php echo base_url('stat/purpleduo/preview/images/logo_pd.png') ?>" class="logo_pd_main"></div>
    </div>
</div>
<div class="container t-black">
    <form action="<?php echo base_url('kirim-purple-duo') ?>" role="form" method="post"  data-parsley-validate autocomplete="off">
    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
	<!---Form starting----> 
    <div class="row outer">
        <!--- For Name---->
        <div class="frame-regis">
        <div class="col-lg-12 p-1">
            <div class="row m-2">
                <div class="col-12 col-lg-3">
                    <label class="firstname">Nama :</label> </div>
                    <div class="col-12 col-lg-9 frame-input">
                        <input type="text" name="fullname" id="fullname" value="<?php echo $member['fullname']; ?>" class="form-control">
                    </div>
                </div>
        </div>        
        
        <div class="col-lg-12 p-1">
            <div class="row m-2">
                <div class="col-12 col-lg-3">
                    <label class="lastname">Usia :</label></div>
                <div class ="col-12 col-lg-9 frame-input">
                    <div class="row">
                        <div class="col-8 col-lg-8">
                            <input type="text" name="age" id="age" value="<?php echo $member['age']; ?>" class="form-control last">
                        </div>
                        <div class="col-4 col-lg-4" style="color: #000;">Tahun</div>
                    </div> 
                </div>
            </div>
        </div>
        <!-----For domisili---->
        <div class="col-lg-12 p-1">
            <div class="row m-2">
                <div class="col-12 col-lg-3" style="margin-left: -4px;">
                    <label class="domisili" >Domisili :</label></div>
                <div class="col-12 col-lg-9 frame-input">
                    <div class="row">
                        <div class="col-8 col-lg-8">
                            <select class='form-control' name='id_provinsi' id="id_provinsi">
                                <option value=''>--</option>
                                <?php
                                if (isset($provinsi) && count($provinsi) > 0) {
                                    foreach ($provinsi as $row) {
                                        if ($row['provinsi'] != "-") {
                                            echo "<option ".(($prov_selected['provinsi']==$row['provinsi']) ? 'selected' : '')." value='$row[provinsi]'>$row[provinsi]</option>";
                                        }
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-4 col-lg-4" style="color: #000;">Provinsi</div>
                    </div> 
                    
                </div>
            </div>
        </div>
        <div class="col-lg-12 p-1">
            <div class="row m-2">
                <div class="col-12 col-lg-3"></div>
                <div class="col-lg-9 frame-input">
                    <div class="row">
                        <div class="col-8 col-lg-8">
                            <select class='form-control' name='id_kota' id="id_kota">
                                <?php
                                    if ($prov_selected) {
                                        echo "<option value='$prov_selected[id_kota]'>$prov_selected[kota]</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-4 col-lg-4" style="color: #000;">Kota</div>
                    </div> 
                    
                </div>
            </div>
            
        </div>
    
        <!-----------submit-------->
        
        <div class="col-sm-12 text-center bt-pos mt-5">
            
            <input type="submit" class="btn btn-warning" value="Submit">
        </div>
        </div>
    </div>	 
    </form> 
</div>

<!-- kusus soundroom -->
<script src="<?php echo base_url('assets/front/js/jquery.js') ?>" type="text/javascript"></script>
<script>
	$(document).on('ready', function() {
		$('#id_provinsi').change(function() {
			var prov = $(this).val();
			var dataform = new FormData();
			dataform.append('<?php echo $this->security->get_csrf_token_name(); ?>', '<?php echo $this->security->get_csrf_hash(); ?>');
			dataform.append('id', prov);
			dataform.append('search', prov);
			$.ajax({
				url: '<?= base_url() ?>home/combocity',
				type: "POST",
				dataType: "json",
				contentType: false,
				processData: false,
				data: dataform,
				beforeSend: function() {
					$('.overlay-all').show();
				},
				error: function() {
					$('.overlay-all').hide();
					alert('Failed..!!');
				},
				success: function(e) {
					$('.overlay-all').hide();
					$('#id_kota option').remove();
					$('#id_kota').append($("<option></option>").attr("value", "").text("--"));
					var dats = e.data;
					$.each(dats, function(i, item) {
						var ids = item.id_kota;
						var kotas = item.kota;
						$('#id_kota').append($("<option></option>").attr("value", ids).text(kotas));
					});
				}
			});

		});
	});
</script>