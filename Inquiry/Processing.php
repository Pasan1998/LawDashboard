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
                <h5 class="card-header">Table Basic</h5>
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                      <tr>
                      <th>#</th>
                        <th>Client Name</th>
                        <th>Client Mobile</th>
                        <th>Client Email</th>
                        <th>Practice Area</th>
                        <th>Message</th>
                        <th>Submitted Date</th>
                        <th>Inquiry Status</th>
                        
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">

                    <?php
                $sqlInquiries= "SELECT * FROM inquiries where InquiresState = '4' ";
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
                        <td><span class="badge bg-label-primary me-1"><?= $rowInquiries['ClientEmail']  ?></span></td>
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
                        <?php $status=$rowInquiries['InquiresState'];
                        
                        if ($status == 1){?>
                        <div class="alert alert-warning" role="alert">
 Not Process
</div><?php }elseif ($status == 2){?>
    <div class="alert alert-primary" role="alert">
  Contacted
</div><?php }elseif($status == 3 ){?>
    <div class="alert alert-dark" role="alert">
 Contacted & Not happening
</div><?php }elseif($status == 4){?>
    <div class="alert alert-success" role="alert">
  Processing
</div><?php }else if($status == 5){?>
    <div class="alert alert-danger" role="alert">
 Rejected
</div><?php }else {?>
   <div class="alert alert-danger" role="alert">
 Cancelled
</div> <?php
}


                            
                        
                        ?>
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

            <!-- Footer -->
            <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                <div class="mb-2 mb-md-0">
                  ©
                  <script>
                    document.write(new Date().getFullYear());
                  </script>
                  , Developed by 
                  <a href="https://themeselection.com" target="_blank" class="footer-link fw-bolder">Pasan Manahara</a>
                </div>
                <div>
                  <a > @ All rights received</a>
                  <a   class="footer-link me-4">More Themes</a>

                  <a
                    href="https://themeselection.com/demo/sneat-bootstrap-html-admin-template/documentation/"
                    target="_blank"
                    class="footer-link me-4"
                    >Documentation</a
                  >

                  <a
                    href="https://github.com/themeselection/sneat-html-admin-template-free/issues"
                    target="_blank"
                    class="footer-link me-4"
                    >Support</a
                  >
                </div>
              </div>
            </footer>
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
     
    </div>
    <!-- / Layout wrapper -->


    <?php  include '../footer.php'; ?>