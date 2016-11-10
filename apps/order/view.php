<?php
$query = $db->prepare("SELECT * FROM tb_orderdetail INNER JOIN tb_order ON (tb_orderdetail.id_order=tb_order.id_order)
                       INNER JOIN tb_food ON (tb_orderdetail.id_food=tb_food.id_food)
                       INNER JOIN tb_member ON (tb_order.id_member=tb_member.id_member)
                       WHERE tb_orderdetail.id_order = :id;");//เตรียมคำสั่ง sql
$query->execute([
  'id'=>$_GET['id']
]);//รัน sql
$sum = 0;
?>

<script type="text/javascript">
            function printTable(print){
                var printContents = document.getElementById(print).innerHTML;
                var originalContents = document.body.innerHTML;
                document.body.innerHTML = printContents;
                window.print();
                document.body.innerHTML = originalContents;
            }
</script>

<div class="col-md-12 col-sm-6 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
      <a data-toggle="tooltip" data-placement="top" title="Back" href="home.php?file=order/index">
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
      <div id="table">
      <table class="table" >
        <thead>
          <tr>
            <th><h2>#</h2></th>
            <th>Menu</th>
            <th>Amount</th>
            <th>Price</th>
            <th>Total Price</th>

          </tr>
        </thead>
        <tbody>
          <?php
          if($query->rowCount() > 0){ //ตรวจสอบว่ามีข้อมูลมากว่า 0 ไหม
            $i=1;
            while($row = $query->fetch(PDO::FETCH_OBJ)){//ดึงข้อมูลมาใส่ใน $row
              $name = $row->fullname_member;
              $address = $row->address;
              $date = $row->order_date;
              $time = $row->order_time;
              $sum += ($row->price*$row->amount);
          ?>
          <tr>
            <td><?= $i++?></td>
            <td><?= $row->food_name;?></td>
            <td><?= $row->amount;?></td>
            <td><?= $row->price;?></td>
            <td><?= ($row->price*$row->amount);?></td>
          </tr>
          <?php
            } //  ปิด while
          }// ปิด if
          ?>
        </tbody>
        <h1 style="text-align:center;">Bagus Delivery</h1>
        <h2>Order ID : A00<?= $_GET['id']?></h2>
        <h4>Order from : <?= $name?></h4>
        <h4>Date : <?= $date?></h4>
        <h4>Time : <?= $time?></h4>
      </table>
      <span class="left">
        <br><br>
        <p style="text-align:left; width:180px;">Address : <?=$address?></p>
      </span>
      <span class="right"><p style="text-align:center;">Total : <?=$sum?> บาท</p></span><br><br>
      <span class="right">
        <p style="text-align:center;">Signature recipient</p><br>
        <p style="text-align:center;">....................</p>
        <p style="text-align:center;">(<?= $name?>)</p>
    </span>
    </div>
    <p style="text-align:center;"><button OnClick="printTable('table');" class="btn btn-info">Print</button></p>
  </div>
  </div>
</div>
