<?php
$query = $db->prepare("SELECT * FROM tb_orderdetail INNER JOIN tb_food ON (tb_orderdetail.id_food=tb_food.id_food)
                       INNER JOIN tb_order ON (tb_orderdetail.id_order=tb_order.id_order)
                       INNER JOIN tb_member ON (tb_order.id_member=tb_member.id_member)
                       WHERE tb_orderdetail.id_order = :id;");//เตรียมคำสั่ง sql
$query->execute([
  'id'=>$_GET['id']
]);//รัน sql
$sum = 0;
?>

<div class="col-md-12 col-sm-6 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
      <a data-toggle="tooltip" data-placement="top" title="Back" href="home.php?file=notification/index">
        <span class="fa fa-backward" aria-hidden="true"></span>
      </a>
      <ul class="nav navbar-right panel_toolbox">
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
        </li>
        <li><a class="close-link"><i class="fa fa-close"></i></a>
        </li>
      </ul>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
      <table class="table" >
        <thead>
          <tr>
            <th><h2>#</h2></th>
            <th>Menu</th>
            <th>Time of Cook</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if($query->rowCount() > 0){ //ตรวจสอบว่ามีข้อมูลมากว่า 0 ไหม
            $i=1;
            while($row = $query->fetch(PDO::FETCH_OBJ)){//ดึงข้อมูลมาใส่ใน $row
              $sum += $row->cooktime;
              $date = $row->order_date;
              $name = $row->fullname_member;
          ?>
          <tr>
            <td><?= $i++?></td>
            <td><?= $row->food_name;?></td>
            <td><?= $row->cooktime;?> นาที</td>
          </tr>
          <?php
            } //  ปิด while
          }// ปิด if
          ?>
        </tbody>
        <h2>Order ID : <?= $_GET['id']?></h2>
        <h4>Order from : <?= $name?></h4>
        <h4>Date/Time : <?= $date?></h4>
      </table>
      <span class="right"><p style="text-align:center;">Time total: <?=$sum/60%24?>:<?=$sum%60?> นาที</p></span><br><br>
      <span class="right">

    </span>
    </div>
    <p style="text-align:center;"><button class="btn btn-info">####</button></p>
  </div>
  </div>
</div>
