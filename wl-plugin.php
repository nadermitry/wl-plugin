<?php
/**
 * @package  wlPlugin
 */
/*
Plugin Name: Wish List Plugin
Plugin URI: 
Description: 
Version: 1.0.0
Author: Nader Mitry
Author URI: 
License: GPLv2 or later
Text Domain: wl-plugin
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

Copyright 2005-2015 Automattic, Inc.
*/

// TODO - Instalation steps 
//   1  - Install wordpress 
//   2  - Store woocommerce theme 
//	 3  - Woocommecre plugin
//   4  - WCFM Marketplace plugin 
//   5  - Simple Page Access Restriction
//            redirect page my account



// If this file is called firectly, abort!!!
defined( 'ABSPATH' ) or die( 'Hey, what are you doing here? You silly human!' );

//use Inc\Pages\AddEvent;
use Inc\Base\Event;
use Inc\Base\Gift;


// Require once the Composer Autoload
if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
	require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}


global $wpdb;
$charset_collate = $wpdb->get_charset_collate();
/*

$table_name = $wpdb->prefix . 'events';
$sql = "CREATE TABLE $table_name (
    id mediumint(9) NOT NULL AUTO_INCREMENT,
    user_id mediumint(9) NOT NULL,
	title varchar(255),
    start_date datetime NOT NULL,
	event_image  varchar(255),
    end_date datetime ,
    description text,
	location_name varchar(255),
	location_url varchar(255),
    location_address varchar(255),
	location_map varchar(255),
	is_active BOOLEAN NOT NULL DEFAULT 1, 
    PRIMARY KEY  (id)
) $charset_collate;";

require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
dbDelta( $sql ); 


 $table_name = $wpdb->prefix . 'gifts';
 $sql = "CREATE TABLE $table_name (
    id mediumint(9) NOT NULL AUTO_INCREMENT,    
	title varchar(255),   
    description text,
	url VARCHAR(1000) NOT NULL, 
	img_url  VARCHAR(255) NOT NULL,
	user_id mediumint(9) NOT NULL,
	product_id mediumint(9) ,
	is_active BOOLEAN NOT NULL DEFAULT 1,  
    PRIMARY KEY  (id)
) $charset_collate;";

require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
dbDelta( $sql ); 


$table_name = $wpdb->prefix . 'event_gifts';
$table_gifts_name = $wpdb->prefix . 'gifts';
$table_events_name = $wpdb->prefix . 'events';
$sql = "CREATE TABLE $table_name (
    id mediumint(9) NOT NULL AUTO_INCREMENT,    
	event_id mediumint(9) NOT NULL,   
    gift_id mediumint(9) NOT NULL,
	is_active BOOLEAN NOT NULL DEFAULT 1,
	views_count mediumint(9) NOT NULL DEFAULT 0,
	purchase_count mediumint(9) NOT NULL DEFAULT 0,
	user_id mediumint(9) NOT NULL,	
    PRIMARY KEY  (id),
	FOREIGN KEY (event_id) REFERENCES $table_events_name(id),
    FOREIGN KEY (gift_id) REFERENCES  $table_gifts_name(id)
	
) $charset_collate;";

require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
dbDelta( $sql ); 


$view_name = $wpdb->prefix . 'gift_events_vw';

// Your SQL query to create the view
$query = "
    CREATE VIEW $view_name AS
    SELECT $wpdb->prefix". "events.*, $wpdb->prefix" . "event_gifts.gift_id ,$wpdb->prefix" ."event_gifts.id as event_gift_id 
	FROM $wpdb->prefix"."events
	INNER JOIN $wpdb->prefix" . "event_gifts ON  $wpdb->prefix" . "event_gifts.event_id = $wpdb->prefix" . "events.id";

// Execute the query
$wpdb->query($query);


$view_name = $wpdb->prefix . 'event_gifts_vw';

// Your SQL query to create the view
$query = "
    CREATE VIEW $view_name AS
    SELECT $wpdb->prefix". "gifts.*, $wpdb->prefix" . "event_gifts.event_id , $wpdb->prefix" ."event_gifts.id as event_gift_id 
	FROM $wpdb->prefix"."gifts
	INNER JOIN $wpdb->prefix" . "event_gifts ON  $wpdb->prefix" . "event_gifts.gift_id = $wpdb->prefix" . "gifts.id";

// Execute the query
$wpdb->query($query);
*/


