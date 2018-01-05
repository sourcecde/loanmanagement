<?php 
include 'admin-header.php';
$page_id="";
$page_top_id="home";
include 'DataAccessLayer.php';
$numBorrowers=getUserCount('borrower');
$numLenders=getUserCount('lender');
$numLoans=getLoanCount();
?>

      <div class="content-wrapper">
        <div class="page-title">
          <div>
            <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
            <p>Manage Loans, Borrowers & Lenders!</p>
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
              <h3 class="card-title"><i class="fa fa-user-circle"></i> Borrowers</h3>
             <p>There are <?php echo $numBorrowers; ?> borrowers in the system.</p>
              <p class="mt-40 mb-20"><a class="btn btn-primary icon-btn mr-10" href="add-borrower.php" ><i class="fa fa-user-plus"></i> Add Borrower</a><a class="btn btn-info icon-btn mr-10" href="all-borrowers.php" ><i class="fa fa-list"></i> View All Borrowers</a></p>
            </div>
          </div>
          <div class="col-md-6">
           <div class="card">
              <h3 class="card-title"><i class="fa fa-user-circle-o"></i> Lenders</h3>
              <p>There are <?php echo $numLenders; ?> lenders in the system.</p>
              <p class="mt-40 mb-20"><a class="btn btn-primary icon-btn mr-10" href="add-lender.php" ><i class="fa fa-user-plus"></i> Add Lender</a><a class="btn btn-info icon-btn mr-10" href="all-lenders.php" ><i class="fa fa-list"></i> View All Lenders</a></p>
            </div>
          </div>
          <div class="col-md-6">
           <div class="card">
              <h3 class="card-title"><i class="fa fa-money"></i> Managed Loans</h3>
              <p>There are <?php echo $numLoans; ?> manages loans in the system.</p>
              <p class="mt-40 mb-20"><a class="btn btn-primary icon-btn mr-10" href="add-loan.php" ><i class="fa fa-plus"></i> Add Loan</a><a class="btn btn-info icon-btn mr-10" href="all-loans.php" ><i class="fa fa-list"></i> View All Loans</a></p>

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