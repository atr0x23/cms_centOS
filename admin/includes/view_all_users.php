<?php

if(isset($_POST['checkBoxArray'])){
    
    
foreach($_POST['checkBoxArray'] as $userValueId ){

    $bulk_options = $_POST['bulk_options'];

    switch($bulk_options) {

    case 'administrator' :

        $query = "UPDATE users SET user_role = '{$bulk_options}' WHERE user_id={$userValueId} ";
        $change_to_admin_role = mysqli_query($connection, $query);
            
        confirmQuery($change_to_admin_role);
            
            break;
            
    case 'subscriber' :

        $query = "UPDATE users SET user_role = '{$bulk_options}' WHERE user_id={$userValueId} ";
        $change_to_subscriber_role = mysqli_query($connection, $query);
        
        confirmQuery($change_to_subscriber_role);
            
            break;
            
    case 'delete' :

        $query = "DELETE FROM users WHERE user_id = {$userValueId} ";
        $delete_query = mysqli_query($connection, $query);        

            break;
    }
        
    }
    
    
    
}


?>

<form action="" method="post">
<div><label for="">Bulk Options</label></div>
<table class="table table-hover">
                           
    <!-- START bulk options -->
    <div id="bulkOptionsContainer" class="col-xs-4">

   <select class="form-control" name="bulk_options" id="">

    <option value="">select action</option>   
    <option value="administrator">administrator</option>   
    <option value="subscriber">subscriber</option>   
    <option value="delete">Delete</option>   

   </select> 

</div> 
              


<div class="col-xs-4">
    <input type="submit" name="submit" class="btn btn-success" value="Apply">
    <a class="btn btn-primary" href="users.php?source=add_user">Add new user</a>     
</div>
                                               
    <!-- END bulk options -->                       
                           
                           
                            <thead style="background-color:lightgray;">
                                <tr>
                                    <th><input id="selectAllboxes" type="checkbox"></th>
                                    <th>Id</th>
                                    <th>Username</th>
                                    <th>Firstname</th>
                                    <th>Lastname</th>
                                    <th>Email</th>
                                    <th>Image</th>
                                    <th>Role</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                       
                            <tbody>
                                
<?php   

$query = "SELECT * FROM users" ; 
$select_users = mysqli_query($connection, $query);                                
    while($row = mysqli_fetch_assoc($select_users)){
        $user_id = $row['user_id'];
        $username = $row['username'];        
        $user_firstname = $row['user_firstname'];        
        $user_lastname = $row['user_lastname'];        
        $user_email = $row['user_email'];        
        $user_image = $row['user_image'];        
        $user_role = $row['user_role'];        
        
        
        echo "<tr>"; ?>
        
        <td><input class="checkBoxes" type="checkbox" name="checkBoxArray[]" value="<?php echo $user_id; ?>"></td>
        
        <?php
        echo "<td>$user_id</td>";
        echo "<td>$username</td>";
        echo "<td>$user_firstname</td>";
        echo "<td>$user_lastname</td>";
        echo "<td>$user_email</td>";
        echo "<td><img width='60' src='../images/$user_image'></td>";
        echo "<td>$user_role</td>";
        echo "<td><a href='users.php?source=edit_user&u_id={$user_id}'>edit</a> | <a href='users.php?delete={$user_id}'>delete</a></td>";
        echo "</tr>";
    }
    
    
?>                               
                                
                            </tbody>
                         </table>
                    </form>
                         
<?php 

if(isset($_GET['delete'])){
    
    if(isset($_SESSION['user_role'])){
        
        if($_SESSION['user_role'] == 'administrator'){
    
    
    $the_user_id = escape($_GET['delete']);
    
    $query = "DELETE FROM users WHERE user_id = {$the_user_id} ";
    $delete_user_query = mysqli_query($connection, $query);
    //header("Location: users.php");
    echo "<p class='bg-success'> User has been deleted!</a> </p>";
        
        
        } else { header("Location: index.php"); }
        
    } else { header("Location: index.php"); }

}


?>