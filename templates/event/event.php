
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
// Loop through results
//print_r($image_path);
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
         
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#bigModal">
  Launch Big Modal
</button>
        <input style="float:right;"class="form-control mr-sm-2" type="search" id="search" placeholder="Search..." aria-label="Search">
         <!-- You can add a search button if needed -->
         <!-- <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button> -->
        </form>
    </div>
  </div>
</nav>

<div class="container">
  <!-- List -->
  <ul id="list" class="list-group">
    
    <?php foreach ($gifts as $gift) : ?>
        <li class="list-group-item">
        <img width="65px" src="<?php echo $gift->img_url?>" ?>
        <?php  echo $this->trim_and_add_dots($gift->title,60) ?>
       <div style="float:right;">                 
        <button onclick="count_actions(<?php echo $gift->id?>,<?php echo $result->id?>,'views_count','<?php echo $gift->url?>')">View</button>
        <button onclick="count_actions(<?php echo $gift->id?>,<?php echo $result->id?>,'purchase_count','<?php echo $gift->url?>')">Buy</button>
        <button onclick="count_actions(<?php echo $gift->id?>,<?php echo $result->id?>,'purchase_count','<?php echo $gift->url?>')">Delete</button>
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
      <div class="modal-header">
        <h5 class="modal-title" id="bigModalLabel">Big Modal Window</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Modal Content Goes Here -->
        <p>This is a big modal window content.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>




<!-- Bootstrap JS and jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
  $(document).ready(function(){
    // Initialize pagination
    var itemsPerPage = 15; // Change this to adjust items per page
    var listItems = $("#list").children();
    var numItems = listItems.length;
    var numPages = Math.ceil(numItems / itemsPerPage);

    // Add pagination items
    for (var i = 1; i <= numPages; i++) {

        if (i ==1){activ=" active ";}else{activ="  ";}
      $("#pagination").append('<a class="' + activ +'page-numbers" href="#">' + i + '</a>');
    }

    // Show first page by default
    showPage(1);

    // Pagination click event
    $("#pagination").on("click", ".page-numbers", function(e) {
       
      e.preventDefault();
      var page = $(this).text();
   
      showPage(page);
      // Highlight the clicked page number and remove highlight from others
      $(".page-numbers").removeClass("active");
      $(this).addClass("active");
    });

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
    function showPage(page) {
      var startIndex = (page - 1) * itemsPerPage;
      var endIndex = startIndex + itemsPerPage;
      listItems.hide().slice(startIndex, endIndex).show();
    }
  });
</script>