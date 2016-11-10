<?php
require_once("../../libs/Db.php"); //ติดต่อฐานข้อมูล

$query = $db->prepare("SELECT * FROM tb_comment INNER JOIN tb_member ON (tb_comment.id_member=tb_member.id_member)");  //เตรียมคำสั่ง sql
$query->execute();  //รัน sql
if($query->rowCount() > 0){   //ตรวจสอบว่ามีข้อมูลมากว่า 0 ไหม
  while($row = $query->fetch(PDO::FETCH_OBJ)){  //ดึงข้อมูลมาใส่ใน $row
    $output[]=$row;
  }
  print(json_encode(array('data' => $output)));
}else {
  print(json_encode(array('data' => '')));
}
//print(json_encode($output));
?>
<?php $db = null; //ปิดฐานข้อมูล ?>
