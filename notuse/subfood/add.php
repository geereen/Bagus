<?php
$type = require('food/type.php');
$i=1;
////// กด Submit
if(isset($_POST['ok'])){
  $query = $db->prepare("INSERT INTO tb_subfood (
    subtype, subname, 	subprice
  ) VALUES (
    :subtype, :subname, :subprice
  );");

  $result = $query->execute([
    "subtype" => $_POST["subtype"],
    "subname" => $_POST["subname"],
    "subprice" => $_POST["subprice"]
  ]);
  if($result){
    echo "<script>alert('Successfully')</script>";
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
              <option></option>
              <option value="<?= $i++?>"><?= $value?></option>
              <?php endforeach;?>
            </select>
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Sub Detail <span class="required">*</span></label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="text" class="form-control" required="required" placeholder="รายละเอียด" name="subname">
          </div>
        </div>

        <div class="form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12">Price <span class="required">*</span></label>
           <div class="col-md-9 col-sm-9 col-xs-12">
             <input type="text" class="form-control" required="required" placeholder="ราคา" name="subprice">
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
