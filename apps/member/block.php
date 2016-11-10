<?php
$status = require('member_status.php');
?>

<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
      <h2>Member<small>Block</small></h2>
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
            <th>FirstName - LastName</th>
            <th>E-mail</th>
            <th>Username</th>
            <th>Status</th>
            <th>Manage</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $query = $db->prepare("SELECT * FROM tb_member WHERE status_member = 0 ORDER BY id_member ASC");//เตรียมคำสั่ง sql
          $query->execute();//รัน sql
          if($query->rowCount() > 0){ //ตรวจสอบว่ามีข้อมูลมากว่า 0 ไหม
            $i=1;
            while($row = $query->fetch(PDO::FETCH_OBJ)){//ดึงข้อมูลมาใส่ใน $row
              $color='';
                if ($row->status_member==0) {
                  $color='danger';
                }elseif ($row->status_member==1) {
                  $color='success';
                }
          ?>
          <tr>
            <td><?= $i++?></td>
            <td><?= $row->fullname_member;?></td>
            <td><?= $row->email;?></td>
            <td><?= $row->m_username;?></td>
            <td><span class="label label-<?= $color?>"><?= $status[$row->status_member];?></span></td>
            <td>
              <a data-toggle="tooltip" data-placement="top" title="View" href="home.php?file=member/view&id=<?=$row->id_member?>">
                <span class="fa fa-eye" aria-hidden="true"></span>
              </a>&nbsp;
              <a data-toggle="tooltip" data-placement="top" title="Delete" href="home.php?file=member/delete&id=<?=$row->id_member?>">
                <span class="fa fa-trash-o" aria-hidden="true"></span>
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
