<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
      <h2> Delivery Man </h2>
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
            <!-- <th><input type="checkbox" id="check-all" class="flat"></th> -->
            <th>
              <a data-toggle="tooltip" data-placement="top" title="Add" href="home.php?file=deliveryman/add">
              <span class="fa fa-plus-circle" aria-hidden="true"></span></a>
            </th>
            <th>FirstName - LastName</th>
            <th>Gender</th>
            <th>Phone Number</th>
            <th>Manage</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $query = $db->prepare("SELECT * FROM tb_staff WHERE level = 1 ORDER BY id_staff ASC");//เตรียมคำสั่ง sql
          $query->execute();//รัน sql
          if($query->rowCount() > 0){ //ตรวจสอบว่ามีข้อมูลมากว่า 0 ไหม
            $i=1;
            while($row = $query->fetch(PDO::FETCH_OBJ)){//ดึงข้อมูลมาใส่ใน $row
          ?>
          <tr>
            <!-- <td><input type="checkbox" class="flat" name="table_records"></td> -->
            <td><?= $i++?></td>
            <td><?= $row->fullname_staff;?></td>
            <td><?= $row->sex;?></td>
            <td><?= $row->tel_staff;?></td>
            <td>
              <a data-toggle="tooltip" data-placement="top" title="View" href="home.php?file=deliveryman/view&id=<?=$row->id_staff?>">
                <span class="fa fa-eye" aria-hidden="true"></span>
              </a>&nbsp;
              <a data-toggle="tooltip" data-placement="top" title="Edit" href="home.php?file=deliveryman/edit&id=<?=$row->id_staff?>">
                <span class="fa fa-pencil" aria-hidden="true"></span>
              </a>&nbsp;
              <a data-toggle="tooltip" data-placement="top" title="Delete" href="home.php?file=deliveryman/delete&id=<?=$row->id_staff?>&old_pic=<?=$row->cp_picstaff?>">
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
