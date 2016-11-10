<?php
$type = require('food/type.php');
$i=1;

if(isset($_GET['id'])){
  $query = $db->prepare("SELECT * FROM tb_subfood WHERE id_subfood=:id");
  $query->execute(['id'=>$_GET['id']]);
  if($query->rowCount()>0){
    $data = $query->fetch(PDO::FETCH_OBJ);
    $record=[
      'subtype'=>$data->subtype
    ];
  }
}

if (isset($_POST['ok'])) {
  // อัพเดตลงฐานข้อมูล
  $query = $db->prepare("UPDATE tb_subfood SET
    subtype = :subtype,
    subname = :subname,
    subprice = :subprice
    WHERE tb_subfood.id_subfood = :id ;");

  $result = $query->execute([
    "id" => $_GET["id"],
    "subtype" => $_POST["subtype"],
    "subname" => $_POST["subname"],
    "subprice" => $_POST["subprice"],
  ]);

  if($result){
    echo "<script>
    alert('Successfully');
    window.location = 'home.php?file=subfood/index';
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
      <h2>Form Basic Elements <small>different form elements</small></h2>
      <ul class="nav navbar-right panel_toolbox">
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
        </li>
        <li><a class="close-link"><i class="fa fa-close"></i></a>
        </li>
      </ul>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
      <a data-toggle="tooltip" data-placement="top" title="View All" href="home.php?file=subfood/index">
        <span class="fa fa-backward" aria-hidden="true"></span>
      </a>
      <br />
      <form class="form-horizontal form-label-left" action="" method="post">

        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Sub of Type <span class="required">*</span></label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <select class="select2_single form-control" name="subtype" required="required" tabindex="-1">
              <?php foreach ($type as $value):?>
                <?php
                  $select='';
                  if($record['subtype']==$i){
                    $select = 'selected';
                  }
                ?>
              <option></option>
              <option value="<?= $i++?>" <?=$select?>><?= $value?></option>
              <?php endforeach;?>
            </select>
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Sub Detail <span class="required">*</span></label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="text" class="form-control" required="required" placeholder="รายละเอียด" name="subname" value="<?=$data->subname?>">
          </div>
        </div>

        <div class="form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12">Price <span class="required">*</span></label>
           <div class="col-md-9 col-sm-9 col-xs-12">
             <input type="text" class="form-control" required="required" placeholder="ราคา" name="subprice" value="<?=$data->subprice?>">
           </div>
         </div>

        <div class="ln_solid"></div>
        <div class="form-group">
          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
            <button type="submit" class="btn btn-success" name="ok">Submit</button>
            <button type="reset" class="btn btn-default">Clear</button>
          </div>
        </div>

      </form>
    </div>
  </div>
</div>
