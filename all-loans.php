<?php 
include 'admin-header.php';
$page_id="";
$page_top_id="loans";
?>
      <div class="content-wrapper">
        <div class="page-title">
          <div>
            <h1><i class="fa fa-list"></i> All Loans</h1>
            <p>Manage Loans, Borrowers & Lenders!</p>
          </div>
          <div>
            <ul class="breadcrumb">
              <li><i class="fa fa-home fa-lg"></i></li>
              <li><a href="#">All Loans</a></li>
            </ul>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                <table class="table table-hover table-bordered" id="sampleTable">
                  <thead>
                    <tr>
                      <th>Borrower</th>
                      <th>Lender</th>                      
                      <th>Amount</th>
                      <th>Start Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  include 'DataAccessLayer.php';
                  $loans=getLoans();
                  for ($i=0;$i<count($loans);$i++)
                  {
                    echo "<tr>";
                    echo "<td>" . $loans[$i]['borrower_name'] . "</td>";
                    echo "<td>" . $loans[$i]['lender_name'] . "</td>";
                    echo "<td>$" . $loans[$i]['amount'] . "</td>";
                    echo "<td>" . $loans[$i]['start_date'] . "</td>";
                    echo "<td>";
                    echo "<div class='btn-group'>";
                    echo "<a class='btn btn-primary btn-success' href='view-loan.php?id=" . $loans[$i]['loan_id'] . "'><i class='fa fa-eye'></i> View</a>";
                    echo "<a class='btn btn-primary btn-sm' href='edit-loan.php?id=" . $loans[$i]['loan_id'] . "'><i class='fa fa-edit'></i> Edit</a>";
                    echo "<a class='btn btn-primary btn-info' href='loan-entries.php?id=" . $loans[$i]['loan_id'] . "'><i class='fa fa-list'></i> Entries</a>";     
                    echo "</div>";
                    echo "</td>";
                    echo "</tr>";
                  }
                  ?>
                 

                   
                  </tbody>
                </table>
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
    <!-- Data table plugin-->
    <script type="text/javascript" src="js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="js/plugins/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">$('#sampleTable').DataTable();</script>
<?php 
include 'admin-footer.php';
?>