<?php
/**
 * @package  AlecadddPlugin
 */

namespace Inc\Base;
use Inc\Base\BaseController;

class Gift extends BaseController {
 // Constructor
    

 public function __construct() {
        parent::__construct();
    }

public  function add() {
    ob_start();	
    if (file_exists( dirname( __FILE__,3 ) . '\templates\gift\addGiftForm.php')) {
        require_once dirname( __FILE__,3 ) . '\templates\gift\addGiftForm.php';
    } 
    $output_string = ob_get_contents();
    ob_end_clean();
    return $output_string;
} 

    public function viewList(){

        ob_start();	
        if (file_exists( dirname( __FILE__,3 ) . '\templates\gift\list_gifts.php')) {
            require_once dirname( __FILE__,3 ) . '\templates\gift\list_gifts.php';
        }         	
        $output_string = ob_get_contents();
        ob_end_clean();
        return $output_string;        
    }



    public function get_vendor($par_url) {

        $parsed_url = parse_url($par_url);
        if ($parsed_url && isset($parsed_url['host'])) {
            $host = $parsed_url['host'];           
            // Remove 'www.' from the beginning of the host name
            $host = preg_replace('/^www\./', '', $host);        
            // Extract the domain name without the TLD
            $parts = explode('.', $host);
            $domain = $parts[0];        
            return $domain;
        } 
        }





    public function eventsSelector($giftId) {

        global $wpdb;

        $events_table     = $wpdb->prefix . 'events';
        $events_condition = " WHERE user_id = $this->current_user_id and is_active =1 and start_date >= NOW()";
        $events_query     = "SELECT * FROM $events_table $events_condition";
        $events_results   = $wpdb->get_results($events_query);

        $events_gifts_table     = $wpdb->prefix . 'event_gifts';
        $events_gifts_condition = " WHERE user_id = $this->current_user_id and is_active =1 and gift_id = $giftId ";
        $events_gifts_query     = "SELECT event_id FROM $events_gifts_table $events_gifts_condition";
        $events_gifts_results   = $wpdb->get_results($events_gifts_query);
        
        $aa=array();
        foreach ($events_gifts_results as $events_gifts_result) {
            array_push($aa, $events_gifts_result->event_id);          
        }       
        
        $html = ' 
        
        <script>
        
        function count_actions( pgiftid, peventid,  ptype,purl){
            passed_data={"giftid":pgiftid,"eventid":peventid,"type":ptype};  
        jQuery.ajax({
            type: "post",
            url: `${window.location.origin}/wordpress/wp-admin/admin-ajax.php`,
            data: {
              action: "wl_ajax_gifts_counter",  // the action to fire in the server
              data: passed_data,         // any JS object
            },
            complete: function (response) {
                console.log(JSON.parse(response.responseText).data);                
                window.open(purl, "_blank");

            },
        });
    }

    function add_to_event(giftid){
        var strDivName= \'EventsofGift\' + giftid;
        var myDiv = document.getElementById(strDivName);
        myDiv.innerHTML = myDiv.innerHTML + "<img width=\'200px\' src='.$this->plugin_url.'assets/images/loading_icon.gif\'>";
        var checkboxValues = [];
        var checkboxes = document.querySelectorAll(\'input[type="checkbox"]\');

        // Loop through each checkbox
        checkboxes.forEach(function(checkbox) {
        // Check if the checkbox is checked    
        if (checkbox.id==giftid+\'_\'+checkbox.value) {     
            if (checkbox.checked) {              
                checkboxValues.push(checkbox.value);
            }
        }
    });

    passed_data={"giftid":giftid,"events":checkboxValues};
    
    
     //alert('. '\''.$this->plugin_url.'assets/images/loading_icon.gif\');
     
    

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
             // Append HTML content to the div
             myDiv.innerHTML = newHTML;
            
        },
    });
}
    </script>
        
        
        
        
        
        <!-- Modal -->
        <div class="modal fade" id="eventsModal'.'-G'.$giftId.'" tabindex="-1" aria-labelledby="exampleModalLabel'.'G-'.$giftId.'" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Select Event</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <div class="modal-body">
                <!--  <form method="post" id="myForm'. $giftId .'">  -->            
                        <div class="form-group scrollable-container" style="max-height: 200px; overflow-y: auto;">';
                            foreach ($events_results as $events_result) { 
                                $checked = (in_array($events_result->id, $aa)) ? 'checked' : '';
                                $html =$html . 
                                '<div class="form-group form-check">
                                    
                                    <input ' .$checked .' type="checkbox" class="form-check-input" name="eventid[]"  value="'. $events_result->id .'"  id="'. $giftId. '_'. $events_result->id .'">
                                    <label class="form-check-label" for="exampleCheck1">'. $events_result->title.'</label>
                                </div>';
                            }

                            $html =$html .

                        '<input  type="hidden"  name="giftid"  value="'. $giftId .'"  id="giftid">
                        </div>
                        <button data-dismiss="modal" onclick ="add_to_event('. $giftId .');" 
                                class="btn btn-primary">Submit</button>
                        <!-- </form>-->  
                </div>
            </div>
            </div>
        </div>';     
    return $html;
    }
}