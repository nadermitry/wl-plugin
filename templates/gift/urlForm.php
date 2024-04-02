<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="<?php echo $this->plugin_url ?>xassets/bootstrap/css/bootstrap.css">
        <link rel="stylesheet" href="<?php echo $this->plugin_url ?>xassets/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="<?php echo $this->plugin_url ?>xassets/css/form-elements.css">
        <link rel="stylesheet" href="<?php echo $this->plugin_url ?>xassets/css/style.css">

<div class="container">
    
    <div id="add-gift-Wizard" class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3 form-box addeventbody">
    
    <form role="form"  action="<?php echo get_permalink() ?>" method="post" enctype="multipart/form-data"  class="f1">
        
            <div class="f1-steps">
                <div class="f1-progress">
                    <div class="f1-progress-line" data-now-value="16.66" data-number-of-steps="3" style="width: 16.66%;"></div>
                </div>
                <div class="f1-step active">
                    <div class="f1-step-icon"><i class="fa fa-info"></i></div>
                    <p>Info</p>
                </div>
                <div class="f1-step ">
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

                <div class="f2-buttons">
                    <button type="submit" id="addGiftSubmit"  class="btn btn-submit">Submit</button>
                </div>
            </fieldset> 
        </form>
    </div>
</div>

<script src="<?php echo $this->plugin_url ?>/xassets/js/jquery-1.11.1.min.js"></script>
                    
                    <script src="<?php echo $this->plugin_url ?>/xassets/bootstrap/js/bootstrap.min.js"></script>
                    <script src="<?php echo $this->plugin_url ?>/xassets/js/jquery.backstretch.min.js"></script>
                    <script src="<?php echo $this->plugin_url ?>/xassets/js/retina-1.1.0.min.js"></script>
                    <script src="<?php echo $this->plugin_url ?>/xassets/js/scripts.js"></script>