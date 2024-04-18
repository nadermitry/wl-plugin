


 <!-- CSS -->
 <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="<?php echo $this->plugin_url ?>xassets/bootstrap/css/bootstrap.css">
        <link rel="stylesheet" href="<?php echo $this->plugin_url ?>xassets/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="<?php echo $this->plugin_url ?>xassets/css/form-elements.css">
        <link rel="stylesheet" href="<?php echo $this->plugin_url ?>xassets/css/style.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="xassets/ico/favicon.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo $this->plugin_url ?>xassets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo $this->plugin_url ?>xassets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $this->plugin_url ?>wl-plugin/xassets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="<?php echo $this->plugin_url ?>xassets/ico/apple-touch-icon-57-precomposed.png">

<style>
/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgba(0,0,0,0.5); /* Black w/ opacity */
}

/* Loading Spinner */
.loader {
  border: 8px solid #f3f3f3; /* Light grey */
  border-top: 8px solid #3498db; /* Blue */
  border-radius: 50%;
  width: 50px;
  height: 50px;
  animation: spin 2s linear infinite;
  position: absolute;
  left: 50%;
  top: 50%;
  margin-left: -25px;
  margin-top: -25px;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}


</style>


<!--<div id="eventWizard" class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3 form-box addeventbody">-->
<div id="eventWizard" class="form-box addeventbody">
         
                        <form role="form" id="event-form" method="post" enctype="multipart/form-data"  class="f1">
                    		<!--<h3>Register To Our App</h3>
                    		<p>Fill in the form to get instant access</p>-->
                    		<div class="f1-steps">
                    			<div class="f1-progress">
                    			    <div class="f1-progress-line" data-now-value="16.66" data-number-of-steps="3" style="width: 16.66%;"></div>
                    			</div>
                    			<div class="f1-step active">
                    				<div class="f1-step-icon"><i class="fa fa-gift"></i></div>
                    				<p>Add Gifts</p>
                    			</div>
                    			<div class="f1-step">
                    				<div class="f1-step-icon"><i class="fa fa-users"></i></i></div>
                    				<p>Invite Friends</p>
                    			</div>
                    		    <div class="f1-step">
                    				<div class="f1-step-icon"><i class="fa fa-map-marker"></i></i></div>
                    				<p>Summery</p>
                    			</div>                              
                    		</div>
                    		
                    		<fieldset>
                    		    <!--<h4>Tell us who you are:</h4>-->
                            <div class="container">
  <!-- List -->

  <ul  class="list-group">
   

   <li id="li0" class="list-group-item">
   
      
   
             <input  class="addEvent  form-control" type="search" id="search" placeholder="Search..." aria-label="Search">
              <!-- You can add a search button if needed -->
             <!-- <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button> -->
           
         
         
        
    
     </li>

  </ul>

  <ul id="list" class="list-group">

    
    <?php foreach ($newgifts as $gift) : ?>
        <li id="li<?php echo $gift->event_gift_id?>" class="list-group-item">
        <img width="65px" src="<?php echo $gift->img_url?>" ?>
        <?php  echo $this->trim_and_add_dots($gift->title,60) ?>
       <div id="giftsControl-G<?php echo $gift->id?>" style="float:right;">  
        <button  onclick="add_to_event(<?php echo $gift->id ?>,<?php echo   $this->eventid ?>)">Add</button>
        
       
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
                            
<div class="f1-buttons">
                                    
                                    <button type="button" class="btn btn-next">Next</button>
                                </div>
</fieldset>

                            <fieldset>
                            <article class="small single">     
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
                                <div class="f1-buttons">
                                    <button type="button" class="btn btn-previous">Previous</button>
                                    <button type="button" class="btn btn-next">Next</button>
                                </div>
                            </fieldset>

                            <fieldset>
                               
                                
                                <div class="f1-buttons">
                                    <input type="hidden" name="action" value="wl_ajax_save_event">
                                    <button type="button" class="btn btn-previous">Previous</button>
                                    <button name="submit" type="submit" class="btn btn-submit">Submit</button>
                                    <!--<button  type="button" onclick="save_event();" class="btn">Submit</button>-->
                                </div>
                            </fieldset>
                    	
                    	</form>
                    </div>


  <!-- The Modal -->
  <div id="loadingModal" class="modal">
    <!-- Loading spinner -->
    <div class="loader"></div>
  </div>



<!--

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <div class="container">
            <div class="row">
                <div class="col-md-12">                    
                    <form5 id="event-form555" method="post55" enctype="multipart/form-data">
                        <label>Title:</label>
                        <input type="text" name="event_title" required><br><br>
                        
                        <label>Image Upload:</label>
                        <input type="file" name="event_image" accept="image/*" required><br><br>
                        
                        <label>Start Date and Time:</label>
                        <input type="datetime-local" name="start_datetime" required><br><br>
                        
                        <label>End Date and Time:</label>
                        <input type="datetime-local" name="end_datetime"><br><br>
                        
                        <label>Description:</label>                                               
                        <textarea id="event_description" name="event_description" rows="4" cols="50"></textarea><br><br>

                        <label>Location Name:</label>
                        <input type="text" name="event_address_name" required ><br><br>

                        <label>Location URL:</label>
                        <input type="text" name="event_address_url"><br><br>

                        <label>Location Address:</label>
                        <textarea name="event_address" required></textarea><br><br>

                        <label>Google Maps location:</label>
                        <input type="text" name="event_location"><br><br>    
                        
                        <input type="submit" name="submit" value="Submit">
                    </form>
                </div>
            </div>
        </div>
    </main>
</div>
        -->




  <script src="<?php echo $this->plugin_url ?>/xassets/js/jquery-1.11.1.min.js"></script>
                    
        <script src="<?php echo $this->plugin_url ?>/xassets/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo $this->plugin_url ?>/xassets/js/jquery.backstretch.min.js"></script>
        <script src="<?php echo $this->plugin_url ?>/xassets/js/retina-1.1.0.min.js"></script>
        <script src="<?php echo $this->plugin_url ?>/xassets/js/scripts.js"></script>
        
        <!--[if lt IE 10]>
            <script src="<?php echo $this->plugin_url ?>/xassets/js/placeholder.js"></script>
        <![endif]-->




<script>







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
</script>