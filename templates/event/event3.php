

<?php 

$dateString = $result->start_date; // Example DateTime string

// Create a DateTime object from the string
$dateTime = new DateTime($dateString);

// Extract date and time
$date = $dateTime->format('d-M-Y'); // Date in 'YYYY-MM-DD' format
$time = $dateTime->format('h:i A'); // Time in 'HH:MM:SS' format


$endDateString = $result->end_date; // Example DateTime string

// Create a DateTime object from the string
$endDateTime = new DateTime($endDateString);

// Extract date and time
$end_date = $endDateTime->format('d-M-Y'); // Date in 'YYYY-MM-DD' format
$end_time = $endDateTime->format('h:i A'); // Time in 'HH:MM:SS' format


        ?>



<div>

<div class="container">

<!-- Left Column / Headphones Image 
<div class="left-column">-->
<div class="row">
<div class="col-md-7">
  
  <img data-image="red" class="active" src="<?php echo plugin_dir_url( dirname( __FILE__, 2 ) ) .'/assets/images/events/'. $result->event_image;  ?>" alt="">
  <button class="btn btn-primary choose-image-button" data-toggle="modal" data-target="#imageModal">Choose Image</button>
</div>


<!-- Right Column 
<div class="right-column"> -->
<div class="col-md-5">
  <!-- Product Description -->
  <div class="product-description">
   <!-- <span>Event</span>-->
   <?php if ($isCurrentUser) :?>
             
           

             <div class="product-price">
    <!--<span>148$</span>-->
    <a   data-toggle="modal" data-target="#editModal" href="#" class="cart-btn">Edit</a>
    
    </div>
 
         <?php endif ?>
    <h1> <?php echo stripcslashes(sanitize_text_field($result->title)); ?></h1>
    <p><?php echo stripcslashes(sanitize_text_field($result->description)) ; ?></p>
  </div>

  <!-- Product Configuration -->
  <div class="product-configuration">

    <!-- Product Color 
    <div class="product-color">
      <span>Color</span>

      <div class="color-choose">
        <div>
          <input data-image="red" type="radio" id="red" name="color" value="red" checked>
          <label for="red"><span></span></label>
        </div>
        <div>
          <input data-image="blue" type="radio" id="blue" name="color" value="blue">
          <label for="blue"><span></span></label>
        </div>
        <div>
          <input data-image="black" type="radio" id="black" name="color" value="black">
          <label for="black"><span></span></label>
        </div>
      </div>

    </div>
    -->

    <!-- Cable Configuration -->
    <div class="cable-config">
      <!--<span>Cable configuration</span>-->     
      
<div class="container">
  <!-- Left Column / Headphones Image 
  <div class="left-column">-->
  <div class="row">
    <div class="col-md-6">          
      <div class="cable-choose">
        <button><i class="fas fa-calendar-alt mr-2"></i> <?php echo $date;?>   <?php echo $time;?></button>
      </div>
    </div> 

    <div class="col-md-6">
      <div class="cable-choose">
        <button><i class="fas fa-calendar-alt mr-2"></i> <?php echo $end_date;?> <?php echo $end_time;?></button>
      </div> 
    </div> 
  </div> 
</div> 
           
          
      

      
     
      <div class=" mt-0 mb-0">                
               
                    <a class=" mt-0 mb-0" target="_blank" href="<?php echo $result->location_url?>"><?php echo sanitize_text_field($result->location_name); ?></a>
                           
            </div>

            <div class=" mt-0 mb-0">                
                
                    <a  class=" mt-0 mb-0" target="_blank" href="<?php echo $result->location_map?>"><?php echo sanitize_text_field($result->location_address);?></a>
                           
            </div>


            <div class=" mt-0 mb-0">                
                <span class="bs-blog-date">
                    <a class=" mt-0 mb-0" target="_blank" href="<?php echo $result->location_map?>"> Map</a>
                </span>                
            </div>  
            
            <article class="small single ">     
        <div class="post-share">
            <div class="post-share-icons cf"> 

                <a class="facebook" href="https://www.facebook.com/sharer.php?u=<?php echo $currentURL ;?>" target="_blank">
                    <i class="fab fa-facebook"></i>
                </a>

                    <a class="x-twitter" href="http://twitter.com/share?url=<?php echo $currentURL ;?>" target="_blank">
                        <i class="fa-brands fa-x-twitter"></i>
                    </a>

                    <a class="envelope" href="mailto:?subject=<?php echo $result->title; ?>&amp;body=<?php echo $currentURL ;?>" target="_blank">
                        <i class="fas fa-envelope-open"></i>
                    </a>
                    <a class="linkedin" href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo $currentURL ;?>" target="_blank">
                        <i class="fab fa-linkedin"></i>
                    </a>
                               
                    <a class="telegram" href="https://t.me/share/url?url=<?php echo $currentURL ;?>&amp;title=<?php echo $result->title; ?>" target="_blank">
                        <i class="fab fa-telegram"></i>
                    </a>
                    <a class="whatsapp" href="https://api.whatsapp.com/send?text=<?php echo $currentURL ;?>" target="_blank">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                                    <a class="reddit" href="https://www.reddit.com/submit?url=<?php echo $currentURL ;?>" target="_blank">
                        <i class="fab fa-reddit"></i>
                    </a>
                    <a class="whatsapp" href="javascript:window.print()"> <i class="fas fa-print"></i></a>
            </div>
        </div>

        <div class="clearfix mb-3"></div>
                
                             

    </article>
    </div>

    
  </div>  
