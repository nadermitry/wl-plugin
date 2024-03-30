<?php defined( 'ABSPATH' ) or die( 'eRROR' ); ?>

  
 






    
        
	<div class="container mt-5 mb-5">
    <div class="wl-event-d-flex wl-event-justify-content-center wl-event-row">
        <div class="col-md-10">           
           
		<?php foreach ($results as $result) : $gifts = $this->gifts($result->id); ?>   
            <div class="wl-event-row wl-event-p-2 bg-white wl-event-border wl-event-rounded wl-event-mt-2">
                <div class="col-md-3 wl-event-mt-1"><img class="img-fluid img-responsive wl-event-rounded product-image" src="<?php echo plugin_dir_url( dirname( __FILE__, 2 ) ) .'assets\images\events\\'. $result->event_image;  ?>"></div>
                <div class="col-md-6 wl-event-mt-1">
                    <h5><?php echo stripcslashes($result->title) ?></h5>
                    <!-- <div class="d-flex flex-row">
                        <div class="ratings mr-2"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></div><span>110</span>
                    </div>-->
                    <div class="wl-event-mt-1 mb-1 spec-1">
                        <span>  <?php echo $this->formatDate($result->start_date);?></span>
                        <!--<span class="dot"></span>
                        <span>Light weight</span>
                        <span class="dot"></span>
                        <span>Best finish<br></span>-->
                    </div>
                    <!-- 
                    <div class="mt-1 mb-1 spec-1">
                        <span>Unique design</span>
                        <span class="dot"></span>
                        <span>For men</span>
                        <span class="dot"></span>
                        <span>Casual<br></span>
                    </div> -->
                    <p class="text-justify  para mb-0"><?php echo $result->description ?> <br><br></p>
                </div>
                <div class="wl-event-align-items-center wl-event-align-content-center col-md-3 wl-event-border-left wl-event-mt-1">
                    <!--<div class="d-flex flex-row align-items-center">
                        <h4 class="mr-1">$15.99</h4><span class="strike-text">$21.99</span>

                    <h6 class="text-success">Free shipping</h6>  </div> -->
                    <div class="wl-event-d-flex wl-event-flex-column mt-4">
						<button onclick="window.location.href='<?php echo home_url('/event').'/?eid='.$result->id ?>'" class="wl-event-btn wl-event-btn-primary  wl-event-btn-sm" >Details</button>
						<button class="wl-event-btn wl-event-btn-outline-primary  wl-event-btn-sm wl-event-mt-2" type="button">Add to wishlist</button>
                    </div>
                </div>
            </div>
        <?php endforeach ?>    	

        </div>
    </div>
</div>


<div class="col-lg-12 content-right">
    <div class="bs-content-list"> 
        <div class="col-md-12 text-center  justify-content-between">
            <div class="wl-pagination"> <?php echo $pagination ?> </div>
        </div>
    </div>                  
</div>
