<?php 

if(isset($_GET['p_id'])){
    
    $the_post_id = $_GET['p_id'];
    
    
}


$query = "SELECT * FROM posts WHERE post_id =" . mysqli_real_escape_string($connection, $_GET['p_id']) .""; 
$select_posts_by_id = mysqli_query($connection, $query);                                
    while($row = mysqli_fetch_assoc($select_posts_by_id)){
        $post_id = $row['post_id'];
        $post_user = $row['post_user'];
        $post_title = $row['post_title'];        
        $post_category_id = $row['post_category_id'];        
        $post_status = $row['post_status'];        
        $post_image = $row['post_image'];        
        $post_tags = $row['post_tags'];        
        $post_content = $row['post_content'];               
        $post_date = $row['post_date'];

    }

    if(isset($_POST['update_post'])){
        
        $post_user = escape($_POST['post_user']);
        $post_title = escape($_POST['title']);        
        $post_category_id = escape($_POST['post_category']);
        $post_status = escape($_POST['post_status']);
        $post_image = $_FILES['image']['name'];        
        $post_image_temp = $_FILES['image']['tmp_name'];        
        $post_content = escape($_POST['post_content']);
        $post_tags = escape($_POST['post_tags']);        
        
    move_uploaded_file($post_image_temp, "../images/$post_image");
        
        if(empty($post_image)){
            
            $query = "SELECT * FROM posts WHERE post_id =" . mysqli_real_escape_string($connection, $_GET['p_id']) ."";
            $select_image = mysqli_query($connection, $query);
            
            while($row = mysqli_fetch_array($select_image)){
                
                $post_image = $row['post_image'];
                
            }
            
        }
        
        
        
$query = " UPDATE posts SET ";
$query .= "post_title = '{$post_title}', ";
$query .= "post_category_id = '{$post_category_id}', ";
$query .= "post_date = now(), ";
$query .= "post_user = '{$post_user}', ";
$query .= "post_status = '{$post_status}', ";
$query .= "post_tags = '{$post_tags}', ";        
$query .= "post_content = '{$post_content}', ";
$query .= "post_image = '{$post_image}' ";        
$query .= "WHERE post_id =" . mysqli_real_escape_string($connection, $_GET['p_id']) .""; //       
       
      $update_post = mysqli_query($connection, $query);  
      
        confirmQuery($update_post);
        
        //echo "<p class='bg-success'> The post has been updated! |" . " " . "<a href='../post.php?p_id={$the_post_id}'> view post </a>|" . "<a href='posts.php'> edit more posts</a> </p>";
        header("Location: posts.php");
    }


?>
   

   
   <form action="" method="post" enctype="multipart/form-data">
    
    <div class="form-group">
        <label for="title">Post Title</label>
        <input value="<?php echo $post_title; ?>" type="text" class="form-control" name="title">
    </div>
    
    <?php
       //thanos gia na emfanizei sto dropdown san prwti epilogh thn catigoria pou exei to post.
       $query_category = "SELECT * FROM categories WHERE cat_id = $post_category_id" ; 
                        $select_categories = mysqli_query($connection, $query_category);

                        confirmQuery($select_categories);
                        
                        while($row = mysqli_fetch_assoc($select_categories)){
                            $cat_id = $row['cat_id'];        
                            $cat_title = $row['cat_title']; 
                        }
       ?>
    
    <div class="form-group">
     <label for="category">Post Category</label>
     <div>
      <select name="post_category" id="post_category">
         <option value="<?php echo $cat_id; ?>"><?php echo $cat_title; // to vriskei apo to query_category ?></option>
          
    <?php 
          
          
                    $query = "SELECT * FROM categories " ; 
                    $select_categories = mysqli_query($connection, $query);
                    
                    confirmQuery($select_categories);
          
                    while($row = mysqli_fetch_assoc($select_categories)){
                    $cat_id = $row['cat_id'];        
                    $cat_title = $row['cat_title'];  
          
                        
                        echo "<option value='{$cat_id}'>{$cat_title}</option>";
                        
                        
                        
                    }
          
          
          
          
          
          
          ?>            
          
          
      </select>
      </div>
    </div>
    
    
<!--
    <div class="form-group">
        <label for="title">Post Author</label>
        <input value="<?php// echo $post_author; ?>" type="text" class="form-control" name="author">
    </div>
-->
   <div class="form-group">
    <label for="post-user">Post User</label><br>
      <select name="post_user" id="post_user">
    <?php echo "<option value='{$post_user}'>{$post_user}</option>"; ?> 
         
    <?php 
                    $query = "SELECT * FROM users WHERE user_role ='administrator' " ; 
                    $select_users = mysqli_query($connection, $query);
                    
                    confirmQuery($select_users);
          
                    while($row = mysqli_fetch_assoc($select_users)){
                    $user_id = $row['user_id'];        
                    $username = $row['username'];  
 
                        echo "<option value='{$username}'>{$username}</option>";   
                        
                    }
          
          ?>      
          
          
          
          
      </select>
    
    </div>
    
    
    <div class="form-group">
    <label for="post_status">Post Status</label>
       <div>
        <select name="post_status" id="">
            <option><?php echo $post_status; ?></option>
            <?php
            
            if($post_status == 'published'){
                
                echo "<option value='draft'>draft</option>";
            } else {
                
                echo "<option value='published'>publish</option>";
            }
            
            ?>
            
            
        </select>
        </div>
    </div>
    

    <div class="form-group">
        <label for="post_image">Post Image</label>
        <div>
        <img width="100" src="../images/<?php echo $post_image; ?>" alt="">
        <input type="file" class="form-control" name="image">
        </div>
    </div>
    
    
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input value="<?php echo $post_tags; ?>" type="text" class="form-control" name="post_tags">
    </div>
    
    
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="editor" cols="30" rows="10"><?php echo $post_content; ?>
        </textarea>
    </div>
    
    
    <div class="form-group">
        <input type="submit" class="btn btn-info" name="update_post" value="Update Post">
        <a href="posts.php" class="btn btn-danger">go back</a>
    </div>
    
    
</form>

<!-- CKeditor code loads from the: js/scripts.js --> 