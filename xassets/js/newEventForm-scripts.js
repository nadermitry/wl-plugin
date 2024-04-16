
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


jQuery(document).ready(function() {
	
    /*
        Fullscreen background
    */
    //$.backstretch("./xassets/img/backgrounds/1.jpg");
    
    //$('#top-navbar-1').on('shown.bs.collapse', function(){
    //	$.backstretch("resize");
    //});
    //$('#top-navbar-1').on('hidden.bs.collapse', function(){
    //	$.backstretch("resize");
    //});
    
    /*
        Form
    */
    $('.f1 fieldset:first').fadeIn('slow');
    
    $('.f1 input[type="text"], .f1 input[type="password"], .f1 textarea').on('focus', function() {
    	$(this).removeClass('input-error');
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
    	// fields validation
		alert('00000000000');	
		if ($('#event_image').val() == "" && $('#imageDisplay').attr('src') == "http://wishlist.local/wp-content/plugins/wl-plugin//images/imageplaceholder.png") {	
			alert('11111111111111111');	
			//$('#file_title').css('color', 'red');
			$('#dropcontainer').css('border-color', 'red');
				
			//e.preventDefault();
			$('drop-container').addClass('input-error');
		}else{
			if ($('#event_title').val() != ""){
				alert('22222222222222222');	
			next_step = true;
			}

		}

    	
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
    
    // submit
    
	
	
	
	
	/*
	
	$('.f1').on('submit', function(e) {  

		
		
    	
    	$(this).find('#event_title, #event_image,#start_datetime,#event_address_name,#event_address').each(function() {
    		
			
			
			
			
			if( $(this).val() == "" ) {
    			e.preventDefault();
    			$(this).addClass('input-error');
    		}
    		else {
    			$(this).removeClass('input-error');
    		}
    	});
    	// fields validation


		// fields validation
    	$(this).find('#url').each(function() {
    		if( $(this).val() == "" ) {
    			e.preventDefault();
    			$(this).addClass('input-error');
    		}
    		else {
    			$(this).removeClass('input-error');
    		}
    	});
    	// fields validation
    	
    });
    

  */
	$('.f1').on('submit', function(e) { 
		
		e.preventDefault();
		isError=true;
		$(this).find('#event_title, #event_image,#start_datetime,#event_address_name,#event_address').each(function() {
			if( $(this).val() == "" ) {
				e.preventDefault();
				$(this).addClass('input-error');
				isError=true;				
    		}
    		else {
    			$(this).removeClass('input-error');
				isError=false;	
    		}
    	});
    	// fields validation


		// fields validation
    	$(this).find('#url').each(function() {
    		if( $(this).val() == "" ) {
    			e.preventDefault();
    			$(this).addClass('input-error');
				isError=true;

    		}
    		else {
    			$(this).removeClass('input-error');
				isError=false;
    		}
    	});
        if (isError==false){
		
		showLoading();
		var formData = new FormData($(this)[0]);
        $.ajax({
        
            url: `${window.location.origin}/wp-admin/admin-ajax.php`, // WordPress AJAX URL
            type: 'POST',
            data: formData,
            async: true,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                // Handle success response
                //console.log(response.data);
				
				window.location.href = "/event2/?eid="+response.data;
			   
            },
            error: function(xhr, textStatus, errorThrown) {
                // Handle error response
                console.error('Error uploading file: ' + textStatus);
            }
        });
  
	}




    	
    });



	$('.addGiftForm fieldset:first').fadeIn('slow');
    
    $('.addGiftForm input[type="text"], .addGiftForm input[type="password"], .addGiftForm textarea').on('focus', function() {
    	$(this).removeClass('input-error');
    });
    
    // next step
    $('.addGiftForm .btn-next').on('click', function() {
    	var parent_fieldset = $(this).parents('fieldset');
    	var next_step = true;
    	// navigation steps / progress steps
    	var current_active_step = $(this).parents('.addGiftForm').find('.f1-step.active');
    	var progress_line = $(this).parents('.addGiftForm').find('.f1-progress-line');
    	
    	// fields validation
    	parent_fieldset.find('#URL').each(function() {
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
    			scroll_to_class( $('.addGiftForm'), 20 );
	    	});
    	}
    	
    });
    
    // previous step
    $('.addGiftForm .btn-previous').on('click', function() {
    	// navigation steps / progress steps
    	var current_active_step = $(this).parents('.addGiftForm').find('.f1-step.active');
    	var progress_line = $(this).parents('.addGiftForm').find('.f1-progress-line');
    	
    	$(this).parents('fieldset').fadeOut(400, function() {
    		// change icons
    		current_active_step.removeClass('active').prev().removeClass('activated').addClass('active');
    		// progress bar
    		bar_progress(progress_line, 'left');
    		// show previous step
    		$(this).prev().fadeIn();
    		// scroll window to beginning of the form
			scroll_to_class( $('.addGiftForm'), 20 );
    	});
    });
    









	$('.addGiftForm').on('submit', function(e) {
		e.preventDefault();
		isError=true;
		$(this).find('#url').each(function() {
			if( $(this).val() == "" ) {				
				e.preventDefault();
				$(this).addClass('input-error');
				isError=true;				
    		}
    		else {
    			$(this).removeClass('input-error');
				isError=false;				
    		}
    	});
		if (isError==false){
		var formData = new FormData($(this)[0]);
	    //showLoading();
		$.ajax({
        
            url: `${window.location.origin}/wp-admin/admin-ajax.php`, // WordPress AJAX URL
            type: 'POST',
            data: formData,
            async: true,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                // Handle success response
                console.log(response.data);
				
				//window.location.href = "/event2/?eid="+response.data;
			   
            },
            error: function(xhr, textStatus, errorThrown) {
                // Handle error response
                console.error('Error : ' + textStatus);
				alert('Error');
            }
        });
		
		
		}

		
    	
    	
    });





});





