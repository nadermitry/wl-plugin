
<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="<?php echo $this->plugin_url ?>xassets/bootstrap/css/bootstrap.css">
        <link rel="stylesheet" href="<?php echo $this->plugin_url ?>xassets/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="<?php echo $this->plugin_url ?>xassets/css/form-elements.css">
        <link rel="stylesheet" href="<?php echo $this->plugin_url ?>xassets/css/style.css">

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

<!-- The Modal -->
<div id="loadingModal" class="modal">
    <!-- Loading spinner -->
    <div class="loader"></div>
   
  </div>


<div id="giftWizard" class="form-box addeventbody">
         
    <form role="form" id="gift-form"   class="f1">
        <!--<h3>Register To Our App</h3>
        <p>Fill in the form to get instant access</p>-->
        <div class="f1-steps">
            <div class="f1-progress">
                <div class="f1-progress-line" data-now-value="16.66" data-number-of-steps="4" style="width: 16.66%;"></div>
            </div>
            <div class="f1-step active">
                <div class="f1-step-icon"><i class="fa fa-info"></i></div>
                <p>Info</p>
            </div>
            <div class="f1-step">
                <div class="f1-step-icon"><i class="fa fa-calendar"></i></i></div>
                <p>Date</p>
            </div>
            <div class="f1-step">
                <div class="f1-step-icon"><i class="fa fa-map-marker"></i></i></div>
                <p>Location</p>
            </div>                              
        </div>

        <fieldset>
            <!--<h4>Tell us who you are:</h4>-->
            <div class="form-group">                    	
                <label class="sr-only" for="event_title">URL</label>
                <input type="text"  placeholder="URL..." class="addEvent  form-control" id="url" name="url"> 
            </div>

             <!--<div class="f1-buttons">
                <button type="submit" id="addGiftSubmit"  class="btn btn-submit">Next</button>
            </div>-->
           <div class="f1-buttons"> 
                <button type="button" class="btn btn-npost">Next</button>
            </div>
        </fieldset>

        <fieldset>
            <!--  <h4>Set up your account:</h4>-->
            
            <div class="container">
        <div class="row">
        <!-- First Column -->
        <div class="col-md-1">
            <!-- First Row of First Column -->
            <div class="row">
                <div class="col-md-12"> 
                    <div class="row mt-3">
                    <div class="row" id="imageContainer">
                                            <img WIDTH="60%" src="<?php echo $images[$i] ?>" onclick="imagclicked('<?php echo $images[$i] ?>',<?php echo $nImgno;  ?>);"  class="img-thumbnail" data-target="#carouselExampleIndicators" data-slide-to="0">
                                        </div>
                        <?php 
                            $nImgno=-1;
                            $strImage=plugin_dir_url( __FILE__ )."assets/sysimages/na.png";
                            for ($i = 0; $i < $noOfTries; ++$i): 
                              
                            
                            ?>  
                            
                                <?php if ( !is_null($images[$i])):?>                                  
                                <?php if ( isValidImage($images[$i])) : 
                                 //echo ($images[$i]).'<br>';
                                    $nImgno =$nImgno+1?> 
                                    <?php if (  $nImgno < $maxNoOfImages):?> 
                                        <div class="row" id="imageContainer">
                                            <img WIDTH="60%" src="<?php echo $images[$i] ?>" onclick="imagclicked('<?php echo $images[$i] ?>',<?php echo $nImgno;  ?>);"  class="img-thumbnail" data-target="#carouselExampleIndicators" data-slide-to="0">
                                        </div>
                                    <?php endif ?> 
                                <?php endif ?> 
                                <?php endif ?>    
                            <?php endfor?>
                        <div class="row">  
                           
                            <button type="button" id="prevBtn" class="btn btn-secondary" onclick="changeImageSub()"><</button>
                            <button type="button" id="nextBtn" class="btn btn-secondary" onclick="changeImageAdd()">></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Second Column -->
        
        <div class="col-md-11">
            <!-- First Row of Second Column -->
            <div class="row">
                <div class="col-md-12">
                    <div class="container">
                        <!--<form action="http://localhost/wordpress/?page_id=342" method="post">-->
                    
                            <div class="form-group">
                                <label  class="sr-only" for="title">Title</label>
                                <input type="text"  placeholder="Title..." class="addEvent  form-control" id="title" name="title"  >
                                
                            </div>
                            
                            <div class="form-group">
                                   <!--<input type="hidden"  placeholder="url..." class="addEvent  form-control" id="imgurl" name="imgurl"  >-->
                                   <a target="_blank" href="<?php echo $_POST["url"]; ?>"><img class="img-thumbnail" id="myImage" src="assets/sysimages/loading.gif" alt="loading ..." width="25%"></a>        
                            </div> 

               



                            <div class="form-group">                                  
                                <input type="hidden" class="form-control" id="imageUrl" name="imageUrl" required >
                                <input type="hidden" class="form-control" id="url" name="url" required  value="<?php echo $_POST["url"]; ?>">
                            </div>
                            <div class="form-group">
                                <label for="description">Description:</label>
                                <textarea class="form-control" id="description" name="description" rows="4" cols="50"></textarea>
                            </div>
                            <div class="form-group">                              
                                
                           
                            </div>
                        
                    
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
      <div class="f1-buttons">
                
                <button type="button" class="btn btn-previous">Previous</button>
                <button name="savegift" type="button" class="btn btn-save-gift">Next</button>
                <!--<button  type="button" onclick="save_event();" class="btn">Submit</button>-->
            </div>             
        </fieldset>

        <fieldset>
            <!-- <h4>Social media profiles:</h4>-->
            <div class="form-group">
                <a id="gifturl" href="" target="_blank"> <h3 id="gifttitle"><h3></a>
                <a id="gifturl" href="" target="_blank"><img width="10%" id="giftimage"src=""> </a>
                <p id="giftdescription"></p>  
                <input type="hidden" id="giftid">                  
            </div>
            
            
            <div class="f1-buttons">
                
                <button type="button"  class="btn btn-addto-event">Add to Event</button>
                <button name="submit" type="submit" class="btn btn-submit">Add Another Gift </button>
                <button type="button" class="btn btn-mygifts">Go to My Gifts</button>
                
            </div>
        </fieldset>


        <fieldset>
            <!-- <h4>Social media profiles:</h4>-->
            <div class="form-group">
              <div id="checkboxContainer"></div>   
            </div>
            
            
            <div class="f1-buttons">
                
                
                <button name="submit" type="submit" class="btn btn-submit">Add Another Gift</button>
                <button type="button" class="btn btn-mygifts">Go to My Gifts</button>
              
                <!--<button  type="button" onclick="save_event();" class="btn">Submit</button>-->
            </div>
        </fieldset>

    </form>
</div>




<script src="<?php echo $this->plugin_url ?>xassets/js/jquery-1.11.1.min.js"></script>
<script src="<?php echo $this->plugin_url ?>xassets/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo $this->plugin_url ?>xassets/js/jquery.backstretch.min.js"></script>
<script src="<?php echo $this->plugin_url ?>xassets/js/retina-1.1.0.min.js"></script>
<script src="<?php echo $this->plugin_url ?>xassets/js/urlForm-scripts.js"></script>

