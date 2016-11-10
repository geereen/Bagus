<?php
$status = require('order/order_status.php');

$query = $db->prepare("SELECT * FROM tb_order INNER JOIN tb_member ON tb_order.id_member=tb_member.id_member
                       WHERE tb_order.status = 3 ORDER BY id_order ASC;");//เตรียมคำสั่ง sql
$query->execute();//รัน sql
$ordersend = $query->fetchAll(PDO::FETCH_OBJ);
?>
<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
      <h2>Orders <small></small></h2>

      <ul class="nav navbar-right panel_toolbox">
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
        </li>
        <li><a class="close-link"><i class="fa fa-close"></i></a>
        </li>
      </ul>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
      <table id="datatable" class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Name Member</th>
            <th>Date</th>
            <th>Status</th>
            <th><center><i class="fa fa-paper-plane" aria-hidden="true"></i> Notification</center></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($ordersend as $key => $row): ?>
          <tr>
            <td><?= ($key+1);?></td>
            <td><?= $row->fullname_member;?></td>
            <td><?= $row->order_date;?></td>
            <td><span class="label label-primary"><?= $status[$row->status];?></span></td>
            <td>
             <center>
              <?php
                $query = $db->prepare("SELECT * FROM tb_notifydetail WHERE id_order = :id_order AND notify_type = 1");
                $query->execute([
                  'id_order' => $row->id_order
                ]);
                if($query->rowCount()>0){
              ?>
              <a href="#" class="btn btn-info btn-xs" disabled>Sending</a>
              &nbsp;&nbsp;
              <?php }else{ ?>
              <a href="home.php?file=notification/add1&id=<?=$row->id_order?>" class="btn btn-info btn-xs">Sending</a>
              &nbsp;&nbsp;
              <?php } ?>
              <?php
                $query = $db->prepare("SELECT * FROM tb_notifydetail WHERE id_order = :id_order AND notify_type = 2");
                $query->execute([
                  'id_order' => $row->id_order
                ]);
                if($query->rowCount()>0){
              ?>
              <a href="#" class="btn btn-success btn-xs" disabled>Deliveryman</a>
              <?php }else{ ?>
              <a href="home.php?file=notification/add2&id=<?=$row->id_order?>" class="btn btn-success btn-xs">Deliveryman</a>
              <?php } ?>
             </center>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
