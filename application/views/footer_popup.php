

                    </div>
                </div> 
 
    </div> 
	<style>
		.tab-pane{
			padding-top:20px;
		}
	</style>
    <script src="<?=base_url()?>assets/webadmin/js/jquery-1.10.2.js"></script>
    <script src="<?=base_url()?>assets/webadmin/js/bootstrap.min.js"></script>
    <script src="<?=base_url()?>assets/webadmin/js/jquery.metisMenu.js"></script>
    <script src="<?=base_url()?>assets/webadmin/js/dataTables/jquery.dataTables.js"></script>
    <script src="<?=base_url()?>assets/webadmin/js/dataTables/dataTables.bootstrap.js"></script>
	<script src="<?=base_url()?>assets/datepicker/js/bootstrap-datepicker.js"></script>
	<script type="text/javascript" src="<?=base_url()?>assets/webadmin/tinymce/tinymce.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>assets/webadmin/tinymce/jquery.tinymce.min.js"></script>	
	<script type="text/javascript" src="<?=base_url()?>assets/webadmin/js/bootstraptokenfield.js"></script>		
        <script>
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
            $(document).ready(function () {
                $(".datepicker").datepicker({
                    dateFormat: "yy-mm-dd",
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
				$('textarea.tinymce-editoradv').tinymce({
					plugins: [
						"advlist autolink lists link image charmap print preview hr anchor pagebreak",
						"searchreplace wordcount visualblocks visualchars code fullscreen",
						"insertdatetime media nonbreaking save table contextmenu directionality",
						"emoticons template paste textcolor filemanager"
					],
					toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
					//toolbar2: "print preview media | forecolor backcolor emoticons",
					image_advtab: true,
					relative_urls: false
				}); 
            });
		</script>	
    <script src="<?=base_url()?>assets/webadmin/js/custom-scripts.js"></script>
</body>
</html>