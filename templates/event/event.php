
<style>

.pagination {
    margin: 20px 0;
}

.pagination a {
    padding: 8px 12px;
    margin-right: 5px;
    border: 1px solid #ccc;
    background-color: #f8f8f8;
    color: #333;
    text-decoration: none;
}

.pagination a:hover {
    background-color: #ddd;
}

.pagination .active {
    background-color: #0073e6;
    color: #fff;
    padding: 8px 12px;
    margin-right: 5px;
}

.pagination .dots {
    
    padding: 8px 12px;
    margin-right: 5px;
    border: 1px solid #ccc;
    background-color: #f8f8f8;
    color: #333;
    text-decoration: none;
}

.form-control {
    
    margin-bottom: 0px;   
   
}

.navbar-collapse1 {
    
    flex-grow: 0; 
    
}

</style>

<?php


global $wpdb;

$eventid = isset($_GET['eid']) ? intval($_GET['eid']) : 1;

$table_name = $wpdb->prefix . 'events';
$additional_condition = " WHERE id = $eventid";
// Prepare your SQL query with placeholders
$query = "SELECT * FROM $table_name $additional_condition";
// Fetch results
$results = $wpdb->get_results($query);
$currentURL = home_url( add_query_arg( NULL, NULL ));
$current_user = wp_get_current_user();
$user_name = $current_user->user_login;
$user_full_name = $current_user->display_name;
$image_path = get_user_meta($current_user->ID, 'wp_user_avatars', true);
$gifts     = $this->gifts($eventid);
$newgifts     = $this->gifts($eventid,true);
// Loop through results
//print_r($newgifts);
//$user_meta = unserialize($image_path);

// Access the values
$full_url = $image_path['full']; // The full URL

foreach ($results as $result) :
    
    $isCurrentUser = ($result->user_id == $current_user->ID);

?>



<div class="bs-blog-post single"> 
    <div class="bs-header">
        
        <?php if ($isCurrentUser) :?>

            <div class="bs-blog-category">
                <a class="blogus-categories category-color-1" href="http://localhost/wordpress/category/fashion/" alt="View all posts in Fashion"> 
                    Edit
                </a>
                <a class="blogus-categories category-color-1" href="http://localhost/wordpress/category/food/" alt="View all posts in Food"> 
                    Hide
                </a>        
            </div>

        <?php endif ?>

        <h1 class="title"> 
            <?php echo $result->title; ?>
        </h1>

        <article class="small single">
            <?php echo $result->description ; ?> 
        </article>

        <div class="bs-info-author-block">
            <div class="bs-blog-meta mt-3 mb-0">                
                <span class="bs-blog-date">
                   <time datetime=""><?php echo date_i18n('F j, Y g:i a', strtotime($result->start_date));?></time>
                </span>                
            </div>

            <div class="bs-blog-meta mt-3 mb-0">                
                <span class="bs-blog-date">
                    <a href="<?php echo $result->location_url?>"><?php echo $result->location_name?></a>
                </span>                
            </div>
        
      

        </div>

    </div>
    
    
    <img fetchpriority="high" width="1250" height="850" 
    src="<?php echo plugin_dir_url( dirname( __FILE__, 2 ) ) .'/assets/images/events/'. $result->event_image;  ?>" class="img-fluid wp-post-image" alt="" decoding="async" 
    srcset="<?php echo plugin_dir_url( dirname( __FILE__, 2 ) ) .'/assets/images/events/'. $result->event_image;  ?> 1250w,
    <?php echo plugin_dir_url( dirname( __FILE__, 2 ) ) .'/assets/images/events/'. $result->event_image;  ?> 300w,
    <?php echo plugin_dir_url( dirname( __FILE__, 2 ) ) .'/assets/images/events/'. $result->event_image;  ?> 1024w,
    <?php echo plugin_dir_url( dirname( __FILE__, 2 ) ) .'/assets/images/events/'. $result->event_image;  ?> 768w, 
    <?php echo plugin_dir_url( dirname( __FILE__, 2 ) ) .'/assets/images/events/'. $result->event_image;  ?> 600w"
    sizes="(max-width: 1250px) 100vw, 1250px">
        
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

   
</div>



<nav class="navbar navbar-expand-lg navbar-light">
  <div class="container">
   
  <a class="navbar-brand" href="#">Wish List</a>
    <div class="navbar-collapse1" id="navbarSupportedContent">
      <!-- Search input -->
        <form class="form-inline my-2 my-lg-0">
         

        <input style="float:right;"class="form-control mr-sm-2" type="search" id="search" placeholder="Search..." aria-label="Search">
         <!-- You can add a search button if needed -->
         <!-- <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button> -->
        </form>
    </div>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#bigModal">
add Gifts
</button>
  </div>
</nav>

