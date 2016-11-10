<?php
require_once("../libs/Db.php"); //ติดต่อฐานข้อมูล

$query = $db->prepare("SELECT * FROM tb_member WHERE m_username = :username AND m_password = :password AND status_member = 1");
$query->execute([
  'username'=>$_POST['username'],
  'password'=>$_POST['password'],
]);

if($query->rowCount()>0){ #กรณีมีค่ามากว่า 0 = ล็อกอินผ่าน
 $data = $query->fetch(PDO::FETCH_OBJ);
 //print(json_encode($data));
 print(json_encode(array('status' => 'success','message' => 'สำเร็จ','id' => $data->id_member,'name' => $data->fullname_member)));
}else{
 print(json_encode(array('status' => 'errors','message' => 'ไม่สำเร็จ')));
}

?>
<?php $db = null; //ปิดฐานข้อมูล ?>