function wl_ajax_giftsActionCounter() {
    // Your AJAX logic goes here
    // You can retrieve data from $_POST array




    $data = $_POST['data'];
    

	$field_name=sanitize_text_field($data['type']);
	
  
	global $wpdb;
	// Table name
	$table_name = $wpdb->prefix . 'event_gifts';	

	
	// Update query
	$updated_rows =  $wpdb->query(
		$wpdb->prepare(
			"UPDATE $table_name SET $field_name = $field_name + 1 WHERE gift_id = %d AND event_id = %d",
			intval($data['giftid']),
			intval($data['eventid'])
		)
	);



if ($updated_rows !== false) {
    // If the update was successful, retrieve the updated views_count
    $updated_count = $wpdb->get_var(
        $wpdb->prepare(
            "SELECT $field_name FROM $table_name WHERE gift_id = %d AND event_id = %d",
			intval($data['giftid']),
            intval($data['eventid'])
        )
    );

    if ($updated_count !== null) {
        // Output or use the updated views_count as needed
        $data ="{\"count\": $updated_count}";
    
} 
    

	wp_send_json_success($data);





    wp_die(); // Always use wp_die() at the end of your AJAX callback function
}
}
add_action('wp_ajax_wl_ajax_gifts_counter', 'wl_ajax_giftsActionCounter');
add_action('wp_ajax_nopriv_wl_ajax_gifts_counter', 'wl_ajax_giftsActionCounter'); 


