<?php
if (isset($_GET['id'])) {
  $query = $db->prepare("SELECT * FROM tb_order WHERE tb_order.id_order = :id;");
  $query->execute([
    'id'=>$_GET['id']
  ]);//รัน sql
  if ($query->rowCount() > 0) {
    $order = $query->fetch(PDO::FETCH_OBJ);

    $query = $db->prepare("INSERT INTO tb_notify (id_member, notify_date, notify_time, notify_status)
                           VALUES (:id_member, :notify_date, :notify_time, :notify_status);");

    $result = $query->execute([
      "id_member" =>$order->id_member,
      "notify_date" =>date("Y-m-d"),
      "notify_time" =>date("H:i:s"),
      "notify_status" =>1,
    ]);
    if ($result) {
      $idnotify = $db->lastInsertId();
      $query = $db->prepare("INSERT INTO tb_notifydetail (id_notify, id_order, notify_type, notify_txt)
                             VALUES (:id_notify, :id_order, :notify_type, :notify_txt);");

      $result1 = $query->execute([
        "id_notify" =>$idnotify,
        "id_order" =>$order->id_order,
        "notify_type" =>2,
        "notify_txt" =>"โปรไฟล์พนักงานส่ง",
      ]);
      if($result1){
        echo "<script>
              alert('Send alert Successfully')
              window.location = 'home.php?file=notification/index';
              </script>";
      }else{
        echo "<script>
           alert('Send fail! '".$query->errorInfo()[2].");
           </script>";
      }

    }
  }
}
?>
