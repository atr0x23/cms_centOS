<?php  include "includes/header.php"; ?>
    <?php  include "includes/db.php"; ?>

    <!-- Navigation -->
    
<?php  include "includes/navigation.php"; ?>    

    <!-- Page Content -->
    <div class="container">

        <div class="row">
        <div class="col-sm-3"> </div>
            <!-- Blog Entries Column -->
            <div class="col-sm-6">

                <h1 class="page-header">
                    Page with the posts
                    <!-- <small>Secondary Text</small> -->
                </h1>

                <!-- First Blog Post -->
                
                <?php 
                
                if(isset($_GET['p_id'])){
                    
                    $the_post_id = $_GET['p_id'];
                    
     // increases the post views counter, every time a user clicks on a specific post               
    $query = "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id = $the_post_id";
    $views_query = mysqli_query($connection, $query);
            confirmQuery($views_query);            
    // END post views counter            
    
    
    //check if the user is admin, to echo all the posts and not only the published ones.
    if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'administrator'){

        $query = "SELECT * FROM posts WHERE post_id = $the_post_id";

    } else{

        $query = "SELECT * FROM posts WHERE post_id = $the_post_id AND post_status = 'published'" ;
    }
         $select_all_from_posts_query = mysqli_query($connection, $query);

         if(mysqli_num_rows($select_all_from_posts_query) < 1) {

            echo "<h2 class='text-center'> There are no posts available </h2>";

         } else {
          

        while($row = mysqli_fetch_assoc($select_all_from_posts_query)){

            $post_id = $row['post_id'];
            $post_title = $row['post_title'];
            $post_user = $row['post_user'];
            $post_date = $row['post_date'];
            $post_image = $row['post_image'];
            $post_content = $row['post_content'];
                    
                    ?>    
                        
                     
                <h2><?php echo $post_title ?></h2>
                <p class="lead">
                    by <?php echo $post_user ?>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image ;?>" alt="">
                <hr>
                <p><?php echo $post_content ?></p>
            <!--    <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a> -->

                <hr>

          <?php }  ?>
            
             <!-- title on the comments section -->
             <div>
                <h3 class="comment_sec-title">
                Comments about the article.
                </h3>        
            </div> 
            <hr>
            <!-- Comments Form -->
            <a href="#demo" class="btn btn-info" data-toggle="collapse">Make a comment</a>
                <div id="demo" class="collapse">
                    <div class="cf">
                        <!-- <h4>a form title here</h4> -->
                        <form action="" method="post" role="form">
                        
                            <div><input type="text" placeholder="username" required name="comment_author"></div>
                            <div><input type="email" placeholder="email" required name="comment_email"></div>
                            <div><textarea placeholder="your comment..." rows"10" required name="comment_content"></textarea></div>

                            <input type="submit" class="btn btn-primary" name="create_comment" value="Submit">
                        </form>
                    </div>
                </div>
                <!-- End of Comments Form -->
            
            
            <!-- Create Comments -->
                
            <?php 
                
            if(isset($_POST['create_comment'])){
                
            $the_post_id = $_GET['p_id'];
            $comment_author = $_POST['comment_author'];
            $comment_email = $_POST['comment_email'];       
            $comment_content = $_POST['comment_content'];    
            $comment_date = date("Y/m/d");
            $comment_time = date("G:i:s a"); 
                 
                
                if(!empty($comment_author) && !empty($comment_content)){
                    
                    
            $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date, comment_time)";
                
            $query .= "VALUES ($the_post_id, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'unapproved', '{$comment_date}', '{$comment_time}')"; 
                
                
            $create_comment_query = mysqli_query($connection,$query);
            
           confirmQuery($create_comment_query);

            //notify user that his comment has been entered.
           echo "<script> alert('thank you psofo, wait for admin approval') </script>";
            
            // increasing the post_comment_counter    

//            $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 ";            
//            $query .= "WHERE post_id = $the_post_id ";
//            $update_comment_count = mysqli_query($connection,$query);     
                
            } else {
                    
                echo "<script> alert('the form fields canot be empty!') </script>";    
                    
                }         
                    
                } else{}
    ?>    <!-- END of Create Comments -->

          <!-- START of Show Comments -->
    <?php            
          $query = "SELECT * FROM comments WHERE comment_post_id = {$the_post_id} ";
        $query .= "AND comment_status = 'approved' ";
        $query .= "ORDER BY comment_id DESC ";
        $select_comment_query = mysqli_query($connection, $query);
            confirmQuery($select_comment_query);
        
        
        while($row = mysqli_fetch_array($select_comment_query)){
            
        $comment_date = $row['comment_date'];
        $comment_content = $row['comment_content'];
        $comment_author = $row['comment_author'];      
        $comment_time = $row['comment_time'];      
                
        ?>
                <!-- The Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        
                        <h4 class="media-heading"><?php echo $comment_content; ?></h4>
                        <small><?php echo $comment_author; ?> <?php echo"<strong style='color:green'>$comment_date</strong>"; ?> at 
                            <?php echo "<strong style='color:green'>$comment_time </strong>"; ?></small>
                        
                    </div>
                </div>   
        <?php } ?>        
                     
          <!-- END of Show Comments --> 

                

                <hr>

                
                
  

  
                     
        
                
        <?php } }else{ header("Location: index.php");} ?>        

               
                        <!-- Nested Comment --
                        <div class="media">
                            <a class="pull-left" href="#">
                                <img class="media-object" src="http://placehold.it/64x64" alt="">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">Nested Start Bootstrap
                                    <small>August 25, 2014 at 9:30 PM</small>
                                </h4>
                                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                            </div>
                        </div>
                        <-- End Nested Comments -->
            
                        

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-sm-3"> </div>

        </div>
        <!-- /.row -->

        <hr>
        

<?php  include "includes/footer.php"; ?>        
