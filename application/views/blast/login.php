
<!DOCTYPE html>

<html class="backend" id='body'>
    <head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Simply Authentic | EBlast</title>
		<link href="<?=base_url()?>assets/webadmin/css/bootstrap.css" rel="stylesheet" />
		<link href="<?=base_url()?>assets/webadmin/css/font-awesome.css" rel="stylesheet" /> 
		<link href="<?=base_url()?>assets/webadmin/css/form-elements.css" rel="stylesheet" /> 
		<link href="<?=base_url()?>assets/webadmin/css/style.css" rel="stylesheet" /> 
		<link href="<?=base_url()?>assets/webadmin/images/favicon.png" rel="icon" />
    </head>
    <body>
	<style> 
	</style>
        <div class="top-content">
        	
            <div class="inner-bg">
                <div class="container"> 
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                        	<div class="form-top">
                        		<div class="form-top-left">
									<img src='<?=base_url()?>assets/webadmin/images/logo.png' width='150'><br><br>
                        			<h3>EBLAST Login </h3> 
                        		</div>
                        		<div class="form-top-right">
                        			<i class="fa fa-lock"></i>
                        		</div>
                            </div>
							
                            <div class="form-bottom">
			                    <form role="form" class="login-form"  name="form-login" action="<?=base_url()?>blast/auth/in" method="post" data-parsley-validate>
			                    	<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
									<div class="form-group">
			                    		<label class="sr-only" for="user">Username</label>
			                        	<input type="text" name="user" placeholder="Username..." class="form-username form-control" id="form-username" required>
			                        </div>
			                        <div class="form-group">
			                        	<label class="sr-only" for="pass">Password</label>
			                        	<input type="password" name="pass" placeholder="Password..." class="form-password form-control" id="form-password"  required>
			                        </div>
									<?php $response = $this->session->flashdata('response'); if(isset($response["status"]) && $response["status"] == "error"): ?>
										<div class="alert alert-danger" style='padding:10px;'>
											<?=$response["message"]?>
										</div>
									<?php endif; ?> 
			                        <button type="submit" class="btn btn-primary">Sign in!</button>
			                    </form>
		                    </div>
							
                        </div>
                    </div> 
                </div>
            </div>
            
        </div>	 
	<div align='center' style='font-size:12px; color:#666666;'>2019 Simply Authentic. All Rights Reserved.<br><a href='http://dialectiga.com' target='_blank'>Dialectiga</a></div>
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
	</script>
</body>
</html>