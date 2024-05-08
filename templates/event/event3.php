<style>
  @import url("https://fonts.googleapis.com/css?family=Nunito:400,600,700");
* {
  box-sizing: border-box;
}



.modal1 {
  position: fixed;
  left: 0;
  bottom: 0;
  width: 100%;
  height: 60px;
  background: rgba(51, 51, 51, 0.5);
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  transition: 0.4s;
}
.modal-container {
  display: flex;
  max-width: 1000px;
  width: 100%;
  border-radius: 10px;
  overflow: hidden;
  position: absolute;
  opacity: 0;
  pointer-events: none;
  transition-duration: 0.3s;
  background: #fff;
  transform: translateY(100px) scale(0.4);
}
.modal-title {
  font-size: 26px;
  margin: 0;
  font-weight: 400;
  color: #55311c;
}
.modal-desc {
  margin: 6px 0 30px 0;
}
.modal-left {
  padding: 60px 30px 20px;
  background: #fff;
  flex: 3;
  transition-duration: 0.5s;
  transform: translateY(80px);
  opacity: 0;
}
.modal-button {
  color: #7d695e;
  font-family: "Nunito", sans-serif;
  font-size: 18px;
  cursor: pointer;
  border: 0;
  outline: 0;
  padding: 10px 40px;
  border-radius: 30px;
  background: white;
  box-shadow: 0 10px 40px rgba(0, 0, 0, 0.16);
  transition: 0.3s;
}
.modal-button:hover {
  border-color: rgba(255, 255, 255, 0.2);
  background: rgba(255, 255, 255, 0.8);
}
.modal-right {
  flex: 2;
  font-size: 0;
  transition: 0.3s;
  overflow: hidden;
}
.modal-right img {
  width: 100%;
  height: 100%;
  transform: scale(2);
  -o-object-fit: cover;
     object-fit: cover;
  transition-duration: 1.2s;
}
.modal1.is-open {
  height: 100%;
  background: rgba(51, 51, 51, 0.85);
}
.modal1.is-open .modal-button {
  opacity: 0;
}
.modal1.is-open .modal-container {
  opacity: 1;
  transition-duration: 0.6s;
  pointer-events: auto;
  transform: translateY(0) scale(1);
}
.modal1.is-open .modal-right img {
  transform: scale(1);
}
.modal1.is-open .modal-left {
  transform: translateY(0);
  opacity: 1;
  transition-delay: 0.1s;
}
.modal-buttons {
  display: flex;
  justify-content: space-between;
  align-items: center;
}
.modal-buttons a {
  color: rgba(51, 51, 51, 0.6);
  font-size: 14px;
}

.sign-up {
  margin: 60px 0 0;
  font-size: 14px;
  text-align: center;
}
.sign-up a {
  color: #8c7569;
}

.input-button {
  padding: 8px 12px;
  outline: none;
  border: 0;
  color: #fff;
  border-radius: 4px;
  background: #8c7569;
  font-family: "Nunito", sans-serif;
  transition: 0.3s;
  cursor: pointer;
}
.input-button:hover {
  background: #55311c;
}

.input-label {
  font-size: 11px;
  text-transform: uppercase;
  font-family: "Nunito", sans-serif;
  font-weight: 600;
  letter-spacing: 0.7px;
  color: #8c7569;
  transition: 0.3s;
}

.input-block {
  display: flex;
  flex-direction: column;
  padding: 10px 10px 8px;
  border: 1px solid #ddd;
  border-radius: 4px;
  margin-bottom: 20px;
  transition: 0.3s;
}
.input-block input {
  outline: 0;
  border: 0;
  padding: 4px 0 0;
  font-size: 14px;
  font-family: "Nunito", sans-serif;
}
.input-block input::-moz-placeholder {
  color: #ccc;
  opacity: 1;
}
.input-block input:-ms-input-placeholder {
  color: #ccc;
  opacity: 1;
}
.input-block input::placeholder {
  color: #ccc;
  opacity: 1;
}
.input-block:focus-within {
  border-color: #8c7569;
}
.input-block:focus-within .input-label {
  color: rgba(140, 117, 105, 0.8);
}

.icon-button {
  outline: 0;
  position: absolute;
  right: 10px;
  top: 12px;
  width: 32px;
  height: 32px;
  border: 0;
  background: 0;
  padding: 0;
  cursor: pointer;
}

