<?php
require_once("../../libs/Db.php"); //ติดต่อฐานข้อมูล
$sum = 0;
$query = $db->prepare("SELECT * FROM tb_orderdetail INNER JOIN tb_order ON (tb_orderdetail.id_order=tb_order.id_order)
                       INNER JOIN tb_food ON (tb_orderdetail.id_food=tb_food.id_food)
                       INNER JOIN tb_member ON (tb_order.id_member=tb_member.id_member)
                       WHERE tb_orderdetail.id_order = :id;");  //เตรียมคำสั่ง sql
$query->execute([
  "id" => $_GET["id"]
]);  //รัน sql
if($query->rowCount() > 0){   //ตรวจสอบว่ามีข้อมูลมากว่า 0 ไหม
  while($row = $query->fetch(PDO::FETCH_OBJ)){  //ดึงข้อมูลมาใส่ใน $row
    $output[]=$row;
    $sum += ($row->price*$row->amount);
    $status = $row->status;
    $time = $row->order_time;
  }
}
//print(json_encode($output));
print(json_encode(array('data' => $output, 'sum' => $sum, 'status' => $status, 'time' => $time)));
?>
<?php $db = null; //ปิดฐานข้อมูล ?>
