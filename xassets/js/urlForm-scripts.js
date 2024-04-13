var imageSources =[];
var lastimgNo =0;
var imgNo =1;  

function scroll_to_class(element_class, removed_height) {
	var scroll_to = $(element_class).offset().top - removed_height;
	if($(window).scrollTop() != scroll_to) {
		$('html, body').stop().animate({scrollTop: scroll_to}, 0);
	}
}

function bar_progress(progress_line_object, direction) {
	var number_of_steps = progress_line_object.data('number-of-steps');
	var now_value = progress_line_object.data('now-value');
	var new_value = 0;
	if(direction == 'right') {
		new_value = now_value + ( 100 / number_of_steps );
	}
	else if(direction == 'left') {
		new_value = now_value - ( 100 / number_of_steps );
	}
	progress_line_object.attr('style', 'width: ' + new_value + '%;').data('now-value', new_value);
}


function showProgress() {
	
	var modal = document.getElementById("progressModal");
	modal.style.display = "block";
  
	var progressBar = document.getElementById("progressBar");
	var width = 0;
	var interval = setInterval(function() {
	  if (width >= 100) {
		clearInterval(interval);
		modal.style.display = "none";
	  } else {
		width++;
		progressBar.style.width = width + "%";
	  }
	}, 50); // Change interval for different speeds
  }

  function showLoading() {	
	var modal = document.getElementById("loadingModal");
	modal.style.display = "block";
  }

  function hideLoading() {	
	var modal = document.getElementById("loadingModal");
	modal.style.display = "none";
  }


  