</div>
</div>
</div>

</div>



<div class="container">
  <!-- List -->

  <ul  class="list-group">
   

   <li id="li0" class="list-group-item">
   
       Wish List
       
        <button type="button"  style="float:right;" class="btn btn-primary" data-toggle="modal" data-target="#bigModal"> add Gifts</button>               
        
             <input style="float:right;" class="form-control mr-sm-2 col-md-3" type="search" id="search" placeholder="Search..." aria-label="Search">
              <!-- You can add a search button if needed -->
             <!-- <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button> -->
           
         
         
        
    
     </li>

  </ul>
  

  <ul id="list" class="list-group">

    
    <?php foreach ($gifts as $gift) : ?>
        <li id="li<?php echo $gift->event_gift_id?>" class="list-group-item">
        <img width="65px" src="<?php echo $gift->img_url?>" ?>
        <?php  echo $this->trim_and_add_dots($gift->title,60) ?>
       <div >                 
        <button onclick="count_actions(<?php echo $gift->id?>,<?php echo $result->id?>,'views_count','<?php echo $gift->url?>')">View</button>
        <button onclick="count_actions(<?php echo $gift->id?>,<?php echo $result->id?>,'purchase_count','<?php echo $gift->url?>')">Buy</button>
        <button  onclick="remove_from_event(<?php echo $gift->id?>,<?php echo $result->id?>,<?php echo $gift->event_gift_id?>)">Remove</button>
        
       
    </div>
    </li>
    
        <?php endforeach ; ?>
  </ul>


  <!-- Pagination -->
  <nav aria-label="Page navigation">
  
    <ul class="navigation wl-pagination justify-content-center" id="pagination">
      <!-- Pagination items will be added dynamically using JavaScript -->
    </ul>
  </nav>

</div>


<div class="bs-info-author-block py-4 px-3 mb-4 flex-column justify-content-center text-center">
    
<?php if ($full_url != "") :?>
  <a class="bs-author-pic mb-3" ><img alt="" src="<?php echo $full_url;?>" srcset="<?php echo $full_url;?> 2x" class="avatar avatar-150 photo" height="150" width="150" decoding="async"></a>
<?php endif; ?> 
<div class="flex-grow-1">
        <h4 class="title"><a ><?php echo $this->current_user->display_name; ?></a></h4>
        <p></p>
    </div>
</div>






<?php  //endforeach ?>



<!-- Big Modal -->
<div class="modal fade" id="bigModal" tabindex="-1" aria-labelledby="bigModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg"> <!-- Use modal-lg class for a large modal -->
    <div class="modal-content">
      <div class="modal-header ">
      <button  type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="bigModalLabel">Add gifts to <?php echo $result->title; ?> </h5>
       
        <form class="form-inline my-2 my-lg-0">
         

        <input  class="form-control mr-sm-2" type="search" id="newsearch" placeholder="Search..." aria-label="Search">
         <!-- You can add a search button if needed -->
         <!-- <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button> -->
        </form>
        
      </div>
      <div class="modal-body">

      

        <!-- Modal Content Goes Here -->
        <ul id="newlist" class="list-group">
    
    <?php foreach ($newgifts as $gift) : ?>
        <li class="list-group-item">
        <img width="65px" src="<?php echo $gift->img_url?>" ?>
        <?php  echo $this->trim_and_add_dots(stripcslashes($gift->title),60) ?>
        <div id="giftsControl-G<?php echo $gift->id ?>" style="float:right;"> 
            <button onclick="add_to_event(<?php echo $gift->id ?>,<?php echo  $result->id ?>)">Add</button>
        </div>
    </li>
    
        <?php endforeach ; ?>
  </ul>
      </div>

            <nav aria-label="Page navigation">
        
        <ul class="navigation wl-pagination justify-content-center" id="newpagination">
          <!-- Pagination items will be added dynamically using JavaScript -->
        </ul>
      </nav>


      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div>


