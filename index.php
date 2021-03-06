<?php  include "includes/header.php"; ?>
    <?php  include "includes/db.php"; ?>

    <!-- Navigation -->
    
<?php  include "includes/navigation.php";?>    

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
                
                $per_page = 3; //how many posts appear per page
                $count = 0;

                if(isset($_GET['page'])){
                    
                $page = escape($_GET['page']);    
                }else{ $page=""; }
                
                if($page == "" || $page == 1){
                    
                    $page_1 = 0;
                }else {
                    
                    $page_1 = ($page * $per_page) - $per_page;
                }
                
                //check if the user is admin or another.
                if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'administrator'){

                    $query = "SELECT * FROM posts";

                    } else{

                    $query = "SELECT * FROM posts WHERE post_status = 'published'" ;
        
                        }

                //query to select all the posts and after to check the base if there are or is empty. 
                $count_query = mysqli_query($connection, $query);
                $count = mysqli_num_rows($count_query);
                 //check if there are posts
                 if($count < 1){

                     echo "<h2 class='text-center'>Sorry, there are no published posts!</h2>";
                } else{

                    //check if the user is admin, to echo all the posts and not only the published ones.
                if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'administrator'){

                    $query = "SELECT * FROM posts LIMIT $page_1, $per_page";

                    } else{

                    $query = "SELECT * FROM posts WHERE post_status = 'published' LIMIT $page_1, $per_page" ;

                        }
                 $select_published_from_posts_query = mysqli_query($connection, $query);

                    while($row = mysqli_fetch_assoc($select_published_from_posts_query)){

                        $post_id = $row['post_id'];
                        $post_title = $row['post_title'];
                        $post_user = $row['post_user'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = substr($row['post_content'],0,200);
                        $post_status = $row['post_status'];
                        
                    ?>                                   
                    <div class="postboarders">      
                        <h2><?php echo $post_title ?></h2>
                        <p class="lead">
                            by <a href="user_posts.php?user=<?php echo $post_user; ?>&p_id=<?php echo $post_id; ?>"><?php echo $post_user ?></a>
                        </p>
                        <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p>
                        <hr>
                        <a href="post.php?p_id=<?php echo $post_id; ?>">
                            <img class="img-responsive" src="images/<?php echo $post_image ;?>" alt="">
                        </a>
                        <hr>
                        <p><?php echo $post_content ?></p>
                        <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                        <hr class="new3">
                    </div>
          <?php }  } ?>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-sm-3"> </div>
            

        </div>
        <!-- /.row -->

        <hr>
    
    <!-- pagination system --> 
                    
        <ul class="pager">

    <?php 
         $count = ceil($count/$per_page);   
        for($i=1; $i<=$count; $i++){
            
            if($i == $page){
                
            echo "<li><a class='active_link' href='index.php?page={$i}'>{$i}</a></li>";    
                
            }else{
                
            echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";    
                
            }  
            
        }
            
            
    ?>
            
        </ul> <!-- END of pagination system --> 
        

<?php  include "includes/footer.php"; ?>        
