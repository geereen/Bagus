<?php
$status = require('order/order_status.php');
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
            <th>Date/Time</th>
            <th>Status</th>
            <th>Calculate</th>
            <th><center><i class="fa fa-paper-plane" aria-hidden="true"></i></center></th>
          </tr>
        </thead>
        <tbody>
          <?php
          $query = $db->prepare("SELECT * FROM tb_order INNER JOIN tb_member ON tb_order.id_member=tb_member.id_member
                                 WHERE tb_order.status = 1 ORDER BY id_order ASC;");//เตรียมคำสั่ง sql
          $query->execute();//รัน sql
          if($query->rowCount() > 0){ //ตรวจสอบว่ามีข้อมูลมากว่า 0 ไหม
            $i=1;
            while($row = $query->fetch(PDO::FETCH_OBJ)){//ดึงข้อมูลมาใส่ใน $row
          ?>
          <tr>
            <td><?= $i++?></td>
            <td><?= $row->fullname_member;?></td>
            <td><?= $row->order_date;?></td>
            <td><span class="label label-info"><?= $status[$row->status];?></span></td>
            <td>
              &nbsp;&nbsp;&nbsp;
              <a data-toggle="tooltip" data-placement="top" title="View" href="home.php?file=notification/view&id=<?=$row->id_order?>">
              <span class="fa fa-calculator" aria-hidden="true"></span>
              </a>
            </td>
            <td><button type="submit" class="btn btn-success btn-xs">Send</button></td>
          </tr>
          <?php
            } //  ปิด while
          } // ปิด if
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
