<?php 
include 'borrower-header.php';
$page_id="";
$page_top_id="home";


$borrower_id=$_SESSION["borrower_id"];

$numLoans=getBorrowerLoanCount($borrower_id);
?>

      <div class="content-wrapper">
        <div class="page-title">
          <div>
            <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
            <p>Manage Loans</p>
          </div>
          <div>
            <ul class="breadcrumb">
              <li><i class="fa fa-home fa-lg"></i></li>
              <li><a href="#">Dashboard</a></li>
            </ul>
          </div>
        </div>
        <div class="row">
          
          <div class="col-md-6">
           <div class="card">
              <h3 class="card-title"><i class="fa fa-money"></i> My Loans</h3>
              <p>There are <?php echo $numLoans; ?> loans against me in the system.</p>
              <p class="mt-40 mb-20"><a class="btn btn-info icon-btn mr-10" href="all-loans.php" ><i class="fa fa-list"></i> View My Loans</a></p>

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