<?php
//ดึงข้อมูลพนักงานส่งมาเก็บในตัวแปร Deliveryman
$query = $db->prepare("SELECT * FROM tb_staff WHERE tb_staff.level = 1;");//เตรียมคำสั่ง sql
$query->execute();
$deliveryman = $query->fetchAll(PDO::FETCH_OBJ);

if(isset($_GET['id'])){
  $query = $db->prepare("SELECT * FROM tb_order WHERE id_order=:id");
  $query->execute(['id'=>$_GET['id']]);
  if($query->rowCount()>0){
    $data = $query->fetch(PDO::FETCH_OBJ);
    $record=[
      'status'=>$data->status,
      'delivery' => $data->id_staff
    ];
  }
}


if (isset($_POST['ok'])) {
  // อัพเดตลงฐานข้อมูล
  $query = $db->prepare("UPDATE tb_order SET
    id_staff = :delivery,
    status = :status
    WHERE tb_order.id_order = :id ;");

  $result = $query->execute([
    "id" => $_GET["id"],
    "delivery" => $_POST["delivery"],
    "status" => $_POST["status"],
  ]);

  if($result){
    echo "<script>
    alert('Successfully');
    window.location = 'home.php?file=order/index';
    </script>";
  }else{
    echo "<script>
    alert('Save fail! '".$query->errorInfo()[2].");
    </script>";
  }
}
?>

<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
      <h2> ORDER <small></small></h2>
      <ul class="nav navbar-right panel_toolbox">
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
        </li>
        <li><a class="close-link"><i class="fa fa-close"></i></a>
        </li>
      </ul>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
      <a data-toggle="tooltip" data-placement="top" title="Back" href="home.php?file=order/index">
        <span class="fa fa-backward" aria-hidden="true"></span>
      </a>
      <br/>

      <form data-parsley-validate class="form-horizontal form-label-left" action="" method="post" >

        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Status </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="btn-group" data-toggle="buttons">
              <label class="btn btn-warning <?php if ($record['status']==1){ echo "active";} ?>">
                <input type="radio" name="status" value="1" <?php if ($record['status']==1){ echo "checked";} ?> > &nbsp; Waiting.. &nbsp;
              </label>
              <label class="btn btn-warning <?php if ($record['status']==2){ echo "active";} ?>">
                <input type="radio" name="status" value="2" <?php if ($record['status']==2){ echo "checked";} ?> > Cooking &nbsp;
              </label>
              <label class="btn btn-warning <?php if ($record['status']==3){ echo "active";} ?>">
                <input type="radio" name="status" value="3" <?php if ($record['status']==3){ echo "checked";} ?> > &nbsp; Sending &nbsp;
              </label>
              <label class="btn btn-warning <?php if ($record['status']==4){ echo "active";} ?>">
                <input type="radio" name="status" value="4" <?php if ($record['status']==4){ echo "checked";} ?> > &nbsp; Complete
              </label>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Delivery Man </label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <select class="select2_single form-control" name="delivery" tabindex="-1" >
              <?php foreach ($deliveryman as $value):?>
                <?php
                  $select='';
                  if($record['delivery']==$value->id_staff){
                    $select = 'selected';
                  }
                ?>
              <option></option>
              <option value="<?= $value->id_staff?>" <?=$select?>><?= $value->fullname_staff?></option>
              <?php endforeach;?>
            </select>
          </div>
        </div>

        <div class="ln_solid"></div>
        <div class="form-group">
          <div style="text-align:center;">
            <button type="submit" class="btn btn-success" name="ok">Submit</button>
            <button type="reset" class="btn btn-default">Clear</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