.scroll-down {
  position: fixed;
  top: 50%;
  left: 50%;
  display: flex;
  flex-direction: column;
  align-items: center;
  text-align: center;
  color: #7d695e;
  font-size: 32px;
  font-weight: 800;
  transform: translate(-50%, -50%);
}
.scroll-down svg {
  margin-top: 16px;
  width: 52px;
  fill: currentColor;
}

@media (max-width: 750px) {
  .modal-container {
    width: 90%;
  }

  .modal-right {
    display: none;
  }
}

</style>


<?php 

$dateString = $result->start_date; // Example DateTime string

// Create a DateTime object from the string
$dateTime = new DateTime($dateString);

// Extract date and time
$date = $dateTime->format('d-M-Y'); // Date in 'YYYY-MM-DD' format
$time = $dateTime->format('h:i A'); // Time in 'HH:MM:SS' format


$endDateString = $result->end_date; // Example DateTime string

// Create a DateTime object from the string
$endDateTime = new DateTime($endDateString);

// Extract date and time
$end_date = $endDateTime->format('d-M-Y'); // Date in 'YYYY-MM-DD' format
$end_time = $endDateTime->format('h:i A'); // Time in 'HH:MM:SS' format


        ?>



<div>

<div class="container11">

<!-- Left Column / Headphones Image 
<div class="left-column">-->
<div class="row">
<div class="col-md-7">
  
  <img data-image="red" class="active single-event-img" src="<?php echo plugin_dir_url( dirname( __FILE__, 2 ) ) .'/assets/images/events/'. $result->event_image;  ?>" alt="">
  
  <?php if ($isCurrentUser) :?>
    <button class="xbutton choose-image-button" data-toggle="modal" data-target="#imageModal">Choose Image</button>
              <?php endif ?>
 
            

</div>


<!-- Right Column 
<div class="right-column"> -->
<div class="col-md-5">
  <!-- Product Description -->
  <div class="product-description">
  <h1> <?php echo stripcslashes(sanitize_text_field($result->title)); ?></h1>
   <!-- <span>Event</span>-->
   
             
    

    <div class="product-price">
    <!--<span>148$</span>-->
    </div>
 
       
   
    <p><?php echo stripcslashes(sanitize_text_field($result->description)) ; ?></p>
  </div>

  <!-- Product Configuration -->
  <div class="product-configuration">

    <!-- Product Color 
    <div class="product-color">
      <span>Color</span>

      <div class="color-choose">
        <div>
          <input data-image="red" type="radio" id="red" name="color" value="red" checked>
          <label for="red"><span></span></label>
        </div>
        <div>
          <input data-image="blue" type="radio" id="blue" name="color" value="blue">
          <label for="blue"><span></span></label>
        </div>
        <div>
          <input data-image="black" type="radio" id="black" name="color" value="black">
          <label for="black"><span></span></label>
        </div>
      </div>

    </div>
    -->

    <!-- Cable Configuration -->
    <div class="cable-config">
      <!--<span>Cable configuration</span>-->     
      
      <div class="container">
        <!-- Left Column / Headphones Image 
        <div class="left-column">-->
        <div class="row">
          <div class="col-md-12">          
            <div class="cable-choose">
              <button><i class="fas fa-calendar-alt mr-2"></i> <?php echo $date;?>   <?php echo $time;?></button>
            </div>
          </div> 

         <!-- <div class="col-md-6">
            <div class="cable-choose">
              <button><i class="fas fa-calendar-alt mr-2"></i> <?php echo $end_date;?> <?php echo $end_time;?></button>
            </div> 
          </div>-->

        </div> 
      </div> 
           
          
      

      
     
      <div class=" mt-0 mb-0">                
               
                    <a class=" mt-0 mb-0" target="_blank" href="<?php echo $result->location_url?>"><?php echo sanitize_text_field($result->location_name); ?></a>
                           
            </div>

            <div class=" mt-0 mb-0">                
                
                    <a  class=" mt-0 mb-0" target="_blank" href="<?php echo $result->location_map?>"><?php echo sanitize_text_field($result->location_address);?></a>
                           
            </div>


            <div class=" mt-0 mb-0">                
                <span class="bs-blog-date">
                    <a class=" mt-0 mb-0" target="_blank" href="<?php echo $result->location_map?>"> Map</a>
                </span>                
            </div>  
            


            <?php if ($isCurrentUser) :?>
            
            
            <article class="small single ">     
        <div class="post-share">
            <div class="post-share-icons cf"> 

                <a class="facebook" href="https://www.facebook.com/sharer.php?u=<?php echo $currentURL ;?>" target="_blank">
                    <i class="fab fa-facebook"></i>
                </a>

                  <!--  <a class="x-twitter" href="http://twitter.com/share?url=<?php echo $currentURL ;?>" target="_blank">
                        <i class="fa-brands fa-x-twitter"></i>
                    </a>-->

                    <a class="envelope" href="mailto:?subject=<?php echo $result->title; ?>&amp;body=<?php echo $currentURL ;?>" target="_blank">
                        <i class="fas fa-envelope-open"></i>
                    </a>
                    <!--<a class="linkedin" href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo $currentURL ;?>" target="_blank">
                        <i class="fab fa-linkedin"></i>
                    </a>-->
                               
                    <a class="telegram" href="https://t.me/share/url?url=<?php echo $currentURL ;?>&amp;title=<?php echo $result->title; ?>" target="_blank">
                        <i class="fab fa-telegram"></i>
                    </a>
                    <a class="whatsapp" href="https://api.whatsapp.com/send?text=<?php echo $currentURL ;?>" target="_blank">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                                    <a class="reddit" href="https://www.reddit.com/submit?url=<?php echo $currentURL ;?>" target="_blank">
                        <i class="fab fa-reddit"></i>
                    </a>
                    <!--<a class="whatsapp" href="javascript:window.print()"> <i class="fas fa-print"></i></a>-->
            </div>
        </div>

        <div class="clearfix mb-3"></div>
                
                             

    </article>

    <?php endif ?>
    </div>

    
  </div>  
