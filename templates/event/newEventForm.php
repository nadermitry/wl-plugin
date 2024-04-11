
 <!-- CSS -->
 <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="<?php echo $this->plugin_url ?>xassets/bootstrap/css/bootstrap.css">
        <link rel="stylesheet" href="<?php echo $this->plugin_url ?>xassets/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="<?php echo $this->plugin_url ?>xassets/css/form-elements.css">
        <link rel="stylesheet" href="<?php echo $this->plugin_url ?>xassets/css/style.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="xassets/ico/favicon.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo $this->plugin_url ?>xassets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo $this->plugin_url ?>xassets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $this->plugin_url ?>wl-plugin/xassets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="<?php echo $this->plugin_url ?>xassets/ico/apple-touch-icon-57-precomposed.png">

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


<!--<div id="eventWizard" class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3 form-box addeventbody">-->
<div id="eventWizard" class="form-box addeventbody">
                    
                        <form role="form" id="event-form" method="post" enctype="multipart/form-data"  class="f1">
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
                                    <label class="sr-only" for="event_title">Title</label>
                                    <input type="text" name="event_title"  placeholder="Title..." class="addEvent  form-control" id="event_title">                                
                                </div>
                                <div class="form-group" >
                                  <!--  <label class="drop-X" id="X" for="event_image">Event Image</label> -->
                                                                
                                    <label for="images" class="drop-container" id="dropcontainer">
                                        <img id="imageDisplay" src="<?php echo $this->plugin_url ?>/images/imageplaceholder.png"  width="100px"> 
                                        
                                        <span id="file_title" class="drop-title">Drop Event image here</span>
                                            or
                                        <input type="file" name="event_image" id="event_image" accept="image/*" required>
                                    </label>                                
                                
                                </div>
                                <div class="form-group">
                                    <label class="sr-only" for="event_description">Description</label>                                                                                 
                                    <textarea id="event_description" name="event_description" placeholder="Event Description..." class="addEvent form-control" id="event_description"></textarea>
                                </div>
                                <div class="f1-buttons">
                                    <button type="button" class="btn btn-next">Next</button>
                                </div>
                            </fieldset>

                            <fieldset>
                              <!--  <h4>Set up your account:</h4>-->
                                <div class="form-group">
                                    <label class="" for="start_datetime">Start Date</label>                                    
                                    <input type="datetime-local"  placeholder="Start Date..." class="f1-email form-control" name="start_datetime" id="start_datetime"  >
                                </div>
                                <div class="form-group">
                                    <label class="" for="end_datetime">End Date</label>
                                    <input type="datetime-local" placeholder="End Date..."  class="f1-email form-control" name="end_datetime" id="end_datetime">
                                </div>
                               
                                <div class="f1-buttons">
                                    <button type="button" class="btn btn-previous">Previous</button>
                                    <button type="button" class="btn btn-next">Next</button>
                                </div>
                            </fieldset>

                            <fieldset>
                               <!-- <h4>Social media profiles:</h4>-->
                                <div class="form-group">
                                    <label class="sr-only" for="event_address_name">Locaion Name</label>                                  
                                    <input type="text" name="event_address_name"  id="event_address_name" placeholder="Locaion Name..." class="f1-facebook form-control" >
                                </div>
                                <div class="form-group">
                                    <label class="sr-only" for="event_address_url">Location Website</label>                                  
                                    <input type="text" name="event_address_url" id="event_address_url" placeholder="Location Website..." class="f1-twitter form-control">
 
                                </div>
                                <div class="form-group">
                                    <label class="sr-only" for="event_address">Address</label>                                  
                                    <textarea name="event_address" id="event_address"  placeholder="Address..." class="f1-google-plus form-control"></textarea>
                                </div>
                                <div class="form-group">
                                    <label class="sr-only" for="event_location">Google Maps Location</label>                                   
                                    <input type="text" name="event_location" id="event_location" placeholder="Google Maps Location..." class="f1-google-plus form-control">
                                </div>
                                
                                <div class="f1-buttons">
                                    <input type="hidden" name="action" value="wl_ajax_save_event">
                                    <button type="button" class="btn btn-previous">Previous</button>
                                    <button name="submit" type="submit" class="btn btn-submit">Submit</button>
                                    <!--<button  type="button" onclick="save_event();" class="btn">Submit</button>-->
                                </div>
                            </fieldset>
                    	
                    	</form>
                    </div>


  <!-- The Modal -->
  <div id="loadingModal" class="modal">
    <!-- Loading spinner -->
    <div class="loader"></div>
  </div>



<!--

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <div class="container">
            <div class="row">
                <div class="col-md-12">                    
                    <form5 id="event-form555" method="post55" enctype="multipart/form-data">
                        <label>Title:</label>
                        <input type="text" name="event_title" required><br><br>
                        
                        <label>Image Upload:</label>
                        <input type="file" name="event_image" accept="image/*" required><br><br>
                        
                        <label>Start Date and Time:</label>
                        <input type="datetime-local" name="start_datetime" required><br><br>
                        
                        <label>End Date and Time:</label>
                        <input type="datetime-local" name="end_datetime"><br><br>
                        
                        <label>Description:</label>                                               
                        <textarea id="event_description" name="event_description" rows="4" cols="50"></textarea><br><br>

                        <label>Location Name:</label>
                        <input type="text" name="event_address_name" required ><br><br>

                        <label>Location URL:</label>
                        <input type="text" name="event_address_url"><br><br>

                        <label>Location Address:</label>
                        <textarea name="event_address" required></textarea><br><br>

                        <label>Google Maps location:</label>
                        <input type="text" name="event_location"><br><br>    
                        
                        <input type="submit" name="submit" value="Submit">
                    </form>
                </div>
            </div>
        </div>
    </main>
</div>
        -->

  <!-- Javascript -->
<script>
    // Function to handle file input change event
function handleFileSelect(event) {
    const file = event.target.files[0];
    if (!file) {
        return;
    }
    
    // Check if the file is an image
    if (!file.type.match('image.*')) {
        console.log('Selected file is not an image.');
        return;
    }

    const reader = new FileReader();

    reader.onload = function(event) {
        const imgElement = document.getElementById('imageDisplay');
        imgElement.src = event.target.result;
    };

    // Read the file as a data URL
    reader.readAsDataURL(file);
}

// Add event listener to the file input
document.getElementById('event_image').addEventListener('change', handleFileSelect, false);
</script>    


  <script src="<?php echo $this->plugin_url ?>/xassets/js/jquery-1.11.1.min.js"></script>
                    
        <script src="<?php echo $this->plugin_url ?>/xassets/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo $this->plugin_url ?>/xassets/js/jquery.backstretch.min.js"></script>
        <script src="<?php echo $this->plugin_url ?>/xassets/js/retina-1.1.0.min.js"></script>
        <script src="<?php echo $this->plugin_url ?>/xassets/js/newEventForm-scripts.js"></script>
        
        <!--[if lt IE 10]>
            <script src="<?php echo $this->plugin_url ?>/xassets/js/placeholder.js"></script>
        <![endif]-->