jQuery(document).ready(function() {	
   
    $('.f1 fieldset:first').fadeIn('slow');
    
    $('.f1 input[type="text"], .f1 input[type="password"], .f1 textarea').on('focus', function() {
		$(this).removeClass('input-error');
    });
    
    
	$('.f1 .btn-npost').on('click', function() {

		var parent_fieldset = $(this).parents('fieldset');
		var next_step = true;
    	// navigation steps / progress steps
		var current_active_step = $(this).parents('.f1').find('.f1-step.active');
		var progress_line = $(this).parents('.f1').find('.f1-progress-line');
		
    	// fields validation
		parent_fieldset.find('#url').each(function() {
			if( $(this).val() == "" ) {
				$(this).addClass('input-error');
				next_step = false;
			}
			else {
				$(this).removeClass('input-error');				
			



	passed_data={"url":$(this).val()};
	showLoading();  
	jQuery.ajax({
		type: "post",
		url: `${window.location.origin}/wp-admin/admin-ajax.php`,
		data: {
		  action: "wl_ajax_add_gift_url",  // the action to fire in the server
		  data: passed_data,         // any JS object
		},
		success: function(response) {
			// Handle success response
			//console.log(JSON.parse(response.responseText));
			//console.log(JSON.parse(response.responseText));  
			//console.log("sucees");
		   
		},
		error: function(xhr, textStatus, errorThrown) {
			// Handle error response
			console.error('Error: ' + textStatus);
			next_step = false;
		},
		complete: function (response) {
			//console.log('complete');        
			//console.log(JSON.parse(response.responseText).data);                
			//window.open(purl, "_blank");
            if( next_step ) {

				
				$("#title").val(JSON.parse(response.responseText).data.title);	
				
				var container = document.getElementById("imageContainer");
				
					while (container.firstChild) {
						container.removeChild(container.firstChild);
					}
                  // Array of image sources
				 // alert( JSON.parse(response.responseText).data.images);
				  if (JSON.parse(response.responseText).data.images == undefined)
				  {
					imageSources=['fffff.jpg'];
				  }else{
    			 imageSources = JSON.parse(response.responseText).data.images;
				 
				  }
				

				lastimgNo=imageSources.length-1;
				initImages();

				

				

				parent_fieldset.fadeOut(400, function() {
					// change icons
					current_active_step.removeClass('active').addClass('activated').next().addClass('active');
					// progress bar
					bar_progress(progress_line, 'right');
					// show next step
					$(this).next().fadeIn();
					// scroll window to beginning of the form
					scroll_to_class( $('.f1'), 20 );
				});
				hideLoading();
			}
		},
	});

			}
		});



	

});
	
	

	
$('.f1 .btn-save-gift').on('click', function() {



   // alert('rrrrrrrrrrrrrrrrr');
	var parent_fieldset = $(this).parents('fieldset');
	var next_step = true;
    // navigation steps / progress steps
	var current_active_step = $(this).parents('.f1').find('.f1-step.active');
	var progress_line = $(this).parents('.f1').find('.f1-progress-line');
		
    // fields validation

	parent_fieldset.find('#title2').each(function() {
		
		if( $(this).val() == "" ) {
			$(this).addClass('input-error');
			//if($(this).attr("id")=='imgurl'){
			//	$('#myImage').addClass('input-error');
				//$('#myImage').css("border-style", "solid");
		//}; 
            
		   
			next_step = false;
			//alert('ddddddddddddddddddddddddddd');
		}
		else {
			//alert('rttttttttttttttttttt');
			$(this).removeClass('input-error');	
			//alert($('#myImage').attr("src"));
			if($('#myImage').attr("src")=='na.png'){
			//	alert('ffff');
                $('#myImage').addClass('input-error');
				$('#myImage').css("border-style", "solid");
				next_step = false;
		     }else{

				passed_data={
					"title":$('#title').val(),
					"img_url":$('#myImage').attr("src"),
					"description":$('#description').val(),
					'url': $('#url').val()  
			     };
				showLoading();  
				jQuery.ajax({
					type: "post",
					url: `${window.location.origin}/wp-admin/admin-ajax.php`,
					data: {
					  action: "wl_ajax_save_gift_url",  // the action to fire in the server
					  data: passed_data,         // any JS object
					},
					success: function(response) {
						// Handle success response
						//console.log(JSON.parse(response.responseText));
						//console.log(JSON.parse(response.responseText).data);  
						//console.log("success");
						next_step=true;
					   
					},
					error: function(xhr, textStatus, errorThrown) {
						// Handle error response
						console.error('Error: ' + textStatus);
						//console.log(JSON.parse(response.responseText).data);  
						next_step = false;
					},
					complete: function (response) {
					//	console.log('complete');        
						//console.log(JSON.parse(response.responseText).data); 

						//window.open(purl, "_blank");
						next_step=true;
						$jsonGiftData=JSON.parse(response.responseText).data;
						$("#giftid").val($jsonGiftData.id);
						$("#gifttitle").text($jsonGiftData.title);
						$("#gifturl").attr("href", $jsonGiftData.url);
						$("#gifturl2").attr("href", $jsonGiftData.url);
						$("#giftdescription").text($jsonGiftData.description);
						$("#giftimage").attr("src", $jsonGiftData.img_url);
   						$("#giftimage").attr("alt", $jsonGiftData.title);
					},
				});


			 
			
			//if($(this).attr("id")=='imgurl'){
				//$('#myImage').removeClass('input-error');
				//$('#myImage').css("border-style", "none");
				
		//}; 
			
	

		
		if( next_step ) {
			
            
			parent_fieldset.fadeOut(400, function() {
				// change icons
				current_active_step.removeClass('active').addClass('activated').next().addClass('active');
				// progress bar
				bar_progress(progress_line, 'right');
				// show next step
				$(this).next().fadeIn();
				// scroll window to beginning of the form
				scroll_to_class( $('.f1'), 20 );
			});
			hideLoading();
		}
	}
}
	});

});


$('.f1 .btn-mygifts').on('click', function() {	
	showLoading();
	window.location.href = '/my-gifts';	
});


$('.f1 .btn-addto-event').on('click', function() {
    
	var parent_fieldset = $(this).parents('fieldset');
	var next_step = true;
    // navigation steps / progress steps
	var current_active_step = $(this).parents('.f1').find('.f1-step.active');
	var progress_line = $(this).parents('.f1').find('.f1-progress-line');
		
	if( next_step ) {
			
		
        showLoading();  
				jQuery.ajax({
					type: "post",
					url: `${window.location.origin}/wp-admin/admin-ajax.php`,
					data: {
					  action: "wl_ajax_addto_event_url",  // the action to fire in the server
					  data: passed_data,         // any JS object
					},
					success: function(response) {
						// Handle success response
						//console.log(JSON.parse(response.responseText));
						//console.log(JSON.parse(response.responseText).data);  
					//	console.log("success");
						next_step=true;
					   
					},
					error: function(xhr, textStatus, errorThrown) {
						// Handle error response
						console.error('Error: ' + textStatus);
						//console.log(JSON.parse(response.responseText).data);  
						next_step = false;
					},
					complete: function (response) {
						//console.log('complete');        
					//	console.log(JSON.parse(response.responseText).data); 
						jsonArray=JSON.parse(response.responseText).data;
						//for (var i = 0; i < jsonArray.length; i++) {
						//	console.log("ID:", jsonArray[i].title);
						//  }

						  var container = document.getElementById("checkboxContainer");

						  // Iterate over the JSON array

						




						  jsonArray.forEach(function(item) {
							  // Create a checkbox element
							  
							  var checkbox = document.createElement("input");
							  checkbox.type = "checkbox";
							  checkbox.id =  item.id; // Set unique ID for each checkbox
							  checkbox.name = "eventid[]" ; // Set unique name for each checkbox					        
							  // Create a label for the checkbox
							  var label = document.createElement("label");
							  label.htmlFor = "checkbox_" + item.id;
							  label.appendChild(document.createTextNode(item.title));
					           
							  // Append the checkbox and label to the container
							  container.appendChild(checkbox);
							  container.appendChild(label);
							  container.appendChild(document.createElement("br")); // Add line break for spacing
						       
							}); 	
						  hideLoading();  
						parent_fieldset.fadeOut(400, function() {
							// change icons
							current_active_step.removeClass('active').addClass('activated').next().addClass('active');
							// progress bar
							bar_progress(progress_line, 'right');
							// show next step
							$(this).next().fadeIn();
							// scroll window to beginning of the form
							scroll_to_class( $('.f1'), 20 );
						});
					},
				});


		
		
	}

});




$('.f1 .btn-next1').on('click', function() {
	var parent_fieldset = $(this).parents('fieldset');
	var next_step = true;
	// navigation steps / progress steps
	var current_active_step = $(this).parents('.f1').find('.f1-step.active');
	var progress_line = $(this).parents('.f1').find('.f1-progress-line');
	
	// fields validation
	parent_fieldset.find('#title').each(function() {
		if( $(this).val() == "" ) {
			$(this).addClass('input-error');
			next_step = false;
		}
		else {
			$(this).removeClass('input-error');
			$('#title2').val($(this).val());
		}
	});



if( next_step ) {
	parent_fieldset.fadeOut(400, function() {
		// change icons
		current_active_step.removeClass('active').addClass('activated').next().addClass('active');
		// progress bar
		bar_progress(progress_line, 'right');
		// show next step
		$(this).next().fadeIn();
		// scroll window to beginning of the form
		scroll_to_class( $('.f1'), 20 );
	});
}

});

	// next step
    $('.f1 .btn-next').on('click', function() {
		var parent_fieldset = $(this).parents('fieldset');
		var next_step = true;
    	// navigation steps / progress steps
		var current_active_step = $(this).parents('.f1').find('.f1-step.active');
		var progress_line = $(this).parents('.f1').find('.f1-progress-line');
		
    	// fields validation
		parent_fieldset.find('#event_title, #event_image,#start_datetime,#event_address_name,#event_address').each(function() {
			if( $(this).val() == "" ) {
				$(this).addClass('input-error');
				next_step = false;
			}
			else {
				$(this).removeClass('input-error');
			}
		});



	if( next_step ) {
		parent_fieldset.fadeOut(400, function() {
			// change icons
			current_active_step.removeClass('active').addClass('activated').next().addClass('active');
			// progress bar
			bar_progress(progress_line, 'right');
			// show next step
			$(this).next().fadeIn();
			// scroll window to beginning of the form
			scroll_to_class( $('.f1'), 20 );
		});
	}

});
    
    // previous step
    $('.f1 .btn-previous').on('click', function() {
    	// navigation steps / progress steps
    	var current_active_step = $(this).parents('.f1').find('.f1-step.active');
    	var progress_line = $(this).parents('.f1').find('.f1-progress-line');
    	
    	$(this).parents('fieldset').fadeOut(400, function() {
    		// change icons
    		current_active_step.removeClass('active').prev().removeClass('activated').addClass('active');
    		// progress bar
    		bar_progress(progress_line, 'left');
    		// show previous step
    		$(this).prev().fadeIn();
    		// scroll window to beginning of the form
			scroll_to_class( $('.f1'), 20 );
    	});
    });
    
  
	
	$(document).on('change', ':checkbox', function() {
		var checkboxID = $(this).attr('id');
		if($(this).is(":checked")) {
			
			passed_data={
				"giftid":$("#giftid").val(),
				"eventid":checkboxID
			 };
			showLoading();  
			jQuery.ajax({
				type: "post",
				url: `${window.location.origin}/wp-admin/admin-ajax.php`,
				data: {
				  action: "wl_add_gift_to_event",  // the action to fire in the server
				  data: passed_data,         // any JS object
				},
				success: function(response) {
					// Handle success response
					//console.log(JSON.parse(response.responseText));
					//console.log(JSON.parse(response.responseText).data);  
					//console.log("success");
					next_step=true;
				   
				},
				error: function(xhr, textStatus, errorThrown) {
					// Handle error response
					console.error('Error: ' + textStatus);
					//console.log(JSON.parse(response.responseText).data);  
					next_step = false;
				},
				complete: function (response) {
					//console.log('complete');        
					//console.log(JSON.parse(response.responseText).data); 

					//window.open(purl, "_blank");
					next_step=true;
					hideLoading();  
				},
			});





		} else {
			showLoading();  
			jQuery.ajax({
				type: "post",
				url: `${window.location.origin}/wp-admin/admin-ajax.php`,
				data: {
				  action: "wl_remove_gift_from_event",  // the action to fire in the server
				  data: passed_data,         // any JS object
				},
				success: function(response) {
					// Handle success response
					//console.log(JSON.parse(response.responseText));
					//console.log(JSON.parse(response.responseText).data);  
					//console.log("success");
					next_step=true;
				   
				},
				error: function(xhr, textStatus, errorThrown) {
					// Handle error response
					console.error('Error: ' + textStatus);
					//console.log(JSON.parse(response.responseText).data);  
					next_step = false;
				},
				complete: function (response) {
					//console.log('complete');        
					//console.log(JSON.parse(response.responseText).data); 

					//window.open(purl, "_blank");
					next_step=true;
					hideLoading();  
				},
			});
		}
	});


});

