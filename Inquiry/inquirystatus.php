<?php 
include '../header.php';
include '../navbar.php';
include '../function.php';?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.24/sweetalert2.all.js"></script>
<?php 
extract($_POST);
if ($_SERVER['REQUEST_METHOD'] == "POST"  && @$action == 'statuschange') {

    extract($_POST);
     $sql = "UPDATE inquiries SET InquiresState = $change_status WHERE InquiriesID = $InquiriesID";
     echo '';
    $db = dbConn();
    $results = $db->query($sql);
    if($results != null){
      ?>  <script>
        Swal.fire({
            title: 'Success!',
            text: 'Inquiry Status chnaged.',
            icon: 'success',
            confirmButtonText: 'OK'
        }).then(() => {
            window.location.href = 'All.php'; // Redirect to success page
        });
        
        </script><?php
        
    }
    else{?>
        <script>
        Swal.fire({
            title: 'danger',
            text: 'Inquiry  Status not chnaged.',
            icon: 'danger',
            confirmButtonText: 'OK'
        }).then(() => {
            window.location.href = 'All.php'; // Redirect to success page
        });
        
        </script><?php
    }
  
}
 ob_end_flush();
?>