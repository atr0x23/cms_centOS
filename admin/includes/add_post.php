<?php


if(isset($_POST['create_post'])) {
    

    $post_title = escape($_POST['title']);        
    $post_category_id = escape($_POST['post_category']);
    $post_user = escape($_POST['post_user']);
    $post_status = escape($_POST['post_status']);
    
    $post_image = $_FILES['image']['name'];        
    $post_image_temp = $_FILES['image']['tmp_name'];        
    
    $post_tags = escape($_POST['post_tags']);        
    $post_content = escape($_POST['post_content']);        
    $post_date = date('d-m-y');
    $post_views_count = 0;
    
    
    
    move_uploaded_file($post_image_temp, "../images/$post_image");
    
    
$query = " INSERT INTO posts(post_category_id, post_title, post_user, post_date, post_image, post_content, post_tags, post_status, post_views_count) ";    
    
$query .= " VALUES({$post_category_id},'{$post_title}','{$post_user}',now(),'{$post_image}','{$post_content}','{$post_tags}','$post_status','$post_views_count') "; 
    
  
   $create_post_query = mysqli_query($connection, $query);
    
   confirmQuery($create_post_query);
    
    echo "<p class='bg-success'> The new post has been created! |" . " " . "<a href='posts.php'>view all posts</a> </p>";
    
    
}

?>


   
  
   <form action="" method="post" enctype="multipart/form-data">
    
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title">
    </div>
    
    
    <div class="form-group">
    <label for="category">Post Category</label><br>
      <select name="post_category" id="post_category">
          
    <?php 
                    $query = "SELECT * FROM categories " ; 
                    $select_categories = mysqli_query($connection, $query);
                    
                    confirmQuery($select_categories);
          
                    while($row = mysqli_fetch_assoc($select_categories)){
                    $cat_id = escape($row['cat_id']);        
                    $cat_title = escape($row['cat_title']);  
 
                        echo "<option value='{$cat_id}'>{$cat_title}</option>";   
                        
                    }
          
          ?>      
          
          
          
          
      </select>
    
    </div>

   
   <div class="form-group">
    <label for="post-user">Post User</label><br>
      <select name="post_user" id="post_user">
          
    <?php 
                    $query = "SELECT * FROM users WHERE user_role ='administrator' " ; 
                    $select_users = mysqli_query($connection, $query);
                    
                    confirmQuery($select_users);
          
                    while($row = mysqli_fetch_assoc($select_users)){
                    $user_id = escape($row['user_id']);        
                    $username = escape($row['username']);  
 
                        echo "<option value='{$username}'>{$username}</option>";   
                        
                    }
          
          ?>      
          
          
          
          
      </select>
    
    </div>
   
    
    
     <div class="form-group">
    <label for="post_status">Post Status</label>
       <div>
        <select name="post_status" id="">
                <option>draft</option>
                <option>published</option>";
        </select>
        </div>
    </div>    
    
    
    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" class="form-control" name="image">
    </div>
    
    
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>
    
    
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="editor" cols="30" rows="10"></textarea>
    </div>
    
    
    <div class="form-group">
        <input type="submit" class="btn btn-info" name="create_post" value="Add Post">
    </div>
    
</form>

<!-- CKeditor code loads from the: js/scripts.js -->    
       