function initImages(){
	
	imgNo=0;
       
	var image = document.getElementById('myImage');
	var imageUrl = document.getElementById('imageUrl');
   
	if (imageSources[0]===undefined)
	{                
		image.src= window.location.origin +'/wp-content/plugins/wl-plugin/images/gift-icon.png';
		imageUrl.value =  window.location.origin +'/wp-content/plugins/wl-plugin/images/gift-icon.png';
	} 
	else
	{             
		image.src = imageSources[0];

		imageUrl.value = imageSources[0]
		//$("#imgurl").val(imageSources[0]);
	 } 

	 
   
	//prevBtn.disabled = true;
	//nextBtn.disabled = true ;
	
	//if (lastimgNo>0){nextBtn.disabled = false ;};

	 
	 imgNo =1;  
    
   




	   // Define an array of image URLs
var imageUrls = imageSources;
imageUrls.push(window.location.origin +'/wp-content/plugins/wl-plugin/images/gift-icon.png');

// Get the image container
var imageContainer = document.getElementById("imageContainer");


//var newDiv = document.createElement("div");
//	newDiv.classList.add("img");
// Create a new image element
//var imgElement = document.createElement("img");
// Add classes and attributes to the image element
//imgElement.classList.add("col-md-3"); // Bootstrap grid classes and custom class for styling
//imgElement.src =window.location.origin +'/wp-content/plugins/wl-plugin/images/gift-icon.png'; // Set the image source
//imgElement.alt = "Image"; // Set the alt attribute
//imgElement.onclick = function() {
	// You can define what happens when an image is clicked here
	//alert("You clicked on image: " + url);

		//var  imageUrl1 = document.getElementById('imageUrl');
		//var  image1    = document.getElementById('myImage');
		//alert(links[imgNo]);
		//image1.src      = window.location.origin +'/wp-content/plugins/wl-plugin/images/gift-icon.png';
		//imageUrl1.value = window.location.origin +'/wp-content/plugins/wl-plugin/images/gift-icon.png';

 //};
 //newDiv.appendChild(imgElement);
 //imageContainer.appendChild(newDiv);



// Loop through the image URLs array

//alert()

var divCount = 1;
imageUrls.forEach(function(url) {
	addDiv(divCount,url);
	divCount++;

	//var newDiv = document.createElement("div");
	//newDiv.classList.add("img");
	//newDiv.attr("id")=imgCount1;
	//imgCount1=imgCount1+1;
// Create a new image element
//var imgElement = document.createElement("img");
// Add classes and attributes to the image element
//imgElement.classList.add("col-md-3"); // Bootstrap grid classes and custom class for styling
//imgElement.src = url; // Set the image source
//imgElement.alt = "Image"; // Set the alt attribute

//imgElement.onclick = function() {
	// You can define what happens when an image is clicked here
	//alert("You clicked on image: " + url);

	//	var  imageUrl1 = document.getElementById('imageUrl');
	//	var  image1    = document.getElementById('myImage');
		//alert(links[imgNo]);
	//	image1.src      = url;		
	//	imageUrl1.value = url;
	//	hilieghigImage();

	//	$(this).parent().css("border-color", "RED");
			
			
	
		//$(this).classList.add("col-md-30")= "20px solid"; // Set border style
		//alert($(this));
    // Generate a random color (you can replace this with your desired color logic)
	//$(this).css.borderColor = "black";

 //};
 //newDiv.appendChild(imgElement);
 
 //imgCount=imgCount=+1; 
 //imageContainer.appendChild(newDiv);
// Append the image element to the image container

});

$("#imgDiv1").css("border-color", "green");


}


