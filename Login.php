<?php 
session_start();
include "dbconn.php";

$errors = array();
$status = $message = $redirect = '';

$EmailID   = FilterValue($_POST['EmailID']);
if($EmailID == ""){
	$status = 'error';
	$errors['EmailIDError'] ="Please Add EmailID";
}

$Password  = $_POST['Password'] ? EncryptData($_POST['Password']) : '';
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