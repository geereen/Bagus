<?php
require_once("../../libs/Db.php"); //ติดต่อฐานข้อมูล
date_default_timezone_set('Asia/Bangkok'); //เซตทามโซน
$date = date("Y-m-d H:i:s");

$query = $db->prepare("INSERT INTO tb_comment (id_member, date_comment, detail)
 VALUES (:id, :date_comment, :comment);");

$result = $query->execute([
  "id" => $_POST["id"],
  "date_comment" => $date,
  "comment" => $_POST["comment"],
]);

if($result){
 echo json_encode(array('status' => 'success','message' => 'สำเร็จ'));
}else{
 echo json_encode(array('status' => 'errors','message' => 'เกิดข้อผิดพลาด'));
}

?>
<?php $db = null; //ปิดฐานข้อมูล ?>
