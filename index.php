<?php 
session_start();
if(isset($_SESSION['UserSessionData']) && !empty($_SESSION['UserSessionData'])){
  header("Location: Dashboard.php");
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>NEC | Login</title>

    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">

    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="vendors/jquery/dist/jquery_form.js"></script>
    <script src="vendors/jquery/dist/form_submit.js"></script>
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">

        <div class="animate form login_form">
          <div class="row">
            <div class="col-md-12 success_message">
              <?php 
              if(isset($_SESSION['LogoutMsg']) && $_SESSION['LogoutMsg'] != ''){
                echo $_SESSION['LogoutMsg'];
                unset($_SESSION['LogoutMsg']);
              }
              ?>
            </div>
        </div>
        
          <section class="login_content">
            <form action="Login.php" method="POST" id="LoginForm">
              <h1>Login Form</h1>
              <div>
                <input name="EmailID" type="text" class="form-control" placeholder="EmailID">
              </div>
              <div>
                <input name="Password" type="password" class="form-control" placeholder="Password" 
                onpaste="return false;" ondrop="return false;">
              </div>

              <div class="error_msg EmailIDError"></div>
              <div class="error_msg PasswordError"></div>
              <br>
              <div>
                <input type="submit" class="btn btn-success" id="LoginBtn" value="Login">
              </div>

              <div class="clearfix"></div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>
