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

        //global $term;
        global $wp_query;
        $current_term = $wp_query->get_queried_object();
        $date_format  = get_option('date_format');   
        $time_format  = get_option('time_format');
        $meta_value   = get_term_meta( $current_term->term_id, 'event_date', true );
        $formatted_date = date($date_format, strtotime($meta_value));

        $formatted_time = date($time_format, strtotime($meta_value));


// Check if the meta value exists
if ( ! empty( $formatted_date ) ) {
    // Do something with the meta value
    $content = '<div>'. $formatted_date .'<br>'. $formatted_time .'</div>';
} else {
    // Meta value doesn't exist or is empty
    $content =  'Meta Value not found';
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
