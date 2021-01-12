<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>
 
<?php 

if(isset($_POST['submit'])){
    
$username = $_POST['username'];   
$email    = $_POST['email']; 
$password = $_POST['password'];    
    
    
    if(!empty($username) && !empty($email) && !empty($password)){
    
 
$username = mysqli_real_escape_string($connection, $username);   
$email    = mysqli_real_escape_string($connection, $email);
$password = mysqli_real_escape_string($connection, $password);   

$password = password_hash( $password, PASSWORD_BCRYPT, array('cost' => 12) );        
        
        



$query = "INSERT INTO users (username, user_password, user_email, user_role) ";
$query .= " VALUES('{$username}','{$password}','{$email}','subscriber')";
$register_user_query = mysqli_query($connection, $query);
    confirmQuery($register_user_query);
        
$registration_completed = "<div class='alert alert-success' role='alert'>Thank you, registration completed! Click <a href='#' class='alert-link'> here </a> to login</div>";        
$message = "";
        
}else{ 
        $message = "<div class='alert alert-danger' role='alert'>You have to fill out <b>ALL</b> the form fields!</div>";
        $registration_completed = "";
    } 

} else{ $message = "";
        $registration_completed = "";}

?> 
 


    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1 class="text-center">Registration Form</h1>
                 
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                       <?php echo $message; ?><?php echo $registration_completed; ?>
                        <div style="margin-bottom: 25px" class="input-group">
                            <label for="username" class="sr-only">Username</label>
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter a username *">
                        </div>
                        
                         <div style="margin-bottom: 30px" class="input-group">
                            <label for="email" class="sr-only">Email</label>
                            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com *">
                        </div>
                        
                         <div style="margin-bottom: 25px" class="input-group">
                            <label for="password" class="sr-only">Password</label>
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password *">
                        </div>
                        
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-lg btn-primary btn-block" value="Register"><!-- btn btn-custom btn-lg btn-block --> 
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>

<!--
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
            <h1 class="text-center">Registration Form</h1>
            <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
            <div class="alert alert-warning" role="alert">
              A simple warning alert—check it out!
            </div>                
<div class="form-group has-success has-feedback">
  <label class="control-label sr-only" for="inputSuccess5">Username</label>
  <div class="input-group">
   <span class="input-group-addon">Username</span>
    <input type="username" class="form-control" name="username" aria-describedby="inputGroupSuccess5Status">
  </div>
  <span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
  <span id="inputSuccess5Status" class="sr-only">(success)</span>
</div>
<div class="form-group has-success has-feedback">
  <label class="control-label sr-only" for="inputGroupSuccess4">Email</label>
  <div class="input-group">
   <span class="input-group-addon">Email</span>
    <input type="email" class="form-control" name="email" aria-describedby="inputGroupSuccess4Status">
  </div>
  <span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
  <span id="inputGroupSuccess4Status" class="sr-only">(success)</span>
</div>
<div class="form-group has-success has-feedback">
  <label class="control-label sr-only" for="inputSuccess5">Password</label>
  <div class="input-group">
   <span class="input-group-addon">Password</span>
    <input type="password" class="form-control" name="password" aria-describedby="inputGroupSuccess5Status">
  </div>
  <span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
  <span id="inputSuccess5Status" class="sr-only">(success)</span>
</div>              
               
        <input type="submit" name="submit" class="btn btn-custom btn-lg btn-block" value="Register">       
                </form>        

            </div>
        </div>
    </div>
</section> -->


<?php include "includes/footer.php";?>
