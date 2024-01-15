<?php 
  include "header.php";
  $CountAllUsers    = GetCountAllUsers($Gender=0);
  $CountMaleUsers   = GetCountAllUsers($Gender=1);
  $CountFemaleUsers = GetCountAllUsers($Gender=2);


?>

<!-- page content -->
<div class="right_col" role="main">
  <br>
  <div class="row">
      <div class="col-md-4 col-sm-4">
          <h3><?php echo $DashboardLbl;?></h3>
      </div>
      <div class="col-md-8 col-sm-8">
          <h3>Last Logged In : <?php 
              echo ($LastLoggedIn != NULL) ? GetDisplayDateTime($LastLoggedIn) : 'First Time Login';?>
            
          </h3>
      </div>
  </div>
  <br>
  <!-- top tiles -->
  <div class="row" style="<?php echo $UserRoleWiseDisplay;?>">
  <div class="tile_count">
    <div class="col-md-4 col-sm-4  tile_stats_count">
      <span class="count_top"><i class="fa fa-user"></i> Total Users</span>
      <div class="count"><?php echo $CountAllUsers;?></div>
    </div>
    
    <div class="col-md-4 col-sm-4  tile_stats_count">
      <span class="count_top"><i class="fa fa-user"></i> Total Females</span>
      <div class="count green"><?php echo $CountFemaleUsers;?></div>
    </div>
    <div class="col-md-4 col-sm-4  tile_stats_count">
      <span class="count_top"><i class="fa fa-user"></i> Total Males</span>
      <div class="count green"><?php echo $CountMaleUsers;?></div>
    </div>
  </div>
</div>
</div>
<!-- /page content -->

<?php 
  include "footer.php";
?> 
