<?php 
/**
 * @package   wlPlugin
 */
namespace Inc\Base;

class BaseController
{
	public $plugin_path;

	public $plugin_url;

	public $plugin;

	public $current_user_id;

	public function __construct() {
		$this->plugin_path = plugin_dir_path( dirname( __FILE__, 2 ) );
		$this->plugin_url = plugin_dir_url( dirname( __FILE__, 2 ) );
		$this->plugin = plugin_basename( dirname( __FILE__, 3 ) ) . '/wl-plugin.php';
		$this->current_user_id = get_current_user_id();
	}

	public function trim_and_add_dots($text,$len) {
        // Check if the length of the string is greater than 30 characters
        if (strlen($text) > $len) {
            // Trim the string to 30 characters
            $trimmed_text = substr($text, 0, $len);
            // Add three dots at the end
            $trimmed_text .= '...';
            return $trimmed_text;
        } else {
            // If the string is already 30 characters or less, return the original string
            return $text;
        }
    }


    public function formatDate($date){

        $dateString = $date; // Example DateTime string

        // Create a DateTime object from the string
        $dateTime = new \DateTime($dateString);
        
        // Extract date and time
        $date = $dateTime->format('d-M-Y'); // Date in 'YYYY-MM-DD' format
        $time = $dateTime->format('h:i A'); // Time in 'HH:MM:SS' format
        return  $date . ' at '.  $time;
 
    }



    
}