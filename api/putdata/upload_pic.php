<?php
require_once("../../libs/Db.php"); //ติดต่อฐานข้อมูล

if (isset($_GET["id"])) {
$target_dir = "../../images/members/";
$tmp_name = $_FILES["myCameraImg"]["tmp_name"];
$name = $_FILES["myCameraImg"]["name"];

//ฟังก์ชั่นวันที่
date_default_timezone_set('Asia/Bangkok'); //เซตทามโซน
$timeFile = date("Ymd")."_";
//ฟังก์ชั่นสุ่มตัวเลข
$numrand = (mt_rand());
//เอาชื่อไฟล์เก่าออกให้เหลือแต่นามสกุล
$type = strrchr($_FILES['myCameraImg']['name'],".");
//ตั้งชื่อไฟล์ใหม่โดยเอาเวลาไว้หน้าชื่อไฟล์เดิม
$newname = $timeFile.$numrand.$type;
$path_copy = $target_dir.$newname;

  if(move_uploaded_file($tmp_name,$path_copy)){ // ย้ายรูปไปที่ Server

    unlink($target_dir.$_GET['old_pic']); // ลบรูปเก่า
    // อัพเดตลงฐานข้อมูล
    $query = $db->prepare("UPDATE tb_member SET
      pic_member = :pic_member
      WHERE tb_member.id_member = :id ;");

    $result = $query->execute([
      "id" => $_GET["id"],
      "pic_member" => $newname
    ]);
    if ($result) {
       echo json_encode(array('status' => 'success','message' => 'สำเร็จ'));
    }else {
       echo json_encode(array('status' => 'errors','message' => 'เกิดข้อผิดพลาด'));
    }
  }
}

?>
<?php $db = null; //ปิดฐานข้อมูล ?>
