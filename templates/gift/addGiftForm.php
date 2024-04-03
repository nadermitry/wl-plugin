<?php
    namespace Spekulatius\PHPScraper\Tests;
    defined( 'ABSPATH' ) or die( 'eRROR' );    

?>




<?php
    if (!isset($_POST["url"]) && !isset($_POST["title"])) 
    {   
        
     if (!isset($_GET["success"])){
        
        if ( file_exists( dirname( __FILE__,3 ) . '/templates/gift/urlForm.php' ) ) {
            require_once dirname( __FILE__,3 ) . '/templates/gift/urlForm.php';
        }  

        
    }
    else{
        echo "saved " .$_GET["success"];
    }
 } 
?>

<?php 
;
if (isset($_POST["url"]) && filter_var($_POST["url"], FILTER_VALIDATE_URL) && (!isset($_POST["title"]))) {
if ( file_exists( dirname( __FILE__,3 ) . '/templates/gift/newItemForm.php' ) ) {

    try{    
        $web = new \Spekulatius\PHPScraper\PHPScraper;
        $web->go($_POST["url"]);
        $noOfTries=10;
        $maxNoOfImages =50;
        $tempImages =$web->images;
        $images=array();

        foreach ($tempImages as $img) {    
            if (!is_null($img) ){    
                $jpgPos = strpos(strtoupper($img), strtoupper('.jpg'));
                if  ($jpgPos){                
                    array_push($images,$img);
                }
            }      
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
        
        }



    catch(\Throwable $e){
       // echo $e;
        }
            require_once dirname( __FILE__,3 ) . '/templates/gift/newItemForm.php';   
            
            


        }  
    }
    ?>

<?php if (isset($_POST["title"])){
        if (!isset($_GET["success"])){
        $current_user_id = get_current_user_id();
        
        if ($current_user_id) {
            
            global $wpdb;
            $table_name = $wpdb->prefix . 'gifts';
          /*
            $data = array(
                'user_id' => get_current_user_id(),
                'title' => sanitize_text_field($_POST["title"]),
                'description' => sanitize_text_field($_POST["description"]),
                'url' => sanitize_text_field($_POST["url"]),
                'img_url' => sanitize_text_field($_POST["imageUrl"])
            );
     */
            $data = array(
                'user_id' => get_current_user_id(),
                'title' => sanitize_text_field($_POST["title"]),
                'description' => sanitize_text_field($_POST["description"]),
                'url' => $_POST["url"],
                'img_url' => $_POST["imageUrl"],
                'product_id' => 0
            );

        
         //print_r($data);
            $wpdb->insert( $table_name, $data );
          //  echo 'Post inserted successfully. Post ID: ' . $wpdb->insert_id;
         
        } 
        else {
           // echo 'No user is currently logged in.';
            }
    } 
    $new_url = add_query_arg( 'success',$wpdb->insert_id , get_permalink() );
    //echo $new_url;
    //wp_redirect( $new_url, 303 );
    echo("<script>location.href = '".$new_url."'</script>");
   
}
?>




