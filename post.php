<?php  include "includes/header.php"; ?>
    <?php  include "includes/db.php"; ?>

    <!-- Navigation -->
    
<?php  include "includes/navigation.php"; ?>    

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
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
                
    $query = "SELECT * FROM posts WHERE post_id = $the_post_id" ; 
         $select_all_from_posts_query = mysqli_query($connection, $query);

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

          <?php } }else{ header("Location: index.php");} ?>
            
            
            
            <!-- Create Comments -->
                
            <?php 
                
            if(isset($_POST['create_comment'])){
                
                $the_post_id = $_GET['p_id'];
            
            $comment_author = $_POST['comment_author'];    
            $comment_email = $_POST['comment_email'];    
            $comment_content = $_POST['comment_content'];    
            $comment_date = date("Y/m/d");
            $comment_time = date("G:i:s a"); 
                 
                
                if(!empty($comment_author) && !empty($comment_email) && !empty($comment_content)){
                    
                    
            $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date, comment_time)";
                
            $query .= "VALUES ($the_post_id, '{$comment_author}', '{$comment_email}',  '{$comment_content}', 'unapproved', '{$comment_date}', '{$comment_time}')"; 
                
                
            $create_comment_query = mysqli_query($connection,$query);
            
           confirmQuery($create_comment_query);
                
            
            // increasing the post_comment_counter    

//            $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 ";            
//            $query .= "WHERE post_id = $the_post_id ";
//            $update_comment_count = mysqli_query($connection,$query);     
                
            } else {
                    
                echo "<script> alert('the form fields canot be empty!') </script>";    
                    
                }         
                    
                } else{}
    ?>    <!-- END of Create Comments -->
                
                
                
                
                
                

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form action="" method="post" role="form">
                       
                       <div class="form-group">
                            <label>username</label>
                            <input type="text" class="form-control" name="comment_author">
                        </div>
                        
                        <div class="form-group">
                            <label>email</label>
                            <input type="email" class="form-control" name="comment_email">
                        </div>
                       
                        <div class="form-group">
                            <label>your comment</label>
                            <textarea class="form-control" name="comment_content" rows="3"></textarea>
                        </div>
                        <input type="submit" class="btn btn-primary" name="create_comment" value="Submit">
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->
                
                
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

                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author; ?>
                            <small><?php echo"<strong style='color:green'>$comment_date</strong>"; ?> at <?php echo "<strong style='color:green'>$comment_time </strong>"; ?></small>
                        </h4>
                        <?php echo $comment_content; ?>
                    </div>
                </div>
                
        <?php  } ?>        

               
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
            <?php include "includes/sidebar.php" ?>

        </div>
        <!-- /.row -->

        <hr>
        

<?php  include "includes/footer.php"; ?>        
