<?php 
  include "header.php";
  $AllUsersDetails = GetAllUsersDetails($UserRole=2);
?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">

      <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
          <div class="x_title">
            <h2>Users List</h2>
            <div class="clearfix"></div>
          </div>
          <div class="row">
                <div class="col-md-12 success_message">
                  <?php 
                  if(isset($_SESSION['SuccessMsg']) && $_SESSION['SuccessMsg'] != ''){
                    echo $_SESSION['SuccessMsg'];
                    unset($_SESSION['SuccessMsg']);
                  }
                  ?>
                </div>
          </div>
          <div class="x_content">

              <div class="row">
                  <div class="col-sm-12">
                    <div class="card-box table-responsive">
	
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" 
            cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Sr No.</th>
                  <th>Full Name</th>
                  <th>Email ID</th>
                  <th>Gender</th>
                  <th>Status</th>
                  <th>Created At</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $i = 0;
                foreach ($AllUsersDetails as $UsersDetails) {
                    $i++;
                    $UserID       = $UsersDetails['UserID'];
                    $FullName     = $UsersDetails['FullName'];
                    $EmailID      = $UsersDetails['EmailID'];
                    $Gender       = GetUserGender($UsersDetails['Gender']);
                    $UserStatus   = GetUserStatus($UsersDetails['UserStatus']);
                    $CreatedAt    = GetDisplayDateTime($UsersDetails['CreatedAt']);

                    $UserStatusBtn = ($UserStatus == 'Active') ? 'btn-success' : 'btn-danger';
                  ?>
                  <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $FullName;?></td>
                    <td><?php echo $EmailID;?></td>
                    <td><?php echo $Gender;?></td>
                    <td id="TblUserStatus_<?php echo $UserID;?>"><?php echo $UserStatus;?></td>
                    <td><?php echo $CreatedAt;?></td>
                    <td>
                      <a href="ManageUser.php?mode=edit&id=<?php echo $UserID;?>" class="btn btn-sm btn-info">Edit</a>
                      <input type="button" id="UserStatusBtn_<?php echo $UserID;?>" 
                      class="btn btn-sm UserStatusBtn <?php echo $UserStatusBtn;?>" 
                      value="<?php echo $UserStatus;?>" UserStatus="<?php echo $UsersDetails['UserStatus'];?>" UserID="<?php echo $UserID;?>">
                      </td>
                  </tr>
                  <?php 
                }
                ?>
              </tbody>
            </table>
	
          </div>
        </div>
      </div>
    </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  $(function(){
    UpdateUserStatusFn();
  });

  function UpdateUserStatusFn(){

      $(document).on('click', '.UserStatusBtn', function () {
        $('.success_message').html('');
        var UserStatus    = $(this).attr('UserStatus');
        var UserID        = $(this).attr('UserID');
        var UpdatedStatus = (UserStatus == 1) ? 0 : 1;
        jQuery.ajax({
            url: "ManageUserData.php",
            type: 'POST',
            data: {
                'UpdatedStatus':  UpdatedStatus,  
                'id':  UserID,  
                'mode':  'UpdateUserStatus'
            },
            success: function(status) {
                var status = $.trim(status);
                var RespMsg = '';
                var StatusClass = '';
                
                if(status == "success"){
                  var UpdatedStatusVal = (UpdatedStatus == 1) ? 'Active' : 'Inactive';

                  $("#UserStatusBtn_"+UserID).attr('userstatus',UpdatedStatus);
                  $("#UserStatusBtn_"+UserID).attr('value',UpdatedStatusVal);
                  $("#TblUserStatus_"+UserID).html(UpdatedStatusVal);

                  var StatusClass = 'alert-success';
                  $("#UserStatusBtn_"+UserID).removeClass("btn-success btn-danger");
                  var BtnClass = (UpdatedStatus == 1) ? 'btn-success' : 'btn-danger';

                  RespMsg = 'User status updated successfully.';

                }else if(status == "DBError"){

                  var StatusClass = 'alert-danger';
                  RespMsg = 'Some error occured while updating status.';

                }

                $("#UserStatusBtn_"+UserID).addClass(BtnClass);
                var SuccMsg = '<div class="alert '+StatusClass+' alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>'+RespMsg+' </strong></div>';
                $('.success_message').html(SuccMsg);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
      });
        
    }
</script>
<!-- /page content -->
<?php 
  include "footer.php";
?>