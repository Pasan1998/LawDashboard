<?php
include '../header.php';
include '../navbar.php';
include '../function.php';
?>

<?php
extract($_POST);
if ($_SERVER['REQUEST_METHOD'] == "POST") {
  extract($_POST);

  $BlogPracticeArea = cleanInput($BlogPracticeArea);
  
  $LDEnglish = cleanInput($LDEnglish);
  $LDTamil = cleanInput($LDTamil);
  $LDSinhala = cleanInput($LDSinhala);

  $SDEnglish = cleanInput($SDEnglish);
  $SDTamil = cleanInput($SDTamil);
  $SDSinhala = cleanInput($SDSinhala);

  $DescriptionSinhala = cleanInput($DescriptionSinhala);
  $DescriptionTamil = cleanInput($DescriptionTamil);
  $DescriptionEnglish = cleanInput($DescriptionEnglish);

  $productimage = $_FILES['PageImage'];
  
  //create array variable store validation messages
  $messages = array();

  //validate required fields
  if (empty($BlogPracticeArea)) {
    $messages['error_BlogPracticeArea'] = "The Practice Area should be selected..!";
  }
 
  if (empty($LDEnglish)) {
    $messages['error_LDEnglish'] = "The English heading Name should not be empty..!";
  }
  if (empty($LDTamil)) {
    $messages['error_LDTamil'] = "The Tamil heading Name should not be empty..!";
  }
  if (empty($LDSinhala)) {
    $messages['error_LDSinhala'] = "The Sinhala heading Name should not be empty..!";
  }

  if (empty($SDEnglish)) {
    $messages['error_SDEnglish'] = "The English tag should not be empty..!";
  }
  if (empty($SDSinhala)) {
    $messages['error_SDSinhala'] = "The Sinhala tag  should not be empty..!";
  }
  if (empty($SDTamil)) {
    $messages['error_SDTamil'] = "The tamil tag should not be empty..!";
  }

  if (empty($DescriptionSinhala)) {
    $messages['error_DescriptionSinhala'] = "The Sinhala Description should not be empty..!";
  }
  if (empty($DescriptionTamil)) {
    $messages['error_DescriptionTamil'] = "The Tamil Description should not be empty..!";
  }
  if (empty($DescriptionEnglish)) {
    $messages['error_DescriptionEnglish'] = "The Enlgish Description Name should not be empty..!";
  }

  if ($_FILES['PageImage']['name'] == "") {
    $messages['error_PageImage'] = "The Images should not be empty..!";
  }

 
  if ($_FILES['PageImage']['name'] != "") {
    $productimage = $_FILES['PageImage'];
    $filename = $productimage['name'];
    $filetmpname = $productimage['tmp_name'];
    $filesize = $productimage['size'];
    $fileerror = $productimage['error'];
    //take file extension
    $file_ext = explode(".", $filename);
    $file_ext = strtolower(end($file_ext));
    //select allowed file type
    $allowed = array("jpg", "jpeg", "png", "gif");
    //check wether the file type is allowed
    if (in_array($file_ext, $allowed)) {
      if ($fileerror === 0) {
        //file size gives in bytes
        if ($filesize <= 6291456) {
          //giving appropriate file name. Can be duplicate have to validate using function
          $file_name_new = uniqid('', true) . $SDEnglish . '.' . $file_ext;
          //directing file destination
          $file_path = "../images/" . $file_name_new;
          //moving binary data into given destination
          if (move_uploaded_file($filetmpname, $file_path)) {
            "The file is uploaded successfully";
          } else {
            $messages['file_error'] = "File is not uploaded";
          }
        } else {
          $messages['file_error'] = "File size is invalid";
        }
      } else {
        $messages['file_error'] = "File has an error";
      }
    } else {
      $messages['file_error'] = "Invalid File type";
    }
  }

  if (empty($messages)) {

    $db = dbConn();
    // $adduser = $_SESSION['UserId'];
    $adddate = date('Y-m-d');
    $blogStatus = 1;
    echo $sql = "INSERT INTO blog(BlogServiceID, BlogStatus,BlogImage, 
    Sinhala_Description, Tamil_Description, English_Description, SinhalaTags, TamilTag,EnglishTag,SinhalaHeading,TamilHeading,EnglishHeading) VALUES
    ('$BlogPracticeArea','$blogStatus','$file_name_new','$DescriptionSinhala','$DescriptionTamil','$DescriptionEnglish','$SDSinhala','$SDTamil',' $SDEnglish',
    '$LDSinhala','$LDTamil','$LDEnglish')";
    $results = $db->query($sql);

  }

}

