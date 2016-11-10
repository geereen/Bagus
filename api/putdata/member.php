<?php
require_once("../../libs/Db.php"); //ติดต่อฐานข้อมูล

$query = $db->prepare("INSERT INTO tb_member (fullname_member, email, address, tel_member, m_username, m_password, status_member)
 VALUES (:fullname, :email, :address, :tel, :username, :password, :status);");

$result = $query->execute([
  "fullname" => $_POST["fullname"],
  "email" => $_POST["email"],
  "address" => $_POST["address"],
  "tel" => $_POST["tel"],
  "username" => $_POST["username"],
  "password" => $_POST["password"],
  "status" => 1,
]);

if($result){
 echo json_encode(array('status' => 'success','message' => 'การสมัครสมาชิกสำเร็จ'));
}else{
 echo json_encode(array('status' => 'errors','message' => 'เกิดข้อผิดพลาด'));
}

?>
<?php $db = null; //ปิดฐานข้อมูล ?>
