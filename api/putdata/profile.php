<?php
require_once("../../libs/Db.php"); //ติดต่อฐานข้อมูล

$query = $db->prepare("UPDATE tb_member SET
  fullname_member = :fullname,
  email = :email,
  address = :address,
  tel_member = :tel
  WHERE tb_member.id_member = :id ;");

$result = $query->execute([
  "id" => $_GET["id"],
  "fullname" => $_POST["fullname"],
  "email" => $_POST["email"],
  "address" => $_POST["address"],
  "tel" => $_POST["tel"]
]);

if($result){
 echo json_encode(array('status' => 'success','message' => 'สำเร็จ'));
}else{
 echo json_encode(array('status' => 'errors','message' => 'เกิดข้อผิดพลาด'));
}

?>
<?php $db = null; //ปิดฐานข้อมูล ?>
