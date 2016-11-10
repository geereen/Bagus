<?php
$db_host = 'mysql.hostinger.in.th'; // Sever database
$db_name = 'u927431626_bagus'; // ฐานข้อมูล
$db_user = 'u927431626_bagus'; // ชื่อผู้ใช้
$db_pass = '123456'; // รหัสผ่าน
$db = null;

try { // ให้พยายามทำงานคำสั่งต่อไปนี้
  $db = new PDO("mysql:host=$db_host; dbname=$db_name", $db_user, $db_pass);
  $db->exec("SET CHARACTER SET utf8"); // ให้รองรับภาษาไทย
}catch (PDOException $e) { //กรณีทำงานผิดพลาด
  echo "พบปัญหา : ".$e->getMessage(); //แสดง Error
}

$query = $db->prepare("SELECT * FROM tb_member WHERE status_member = 1");//เตรียมคำสั่ง sql
$query->execute();//รัน sql
if($query->rowCount() > 0){ //ตรวจสอบว่ามีข้อมูลมากว่า 0 ไหม
  while($row = $query->fetch(PDO::FETCH_OBJ)){//ดึงข้อมูลมาใส่ใน $row
    $output[]=$row;
  }
}
print(json_encode($output));
?>
