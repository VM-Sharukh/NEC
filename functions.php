<?php 
error_reporting(0);
function GetCurrentDateTime(){
	$date = date("Y-m-d H:i:s");  
	return $date;
}

function GetDisplayDateTime($date){
    return date("F j, Y, g:i A", strtotime($date));
}

function GetDataEncrytionDetails(){
	return $data = array("AES-128-CTR",'7208131151',"NEC123456",0);
}

function EncryptData($Value) {
    list($Ciphering,$EncryptionIV,$EncryptionKey,$Options) = GetDataEncrytionDetails();
    return $encryption = openssl_encrypt($Value, $Ciphering,$EncryptionKey, $Options, $EncryptionIV);
}

function DecryptData($Value) {
	list($Ciphering,$DecryptionIV,$DecryptionKey,$Options) = GetDataEncrytionDetails();
 	return $decryption=openssl_decrypt($Value, $Ciphering,$DecryptionKey, $Options, $DecryptionIV);
}

function FilterValue($Value){
	global $conn;
    $NewValue = filter_var($Value,FILTER_SANITIZE_STRING);
    $NewValue = mysqli_real_escape_string($conn,$NewValue);
    return $NewValue;
}


function GetUserGender($Value){
	$UserGenderMapArray = array('1'=>'Male','2'=>'Female');
	return $UserGenderMapArray[$Value];
}

function GetUserStatus($Value){
	$UserGenderStatusArray = array('1'=>'Active','0'=>'Inactive');
	return $UserGenderStatusArray[$Value];
}

function IsValidEmail($EmailID){ 
    return filter_var($EmailID, FILTER_VALIDATE_EMAIL) !== false;
}

function ValidatingEmailId($EmailID,$id=0){
	$data = array();
	$status = $EmailIDError = '';
	if(!IsValidEmail($EmailID)) {
		$status = 'error';
		$EmailIDError ="Please Add Valid EmailID";
	}else{
		$UserID = CheckEmailIDExists($EmailID,$id);
		if($UserID > 0){
			$status = 'error';
			$EmailIDError ="EmailID Already Exists.";
		}
	}
	return $data = array($status,$EmailIDError);
}

function ValidatingLoginEmailId($EmailID,$Password){
	$data = array();
	$status = $EmailIDError = '';
	if(!IsValidEmail($EmailID)) {
		$status = 'error';
		$EmailIDError ="Please Add Valid EmailID";
	}else{

		$UserID = GetUserID($EmailID,$Password);
		if($UserID == 0){
			$status = 'error';
			$EmailIDError = "Invalid Credentails. Please Try Again.";
		}else if($UserID > 0 && !FetchUserStatus($UserID)){
			$status = 'error';
			$EmailIDError ="Added EmailID is inactive. Please contact administrator";
		}
	}
	return $data = array($status,$EmailIDError,$UserID);
}

function UpdateUserStatus($UpdatedStatus,$id){
	global $conn;
	$CurrentDateTime = GetCurrentDateTime();
	$query="Update users set UserStatus = '$UpdatedStatus',LastUpdated = '$CurrentDateTime' 
	Where UserID = '$id'";
    $status = ($conn->query($query) !== TRUE) ? 'DBError' : 'success';
    return $status;
}

function GetUserID($EmailID,$Password){
	global $conn;
	$query  = "SELECT UserID FROM users WHERE EmailID='$EmailID' AND Password='$Password'";
	$result = $conn->query($query);
	$UserID = 0;
	if ($result->num_rows > 0){
		$row = $result->fetch_assoc();
		$UserID = $row['UserID'];
	}
	return $UserID;
}

function FetchUserStatus($UserID){
	global $conn;
	$query  = "SELECT UserStatus FROM users WHERE UserID='$UserID'";
	$result = $conn->query($query);
	$UserStatus = 0;
	if ($result->num_rows > 0){
		$row = $result->fetch_assoc();
		$UserStatus = $row['UserStatus'];
	}
	return $UserStatus;
}

function GetUserDetails($UserID){
	global $conn;
	$query  = "SELECT FullName,EmailID,UserRole,Password,Gender,UserStatus,UserProfileImage,LastLoggedIn FROM users 
	WHERE UserID='$UserID'";
	$result = $conn->query($query);
	$UsersDetails = array();
	if ($result->num_rows > 0){
		$UsersDetails = $result->fetch_assoc();
	}
	return $UsersDetails;
}

function GetCountAllUsers($Gender=0){
	global $conn;
	$query  = "SELECT count(UserID) as TotalUsers FROM users WHERE UserRole = 2 ";
	if($Gender > 0) $query.= "AND Gender = '$Gender'"; 
	$result = $conn->query($query);
	$TotalUsers = 0;
	if ($result->num_rows > 0){
		$row = $result->fetch_assoc();
		$TotalUsers = $row['TotalUsers'];
	}
	return $TotalUsers;
}