function wl_ajax_add_to_event() {
    // Your AJAX logic goes here
    // You can retrieve data from $_POST array

   $data   = $_POST['data'];
   //$giftid =$data['giftid'];
   //$events = $data['events'];  


   global $wpdb;
   $table_name = $wpdb->prefix . 'event_gifts';  
   // Specify the condition for deleting rows
   if ($data['delete']==1){
 
	$where_condition = array('gift_id' => $data['giftid']);
	// Format the where condition
	$where_format = array('%d' );// Use '%d' for integers, '%f' for floats, '%s' for strings
	// Delete rows from the custom table
	$wpdb->delete($table_name, $where_condition, $where_format);
}
//Print_r($_POST['eventid']);
   if (isset( $data['events'])) {
	$returnHtml ='';
       // Loop through each selected fruit
       foreach ( $data['events'] as $eventID) {
		
           $data_to_insert = array(
               'event_id' => $eventID,
               'gift_id' =>  $data['giftid'],
                'user_id' => get_current_user_id(),
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
           

		   $events_table = $wpdb->prefix . 'events';  
   		   // Specify the condition for deleting rows
   		   			
			$eventinfo = $wpdb->get_row("SELECT * FROM $events_table WHERE id=" .$eventID);

		   $returnHtml = $returnHtml .'<div class="bs-blog-category">
				<a href="'. home_url() .'/event?eid=' .$eventinfo->id .'" arget="_blank" class="blogus-categories category-color-1">'
			    . $eventinfo->title .
			'</a>
	</div>';
          
       }


	}
  
	
   echo $returnHtml;

   
	//wp_send_json_success($data);





    wp_die(); // Always use wp_die() at the end of your AJAX callback function
//}
}
add_action('wp_ajax_wl_add_to_event', 'wl_ajax_add_to_event');
add_action('wp_ajax_nopriv_wl_add_to_event', 'wl_ajax_add_to_event'); 

function wl_add_gift_to_event(){

    $data = $_POST['data'];
    global $wpdb;
   $table_name = $wpdb->prefix . 'event_gifts';  
	$data_to_insert = array(
		'event_id' =>  $data['eventid'],
		'gift_id' =>  $data['giftid'],
		 'user_id' => get_current_user_id(),
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


 if  ($wpdb->insert_id >0 ){
	wp_send_json_success( $wpdb->insert_id);
  }else{
	wp_send_json_error('Error inserting record');

	}
	wp_die();

}

add_action('wp_ajax_wl_add_gift_to_event', 'wl_add_gift_to_event');
add_action('wp_ajax_nopriv_wl_add_gift_to_event', 'wl_add_gift_to_event'); 


function wl_remove_gift_from_event(){

    $data = $_POST['data'];
    global $wpdb;
   $table_name = $wpdb->prefix . 'event_gifts'; 
   
   $where_condition = array(
	'gift_id' => $data['giftid'],
	'event_id' =>  $data['eventid'] ,
	'user_id' => get_current_user_id()
	);
	// Format the where condition
	$where_format = array('%d','%d','%d' );// Use '%d' for integers, '%f' for floats, '%s' for strings
	// Delete rows from the custom table
	$deleted_rows= $wpdb->delete($table_name, $where_condition, $where_format);


	if ( $deleted_rows === false ) {
		// Delete operation failed
		
		wp_send_json_error("Error deleting records.");
	} else {
		// Delete operation successful
		
		wp_send_json_success("Successfully deleted {$deleted_rows} row(s).");
	}
	wp_die();

}

add_action('wp_ajax_wl_remove_gift_from_event', 'wl_remove_gift_from_event');
add_action('wp_ajax_nopriv_wl_remove_gift_from_event', 'wl_remove_gift_from_event'); 




function wl_ajax_remove_from_event() {
    // Your AJAX logic goes here
    // You can retrieve data from $_POST array

   $data   = $_POST['data'];
   //$giftid =$data['giftid'];
   //$events = $data['events'];  


   global $wpdb;
   $table_name = $wpdb->prefix . 'event_gifts';  
   // Specify the condition for deleting rows
   
 
	$where_condition = array(
		'gift_id' => $data['giftid'],
    	'event_id' => $data['events'][0]
	);
	// Format the where condition
	$where_format = array('%d','%d' );// Use '%d' for integers, '%f' for floats, '%s' for strings
	// Delete rows from the custom table

	//print_r($where_condition);
	$wpdb->delete($table_name, $where_condition, $where_format);


  
	
   //echo $returnHtml;

   
	//wp_send_json_success($data);





    wp_die(); // Always use wp_die() at the end of your AJAX callback function
//}
}
add_action('wp_ajax_wl_remove_from_event'       , 'wl_ajax_remove_from_event');
add_action('wp_ajax_nopriv_wl_remove_from_event', 'wl_ajax_remove_from_event'); 


function wl_ajax_update_event() {
	
	
	$data   = $_POST['data'];
   
    global $wpdb;
    $table_name = $wpdb->prefix . 'events'; 
    $where_condition = array(		
    	'id' => $data['event']
	);
	// Format the where condition
	$where_format = array('%d' );// Use '%d' for integers, '%f' for floats, '%s' for strings

	$updateData = array(
		'title' => $data['title'],
		'start_date' => $data['start_date'],
		'end_date' => $data['end_date'],
		'description' => $data['description'],
		'location_name' => $data['location_name'],
		'location_url' => $data['location_url'],
		'location_address' => $data['location_address'],
		'location_map' => $data['location_map']
		
	);


	$wpdb->update( $table_name, $updateData, $where_condition );
}
add_action('wp_ajax_wl_update_event'       , 'wl_ajax_update_event');
add_action('wp_ajax_nopriv_wl_update_event', 'wl_ajax_update_event'); 



// Register AJAX action for handling file upload
add_action('wp_ajax_handle_file_upload', 'handle_file_upload');
add_action('wp_ajax_nopriv_handle_file_upload', 'handle_file_upload'); // Allow non-logged-in users

function handle_file_upload() {
    // Check if file was uploaded
    if(isset($_FILES['newImageInput'])) {
        $file = $_FILES['newImageInput'];
        
        // Check for errors
        if ($file['error'] !== UPLOAD_ERR_OK) {
            wp_send_json_error('Error uploading file');
        }
        
        // Move uploaded file to desired directory
		$parts = explode('.', basename($file['name']));
		$nn = end($parts);
		$file_ext = strtolower($nn);
		$filename = uniqid('event_') . '.' . $file_ext;
        $upload_dir = plugin_dir_path( __FILE__ ) . '/assets/images/events/';
        $file_path = $upload_dir . '/' . $filename;        
        if(move_uploaded_file($file['tmp_name'], $file_path)) {
			if (isset( $_POST['event_id'])){
				global $wpdb; 
				$table_name = $wpdb->prefix . 'events'; 
				$where_condition = array('id' =>$_POST['event_id']);
				$updateData = array('event_image' => $filename);
				$wpdb->update($table_name, $updateData, $where_condition);             
			 }
            wp_send_json_success('File uploaded successfully');			
			
       } else {
            wp_send_json_error('Error moving file to destination');
       }

    } else {
        wp_send_json_error('No file uploaded');
    }
}

function wl_ajax_save_event() {

	
	$event_title = sanitize_text_field($_POST['event_title']);
	$event_description= sanitize_text_field($_POST['event_description']);               
	$event_address_name = sanitize_text_field($_POST['event_address_name']);
	$event_address_url= sanitize_text_field($_POST['event_address_url']);
	$event_location = sanitize_text_field($_POST['event_location']);
	$event_address = sanitize_text_field($_POST['event_address']);
	$start_datetime = sanitize_text_field($_POST['start_datetime']);
	$end_datetime = sanitize_text_field($_POST['end_datetime']); 
	$imageDisplaytext= sanitize_text_field($_POST['imageDisplaytext']); 

    


	if(isset($_FILES['event_image'])) {

		if ($imageDisplaytext !=""){$filename =$imageDisplaytext;} else{

        $file = $_FILES['event_image'];
        
        // Check for errors
        if ($file['error'] !== UPLOAD_ERR_OK) {
            wp_send_json_error('Error uploading file');
        }
        
        // Move uploaded file to desired directory
		$parts = explode('.', basename($file['name']));
		$nn = end($parts);
		$file_ext = strtolower($nn);
		$filename = uniqid('event_') . '.' . $file_ext;

       


        $upload_dir = plugin_dir_path( __FILE__ ) . '/assets/images/events/';
        $file_path = $upload_dir . '/' . $filename;




		if(move_uploaded_file($file['tmp_name'], $file_path)) {
						
			
       } else {
            wp_send_json_error('Error moving file to destination');
       }
	}
       $data = array(
		'user_id' => get_current_user_id(),
		'title' => $event_title,
		'start_date' => $start_datetime,
		'end_date' => $end_datetime,
		'description' =>$event_description,
		'location_name' => $event_address_name,
		'location_address' => $event_address,
		'location_url' => $event_address_url,
		'location_map' => $event_location,                    
		'event_image' => $filename
	);
	global $wpdb;			
	$wpdb->insert( $wpdb->prefix . 'events', $data );                
	$newEventID = $wpdb->insert_id ; 

	
	wp_send_json_success($newEventID);


    } else {
        wp_send_json_error('No file uploaded');
    }	
wp_die(); // Always use wp_die() at the end of your AJAX callback function
    

	
}

// Register AJAX action for handling file upload
add_action('wp_ajax_wl_ajax_save_event', 'wl_ajax_save_event');
add_action('wp_ajax_nopriv_wl_ajax_save_event', 'wl_ajax_save_event'); // Allow non-logged-in users

function wl_add_to_gifts() {

	$product   = $_POST['data'];
	
    


    $current_user_id = get_current_user_id();
        
   // if ($current_user_id) {
           
		//print_r($data['productData']);
	    //$data1 = json_decode($data['productData'], true);

		 //echo $data['title'];
		 //echo $data['description'].'</br>';
		 //echo $data['product_id'].'</br>';
		 //echo $data['image_url'];
		 //echo $product['product_url'];
		  
		//echo 'Product Title: '. $data['productData']['title'] . '<br>';  
//
            global $wpdb;
           $table_name = $wpdb->prefix . 'gifts';        
    
            $data = array(
                'user_id' => get_current_user_id(),
                'title' => sanitize_text_field($product['title']),
                'description' => sanitize_text_field($product['description']),
                'url' =>   $product['product_url'],
                'img_url' => $product['image_url'],
				'product_id' => $product['product_id']
            );
            $wpdb->insert( $table_name, $data );
	//	}

		//echo 'xxxxxxxxxxxxxxxxxxx done xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx';
		//print_r( $data) ;
		//echo '</pre>';
		wp_die(); 
   
}


add_action('wp_ajax_wl_add_to_gifts', 'wl_add_to_gifts');
add_action('wp_ajax_nopriv_wl_add_to_gifts', 'wl_add_to_gifts'); // Allow non-logged-in users

function wl_ajax_add_gift_url(){
	
	$data = $_POST['data'];
	try{    
        $web = new \Spekulatius\PHPScraper\PHPScraper;
        $web->go($data["url"]);
        $noOfTries=50;
        $maxNoOfImages =50;
        $tempImages =$web->images;
        $images=array();
        
		$xcount=0;
        foreach ($tempImages as $img) {  
			if ($xcount<= $noOfTries){
            if (!is_null($img) ){    
                $jpgPos = strpos(strtoupper($img), strtoupper('.jpg'));
                if  ($jpgPos){
					//if (isValidImage($img)) {               
                    array_push($images,$img);
				//	}
                }
            } 
		}  
			$xcount++;     
        }

        $noOfTries     = min($noOfTries,count($images)-1);
        $maxNoOfImages = min($maxNoOfImages,count($images)-1);
        $paragraph =$web->paragraphs;
        $productTitle ='';
        $hh=count($web->h1);
        for ($v = 0; $v < $hh; ++$v) { 
            if (strlen(trim($web->h1[$v]))>3){
                $productTitle =$web->h1[$v];
                break;
            }
           
        }


		$jsonData = array(
			'title' =>  trim($productTitle),
			'images' => $images
			
		);


        wp_send_json_success($jsonData);
        }



    catch(\Throwable $e){
       wp_send_json_error('Error');
        }
    



				
			

	
	wp_die(); 
   
}

add_action('wp_ajax_wl_ajax_add_gift_url', 'wl_ajax_add_gift_url');
add_action('wp_ajax_nopriv_wl_ajax_add_gift_url', 'wl_ajax_add_gift_url'); // Allow non-logged-in users


function wl_ajax_save_gift_url(){

	$data = $_POST['data'];
    $current_user_id = get_current_user_id();        
    if ($current_user_id) {            
		global $wpdb;
        $table_name = $wpdb->prefix . 'gifts';         
        $giftData = array(
			'user_id' => get_current_user_id(),
			'title' => sanitize_text_field($data["title"]),
			'description' => sanitize_text_field($data["description"]),
			'url' => $data["url"],
			'img_url' => $data["img_url"],
			'product_id' => 0
        );         
        $wpdb->insert($table_name,$giftData);
    } 
    else {
		wp_send_json_error()('Please login');
		wp_die();
    }

    

$column_name = 'id';
$value = $wpdb->insert_id;
$query = $wpdb->prepare("SELECT * FROM $table_name WHERE $column_name = %s", $value);
$record = $wpdb->get_row($query);
if ($record) {   
	$queryData = array(
		'id'=>  $record->id,
		'title' =>  $record->title,
		'url' => $record->url,
		'description' => $record->description,
		'img_url' => $record->img_url		
	);   
    
} else {
    $queryData= array(
		'title' =>  '',
		'url' => ''
		
	);
}


	wp_send_json_success($queryData);
	wp_die();
}

add_action('wp_ajax_wl_ajax_save_gift_url', 'wl_ajax_save_gift_url');
add_action('wp_ajax_nopriv_wl_ajax_save_gift_url', 'wl_ajax_save_gift_url'); // Allow non-logged-in users

function wl_ajax_addto_event_url(){
	global $wpdb;
	$imagepath= 'ddddddddd';
	$imagepath=plugin_dir_url( __FILE__, 2 ) ;
    $events_table     = $wpdb->prefix . 'events';
    $events_condition = " WHERE user_id = ".get_current_user_id() ." and is_active =1 and start_date >= NOW()";
    $events_query     = "SELECT * ,'$imagepath' as imgpath FROM $events_table $events_condition";
	
    $events_results   = $wpdb->get_results($events_query);
	wp_send_json_success( $events_results);
	wp_die();
}



add_action('wp_ajax_wl_ajax_addto_event_url', 'wl_ajax_addto_event_url');
add_action('wp_ajax_nopriv_wl_ajax_addto_event_url', 'wl_ajax_addto_event_url');


// Add a filter to modify the post title
function hide_post_title($title, $id) {
    // Check if it's the post you want to hide the title for
	global $wpdb;
//echo $_GET(eid);

    if (is_single($id) || is_page($id)) {
		if ($title==="Event"){
 			// Return an empty title
			//echo  $title ;
			//echo  $id ;
			$eventid = isset($_GET['eid']) ? intval($_GET['eid']) : 1;
			$result = $wpdb->get_results ( "
    		SELECT title
    		FROM   ".$wpdb->prefix ."events
        		WHERE id =".  $eventid 
				 );

			foreach ( $result as $page )
			{
				
        		//return $page->title;
			}
			return '';
			
		}
       
    }
    
    // If it's not the post you want to hide the title for, return the original title
    return $title;
}

// Hook into the_title filter
add_filter('the_title', 'hide_post_title', 10, 2);









add_filter( 'single_template', 'override_single_template' );

function override_single_template( $single_template ){
	//echo $single_template;
    global $post;
    $file = dirname(__FILE__) .'\templates\single-'. $post->post_type .'.php';    
    if( file_exists( $file ) ) $single_template = $file;
	//echo $single_template;
    return $single_template;
}


function use_custom_template($tpl){
	global $taxonomy;
	if ( $taxonomy== 'event'  ) {		
		//echo '<pre>';
		//print_r($taxonomy);
		//echo '</pre>';
	  $tpl  = dirname(__FILE__) .'\templates\single-event.php';    
	}
	return $tpl;
  }
  
  add_filter( 'archive_template', 'use_custom_template' ) ;

add_action( 'init',  'add_button' );

 function add_button() {
			add_button_for_single();
			//$this->add_button_for_loop();

			// Add the link "Add to wishlist" for Gutenberg blocks.
			//add_filter( 'woocommerce_blocks_product_grid_item_html', 'add_button_for_blocks_product_grid_item' );
		}





 function add_button_for_single() {
			// Add the link "Add to wishlist".
		//	$position = get_option( 'yith_wcwl_button_position', 'add-to-cart' );
//echo $position;
			/**
			 * APPLY_FILTERS: yith_wcwl_positions
			 *
			 * Filter the array of positions where to display the 'Add to wishlist' button in the product page.
			 *
			 * @param array $positions Array of positions
			 *
			 * @return array
			 */
			

			///if ( yith_plugin_fw_wc_is_using_block_template_in_single_product() ) {
			//	$this->add_button_for_blockified_template( 'single-product', $position );
		//	} else {
				add_action( 'woocommerce_single_product_summary', 'print_button' , 31 );
			//}
		}

function print_button(){

//echo'[wl_add_to_wish_list]';
echo do_shortcode( '[wl_add_to_wish_list]' ); //nad
}


		



add_action( 'woocommerce_before_main_content', 'nader1', 20, 0 );
add_action( 'woocommerce_sidebar', 'nader3', 10 );
add_action( 'woocommerce_before_single_product', 'nader4', 10 );
add_action( 'woocommerce_before_single_product_summary', 'nader2', 20, 0 );
add_action( 'woocommerce_before_add_to_cart_button', 'nader3', 20 );



function nader1(){
	global $product;
	$id = $product->get_id();
	//echo "<div>1111111111111111111111</div>";

}

function nader2(){
	//global $product;
	//$id = $product->get_id();
	//echo "<div>222222222222222222222222</div>";

}

function nader3(){
	//global $product;
	//$id = $product->get_id();
    echo "<div>33333333333333333333333333333</div>";

}

function nader4(){
	global $product;
	$id = $product->get_id();
	//5435echo "<div>4444444444444444444</div>".$id;

}

function isValidImage($strPath){    
    $ret=true;   
    $findme = array("jpg");   
        foreach ($findme as $ext){ 
            if (!is_null($strPath) ){    
         $pos = strpos(strtoupper($strPath), strtoupper('.'.$ext));   
            if  ($pos){
            $nsize= getimagesize($strPath);       
            if ($nsize[0] >100 ){
                $ret=true;
            } 
        }  
        }
    }
    return $ret;  
    }


function add_gift_shortcode1(){
	
			ob_start();
		

		// include file located.
		
		
		include plugin_dir_path(__FILE__).'templates/add_to_wish_list.php';
		
			return ob_get_clean();
		
}
add_shortcode('wl_add_to_wish_list', 'add_gift_shortcode1');



function add_gift_shortcode(){
	if ( class_exists( 'Inc\Base\\Gift' ) ) {    
		$giftManager = new Gift();
		return $giftManager->add();
	}
}
add_shortcode('wl_addGift', 'add_gift_shortcode');






function list_gifts_shortcode(){
    if ( class_exists( 'Inc\Base\\Gift' ) ) {    
		$giftManager = new Gift();
		return $giftManager->viewList();
	}
}
add_shortcode('wl_listGifts', 'list_gifts_shortcode');


function list_events_shortcode(){
	if ( class_exists( 'Inc\Base\\Event' ) ) {    
	$eventManager = new Event();
	return $eventManager->viewList();
	}	
}
add_shortcode('wl_listEvents', 'list_events_shortcode');



function addEvent_shortcode(){
	if ( class_exists( 'Inc\Base\\Event' ) ) {		
		$eventManager = new Event();
		return $eventManager->add();
    }
}
add_shortcode('wl_addEvent', 'addEvent_shortcode');


function event_shortcode(){

    if ( class_exists( 'Inc\Base\\Event' ) ) {		
		$eventManager = new Event();
		return $eventManager->view();
    }
}
add_shortcode('wl_event', 'event_shortcode');


function event2_shortcode(){

    if ( class_exists( 'Inc\Base\\Event' ) ) {		
		$eventManager = new Event();
		return $eventManager->view2();
    }
}
add_shortcode('wl_event2', 'event2_shortcode');








/**
 * The code that runs during plugin activation
 */
function activate_wl_plugin() {
	Inc\Base\Activate::activate();
}
register_activation_hook( __FILE__, 'activate_wl_plugin' );

/**
 * The code that runs during plugin deactivation
 */
function deactivate_wl_plugin() {
	Inc\Base\Deactivate::deactivate();
}
register_deactivation_hook( __FILE__, 'deactivate_wl_plugin' );

/**
 * Initialize all the core classes of the plugin
 */
if ( class_exists( 'Inc\\Init' ) ) {
	Inc\Init::register_services();
	
}
