var Demo = (function() {
	function demoUpload() {
		var $uploadCrop;
		function readFile(input) {
 			if (input.files && input.files[0]) {
	            var reader = new FileReader();
	            
	            reader.onload = function (e) {
	                $('#form1').addClass('ready');
					$('.upload-demo').addClass('ready');
	            	$uploadCrop.croppie('bind', {
	            		url: e.target.result
	            	}).then(function(){
	            		console.log('jQuery bind complete');
	            	});
	            }
	            reader.readAsDataURL(input.files[0]);
				$("#btnnext").hide(); 
	        }
	        else {
		        alert("Sorry - you're browser doesn't support the FileReader API");
		    }
		}
		$uploadCrop = $('#upload-demo').croppie({
			viewport: {
				width: 300,
				height: 300,
				type: 'square'
			},
            enableOrientation: true
		});

		$('#imgInp').on('change', function () {
		    readFile(this);
		    $(".upload-demo-wrap").show();
		    $('.upload-result').show();
		    $('#hasilimage').attr('src', ""); 
		    $(".actions-crop").show();
			$('.cr-viewport').removeClass('cr-viewportco');
			$('.cr-viewport').removeClass('cr-viewportce');
			$('.cr-viewport').addClass('cr-viewportco');
		});
		$('.upload-result').on('click', function (ev) {
			$uploadCrop.croppie('result', {
				type: 'canvas',
				size: 'viewport'
			}).then(function (resp) {
				/*$('#hasilimage').attr('src', resp);
				$('.img-resultnya').attr('src', resp);
				$("#hasilnya").val(resp);
				$("#btnnext").show();
				$(".img-avg").trigger('click');
				*/
				var dataform = new FormData();
				var hasn = $('#hash').attr('name');
				var hasnv = $('#hash').val();
				dataform.append(hasn, hasnv); 
				dataform.append('pp', encodeURIComponent(resp)); 
				$.ajax({
					url: base+'profile/changepp',
					type: "POST",
					dataType: "json",
					contentType: false,
					processData: false,
					data: dataform,
					beforeSend: function () {  
						$('.overlay-all').show();
						$('#hasilimage').attr('src', resp);
						$('.img-resultnya').attr('src', resp);
						$("#hasilnya").val(resp);
						$("#btnnext").show();
						$(".img-avg").trigger('click');
					},				
					error: function () {
						$('.overlay-all').hide();
						alert('Failed..!!');
					},
					success: function (e) { 
						if(e.status=="true"){
							$('#lblStatusLogin').html("<div class='alert alert-success'>"+e.message+"</div>");
						}else{
							$('#lblStatusLogin').html("<div class='alert alert-danger'>"+e.message+"</div>");
						}
						$('.overlay-all').hide();
						$('.upload-result').hide(); 
					}
				});
			});
			$(".upload-demo-wrap").hide();
            $(this).hide(); 
		}); 
	}


	function init() {
		demoUpload();
	}

	return {
		init: init
	};
})();


// Full version of `log` that:
//  * Prevents errors on console methods when no console present.
//  * Exposes a global 'log' function that preserves line numbering and formatting.
(function () {
  var method;
  var noop = function () { };
  var methods = [
      'assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error',
      'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log',
      'markTimeline', 'profile', 'profileEnd', 'table', 'time', 'timeEnd',
      'timeStamp', 'trace', 'warn'
  ];
  var length = methods.length;
  var console = (window.console = window.console || {});
 
  while (length--) {
    method = methods[length];
 
    // Only stub undefined methods.
    if (!console[method]) {
        console[method] = noop;
    }
  }
 
 
  if (Function.prototype.bind) {
    window.log = Function.prototype.bind.call(console.log, console);
  }
  else {
    window.log = function() { 
      Function.prototype.apply.call(console.log, console, arguments);
    };
  }
})();
