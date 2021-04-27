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
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                
                <?php 
                
                if(isset($_GET['category'])){
                    
                    
                    $post_category_id = $_GET['category'];
                    
                    
                }
                
                
                $query = "SELECT * FROM posts WHERE post_category_id = $post_category_id " ; 
                     $select_all_from_posts_query = mysqli_query($connection, $query);
                    
                    while($row = mysqli_fetch_assoc($select_all_from_posts_query)){
                        
                        $post_id = $row['post_id'];
                        $post_title = $row['post_title'];
                        $post_user = $row['post_user'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = substr($row['post_content'],0,100);
                    
                    ?> 
                                  
                        
                     
                <h2><?php echo $post_title ?></h2>
                <p class="lead">
                    by <a href="user_posts.php?user=<?php echo $post_user; ?>&p_id=<?php echo $post_id; ?>"><?php echo $post_user; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image ;?>" alt="">
                <hr>
                <p><?php echo $post_content ?></p>
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>

          <?php } ?>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-sm-3"> </div>

        </div>
        <!-- /.row -->

        <hr>
        

<?php  include "includes/footer.php"; ?>        