?>

<!-- Content wrapper -->
<div class="content-wrapper">
  <!-- Content -->

  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Adding</span> New Blog</h4>

    <!-- Basic Layout & Basic with Icons -->
    <div class="row">

      <div class="col-xxl">
        <div class="card mb-4">
          <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Basic with Icons</h5>
            <small class="text-muted float-end">Merged input group</small>
          </div>
          <div class="card-body">
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"
              enctype="multipart/form-data">
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-icon-default-company">PracticeArea Name</label>
                <div class="col-sm-9">
                <?php
                    $sqlq = "SELECT * FROM services";
                    $db = dbConn();
                    $resultq = $db->query($sqlq);
                    ?>
                  <div class="input-group input-group-merge">
                    <span id="basic-icon-default-company2" class="input-group-text"><i
                        class="bx bx-buildings"></i></span>

                    <select id="product_name" name="BlogPracticeArea" class="form-control">
                        <option value="">-Select Color-</option>
                        <?php
                        if ($resultq->num_rows > 0) {

                            while ($rowq = $resultq->fetch_assoc()) {
                                ?>

                                <option style="background-color: <?= $rowq['ServiceID'] ?>" value="<?= $rowq['PageName'] ?>" <?php
                        if (@$Pcolor == $rowq['ServiceID']) {
                            echo "selected";
                        }
                                ?> ><?php echo $colorzz = $rowq['PageName']; ?>

                                </option>
                                <?php
                            }
                        }
                        ?>
                    </select>

                    <span class="text-danger"> <?= @$messages['error_BlogPracticeArea']; ?></span>
                  </div>
                </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-2 form-label" for="basic-icon-default-phone"> Tag Name Sinhala</label>
                <div class="col-sm-9">
                  <div class="input-group input-group-merge">
                    <span id="basic-icon-default-phone2" class="input-group-text"><i class="bx bx-phone"></i></span>
                    <input type="text" id="basic-icon-default-phone" class="form-control phone-mask"
                      placeholder="658 799 8941" aria-label="658 799 8941" aria-describedby="basic-icon-default-phone2"
                      name="SDSinhala" value="<?= @$SDSinhala ?>" />
                    <span class="text-danger"> <?= @$messages['error_SDSinhala']; ?></span>
                  </div>
                </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-2 form-label" for="basic-icon-default-phone"> Tag Name Tamil</label>
                <div class="col-sm-9">
                  <div class="input-group input-group-merge">
                    <span id="basic-icon-default-phone2" class="input-group-text"><i class="bx bx-phone"></i></span>
                    <input type="text" id="basic-icon-default-phone" class="form-control phone-mask"
                      placeholder="658 799 8941" aria-label="658 799 8941" aria-describedby="basic-icon-default-phone2"
                      name="SDTamil" value="<?= @$SDTamil ?>" />
                    <span class="text-danger"> <?= @$messages['error_SDTamil']; ?></span>
                  </div>
                </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-2 form-label" for="basic-icon-default-phone">Tag Name English</label>
                <div class="col-sm-9">
                  <div class="input-group input-group-merge">
                    <span id="basic-icon-default-phone2" class="input-group-text"><i class="bx bx-phone"></i></span>
                    <input type="text" id="basic-icon-default-phone" class="form-control phone-mask"
                      placeholder="658 799 8941" aria-label="658 799 8941" aria-describedby="basic-icon-default-phone2"
                      name="SDEnglish" value="<?= @$SDEnglish ?>" />
                    <span class="text-danger"> <?= @$messages['error_SDEnglish']; ?></span>
                  </div>
                </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-2 form-label" for="basic-icon-default-phone">Heading Sinhala</label>
                <div class="col-sm-9">
                  <div class="input-group input-group-merge">
                    <span id="basic-icon-default-phone2" class="input-group-text"><i class="bx bx-phone"></i></span>
                    <input type="text" id="basic-icon-default-phone" class="form-control phone-mask"
                      placeholder="658 799 8941" aria-label="658 799 8941" aria-describedby="basic-icon-default-phone2"
                      name="LDSinhala" value="<?= @$LDSinhala ?>" />
                    <span class="text-danger"> <?= @$messages['error_LDSinhala']; ?></span>
                  </div>
                </div>
              </div>

              <div class="row mb-3">
                <label class="col-sm-2 form-label" for="basic-icon-default-phone">Heading Tamil</label>
                <div class="col-sm-9">
                  <div class="input-group input-group-merge">
                    <span id="basic-icon-default-phone2" class="input-group-text"><i class="bx bx-phone"></i></span>
                    <input type="text" id="basic-icon-default-phone" class="form-control phone-mask"
                      placeholder="658 799 8941" aria-label="658 799 8941" aria-describedby="basic-icon-default-phone2"
                      name="LDTamil" value="<?= @$LDTamil ?>" />
                    <span class="text-danger"> <?= @$messages['error_LDTamil']; ?></span>
                  </div>
                </div>
              </div>

              <div class="row mb-3">
                <label class="col-sm-2 form-label" for="basic-icon-default-phone">Heading English </label>
                <div class="col-sm-9">
                  <div class="input-group input-group-merge">
                    <span id="basic-icon-default-phone2" class="input-group-text"><i class="bx bx-phone"></i></span>
                    <input type="text" id="basic-icon-default-phone" class="form-control phone-mask"
                      placeholder="658 799 8941" aria-label="658 799 8941" aria-describedby="basic-icon-default-phone2"
                      name="LDEnglish" value="<?= @$LDEnglish ?>" />
                    <span class="text-danger"> <?= @$messages['error_LDEnglish']; ?></span>
                  </div>
                </div>
              </div>
              <!-- description  -->
              <div class="row mb-3">
                <label class="col-sm-2 form-label" for="basic-icon-default-phone"> Description Sinhala</label>
                <div class="col-sm-9">
                  <div class="input-group input-group-merge">
                    <span id="basic-icon-default-phone2" class="input-group-text"><i class="bx bx-phone"></i></span>
                    <input type="text" id="basic-icon-default-phone" class="form-control phone-mask"
                      placeholder="658 799 8941" aria-label="658 799 8941" aria-describedby="basic-icon-default-phone2"
                      name="DescriptionSinhala" value="<?= @$LDSinhala ?>" />
                    <span class="text-danger"> <?= @$messages['error_DescriptionSinhala']; ?></span>
                  </div>
                </div>
              </div>

              <div class="row mb-3">
                <label class="col-sm-2 form-label" for="basic-icon-default-phone">Description Tamil</label>
                <div class="col-sm-9">
                  <div class="input-group input-group-merge">
                    <span id="basic-icon-default-phone2" class="input-group-text"><i class="bx bx-phone"></i></span>
                    <input type="text" id="basic-icon-default-phone" class="form-control phone-mask"
                      placeholder="658 799 8941" aria-label="658 799 8941" aria-describedby="basic-icon-default-phone2"
                      name="DescriptionTamil" value="<?= @$LDTamil ?>" />
                    <span class="text-danger"> <?= @$messages['error_DescriptionTamil']; ?></span>
                  </div>
                </div>
              </div>

              <div class="row mb-3">
                <label class="col-sm-2 form-label" for="basic-icon-default-phone">Description English </label>
                <div class="col-sm-9">
                  <div class="input-group input-group-merge">
                    <span id="basic-icon-default-phone2" class="input-group-text"><i class="bx bx-phone"></i></span>
                    <input type="text" id="basic-icon-default-phone" class="form-control phone-mask"
                      placeholder="658 799 8941" aria-label="658 799 8941" aria-describedby="basic-icon-default-phone2"
                      name="DescriptionEnglish" value="<?= @$LDEnglish ?>" />
                    <span class="text-danger"> <?= @$messages['error_DescriptionEnglish']; ?></span>
                  </div>
                </div>
              </div>

              <div class="row mb-3">
                <label class="col-sm-2 form-label" for="basic-icon-default-phone">Page Image </label>
                <div class="col-sm-9">
                  <div class="input-group input-group-merge">
                    <span id="basic-icon-default-phone2" class="input-group-text"><i class="bx bx-phone"></i></span>
                    <input type="file" id="basic-icon-default-phone" class="form-control phone-mask"
                      placeholder="658 799 8941" aria-label="658 799 8941" aria-describedby="basic-icon-default-phone2"
                      name="PageImage" />
                    <span class="text-danger"> <?= @$messages['error_PageImage']; ?></span>
                  </div>
                </div>
              </div>

             
              <div class="row justify-content-end">
                <div class="col-sm-10">
                  <button type="submit" name="submit" class="btn btn-primary">Send</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- / Content -->




  <?php include '../footer.php'; ?>