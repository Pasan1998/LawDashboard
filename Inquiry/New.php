<?php
include '../header.php';
include '../navbar.php';
include '../function.php';
?>



          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <div class="col-lg-12 mb-4 order-0">
                  <div class="card">
                    <div class="d-flex align-items-end row">
                      <div class="col-sm-7">
                        <div class="card-body">
                          <h5 class="card-title text-primary">Congratulations John! 🎉</h5>
                          <p class="mb-4">
                            You have done <span class="fw-bold">72%</span> more sales today. Check your new badge in
                            your profile.
                          </p>

                          <a href="javascript:;" class="btn btn-sm btn-outline-primary">View Badges</a>
                        </div>
                      </div>
                      <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                          <img
                            src="<?= SYSTEM_PATH_BACKEND ?>assets/img/illustrations/man-with-laptop-light.png"
                            height="140"
                            alt="View Badge User"
                            data-app-dark-img="illustrations/man-with-laptop-dark.png"
                            data-app-light-img="illustrations/man-with-laptop-light.png"
                          />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                
                
              </div>
              
              <!-- table start -->
            
              <!-- tables end -->

<!-- start -->

<div class="row"> 
    <div class="col-12 mb-4">
      <!-- Basic Bootstrap Table -->
      <div class="card">
      <?php

           $statusofInquiry = 1;

          if ($statusofInquiry == 1) {
            $tablehead = 'Not Process';
          } elseif ($statusofInquiry == 2) {
            $tablehead = 'Contacted';
          } elseif ($statusofInquiry == 3) {
            $tablehead = 'Contacted & Not happening';
          } elseif ($statusofInquiry == 4) {
            $tablehead = 'Processing';
          } elseif ($statusofInquiry == 5) {
            $tablehead = 'Rejected';
          } elseif ($statusofInquiry == 6) {
            $tablehead = 'Cancelled';
          } elseif ($statusofInquiry == 7) {
            $tablehead = 'Completed';
          } else {
            $tablehead = 'Unknown Status'; // Optional: handle unexpected statuses
          }



          ?>


          <h5 class="card-header">Table Basic  <button class="btn btn-info"> <?php echo  $tablehead ?> </button></h5>
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                      <tr>
                      <th>#</th>
                        <th>Client Name</th>
                        <th>Client Mobile</th>
                  
                        <th>Practice Area</th>
                        <th>Message</th>
                        <th>Submitted Date</th>
                        <th>Inquiry Status</th>
                        <th>Change Status</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">

                    <?php
                $sqlInquiries= "SELECT * FROM inquiries where InquiresState = '1'";
                $db = dbConn();
                $resultInquiries = $db->query($sqlInquiries);
                ?>

<?php
                        if ($resultInquiries->num_rows > 0) {
                            $i = 1;
                            while ($rowInquiries = $resultInquiries->fetch_assoc()) {
                                
                                ?>
                      <tr>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <?= $i  ?></td>
                        <td><?= ucwords($rowInquiries['ClientName'])  ?></td>
                        <td>
                        <?= $rowInquiries['ClientMobile']  ?>
                        </td>
                       
                        <td>
                        <?php
                        
                        $id=$rowInquiries['ServiceID'];
                        $sql_service= "SELECT * FROM services where ServiceID ='$id'";
                        $db = dbConn();
                        $result_service = $db->query($sql_service);
                        $row_service = $result_service->fetch_assoc();

                        echo ucwords($row_service['Description']);
                            


                        ?>
                        </td>
                        <td>
                        <?= ucwords($rowInquiries['ClientMessage'])  ?>
                        </td>
                        <td>
                        <?= $rowInquiries['Loggeddate']  ?>
                        </td>
                        <td>
                        <?php $status = $rowInquiries['InquiresState'];

                        if ($status == 1) { ?>
                          <div class="alert alert-warning" role="alert">
                            Not Process
                          </div><?php } elseif ($status == 2) { ?>
                          <div class="alert alert-primary" role="alert">
                            Contacted
                          </div><?php } elseif ($status == 3) { ?>
                          <div class="alert alert-dark" role="alert">
                            Contacted & Not happening
                          </div><?php } elseif ($status == 4) { ?>
                          <div class="alert alert-success" role="alert">
                            Processing
                          </div><?php } else if ($status == 5) { ?>
                            <div class="alert alert-danger" role="alert">
                              Rejected
                            </div><?php } else if  ($status == 6)  { ?>
                            <div class="alert alert-danger" role="alert">
                              Cancelled
                            </div> <?php
                        }else if  ($status == 7)  { ?>
                           <div class="alert alert-success" role="alert">
                              Completed
                            </div> <?php }

                        ?>
                      </td>

                        <td>
                        <form method="post" action="inquirystatus.php">
                          <input type="hidden" name="InquiriesID" value="<?= $rowInquiries['InquiriesID'] ?>">
                          <div class="mb-3">
                            <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example" name="change_status">
                              <option selected>Change Status</option>
                              <option value="1"> Not Process</option>
                              <option value="2">Contacted</option>
                              <option value="3">Contacted & Not happening</option>
                              <option value="4">Processing</option>
                              <option value="5">Rejected</option>
                              <option value="6">Cancelled</option>
                              <option value="7">Completed</option>
                            </select>
                          </div>
                          <button class="btn btn-info" type="submit" value="statuschange" name="action" > Change</button>
                        </form>
                        </td>

                      </tr>
                     <?php 
                      $i++;
                    }}?>
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

            


            <?php  include '../footer.php'; ?>