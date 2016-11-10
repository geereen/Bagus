<?php
require_once("../../libs/Db.php"); //ติดต่อฐานข้อมูล
date_default_timezone_set('Asia/Bangkok'); //เซตทามโซน
$date = date("Y-m-d");
$time = date("H:i:s");

if (isset($_POST['id'])) {
  $id_member = $_POST['id'];
  $cart =  json_decode($_POST['data']);

  $query = $db->prepare("INSERT INTO tb_order (id_member, id_staff, order_date, order_time, status)
                         VALUES (:id_member, :id_staff, :order_date, :order_time, :status);");

  $result = $query->execute([
    "id_member" => $id_member,
    "id_staff" => 5,
    "order_date" => $date,
    "order_time" => $time,
    "status" => 1,
  ]);

  if ($result) {
    $lastId = $db->lastInsertId();
    foreach ($cart as $value){
      $query = $db->prepare("INSERT INTO tb_orderdetail (id_order, id_food, amount)
                             VALUES (:id_order, :id_food, :amount);");
      $res = $query->execute([
        "id_order" => $lastId,
        "id_food" => $value->id_food,
        "amount" => $value->amount,
      ]);
    } // foreach

    if ($res) {
      print(json_encode(array('status' => 'success','message' => 'สำเร็จ')));
    }else {
      print(json_encode(array('status' => 'errors','message' => 'ไม่สำเร็จ')));
    }

  } // if result
}

?>
<?php $db = null; //ปิดฐานข้อมูล ?>
