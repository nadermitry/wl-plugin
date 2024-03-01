<?php
if (isset($_POST["title"]) ) {

  $post_data = array(
     'post_title'    => $_POST["title"],
     'post_content'  => $_POST["description"],
     'post_status'   => 'publish', // Can be 'publish', 'pending', 'draft', or 'private'
     'post_author'   => 1, // The ID of the author
     'post_type'     => 'wl_items', // Post type (e.g., 'post', 'page', 'custom_post_type')
  );
 
  // Insert the post into the database
  $post_id = wp_insert_post( $post_data );
 


 // Check if the post was successfully inserted
  if ( ! is_wp_error( $post_id ) ) {

    // Replace 123 with the ID of the post you want to add meta to

    // Add meta data to the post
    $meta_key = 'url';
    $meta_value = $_POST["url"];
    
    // Add the meta data to the post
    add_post_meta( $post_id, $meta_key, $meta_value );

    $meta_key = 'img_url';
    $meta_value = $_POST["imageUrl"];
    
    // Add the meta data to the post
    add_post_meta( $post_id, $meta_key, $meta_value );
    




     echo 'Post inserted successfully. Post ID: ' . $post_id;
 } else {
    echo 'Error inserting post: ' . $post_id->get_error_message();
 }

}
?>