const dropContainer = document.getElementById("dropcontainer")
const fileInput = document.getElementById("event_image")

dropContainer.addEventListener("dragover", (e) => {
  // prevent default to allow drop
  e.preventDefault()
}, false)

dropContainer.addEventListener("dragenter", () => {
  dropContainer.classList.add("drag-active")
})

dropContainer.addEventListener("dragleave", () => {
  dropContainer.classList.remove("drag-active")
})

dropContainer.addEventListener("drop", (e) => {
  e.preventDefault()
  handleDrop(e)

  dropContainer.classList.remove("drag-active")
  fileInput.files = e.dataTransfer.files
  
})



function handleDrop(event) {
    event.preventDefault(); // Prevent default behavior (opening as link for some elements)

    if (event.dataTransfer.items) {
        // Use DataTransferItemList interface to access the file(s)
        for (var i = 0; i < event.dataTransfer.items.length; i++) {
			
            // If dropped items aren't files, reject them
            if (event.dataTransfer.items[i].kind === 'file') {
                var file = event.dataTransfer.items[i].getAsFile();
               
                // Check if the dropped file is an image
                if (!file.type.match('image.*')) {
                    console.log('Dropped file is not an image.');
                    return;
                }

                // Display the dropped image
                displayImage(file);
            }
        }
    } else {
        // Use DataTransfer interface to access the file(s)
        for (var i = 0; i < event.dataTransfer.files.length; i++) {
            // If dropped items aren't files, reject them
            if (event.dataTransfer.files[i].kind === 'file') {
                var file = event.dataTransfer.files[i];

                // Check if the dropped file is an image
                if (!file.type.match('image.*')) {
                    console.log('Dropped file is not an image.');
                    return;
                }

                // Display the dropped image
                displayImage(file);
            }
        }
    }
}


// Function to display the dropped image in the img tag
function displayImage(file) {
    const reader = new FileReader();

    reader.onload = function(event) {
        const imgElement = document.getElementById('imageDisplay');
        imgElement.src = event.target.result;
    };

    // Read the dropped file as a data URL
    reader.readAsDataURL(file);
}




function save_event(){


	$('.f1').find('#event_title, #event_image,#start_datetime,#event_address_name,#event_address').each(function() { 
		if( $(this).val() == "" ) {
			$(this).addClass('input-error');
						
			exit;
		}
		else {
			$(this).removeClass('input-error');
		}
	});
	// fields validation


	// fields validation
	$(this).find('#url').each(function() {
		if( $(this).val() == "" ) {
			$(this).addClass('input-error');
			exit;
		}
		else {
			$(this).removeClass('input-error');
		}
	});
	// fields validation

  
	var formData = new FormData($('#event-form')[0]);

	/*var formData = {
		event_title: document.getElementById("event_title").value,
		event_image: document.getElementById("event_image").value,
		event_description: document.getElementById("event_description").value,
		start_datetime: document.getElementById("start_datetime").value,
		end_datetime: document.getElementById("end_datetime").value,
		event_address_name: document.getElementById("event_address_name").value,
		event_address_url: document.getElementById("event_address_url").value,
		event_address: document.getElementById("event_address").value,
		event_location: document.getElementById("event_location").value		
	};*/



    passed_data=formData; 
    jQuery.ajax({
        type: "post",       
        url: `${window.location.origin}/wp-admin/admin-ajax.php`,
        data: {
          action: "wl_ajax_save_event",  // the action to fire in the server
          data: passed_data,         // any JS object
        },
        complete: function (response) {           
            console.log(JSON.parse(response.responseText).data);                
           alert(JSON.parse(response.responseText).data)

        },
    });
}




function ddd(imgpath ,dirUrl){
	//const fileInput = document.getElementById("event_image")
	const imageDisplay = document.getElementById("imageDisplay")
	const imageDisplaytext = document.getElementById("imageDisplaytext")
	imageDisplaytext.value=imgpath;
	//;
	//fileInput.files[0] = imgpath;
	imageDisplay.src=dirUrl+imgpath
	//alert(imgpath);


}


function dydy(){
	const imageDisplay = document.getElementById("imageDisplay")
	const imageDisplaytext = document.getElementById("imageDisplaytext")
	imageDisplaytext.value='';
	//;
	//fileInput.files[0] = imgpath;
	imageDisplay.src=''

}