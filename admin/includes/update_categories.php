<form action="" method="post">
            <div class="form-group">
            <label for="cat-tile">Edit a category</label>
                            
                    <?php 
                                
                    if(isset($_GET['edit'])){
                        
                        $cat_id = escape($_GET['edit']);            
                                
                    $query = "SELECT * FROM categories WHERE cat_id = $cat_id " ; 
                    $select_categories_id = mysqli_query($connection, $query);
                                
                    while($row = mysqli_fetch_assoc($select_categories_id)){
                    $cat_id = $row['cat_id'];        
                    $cat_title = $row['cat_title'];        
                    ?>
                    
                    
                <input value="<?php if(isset($cat_title)){echo $cat_title;} ?>" type="text" class="form-control" name="cat_title">
                            
                    <?php }}    ?>
                           
                    <?php 
                                //  update query
                                
                     if(isset($_POST['update_category'])){
  
                        $the_cat_title = escape($_POST['cat_title']);
                        $query = "UPDATE categories SET cat_title = '{$the_cat_title}' WHERE cat_id = {$cat_id} ";
                        $update_query = mysqli_query($connection, $query);
                         header("Location: categories.php"); //it refreshes the page
                                
                         if(!$update_query){
                             
                             die("the query failed" . mysqli_error($connection));
                         }       
                     }
                                
                                ?>       
                           
                           
                           
                           
                            </div>
                            <div class="form-group">
                            <input class="btn btn-info" type="submit" name="update_category" value="Update Category">
                            </div>
                            
                        </form>