</div>
</div>
</div>

</div>

   
     
   

<h3>Wish List</h3>
<div  class="container12">    
      
      <div style="width:60%">
        <div class="button-container">
          <input class="form-control mr-sm-2 ml-2  col-md-6" type="search" id="search" placeholder="Search..." aria-label="Search">
            <?php if ($isCurrentUser) :?>
              <button type="button" class="ybutton btn-primary mr-2" data-toggle="modal" data-target="#bigModal">Add Gifts</button>             
            <?php endif ?> 
        </div>      
   </div>
 </div>
 
<div class="container">
  <!-- List -->

  
  
  



  <ul id="list" class="list-group">

    
    <?php foreach ($gifts as $gift) : ?>

        

      <li id="li<?php echo $gift->event_gift_id?>" class="list-group-item"> 
        
        
       



        <div class="image">
            <img src="<?php echo $gift->img_url?>" alt="Your Image">
        </div>
        <div class="xtext">
            <p> <?php  echo $this->trim_and_add_dots($gift->title,60) ?></p>
            
        </div>

        <div class="xbutton-group">            
          <button class="xbutton" onclick="count_actions(<?php echo $gift->id?>,<?php echo $result->id?>,'views_count','<?php echo $gift->url?>')">View</button>
      <!--    <button class="xbutton" onclick="count_actions(<?php echo $gift->id?>,<?php echo $result->id?>,'purchase_count','<?php echo $gift->url?>')">Buy</button>-->
          <?php if ($isCurrentUser) :?>
            <button class="xbutton" onclick="remove_from_event(<?php echo $gift->id?>,<?php echo $result->id?>,<?php echo $gift->event_gift_id?>)">Remove</button>
          <?php endif ?>
        </div>

       
    </li>




    
        <?php endforeach ; ?>
  </ul>


  <!-- Pagination -->
  <nav aria-label="Page navigation">
  
    <ul class="navigation wl-pagination justify-content-center" id="pagination">
      <!-- Pagination items will be added dynamically using JavaScript -->
    </ul>
  </nav>

</div>


<div class="bs-info-author-block py-4 px-3 mb-4 flex-column justify-content-center text-center">
    
<?php if ($full_url != "") :?>
  <a class="bs-author-pic mb-3" ><img alt="" src="<?php echo $full_url;?>" srcset="<?php echo $full_url;?> 2x" class="avatar avatar-150 photo" height="150" width="150" decoding="async"></a>
<?php endif; ?> 
<div class="flex-grow-1">
        <h4 class="title"><a ><?php echo $this->current_user->display_name; ?></a></h4>
        <p></p>
    </div>
