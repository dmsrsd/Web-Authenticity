<style>
.modal {
  text-align: center;
  padding: 0!important;
}

.modal:before {
  content: '';
  display: inline-block;
  height: 100%;
  vertical-align: middle;
  margin-right: -4px;
}

.modal-dialog {
  display: inline-block;
  text-align: left;
  vertical-align: middle;
}
</style>
</div>
    <script src="<?=base_url()?>assets/webadmin/js/jquery-1.10.2.js"></script>
    <script src="<?=base_url()?>assets/webadmin/js/bootstrap.min.js"></script>
	<script type="text/javascript">

	var message="Sorry, right-click has been disabled";
	function clickIE() {if (document.all) {(message);return false;}}
	function clickNS(e) {if
	(document.layers||(document.getElementById&&!document.all)) {
	if (e.which==2||e.which==3) {(message);return false;}}}
	if (document.layers)
	{document.captureEvents(Event.MOUSEDOWN);document.onmousedown=clickNS;}
	else{document.onmouseup=clickNS;document.oncontextmenu=clickIE;}
	document.oncontextmenu=new Function("return false")
	function disableF5(e) { if (e.which == 116) e.preventDefault(); };	
	
		$(document).ready(function () { 
		});
	</script>
</body>
</html>