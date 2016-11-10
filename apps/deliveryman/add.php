<?php
if(isset($_POST['ok'])){
  // อัพโหลดรูป
  $target_dir = "D:/xampp/htdocs/Bagus/images/deliveryman/";
  $target_file = $target_dir . basename($_FILES["image"]["name"]);
  $uploadOk = 1;
  $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

  //ฟังก์ชั่นวันที่
  date_default_timezone_set('Asia/Bangkok');
  $date = date("Ymd");
  //ฟังก์ชั่นสุ่มตัวเลข
  $numrand = (mt_rand());
  //เอาชื่อไฟล์เก่าออกให้เหลือแต่นามสกุล
  $type = strrchr($_FILES['image']['name'],".");
  //ตั้งชื่อไฟล์ใหม่โดยเอาเวลาไว้หน้าชื่อไฟล์เดิม
  $newname = $date.$numrand.$type;
  $path_copy = $target_dir.$newname;

  $check = getimagesize($_FILES["image"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }

  // Check if file already exists
  if (file_exists($target_file)) {
      echo "Sorry, file already exists.";
      $uploadOk = 0;
  }
  // Check file size
  if ($_FILES["image"]["size"] > 500000000) {
      echo "Sorry, your file is too large.";
      $uploadOk = 0;
  }
  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif" ) {
      echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $uploadOk = 0;
  }
  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
  } else {
      if (move_uploaded_file($_FILES["image"]["tmp_name"], $path_copy)) {
          //echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
          // เพิ่มลงฐานข้อมูล
          $query = $db->prepare("INSERT INTO tb_staff (
            fullname_staff, sex, 	age, tel_staff, pic_staff, cp_picstaff, level
          ) VALUES (
            :fullname, :sex, :age, :tel, :image, :cp_picstaff, :level
          );");

          $result = $query->execute([
            "fullname" => $_POST["fullname"],
            "sex" => $_POST["sex"],
            "age" => $_POST["age"],
            "tel" => $_POST["tel"],
            "image" => $_FILES["image"]["name"],
            "level" => 1,
            "cp_picstaff" => $newname
          ]);
            if($result){
              echo "<script>alert('Save Successfully')</script>";
            }else{
              echo "<script>
                 alert('Save fail! '".$query->errorInfo()[2].");
                 </script>";
            }
      } else {
          echo "Sorry, there was an error uploading your file.";
      }
  }

}

?>

<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
      <h2> Form Design <small>different form elements</small></h2>
      <ul class="nav navbar-right panel_toolbox">
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
        </li>
        <li><a class="close-link"><i class="fa fa-close"></i></a>
        </li>
      </ul>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
      <a data-toggle="tooltip" data-placement="top" title="View All" href="home.php?file=deliveryman/index">
        <span class="fa fa-backward" aria-hidden="true"></span>
      </a>
      <br />
      <form data-parsley-validate class="form-horizontal form-label-left" action="" method="post" enctype="multipart/form-data">

        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Full Name <span class="required">*</span>
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text"  required="required" placeholder="ชื่อ-สกุล" class="form-control col-md-7 col-xs-12" name="fullname" value="">
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Picture <span class="required">*</span>
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="file" name="image" required="required" accept="image/*">
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Gender <span class="required">*</span></label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <div id="gender" class="btn-group" data-toggle="buttons">
              <label class="btn btn-primary">
                <input type="radio" name="sex" value="Male" required="required"> &nbsp; Male &nbsp;
              </label>
              <label class="btn btn-primary">
                <input type="radio" name="sex" value="Female" required="required"> Female
              </label>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Age <span class="required">*</span>
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text"  required="required" placeholder="อายุ" class="form-control col-md-7 col-xs-12" name="age" value="">
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Phone Number <span class="required">*</span>
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text"  required="required" placeholder="เบอร์โทรศัพท์" class="form-control col-md-7 col-xs-12" name="tel" value="">
          </div>
        </div>

        <div class="ln_solid"></div>
        <div class="form-group">
          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
            <button type="submit" class="btn btn-success" name="ok">Submit</button>
            <button type="reset" class="btn btn-default">Clear</button>
          </div>
        </div>

      </form>


    </div>
  </div>
</div>
