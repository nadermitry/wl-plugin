
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

<style>
  .imageContainer {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    grid-gap: 10px;
    padding: 10px;
  }

  .grid-item {
    background-color: #ddd;
    padding: 20px;
    text-align: center;
  }

  @media (min-width: 576px) {
    /* Small devices (sm) */
    .imageContainer{
      grid-template-columns: repeat(3, 1fr);
    }
  }

  @media (min-width: 768px) {
    /* Medium devices (md) */
    .imageContainer {
      grid-template-columns: repeat(3, 1fr);
    }
  }


  
</style>
<style>





.desc
{
  text-align: center;
  font-weight: normal;
  width: 100%;
  margin: 0px;
  visibility:hidden;
}

div:hover .desc {
  visibility:visible;
}
div.img img {max-width:100%;}
div.img{
  margin: 5px 5px 5px 5px;
  padding:5px;
  box-sizing:border-box;
  /*background:#f1f1f1;*/
  line-height:0px;
  height: auto;
  width: 20%;
  float: left;
  text-align: center;
  -webkit-transition:all 0.5s ease;
  -moz-transition:all 0.5s ease; 
  -o-transition:all 0.5s ease; 
  transition:all 0.5s ease;
  border-radius:4px;
  border-style:solid;
}	
div:hover{line-height:30px;font-size:16px;}
div.img img
{
  display: inline-block;
  /*margin: 3px*/;
}

@keyframes bgfade
{
0%   {opacity:0;}
100% {opacity:1;}
}

@-webkit-keyframes bgfade /* Safari and Chrome */
{
0%   {opacity:0;}
100% {opacity:1;}
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
            <div class="form-group" >
                <label  class="sr-only" for="title" >Title</label>
                <input type="text"  placeholder="Title..." class="addEvent  form-control" id="title" name="title"  >
                </div>
           
            <div class="form-group"  id="imageContainer" >
          
            </div>


            
            <div class="form-group">
                <label for="description">Description:</label>
                 <textarea class="form-control" id="description" name="description" rows="4" cols="50"></textarea>
            </div>
              
               
            <div class="f1-buttons" >                
                <button type="button" class="btn btn-previous">Previous</button>
                <button name="savegift" type="button" class="btn btn-next1">Next</button>
                <!--<button  type="button" onclick="save_event();" class="btn">Submit</button>-->
            </div>    
        </fieldset>

       


        <fieldset>
            <!--  <h4>Set up your account:</h4>-->
            
            <div class="container">
        <div class="row">
        
        <!-- Second Column -->
        
        <div class="col-md-11">
            <!-- First Row of Second Column -->
            <div class="row">
                <div class="col-md-12">
                    <div class="container">
                        <!--<form action="http://localhost/wordpress/?page_id=342" method="post">-->
                    
                            <div class="form-group">
                                <label  class="sr-only" for="title">Title</label>
                                <input disabled type="text"  placeholder="Title..." class="addEvent  form-control" id="title2" name="title2"  >
                                
                            </div>
                            
                            <div class="form-group">
                                   <!--<input type="hidden"  placeholder="url..." class="addEvent  form-control" id="imgurl" name="imgurl"  >-->
                                   <a id="gifturl3" name="gifturl3"  target="_blank" href=""><img class="img-thumbnail" id="myImage" src="assets/sysimages/loading.gif" alt="loading ..." width="25%"></a>        
                            </div> 

               



                            <div class="form-group">                                  
                                <input type="hidden" class="form-control" id="imageUrl" name="imageUrl" required >
                                <input type="hidden" class="form-control" id="url" name="url" required  value="<?php echo $_POST["url"]; ?>">
                            </div>
                            <div class="form-group">
                                <label for="description">Description:</label>
                                <textarea disabled class="form-control" id="description1" name="description1" rows="4" cols="50"></textarea>
                            </div>
                            
                        
                    
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
      <div class="f1-buttons">
                
                <button type="button" class="btn btn-previous">Previous</button>
                <button name="savegift" type="button" class="btn btn-save-gift">Save</button>
                <!--<button  type="button" onclick="save_event();" class="btn">Submit</button>-->
            </div>             
        </fieldset>

        <fieldset>
            <!-- <h4>Social media profiles:</h4>-->
            <div class="form-group">
                <a id="gifturl" href="" target="_blank"> <h3 id="gifttitle"><h3></a>
                <a id="gifturl" href="" target="_blank"><img width="10%" id="giftimage"src=""> </a>
                <p id="giftdescription"></p>  
                <a id="gifturl2" href="" target="_blank"> View on Store <h3></a>
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