function GetAllUsersDetails($UserRole=0){
	global $conn;
	$query  = "SELECT UserID,FullName,EmailID,Gender,UserStatus,CreatedAt FROM users ";
	if($UserRole > 0) $query.= "WHERE UserRole = '$UserRole'"; 
	$result = $conn->query($query);
	$UsersDetails = array();
	if ($result->num_rows > 0){
		while($row = $result->fetch_assoc()) {
        	$UsersDetails[] = $row; 
		}
	}
	return $UsersDetails;
}

function CheckEmailIDExists($EmailID,$UserID=0){
	global $conn;
	$query  = "SELECT UserID FROM users WHERE EmailID='$EmailID' ";
	if($UserID > 0) $query.= "AND UserID NOT IN ('$UserID')"; 
	$result = $conn->query($query);
	$UserID = 0;
	if ($result->num_rows > 0){
		$row = $result->fetch_assoc();
		$UserID = $row['UserID'];
	}
	return $UserID;
}

function UploadUserProfileImage($mode,$file){

	$UserProfileImgError = '';
	$UserProfileImgErrorStatus = 'success';

	$CurrentDateTime     = GetCurrentDateTime();

	$file_name 	= 	$file['name'];
	$file_size 	= 	$file['size'];
	$file_tmp 	= 	$file['tmp_name'];
	$file_type	=	$file['type'];
	$file_ext	=	strtolower(end(explode('.',$file_name)));
	$extensions = 	array("jpeg","jpg","png");
	  
	if(!in_array($file_ext,$extensions)){
		$UserProfileImgErrorStatus = 'error';
		$UserProfileImgError ="Please Upload User Profile Image with JPEG/JPG/PNG file.";
	}
	 
	if($file_size > 2097152){
		$UserProfileImgErrorStatus = 'error';
		$UserProfileImgError ="User Profile Image size must be less than 2 MB";
	}
	
	if($status != 'error'){
	  	$str = 'ABCDEFGHIJKLMNPQRSTUVWXYZ-1234567890!abcdefghijklmnopqrstuvwxyz';
	  	$shuffle_value =substr(str_shuffle($str), 0, 15);
	  	$UserProfileImage = strtotime($CurrentDateTime).$shuffle_value.".".$file_ext;

	  	$UserProfileImageLoc  = "production/images/";
	  	$UserProfileImagePath = $UserProfileImageLoc.$UserProfileImage;
		move_uploaded_file($file_tmp,$UserProfileImagePath);

		if($mode == "edit"){
			$OldUserProfileImage 	 = FilterValue($_POST['OldUserProfileImage']);
			$OldUserProfileImagePath = $UserProfileImageLoc.$OldUserProfileImage;
			UnlinkFile($OldUserProfileImagePath);
		}
	}

	$data['UserProfileImgErrorStatus'] = $UserProfileImgErrorStatus;
	$data['UserProfileImgError']       = $UserProfileImgError;
	$data['UserProfileImage']          = $UserProfileImage;
	
	return $data;
}

function UnlinkFile($UserProfileImagePath){
	if(file_exists($UserProfileImagePath))  unlink($UserProfileImagePath);
}


function SaveLoggedInDetails($UserID){
	global $conn;
	$CurrentDateTime = GetCurrentDateTime();
	$query="Insert into user_logged_in_details(UserID,LogginDateTime)
	values('$UserID','$CurrentDateTime')";
    $status = ($conn->query($query) !== TRUE) ? 'DBError' : 'success';
    return $status;
}

function UpdateUserLoggedInTime($UserID){
	global $conn;
	$CurrentDateTime = GetCurrentDateTime();
	$query="Update users set LastLoggedIn = '$CurrentDateTime' 
	Where UserID = '$UserID'";
    $status = ($conn->query($query) !== TRUE) ? 'DBError' : 'success';
    return $status;
}

function UpdateUserLoggedOutTime($UserID){
	global $conn;
	$CurrentDateTime = GetCurrentDateTime();
	$query="Update users set LastLoggedOut = '$CurrentDateTime' 
	Where UserID = '$UserID'";
    $status = ($conn->query($query) !== TRUE) ? 'DBError' : 'success';
    return $status;
}

function SaveVisitedPageLogs($UserID){
	global $conn;

	$CurrentDateTime = GetCurrentDateTime();
	$Protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://"; 
	$PageURL = $Protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . $_SERVER['QUERY_STRING'];
	$ReferrerURL = (!empty($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] :'';  
	$UserIPAddress = $_SERVER['REMOTE_ADDR']; 
	$UserAgent = $_SERVER['HTTP_USER_AGENT']; 

	$query="Insert into user_page_visited_logs(PageURL,ReferrerURL,UserIPAddress,UserAgent,UserID,AddedDateTime)
	values('$PageURL','$ReferrerURL','$UserIPAddress','$UserAgent','$UserID','$CurrentDateTime')";
    $status = ($conn->query($query) !== TRUE) ? 'DBError' : 'success';
    return $status;
}




?>	
