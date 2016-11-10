<?php
$type = require('type.php');
$i=1;
?>

<div class="col-md-4 col-sm-4 col-xs-6">
  <form class="form-horizontal" action="" method="post">

    <div class="form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12">Type <span class="required">:</span></label>
        <div class="col-md-9 col-sm-9 col-xs-12">
          <select class="select2_single form-control" name="type" required="required" tabindex="-1">
            <?php foreach ($type as $value):?>
            <option></option>
            <option value="<?= $i++?>"><?= $value?></option>
            <?php endforeach;?>
          </select>
        </div>
      </div>

  <div class="form-group">
    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
      <button type="submit" class="btn btn-success" name="ok">Submit</button>
    </div>
  </div>

  </form>
</div>
<?php
  if(isset($_POST['ok'])){
?>
<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
      <h2> Foods </h2>
      <!-- <a href="home.php?file=deliveryman/add"><i class="fa fa-plus-circle"></i></a> -->

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
            <th>
              <a data-toggle="tooltip" data-placement="top" title="Add" href="home.php?file=food/add1">
              <span class="fa fa-plus-circle" aria-hidden="true"></span></a>
            </th>
            <th>Name</th>
            <th>Type</th>
            <th>Price</th>
            <th>Time of Cook</th>
            <th>Manage</th>
          </tr>
        </thead>
        <tbody>
        <?php
          $query = $db->prepare("SELECT * FROM tb_food WHERE tb_food.type = :type ORDER BY id_food ASC");//เตรียมคำสั่ง sql
          $query->execute([
            "type" => $_POST["type"]
          ]);//รัน sql
          if($query->rowCount() > 0){ //ตรวจสอบว่ามีข้อมูลมากว่า 0 ไหม
            $i=1;
            while($row = $query->fetch(PDO::FETCH_OBJ)){//ดึงข้อมูลมาใส่ใน $row
        ?>
          <tr>
            <td><?= $i++?></td>
            <td><?= $row->food_name;?></td>
            <td><?= $type[$row->type];?></td>
            <td><?php if ($row->price == 0){ echo " - ";?><?php }else{?><?= $row->price;?><?php } ?></td>
            <td><?= $row->cooktime;?></td>
            <td>
              <a data-toggle="tooltip" data-placement="top" title="View" href="home.php?file=food/view&id=<?=$row->id_food?>&subtype=<?=$row->type?>">
                <span class="fa fa-eye" aria-hidden="true"></span>
              </a>&nbsp;
              <a data-toggle="tooltip" data-placement="top" title="Edit" href="home.php?file=food/edit&id=<?=$row->id_food?>">
                <span class="fa fa-pencil" aria-hidden="true"></span>
              </a>&nbsp;
              <a data-toggle="tooltip" data-placement="top" title="Delete" href="home.php?file=food/delete&id=<?=$row->id_food?>&old_pic=<?=$row->cp_foodpic?>">
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
<?php
  } // ปิด if ok
?>