</div>






<?php  //endforeach ?>

<?php if ($isCurrentUser) :?>

<!-- Big Modal -->
<div class="modal fade" id="bigModal" tabindex="-1" aria-labelledby="bigModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg"> <!-- Use modal-lg class for a large modal -->
    <div class="modal-content">
      <div class="modal-header ">
   
          <span aria-hidden="true" class="close" data-dismiss="modal" aria-label="Close">&times;</span>
      
        <h5 class="modal-title" id="bigModalLabel">Add gifts to <?php echo $result->title; ?> </h5>
       
        <form class="form-inline my-2 my-lg-0">
          < container
        <div class="row">
        <div class="col-md-6">
        <input  style="margin:15px" class="form-control large-input mr-sm-2 ml-5 mr-5" type="search" id="newsearch" placeholder="Search..." aria-label="Search">
         <!-- You can add a search button if needed -->
         <!-- <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button> -->
        </div>
        </div>
        </form>
        
      </div>
      <div class="modal-body">

      

        <!-- Modal Content Goes Here -->
        <ul id="newlist" class="list-group">
    
    <?php foreach ($newgifts as $gift) : ?>
        <li class="list-group-item">
        <img width="65px" src="<?php echo $gift->img_url?>" ?>
        <?php  echo $this->trim_and_add_dots(stripcslashes($gift->title),60) ?>
        <div id="giftsControl-G<?php echo $gift->id ?>" style="float:right;"> 
            <button class="ybutton" onclick="add_to_event(<?php echo $gift->id ?>,<?php echo  $result->id ?>)">Add</button>
        </div>
    </li>
    
        <?php endforeach ; ?>
  </ul>
      </div>

            <nav aria-label="Page navigation">
        
        <ul class="navigation wl-pagination justify-content-center" id="newpagination">
          <!-- Pagination items will be added dynamically using JavaScript -->
        </ul>
      </nav>


      <div class="modal-footer">
        <button class="ybutton"  type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div>




