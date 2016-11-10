<?php
require_once("../../libs/Db.php"); //ติดต่อฐานข้อมูล

$query = $db->prepare("SELECT * FROM tb_order WHERE id_member = :id ORDER BY id_order ASC;");  //เตรียมคำสั่ง sql
$query->execute([
  "id" => $_GET["id"]
]);  //รัน sql
if($query->rowCount() > 0){   //ตรวจสอบว่ามีข้อมูลมากว่า 0 ไหม
  while($row = $query->fetch(PDO::FETCH_OBJ)){  //ดึงข้อมูลมาใส่ใน $row
    $output[]=$row;
  }
  //print(json_encode($output));
  print(json_encode(array('data' => $output, 'i' => $query->rowCount())));
}else{
  print(json_encode(array('data' => '', 'i' =>'')));
}

?>
<?php $db = null; //ปิดฐานข้อมูล ?>
