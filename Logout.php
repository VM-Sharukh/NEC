<?php 
session_start();
include "dbconn.php";

$UserID = $_SESSION['UserSessionData']['UserID'];
UpdateUserLoggedOutTime($UserID);

unset($_SESSION['UserSessionData']);
$_SESSION['LogoutMsg'] = '<div class="alert alert-success  alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong> User Logout Successfully </strong></div>';
header("Location: index.php");
?>