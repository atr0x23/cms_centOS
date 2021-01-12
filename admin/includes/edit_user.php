<?php 

if(isset($_GET['u_id'])){
    
    $the_user_id = escape($_GET['u_id']);
    
    
}


$query = "SELECT * FROM users WHERE user_id = $the_user_id " ; 
$select_users_by_id = mysqli_query($connection, $query);                                
    while($row = mysqli_fetch_assoc($select_users_by_id)){
        $user_id = $row['user_id'];
        $username = $row['username'];
        //$user_password = $row['user_password'];
        $user_firstname = $row['user_firstname'];        
        $user_lastname = $row['user_lastname'];        
        $user_email = $row['user_email'];        
        $user_image = $row['user_image'];        
        $user_role = $row['user_role']; 

    }

        if(isset($_POST['update_user'])){

        //$user_id = $_POST['user_id'];        
        $username = escape($_POST['username']);        
        $user_password = escape($_POST['user_password']);
        $user_role = escape($_POST['user_role']);
        $user_firstname = escape($_POST['user_firstname']);
        $user_lastname = escape($_POST['user_lastname']);
        $user_email = escape($_POST['user_email']);

        $user_image = escape($_FILES['image']['name']);        
        $user_image_temp = escape($_FILES['image']['tmp_name']);        

        move_uploaded_file($user_image_temp, "../images/$user_image");
        
                    if(empty($user_image)){

                        $query = "SELECT * FROM users WHERE user_id = $the_user_id ";
                        $select_image = mysqli_query($connection, $query);

                        while($row = mysqli_fetch_array($select_image)){

                            $user_image = $row['user_image'];

                        }

                    }

//kanei kryptografisi sto password ean tou exoume kanei allages

if(!empty($user_password)){
            
$user_password = mysqli_real_escape_string($connection, $user_password);   

$hashed_password = password_hash( $user_password, PASSWORD_BCRYPT, array('cost' => 10) );          
            
// ! kryptografisi 
 
$query = " UPDATE users SET ";
$query .= "username = '{$username}', ";
$query .= "user_password = '{$hashed_password}', ";
$query .= "user_role = '{$user_role}', ";
$query .= "user_firstname = '{$user_firstname}', ";        
$query .= "user_lastname = '{$user_lastname}', ";
$query .= "user_email = '{$user_email}', ";        
$query .= "user_image = '{$user_image}' ";        
$query .= "WHERE user_id = {$the_user_id} ";        
       
      $update_user = mysqli_query($connection, $query);  
        confirmQuery($update_user);
            echo "<p class='alert alert-success' role='alert'> The user changes has been done! |" . " " . "<a href='users.php'>view users</a></p>";

        } else{
    

$query = " UPDATE users SET ";
$query .= "username = '{$username}', ";
//$query .= "user_password = '{$hashed_password}', ";
$query .= "user_role = '{$user_role}', ";
$query .= "user_firstname = '{$user_firstname}', ";        
$query .= "user_lastname = '{$user_lastname}', ";
$query .= "user_email = '{$user_email}', ";        
$query .= "user_image = '{$user_image}' ";        
$query .= "WHERE user_id = {$the_user_id} ";        
       
      $update_user = mysqli_query($connection, $query);  
        confirmQuery($update_user);
            echo "<p class='alert alert-success' role='alert'> The user changes has been done! |" . " " . "<a href='users.php'>view users</a></p>";            
            
        }
    } //end isset update_user
        else{}
?>
   

   
   <form action="" method="post" enctype="multipart/form-data">
    
    <div class="form-group">
        <label for="username">Username</label>
        <input value="<?php echo $username; ?>" type="text" class="form-control" name="username">
    </div>
    
    
    <div class="form-group">
            <label for="user-password">Change Password <small>(empty, if you want NO change)</small></label>
            <input type="password" class="form-control" name="user_password">
        </div> 
    
    
    <div class="form-group">
     <label for="user-role">Role</label>
     <div>
      <select name="user_role" id="">
         <option value="<?php echo $user_role ;?>"><?php echo $user_role ;?></option>"
          
    <?php 
            if ($user_role == 'administrator'){
                
        echo "<option value='subscriber'>subscriber</option>"; 
                
            }else {
                
    echo "<option value='administrator'>administrator</option>";
                
            }

          ?>      
      </select>
      </div>
    
    </div>
    
    
    <div class="form-group">
        <label for="user-firstname">First Name</label>
        <input value="<?php echo $user_firstname; ?>" type="text" class="form-control" name="user_firstname">
    </div>
    
    
    
    <div class="form-group">
        <label for="user-lastname">Last Name</label>
        <input value="<?php echo $user_lastname; ?>" type="text" class="form-control" name="user_lastname">
    </div>
    
    
    <div class="form-group">
        <label for="user-email">Email</label>
        <input value="<?php echo $user_email; ?>" type="email" class="form-control" name="user_email">
    </div>
    
    
    <div class="form-group">
        <label for="user-image">Image</label>
        <img width="80" src="../images/<?php echo $user_image; ?>" alt="">
        <input type="file" class="form-control" name="image">
    </div>
    
    
    <div class="form-group">
        <input type="submit" class="btn btn-info" name="update_user" value="Update User">
        <a href="users.php" class="btn btn-danger">go back</a>
    </div>
    
</form>