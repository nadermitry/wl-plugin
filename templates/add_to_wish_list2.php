

<?php
  global $product;
  $product_id = $product->get_id();
  
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


      global $wpdb;
      $table_name = $wpdb->prefix . 'gifts';
		  // Replace 'your_column_name' with the name of the column you want to query
		  $sql="SELECT * FROM $table_name WHERE user_id= " . get_current_user_id() ." and product_id= ".  esc_attr( $product_id );
		  $result = $wpdb->get_row($sql);
      
			if ($result) {				// Access individual columns like this
				
				  // User is logged in
          $buttonTitle = 'Remove from my Gifts';
          $buttonOnClickFunction = 'remove_from_gifts('.$result->id.','.$product_id.');';
			} else {
          // User is logged in
      $buttonTitle = 'Add to my Gifts';
      $buttonOnClickFunction = 'add_to_gifts('.esc_attr( $product_id ).');';
      }


    
    
    
    
    } else {
      // User is not logged in
      $buttonTitle = 'PLease login to add it to your wishlist';
      $buttonOnClickFunction = 'login_in_first();';
    }
  ?>




  <button  id="wl_gift_button_action<?php echo esc_attr( $product_id );?>"
		class="<?php echo "add_to_wishlist single_add_to_wishlist"; ?>"  onclick="<?php echo $buttonOnClickFunction;?>"	>
		  <i class="yith-wcwl-icon fa fa-heart-o"></i>
		<span id="wl_button_title<?php echo esc_attr( $product_id );?>"><?php echo  $buttonTitle; ?></span>
	</button>
</div>














		