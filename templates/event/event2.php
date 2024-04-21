


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
          <div class="f1-progress-line" data-now-value="16.66" data-number-of-steps="3" style="width: 16.66%;"></div>
      </div>
      <div class="f1-step active">
        <div class="f1-step-icon"><i class="fa fa-gift"></i></div>
        <p>Add Gifts</p>
      </div>
      <div class="f1-step">
        <div class="f1-step-icon"><i class="fa fa-users"></i></i></div>
        <p>Invite Friends</p>
      </div>
        <div class="f1-step">
        <div class="f1-step-icon"><i class="fa fa-map-marker"></i></i></div>
        <p>Summery</p>
      </div>                              
    </div>

    <fieldset>
      <!--<h4>Tell us who you are:</h4>-->
      <div class="container">
        <!-- List -->
        <ul  class="list-group">
          <li id="li0" class="list-group-item">
            <input  class="addEvent  form-control" type="search" id="search" placeholder="Search..." aria-label="Search">
            <!-- You can add a search button if needed -->
            <!-- <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button> -->
          </li>
        </ul>

        <ul id="list" class="list-group">
          <?php foreach ($newgifts as $gift) : ?>
            <li id="li<?php echo $gift->event_gift_id?>" class="list-group-item">
              <img width="65px" src="<?php echo $gift->img_url?>" ?>
              <?php  echo $this->trim_and_add_dots($gift->title,60) ?>
              <div id="giftsControl-G<?php echo $gift->id?>" style="float:right;">  
                <button  onclick="add_to_event(<?php echo $gift->id ?>,<?php echo   $this->eventid ?>)">Add</button>
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
        
      <div class="f1-buttons">                
        <button type="button" class="btn btn-next">Next</button>
      </div>

    </fieldset>

    <fieldset>
      <h4>Invite Friends:</h4>
      <article class="small single">             
        <div class="post-share">
          <div class="post-share-icons cf"> 

            <a class="facebook" href="https://www.facebook.com/sharer.php?u=<?php echo $currentURL ;?>" target="_blank">
              <i class="fab fa-facebook"></i>
            </a>

            <a class="x-twitter" href="http://twitter.com/share?url=<?php echo $currentURL ;?>" target="_blank">
              <i class="fa-brands fa-x-twitter"></i>
            </a>

            <a class="envelope" href="mailto:?subject=<?php echo $result->title; ?>&amp;body=<?php echo $currentURL ;?>" target="_blank">
              <i class="fas fa-envelope-open"></i>
            </a>

            <a class="linkedin" href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo $currentURL ;?>" target="_blank">
              <i class="fab fa-linkedin"></i>
            </a>
            
            <a class="telegram" href="https://t.me/share/url?url=<?php echo $currentURL ;?>&amp;title=<?php echo $result->title; ?>" target="_blank">
              <i class="fab fa-telegram"></i>
            </a>

            <a class="whatsapp" href="https://api.whatsapp.com/send?text=<?php echo $currentURL ;?>" target="_blank">
              <i class="fab fa-whatsapp"></i>
            </a>
                <a class="reddit" href="https://www.reddit.com/submit?url=<?php echo $currentURL ;?>" target="_blank">                
                <i class="fab fa-reddit"></i>
            </a>

            <a class="whatsapp" href="javascript:window.print()"> 
              <i class="fas fa-print"></i>
            </a>

          </div>
        </div>
        <div class="clearfix mb-3"></div>

      </article>

      <div class="f1-buttons">
          <button type="button" class="btn btn-previous">Previous</button>
          <button type="button" class="btn btn-next">Next</button>
      </div>

    </fieldset>

    <fieldset> 
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

<script src="<?php echo $this->plugin_url ?>/xassets/js/jquery-1.11.1.min.js"></script>
<script src="<?php echo $this->plugin_url ?>/xassets/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo $this->plugin_url ?>/xassets/js/jquery.backstretch.min.js"></script>
<script src="<?php echo $this->plugin_url ?>/xassets/js/retina-1.1.0.min.js"></script>
<script src="<?php echo $this->plugin_url ?>/xassets/js/event2-scripts.js"></script>
        
<!--[if lt IE 10]>
    <script src="<?php echo $this->plugin_url ?>/xassets/js/placeholder.js"></script>
<![endif]-->
