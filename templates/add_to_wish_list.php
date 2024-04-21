<style>
/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgba(0,0,0,0.5); /* Black w/ opacity */
}


/* Loading Spinner */
.loader {
  border: 8px solid #f3f3f3; /* Light grey */
  border-top: 8px solid #3498db; /* Blue */
  border-radius: 50%;
  width: 50px;
  height: 50px;
  animation: spin 2s linear infinite;
  position: absolute;
  left: 50%;
  top: 50%;
  margin-left: -25px;
  margin-top: -25px;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>  


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


<!-- The Modal -->
<div id="loadingModal" class="modal">
    <!-- Loading spinner -->
    <div class="loader"></div>
   
  </div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal Title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <p id="modalMessage"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>





<script>


 // Function to open modal with a message
 function openModal(message) {
    // Set the message in the modal body
    document.getElementById('modalMessage').innerText = message;
    // Open the modal
    //$('#exampleModal').modal('show');

    var modal1 = document.getElementById("exampleModal");
    modal1.style.display = "block";
  }

  



function login_in_first(){ 
  // FIXME  - define global variables to login page and redirect to " 
  window.location.replace( window.location.origin +"/my-account/?redirect_to=<?php echo get_permalink();?>");
 
}


function add_to_gifts(){
       // var strDivName= 'EventsofGift' + giftid;
        
       
       //var productData = '{"title":"<?php echo $product_title ?>","price":10,"sku":"ABC123","description":"This is a sample product."}';    

       showLoading();  
    passed_data={
        "title":"<?php echo $product_title; ?>",
        "description":"<?php echo $product_description; ?>",
        "product_id" :<?php echo $product_id; ?>,
        "image_url" :  "<?php echo  $image_url;?>" ,
        "product_url":  "<?php echo  $product_url;?>" 
    };


        jQuery.ajax({
        type: "post",       
        url: `${window.location.origin}/wp-admin/admin-ajax.php`,
        data: {
          action: "wl_add_to_gifts",  // the action to fire in the server
          data: passed_data,         // any JS object
        },
        complete: function (response) {
          hideLoading();
          openModal(response.responseText);
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

  
  function showLoading() {	
	var modal = document.getElementById("loadingModal");
	modal.style.display = "block";
  }

  function hideLoading() {	
	var modal = document.getElementById("loadingModal");
	modal.style.display = "none";
  }


</script>


