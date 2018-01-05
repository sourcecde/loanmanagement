<?php 
include 'borrower-header.php';
$page_id="";
$page_top_id="loans";

$borrower_id=$_SESSION["borrower_id"];

$message="";
$display_message="none";

$message_type="alert-danger";


if($_GET['id']!='')
{
    $loan_id=$_GET["id"];
    $loan=getBorrowerLoanDetails($borrower_id,$loan_id);
    $borrower_id=$loan['borrower_id'];
    $borrower_name=$loan['borrower_name'];
    $borrower_address=$loan['borrower_address'];
    $borrower_phone=$loan['borrower_phone'];
    $borrower_email=$loan['borrower_email'];
    $lender_id=$loan['lender_id'];
    $lender_name=$loan['lender_name'];
    $lender_address=$loan['lender_address'];
    $lender_phone=$loan['lender_phone'];
    $lender_email=$loan['lender_email'];
    $start_date=$loan['start_date'];    
    $interest_rate=$loan['interest_rate'];    
    $term=$loan['term'];    
    $amount=$loan['amount'];    
    $term_freq=$loan['term_freq'];    
    $schedule=$loan['schedule'];    
    $notes=$loan['notes'];    
    $entries=getLoanEntries($loan_id);
    $balance=$amount;
}

else
{
    header('Location: all-loans.php');
    exit();
}
?>
      <div class="content-wrapper">
        <div class="page-title">
          <div>
            <h1><i class="fa fa-list"></i> Loan Entries</h1>
            <p>Manage Loans, Borrowers & Lenders!</p>
          </div>
          <div>
            <ul class="breadcrumb">
              <li><i class="fa fa-home fa-lg"></i></li>
              <li><a href="#">Loan Entries</a></li>
            </ul>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <section class="invoice">
                <div class="row">
                  <div class="col-xs-12">
                    <h2 class="page-header"><i class="fa fa-list"></i> Loan Entries<small class="pull-right">Date: <?php echo  date('Y/m/d'); ?></small></h2>
                  </div>
                </div>
                <div class="row invoice-info">
                  <div class="col-xs-4">Borrower: 
                    <address><strong><?php echo $borrower_name; ?></strong><br><?php echo $borrower_address; ?><br>Phone: <?php echo $borrower_phone; ?><br>Email: <?php echo $borrower_email; ?></address>
                  </div>
                  <div class="col-xs-4">Lender: 
                    <address><strong><?php echo $lender_name; ?></strong><br><?php echo $lender_address; ?><br>Phone: <?php echo $lender_phone; ?><br>Email: <?php echo $lender_email; ?></address>
                  </div>
                  <!--div class="col-xs-4"><b>Invoice #007612</b><br><br><b>Order ID:</b> 4F3S8J<br><b>Payment Due:</b> 2/22/2014<br><b>Account:</b> 968-34567</div-->
                </div>
                <div class="row hidden-print mt-20">
                  <!--div class="col-xs-12 text-right">
                    <a class="btn btn-primary" href="add-entry.php?id=<?php echo $loan_id; ?>"><i class="fa fa-plus"></i> Add Entry</a>
                  </div-->
                </div>
                <div class="row">
                
                  <div class="col-xs-12 table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>Date</th>
                          <th>Description</th>
                          <th>Amount</th>
                          <th>Balance</th>
                        </tr>
                      </thead>
                       <tbody>
                      <tr>                         
                          <td><?php echo $start_date; ?></td>
                          <td>Loan Start (+)</td>
                          <td>$<?php echo $amount; ?></td>
                          <td>$<?php echo $balance; ?></td>
                        </tr>
                     
                      <?php

                      for ($i=0;$i<count($entries);$i++)
                        {
                          if($entries[$i]['entry_type'] == 'addition')
                            $balance=$balance+$entries[$i]['amount'];
                          else 
                            $balance=$balance-$entries[$i]['amount'];
                          echo "<tr>";
                          echo "<td>" . $entries[$i]['entry_date'] . "</td>";
                          echo "<td>" . $entries[$i]['description'] . ($entries[$i]['entry_type'] == 'addition' ? ' (+)' : ' (-)') . "</td>";
                          echo "<td>$" . $entries[$i]['amount']. "</td>";               
                          echo "<td>$" .$balance . "</td>";                    
                          echo "</tr>";
                        }
                      ?>
                        
                       
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="row hidden-print mt-20">
                  <div class="col-xs-12 text-right"><a class="btn btn-primary" href="javascript:window.print();" target="_blank"><i class="fa fa-print"></i> Print</a></div>
                </div>
              </section>
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
<?php 
include 'borrower-footer.php';
?>