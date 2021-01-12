<?php include "includes/admin_header.php" ?> 
   
    <div id="wrapper">
        

        <!-- Navigation -->
        <?php include "includes/admin_navigation.php" ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Categories
                            <small><?php// echo $_SESSION['username']; ?></small>
                        </h1>
                      <!-- thanos  <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Blank Page
                            </li>
                        </ol> thnos breadcrumb END  -->
                        
                        <div class="col-xs-6">
                        
                        <?php insert_categories(); ?>
                        
                        <form action="" method="post">
                            <div class="form-group">
                            <label for="cat-tile">Add a category</label>
                            <input class="form-control" type="text" name="cat_title">
                            </div>
                            <div class="form-group">
                            <input class="btn btn-info" type="submit" name="submit" value="add category">
                            </div>
                            
                        </form>
                        
                <?php 
                          //udate and include query
                            
                if(isset($_GET['edit'])){
                    
                    $cat_id = $_GET['edit'];
                    
                    include "includes/update_categories.php";
                    
                    
                }
                            
                            
                ?>      
                        </div>
                        
                        
                    
                        
                                
                        
    <div class="col-xs-6">
            <table class="table table-hover">
                <thead style="background-color:lightgray;">
                        <tr>
                            <th>Cat id</th>
                            <th>Cat name</th>
                            <th>Actions</th>
                        </tr>
                </thead>
                <tbody>   
                              
                <?php findAllCategories();  ?> 
                                
                 <?php  delete_categories(); ?>               
                            
                </tbody>
            </table>
        </div>
                        
                        
                        
                        
                        
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include "includes/admin_footer.php" ?>  