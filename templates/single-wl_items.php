<?php
/**
 * Template canvas file to render the current 'wp_template'.
 *
 * @package WordPress
 */

/*
 * Get the template HTML.
 * This needs to run before <head> so that blocks can add scripts and styles in wp_head().
 */

 function my_the_content_filter( $content ) {
    // maybe limit to archive or single cpt display?

        global $post;

        
		if ($post->post_type =='wl_items'){

			
		
        $meta = get_post_meta( $post->ID);
        if( false === $meta ){
           //return $content . $meta->url[0];
        }
		else{        
        
        $url= '<a target="_blank" href="'. $meta['url'][0].'">Link</a>';

         $parsed_url = parse_url($meta['url'][0]);
        
        $vendor="";
        if ($parsed_url && isset($parsed_url['host'])) {
            $host = $parsed_url['host'];           
            // Remove 'www.' from the beginning of the host name
            $host = preg_replace('/^www\./', '', $host);        
            // Extract the domain name without the TLD
            $parts = explode('.', $host);
            $domain = $parts[0];        
            $vendor= $domain;
        } 

        $img='<img src="'. $meta['img_url'][0].'">';
       // $content = $content . $url ."<br>";
       // $content = $content . $vendor ."<br>";
        //$content = $content . $img; 

        $content ='<div class="container">
        <div class="row mt-5">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                   <a target ="_blank" href="'.$meta['url'][0].'"> <img width="25%" src="'. $meta['img_url'][0].'" class="card-img-top" alt="Product Image"></a>
                    <div class="card-body">
                        <h5 class="card-title">'.'Card title'.'</h5>                        
                        <p class="card-text"><small class="text-muted">'.$vendor.'</small></p>
                    </div>
                </div>
            </div>
        </div>
        </div>';
              
		}
    }
    return $content;
}
add_filter( 'the_content', 'my_the_content_filter' );




$template_html = get_the_block_template_html();
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php 
wp_body_open(); 
?>
<?php echo $template_html; ?>

<?php wp_footer(); ?>
</body>
</html>