<!-- Bootstrap Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">Choose Another Image </h5>
                   
                        <span  class="close" data-dismiss="modal" aria-label="Close" aria-hidden="true">&times;</span>
                        
                </div>
                
                <form id="file-upload-form" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                   
                    <input type="file" id="newImageInput" name="newImageInput" class="form-control-file">
                    <input type="hidden" name="action" value="handle_file_upload">
                    <input type="hidden" name="event_id" value="<?php echo  $result->id ?>">
                </div>
                <div class="modal-footer">
                    <input type="submit"  class="btn btn-primary" name="submit" value="Upload File and save">                   
                    <button type="button" class="btn btn-primary" id="applyImageButton">Apply Image</button>
                </div> 
                </form>


                
    
    
    <!-- Add hidden input field for AJAX action -->
    


            </div>
        </div>
    </div>

  
     



    <?php endif ?>

  <?php if ($isCurrentUser) :?>
    <div class="modal1">  
      <div class="modal-container">  
        <div class="modal-left">
          <form id="event-form" method="post" enctype="multipart/form-data">      
            <div class="container">
              <div class="row">
                <div class="col-md-6">
                  <div class="input-block">
                    <label for="event_title" class="input-label">Title:</label>
                    <input type="text" value=" <?php echo stripcslashes(sanitize_text_field($result->title)); ?>" id="event_title" name="event_title" required>
                  </div>   
                </div>
          
                <div class="col-md-6">
                  <div class="input-block">
                    <label  for="start_datetime" class="input-label" >Start Date and Time:</label>
                    <input type="datetime-local"  value="<?php echo $result->start_date; ?>" id="start_datetime" name="start_datetime" required>
                  </div>
                </div>
                <!-- <div class="col-md-6">
                  <div class="input-block">
                    <label  for="end_datetime" class="input-label">End Date and Time:</label>-->
                    <input type="hidden" value="<?php echo $result->end_date; ?>" id="end_datetime" name="end_datetime">
                  <!-- </div>
                </div>-->
              </div>
          
              <div class="row">
                <div class="col-md-12">
                  <div class="input-block">
                    <label  for="event_description" class="input-label">Description:</label>                                               
                    <textarea id="event_description"  name="event_description" rows="3" cols="50"><?php echo stripcslashes(sanitize_text_field($result->description)) ; ?></textarea>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="input-block">               
                    <label  for="event_address_name" class="input-label">Location:</label>
                    <input type="text"     value="<?php echo sanitize_text_field($result->location_name)?>" id="event_address_name" name="event_address_name" required>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="input-block">
                    <label  for="event_address_url" class="input-label">Location URL:</label>
                    <input type="text"  value="<?php echo $result->location_url?>"  id="event_address_url"  name="event_address_url" >
                  </div>
                </div>
              </div>

              <div class="row">

                <div class="col-md-6">        
                  <div class="input-block">  
                    <label  for="event_address" class="input-label">Address:</label>
                    <input type="text" name="event_address"  id="event_address" value="<?php echo sanitize_text_field($result->location_address)?>" required>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="input-block">
                    <label  for="event_location" class="input-label">Location:</label>
                    <input type="text" name="event_location"   id="event_location" value="<?php echo $result->location_map?>">  
                  </div>
                </div>

              </div>

              <div class="row">
                <div class="col-md-12">
                  <div class="modal-buttons">       
                    <button type="button" data-dismiss="modal" class="ybutton"   onclick="update_event(<?php echo  $result->id ?>)">Save</button> 
                  </div>
               </div>
              </div>

            </div>
          </form>
        </div>

     <div class="modal-right">
      <img src="<?php echo plugin_dir_url( dirname( __FILE__, 2 ) ) .'/assets/images/events/'. $result->event_image;  ?>" alt="">
    </div>


     
     <button class="icon-button close-button">
         <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50">
     <path d="M 25 3 C 12.86158 3 3 12.86158 3 25 C 3 37.13842 12.86158 47 25 47 C 37.13842 47 47 37.13842 47 25 C 47 12.86158 37.13842 3 25 3 z M 25 5 C 36.05754 5 45 13.94246 45 25 C 45 36.05754 36.05754 45 25 45 C 13.94246 45 5 36.05754 5 25 C 5 13.94246 13.94246 5 25 5 z M 16.990234 15.990234 A 1.0001 1.0001 0 0 0 16.292969 17.707031 L 23.585938 25 L 16.292969 32.292969 A 1.0001 1.0001 0 1 0 17.707031 33.707031 L 25 26.414062 L 32.292969 33.707031 A 1.0001 1.0001 0 1 0 33.707031 32.292969 L 26.414062 25 L 33.707031 17.707031 A 1.0001 1.0001 0 0 0 32.980469 15.990234 A 1.0001 1.0001 0 0 0 32.292969 16.292969 L 25 23.585938 L 17.707031 16.292969 A 1.0001 1.0001 0 0 0 16.990234 15.990234 z"></path>
    </svg>
      </button>
      
   </div>
 

      <button class="modal-button"><i class="fas fa-edit"></i> Edit</button>
      
 
   
</div>
<?php endif ?>





<!-- Bootstrap JS and jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>


const body = document.querySelector("body");
const modal = document.querySelector(".modal1");
const modalButton = document.querySelector(".modal-button");
const closeButton = document.querySelector(".close-button");
const scrollDown = document.querySelector(".scroll-down");
let isOpened = false;

const openModal = () => {
  modal.classList.add("is-open");
  body.style.overflow = "hidden";
};

const closeModal = () => {
  modal.classList.remove("is-open");
  body.style.overflow = "initial";
};

window.addEventListener("scroll", () => {
  if (window.scrollY > window.innerHeight / 3 && !isOpened) {
    isOpened = true;
    scrollDown.style.display = "none";
    openModal();
  }
});

modalButton.addEventListener("click", openModal);
closeButton.addEventListener("click", closeModal);

document.onkeydown = evt => {
  evt = evt || window.event;
  evt.keyCode === 27 ? closeModal() : false;
};








function findMinimum(arr) {
    if (arr.length === 0) {
        return undefined; // Return undefined if the array is empty
    }

    let min = arr[0]; // Assume the first element is the minimum

    // Loop through the array to find the minimum value
    for (let i = 1; i < arr.length; i++) {
        if (arr[i] < min) {
            min = arr[i]; // Update min if the current element is smaller
        }
    }

    return min;
}



   
    





