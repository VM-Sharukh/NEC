<?php 
  include "header.php";

  $mode = $_GET['mode'];
  $id = 0;
  $ValidateModeArray= array('add','edit');
  if(!in_array($mode, $ValidateModeArray)){
  		header("Location: Dashboard.php");
  }

  $PageTitle = 'Add User';
  $BtnTitle = 'Add';
  if($mode == 'edit'){
  		$id = $_GET['id'];
  		$GetUserDetails = GetUserDetails($id);
  		// echo "<pre>";print_r($GetUserDetails);echo "</pre>";die();
  		if(empty($GetUserDetails)){
  			header("Location: UsersList.php");
  		}

  		$PageTitle = 'Edit User';
  		$BtnTitle = 'Update';
  }

?>

<!-- page content -->
<div class="right_col" role="main">
	<div class="">

		<div class="row">
			<div class="col-md-12 ">
				<div class="x_panel">
					<div class="x_title">
						<h2><?php echo $PageTitle;?></h2>
						<div class="clearfix"></div>
					</div>
					<div class="row">
                <div class="col-md-12 success_message">
                </div>
          </div>
					<div class="x_content">

						<!-- start form for validation -->
						<form action="ManageUserData.php" method="POST" id="ManageUserForm" enctype="multipart/form-data">

							<div class="form-group row ">
									
									<div class="col-md-4 col-sm-4 ">
										<label class="control-label" for="FullName">Full Name</label>
										<input value="<?php echo $GetUserDetails['FullName'];?>" type="text" id="FullName" class="form-control" name="FullName" placeholder="FullName">
										<div class="error_msg FullNameError"></div>
									</div>

									<div class="col-md-4 col-sm-4 ">
										<label class="control-label" for="EmailID">Email ID</label>
										<input value="<?php echo $GetUserDetails['EmailID'];?>" type="text" id="EmailID" class="form-control" name="EmailID" placeholder="Email ID">
										<div class="error_msg EmailIDError"></div>
									</div>

									<div class="col-md-4 col-sm-4 ">
										<label class="control-label" for="Password">Password</label>
										<input value="<?php echo $GetUserDetails['Password'];?>" type="text" id="Password" class="form-control" name="Password" placeholder="Password">
										<div class="error_msg PasswordError"></div>
									</div>
							</div>

							 <br>

							<div class="form-group row ">
									<div class="col-md-4 col-sm-4 ">
										<label class="control-label" for="Gender">Gender</label> <br>
										Male: <input type="radio" class="flat" id="GenderM" name="Gender" value="1"> 
										Female: <input type="radio" class="flat" id="GenderF" name="Gender" value="2">
										<div class="error_msg GenderError"></div>
									</div>

									<div class="col-md-4 col-sm-4 ">
										<label class="control-label" for="Gender">Profile Picture</label> <br>
										<input type="file" class="flat" name="UserProfileImage">
										<img id="UserProfileImage" src="<?php echo "production/images/".$GetUserDetails['UserProfileImage']?>" 
										 width="100" height="100">

										<div class="error_msg UserProfileImageError"></div>
									</div>
							</div>
							<br>
							<input type="hidden" value="<?php echo $mode?>" name="mode">
							<input type="hidden" value="<?php echo $id?>" name="id">
							<input type="hidden" value="<?php echo $GetUserDetails['UserProfileImage']?>" name="OldUserProfileImage">
							<input type="submit" class="btn btn-success " value="<?php echo $BtnTitle?>">
							<input type="button" class="btn btn-primary" onclick="RedirectBackBtn()"  value="Back">

						</form>
						<!-- end form for validations -->

					</div>
				</div>


			</div>


		</div>


	</div>
</div>
<!-- /page content -->
<script>
	$(function(){
		var mode = $("input[name=mode]").val();
		ValidateGenderChecked(mode);
		ValidateUserProfileImage(mode);
	});

	function ValidateGenderChecked(mode){
		$("input[name=Gender]").prop('checked', false);
		if(mode == 'add'){
			$('#GenderM').prop('checked', true);
		}
		else if(mode == 'edit'){
			var Gender = "<?php echo $GetUserDetails['Gender']?>";
			var GenderCheckedID = (Gender == 1) ? 'GenderM' : 'GenderF';
			$("#"+GenderCheckedID).prop('checked', true);
		}

	}

	function ValidateUserProfileImage(mode){
		$("#UserProfileImage").hide();
		if(mode == 'edit'){
			$("#UserProfileImage").show();
		}

	}

	function RedirectBackBtn(){
		window.location.href = 'UsersList.php';
	}
</script>
<?php 
  include "footer.php";
?>