<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog "> <!-- Use modal-lg class for a large modal -->
    <div class="modal-content">
      <div class="modal-header ">
      <button  type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="editModalLabel">Edit <?php echo $result->title; ?> </h5>       
       
      
      </div>
      <div class="modal-body">     

        <!-- Modal Content Goes Here -->
        
            <div class="container">
               <div class="row">
                  <div class="">                    
                      <form id="event-form" method="post" enctype="multipart/form-data">
                      <div class="row">
                        <div class="">
                          <label>Title:</label>
                          <input type="text" value=" <?php echo stripcslashes(sanitize_text_field($result->title)); ?>" id="event_title" name="event_title" required>
                        </div>                       
                      
                        <div class="">
                          <label>Start Date and Time:</label>
                          <input type="datetime-local"  value="<?php echo $result->start_date; ?>" id="start_datetime" name="start_datetime" required>
                        </div>
                        <div class="">
                          <label>End Date and Time:</label>
                          <input type="datetime-local" value="<?php echo $result->end_date; ?>" id="end_datetime" name="end_datetime">
                        </div>
                      </div>
                      <div class="row">
                        <div class="">
                        <label>Description:</label>                                               
                        <textarea id="event_description"  name="event_description" rows="3" cols="50"><?php echo stripcslashes(sanitize_text_field($result->description)) ; ?></textarea>
                        </div>
                      </div>  
                      <div class="row"> 
                      <div class="">               
                        <label>Location:</label>
                        <input type="text"     value="<?php echo sanitize_text_field($result->location_name)?>" id="event_address_name" name="event_address_name" required>
                        </div>
                        <div class="">
                        <label>Location URL:</label>
                        <input type="text"  value="<?php echo $result->location_url?>"  id="event_address_url"  name="event_address_url" >
                        </div>
                      </div> 
                      <div class="row"> 
                      <div class="">  
                        <label>Address:</label>
                        <input type="text" name="event_address"  id="event_address" value="<?php echo sanitize_text_field($result->location_address)?>" required>
                        </div>
                        <div class="">
                        <label>Location:</label>
                        <input type="text" name="event_location"   id="event_location" value="<?php echo $result->location_map?>">  
                        </div>
                        </div>
                       <br>
                        <div class="modal-footer">
                         
                        
                          <button data-dismiss="modal" onclick="update_event(<?php echo  $result->id ?>)">Save</button>  
                        </div>


                    </form>
                </div>
            </div>
        </div>
   
        
      </div>

          


      
    </div>
  </div>
</div>
<!-- Edit Modal End -->

<!-- Bootstrap Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">Choose Another Image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <form id="file-upload-form" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                   
                    <input type="file" id="newImageInput" name="newImageInput" class="form-control-file">
                    <input type="hidden" name="action" value="handle_file_upload">
                    <input type="hidden" name="event_id" value="<?php echo  $result->id ?>">
                </div>
                <div class="modal-footer">
                    <input type="submit"  class="btn btn-primary" name="submit" value="Upload File and save">                   
                    <button type="button" class="btn btn-primary" id="applyImageButton">Apply Image</button>
                </div> 
                </form>


                
    
    
    <!-- Add hidden input field for AJAX action -->
    


            </div>
        </div>
    </div>






<!-- Bootstrap JS and jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>











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



   
    





$('#bigModal').on('hidden.bs.modal', function () {  
    location.reload();
  });


  $('#editModal').on('hidden.bs.modal', function () {  
    location.reload();
  });

 


  //var itemsPerPage = 5; // Change this to adjust items per page
   // var listItems = $("#list").children();
  //  var numItems = listItems.length;
   // var numPages = Math.ceil(numItems / itemsPerPage);
    //alert('CurrentPage');
   // var CurrentPage = 1;



var itemsPerPageEvent = 3; // Change this to adjust items per page
var listItemsEvent = $("#list").children();
var numItemsEvent = listItemsEvent.length;
var numPagesEvent = Math.ceil(numItemsEvent / itemsPerPageEvent);
var pagesToShowEvent = 5; // Number of page numbers to show at a time
var currentPageEvent = 1; // Set the default current page

