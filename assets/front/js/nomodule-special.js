(function() {
  var check = document.createElement('script');
  if (!('noModule' in check) && 'onbeforeload' in check) {
    var support = false;
    document.addEventListener('beforeload', function(e) {
      if (e.target === check) {
        support = true;
      } else if (!e.target.hasAttribute('nomodule') || !support) {
        return;
      }
      e.preventDefault();
    }, true);

    check.type = 'module';
    check.src = '.';
    document.head.appendChild(check);
    check.remove();
	
	
	}
}());

Webcam.set({
	width: 320,
	height: 320,
	dest_width: 320,
	dest_height: 320,
	image_format: 'jpeg',
	jpeg_quality: 90, 
	constraints: {
		width: 320, // { exact: 320 },
		height: 320, // { exact: 180 },
		facingMode: 'environment',
		frameRate: 30
	}	
});


$(document).on('ready', function() { 
	$('#scanner').hide();
	$('#scannerimage').show();
	Webcam.reset();
	Webcam.attach( '#my_camera' );
	$('#hasilimage').hide(); 
	
	$('.cekrek').click(function(){
		Webcam.snap( function(data_uri) {
			$('#hasilimage').attr('src', data_uri); 
			$('#hasilimage').show(); 
			$('#my_camera').hide(); 
			//window.onload = function() {  
				QCodeDecoder().decodeFromImage(data_uri, function(err, res){
					//$('#hasil').val(res||err)
					var dataform2 = new FormData();
					dataform2.append(secname, sechash);  		
					dataform2.append('qr', res);  		
					$.ajax({
						type: "POST",
						data: dataform2,
						dataType: "json",
						contentType: false,
						processData: false,
						url: base + "rewards/scanqrspecial",
						beforeSend: function () { 
							$('.overlay-all').show();
						},
						success: function (e) {
							if(e.status=="true"){
								//$('#onground').modal('show');
								$('#onground').modal({backdrop: 'static', keyboard: false});
								$('#onground .notif').html(e.hasil);
							}else{
								alert('GAGAL! '+e.message); 
								$('#my_camera').show(); 
								$('#hasilimage').hide(); 
								Webcam.reset();
								Webcam.attach( '#my_camera' );
							}
							
							$('.overlay-all').hide();
						},
						error: function () { 
							$('.overlay-all').hide();
						}
					});					
				});
			//}
		});
	});	
});