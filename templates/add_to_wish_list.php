<?php
/**
 * Template variables:
 *
 * @var $base_url string Current page url
 * @var $wishlist_url              string Url to wishlist page
 * @var $exists                    bool Whether current product is already in wishlist
 * @var $show_exists               bool Whether to show already in wishlist link on multi wishlist
 * @var $show_count                bool Whether to show count of times item was added to wishlist
 * @var $product_id                int Current product id
 * @var $parent_product_id         int Parent for current product
 * @var $product_type              string Current product type
 * @var $label                     string Button label
 * @var $browse_wishlist_text      string Browse wishlist text
 * @var $already_in_wishslist_text string Already in wishlist text
 * @var $product_added_text        string Product added text
 * @var $icon                      string Icon for Add to Wishlist button
 * @var $link_classes              string Classed for Add to Wishlist button
 * @var $available_multi_wishlist  bool Whether add to wishlist is available or not
 * @var $disable_wishlist          bool Whether wishlist is disabled or not
 * @var $template_part             string Template part
 * @var $container_classes         string Container classes
 */

 

global $product;

//echo '<pre>';
//echo  print_r($product);
//echo '</pre>';
$product_id = $product->get_id();
$product_title=  sanitize_text_field($product->get_title());
$product_description = sanitize_text_field($product->get_description());
$image_url = wp_get_attachment_image_url(get_post_thumbnail_id( $product_id ), 'full' );
//$product_url=home_url( $_SERVER['REQUEST_URI'] );
$product_url =get_permalink();
//$product_url=esc_url($current_url);


//echo '<pre>';
//print_r($product);
//echo '</pre>';
// Output the image
//echo '<img src="' . esc_url( $image_url ) . '" alt="' . esc_attr( get_the_title( $product_id ) ) . '">';

?>

<div class="yith-wcwl-add-button">
	<?php
	/**
	 * APPLY_FILTERS: yith_wcwl_add_to_wishlist_title
	 *
	 * Filter the 'Add to wishlist' label.
	 *
	 * @param string $label Label
	 *
	 * @return string
	 */
	?>
  
	
  <?php 
    // FIXME  - login by google should redirect to the same single product page"   
    if ( is_user_logged_in() ) {
      // User is logged in
      $buttonTitle = 'Add to my Gifts';
      $buttonOnClickFunction = 'add_to_gifts();';
    } else {
      // User is not logged in
      $buttonTitle = 'PLease login to add it to your wishlist';
      $buttonOnClickFunction = 'login_in_first();';
    }
  ?>





  <button
		href="#"
		class="<?php echo "add_to_wishlist single_add_to_wishlist"; ?>"
		data-product-id="<?php echo esc_attr( $product_id ); ?>"
		data-product-type="<?php echo esc_attr( $product_type ); ?>"
		data-original-product-id="<?php echo esc_attr( $parent_product_id ); ?>"
		data-title="<?php echo "esc_attr( apply_filters( 'yith_wcwl_add_to_wishlist_title', $label ) )"; ?>"
		rel="nofollow"
        onclick="<?php echo $buttonOnClickFunction;?>"
	>
		
    <i class="yith-wcwl-icon fa fa-heart-o"></i>
		<span><?php echo  $buttonTitle; ?></span>
	</button>
</div>


<script>


function login_in_first(){  
  window.location.replace("http://"+window.location.hostname+"/my-account/?redirect_to=<?php echo get_permalink();?>");
}


function add_to_gifts(){
       // var strDivName= 'EventsofGift' + giftid;
        
       
       //var productData = '{"title":"<?php echo $product_title ?>","price":10,"sku":"ABC123","description":"This is a sample product."}';    


    passed_data={
        "title":"<?php echo $product_title; ?>",
        "description":"<?php echo $product_description; ?>",
        "product_id" :<?php echo $product_id; ?>,
        "image_url" :  "<?php echo  $image_url;?>" ,
        "product_url":  "<?php echo  $product_url;?>" 
    };


        jQuery.ajax({
        type: "post",
        url: '<?php echo  get_site_url();?>/wp-admin/admin-ajax.php',
      //  url: `${window.location.origin}/wordpress/wp-admin/admin-ajax.php`,
        data: {
          action: "wl_add_to_gifts",  // the action to fire in the server
          data: passed_data,         // any JS object
        },
        complete: function (response) {
            console.log(response.responseText);
          // alert(response.responseText)           
            //var newHTML = response.responseText;    
            //  alert(newHTML);
            //alert(enventid_array[0]);
            // Append HTML content to the div
            //  myDiv.innerHTML ='<button onclick="remove_from_event('+ giftid +','+ eventid+')">Remove</button>';
            
        },
    });

    
  }

</script>