// Function to generate pagination
// Function to generate pagination
function icsGeneratePaginationEvent(containrtId,currentPage) {
    var paginationContainerEvent = $(containrtId);
    paginationContainerEvent.empty(); // Clear existing pagination links

    // Calculate start and end pages based on the current page
    var startPage, endPage;
    if (numPagesEvent <= pagesToShowEvent) {
        startPage = 1;
        endPage = numPagesEvent;
    } else {
        var halfPagesToShow = Math.floor(pagesToShowEvent / 2);
        if (currentPage <= halfPagesToShow) {
            startPage = 1;
            endPage = pagesToShowEvent;
        } else if (currentPage + halfPagesToShow >= numPagesEvent) {
            startPage = numPagesEvent - pagesToShowEvent + 1;
            endPage = numPagesEvent;
        } else {
            startPage = currentPage - halfPagesToShow;
            endPage = currentPage + halfPagesToShow;
        }
    }

    if (currentPage > 1) {
      paginationContainerEvent.append('<button type="button" class="ics-page-numbers" onclick="icsGotoPageEvent(' + (currentPage - 1) + ')">&laquo;</button>');
    }


    // Add pagination items
    for (var i = startPage; i <= endPage; i++) {
        var activ = (i === currentPage) ? "active" : "";
        paginationContainerEvent.append('<button type="button" class="' + activ + ' ics-page-numbers"  onclick="icsGotoPageEvent(' + i + ')">' + i + '</button>');
    }

    if (currentPage < numPagesEvent) {
      paginationContainerEvent.append('<button type="button"  class="ics-page-numbers" onclick="icsGotoPageEvent(' + (currentPage + 1) + ')">&raquo;</button>');
    }

    

}
















var newitemsPerPage = 3; // Change this to adjust items per page
var newlistItems = $("#newlist").children();
var newnumItems = newlistItems.length;
var newnumPages = Math.ceil(newnumItems / newitemsPerPage);
var pagesToShow = 5; // Number of page numbers to show at a time
var currentPage = 1; // Set the default current page


// Function to generate pagination
function icsGeneratePagination(containrtId,currentPage) {
    var newpaginationContainer = $(containrtId);
    newpaginationContainer.empty(); // Clear existing pagination links

    // Calculate start and end pages based on the current page
    var startPage, endPage;
    if (newnumPages <= pagesToShow) {
        startPage = 1;
        endPage = newnumPages;
    } else {
        var halfPagesToShow = Math.floor(pagesToShow / 2);
        if (currentPage <= halfPagesToShow) {
            startPage = 1;
            endPage = pagesToShow;
        } else if (currentPage + halfPagesToShow >= newnumPages) {
            startPage = newnumPages - pagesToShow + 1;
            endPage = newnumPages;
        } else {
            startPage = currentPage - halfPagesToShow;
            endPage = currentPage + halfPagesToShow;
        }
    }

    if (currentPage > 1) {
      newpaginationContainer.append('<button type="button" class="ics-page-numbers" onclick="icsGotoPage(' + (currentPage - 1) + ')">&laquo;</button>');
    }


    // Add pagination items
    for (var i = startPage; i <= endPage; i++) {
        var activ = (i === currentPage) ? "active" : "";
        newpaginationContainer.append('<button type="button" class="' + activ + ' ics-page-numbers"  onclick="icsGotoPage(' + i + ')">' + i + '</button>');
    }

    if (currentPage < newnumPages) {
      newpaginationContainer.append('<button type="button"  class="ics-page-numbers" onclick="icsGotoPage(' + (currentPage + 1) + ')">&raquo;</button>');
    }

}



// Function to handle pagination navigation
function icsGotoPage(pageNumber) {
    currentPage = pageNumber; // Update current page
    icsGeneratePagination("#newpagination",currentPage);   // Generate pagination with the updated current page
    var newstartIndex = (pageNumber - 1) * newitemsPerPage;
    var newendIndex = newstartIndex + newitemsPerPage;
    newlistItems.hide().slice(newstartIndex, newendIndex).show();    
   // console.log('Showing page ' + pageNumber);
}

// Function to handle pagination navigation
function icsGotoPageEvent(pageNumber) {
    currentPage = pageNumber; // Update current page
    icsGeneratePaginationEvent("#pagination",currentPage);   // Generate pagination with the updated current page
    var newstartIndex = (pageNumber - 1) * itemsPerPageEvent;
    var newendIndex = newstartIndex +  itemsPerPageEvent;    
    listItemsEvent.hide().slice(newstartIndex, newendIndex).show();    
   // console.log('Showing page ' + pageNumber);
}






  $(document).ready(function(){ 

    $('#file-upload-form').submit(function(e) {
        e.preventDefault();
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
                console.log(response.data);
                location.reload();
            },
            error: function(xhr, textStatus, errorThrown) {
                // Handle error response
                console.error('Error uploading file: ' + textStatus);
            }
        });
    });

