
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
    		
        //alert(this.id);
        
        if( $(this).val() == "" ) {
    			$(this).addClass('input-error');
    			next_step = false;
    		}
    		else {
    			$(this).removeClass('input-error');
    		}
    	});
    	// fields validation
		if( $('#event_image').val() == "" ) {	
			//alert('xxxxddddddrrrxx');	
			//$('#file_title').css('color', 'red');
			$('#dropcontainer').css('border-color', 'red');
				
			e.preventDefault();
			$('drop-container').addClass('input-error');
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
        var formData = new FormData($(this)[0]);
		showLoading();
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



$(document).ready(function(){
    // Initialize pagination

    wl_paging();
    // Search functionality
    $("#search").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("#list li").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
      // Update pagination after filtering
      listItems = $("#list").children(":visible");
      numItems = listItems.length;
      numPages = Math.ceil(numItems / itemsPerPage);
      $("#pagination").empty();
      for (var i = 1; i <= numPages; i++) {

        if (i==1){
        isative=' active ';
        }else{
          isative='';
        }
        $("#pagination").append('<a class="'+ isative +'page-numbers" href="#">' + i + '</a>');
      }
      // Show the first page after filtering
      showPage(1);
    });

    $("#search").on("search", function() {
    if (!this.value) {
        // Show all list items
        $("#list li").show();
        
        // Update pagination after clearing the search
        listItems = $("#list").children(":visible");
      numItems = listItems.length;
      numPages = Math.ceil(numItems / itemsPerPage);
      $("#pagination").empty();
      for (var i = 1; i <= numPages; i++) {
        if (i==1){
        isative=' active ';
        }else{
          isative='';
        }
          
        $("#pagination").append('<a class="'+ isative +' page-numbers" href="#">' + i + '</a>');
      }
      showPage(1);
    }
});

    // Function to show specific page
  
  });




  
  var itemsPerPage = 3; // Change this to adjust items per page
    var listItems = $("#list").children();
    var numItems = listItems.length;
    var numPages = Math.ceil(numItems / itemsPerPage);
    //alert('CurrentPage');
    var CurrentPage = 1;
    

    function findMinimum(arr) {
    if (arr.length === 0) {
        return undefined; // Return undefined if the array is empty
    }

    let min = arr[0]; // Assume the first element is the minimum

    // Loop through the array to find the minimum value
    for (let i = 1; i < arr.length; i++) {
        if (arr[i] < min) {
            min = arr[i]; // Update min if the current element is smaller
        }
    }

    return min;
}

function add_to_event(giftid,eventid){
       // var strDivName= 'EventsofGift' + giftid;
        var enventid_array = [];
     
        var myDiv = document.getElementById("giftsControl-G"+giftid);
       // myDiv.innerHTML = myDiv.innerHTML + "<img width=\'200px\' src='.$this->plugin_url.'assets/images/loading_icon.gif\'>";
       
        enventid_array.push(eventid);
           

    passed_data={"giftid":giftid,"events":enventid_array,"delete":0};

  
        jQuery.ajax({
        type: "post",
        //url: '<?php echo  get_site_url();?>/wp-admin/admin-ajax.php',
       url: `${window.location.origin}/wp-admin/admin-ajax.php`,
        data: {
          action: "wl_add_to_event",  // the action to fire in the server
          data: passed_data,         // any JS object
        },
        complete: function (response) {
           
            console.log(response.responseText);
            var newHTML = response.responseText;    
          //  alert(newHTML);
//alert(enventid_array[0]);
             // Append HTML content to the div
             myDiv.innerHTML ='<button onclick="remove_from_event('+ giftid +','+ eventid+')">Remove</button>';
            
        },
    });

    
  }

  function remove_from_event(giftid,eventid,wishlistid=0){
       // var strDivName= 'EventsofGift' + giftid;
        var enventid_array = [];
  
       var myDiv = document.getElementById("giftsControl-G"+giftid);
       // myDiv.innerHTML = myDiv.innerHTML + "<img width=\'200px\' src='.$this->plugin_url.'assets/images/loading_icon.gif\'>";
       
        enventid_array.push(eventid);
           

    passed_data={"giftid":giftid,"events":enventid_array};


        jQuery.ajax({
        type: "post",
        url: `${window.location.origin}/wp-admin/admin-ajax.php`,
       
        data: {
          action: "wl_remove_from_event",  // the action to fire in the server
          data: passed_data,         // any JS object
        },
        complete: function (response) {
         
            console.log(response.responseText); 
           
           
            var newHTML = response.responseText;    
          //  alert(newHTML);
//alert(enventid_array[0]);
             // Append HTML content to the div
             if  (wishlistid==0){
             myDiv.innerHTML ='<button onclick="add_to_event('+ giftid +','+ eventid+')">Add</button>';
             }else
             {
              // Find the <ul> element by its ID
              //alert(wishlistid);
                var myList = document.getElementById('list');

            // Find the <li> element by its ID
            var listItemToRemove = document.getElementById('li'+wishlistid); // ID of the <li> to remove

            // Remove the <li> element from the <ul>
            if (listItemToRemove) {
                myList.removeChild(listItemToRemove);
                for (var i = 1; i <= numPages; i++) {

if (i ==1){activ=" active ";}else{activ="  ";}
//var myPagination = document.getElementById('pagination');
//myPagination.removeChild('pagingB' + i );

var myLink = document.getElementById('pagingB' + i);

// Remove the <a> element if it exists
if (myLink) {
  myLink.parentNode.removeChild(myLink);
}


}
          
wl_paging(CurrentPage);
            }
             }
        },
    });

    
  }

  

function showPage(page) {
      var startIndex = (page - 1) * itemsPerPage;
      var endIndex = startIndex + itemsPerPage;
      listItems.hide().slice(startIndex, endIndex).show();
    }

function wl_paging(parPage=1){
    listItems = $("#list").children();
    numItems = listItems.length;
    var numPages = Math.ceil(numItems / itemsPerPage);
    
    numbers = [];
    numbers.push(parPage);
    numbers.push(numPages);
    pagetoShow= findMinimum(numbers)
    
    // Add pagination items
    for (var i = 1; i <= numPages; i++) {

        if (i ==pagetoShow){activ=" active ";}else{activ="  ";}
      $("#pagination").append('<a id="pagingB'+ i +'" class="' + activ +'page-numbers" href="#">' + i + '</a>');
    }

    // Show first page by default
    
    //alert(CurrentPage);
    showPage(pagetoShow);

    // Pagination click event
    $("#pagination").on("click", ".page-numbers", function(e) {
       
      e.preventDefault();
      var page = $(this).text();
   
      showPage(page);
      // Highlight the clicked page number and remove highlight from others
      $(".page-numbers").removeClass("active");
      $(this).addClass("active");
      CurrentPage = page;
    });


}