$('#bigModal').on('hidden.bs.modal', function () {  
    location.reload();
  });


  $('#editModal').on('hidden.bs.modal', function () {  
    location.reload();
  });

 


  //var itemsPerPage = 5; // Change this to adjust items per page
   // var listItems = $("#list").children();
  //  var numItems = listItems.length;
   // var numPages = Math.ceil(numItems / itemsPerPage);
    //alert('CurrentPage');
   // var CurrentPage = 1;



var itemsPerPageEvent = 3; // Change this to adjust items per page
var listItemsEvent = $("#list").children();
var numItemsEvent = listItemsEvent.length;
var numPagesEvent = Math.ceil(numItemsEvent / itemsPerPageEvent);
var pagesToShowEvent = 5; // Number of page numbers to show at a time
var currentPageEvent = 1; // Set the default current page

// Function to generate pagination
// Function to generate pagination
function icsGeneratePaginationEvent(containrtId,currentPage) {
    var paginationContainerEvent = $(containrtId);
    paginationContainerEvent.empty(); // Clear existing pagination links

    // Calculate start and end pages based on the current page
    var startPage, endPage;
    if (numPagesEvent <= pagesToShowEvent) {
        startPage = 1;
        endPage = numPagesEvent;
    } else {
        var halfPagesToShow = Math.floor(pagesToShowEvent / 2);
        if (currentPage <= halfPagesToShow) {
            startPage = 1;
            endPage = pagesToShowEvent;
        } else if (currentPage + halfPagesToShow >= numPagesEvent) {
            startPage = numPagesEvent - pagesToShowEvent + 1;
            endPage = numPagesEvent;
        } else {
            startPage = currentPage - halfPagesToShow;
            endPage = currentPage + halfPagesToShow;
        }
    }

    if (currentPage > 1) {
      paginationContainerEvent.append('<button type="button" class="ics-page-numbers" onclick="icsGotoPageEvent(' + (currentPage - 1) + ')">&laquo;</button>');
    }


    // Add pagination items
    for (var i = startPage; i <= endPage; i++) {
        var activ = (i === currentPage) ? "active" : "";
        paginationContainerEvent.append('<button type="button" class="' + activ + ' ics-page-numbers"  onclick="icsGotoPageEvent(' + i + ')">' + i + '</button>');
    }

    if (currentPage < numPagesEvent) {
      paginationContainerEvent.append('<button type="button"  class="ics-page-numbers" onclick="icsGotoPageEvent(' + (currentPage + 1) + ')">&raquo;</button>');
    }

    

}
















var newitemsPerPage = 3; // Change this to adjust items per page
var newlistItems = $("#newlist").children();
var newnumItems = newlistItems.length;
var newnumPages = Math.ceil(newnumItems / newitemsPerPage);
var pagesToShow = 5; // Number of page numbers to show at a time
var currentPage = 1; // Set the default current page


// Function to generate pagination
function icsGeneratePagination(containrtId,currentPage) {
    var newpaginationContainer = $(containrtId);
    newpaginationContainer.empty(); // Clear existing pagination links

    // Calculate start and end pages based on the current page
    var startPage, endPage;
    if (newnumPages <= pagesToShow) {
        startPage = 1;
        endPage = newnumPages;
    } else {
        var halfPagesToShow = Math.floor(pagesToShow / 2);
        if (currentPage <= halfPagesToShow) {
            startPage = 1;
            endPage = pagesToShow;
        } else if (currentPage + halfPagesToShow >= newnumPages) {
            startPage = newnumPages - pagesToShow + 1;
            endPage = newnumPages;
        } else {
            startPage = currentPage - halfPagesToShow;
            endPage = currentPage + halfPagesToShow;
        }
    }

    if (currentPage > 1) {
      newpaginationContainer.append('<button type="button" class="ics-page-numbers" onclick="icsGotoPage(' + (currentPage - 1) + ')">&laquo;</button>');
    }


    // Add pagination items
    for (var i = startPage; i <= endPage; i++) {
        var activ = (i === currentPage) ? "active" : "";
        newpaginationContainer.append('<button type="button" class="' + activ + ' ics-page-numbers"  onclick="icsGotoPage(' + i + ')">' + i + '</button>');
    }

    if (currentPage < newnumPages) {
      newpaginationContainer.append('<button type="button"  class="ics-page-numbers" onclick="icsGotoPage(' + (currentPage + 1) + ')">&raquo;</button>');
    }

}



