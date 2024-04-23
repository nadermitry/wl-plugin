


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
          $buttonOnClickFunction = 'remove_from_gifts('.$result->id.');';
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




  <button  id="wl_gift_button_action"
		class="<?php echo "add_to_wishlist single_add_to_wishlist"; ?>"  onclick="<?php echo $buttonOnClickFunction;?>"	>
		  <i class="yith-wcwl-icon fa fa-heart-o"></i>
		<span id="wl_button-title"><?php echo  $buttonTitle; ?></span>
	</button>
</div>













<script>
jQuery(document).ready(function() {

// Get the modal element
var modal = document.getElementById('exampleModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementById("x");


// When the user clicks on the button, open the modal
btn.onclick = function() {
  
    modal.style.display = "none";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
   
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

// Close the modal when Escape key is pressed
window.onkeydown = function(event) {
    if (event.key === "Escape") {
        modal.style.display = "none";
    }
}


});

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

function remove_from_gifts(record_id){
      
      // TODO disable gift if it was added to an event instead of deleing it
             
              
              showLoading();  
              passed_data={"id":record_id};
              jQuery.ajax({
              type: "post",       
              url: `${window.location.origin}/wp-admin/admin-ajax.php`,
              data: {
                action: "wl_remove_from_gifts",  // the action to fire in the server
                data: passed_data,         // any JS object
              },
              complete: function (response) {        
                  hideLoading(); 
      
                  if(JSON.parse(response.responseText).data =="Error"){
                    openModal('Item is used in an event cannot delete');
                    console.log(response.responseText);
                  }
      
                  else{
      
                       
                  openModal('Item Removed from gift list');
                  console.log(response.responseText);
                  var button = document.getElementById('wl_gift_button_action');
                  button.setAttribute('onclick', 'add_to_gifts();');
                  var buttonSapn = document.getElementById('wl_button-title');
                  buttonSapn.textContent='Add to my Gifts';
                  // Change the title attribute
                  button.title =   'Add to my Gifts';
                  }
              },
          });
      
          
      
        }
      
      
      
      function add_to_gifts(product_id){
             // var strDivName= 'EventsofGift' + giftid;
              
                     
            
             


             showLoading(); 
             
             /*
          passed_data={
              "title":"<?php echo $product_title; ?>",
              "description":"<?php echo $product_description; ?>",
              "product_id" : product_id,
              "image_url" :  "<?php echo  $image_url;?>" ,
              "product_url":  "<?php echo  $product_url;?>" 
          };
*/
          passed_data={
           
              "product_id" : product_id
             
          };
      
             
              jQuery.ajax({
              type: "post",       
              url: `${window.location.origin}/wp-admin/admin-ajax.php`,
              data: {
                action: "wl_add_to_gifts2",  // the action to fire in the server
                data: passed_data,         // any JS object
              },
              complete: function (response) {
                  //alert(JSON.parse(response.responseText).data);
                  var button = document.getElementById('wl_gift_button_action');                 
                  button.setAttribute('onclick', 'remove_from_gifts('+JSON.parse(response.responseText).data+');');
                  var buttonSapn = document.getElementById('wl_button-title');
                  buttonSapn.textContent='Remove from my Gifts';
      
      // Change the title attribute
                 // button.value = 'Remove from my Gifts';
                hideLoading();
                openModal('Item added to gift list');
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
		