function addDiv(divCount,url) {
	// Create a new div element with unique ID
	
	var newDiv = $("<div></div>", {
		id: "imgDiv" + divCount,
		class: "img"
	});

	// Create a new img element
	var newImg = $("<img>", {
		src: url,
		alt: "Image" + divCount,
		click: function() {
			// You can define what happens when an image is clicked here
			//alert("You clicked on image: " + url);
		
				var  imageUrl1 = document.getElementById('imageUrl');
				var  image1    = document.getElementById('myImage');
				//alert(links[imgNo]);
				image1.src      = url;		
				imageUrl1.value = url;
				hilieghigImage();
		
				$(this).parent().css("border-color", "green");
					
					
			
				//$(this).classList.add("col-md-30")= "20px solid"; // Set border style
				//alert($(this));
			// Generate a random color (you can replace this with your desired color logic)
			//$(this).css.borderColor = "black";
		
		 }
	});

	newImg.onclick = function() {
		// You can define what happens when an image is clicked here
		//alert("You clicked on image: " + url);
	
			var  imageUrl1 = document.getElementById('imageUrl');
			var  image1    = document.getElementById('myImage');
			//alert(links[imgNo]);
			image1.src      = url;		
			imageUrl1.value = url;
			hilieghigImage();
	
			$(this).parent().css("border-color", "RED");
				
				
		
			//$(this).classList.add("col-md-30")= "20px solid"; // Set border style
			//alert($(this));
		// Generate a random color (you can replace this with your desired color logic)
		//$(this).css.borderColor = "black";
	
	 };// A
	
	
	
	newDiv.append(newImg);

	// Append the div to the container
	$("#imageContainer").append(newDiv);

	// Increment the div count for the next ID
	
}