<div class="container">
  <!-- List -->
  <ul id="list" class="list-group">
    
    <?php foreach ($gifts as $gift) : ?>
        <li id="li<?php echo $gift->event_gift_id?>" class="list-group-item">
        <img width="65px" src="<?php echo $gift->img_url?>" ?>
        <?php  echo $this->trim_and_add_dots($gift->title,60) ?>
       <div style="float:right;">                 
        <button onclick="count_actions(<?php echo $gift->id?>,<?php echo $result->id?>,'views_count','<?php echo $gift->url?>')">View</button>
        <button onclick="count_actions(<?php echo $gift->id?>,<?php echo $result->id?>,'purchase_count','<?php echo $gift->url?>')">Buy</button>
        <button  onclick="remove_from_event(<?php echo $gift->id?>,<?php echo $result->id?>,<?php echo $gift->event_gift_id?>)">Delete</button>
        
       
    </div>
    </li>
    
        <?php endforeach ; ?>
  </ul>


  <!-- Pagination -->
  <nav aria-label="Page navigation">
  
    <ul class="navigation pagination justify-content-center" id="pagination">
      <!-- Pagination items will be added dynamically using JavaScript -->
    </ul>
  </nav>

</div>


<div class="bs-info-author-block py-4 px-3 mb-4 flex-column justify-content-center text-center">
    <a class="bs-author-pic mb-3" ><img alt="" src="<?php echo $full_url;?>" srcset="<?php echo $full_url;?> 2x" class="avatar avatar-150 photo" height="150" width="150" decoding="async"></a>
    <div class="flex-grow-1">
        <h4 class="title"><a ><?php echo $user_full_name ?></a></h4>
        <p></p>
    </div>
</div>






<?php  endforeach ?>



<!-- Big Modal -->
<div class="modal fade" id="bigModal" tabindex="-1" aria-labelledby="bigModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg"> <!-- Use modal-lg class for a large modal -->
    <div class="modal-content">
      <div class="modal-header ">
        <h5 class="modal-title" id="bigModalLabel">Add gifts to <?php echo $result->title; ?> </h5>
       
        <form class="form-inline my-2 my-lg-0">
         

        <input  class="form-control mr-sm-2" type="search" id="newsearch" placeholder="Search..." aria-label="Search">
         <!-- You can add a search button if needed -->
         <!-- <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button> -->
        </form>
        <button  type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      

        <!-- Modal Content Goes Here -->
        <ul id="newlist" class="list-group">
    
    <?php foreach ($newgifts as $gift) : ?>
        <li class="list-group-item">
        <img width="65px" src="<?php echo $gift->img_url?>" ?>
        <?php  echo $this->trim_and_add_dots($gift->title,60) ?>
        <div id="giftsControl-G<?php echo $gift->id ?>" style="float:right;"> 
            <button onclick="add_to_event(<?php echo $gift->id ?>,<?php echo  $result->id ?>)">Add</button>
        </div>
    </li>
    
        <?php endforeach ; ?>
  </ul>
      </div>

      <nav aria-label="Page navigation">
  
  <ul class="navigation pagination justify-content-center" id="newpagination">
    <!-- Pagination items will be added dynamically using JavaScript -->
  </ul>
</nav>


      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       
      </div>
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



   var itemsPerPage = 5; // Change this to adjust items per page
    var listItems = $("#list").children();
    var numItems = listItems.length;
    var numPages = Math.ceil(numItems / itemsPerPage);
    //alert('CurrentPage');
    var CurrentPage = 1;
    

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

$('#bigModal').on('hidden.bs.modal', function () {  
    location.reload();
  });

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
        $("#pagination").append('<a class="page-numbers" href="#">' + i + '</a>');
      }
      // Show the first page after filtering
      showPage(1);
    });

    // Function to show specific page
  
  });
</script>



<script>
  $(document).ready(function(){
    // Initialize pagination
    var newitemsPerPage = 3; // Change this to adjust items per page
    var newlistItems = $("#newlist").children();
    var newnumItems = newlistItems.length;
    var newnumPages = Math.ceil(newnumItems / newitemsPerPage);
    
  
    // Add pagination items
    for (var i = 1; i <= newnumPages; i++) {

        if (i ==1){activ=" active ";}else{activ="  ";}
      $("#newpagination").append('<a   class="' + activ +'page-numbers" href="#">' + i + '</a>');
    }

    // Show first page by default
    newshowPage(1);

    // Pagination click event
    $("#newpagination").on("click", ".page-numbers", function(e) {
       
      e.preventDefault();
      var newpage = $(this).text();
   
      newshowPage(newpage);
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
      $("#newpagination").empty();
      for (var i = 1; i <= newnumPages; i++) {
        $("#newpagination").append('<a  class="page-numbers" href="#">' + i + '</a>');
      }
      // Show the first page after filtering
      newshowPage(1);
    });

    // Function to show specific page
    function newshowPage(page) {
      var newstartIndex = (page - 1) * newitemsPerPage;
      var newendIndex = newstartIndex + newitemsPerPage;
      newlistItems.hide().slice(newstartIndex, newendIndex).show();
    }
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
        url: `${window.location.origin}/wordpress/wp-admin/admin-ajax.php`,
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
        url: `${window.location.origin}/wordpress/wp-admin/admin-ajax.php`,
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

</script>