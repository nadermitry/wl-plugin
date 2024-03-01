    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <div class="container">
        <div class="row">
        <!-- First Column -->
        <div class="col-md-1">
            <!-- First Row of First Column -->
            <div class="row">
                <div class="col-md-12"> 
                    <div class="row mt-3">
                        <?php 
                            $nImgno=-1;
                            $strImage="/assets/sysimages/na.jpg";
                            for ($i = 0; $i < $noOfTries; ++$i): 
                              
                            
                            ?>  
                            
                                <?php if ( !is_null($images[$i])):?>                                  
                                <?php if ( isValidImage($images[$i])) : 
                                 //echo ($images[$i]).'<br>';
                                    $nImgno =$nImgno+1?> 
                                    <?php if (  $nImgno < $maxNoOfImages):?> 
                                        <div class="row">
                                            <img WIDTH="60%" src="<?php echo $images[$i] ?>" onclick="imagclicked('<?php echo $images[$i] ?>',<?php echo $nImgno;  ?>);"  class="img-thumbnail" data-target="#carouselExampleIndicators" data-slide-to="0">
                                        </div>
                                    <?php endif ?> 
                                <?php endif ?> 
                                <?php endif ?>    
                            <?php endfor?>
                        <div class="row">  
                            <button id="prevBtn" class="btn btn-secondary" onclick="changeImageSub()"><</button>
                            <button id="nextBtn" class="btn btn-secondary" onclick="changeImageAdd()">></button>
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
                        <form action="<?php echo get_permalink() ?>" method="post">
                            <div class="form-group">
                                <label for="title">Title:</label>
                                <input type="text" class="form-control" id="title" name="title" required value="<?php echo trim($productTitle); ?>">
                                <div class="form-group">
                                    <a target="_blank" href="<?php echo $_POST["url"]; ?>"><img class="img-thumbnail" id="myImage" src="assets/sysimages/loading.gif" alt="loading ..." width="25%"></a>        
                                </div> 
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
                                
                            <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>

<script>

    
    var imgNo =1;
    var lastimgNo =0;
    <?php

    echo "var links = [" ;
    $xcount=0;
    $strArray='';        
    $xcount = 0;
    for ($i = 0; $i < $noOfTries; ++$i) {
        
        if ( isValidImage($images[$i])){
            
            if (  $xcount < $maxNoOfImages)
                {
                $xcount = $xcount+1;
                $strArray =  $strArray  . "'" . $images[$i] ."',";
                }
            }
    }
    echo rtrim($strArray, ',');
    echo "];" ;
    echo "lastimgNo =" . $xcount-1 .";";
    ?>
    


    document.addEventListener('DOMContentLoaded', function() {
    
        imgNo=0;
       
        var image = document.getElementById('myImage');
        var imageUrl = document.getElementById('imageUrl');
       
        if (links[0]===undefined)
        {                
            image.src="assets/sysimages/na.jpg";
            imageUrl.value = ""
        } 
        else
        {             
            image.src = links[0];
            imageUrl.value = links[0]
         } 

         
       
        prevBtn.disabled = true;
        nextBtn.disabled = true ;
        if (lastimgNo>0){nextBtn.disabled = false ;};

         


           // Define an array of image URLs
    var imageUrls = links;

// Get the image container
    var imageContainer = document.getElementById("imageContainer");

// Loop through the image URLs array
    imageUrls.forEach(function(url) {
    // Create a new image element
    var imgElement = document.createElement("img");
    // Add classes and attributes to the image element
    imgElement.classList.add("col-md-2", "vertical-image"); // Bootstrap grid classes and custom class for styling
    imgElement.src = url; // Set the image source
    imgElement.alt = "Image"; // Set the alt attribute
    imgElement.onclick = function() {
        // You can define what happens when an image is clicked here
        //alert("You clicked on image: " + url);

            var  imageUrl1 = document.getElementById('imageUrl');
            var  image1    = document.getElementById('myImage');
            //alert(links[imgNo]);
            image1.src      = url;
            imageUrl1.value = url;

     };
  

    // Append the image element to the image container
        imageContainer.appendChild(imgElement);
    });
   
    
    });

  


    function changeImageAdd() {
      // alert( lastimgNo);
        if (imgNo == (lastimgNo-1) ){nextBtn.disabled = true;};
       
        
        imgNo =imgNo +1;
       
            //if (imgNo > lastImage) {alert('fffffffffff')}
             //alert( imgNo);
            imageUrl = document.getElementById('imageUrl');
            var image = document.getElementById('myImage');
            //alert(links[imgNo]);
            image.src = links[imgNo];
            imageUrl.value= links[imgNo];
            prevBtn.disabled = false;
       
        }


        function changeImageSub() {
         //  alert( lastimgNo);
            if (imgNo == 1 ){prevBtn.disabled = true;};
       
            if (imgNo ==0 ){return false;};
           nextBtn.disabled = false;
        imgNo =imgNo -1;
        imageUrl = document.getElementById('imageUrl');
        var image = document.getElementById('myImage');
            //alert(links[imgNo]);
            image.src = links[imgNo];
            imageUrl.value= links[imgNo];
            
       
        }



        function imagclicked(strimageno,pimgno) {
        // You can define what happens when an image is clicked here
        //alert(lastimgNo);
       //alert(pimgno);
    nextBtn.disabled = false ;
    prevBtn.disabled = false ;
    if (pimgno == 0 ){prevBtn.disabled = true;};
       if (pimgno == lastimgNo ){nextBtn.disabled = true;};
        imgNo=pimgno;
        var  imageUrl1 = document.getElementById('imageUrl');
            var  image1    = document.getElementById('myImage');
            //alert(links[imgNo]);
            image1.src      = strimageno;
            imageUrl1.value = strimageno;
           
           

          

    };


    
</script>


<!-- Bootstrap CSS 
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>   
-->