<?php
$type = require('food/type.php');
$i=1;

// ดึงข้อมูลรายละเอียดอาหารมาเก็บในตัวแปร sub
$query = $db->prepare("SELECT DISTINCT subtype FROM tb_subfood;");//เตรียมคำสั่ง sql
$query->execute();
$sub = $query->fetchAll(PDO::FETCH_OBJ);

?>

  <div class="col-md-4 col-sm-4 col-xs-6">
    <form class="form-horizontal" action="" method="post">

      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Type <span class="required">:</span></label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <select class="select2_single form-control" name="subtype" required="required" tabindex="-1">
              <?php foreach ($sub as $value):?>
              <option></option>
              <option value="<?= $value->subtype?>"><?= $type[$value->subtype]?></option>
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
        <h2> Sub Foods </h2>
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
              <th>
                <a data-toggle="tooltip" data-placement="top" title="Add" href="home.php?file=subfood/add">
                <span class="fa fa-plus-circle" aria-hidden="true"></span></a>
              </th>
              <th>Sub of Type</th>
              <th>Detail</th>
              <th>Price</th>
              <th>Manage</th>
            </tr>
          </thead>
          <tbody>
            <?php

            $query = $db->prepare("SELECT * FROM tb_subfood WHERE tb_subfood.subtype = :subtype ORDER BY id_subfood ASC");//เตรียมคำสั่ง sql
            $query->execute([
              "subtype" => $_POST["subtype"]
            ]);//รัน sql
            if($query->rowCount() > 0){ //ตรวจสอบว่ามีข้อมูลมากว่า 0 ไหม
              $i=1;
              while($row = $query->fetch(PDO::FETCH_OBJ)){//ดึงข้อมูลมาใส่ใน $row
            ?>
            <tr>
              <td><?= $i++?></td>
              <td><?= $type[$row->subtype];?></td>
              <td><?= $row->subname;?></td>
              <td><?= $row->subprice;?></td>
              <td>
                <a data-toggle="tooltip" data-placement="top" title="Edit" href="home.php?file=subfood/edit&id=<?=$row->id_subfood?>">
                  <span class="fa fa-pencil" aria-hidden="true"></span>
                </a>&nbsp;
                <a data-toggle="tooltip" data-placement="top" title="Delete" href="home.php?file=subfood/delete&id=<?=$row->id_subfood?>">
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
