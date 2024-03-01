<?php


$base_url = 'http://' . $_SERVER['HTTP_HOST'] .'/wordpress';
//echo $base_url;
//exit;
define('SHORTINIT', true); // Prevents loading unnecessary WordPress components
require_once $base_url.'/wp-load.php';





if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (isset($_POST['giftid'])) {
        
        //global $wpdb;
        $table_name = $wpdb->prefix . 'wp_event_gifts';  
        // Specify the condition for deleting rows
        $where_condition = array('giftid' => $_POST['giftid']);
        // Format the where condition
        $where_format = array('%d' );// Use '%d' for integers, '%f' for floats, '%s' for strings
        // Delete rows from the custom table
        $wpdb->delete($table_name, $where_condition, $where_format);

        if (isset($_POST['eventid'])) {
            // Loop through each selected fruit
            foreach ($_POST['eventid'] as $eventID) {
                $data_to_insert = array(
                    'eventid' => $eventID,
                    'giftid' => $_POST['giftid'],
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
        } else {
           // echo "No fruits selected";
        }
        
        
    } else {
       // echo "No gifts selected";
    }
    
    // Check if the fruit array is set
}
?>