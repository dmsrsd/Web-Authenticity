  
    import QrScanner from "../qr/src/qr-scanner.js";
    QrScanner.WORKER_PATH = '../assets/front/qr/qr-scanner-worker.min.js';

    const video = document.getElementById('qr-video');
    const camQrResult = document.getElementById('cam-qr-result');
	const camHasCamera = document.getElementById('cam-has-camera');
    const scanner = new QrScanner(video, result => setResult(camQrResult, result));
    scanner.start(); 

    function setResult(label, result) {
        label.textContent = result;
        label.style.color = 'teal';
        clearTimeout(label.highlightTimeout);
        label.highlightTimeout = setTimeout(() => label.style.color = 'inherit', 100);
		camQrResult.value=result;
		scanner.pause();  
		var dataform2 = new FormData();
		dataform2.append(secname, sechash);  		
		dataform2.append('qr', result);  		
		$.ajax({
			type: "POST",
			data: dataform2,
			dataType: "json",
			contentType: false,
			processData: false,
			url: base + "rewards/scanqrspecial",
			beforeSend: function () { 
				$('#scanner').removeAttr('class');
				$('.overlay-all').show();
			},
			success: function (e) {
				if(e.status=="true"){
					//$('#onground').modal('show');
					$('#onground').modal({backdrop: 'static', keyboard: false});
					$('#onground .notif').html(e.hasil);
					$('#scanner').attr('class','right');
				}else{
					alert('GAGAL! '+e.message);
					$('#scanner').attr('class','wrong');
					scanner.start(); 
				}
				$('.overlay-all').hide();
			},
			error: function () { 
				$('.overlay-all').hide();
			}
		});
    }
    //QrScanner.hasCamera().then(hasCamera => camHasCamera.textContent = hasCamera);

	/*var image = "<?=base_url()?>uploads/qr/head-1.png";
	QrScanner.scanImage(image)
		.then(result => console.log(result))
		.catch(error => console.log(error || 'No QR code found.'));
 
	*/
	$('#scanner').show();
	$('#scannerimage').hide(); 