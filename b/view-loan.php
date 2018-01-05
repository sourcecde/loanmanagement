<?php 
include 'borrower-header.php';
$page_id="";
$page_top_id="loans";

$message="";
$display_message="none";

$message_type="alert-danger";

$borrower_id=$_SESSION["borrower_id"];

if($_GET['id']!='')
{
    $loan_id=$_GET["id"];
    $loan=getBorrowerLoanDetails($borrower_id,$loan_id);
    $borrower_id=$loan['borrower_id'];
    $borrower_name=$loan['borrower_name'];
    $lender_id=$loan['lender_id'];
    $lender_name=$loan['lender_name'];
    $start_date=$loan['start_date'];    
    $interest_rate=$loan['interest_rate'];    
    $term=$loan['term'];    
    $amount=$loan['amount'];    
    $term_freq=$loan['term_freq'];    
    $schedule=$loan['schedule'];    
    $notes=$loan['notes'];    
}

else
{
    header('Location: all-loans.php');
    exit();
}






$borrowers=getUsers('borrower');
$lenders=getUsers('lender');
?>
      <div class="content-wrapper">
        <div class="page-title">
          <div>
            <h1><i class="fa fa-plus"></i> View Loan</h1>
            <p>Manage Loans, Borrowers & Lenders!</p>
          </div>
          <div>
            <ul class="breadcrumb">
              <li><i class="fa fa-home fa-lg"></i></li>
              <li><a href="#">View Loan</a></li>
            </ul>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="card">
              <h3 class="card-title">Loan Details</h3>
              <div class="card-body">
               
                    <form id="addLoanForm"  role="form" method="post" action="add-loan.php">
                     
                     <div class="form-group">
                      <label class=" control-label" for="name"> Borrower:</label>
                      <input type="text" class="form-control" id="borrower_name" name="borrower_name"  readonly="readonly" value="<?php echo $borrower_name; ?>">
                     </div>
                        
                      <div class="form-group">
                          <label class=" control-label" for="phone"> Lender:</label>
                          <input type="text" class="form-control" id="lender_name" name="lender_name"  readonly="readonly" value="<?php echo $lender_name; ?>">
                                            
                        </div>
                        <div class="form-group">
                          <label class="control-label">Amount:</label>
                          <div class="input-group">
                            <span class="input-group-addon">$</span>
                            <input class="form-control" type="text"  readonly="readonly"  name="amount" value="<?php echo $amount; ?>" placeholder="Enter loan amount">                            
                          </div>
                        </div>
                        <div class="form-group">
                          <label class=" control-label" for="start_date">Start Date:</label>
                          <div class="input-group date"> 
                          <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                          <input class="form-control" id="start_date" readonly="readonly"  type="text" value="<?php echo $start_date; ?>" name="start_date" placeholder="Select Date">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class=" control-label" for="interest_rate">Interest Rate:</label>     
                          <div class="input-group">                     
                            <input type="text" class="form-control" readonly="readonly" value="<?php echo $interest_rate; ?>" id="interest_rate" required="required" name="interest_rate" placeholder="Enter interest rate"> 
                            <span class="input-group-addon">%</span>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class=" control-label" for="username">Term:</label>     
                          <div>                       
                          <input readonly="readonly" value="<?php echo $term; ?>" type="text" class="form-control" style="display: inline;width: 60%;float: left;" id="term" required="required" name="term">   
                          <select class="form-control" name="term_freq"  style="display: inline;width: 40%;" readonly="readonly">
                                        <option <?php echo ($term_freq == 'day' ? ' selected="selected"' : ''); ?> value="day">Day</option>
                                        <option <?php echo ($term_freq == 'week' ? ' selected="selected"' : ''); ?> value="week">Week</option>
                                        <option <?php echo ($term_freq == 'month' ? ' selected="selected"' : ''); ?> value="month">Month</option>
                                        <option <?php echo ($term_freq == 'year' ? ' selected="selected"' : ''); ?> value="year">Year</option>
                                    </select>
                                    </div>   
                        </div>
                        <div class="form-group">
                          <label class=" control-label" for="username">Schedule of Payment:</label>                          
                          <select class="form-control" name="schedule" readonly="readonly">
                                        <option <?php echo ($schedule == 'daily' ? ' selected="selected"' : ''); ?> value="daily">Daily</option>
                                        <option <?php echo ($schedule == 'weekly' ? ' selected="selected"' : ''); ?> value="weekly">Weekly</option>
                                        <option <?php echo ($schedule == 'biweekly' ? ' selected="selected"' : ''); ?> value="biweekly">Bi-weekly</option>
                                        <option <?php echo ($schedule == 'monthly' ? ' selected="selected"' : ''); ?> value="monthly">Monthly</option>
                                        <option <?php echo ($schedule == 'bimonthly' ? ' selected="selected"' : ''); ?> value="bimonthly">Bi-Monthly</option>
                                        <option <?php echo ($schedule == 'yearly' ? ' selected="selected"' : ''); ?> value="yearly">Yearly</option>
                                    </select>         
                        </div>
                        <div class="form-group">
                          <label class="control-label">Notes</label>
                          <textarea class="form-control" rows="4" id="notes" name="notes" placeholder="Enter your notes" readonly="readonly"><?php echo $notes; ?></textarea>
                        </div>
                        
                       
                        <div id="invalidLogin" class="alert <?php echo $message_type ?> fade in" style="display:<?php echo $display_message ?>">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                          <?php echo $message ?>
                        </div>
                        
                        
                  </form>
               </div>
               <div class="card-footer">
                <div class="row">
                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Javascripts-->
    <script src="../js/jquery-2.1.4.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/plugins/pace.min.js"></script>
    <script src="../js/main.js"></script>
    <script type="text/javascript" src="../js/plugins/select2.min.js"></script>
     <script type="text/javascript" src="../js/plugins/bootstrap-datepicker.min.js"></script>
   
<?php 
include 'borrower-footer.php';
?>