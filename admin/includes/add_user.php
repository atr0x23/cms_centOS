<?php

if(isset($_POST['create_user'])) {
    

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
    
    $user_date = date('y/m/d');
    
    
if(!empty($username) && !empty($user_email) && !empty($user_password)){
    
 
$username = mysqli_real_escape_string($connection, $username);   
$user_email    = mysqli_real_escape_string($connection, $user_email);
$user_password = mysqli_real_escape_string($connection, $user_password);   

$password = password_hash( $user_password, PASSWORD_BCRYPT, array('cost' => 10) );        
            
    
  

$query = " INSERT INTO users( username, user_password, user_firstname, user_lastname, user_email, user_image, user_role, user_date ) ";       
$query .= " VALUES('{$username}','{$password}','{$user_firstname}','{$user_lastname}','{$user_email}','{$user_image}','$user_role','$user_date') "; 
$create_user_query = mysqli_query($connection, $query);
   confirmQuery($create_user_query);
    
    $success_message = "<p class='alert alert-success' role='alert'> The new user has been created! |" . " " . "<a href='users.php'>view users</a></p>";
    $unsuccess_message = "";

}else{ 
        $unsuccess_message = "<div class='alert alert-danger' role='alert'>Fields with <strong>*</strong> are necessary! </div>";
        $success_message = "";
    } 
    
}else {
    
    $unsuccess_message = "";
    $success_message = "";
}
    


?>
  

  
   <form action="" method="post" enctype="multipart/form-data">
    <?php echo $success_message; ?><?php echo $unsuccess_message; ?>
    <div class="form-group">
        <label>Username *</label>
        <input type="text" class="form-control" name="username">
    </div>
    
    
    <div class="form-group">
        <label>User Password *</label>
        <input type="password" class="form-control" name="user_password">
    </div>
    
    
    <div class="form-group">
     <label>User Role</label>
      <div>
      <select name="user_role" id="">
      <option value="subscriber">seletct</option>    
      <option value="subscriber">subscriber</option>    
      <option value="administrator">administrator</option>    
      </select>
      </div>
    </div>
    
    
    <div class="form-group">
        <label>First Name</label>
        <input type="text" class="form-control" name="user_firstname">
    </div>
    
    
    <div class="form-group">
        <label>Last Name</label>
        <input type="text" class="form-control" name="user_lastname">
    </div>
    
    
    <div class="form-group">
        <label>User Email *</label>
        <input type="email" class="form-control" name="user_email">
    </div>
    
    
    <div class="form-group">
        <label>User Image</label>
        <input type="file" class="form-control" name="image">
    </div> 
    
    
    <div class="form-group">
        <input type="submit" class="btn btn-info" name="create_user" value="Add User">
    </div>
    
</form>