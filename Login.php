<?php 
session_start();
// error_reporting(0);
// echo "<pre>";print_r($_SESSION);echo "</pre>";
// echo "<pre>";print_r($_POST);echo "</pre>";
// echo "<pre>";print_r($_FILES);echo "</pre>";die();
include "dbconn.php";

$errors = array();
$status = $message = $redirect = '';

// $EmailID   = mysqli_real_escape_string($conn,$_POST['EmailID']);
// $Password  = mysqli_real_escape_string($conn,$_POST['Password']);

$EmailID   = FilterValue($_POST['EmailID']);
$Password  = FilterValue($_POST['Password']);

if($EmailID == ""){
	$status = 'error';
	$errors['EmailIDError'] ="Please Add EmailID";
}

if($Password == ""){
	$status = 'error';
	$errors['PasswordError'] ="Please Add Password";
}

if($EmailID != "" && $Password != ""){
	list($status,$errors['EmailIDError'],$UserID) = ValidatingLoginEmailId($EmailID,$Password);
}

if($status !="error"){
	$GetUserDetails = GetUserDetails($UserID);
	$UserSessionData = array(
		'UserID'=>$UserID,
		'FullName'=>$GetUserDetails['FullName'],
		'UserProfileImage'=>$GetUserDetails['UserProfileImage'],
		'UserRole'=>$GetUserDetails['UserRole'],
		'LastLoggedIn'=>$GetUserDetails['LastLoggedIn']
	);
	// echo "<pre>";print_r($UserSessionData);die();
	$_SESSION['UserSessionData'] = $UserSessionData;

	SaveLoggedInDetails($UserID);
	UpdateUserLoggedInTime($UserID);
	SaveVisitedPageLogs($UserID);
	
	$status = 'success';
	$redirect="Dashboard.php";
}


	
$data['status'] = $status;
$data['errors'] = $errors;
$data['redirect'] = $redirect;
$data['message'] = $message;
echo json_encode($data);
?>