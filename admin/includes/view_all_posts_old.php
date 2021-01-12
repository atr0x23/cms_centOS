<?php

if(isset($_POST['checkBoxArray'])){
    
    
foreach($_POST['checkBoxArray'] as $postValueId ){

    $bulk_options = $_POST['bulk_options'];

    switch($bulk_options) {

    case 'published' :

        $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id={$postValueId} ";
        $update_to_published_status = mysqli_query($connection, $query);
            
        confirmQuery($update_to_published_status);
            
            break;
            
    case 'draft' :

        $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id={$postValueId} ";
        $update_to_draft_status = mysqli_query($connection, $query);
        
        confirmQuery($update_to_draft_status);
            
            break;
            
            
            
            
    case 'clone' :
            
        $query = "SELECT * FROM posts WHERE post_id = '{$postValueId}' " ; 
        $select_posts_query = mysqli_query($connection, $query);
            confirmQuery($select_posts_query);
            
    while($row = mysqli_fetch_array($select_posts_query)){
        $post_author = $row['post_author'];
        $post_title = $row['post_title'];        
        $post_category_id = $row['post_category_id'];        
        $post_status = $row['post_status'];        
        $post_image = $row['post_image'];        
        $post_tags = $row['post_tags'];        
        $post_content = $row['post_content'];                
        $post_date = $row['post_date'];

    }
    
    $query = " INSERT INTO posts( post_author, post_title, post_category_id, post_status, post_image, post_tags, post_content, post_date ) ";    
    $query .= " VALUES('{$post_author}','{$post_title}','{$post_category_id}','$post_status','{$post_image}','{$post_tags}','{$post_content}',now()) "; 
    $the_clone_query = mysqli_query($connection, $query);
        confirmQuery($the_clone_query);
            
            break;
            
            
            
            
            
    case 'delete' :

        $query = "DELETE FROM posts WHERE post_id = {$postValueId} ";
        $delete_query = mysqli_query($connection, $query);        

            break;
    }
        
    } 
    
}


?>
                        
                         <form action="" method="post">
                         <div><label for="">Bulk Options</label></div>
                          
                           <table class="table table-hover">  <!-- table table-bordered table-hover -->
                           
<div id="bulkOptionsContainer" class="col-xs-4">
  
   <select class="form-control" name="bulk_options" id="">

    <option value="">select an action</option>   
    <option value="published">Publish</option>   
    <option value="draft">Draft</option>   
    <option value="clone">Dublicate</option>   
    <option value="delete">Delete</option>   

   </select> 

</div> 
              


<div class="col-xs-4">
    <input type="submit" name="submit" class="btn btn-success" value="Apply">
    <a class="btn btn-primary" href="posts.php?source=add_post">Add new</a>     
</div>
   
    
                                                                                                      
                                                      
                <thead style="background-color:lightgray;">
                    <tr>
                        <th><input id="selectAllboxes" type="checkbox"></th>
                        <th>Id</th>
                        <th>Author</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Views</th>
                        <th>Image</th>
                        <th>Tags</th>
                        <th>Comments</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>

<?php   

$query = "SELECT * FROM posts ORDER BY post_id DESC" ; 
$select_posts = mysqli_query($connection, $query);                                
    while($row = mysqli_fetch_assoc($select_posts)){
        $post_id = $row['post_id'];
        $post_author = $row['post_author'];
        $post_title = $row['post_title'];        
        $post_category_id = $row['post_category_id'];        
        $post_status = $row['post_status'];        
        $post_views = $row['post_views_count'];        
        $post_image = $row['post_image'];        
        $post_tags = $row['post_tags'];        
        $post_comment_count = $row['post_comment_count'];        
        $post_date = $row['post_date'];
        
        echo "<tr>";
         ?>
         
    <td><input class="checkBoxes" type="checkbox" name="checkBoxArray[]" value="<?php echo $post_id; ?>"></td>     
         
         
        <?php 
        echo "<td>$post_id</td>";
        echo "<td>$post_author</td>";
        echo "<td>$post_title</td>";
        
        $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id} " ; 
        $select_categories_id = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($select_categories_id)){
        $cat_id = $row['cat_id'];        
        $cat_title = $row['cat_title'];  
        
        echo "<td>{$cat_title}</td>";
        
        }
        
        
        if($post_status == 'published'){
        echo "<td class='success'>$post_status</td>";}else{  //style='background-color:lightgreen'
           echo "<td class='danger'>$post_status</td>"; 
        }
        echo "<td>$post_views | <a onClick=\"javascript: return confirm('Are you sure about delete all views of this post?'); \" href='posts.php?reset={$post_id}'>reset</a></td>";
        echo "<td><img width='60' src='../images/$post_image'></td>";
        echo "<td>$post_tags</td>";
        echo "<td>$post_comment_count</td>";
        echo "<td>$post_date</td>";
        echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>edit</a> | <a onClick=\"javascript: return confirm('Are you sure?'); \" href='posts.php?delete={$post_id}'>delete</a> | <a href='../post.php?p_id={$post_id}'> view post </a></td>";
        echo "</tr>";
    }
    
    
?>                               
                                
                            </tbody>
                         </table>
</form>                         
                        
<?php 

if(isset($_GET['reset'])){
    
    
    $the_post_id = $_GET['reset'];
    
    $query = "UPDATE posts SET post_views_count = '0'";
    $query .= "WHERE post_id =" . mysqli_real_escape_string($connection, $_GET['reset']) ."";
    $reset_query = mysqli_query($connection, $query);
        confirmQuery($reset_query);
    header("Location: posts.php");
    
}



if(isset($_GET['delete'])){
    
    
    $the_post_id = $_GET['delete'];
    
    $query = "DELETE FROM posts WHERE post_id =" . mysqli_real_escape_string($connection, $_GET['delete']) ."";
    $delete_query = mysqli_query($connection, $query);
        confirmQuery($delete_query);
    header("Location: posts.php");
    
}


?>