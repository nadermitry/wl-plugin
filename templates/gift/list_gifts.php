
<?php defined( 'ABSPATH' ) or die( 'eRROR' ); 

//if   (!isset($_GET['success'])) {

if (isset($_POST['giftid'])) {
 
   global $wpdb;
   $table_name = $wpdb->prefix . 'event_gifts';  
   // Specify the condition for deleting rows
   $where_condition = array('gift_id' => $_POST['giftid']);
   // Format the where condition
   $where_format = array('%d' );// Use '%d' for integers, '%f' for floats, '%s' for strings
   // Delete rows from the custom table
   $wpdb->delete($table_name, $where_condition, $where_format);
//Print_r($_POST['eventid']);
   if (isset($_POST['eventid'])) {
       // Loop through each selected fruit
       foreach ($_POST['eventid'] as $eventID) {
       
           $data_to_insert = array(
               'event_id' => $eventID,
               'gift_id' =>  $_POST['giftid'],
                'user_id' => $this->current_user_id,
               // Add more columns and values as needed
           );
           
           // Data format
           $data_format = array(
               '%d', // Use '%d' for integers, '%f' for floats, '%s' for strings
               '%d' // Format corresponds to the data type of each value in the $data_to_insert array
               // Add more format placeholders for additional columns
           );
           
           // Insert data into the custom table
           $wpdb->insert($table_name, $data_to_insert, $data_format);
          
       }

       $new_url = add_query_arg( 'success',$wpdb->insert_id , get_permalink() );
    //echo $new_url;
    //wp_redirect( $new_url, 303 );
    //echo("<script>location.href = '".$new_url."'</script>");
   } else {
      // echo "No fruits selected";
   }

}
//}

?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <!-- Bootstrap JS -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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

.pagination .current {
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


.form-check {
    position: relative;
    display: block;
    padding-left: 1.5em;
}

 /* Custom CSS for setting the image height */
.product-image {
  height: 200px; /* Set the desired height for the product images */
  object-fit: cover; /* Maintain aspect ratio and cover the container */
}
</style>

   


<?php


global $wpdb;
// Number of items per page
$items_per_page = 6; // You can adjust this number as needed
            
// Current page
$current_page = max(1, get_query_var('paged'));
            
// Calculate the offset
$offset = ($current_page - 1) * $items_per_page;

$table_name = $wpdb->prefix . 'gifts';
$additional_condition = " WHERE user_id = $this->current_user_id";
$query       = $wpdb->prepare("SELECT * FROM $table_name $additional_condition LIMIT %d, %d", $offset, $items_per_page);
$results     = $wpdb->get_results($query);
$total_items = $wpdb->get_var("SELECT COUNT(*) FROM $table_name $additional_condition");


?>


<div class="container">
    <div class="row">
   
<?php





 $count = 0;
foreach ($results as $result) :      


    $event_gifts_table = $wpdb->prefix . 'gift_events_vw';  
    // Specify the condition for deleting rows
    $where_condition = ' where gift_id =' .$result->id .' and  user_id = '. $this->current_user_id ;
    
    // Format the where condition
    //$where_format = array('%d' );// Use '%d' for integers, '%f' for floats, '%s' for strings
    $events     = $wpdb->get_results("select * from  $event_gifts_table $where_condition");

    //echo "select * from  $event_gifts_table $where_condition";
   // echo '<pre>';
    //Print_r($results);
    //echo '</pre>';
?>

                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        
                        <div class="card-body">
                            <h6 class="card-title tooltiptext" title="<?php echo $result->title; ?>"><?php echo $this->trim_and_add_dots($result->title,28); ?></h6>
                            <?php
                        if ($result->img_url) :
                            ?>
                            <img src="<?php echo  $result->img_url; ?>" alt="<?php echo $result->title; ?>" title="<?php echo $result->title; ?>" class="tooltiptext card-img-top product-image">
                            
                            
                            <?php endif; ?>
                            <p class="card-text"><div class="bs-blog-category"><a href="<?php echo $result->url?>" target="_blank" class="blogus-categories category-color-1"><?php  echo $this->get_vendor($result->url) ?></span></a></div>
                       
                       
                           <div id="EventsofGift<?php echo $result->id?>">
                            <?php foreach ($events as $event) : ?>
                            <p class="card-text"><div class="bs-blog-category"><a href="<?php echo home_url() .'/event?eid=' .$event->id?>" target="_blank" class="blogus-categories category-color-1"><?php  echo $event->title ?></span></a></div>
                           <?php endforeach ; ?>
                        </div>  



                            
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                     <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#eventsModal-G<?php echo $result->id?>">
                                     Add to Event
                                    </button>   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        
          
       



<?php 

 $count++;
 // Close the row and start a new one after every third product
 if ($count % 3 == 0) :
     ?>
 </div>
 <div class="row">
 <?php
 endif;

 echo $this->eventsSelector($result->id);



endforeach ;







$pagination = paginate_links(array(
    'base' => esc_url(add_query_arg('paged', '%#%')),
    'format' => '?paged=%#%',
    'current' => $current_page,
    'total' => ceil($total_items / $items_per_page),
    'prev_text' => __('Previous'),
    'next_text' => __('Next'),

));



        ?>

<div class="col-lg-12 content-right">
    <div class="bs-content-list"> 
        <div class="col-md-12 text-center d-md-flex justify-content-between">
       <div class="navigation pagination"> <?php echo $pagination ?> </div>
        </div>
    </div>                  
</div>



</div>
</div>



<script>
$(document).ready(function() {
  $('#myForm').submit(function(event) {
    // Prevent default form submission
    event.preventDefault();
    
    // Serialize form data
    var formData = $(this).serialize();

    // Submit form data using AJAX
    $.ajax({
      type: 'POST',
      url: '<?php 'your_php_script.php' ?>', // Change this to your PHP script URL
      data: formData,
      success: function(response) {
        // Handle success response
        console.log(response);
        // Optionally, you can perform further actions here
      },
      error: function(xhr, status, error) {
        // Handle error
        console.error(xhr.responseText);
      }
    });
  });
});
</script>



