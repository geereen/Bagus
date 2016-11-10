<?php
$query = $db->prepare("SELECT * FROM tb_staff WHERE id_staff = :id");
$query->execute([
  'id'=>$_GET['id']
]);//รัน sql
$row = $query->fetch(PDO::FETCH_OBJ);
?>
<div class="col-md-12 col-sm-6 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
      <a data-toggle="tooltip" data-placement="top" title="Back" href="home.php?file=deliveryman/index">
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
            <th><h2><?= $row->fullname_staff;?></h2></th>
            <th>Gender</th>
            <th>Age</th>
            <th>Phone Number</th>

          </tr>
        </thead>
        <tbody>
          <tr>
            <td><img src="../images/deliveryman/<?=$row->cp_picstaff?>" alt="" width="220"/></td>
            <td><?= $row->sex;?></td>
            <td><?= $row->age;?></td>
            <td><?= $row->tel_staff;?></td>

            <td>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
