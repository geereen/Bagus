<?php
// ดึงข้อมูลรายละเอียดอาหารมาเก็บในตัวแปร sub
$query = $db->prepare("SELECT * FROM tb_subfood WHERE subtype = :subtype");//เตรียมคำสั่ง sql
$query->execute([
  'subtype'=>$_GET['subtype']
]);
$sub = $query->fetchAll(PDO::FETCH_OBJ);

$type = require('type.php');
if (isset($_GET['id'])) {
$query = $db->prepare("SELECT * FROM tb_food WHERE id_food = :id");
$query->execute([
  'id'=>$_GET['id']
]);//รัน sql
$row = $query->fetch(PDO::FETCH_OBJ);
}
?>

<div class="col-md-12 col-sm-6 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
      <a data-toggle="tooltip" data-placement="top" title="Back" href="home.php?file=food/index">
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
      <table class="table">
        <thead>
          <tr>
            <th><h2><?= $row->food_name;?></h2></th>
            <th>Type</th>
            <th>Detail</th>
            <th>Price</th>
            <th>Time of Cook</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><img src="../images/foods/<?=$row->cp_foodpic?>" alt="" width="220"/></td>
            <td><?= $type[$row->type];?></td>

            <td><?php foreach ($sub as $value):?>
            <?php if($value->subtype == $row->type){?>
            <?= $value->subname;?><br><? }else{ ?>
            <?php } ?>
            <?php endforeach;?>
            </td>

            <td><?php foreach ($sub as $value):?>
            <?= $value->subprice;?><br>
            <?php endforeach;?><?php if($row->price == 0){ echo " ";?><?php }else{?>
            <?= $row->price;?><?php } ?>
            </td>

            <td><?= $row->cooktime;?></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
