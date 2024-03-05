<script>

   


if ("geolocation" in navigator) {
    // Geolocation is available
    navigator.geolocation.getCurrentPosition(function(position) {
        // Success callback
        var latitude = position.coords.latitude;
        var longitude = position.coords.longitude;
        
        // You can do something with the latitude and longitude
        console.log("Latitude: " + latitude + ", Longitude: " + longitude);
    }, function(error) {
        // Error callback
        console.error("Error getting geolocation: ", error.message);
    });
} else {
    // Geolocation is not available
    console.error("Geolocation is not supported by this browser.");
}







</script>    
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

</style>

<?php defined( 'ABSPATH' ) or die( 'eRROR' ); ?>

<?php
        
        //$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $current_user_id = get_current_user_id();
        
        // Custom Query
      /*
        $args = array(
            'post_type'      => 'wl_items', // Replace with your custom post type slug
            'posts_per_page' => 5, // Display all posts
            'author'    => $current_user_id, 
            'paged'     => $paged            
        );

        $custom_query = new WP_Query($args);

        if ($custom_query->have_posts()) :
            echo '<ul>'; // Start the unordered list
            while ($custom_query->have_posts()) : $custom_query->the_post();
                $url = get_post_meta(get_the_ID(), 'url', true);
                $img_url = get_post_meta(get_the_ID(), 'img_url', true);
                // Display post content or whatever you want to show              
                echo '<li>'; 
                echo '<img width ="10%" src="'.esc_url( $img_url). '">';
                echo '<a href="' . esc_url( $url) . '">' . get_the_title() . '</a>';
                // the_content();
                echo '</li>'; // End list item
                // echo '<p>Meta Value: ' . esc_html($meta_value) . '</p>';
            endwhile;
            echo '</ul>'; // End the unordered list


            */

            global $wpdb;

           

            // Number of items per page
            $items_per_page = 3; // You can adjust this number as needed
            
            // Current page
            $current_page = max(1, get_query_var('paged'));
            
            // Calculate the offset
            $offset = ($current_page - 1) * $items_per_page;



$table_name = $wpdb->prefix . 'events';


$additional_condition = " WHERE user_id = $current_user_id";
// Prepare your SQL query with placeholders
$query = $wpdb->prepare("SELECT * FROM $table_name $additional_condition LIMIT %d, %d", $offset, $items_per_page);


// Fetch results
$results = $wpdb->get_results($query);
$total_items = $wpdb->get_var("SELECT COUNT(*) FROM $table_name $additional_condition");
// Loop through results






foreach ($results as $result) :
    $event_url= home_url('/event').'/?eid='.$result->id;
    $gifts     = $this->gifts($result->id);
?>

    <div id="post-565" class="bs-blog-post list-blog post-565 post type-post status-publish format-standard has-post-thumbnail hentry category-lifestyle category-travel tag-business tag-cinema tag-health tag-sport tag-travel tag-world">
    <div class="bs-blog-thumb lg back-img" style="background-image: url('<?php echo plugin_dir_url( dirname( __FILE__, 2 ) ) .'/assets/images/events/'. $result->event_image;  ?>');">
        <a href="<?php echo $event_url ?>" class="link-div"></a>
     </div> 
    <article class="small text-xs">
    <!--   
    <div class="bs-blog-category">
        <a class="blogus-categories category-color-1" href="http://localhost/wordpress/category/lifestyle/" alt="View all posts in lifestyle"> lifestyle </a>
        <a class="blogus-categories category-color-1" href="http://localhost/wordpress/category/travel/" alt="View all posts in Travel"> Travel          </a>  
    </div>
-->
<h4 class="title"><a href="<?php echo  $event_url?>"><?php echo $result->title ?></a></h4>
<div class="bs-blog-meta"> 
    <span class="bs-blog-date">
        <time datetime=""><?php echo date_i18n('F j, Y g:i a', strtotime($result->start_date));?></time>
    </span>

   <!-- <?php foreach ($gifts as $gift) : ?>
                            <p class="card-text"><div class="bs-blog-category"><a href="<?php echo $gift->url ?>" target="_blank" class="blogus-categories category-color-1"><?php  echo $this->trim_and_add_dots($gift->title,30) ?></span></a></div>
                            <button onclick="count_actions(<?php echo $gift->id?>,<?php echo $result->id?>,'views_count','<?php echo $gift->url?>')">View</button>
                            <button onclick="count_actions(<?php echo $gift->id?>,<?php echo $result->id?>,'purchase_count','<?php echo $gift->url?>')">Purchase</button>
        <?php endforeach ; ?>-->

    <!--    
    <span class="edit-link">
        <i class="fas fa-edit"></i>
            <a class="post-edit-link" href="http://localhost/wordpress/wp-admin/post.php?post=565&amp;action=edit">Edit 
            <span class="screen-reader-text">Goalposts post launch. Regroup move the needle.</span>
        </a>
    </span> 
  -->   
</div>

            <p><?php echo $result->description ;?></p>
        <a href="<?php echo  $event_url?>" class="more-link">Read More</a>
                    </article>
</div>
<!-- // bs-posts-sec block_6 -->


   
<?php 
 // Access your data
  //  echo '<a href="'. home_url('/event').'/?eid='.$result->id.'">' . $result->title .' </a>';
endforeach ?>



<?php

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










