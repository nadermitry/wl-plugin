<?php defined( 'ABSPATH' ) or die( 'eRROR' ); ?>


<!--<section class="light">-->
	<div class="container py-2">
		<!--<div class="h1 text-center text-dark" id="pageHeaderTitle">My Events</div>-->

        <?php foreach ($results as $result) : $gifts = $this->gifts($result->id); ?> 

            <article class="postcard light blue">
              
                <a class="postcard__img_link" href="<?php echo home_url('/event').'/?eid='.$result->id ?>">
                    <img class="postcard__img" src="<?php echo plugin_dir_url( dirname( __FILE__, 2 ) ) .'assets\images\events\\'. $result->event_image;  ?>" alt="Image Title" />
                </a>
                <div class="postcard__text t-dark">




 


                    <h1 class="postcard__title blue"><a href="<?php echo home_url('/event').'/?eid='.$result->id ?>"><?php echo stripcslashes(sanitize_text_field($result->title)) ?></a></h1>
                    <div class="code">
  <?php if ($result->is_active == 1) :?>
    <span class="badge-active">Active</span>   
  <?php else : ?>  
    <span class="badge-inactive">In-active</span>   
  <?php endif ?>         
</div> 
                    <div class="postcard__subtitle small">
                        <time datetime="2020-05-25 12:00:00">
                            <i class="fas fa-calendar-alt mr-2"></i> <?php echo $this->formatDate($result->start_date);?>
                        </time>
                    </div>
                    <div class="postcard__bar"></div>
                    <div class="postcard__preview-txt"><?php echo stripcslashes(sanitize_text_field($result->description)) ?></div>
                    <ul class="postcard__tagbox">
                       <!-- <li class="tag__item"><i class="fas fa-tag mr-2"></i>Podcast</li>
                        <li class="tag__item"><i class="fas fa-clock mr-2"></i>55 mins.</li>-->
                        <li class="tag__item play blue">
                            <a href="<?php echo home_url('/event').'/?eid='.$result->id ?>">
                            <!--<i class="fas fa-play mr-2"></i>-->
                             Details</a>
                        </li>
                    </ul>
                </div>
            </article>
        <?php endforeach ?>  
        
        <div class="col-lg-12 content-right">
    <div class="bs-content-list"> 
        <div class="col-md-12 text-center  justify-content-between">
            <div class="wl-pagination"> <?php echo $pagination ?> </div>
        </div>
    </div>                  
</div>
	
		
	</div>

    </div>
<!--</section>-->