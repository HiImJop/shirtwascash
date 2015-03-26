function toggleoptions_on(){
	$('#UploadOptions').css('margin-top', '-100%');
}
function toggleoptions_off(){
	$('#UploadOptions').css('margin-top', '0px');
}

function getBase64Image(img) {
    // Create an empty canvas element
    var canvas = document.createElement("canvas");
    canvas.width = img.width;
    canvas.height = img.height;

    // Copy the image contents to the canvas
    var ctx = canvas.getContext("2d");
    ctx.drawImage(img, 0, 0);

    // Get the data-URL formatted image
    // Firefox supports PNG and JPEG. You could check img.src to guess the
    // original format, but be aware the using "image/jpg" will re-encode the image.
    var dataURL = canvas.toDataURL("image/png");

    return dataURL.replace(/^data:image\/(png|jpg);base64,/, "");
}

function findPos(obj) {
    var curleft = 0, curtop = 0;
    if (obj.offsetParent) {
        do {
            curleft += obj.offsetLeft;
            curtop += obj.offsetTop;
        } while (obj = obj.offsetParent);
        return { x: curleft, y: curtop };
    }
    return undefined;
}

function rgbToHex(r, g, b) {
    if (r > 255 || g > 255 || b > 255)
        throw "Invalid color component";
    return ((r << 16) | (g << 8) | b).toString(16);
}


$(function(){
	// Get hexcode from colored squares
	$('.color').on('click', function(e){
		e.preventDefault();
		var hex = $(this).data('hex');
		$('#tshirt-base').css('background-color', '#' + hex);
		$('#ColorPicker .icon-brush').css('color', '#' + hex);
		console.log(hex);
	});

	// Get hexcode from hex input
	$('#inputhex').on('keyup', function(){
		var inputhex = $(this).val();
		$('#tshirt-base').css('background-color', '#' +inputhex);
			$('#ColorPicker .icon-brush').css('color', '#' + inputhex);
		console.log(inputhex);
	});

	$('#ColorPicker').spectrum({
		preferredFormat: "hex",
		change:function(color){
			console.log('color change');
			$('#tshirt-base').css('background-color', color.toHexString());
			var hex = color.toHexString().substr(1);
			$('#inputhex').val(hex);
			$('#ColorPicker .icon-brush').css('color', '#' + hex);
		}
	});

	$('#tshirtdesign, .tshirt-design canvas').draggable({
		cursor:'move'
	})

	$('#ComputerImageHolder').on('change', function(){
		$('#changeimage').show();
		toggleoptions_on();
	});

	function readURL(input) {

	    if (input.files && input.files[0]) {
	        var reader = new FileReader();

	        reader.onload = function (e) {
	            $('#tshirtdesign').attr('src', e.target.result);
	        }

	        reader.readAsDataURL(input.files[0]);
	    }
	}

	$("#ComputerImageHolder").change(function(){
	    readURL(this);
	});

 	$( "#sizeandscale" ).slider({
 		min: 50,
 		max: 100,
 		value: 100,
 		animate: true,
 		slide: function(event, ui) {
             // $('#tshirtdesign').rotate(ui.value);
             console.log(ui.value)
             $('#tshirtdesign').css({
             	'width' : '' + ui.value + '%'
             });
        }}
 	);


 	$('#rotate-image').slider({
 		min: -180,
 		max: 180,
		slide: function(event, ui) {
             // $('#tshirtdesign').rotate(ui.value);
             console.log(ui.value)
             $('#tshirtdesign').css({
             	 '-ms-transform' : 'rotate('+ ui.value +'deg)',
			     '-webkit-transform' : 'rotate('+ ui.value + 'deg)',
			     'transform' : 'rotate('+ ui.value + 'deg)'
             });
        }
 	})

 	// event listener for pasted url
	document.addEventListener("paste", function (e) {
	    console.log(e.target.id);
	    var pastedText = undefined;
	    if (window.clipboardData && window.clipboardData.getData) { // IE
	        pastedText = window.clipboardData.getData('Text');
	    } else if (e.clipboardData && e.clipboardData.getData) {
	        pastedText = e.clipboardData.getData('text/plain');
	    }

	    pastedText = $.parseHTML(pastedText);
	    pastedText = pastedText[0].data;

	    e.preventDefault();
	    if(pastedText){
		    $('#tshirtdesign').attr('src', pastedText);
			toggleoptions_on();
	    }

	});


	// event listener for pasting images
	document.onpaste = function (event) {
	  var items = (event.clipboardData  || event.originalEvent.clipboardData).items;
	  // var pastedText = undefined;

	  console.log(JSON.stringify(items)); 
	  var blob = null;
	  for (var i = 0; i < items.length; i++) {
	    if (items[i].type.indexOf("image") === 0) {
	      blob = items[i].getAsFile();
	    }
	  }

	  if (blob !== null) {
	    var reader = new FileReader();
	    reader.onload = function(event) {
	      console.log(event.target.result);
	      $('#tshirtdesign').attr('src', event.target.result);
			toggleoptions_on();
	    };
	    reader.readAsDataURL(blob);
	  }
	}

	$('#SaveMockup').on('click', function(){
		html2canvas($("#TshirtPreview"), {
			allowTaint: true,
            onrendered: function(canvas) {
                theCanvas = canvas;
                document.body.appendChild(canvas);

                // Convert and download as image 
                Canvas2Image.saveAsPNG(canvas); 
                $("body").append(canvas);
                // Clean up 
                //document.body.removeChild(canvas);
            }
        });
	});


	$('#eyedropper').on('click', function(){
		html2canvas($("#tshirtdesign"), 
			allowTaint: true, {
            onrendered: function(canvas) {
                theCanvas = canvas;
                canvas.id = "eyedropimage";
				$('#tshirtdesigncontainer').html(canvas);
				$('#tshirtdesigncontainer').addClass('cursor');

                // Canvas2Image.saveAsPNG(canvas); 
                // $("#tshirt-base").appendTo(canvas);
                // document.body.removeChild(canvas);

                var canvasimage = $('#eyedropimage');

                canvasimage.mousemove(function(e) {
				    var pos = findPos(this);
				    var x = e.pageX - pos.x;
				    var y = e.pageY - pos.y;
				    var coord = "x=" + x + ", y=" + y;
				    var c = this.getContext('2d');
				    var p = c.getImageData(x, y, 1, 1).data; 
				    var hex = "#" + ("000000" + rgbToHex(p[0], p[1], p[2])).slice(-6);
				    var hexcode = "#" + ("000000" + rgbToHex(p[0], p[1], p[2])).slice(-6);
				    $('#status').html(coord + "<br>" + hex);
					$('#tshirt-base').css({'background' : hexcode});
					console.log(hexcode);
				});

				$('#tshirtdesign').addClass('hideimage');

				canvasimage.on('click', function(){
					$('#tshirtdesign').removeClass('hideimage');
					$(this).remove();
				});
            }
        });
	});

	$('#changeimage').on('click', function(){
		$('#ComputerImageHolder').click();
	});

	$("#CreateShirt").leanModal();
});
