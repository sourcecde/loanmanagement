<?php 
include 'admin-header.php';
$page_id="";
$page_top_id="loans";

include 'DataAccessLayer.php';
$message="";
$display_message="none";
$message_type="alert-danger";

$loan_id=$_GET["id"];
$entry_date=$_POST["entry_date"];
$amount=$_POST["amount"];
$description=$_POST["description"];
$entry_type=$_POST["entry_type"];
$notes=$_POST["notes"];


if($entry_date!="")
{
  $loan_id=$_POST["loan_id"];
  $display_message="block";
  
  if(!is_numeric($amount))
  {
    $message="<strong>Amount should be number!</strong> Please try again!";   
  }  
  else
  {
  $message=addLoanEntry($entry_date,$amount,$description,$loan_id,$entry_type,$notes);
  if($message=="SUCCESS")
  {
    $message="<strong>SUCCESS!</strong> Entry added to the system!";
    $message_type="alert-success";
  }
  else
  {
    $message="<strong>FAILURE!</strong> " . $message . "!";
  }
}
}


$borrowers=getUsers('borrower');
$lenders=getUsers('lender');
?>
      <div class="content-wrapper">
        <div class="page-title">
          <div>
            <h1><i class="fa fa-plus"></i> Add Loan Entry</h1>
            <p>Manage Loans, Borrowers & Lenders!</p>
          </div>
          <div>
            <ul class="breadcrumb">
              <li><i class="fa fa-home fa-lg"></i></li>
              <li><a href="#">Add Loan Entry</a></li>
            </ul>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="card">
              <h3 class="card-title">New Loan Entry Details</h3>
              <div class="card-body">
               
                    <form id="addLoanEntry"  role="form" method="post" action="add-entry.php">
                     
                         <input type="text" hidden="true" id="loan_id" name="loan_id" value="<?php echo $loan_id; ?>"/>
                        <div class="form-group">
                       
                        <div class="form-group">
                          <label class=" control-label" for="email">Entry Date:</label>
                          <div class="input-group date"> 
                          <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                          <input name="entry_date" id ="entry_date" class="form-control" type="text" placeholder="Select Date">
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="control-label">Amount:</label>
                          <div class="input-group">
                            <span class="input-group-addon">$</span>
                            <input name="amount" id="amount" class="form-control" type="text" placeholder="Enter amount">                            
                          </div>
                        </div>
                       
                        <div class="form-group">
                          <label class=" control-label" for="username">Description:</label>     
                                       
                            <input type="text" class="form-control" id="description" required="required" name="description" placeholder="Enter description"> 
                            
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label class=" control-label" for="username">Entry Type:</label>                          
                          <select class="form-control" name="entry_type" id="entry_type">
                                        <option value="addition">Addition</option>
                                        <option value="deduction">Deduction</option>                                       
                                    </select>         
                        </div>
                        <div class="form-group">
                          <label class="control-label">Notes</label>
                          <textarea class="form-control" rows="4" id="notes" name="notes" placeholder="Enter your notes"></textarea>
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
                    <button onclick="document.getElementById('addLoanEntry').submit();" class="btn btn-primary icon-btn" type="button"><i class="fa fa-fw fa-lg fa-check-circle"></i>Add</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-default icon-btn" href="#"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
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
    <script type="text/javascript" src="js/plugins/select2.min.js"></script>
     <script type="text/javascript" src="js/plugins/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript">
      $('#sl').click(function(){
        $('#tl').loadingBtn();
        $('#tb').loadingBtn({ text : "Signing In"});
      });
      
      $('#el').click(function(){
        $('#tl').loadingBtnComplete();
        $('#tb').loadingBtnComplete({ html : "Sign In"});
      });
      
      $('#entry_date').datepicker({
        format: "yyyy-mm-dd",
        autoclose: true,
        todayHighlight: true
      });
      
      
    </script>
<?php 
include 'admin-footer.php';
?>