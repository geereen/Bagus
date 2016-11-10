<?php
require_once("../../libs/Db.php"); //ติดต่อฐานข้อมูล
$i=0;

$query = $db->prepare("SELECT * FROM tb_notifydetail INNER JOIN tb_notify ON tb_notifydetail.id_notify=tb_notify.id_notify
                       INNER JOIN tb_order ON tb_notifydetail.id_order=tb_order.id_order
                       INNER JOIN tb_staff ON tb_order.id_staff=tb_staff.id_staff
                       WHERE tb_notify.id_member = :id AND tb_notify.notify_status = 1 ORDER BY tb_notify.id_notify DESC ");  //เตรียมคำสั่ง sql
$query->execute([
  "id" => $_GET["id"]
]);  //รัน sql
  if($query->rowCount() > 0){   //ตรวจสอบว่ามีข้อมูลมากว่า 0 ไหม
    while($row = $query->fetch(PDO::FETCH_OBJ)){  //ดึงข้อมูลมาใส่ใน $row
      $output[]=$row;
      if ($row->notify_status == 1) {
        $i++;
      }
    }
    print(json_encode(array('data' => $output,'num' => $i)));
  }else {
    print(json_encode(array('data'=>'','num'=>'')));
  }
?>
<?php $db = null; //ปิดฐานข้อมูล ?>
