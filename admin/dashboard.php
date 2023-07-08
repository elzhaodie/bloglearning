<?php
session_start();
if((empty($_SESSION['user_role'])) or ($_SESSION['user_role'] !== 'admin')){
    echo "you are not an admin, you're not allowed to access this url";
} else {
?>
<!DOCTYPE html>
<html lang="en">

<head>
<link rel="stylesheet" href="css/style.css">
<?php 
include "includes/db.php";
include "includes/header.php";
include "includes/functions.php";  
?>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>

google.charts.load('current', {packages: ['corechart', 'bar']});
google.charts.setOnLoadCallback(drawBasic);

function drawBasic() {

    var data = google.visualization.arrayToDataTable([
         ['', 'Jumlah Data', { role: 'style' }],
         ['Posts', <?php 
         $result = count_post();
         while($row = mysqli_fetch_assoc($result)){
             ?>
             <?php  echo $row['hasil']?>
         <?php
         }
         ?>, '#337AB7'],
            // RGB value
         ['Comments', <?php
                        $result = count_comments();
                        while($row = mysqli_fetch_assoc($result)){
                            ?>
                            <?php  echo $row['hasil']?>
                        <?php
                        }
                        ?>, '#337AB7'],            // English color name
         ['Users', 
         <?php
                        $result = count_users();
                        while($row = mysqli_fetch_assoc($result)){
                            ?>
                            <?php  echo $row['hasil']?>
                        <?php
                        }
                        ?>
         , '#337AB7'],
         ['Categories', <?php
                        $result = count_categories();
                        while($row = mysqli_fetch_assoc($result)){
                            ?>
                            <?php  echo $row['hasil']?>
                        <?php
                        }
                        ?>, 'color: #337AB7' ], // CSS-style declaration
      ]);

      var options = {
        title: 'Keseluruhan Data Learning Blog',
        hAxis: {
          title: 'Kategori Data',
        },
        vAxis: {
          title: 'Jumlah Data'
        }
      };

      var chart = new google.visualization.ColumnChart(
        document.getElementById('chart_div'));

      chart.draw(data, options);
    }
</script>
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <?php 
                include "includes/navigation.php";
            ?>
            <!-- Top Menu Items -->
            <?php 
                include "includes/top_menu.php";
            ?>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <?php 
                include "includes/sidebar.php";
            ?>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin
                            <small>
                                <?php
                                    if(empty($_SESSION['username'])){
                                        echo "";
                                    } else {
                                        echo $_SESSION['username'];
                                    }
                                ?>
                            </small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i>  <a href="">Categories</a>
                            </li>
                        </ol>
                        <div class="col-lg-12">
                                   
                <!-- /.row -->
                
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                  <div class='huge'>
                    <?php
                        $result = count_post();
                        while($row = mysqli_fetch_assoc($result)){
                            ?>
                            <?php  echo $row['hasil']?>
                        <?php
                        }
                    ?>
                  </div>
                        <div>Posts</div>
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
                     <div class='huge'>
                        <?php
                        $result = count_comments();
                        while($row = mysqli_fetch_assoc($result)){
                            ?>
                            <?php  echo $row['hasil']?>
                        <?php
                        }
                        ?>
                    </div>
                      <div>Comments</div>
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
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    <div class='huge'><?php
                        $result = count_users();
                        while($row = mysqli_fetch_assoc($result)){
                            ?>
                            <?php  echo $row['hasil']?>
                        <?php
                        }
                        ?></div>
                        <div> Users</div>
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
                        <div class='huge'><?php
                        $result = count_categories();
                        while($row = mysqli_fetch_assoc($result)){
                            ?>
                            <?php  echo $row['hasil']?>
                        <?php
                        }
                        ?></div>
                         <div>Categories</div>
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
<div class="row">
<div id="chart_div"></div>
</div>
                <!-- /.row -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
<?php
}
?>


