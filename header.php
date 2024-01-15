<?php 
 
session_start();
include "dbconn.php";

$UserSessionData = $_SESSION['UserSessionData'];
if(empty($UserSessionData)){
    header("Location: index.php");
}

$UserID           = $UserSessionData['UserID'];
$FullName         = $UserSessionData['FullName'];
$UserProfileImage = $UserSessionData['UserProfileImage'];
$UserRole         = $UserSessionData['UserRole'];
$LastLoggedIn     = $UserSessionData['LastLoggedIn'];

SaveVisitedPageLogs($UserID);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="images/favicon.ico" type="image/ico" />

    <title>NEC - Dashboard</title>

    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="vendors/iCheck/skins/flat/green.css" rel="stylesheet">
	
    <!-- bootstrap-progressbar -->
    <link href="vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">

    <!-- Datatables -->
    <link href="vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

    <script src="vendors/jquery/dist/jquery.min.js"></script>
  </head>
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span> NEC </span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="production/images/<?php echo $UserProfileImage;?>" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2><?php echo $FullName;?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                

                <ul class="nav side-menu">
                  <li><a href="Dashboard.php"><i class="fa fa-dashboard"></i> Dashboard </a>
                  </li>
                </ul>
                <?php
                  if($UserRole == 1){
                    $UserRoleWiseDisplay = 'display:inline';
                    $DashboardLbl = 'Admin Dashboard';
                  }else if($UserRole == 2){
                    $UserRoleWiseDisplay = 'display:none';
                    $DashboardLbl = 'User Dashboard';
                  }
                ?>
                <ul class="nav side-menu" style="<?php echo $UserRoleWiseDisplay;?>">
                  <li><a><i class="fa fa-users"></i> Users <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="ManageUser.php?mode=add">Add User</a></li>
                      <li><a href="UsersList.php">Users List</a></li>
                    </ul>
                  </li>
                </ul>

                <ul class="nav side-menu">
                  <li><a href="Logout.php"><i class="fa fa-sign-out"></i> Logout </a>
                  </li>
                </ul>

              </div>
              

            </div>
            <!-- /sidebar menu -->

          </div>
        </div>