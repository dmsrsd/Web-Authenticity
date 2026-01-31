

                    </div>
                </div> 
				 
            </div>
        </div>
    </div>
    <script src="<?=base_url()?>assets/webadmin/js/jquery-1.10.2.js"></script>
    <script src="<?=base_url()?>assets/webadmin/js/bootstrap.min.js"></script>
    <script src="<?=base_url()?>assets/webadmin/js/tag.js"></script>
    <script src="<?=base_url()?>assets/webadmin/js/jquery.metisMenu.js"></script>
    <script src="<?=base_url()?>assets/webadmin/js/dataTables/jquery.dataTables.js"></script>
    <script src="<?=base_url()?>assets/webadmin/js/dataTables/dataTables.bootstrap.js"></script>
	<script src="<?=base_url()?>assets/datepicker/js/bootstrap-datepicker.js"></script>
	<script src="<?=base_url()?>assets/webadmin/js/bootstrap-datetimepicker.js"></script>
	<script src="<?=base_url()?>assets/webadmin/js/bootstrap-datetimepickerid.js"></script>
		<!--fancy-->
		<script type="text/javascript" src="<?=base_url()?>assets/fancy/jquery.mousewheel-3.0.6.pack.js"></script>
		<script type="text/javascript" src="<?=base_url()?>assets/fancy/jquery.fancybox.js?v=2.1.5"></script>
		<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/fancy/jquery.fancybox.css?v=2.1.5" media="screen" />
		<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/fancy/helpers/jquery.fancybox-buttons.css?v=1.0.5" />
		<script type="text/javascript" src="<?=base_url()?>assets/fancy/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
		<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/fancy/helpers/jquery.fancybox-thumbs.css?v=1.0.7" />
		<script type="text/javascript" src="<?=base_url()?>assets/fancy/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>
		<script type="text/javascript" src="<?=base_url()?>assets/fancy/helpers/jquery.fancybox-media.js?v=1.0.6"></script>		
		<!--endfancy-->	
	<script type="text/javascript" src="<?=base_url()?>assets/webadmin/tinymce/tinymce.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>assets/webadmin/tinymce/jquery.tinymce.min.js"></script>	
	<script type="text/javascript" src="<?=base_url()?>assets/selectize/selectize.js"></script>	
		
		
        <script>
			function change_top(idnya){
				$.ajax({
					type: "GET",
					url: "<?=base_url()?>cms/logic/set_top/video/"+idnya,
					beforeSend: function () { },
					success: function (e) {
						e = jQuery.parseJSON(e);
						if(e.status_ajx=="false"){
							alert('Gagal merubah data');
						}else{
							location.reload();
						}
					}
				});
			}			
			function change_status(htmlst,statusnya,idnya,pagenya){
				$.ajax({
					type: "GET",
					url: pagenya,
					beforeSend: function () { },
					success: function (e) {
						e = jQuery.parseJSON(e);
						if(e.status_ajx=="false"){
							alert('Gagal merubah data');
						}else{
							$('#'+htmlst).html(e.hasil);
						}
					}
				});
			}			
			function pilih_jawaban(htmlst,statusnya,idnya,pagenya){
				$.ajax({
					type: "GET",
					url: pagenya,
					beforeSend: function () { },
					success: function (e) {
						e = jQuery.parseJSON(e);
						if(e.status_ajx=="false"){
							alert('Gagal merubah data');
						}else{
							$('#'+htmlst).html(e.hasil);
						}
					}
				});
			}
			$(document).on('click', '.del-row', function(e) {
				if (confirm("Hapus ?")) {
					$(this).closest('tr').remove(); 
				} 
			});
			$(document).on('click', '.removeklass', function(e) {
				if (confirm("Hapus ?")) { 
					var jum = eval($('#classjum').val()) - 1;
					$('#classjum').val(jum);
					
					if(eval($('#classjum').val()==jum)){
						$('.removeklass[data-klass="'+jum+'"]').removeClass('hide');
					}
				} 
			});
			$(document).on('click', '.addstorebutton', function(e) {			
			//$('.addklassvalue').click(function(){ 
				var tablenya = "listablerank-0";
				var rcex = $('#'+tablenya+' tbody > tr').length;
				var indrcek = rcex-1;
				$('#'+tablenya+' tr:last').after('\
				<tr>\
					<td><input type="text" name="button2['+indrcek+'][]" class="form-control"  placeholder="Nama"></td>\
					<td><input type="text" name="button2['+indrcek+'][]" class="form-control" required placeholder="Deskripsi"></td>\
					<td><input type="file" name="imaged-'+indrcek+'" class="form-control" required placeholder="Image"><input type="hidden" name="button2['+indrcek+'][]"></td>\
					<td align="center"><a class="btn btn-sm btn-danger del-row" ><i class="fa fa-trash"></i></a></td>\
					</tr>');
			});	 	
			$(document).on('click', '.addklassvalue', function(e) {			
			//$('.addklassvalue').click(function(){ 
				var tablenya = "listablerank-0";
				var rcex = $('#'+tablenya+' tbody > tr').length;
				var indrcek = rcex-1;
				$('#'+tablenya+' tr:last').after('\
				<tr>\
					<td><input type="text" name="product['+indrcek+'][]" class="form-control" required placeholder="Nama"></td>\
					<td><input type="text" name="product['+indrcek+'][]" class="form-control" required placeholder="Deskripsi"></td>\
					<td><input type="file" name="imaged-'+indrcek+'" class="form-control" required placeholder="Image"><input type="hidden" name="product['+indrcek+'][]"></td>\
					<td align="center"><a class="btn btn-sm btn-danger del-row" ><i class="fa fa-trash"></i></a></td>\
					</tr>');
			});	 	
			$(document).on("click",".resend-regis",function() {
				
				var iod = $(this).attr('data-id');
				var dataform = new FormData();
				dataform.append('<?php echo $this->security->get_csrf_token_name(); ?>', '<?php echo $this->security->get_csrf_hash(); ?>'); 
				dataform.append('iod', iod); 
				$.ajax({
					type: "POST",
					data: dataform,
					dataType: "json",
					contentType: false,
					processData: false,
					url: "<?php echo base_url();?>webadmin/dashboard/resendregis",
					beforeSend: function () { 
						$(".resend-regis").prop('disabled', true);
						$(".resend-regis").html('...');
					},
					success: function (e) { 
						if(e.status=="true"){ 				
							alert("Berhasil mengirim ulang verifikasi register");
							
						}else{ 
							alert(e.message);
						}
						$(".resend-regis").html('<i class="fa fa-envelope"></i>');
						$(".resend-regis").prop('disabled', false);
					},
					error: function () {
						alert("Fatal iyeu mah teuing kunaon");
						$(".resend-regis").prop('disabled', false);
					}
				});					
				
			});
			$(document).on("click",".hapus-point",function() {
				var result = confirm("Yakin untuk menghapus point ini?");
				if (result) {
					var iod = $(this).attr('data-id');
					var dataform = new FormData();
					dataform.append('<?php echo $this->security->get_csrf_token_name(); ?>', '<?php echo $this->security->get_csrf_hash(); ?>'); 
					dataform.append('iod', iod); 
					$.ajax({
						type: "POST",
						data: dataform,
						dataType: "json",
						contentType: false,
						processData: false,
						url: "<?php echo base_url();?>webadmin/dashboard/hapuspoint",
						beforeSend: function () { 
							$(".hapus-point").prop('disabled', true);
							$(".hapus-point").html('...');
						},
						success: function (e) { 
							if(e.status=="true"){ 				
								alert("Berhasil menghapus point");
								$('.find').click();
							}else{ 
								alert(e.message);
							}
							$(".hapus-point").html('<i class="fa fa-times"></i>');
							$(".hapus-point").prop('disabled', false);
						},
						error: function () {
							alert("Fatal iyeu mah teuing kunaon");
							$(".hapus-point").prop('disabled', false);
						} 
					});
				}				
				
			});
			$(document).on("click",".hapus-redeem",function() { 
				var result = confirm("Yakin untuk menghapus point ini?");
				if (result) {
					var iod = $(this).attr('data-id');
					var dataform = new FormData();
					dataform.append('<?php echo $this->security->get_csrf_token_name(); ?>', '<?php echo $this->security->get_csrf_hash(); ?>'); 
					dataform.append('iod', iod); 
					$.ajax({
						type: "POST",
						data: dataform,
						dataType: "json",
						contentType: false,
						processData: false,
						url: "<?php echo base_url();?>webadmin/dashboard/hapusredeem",
						beforeSend: function () { 
							$(".hapus-redeem").prop('disabled', true);
							$(".hapus-redeem").html('...');
						},
						success: function (e) { 
							if(e.status=="true"){ 				
								alert("Berhasil menghapus redeem");
								$('.find').click();
							}else{ 
								alert(e.message);
							}
							$(".hapus-redeem").html('<i class="fa fa-times"></i>');
							$(".hapus-redeem").prop('disabled', false);
						},
						error: function () {
							alert("Fatal iyeu mah teuing kunaon");
							$(".hapus-redeem").prop('disabled', false);
						}
					});
				}				
				
			});
			$(document).on("click",".resendwaqr",function() {
				var iod = $(this).attr('data-order');
				$('#statusresend').html("");
				var dataform = new FormData();
				dataform.append('<?php echo $this->security->get_csrf_token_name(); ?>', '<?php echo $this->security->get_csrf_hash(); ?>'); 
				dataform.append('iod', iod); 
				$.ajax({
					type: "POST",
					data: dataform,
					dataType: "json",
					contentType: false,
					processData: false,
					url: "<?php echo base_url();?>webadmin/dashboard/orderresendwaqr",
					beforeSend: function () { 
						$(".resendemail").prop('disabled', true);
						$(".resendwatext").prop('disabled', true);
						$(".resendwaqr").prop('disabled', true);
						$('#statusresend').html("<em>Please Wait<em><br>");
					},
					success: function (e) { 
						if(e.status=="true"){ 				
							$('#statusresend').html("<div class='alert alert-success'>Berhasil mengirim ulang  Whatsapp QR</div>");
							
						}else{ 
							alert('WRONG');
							$('#statusresend').html("<div class='alert alert-danger'>Gagal teuing kunaon</div>");
						}
						$(".resendemail").prop('disabled', false);
						$(".resendwatext").prop('disabled', false);
						$(".resendwaqr").prop('disabled', false);
					},
					error: function () {
						$('#statusresend').html("<div class='alert alert-danger'>Fatal iyeu mah teuing kunaon</div>");
						$(".resendemail").prop('disabled', false);
						$(".resendwatext").prop('disabled', false);
						$(".resendwaqr").prop('disabled', false);
					}
				});					
				
			});
			$(document).on("click",".resendwatext",function() {
				var iod = $(this).attr('data-order');
				$('#statusresend').html("");
				var dataform = new FormData();
				dataform.append('<?php echo $this->security->get_csrf_token_name(); ?>', '<?php echo $this->security->get_csrf_hash(); ?>'); 
				dataform.append('iod', iod); 
				$.ajax({
					type: "POST",
					data: dataform,
					dataType: "json",
					contentType: false,
					processData: false,
					url: "<?php echo base_url();?>webadmin/dashboard/orderresendwatext",
					beforeSend: function () { 
						$(".resendemail").prop('disabled', true);
						$(".resendwatext").prop('disabled', true);
						$(".resendwaqr").prop('disabled', true);
						$('#statusresend').html("<em>Please Wait<em><br>");
					},
					success: function (e) { 
						if(e.status=="true"){ 				
							$('#statusresend').html("<div class='alert alert-success'>Berhasil mengirim ulang Whatsapp Text </div>");
							
						}else{  
							$('#statusresend').html("<div class='alert alert-danger'>"+e.message+"</div>");
						}
						$(".resendemail").prop('disabled', false);
						$(".resendwatext").prop('disabled', false);
						$(".resendwaqr").prop('disabled', false);
					},
					error: function () {
						$('#statusresend').html("<div class='alert alert-danger'>Fatal iyeu mah teuing kunaon</div>");
						$(".resendemail").prop('disabled', false);
						$(".resendwatext").prop('disabled', false);
						$(".resendwaqr").prop('disabled', false);
					}
				});					
				
			});
			$(document).on("click",".resendemail",function() {
				var iod = $(this).attr('data-order');
				$('#statusresend').html("");
				var dataform = new FormData();
				dataform.append('<?php echo $this->security->get_csrf_token_name(); ?>', '<?php echo $this->security->get_csrf_hash(); ?>'); 
				dataform.append('iod', iod); 
				$.ajax({
					type: "POST",
					data: dataform,
					dataType: "json",
					contentType: false,
					processData: false,
					url: "<?php echo base_url();?>webadmin/dashboard/orderresendemail",
					beforeSend: function () { 
						$(".resendemail").prop('disabled', true);
						$(".resendwatext").prop('disabled', true);
						$(".resendwaqr").prop('disabled', true);
						$('#statusresend').html("<em>Please Wait<em><br>");
					},
					success: function (e) { 
						if(e.status=="true"){ 				
							$('#statusresend').html("<div class='alert alert-success'>"+e.message+"</div>");
							
						}else{  
							$('#statusresend').html("<div class='alert alert-danger'>"+e.message+"</div>");
						}
						$(".resendemail").prop('disabled', false);
						$(".resendwatext").prop('disabled', false);
						$(".resendwaqr").prop('disabled', false);
					},
					error: function () {
						$('#statusresend').html("<div class='alert alert-danger'>Fatal iyeu mah teuing kunaon</div>");
						$(".resendemail").prop('disabled', false);
						$(".resendwatext").prop('disabled', false);
						$(".resendwaqr").prop('disabled', false);
					}
				});					
				
			});
            $(document).ready(function () {
			<?php
			$now = $this->uri->segment(3);
			?> 

			<?php
			if($now=="historypoint"){
			?> 
				var tabel = null; 
				tabel = $('.dataTableshistorypoint').DataTable({
					"processing": true,
					"serverSide": true,
					"ordering": true, 
					"order": [[ 6, 'desc' ]], 
					"ajax":
					{
						"url": "<?=base_url();?>webadmin/dashboard/historypointajax", 
						"type": "POST",
						"data": function ( d ) {
							d.<?php echo $this->security->get_csrf_token_name(); ?> = "<?php echo $this->security->get_csrf_hash(); ?>";
							// d.custom = $('#myInput').val();
							// etc
							}
						},
					"deferRender": true,
					"aLengthMenu": [[15, 50,100],[ 15, 50,100]], 
					"columns": [ 
						{ "data": "no" },  
						{ "data": "member" },  
						{ "data": "hp" }, 
						{ "data": "email" }, 
						{ "data": "nama_point" }, 
						{ "data": "pts" },  
						{ "data": "created_date" }
					],
				});		
			<?php
			}
			?>				
			<?php
			if($now=="member"){
			?> 
				var tabel = null; 
				tabel = $('.dataTablesmember').DataTable({
					"processing": true,
					"serverSide": true,
					"ordering": true, 
					"order": [[ 1, 'asc' ]], 
					"ajax":
					{
						"url": "<?=base_url();?>webadmin/dashboard/memberajax<?=$n?>", 
						"type": "POST",
						"data": function ( d ) {
							d.<?php echo $this->security->get_csrf_token_name(); ?> = "<?php echo $this->security->get_csrf_hash(); ?>";
							// d.custom = $('#myInput').val();
							// etc
							}
						},
					"deferRender": true,
					"aLengthMenu": [[15, 50,100],[ 15, 50,100]], 
					"columns": [ 
						{ "data": "no" },  
						{ "data": "fullname" },  
						{ "data": "email" }, 
						{ "data": "hp" }, 
						{ "data": "address" }, 
						{ "data": "email" }, 
						{ "data": "last_login" }, 
						{ "data": "created_date" }, 
						{ "data": null, 
						"render": function ( data, type, row ) { 
								var html  = "<a href='javascript:void(0);' class='btn btn-xs btn-success resend-regis' data-id='"+row.id_member+"'><i class='fa fa-envelope'></i></a>";
								return html
							}
						}, 
					],
				});		
			<?php
			}
			?>				
				
				$('.showresend').click(function(){
					var id = $(this).attr('data-order');
					$('#modalresend .modal-body').html("Please wait ...");
					$('#modalresend').modal({backdrop: 'static', keyboard: false});
					var dataform = new FormData();
					dataform.append('<?php echo $this->security->get_csrf_token_name(); ?>', '<?php echo $this->security->get_csrf_hash(); ?>'); 
					dataform.append('iod', id); 
					$.ajax({
						type: "POST",
						data: dataform,
						dataType: "json",
						contentType: false,
						processData: false,
						url: "<?php echo base_url();?>webadmin/dashboard/orderdetil",
						beforeSend: function () { 
						},
						success: function (e) { 
							if(e.status=="true"){ 				
								$('#modalresend .modal-body').html(e.html);
							}else{ 
								alert('WRONG');
								$('#modalresend .modal-body').html("Gagal...");
							}
						},
						error: function () {
							$('#modalresend .modal-body').html("Fatal...");
						}
					});					

				});
				$('#status-youtube').change(function(){
					var isi = $(this).val();
					if(isi!="1"){
						$('#youtube').removeAttr("required");
						$('#url').attr("required","required");
						$('#judul1').attr("required","required");
						$('#judul2').attr("required","required");
						$('#judul3').attr("required","required");
					}else{
						$('#youtube').attr("required","required");
						$('#url').removeAttr("required");
						$('#judul1').removeAttr("required");
						$('#judul2').removeAttr("required");
						$('#judul3').removeAttr("required");
					}
				});
				$('#tags').selectize({
					delimiter: ',',
					persist: false,
					create: function(input) {
						return {
							value: input,
							text: input
						}
					}
				});				
				$('[data-toggle="tooltip"]').tooltip(); 
                $("input[name='review_type']").change(function(){
					var v = $(this).val();
					if(v=="1"){
						var im = $(this).attr('data-image');
						$('#p-image').removeClass('hide');
						$('#p-video').addClass('hide');
						if(im==""){
							$('#review_image').attr('required','required');
						}else{
							$('#review_image').removeAttr('required');
						}
						$('#review_youtube').removeAttr('required');
					}else{
						$('#p-image').addClass('hide');
						$('#p-video').removeClass('hide');
						$('#review_youtube').attr('required','required');
						$('#review_image').removeAttr('required');
						
					}
				});
				
				//$('#tag').tagsinput('add', 'vino');
				//$('#tag').tagsinput('add', 'vino sf');
				$('.dataTables').dataTable({"pageLength" : 15});
                $(".datepicker").datepicker({
                    dateFormat: "yy-mm-dd",
				});
                $(".datepickertime").datetimepicker({format: 'yyyy-mm-dd hh:ii:ss'});
                $(".timepicker").datetimepicker({format: 'hh:ii'});
				$('.fancybox').fancybox({
					width: "80%",
				});			
				$('#tipe-voucher').on('change', function() {
					var pal = this.value; 
					if(pal=="3"){
						$("#value").val("Free Ongkir");
					}
				});				
                $('#create-voucher').click(function(){
					var dataform = new FormData();
					dataform.append('<?php echo $this->security->get_csrf_token_name(); ?>', '<?php echo $this->security->get_csrf_hash(); ?>'); 
					$.ajax({
						type: "POST",
						data: dataform,
						dataType: "json",
						contentType: false,
						processData: false,
						url: "<?php echo base_url();?>cms/logic/genv",
						beforeSend: function () {
							//$('.preloader').show();
						},
						success: function (e) {
							//e = jQuery.parseJSON(e);
							if(e.status=="true"){ 				
								$('#kode').val(e.kode);
							}else{
								//$('.preloader').hide();
								alert('WRONG');
							}
						},
						error: function () {
							alert('WRONG');
						}
					});					
				});
                $('.pilih_icon a').click(function(){
					var icon = $(this).attr('data-icon');
					var target = $(this).attr('data-target');
					$('#'+target).val(icon);
					if($(this).attr('class')=='active'){}else{
						$('.pilih_icon a').attr('class','');
						$(this).attr('class','pilih');
					}
				});
				$('form #judul').keyup(function() {
					slug = $(this).val().toLowerCase().replace(/ +/g, '-').replace('--', '-').replace(/[^a-z0-9\-\.]+/g,'').substring(0, $(this).val().length > 100?100:$(this).val().length);
					$('form #slug').val(slug);
				}); 		
				$('form #judul-ticket').keyup(function() {
					slug = $(this).val().toLowerCase().replace(/ +/g, '-').replace('--', '-').replace(/[^a-z0-9\-\.]+/g,'').substring(0, $(this).val().length > 100?100:$(this).val().length);
					$('form #slug').val(slug); 			
					var gen = "<?=base_url();?>ticket/genqr/" + slug + "/547x547";
					//$('#prev-qr').attr('src',gen); 				
					//$('#prev-qr2').attr('src',gen); 				
					
				}); 
				
				$('form #campaign_name').keyup(function() {
					slug = $(this).val().toLowerCase().replace(/ +/g, '-').replace('--', '-').replace(/[^a-z0-9\-\.]+/g,'').substring(0, $(this).val().length > 100?100:$(this).val().length);
					$('form #slug').val(slug);
				});

				$('form .slugable').keyup(function() {
					slug = $(this).val().toLowerCase().replace(/ +/g, '-').replace('--', '-').replace(/[^a-z0-9\-\.]+/g,'').substring(0, $(this).val().length > 100?100:$(this).val().length);
					$('form #slug').val(slug);
				});

				$('form #nama').keyup(function() {
					slug = $(this).val().toLowerCase().replace(/ +/g, '-').replace('--', '-').replace(/[^a-z0-9\-\.]+/g,'').substring(0, $(this).val().length > 100?100:$(this).val().length);
					$('form #slug').val(slug);
				}); 		
				$('textarea.tinymce-editoradv').tinymce({
					selector: "#resizable",
					plugins: ["advlist autolink lists link image charmap print preview anchor"],
					menubar: false,
					resize: false,
					toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
					extended_valid_elements : "script[src|async|defer|type|charset]"
					/*
					plugins: [
						"advlist autolink lists link image charmap print preview hr anchor pagebreak",
						"searchreplace wordcount visualblocks visualchars code fullscreen",
						"insertdatetime media nonbreaking save table contextmenu directionality",
						"emoticons template paste textcolor filemanager"
					],
					toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
					toolbar2: "print preview media | forecolor backcolor emoticons",
					image_advtab: true,
					relative_urls: false
					*/
				}); 
				$('textarea.tinymce-editoradvv').tinymce({
					plugins: [
						"advlist autolink lists link image charmap print preview hr anchor pagebreak",
						"searchreplace wordcount visualblocks visualchars code fullscreen",
						"insertdatetime media nonbreaking save table contextmenu directionality",
						"emoticons template paste textcolor "
					],
					toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
					//toolbar2: "print preview media | forecolor backcolor emoticons",
					//image_advtab: true,
					relative_urls: false
				}); 
            });		
    </script>	
    <script src="<?=base_url()?>assets/webadmin/js/custom-scripts.js"></script>
</body>
</html>