// Initialize pagination
    var listItemsEvent = $("#list").children();
    var itemsPerPageEvent =3;    
    var containerIdEvent = "#pagination";
    var itemsPerPageEvent = 3
    
    icsGeneratePaginationEvent("#pagination",1);
    icsGotoPageEvent(1)
  



    icsGeneratePagination("#newpagination",currentPage);
    // Show first page by default
    icsGotoPage(1);
    // Pagination click event
    $("#newpagination").on("click", ".page-numbers", function(e) {
      e.preventDefault();
      var newpage = $(this).text();
      icsGotoPage(newpage);
      // Highlight the clicked page number and remove highlight from others
      $(".page-numbers").removeClass("active");
      $(this).addClass("active");
    });

    // Search functionality
    $("#newsearch").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("#newlist li").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
      // Update pagination after filtering
      newlistItems = $("#newlist").children(":visible");
      newnumItems = newlistItems.length;
      newnumPages = Math.ceil(newnumItems / newitemsPerPage);

      icsGeneratePagination("#newpagination",1); 
      // Show first page by default
      icsGotoPage(1);
    });




    $("#search").on("keyup", function() {
      
      var value = $(this).val().toLowerCase();
      $("#list li").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    
      // Update pagination after filtering
      listItemsEvent = $("#list").children(":visible");
      numItemsEvent = listItemsEvent.length;
     
      numPagesEvent = Math.ceil(numItemsEvent / itemsPerPageEvent);
      icsGeneratePaginationEvent("#pagination",1); 
      // Show first page by default
      icsGotoPageEvent(1);
      
    });


    
    $("#newsearch").on("search", function() {
    if (!this.value) {
      // Show all list items
      $("#newlist li").show();
      newlistItems = $("#newlist").children(":visible");
      newnumItems = newlistItems.length;
      newnumPages = Math.ceil(newnumItems / newitemsPerPage);
      icsGeneratePagination("#newpagination",1);     
      icsGotoPage(1);
  }
  });


  $("#search").on("search", function() {
    if (!this.value) {
        // Show all list items
        $("#list li").show();
        // Update pagination after clearing the search
        listItemsEvent = $("#list").children(":visible");
        numItemsEvent = listItemsEvent.length;
        numPagesEvent = Math.ceil(numItemsEvent / itemsPerPageEvent);
        icsGeneratePaginationEvent("#pagination",1); 
        // Show first page by default
        icsGotoPageEvent(1);
    }
});

   
  });



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


  function update_event(eventid){
  
    passed_data={"event":eventid,      
      "title":document.getElementById('event_title').value,
      "start_date":document.getElementById('start_datetime').value,
      "end_date":document.getElementById('end_datetime').value,
      "description":document.getElementById('event_description').value,
      "location_name":document.getElementById('event_address_name').value,
      "location_url":document.getElementById('event_address_url').value,
      "location_address":document.getElementById('event_address').value,
      "location_map":document.getElementById('event_location').value,
      "is_active":1
    };
    


    jQuery.ajax({
      type: "post",
      
url: `${window.location.origin}/wp-admin/admin-ajax.php`,
data: {
  action: "wl_update_event",  // the action to fire in the server
  data: passed_data,         // any JS object
},
complete: function (response) {
 
    console.log(response.responseText);
    //alert(response.responseText);
  //  alert(newHTML);
  //alert(enventid_array[0]);
  // Append HTML content to the div
  // myDiv.innerHTML ='<button onclick="remove_from_event('+ giftid +','+ eventid+')">Remove</button>';
    
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
          


icsGeneratePagination("#newpagination",CurrentPage);     
      icsGotoPage(1);
            }
             }
        },
    });

    
  }

</script>


<!-- Link Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Custom JavaScript -->
    <script>
        // Apply image button click event
        document.getElementById('applyImageButton').addEventListener('click', function() {
            // Fetch the new image from the file input
            var newImageFile = document.getElementById('newImageInput').files[0];
            if (newImageFile) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('originalImage').src = e.target.result;
                };
                reader.readAsDataURL(newImageFile);
            }
            // Close the modal
            $('#imageModal').modal('hide');
        });



      



    </script>