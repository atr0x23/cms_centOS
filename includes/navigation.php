<nav style="box-shadow: 1px 5px 5px #717171;" class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">CMS Front</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
               
               
            <div class="centerd">
                <ul class="nav navbar-nav">
                    
                      
                      
                      <?php
                     $query = "SELECT * FROM categories" ; 
                     $select_all_categories_query = mysqli_query($connection, $query);
                    
                    while($row = mysqli_fetch_assoc($select_all_categories_query)){
                        
                       $cat_title = $row['cat_title'];
                       $cat_id = $row['cat_id'];

                       $category_class = ''; // active navigation links  ***start***
                       $registration_class = '';
                       $contact_class = '';
                       
                       $pageName = basename($_SERVER['PHP_SELF']);

                       $registration = 'registration.php';
                       $contact = 'contact.php';

                       if(isset($_GET['category']) && $_GET['category'] == $cat_id){

                        $category_class = 'active';

                       } elseif($pageName == $registration){

                        $registration_class = 'active';
                       } elseif($pageName == $contact){

                        $contact_class = 'active';
                       } // active navigation links  ***end***

                       echo "<li class='$category_class'><a href='category_posts.php?category=$cat_id&cat_title=$cat_title'>{$cat_title}</a></li>";

                    }
                    
                    
                      ?>
                      
                    <li><a href="admin">Admin</a></li>               
                    <li class='<?php echo $registration_class;?>'><a href="registration.php">Register</a></li>
                    <li class='<?php echo $contact_class;?>'><a href="contact.php">Contact</a></li>

                        <?php if(isset($_SESSION['user_role'])):?>
                        <li><a href="includes/logout.php" class="btn btn-link">Logout</a></li>
                        <?php else: ?> 
                    <li><a onclick="document.getElementById('id01').style.display='block'">Login</a></li>
                        <?php endif; ?>
                        <!-- <li><a href="">Online now:<span class="online_users"></span></a></li> -->
                                    
                                    
                            
                            
                        
                        
                    <?php
                        
                        if(isset($_SESSION['user_role'])) {
                            
                            if($_SESSION['user_role'] == 'administrator'){
                            
                            if(isset($_GET['p_id'])){
                                
                                $the_post_id = $_GET['p_id'];
                                
                                echo "<li><a href='admin/posts.php?source=edit_post&p_id={$the_post_id}'>Edit Post</a></li>";
                            }
                            
                            }
                            
                        }           
                                    
                        ?>
                
                
                    <!-- <li>
                                <a href="#">Services</a>
                            </li>
                            <li>
                                <a href="#">Contact</a>
                            </li>-->
                
                
                </ul>
            </div>  
                
                
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <div id="id01" class="modal">
        <form class="modal-content animate" action="includes/login.php" method="post">
            <div class="imgcontainer">
            <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
            <img src="img_avatar2.png" alt="Avatar" class="avatar">
            </div>

            <div class="modal-container">
            <label for="uname"><b>Username</b></label>
            <input type="text" class="for_the_inputs" placeholder="Enter Username" name="username" required>

            <label for="psw"><b>Password</b></label>
            <input type="password" class="for_the_inputs" placeholder="Enter Password" name="password" required>
                
            <button class="login-button" name="login" type="submit">Login</button>
            <label>
                <input type="checkbox" checked="checked" name="remember"> Remember me
            </label>
            </div>

            <div class="modal-container" style="background-color:#f1f1f1">
            <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
            <span class="psw">Forgot <a href="#">password?</a></span>
            </div>
        </form>
    </div>