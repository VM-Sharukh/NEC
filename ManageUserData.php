<?php 
session_start();
// echo "<pre>";print_r($_SESSION);echo "</pre>";
// echo "<pre>";print_r($_POST);echo "</pre>";
// echo "<pre>";print_r($_FILES);echo "</pre>";die();
include "dbconn.php";

$UserID = $_SESSION['UserSessionData']['UserID'];
if($UserID == 0 || $UserID == ''){
	$data['status'] = 'success';
	$data['redirect'] = "Logout.php";
	echo json_encode($data);die();
}
SaveVisitedPageLogs($UserID);

$errors = array();
$status = $message = $redirect = '';

$FullName   = FilterValue($_POST['FullName']);
$EmailID    = FilterValue($_POST['EmailID']);
$Password   = FilterValue($_POST['Password']);
$Gender     = FilterValue($_POST['Gender']);
$mode     	= FilterValue($_POST['mode']);
$id     	= FilterValue($_POST['id']);

if($mode == "UpdateUserStatus"){
	$UpdatedStatus 	= FilterValue($_POST['UpdatedStatus']);
	$status = UpdateUserStatus($UpdatedStatus,$id);
	echo $status;
	die();
}

$CurrentDateTime     = GetCurrentDateTime();

if($FullName == ""){
	$status = 'error';
	$errors['FullNameError'] ="Please Add FullName";
}

if($EmailID == ""){
	$status = 'error';
	$errors['EmailIDError'] ="Please Add EmailID";
}

if($EmailID != ""){
	list($status,$errors['EmailIDError']) = ValidatingEmailId($EmailID,$id);
}

if($Password == ""){
	$status = 'error';
	$errors['PasswordError'] ="Please Add Password";
}

if($Gender == ""){
	$status = 'error';
	$errors['GenderError'] ="Please Select Gender";
}

if(empty($_FILES['UserProfileImage'])){
	if($mode == "add"){
		$status = 'error';
		$errors['UserProfileImageError'] ="Please Upload User Profile Image";
	}else if($mode == "edit"){
		$UserProfileImage = FilterValue($_POST['OldUserProfileImage']);
	}
}

if($status !="error" && isset($_FILES['UserProfileImage'])){
	$file = $_FILES['UserProfileImage'];
	$UploadUserProfileImageData = UploadUserProfileImage($mode,$file);
	$UserProfileImgErrorStatus  = $UploadUserProfileImageData['UserProfileImgErrorStatus'];
	if($UserProfileImgErrorStatus == 'error'){
		$status = 'error';
		$errors['UserProfileImageError'] = $UploadUserProfileImageData['UserProfileImgError'];
	}
	$UserProfileImage  			= $UploadUserProfileImageData['UserProfileImage'];
}


if($status !="error"){
	$status   = 'success';
	$redirect ="UsersList.php";

	$ValidateModeArray = array('add','edit');
	if(in_array($mode, $ValidateModeArray)){
		if($mode == "add"){
			$query="Insert into users(FullName,EmailID,Password,Gender,UserProfileImage,CreatedAt)
			values('$FullName','$EmailID','$Password','$Gender','$UserProfileImage','$CurrentDateTime')";
			$UserMsg = 'User Added Successfully.';
		}else if($mode == "edit"){
			$query="Update users set FullName = '$FullName',EmailID = '$EmailID',Password = '$Password',Gender = '$Gender',UserProfileImage = '$UserProfileImage',LastUpdated = '$CurrentDateTime' Where UserID = '$id'";
			$UserMsg = 'User Details Updated Successfully.';
		}

		$AlertMsgClass = 'alert-success';
		if ($conn->query($query) !== TRUE) {
			$AlertMsgClass = 'alert-danger';
	        $status = 'DBError';
	        $redirect="#";
	    }

	    $message = $_SESSION['SuccessMsg'] = '<div class="alert '.$AlertMsgClass.' alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>'.$UserMsg.' </strong></div>';
	}
}


	
$data['status'] = $status;
$data['errors'] = $errors;
$data['redirect'] = $redirect;
$data['message'] = $message;
echo json_encode($data);
?>