<?php defined( 'ABSPATH' ) or die( 'eRROR' ); ?>

<script>
if ("geolocation" in navigator) {
    // Geolocation is available
    navigator.geolocation.getCurrentPosition(function(position) {
        // Success callback
        var latitude = position.coords.latitude;
        var longitude = position.coords.longitude;
        
        // You can do something with the latitude and longitude
        console.log("Latitude: " + latitude + ", Longitude: " + longitude);
    }, function(error) {
        // Error callback
        console.error("Error getting geolocation: ", error.message);
    });
} else {
    // Geolocation is not available
    console.error("Geolocation is not supported by this browser.");
}
</script>    
<style>

    
.products {
    display: grid;
    grid-template-columns: repeat(4, 1fr); /* Change this line */
    gap: 20px;
}

.product {
    position: relative;
    overflow: hidden;
}

.product img {
    width: 100%;
    height: auto;
    display: block;
}

.overlay {
    position: absolute;
    top: 0;
    left: 0;
    background-color: rgba(0, 0, 0, 0.5);
    width: 100%;
    height: 100%;
    opacity: 0;
    transition: opacity 0.3s ease;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

.product:hover .overlay {
    opacity: 1;
}

.overlay h2,
.overlay p,
.overlay button {
    color: #fff;
}

.overlay button {
    background-color: #007bff;
    border: none;
    color: #fff;
    padding: 8px 16px;
    cursor: pointer;
}

.overlay button:hover {
    background-color: #0056b3;
}

</style>









<div class="products">
    <?php foreach ($results as $result) : $gifts = $this->gifts($result->id);?>

        <div class="product">
            <img src="<?php echo plugin_dir_url( dirname( __FILE__, 2 ) ) .'assets\images\events\\'. $result->event_image;  ?>" alt="Product">        
            <div class="overlay">
                <a href="<?php echo home_url('/event').'/?eid='.$result->id ?>">
                    <!--<h2>Product 1</h2>-->
                    <p><?php echo stripcslashes($result->title) ?></p>
                    <button>Edit</button>
                </a>
            </div>
        </div>

    <?php endforeach ?>    
</div>

<div class="col-lg-12 content-right">
    <div class="bs-content-list"> 
        <div class="col-md-12 text-center d-md-flex justify-content-between">
            <div class="navigation pagination"> <?php echo $pagination ?> </div>
        </div>
    </div>                  
</div>