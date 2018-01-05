<?php 
include 'admin-header.php';
$page_id="";
$page_top_id="borrowers";


$message="";
$display_message="none";
$message_type="alert-danger";
$username=$_POST["username"];
$password=$_POST["password"];
$confirm_password=$_POST["confirmPassword"];
$name=$_POST["name"];
$phone=$_POST["phone"];
$email=$_POST["email"];
$address=$_POST["address"];
$type="borrower";

if($username!="")
{
  $display_message="block";
  include 'DataAccessLayer.php';
  if(strlen($username)<6)
  {
    $message="<strong>Username length should be more than 6!</strong> Please try again!";   
  }
  else if(strlen($password)<6)
  {
    $message="<strong>Pasword length should be more than 6!</strong> Please try again!";   
  }
  else if($password!=$confirm_password)
  {
    $message="<strong>Paswords dont match!</strong> Please try again!";   
  }
  else
  {
  $message=addUser($username,$password,$name,$phone,$email,$address,$type);
  if($message=="SUCCESS")
  {
    $message="<strong>SUCCESS!</strong> Borrower added to the system!";
    $message_type="alert-success";
  }
  else
  {
    $message="<strong>FAILURE!</strong> " . $message . "!";
  }
}
}
?>

      <div class="content-wrapper">
        <div class="page-title">
          <div>
            <h1><i class="fa fa-user-plus"></i> Add Borrower</h1>
            <p>Manage Loans, Borrowers & Lenders!</p>
          </div>
          <div>
            <ul class="breadcrumb">
              <li><i class="fa fa-home fa-lg"></i></li>
              <li><a href="#">Add Borrower</a></li>
            </ul>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="card">
              <h3 class="card-title">New Borrower Details</h3>
              <div class="card-body">
               
                   <form id="addBorrowerForm"  role="form" method="post" action="add-borrower.php">
  
                     
                        
                        <div class="form-group">
                          <label class=" control-label" for="name">Name:</label>
                          
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name">
                          
                        </div>
                        <div class="form-group">
                          <label class=" control-label" for="phone">Phone:</label>
                          
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Phone">
                          
                        </div>
                        <div class="form-group">
                          <label class=" control-label" for="email">Email:</label>
                          
                            <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email">
                          
                        </div>
                        <div class="form-group">
                          <label class="control-label">Address</label>
                          <textarea class="form-control" rows="4" id="address" name="address" placeholder="Enter your address"></textarea>
                        </div>
                        <div class="form-group">
                          <label class=" control-label" for="username">Username:</label>
                          
                            <input type="text" class="form-control" id="username" required="required" name="username" placeholder="Enter username">
                          
                        </div>
                        <div class="form-group">
                          <label class=" control-label" for="password">Password:</label>
                           
                            <input type="password" class="form-control" id="password" required="required" name="password" placeholder="Enter password">
                          
                        </div>
                        <div class="form-group">
                          <label class=" control-label" for="password">Confirm Password:</label>
                           
                            <input type="password" class="form-control" id="comfirmPassword" name="confirmPassword" required="required"  placeholder="Re-enter password">
                        
                        </div>
                        <div id="invalidLogin" class="alert <?php echo $message_type ?> fade in" style="display:<?php echo $display_message ?>">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                          <?php echo $message ?>
                        </div>
                        
                        
                  </form>
               </div>
               <div class="card-footer">
                <div class="row">
                  <div class="col-md-8 col-md-offset-0">
                    <button class="btn btn-primary icon-btn" onclick="document.getElementById('addBorrowerForm').submit();" type="button"><i class="fa fa-fw fa-lg fa-check-circle"></i>Add</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-default icon-btn" href="#"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Javascripts-->
    <script src="js/jquery-2.1.4.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/pace.min.js"></script>
    <script src="js/main.js"></script>
<?php 
include 'admin-footer.php';
?>