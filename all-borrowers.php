<?php 
include 'admin-header.php';
$page_id="";
$page_top_id="borrowers";
?>
      <div class="content-wrapper">
        <div class="page-title">
          <div>
            <h1><i class="fa fa-list"></i> All Borrowers</h1>
            <p>Manage Loans, Borrowers & Lenders!</p>
          </div>
          <div>
            <ul class="breadcrumb">
              <li><i class="fa fa-home fa-lg"></i></li>
              <li><a href="#">All Borrowers</a></li>
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
                      <th>Name</th>
                      <th>Phone</th>                      
                      <th>Email</th>
                      <th>Username</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  include 'DataAccessLayer.php';
                  $users=getUsers('borrower');
                  for ($i=0;$i<count($users);$i++)
                  {
                    echo "<tr>";
                    echo "<td>" . $users[$i]['name'] . "</td>";
                    echo "<td>" . $users[$i]['phone'] . "</td>";
                    echo "<td>" . $users[$i]['email'] . "</td>";
                    echo "<td>" . $users[$i]['username'] . "</td>";
                    echo "<td>";
                    echo "<div class='btn-group'>";
                    echo "<a class='btn btn-primary btn-success' href='view-borrower.php?id=" . $users[$i]['user_id'] . "'><i class='fa fa-eye'></i> View</a>";
                    echo "<a class='btn btn-primary btn-sm' href='edit-borrower.php?id=" . $users[$i]['user_id'] . "'><i class='fa fa-edit'></i> Edit</a>";
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