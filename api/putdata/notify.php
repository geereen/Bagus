<?php
require_once("../../libs/Db.php"); //ติดต่อฐานข้อมูล

$query = $db->prepare("UPDATE tb_notify SET
  notify_status = :notify_status
  WHERE tb_notify.id_notify = :id ;");

$result = $query->execute([
  "id" => $_GET["id"],
  "notify_status" =>2,
]);

if($result){
 echo json_encode(array('status' => 'success','message' => 'อ่านแล้ว'));
}else{
 echo json_encode(array('status' => 'errors','message' => 'เกิดข้อผิดพลาด'));
}

?>
<?php $db = null; //ปิดฐานข้อมูล ?>
