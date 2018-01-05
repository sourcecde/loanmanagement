<?php 
session_start();
if(isset($_SESSION["user_id"]) ){
    header("location:index.php");
    exit();
}
if(isset($_SESSION["borrower_id"]) ){
    header("location:b/index.php");
    exit();
}
if(isset($_SESSION["lender_id"]) ){
    header("location:l/index.php");
    exit();
}
$invalid_login="none";
$username=$_POST["username"];
$password=$_POST["password"];
if($username!="")
{
  include 'DataAccessLayer.php';
  $user_id=adminLogin($username,$password);
  if($user_id>0)
  {
    $_SESSION["user_id"]=$user_id;
    header("location:index.php");
    exit();
  }
  else
  {
    $user_id=borrowerLogin($username,$password);
    if($user_id>0)
    {
      $_SESSION["borrower_id"]=$user_id;
      header("location:b/index.php");
      exit();
    }    
      else
      {
        $user_id=lenderLogin($username,$password);
        if($user_id>0)
        {
          $_SESSION["lender_id"]=$user_id;
          header("location:l/index.php");
          exit();
        }
        else
          $invalid_login = "block";
      }
  }
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS-->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Loan Management</title>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries-->
    <!--if lt IE 9
    script(src='https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js')
    script(src='https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js')
    -->
  </head>
  <body>
    <section class="material-half-bg">
      <div class="cover"></div>
    </section>
    <section class="login-content">
      <div class="logo">
        <h1>Loan Management</h1>
      </div>
      <div class="login-box">
        <form class="login-form"  role="form" method="post" action="login.php">
          <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>SIGN IN</h3>
          <div class="form-group">
            <label class="control-label">USERNAME</label>
            <input class="form-control" type="text"  autofocus id="username" required="required" name="username" placeholder="Enter username">
          </div>
          <div class="form-group">
            <label class="control-label">PASSWORD</label>
            <input class="form-control" type="password"  id="password" required="required" name="password" placeholder="Enter password">
          </div>
          <div id="invalidLogin" class="alert alert-danger fade in" style="display:<?php echo $invalid_login ?>">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Invalid Login!</strong> Please try again!.
          </div>
          <!--div class="form-group">
            <div class="utility">
              <div class="animated-checkbox">
                <label class="semibold-text">
                  <input type="checkbox"><span class="label-text">Stay Signed in</span>
                </label>
              </div>
              <p class="semibold-text mb-0"><a data-toggle="flip">Forgot Password ?</a></p>
            </div>
          </div-->
          <div class="form-group btn-container">
            <button class="btn btn-primary btn-block"><i class="fa fa-sign-in fa-lg fa-fw"></i>SIGN IN</button>
          </div>
        </form>
       
      </div>
    </section>
  </body>
  <script src="js/jquery-2.1.4.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/plugins/pace.min.js"></script>
  <script src="js/main.js"></script>
  <script type="text/javascript">
  setTimeout(function(){$("#invalidLogin").alert("close");},10000);
  </script>
</html>