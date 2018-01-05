<?php 
include 'admin-header.php';
$page_id="";
$page_top_id="loans";

include 'DataAccessLayer.php';
$message="";
$display_message="none";
$message_type="alert-danger";
$borrower_id=$_POST["borrower_id"];
$lender_id=$_POST["lender_id"];
$amount=$_POST["amount"];
$start_date=$_POST["start_date"];
$interest_rate=$_POST["interest_rate"];
$term=$_POST["term"];
$term_freq=$_POST["term_freq"];
$schedule=$_POST["schedule"];
$notes=$_POST["notes"];

if($borrower_id!="")
{
  $display_message="block";
  
  if(!is_numeric($amount))
  {
    $message="<strong>Amount should be number!</strong> Please try again!";   
  }
  else if(!is_numeric($interest_rate))
  {
    $message="<strong>Interest rate should be number!</strong> Please try again!";   
  }
  else if(!is_numeric($term))
  {
    $message="<strong>Term should be number!</strong> Please try again!";   
  }
  else
  {
  $message=addLoan($borrower_id,$lender_id,$amount,$start_date,$interest_rate,$term,$term_freq,$schedule,$notes);
  if($message=="SUCCESS")
  {
    $message="<strong>SUCCESS!</strong> Loan added to the system!";
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
            <h1><i class="fa fa-plus"></i> Add Loan</h1>
            <p>Manage Loans, Borrowers & Lenders!</p>
          </div>
          <div>
            <ul class="breadcrumb">
              <li><i class="fa fa-home fa-lg"></i></li>
              <li><a href="#">Add Loan</a></li>
            </ul>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="card">
              <h3 class="card-title">New Loan Details</h3>
              <div class="card-body">
               
                    <form id="addLoanForm"  role="form" method="post" action="add-loan.php">
                     
                        
                        <div class="form-group">
                          <label class=" control-label" for="name">Select Borrower:</label>
                          <select  name="borrower_id"  class="form-control" id="borrower_id">
                          <optgroup label="Select Borrower">
                          <? for ($i=0;$i<count($borrowers);$i++)
                             {
                              echo "<option value='" . $borrowers[$i]['user_id'] . "'>" . $borrowers[$i]['name'] . " (". $borrowers[$i]['username'] .")</option>";
                             }
                            ?>                              
                            </optgroup>
                            </select>                           
                        </div>
                        <div class="form-group">
                          <label class=" control-label" for="phone">Select Lender:</label>
                          <select  name="lender_id"  class="form-control" id="lender_id">
                          <optgroup label="Select Lender">
                              <? for ($i=0;$i<count($lenders);$i++)
                             {
                              echo "<option value='" . $lenders[$i]['user_id'] . "'>" . $lenders[$i]['name'] . " (". $lenders[$i]['username'] .")</option>";
                             }
                            ?>   
                              </optgroup>                   
                            </select>                          
                        </div>
                        <div class="form-group">
                          <label class="control-label">Amount:</label>
                          <div class="input-group">
                            <span class="input-group-addon">$</span>
                            <input class="form-control" type="text" name="amount" placeholder="Enter loan amount">                            
                          </div>
                        </div>
                        <div class="form-group">
                          <label class=" control-label" for="start_date">Start Date:</label>
                          <div class="input-group date"> 
                          <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                          <input class="form-control" id="start_date" type="text" name="start_date" placeholder="Select Date">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class=" control-label" for="interest_rate">Interest Rate:</label>     
                          <div class="input-group">                     
                            <input type="text" class="form-control" id="interest_rate" required="required" name="interest_rate" placeholder="Enter interest rate"> 
                            <span class="input-group-addon">%</span>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class=" control-label" for="username">Term:</label>     
                          <div>                       
                          <input type="text" class="form-control" style="display: inline;width: 60%;float: left;" id="term" required="required" name="term">   
                          <select class="form-control" name="term_freq"  style="display: inline;width: 40%;">
                                        <option value="day">Day</option>
                                        <option value="week">Week</option>
                                        <option value="month">Month</option>
                                        <option value="year">Year</option>
                                    </select>
                                    </div>   
                        </div>
                        <div class="form-group">
                          <label class=" control-label" for="username">Schedule of Payment:</label>                          
                          <select class="form-control" name="schedule">
                                        <option value="daily">Daily</option>
                                        <option value="weekly">Weekly</option>
                                        <option value="biweekly">Bi-weekly</option>
                                        <option value="monthly">Monthly</option>
                                        <option value="bimonthly">Bi-Monthly</option>
                                        <option value="yearly">Yearly</option>
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
                    <button class="btn btn-primary icon-btn" onclick="document.getElementById('addLoanForm').submit();" type="button"><i class="fa fa-fw fa-lg fa-check-circle"></i>Add</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-default icon-btn" href="#"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
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
      
      $('#start_date').datepicker({
        format: "yyyy-mm-dd",
        autoclose: true,
        todayHighlight: true
      });
      
      $('#borrowerSelect').select2();
      $('#lenderSelect').select2();
    </script>
<?php 
include 'admin-footer.php';
?>