// Function to handle pagination navigation
function icsGotoPage(pageNumber) {
    currentPage = pageNumber; // Update current page
    icsGeneratePagination("#newpagination",currentPage);   // Generate pagination with the updated current page
    var newstartIndex = (pageNumber - 1) * newitemsPerPage;
    var newendIndex = newstartIndex + newitemsPerPage;
    newlistItems.hide().slice(newstartIndex, newendIndex).show();    
   // console.log('Showing page ' + pageNumber);
}

// Function to handle pagination navigation
function icsGotoPageEvent(pageNumber) {
    currentPage = pageNumber; // Update current page
    icsGeneratePaginationEvent("#pagination",currentPage);   // Generate pagination with the updated current page
    var newstartIndex = (pageNumber - 1) * itemsPerPageEvent;
    var newendIndex = newstartIndex +  itemsPerPageEvent;    
    listItemsEvent.hide().slice(newstartIndex, newendIndex).show();    
   // console.log('Showing page ' + pageNumber);
}






  $(document).ready(function(){ 

    $('#file-upload-form').submit(function(e) {
        e.preventDefault();
        var formData = new FormData($(this)[0]);

        $.ajax({
        
            url: `${window.location.origin}/wp-admin/admin-ajax.php`, // WordPress AJAX URL
            type: 'POST',
            data: formData,
            async: true,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                // Handle success response
                console.log(response.data);
                location.reload();
            },
            error: function(xhr, textStatus, errorThrown) {
                // Handle error response
                console.error('Error uploading file: ' + textStatus);
            }
        });
    });

// Initialize pagination
    listItemsEvent = $("#list").children();
       
    var containerIdEvent = "#pagination";
    
    
    icsGeneratePaginationEvent("#pagination",1);
    icsGotoPageEvent(1)
  



    icsGeneratePagination("#newpagination",currentPage);
    // Show first page by default
    icsGotoPage(1);
    // Pagination click event
    $("#newpagination").on("click", ".page-numbers", function(e) {
      e.preventDefault();
      var newpage = $(this).text();
      icsGotoPage(newpage);
      // Highlight the clicked page number and remove highlight from others
      $(".page-numbers").removeClass("active");
      $(this).addClass("active");
    });

    // Search functionality
    $("#newsearch").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("#newlist li").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
      // Update pagination after filtering
      newlistItems = $("#newlist").children(":visible");
      newnumItems = newlistItems.length;
      newnumPages = Math.ceil(newnumItems / newitemsPerPage);

      icsGeneratePagination("#newpagination",1); 
      // Show first page by default
      icsGotoPage(1);
    });




    $("#search").on("keyup", function() {      
      var value = $(this).val().toLowerCase();
      $("#list li").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    
      // Update pagination after filtering
      listItemsEvent = $("#list").children(":visible");
      numItemsEvent = listItemsEvent.length;
     
      numPagesEvent = Math.ceil(numItemsEvent / itemsPerPageEvent);
      icsGeneratePaginationEvent("#pagination",1); 
      // Show first page by default
      icsGotoPageEvent(1);
      
    });


    
    $("#newsearch").on("search", function() {
    if (!this.value) {
      // Show all list items
      $("#newlist li").show();
      newlistItems = $("#newlist").children(":visible");
      newnumItems = newlistItems.length;
      newnumPages = Math.ceil(newnumItems / newitemsPerPage);
      icsGeneratePagination("#newpagination",1);     
      icsGotoPage(1);
  }
  });


  $("#search").on("search", function() {
    if (!this.value) {
        // Show all list items
        $("#list li").show();
        // Update pagination after clearing the search
        listItemsEvent = $("#list").children(":visible");
        numItemsEvent = listItemsEvent.length;
        numPagesEvent = Math.ceil(numItemsEvent / itemsPerPageEvent);
        icsGeneratePaginationEvent("#pagination",1); 
        // Show first page by default
        icsGotoPageEvent(1);
    }
});

   
  });



  function add_to_event(giftid,eventid){
       // var strDivName= 'EventsofGift' + giftid;
        var enventid_array = [];
     
        var myDiv = document.getElementById("giftsControl-G"+giftid);
       // myDiv.innerHTML = myDiv.innerHTML + "<img width=\'200px\' src='.$this->plugin_url.'assets/images/loading_icon.gif\'>";
       
        enventid_array.push(eventid);
           

    passed_data={"giftid":giftid,"events":enventid_array,"delete":0};


        jQuery.ajax({
        type: "post",
        //url: '<?php echo  get_site_url();?>/wp-admin/admin-ajax.php',
       url: `${window.location.origin}/wp-admin/admin-ajax.php`,
        data: {
          action: "wl_add_to_event",  // the action to fire in the server
          data: passed_data,         // any JS object
        },
        complete: function (response) {
         
            console.log(response.responseText); 
           
           
            var newHTML = response.responseText;    
          //  alert(newHTML);
//alert(enventid_array[0]);
             // Append HTML content to the div
             myDiv.innerHTML ='<button onclick="remove_from_event('+ giftid +','+ eventid+')">Remove</button>';
            
        },
    });

    
  }


  function update_event(eventid){
 
 
    passed_data={"event":eventid,      
      "title":document.getElementById('event_title').value,
      "start_date":document.getElementById('start_datetime').value,
      "end_date":document.getElementById('end_datetime').value,
      "description":document.getElementById('event_description').value,
      "location_name":document.getElementById('event_address_name').value,
      "location_url":document.getElementById('event_address_url').value,
      "location_address":document.getElementById('event_address').value,
      "location_map":document.getElementById('event_location').value,
      "is_active":1
    };
    
  

    jQuery.ajax({
      type: "post",
      
url: `${window.location.origin}/wp-admin/admin-ajax.php`,
data: {
  action: "wl_update_event",  // the action to fire in the server
  data: passed_data,         // any JS object
},
complete: function (response) {
 
    console.log(response.responseText);
    window.location.reload();
  //  alert(newHTML);
  //alert(enventid_array[0]);
  // Append HTML content to the div
  // myDiv.innerHTML ='<button onclick="remove_from_event('+ giftid +','+ eventid+')">Remove</button>';
    
},
});



  }



  function remove_from_event(giftid,eventid,wishlistid=0){
       // var strDivName= 'EventsofGift' + giftid;
        var enventid_array = [];
  
       var myDiv = document.getElementById("giftsControl-G"+giftid);
       // myDiv.innerHTML = myDiv.innerHTML + "<img width=\'200px\' src='.$this->plugin_url.'assets/images/loading_icon.gif\'>";
       
        enventid_array.push(eventid);
           

    passed_data={"giftid":giftid,"events":enventid_array};


        jQuery.ajax({
        type: "post",
        url: `${window.location.origin}/wp-admin/admin-ajax.php`,
       
        data: {
          action: "wl_remove_from_event",  // the action to fire in the server
          data: passed_data,         // any JS object
        },
        complete: function (response) {
         
            console.log(response.responseText); 
           
           
            var newHTML = response.responseText;    
          //  alert(newHTML);
//alert(enventid_array[0]);
             // Append HTML content to the div
             if  (wishlistid==0){
             myDiv.innerHTML ='<button onclick="add_to_event('+ giftid +','+ eventid+')">Add</button>';
             }else
             {
              // Find the <ul> element by its ID
              //alert(wishlistid);
                var myList = document.getElementById('list');

            // Find the <li> element by its ID
            var listItemToRemove = document.getElementById('li'+wishlistid); // ID of the <li> to remove

            // Remove the <li> element from the <ul>
            if (listItemToRemove) {
                myList.removeChild(listItemToRemove);
                for (var i = 1; i <= numPages; i++) {

if (i ==1){activ=" active ";}else{activ="  ";}
//var myPagination = document.getElementById('pagination');
//myPagination.removeChild('pagingB' + i );

var myLink = document.getElementById('pagingB' + i);

// Remove the <a> element if it exists
if (myLink) {
  myLink.parentNode.removeChild(myLink);
}


}
          


icsGeneratePagination("#newpagination",CurrentPage);     
      icsGotoPage(1);
            }
             }
        },
    });

    
  }

</script>


<!-- Link Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Custom JavaScript -->
    <script>
        // Apply image button click event
        document.getElementById('applyImageButton').addEventListener('click', function() {
            // Fetch the new image from the file input
            var newImageFile = document.getElementById('newImageInput').files[0];
            if (newImageFile) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('originalImage').src = e.target.result;
                };
                reader.readAsDataURL(newImageFile);
            }
            // Close the modal
            $('#imageModal').modal('hide');
        });



      



    </script>