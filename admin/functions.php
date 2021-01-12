<?php 

function escape($string){
    
    global $connection;
    
   return mysqli_real_escape_string($connection, trim($string));
    
}



function admins_online(){
    
    
    if(isset($_GET['onlineadmins'])) {
    
    global $connection;
        
    if(!$connection){
        
        session_start();
        include("../includes/db.php");
        
$session = session_id();
$time = time();
$time_out_in_seconds = 30;
$time_out = $time - $time_out_in_seconds ;


$query = "SELECT * FROM admins_online WHERE session ='$session'";
$send_query = mysqli_query($connection, $query);
$count = mysqli_num_rows($send_query);

    if($count == NULL){
        
    mysqli_query($connection, "INSERT INTO admins_online(session, time) VALUES('$session','$time')");    
  
    }else{
        
     mysqli_query($connection, "UPDATE admins_online SET time = '$time' WHERE session = '$session'");      
        
    }

$admins_online_query = mysqli_query($connection, "SELECT * FROM admins_online WHERE time > '$time_out'");
echo $count_admins = mysqli_num_rows($admins_online_query);        
    
    }    
    
} // get request isset    
}

admins_online();



function confirmQuery($result) {
    
    global $connection;
    
     if(!$result){
        
        die("Query Faild ! " . mysqli_error($connection));
        
        
    }
    
}



function insert_categories(){
    
    global $connection;
    
    if(isset($_POST['submit'])) {
                                
        $cat_title = $_POST['cat_title'];
        if($cat_title == "" || empty($cat_title)){ 
                                    
            echo "einai adeio rei !";
                                    
            } else {
                                    
        $query = "INSERT INTO categories(cat_title) ";
        $query .= " VALUE('{$cat_title}') ";
                                    
        $create_category_query = mysqli_query($connection, $query);
                                                                
        if(!$create_category_query){
                                        
        die('Query Failed' . mysqli_error($connection));
                        }
            }
                                
        }
      
}



function findAllCategories(){
    
    
    global $connection;
    
    
 $query = "SELECT * FROM categories" ; 
 $select_categories = mysqli_query($connection, $query);                                
    while($row = mysqli_fetch_assoc($select_categories)){
        $cat_id = $row['cat_id'];        
        $cat_title = $row['cat_title'];
        echo "<tr>"; 
        echo "<td>{$cat_id}</td>";
        echo "<td>{$cat_title}</td>";
        echo "<td><a href='categories.php?edit={$cat_id}'><i class='fa fa-edit' style='font-size:24px'></i>  <a onClick=\"javascript: return confirm('Are you sure?'); \" href='categories.php?delete={$cat_id}'><i class='fa fa-remove' style='font-size:24px;color:red'></i></td>";
        //echo "<td><a href='categories.php?edit={$cat_id}'>Edit</td>"; metefera to line apo panw gia na ta emfanizei stin idia stili
        echo "</tr>";
        }       
    
}



function delete_categories(){
    
    
global $connection;  
    

    if(isset($_GET['delete'])){
  
        $the_cat_id = $_GET['delete'];
        $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id}";
        $delete_query = mysqli_query($connection, $query);
        
        header("Location: categories.php"); //it refreshes the page
        }

}





?>