function add_to_event(){


	alert($("#giftid").val());


}


function imagclicked(strimageno,pimgno) {
	// You can define what happens when an image is clicked here
	//alert(lastimgNo);
  
//nextBtn.disabled = false ;
//prevBtn.disabled = false ;
//if (pimgno == 0 ){prevBtn.disabled = true;};
   //if (pimgno == lastimgNo ){nextBtn.disabled = true;};
	imgNo=pimgno;
	var  imageUrl1 = document.getElementById('imageUrl');
		var  image1    = document.getElementById('myImage');
		//alert(links[imgNo]);
		image1.src      = strimageno;
		imageUrl1.value = strimageno;
		//$("#imgurl").val(strimageno);
		//$("#title").val(JSON.parse(response.responseText).data.title);	
	   
	   
		
	  

};

function changeImageAdd() {
	
	 //if (imgNo == (lastimgNo-1) ){nextBtn.disabled = true;};
	
	 
	 imgNo =imgNo +1;
	
		 //if (imgNo > lastImage) {alert('fffffffffff')}
		  //alert( imgNo);
		 imageUrl = document.getElementById('imageUrl');
		 var image = document.getElementById('myImage');
		 //alert(links[imgNo]);
		 image.src = imageSources[imgNo];		 

		 imageUrl.value= imageSources[imgNo];
		 //prevBtn.disabled = false;
	
	 }


	 function changeImageSub() {
		
		
		
		//if (imgNo == 1 ){prevBtn.disabled = true;};
	
		 if (imgNo ==0 ){return false;};
		//nextBtn.disabled = false;
	 imgNo =imgNo -1;
	 imageUrl = document.getElementById('imageUrl');
	 var image = document.getElementById('myImage');
		 //alert(links[imgNo]);
		 image.src = imageSources[imgNo];
		 imageUrl.value= imageSources[imgNo];
		 
	
	 }

	 function hilieghigImage(){


		// Get all elements with the class "img"
var elements = document.getElementsByClassName("img");

// Loop through each element and change its border color
for (var i = 0; i < elements.length; i++) {
    elements[i].style.border = "2px solid"; // Set border style
    // Generate a random color (you can replace this with your desired color logic)
    elements[i].style.borderColor = "black";
}
	 }

	 // Function to generate a random color
function getRandomColor() {
    var letters = "0123456789ABCDEF";
    var color = "#";
    for (var i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}