<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>
 
<?php 


if(isset($_POST['submit'])){
    
    
   // if(!empty($subject) && !empty($body) && !empty($header)){
    
    
$to      =  "atr0x23@gmail.com";   
$subject =  wordwrap($_POST['subject'],70); // use wordwrap() if lines are longer than 70 characters
$body    =  $_POST['body']; 
$header  =  "From: " . $_POST['email'];    
// send email
mail($to,$subject,$body,$header); 

    
$email_sent = "<div class='alert alert-success' role='alert'> Thank you, your message has been sent! <mark>:)</mark> </div>";
$something_is_wrong = "";
}
//    else{
//
//        $email_sent = "";
//        $something_is_wrong = "<div class='alert alert-danger' role='alert'>Oops, something went wrong! Be sure that you have filled up all the fields and try gain.</div>";
//
//    } 
//
// } 
//
//else{
//         $email_sent = "";
//         $something_is_wrong = ""; }

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
                <h1 class="text-center">Contact Form</h1>
                 
                    <form role="form" action="" method="post" id="login-form" autocomplete="off">
                       <?php echo $something_is_wrong; ?><?php echo $email_sent; ?>
        
                        
                         <div style="margin-bottom: 30px" class="input-group">
                            <label for="email" class="sr-only">Email</label>
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com *">
                        </div>
                        
                        <div style="margin-bottom: 25px" class="input-group">
                            <label for="username" class="sr-only">Subject</label>
                            <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                            <input type="text" name="subject" id="subject" class="form-control" placeholder="Enter a subject">
                        </div>
                        
                         <div style="margin-bottom: 25px" class="input-group">
                            <label for="password" class="sr-only">Your message</label>
                            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                             <textarea name="body" id="body" class="input-group" cols="78" rows="10" placeholder="type your message here..."></textarea>
                        </div>
                        
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-lg btn-primary btn-block" value="Send"><!-- btn btn-custom btn-lg btn-block --> 
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>




<?php include "includes/footer.php";?>
