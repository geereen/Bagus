<?php
$status = require('order_status.php');
?>
<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
      <h2>Orders <small>Complete</small></h2>

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
            <th>Name Deliveryman</th>
            <th>Date</th>
            <th>Time</th>
            <th>Status</th>
            <th>Manage</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $query = $db->prepare("SELECT * FROM tb_order INNER JOIN tb_member ON tb_order.id_member=tb_member.id_member
                                 INNER JOIN tb_staff ON tb_order.id_staff=tb_staff.id_staff
                                 WHERE tb_order.status = 4 ORDER BY id_order ASC;");//เตรียมคำสั่ง sql
          $query->execute();//รัน sql
          if($query->rowCount() > 0){ //ตรวจสอบว่ามีข้อมูลมากว่า 0 ไหม
            $i=1;
            while($row = $query->fetch(PDO::FETCH_OBJ)){//ดึงข้อมูลมาใส่ใน $row
              $color='';
                if ($row->status==1) {
                  $color='info';
                }elseif ($row->status==2) {
                  $color='warning';
                }elseif ($row->status==3) {
                  $color='primary';
                }elseif ($row->status==4) {
                  $color='success';
                }
          ?>
          <tr>
            <td><?= $i++?></td>
            <td><?= $row->fullname_member;?></td>
            <td><?= $row->fullname_staff;?></td>
            <td><?= $row->order_date;?></td>
            <td><?= $row->order_time;?></td>
            <td><span class="label label-<?= $color?>"><?= $status[$row->status];?></span></td>
            <td>
              <a data-toggle="tooltip" data-placement="top" title="View" href="home.php?file=order/view&id=<?=$row->id_order?>">
                <span class="fa fa-eye" aria-hidden="true"></span>
              </a>&nbsp;
              <a data-toggle="tooltip" data-placement="top" title="Edit" href="home.php?file=order/edit&id=<?=$row->id_order?>">
                <span class="fa fa-pencil" aria-hidden="true"></span>
              </a>
            </td>
          </tr>
          <?php
            } //  ปิด while
          }// ปิด if
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
