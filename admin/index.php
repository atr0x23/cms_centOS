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
                            Control Panel
                            <small><?php // echo $_SESSION['username']; ?> (dashboard) </small>
                        </h1>
                        
                      <!-- thanos  <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Blank Page
                            </li>
                        </ol> thnos breadcrumb END  -->
                    </div>
                </div>
                <!-- /.row -->
                
                
                <!-- widgets start -->
                
                <div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-newspaper-o fa-5x"></i> <!--  fa fa-file-text fa-5x-->
                    </div>
                    <div class="col-xs-9 text-right">
<?php 
                        
$query = "SELECT * FROM posts";
$select_all_posts = mysqli_query($connection,$query);                        

$all_post_counts = mysqli_num_rows($select_all_posts);                        
  
echo "<div class='huge'>{$all_post_counts}</div>";                        
                        
?>                    
                    
                    
                        <div>All Posts</div>
                    </div>
                </div>
            </div>
            <a href="posts.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>    
                    </div>
                    <div class="col-xs-9 text-right">
<?php 
                        
$query = "SELECT * FROM comments";
$select_all_comments = mysqli_query($connection,$query);                        

$comments_counts = mysqli_num_rows($select_all_comments);                        
  
echo "<div class='huge'>{$comments_counts}</div>";                        
                        
?>

                      <div>All Comments</div>
                    </div>
                </div>
            </div>
            <a href="comments.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-child fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
<?php 
                        
$query = "SELECT * FROM users";
$select_all_users = mysqli_query($connection,$query);                        

$all_users_counts = mysqli_num_rows($select_all_users);                        
  
echo "<div class='huge'>{$all_users_counts}</div>";                        
                        
?>

                        <div>All Users</div>
                    </div>
                </div>
            </div>
            <a href="users.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-list fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
<?php 
                        
$query = "SELECT * FROM categories";
$select_all_categories = mysqli_query($connection,$query);                        

$categories_counts = mysqli_num_rows($select_all_categories);                        
  
echo "<div class='huge'>{$categories_counts}</div>";                        
                        
?>

                         <div>All Categories</div>
                    </div>
                </div>
            </div>
            <a href="categories.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
                
                <!-- widgets end -->
                
                
<?php 
       /* query for the draft posts*/         
$query = "SELECT * FROM posts WHERE post_status = 'draft'";
$select_all_draft_posts = mysqli_query($connection,$query);                        
$post_draft_counts = mysqli_num_rows($select_all_draft_posts);

       /* query for the published posts*/         
$query = "SELECT * FROM posts WHERE post_status = 'published'";
$select_all_published_posts = mysqli_query($connection,$query);                        
$post_published_counts = mysqli_num_rows($select_all_published_posts);
                
       /* query for the approved comments*/         
$query = "SELECT * FROM comments WHERE comment_status = 'approved'";
$select_all_approved_comments = mysqli_query($connection,$query); 
$approved_comment_counts = mysqli_num_rows($select_all_approved_comments);                
                
       /* query for the unapproved comments*/         
$query = "SELECT * FROM comments WHERE comment_status = 'unapproved'";
$select_all_unapproved_comments = mysqli_query($connection,$query); 
$unapproved_comment_counts = mysqli_num_rows($select_all_unapproved_comments);
                
       /* query for the admins */         
$query = "SELECT * FROM users WHERE user_role = 'administrator'";
$select_all_administrators = mysqli_query($connection,$query);                        
$administrators_counts = mysqli_num_rows($select_all_administrators);                
                
       /* query for the subscribers */         
$query = "SELECT * FROM users WHERE user_role = 'subscriber'";
$select_all_subscribers = mysqli_query($connection,$query);                        
$subscribers_counts = mysqli_num_rows($select_all_subscribers);                 
                
                
?>                
                
                
                
                
                <!-- google chart start -->
        <div class="row">
        <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Data','Count'],
        <?php 

        $element_text = ['Draft Posts','Published Posts','Approved Comments','Unapproved Comments','Admin Users','Subscribers','Categories'];
        $element_count = [$post_draft_counts, $post_published_counts, $approved_comment_counts, $unapproved_comment_counts, $administrators_counts, $subscribers_counts, $categories_counts];    

            for($i=0; $i<7; $i++) {
                
                echo "['{$element_text[$i]}'" . "," . "{$element_count[$i]}],";
            }

        ?>            
            
//          ['Posts',100],
        ]);

        var options = {
          chart: {
            title: 'Company Performance',
            subtitle: 'Sales, Expenses, and Profit: 2014-2017',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
       <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
        </div>        
                <!-- google chart end -->
                
                
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include "includes/admin_footer.php" ?>  