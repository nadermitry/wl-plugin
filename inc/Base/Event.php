<?php
/**
 * @package   wlPlugin
*/

namespace Inc\Base;
use Inc\Base\BaseController;

class Event extends BaseController {  

    public $table_name;
    public $db;
    public $dbPrefix;
    public $eventid;
    public $current_user;

    public function __construct() {
        parent::__construct();
        global $wpdb;  
        $this->db = $wpdb;   
        $this->dbPrefix = $wpdb->prefix ;
        $this->table_name =  $this->dbPrefix . 'events';        
        $this->eventid = isset($_GET['eid']) ? intval($_GET['eid']) : 1;
        $this->current_user =  wp_get_current_user();        
    }

    public  function add() {        
        ob_start();       
        if(isset($_POST['submit'])) {            
            if (!isset($_GET["success"])) {                
                $event_title = sanitize_text_field($_POST['event_title']);
                $event_description= sanitize_text_field($_POST['event_description']);               
                $event_address_name = sanitize_text_field($_POST['event_address_name']);
                $event_address_url= sanitize_text_field($_POST['event_address_url']);
                $event_location = sanitize_text_field($_POST['event_location']);
                $event_address = sanitize_text_field($_POST['event_address']);
                $start_datetime = sanitize_text_field($_POST['start_datetime']);
                $end_datetime = sanitize_text_field($_POST['end_datetime']);                
              
                $parts = explode('.', $_FILES['event_image']['name']);
                $nn = end($parts);
                $file_ext = strtolower($nn);
                $filename = uniqid('event_') . '.' . $file_ext;
                $upload_file = $this->plugin_path . 'assets/images/events/' . $filename;
                move_uploaded_file($_FILES['event_image']['tmp_name'], $upload_file);
                               
                $data = array(
                    'user_id' => $this->current_user->ID,
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
        
                $this->db->insert( $this->table_name, $data );                
                $new_url = add_query_arg( 'success',$this->db->insert_id , get_permalink());                
                echo("<script>location.href = '".$new_url."'</script>");
               
            }        
        }
        
        if (!isset($_POST["event_title"])) {   
            if (!isset($_GET["success"])) {                
                if (file_exists( dirname( __FILE__,3 ) . '/templates/event/newEventForm.php')) {
                    require_once dirname( __FILE__,3 ) . '/templates/event/newEventForm.php';
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
        $items_per_page = 3;      
        $current_page = max(1, get_query_var('paged'));
        $offset = ($current_page - 1) * $items_per_page; 

        $additional_condition = " WHERE user_id = ". $this->current_user->ID ;        
        $query = $this->db->prepare("SELECT * FROM $this->table_name $additional_condition LIMIT %d, %d", $offset, $items_per_page);        
        $results = $this->db->get_results($query);
        $total_items =$this->db->get_var("SELECT COUNT(*) FROM $this->table_name $additional_condition");

        $pagination = paginate_links(array(
            'base' => esc_url(add_query_arg('paged', '%#%')),
            'format' => '?paged=%#%',
            'current' => $current_page,
            'total' => ceil($total_items / $items_per_page),
            'prev_text' => __('Previous'),
            'next_text' => __('Next'),
        
        ));
        wp_enqueue_style(
            'evnt-list-pagination-style', // Unique handle for the style
            $this->plugin_url . 'assets/css/pagination.css', // Path to the stylesheet file
            array(), // Dependencies (optional)
            '1.0' // Style version (optional)
        );
        $eventListTemplate ='list_events1.php';

        ob_start();	        
        if (file_exists( dirname( __FILE__,3 ) . '/templates/event/'.$eventListTemplate)) {
            require_once dirname( __FILE__,3 ) . '/templates/event/'.$eventListTemplate;
        }
        $output_string = ob_get_contents();
        ob_end_clean();
        return $output_string;
    }


    public function view(){

        $additional_condition = " WHERE id =  $this->eventid ";
        $query = "SELECT * FROM $this->table_name $additional_condition LIMIT 1";
        $result = $this->db->get_row($query);
       
        $currentURL = home_url( add_query_arg( NULL, NULL ));       
        $isCurrentUser = ($result->user_id == $this->current_user->ID);
       
        $image_path = get_user_meta($this->current_user->ID, 'wp_user_avatars', true);

        
        if (isset( $image_path['full'])) {
            $full_url = $image_path['full']; // The full URL 
        }else{
            $full_url = '';
        }
        
        $gifts     = $this->gifts( $this->eventid);
        $newgifts  = $this->gifts($this->eventid,true);       
       
        ob_start();	
        if (file_exists( dirname( __FILE__,3 ) . '/templates/event/event.php')) {
            require_once dirname( __FILE__,3 ) . '/templates/event/event.php';
        }  

        $output_string = ob_get_contents();
        ob_end_clean();
        return $output_string;
    }

    public function gifts(int $eventId ,bool $new = false){
       
        if (!$new ){
            $event_gifts_table = $this->dbPrefix . 'event_gifts_vw';          
            $where_condition = ' where event_id =' .$eventId ;
            
            $gifts     = $this->db->get_results("select * from  $event_gifts_table $where_condition");
        }else{

            $event_gifts_table = $this->dbPrefix . 'gifts';  
            
            $where_condition = ' and user_id = '. $this->current_user_id;
            
            $gifts     = $this->db->get_results("SELECT *
            FROM  $this->dbPrefix"."gifts
            WHERE NOT EXISTS (
                SELECT 1
                FROM  $this->dbPrefix"."event_gifts
                WHERE  $this->dbPrefix" . "event_gifts.event_Id =$eventId and  ". $this->dbPrefix ."event_gifts.gift_id =  $this->dbPrefix". "gifts.id
            ) ".  $where_condition);

        }
        return $gifts;
    }


    


}