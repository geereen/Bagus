<?php
require_once("../../libs/Db.php"); //ติดต่อฐานข้อมูล

$query = $db->prepare("SELECT * FROM tb_staff WHERE tb_staff.id_staff = :id");  //เตรียมคำสั่ง sql
$query->execute([
  "id" => $_GET["id"]
]);  //รัน sql
  if($query->rowCount() > 0){   //ตรวจสอบว่ามีข้อมูลมากว่า 0 ไหม
    while($row = $query->fetch(PDO::FETCH_OBJ)){  //ดึงข้อมูลมาใส่ใน $row
      $output[]=$row;
    }
    print(json_encode(array('data' => $output)));
  }else {
    print(json_encode(array('data'=>'')));
  }
?>
<?php $db = null; //ปิดฐานข้อมูล ?>
