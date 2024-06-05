<?php
include '../header.php';
include '../navbar.php';
include '../function.php';
?>

<?php
extract($_POST);
if ($_SERVER['REQUEST_METHOD'] == "POST") {
  extract($_POST);

  $HName = cleanInput($HName);

  $LDEnglish = cleanInput($LDEnglish);
  $LDTamil = cleanInput($LDTamil);
  $LDSinhala = cleanInput($LDSinhala);
  $SDEnglish = cleanInput($SDEnglish);
  $SDTamil = cleanInput($SDTamil);
  $SDSinhala = cleanInput($SDSinhala);
  $productimage = $_FILES['PageImage'];
  $productimages = $_FILES['Iconimage'];
  //create array variable store validation messages
  $messages = array();

  //validate required fields
  if (empty($HName)) {
    $messages['error_HName'] = "The Name should not be empty..!";
  }
  if (empty($SDTamil)) {
    $messages['error_SDTamil'] = "The Name should not be empty..!";
  }

  if (empty($LDEnglish)) {
    $messages['error_LDEnglish'] = "The Name should not be empty..!";
  }
  if (empty($LDTamil)) {
    $messages['error_LDTamil'] = "The Name should not be empty..!";
  }
  if (empty($LDSinhala)) {
    $messages['error_LDSinhala'] = "The Name should not be empty..!";
  }
  if (empty($SDEnglish)) {
    $messages['error_SDEnglish'] = "The Name should not be empty..!";
  }
  if (empty($SDSinhala)) {
    $messages['error_SDSinhala'] = "The Name should not be empty..!";
  }

  if ($_FILES['PageImage']['name'] == "") {
    $messages['error_PageImage'] = "The Images should not be empty..!";
  }

  if ($_FILES['Iconimage']['name'] == "") {
    $messages['error_Iconimage'] = "The Images should not be empty..!";
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
          $file_name_new = uniqid('', true) . $HName . '.' . $file_ext;
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

  //Second Image
  if ($_FILES['Iconimage']['name'] != "") {
    $productimages = $_FILES['Iconimage'];
    $filename = $productimages['name'];
    $filetmpname = $productimages['tmp_name'];
    $filesize = $productimages['size'];
    $fileerror = $productimages['error'];
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
          $file_name_news = uniqid('', true) . $HName . '.' . $file_ext;
          //directing file destination
          $file_path = "../images/" . $file_name_news;
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
    echo $sql = "INSERT INTO practice_areas(ImageIcon, HeadingName, SmallerDescriptionSinhala, SmallerDescriptionTamil, SmallerDescriptionEnglish,
     LongerDescriptionSinhala, LongerDescriptionTamil, LongerDescriptionEnglish, PageImage, CreatedDate) 
     VALUES ('$file_name_news','$HName','$SDSinhala','$SDTamil','$SDEnglish','$LDSinhala','$LDTamil','$LDEnglish','$file_name_new',' $adddate')";
    $results = $db->query($sql);
  }

}

?>

<!-- Content wrapper -->
<div class="content-wrapper">
  <!-- Content -->

  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Adding</span> New PracticeArea</h4>

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
                <div class="col-sm-10">
                  <div class="input-group input-group-merge">
                    <span id="basic-icon-default-company2" class="input-group-text"><i
                        class="bx bx-buildings"></i></span>
                    <input type="text" id="basic-icon-default-company" class="form-control" placeholder="ACME Inc."
                      aria-label="ACME Inc." aria-describedby="basic-icon-default-company2" name="HName"
                      value="<?= @$HName ?>" />
                    <span class="text-danger"> <?= @$messages['error_HName']; ?></span>
                  </div>
                </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-2 form-label" for="basic-icon-default-phone">Short Description Sinhala</label>
                <div class="col-sm-10">
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
                <label class="col-sm-2 form-label" for="basic-icon-default-phone">Short Description Tamil</label>
                <div class="col-sm-10">
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
                <label class="col-sm-2 form-label" for="basic-icon-default-phone">Short Description English</label>
                <div class="col-sm-10">
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
                <label class="col-sm-2 form-label" for="basic-icon-default-phone">Long Description Sinhala</label>
                <div class="col-sm-10">
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
                <label class="col-sm-2 form-label" for="basic-icon-default-phone">Long Description Tamil</label>
                <div class="col-sm-10">
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
                <label class="col-sm-2 form-label" for="basic-icon-default-phone">Long Description English </label>
                <div class="col-sm-10">
                  <div class="input-group input-group-merge">
                    <span id="basic-icon-default-phone2" class="input-group-text"><i class="bx bx-phone"></i></span>
                    <input type="text" id="basic-icon-default-phone" class="form-control phone-mask"
                      placeholder="658 799 8941" aria-label="658 799 8941" aria-describedby="basic-icon-default-phone2"
                      name="LDEnglish" value="<?= @$LDEnglish ?>" />
                    <span class="text-danger"> <?= @$messages['error_LDEnglish']; ?></span>
                  </div>
                </div>
              </div>

              <div class="row mb-3">
                <label class="col-sm-2 form-label" for="basic-icon-default-phone">Icon Image </label>
                <div class="col-sm-10">
                  <div class="input-group input-group-merge">
                    <span id="basic-icon-default-phone2" class="input-group-text"><i class="bx bx-phone"></i></span>
                    <input type="file" id="basic-icon-default-phone" class="form-control phone-mask"
                      placeholder="658 799 8941" aria-label="658 799 8941" aria-describedby="basic-icon-default-phone2"
                      name="Iconimage" />
                    <span class="text-danger"> <?= @$messages['error_Iconimage']; ?></span>
                  </div>
                </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-2 form-label" for="basic-icon-default-phone">Page Image </label>
                <div class="col-sm-10">
                  <div class="input-group input-group-merge">
                    <span id="basic-icon-default-phone2" class="input-group-text"><i class="bx bx-phone"></i></span>
                    <input type="file" id="basic-icon-default-phone" class="form-control phone-mask"
                      placeholder="658 799 8941" aria-label="658 799 8941" aria-describedby="basic-icon-default-phone2"
                      name="PageImage" />
                    <span class="text-danger"> <?= @$messages['error_PageImage']; ?></span>
                  </div>
                </div>
              </div>

              <!-- <div class="row mb-3">
                          <label class="col-sm-2 form-label" for="basic-icon-default-message">Message</label>
                          <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                              <span id="basic-icon-default-message2" class="input-group-text"
                                ><i class="bx bx-comment"></i
                              ></span>
                              <textarea
                                id="basic-icon-default-message"
                                class="form-control"
                                placeholder="Hi, Do you have a moment to talk Joe?"
                                aria-label="Hi, Do you have a moment to talk Joe?"
                                aria-describedby="basic-icon-default-message2"
                              ></textarea>
                            </div>
                          </div>
                        </div> -->
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