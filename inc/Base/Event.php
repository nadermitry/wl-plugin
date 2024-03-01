<?php
/**
 * @package  AlecadddPlugin
 */

namespace Inc\Base;
use Inc\Base\BaseController;

class Event extends BaseController {
 // Constructor
   

 
 public function __construct() {
        parent::__construct();
    }

    public  function add() {        
        ob_start();
        global $wpdb;	
        if(isset($_POST['submit'])) {            
            if (!isset($_GET["success"])) { 
                // Handle form submission
                $event_title = sanitize_text_field($_POST['event_title']);
                $event_description= sanitize_text_field($_POST['event_description']);               
                $event_address_name = sanitize_text_field($_POST['event_address_name']);
                $event_address_url= sanitize_text_field($_POST['event_address_url']);
                $event_location = sanitize_text_field($_POST['event_location']);
                $event_address = sanitize_text_field($_POST['event_address']);
                $start_datetime = sanitize_text_field($_POST['start_datetime']);
                $end_datetime = sanitize_text_field($_POST['end_datetime']);
                
               // $event_image = sanitize_text_field(basename($_FILES['event_image']['name']));
                // Handle file upload
                //$upload_dir = wp_upload_dir();
                //$upload_file = $upload_dir['path'] . '/' . basename($_FILES['event_image']['name']);
                $parts = explode('.', $_FILES['event_image']['name']);
                $nn = end($parts);
                $file_ext = strtolower($nn);
                $filename = uniqid('event_') . '.' . $file_ext;
                $upload_file = $this->plugin_path . 'assets/images/events/' . $filename;
                move_uploaded_file($_FILES['event_image']['tmp_name'], $upload_file);
                // }

                $table_name = $wpdb->prefix . 'events';
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
        
                $wpdb->insert( $table_name, $data );                
                $new_url = add_query_arg( 'success',$wpdb->insert_id , get_permalink());                
                echo("<script>location.href = '".$new_url."'</script>");
                //wp_redirect( $new_url, 303 );
            }        
        }
        
        if (!isset($_POST["event_title"])) {   
            if (!isset($_GET["success"])) {                
                if (file_exists( dirname( __FILE__,3 ) . '\templates\event\newEventForm.php')) {
                    require_once dirname( __FILE__,3 ) . '\templates\event\newEventForm.php';
                } 
            }
            else{
                echo "saved " .$_GET["success"];
            }
        }        
        $output_string = ob_get_contents();
	    ob_end_clean();
	    return $output_string;
    }

    public function viewList(){
        ob_start();	        
        if (file_exists( dirname( __FILE__,3 ) . '\templates\event\list_events.php')) {
            require_once dirname( __FILE__,3 ) . '\templates\event\list_events.php';
        }  
        $output_string = ob_get_contents();
        ob_end_clean();
        return $output_string;
    }


    public function view(){
        $eventid = isset($_GET['eid']) ? intval($_GET['eid']) : 1;
        $gifts     = $this->gifts($eventid);
        ob_start();	
        if (file_exists( dirname( __FILE__,3 ) . '\templates\event\event.php')) {
            require_once dirname( __FILE__,3 ) . '\templates\event\event.php';
        }  
        $output_string = ob_get_contents();
        ob_end_clean();
        return $output_string;
    }

    public function gifts(int $eventId){
        global $wpdb;	
        $event_gifts_table = $wpdb->prefix . 'event_gifts_vw';  
        // Specify the condition for deleting rows
        $where_condition = ' where event_id =' .$eventId;
        // Format the where condition
        //$where_format = array('%d' );// Use '%d' for integers, '%f' for floats, '%s' for strings
        $gifts     = $wpdb->get_results("select * from  $event_gifts_table $where_condition");
        return $gifts;
    }



}