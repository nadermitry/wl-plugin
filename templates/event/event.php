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
//$full_url = $image_path['full']; // The full URL

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
        
        <?php foreach ($gifts as $gift) : ?>
                            <p class="card-text"><div class="bs-blog-category"><a href="" target="_blank" class="blogus-categories category-color-1"><?php  echo $gift->title ?></span></a></div>
                        <?php endforeach ; ?>

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
<div class="bs-info-author-block py-4 px-3 mb-4 flex-column justify-content-center text-center">
    <a class="bs-author-pic mb-3" ><img alt="" src="<?php echo $full_url;?>" srcset="<?php echo $full_url;?> 2x" class="avatar avatar-150 photo" height="150" width="150" decoding="async"></a>
    <div class="flex-grow-1">
        <h4 class="title"><a ><?php echo $user_full_name ?></a></h4>
        <p></p>
    </div>
</div>






<?php  endforeach ?>