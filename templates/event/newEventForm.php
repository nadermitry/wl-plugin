<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <div class="container">
            <div class="row">
                <div class="col-md-12">                    
                    <form id="event-form" method="post" enctype="multipart/form-data">
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
                                           
                        <label>Location:</label>
                        <textarea name="event_address_name" required></textarea><br><br>

                        <label>Location URL:</label>
                        <textarea name="event_address_url" ></textarea><br><br>

                        <label>Address:</label>
                        <textarea name="event_address" required></textarea><br><br>

                        <label>Location:</label>
                        <input type="text" name="event_location"><br><br>    
                        
                        <input type="submit" name="submit" value="Submit">
                    </form>
                </div>
            </div>
        </div>
    </main><!-- #main -->
</div><!-- #primary -->