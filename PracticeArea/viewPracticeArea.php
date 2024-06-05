<?php
include '../header.php';
include '../navbar.php';
include '../function.php';
?>



<!-- Content wrapper -->
<div class="content-wrapper">
  <!-- Content -->

  <div class="container-xxl flex-grow-1 container-p-y">
    

    <!-- table start -->

    <!-- tables end -->

    <!-- start -->

    <div class="row">
      <div class="col-12 mb-4">
        <!-- Basic Bootstrap Table -->
        <div class="card">
          <h5 class="card-header">Table Basic</h5>
          <div class="table-responsive text-nowrap">
            <table class="table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Practice Area</th>
                  <th>Image</th>
                  <th>Stauts</th>
                  <th>View</th>
                  <th>Edit</th>
                  <th>Delete</th>


                </tr>
              </thead>
              <tbody class="table-border-bottom-0">

                <?php
                $sqlInquiries = "SELECT * FROM practice_areas where practiceAreaStatus = '1'";
                $db = dbConn();
                $resultInquiries = $db->query($sqlInquiries);
                ?>

                <?php
                if ($resultInquiries->num_rows > 0) {
                  $i = 1;
                  while ($rowInquiries = $resultInquiries->fetch_assoc()) {

                    ?>
                    <tr>
                      <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <?= $i ?></td>
                      <td><?= ucwords($rowInquiries['HeadingName']) ?></td>

                      <td><span class="badge bg-label-primary me-1"><?= $rowInquiries['ImageIcon'] ?></span></td>
                      <td>
                        <?php
                        if ($rowInquiries['practiceAreaStatus'] == 1) {
                          echo ucwords("Activated");
                        } else {
                          echo ucwords("De-ativated");
                        }
                        ?>
                      </td>
                      <td>
                        <button class="btn btn text-primary"> View </button>
                      </td>
                      <td>
                        <button class="btn btn text-info"> Edit </button>
                      </td>
                      <td>
                        <button class="btn btn text-danger"> Delete </button>

                      </td>
                    </tr>
                    <?php
                    $i++;
                  }
                } ?>
              </tbody>
            </table>
          </div>
        </div>
        <!--/ Basic Bootstrap Table -->

      </div>
    </div>

    <!-- end -->

  </div>
  <!-- / Content -->




  <?php include '../footer.php'; ?>